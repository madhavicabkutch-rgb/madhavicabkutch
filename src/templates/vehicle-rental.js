// Vehicle rental template for Madhavi Cab Kutch

import { e, money, waLink, photo, renderLayout } from './layout.js';

export function renderVehicleRentalPage({ type = 'Car', vehicles = [], settings = {}, popularRoutes = [] }) {
  const bizPhone = settings.biz_phone || '+918128807488';
  const bizPhoneD = settings.biz_phone_display || '+91 81288 07488';
  const bizWa = settings.biz_whatsapp || '918128807488';

  const categoryMeta = {
    Car: {
      tag: 'Car rental with driver',
      h1: 'Car rental in Bhuj with verified local driver',
      lead: 'Clean, comfortable air-conditioned sedans and SUVs for local Bhuj sightseeing, Rann Utsav tours, and outstation trips across Gujarat. Transparent fixed pricing, experienced drivers.',
      wa: 'Hi, I want to book a car on rent in Bhuj.'
    },
    Bus: {
      tag: 'Bus & tempo traveller hire',
      h1: 'Tempo traveller & bus rental in Bhuj, Kutch',
      lead: 'Spacious 12 to 17 seater luxury tempo travellers and 24 to 56 seater coaches with pushback seats and powerful AC for family groups, corporate events and pilgrimage tours.',
      wa: 'Hi, I want to book a tempo traveller or bus on rent.'
    },
    Premium: {
      tag: 'Executive & VIP cars',
      h1: 'Luxury & premium car rental in Bhuj, Kutch',
      lead: 'Executive SUVs including Toyota Fortuner for VIP guests, business delegates, desert safaris and wedding functions in Bhuj and across Kutch.',
      wa: 'Hi, I want to enquire about premium car rental in Bhuj.'
    }
  };

  const c = categoryMeta[type] || categoryMeta.Car;

  const content = `
<section class="phero">
  <div class="wrap">
    <div class="crumb"><a href="./">Home</a> &rsaquo; Vehicle rental</div>
    <span class="tag">${e(c.tag)}</span>
    <h1>${e(c.h1)}</h1>
    <p>${e(c.lead)}</p>
    <div class="cta">
      <a href="#quote" class="btn btn-gold">Check availability</a>
      <a href="tel:${e(bizPhone)}" class="btn btn-ghost"><i class="fa fa-phone"></i> Call ${e(bizPhoneD)}</a>
    </div>
  </div>
</section>

<section class="sec">
  <div class="wrap">

    <div class="vtabs">
      <a href="vehicle-rental?type=Car" class="vt-tab ${type === 'Car' ? 'on' : ''}">Cars</a>
      <a href="vehicle-rental?type=Bus" class="vt-tab ${type === 'Bus' ? 'on' : ''}">Buses &amp; Tempo</a>
      <a href="vehicle-rental?type=Premium" class="vt-tab ${type === 'Premium' ? 'on' : ''}">Premium</a>
    </div>

    ${vehicles && vehicles.length ? `
      <div class="g3">
        ${vehicles.map(v => {
          const name = v.name || '';
          const hasLocal8 = v.local_8h_80km_ac !== null && v.local_8h_80km_ac !== '';
          const hasLocal8n = v.local_8h_80km_nonac !== null && v.local_8h_80km_nonac !== '';
          const hasLocal12 = v.local_12h_300km_ac !== null && v.local_12h_300km_ac !== '';
          const hasLocal12n = v.local_12h_300km_nonac !== null && v.local_12h_300km_nonac !== '';
          const hasPerKm = v.per_km !== null && v.per_km !== '';
          const hasAirport = v.airport_transfer !== null && v.airport_transfer !== '';
          const hasNight = v.driver_night_allowance !== null && v.driver_night_allowance !== '';
          const hasDailyMin = v.daily_min_km !== null && v.daily_min_km !== '';

          const meta = [];
          if (v.models) meta.push(e(v.models));
          if (v.seats) meta.push(`${e(v.seats)} seats`);
          if (v.luggage) meta.push(e(v.luggage));

          return `
          <article class="vcard mv-vehicle-card">
            ${photo(v.image, `${name} on rent in Bhuj`, '&#128663;', 'contain')}

            <div class="b">
              <h3>${e(name)}</h3>

              ${meta.length ? `<div class="meta">${meta.join(' &middot; ')}</div>` : ''}

              ${v.description ? `<p class="mv-description">${e(v.description)}</p>` : ''}

              ${hasLocal8 || hasLocal8n || hasLocal12 || hasLocal12n ? `
                <div class="mv-rate-title">Local rental — Bhuj</div>
                <div class="mv-rate-table">
                  <div class="mv-rate-row mv-rate-head">
                    <span>Package</span><span>A/C</span><span>Non-A/C</span>
                  </div>

                  ${hasLocal8 || hasLocal8n ? `
                    <div class="mv-rate-row">
                      <span>8 hours / 80 km</span>
                      <strong>${hasLocal8 ? '&#8377;' + e(v.local_8h_80km_ac) : '—'}</strong>
                      <strong>${hasLocal8n ? '&#8377;' + e(v.local_8h_80km_nonac) : '—'}</strong>
                    </div>
                  ` : ''}

                  ${hasLocal12 || hasLocal12n ? `
                    <div class="mv-rate-row">
                      <span>12 hours / 300 km</span>
                      <strong>${hasLocal12 ? '&#8377;' + e(v.local_12h_300km_ac) : '—'}</strong>
                      <strong>${hasLocal12n ? '&#8377;' + e(v.local_12h_300km_nonac) : '—'}</strong>
                    </div>
                  ` : ''}
                </div>
              ` : ''}

              ${hasPerKm || hasDailyMin || hasNight || hasAirport ? `
                <div class="mv-rate-title">Outstation &amp; other rates</div>
                <div class="mv-extra-grid">
                  ${hasPerKm ? `
                    <div class="mv-extra-item">
                      <span>Per km</span>
                      <strong>&#8377;${e(v.per_km)}/km</strong>
                    </div>
                  ` : ''}
                  ${hasDailyMin ? `
                    <div class="mv-extra-item">
                      <span>Daily minimum</span>
                      <strong>${e(v.daily_min_km)} km</strong>
                    </div>
                  ` : ''}
                  ${hasNight ? `
                    <div class="mv-extra-item">
                      <span>Driver night</span>
                      <strong>&#8377;${e(v.driver_night_allowance)}</strong>
                    </div>
                  ` : ''}
                  ${hasAirport ? `
                    <div class="mv-extra-item">
                      <span>Airport transfer</span>
                      <strong>&#8377;${e(v.airport_transfer)}</strong>
                    </div>
                  ` : ''}
                </div>
              ` : ''}

              <div class="vcard-foot" style="margin-top:16px">
                <a href="${waLink(bizWa, `Hi, I want to book a ${name} on rent.`)}" class="btn btn-wa btn-block" target="_blank" rel="noopener">
                  <i class="fa fa-whatsapp"></i> Book ${e(name)}
                </a>
              </div>
            </div>
          </article>
          `;
        }).join('')}
      </div>
    ` : `
      <div style="padding:50px 20px;text-align:center">
        <h3>No vehicles currently listed in this category.</h3>
        <p>Contact us directly on WhatsApp or phone for immediate vehicle availability.</p>
        <a class="btn btn-gold" target="_blank" rel="noopener" href="${waLink(bizWa, c.wa)}">Enquire on WhatsApp</a>
      </div>
    `}

  </div>
</section>

<section class="sec sec-grey">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">WHAT THE RATE COVERS</div>
      <h2>Included and Charged Separately</h2>
    </div>
    <div class="g2">
      <div class="inc-box inc-yes">
        <h3>Included in the rate</h3>
        <ul>
          <li>Fuel for the full booking</li>
          <li>Verified commercial driver service</li>
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
`;

  return renderLayout({
    title: 'Car Rental in Bhuj | Taxi Service in Kutch | Madhavi Cab',
    description: 'Car rental in Bhuj with driver. Sedans, Ertiga, Innova Crysta, Tempo Travellers for local sightseeing, outstation & Rann Utsav. 24x7. Call +91 81288 07488.',
    canonical: `https://madhavicabkutch.com/vehicle-rental?type=${encodeURIComponent(type)}`,
    active: 'rental',
    settings,
    popularRoutes,
    content
  });
}
