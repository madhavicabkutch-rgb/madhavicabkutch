<?php
$page_title    = "One Way Taxi from Bhuj to Ahmedabad & Rajkot | Madhavi Cab";
$page_desc     = "One way taxi from Bhuj to Ahmedabad, Rajkot, Dholavira, Mandvi and across Gujarat. Pay for one side only, no return fare. Fixed rates. Call +91 81288 07488.";
$page_keywords = "one way taxi from bhuj, bhuj to ahmedabad taxi, bhuj to rajkot cab, one way drop bhuj, outstation cab bhuj, one way cab gujarat";
$active        = "oneway";

$oneway_schema = array(
    '@context' => 'https://schema.org',
    '@type' => 'TaxiService',
    'name' => 'One Way Taxi Service from Bhuj',
    'description' => 'One way taxi drops from Bhuj to Ahmedabad, Rajkot, Dholavira, Mandvi and across Gujarat with no return fare charged.',
    'provider' => array(
        '@type' => 'TaxiService',
        'name' => 'MADHAVI CAB KUTCH',
        'telephone' => '+918128807488',
        'url' => 'https://madhavicabkutch.com/'
    ),
    'areaServed' => array(
        array('@type' => 'City', 'name' => 'Bhuj'),
        array('@type' => 'City', 'name' => 'Ahmedabad'),
        array('@type' => 'City', 'name' => 'Rajkot'),
        array('@type' => 'City', 'name' => 'Gandhidham'),
        array('@type' => 'AdministrativeArea', 'name' => 'Gujarat')
    ),
    'hasOfferCatalog' => array(
        '@type' => 'OfferCatalog',
        'name' => 'One Way Taxi Routes from Bhuj',
        'itemListElement' => array(
            array(
                '@type' => 'Offer',
                'itemOffered' => array('@type' => 'Service', 'name' => 'Bhuj to Ahmedabad One Way Taxi'),
                'price' => '6500',
                'priceCurrency' => 'INR'
            ),
            array(
                '@type' => 'Offer',
                'itemOffered' => array('@type' => 'Service', 'name' => 'Bhuj to Rajkot One Way Taxi'),
                'price' => '4500',
                'priceCurrency' => 'INR'
            ),
            array(
                '@type' => 'Offer',
                'itemOffered' => array('@type' => 'Service', 'name' => 'Bhuj to Dholavira Taxi'),
                'price' => '5000',
                'priceCurrency' => 'INR'
            )
        )
    )
);
$page_schema = '<script type="application/ld+json">' . json_encode($oneway_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';

include 'header.php';

$routes = fetch_all("SELECT * FROM routes WHERE is_active=1 ORDER BY sort_order ASC, id ASC");
?>

<section class="phero">
  <div class="wrap">
    <div class="crumb"><a href="./">Home</a> &rsaquo; One way taxi</div>
    <span class="tag">One way drop service</span>
    <h1>One way taxi from Bhuj across Gujarat</h1>
    <p>Travelling one side only? You should never pay for the driver's return trip. Madhavi Cab provides reliable one way cab drops from Bhuj to Ahmedabad, Rajkot, Vadodara, Surat, Dholavira, Mandvi and across Gujarat. Pay only for one side journey at affordable fixed rates.</p>
    <div class="cta">
      <a href="#quote" class="btn btn-gold">Get a fare quote</a>
      <a href="tel:<?php echo BIZ_PHONE; ?>" class="btn btn-ghost">Call <?php echo BIZ_PHONE_D; ?></a>
    </div>
  </div>
</section>

<div class="qstrip"><div class="wrap in">
  <div class="qi"><i class="fa fa-inr"></i> No return fare charged</div>
  <div class="qi"><i class="fa fa-map-marker"></i> Pickup anywhere in Kutch</div>
  <div class="qi"><i class="fa fa-clock-o"></i> Night departures available</div>
</div></div>

<!-- FARE TABLE -->
<section class="sec">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">FARES</div>
      <h2>One way cab fares from Bhuj</h2>
      <p>All-inclusive of fuel, driver allowance and vehicle charges. Toll, parking and state permit are billed separately at actuals.</p>
    </div>

    <?php if (count($routes)): ?>
    <div class="tbl-wrap">
      <table>
        <thead>
          <tr><th>Route</th><th>Distance</th><th>Time</th><th>Sedan</th><th>SUV</th><th>Tempo</th><th></th></tr>
        </thead>
        <tbody>
        <?php foreach ($routes as $r): ?>
          <tr>
            <td><?php echo e($r['from_city']); ?> &rarr; <?php echo e($r['to_city']); ?></td>
            <td class="km"><?php echo $r['distance_km'] ? (int)$r['distance_km'] . ' km' : '&mdash;'; ?></td>
            <td class="km"><?php echo $r['duration'] ? e($r['duration']) : '&mdash;'; ?></td>
            <td class="fare">&#8377;<?php echo money($r['sedan_fare']); ?></td>
            <td class="fare">&#8377;<?php echo money($r['suv_fare']); ?></td>
            <td class="fare">&#8377;<?php echo money($r['tempo_fare']); ?></td>
            <td><a class="book" target="_blank" rel="noopener"
                   href="<?php echo wa_link('Hi, I need a one way taxi from ' . $r['from_city'] . ' to ' . $r['to_city'] . '.'); ?>">Book &rarr;</a></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <p class="tbl-note">Route not listed? Send us the pickup and drop point on WhatsApp and we will quote it the same day.</p>
    <?php else: ?>
    <p class="tbl-note">Fares are updated regularly. Call <a href="tel:<?php echo BIZ_PHONE; ?>" class="more"><?php echo BIZ_PHONE_D; ?></a> or message us on WhatsApp for the current rate on your route.</p>
    <?php endif; ?>
  </div>
</section>

<!-- QUOTE -->
<section class="qband" id="quote">
  <div class="wrap">
    <div>
      <h2>Tell us your route</h2>
      <p>Any pickup and drop point, any date. Fill this in and it reaches us on WhatsApp with your details already typed out.</p>
    </div>

    <div class="qbox">
      <div class="qgrid">
        <div class="fld">
          <label for="q-pick">Pickup point</label>
          <input type="text" id="q-pick" placeholder="Bhuj, hotel or address">
        </div>
        <div class="fld">
          <label for="q-drop">Drop point</label>
          <input type="text" id="q-drop" placeholder="City or address">
        </div>
        <div class="fld">
          <label for="q-date">Travel date</label>
          <input type="date" id="q-date">
        </div>
        <div class="fld">
          <label for="q-time">Pickup time</label>
          <input type="time" id="q-time">
        </div>
        <div class="fld">
          <label for="q-veh">Vehicle</label>
          <select id="q-veh">
            <option value="">Any / not sure</option>
            <option>Sedan &mdash; 4 seats</option>
            <option>SUV &mdash; 6-7 seats</option>
            <option>Tempo Traveller &mdash; 12-17 seats</option>
            <option>Bus</option>
          </select>
        </div>
        <div class="fld">
          <label for="q-pax">Passengers</label>
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
        <div class="fld qfull">
          <label for="q-msg">Anything else? (optional)</label>
          <textarea id="q-msg" placeholder="Stops on the way, luggage, return trip, flight or train timing"></textarea>
        </div>
        <div class="qfull err" id="q-err"></div>
        <div class="qfull">
          <button class="btn btn-wa btn-block" id="q-send"><i class="fa fa-whatsapp"></i> Send on WhatsApp</button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- WHY ONE WAY COSTS LESS -->
<section class="sec">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">HOW IT WORKS</div>
      <h2>Why a one way drop costs less</h2>
      <p>A quick look at how the two booking types differ, using the same route and the same car.</p>
    </div>
    <div class="g2">
      <div class="inc-box">
        <h3>One way drop</h3>
        <p style="font-size:14.5px;color:var(--muted);margin-bottom:14px">You are charged for the distance you actually travel. The driver finds a return passenger on his own, so that cost never reaches your bill.</p>
        <p style="font-size:15px;padding-top:13px;border-top:1px solid var(--line)">Bhuj to Ahmedabad, sedan &mdash; <b style="font-family:'Outfit',sans-serif;font-size:20px;color:var(--ink)">&#8377;4,500</b></p>
      </div>
      <div class="inc-box">
        <h3>Round trip</h3>
        <p style="font-size:14.5px;color:var(--muted);margin-bottom:14px">The vehicle waits and brings you back, so both sides of the journey plus the driver night allowance are charged to you.</p>
        <p style="font-size:15px;padding-top:13px;border-top:1px solid var(--line)">Bhuj to Ahmedabad and back, sedan &mdash; <b style="font-family:'Outfit',sans-serif;font-size:20px;color:var(--ink)">&#8377;8,500</b></p>
      </div>
    </div>
    <p class="tbl-note">Planning to return within a day or two? Ask us for both fares. Sometimes a round trip works out cheaper than two separate one way bookings.</p>
  </div>
</section>

<!-- INCLUDED -->
<section class="sec sec-grey">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">WHAT THE FARE COVERS</div>
      <h2>Included and charged separately</h2>
    </div>
    <div class="g2">
      <div class="inc-box inc-yes">
        <h3>Included</h3>
        <ul>
          <li>Fuel for the full journey</li>
          <li>Driver allowance and food</li>
          <li>Vehicle maintenance and insurance</li>
          <li>Pickup from your doorstep in Bhuj</li>
          <li>One short refreshment stop on long routes</li>
        </ul>
      </div>
      <div class="inc-box inc-no">
        <h3>Charged separately</h3>
        <ul>
          <li>Toll charges at actuals</li>
          <li>Parking charges where applicable</li>
          <li>State border permit on interstate routes</li>
          <li>Extra stops or detours added on the way</li>
          <li>Waiting beyond 30 minutes at pickup</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- VEHICLES -->
<section class="sec">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">CHOOSE YOUR VEHICLE</div>
      <h2>Fares above are quoted for these</h2>
      <p>Buses and larger vehicles are quoted on request.</p>
    </div>
    <div class="g3">
      <div class="vcard">
        <?php photo('sedan.jpg','Sedan for one way taxi from Bhuj','&#128663;','contain'); ?>
        <div class="b">
          <h3>Sedan</h3>
          <div class="meta">Swift Dzire, Etios &middot; 4 seats &middot; 2 bags</div>
          <p>Best value for two to four passengers with normal luggage. Comfortable on the long highway runs to Ahmedabad and Rajkot.</p>
        </div>
      </div>
      <div class="vcard">
        <?php photo('suv.jpg','SUV for one way taxi from Bhuj','&#128665;','contain'); ?>
        <div class="b">
          <h3>SUV</h3>
          <div class="meta">Ertiga, Innova &middot; 6-7 seats &middot; 4 bags</div>
          <p>Extra legroom and boot space for families. The usual pick for Rann and Dholavira routes with rougher stretches.</p>
        </div>
      </div>
      <div class="vcard">
        <?php photo('tempo-traveller.jpg','Tempo traveller for group one way travel','&#128652;','contain'); ?>
        <div class="b">
          <h3>Tempo Traveller</h3>
          <div class="meta">12-17 seats &middot; pushback seats</div>
          <p>For group travel, corporate transfers and wedding parties moving between cities in one vehicle.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="sec sec-grey">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">QUESTIONS</div>
      <h2>Common questions about one way taxi</h2>
    </div>
    <div class="faq">
      <details open>
        <summary>Is the fare fixed or per kilometre?</summary>
        <div class="ans">Listed routes are fixed-fare. You are quoted one number before travel and that is what you pay, apart from toll and parking. Routes not on the list are quoted per kilometre.</div>
      </details>
      <details>
        <summary>Can I be picked up from outside Bhuj?</summary>
        <div class="ans">Yes. We operate across Kutch, so pickups from Gandhidham, Anjar, Mandvi, Bhachau and nearby towns are routine. The fare adjusts for the pickup point.</div>
      </details>
      <details>
        <summary>Do I have to pay in advance?</summary>
        <div class="ans">No online advance is needed for most bookings. Payment is made to the driver at the end of the trip, in cash or by UPI.</div>
      </details>
      <details>
        <summary>What if I need to stop on the way?</summary>
        <div class="ans">Short refreshment stops are part of the trip. Sightseeing detours add distance, so tell us in advance and we include it in the quote.</div>
      </details>
      <details>
        <summary>Can I book a one way drop late at night?</summary>
        <div class="ans">Yes, we run 24x7. Night departures between 10 pm and 6 am carry a small driver night charge on long routes.</div>
      </details>
      <details>
        <summary>Do you handle airport and railway station drops?</summary>
        <div class="ans">Yes, from Bhuj airport, Bhuj station and Gandhidham station, and drops to Ahmedabad airport. Share your flight or train number and we track it.</div>
      </details>
      <details>
        <summary>How do I cancel a booking?</summary>
        <div class="ans">Message us on WhatsApp. Cancellations made more than six hours before pickup carry no charge.</div>
      </details>
    </div>
  </div>
</section>

<script>
(function(){
  var err=document.getElementById('q-err');
  function v(id){ var el=document.getElementById(id); return el ? el.value.trim() : ''; }
  ['q-pick','q-drop','q-date','q-time','q-veh','q-pax','q-name','q-mob','q-msg'].forEach(function(id){
    var el=document.getElementById(id);
    if(el) el.addEventListener('input',function(){ err.classList.remove('show'); });
  });
  document.getElementById('q-send').addEventListener('click',function(){
    var pick=v('q-pick'),drop=v('q-drop'),date=v('q-date'),time=v('q-time'),
        veh=v('q-veh'),pax=v('q-pax'),name=v('q-name'),
        mob=v('q-mob').replace(/\D/g,''),msg=v('q-msg');
    if(!pick||!drop){ err.textContent='Enter your pickup and drop point.'; err.classList.add('show'); return; }
    if(mob.length<10){ err.textContent='Enter a valid 10-digit mobile number.'; err.classList.add('show'); return; }
    err.classList.remove('show');
    var m='Hi, I need a one way taxi fare.\n';
    m+='\nPickup: '+pick;
    m+='\nDrop: '+drop;
    if(date) m+='\nDate: '+date;
    if(time) m+='\nTime: '+time;
    if(veh) m+='\nVehicle: '+veh.replace(/\u2014/g,'-');
    if(pax) m+='\nPassengers: '+pax;
    if(name) m+='\nName: '+name;
    m+='\nMobile: '+mob;
    if(msg) m+='\nNote: '+msg;
    window.open('https://wa.me/<?php echo BIZ_WA; ?>?text='+encodeURIComponent(m),'_blank');
  });
})();
</script>

<?php include 'footer.php'; ?>
