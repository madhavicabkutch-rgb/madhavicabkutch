<?php
require_once __DIR__ . '/auth.php';

$pg = 'places';
$id = get_id();
$pg_title = $id ? 'Edit place' : 'Add place';
require_once __DIR__ . '/inc/admin-header.php';

$row = array(
  'id' => 0, 'title' => '', 'slug' => '', 'category' => '',
  'distance_bhuj' => '', 'best_time' => '', 'short_desc' => '',
  'description' => '', 'image' => '', 'sort_order' => 0, 'is_active' => 1
);

if ($id) {
    $found = fetch_one("SELECT * FROM places WHERE id = " . $id);
    if (!$found) {
        flash_set('error', 'That place no longer exists.');
        header('Location: places.php');
        exit;
    }
    $row = $found;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_ok()) {
        flash_set('error', 'Session expired. Please try again.');
        header('Location: place-edit.php' . ($id ? '?id=' . $id : ''));
        exit;
    }

    $title         = post('title');
    $slug          = post('slug');
    $category      = post('category');
    $distance_bhuj = post('distance_bhuj');
    $best_time     = post('best_time');
    $short_desc    = post('short_desc');
    $description   = post('description');
    $image         = isset($row['image']) ? $row['image'] : '';
    $sort_order    = (int)post('sort_order');
    $is_active     = isset($_POST['is_active']) ? 1 : 0;

    $slug = ($slug === '') ? make_slug($title) : make_slug($slug);

    if ($title === '') {
        flash_set('error', 'Enter the name of the place.');
    } else {

        /* ---- Image upload ---- */
        if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] !== UPLOAD_ERR_NO_FILE) {
            $upload = $_FILES['image_file'];

            if ($upload['error'] !== UPLOAD_ERR_OK) {
                flash_set('error', 'The image upload failed. Please try again.');
            } elseif ($upload['size'] > 5 * 1024 * 1024) {
                flash_set('error', 'Image must be 5 MB or smaller.');
            } else {
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $mime = $finfo->file($upload['tmp_name']);

                $allowed = array(
                    'image/jpeg' => 'jpg',
                    'image/png'  => 'png',
                    'image/webp' => 'webp'
                );

                if (!isset($allowed[$mime])) {
                    flash_set('error', 'Please upload a JPG, PNG or WebP image.');
                } else {
                    $safeBase = make_slug(pathinfo($upload['name'], PATHINFO_FILENAME));
                    if ($safeBase === '') {
                        $safeBase = 'place-image';
                    }

                    $ext = $allowed[$mime];
                    $filename = $safeBase . '.' . $ext;
                    $uploadDir = __DIR__ . '/../assets/img/';

                    if (!is_dir($uploadDir)) {
                        @mkdir($uploadDir, 0755, true);
                    }

                    /* Avoid overwriting another existing image. */
                    if (file_exists($uploadDir . $filename) && $filename !== $image) {
                        $filename = $safeBase . '-' . time() . '.' . $ext;
                    }

                    if (!move_uploaded_file($upload['tmp_name'], $uploadDir . $filename)) {
                        flash_set('error', 'Could not save the uploaded image. Check folder permissions.');
                    } else {
                        $image = $filename;
                    }
                }
            }
        }

        /* Only continue to the database if there was no upload error. */
        $hasError = false;
        /* flash messages are not exposed as a state flag, so re-check upload when present. */
        if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] !== UPLOAD_ERR_NO_FILE) {
            if (!isset($mime) || !isset($allowed[$mime]) || !isset($filename) || !file_exists(__DIR__ . '/../assets/img/' . $image)) {
                $hasError = true;
            }
        }

        if (!$hasError) {
            if (defined('DB_OK') && DB_OK && isset($conn) && $conn) {
                $chk = $conn->prepare("SELECT id FROM places WHERE slug = ? AND id <> ? LIMIT 1");
                $chk->bind_param('si', $slug, $id);
                $chk->execute();
                $clash = $chk->get_result()->fetch_assoc();
                $chk->close();
                if ($clash) {
                    $slug = $slug . '-' . time();
                }

                if ($id) {
                    $st = $conn->prepare("UPDATE places SET
                            title=?, slug=?, category=?, distance_bhuj=?, best_time=?,
                            short_desc=?, description=?, image=?, sort_order=?, is_active=?
                          WHERE id=?");
                    if (!$st) {
                        flash_set('error', 'SQL error: ' . $conn->error);
                    } else {
                        $st->bind_param('ssssssssiii',
                            $title, $slug, $category, $distance_bhuj, $best_time,
                            $short_desc, $description, $image, $sort_order, $is_active, $id);
                        if ($st->execute()) {
                            flash_set('ok', 'Place saved.');
                            $st->close();
                            header('Location: places.php');
                            exit;
                        }
                        flash_set('error', 'Could not save: ' . $st->error);
                        $st->close();
                    }
                } else {
                    $st = $conn->prepare("INSERT INTO places
                            (title, slug, category, distance_bhuj, best_time,
                             short_desc, description, image, sort_order, is_active)
                          VALUES (?,?,?,?,?,?,?,?,?,?)");
                    if (!$st) {
                        flash_set('error', 'SQL error: ' . $conn->error);
                    } else {
                        $st->bind_param('ssssssssii',
                            $title, $slug, $category, $distance_bhuj, $best_time,
                            $short_desc, $description, $image, $sort_order, $is_active);
                        if ($st->execute()) {
                            flash_set('ok', 'Place added.');
                            $st->close();
                            header('Location: places.php');
                            exit;
                        }
                        flash_set('error', 'Could not save: ' . $st->error);
                        $st->close();
                    }
                }
            } else {
                // Local JSON storage save
                $places = load_local_data('places');
                if ($id) {
                    foreach ($places as &$p) {
                        if ($p['id'] == $id) {
                            $p['title'] = $title;
                            $p['slug'] = $slug;
                            $p['category'] = $category;
                            $p['distance_bhuj'] = $distance_bhuj;
                            $p['best_time'] = $best_time;
                            $p['short_desc'] = $short_desc;
                            $p['description'] = $description;
                            $p['image'] = $image;
                            $p['sort_order'] = $sort_order;
                            $p['is_active'] = $is_active;
                        }
                    }
                    flash_set('ok', 'Place saved.');
                } else {
                    $newId = count($places) ? max(array_column($places, 'id')) + 1 : 1;
                    $places[] = array(
                        'id' => $newId, 'title' => $title, 'slug' => $slug,
                        'category' => $category, 'distance_bhuj' => $distance_bhuj,
                        'best_time' => $best_time, 'short_desc' => $short_desc,
                        'description' => $description, 'image' => $image,
                        'sort_order' => $sort_order, 'is_active' => $is_active
                    );
                    flash_set('ok', 'Place added.');
                }
                save_local_data('places', $places);
                header('Location: places.php');
                exit;
            }
        }
    }

    $row = array(
      'id' => $id, 'title' => $title, 'slug' => $slug, 'category' => $category,
      'distance_bhuj' => $distance_bhuj, 'best_time' => $best_time,
      'short_desc' => $short_desc, 'description' => $description,
      'image' => $image, 'sort_order' => $sort_order, 'is_active' => $is_active
    );
}
?>

