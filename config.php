<?php
/* ============================================================
   Madhavi Cab Kutch — database connection and helpers
   Included by header.php, so every page gets it automatically.
   ============================================================ */

/* ------------------------------------------------------------
   1. DATABASE DETAILS — fill these in on the server
   ------------------------------------------------------------
   Get these from hPanel > Databases > MySQL Databases.
   Replace the placeholder text between the quotes.
   Keep the quotes. Do not add spaces around the values.
------------------------------------------------------------ */
define('DB_HOST', 'localhost');
define('DB_NAME', 'u903526733_madhavicab');
define('DB_USER', 'u903526733_madhavicab');
define('DB_PASS', 'Optinest123@');

/* ------------------------------------------------------------
   2. Site URL
------------------------------------------------------------ */
define('SITE_URL', 'https://madhavicabkutch.com');


/* ------------------------------------------------------------
   3. Fallback business details
   These are used ONLY if the database is unreachable, so the
   site keeps working instead of going blank. Normally the
   values from the settings table are used instead.
------------------------------------------------------------ */
$FALLBACK = array(
  'biz_phone'         => '+918128807488',
  'biz_phone_display' => '+91 81288 07488',
  'biz_whatsapp'      => '918128807488',
  'biz_email'         => 'madhavicabkutch@gmail.com',
  'biz_street'        => '4, Yogeswar Nagar',
  'biz_city'          => 'Bhuj, Kutch',
  'biz_pin'           => '370001',
  'fb_url'            => 'https://www.facebook.com/ramesh.ahir.90813',
  'ig_url'            => 'https://www.instagram.com/madhavi_cab_kutch/',
  'stat_years'        => '12+',
  'stat_vehicles'     => '40+',
  'stat_support'      => '24×7'
);


/* ------------------------------------------------------------
   4. Connect
   $conn is null if the connection fails or mysqli is not installed.
   Nothing crashes.
------------------------------------------------------------ */
if (function_exists('mysqli_report') && class_exists('mysqli')) {
    mysqli_report(MYSQLI_REPORT_OFF);
    $conn = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn && !$conn->connect_errno) {
        $conn->set_charset('utf8mb4');
        define('DB_OK', true);
    } else {
        $conn = null;
        define('DB_OK', false);
    }
} else {
    $conn = null;
    define('DB_OK', false);
}


/* ------------------------------------------------------------
   5. Load settings into memory
------------------------------------------------------------ */
$SETTINGS = $FALLBACK;

if (DB_OK) {
    $res = $conn->query("SELECT setting_key, setting_value FROM settings");
    if ($res) {
        while ($row = $res->fetch_assoc()) {
            if ($row['setting_value'] !== null && $row['setting_value'] !== '') {
                $SETTINGS[$row['setting_key']] = $row['setting_value'];
            }
        }
        $res->free();
    }
}


/* ------------------------------------------------------------
   6. Helper functions
------------------------------------------------------------ */

/* Read a setting: setting('biz_email') */
function setting($key, $default = '') {
    global $SETTINGS;
    return isset($SETTINGS[$key]) ? $SETTINGS[$key] : $default;
}

/* Escape output for HTML: e($row['title']) */
function e($str) {
    return htmlspecialchars((string)$str, ENT_QUOTES, 'UTF-8');
}

/* Format a number as rupees: money(4500) gives 4,500 */
function money($n) {
        if ($n === null || $n === '' || (float)$n == 0) return 'On request';
    return number_format((float)$n, 0, '.', ',');
}

require_once __DIR__ . '/local_data.php';

