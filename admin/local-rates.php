<?php
$pg = 'local';
$pg_title = 'Local rental rates';
require_once __DIR__ . '/inc/admin-header.php';

/* ---- Delete one row ---- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && post('action') === 'delete') {
    if (!csrf_ok()) {
        flash_set('error', 'Session expired. Please try again.');
    } else {
        $did = (int)post('id');
        $st = $conn->prepare("DELETE FROM local_rates WHERE id = ?");
        $st->bind_param('i', $did);
        $st->execute() ? flash_set('ok', 'Row deleted.') : flash_set('error', 'Could not delete: ' . $conn->error);
        $st->close();
    }
    header('Location: local-rates.php');
    exit;
}

/* ---- Add a new row ---- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && post('action') === 'add') {
    if (!csrf_ok()) {
        flash_set('error', 'Session expired. Please try again.');
    } else {
        $label      = post('n_label');
        $sedan      = (float)post('n_sedan');
        $suv        = (float)post('n_suv');
        $tempo      = (float)post('n_tempo');
        $extra_km   = post('n_extra_km');
        $extra_hour = post('n_extra_hour');
        $sort_order = (int)post('n_sort');
        $is_active  = 1;

        if ($label === '') {
            flash_set('error', 'Enter a name for the package.');
        } else {
            /* 8 placeholders, 8 type letters */
            $st = $conn->prepare("INSERT INTO local_rates
                (label, sedan_fare, suv_fare, tempo_fare, extra_km, extra_hour, sort_order, is_active)
                VALUES (?,?,?,?,?,?,?,?)");
            if (!$st) {
                flash_set('error', 'SQL error: ' . $conn->error);
            } else {
                $st->bind_param('sdddssii',
                    $label, $sedan, $suv, $tempo, $extra_km, $extra_hour, $sort_order, $is_active);
                $st->execute() ? flash_set('ok', 'Package added.') : flash_set('error', 'Could not save: ' . $st->error);
                $st->close();
            }
        }
    }
    header('Location: local-rates.php');
    exit;
}

