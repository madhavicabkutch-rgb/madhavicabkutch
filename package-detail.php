<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/packages-data.php';

$code = isset($_GET['p']) ? trim($_GET['p']) : '';

if (!isset($PACKAGES[$code])) {
    $page_title = "Package not found | Madhavi Cab Kutch";
    $page_desc  = "The tour package you are looking for is not available.";
    $active     = "packages";
    include 'header.php';
    ?>
    <section class="phero">
      <div class="wrap">
        <h1>Package not found</h1>
        <p>The package you are looking for is not available. Have a look at the four tours we run from Bhuj.</p>
        <div class="cta">
          <a href="fixed-kutch-tour-package" class="btn btn-gold">View all packages</a>
        </div>
      </div>
    </section>
    <?php
    include 'footer.php';
    exit;
}

$p = $PACKAGES[$code];

$page_title    = $p['title'] . " from Bhuj | Madhavi Cab Kutch";
$page_desc     = "Book " . $p['nights'] . " Kutch tour from Bhuj covering " . $p['short'] . ". AC cab and driver included from Rs " . number_format($p['price']) . ". Call +91 81288 07488.";
$page_keywords = strtolower($p['title']) . ", kutch tour package, " . strtolower($p['short']) . ", bhuj cab package, rann of kutch tour";
$active        = "packages";
$canonical     = SITE_URL . '/package-detail?p=' . urlencode($p['code']);
$og_image      = SITE_URL . '/assets/img/' . $p['image'];

// TouristTrip Schema
$itinerary_items = array();
if (!empty($p['itinerary'])) {
    foreach ($p['itinerary'] as $sidx => $step) {
        $itinerary_items[] = array(
            '@type' => 'ListItem',
            'position' => $sidx + 1,
            'name' => $step[0],
            'description' => $step[1]
        );
    }
}

