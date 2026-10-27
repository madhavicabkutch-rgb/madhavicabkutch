<?php
$pg = 'places';
$pg_title = 'Places to visit';
require_once __DIR__ . '/inc/admin-header.php';

/* ---- Delete ---- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && post('action') === 'delete') {
    if (!csrf_ok()) {
        flash_set('error', 'Session expired. Please try again.');
    } else {
        $id = (int)post('id');
        if (defined('DB_OK') && DB_OK && isset($conn) && $conn) {
            $st = $conn->prepare("DELETE FROM places WHERE id = ?");
            if ($st) {
                $st->bind_param('i', $id);
                $st->execute();
                $st->close();
            }
        } else {
            $places = load_local_data('places');
            $places = array_values(array_filter($places, function($p) use ($id) { return $p['id'] != $id; }));
            save_local_data('places', $places);
        }
        flash_set('ok', 'Place deleted.');
    }
    header('Location: places.php');
    exit;
}

/* ---- Toggle active ---- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && post('action') === 'toggle') {
    if (csrf_ok()) {
        $id = (int)post('id');
        if (defined('DB_OK') && DB_OK && isset($conn) && $conn) {
            $conn->query("UPDATE places SET is_active = 1 - is_active WHERE id = " . $id);
        } else {
            $places = load_local_data('places');
            foreach ($places as &$p) {
                if ($p['id'] == $id) {
                    $p['is_active'] = empty($p['is_active']) ? 1 : 0;
                }
            }
            save_local_data('places', $places);
        }
    }
    header('Location: places.php');
    exit;
}

$places = fetch_all("SELECT * FROM places ORDER BY sort_order ASC, id ASC");
?>

<div class="card">
  <div class="card-head">
    <div>
      <h2>Places to visit</h2>
      <p class="card-note">These build the Places to Visit page and the four cards on the homepage. The first four by sort order appear on the homepage.</p>
    </div>
    <a href="place-edit.php" class="btn btn-accent">Add place</a>
  </div>

  <?php if (!count($places)): ?>
    <div class="empty">No places yet. Click <b>Add place</b> to create the first one.</div>
  <?php else: ?>
  <div class="tbl-wrap">
    <table>
      <thead>
        <tr><th>#</th><th>Place</th><th>Category</th><th>Distance</th><th>Photo file</th><th>Status</th><th>Actions</th></tr>
      </thead>
      <tbody>
      <?php foreach ($places as $p): ?>
        <tr>
          <td class="t-num"><?php echo (int)$p['sort_order']; ?></td>
          <td>
            <b><?php echo e($p['title']); ?></b><br>
            <span class="t-num" style="font-size:12.5px">/<?php echo e($p['slug']); ?></span>
          </td>
          <td class="t-num"><?php echo $p['category'] ? e($p['category']) : '&mdash;'; ?></td>
          <td class="t-num"><?php echo $p['distance_bhuj'] ? e($p['distance_bhuj']) : '&mdash;'; ?></td>
          <td class="t-num"><?php echo $p['image'] ? e($p['image']) : '&mdash;'; ?></td>
          <td>
            <form method="post" style="display:inline">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="action" value="toggle">
              <input type="hidden" name="id" value="<?php echo (int)$p['id']; ?>">
              <button type="submit" class="pill <?php echo $p['is_active'] ? 'pill-on' : 'pill-off'; ?>" style="border:none;cursor:pointer">
                <?php echo $p['is_active'] ? 'Active' : 'Hidden'; ?>
              </button>
            </form>
          </td>
          <td>
            <div class="t-act">
              <a href="../place-detail.php?slug=<?php echo e($p['slug']); ?>" class="btn btn-out btn-sm" target="_blank">View</a>
              <a href="place-edit.php?id=<?php echo (int)$p['id']; ?>" class="btn btn-out btn-sm">Edit</a>
              <form method="post" style="display:inline">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="<?php echo (int)$p['id']; ?>">
                <button type="submit" class="btn btn-danger btn-sm"
                        data-confirm="Delete &quot;<?php echo e($p['title']); ?>&quot;? This cannot be undone.">Delete</button>
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
  Photos are not uploaded here. Save the image into <b>assets/img/</b> on the server, then type the exact file name (for example <b>white-rann.jpg</b>) into the place's Photo file box. If the file is missing, a placeholder is shown and nothing breaks.
</div>

<?php require_once __DIR__ . '/inc/admin-footer.php'; ?>
