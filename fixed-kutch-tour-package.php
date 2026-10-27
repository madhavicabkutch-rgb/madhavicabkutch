<?php
require_once __DIR__ . '/packages-data.php';

$page_title    = "Kutch Tour Packages from Bhuj | Rann Utsav Tours | Madhavi Cab";
$page_desc     = "Book Kutch tour packages from Bhuj. 1N to 4N trips covering White Rann, Dholavira & Mandvi with cab and driver included. Best rates. Call +91 81288 07488.";
$page_keywords = "kutch tour packages from bhuj, rann utsav tour package, kutch holiday packages, rann of kutch tour, dholavira tour package, kutch sightseeing package";
$active        = "packages";

$pkg_schema_items = array();
$pos = 1;
foreach ($PACKAGES as $code => $pitem) {
    $pkg_schema_items[] = array(
        '@type' => 'TouristTrip',
        'position' => $pos++,
        'name' => $pitem['title'],
        'description' => $pitem['lead'],
        'touristType' => array('Cultural Tourism', 'Sightseeing'),
        'offers' => array(
            '@type' => 'Offer',
            'price' => (string)$pitem['price'],
            'priceCurrency' => 'INR',
            'availability' => 'https://schema.org/InStock',
            'url' => 'https://madhavicabkutch.com/package-detail?p=' . urlencode($code)
        ),
        'provider' => array(
            '@type' => 'TravelAgency',
            'name' => 'MADHAVI CAB KUTCH',
            'telephone' => '+918128807488',
            'url' => 'https://madhavicabkutch.com/'
        )
    );
}

