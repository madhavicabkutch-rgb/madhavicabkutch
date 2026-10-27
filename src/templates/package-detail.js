// Tour package detail page template for Madhavi Cab Kutch

import { e, money, waLink, renderLayout } from './layout.js';
import { PACKAGES, PKG_INCLUDED, PKG_EXCLUDED } from '../data/packages.js';

export function renderPackageDetailPage({ code = '', settings = {}, popularRoutes = [] }) {
  const bizPhone = settings.biz_phone || '+918128807488';
  const bizPhoneD = settings.biz_phone_display || '+91 81288 07488';
  const bizWa = settings.biz_whatsapp || '918128807488';

  const p = PACKAGES[code];

  if (!p) {
    const notFoundContent = `
    <section class="phero">
      <div class="wrap">
        <h1>Package not found</h1>
        <p>The package you are looking for is not available. Have a look at the four tours we run from Bhuj.</p>
        <div class="cta">
          <a href="fixed-kutch-tour-package" class="btn btn-gold">View all packages</a>
        </div>
      </div>
    </section>
    `;
    return renderLayout({
      title: 'Package not found | Madhavi Cab Kutch',
      description: 'The tour package you are looking for is not available.',
      canonical: 'https://madhavicabkutch.com/fixed-kutch-tour-package',
      active: 'packages',
      settings,
      popularRoutes,
      content: notFoundContent
    });
  }

  const waMsg = `Hi, I am interested in the ${p.nights} Kutch tour (${p.short}).`;
  const canonical = `https://madhavicabkutch.com/package-detail?p=${encodeURIComponent(p.code)}`;
  const ogImage = `https://madhavicabkutch.com/assets/img/${p.image}`;

  const itineraryItems = p.itinerary.map((step, sidx) => ({
    '@type': 'ListItem',
    position: sidx + 1,
    name: step[0],
    description: step[1]
  }));

  const pkgSchema = {
    '@context': 'https://schema.org',
    '@type': 'TouristTrip',
    name: p.title,
    description: p.lead,
    image: ogImage,
    touristType: ['Family', 'Couple', 'Group', 'Solo Traveler'],
    offers: {
      '@type': 'Offer',
      price: p.price,
      priceCurrency: 'INR',
      availability: 'https://schema.org/InStock',
      validFrom: '2026-01-01',
      url: canonical
    },
    provider: {
      '@type': 'TravelAgency',
      name: 'MADHAVI CAB KUTCH',
      telephone: bizPhone,
      url: 'https://madhavicabkutch.com/'
    },
    itinerary: {
      '@type': 'ItemList',
      numberOfItems: itineraryItems.length,
      itemListElement: itineraryItems
    }
  };

  const pageSchema = `<script type="application/ld+json">\n${JSON.stringify(pkgSchema, null, 2)}\n</script>`;

  const otherPackages = Object.values(PACKAGES).filter(item => item.code !== p.code);

  const content = `
<section class="phero">
  <div class="wrap">
    <div class="crumb"><a href="./">Home</a> &rsaquo; <a href="fixed-kutch-tour-package">Tour packages</a> &rsaquo; ${e(p.nights)}</div>
    <span class="tag">${e(p.nights)}</span>
    <h1>${e(p.title)}</h1>
    <p>${e(p.lead)}</p>
    <div class="cta">
      <a href="${waLink(bizWa, waMsg)}" class="btn btn-gold" target="_blank" rel="noopener"><i class="fa fa-whatsapp"></i> Enquire on WhatsApp</a>
      <a href="tel:${e(bizPhone)}" class="btn btn-ghost"><i class="fa fa-phone"></i> Call ${e(bizPhoneD)}</a>
    </div>
  </div>
</section>

<div class="qstrip"><div class="wrap in">
  <div class="qi"><i class="fa fa-inr"></i> From &#8377;${money(p.price)} per vehicle</div>
  <div class="qi"><i class="fa fa-calendar"></i> ${e(p.nights)}</div>
  <div class="qi"><i class="fa fa-map-marker"></i> Starts and ends in Bhuj</div>
  <div class="qi"><i class="fa fa-car"></i> Dedicated cab with driver</div>
</div></div>

<section class="sec">
  <div class="wrap">
    <div style="display:grid;grid-template-columns:2fr 1fr;gap:40px;align-items:start">

      <div>
        <div class="sec-head" style="text-align:left;margin-bottom:24px">
          <div class="kick">DAY BY DAY SCHEDULE</div>
          <h2>Tour Itinerary</h2>
        </div>

        <div class="itin-list" style="display:flex;flex-direction:column;gap:20px;margin-bottom:40px">
          ${p.itinerary.map(item => `
            <div style="background:#fff;border:1px solid #e3e6ea;border-radius:10px;padding:22px">
              <h3 style="font-size:18px;color:#141b2e;margin-bottom:10px;display:flex;align-items:center;gap:10px">
                <span style="background:#f2b01e;color:#141b2e;width:28px;height:28px;border-radius:50%;display:grid;place-items:center;font-size:13px;font-weight:700">&#10003;</span>
                ${e(item[0])}
              </h3>
              <p style="color:#4a5568;line-height:1.7;font-size:15px;margin:0">${e(item[1])}</p>
            </div>
          `).join('')}
        </div>

        <div style="background:#f7f4ee;border:1px solid #e3e6ea;border-radius:10px;padding:24px;margin-bottom:40px">
          <h3 style="font-size:17px;margin-bottom:8px;color:#141b2e">Best time for this trip</h3>
          <p style="color:#5b6b7c;margin:0;line-height:1.6">${e(p.best)}</p>
        </div>

        <div class="g2" style="margin-bottom:30px">
          <div class="inc-box inc-yes">
            <h3>Package inclusions</h3>
            <ul>
              ${PKG_INCLUDED.map(inc => `<li>${e(inc)}</li>`).join('')}
            </ul>
          </div>
          <div class="inc-box inc-no">
            <h3>Package exclusions</h3>
            <ul>
              ${PKG_EXCLUDED.map(exc => `<li>${e(exc)}</li>`).join('')}
            </ul>
          </div>
        </div>
      </div>

      <div style="position:sticky;top:90px;background:#fff;border:1px solid #e3e6ea;border-radius:12px;padding:26px">
        <div style="font-size:13px;color:#718096;text-transform:uppercase;letter-spacing:0.5px">Package Fare</div>
        <div style="font-size:28px;font-weight:700;color:#141b2e;margin:6px 0 16px">&#8377;${money(p.price)} <span style="font-size:14px;font-weight:400;color:#718096">/ vehicle</span></div>
        <p style="font-size:14px;color:#5b6b7c;line-height:1.5;margin-bottom:20px">Covers vehicle, verified local driver, fuel, toll, parking and all transfers starting from Bhuj.</p>
        <a href="${waLink(bizWa, waMsg)}" class="btn btn-wa btn-block" style="margin-bottom:10px" target="_blank" rel="noopener">
          <i class="fa fa-whatsapp"></i> Book this package
        </a>
        <a href="tel:${e(bizPhone)}" class="btn btn-out btn-block">
          <i class="fa fa-phone"></i> Call for booking
        </a>
      </div>

    </div>
  </div>
</section>

<section class="sec sec-grey">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">OTHER OPTIONS</div>
      <h2>More Kutch Tour Packages</h2>
    </div>
    <div class="g3">
      ${otherPackages.map(op => `
        <article class="pkg-card" style="background:#fff;border:1px solid #e3e6ea;border-radius:10px;overflow:hidden;padding:20px">
          <span class="tag" style="margin-bottom:10px">${e(op.nights)}</span>
          <h3 style="font-size:18px;margin-bottom:6px"><a href="package-detail?p=${encodeURIComponent(op.code)}">${e(op.title)}</a></h3>
          <p style="font-size:14px;color:#5b6b7c;margin-bottom:14px">${e(op.short)} &middot; &#8377;${money(op.price)}</p>
          <a href="package-detail?p=${encodeURIComponent(op.code)}" class="slink">View details &rarr;</a>
        </article>
      `).join('')}
    </div>
  </div>
</section>
`;

  return renderLayout({
    title: `${p.title} from Bhuj | Madhavi Cab Kutch`,
    description: `Book ${p.nights} Kutch tour from Bhuj covering ${p.short}. AC cab and driver included from Rs ${Number(p.price).toLocaleString('en-IN')}. Call +91 81288 07488.`,
    canonical,
    active: 'packages',
    ogImage,
    pageSchema,
    settings,
    popularRoutes,
    content
  });
}
