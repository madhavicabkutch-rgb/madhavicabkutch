<?php
/* ============================================================
   Madhavi Cab — Vehicle Rental
   Vehicle cards are controlled from Admin > Vehicles.
   Database mapping:
     category = Vehicle Type (Car / Bus / Premium)
     models   = Vehicle Category (Sedan / SUV / Tempo Traveller etc.)
============================================================ */

$valid = array('Car','Bus','Premium');
$type = isset($_GET['type']) ? trim($_GET['type']) : 'Car';
if (!in_array($type, $valid, true)) $type = 'Car';

$copy = array(
  'Car' => array(
    'tag'=>'Cars on rent with driver',
    'h1'=>'Car rental in Bhuj with driver',
    'lead'=>'Affordable sedan and SUV car rental in Bhuj with experienced local drivers. Ideal for local Bhuj city sightseeing, outstation drops across Gujarat and multi-day Rann of Kutch tours.',
    'title'=>'Car Rental in Bhuj, Kutch | Sedan & SUV on Rent | Madhavi Cab',
    'desc'=>'Book car rental in Bhuj with driver. Clean sedans (Swift Dzire) and SUVs (Innova Crysta, Ertiga) for local, outstation and Kutch tours. Call +91 81288 07488.',
    'keywords'=>'car rental in bhuj, car hire bhuj, sedan on rent bhuj, innova crysta rental bhuj, ertiga cab bhuj, outstation car rental kutch',
    'wa'=>'Hi, I want to rent a car in Bhuj.'
  ),
  'Bus' => array(
    'tag'=>'Tempo travellers & mini buses',
    'h1'=>'Tempo traveller & bus rental in Bhuj, Kutch',
    'lead'=>'12 to 25 seater AC tempo travellers and luxury mini buses for family group vacations, wedding guest movements, corporate trips and school tours across Kutch.',
    'title'=>'Tempo Traveller & Bus on Rent in Bhuj, Kutch | Madhavi Cab',
    'desc'=>'Hire AC Tempo Traveller & Bus on rent in Bhuj, Kutch. 12, 17, 20 & 25 seater luxury tempo travellers for weddings, group tours and Rann Utsav. Call +91 81288 07488.',
    'keywords'=>'tempo traveller on rent bhuj, bus rental bhuj, tempo traveller hire kutch, 17 seater tempo traveller bhuj, mini bus hire bhuj',
    'wa'=>'Hi, I want to rent a bus or tempo traveller in Bhuj.'
  ),
  'Premium' => array(
    'tag'=>'Luxury & wedding cars',
    'h1'=>'Luxury & wedding car rental in Bhuj, Kutch',
    'lead'=>'Premium chauffeur-driven cars including Toyota Fortuner and Innova Crysta for weddings, VIP corporate delegations and high-comfort touring in Kutch.',
    'title'=>'Luxury & Wedding Car Rental in Bhuj, Kutch | Madhavi Cab',
    'desc'=>'Chauffeur-driven luxury car rental in Bhuj for weddings, VIP delegates and corporate tours. Toyota Fortuner & Innova Crysta at fixed rates. Call +91 81288 07488.',
    'keywords'=>'luxury car rental bhuj, wedding car hire bhuj, fortuner on rent bhuj, vip cab service kutch, premium car rental bhuj',
    'wa'=>'Hi, I want to book a premium car in Bhuj.'
  )
);
$c = $copy[$type];

$page_title    = $c['title'];
$page_desc     = $c['desc'];
$page_keywords = $c['keywords'];
$active        = 'rental';