$catalog_schema = array(
    '@context' => 'https://schema.org',
    '@type' => 'ItemList',
    'name' => 'Kutch Tour Packages by Madhavi Cab',
    'description' => 'Ready-made trips starting from Bhuj covering the White Rann, Dholavira, Mandvi and craft villages.',
    'itemListElement' => $pkg_schema_items
);
$page_schema = '<script type="application/ld+json">' . json_encode($catalog_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';

include 'header.php';
?>

<section class="phero">
  <div class="wrap">
    <div class="crumb"><a href="./">Home</a> &rsaquo; Tour packages</div>
    <span class="tag">Vehicle and driver included</span>
    <h1>Kutch tour packages from Bhuj with cab &amp; driver</h1>
    <p>Ready-made holiday packages built around the best of Kutch &mdash; from a quick overnight sunset trip at the White Rann to a comprehensive 5-day circuit covering Dholavira, Mandvi Beach, and craft villages. Vehicle, local driver and route planning included.</p>
    <div class="cta">
      <a href="#quote" class="btn btn-gold">Plan my trip</a>
      <a href="tel:<?php echo BIZ_PHONE; ?>" class="btn btn-ghost">Call <?php echo BIZ_PHONE_D; ?></a>
    </div>
  </div>
</section>

<div class="qstrip"><div class="wrap in">
  <div class="qi"><i class="fa fa-inr"></i> Price is per vehicle, not per person</div>
  <div class="qi"><i class="fa fa-map-o"></i> Itinerary can be changed</div>
  <div class="qi"><i class="fa fa-bed"></i> Stay arranged on request</div>
</div></div>

<section class="sec">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">CHOOSE YOUR PACKAGE</div>
      <h2>Custom Kutch tour itineraries from Bhuj</h2>
      <p>Every package starts and ends in Bhuj, with pickup from the airport, railway station or your hotel.</p>
    </div>

    <div class="g4">
      <?php foreach ($PACKAGES as $p): ?>
        <div class="pcard">
          <?php photo($p['image'], e($p['title']), '&#127957;'); ?>
          <div class="b">
            <h3><?php echo e($p['nights']); ?></h3>
            <div class="dur"><?php echo e($p['short']); ?></div>
            <ul>
              <?php foreach (array_slice($p['covers'], 0, 3) as $cv): ?>
                <li><?php echo e($cv); ?></li>
              <?php endforeach; ?>
            </ul>
            <div class="foot">
              <span class="price">From <b>&#8377;<?php echo money($p['price']); ?></b></span>
              <a href="package-detail?p=<?php echo e($p['code']); ?>" class="more">Details &rarr;</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="sec sec-grey">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">WHAT IS INCLUDED</div>
      <h2>Included and not included</h2>
      <p>The same terms apply to every package above.</p>
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
    <p class="tbl-note">We can arrange hotel or tent city stay at cost. Tell us your budget and we will suggest options.</p>
  </div>
</section>

<section class="qband" id="quote">
  <div class="wrap">
    <div>
      <h2>Plan your trip</h2>
      <p>Tell us your dates and group size. We will send a day-by-day plan and the total cost on WhatsApp.</p>
    </div>

    <div class="qbox">
      <div class="qgrid">
        <div class="fld">
          <label for="q-pkg">Package</label>
          <select id="q-pkg">
            <?php foreach ($PACKAGES as $p): ?>
              <option><?php echo e($p['nights']); ?> &mdash; <?php echo e($p['short']); ?></option>
            <?php endforeach; ?>
            <option>Custom itinerary</option>
          </select>
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
          <label for="q-date">Start date</label>
          <input type="date" id="q-date">
        </div>
        <div class="fld">
          <label for="q-pax">Travellers</label>
          <input type="number" id="q-pax" min="1" max="60" placeholder="How many">
        </div>
        <div class="fld">
          <label for="q-pick">Pickup point</label>
          <input type="text" id="q-pick" placeholder="Bhuj airport, station or hotel">
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
          <label for="q-msg">Anything specific you want to cover? (optional)</label>
          <textarea id="q-msg" placeholder="Places you must see, elderly travellers or children, food preferences, timings"></textarea>
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
      <div class="kick">QUESTIONS</div>
      <h2>Common questions about tour packages</h2>
    </div>
    <div class="faq">
      <details open>
        <summary>Is the price per person or per vehicle?</summary>
        <div class="ans">Per vehicle, not per head. A group of six in one SUV pays the same as a group of two, so larger groups work out cheaper per person.</div>
      </details>
      <details>
        <summary>Can the itinerary be changed?</summary>
        <div class="ans">Yes. These are starting points, not fixed schedules. Tell us what you want to add or drop and we will rebuild the plan and requote.</div>
      </details>
      <details>
        <summary>Do you arrange hotels and tent city stay?</summary>
        <div class="ans">We can book both at cost. During Rann Utsav the tent city fills up early, so book at least three to four weeks ahead.</div>
      </details>
      <details>
        <summary>What is the best time to visit Kutch?</summary>
        <div class="ans">November to February has the most comfortable weather and covers the Rann Utsav season. The White Rann is at its best on full moon nights.</div>
      </details>
      <details>
        <summary>Do we need a permit for the White Rann?</summary>
        <div class="ans">Yes, a permit is checked at the Bhirandiyara checkpost. It is quick to obtain and your driver will guide you through it. Carry a photo ID.</div>
      </details>
      <details>
        <summary>Are these tours suitable for elderly travellers?</summary>
        <div class="ans">Most are. Distances are moderate and the vehicle stays with you throughout. Tell us in advance and we will keep the daily driving shorter with more breaks.</div>
      </details>
      <details>
        <summary>Can you pick us up from Ahmedabad instead of Bhuj?</summary>
        <div class="ans">Yes. Pickup from Ahmedabad, Rajkot or Gandhidham can be added to any package, quoted separately based on the distance.</div>
      </details>
    </div>
  </div>
</section>

<script>
(function(){
  var err=document.getElementById('q-err');
  function v(id){ var el=document.getElementById(id); return el ? el.value.trim() : ''; }
  ['q-pkg','q-veh','q-date','q-pax','q-pick','q-stay','q-name','q-mob','q-msg'].forEach(function(id){
    var el=document.getElementById(id);
    if(el) el.addEventListener('input',function(){ err.classList.remove('show'); });
  });
  document.getElementById('q-send').addEventListener('click',function(){
    var pkg=v('q-pkg'),veh=v('q-veh'),date=v('q-date'),pax=v('q-pax'),
        pick=v('q-pick'),stay=v('q-stay'),name=v('q-name'),
        mob=v('q-mob').replace(/\D/g,''),msg=v('q-msg');
    if(mob.length<10){ err.textContent='Enter a valid 10-digit mobile number.'; err.classList.add('show'); return; }
    err.classList.remove('show');
    var m='Hi, I want to book a Kutch tour package.\n';
    m+='\nPackage: '+pkg.replace(/\u2014/g,'-');
    if(veh) m+='\nVehicle: '+veh.replace(/\u2014/g,'-');
    if(date) m+='\nStart date: '+date;
    if(pax) m+='\nTravellers: '+pax;
    if(pick) m+='\nPickup: '+pick;
    m+='\nStay needed: '+stay;
    if(name) m+='\nName: '+name;
    m+='\nMobile: '+mob;
    if(msg) m+='\nNote: '+msg;
    window.open('https://wa.me/<?php echo BIZ_WA; ?>?text='+encodeURIComponent(m),'_blank');
  });
})();
</script>

<?php include 'footer.php'; ?>
