<?php
$page_title    = "Car Rental in Bhuj & Taxi Service in Kutch | Madhavi Cab";
$page_desc     = "Book car rental and taxi in Bhuj, Kutch with driver. Sedans, SUVs, tempo travellers for local, outstation & Rann Utsav tours. 24x7. Call +91 81288 07488.";
$page_keywords = "car rental in bhuj, taxi service in bhuj, cab service in kutch, one way taxi bhuj, kutch tour packages, car hire bhuj, tempo traveller rental kutch";
$active        = "home";
include 'header.php';

$homeRoutes = fetch_all("SELECT * FROM routes WHERE is_active=1 AND show_on_home=1 ORDER BY sort_order ASC, id ASC LIMIT 6");
$homePlaces = fetch_all("SELECT * FROM places WHERE is_active=1 ORDER BY sort_order ASC, id ASC LIMIT 4");
?>


<style>
/* =========================
   MADHAVI CABS — HERO SLIDER
   ========================= */
.hero{
  position:relative;
  height:clamp(500px, 66vh, 680px) !important;
  min-height:500px !important;
  overflow:hidden;
  background:#0d172c;
}

.hero .slide{
  position:absolute !important;
  inset:0 !important;
  width:100% !important;
  height:100% !important;
  display:flex !important;
  align-items:center !important;
  background-size:cover !important;
  background-repeat:no-repeat !important;
  background-position:center center !important;
  opacity:0 !important;
  visibility:hidden !important;
  transition:opacity .65s ease, visibility .65s ease !important;
}

.hero .slide.on{
  opacity:1 !important;
  visibility:visible !important;
}

.hero .slide::before{
  content:"" !important;
  position:absolute !important;
  inset:0 !important;
  z-index:0 !important;
  background:
    linear-gradient(90deg,
      rgba(7,16,35,.82) 0%,
      rgba(7,16,35,.62) 34%,
      rgba(7,16,35,.24) 64%,
      rgba(7,16,35,.08) 100%) !important;
}

.hero .slide::after{
  content:"" !important;
  position:absolute !important;
  inset:0 !important;
  z-index:0 !important;
  background:linear-gradient(180deg,rgba(5,12,27,.12) 0%,rgba(5,12,27,0) 45%,rgba(5,12,27,.28) 100%) !important;
  pointer-events:none !important;
}

.hero .slide .wrap{
  position:relative !important;
  z-index:2 !important;
  width:min(1180px, calc(100% - 48px)) !important;
  margin:0 auto !important;
}

.hero .slide .c{
  max-width:680px !important;
  padding:42px 0 76px !important;
}

.hero .slide .tag{
  display:inline-flex !important;
  align-items:center !important;
  gap:8px !important;
  margin:0 0 22px !important;
  padding:9px 15px !important;
  border:1px solid rgba(245,170,31,.42) !important;
  border-radius:999px !important;
  background:rgba(245,170,31,.12) !important;
  color:#ffb21b !important;
  font-size:13px !important;
  font-weight:800 !important;
  letter-spacing:.09em !important;
  text-transform:uppercase !important;
  backdrop-filter:blur(5px) !important;
}

.hero .slide h1,
.hero .slide h2{
  margin:0 !important;
  max-width:690px !important;
  color:#fff !important;
  font-size:clamp(42px, 5vw, 72px) !important;
  line-height:1.02 !important;
  letter-spacing:-.045em !important;
  font-weight:800 !important;
  text-wrap:balance !important;
  text-shadow:0 3px 22px rgba(0,0,0,.28) !important;
}

/* No hero sub-headline */
.hero .slide p{
  display:none !important;
}

.hero .slide .cta{
  display:flex !important;
  flex-wrap:wrap !important;
  gap:12px !important;
  margin-top:30px !important;
}

.hero .slide .cta .btn{
  min-height:52px !important;
  padding:0 23px !important;
  border-radius:9px !important;
  display:inline-flex !important;
  align-items:center !important;
  justify-content:center !important;
  font-size:15px !important;
  font-weight:800 !important;
  text-decoration:none !important;
  transition:transform .2s ease, box-shadow .2s ease, background .2s ease !important;
}

