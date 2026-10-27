<?php
require_once __DIR__ . '/config.php';

$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';
$pl   = null;

if ($slug !== '' && DB_OK) {
    $st = $conn->prepare("SELECT * FROM places WHERE slug = ? AND is_active = 1 LIMIT 1");
    if ($st) {
        $st->bind_param('s', $slug);
        $st->execute();
        $pl = $st->get_result()->fetch_assoc();
        $st->close();
    }
}

if (!$pl) {
    $page_title = "Place not found | Madhavi Cab Kutch";
    $page_desc  = "The place you are looking for is not available.";
    $active     = "places";
    include 'header.php';
    ?>
    <section class="phero">
      <div class="wrap">
        <h1>Place not found</h1>
        <p>The page you are looking for is not available. Have a look at everything worth seeing in Kutch.</p>
        <div class="cta">
          <a href="places-to-visit" class="btn btn-gold">All places in Kutch</a>
        </div>
      </div>
    </section>
    <?php
    include 'footer.php';
    exit;
}

$page_title    = $pl['title'] . " in Kutch | Sightseeing from Bhuj | Madhavi Cab";
$page_desc     = "Visit " . $pl['title'] . " in Kutch. Distance from Bhuj, timings, route tips and cab booking with experienced driver. Call +91 81288 07488.";
$page_keywords = strtolower($pl['title']) . " kutch, " . strtolower($pl['title']) . " from bhuj, places to visit in kutch, kutch sightseeing cab";
$active        = "places";
$canonical     = SITE_URL . '/place-detail?slug=' . urlencode($pl['slug']);
$og_image   = !empty($pl['image']) ? (strpos($pl['image'], 'http') === 0 ? $pl['image'] : SITE_URL . '/' . ltrim($pl['image'], '/')) : (SITE_URL . '/assets/img/og-image.jpg');