$rental_schema = array(
    '@context' => 'https://schema.org',
    '@type' => 'Service',
    'serviceType' => $c['tag'],
    'name' => $c['h1'],
    'description' => $c['desc'],
    'provider' => array(
        '@type' => 'AutoRental',
        'name' => 'MADHAVI CAB KUTCH',
        'telephone' => '+918128807488',
        'url' => 'https://madhavicabkutch.com/'
    ),
    'areaServed' => array(
        array('@type' => 'City', 'name' => 'Bhuj'),
        array('@type' => 'AdministrativeArea', 'name' => 'Kutch'),
        array('@type' => 'AdministrativeArea', 'name' => 'Gujarat')
    ),
    'offers' => array(
        '@type' => 'Offer',
        'priceCurrency' => 'INR',
        'availability' => 'https://schema.org/InStock',
        'url' => 'https://madhavicabkutch.com/vehicle-rental'
    )
);
$page_schema = '<script type="application/ld+json">' . json_encode($rental_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';

include 'header.php';

$vehicles = fetch_all(
  "SELECT * FROM vehicles
   WHERE is_active=1
   AND category='" . $type . "'
   ORDER BY sort_order ASC, id ASC"
);
?>

<section class="phero">
  <div class="wrap">
    <div class="crumb"><a href="./">Home</a> &rsaquo; Vehicle rental</div>
    <span class="tag"><?php echo e($c['tag']); ?></span>
    <h1><?php echo e($c['h1']); ?></h1>
    <p><?php echo e($c['lead']); ?></p>
    <div class="cta">
      <a href="#quote" class="btn btn-gold">Check availability</a>
      <a href="tel:<?php echo BIZ_PHONE; ?>" class="btn btn-ghost">Call <?php echo BIZ_PHONE_D; ?></a>
    </div>
  </div>
</section>

<section class="sec">
  <div class="wrap">

    <!-- Category Filter Tabs -->
    <div class="vtabs-wrap">
      <div class="vtabs-bar">
        <a href="vehicle-rental?type=Car" class="vt-pill <?php echo $type==='Car'?'on':''; ?>">
          <i class="fa fa-car"></i>
          <span>Sedans &amp; SUVs</span>
          <span class="vt-badge">Popular</span>
        </a>
        <a href="vehicle-rental?type=Bus" class="vt-pill <?php echo $type==='Bus'?'on':''; ?>">
          <i class="fa fa-bus"></i>
          <span>Tempo &amp; Buses</span>
          <span class="vt-badge">Group Tour</span>
        </a>
        <a href="vehicle-rental?type=Premium" class="vt-pill <?php echo $type==='Premium'?'on':''; ?>">
          <i class="fa fa-star"></i>
          <span>VIP &amp; Luxury</span>
          <span class="vt-badge">Executive</span>
        </a>
      </div>
    </div>

    <?php if (count($vehicles)): ?>
      <div class="g3">
      <?php foreach ($vehicles as $v): ?>
        <?php
          $name = trim($v['name']);
          $image = trim($v['image']);
          $wa_text = 'Hi, I want to book a ' . $name . ' (12 hrs / 300 km package) on rent in Bhuj.';

          $has_local_12  = ($v['local_12h_300km_ac'] !== null && $v['local_12h_300km_ac'] !== '');
          $has_local_12n = ($v['local_12h_300km_nonac'] !== null && $v['local_12h_300km_nonac'] !== '');
          $has_per_km = ($v['per_km'] !== null && $v['per_km'] !== '');
          $has_airport = ($v['airport_transfer'] !== null && $v['airport_transfer'] !== '');
          $has_night = ($v['driver_night_allowance'] !== null && $v['driver_night_allowance'] !== '');
          $has_daily_min = ($v['daily_min_km'] !== null && $v['daily_min_km'] !== '');

          $display_rate = $has_local_12
            ? '&#8377;' . e($v['local_12h_300km_ac']) . ' <small style="font-size:10.5px;font-weight:600">/ 12h &bull; 300km</small>'
            : ($has_per_km ? '&#8377;' . e($v['per_km']) . '/km' : 'Best Rates');
        ?>
        <article class="vcard-pro">
          <div class="vcard-pro-head">
            <span class="vcard-type-tag"><i class="fa fa-check-circle"></i> Verified Cab</span>
            <span class="vcard-price-tag"><?php echo $display_rate; ?></span>
            <?php
              if ($image) {
                photo($image, $name . ' on rent in Bhuj', '&#128663;', 'contain');
              } else {
                echo '<div style="font-size:48px">&#128663;</div>';
              }
            ?>
          </div>

          <div class="vcard-pro-body">
            <div class="vcard-title-row">
              <h3><?php echo e($name); ?></h3>
              <div class="vcard-models"><?php echo e(!empty($v['models']) ? $v['models'] : $name); ?></div>
            </div>

            <!-- 12 Hours / 300 KM Prime Package Highlight -->
            <?php if ($has_local_12): ?>
              <div class="v-main-pkg">
                <div class="v-main-pkg-info">
                  <span class="v-main-pkg-tag"><i class="fa fa-star"></i> Recommended Package</span>
                  <span class="v-main-pkg-title">12 Hours / 300 KM</span>
                </div>
                <div class="v-main-pkg-price">
                  <strong>&#8377;<?php echo e($v['local_12h_300km_ac']); ?></strong>
                  <span>A/C Fixed Rate</span>
                </div>
              </div>
            <?php endif; ?>

            <!-- Feature Chips -->
            <div class="v-chips-grid">
              <span class="v-chip"><i class="fa fa-users"></i> <?php echo e(!empty($v['seats']) ? $v['seats'] : '4-5'); ?> Seats</span>
              <span class="v-chip"><i class="fa fa-briefcase"></i> <?php echo e(!empty($v['luggage']) ? $v['luggage'] : 'Luggage Boot'); ?></span>
              <span class="v-chip"><i class="fa fa-snowflake-o"></i> AC &amp; Heater</span>
              <span class="v-chip"><i class="fa fa-shield"></i> Clean &amp; Sanitized</span>
            </div>

            <?php if (!empty($v['description'])): ?>
              <p class="vcard-desc"><?php echo nl2br(e($v['description'])); ?></p>
            <?php endif; ?>

            <!-- Local Bhuj Rates Table (12h / 300km) -->
            <?php if ($has_local_12 || $has_local_12n): ?>
              <div class="v-rate-block">
                <div class="v-rate-header"><i class="fa fa-map-marker"></i> Day Rental Package</div>
                <table class="v-rate-tbl">
                  <thead>
                    <tr>
                      <th>Package</th>
                      <th>A/C</th>
                      <th>Non-A/C</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr style="background:#fffbeb">
                      <td><strong style="color:#b45309">&#9733; 12 hrs / 300 km</strong></td>
                      <td><strong style="color:#b45309"><?php echo $has_local_12 ? '&#8377;' . e($v['local_12h_300km_ac']) : '—'; ?></strong></td>
                      <td><strong><?php echo $has_local_12n ? '&#8377;' . e($v['local_12h_300km_nonac']) : '—'; ?></strong></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            <?php endif; ?>

            <!-- Outstation & Extra Charges -->
            <?php if ($has_per_km || $has_daily_min || $has_night || $has_airport): ?>
              <div class="v-extra-pills">
                <?php if ($has_per_km): ?>
                  <div class="v-extra-pill">
                    <span>Outstation</span>
                    <strong>&#8377;<?php echo e($v['per_km']); ?>/km</strong>
                  </div>
                <?php endif; ?>
                <?php if ($has_daily_min): ?>
                  <div class="v-extra-pill">
                    <span>Daily Min.</span>
                    <strong><?php echo e($v['daily_min_km']); ?> km</strong>
                  </div>
                <?php endif; ?>
                <?php if ($has_night): ?>
                  <div class="v-extra-pill">
                    <span>Driver Night</span>
                    <strong>&#8377;<?php echo e($v['driver_night_allowance']); ?></strong>
                  </div>
                <?php endif; ?>
                <?php if ($has_airport): ?>
                  <div class="v-extra-pill">
                    <span>Airport Drop</span>
                    <strong>&#8377;<?php echo e($v['airport_transfer']); ?></strong>
                  </div>
                <?php endif; ?>
              </div>
            <?php endif; ?>

            <!-- Instant Easy Booking Buttons -->
            <div class="v-booking-actions">
              <a href="<?php echo wa_link($wa_text); ?>" class="btn-book-wa" target="_blank" rel="noopener">
                <i class="fa fa-whatsapp"></i> Book on WhatsApp
              </a>
              <a href="tel:<?php echo BIZ_PHONE; ?>" class="btn-book-call">
                <i class="fa fa-phone"></i> Call Now
              </a>
            </div>

          </div>
        </article>
      <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div style="padding:50px 20px;text-align:center">
        <h3>No vehicles available in this category.</h3>
        <p>Please add an active vehicle from Admin &rarr; Vehicles.</p>
        <a class="btn btn-gold" target="_blank" rel="noopener" href="<?php echo wa_link($c['wa']); ?>">Enquire on WhatsApp</a>
      </div>
    <?php endif; ?>

  </div>
</section>

<section class="sec sec-grey">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">WHAT THE RATE COVERS</div>
      <h2>Included and charged separately</h2>
    </div>
    <div class="g2">
      <div class="inc-box inc-yes">
        <h3>Included in the rate</h3>
        <ul>
          <li>Fuel for the full booking</li>
          <li>Driver service</li>
          <li>Vehicle insurance and maintenance</li>
          <li>Air conditioning where applicable</li>
        </ul>
      </div>
      <div class="inc-box inc-no">
        <h3>Charged separately</h3>
        <ul>
          <li>Toll and parking at actuals</li>
          <li>State border permit where applicable</li>
          <li>Driver night allowance on multi-day trips</li>
          <li>Extra kilometres as per the selected vehicle</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section class="sec" id="quote">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">WHATSAPP ENQUIRY</div>
      <h2>Check vehicle availability</h2>
      <p>Send your trip details and we will confirm the vehicle and price on WhatsApp.</p>
    </div>

    <div class="qbox">
      <div class="qgrid">
        <div class="fld">
          <label>Rental type</label>
          <select id="q-type">
            <option>Local — within Bhuj</option>
            <option>One way taxi</option>
            <option>Outstation — one day</option>
            <option>Outstation — multi day</option>
            <option>Airport / station transfer</option>
            <option>Wedding / event</option>
          </select>
        </div>
        <div class="fld">
          <label>Vehicle</label>
          <select id="q-veh">
            <option value="">Any / not sure</option>
            <?php foreach ($vehicles as $v): ?>
              <option><?php echo e($v['name']); ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="fld">
          <label>Start date</label>
          <input type="date" id="q-date">
        </div>
        <div class="fld">
          <label>Number of days</label>
          <input type="number" id="q-days" min="1" placeholder="e.g. 3">
        </div>
        <div class="fld">
          <label>Pickup point</label>
          <input type="text" id="q-pick" placeholder="Bhuj, hotel or address">
        </div>
        <div class="fld">
          <label>Mobile number</label>
          <input type="tel" id="q-mob" placeholder="10-digit number">
        </div>
        <div class="fld qfull">
          <label>Where do you plan to travel?</label>
          <input type="text" id="q-msg" placeholder="e.g. Bhuj to White Rann / Kutch tour">
        </div>
      </div>
      <div class="err" id="q-err"></div>
      <button class="btn btn-wa" id="q-send" type="button">Send on WhatsApp</button>
    </div>
  </div>
</section>


<style>
/* Vehicle image consistency: show the complete vehicle without cropping */
.mv-vehicle-card > .ph,
.mv-vehicle-card .ph {
  height: 230px !important;
  min-height: 230px !important;
  overflow: hidden !important;
  background: #fff !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
}

.mv-vehicle-card > .ph img,
.mv-vehicle-card .ph img {
  width: 100% !important;
  height: 100% !important;
  max-width: 100% !important;
  max-height: 100% !important;
  object-fit: contain !important;
  object-position: center center !important;
  display: block !important;
}

.mv-vehicle-card .b{padding-top:18px}
.mv-description{color:#53627a;line-height:1.6;margin:10px 0 16px}
.mv-rate-title{
  font-size:13px;font-weight:800;text-transform:uppercase;letter-spacing:.06em;
  color:#17233d;margin:18px 0 8px
}
.mv-rate-table{
  border:1px solid #e5e8ee;border-radius:10px;overflow:hidden;background:#fff
}
.mv-rate-row{
  display:grid;grid-template-columns:1.5fr 1fr 1fr;gap:8px;
  padding:9px 11px;border-top:1px solid #edf0f4;
  font-size:13px;align-items:center
}
.mv-rate-row:first-child{border-top:0}
.mv-rate-head{
  background:#17233d;color:#fff;font-weight:700;font-size:12px
}
.mv-rate-row strong{font-weight:700;color:#17233d}
.mv-extra-grid{
  display:grid;grid-template-columns:1fr 1fr;gap:8px
}
.mv-extra-item{
  border:1px solid #e5e8ee;border-radius:9px;padding:9px 10px;
  background:#fafbfc;display:flex;flex-direction:column;gap:3px
}
.mv-extra-item span,.mv-extra-km span:first-child{
  font-size:11px;color:#718096
}
.mv-extra-item strong{font-size:13px;color:#17233d}
.mv-extra-km{
  display:flex;flex-wrap:wrap;gap:12px;margin-top:9px;padding:9px 10px;
  background:#fff8e8;border-radius:9px;font-size:12px;color:#53627a
}
.mv-extra-km strong{color:#17233d}
.mv-foot{margin-top:17px;padding-top:14px;border-top:1px solid #edf0f4}
@media(max-width:700px){
  .mv-vehicle-card > .ph,
  .mv-vehicle-card .ph {
    height: 190px !important;
    min-height: 190px !important;
  }

  .mv-rate-row{grid-template-columns:1.35fr 1fr 1fr;font-size:12px;padding:8px}
  .mv-extra-grid{grid-template-columns:1fr}
}
</style>

<script>
(function(){
  function v(id){var e=document.getElementById(id);return e?e.value.trim():'';}
  var btn=document.getElementById('q-send'), err=document.getElementById('q-err');
  if(!btn)return;
  btn.addEventListener('click',function(){
    var mob=v('q-mob').replace(/\D/g,'');
    if(!v('q-pick')){err.textContent='Enter your pickup point.';err.classList.add('show');return;}
    if(mob.length<10){err.textContent='Enter a valid 10-digit mobile number.';err.classList.add('show');return;}
    err.classList.remove('show');

    var m='Hi, I want to rent a vehicle.';
    m+='\nRental type: '+v('q-type');
    if(v('q-veh'))m+='\nVehicle: '+v('q-veh');
    if(v('q-date'))m+='\nStart date: '+v('q-date');
    if(v('q-days'))m+='\nDays: '+v('q-days');
    m+='\nPickup: '+v('q-pick');
    m+='\nMobile: '+mob;
    if(v('q-msg'))m+='\nPlan: '+v('q-msg');

    window.open('https://wa.me/<?php echo BIZ_WA; ?>?text='+encodeURIComponent(m),'_blank');
  });
})();
</script>

<?php include 'footer.php'; ?>