/* Fallback query processor when MySQL is offline */
function fallback_query($sql) {
    $lsql = strtolower($sql);

    // 1. Routes
    if (strpos($lsql, 'routes') !== false) {
        $items = load_local_data('routes');
        if (preg_match('/where.*?id\s*=\s*(\d+)/i', $sql, $m)) {
            $id = (int)$m[1];
            $items = array_values(array_filter($items, function($r) use ($id) { return $r['id'] == $id; }));
        }
        if (strpos($lsql, 'show_on_home=1') !== false || strpos($lsql, 'show_on_home = 1') !== false) {
            $items = array_values(array_filter($items, function($r) { return !empty($r['show_on_home']); }));
        }
        if (strpos($lsql, 'is_active=1') !== false || strpos($lsql, 'is_active = 1') !== false) {
            $items = array_values(array_filter($items, function($r) { return !empty($r['is_active']); }));
        }
        if (strpos($lsql, 'count(') !== false) {
            return array(array('c' => count($items)));
        }
        if (preg_match('/limit\s+(\d+)/i', $sql, $m)) {
            $items = array_slice($items, 0, (int)$m[1]);
        }
        return $items;
    }

    // 2. Places
    if (strpos($lsql, 'places') !== false) {
        $items = load_local_data('places');
        if (preg_match('/where.*?id\s*=\s*(\d+)/i', $sql, $m)) {
            $id = (int)$m[1];
            $items = array_values(array_filter($items, function($p) use ($id) { return $p['id'] == $id; }));
        }
        if (preg_match('/slug\s*=\s*[\'"]([^\'"]+)[\'"]/i', $sql, $m)) {
            $slug = $m[1];
            $items = array_values(array_filter($items, function($p) use ($slug) { return $p['slug'] === $slug; }));
        }
        if (strpos($lsql, 'is_active=1') !== false || strpos($lsql, 'is_active = 1') !== false) {
            $items = array_values(array_filter($items, function($p) { return !empty($p['is_active']); }));
        }
        if (strpos($lsql, 'count(') !== false) {
            return array(array('c' => count($items)));
        }
        if (preg_match('/limit\s+(\d+)/i', $sql, $m)) {
            $items = array_slice($items, 0, (int)$m[1]);
        }
        return $items;
    }

    // 3. Vehicles
    if (strpos($lsql, 'vehicles') !== false) {
        $items = load_local_data('vehicles');
        if (preg_match('/where.*?id\s*=\s*(\d+)/i', $sql, $m)) {
            $id = (int)$m[1];
            $items = array_values(array_filter($items, function($v) use ($id) { return $v['id'] == $id; }));
        }
        if (preg_match('/category\s*=\s*[\'"]([^\'"]+)[\'"]/i', $sql, $m)) {
            $cat = $m[1];
            $items = array_values(array_filter($items, function($v) use ($cat) { return strcasecmp($v['category'], $cat) === 0; }));
        }
        if (strpos($lsql, 'is_active=1') !== false || strpos($lsql, 'is_active = 1') !== false) {
            $items = array_values(array_filter($items, function($v) { return !empty($v['is_active']); }));
        }
        if (strpos($lsql, 'count(') !== false) {
            return array(array('c' => count($items)));
        }
        if (preg_match('/limit\s+(\d+)/i', $sql, $m)) {
            $items = array_slice($items, 0, (int)$m[1]);
        }
        return $items;
    }

    return array();
}

/* Fetch rows as an array. Automatically falls back to local data if DB is offline */
function fetch_all($sql) {
    global $conn;
    if (defined('DB_OK') && DB_OK && isset($conn) && $conn) {
        try {
            $res = $conn->query($sql);
            if ($res) {
                $out = array();
                while ($row = $res->fetch_assoc()) { $out[] = $row; }
                $res->free();
                if (count($out) > 0) return $out;

                // If 0 rows, check if the underlying table has any rows in MySQL
                if (preg_match('/from\s+([a-zA-Z0-9_]+)/i', $sql, $m)) {
                    $tbl = $m[1];
                    $chk = @$conn->query("SELECT 1 FROM `{$tbl}` LIMIT 1");
                    if ($chk && $chk->num_rows > 0) {
                        $chk->free();
                        return $out; // legitimate empty match
                    }
                    if ($chk) $chk->free();
                }
            }
        } catch (Exception $ex) {}
    }
    return fallback_query($sql);
}

/* Fetch a single row, or null */
function fetch_one($sql) {
    $rows = fetch_all($sql);
    return count($rows) ? $rows[0] : null;
}

/* Split a newline-separated text field into a clean array.
   Used for package highlights. */
function lines_to_array($text) {
    if (!$text) return array();
    $parts = preg_split('/\r\n|\r|\n/', $text);
    $out = array();
    foreach ($parts as $p) {
        $p = trim($p);
        if ($p !== '') $out[] = $p;
    }
    return $out;
}


/* ------------------------------------------------------------
   7. Business constants, built from settings
------------------------------------------------------------ */
define('BIZ_NAME',    'Madhavi Cab Kutch');
define('BIZ_PHONE',   setting('biz_phone'));
define('BIZ_PHONE_D', setting('biz_phone_display'));
define('BIZ_WA',      setting('biz_whatsapp'));
define('BIZ_EMAIL',   setting('biz_email'));
define('BIZ_STREET',  setting('biz_street'));
define('BIZ_CITY',    setting('biz_city'));
define('BIZ_PIN',     setting('biz_pin'));
define('BIZ_LAT',     '23.2597753');
define('BIZ_LNG',     '69.6435447');
define('BIZ_MAP',           'https://www.google.com/maps/place/MADHAVI+CAB+KUTCH/data=!4m2!3m1!1s0x0:0x582ca8dfc5fabc7?sa=X&ved=1t:2428&ictx=111');
define('GOOGLE_REVIEW_URL', 'https://share.google/w1WkYmNi1OvbMWryI');
define('GOOGLE_MAP_EMBED',  'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3665.5412441365474!2d69.64354471059004!3d23.25977530734772!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39511d0074460941%3A0x582ca8dfc5fabc7!2sMADHAVI%20CAB%20KUTCH!5e0!3m2!1sen!2sin!4v1786945317706!5m2!1sen!2sin');
define('FB_URL',            setting('fb_url'));
define('IG_URL',            setting('ig_url'));
