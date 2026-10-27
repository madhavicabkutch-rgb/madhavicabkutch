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
    } elseif (!DB_OK) {
        $error = 'Cannot reach the database. Check config.php.';
    } else {
        $username = post('username');
        $password = post('password');

        if ($username === '' || $password === '') {
            $error = 'Enter both username and password.';
        } else {
            $st = $conn->prepare("SELECT id, username, password_hash, full_name FROM admin_users WHERE username = ? LIMIT 1");
            $st->bind_param('s', $username);
            $st->execute();
            $res = $st->get_result();
            $user = $res->fetch_assoc();
            $st->close();

            if ($user && password_verify($password, $user['password_hash'])) {
                session_regenerate_id(true);
                $_SESSION['admin_id']   = $user['id'];
                $_SESSION['admin_user'] = $user['username'];
                $_SESSION['admin_name'] = $user['full_name'] ? $user['full_name'] : $user['username'];
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
      <input type="text" name="username" id="username" required autofocus>
    </div>
    <div class="fld">
      <label for="password">Password</label>
      <input type="password" name="password" id="password" required>
    </div>
    <button type="submit" class="btn btn-accent btn-block">Log in</button>
  </form>

  <p class="login-foot"><a href="../index.php">&larr; Back to website</a></p>
</div>

</body>
</html>
