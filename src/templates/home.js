// Homepage template for Madhavi Cab Kutch

import { e, money, waLink, photo, renderLayout } from './layout.js';

export function renderHomePage({ routes = [], places = [], settings = {}, popularRoutes = [] }) {
  const bizPhone = settings.biz_phone || '+918128807488';
  const bizPhoneD = settings.biz_phone_display || '+91 81288 07488';
  const bizWa = settings.biz_whatsapp || '918128807488';

  const content = `
<style>
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
.hero .slide.on{ opacity:1 !important; visibility:visible !important; }
.hero .slide::before{
  content:"" !important;
  position:absolute !important;
  inset:0 !important;
  z-index:0 !important;
  background:linear-gradient(90deg, rgba(7,16,35,.82) 0%, rgba(7,16,35,.62) 34%, rgba(7,16,35,.24) 64%, rgba(7,16,35,.08) 100%) !important;
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
.hero .slide .c{ max-width:680px !important; padding:42px 0 76px !important; }
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
.hero .slide h1, .hero .slide h2{
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
.hero .slide p{ display:none !important; }
.hero .slide .cta{ display:flex !important; flex-wrap:wrap !important; gap:12px !important; margin-top:30px !important; }
.hero .dots{ position:absolute; bottom:20px; left:50%; transform:translateX(-50%); display:flex; gap:8px; z-index:3; }
.hero .dots span{ width:12px; height:12px; border-radius:50%; background:rgba(255,255,255,.4); cursor:pointer; }
.hero .dots span.on{ background:#F2B01E; width:28px; border-radius:6px; }
</style>

<section class="hero" id="hero">
  <div class="slide on" style="background-image:url('assets/img/slide1.jpg')">
    <div class="wrap"><div class="c">
      <span class="tag">Based in Bhuj &middot; 24&times;7 Cab Service</span>
      <h1>Car Rental &amp; Taxi Service in Bhuj, Kutch</h1>
      <div class="cta">
        <a href="#quote" class="btn btn-gold">Get fare quote</a>
        <a href="tel:${e(bizPhone)}" class="btn btn-ghost"><i class="fa fa-phone"></i> Call ${e(bizPhoneD)}</a>
      </div>
    </div></div>
  </div>

  <div class="slide" style="background-image:url('assets/img/slide2.jpg')">
    <div class="wrap"><div class="c">
      <span class="tag">One Way Drop &middot; Pay Only For One Side</span>
      <h2>One Way Taxi Across Gujarat</h2>
      <div class="cta">
        <a href="one-way-taxi" class="btn btn-gold">View route fares</a>
        <a href="${waLink(bizWa, 'Hi, I need a one way taxi.')}" class="btn btn-ghost" target="_blank" rel="noopener"><i class="fa fa-whatsapp"></i> WhatsApp us</a>
      </div>
    </div></div>
  </div>

  <div class="slide" style="background-image:url('assets/img/slide3.jpg')">
    <div class="wrap"><div class="c">
      <span class="tag">Ready Itineraries &middot; White Rann &amp; Beyond</span>
      <h2>Kutch Tour Packages with Driver</h2>
      <div class="cta">
        <a href="fixed-kutch-tour-package" class="btn btn-gold">Explore packages</a>
        <a href="tel:${e(bizPhone)}" class="btn btn-ghost"><i class="fa fa-phone"></i> Call ${e(bizPhoneD)}</a>
      </div>
    </div></div>
  </div>

  <div class="dots" id="dots"></div>
</section>

<div class="qstrip"><div class="wrap in">
  <div class="qi"><i class="fa fa-shield"></i> Clean, verified vehicles</div>
  <div class="qi"><i class="fa fa-clock-o"></i> 24&times;7 availability &amp; pickup</div>
  <div class="qi"><i class="fa fa-tag"></i> Transparent fixed fares</div>
  <div class="qi"><i class="fa fa-map-marker"></i> Expert local Kutch drivers</div>
</div></div>

<!-- SERVICES -->
<section class="sec">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">OUR SERVICES</div>
      <h2>Reliable Taxi and Car Rental Across Kutch</h2>
      <p>Whether you need an airport transfer in Bhuj, a one-side outstation drop to Ahmedabad or a full 4-day Kutch circuit, we have well-maintained vehicles with trusted local drivers.</p>
    </div>

    <div class="g3">
      <div class="scard">
        <div class="sico"><i class="fa fa-car"></i></div>
        <h3>Car Rental with Driver</h3>
        <p>Sedans, Ertiga, Innova Crysta, tempo travellers and buses available for local sightseeing in Bhuj or multi-day outstation tours across Gujarat.</p>
        <a href="vehicle-rental" class="slink">View vehicles and rates &rarr;</a>
      </div>

      <div class="scard">
        <div class="sico"><i class="fa fa-exchange"></i></div>
        <h3>One Way Taxi Service</h3>
        <p>Travelling one way? Pay only for single side drop. Popular routes include Bhuj to Ahmedabad, Rajkot, Vadodara, Surat, Mandvi, Dholavira and Dhordo.</p>
        <a href="one-way-taxi" class="slink">Check one way fares &rarr;</a>
      </div>

      <div class="scard">
        <div class="sico"><i class="fa fa-compass"></i></div>
        <h3>Kutch Tour Packages</h3>
        <p>Customized holiday tour packages starting from Bhuj covering the White Rann, Dholavira Harappan site, Kalo Dungar, Mandvi Beach, and craft villages.</p>
        <a href="fixed-kutch-tour-package" class="slink">See tour packages &rarr;</a>
      </div>
    </div>
  </div>
</section>

<!-- ONE WAY ROUTES -->
${routes && routes.length ? `
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
        ${routes.map(r => `
          <tr>
            <td>${e(r.from_city)} &rarr; ${e(r.to_city)}</td>
            <td class="km">${r.distance_km ? Number(r.distance_km) + ' km' : '&mdash;'}</td>
            <td class="fare">&#8377;${money(r.sedan_fare)}</td>
            <td class="fare">&#8377;${money(r.suv_fare)}</td>
            <td class="fare">&#8377;${money(r.tempo_fare)}</td>
            <td><a class="book" target="_blank" rel="noopener"
                   href="${waLink(bizWa, `Hi, I need a one way taxi from ${r.from_city} to ${r.to_city}.`)}">Book &rarr;</a></td>
          </tr>
        `).join('')}
        </tbody>
      </table>
    </div>
    <p class="tbl-note"><a href="one-way-taxi" class="more">View all routes and fares &rarr;</a></p>
  </div>
</section>
` : ''}

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
            <option>Car rental with driver</option>
            <option>One way taxi</option>
            <option>Bus or tempo traveller</option>
            <option>Airport or railway station transfer</option>
            <option>Kutch tour package</option>
            <option>Wedding or event</option>
          </select>
        </div>
        <div class="fld">
          <label for="q-veh">Vehicle</label>
          <select id="q-veh">
            <option value="">Any / not sure</option>
            <option>Sedan (Dzire / Etios) - 4 seats</option>
            <option>SUV (Ertiga / Innova) - 6-7 seats</option>
            <option>Tempo Traveller - 12-17 seats</option>
            <option>Mini Bus / Luxury Coach</option>
            <option>Toyota Fortuner - Premium</option>
          </select>
        </div>
        <div class="fld">
          <label for="q-pick">Pickup point</label>
          <input type="text" id="q-pick" placeholder="Bhuj city, airport, hotel">
        </div>
        <div class="fld">
          <label for="q-drop">Drop point</label>
          <input type="text" id="q-drop" placeholder="Destination city or place">
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
          <label for="q-name">Your name</label>
          <input type="text" id="q-name" placeholder="Name">
        </div>
        <div class="fld">
          <label for="q-mob">Mobile number</label>
          <input type="tel" id="q-mob" placeholder="10-digit mobile number">
        </div>
        <div class="fld qfull">
          <label for="q-msg">Message (optional)</label>
          <textarea id="q-msg" placeholder="Number of passengers, luggage details, flight/train timing"></textarea>
        </div>
        <div class="qfull err" id="q-err"></div>
        <div class="qfull">
          <button class="btn btn-wa btn-block" id="q-send"><i class="fa fa-whatsapp"></i> Send requirement on WhatsApp</button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- PLACES -->
${places && places.length ? `
<section class="sec sec-grey">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">EXPLORE KUTCH</div>
      <h2>Top Places to Visit in Kutch by Cab</h2>
      <p>The spots our drivers are asked for most. Tell us where you want to go and we will build the route around it.</p>
    </div>

    <div class="g4">
      ${places.map(pl => `
        <a href="place-detail?slug=${e(pl.slug)}" class="plcard">
          ${photo(pl.image, `${pl.title} in Kutch`, '&#127963;')}
          <div class="b">
            <h3>${e(pl.title)}</h3>
            <div class="dist">${pl.distance_bhuj ? e(pl.distance_bhuj) + ' from Bhuj' : 'In Kutch'}</div>
          </div>
        </a>
      `).join('')}
    </div>

    <p class="tbl-note"><a href="places-to-visit" class="more">See all places in Kutch &rarr;</a></p>
  </div>
</section>
` : ''}

<!-- FAQS -->
<section class="sec">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">FREQUENTLY ASKED QUESTIONS</div>
      <h2>Common Questions About Cab Booking in Bhuj</h2>
    </div>

    <div class="g2">
      <div class="faq-box">
        <h3>How do I book a cab with Madhavi Cab?</h3>
        <p>You can call us directly at <a href="tel:${e(bizPhone)}">${e(bizPhoneD)}</a> or click any WhatsApp button on this website with your trip details. We confirm vehicle availability and fixed fare in minutes.</p>
      </div>

      <div class="faq-box">
        <h3>Are the drivers experienced with Kutch routes?</h3>
        <p>Yes. All our drivers are locals with extensive experience navigating Kutch routes, White Rann checkposts, Dholavira access roads, and highway outstation travel.</p>
      </div>

      <div class="faq-box">
        <h3>Do you charge for the return journey on one-way trips?</h3>
        <p>No! Our one-way taxi drops are charged strictly for single-side travel. You never pay for the vehicle's empty return trip.</p>
      </div>

      <div class="faq-box">
        <h3>Can you arrange White Rann permits?</h3>
        <p>Yes. Our drivers assist you directly at the Bhirandiyara checkpost or guide you through the online gateway for White Rann permits.</p>
      </div>
    </div>
  </div>
</section>

<script>
(function(){
  var err=document.getElementById('q-err');
  function v(id){ var el=document.getElementById(id); return el ? el.value.trim() : ''; }
  ['q-serv','q-veh','q-pick','q-drop','q-date','q-time','q-name','q-mob','q-msg'].forEach(function(id){
    var el=document.getElementById(id);
    if(el) el.addEventListener('input',function(){ if(err) err.classList.remove('show'); });
  });
  var btn=document.getElementById('q-send');
  if(btn){
    btn.addEventListener('click',function(){
      var serv=v('q-serv'),veh=v('q-veh'),pick=v('q-pick'),drop=v('q-drop'),
          date=v('q-date'),time=v('q-time'),name=v('q-name'),
          mob=v('q-mob').replace(/\\D/g,''),msg=v('q-msg');
      if(!pick){ err.textContent='Enter your pickup point.'; err.classList.add('show'); return; }
      if(mob.length<10){ err.textContent='Enter a valid 10-digit mobile number.'; err.classList.add('show'); return; }
      err.classList.remove('show');
      var m='Hi, I have an enquiry for cab booking.\\n';
      m+='\\nService: '+serv;
      if(veh) m+='\\nVehicle: '+veh;
      m+='\\nPickup: '+pick;
      if(drop) m+='\\nDrop: '+drop;
      if(date) m+='\\nDate: '+date;
      if(time) m+='\\nTime: '+time;
      if(name) m+='\\nName: '+name;
      m+='\\nMobile: '+mob;
      if(msg) m+='\\nMessage: '+msg;
      window.open('https://wa.me/${e(bizWa)}?text='+encodeURIComponent(m),'_blank');
    });
  }
})();
</script>
`;

  return renderLayout({
    title: 'Car Rental in Bhuj & Taxi Service in Kutch | Madhavi Cab',
    description: 'Book car rental and taxi in Bhuj, Kutch with driver. Sedans, SUVs, tempo travellers for local, outstation & Rann Utsav tours. 24x7. Call +91 81288 07488.',
    canonical: 'https://madhavicabkutch.com/',
    active: 'home',
    settings,
    popularRoutes,
    content
  });
}
