<?php
$pg = 'pwd';
$pg_title = 'Change password';
require_once __DIR__ . '/inc/admin-header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_ok()) {
        flash_set('error', 'Session expired. Please try again.');
    } elseif (!DB_OK) {
        flash_set('error', 'Cannot reach the database.');
    } else {
        $current = post('current');
        $new     = post('new');
        $confirm = post('confirm');

        $st = $conn->prepare("SELECT password_hash FROM admin_users WHERE id = ? LIMIT 1");
        $st->bind_param('i', $_SESSION['admin_id']);
        $st->execute();
        $row = $st->get_result()->fetch_assoc();
        $st->close();

        if (!$row || !password_verify($current, $row['password_hash'])) {
            flash_set('error', 'Your current password is not correct.');
        } elseif (strlen($new) < 8) {
            flash_set('error', 'The new password must be at least 8 characters long.');
        } elseif ($new !== $confirm) {
            flash_set('error', 'The two new passwords do not match.');
        } elseif ($new === $current) {
            flash_set('error', 'The new password must be different from the current one.');
        } else {
            $hash = password_hash($new, PASSWORD_DEFAULT);
            $st = $conn->prepare("UPDATE admin_users SET password_hash = ? WHERE id = ?");
            $st->bind_param('si', $hash, $_SESSION['admin_id']);
            if ($st->execute()) {
                flash_set('ok', 'Password changed. Use the new password next time you log in.');
            } else {
                flash_set('error', 'Could not save: ' . $conn->error);
            }
            $st->close();
        }
    }

    header('Location: change-password.php');
    exit;
}
?>

<div class="card" style="max-width:520px">
  <div class="card-head">
    <div>
      <h2>Change your password</h2>
      <p class="card-note">Logged in as <b><?php echo e($_SESSION['admin_user']); ?></b></p>
    </div>
  </div>

  <form method="post" autocomplete="off">
    <?php echo csrf_field(); ?>

    <div class="fld">
      <label for="current">Current password</label>
      <input type="password" name="current" id="current" required>
    </div>

    <div class="fld">
      <label for="new">New password</label>
      <input type="password" name="new" id="new" required>
      <div class="hint">At least 8 characters. Use a mix of letters, numbers and a symbol.</div>
    </div>

    <div class="fld">
      <label for="confirm">Repeat new password</label>
      <input type="password" name="confirm" id="confirm" required>
    </div>

    <div class="f-foot">
      <button type="submit" class="btn btn-accent">Save new password</button>
      <a href="index.php" class="btn btn-out">Cancel</a>
    </div>
  </form>
</div>

<div class="alert al-info" style="max-width:520px">
  If you forget the password, it can be reset directly in the database. Contact OptiNest Solution and we will do it for you.
</div>

<?php require_once __DIR__ . '/inc/admin-footer.php'; ?>