.hero .slide .cta .btn:hover{
  transform:translateY(-2px) !important;
}

.hero .slide .btn-gold{
  background:#f6a91a !important;
  color:#111827 !important;
  box-shadow:0 10px 28px rgba(246,169,26,.24) !important;
}

.hero .slide .btn-ghost{
  background:rgba(255,255,255,.08) !important;
  border:1px solid rgba(255,255,255,.72) !important;
  color:#fff !important;
  backdrop-filter:blur(6px) !important;
}

.hero .dots{
  position:absolute !important;
  z-index:5 !important;
  left:50% !important;
  bottom:24px !important;
  transform:translateX(-50%) !important;
  display:flex !important;
  align-items:center !important;
  gap:8px !important;
}

.hero .dots button,
.hero .dots span{
  width:28px !important;
  height:4px !important;
  border:0 !important;
  border-radius:99px !important;
  background:rgba(255,255,255,.38) !important;
  padding:0 !important;
}

.hero .dots .on,
.hero .dots .active{
  background:#f6a91a !important;
  width:36px !important;
}

@media (max-width: 900px){
  .hero{
    height:570px !important;
    min-height:570px !important;
  }

  .hero .slide{
    background-position:62% center !important;
  }

  .hero .slide::before{
    background:
      linear-gradient(90deg,
        rgba(7,16,35,.86) 0%,
        rgba(7,16,35,.68) 48%,
        rgba(7,16,35,.30) 100%) !important;
  }

  .hero .slide .wrap{
    width:min(100% - 36px, 680px) !important;
  }

  .hero .slide .c{
    max-width:560px !important;
    padding:28px 0 66px !important;
  }

  .hero .slide h1,
  .hero .slide h2{
    font-size:clamp(38px, 8vw, 56px) !important;
    line-height:1.05 !important;
  }
}

@media (max-width: 600px){
  .hero{
    height:560px !important;
    min-height:560px !important;
  }

  .hero .slide{
    align-items:flex-end !important;
    background-position:65% center !important;
  }

  .hero .slide::before{
    background:
      linear-gradient(180deg,
        rgba(7,16,35,.12) 0%,
        rgba(7,16,35,.28) 34%,
        rgba(7,16,35,.90) 72%,
        rgba(7,16,35,.96) 100%) !important;
  }

  .hero .slide .wrap{
    width:calc(100% - 32px) !important;
  }

  .hero .slide .c{
    max-width:100% !important;
    padding:0 0 62px !important;
  }

  .hero .slide .tag{
    margin-bottom:14px !important;
    padding:8px 12px !important;
    font-size:11px !important;
  }

  .hero .slide h1,
  .hero .slide h2{
    max-width:100% !important;
    font-size:36px !important;
    line-height:1.04 !important;
    letter-spacing:-.035em !important;
  }

  .hero .slide .cta{
    margin-top:22px !important;
    gap:9px !important;
  }

  .hero .slide .cta .btn{
    min-height:48px !important;
    padding:0 17px !important;
    font-size:14px !important;
    border-radius:8px !important;
  }

  .hero .dots{
    bottom:19px !important;
  }
}

@media (max-width: 380px){
  .hero{
    height:535px !important;
    min-height:535px !important;
  }

  .hero .slide h1,
  .hero .slide h2{
    font-size:32px !important;
  }

  .hero .slide .cta .btn{
    padding:0 14px !important;
  }
}
</style>

