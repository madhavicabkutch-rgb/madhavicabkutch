// One-way taxi page template for Madhavi Cab Kutch

import { e, money, waLink, renderLayout } from './layout.js';

export function renderOneWayTaxiPage({ routes = [], settings = {}, popularRoutes = [] }) {
  const bizPhone = settings.biz_phone || '+918128807488';
  const bizPhoneD = settings.biz_phone_display || '+91 81288 07488';
  const bizWa = settings.biz_whatsapp || '918128807488';

  const onewaySchema = {
    '@context': 'https://schema.org',
    '@type': 'Service',
    serviceType: 'One Way Taxi Service',
    name: 'One Way Taxi from Bhuj across Gujarat',
    provider: {
      '@type': 'TaxiService',
      name: 'MADHAVI CAB KUTCH',
      telephone: bizPhone,
      url: 'https://madhavicabkutch.com/'
    },
    hasOfferCatalog: {
      '@type': 'OfferCatalog',
      name: 'One Way Taxi Services',
      itemListElement: [
        { '@type': 'Offer', itemOffered: { '@type': 'Service', name: 'Bhuj to Ahmedabad Taxi' }, price: '4500', priceCurrency: 'INR' },
        { '@type': 'Offer', itemOffered: { '@type': 'Service', name: 'Bhuj to Rajkot Taxi' }, price: '3500', priceCurrency: 'INR' },
        { '@type': 'Offer', itemOffered: { '@type': 'Service', name: 'Bhuj to Vadodara Taxi' }, price: '6500', priceCurrency: 'INR' },
        { '@type': 'Offer', itemOffered: { '@type': 'Service', name: 'Bhuj to Surat Taxi' }, price: '8500', priceCurrency: 'INR' },
        { '@type': 'Offer', itemOffered: { '@type': 'Service', name: 'Bhuj to Mandvi Taxi' }, price: '1500', priceCurrency: 'INR' },
        { '@type': 'Offer', itemOffered: { '@type': 'Service', name: 'Bhuj to Dholavira Taxi' }, price: '5000', priceCurrency: 'INR' }
      ]
    }
  };

  const pageSchema = `<script type="application/ld+json">\n${JSON.stringify(onewaySchema, null, 2)}\n</script>`;

  const content = `
<section class="phero">
  <div class="wrap">
    <div class="crumb"><a href="./">Home</a> &rsaquo; One way taxi</div>
    <span class="tag">One way drop service</span>
    <h1>One way taxi from Bhuj across Gujarat</h1>
    <p>Travelling one side only? You should never pay for the driver's return trip. Madhavi Cab provides reliable one way cab drops from Bhuj to Ahmedabad, Rajkot, Vadodara, Surat, Dholavira, Mandvi and across Gujarat. Pay only for one side journey at affordable fixed rates.</p>
    <div class="cta">
      <a href="#quote" class="btn btn-gold">Get a fare quote</a>
      <a href="tel:${e(bizPhone)}" class="btn btn-ghost"><i class="fa fa-phone"></i> Call ${e(bizPhoneD)}</a>
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

    ${routes && routes.length ? `
    <div class="tbl-wrap">
      <table>
        <thead>
          <tr><th>Route</th><th>Distance</th><th>Time</th><th>Sedan</th><th>SUV</th><th>Tempo</th><th></th></tr>
        </thead>
        <tbody>
        ${routes.map(r => `
          <tr>
            <td>${e(r.from_city)} &rarr; ${e(r.to_city)}</td>
            <td class="km">${r.distance_km ? Number(r.distance_km) + ' km' : '&mdash;'}</td>
            <td class="km">${r.duration ? e(r.duration) : '&mdash;'}</td>
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
    <p class="tbl-note">Route not listed? Send us the pickup and drop point on WhatsApp and we will quote it the same day.</p>
    ` : `
    <p class="tbl-note">Fares are updated regularly. Call <a href="tel:${e(bizPhone)}" class="more">${e(bizPhoneD)}</a> or message us on WhatsApp for the current rate on your route.</p>
    `}
  </div>
</section>

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
          <label for="q-serv">Service</label>
          <select id="q-serv">
            <option>One way taxi</option>
            <option>Car rental with driver</option>
            <option>Airport transfer</option>
          </select>
        </div>
        <div class="fld">
          <label for="q-veh">Vehicle</label>
          <select id="q-veh">
            <option value="">Any / not sure</option>
            <option>Sedan (Dzire / Etios) - 4 seats</option>
            <option>SUV (Ertiga / Innova) - 6-7 seats</option>
            <option>Tempo Traveller - 12-17 seats</option>
          </select>
        </div>
        <div class="fld">
          <label for="q-pick">Pickup point</label>
          <input type="text" id="q-pick" placeholder="Bhuj, airport, hotel">
        </div>
        <div class="fld">
          <label for="q-drop">Drop point</label>
          <input type="text" id="q-drop" placeholder="Destination city">
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
          <textarea id="q-msg" placeholder="Luggage details, flight or train timing"></textarea>
        </div>
        <div class="qfull err" id="q-err"></div>
        <div class="qfull">
          <button class="btn btn-wa btn-block" id="q-send"><i class="fa fa-whatsapp"></i> Send on WhatsApp</button>
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
      var m='Hi, I have an enquiry for one way taxi.\\n';
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
    title: 'One Way Taxi from Bhuj across Gujarat | Madhavi Cab',
    description: 'One way taxi from Bhuj to Ahmedabad, Rajkot, Vadodara, Surat & Mandvi. Pay single side drop fare only. Sedans, SUVs & Tempo Travellers. Call +91 81288 07488.',
    canonical: 'https://madhavicabkutch.com/one-way-taxi',
    active: 'oneway',
    pageSchema,
    settings,
    popularRoutes,
    content
  });
}
