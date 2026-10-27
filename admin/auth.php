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
