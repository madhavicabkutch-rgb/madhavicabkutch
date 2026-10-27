<?php
require_once __DIR__ . '/auth.php';

/* Already logged in? Go straight to the dashboard. */
if (!empty($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_ok()) {
        $error = 'Session expired. Please try again.';
    } else {
        $username = post('username');
        $password = post('password');

        if ($username === '' || $password === '') {
            $error = 'Enter both username and password.';
        } else {
            $loggedIn = false;

            // 1. Try DB authentication if connected
            if (defined('DB_OK') && DB_OK && isset($conn) && $conn) {
                $st = $conn->prepare("SELECT id, username, password_hash, full_name FROM admin_users WHERE username = ? LIMIT 1");
                if ($st) {
                    $st->bind_param('s', $username);
                    $st->execute();
                    $res = $st->get_result();
                    $user = $res->fetch_assoc();
                    $st->close();

                    if ($user && password_verify($password, $user['password_hash'])) {
                        $loggedIn = true;
                        $_SESSION['admin_id']   = $user['id'];
                        $_SESSION['admin_user'] = $user['username'];
                        $_SESSION['admin_name'] = !empty($user['full_name']) ? $user['full_name'] : $user['username'];
                    }
                }
            }

            // 2. Fallback local admin authentication (works offline/without MySQL)
            if (!$loggedIn && strtolower($username) === 'admin') {
                $acceptedPasswords = array('admin123', 'admin', 'adminPassword123', 'madhavi123', 'madhavicab');
                if (in_array($password, $acceptedPasswords)) {
                    $loggedIn = true;
                    $_SESSION['admin_id']   = 1;
                    $_SESSION['admin_user'] = 'admin';
                    $_SESSION['admin_name'] = 'Admin';
                }
            }

            if ($loggedIn) {
                session_regenerate_id(true);
                header('Location: index.php');
                exit;
            } else {
                $error = 'Wrong username or password.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin login | Madhavi Cab Kutch</title>
<meta name="robots" content="noindex, nofollow">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/admin.css">
</head>
<body class="login-body">

<div class="login-box">
  <div class="login-head">
    <span class="logo-mark">M</span>
    <div>
      <div class="login-name">Madhavi Cab</div>
      <div class="login-sub">ADMIN PANEL</div>
    </div>
  </div>

  <?php if ($error): ?>
    <div class="alert al-bad"><?php echo e($error); ?></div>
  <?php endif; ?>

  <form method="post" autocomplete="off">
    <?php echo csrf_field(); ?>
    <div class="fld">
      <label for="username">Username</label>
      <input type="text" name="username" id="username" required autofocus placeholder="admin">
    </div>
    <div class="fld">
      <label for="password">Password</label>
      <input type="password" name="password" id="password" required placeholder="••••••••">
    </div>
    <button type="submit" class="btn btn-accent btn-block">Log in</button>
    <p style="font-size:12px;color:#777;text-align:center;margin-top:12px;">Login: <b>admin</b> &middot; Password: <b>admin123</b></p>
  </form>

  <p class="login-foot"><a href="../index.php">&larr; Back to website</a></p>
</div>

</body>
</html>
