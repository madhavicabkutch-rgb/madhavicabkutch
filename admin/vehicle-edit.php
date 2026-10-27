<?php
require_once __DIR__ . '/auth.php';

$pg = 'vehicles';
$id = get_id();
$pg_title = $id ? 'Edit vehicle' : 'Add vehicle';
require_once __DIR__ . '/inc/admin-header.php';

$row = array(
  'id'=>0,
  'name'=>'',
  'category'=>'Car',
  'models'=>'',
  'seats'=>'',
  'luggage'=>'',
  'per_km'=>'',
  'description'=>'',
  'image'=>'',
  'sort_order'=>0,
  'is_active'=>1,
  'local_8h_80km_ac'=>'',
  'local_8h_80km_nonac'=>'',
  'local_12h_300km_ac'=>'',
  'local_12h_300km_nonac'=>'',
  'extra_km_ac'=>'',
  'extra_km_nonac'=>'',
  'airport_transfer'=>'',
  'daily_min_km'=>'',
  'driver_night_allowance'=>'',
  'notes'=>''
);

if ($id) {
    $found = fetch_one("SELECT * FROM vehicles WHERE id=" . (int)$id . " LIMIT 1");
    if (!$found) {
        flash_set('error', 'Vehicle not found.');
        header('Location: vehicles.php');
        exit;
    }
    $row = array_merge($row, $found);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_ok()) {
        flash_set('error', 'Session expired. Please try again.');
        header('Location: vehicle-edit.php' . ($id ? '?id=' . $id : ''));
        exit;
    }

    $name     = post('name');
    $category = post('category');
    $models   = post('models');
    $seats    = post('seats');
    $luggage  = post('luggage');
    $description = post('description');
    $notes    = post('notes');

    if (!in_array($category, array('Car','Bus','Premium'), true)) {
        $category = 'Car';
    }

    $to_rate = function($key) {
        $v = trim(post($key));
        return $v === '' ? null : $v;
    };

    $per_km = $to_rate('per_km');
    $local_8h_80km_ac = $to_rate('local_8h_80km_ac');
    $local_8h_80km_nonac = $to_rate('local_8h_80km_nonac');
    $local_12h_300km_ac = $to_rate('local_12h_300km_ac');
    $local_12h_300km_nonac = $to_rate('local_12h_300km_nonac');
    $extra_km_ac = $to_rate('extra_km_ac');
    $extra_km_nonac = $to_rate('extra_km_nonac');
    $airport_transfer = $to_rate('airport_transfer');
    $daily_min_km = post('daily_min_km') === '' ? null : (int)post('daily_min_km');
    $driver_night_allowance = $to_rate('driver_night_allowance');

    $sort_order = (int)post('sort_order');
    $is_active = isset($_POST['is_active']) ? 1 : 0;

    $image = isset($row['image']) ? $row['image'] : '';
    $upload_failed = false;

    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] !== UPLOAD_ERR_NO_FILE) {
        $f = $_FILES['image_file'];

        if ($f['error'] !== UPLOAD_ERR_OK) {
            flash_set('error', 'Image upload failed.');
            $upload_failed = true;
        } elseif ($f['size'] > 5 * 1024 * 1024) {
            flash_set('error', 'Image must be 5 MB or smaller.');
            $upload_failed = true;
        } else {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->file($f['tmp_name']);

            $allowed = array(
                'image/jpeg' => 'jpg',
                'image/png'  => 'png',
                'image/webp' => 'webp'
            );

            if (!isset($allowed[$mime])) {
                flash_set('error', 'Please upload JPG, PNG or WebP.');
                $upload_failed = true;
            } else {
                $base = make_slug(pathinfo($f['name'], PATHINFO_FILENAME));
                $ext = $allowed[$mime];
                $filename = $base . '.' . $ext;
                $dir = __DIR__ . '/../assets/img/';

                if (!is_dir($dir)) {
                    @mkdir($dir, 0755, true);
                }

                if (file_exists($dir . $filename) && $filename !== $image) {
                    $filename = $base . '-' . time() . '.' . $ext;
                }

                if (!move_uploaded_file($f['tmp_name'], $dir . $filename)) {
                    flash_set('error', 'Could not save the uploaded image. Check assets/img permissions.');
                    $upload_failed = true;
                } else {
                    $image = $filename;
                }
            }
        }
    }

    if ($name === '') {
        flash_set('error', 'Vehicle name is required.');
    } elseif (!$upload_failed) {

        if (defined('DB_OK') && DB_OK && isset($conn) && $conn) {
            if ($id) {
                $sql = "UPDATE vehicles SET
                    name=?, category=?, models=?, seats=?, luggage=?, per_km=?,
                    description=?, image=?, sort_order=?, is_active=?,
                    local_8h_80km_ac=?, local_8h_80km_nonac=?,
                    local_12h_300km_ac=?, local_12h_300km_nonac=?,
                    extra_km_ac=?, extra_km_nonac=?, airport_transfer=?,
                    daily_min_km=?, driver_night_allowance=?, notes=?
                    WHERE id=?";

                $st = $conn->prepare($sql);

                if (!$st) {
                    flash_set('error', 'Database error: ' . $conn->error);
                } else {
                    $types = 'ssssssssiisssssssissi';
                    $st->bind_param(
                        $types,
                        $name, $category, $models, $seats, $luggage, $per_km,
                        $description, $image, $sort_order, $is_active,
                        $local_8h_80km_ac, $local_8h_80km_nonac,
                        $local_12h_300km_ac, $local_12h_300km_nonac,
                        $extra_km_ac, $extra_km_nonac, $airport_transfer,
                        $daily_min_km, $driver_night_allowance, $notes, $id
                    );

                    if ($st->execute()) {
                        flash_set('ok', 'Vehicle updated successfully.');
                        $st->close();
                        header('Location: vehicles.php');
                        exit;
                    }

                    flash_set('error', 'Could not save vehicle: ' . $st->error);
                    $st->close();
                }
            } else {
                $sql = "INSERT INTO vehicles
                    (name, category, models, seats, luggage, per_km,
                     description, image, sort_order, is_active,
                     local_8h_80km_ac, local_8h_80km_nonac,
                     local_12h_300km_ac, local_12h_300km_nonac,
                     extra_km_ac, extra_km_nonac, airport_transfer,
                     daily_min_km, driver_night_allowance, notes)
                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

                $st = $conn->prepare($sql);

                if (!$st) {
                    flash_set('error', 'Database error: ' . $conn->error);
                } else {
                    $types = 'ssssssssiisssssssiss';
                    $st->bind_param(
                        $types,
                        $name, $category, $models, $seats, $luggage, $per_km,
                        $description, $image, $sort_order, $is_active,
                        $local_8h_80km_ac, $local_8h_80km_nonac,
                        $local_12h_300km_ac, $local_12h_300km_nonac,
                        $extra_km_ac, $extra_km_nonac, $airport_transfer,
                        $daily_min_km, $driver_night_allowance, $notes
                    );

                    if ($st->execute()) {
                        flash_set('ok', 'Vehicle added successfully.');
                        $st->close();
                        header('Location: vehicles.php');
                        exit;
                    }

                    flash_set('error', 'Could not add vehicle: ' . $st->error);
                    $st->close();
                }
            }
        } else {
            // Local JSON storage save
            $vehicles = load_local_data('vehicles');
            if ($id) {
                foreach ($vehicles as &$v) {
                    if ($v['id'] == $id) {
                        $v['name'] = $name;
                        $v['category'] = $category;
                        $v['models'] = $models;
                        $v['seats'] = $seats;
                        $v['luggage'] = $luggage;
                        $v['per_km'] = $per_km;
                        $v['description'] = $description;
                        $v['image'] = $image;
                        $v['sort_order'] = $sort_order;
                        $v['is_active'] = $is_active;
                        $v['local_8h_80km_ac'] = $local_8h_80km_ac;
                        $v['local_8h_80km_nonac'] = $local_8h_80km_nonac;
                        $v['local_12h_300km_ac'] = $local_12h_300km_ac;
                        $v['local_12h_300km_nonac'] = $local_12h_300km_nonac;
                        $v['extra_km_ac'] = $extra_km_ac;
                        $v['extra_km_nonac'] = $extra_km_nonac;
                        $v['airport_transfer'] = $airport_transfer;
                        $v['daily_min_km'] = $daily_min_km;
                        $v['driver_night_allowance'] = $driver_night_allowance;
                        $v['notes'] = $notes;
                    }
                }
                flash_set('ok', 'Vehicle updated successfully.');
            } else {
                $newId = count($vehicles) ? max(array_column($vehicles, 'id')) + 1 : 1;
                $vehicles[] = array(
                    'id' => $newId, 'name' => $name, 'category' => $category, 'models' => $models,
                    'seats' => $seats, 'luggage' => $luggage, 'per_km' => $per_km,
                    'description' => $description, 'image' => $image, 'sort_order' => $sort_order,
                    'is_active' => $is_active, 'local_8h_80km_ac' => $local_8h_80km_ac,
                    'local_8h_80km_nonac' => $local_8h_80km_nonac, 'local_12h_300km_ac' => $local_12h_300km_ac,
                    'local_12h_300km_nonac' => $local_12h_300km_nonac, 'extra_km_ac' => $extra_km_ac,
                    'extra_km_nonac' => $extra_km_nonac, 'airport_transfer' => $airport_transfer,
                    'daily_min_km' => $daily_min_km, 'driver_night_allowance' => $driver_night_allowance,
                    'notes' => $notes
                );
                flash_set('ok', 'Vehicle added successfully.');
            }
            save_local_data('vehicles', $vehicles);
            header('Location: vehicles.php');
            exit;
        }
    }

    $row = array_merge($row, array(
        'name'=>$name, 'category'=>$category, 'models'=>$models,
        'seats'=>$seats, 'luggage'=>$luggage, 'per_km'=>$per_km,
        'description'=>$description, 'image'=>$image,
        'sort_order'=>$sort_order, 'is_active'=>$is_active,
        'local_8h_80km_ac'=>$local_8h_80km_ac,
        'local_8h_80km_nonac'=>$local_8h_80km_nonac,
        'local_12h_300km_ac'=>$local_12h_300km_ac,
        'local_12h_300km_nonac'=>$local_12h_300km_nonac,
        'extra_km_ac'=>$extra_km_ac, 'extra_km_nonac'=>$extra_km_nonac,
        'airport_transfer'=>$airport_transfer,
        'daily_min_km'=>$daily_min_km,
        'driver_night_allowance'=>$driver_night_allowance,
        'notes'=>$notes
    ));
}
?>

