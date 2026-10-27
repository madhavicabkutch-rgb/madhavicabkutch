<?php
/* ============================================================
   Admin layout — top half (sidebar + topbar)
   Pages use it like this:
     <?php $pg='routes'; $pg_title='One-way routes';
     require_once __DIR__.'/inc/admin-header.php'; ?>
   ============================================================ */

require_once __DIR__ . '/../auth.php';

$pg       = isset($pg) ? $pg : '';
$pg_title = isset($pg_title) ? $pg_title : 'Dashboard';

function navon($key) {
    global $pg;
    return $pg === $key ? ' class="on"' : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo e($pg_title); ?> | Madhavi Cab Admin</title>
<meta name="robots" content="noindex, nofollow">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/admin.css">
</head>
<body>

<div class="shell">

  <aside class="side" id="side">
    <div class="side-head">
      <span class="logo-mark">M</span>
      <div>
        <div class="side-name">Madhavi Cab</div>
        <div class="side-sub">ADMIN PANEL</div>
      </div>
    </div>

    <nav class="side-nav">
      <a href="index.php"<?php echo navon('home'); ?>>Dashboard</a>

      <div class="side-lbl">RATE MANAGEMENT</div>
      <a href="routes.php"<?php echo navon('routes'); ?>>One-way routes</a>

      <div class="side-lbl">CONTENT</div>
      <a href="places.php"<?php echo navon('places'); ?>>Places to visit</a>

      <div class="side-lbl">ACCOUNT</div>
      <a href="change-password.php"<?php echo navon('pwd'); ?>>Change password</a>
    </nav>

    <div class="side-foot">
      <a href="../index.php" target="_blank">View website &rarr;</a>
    </div>
  </aside>

  <div class="main">
    <div class="topbar">
      <div style="display:flex;align-items:center;gap:12px">
        <button class="burger" id="burger" aria-label="Menu">&#9776;</button>
        <h1><?php echo e($pg_title); ?></h1>
      </div>
      <div class="top-right">
        <span><?php echo e(admin_name()); ?></span>
        <a href="logout.php" class="btn btn-out btn-sm">Log out</a>
      </div>
    </div>

    <div class="content">
      <?php echo flash_show(); ?>
