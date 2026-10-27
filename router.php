<?php
// router.php - Router for PHP's built-in web server (php -S localhost:8080 router.php)
ob_start();

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Shortcut: redirect /login or /login.php to /admin/login.php
if ($uri === '/login' || $uri === '/login.php') {
    header("Location: /admin/login.php", true, 302);
    exit;
}

// Shortcut: redirect /admin to /admin/login.php
if ($uri === '/admin' || $uri === '/admin/') {
    header("Location: /admin/login.php", true, 302);
    exit;
}

// Normalize trailing slashes (e.g. /vehicle-rental/ -> /vehicle-rental), unless it's a directory
if ($uri !== '/' && substr($uri, -1) === '/' && !is_dir(__DIR__ . $uri)) {
    $uri = rtrim($uri, '/');
}

// Serve existing files (images, css, js, php files in subdirectories) directly
if ($uri !== '/' && is_file(__DIR__ . $uri)) {
    return false; // let the built-in server serve the static file or php script
}

// Redirect *.php to clean URL in browser (except admin/blog)
if (preg_match('#^/(?!admin|blog)(.+)\.php$#', $uri, $matches)) {
    $queryString = !empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '';
    header("Location: /" . $matches[1] . $queryString, true, 301);
    exit;
}

// Check if a .php file exists for the clean URL
$cleanPath = ltrim($uri, '/');
$phpFile = __DIR__ . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $cleanPath) . '.php';
if ($cleanPath !== '' && file_exists($phpFile)) {
    $_SERVER['SCRIPT_NAME'] = '/' . $cleanPath . '.php';
    $_SERVER['PHP_SELF'] = '/' . $cleanPath . '.php';
    chdir(__DIR__);
    require $phpFile;
    exit;
}

// If root URL, serve index.php
if ($uri === '/' || $uri === '') {
    require __DIR__ . '/index.php';
    exit;
}

// 404 handler
http_response_code(404);
echo "<!DOCTYPE html><html><head><title>404 Not Found</title></head><body><h1>404 Not Found</h1><p>The requested URL was not found on this server.</p></body></html>";
