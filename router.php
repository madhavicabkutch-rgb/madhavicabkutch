<?php
// router.php - Router for PHP's built-in web server (php -S localhost:8000 router.php)
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Normalize trailing slashes (e.g. /vehicle-rental/ -> /vehicle-rental)
if ($uri !== '/' && substr($uri, -1) === '/') {
    $uri = rtrim($uri, '/');
}

// Serve static assets, admin, blog, or existing files directly
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false; // let the built-in server serve the static file
}

// Redirect *.php to clean URL in browser (except admin/blog)
if (preg_match('#^/(?!admin|blog)(.+)\.php$#', $uri, $matches)) {
    $queryString = $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : '';
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
