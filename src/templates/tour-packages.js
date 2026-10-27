// Tour packages listing template for Madhavi Cab Kutch

import { e, money, waLink, photo, renderLayout } from './layout.js';
import { PACKAGES, PKG_INCLUDED, PKG_EXCLUDED } from '../data/packages.js';

export function renderTourPackagesPage({ settings = {}, popularRoutes = [] }) {
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
    <span class="tag">Vehicle and driver included</span>
    <h1>Kutch tour packages from Bhuj with cab &amp; driver</h1>
    <p>Ready-made holiday packages built around the best of Kutch &mdash; from a quick overnight sunset trip at the White Rann to a comprehensive 5-day circuit covering Dholavira, Mandvi Beach, and craft villages. Vehicle, local driver and route planning included.</p>
    <div class="cta">
      <a href="#quote" class="btn btn-gold">Plan my trip</a>
      <a href="tel:${e(bizPhone)}" class="btn btn-ghost"><i class="fa fa-phone"></i> Call ${e(bizPhoneD)}</a>
    </div>
  </div>
</section>

<div class="qstrip"><div class="wrap in">
  <div class="qi"><i class="fa fa-inr"></i> Price is per vehicle, not per person</div>
  <div class="qi"><i class="fa fa-car"></i> Dedicated cab with driver for entire tour</div>
  <div class="qi"><i class="fa fa-map-marker"></i> Pickup &amp; drop at Bhuj station/airport</div>
  <div class="qi"><i class="fa fa-calendar"></i> Flexible dates &amp; customizable routes</div>
</div></div>

<section class="sec">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">POPULAR ITINERARIES</div>
      <h2>Handcrafted Kutch Tour Packages</h2>
      <p>All packages include private vehicle, driver allowance, fuel, toll and parking. No hidden costs.</p>
    </div>

    <div class="g2">
      ${pkgList.map(p => `
        <article class="pkg-card" style="background:#fff;border:1px solid #e3e6ea;border-radius:12px;overflow:hidden;display:flex;flex-direction:column">
          ${photo(p.image, p.title, '&#127963;')}
          <div style="padding:24px;flex:1;display:flex;flex-direction:column">
            <div style="display:flex;justify-content:space-between;align-items:baseline;margin-bottom:8px">
              <span class="tag" style="margin:0;font-size:12px">${e(p.nights)}</span>
              <span style="font-size:18px;font-weight:700;color:#141b2e">From &#8377;${money(p.price)}</span>
            </div>
            <h3 style="font-size:20px;margin-bottom:8px"><a href="package-detail?p=${encodeURIComponent(p.code)}">${e(p.title)}</a></h3>
            <p style="color:#5b6b7c;font-size:14.5px;line-height:1.6;margin-bottom:16px;flex:1">${e(p.lead)}</p>

            <div style="margin-bottom:18px">
              <div style="font-size:13px;font-weight:600;color:#141b2e;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:8px">Places covered:</div>
              <ul style="padding-left:18px;font-size:13.5px;color:#39415a;line-height:1.7">
                ${p.covers.map(c => `<li>${e(c)}</li>`).join('')}
              </ul>
            </div>

            <div style="display:flex;gap:10px;margin-top:auto">
              <a href="package-detail?p=${encodeURIComponent(p.code)}" class="btn btn-primary" style="flex:1">View Itinerary</a>
              <a href="${waLink(bizWa, `Hi, I am interested in the ${p.title} (${p.short}).`)}" class="btn btn-wa" target="_blank" rel="noopener"><i class="fa fa-whatsapp"></i> Enquire</a>
            </div>
          </div>
        </article>
      `).join('')}
    </div>
  </div>
</section>

<section class="sec sec-grey">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">PACKAGE DETAILS</div>
      <h2>Inclusions &amp; Exclusions</h2>
    </div>
    <div class="g2">
      <div class="inc-box inc-yes">
        <h3>What is included</h3>
        <ul>
          ${PKG_INCLUDED.map(inc => `<li>${e(inc)}</li>`).join('')}
        </ul>
      </div>
      <div class="inc-box inc-no">
        <h3>What is excluded</h3>
        <ul>
          ${PKG_EXCLUDED.map(exc => `<li>${e(exc)}</li>`).join('')}
        </ul>
      </div>
    </div>
  </div>
</section>
`;

  return renderLayout({
    title: 'Kutch Tour Packages from Bhuj | Rann Utsav Tours | Madhavi Cab',
    description: 'Book Kutch tour packages from Bhuj. 1N to 4N trips covering White Rann, Dholavira & Mandvi with cab and driver included. Best rates. Call +91 81288 07488.',
    canonical: 'https://madhavicabkutch.com/fixed-kutch-tour-package',
    active: 'packages',
    pageSchema,
    settings,
    popularRoutes,
    content
  });
}
