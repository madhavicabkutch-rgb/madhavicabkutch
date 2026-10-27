<?php
$pg = 'outstation';
$pg_title = 'Outstation rates';
require_once __DIR__ . '/inc/admin-header.php';

/* ---- Delete one row ---- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && post('action') === 'delete') {
    if (!csrf_ok()) {
        flash_set('error', 'Session expired. Please try again.');
    } else {
        $did = (int)post('id');
        $st = $conn->prepare("DELETE FROM outstation_rates WHERE id = ?");
        $st->bind_param('i', $did);
        $st->execute() ? flash_set('ok', 'Row deleted.') : flash_set('error', 'Could not delete: ' . $conn->error);
        $st->close();
    }
    header('Location: outstation-rates.php');
    exit;
}

/* ---- Add a new row ---- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && post('action') === 'add') {
    if (!csrf_ok()) {
        flash_set('error', 'Session expired. Please try again.');
    } else {
        $vehicle    = post('n_vehicle');
        $per_km     = (float)post('n_per_km');
        $daily_min  = (int)post('n_daily_min');
        $night      = (float)post('n_night');
        $seats      = post('n_seats');
        $sort_order = (int)post('n_sort');
        $is_active  = 1;

        if ($vehicle === '') {
            flash_set('error', 'Enter a vehicle name.');
        } else {
            /* 7 placeholders, 7 type letters */
            $st = $conn->prepare("INSERT INTO outstation_rates
                (vehicle, per_km, daily_min_km, night_allowance, seats, sort_order, is_active)
                VALUES (?,?,?,?,?,?,?)");
            if (!$st) {
                flash_set('error', 'SQL error: ' . $conn->error);
            } else {
                $st->bind_param('sdidsii',
                    $vehicle, $per_km, $daily_min, $night, $seats, $sort_order, $is_active);
                $st->execute() ? flash_set('ok', 'Vehicle rate added.') : flash_set('error', 'Could not save: ' . $st->error);
                $st->close();
            }
        }
    }
    header('Location: outstation-rates.php');
    exit;
}

/* ---- Save all rows at once ---- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && post('action') === 'saveall') {
    if (!csrf_ok()) {
        flash_set('error', 'Session expired. Please try again.');
    } elseif (!isset($_POST['r']) || !is_array($_POST['r'])) {
        flash_set('error', 'Nothing to save.');
    } else {
        /* 8 placeholders, 8 type letters */
        $st = $conn->prepare("UPDATE outstation_rates SET
                vehicle=?, per_km=?, daily_min_km=?, night_allowance=?,
                seats=?, sort_order=?, is_active=?
              WHERE id=?");
        if (!$st) {
            flash_set('error', 'SQL error: ' . $conn->error);
        } else {
            $saved = 0; $failed = '';
            foreach ($_POST['r'] as $rid => $f) {
                $rid        = (int)$rid;
                $vehicle    = trim($f['vehicle']);
                $per_km     = (float)$f['per_km'];
                $daily_min  = (int)$f['daily_min'];
                $night      = (float)$f['night'];
                $seats      = trim($f['seats']);
                $sort_order = (int)$f['sort'];
                $is_active  = isset($f['active']) ? 1 : 0;

                if ($vehicle === '') continue;

                $st->bind_param('sdidsiii',
                    $vehicle, $per_km, $daily_min, $night,
                    $seats, $sort_order, $is_active, $rid);

                if ($st->execute()) { $saved++; } else { $failed = $st->error; }
            }
            $st->close();

            if ($failed !== '') {
                flash_set('error', 'Some rows did not save: ' . $failed);
            } else {
                flash_set('ok', $saved . ' row' . ($saved == 1 ? '' : 's') . ' saved.');
            }
        }
    }
    header('Location: outstation-rates.php');
    exit;
}

$rows = fetch_all("SELECT * FROM outstation_rates ORDER BY sort_order ASC, id ASC");
?>

<style>
.rate-tbl input[type=text],
.rate-tbl input[type=number]{width:100%;padding:8px 9px;border:1px solid var(--border);border-radius:var(--radius);font-size:14px;font-family:'Inter',sans-serif}
.rate-tbl input:focus{border-color:var(--primary);outline:none}
.w-name{min-width:200px}
.w-num{width:104px}
.w-seat{width:88px}
.w-sort{width:74px}
.rate-tbl td{padding:9px 10px}
</style>

