<?php
require_once __DIR__ . '/auth.php';

$pg = 'routes';
$id = get_id();
$pg_title = $id ? 'Edit route' : 'Add route';
require_once __DIR__ . '/inc/admin-header.php';

/* ---- Defaults for a new route ---- */
$row = array(
  'id' => 0, 'from_city' => 'Bhuj', 'to_city' => '', 'slug' => '',
  'distance_km' => '', 'duration' => '',
  'sedan_fare' => '', 'suv_fare' => '', 'tempo_fare' => '',
  'description' => '', 'show_on_home' => 0, 'sort_order' => 0, 'is_active' => 1
);

/* ---- Load existing ---- */
if ($id) {
    $found = fetch_one("SELECT * FROM routes WHERE id = " . $id);
    if (!$found) {
        flash_set('error', 'That route no longer exists.');
        header('Location: routes.php');
        exit;
    }
    $row = $found;
}

/* ---- Save ---- */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_ok()) {
        flash_set('error', 'Session expired. Please try again.');
        header('Location: route-edit.php' . ($id ? '?id=' . $id : ''));
        exit;
    }

    $from_city    = post('from_city', 'Bhuj');
    $to_city      = post('to_city');
    $slug         = post('slug');
    $distance_km  = (int)post('distance_km');
    $duration     = post('duration');
    $sedan_fare   = (float)post('sedan_fare');
    $suv_fare     = (float)post('suv_fare');
    $tempo_fare   = (float)post('tempo_fare');
    $description  = post('description');
    $show_on_home = isset($_POST['show_on_home']) ? 1 : 0;
    $sort_order   = (int)post('sort_order');
    $is_active    = isset($_POST['is_active']) ? 1 : 0;

    /* Build the slug if left blank */
    if ($slug === '') {
        $slug = make_slug($from_city . ' to ' . $to_city);
    } else {
        $slug = make_slug($slug);
    }

    if ($to_city === '') {
        flash_set('error', 'Enter the destination city.');
    } else {

        if (defined('DB_OK') && DB_OK && isset($conn) && $conn) {
            /* Slug must be unique */
            $chk = $conn->prepare("SELECT id FROM routes WHERE slug = ? AND id <> ? LIMIT 1");
            $chk->bind_param('si', $slug, $id);
            $chk->execute();
            $clash = $chk->get_result()->fetch_assoc();
            $chk->close();

            if ($clash) {
                $slug = $slug . '-' . time();
            }

            if ($id) {
                /* 12 values + id = 13 placeholders, 13 type letters */
                $sql = "UPDATE routes SET
                          from_city=?, to_city=?, slug=?, distance_km=?, duration=?,
                          sedan_fare=?, suv_fare=?, tempo_fare=?, description=?,
                          show_on_home=?, sort_order=?, is_active=?
                        WHERE id=?";
                $st = $conn->prepare($sql);
                if (!$st) {
                    flash_set('error', 'SQL error: ' . $conn->error);
                } else {
                    $st->bind_param(
                        'sssisdddsiiii',
                        $from_city, $to_city, $slug, $distance_km, $duration,
                        $sedan_fare, $suv_fare, $tempo_fare, $description,
                        $show_on_home, $sort_order, $is_active, $id
                    );
                    if ($st->execute()) {
                        flash_set('ok', 'Route saved.');
                        $st->close();
                        header('Location: routes.php');
                        exit;
                    }
                    flash_set('error', 'Could not save: ' . $st->error);
                    $st->close();
                }
            } else {
                /* 12 placeholders, 12 type letters */
                $sql = "INSERT INTO routes
                          (from_city, to_city, slug, distance_km, duration,
                           sedan_fare, suv_fare, tempo_fare, description,
                           show_on_home, sort_order, is_active)
                        VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
                $st = $conn->prepare($sql);
                if (!$st) {
                    flash_set('error', 'SQL error: ' . $conn->error);
                } else {
                    $st->bind_param(
                        'sssisdddsiii',
                        $from_city, $to_city, $slug, $distance_km, $duration,
                        $sedan_fare, $suv_fare, $tempo_fare, $description,
                        $show_on_home, $sort_order, $is_active
                    );
                    if ($st->execute()) {
                        flash_set('ok', 'Route added.');
                        $st->close();
                        header('Location: routes.php');
                        exit;
                    }
                    flash_set('error', 'Could not save: ' . $st->error);
                    $st->close();
                }
            }
        } else {
            // Local JSON storage save
            $routes = load_local_data('routes');
            if ($id) {
                foreach ($routes as &$r) {
                    if ($r['id'] == $id) {
                        $r['from_city'] = $from_city;
                        $r['to_city'] = $to_city;
                        $r['slug'] = $slug;
                        $r['distance_km'] = $distance_km;
                        $r['duration'] = $duration;
                        $r['sedan_fare'] = $sedan_fare;
                        $r['suv_fare'] = $suv_fare;
                        $r['tempo_fare'] = $tempo_fare;
                        $r['description'] = $description;
                        $r['show_on_home'] = $show_on_home;
                        $r['sort_order'] = $sort_order;
                        $r['is_active'] = $is_active;
                    }
                }
                flash_set('ok', 'Route saved locally.');
            } else {
                $newId = count($routes) ? max(array_column($routes, 'id')) + 1 : 1;
                $routes[] = array(
                    'id' => $newId, 'from_city' => $from_city, 'to_city' => $to_city, 'slug' => $slug,
                    'distance_km' => $distance_km, 'duration' => $duration,
                    'sedan_fare' => $sedan_fare, 'suv_fare' => $suv_fare, 'tempo_fare' => $tempo_fare,
                    'description' => $description, 'show_on_home' => $show_on_home, 'sort_order' => $sort_order, 'is_active' => $is_active
                );
                flash_set('ok', 'Route added locally.');
            }
            save_local_data('routes', $routes);
            header('Location: routes.php');
            exit;
        }
    }

    /* Save failed — keep what was typed so nothing is lost */
    $row = array(
      'id' => $id, 'from_city' => $from_city, 'to_city' => $to_city, 'slug' => $slug,
      'distance_km' => $distance_km, 'duration' => $duration,
      'sedan_fare' => $sedan_fare, 'suv_fare' => $suv_fare, 'tempo_fare' => $tempo_fare,
      'description' => $description, 'show_on_home' => $show_on_home,
      'sort_order' => $sort_order, 'is_active' => $is_active
    );
    echo flash_show();
}
?>

