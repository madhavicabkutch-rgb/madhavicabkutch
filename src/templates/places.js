// Places to visit listing template for Madhavi Cab Kutch

import { e, waLink, photo, renderLayout } from './layout.js';

export function renderPlacesPage({ places = [], settings = {}, popularRoutes = [] }) {
  const bizPhone = settings.biz_phone || '+918128807488';
  const bizPhoneD = settings.biz_phone_display || '+91 81288 07488';
  const bizWa = settings.biz_whatsapp || '918128807488';

  const placesListSchema = {
    '@context': 'https://schema.org',
    '@type': 'ItemList',
    name: 'Top Places to Visit in Kutch',
    description: 'Famous tourist destinations and sightseeing spots in Kutch, Gujarat reachable by cab from Bhuj.',
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
    <h1>Places to visit in Kutch &mdash; sightseeing from Bhuj</h1>
    <p>Discover top tourist attractions in Kutch with distances from Bhuj, route timings, and cab booking fares. From the iconic White Rann of Kutch and Harappan ruins at Dholavira to Kalo Dungar, Mandvi Beach, and Aina Mahal &mdash; plan your perfect Kutch sightseeing tour with Madhavi Cab.</p>
    <div class="cta">
      <a href="fixed-kutch-tour-package" class="btn btn-gold">See tour packages</a>
      <a href="${waLink(bizWa, 'Hi, I want to plan a sightseeing trip in Kutch.')}" class="btn btn-ghost" target="_blank" rel="noopener"><i class="fa fa-whatsapp"></i> Plan a trip</a>
    </div>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    ${places && places.length ? `
      <div class="sec-head">
        <div class="kick">DESTINATIONS</div>
        <h2>Top sightseeing destinations in Kutch by cab</h2>
        <p>All distances are one way from Bhuj city. Most can be combined into a single day, and your driver will suggest the best order.</p>
      </div>

      <div class="g4">
        ${places.map(pl => `
          <a href="place-detail?slug=${e(pl.slug)}" class="plcard">
            ${photo(pl.image, `${pl.title} in Kutch`, '&#127963;')}
            <div class="b">
              <h3>${e(pl.title)}</h3>
              <div class="dist">
                ${pl.distance_bhuj ? e(pl.distance_bhuj) + ' from Bhuj' : 'In Kutch'}
                ${pl.category ? ` &middot; ${e(pl.category)}` : ''}
              </div>
            </div>
          </a>
        `).join('')}
      </div>
    ` : `
      <div class="sec-head">
        <h2>Places are being updated</h2>
        <p>Call <a href="tel:${e(bizPhone)}" class="more">${e(bizPhoneD)}</a> and we will tell you what is worth seeing on your dates.</p>
      </div>
    `}
  </div>
</section>

<section class="sec sec-grey">
  <div class="wrap">
    <div class="sec-head">
      <div class="kick">KUTCH SIGHTSEEING ADVICE</div>
      <h2>Tips for Planning Your Kutch Trip</h2>
    </div>
    <div class="g3">
      <div class="scard">
        <h3>Sunset at White Rann</h3>
        <p>Leave Bhuj by 1:30 PM to stop at Bhirandiyara for local mawa, climb Kalo Dungar for panoramic desert views, and reach Dhordo well before the sunset.</p>
      </div>
      <div class="scard">
        <h3>Dholavira Day Run</h3>
        <p>Start early around 6:30 AM to beat the mid-day heat. Driving across the Road to Heaven with white salt flats on both sides is the highlight of the trip.</p>
      </div>
      <div class="scard">
        <h3>Permits &amp; Checkposts</h3>
        <p>White Rann checkpost permits can be processed online or directly at Bhirandiyara. Our experienced local drivers will guide and assist you through the process.</p>
      </div>
    </div>
  </div>
</section>
`;

  return renderLayout({
    title: 'Top Places to Visit in Kutch from Bhuj | Madhavi Cab',
    description: 'Top places to visit in Kutch from Bhuj: White Rann, Dholavira, Kalo Dungar & Mandvi Beach. Distances, timings & cab booking from Bhuj. Call +91 81288 07488.',
    canonical: 'https://madhavicabkutch.com/places-to-visit',
    active: 'places',
    pageSchema,
    settings,
    popularRoutes,
    content
  });
}
