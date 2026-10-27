// Contact page template for Madhavi Cab Kutch

import { e, waLink, renderLayout } from './layout.js';

export function renderContactPage({ settings = {}, popularRoutes = [] }) {
  const bizPhone = settings.biz_phone || '+918128807488';
  const bizPhoneD = settings.biz_phone_display || '+91 81288 07488';
  const bizWa = settings.biz_whatsapp || '918128807488';
  const bizEmail = settings.biz_email || 'madhavicabkutch@gmail.com';
  const bizStreet = settings.biz_street || '4, Yogeswar Nagar';
  const bizPin = settings.biz_pin || '370001';
  const bizMap = 'https://www.google.com/maps/place/MADHAVI+CAB+KUTCH/data=!4m2!3m1!1s0x0:0x582ca8dfc5fabc7?sa=X&ved=1t:2428&ictx=111';
  const googleReviewUrl = 'https://share.google/w1WkYmNi1OvbMWryI';
  const googleMapEmbed = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3665.5412441365474!2d69.64354471059004!3d23.25977530734772!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39511d0074460941%3A0x582ca8dfc5fabc7!2sMADHAVI%20CAB%20KUTCH!5e0!3m2!1sen!2sin!4v1786945317706!5m2!1sen!2sin';

  const contactSchema = {
    '@context': 'https://schema.org',
    '@type': 'ContactPage',
    name: 'Contact Madhavi Cab Kutch',
    description: 'Contact Madhavi Cab for 24x7 car rental, taxi booking, and tour packages in Bhuj and Kutch.',
    url: 'https://madhavicabkutch.com/contact',
    mainEntity: {
      '@type': ['TaxiService', 'AutoRental', 'TravelAgency'],
      name: 'MADHAVI CAB KUTCH',
      telephone: bizPhone,
      email: bizEmail,
      url: 'https://madhavicabkutch.com/',
      hasMap: bizMap,
      address: {
        '@type': 'PostalAddress',
        streetAddress: bizStreet,
        addressLocality: 'Bhuj',
        addressRegion: 'Gujarat',
        postalCode: bizPin,
        addressCountry: 'IN'
      },
      openingHours: 'Mo-Su 00:00-23:59',
      contactPoint: {
        '@type': 'ContactPoint',
        telephone: bizPhone,
        contactType: 'customer service',
        areaServed: ['IN'],
        availableLanguage: ['English', 'Hindi', 'Gujarati']
      }
    }
  };

  const pageSchema = `<script type="application/ld+json">\n${JSON.stringify(contactSchema, null, 2)}\n</script>`;

  const content = `
<section class="phero">
  <div class="wrap">
    <div class="crumb"><a href="./">Home</a> &rsaquo; Contact</div>
    <span class="tag">We answer 24&times;7</span>
    <h1>Contact Madhavi Cab &mdash; Taxi booking in Bhuj, Kutch</h1>
    <p>Need a cab in Bhuj or planning an outstation trip? Contact Madhavi Cab 24&times;7 for instant quotes, transparent fixed fares, airport pickups, and comfortable taxi service across Gujarat.</p>
    <div class="cta">
      <a href="tel:${e(bizPhone)}" class="btn btn-gold">Call ${e(bizPhoneD)}</a>
      <a href="${waLink(bizWa, 'Hi, I would like to make an enquiry.')}" class="btn btn-ghost" target="_blank" rel="noopener"><i class="fa fa-whatsapp"></i> WhatsApp us</a>
    </div>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="g4">
      <div class="ct-card">
        <div class="ct-ico"><i class="fa fa-phone"></i></div>
        <h3>Phone</h3>
        <p><a href="tel:${e(bizPhone)}">${e(bizPhoneD)}</a></p>
        <span class="ct-note">Available 24 hours</span>
      </div>
      <div class="ct-card">
        <div class="ct-ico"><i class="fa fa-whatsapp"></i></div>
        <h3>WhatsApp</h3>
        <p><a href="${waLink(bizWa, 'Hi, I would like to make an enquiry.')}" target="_blank" rel="noopener">${e(bizPhoneD)}</a></p>
        <span class="ct-note">Fastest way to get a fare</span>
      </div>
      <div class="ct-card">
        <div class="ct-ico"><i class="fa fa-envelope-o"></i></div>
        <h3>Email</h3>
        <p><a href="mailto:${e(bizEmail)}">${e(bizEmail)}</a></p>
        <span class="ct-note">For invoices and corporate bookings</span>
      </div>
      <div class="ct-card">
        <div class="ct-ico"><i class="fa fa-map-marker"></i></div>
        <h3>Office</h3>
        <p>${e(bizStreet)},<br>Bhuj, Gujarat ${e(bizPin)}</p>
        <span class="ct-note"><a href="${bizMap}" target="_blank" rel="noopener">Open in Google Maps &rarr;</a></span>
      </div>
    </div>
  </div>
</section>

<section class="qband" id="quote">
  <div class="wrap">
    <div>
      <h2>Send us your requirement</h2>
      <p>Fill this in and it reaches us on WhatsApp with everything already typed out. No advance payment is needed to book.</p>
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
            <option>Wedding or event</option>
            <option>Something else</option>
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
            <option>Premium car</option>
          </select>
        </div>
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
          <label for="q-name">Your name</label>
          <input type="text" id="q-name" placeholder="Name">
        </div>
        <div class="fld">
          <label for="q-mob">Mobile number</label>
          <input type="tel" id="q-mob" placeholder="10-digit number">
        </div>
        <div class="fld qfull">
          <label for="q-msg">Your message (optional)</label>
          <textarea id="q-msg" placeholder="Passengers, luggage, stops on the way, flight or train timing"></textarea>
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
      <div class="kick">FIND US ON GOOGLE MAPS</div>
      <h2>Our office: MADHAVI CAB KUTCH</h2>
      <p>Visit us in Bhuj, or get picked up directly from your hotel, railway station, airport or home anywhere in Kutch.</p>
    </div>

    <div class="map-card-panel">
      <div class="mcp-info">
        <h3>
          <svg viewBox="0 0 24 24" width="22" height="22" style="vertical-align:middle"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/></svg>
          MADHAVI CAB KUTCH
        </h3>
        <p>${e(bizStreet)}, Bhuj, Gujarat ${e(bizPin)} (Near Airport Ring Road)</p>
      </div>
      <div class="mcp-btns">
        <a href="${bizMap}" target="_blank" rel="noopener" class="btn btn-gold btn-sm"><i class="fa fa-map-marker"></i> Get Directions</a>
        <a href="${googleReviewUrl}" target="_blank" rel="noopener" class="btn btn-ghost btn-sm"><i class="fa fa-star"></i> 5.0 Google Reviews</a>
      </div>
    </div>
    <div class="map-frame-wrap" style="border-radius:12px;overflow:hidden;border:1px solid #e3e6ea;height:420px">
      <iframe src="${googleMapEmbed}" width="100%" height="100%" style="border:0" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" title="MADHAVI CAB KUTCH Office Location on Google Maps"></iframe>
    </div>
  </div>
</section>

<section class="sec sec-grey">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">SERVICE AREA</div>
      <h2>Where we operate</h2>
      <p>Pickup and drop across Kutch, with outstation runs anywhere in Gujarat and neighbouring states.</p>
    </div>
    <div class="g2">
      <div class="inc-box">
        <h3>Across Kutch</h3>
        <ul style="list-style:none;padding:0">
          <li style="padding:8px 0;border-bottom:1px solid #f3f4f6">Bhuj city and Bhuj airport</li>
          <li style="padding:8px 0;border-bottom:1px solid #f3f4f6">Gandhidham, Adipur and Kandla</li>
          <li style="padding:8px 0;border-bottom:1px solid #f3f4f6">Anjar, Bhachau and Samakhiali</li>
          <li style="padding:8px 0;border-bottom:1px solid #f3f4f6">Mandvi, Mundra and Nakhatrana</li>
          <li style="padding:8px 0;border-bottom:1px solid #f3f4f6">Dhordo, Khavda and the White Rann</li>
          <li style="padding:8px 0">Lakhpat and Narayan Sarovar</li>
        </ul>
      </div>
      <div class="inc-box">
        <h3>Outstation</h3>
        <ul style="list-style:none;padding:0">
          <li style="padding:8px 0;border-bottom:1px solid #f3f4f6">Ahmedabad, Gandhinagar and Vadodara</li>
          <li style="padding:8px 0;border-bottom:1px solid #f3f4f6">Rajkot, Jamnagar and Morbi</li>
          <li style="padding:8px 0;border-bottom:1px solid #f3f4f6">Dwarka, Somnath and Porbandar</li>
          <li style="padding:8px 0;border-bottom:1px solid #f3f4f6">Surat and Bharuch</li>
          <li style="padding:8px 0;border-bottom:1px solid #f3f4f6">Mount Abu and Udaipur</li>
          <li style="padding:8px 0">Mumbai and Pune</li>
        </ul>
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
      var m='Hi, I have an enquiry.\\n';
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
    title: 'Contact Madhavi Cab Kutch | Taxi & Car Rental in Bhuj',
    description: 'Contact Madhavi Cab for 24x7 car rental, taxi booking & Kutch tour packages in Bhuj. Call +91 81288 07488 or WhatsApp for instant fixed fare quotes.',
    canonical: 'https://madhavicabkutch.com/contact',
    active: 'contact',
    pageSchema,
    settings,
    popularRoutes,
    content
  });
}