<div class="card">
  <div class="card-head">
    <div>
      <h2><?php echo $id ? 'Edit place' : 'Add a new place'; ?></h2>
      <p class="card-note">This creates a page at /place-detail.php with its own address.</p>
    </div>
    <a href="places.php" class="btn btn-out">&larr; Back to list</a>
  </div>

  <form method="post" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>

    <div class="f-grid">
      <div class="fld">
        <label for="title">Name of the place</label>
        <input type="text" name="title" id="title" value="<?php echo e($row['title']); ?>" required>
        <div class="hint">For example: White Rann of Kutch</div>
      </div>

      <div class="fld">
        <label for="slug">Page address (slug)</label>
        <input type="text" name="slug" id="slug" value="<?php echo e($row['slug']); ?>">
        <div class="hint">Leave blank and it is created automatically.</div>
      </div>

      <div class="fld">
        <label for="category">Category</label>
        <input type="text" name="category" id="category" value="<?php echo e($row['category']); ?>">
        <div class="hint">Nature, Heritage, Beach, Temple, Craft, Viewpoint</div>
      </div>

      <div class="fld">
        <label for="distance_bhuj">Distance from Bhuj</label>
        <input type="text" name="distance_bhuj" id="distance_bhuj" value="<?php echo e($row['distance_bhuj']); ?>">
        <div class="hint">For example: 80 km</div>
      </div>

      <div class="fld">
        <label for="best_time">Best time to visit</label>
        <input type="text" name="best_time" id="best_time" value="<?php echo e($row['best_time']); ?>">
        <div class="hint">For example: November to February</div>
      </div>

      <div class="fld">
        <label for="sort_order">Sort order</label>
        <input type="number" name="sort_order" id="sort_order" min="0" value="<?php echo (int)$row['sort_order']; ?>">
        <div class="hint">Lower numbers appear first. The first four show on the homepage.</div>
      </div>

      <div class="fld f-full">
        <label for="image_file">Place image</label>

        <?php if (!empty($row['image'])): ?>
          <div style="display:flex;align-items:center;gap:14px;margin:8px 0 12px">
            <img src="../assets/img/<?php echo e($row['image']); ?>"
                 alt="<?php echo e($row['title']); ?>"
                 style="width:140px;height:90px;object-fit:cover;border-radius:8px;border:1px solid #dbe2ea;background:#f5f7fa"
                 onerror="this.style.display='none'">
            <div class="hint">Current image: <b><?php echo e($row['image']); ?></b></div>
          </div>
        <?php endif; ?>

        <input type="file" name="image_file" id="image_file"
               accept="image/jpeg,image/png,image/webp">
        <div class="hint">Upload JPG, PNG or WebP. Maximum 5 MB. Leave empty to keep the current image.</div>
      </div>

      <div class="fld f-full">
        <label for="short_desc">Short description</label>
        <textarea name="short_desc" id="short_desc" style="min-height:70px"><?php echo e($row['short_desc']); ?></textarea>
        <div class="hint">One or two lines. Shown under the heading and used as the page description for Google.</div>
      </div>

      <div class="fld f-full">
        <label for="description">Full description</label>
        <textarea name="description" id="description" style="min-height:220px"><?php echo e($row['description']); ?></textarea>
        <div class="hint">The main text on the place page. Press Enter twice between paragraphs &mdash; each block becomes its own paragraph.</div>
      </div>
    </div>

    <div style="margin-top:6px">
      <label class="check">
        <input type="checkbox" name="is_active" value="1" <?php echo $row['is_active'] ? 'checked' : ''; ?>>
        Active &mdash; visible on the website
      </label>
    </div>

    <div class="f-foot">
      <button type="submit" class="btn btn-accent"><?php echo $id ? 'Save changes' : 'Add place'; ?></button>
      <a href="places.php" class="btn btn-out">Cancel</a>
    </div>
  </form>
</div>

<?php require_once __DIR__ . '/inc/admin-footer.php'; ?>