<!-- HERO -->
<section class="hero" id="hero">
  <div class="slide on" style="<?php echo slide_bg('slide1.jpg'); ?>">
    <div class="wrap"><div class="c">
      <span class="tag">Trusted Cab Service in Bhuj</span>
      <h1>Car Rental in Bhuj &amp; Taxi Service in Kutch</h1>
      <div class="cta">
        <a href="vehicle-rental" class="btn btn-gold">Get Fare on WhatsApp</a>
        <a href="#quote" class="btn btn-ghost">Enquire Now</a>
      </div>
    </div></div>
  </div>

  <div class="slide" style="<?php echo slide_bg('slide2.jpg'); ?>">
    <div class="wrap"><div class="c">
      <span class="tag">One Way Drop Service</span>
      <h2>One Way Taxi from Bhuj Across Gujarat</h2>
      <div class="cta">
        <a href="one-way-taxi" class="btn btn-gold">Check One Way Fare</a>
        <a href="#quote" class="btn btn-ghost">Enquire Now</a>
      </div>
    </div></div>
  </div>

  <div class="slide" style="<?php echo slide_bg('slide3.jpg'); ?>">
    <div class="wrap"><div class="c">
      <span class="tag">Outstation &amp; Kutch Tour</span>
      <h2>Outstation Cabs &amp; Kutch Tour Packages &mdash; 24&times;7</h2>
      <div class="cta">
        <a href="vehicle-rental" class="btn btn-gold">Choose Your Car</a>
        <a href="#quote" class="btn btn-ghost">Get Fare on WhatsApp</a>
      </div>
    </div></div>
  </div>

  <div class="dots" id="dots"></div>
</section>

<!-- QUICK STRIP -->
<div class="qstrip"><div class="wrap in">
  <div class="qi"><i class="fa fa-phone"></i> Call / WhatsApp: <?php echo BIZ_PHONE_D; ?></div>
  <div class="qi"><i class="fa fa-inr"></i> Fixed fares, no hidden charges</div>
  <div class="qi"><i class="fa fa-clock-o"></i> Available 24 / 7</div>
</div></div>

<!-- FLEET -->
<section class="sec" id="vehicles">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">OUR FLEET</div>
      <h2>Vehicles on Rent in Bhuj, Kutch</h2>
      <p>From local city cabs in Bhuj to outstation trips and Rann of Kutch group tours &mdash; choose clean, sanitized cars with verified local drivers.</p>
    </div>

    <div class="g3">
      <div class="vcard">
        <?php photo('sedan.jpg', 'Sedan car rental in Bhuj with driver - Swift Dzire', '&#128663;', 'contain'); ?>
        <div class="b">
          <h3>Cars</h3>
          <div class="meta">Swift Dzire, Ertiga, Innova Crysta</div>
          <p>The everyday choice for families and business travel. Comfortable on highways, easy through Bhuj traffic.</p>
          <div class="foot">
            <span class="price">From <b>&#8377;12</b><span>/km</span></span>
            <a href="vehicle-rental?type=Car" class="more">View rates &rarr;</a>
          </div>
        </div>
      </div>

      <div class="vcard">
        <?php photo('tempo-traveller.jpg', 'Tempo traveller and bus rental in Bhuj Kutch', '&#128652;', 'contain'); ?>
        <div class="b">
          <h3>Buses</h3>
          <div class="meta">Tempo traveller, mini bus, 32 seater</div>
          <p>Keeps a whole group in one vehicle. Common for weddings, corporate travel and school trips across Gujarat.</p>
          <div class="foot">
            <span class="price">From <b>&#8377;45</b><span>/km</span></span>
            <a href="vehicle-rental?type=Bus" class="more">View rates &rarr;</a>
          </div>
        </div>
      </div>

      <div class="vcard">
        <?php photo('suv.jpg', 'SUV and luxury car hire in Bhuj - Innova Crysta & Fortuner', '&#128665;', 'contain'); ?>
        <div class="b">
          <h3>Premium</h3>
          <div class="meta">Innova Crysta, Fortuner, wedding cars</div>
          <p>For weddings, VIP guests and corporate visitors who want a cleaner, quieter and roomier ride.</p>
          <div class="foot">
            <span class="price">On request</span>
            <a href="vehicle-rental?type=Premium" class="more">View rates &rarr;</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ONE WAY ROUTES -->