$place_schema_data = array(
    '@context' => 'https://schema.org',
    '@type' => 'TouristAttraction',
    'name' => $pl['title'],
    'description' => !empty($pl['short_desc']) ? $pl['short_desc'] : ($pl['title'] . ' tourist attraction in Kutch, Gujarat.'),
    'url' => $canonical,
    'image' => $og_image,
    'isAccessibleForFree' => true,
    'publicAccess' => true,
    'address' => array(
        '@type' => 'PostalAddress',
        'addressLocality' => 'Kutch',
        'addressRegion' => 'Gujarat',
        'addressCountry' => 'IN'
    ),
    'provider' => array(
        '@type' => 'TaxiService',
        'name' => BIZ_NAME,
        'telephone' => BIZ_PHONE,
        'url' => SITE_URL . '/'
    )
);
$page_schema = '<script type="application/ld+json">' . json_encode($place_schema_data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';

include 'header.php';

$others = fetch_all("SELECT * FROM places WHERE is_active=1 AND id <> " . (int)$pl['id'] . " ORDER BY sort_order ASC, id ASC LIMIT 4");
$waMsg  = 'Hi, I want to visit ' . $pl['title'] . '. Please share the cab fare from Bhuj.';
?>

<section class="phero">
  <div class="wrap">
    <div class="crumb"><a href="./">Home</a> &rsaquo; <a href="places-to-visit">Places to visit</a> &rsaquo; <?php echo e($pl['title']); ?></div>
    <?php if ($pl['category']): ?><span class="tag"><?php echo e($pl['category']); ?></span><?php endif; ?>
    <h1><?php echo e($pl['title']); ?></h1>
    <?php if ($pl['short_desc']): ?><p><?php echo e($pl['short_desc']); ?></p><?php endif; ?>
    <div class="cta">
      <a href="<?php echo wa_link($waMsg); ?>" class="btn btn-gold" target="_blank" rel="noopener"><i class="fa fa-whatsapp"></i> Book a cab for this trip</a>
      <a href="tel:<?php echo BIZ_PHONE; ?>" class="btn btn-ghost">Call <?php echo BIZ_PHONE_D; ?></a>
    </div>
  </div>
</section>

<div class="qstrip"><div class="wrap in">
  <div class="qi"><i class="fa fa-map-marker"></i> <?php echo $pl['distance_bhuj'] ? e($pl['distance_bhuj']) . ' from Bhuj' : 'In Kutch'; ?></div>
  <div class="qi"><i class="fa fa-calendar"></i> <?php echo $pl['best_time'] ? e($pl['best_time']) : 'Open all year'; ?></div>
  <div class="qi"><i class="fa fa-car"></i> Cab and driver available 24&times;7</div>
</div></div>

<section class="sec">
  <div class="wrap">
    <div class="place-body">
      <?php if (has_img($pl['image'])): ?>
        <div class="place-hero"><img src="assets/img/<?php echo e($pl['image']); ?>" alt="<?php echo e($pl['title']); ?> in Kutch - Cab Sightseeing Tour from Bhuj" loading="lazy"></div>
      <?php endif; ?>

      <?php if ($pl['description']): ?>
        <?php foreach (preg_split('/\r\n|\r|\n/', $pl['description']) as $para): ?>
          <?php $para = trim($para); if ($para === '') continue; ?>
          <p class="place-p"><?php echo e($para); ?></p>
        <?php endforeach; ?>
      <?php endif; ?>

      <div class="place-facts">
        <div>
          <span class="pf-l">Distance from Bhuj</span>
          <span class="pf-v"><?php echo $pl['distance_bhuj'] ? e($pl['distance_bhuj']) : 'Within Kutch'; ?></span>
        </div>
        <div>
          <span class="pf-l">Best time to visit</span>
          <span class="pf-v"><?php echo $pl['best_time'] ? e($pl['best_time']) : 'All year'; ?></span>
        </div>
        <div>
          <span class="pf-l">Type</span>
          <span class="pf-v"><?php echo $pl['category'] ? e($pl['category']) : 'Sightseeing'; ?></span>
        </div>
        <div>
          <span class="pf-l">Getting there</span>
          <span class="pf-v">Private cab from Bhuj</span>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="qband" id="quote">
  <div class="wrap">
    <div>
      <h2>Book a cab to <?php echo e($pl['title']); ?></h2>
      <p>Tell us your date and how many people are travelling. We will send the fare and the vehicle options on WhatsApp.</p>
    </div>
    <div class="qbox">
      <div class="qgrid">
        <div class="fld">
          <label for="q-pick">Pickup point</label>
          <input type="text" id="q-pick" placeholder="Bhuj, hotel or address">
        </div>
        <div class="fld">
          <label for="q-date">Travel date</label>
          <input type="date" id="q-date">
        </div>
        <div class="fld">
          <label for="q-veh">Vehicle</label>
          <select id="q-veh">
            <option value="">Any / not sure</option>
            <option>Sedan &mdash; 4 seats</option>
            <option>SUV &mdash; 6-7 seats</option>
            <option>Tempo Traveller &mdash; 12-17 seats</option>
          </select>
        </div>
        <div class="fld">
          <label for="q-pax">Travellers</label>
          <input type="number" id="q-pax" min="1" max="60" placeholder="How many">
        </div>
        <div class="fld qfull">
          <label for="q-mob">Mobile number</label>
          <input type="tel" id="q-mob" placeholder="10-digit number">
        </div>
        <div class="qfull err" id="q-err"></div>
        <div class="qfull">
          <button class="btn btn-wa btn-block" id="q-send"><i class="fa fa-whatsapp"></i> Send on WhatsApp</button>
        </div>
      </div>
    </div>
  </div>
</section>

<?php if (count($others)): ?>
<section class="sec">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">NEARBY</div>
      <h2>Other places in Kutch</h2>
    </div>
    <div class="g4">
      <?php foreach ($others as $o): ?>
        <a href="place-detail?slug=<?php echo e($o['slug']); ?>" class="plcard">
          <?php photo($o['image'], e($o['title']) . ' in Kutch', '&#127963;'); ?>
          <div class="b">
            <h3><?php echo e($o['title']); ?></h3>
            <div class="dist"><?php echo $o['distance_bhuj'] ? e($o['distance_bhuj']) . ' from Bhuj' : 'In Kutch'; ?></div>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<style>
.place-body{max-width:820px}
.place-hero{border-radius:12px;overflow:hidden;margin-bottom:24px;border:1px solid var(--line)}
.place-hero img{width:100%;height:auto;display:block}
.place-p{font-size:16px;color:#39415a;line-height:1.85;margin-bottom:16px}
.place-facts{display:grid;grid-template-columns:repeat(2,1fr);gap:1px;background:var(--line);border:1px solid var(--line);border-radius:12px;overflow:hidden;margin-top:28px}
.place-facts>div{background:#fff;padding:16px 18px}
.pf-l{display:block;font-size:12px;letter-spacing:.8px;color:var(--muted);text-transform:uppercase;margin-bottom:3px}
.pf-v{display:block;font-size:15.5px;font-weight:500}
@media(max-width:760px){ .place-facts{grid-template-columns:1fr} .place-p{font-size:15px} }
</style>

<script>
(function(){
  var err=document.getElementById('q-err');
  function v(id){ var el=document.getElementById(id); return el ? el.value.trim() : ''; }
  ['q-pick','q-date','q-veh','q-pax','q-mob'].forEach(function(id){
    var el=document.getElementById(id);
    if(el) el.addEventListener('input',function(){ err.classList.remove('show'); });
  });
  document.getElementById('q-send').addEventListener('click',function(){
    var pick=v('q-pick'),date=v('q-date'),veh=v('q-veh'),
        pax=v('q-pax'),mob=v('q-mob').replace(/\D/g,'');
    if(mob.length<10){ err.textContent='Enter a valid 10-digit mobile number.'; err.classList.add('show'); return; }
    err.classList.remove('show');
    var m='Hi, I want to visit <?php echo addslashes($pl['title']); ?>.\n';
    if(pick) m+='\nPickup: '+pick;
    if(date) m+='\nDate: '+date;
    if(veh) m+='\nVehicle: '+veh.replace(/\u2014/g,'-');
    if(pax) m+='\nTravellers: '+pax;
    m+='\nMobile: '+mob;
    window.open('https://wa.me/<?php echo BIZ_WA; ?>?text='+encodeURIComponent(m),'_blank');
  });
})();
</script>

<?php include 'footer.php'; ?>
