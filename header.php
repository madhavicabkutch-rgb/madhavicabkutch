<?php
/* ============================================================
   Madhavi Cab Kutch — shared site header
   Use at the top of every page:
     <?php $page_title="..."; $page_desc="..."; $active="home";
     include 'header.php'; ?>
   ============================================================ */

require_once __DIR__ . '/config.php';

$page_title = isset($page_title) ? $page_title : 'Car Rental & One Way Taxi in Bhuj, Kutch | ' . BIZ_NAME;
$page_desc  = isset($page_desc)  ? $page_desc  : 'Car rental and one way taxi in Bhuj, Kutch. Sedans, SUVs, tempo travellers and buses with local drivers. Fixed fares, available 24x7.';
$active     = isset($active)     ? $active     : '';

$self = basename($_SERVER['PHP_SELF']);
$clean_slug = preg_replace('/\.php$/', '', $self);
if (!isset($canonical)) {
    $canonical = ($clean_slug === 'index' || empty($clean_slug)) ? SITE_URL . '/' : SITE_URL . '/' . $clean_slug;
}

function navclass($key) {
    global $active;
    return $active === $key ? ' class="on"' : '';
}

/* ------------------------------------------------------------
   Image helpers — a photo is shown when the file exists in
   assets/img/, otherwise a placeholder icon keeps the layout intact.
------------------------------------------------------------ */
function has_img($file) {
    if (!$file) return false;
    return file_exists(__DIR__ . '/assets/img/' . $file);
}

/* Return the image URL with its file modification time.
   This automatically bypasses browser/CDN cache whenever an image
   is replaced, without requiring a filename change. */
function img_url($file) {
    if (!$file || !has_img($file)) return '';
    $path = __DIR__ . '/assets/img/' . $file;
    $version = @filemtime($path);
    return 'assets/img/' . e($file) . ($version ? '?v=' . $version : '');
}

/* $fit = 'cover' fills and crops (scenery). 'contain' shows the
   whole image without cropping (vehicle cut-outs on white). */
function photo($file, $alt, $icon = '&#128663;', $fit = 'cover') {
    if (has_img($file)) {
        $cls = ($fit === 'contain') ? 'ph contain' : 'ph';
        echo '<div class="' . $cls . '"><img src="' . img_url($file) . '" alt="' . e($alt) . '" loading="lazy"></div>';
    } else {
        echo '<div class="ph">' . $icon . '</div>';
    }
}

/* Background image for the hero slides */
function slide_bg($file) {
    return has_img($file) ? "background-image:url('" . img_url($file) . "');" : '';
}