<?php if (count($homeRoutes)): ?>
<section class="sec sec-grey">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">ONE WAY TAXI</div>
      <h2>Popular One Way Taxi Routes from Bhuj</h2>
      <p>Single-side drop fares across Gujarat. You are not charged for the driver's return journey. Toll and parking extra at actuals.</p>
    </div>

    <div class="tbl-wrap">
      <table>
        <thead>
          <tr><th>Route</th><th>Km</th><th>Sedan</th><th>SUV</th><th>Tempo</th><th></th></tr>
        </thead>
        <tbody>
        <?php foreach ($homeRoutes as $r): ?>
          <tr>
            <td><?php echo e($r['from_city']); ?> &rarr; <?php echo e($r['to_city']); ?></td>
            <td class="km"><?php echo $r['distance_km'] ? (int)$r['distance_km'] : '&mdash;'; ?></td>
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
    <p class="tbl-note"><a href="one-way-taxi" class="more">View all routes and fares &rarr;</a></p>
  </div>
</section>
<?php endif; ?>

<!-- QUOTE -->
<section class="qband" id="quote">
  <div class="wrap">
    <div>
      <h2>Get a quick quote</h2>
      <p>Fill this in and it reaches us on WhatsApp with your details already typed out. We reply within minutes, and no advance payment is needed.</p>
    </div>

    <div class="qbox">
      <div class="qgrid">
        <div class="fld">
          <label for="q-serv">What do you need?</label>
          <select id="q-serv">
            <option>Car rental</option>
            <option>One way taxi</option>
            <option>Bus or tempo traveller</option>
            <option>Airport or station transfer</option>
            <option>Kutch tour package</option>
          </select>
        </div>
        <div class="fld">
          <label for="q-veh">Vehicle</label>
          <select id="q-veh">
            <option value="">Any / not sure</option>
            <option>Sedan &mdash; 4 seats</option>
            <option>SUV &mdash; 6-7 seats</option>
            <option>Tempo traveller &mdash; 12-17 seats</option>
            <option>Bus</option>
            <option>Premium car</option>
          </select>
        </div>
        <div class="fld">
          <label for="q-pick">Pickup</label>
          <input type="text" id="q-pick" placeholder="Bhuj, hotel or address">
        </div>
        <div class="fld">
          <label for="q-drop">Drop</label>
          <input type="text" id="q-drop" placeholder="City or address">
        </div>
        <div class="fld">
          <label for="q-date">Travel date</label>
          <input type="date" id="q-date">
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

<!-- REVIEWS -->
<section class="sec">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">GOOGLE REVIEWS</div>
      <h2>Trusted by riders across Kutch &amp; Gujarat</h2>
      <p>Verified reviews from our Google Business profile for <b>MADHAVI CAB KUTCH</b>.</p>
    </div>

    <!-- Google Trust Header -->
    <div class="g-trust-banner">
      <div class="g-trust-left">
        <svg class="g-logo-svg" width="36" height="36" viewBox="0 0 24 24" style="width:36px!important;height:36px!important;min-width:36px!important;max-width:36px!important;flex-shrink:0;display:block;"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/></svg>
        <div>
          <div class="g-trust-score">5.0 / 5.0</div>
          <div class="g-stars-row">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
          <div class="g-trust-meta">Rated 5.0 stars on Google &middot; Authentic Customer Feedback</div>
        </div>
      </div>
      <div class="g-trust-btns">
        <a href="<?php echo GOOGLE_REVIEW_URL; ?>" target="_blank" rel="noopener" class="btn btn-gold btn-sm"><i class="fa fa-pencil"></i> Write a Review</a>
        <a href="<?php echo GOOGLE_REVIEW_URL; ?>" target="_blank" rel="noopener" class="btn btn-ghost btn-sm"><i class="fa fa-google"></i> View all Google Reviews &rarr;</a>
      </div>
    </div>

    <!-- Live Trustindex Google Reviews Widget -->
    <div class="trustindex-live-reviews" style="margin-top: 24px; min-height: 150px; width: 100%;">
      <script defer async src="https://cdn.trustindex.io/loader.js?431171984499453598967001b42"></script>
    </div>
  </div>
</section>