$pkg_schema_array = array(
    '@context' => 'https://schema.org',
    '@type' => 'TouristTrip',
    'name' => $p['title'],
    'description' => $p['lead'],
    'image' => $og_image,
    'touristType' => array('Family', 'Couple', 'Group', 'Solo Traveler'),
    'offers' => array(
        '@type' => 'Offer',
        'price' => $p['price'],
        'priceCurrency' => 'INR',
        'availability' => 'https://schema.org/InStock',
        'validFrom' => '2026-01-01',
        'url' => SITE_URL . '/package-detail?p=' . urlencode($p['code'])
    ),
    'provider' => array(
        '@type' => 'TravelAgency',
        'name' => BIZ_NAME,
        'telephone' => BIZ_PHONE,
        'url' => SITE_URL . '/'
    ),
    'itinerary' => array(
        '@type' => 'ItemList',
        'numberOfItems' => count($itinerary_items),
        'itemListElement' => $itinerary_items
    )
);
$page_schema = '<script type="application/ld+json">' . json_encode($pkg_schema_array, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';

include 'header.php';

$waMsg = 'Hi, I am interested in the ' . $p['nights'] . ' Kutch tour (' . $p['short'] . ').';
?>

<section class="phero">
  <div class="wrap">
    <div class="crumb"><a href="./">Home</a> &rsaquo; <a href="fixed-kutch-tour-package">Tour packages</a> &rsaquo; <?php echo e($p['nights']); ?></div>
    <span class="tag"><?php echo e($p['nights']); ?></span>
    <h1><?php echo e($p['title']); ?></h1>
    <p><?php echo e($p['lead']); ?></p>
    <div class="cta">
      <a href="<?php echo wa_link($waMsg); ?>" class="btn btn-gold" target="_blank" rel="noopener"><i class="fa fa-whatsapp"></i> Enquire on WhatsApp</a>
      <a href="tel:<?php echo BIZ_PHONE; ?>" class="btn btn-ghost">Call <?php echo BIZ_PHONE_D; ?></a>
    </div>
  </div>
</section>

<div class="qstrip"><div class="wrap in">
  <div class="qi"><i class="fa fa-inr"></i> From &#8377;<?php echo money($p['price']); ?> per vehicle</div>
  <div class="qi"><i class="fa fa-calendar"></i> <?php echo e($p['nights']); ?></div>
  <div class="qi"><i class="fa fa-map-marker"></i> Starts and ends in Bhuj</div>
</div></div>

<section class="sec">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">WHAT THIS TOUR COVERS</div>
      <h2>Places included</h2>
    </div>
    <div class="g2">
      <div class="inc-box">
        <h3>Sightseeing</h3>
        <ul class="pkg-covers">
          <?php foreach ($p['covers'] as $cv): ?>
            <li><?php echo e($cv); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="inc-box">
        <h3>Good to know</h3>
        <p style="font-size:14.5px;color:var(--muted);margin-bottom:12px"><b style="color:var(--ink)">Best time:</b> <?php echo e($p['best']); ?></p>
        <p style="font-size:14.5px;color:var(--muted);margin-bottom:12px"><b style="color:var(--ink)">Price:</b> quoted per vehicle, not per person. A group of six pays the same as a group of two.</p>
        <p style="font-size:14.5px;color:var(--muted)"><b style="color:var(--ink)">Flexible:</b> the itinerary below is a starting point. Tell us what to add or drop and we will rebuild it.</p>
      </div>
    </div>
  </div>
</section>

<section class="sec sec-grey">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">DAY BY DAY</div>
      <h2>Itinerary</h2>
      <p>Timings shift with the season and with sunset, so your driver will adjust the plan on the day.</p>
    </div>

    <div class="itin">
      <?php foreach ($p['itinerary'] as $d): ?>
        <div class="iday">
          <h3><?php echo e($d[0]); ?></h3>
          <p><?php echo e($d[1]); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">TERMS</div>
      <h2>Included and not included</h2>
    </div>
    <div class="g2">
      <div class="inc-box inc-yes">
        <h3>Included</h3>
        <ul>
          <?php foreach ($PKG_INCLUDED as $i): ?><li><?php echo e($i); ?></li><?php endforeach; ?>
        </ul>
      </div>
      <div class="inc-box inc-no">
        <h3>Not included</h3>
        <ul>
          <?php foreach ($PKG_EXCLUDED as $i): ?><li><?php echo e($i); ?></li><?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>

<section class="qband" id="quote">
  <div class="wrap">
    <div>
      <h2>Enquire about this package</h2>
      <p>Send us your dates and group size. We will confirm availability and the total cost on WhatsApp.</p>
    </div>

    <div class="qbox">
      <div class="qgrid">
        <div class="fld qfull">
          <label>Package</label>
          <input type="text" value="<?php echo e($p['nights'] . ' — ' . $p['short']); ?>" readonly style="background:#f7f8fa">
        </div>
        <div class="fld">
          <label for="q-date">Start date</label>
          <input type="date" id="q-date">
        </div>
        <div class="fld">
          <label for="q-pax">Travellers</label>
          <input type="number" id="q-pax" min="1" max="60" placeholder="How many">
        </div>
        <div class="fld">
          <label for="q-veh">Vehicle</label>
          <select id="q-veh">
            <option value="">Any / not sure</option>
            <option>Sedan &mdash; 4 seats</option>
            <option>SUV &mdash; 6-7 seats</option>
            <option>Tempo Traveller &mdash; 12-17 seats</option>
            <option>Mini bus</option>
          </select>
        </div>
        <div class="fld">
          <label for="q-stay">Need stay arranged?</label>
          <select id="q-stay">
            <option>No, only vehicle</option>
            <option>Yes, hotel</option>
            <option>Yes, tent city</option>
            <option>Not decided yet</option>
          </select>
        </div>
        <div class="fld">
          <label for="q-name">Your name</label>
          <input type="text" id="q-name" placeholder="Name">
        </div>
        <div class="fld">
          <label for="q-mob">Mobile number</label>
          <input type="tel" id="q-mob" placeholder="10-digit number">
        </div>
        <div class="fld qfull">
          <label for="q-msg">Anything else? (optional)</label>
          <textarea id="q-msg" placeholder="Pickup point, timings, anything you want added to the plan"></textarea>
        </div>
        <div class="qfull err" id="q-err"></div>
        <div class="qfull">
          <button class="btn btn-wa btn-block" id="q-send"><i class="fa fa-whatsapp"></i> Send on WhatsApp</button>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">OTHER OPTIONS</div>
      <h2>Compare the other tours</h2>
    </div>
    <div class="g4">
      <?php foreach ($PACKAGES as $o): if ($o['code'] === $p['code']) continue; ?>
        <div class="pcard">
          <?php photo($o['image'], e($o['title']), '&#127957;'); ?>
          <div class="b">
            <h3><?php echo e($o['nights']); ?></h3>
            <div class="dur"><?php echo e($o['short']); ?></div>
            <div class="foot">
              <span class="price">From <b>&#8377;<?php echo money($o['price']); ?></b></span>
              <a href="package-detail?p=<?php echo e($o['code']); ?>" class="more">Details &rarr;</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<style>
.pkg-covers{list-style:none}
.pkg-covers li{font-size:14.5px;padding:8px 0 8px 24px;position:relative;border-bottom:1px solid #f3f4f6;color:#39415a}
.pkg-covers li:last-child{border-bottom:none}
.pkg-covers li::before{content:"\25B8";position:absolute;left:2px;color:var(--gold);font-weight:700}
</style>

<script>
(function(){
  var err=document.getElementById('q-err');
  function v(id){ var el=document.getElementById(id); return el ? el.value.trim() : ''; }
  ['q-date','q-pax','q-veh','q-stay','q-name','q-mob','q-msg'].forEach(function(id){
    var el=document.getElementById(id);
    if(el) el.addEventListener('input',function(){ err.classList.remove('show'); });
  });
  document.getElementById('q-send').addEventListener('click',function(){
    var date=v('q-date'),pax=v('q-pax'),veh=v('q-veh'),stay=v('q-stay'),
        name=v('q-name'),mob=v('q-mob').replace(/\D/g,''),msg=v('q-msg');
    if(mob.length<10){ err.textContent='Enter a valid 10-digit mobile number.'; err.classList.add('show'); return; }
    err.classList.remove('show');
    var m='Hi, I am interested in a Kutch tour package.\n';
    m+='\nPackage: <?php echo addslashes($p['nights'] . ' - ' . $p['short']); ?>';
    if(date) m+='\nStart date: '+date;
    if(pax) m+='\nTravellers: '+pax;
    if(veh) m+='\nVehicle: '+veh.replace(/\u2014/g,'-');
    m+='\nStay needed: '+stay;
    if(name) m+='\nName: '+name;
    m+='\nMobile: '+mob;
    if(msg) m+='\nNote: '+msg;
    window.open('https://wa.me/<?php echo BIZ_WA; ?>?text='+encodeURIComponent(m),'_blank');
  });
})();
</script>

<?php include 'footer.php'; ?>