<div class="card">
  <div class="card-head">
    <div>
      <h2><?php echo $id ? 'Edit route' : 'Add a new route'; ?></h2>
      <p class="card-note">Fares are shown on the site exactly as entered here.</p>
    </div>
    <a href="routes.php" class="btn btn-out">&larr; Back to list</a>
  </div>

  <form method="post">
    <?php echo csrf_field(); ?>

    <div class="f-grid">
      <div class="fld">
        <label for="from_city">From</label>
        <input type="text" name="from_city" id="from_city" value="<?php echo e($row['from_city']); ?>" required>
        <div class="hint">Usually Bhuj.</div>
      </div>

      <div class="fld">
        <label for="to_city">To</label>
        <input type="text" name="to_city" id="to_city" value="<?php echo e($row['to_city']); ?>" required>
        <div class="hint">For example: Ahmedabad</div>
      </div>

      <div class="fld">
        <label for="slug">Page address (slug)</label>
        <input type="text" name="slug" id="slug" value="<?php echo e($row['slug']); ?>">
        <div class="hint">Leave blank and it will be created automatically.</div>
      </div>

      <div class="fld">
        <label for="distance_km">Distance in km</label>
        <input type="number" name="distance_km" id="distance_km" min="0" value="<?php echo e($row['distance_km']); ?>">
      </div>

      <div class="fld">
        <label for="duration">Travel time</label>
        <input type="text" name="duration" id="duration" value="<?php echo e($row['duration']); ?>">
        <div class="hint">For example: 6 hr, or 1 hr 30 min</div>
      </div>

      <div class="fld">
        <label for="sort_order">Sort order</label>
        <input type="number" name="sort_order" id="sort_order" min="0" value="<?php echo (int)$row['sort_order']; ?>">
        <div class="hint">Lower numbers appear first.</div>
      </div>

      <div class="fld">
        <label for="sedan_fare">Sedan fare (&#8377;)</label>
        <input type="number" name="sedan_fare" id="sedan_fare" min="0" step="1" value="<?php echo e($row['sedan_fare']); ?>">
      </div>

      <div class="fld">
        <label for="suv_fare">SUV fare (&#8377;)</label>
        <input type="number" name="suv_fare" id="suv_fare" min="0" step="1" value="<?php echo e($row['suv_fare']); ?>">
      </div>

      <div class="fld">
        <label for="tempo_fare">Tempo fare (&#8377;)</label>
        <input type="number" name="tempo_fare" id="tempo_fare" min="0" step="1" value="<?php echo e($row['tempo_fare']); ?>">
      </div>

      <div class="fld f-full">
        <label for="description">Notes about this route (optional)</label>
        <textarea name="description" id="description"><?php echo e($row['description']); ?></textarea>
        <div class="hint">Not shown on the site yet. Useful for your own reference, and for route pages later.</div>
      </div>
    </div>

    <div class="f-grid-2" style="margin-top:6px">
      <label class="check">
        <input type="checkbox" name="show_on_home" value="1" <?php echo $row['show_on_home'] ? 'checked' : ''; ?>>
        Show this route on the homepage table
      </label>
      <label class="check">
        <input type="checkbox" name="is_active" value="1" <?php echo $row['is_active'] ? 'checked' : ''; ?>>
        Active &mdash; visible on the website
      </label>
    </div>

    <div class="f-foot">
      <button type="submit" class="btn btn-accent"><?php echo $id ? 'Save changes' : 'Add route'; ?></button>
      <a href="routes.php" class="btn btn-out">Cancel</a>
    </div>
  </form>
</div>

<?php require_once __DIR__ . '/inc/admin-footer.php'; ?>
