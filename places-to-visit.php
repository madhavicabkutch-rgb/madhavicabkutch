<?php
$page_title    = "Top Places to Visit in Kutch from Bhuj | Madhavi Cab";
$page_desc     = "Top places to visit in Kutch from Bhuj: White Rann, Dholavira, Kalo Dungar & Mandvi Beach. Distances, timings & cab booking from Bhuj. Call +91 81288 07488.";
$page_keywords = "places to visit in kutch, tourist places in kutch, kutch sightseeing from bhuj, white rann of kutch, dholavira kutch, mandvi beach bhuj";
$active        = "places";

$places_list_schema = array(
    '@context' => 'https://schema.org',
    '@type' => 'ItemList',
    'name' => 'Top Places to Visit in Kutch',
    'description' => 'Famous tourist destinations and sightseeing spots in Kutch, Gujarat reachable by cab from Bhuj.',
    'itemListElement' => array(
        array('@type' => 'ListItem', 'position' => 1, 'name' => 'White Desert (Great Rann of Kutch)'),
        array('@type' => 'ListItem', 'position' => 2, 'name' => 'Dholavira UNESCO Harappan Civilization Site'),
        array('@type' => 'ListItem', 'position' => 3, 'name' => 'Kalo Dungar (Highest Point in Kutch)'),
        array('@type' => 'ListItem', 'position' => 4, 'name' => 'Mandvi Beach & Vijay Vilas Palace'),
        array('@type' => 'ListItem', 'position' => 5, 'name' => 'Aina Mahal & Prag Mahal (Bhuj)'),
        array('@type' => 'ListItem', 'position' => 6, 'name' => 'Road to Heaven (Khadir Bet)')
    )
);
$page_schema = '<script type="application/ld+json">' . json_encode($places_list_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';

include 'header.php';

$places = fetch_all("SELECT * FROM places WHERE is_active=1 ORDER BY sort_order ASC, id ASC");
?>

<section class="phero">
  <div class="wrap">
    <div class="crumb"><a href="./">Home</a> &rsaquo; Places to visit</div>
    <span class="tag">Explore Kutch</span>
    <h1>Places to visit in Kutch &mdash; sightseeing from Bhuj</h1>
    <p>Discover top tourist attractions in Kutch with distances from Bhuj, route timings, and cab booking fares. From the iconic White Rann of Kutch and Harappan ruins at Dholavira to Kalo Dungar, Mandvi Beach, and Aina Mahal &mdash; plan your perfect Kutch sightseeing tour with Madhavi Cab.</p>
    <div class="cta">
      <a href="fixed-kutch-tour-package" class="btn btn-gold">See tour packages</a>
      <a href="<?php echo wa_link('Hi, I want to plan a sightseeing trip in Kutch.'); ?>" class="btn btn-ghost" target="_blank" rel="noopener">Plan a trip</a>
    </div>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <?php if (count($places)): ?>
      <div class="sec-head">
        <div class="kick">DESTINATIONS</div>
        <h2>Top sightseeing destinations in Kutch by cab</h2>
        <p>All distances are one way from Bhuj city. Most can be combined into a single day, and your driver will suggest the best order.</p>
      </div>

      <div class="g4">
        <?php foreach ($places as $pl): ?>
          <a href="place-detail?slug=<?php echo e($pl['slug']); ?>" class="plcard">
            <?php photo($pl['image'], e($pl['title']) . ' in Kutch', '&#127963;'); ?>
            <div class="b">
              <h3><?php echo e($pl['title']); ?></h3>
              <div class="dist">
                <?php echo $pl['distance_bhuj'] ? e($pl['distance_bhuj']) . ' from Bhuj' : 'In Kutch'; ?>
                <?php if ($pl['category']): ?> &middot; <?php echo e($pl['category']); ?><?php endif; ?>
              </div>
            </div>
          </a>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="sec-head">
        <h2>Places are being added</h2>
        <p>We are updating this section. In the meantime, call <a href="tel:<?php echo BIZ_PHONE; ?>" class="more"><?php echo BIZ_PHONE_D; ?></a> and we will tell you what is worth seeing on your dates.</p>
      </div>
    <?php endif; ?>
  </div>
</section>

<section class="sec sec-grey">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">PLANNING TIPS</div>
      <h2>Getting around Kutch</h2>
    </div>
    <div class="g3">
      <div class="inc-box">
        <h3>Distances are long</h3>
        <p style="font-size:14.5px;color:var(--muted)">Kutch is the largest district in India. Dholavira alone is a five hour drive each way from Bhuj, so pair the far places with a full day rather than squeezing them in.</p>
      </div>
      <div class="inc-box">
        <h3>Public transport is thin</h3>
        <p style="font-size:14.5px;color:var(--muted)">Buses run between the main towns but rarely to the sights themselves, and almost never at the timings you would want for a sunset. A private vehicle is the practical way to cover Kutch.</p>
      </div>
      <div class="inc-box">
        <h3>Carry a photo ID</h3>
        <p style="font-size:14.5px;color:var(--muted)">The White Rann, Kalo Dungar and the border areas need a permit that is checked at the checkpost. It is quick to get, but every traveller needs an ID on them.</p>
      </div>
    </div>
  </div>
</section>

<section class="qband">
  <div class="wrap">
    <div>
      <h2>Tell us where you want to go</h2>
      <p>Send us the places on your list and your travel dates. We will suggest the right order, the right vehicle and the total cost.</p>
    </div>
    <div class="qbox">
      <div class="qgrid">
        <div class="fld qfull">
          <label for="q-places">Places you want to cover</label>
          <input type="text" id="q-places" placeholder="White Rann, Dholavira, Mandvi">
        </div>
        <div class="fld">
          <label for="q-date">Travel date</label>
          <input type="date" id="q-date">
        </div>
        <div class="fld">
          <label for="q-pax">Travellers</label>
          <input type="number" id="q-pax" min="1" max="60" placeholder="How many">
        </div>
        <div class="fld">
          <label for="q-name">Your name</label>
          <input type="text" id="q-name" placeholder="Name">
        </div>
        <div class="fld">
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

<script>
(function(){
  var err=document.getElementById('q-err');
  function v(id){ var el=document.getElementById(id); return el ? el.value.trim() : ''; }
  ['q-places','q-date','q-pax','q-name','q-mob'].forEach(function(id){
    var el=document.getElementById(id);
    if(el) el.addEventListener('input',function(){ err.classList.remove('show'); });
  });
  document.getElementById('q-send').addEventListener('click',function(){
    var pls=v('q-places'),date=v('q-date'),pax=v('q-pax'),
        name=v('q-name'),mob=v('q-mob').replace(/\D/g,'');
    if(!pls){ err.textContent='Enter the places you want to cover.'; err.classList.add('show'); return; }
    if(mob.length<10){ err.textContent='Enter a valid 10-digit mobile number.'; err.classList.add('show'); return; }
    err.classList.remove('show');
    var m='Hi, I want to plan a sightseeing trip in Kutch.\n';
    m+='\nPlaces: '+pls;
    if(date) m+='\nDate: '+date;
    if(pax) m+='\nTravellers: '+pax;
    if(name) m+='\nName: '+name;
    m+='\nMobile: '+mob;
    window.open('https://wa.me/<?php echo BIZ_WA; ?>?text='+encodeURIComponent(m),'_blank');
  });
})();
</script>

<?php include 'footer.php'; ?>