<!-- WHY US -->
<section class="sec sec-grey">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">WHY MADHAVI CAB</div>
      <h2>Why Book Taxi in Bhuj with Madhavi Cab?</h2>
    </div>
    <div class="g4">
      <div class="why"><i class="fa fa-inr"></i><h3>Fixed fares</h3><p>Quoted once and charged the same. Nothing added at drop-off except toll and parking.</p></div>
      <div class="why"><i class="fa fa-user"></i><h3>Local drivers</h3><p>Kutch men who know every road, shortcut and the right time to leave for the Rann.</p></div>
      <div class="why"><i class="fa fa-clock-o"></i><h3>On time, 24&times;7</h3><p>Early morning airport and station pickups are routine for us, not a favour.</p></div>
      <div class="why"><i class="fa fa-check-circle"></i><h3>Clean vehicles</h3><p>Serviced weekly, cleaned before every trip, air conditioning always working.</p></div>
    </div>
  </div>
</section>

<!-- PACKAGES -->
<section class="sec">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">FIXED PACKAGES</div>
      <h2>Kutch Tour Packages with Cab &amp; Driver</h2>
      <p>Ready-made trips covering the White Rann, Dholavira, Mandvi and the craft villages &mdash; vehicle, driver and stay arranged together.</p>
    </div>

    <div class="g4">
      <div class="pcard">
        <?php photo('white-rann.jpg', '1 night 2 days Kutch tour package from Bhuj', '&#127957;'); ?>
        <div class="b">
          <h3>1 Night 2 Days</h3>
          <div class="dur">White Rann &amp; Bhuj</div>
          <ul><li>White Rann sunset at Dhordo</li><li>Kalo Dungar viewpoint</li><li>Bhuj city sightseeing</li></ul>
          <div class="foot">
            <span class="price">From <b>&#8377;4,900</b></span>
            <a href="package-detail?p=1n2d" class="more">Details &rarr;</a>
          </div>
        </div>
      </div>

      <div class="pcard">
        <?php photo('dholavira.jpg', '2 nights 3 days Kutch Dholavira tour package', '&#127961;'); ?>
        <div class="b">
          <h3>2 Nights 3 Days</h3>
          <div class="dur">+ Dholavira</div>
          <ul><li>Harappan site at Dholavira</li><li>Road to Heaven</li><li>White Rann and Bhuj</li></ul>
          <div class="foot">
            <span class="price">From <b>&#8377;9,000</b></span>
            <a href="package-detail?p=2n3d" class="more">Details &rarr;</a>
          </div>
        </div>
      </div>

      <div class="pcard">
        <?php photo('mandvi.jpg', '3 nights 4 days Kutch and Mandvi tour package', '&#127958;'); ?>
        <div class="b">
          <h3>3 Nights 4 Days</h3>
          <div class="dur">+ Mandvi beach</div>
          <ul><li>Mandvi beach and Vijay Vilas</li><li>Dholavira and White Rann</li><li>Craft villages of Kutch</li></ul>
          <div class="foot">
            <span class="price">From <b>&#8377;13,200</b></span>
            <a href="package-detail?p=3n4d" class="more">Details &rarr;</a>
          </div>
        </div>
      </div>

      <div class="pcard">
        <?php photo('rann-utsav.jpg', '4 nights 5 days complete Kutch tour package', '&#9978;'); ?>
        <div class="b">
          <h3>4 Nights 5 Days</h3>
          <div class="dur">+ Mata Na Madh</div>
          <ul><li>Complete Kutch circuit</li><li>Mata Na Madh and Narayan Sarovar</li><li>Mandvi, Dholavira, White Rann</li></ul>
          <div class="foot">
            <span class="price">From <b>&#8377;17,000</b></span>
            <a href="package-detail?p=4n5d" class="more">Details &rarr;</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- PLACES -->