<div class="card">
  <div class="card-head">
    <div>
      <h2>Outstation and multi-day rates</h2>
      <p class="card-note">This is the per-kilometre table on the Car rental page. Edit any box and press Save at the bottom.</p>
    </div>
  </div>

  <?php if (!count($rows)): ?>
    <div class="empty">No vehicle rates yet. Add one using the form below.</div>
  <?php else: ?>
  <form method="post">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="action" value="saveall">

    <div class="tbl-wrap rate-tbl">
      <table>
        <thead>
          <tr>
            <th>Vehicle</th><th>Per km &#8377;</th><th>Daily min km</th>
            <th>Night allowance &#8377;</th><th>Seats</th><th>Sort</th><th>Active</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($rows as $r): $i = (int)$r['id']; ?>
          <tr>
            <td><input type="text" class="w-name" name="r[<?php echo $i; ?>][vehicle]" value="<?php echo e($r['vehicle']); ?>"></td>
            <td><input type="number" class="w-num" step="0.5" min="0" name="r[<?php echo $i; ?>][per_km]" value="<?php echo e($r['per_km']); ?>"></td>
            <td><input type="number" class="w-num" step="10" min="0" name="r[<?php echo $i; ?>][daily_min]" value="<?php echo (int)$r['daily_min_km']; ?>"></td>
            <td><input type="number" class="w-num" step="50" min="0" name="r[<?php echo $i; ?>][night]" value="<?php echo e($r['night_allowance']); ?>"></td>
            <td><input type="text" class="w-seat" name="r[<?php echo $i; ?>][seats]" value="<?php echo e($r['seats']); ?>"></td>
            <td><input type="number" class="w-sort" min="0" name="r[<?php echo $i; ?>][sort]" value="<?php echo (int)$r['sort_order']; ?>"></td>
            <td style="text-align:center">
              <input type="checkbox" name="r[<?php echo $i; ?>][active]" value="1" <?php echo $r['is_active'] ? 'checked' : ''; ?>>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="f-foot">
      <button type="submit" class="btn btn-accent">Save all changes</button>
      <span class="card-note">Saves every row in the table at once.</span>
    </div>
  </form>
  <?php endif; ?>
</div>

<?php if (count($rows)): ?>
<div class="card">
  <div class="card-head"><h2>Delete a vehicle rate</h2></div>
  <div class="tbl-wrap">
    <table>
      <thead><tr><th>Vehicle</th><th>Per km</th><th>Seats</th><th></th></tr></thead>
      <tbody>
      <?php foreach ($rows as $r): ?>
        <tr>
          <td><b><?php echo e($r['vehicle']); ?></b></td>
          <td class="t-num">&#8377;<?php echo money($r['per_km']); ?></td>
          <td class="t-num"><?php echo e($r['seats']); ?></td>
          <td>
            <form method="post" style="display:inline">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="action" value="delete">
              <input type="hidden" name="id" value="<?php echo (int)$r['id']; ?>">
              <button type="submit" class="btn btn-danger btn-sm"
                      data-confirm="Delete &quot;<?php echo e($r['vehicle']); ?>&quot;? This cannot be undone.">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <p class="card-note" style="margin-top:12px">Tip: instead of deleting, uncheck <b>Active</b> above. The row is hidden from the website but stays here if you need it again.</p>
</div>
<?php endif; ?>

<div class="card">
  <div class="card-head"><h2>Add a new vehicle rate</h2></div>
  <form method="post">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="action" value="add">

    <div class="f-grid">
      <div class="fld f-full">
        <label for="n_vehicle">Vehicle name</label>
        <input type="text" name="n_vehicle" id="n_vehicle" placeholder="e.g. SUV — Scorpio" required>
      </div>
      <div class="fld">
        <label for="n_per_km">Per km rate (&#8377;)</label>
        <input type="number" name="n_per_km" id="n_per_km" min="0" step="0.5">
      </div>
      <div class="fld">
        <label for="n_daily_min">Daily minimum km</label>
        <input type="number" name="n_daily_min" id="n_daily_min" min="0" step="10" value="250">
      </div>
      <div class="fld">
        <label for="n_night">Night allowance (&#8377;)</label>
        <input type="number" name="n_night" id="n_night" min="0" step="50">
      </div>
      <div class="fld">
        <label for="n_seats">Seats</label>
        <input type="text" name="n_seats" id="n_seats" placeholder="7">
      </div>
      <div class="fld">
        <label for="n_sort">Sort order</label>
        <input type="number" name="n_sort" id="n_sort" min="0" value="<?php echo count($rows) + 1; ?>">
      </div>
    </div>

    <div class="f-foot">
      <button type="submit" class="btn btn-primary">Add vehicle rate</button>
    </div>
  </form>
</div>

<?php require_once __DIR__ . '/inc/admin-footer.php'; ?>
