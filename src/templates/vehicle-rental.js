// Vehicle rental template for Madhavi Cab Kutch - Redesigned UI & Easy Booking Flow

import { e, money, waLink, photo, renderLayout } from './layout.js';

export function renderVehicleRentalPage({ type = 'Car', vehicles = [], settings = {}, popularRoutes = [] }) {
  const bizPhone = settings.biz_phone || '+918128807488';
  const bizPhoneD = settings.biz_phone_display || '+91 81288 07488';
  const bizWa = settings.biz_whatsapp || '918128807488';

  const categoryMeta = {
    Car: {
      tag: 'Car Rental with Driver in Bhuj',
      h1: 'Car Rental in Bhuj with Verified Local Driver',
      lead: 'Clean, comfortable air-conditioned sedans and SUVs for local Bhuj sightseeing, Rann Utsav tours, and outstation trips across Gujarat. Transparent fixed pricing, experienced drivers.',
      wa: 'Hi Madhavi Cab, I want to book a car on rent in Bhuj.'
    },
    Bus: {
      tag: 'Group Travel & Tempo Travellers',
      h1: 'Tempo Traveller & Bus Rental in Bhuj, Kutch',
      lead: 'Spacious 12 to 17 seater luxury tempo travellers and 24 to 56 seater coaches with pushback seats and powerful AC for family groups, corporate events and pilgrimage tours.',
      wa: 'Hi Madhavi Cab, I want to book a tempo traveller or bus on rent.'
    },
    Premium: {
      tag: 'Executive & VIP Cars',
      h1: 'Luxury & Premium Car Rental in Bhuj, Kutch',
      lead: 'Executive SUVs including Toyota Fortuner for VIP guests, business delegates, desert safaris and wedding functions in Bhuj and across Kutch.',
      wa: 'Hi Madhavi Cab, I want to enquire about premium car rental in Bhuj.'
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
      <a href="tel:${e(bizPhone)}" class="btn btn-gold"><i class="fa fa-phone"></i> Call ${e(bizPhoneD)}</a>
      <a href="${waLink(bizWa, c.wa)}" class="btn btn-ghost" target="_blank" rel="noopener"><i class="fa fa-whatsapp"></i> Chat on WhatsApp</a>
    </div>
  </div>
</section>

<section class="sec">
  <div class="wrap">

    <!-- Category Filter Tabs -->
    <div class="vtabs-wrap">
      <div class="vtabs-bar">
        <a href="vehicle-rental?type=Car" class="vt-pill ${type === 'Car' ? 'on' : ''}">
          <i class="fa fa-car"></i>
          <span>Sedans &amp; SUVs</span>
          <span class="vt-badge">Popular</span>
        </a>
        <a href="vehicle-rental?type=Bus" class="vt-pill ${type === 'Bus' ? 'on' : ''}">
          <i class="fa fa-bus"></i>
          <span>Tempo &amp; Buses</span>
          <span class="vt-badge">Group Tour</span>
        </a>
        <a href="vehicle-rental?type=Premium" class="vt-pill ${type === 'Premium' ? 'on' : ''}">
          <i class="fa fa-star"></i>
          <span>VIP &amp; Luxury</span>
          <span class="vt-badge">Executive</span>
        </a>
      </div>
    </div>

    <!-- Vehicles Grid -->
    ${vehicles && vehicles.length ? `
      <div class="g3">
        ${vehicles.map(v => {
          const name = v.name || '';
          const hasLocal12 = v.local_12h_300km_ac !== null && v.local_12h_300km_ac !== '';
          const hasLocal12n = v.local_12h_300km_nonac !== null && v.local_12h_300km_nonac !== '';
          const hasPerKm = v.per_km !== null && v.per_km !== '';
          const hasAirport = v.airport_transfer !== null && v.airport_transfer !== '';
          const hasNight = v.driver_night_allowance !== null && v.driver_night_allowance !== '';
          const hasDailyMin = v.daily_min_km !== null && v.daily_min_km !== '';

          const displayPriceTag = hasLocal12
            ? `&#8377;${e(v.local_12h_300km_ac)} <small style="font-size:10.5px;font-weight:600">/ 12h &bull; 300km</small>`
            : (hasPerKm ? `&#8377;${e(v.per_km)}/km` : 'Best Rates');

          const waBookingMsg = `Hi Madhavi Cab, I want to book ${name} (12 hrs / 300 km package) for rental in Bhuj. Please confirm rates and availability.`;

          return `
          <article class="vcard-pro">
            <div class="vcard-pro-head">
              <span class="vcard-type-tag"><i class="fa fa-check-circle"></i> Verified Cab</span>
              <span class="vcard-price-tag">${displayPriceTag}</span>
              ${v.image ? photo(v.image, `${name} on rent in Bhuj`, '&#128663;', 'contain') : '<div style="font-size:48px">&#128663;</div>'}
            </div>

            <div class="vcard-pro-body">
              <div class="vcard-title-row">
                <h3>${e(name)}</h3>
                <div class="vcard-models">${e(v.models || name)}</div>
              </div>

              <!-- 12 Hours / 300 KM Prime Package Highlight -->
              ${hasLocal12 ? `
                <div class="v-main-pkg">
                  <div class="v-main-pkg-info">
                    <span class="v-main-pkg-tag"><i class="fa fa-star"></i> Recommended Package</span>
                    <span class="v-main-pkg-title">12 Hours / 300 KM</span>
                  </div>
                  <div class="v-main-pkg-price">
                    <strong>&#8377;${e(v.local_12h_300km_ac)}</strong>
                    <span>A/C Fixed Rate</span>
                  </div>
                </div>
              ` : ''}

              <!-- Feature Chips -->
              <div class="v-chips-grid">
                <span class="v-chip"><i class="fa fa-users"></i> ${e(v.seats || '4-5')} Seats</span>
                <span class="v-chip"><i class="fa fa-briefcase"></i> ${e(v.luggage || 'Luggage Boot')}</span>
                <span class="v-chip"><i class="fa fa-snowflake-o"></i> AC &amp; Heater</span>
                <span class="v-chip"><i class="fa fa-shield"></i> Clean &amp; Sanitized</span>
              </div>

              ${v.description ? `<p class="vcard-desc">${e(v.description)}</p>` : ''}

              <!-- Local Bhuj Rates Table (12h / 300km) -->
              ${hasLocal12 || hasLocal12n ? `
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
                        <td><strong style="color:#b45309">${hasLocal12 ? '&#8377;' + e(v.local_12h_300km_ac) : '—'}</strong></td>
                        <td><strong>${hasLocal12n ? '&#8377;' + e(v.local_12h_300km_nonac) : '—'}</strong></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              ` : ''}

              <!-- Outstation & Extra Charges -->
              ${hasPerKm || hasDailyMin || hasNight || hasAirport ? `
                <div class="v-extra-pills">
                  ${hasPerKm ? `
                    <div class="v-extra-pill">
                      <span>Outstation</span>
                      <strong>&#8377;${e(v.per_km)}/km</strong>
                    </div>
                  ` : ''}
                  ${hasDailyMin ? `
                    <div class="v-extra-pill">
                      <span>Daily Min.</span>
                      <strong>${e(v.daily_min_km)} km</strong>
                    </div>
                  ` : ''}
                  ${hasNight ? `
                    <div class="v-extra-pill">
                      <span>Driver Night</span>
                      <strong>&#8377;${e(v.driver_night_allowance)}</strong>
                    </div>
                  ` : ''}
                  ${hasAirport ? `
                    <div class="v-extra-pill">
                      <span>Airport Drop</span>
                      <strong>&#8377;${e(v.airport_transfer)}</strong>
                    </div>
                  ` : ''}
                </div>
              ` : ''}

              <!-- Instant Easy Booking Buttons -->
              <div class="v-booking-actions">
                <a href="${waLink(bizWa, waBookingMsg)}" class="btn-book-wa" target="_blank" rel="noopener">
                  <i class="fa fa-whatsapp"></i> Book on WhatsApp
                </a>
                <a href="tel:${e(bizPhone)}" class="btn-book-call">
                  <i class="fa fa-phone"></i> Call Now
                </a>
              </div>
            </div>
          </article>
          `;
        }).join('')}
      </div>
    ` : `
      <div style="padding:60px 20px;text-align:center;background:#fff;border-radius:18px;border:1px solid var(--line);">
        <div style="font-size:44px;margin-bottom:12px">&#128663;</div>
        <h3>No vehicles currently listed in this category</h3>
        <p style="color:var(--muted);max-width:480px;margin:8px auto 20px;">Contact us directly on WhatsApp or phone for immediate vehicle availability and instant custom pricing.</p>
        <a class="btn btn-gold" target="_blank" rel="noopener" href="${waLink(bizWa, c.wa)}">
          <i class="fa fa-whatsapp"></i> Enquire on WhatsApp
        </a>
      </div>
    `}

  </div>
</section>

<!-- Rate Transparency Section -->
<section class="sec sec-grey">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">TRANSPARENT PRICING</div>
      <h2>What Is Included in Your Cab Booking?</h2>
      <p>Zero hidden surprises at drop-off. We provide fixed, honest quotes upfront on WhatsApp and phone.</p>
    </div>
    <div class="g2">
      <div class="inc-box inc-yes">
        <h3><i class="fa fa-check-circle" style="color:#16a34a;margin-right:6px"></i> Included in the rate</h3>
        <ul>
          <li>Fuel and vehicle charges for the full booking</li>
          <li>Commercial badge verified driver service</li>
          <li>Vehicle insurance, road permits and taxes</li>
          <li>Powerful air conditioning throughout the trip</li>
          <li>Clean sanitized car with luggage assistance</li>
        </ul>
      </div>
      <div class="inc-box inc-no">
        <h3><i class="fa fa-info-circle" style="color:#d97706;margin-right:6px"></i> Charged separately at actuals</h3>
        <ul>
          <li>Highway toll charges and parking tickets (at actual government receipts)</li>
          <li>Driver night allowance (on multi-day outstation trips after 10 PM)</li>
          <li>State border tax / permit (only if traveling outside Gujarat)</li>
          <li>Extra kilometres if travel exceeds package limit</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- Quick WhatsApp Enquiry Strip -->
<section class="sec" id="quote" style="background:#fff;">
  <div class="wrap">
    <div class="qband" style="border-radius:16px;">
      <div class="wrap" style="padding:0 20px;">
        <div>
          <h2>Need Quick Cab Booking in Bhuj?</h2>
          <p>Get instant confirmation with vehicle photos and exact fixed fare directly on your WhatsApp within 5 minutes.</p>
        </div>
        <div style="display:flex;gap:12px;flex-wrap:wrap;">
          <a href="${waLink(bizWa, 'Hi Madhavi Cab, I want to book a cab in Bhuj. Please share vehicle availability and best fare.')}" class="btn btn-wa" target="_blank" rel="noopener" style="font-size:15px;padding:14px 24px;">
            <i class="fa fa-whatsapp"></i> Chat on WhatsApp
          </a>
          <a href="tel:${e(bizPhone)}" class="btn btn-ghost" style="font-size:15px;padding:14px 24px;">
            <i class="fa fa-phone"></i> Call ${e(bizPhoneD)}
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
`;

  return renderLayout({
    title: 'Car Rental in Bhuj | Taxi Service in Kutch | Madhavi Cab',
    description: 'Car rental in Bhuj with driver. Clean Sedans, Ertiga, Innova Crysta, Tempo Travellers for local sightseeing, outstation & Rann Utsav. 24x7. Call +91 81288 07488.',
    canonical: `https://madhavicabkutch.com/vehicle-rental?type=${encodeURIComponent(type)}`,
    active: 'rental',
    settings,
    popularRoutes,
    content
  });
}
