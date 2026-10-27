<?php
require_once __DIR__ . '/auth.php';

$pg = 'vehicles';
$pg_title = 'Vehicles';
require_once __DIR__ . '/inc/admin-header.php';

$rows = fetch_all("SELECT * FROM vehicles ORDER BY category ASC, sort_order ASC, id ASC");
?>

<div class="card">
  <div class="card-head">
    <div>
      <h2>Vehicles</h2>
      <p class="card-note">Manage Cars, Buses and Premium vehicles.</p>
    </div>
    <a href="vehicle-edit.php" class="btn btn-accent">+ Add vehicle</a>
  </div>

  <?php if (!count($rows)): ?>
    <div class="empty">
      <h3>No vehicles added yet</h3>
      <p>Add your first vehicle from scratch.</p>
      <a href="vehicle-edit.php" class="btn btn-accent">Add first vehicle</a>
    </div>
  <?php else: ?>
    <div class="tbl-wrap">
      <table>
        <thead>
          <tr>
            <th>Image</th>
            <th>Vehicle</th>
            <th>Type</th>
            <th>Model / Category</th>
            <th>Seats</th>
            <th>Per KM</th>
            <th>12h / 300km AC</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($rows as $r): ?>
          <tr>
            <td>
              <?php if (!empty($r['image'])): ?>
                <img src="../assets/img/<?php echo e($r['image']); ?>"
                     alt="<?php echo e($r['name']); ?>"
                     style="width:90px;height:58px;object-fit:cover;border-radius:7px"
                     onerror="this.style.display='none'">
              <?php else: ?>&mdash;<?php endif; ?>
            </td>
            <td><strong><?php echo e($r['name']); ?></strong></td>
            <td><?php echo e($r['category']); ?></td>
            <td><?php echo e($r['models']); ?></td>
            <td><?php echo e($r['seats']); ?></td>
            <td><?php echo $r['per_km'] !== null ? '&#8377;' . money($r['per_km']) : '&mdash;'; ?></td>
            <td><strong><?php echo !empty($r['local_12h_300km_ac']) ? '&#8377;' . e($r['local_12h_300km_ac']) : '&mdash;'; ?></strong></td>
            <td>
              <?php if ((int)$r['is_active']): ?>
                <span class="pill yes">Active</span>
              <?php else: ?>
                <span class="pill no">Inactive</span>
              <?php endif; ?>
            </td>
            <td>
              <a class="btn btn-out btn-sm" href="vehicle-edit.php?id=<?php echo (int)$r['id']; ?>">Edit</a>
              <form method="post" action="vehicle-delete.php?id=<?php echo (int)$r['id']; ?>" style="display:inline" onsubmit="return confirm('Delete this vehicle permanently?');">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-out btn-sm">Delete</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

<?php require_once __DIR__ . '/inc/admin-footer.php'; ?>
