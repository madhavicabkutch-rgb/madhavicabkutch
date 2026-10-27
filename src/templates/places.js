// Places to visit listing template for Madhavi Cab Kutch - Top Destinations You Shouldn't Miss

import { e, waLink, photo, renderLayout } from './layout.js';

export function renderPlacesPage({ places = [], settings = {}, popularRoutes = [] }) {
  const bizPhone = settings.biz_phone || '+918128807488';
  const bizPhoneD = settings.biz_phone_display || '+91 81288 07488';
  const bizWa = settings.biz_whatsapp || '918128807488';

  const placesListSchema = {
    '@context': 'https://schema.org',
    '@type': 'ItemList',
    name: 'Top Destinations in Kutch You Shouldn\'t Miss',
    description: 'Explore the best tourist destinations in Kutch: White Rann, Dholavira, Road to Heaven, Mandvi Beach, temples, museums and craft villages with Madhavi Cab.',
    itemListElement: places.map((pl, idx) => ({
      '@type': 'ListItem',
      position: idx + 1,
      name: pl.title
    }))
  };

  const pageSchema = `<script type="application/ld+json">\n${JSON.stringify(placesListSchema, null, 2)}\n</script>`;

  const content = `
<section class="phero">
  <div class="wrap">
    <div class="crumb"><a href="./">Home</a> &rsaquo; Places to visit</div>
    <span class="tag">Explore Kutch</span>
    <h1>Top Destinations You Shouldn't Miss in Kutch</h1>
    <p>From the endless white salt desert to 5000-year-old Harappan ruins and serene Arabian Sea beaches &mdash; discover the very best of Kutch. Reach any of these easily and comfortably with our private car rental and customized tour packages.</p>
    <div class="cta">
      <a href="fixed-kutch-tour-package" class="btn btn-gold">Explore Tour Packages</a>
      <a href="${waLink(bizWa, 'Hi Madhavi Cab, I want to plan a sightseeing trip in Kutch.')}" class="btn btn-ghost" target="_blank" rel="noopener">
        <i class="fa fa-whatsapp"></i> Plan on WhatsApp
      </a>
    </div>
  </div>
</section>

<section class="sec">
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
                <a href="${waLink(bizWa, `Hi Madhavi Cab, I want to book a taxi/package to visit ${pl.title}.`)}" class="pl-book-wa" target="_blank" rel="noopener">
                  <i class="fa fa-whatsapp"></i> Book Cab
                </a>
              </div>
            </div>
          </article>
        `).join('')}
      </div>
    ` : `
      <div style="padding:60px 20px;text-align:center;background:#fff;border-radius:18px;border:1px solid var(--line);">
        <div style="font-size:44px;margin-bottom:12px">&#127963;</div>
        <h3>Destinations are being updated</h3>
        <p style="color:var(--muted);max-width:480px;margin:8px auto 20px;">Call us or contact on WhatsApp to get complete sightseeing details and custom itineraries for your travel dates.</p>
        <a class="btn btn-gold" target="_blank" rel="noopener" href="${waLink(bizWa, 'Hi Madhavi Cab, please share Kutch sightseeing details.')}">
          <i class="fa fa-whatsapp"></i> Enquire on WhatsApp
        </a>
      </div>
    `}
  </div>
</section>

<!-- Sightseeing Tips -->
<section class="sec sec-grey">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">LOCAL ADVICE &amp; EXPERTISE</div>
      <h2>Tips for Planning Your Kutch Trip</h2>
      <p>Our experienced local drivers help you time every sunset, permit checkpost, and photo stop perfectly.</p>
    </div>
    <div class="g3">
      <div class="scard" style="background:#fff;border:1px solid var(--line);border-radius:14px;padding:22px;">
        <h3 style="font-size:18px;margin-bottom:8px;"><i class="fa fa-sun-o" style="color:var(--gold-d);margin-right:6px"></i> Sunset at White Rann</h3>
        <p style="font-size:14px;color:var(--muted);line-height:1.6;">Leave Bhuj by 1:30 PM to stop at Bhirandiyara for fresh local mawa, ascend Kalo Dungar for the panoramic desert horizon, and reach Dhordo well in time for the golden hour.</p>
      </div>
      <div class="scard" style="background:#fff;border:1px solid var(--line);border-radius:14px;padding:22px;">
        <h3 style="font-size:18px;margin-bottom:8px;"><i class="fa fa-road" style="color:var(--gold-d);margin-right:6px"></i> Dholavira &amp; Road to Heaven</h3>
        <p style="font-size:14px;color:var(--muted);line-height:1.6;">Start early around 6:30 AM to beat the mid-day heat. Driving across the 30-km elevated Road to Heaven with endless white salt flats on both horizons is a highlight of Gujarat.</p>
      </div>
      <div class="scard" style="background:#fff;border:1px solid var(--line);border-radius:14px;padding:22px;">
        <h3 style="font-size:18px;margin-bottom:8px;"><i class="fa fa-id-card-o" style="color:var(--gold-d);margin-right:6px"></i> Permits &amp; Checkposts</h3>
        <p style="font-size:14px;color:var(--muted);line-height:1.6;">White Rann checkpost permits can be issued online or directly at Bhirandiyara. Our commercial drivers will assist and guide you smoothly through the checkpost formalities.</p>
      </div>
    </div>
  </div>
</section>

<!-- Quick Booking CTA -->
<section class="sec" style="background:#fff;">
  <div class="wrap">
    <div class="qband" style="border-radius:16px;">
      <div class="wrap" style="padding:0 20px;">
        <div>
          <h2>Want to Visit Any of These Places?</h2>
          <p>Book a dedicated car with local driver for full day sightseeing or multi-day customized tour package.</p>
        </div>
        <div style="display:flex;gap:12px;flex-wrap:wrap;">
          <a href="${waLink(bizWa, 'Hi Madhavi Cab, I want to book a cab to explore Kutch places.')}" class="btn btn-wa" target="_blank" rel="noopener" style="font-size:15px;padding:14px 24px;">
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
    title: 'Top Destinations in Kutch You Shouldn\'t Miss | Madhavi Cab',
    description: 'Explore top destinations in Kutch: White Rann, Dholavira, Road to Heaven, Kalo Dungar, Mandvi Beach & Palaces. Cab rental & tour packages from Bhuj. Call +91 81288 07488.',
    canonical: 'https://madhavicabkutch.com/places-to-visit',
    active: 'places',
    pageSchema,
    settings,
    popularRoutes,
    content
  });
}