/* ---- Save all rows at once ---- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && post('action') === 'saveall') {
    if (!csrf_ok()) {
        flash_set('error', 'Session expired. Please try again.');
    } elseif (!isset($_POST['r']) || !is_array($_POST['r'])) {
        flash_set('error', 'Nothing to save.');
    } else {
        /* 9 placeholders, 9 type letters */
        $st = $conn->prepare("UPDATE local_rates SET
                label=?, sedan_fare=?, suv_fare=?, tempo_fare=?,
                extra_km=?, extra_hour=?, sort_order=?, is_active=?
              WHERE id=?");
        if (!$st) {
            flash_set('error', 'SQL error: ' . $conn->error);
        } else {
            $saved = 0; $failed = '';
            foreach ($_POST['r'] as $rid => $f) {
                $rid        = (int)$rid;
                $label      = trim($f['label']);
                $sedan      = (float)$f['sedan'];
                $suv        = (float)$f['suv'];
                $tempo      = (float)$f['tempo'];
                $extra_km   = trim($f['extra_km']);
                $extra_hour = trim($f['extra_hour']);
                $sort_order = (int)$f['sort'];
                $is_active  = isset($f['active']) ? 1 : 0;

                if ($label === '') continue;

                $st->bind_param('sdddssiii',
                    $label, $sedan, $suv, $tempo,
                    $extra_km, $extra_hour, $sort_order, $is_active, $rid);

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
    header('Location: local-rates.php');
    exit;
}

$rows = fetch_all("SELECT * FROM local_rates ORDER BY sort_order ASC, id ASC");
?>

<style>
.rate-tbl input[type=text],
.rate-tbl input[type=number]{width:100%;padding:8px 9px;border:1px solid var(--border);border-radius:var(--radius);font-size:14px;font-family:'Inter',sans-serif}
.rate-tbl input:focus{border-color:var(--primary);outline:none}
.w-name{min-width:190px}
.w-fare{width:110px}
.w-txt{width:130px}
.w-sort{width:74px}
.rate-tbl td{padding:9px 10px}
</style>

<div class="card">
  <div class="card-head">
    <div>
      <h2>Local rental packages</h2>
      <p class="card-note">This is the first table on the Car rental page &mdash; the 4, 8 and 12 hour packages within Bhuj. Edit any box and press Save at the bottom.</p>
    </div>
  </div>

  <?php if (!count($rows)): ?>
    <div class="empty">No packages yet. Add one using the form below.</div>
  <?php else: ?>
  <form method="post">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="action" value="saveall">

    <div class="tbl-wrap rate-tbl">
      <table>
        <thead>
          <tr>
            <th>Package name</th><th>Sedan &#8377;</th><th>SUV &#8377;</th><th>Tempo &#8377;</th>
            <th>Extra km</th><th>Extra hour</th><th>Sort</th><th>Active</th><th></th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($rows as $r): $i = (int)$r['id']; ?>
          <tr>
            <td><input type="text" class="w-name" name="r[<?php echo $i; ?>][label]" value="<?php echo e($r['label']); ?>"></td>
            <td><input type="number" class="w-fare" step="1" min="0" name="r[<?php echo $i; ?>][sedan]" value="<?php echo e($r['sedan_fare']); ?>"></td>
            <td><input type="number" class="w-fare" step="1" min="0" name="r[<?php echo $i; ?>][suv]" value="<?php echo e($r['suv_fare']); ?>"></td>
            <td><input type="number" class="w-fare" step="1" min="0" name="r[<?php echo $i; ?>][tempo]" value="<?php echo e($r['tempo_fare']); ?>"></td>
            <td><input type="text" class="w-txt" name="r[<?php echo $i; ?>][extra_km]" value="<?php echo e($r['extra_km']); ?>"></td>
            <td><input type="text" class="w-txt" name="r[<?php echo $i; ?>][extra_hour]" value="<?php echo e($r['extra_hour']); ?>"></td>
            <td><input type="number" class="w-sort" min="0" name="r[<?php echo $i; ?>][sort]" value="<?php echo (int)$r['sort_order']; ?>"></td>
            <td style="text-align:center">
              <input type="checkbox" name="r[<?php echo $i; ?>][active]" value="1" <?php echo $r['is_active'] ? 'checked' : ''; ?>>
            </td>
            <td></td>
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
  <div class="card-head"><h2>Delete a package</h2></div>
  <div class="tbl-wrap">
    <table>
      <thead><tr><th>Package</th><th>Sedan</th><th>SUV</th><th>Tempo</th><th></th></tr></thead>
      <tbody>
      <?php foreach ($rows as $r): ?>
        <tr>
          <td><b><?php echo e($r['label']); ?></b></td>
          <td class="t-num">&#8377;<?php echo money($r['sedan_fare']); ?></td>
          <td class="t-num">&#8377;<?php echo money($r['suv_fare']); ?></td>
          <td class="t-num">&#8377;<?php echo money($r['tempo_fare']); ?></td>
          <td>
            <form method="post" style="display:inline">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="action" value="delete">
              <input type="hidden" name="id" value="<?php echo (int)$r['id']; ?>">
              <button type="submit" class="btn btn-danger btn-sm"
                      data-confirm="Delete &quot;<?php echo e($r['label']); ?>&quot;? This cannot be undone.">Delete</button>
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
  <div class="card-head"><h2>Add a new package</h2></div>
  <form method="post">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="action" value="add">

    <div class="f-grid">
      <div class="fld f-full">
        <label for="n_label">Package name</label>
        <input type="text" name="n_label" id="n_label" placeholder="e.g. 6 hours / 60 km" required>
      </div>
      <div class="fld">
        <label for="n_sedan">Sedan fare (&#8377;)</label>
        <input type="number" name="n_sedan" id="n_sedan" min="0" step="1">
      </div>
      <div class="fld">
        <label for="n_suv">SUV fare (&#8377;)</label>
        <input type="number" name="n_suv" id="n_suv" min="0" step="1">
      </div>
      <div class="fld">
        <label for="n_tempo">Tempo fare (&#8377;)</label>
        <input type="number" name="n_tempo" id="n_tempo" min="0" step="1">
      </div>
      <div class="fld">
        <label for="n_extra_km">Extra km charge</label>
        <input type="text" name="n_extra_km" id="n_extra_km" placeholder="12 / 16 / 28">
        <div class="hint">Sedan / SUV / Tempo, as shown on the site.</div>
      </div>
      <div class="fld">
        <label for="n_extra_hour">Extra hour charge</label>
        <input type="text" name="n_extra_hour" id="n_extra_hour" placeholder="150">
      </div>
      <div class="fld">
        <label for="n_sort">Sort order</label>
        <input type="number" name="n_sort" id="n_sort" min="0" value="<?php echo count($rows) + 1; ?>">
      </div>
    </div>

    <div class="f-foot">
      <button type="submit" class="btn btn-primary">Add package</button>
    </div>
  </form>
</div>

<?php require_once __DIR__ . '/inc/admin-footer.php'; ?>
