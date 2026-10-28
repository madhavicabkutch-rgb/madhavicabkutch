<?php
require_once __DIR__ . '/auth.php';

$pg = 'routes';
$pg_title = 'One-way routes';

/* ---- Delete ---- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && post('action') === 'delete') {
    if (!csrf_ok()) {
        flash_set('error', 'Session expired. Please try again.');
    } else {
        $id = (int)post('id');
        if (defined('DB_OK') && DB_OK && isset($conn) && $conn) {
            $st = $conn->prepare("DELETE FROM routes WHERE id = ?");
            if ($st) {
                $st->bind_param('i', $id);
                $st->execute();
                $st->close();
            }
        }
        sync_delete_route($id);
        flash_set('ok', 'Route deleted.');
    }
    header('Location: routes.php');
    exit;
}

/* ---- Quick toggle: active / homepage ---- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && post('action') === 'toggle') {
    if (csrf_ok()) {
        $id  = (int)post('id');
        $col = (post('col') === 'home') ? 'show_on_home' : 'is_active';
        if (defined('DB_OK') && DB_OK && isset($conn) && $conn) {
            $conn->query("UPDATE routes SET `$col` = 1 - `$col` WHERE id = " . $id);
        }
        sync_toggle_route($id, $col);
    }
    header('Location: routes.php');
    exit;
}

require_once __DIR__ . '/inc/admin-header.php';

$routes = fetch_all("SELECT * FROM routes ORDER BY sort_order ASC, id ASC");
?>

<div class="card">
  <div class="card-head">
    <div>
      <h2>One-way routes</h2>
      <p class="card-note">These build the fare table on the One-way taxi page. Routes marked for the homepage also show in the short table there.</p>
    </div>
    <a href="route-edit.php" class="btn btn-accent">Add route</a>
  </div>

  <?php if (!count($routes)): ?>
    <div class="empty">No routes yet. Click <b>Add route</b> to create the first one.</div>
  <?php else: ?>
  <div class="tbl-wrap">
    <table>
      <thead>
        <tr>
          <th>#</th><th>Route</th><th>Km</th><th>Time</th>
          <th>Sedan</th><th>SUV</th><th>Tempo</th>
          <th>Homepage</th><th>Status</th><th>Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($routes as $r): ?>
        <tr>
          <td class="t-num"><?php echo (int)$r['sort_order']; ?></td>
          <td><b><?php echo e($r['from_city']); ?> &rarr; <?php echo e($r['to_city']); ?></b></td>
          <td class="t-num"><?php echo $r['distance_km'] ? (int)$r['distance_km'] : '&mdash;'; ?></td>
          <td class="t-num"><?php echo $r['duration'] ? e($r['duration']) : '&mdash;'; ?></td>
          <td class="t-num">&#8377;<?php echo money($r['sedan_fare']); ?></td>
          <td class="t-num">&#8377;<?php echo money($r['suv_fare']); ?></td>
          <td class="t-num">&#8377;<?php echo money($r['tempo_fare']); ?></td>
          <td>
            <form method="post" style="display:inline">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="action" value="toggle">
              <input type="hidden" name="col" value="home">
              <input type="hidden" name="id" value="<?php echo (int)$r['id']; ?>">
              <button type="submit" class="pill <?php echo $r['show_on_home'] ? 'pill-on' : 'pill-off'; ?>" style="border:none;cursor:pointer">
                <?php echo $r['show_on_home'] ? 'Yes' : 'No'; ?>
              </button>
            </form>
          </td>
          <td>
            <form method="post" style="display:inline">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="action" value="toggle">
              <input type="hidden" name="col" value="active">
              <input type="hidden" name="id" value="<?php echo (int)$r['id']; ?>">
              <button type="submit" class="pill <?php echo $r['is_active'] ? 'pill-on' : 'pill-off'; ?>" style="border:none;cursor:pointer">
                <?php echo $r['is_active'] ? 'Active' : 'Hidden'; ?>
              </button>
            </form>
          </td>
          <td>
            <div class="t-act">
              <a href="route-edit.php?id=<?php echo (int)$r['id']; ?>" class="btn btn-out btn-sm">Edit</a>
              <form method="post" style="display:inline">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="<?php echo (int)$r['id']; ?>">
                <button type="submit" class="btn btn-danger btn-sm"
                        data-confirm="Delete the route <?php echo e($r['from_city'] . ' to ' . $r['to_city']); ?>? This cannot be undone.">Delete</button>
              </form>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <?php endif; ?>
</div>

<div class="alert al-info">
  Click the <b>Homepage</b> or <b>Status</b> pill to switch it on or off without opening the edit form. Keep about six routes on the homepage &mdash; more than that makes the front page long.
</div>

<?php require_once __DIR__ . '/inc/admin-footer.php'; ?>