<?php if (count($homePlaces)): ?>
<section class="sec sec-grey">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">EXPLORE KUTCH</div>
      <h2>Top Places to Visit in Kutch by Cab</h2>
      <p>The spots our drivers are asked for most. Tell us where you want to go and we will build the route around it.</p>
    </div>

    <div class="g4">
      <?php foreach ($homePlaces as $pl): ?>
        <a href="place-detail?slug=<?php echo e($pl['slug']); ?>" class="plcard">
          <?php photo($pl['image'], e($pl['title']) . ' in Kutch', '&#127963;'); ?>
          <div class="b">
            <h3><?php echo e($pl['title']); ?></h3>
            <div class="dist"><?php echo $pl['distance_bhuj'] ? e($pl['distance_bhuj']) . ' from Bhuj' : 'In Kutch'; ?></div>
          </div>
        </a>
      <?php endforeach; ?>
    </div>

    <p class="tbl-note"><a href="places-to-visit" class="more">See all places in Kutch &rarr;</a></p>
  </div>
</section>
<?php endif; ?>

<!-- FAQS -->
<section class="sec">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">FREQUENTLY ASKED QUESTIONS</div>
      <h2>Cab Booking &amp; Car Rental FAQs in Bhuj</h2>
      <p>Common questions travelers ask about our car rental, one way taxi and Kutch tour packages.</p>
    </div>

    <div class="faq">
      <details open>
        <summary>How do I book a cab with Madhavi Cab Kutch?</summary>
        <div class="ans">You can book instantly by calling <a href="tel:<?php echo BIZ_PHONE; ?>"><?php echo BIZ_PHONE_D; ?></a> or sending your pickup point, drop location, and date on WhatsApp. We provide upfront fixed fare quotes within minutes with zero advance payment needed.</div>
      </details>

      <details>
        <summary>Are one-way taxi fares charged for return travel?</summary>
        <div class="ans">No. Our one-way taxi drops (such as Bhuj to Ahmedabad, Rajkot, or Mandvi) cover one direction only. You never pay for the vehicle's return trip.</div>
      </details>

      <details>
        <summary>Do you provide cabs for the White Rann (Dhordo) and Dholavira?</summary>
        <div class="ans">Yes. We operate daily sightseeing cabs and tour packages covering the White Rann at Dhordo, Kalo Dungar viewpoint, the Road to Heaven, and the Dholavira UNESCO World Heritage site.</div>
      </details>

      <details>
        <summary>Are toll taxes, parking, and driver charges included?</summary>
        <div class="ans">Fuel, vehicle charges, and driver services are always included in the quote. Toll taxes and parking fees are charged transparently at actual government receipts.</div>
      </details>

      <details>
        <summary>Can I book early morning pickups from Bhuj Airport or Railway Station?</summary>
        <div class="ans">Yes. We operate 24 hours a day, 7 days a week. Early morning train and flight arrivals at Bhuj Airport (BHJ) and Bhuj Railway Station are routine for our drivers.</div>
      </details>

      <details>
        <summary>What vehicles do you offer for hire?</summary>
        <div class="ans">We provide comfortable 4-seater sedans (Swift Dzire), 6-7 seater family SUVs (Ertiga, Innova Crysta), luxury wedding cars (Fortuner), and 12-25 seater Tempo Travellers &amp; buses for group tours.</div>
      </details>
    </div>
  </div>
</section>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "How do I book a cab with Madhavi Cab Kutch?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "You can book instantly by calling +91 81288 07488 or sending your pickup point, drop location, and date on WhatsApp. We provide upfront fixed fare quotes within minutes with zero advance payment needed."
      }
    },
    {
      "@type": "Question",
      "name": "Are one-way taxi fares charged for return travel?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "No. Our one-way taxi drops (such as Bhuj to Ahmedabad, Rajkot, or Mandvi) cover one direction only. You never pay for the vehicle's return trip."
      }
    },
    {
      "@type": "Question",
      "name": "Do you provide cabs for the White Rann (Dhordo) and Dholavira?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes. We operate daily sightseeing cabs and tour packages covering the White Rann at Dhordo, Kalo Dungar viewpoint, the Road to Heaven, and the Dholavira UNESCO World Heritage site."
      }
    },
    {
      "@type": "Question",
      "name": "Are toll taxes, parking, and driver charges included?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Fuel, vehicle charges, and driver services are always included in the quote. Toll taxes and parking fees are charged transparently at actual government receipts."
      }
    },
    {
      "@type": "Question",
      "name": "Can I book early morning pickups from Bhuj Airport or Railway Station?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes. We operate 24 hours a day, 7 days a week. Early morning train and flight arrivals at Bhuj Airport (BHJ) and Bhuj Railway Station are routine for our drivers."
      }
    },
    {
      "@type": "Question",
      "name": "What vehicles do you offer for hire in Bhuj?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "We provide comfortable 4-seater sedans (Swift Dzire), 6-7 seater family SUVs (Ertiga, Innova Crysta), luxury wedding cars (Fortuner), and 12-25 seater Tempo Travellers and buses for group tours."
      }
    }
  ]
}
</script>

