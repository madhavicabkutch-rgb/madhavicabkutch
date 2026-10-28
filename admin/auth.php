<?php
/* ============================================================
   Admin authentication guard.
   Every admin page includes this first. If nobody is logged in,
   it redirects to the login page and stops.
   ============================================================ */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* Buffer output so header('Location: ...') still works even after
   part of the page has already been printed. Without this, every
   save, delete and toggle redirect fails with "headers already sent". */
if (!ob_get_level()) {
    ob_start();
}

/* Prevent admin pages from being cached by browser or proxies */
if (!headers_sent()) {
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Pragma: no-cache');
    header('Expires: 0');
}

require_once __DIR__ . '/../config.php';

/* Pages that do not need a login */
$public_admin_pages = array('login.php');
$current_page = basename($_SERVER['PHP_SELF']);

if (!in_array($current_page, $public_admin_pages)) {
    if (empty($_SESSION['admin_id'])) {
        header('Location: login.php');
        exit;
    }
}

/* CSRF token for forms */
if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(16));
}

function csrf_field() {
    return '<input type="hidden" name="csrf" value="' . $_SESSION['csrf'] . '">';
}

function csrf_ok() {
    return isset($_POST['csrf']) && hash_equals($_SESSION['csrf'], $_POST['csrf']);
}

/* Flash messages between redirects */
function flash_set($type, $msg) {
    $_SESSION['flash'] = array('type' => $type, 'msg' => $msg);
}

function flash_show() {
    if (empty($_SESSION['flash'])) return '';
    $f = $_SESSION['flash'];
    unset($_SESSION['flash']);
    $cls = ($f['type'] === 'error') ? 'al-bad' : 'al-ok';
    return '<div class="alert ' . $cls . '">' . e($f['msg']) . '</div>';
}

/* Current admin name */
function admin_name() {
    return isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : 'Admin';
}

/* Read a POST value safely */
function post($key, $default = '') {
    return isset($_POST[$key]) ? trim($_POST[$key]) : $default;
}

/* Read a GET id as an integer */
function get_id() {
    return isset($_GET['id']) ? (int)$_GET['id'] : 0;
}

/* Make a URL-safe slug from a title */
function make_slug($text) {
    $s = strtolower(trim($text));
    $s = preg_replace('/[^a-z0-9]+/', '-', $s);
    $s = trim($s, '-');
    return $s === '' ? 'item-' . time() : $s;
}

/* Safe image uploader with multiple MIME detection fallbacks (works without php-fileinfo) */
function handle_image_upload($field_name, $current_image = '') {
    if (!isset($_FILES[$field_name]) || $_FILES[$field_name]['error'] === UPLOAD_ERR_NO_FILE) {
        return array('ok' => true, 'has_file' => false, 'filename' => $current_image);
    }

    $f = $_FILES[$field_name];

    if ($f['error'] !== UPLOAD_ERR_OK) {
        return array('ok' => false, 'error' => 'Image upload failed. Please try again.');
    }

    if ($f['size'] > 5 * 1024 * 1024) {
        return array('ok' => false, 'error' => 'Image must be 5 MB or smaller.');
    }

    $tmp = $f['tmp_name'];
    $mime = '';
    $ext = '';

    // 1. Try getimagesize (PHP core, reliable, no fileinfo dependency)
    $img_info = @getimagesize($tmp);
    if ($img_info && !empty($img_info['mime'])) {
        $mime = strtolower($img_info['mime']);
    }

    // 2. Try finfo if available
    if (!$mime && class_exists('finfo')) {
        try {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = strtolower((string)$finfo->file($tmp));
        } catch (Throwable $e) {}
    }

    // 3. Try mime_content_type if available
    if (!$mime && function_exists('mime_content_type')) {
        $mime = strtolower((string)@mime_content_type($tmp));
    }

    $mime_map = array(
        'image/jpeg' => 'jpg',
        'image/pjpeg' => 'jpg',
        'image/jpg' => 'jpg',
        'image/png'  => 'png',
        'image/x-png' => 'png',
        'image/webp' => 'webp'
    );

    if (isset($mime_map[$mime])) {
        $ext = $mime_map[$mime];
    } else {
        // Fallback to file extension
        $orig_ext = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
        if (in_array($orig_ext, array('jpg', 'jpeg', 'jfif'), true)) {
            $ext = 'jpg';
        } elseif ($orig_ext === 'png') {
            $ext = 'png';
        } elseif ($orig_ext === 'webp') {
            $ext = 'webp';
        }
    }

    if (!$ext) {
        return array('ok' => false, 'error' => 'Please upload a JPG, PNG or WebP image.');
    }

    $base = make_slug(pathinfo($f['name'], PATHINFO_FILENAME));
    if ($base === '') {
        $base = 'img-' . time();
    }

    $filename = $base . '.' . $ext;
    $dir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR;

    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }

    if (file_exists($dir . $filename) && $filename !== $current_image) {
        $filename = $base . '-' . time() . '.' . $ext;
    }

    $dest = $dir . $filename;
    $saved = false;
    if (is_uploaded_file($tmp)) {
        $saved = move_uploaded_file($tmp, $dest);
    }
    if (!$saved) {
        $saved = @copy($tmp, $dest);
        if ($saved) @unlink($tmp);
    }

    if (!$saved) {
        return array('ok' => false, 'error' => 'Could not save the uploaded image. Check assets/img permissions.');
    }

    return array('ok' => true, 'has_file' => true, 'filename' => $filename);
}