<div class="card">
  <div class="card-head">
    <div>
      <h2><?php echo $id ? 'Edit vehicle' : 'Add New Vehicle'; ?></h2>
      <p class="card-note">Vehicle details and rental rates. Extra Hour Charge is not included.</p>
    </div>
    <a href="vehicles.php" class="btn btn-out">&larr; Back</a>
  </div>

  <form method="post" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>

    <div class="f-grid">

      <div class="fld">
        <label>Vehicle Type</label>
        <select name="category">
          <?php foreach (array('Car','Bus','Premium') as $vtype): ?>
            <option value="<?php echo $vtype; ?>" <?php echo $row['category']===$vtype?'selected':''; ?>><?php echo $vtype; ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="fld">
        <label>Vehicle Name *</label>
        <input type="text" name="name" value="<?php echo e($row['name']); ?>" placeholder="e.g. Swift Dzire" required>
      </div>

      <div class="fld">
        <label>Vehicle Category / Model</label>
        <input type="text" name="models" value="<?php echo e($row['models']); ?>" placeholder="e.g. Sedan / SUV / 12 Seater">
      </div>

      <div class="fld">
        <label>Seating</label>
        <input type="text" name="seats" value="<?php echo e($row['seats']); ?>" placeholder="e.g. 4+1">
      </div>

      <div class="fld">
        <label>Luggage / Bags</label>
        <input type="text" name="luggage" value="<?php echo e($row['luggage']); ?>" placeholder="e.g. 2 bags">
      </div>

      <div class="fld">
        <label>Outstation Per KM (₹)</label>
        <input type="text" name="per_km" value="<?php echo e($row['per_km']); ?>" placeholder="e.g. 2400 or On Call" placeholder="e.g. 13">
      </div>

      <div class="fld f-full">
        <label>Vehicle Image</label>
        <?php if (!empty($row['image'])): ?>
          <div style="margin:8px 0 12px">
            <img src="../assets/img/<?php echo e($row['image']); ?>"
                 alt="<?php echo e($row['name']); ?>"
                 style="width:180px;height:110px;object-fit:cover;border-radius:8px;border:1px solid #dbe2ea">
            <div class="hint">Current image: <?php echo e($row['image']); ?></div>
          </div>
        <?php endif; ?>
        <input type="file" name="image_file" accept="image/jpeg,image/png,image/webp">
        <div class="hint">JPG, PNG or WebP. Maximum 5 MB.</div>
      </div>

      <div class="fld f-full">
        <label>Description</label>
        <textarea name="description" style="min-height:120px"><?php echo e($row['description']); ?></textarea>
      </div>

      <div class="fld f-full">
        <h3 style="margin:12px 0 4px;color:#e31b23">Local Rental — Bhuj</h3>
        <div class="hint">Extra Hour Charge is intentionally excluded.</div>
      </div>

      <input type="hidden" name="local_8h_80km_ac" value="<?php echo e($row['local_8h_80km_ac']); ?>">
      <input type="hidden" name="local_8h_80km_nonac" value="<?php echo e($row['local_8h_80km_nonac']); ?>">

      <div class="fld f-full">
        <h3 style="margin:12px 0 8px">Day Rental Package — 12 Hours / 300 Kms Fix Charge</h3>
      </div>

      <div class="fld">
        <label>A/C (₹)</label>
        <input type="text" name="local_12h_300km_ac" value="<?php echo e($row['local_12h_300km_ac']); ?>" placeholder="e.g. 2400 or On Call">
      </div>

      <div class="fld">
        <label>Non-A/C (₹)</label>
        <input type="text" name="local_12h_300km_nonac" value="<?php echo e($row['local_12h_300km_nonac']); ?>" placeholder="e.g. 2400 or On Call">
      </div>

      <div class="fld f-full">
        <h3 style="margin:12px 0 8px">Above Extra KM Charge</h3>
      </div>

      <div class="fld">
        <label>A/C (₹)</label>
        <input type="text" name="extra_km_ac" value="<?php echo e($row['extra_km_ac']); ?>" placeholder="e.g. 2400 or On Call">
      </div>

      <div class="fld">
        <label>Non-A/C (₹)</label>
        <input type="text" name="extra_km_nonac" value="<?php echo e($row['extra_km_nonac']); ?>" placeholder="e.g. 2400 or On Call">
      </div>

      <div class="fld f-full">
        <h3 style="margin:12px 0 8px">Outstation</h3>
      </div>

      <div class="fld">
        <label>Daily Minimum KM</label>
        <input type="number" min="0" name="daily_min_km" value="<?php echo e($row['daily_min_km']); ?>" placeholder="e.g. 300">
      </div>

      <div class="fld">
        <label>Driver Night Allowance (₹)</label>
        <input type="text" name="driver_night_allowance" value="<?php echo e($row['driver_night_allowance']); ?>" placeholder="e.g. 2400 or On Call">
      </div>

      <div class="fld">
        <label>Airport / Station Transfer (₹)</label>
        <input type="text" name="airport_transfer" value="<?php echo e($row['airport_transfer']); ?>" placeholder="e.g. 2400 or On Call">
      </div>

      <div class="fld f-full">
        <label>Notes</label>
        <textarea name="notes" style="min-height:80px" placeholder="Any special vehicle/rate notes"><?php echo e($row['notes']); ?></textarea>
      </div>

      <div class="fld">
        <label>Status</label>
        <select name="is_active">
          <option value="1" <?php echo $row['is_active'] ? 'selected' : ''; ?>>Active</option>
          <option value="0" <?php echo !$row['is_active'] ? 'selected' : ''; ?>>Inactive</option>
        </select>
      </div>

      <div class="fld">
        <label>Sort Order</label>
        <input type="number" name="sort_order" value="<?php echo (int)$row['sort_order']; ?>" min="0">
      </div>

    </div>

    <div class="f-foot">
      <button type="submit" class="btn btn-accent">Save Vehicle</button>
      <a href="vehicles.php" class="btn btn-out">Cancel</a>
    </div>
  </form>
</div>

<?php require_once __DIR__ . '/inc/admin-footer.php'; ?>