<!-- LOCATION / GOOGLE MAP -->
<section class="sec sec-grey" id="location">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">LOCATION &amp; OFFICE</div>
      <h2>Visit us in Bhuj, Kutch</h2>
      <p>Conveniently located near Airport Ring Road, Bhuj. Pickup available across all hotels, railway stations, and airport 24&times;7.</p>
    </div>

    <div class="map-card-panel">
      <div class="mcp-info">
        <h3>
          <svg viewBox="0 0 24 24" width="22" height="22" style="vertical-align:middle"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/></svg>
          MADHAVI CAB KUTCH
        </h3>
        <p><?php echo BIZ_STREET; ?>, Bhuj, Gujarat <?php echo BIZ_PIN; ?> &middot; Open 24 Hours</p>
      </div>
      <div class="mcp-btns">
        <a href="<?php echo BIZ_MAP; ?>" target="_blank" rel="noopener" class="btn btn-gold btn-sm"><i class="fa fa-map-marker"></i> Open in Google Maps</a>
        <a href="tel:<?php echo BIZ_PHONE; ?>" class="btn btn-ghost btn-sm"><i class="fa fa-phone"></i> Call Now</a>
      </div>
    </div>
    <div class="map-frame-wrap">
      <iframe src="<?php echo GOOGLE_MAP_EMBED; ?>" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" title="MADHAVI CAB KUTCH Office Location on Google Maps"></iframe>
    </div>
  </div>
</section>

<!-- STATS -->
<section class="stats">
  <div class="wrap">
    <div><div class="stat-n"><?php echo e(setting('stat_years','12+')); ?></div><div class="stat-l">Years running</div></div>
    <div><div class="stat-n"><?php echo e(setting('stat_vehicles','40+')); ?></div><div class="stat-l">Vehicles</div></div>
    <div><div class="stat-n">15+</div><div class="stat-l">Routes covered</div></div>
    <div><div class="stat-n"><?php echo e(setting('stat_support','24×7')); ?></div><div class="stat-l">Support</div></div>
  </div>
</section>

<script>
(function(){
  var err=document.getElementById('q-err');
  function v(id){ return document.getElementById(id).value.trim(); }
  ['q-serv','q-veh','q-pick','q-drop','q-date','q-mob'].forEach(function(id){
    var el=document.getElementById(id);
    if(el) el.addEventListener('input',function(){ err.classList.remove('show'); });
  });
  document.getElementById('q-send').addEventListener('click',function(){
    var serv=v('q-serv'),veh=v('q-veh'),pick=v('q-pick'),drop=v('q-drop'),
        date=v('q-date'),mob=v('q-mob').replace(/\D/g,'');
    if(!pick){ err.textContent='Enter your pickup point.'; err.classList.add('show'); return; }
    if(mob.length<10){ err.textContent='Enter a valid 10-digit mobile number.'; err.classList.add('show'); return; }
    err.classList.remove('show');
    var m='Hi, I need a quote.\n';
    m+='\nService: '+serv;
    if(veh) m+='\nVehicle: '+veh.replace(/\u2014/g,'-');
    m+='\nPickup: '+pick;
    if(drop) m+='\nDrop: '+drop;
    if(date) m+='\nDate: '+date;
    m+='\nMobile: '+mob;
    window.open('https://wa.me/<?php echo BIZ_WA; ?>?text='+encodeURIComponent(m),'_blank');
  });
})();
</script>

<?php include 'footer.php'; ?>
