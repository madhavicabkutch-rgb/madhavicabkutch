<?php
$pg = 'home';
$pg_title = 'Dashboard';
require_once __DIR__ . '/inc/admin-header.php';

function count_rows($table) {
    $r = fetch_one("SELECT COUNT(*) AS c FROM `$table` WHERE is_active = 1");
    return $r ? (int)$r['c'] : 0;
}

$n_routes  = count_rows('routes');
$n_places  = count_rows('places');
$n_vehicles = count_rows('vehicles');

$home_routes = fetch_one("SELECT COUNT(*) AS c FROM routes WHERE is_active=1 AND show_on_home=1");
$home_routes = $home_routes ? (int)$home_routes['c'] : 0;
?>

<?php if (!DB_OK): ?>
  <div class="alert" style="background:#e8f0fe;border-left:4px solid #1a73e8;color:#174ea6;padding:12px 16px;border-radius:6px;margin-bottom:20px;">
    <strong>Local Data Active:</strong> Using saved dataset (<?php echo $n_routes; ?> routes, <?php echo $n_places; ?> places, <?php echo $n_vehicles; ?> vehicles).
  </div>
<?php endif; ?>

<div class="stat-grid" style="grid-template-columns:repeat(3,1fr)">
  <div class="stat">
    <div class="stat-n"><?php echo $n_routes; ?></div>
    <div class="stat-l">One-way routes</div>
    <a href="routes.php">Manage &rarr;</a>
  </div>

  <div class="stat">
    <div class="stat-n"><?php echo $n_places; ?></div>
    <div class="stat-l">Places to visit</div>
    <a href="places.php">Manage &rarr;</a>
  </div>

  <div class="stat">
    <div class="stat-n"><?php echo $n_vehicles; ?></div>
    <div class="stat-l">Vehicles</div>
    <a href="vehicles.php">Manage &rarr;</a>
  </div>
</div>

<div class="card">
  <div class="card-head">
    <div>
      <h2>What you can change here</h2>
      <p class="card-note">Changes appear on the website immediately after saving.</p>
    </div>
  </div>

  <div class="tbl-wrap">
    <table>
      <thead>
        <tr><th>Section</th><th>Where it appears on the site</th><th>Rows</th><th></th></tr>
      </thead>
      <tbody>
        <tr>
          <td><b>One-way routes</b></td>
          <td>Fare table on the One Way Taxi page and the short route table on the homepage</td>
          <td class="t-num"><?php echo $n_routes; ?> active, <?php echo $home_routes; ?> on homepage</td>
          <td><a href="routes.php" class="btn btn-out btn-sm">Open</a></td>
        </tr>

        <tr>
          <td><b>Places to visit</b></td>
          <td>Places to Visit page and place cards on the homepage</td>
          <td class="t-num"><?php echo $n_places; ?> active</td>
          <td><a href="places.php" class="btn btn-out btn-sm">Open</a></td>
        </tr>

        <tr>
          <td><b>Vehicles</b></td>
          <td>Car Rental page — vehicle details, images and rental rates</td>
          <td class="t-num"><?php echo $n_vehicles; ?> active</td>
          <td><a href="vehicles.php" class="btn btn-out btn-sm">Open</a></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="card">
  <div class="card-head"><h2>A few things worth knowing</h2></div>
  <ul style="font-size:14.5px;color:#5B6B7C;line-height:1.9;padding-left:18px">
    <li><b>Sort order</b> decides the position in the table. Lower numbers appear first.</li>
    <li><b>Active</b> is the on/off switch. Turning it off hides an item from the website without deleting it.</li>
    <li><b>Show on homepage</b> controls which one-way routes appear on the front page.</li>
    <li><b>Vehicles</b> is now the single place to manage vehicle images, vehicle details and rental rates.</li>
    <li>After saving, open the website and press <b>Ctrl + Shift + R</b> to refresh the latest version.</li>
  </ul>
</div>

<div class="alert al-info">
  Page text, tour packages, FAQs, reviews and other content not listed above can be updated separately when required.
</div>

<?php require_once __DIR__ . '/inc/admin-footer.php'; ?>
