// Tour packages listing template for Madhavi Cab Kutch - Enhanced with Top Destinations

import { e, money, waLink, photo, renderLayout } from './layout.js';
import { PACKAGES, PKG_INCLUDED, PKG_EXCLUDED } from '../data/packages.js';

export function renderTourPackagesPage({ places = [], settings = {}, popularRoutes = [] }) {
  const bizPhone = settings.biz_phone || '+918128807488';
  const bizPhoneD = settings.biz_phone_display || '+91 81288 07488';
  const bizWa = settings.biz_whatsapp || '918128807488';

  const pkgList = Object.values(PACKAGES);

  const catalogSchema = {
    '@context': 'https://schema.org',
    '@type': 'ItemList',
    name: 'Kutch Tour Packages by Madhavi Cab',
    description: 'Ready-made trips starting from Bhuj covering the White Rann, Dholavira, Mandvi and craft villages.',
    itemListElement: pkgList.map((p, idx) => ({
      '@type': 'TouristTrip',
      position: idx + 1,
      name: p.title,
      description: p.lead,
      touristType: ['Cultural Tourism', 'Sightseeing'],
      offers: {
        '@type': 'Offer',
        price: String(p.price),
        priceCurrency: 'INR',
        availability: 'https://schema.org/InStock',
        url: `https://madhavicabkutch.com/package-detail?p=${encodeURIComponent(p.code)}`
      },
      provider: {
        '@type': 'TravelAgency',
        name: 'MADHAVI CAB KUTCH',
        telephone: bizPhone,
        url: 'https://madhavicabkutch.com/'
      }
    }))
  };

  const pageSchema = `<script type="application/ld+json">\n${JSON.stringify(catalogSchema, null, 2)}\n</script>`;

  const content = `
<section class="phero">
  <div class="wrap">
    <div class="crumb"><a href="./">Home</a> &rsaquo; Tour packages</div>
    <span class="tag">Vehicle &amp; Verified Driver Included</span>
    <h1>Kutch Tour Packages from Bhuj with Cab &amp; Driver</h1>
    <p>Ready-made holiday packages built around the best of Kutch &mdash; from a quick overnight sunset trip at the White Rann to a comprehensive 5-day circuit covering Dholavira, Mandvi Beach, and craft villages. Vehicle, local driver and route planning included.</p>
    <div class="cta">
      <a href="#destinations" class="btn btn-gold">Explore All Destinations</a>
      <a href="${waLink(bizWa, 'Hi Madhavi Cab, I want to book a customized Kutch tour package.')}" class="btn btn-ghost" target="_blank" rel="noopener">
        <i class="fa fa-whatsapp"></i> Chat on WhatsApp
      </a>
    </div>
  </div>
</section>

<div class="qstrip"><div class="wrap in">
  <div class="qi"><i class="fa fa-inr"></i> Price is per vehicle, not per person</div>
  <div class="qi"><i class="fa fa-car"></i> Dedicated cab with driver for entire tour</div>
  <div class="qi"><i class="fa fa-map-marker"></i> Pickup &amp; drop at Bhuj station/airport</div>
  <div class="qi"><i class="fa fa-calendar"></i> Flexible dates &amp; customizable routes</div>
</div></div>

<!-- Handcrafted Packages -->
<section class="sec">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">POPULAR ITINERARIES</div>
      <h2>Handcrafted Kutch Tour Packages</h2>
      <p>All packages include private vehicle, driver allowance, fuel, toll and parking. No hidden costs.</p>
    </div>

    <div class="g2">
      ${pkgList.map(p => `
        <article class="pkg-card" style="background:#fff;border:1px solid #e3e6ea;border-radius:16px;overflow:hidden;display:flex;flex-direction:column;box-shadow:0 4px 16px rgba(0,0,0,.04);transition:transform .2s ease;">
          <div style="height:210px;overflow:hidden;position:relative;">
            ${photo(p.image, p.title, '&#127963;')}
            <span class="vcard-price-tag" style="position:absolute;top:12px;right:12px;">From &#8377;${money(p.price)}</span>
            <span class="vcard-type-tag" style="position:absolute;top:12px;left:12px;">${e(p.nights)}</span>
          </div>
          <div style="padding:24px;flex:1;display:flex;flex-direction:column">
            <h3 style="font-size:22px;font-weight:700;margin-bottom:8px"><a href="package-detail?p=${encodeURIComponent(p.code)}" style="color:var(--ink);text-decoration:none;">${e(p.title)}</a></h3>
            <p style="color:#5b6b7c;font-size:14.5px;line-height:1.6;margin-bottom:16px;flex:1">${e(p.lead)}</p>

            <div style="margin-bottom:18px">
              <div style="font-size:12.5px;font-weight:700;color:#141b2e;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:8px">Places covered in this package:</div>
              <ul style="padding-left:18px;font-size:13.5px;color:#39415a;line-height:1.7">
                ${p.covers.map(c => `<li>${e(c)}</li>`).join('')}
              </ul>
            </div>

            <div style="display:flex;gap:10px;margin-top:auto">
              <a href="package-detail?p=${encodeURIComponent(p.code)}" class="btn btn-primary" style="flex:1;text-align:center;">View Itinerary</a>
              <a href="${waLink(bizWa, `Hi Madhavi Cab, I am interested in the ${p.title} (${p.short}).`)}" class="btn btn-wa" target="_blank" rel="noopener">
                <i class="fa fa-whatsapp"></i> Book Now
              </a>
            </div>
          </div>
        </article>
      `).join('')}
    </div>
  </div>
</section>

<!-- TOP DESTINATIONS SECTION (Requested by User) -->
<section class="sec sec-grey" id="destinations">
  <div class="wrap">
    <div class="sec-head center" style="text-align:center;margin-bottom:38px;">
      <div class="kick" style="letter-spacing:2px;font-weight:700;">EXPLORE KUTCH</div>
      <h2 style="font-size:32px;font-weight:700;color:var(--ink);margin-bottom:10px;">Top Destinations You Shouldn't Miss</h2>
      <p style="margin:0 auto;color:var(--muted);font-size:15.5px;max-width:760px;">
        From the endless white salt desert to ancient ruins and serene beaches, discover the best of Kutch. Reach any of these easily with our car rental and tour packages.
      </p>
    </div>

    ${places && places.length ? `
      <div class="g3">
        ${places.map(pl => `
          <article class="plcard-pro">
            <div class="plcard-pro-img">
              <span class="pl-cat-badge">${e(pl.category || 'DESTINATION')}</span>
              <span class="pl-dist-badge"><i class="fa fa-map-marker"></i> ${e(pl.distance_bhuj || 'In Kutch')}</span>
              <a href="place-detail?slug=${e(pl.slug)}" title="${e(pl.title)}">
                ${photo(pl.image, `${pl.title} in Kutch`, '&#127963;')}
              </a>
            </div>
            <div class="plcard-pro-body">
              <h3><a href="place-detail?slug=${e(pl.slug)}">${e(pl.title)}</a></h3>
              <p>${e(pl.short_desc || pl.description)}</p>
              <div class="plcard-pro-foot">
                <a href="place-detail?slug=${e(pl.slug)}" class="pl-explore-btn">Explore &rarr;</a>
                <a href="${waLink(bizWa, `Hi Madhavi Cab, I want to book a tour package to visit ${pl.title}.`)}" class="pl-book-wa" target="_blank" rel="noopener">
                  <i class="fa fa-whatsapp"></i> Book Tour
                </a>
              </div>
            </div>
          </article>
        `).join('')}
      </div>
    ` : ''}
  </div>
</section>

<!-- Inclusions & Exclusions -->
<section class="sec">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">PACKAGE DETAILS</div>
      <h2>Inclusions &amp; Exclusions</h2>
      <p>Clear, fixed pricing. What is covered and what is paid directly at actuals.</p>
    </div>
    <div class="g2">
      <div class="inc-box inc-yes">
        <h3><i class="fa fa-check-circle" style="color:#16a34a;margin-right:6px"></i> What is included</h3>
        <ul>
          ${PKG_INCLUDED.map(inc => `<li>${e(inc)}</li>`).join('')}
        </ul>
      </div>
      <div class="inc-box inc-no">
        <h3><i class="fa fa-info-circle" style="color:#d97706;margin-right:6px"></i> What is excluded</h3>
        <ul>
          ${PKG_EXCLUDED.map(exc => `<li>${e(exc)}</li>`).join('')}
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- Questions & Answers Accordion -->
<section class="sec sec-grey">
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

<!-- Quick WhatsApp Enquiry Strip -->
<section class="sec" style="background:#fff;padding-top:0;">
  <div class="wrap">
    <div class="qband" style="border-radius:16px;">
      <div class="wrap" style="padding:0 20px;">
        <div>
          <h2>Want a Customized Kutch Tour Package?</h2>
          <p>Tell us your travel dates, number of people, and preferred places. We will create a custom itinerary with vehicle and driver within 10 minutes on WhatsApp.</p>
        </div>
        <div style="display:flex;gap:12px;flex-wrap:wrap;">
          <a href="${waLink(bizWa, 'Hi Madhavi Cab, I want to create a custom Kutch tour package.')}" class="btn btn-wa" target="_blank" rel="noopener" style="font-size:15px;padding:14px 24px;">
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
    title: 'Kutch Tour Packages from Bhuj | Rann Utsav Tours | Madhavi Cab',
    description: 'Book Kutch tour packages from Bhuj. 1N to 4N trips covering White Rann, Dholavira, Road to Heaven & Mandvi with cab and driver included. Call +91 81288 07488.',
    canonical: 'https://madhavicabkutch.com/fixed-kutch-tour-package',
    active: 'packages',
    pageSchema,
    settings,
    popularRoutes,
    content
  });
}