/* WhatsApp link with a pre-filled message */
function wa_link($msg) {
    return 'https://wa.me/' . BIZ_WA . '?text=' . rawurlencode($msg);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo e($page_title); ?></title>
<meta name="description" content="<?php echo e($page_desc); ?>">
<meta name="keywords" content="<?php echo isset($page_keywords) ? e($page_keywords) : 'car rental in bhuj, taxi service in bhuj, cab service in kutch, one way taxi bhuj, kutch tour packages, white rann cab, dholavira taxi, tempo traveller bhuj, car hire kutch'; ?>">
<link rel="canonical" href="<?php echo $canonical; ?>">
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<meta name="theme-color" content="#141b2e">
<meta name="geo.region" content="IN-GJ">
<meta name="geo.placename" content="Bhuj, Kutch, Gujarat">
<meta name="geo.position" content="<?php echo BIZ_LAT; ?>;<?php echo BIZ_LNG; ?>">
<meta name="ICBM" content="<?php echo BIZ_LAT; ?>, <?php echo BIZ_LNG; ?>">

<meta property="og:site_name" content="<?php echo BIZ_NAME; ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?php echo e($page_title); ?>">
<meta property="og:description" content="<?php echo e($page_desc); ?>">
<meta property="og:url" content="<?php echo $canonical; ?>">
<meta property="og:image" content="<?php echo isset($og_image) ? $og_image : (SITE_URL . '/assets/img/og-image.jpg'); ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="<?php echo e($page_title); ?>">
<meta property="og:locale" content="en_IN">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo e($page_title); ?>">
<meta name="twitter:description" content="<?php echo e($page_desc); ?>">
<meta name="twitter:image" content="<?php echo isset($og_image) ? $og_image : (SITE_URL . '/assets/img/og-image.jpg'); ?>">

<link rel="icon" href="assets/img/favicon.png" type="image/png">
<link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/style-h1.css">

<?php
// Breadcrumb schema builder
$bc_items = array(
    array('name' => 'Home', 'url' => SITE_URL . '/')
);
if ($active === 'rental') {
    $bc_items[] = array('name' => 'Car Rental', 'url' => SITE_URL . '/vehicle-rental');
} elseif ($active === 'oneway') {
    $bc_items[] = array('name' => 'One Way Taxi', 'url' => SITE_URL . '/one-way-taxi');
} elseif ($active === 'packages') {
    $bc_items[] = array('name' => 'Tour Packages', 'url' => SITE_URL . '/fixed-kutch-tour-package');
    if (isset($p) && isset($p['nights'])) {
        $bc_items[] = array('name' => $p['nights'] . ' Kutch Tour', 'url' => $canonical);
    }
} elseif ($active === 'places') {
    $bc_items[] = array('name' => 'Places to Visit', 'url' => SITE_URL . '/places-to-visit');
    if (isset($pl) && isset($pl['title'])) {
        $bc_items[] = array('name' => $pl['title'], 'url' => $canonical);
    }
} elseif ($active === 'contact') {
    $bc_items[] = array('name' => 'Contact', 'url' => SITE_URL . '/contact');
} elseif ($clean_slug === 'terms') {
    $bc_items[] = array('name' => 'Terms & Conditions', 'url' => $canonical);
} elseif ($clean_slug === 'privacy-policy') {
    $bc_items[] = array('name' => 'Privacy Policy', 'url' => $canonical);
} elseif ($clean_slug === 'cancellation-policy') {
    $bc_items[] = array('name' => 'Cancellation Policy', 'url' => $canonical);
}

$bc_schema_elements = array();
foreach ($bc_items as $idx => $bc) {
    $bc_schema_elements[] = array(
        '@type' => 'ListItem',
        'position' => $idx + 1,
        'name' => $bc['name'],
        'item' => $bc['url']
    );
}
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": ["TaxiService", "AutoRental", "TravelAgency"],
      "@id": "<?php echo SITE_URL; ?>/#business",
      "name": "<?php echo BIZ_NAME; ?>",
      "alternateName": ["Madhavi Cab", "Madhavi Cab Bhuj", "Madhavi Cab Kutch Car Rental"],
      "description": "Car rental, one way taxi, tempo traveller hire and customized Kutch tour packages operated from Bhuj, Gujarat.",
      "url": "<?php echo SITE_URL; ?>/",
      "telephone": "<?php echo BIZ_PHONE; ?>",
      "email": "<?php echo BIZ_EMAIL; ?>",
      "logo": "<?php echo SITE_URL; ?>/assets/img/logo.png",
      "image": "<?php echo SITE_URL; ?>/assets/img/og-image.jpg",
      "priceRange": "₹₹",
      "currenciesAccepted": "INR",
      "paymentAccepted": "Cash, UPI, Credit Card, Debit Card, Net Banking",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "<?php echo BIZ_STREET; ?>",
        "addressLocality": "Bhuj",
        "addressRegion": "Gujarat",
        "postalCode": "<?php echo BIZ_PIN; ?>",
        "addressCountry": "IN"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": "<?php echo BIZ_LAT; ?>",
        "longitude": "<?php echo BIZ_LNG; ?>"
      },
      "hasMap": "<?php echo BIZ_MAP; ?>",
      "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],
        "opens": "00:00",
        "closes": "23:59"
      },
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "5.0",
        "bestRating": "5",
        "worstRating": "1",
        "ratingCount": "32"
      },
      "areaServed": [
        { "@type": "City", "name": "Bhuj" },
        { "@type": "City", "name": "Gandhidham" },
        { "@type": "City", "name": "Mandvi" },
        { "@type": "City", "name": "Anjar" },
        { "@type": "City", "name": "Mundra" },
        { "@type": "AdministrativeArea", "name": "Kutch" },
        { "@type": "AdministrativeArea", "name": "Gujarat" }
      ],
      "sameAs": [
        "<?php echo FB_URL; ?>",
        "<?php echo IG_URL; ?>",
        "<?php echo BIZ_MAP; ?>",
        "<?php echo GOOGLE_REVIEW_URL; ?>"
      ],
      "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": "Services",
        "itemListElement": [
          { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Car rental with driver in Bhuj" } },
          { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "One way taxi from Bhuj across Gujarat" } },
          { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Bus and tempo traveller hire in Kutch" } },
          { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Kutch tour packages (White Rann, Dholavira, Mandvi)" } }
        ]
      }
    },
    {
      "@type": "WebSite",
      "@id": "<?php echo SITE_URL; ?>/#website",
      "name": "<?php echo BIZ_NAME; ?>",
      "url": "<?php echo SITE_URL; ?>/",
      "inLanguage": "en-IN",
      "publisher": { "@id": "<?php echo SITE_URL; ?>/#business" }
    },
    {
      "@type": "BreadcrumbList",
      "@id": "<?php echo $canonical; ?>#breadcrumb",
      "itemListElement": <?php echo json_encode($bc_schema_elements, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
    }
  ]
}
</script>
<?php if (isset($page_schema)) { echo "\n" . $page_schema . "\n"; } ?>
</head>
<body>

<div class="topbar">
  <div class="wrap">
    <span><?php echo BIZ_CITY; ?> &middot; Available 24&times;7</span>
    <span>Call / WhatsApp: <a href="tel:<?php echo BIZ_PHONE; ?>"><?php echo BIZ_PHONE_D; ?></a></span>
  </div>
</div>

<header class="hdr">
  <div class="wrap">
    <a href="./" class="logo-plate" title="Madhavi Cab Kutch - Car Rental & Taxi Service in Bhuj">
      <?php if (has_img('logo.png')): ?>
        <img src="<?php echo img_url('logo.png'); ?>" alt="<?php echo BIZ_NAME; ?> - Car Rental & Taxi Service in Bhuj Kutch">
      <?php else: ?>
        <span class="logo-mark">M</span>
        <span>
          <span class="logo-txt">Madhavi Cab</span>
          <span class="logo-sub">CAB KUTCH</span>
        </span>
      <?php endif; ?>
    </a>

    <button class="burger" id="burger" aria-label="Open menu" aria-expanded="false">&#9776;</button>

    <nav class="nav" id="nav">
      <a href="./"<?php echo navclass('home'); ?>>Home</a>
      <a href="vehicle-rental"<?php echo navclass('rental'); ?>>Car Rental</a>
      <a href="one-way-taxi"<?php echo navclass('oneway'); ?>>One Way Taxi</a>
      <a href="fixed-kutch-tour-package"<?php echo navclass('packages'); ?>>Tour Packages</a>
      <a href="places-to-visit"<?php echo navclass('places'); ?>>Places to Visit</a>
      <a href="contact"<?php echo navclass('contact'); ?>>Contact</a>
      <a href="<?php echo wa_link('Hi, I would like to make an enquiry.'); ?>" class="nav-cta" target="_blank" rel="noopener">Enquire Now</a>
    </nav>
  </div>
</header>
