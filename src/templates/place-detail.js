// Sightseeing place detail page template for Madhavi Cab Kutch

import { e, waLink, photo, renderLayout } from './layout.js';

export function renderPlaceDetailPage({ slug = '', place = null, others = [], settings = {}, popularRoutes = [] }) {
  const bizPhone = settings.biz_phone || '+918128807488';
  const bizPhoneD = settings.biz_phone_display || '+91 81288 07488';
  const bizWa = settings.biz_whatsapp || '918128807488';
  const bizName = settings.biz_name || 'Madhavi Cab Kutch';

  if (!place) {
    const notFoundContent = `
    <section class="phero">
      <div class="wrap">
        <h1>Place not found</h1>
        <p>The place you are looking for is not available. Have a look at everything worth seeing in Kutch.</p>
        <div class="cta">
          <a href="places-to-visit" class="btn btn-gold">All places in Kutch</a>
        </div>
      </div>
    </section>
    `;
    return renderLayout({
      title: 'Place not found | Madhavi Cab Kutch',
      description: 'The place you are looking for is not available.',
      canonical: 'https://madhavicabkutch.com/places-to-visit',
      active: 'places',
      settings,
      popularRoutes,
      content: notFoundContent
    });
  }

  const canonical = `https://madhavicabkutch.com/place-detail?slug=${encodeURIComponent(place.slug)}`;
  const ogImage = place.image
    ? (place.image.startsWith('http') ? place.image : `https://madhavicabkutch.com/assets/img/${place.image}`)
    : 'https://madhavicabkutch.com/assets/img/og-image.jpg';

  const placeSchema = {
    '@context': 'https://schema.org',
    '@type': 'TouristAttraction',
    name: place.title,
    description: place.short_desc || `${place.title} tourist attraction in Kutch, Gujarat.`,
    url: canonical,
    image: ogImage,
    isAccessibleForFree: true,
    publicAccess: true,
    address: {
      '@type': 'PostalAddress',
      addressLocality: 'Kutch',
      addressRegion: 'Gujarat',
      addressCountry: 'IN'
    },
    provider: {
      '@type': 'TaxiService',
      name: bizName,
      telephone: bizPhone,
      url: 'https://madhavicabkutch.com/'
    }
  };

  const pageSchema = `<script type="application/ld+json">\n${JSON.stringify(placeSchema, null, 2)}\n</script>`;
  const waMsg = `Hi, I want to visit ${place.title}. Please share the cab fare from Bhuj.`;

  const content = `
<section class="phero">
  <div class="wrap">
    <div class="crumb"><a href="./">Home</a> &rsaquo; <a href="places-to-visit">Places to visit</a> &rsaquo; ${e(place.title)}</div>
    ${place.category ? `<span class="tag">${e(place.category)}</span>` : ''}
    <h1>${e(place.title)}</h1>
    ${place.short_desc ? `<p>${e(place.short_desc)}</p>` : ''}
    <div class="cta">
      <a href="${waLink(bizWa, waMsg)}" class="btn btn-gold" target="_blank" rel="noopener"><i class="fa fa-whatsapp"></i> Book a cab for this trip</a>
      <a href="tel:${e(bizPhone)}" class="btn btn-ghost"><i class="fa fa-phone"></i> Call ${e(bizPhoneD)}</a>
    </div>
  </div>
</section>

<div class="qstrip"><div class="wrap in">
  <div class="qi"><i class="fa fa-map-marker"></i> ${place.distance_bhuj ? e(place.distance_bhuj) + ' from Bhuj' : 'In Kutch'}</div>
  <div class="qi"><i class="fa fa-calendar"></i> ${place.best_time ? e(place.best_time) : 'Open all year'}</div>
  <div class="qi"><i class="fa fa-car"></i> Cab and driver available 24&times;7</div>
</div></div>

<section class="sec">
  <div class="wrap">
    <div class="place-body">
      ${place.image ? `
        <div class="place-hero" style="border-radius:12px;overflow:hidden;margin-bottom:30px;max-height:460px">
          <img src="assets/img/${e(place.image)}" alt="${e(place.title)} in Kutch - Cab Sightseeing Tour from Bhuj" style="width:100%;height:100%;object-fit:cover" loading="lazy">
        </div>
      ` : ''}

      ${place.description ? `
        <div class="place-prose" style="font-size:16px;line-height:1.8;color:#2d3748;margin-bottom:40px">
          <p>${e(place.description)}</p>
        </div>
      ` : ''}

      <div class="place-cta" style="background:#f7f4ee;border:1px solid #e3e6ea;border-radius:12px;padding:28px;margin-bottom:40px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:16px">
        <div>
          <h3 style="font-size:20px;margin-bottom:4px;color:#141b2e">Plan your visit to ${e(place.title)}</h3>
          <p style="color:#5b6b7c;margin:0">Pickup from hotel, Bhuj railway station or airport. Return drop included.</p>
        </div>
        <div style="display:flex;gap:12px">
          <a href="${waLink(bizWa, waMsg)}" class="btn btn-wa" target="_blank" rel="noopener"><i class="fa fa-whatsapp"></i> Instant Quote on WhatsApp</a>
          <a href="tel:${e(bizPhone)}" class="btn btn-primary"><i class="fa fa-phone"></i> Call Now</a>
        </div>
      </div>
    </div>
  </div>
</section>

${others && others.length ? `
<section class="sec sec-grey">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">MORE SIGHTSEEING</div>
      <h2>Other Places to Visit in Kutch</h2>
    </div>
    <div class="g4">
      ${others.map(op => `
        <a href="place-detail?slug=${e(op.slug)}" class="plcard">
          ${photo(op.image, `${op.title} in Kutch`, '&#127963;')}
          <div class="b">
            <h3>${e(op.title)}</h3>
            <div class="dist">${op.distance_bhuj ? e(op.distance_bhuj) + ' from Bhuj' : 'In Kutch'}</div>
          </div>
        </a>
      `).join('')}
    </div>
  </div>
</section>
` : ''}
`;

  return renderLayout({
    title: `${place.title} in Kutch | Sightseeing from Bhuj | Madhavi Cab`,
    description: `Visit ${place.title} in Kutch. Distance from Bhuj, timings, route tips and cab booking with experienced driver. Call +91 81288 07488.`,
    canonical,
    active: 'places',
    ogImage,
    pageSchema,
    settings,
    popularRoutes,
    content
  });
}
