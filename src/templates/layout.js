// Shared layout template (Header, Navigation, Topbar, Footer, Schemas)

export function e(str) {
  if (str === null || str === undefined) return '';
  return String(str)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#039;');
}

export function money(n) {
  if (n === null || n === undefined || n === '' || Number(n) === 0) return 'On request';
  return Number(n).toLocaleString('en-IN');
}

export function waLink(phone, msg) {
  const cleanPhone = String(phone || '918128807488').replace(/\D/g, '');
  return `https://wa.me/${cleanPhone}?text=${encodeURIComponent(msg || 'Hi, I would like to make an enquiry.')}`;
}

export function photo(file, alt, icon = '&#128663;', fit = 'cover') {
  if (file) {
    const cls = fit === 'contain' ? 'ph contain' : 'ph';
    return `<div class="${cls}"><img src="/assets/img/${e(file)}" alt="${e(alt)}" loading="lazy"></div>`;
  }
  return `<div class="ph">${icon}</div>`;
}

export function renderLayout({
  title = 'Car Rental & One Way Taxi in Bhuj, Kutch | Madhavi Cab Kutch',
  description = 'Car rental and one way taxi in Bhuj, Kutch. Sedans, SUVs, tempo travellers and buses with local drivers. Fixed fares, available 24x7.',
  keywords = 'car rental in bhuj, taxi service in bhuj, cab service in kutch, one way taxi bhuj, kutch tour packages, white rann cab, dholavira taxi, tempo traveller bhuj, car hire kutch',
  canonical = 'https://madhavicabkutch.com/',
  active = 'home',
  ogImage = 'https://madhavicabkutch.com/assets/img/og-image.jpg',
  pageSchema = '',
  settings = {},
  content = '',
  popularRoutes = []
}) {
  const bizName = settings.biz_name || 'Madhavi Cab Kutch';
  const bizPhone = settings.biz_phone || '+918128807488';
  const bizPhoneD = settings.biz_phone_display || '+91 81288 07488';
  const bizWa = settings.biz_whatsapp || '918128807488';
  const bizEmail = settings.biz_email || 'madhavicabkutch@gmail.com';
  const bizStreet = settings.biz_street || '4, Yogeswar Nagar';
  const bizCity = settings.biz_city || 'Bhuj, Kutch';
  const bizPin = settings.biz_pin || '370001';
  const fbUrl = settings.fb_url || 'https://www.facebook.com/ramesh.ahir.90813';
  const igUrl = settings.ig_url || 'https://www.instagram.com/madhavi_cab_kutch/';
  const bizLat = '23.2597753';
  const bizLng = '69.6435447';
  const bizMap = 'https://www.google.com/maps/place/MADHAVI+CAB+KUTCH/data=!4m2!3m1!1s0x0:0x582ca8dfc5fabc7?sa=X&ved=1t:2428&ictx=111';
  const googleReviewUrl = 'https://share.google/w1WkYmNi1OvbMWryI';
  const currentYear = new Date().getFullYear();

  // Breadcrumbs
  const bcItems = [{ name: 'Home', url: 'https://madhavicabkutch.com/' }];
  if (active === 'rental') {
    bcItems.push({ name: 'Car Rental', url: 'https://madhavicabkutch.com/vehicle-rental' });
  } else if (active === 'oneway') {
    bcItems.push({ name: 'One Way Taxi', url: 'https://madhavicabkutch.com/one-way-taxi' });
  } else if (active === 'packages') {
    bcItems.push({ name: 'Tour Packages', url: 'https://madhavicabkutch.com/fixed-kutch-tour-package' });
  } else if (active === 'places') {
    bcItems.push({ name: 'Places to Visit', url: 'https://madhavicabkutch.com/places-to-visit' });
  } else if (active === 'contact') {
    bcItems.push({ name: 'Contact', url: 'https://madhavicabkutch.com/contact' });
  }

  const bcSchemaElements = bcItems.map((bc, idx) => ({
    '@type': 'ListItem',
    position: idx + 1,
    name: bc.name,
    item: bc.url
  }));

  const globalSchema = {
    '@context': 'https://schema.org',
    '@graph': [
      {
        '@type': ['TaxiService', 'AutoRental', 'TravelAgency'],
        '@id': 'https://madhavicabkutch.com/#business',
        name: bizName,
        alternateName: ['Madhavi Cab', 'Madhavi Cab Bhuj', 'Madhavi Cab Kutch Car Rental'],
        description: 'Car rental, one way taxi, tempo traveller hire and customized Kutch tour packages operated from Bhuj, Gujarat.',
        url: 'https://madhavicabkutch.com/',
        telephone: bizPhone,
        email: bizEmail,
        logo: 'https://madhavicabkutch.com/assets/img/logo.png',
        image: 'https://madhavicabkutch.com/assets/img/og-image.jpg',
        priceRange: '₹₹',
        currenciesAccepted: 'INR',
        paymentAccepted: 'Cash, UPI, Credit Card, Debit Card, Net Banking',
        address: {
          '@type': 'PostalAddress',
          streetAddress: bizStreet,
          addressLocality: 'Bhuj',
          addressRegion: 'Gujarat',
          postalCode: bizPin,
          addressCountry: 'IN'
        },
        geo: {
          '@type': 'GeoCoordinates',
          latitude: bizLat,
          longitude: bizLng
        },
        hasMap: bizMap,
        openingHoursSpecification: {
          '@type': 'OpeningHoursSpecification',
          dayOfWeek: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
          opens: '00:00',
          closes: '23:59'
        },
        aggregateRating: {
          '@type': 'AggregateRating',
          ratingValue: '5.0',
          bestRating: '5',
          worstRating: '1',
          ratingCount: '32'
        },
        areaServed: [
          { '@type': 'City', name: 'Bhuj' },
          { '@type': 'City', name: 'Gandhidham' },
          { '@type': 'City', name: 'Mandvi' },
          { '@type': 'City', name: 'Anjar' },
          { '@type': 'City', name: 'Mundra' },
          { '@type': 'AdministrativeArea', name: 'Kutch' },
          { '@type': 'AdministrativeArea', name: 'Gujarat' }
        ],
        sameAs: [fbUrl, igUrl, bizMap, googleReviewUrl],
        hasOfferCatalog: {
          '@type': 'OfferCatalog',
          name: 'Services',
          itemListElement: [
            { '@type': 'Offer', itemOffered: { '@type': 'Service', name: 'Car rental with driver in Bhuj' } },
            { '@type': 'Offer', itemOffered: { '@type': 'Service', name: 'One way taxi from Bhuj across Gujarat' } },
            { '@type': 'Offer', itemOffered: { '@type': 'Service', name: 'Bus and tempo traveller hire in Kutch' } },
            { '@type': 'Offer', itemOffered: { '@type': 'Service', name: 'Kutch tour packages (White Rann, Dholavira, Mandvi)' } }
          ]
        }
      },
      {
        '@type': 'WebSite',
        '@id': 'https://madhavicabkutch.com/#website',
        name: bizName,
        url: 'https://madhavicabkutch.com/',
        inLanguage: 'en-IN',
        publisher: { '@id': 'https://madhavicabkutch.com/#business' }
      },
      {
        '@type': 'BreadcrumbList',
        '@id': `${canonical}#breadcrumb`,
        itemListElement: bcSchemaElements
      }
    ]
  };

  const navClass = key => (active === key ? ' class="on"' : '');

  // Popular routes list in footer
  const routesHtml = popularRoutes && popularRoutes.length
    ? popularRoutes.map(r => `<li><a href="one-way-taxi">Bhuj to ${e(r.to_city)}</a></li>`).join('')
    : `<li><a href="one-way-taxi">Bhuj to Ahmedabad</a></li>
       <li><a href="one-way-taxi">Bhuj to Rajkot</a></li>
       <li><a href="one-way-taxi">Bhuj to Dholavira</a></li>
       <li><a href="one-way-taxi">Bhuj to Mandvi</a></li>
       <li><a href="one-way-taxi">Bhuj to Dhordo</a></li>`;

  return `<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>${e(title)}</title>
<meta name="description" content="${e(description)}">
<meta name="keywords" content="${e(keywords)}">
<link rel="canonical" href="${canonical}">
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<meta name="theme-color" content="#141b2e">
<meta name="geo.region" content="IN-GJ">
<meta name="geo.placename" content="Bhuj, Kutch, Gujarat">
<meta name="geo.position" content="${bizLat};${bizLng}">
<meta name="ICBM" content="${bizLat}, ${bizLng}">

<meta property="og:site_name" content="${e(bizName)}">
<meta property="og:type" content="website">
<meta property="og:title" content="${e(title)}">
<meta property="og:description" content="${e(description)}">
<meta property="og:url" content="${canonical}">
<meta property="og:image" content="${ogImage}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="${e(title)}">
<meta property="og:locale" content="en_IN">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="${e(title)}">
<meta name="twitter:description" content="${e(description)}">
<meta name="twitter:image" content="${ogImage}">

<link rel="icon" href="/assets/img/favicon.png" type="image/png">
<link rel="apple-touch-icon" href="/assets/img/apple-touch-icon.png">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/assets/css/style-h1.css?v=2.4">

<script type="application/ld+json">
${JSON.stringify(globalSchema, null, 2)}
</script>
${pageSchema ? `\n${pageSchema}\n` : ''}
</head>
<body>

<div class="topbar">
  <div class="wrap">
    <span>${e(bizCity)} &middot; Available 24&times;7</span>
    <span>Call / WhatsApp: <a href="tel:${e(bizPhone)}">${e(bizPhoneD)}</a></span>
  </div>
</div>

<header class="hdr">
  <div class="wrap">
    <a href="/" class="logo-plate" title="Madhavi Cab Kutch - Car Rental & Taxi Service in Bhuj">
      <img src="/assets/img/logo.png" alt="${e(bizName)} - Car Rental & Taxi Service in Bhuj Kutch" onerror="this.outerHTML='<span class=\\'logo-mark\\'>M</span><span><span class=\\'logo-txt\\'>Madhavi Cab</span><span class=\\'logo-sub\\'>CAB KUTCH</span></span>'">
    </a>

    <button class="burger" id="burger" aria-label="Open menu" aria-expanded="false">&#9776;</button>

    <nav class="nav" id="nav">
      <a href="/"${navClass('home')}>Home</a>
      <a href="/vehicle-rental"${navClass('rental')}>Car Rental</a>
      <a href="/one-way-taxi"${navClass('oneway')}>One Way Taxi</a>
      <a href="/fixed-kutch-tour-package"${navClass('packages')}>Tour Packages</a>
      <a href="/places-to-visit"${navClass('places')}>Places to Visit</a>
      <a href="/contact"${navClass('contact')}>Contact</a>
      <a href="${waLink(bizWa, 'Hi, I would like to make an enquiry.')}" class="nav-cta" target="_blank" rel="noopener">Enquire Now</a>
    </nav>
  </div>
</header>

${content}

<section class="band">
  <div class="wrap">
    <div>
      <h2>Need a cab today?</h2>
      <p>Send your route on WhatsApp for an instant fare.</p>
    </div>
    <div class="band-btns">
      <a href="tel:${e(bizPhone)}" class="btn btn-ink">Call now</a>
      <a href="${waLink(bizWa, 'Hi, I need a cab. Please share the fare.')}" class="btn btn-wa" target="_blank" rel="noopener">WhatsApp</a>
    </div>
  </div>
</section>

<footer class="ftr">
  <div class="wrap">
    <div class="ftr-grid">

      <div>
        <div class="ftr-brand">
          <span class="logo-plate">
            <img src="/assets/img/logo.png" alt="${e(bizName)} - Car Rental & Taxi Service in Bhuj Kutch" loading="lazy" onerror="this.outerHTML='<span class=\\'logo-mark\\'>M</span><span><span class=\\'logo-txt\\'>Madhavi Cab</span><span class=\\'logo-sub\\'>CAB KUTCH</span></span>'">
          </span>
        </div>
        <p class="ftr-about">Car rental, one way taxi and Kutch tour packages operated from Bhuj. Fixed fares, verified local drivers and clean vehicles across Kutch and Gujarat.</p>
        <div class="social">
          <a href="${e(fbUrl)}" aria-label="Facebook" target="_blank" rel="noopener"><svg viewBox="0 0 24 24"><path d="M14 8.5V6.8c0-.7.2-1.1 1.2-1.1H17V2.6c-.5-.1-1.4-.2-2.4-.2-2.4 0-4 1.4-4 4v2.1H8V12h2.6v9H14v-9h2.6l.4-3.5H14z"/></svg></a>
          <a href="${e(igUrl)}" aria-label="Instagram" target="_blank" rel="noopener"><svg viewBox="0 0 24 24"><path d="M12 2.2c3.2 0 3.6 0 4.9.1 1.2.1 1.8.2 2.2.4.6.2 1 .5 1.4.9.4.4.7.8.9 1.4.2.4.4 1 .4 2.2.1 1.3.1 1.7.1 4.9s0 3.6-.1 4.9c-.1 1.2-.2 1.8-.4 2.2-.2.6-.5 1-.9 1.4-.4.4-.8.7-1.4.9-.4.2-1 .4-2.2.4-1.3.1-1.7.1-4.9.1s-3.6 0-4.9-.1c-1.2-.1-1.8-.2-2.2-.4-.6-.2-1-.5-1.4-.9-.4-.4-.7-.8-.9-1.4-.2-.4-.4-1-.4-2.2-.1-1.3-.1-1.7-.1-4.9s0-3.6.1-4.9c.1-1.2.2-1.8.4-2.2.2-.6.5-1 .9-1.4.4-.4.8-.7 1.4-.9.4-.2 1-.4 2.2-.4 1.3-.1 1.7-.1 4.9-.1zm0 3.8a6 6 0 100 12 6 6 0 000-12zm0 9.9a3.9 3.9 0 110-7.8 3.9 3.9 0 010 7.8zm7.6-10.1a1.4 1.4 0 11-2.8 0 1.4 1.4 0 012.8 0z"/></svg></a>
        </div>
      </div>

      <div>
        <h4>Quick links</h4>
        <ul class="ftr-list">
          <li><a href="/">Home</a></li>
          <li><a href="/vehicle-rental">Car rental in Bhuj</a></li>
          <li><a href="/one-way-taxi">One way taxi</a></li>
          <li><a href="/fixed-kutch-tour-package">Kutch tour packages</a></li>
          <li><a href="/places-to-visit">Places to visit in Kutch</a></li>
          <li><a href="/contact">Contact us</a></li>
        </ul>
      </div>

      <div>
        <h4>Popular routes</h4>
        <ul class="ftr-list">
          ${routesHtml}
          <li><a href="/one-way-taxi" class="ftr-more">View all routes &rarr;</a></li>
        </ul>
      </div>

      <div>
        <h4>Contact us</h4>
        <div class="ftr-g-badge">
          <a href="${googleReviewUrl}" target="_blank" rel="noopener" title="View MADHAVI CAB KUTCH reviews on Google">
            <svg viewBox="0 0 24 24" width="16" height="16" style="flex-shrink:0"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/></svg>
            <span class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
            <strong>5.0 Google Rating</strong>
          </a>
        </div>
        <ul class="ftr-list ftr-contact">
          <li><i class="fa fa-phone fi"></i><a href="tel:${e(bizPhone)}">${e(bizPhoneD)}</a></li>
          <li><i class="fa fa-envelope-o fi"></i><a href="mailto:${e(bizEmail)}">${e(bizEmail)}</a></li>
          <li><i class="fa fa-map-marker fi"></i><a href="${bizMap}" target="_blank" rel="noopener">MADHAVI CAB KUTCH, Bhuj</a></li>
        </ul>
        <a href="${waLink(bizWa, 'Hi, I would like to make an enquiry.')}" class="btn btn-wa btn-sm ftr-wa" target="_blank" rel="noopener">Chat on WhatsApp</a>
      </div>

    </div>

    <div class="ftr-policy">
      <a href="/cancellation-policy">Cancellation policy</a>
      <span>&middot;</span>
      <a href="/privacy-policy">Privacy policy</a>
      <span>&middot;</span>
      <a href="/terms">Terms and conditions</a>
    </div>

    <div class="ftr-bot">
      <span>&copy; ${currentYear} ${e(bizName)}. All rights reserved.</span>
      <span class="credit">Designed and developed by <a href="https://khushicreativetech.in" target="_blank" rel="noopener">Khushi Creative Tech</a></span>
    </div>
  </div>
</footer>

<a href="${waLink(bizWa, 'Hi, I would like to make an enquiry.')}" class="wa-float" aria-label="Chat on WhatsApp" target="_blank" rel="noopener"><i class="fa fa-whatsapp"></i></a>

<nav class="mbar" aria-label="Quick contact">
  <a href="tel:${e(bizPhone)}"><i class="fa fa-phone"></i>Call</a>
  <a href="${waLink(bizWa, 'Hi, I would like to make an enquiry.')}" target="_blank" rel="noopener"><i class="fa fa-whatsapp"></i>WhatsApp</a>
  <a href="/contact"><i class="fa fa-pencil-square-o"></i>Enquiry</a>
</nav>

<script>
/* mobile menu */
var b=document.getElementById('burger'),n=document.getElementById('nav');
if(b&&n){
  b.addEventListener('click',function(){
    var o=n.classList.toggle('open');
    b.setAttribute('aria-expanded',o);
  });
}

/* hero slider */
(function(){
  var hero=document.getElementById('hero');
  if(!hero) return;
  var slides=hero.querySelectorAll('.slide');
  var dotBox=document.getElementById('dots');
  if(slides.length<2||!dotBox) return;

  var i=0,timer=null;

  slides.forEach(function(s,k){
    var d=document.createElement('span');
    if(k===0) d.className='on';
    d.setAttribute('role','button');
    d.setAttribute('aria-label','Slide '+(k+1));
    d.addEventListener('click',function(){ go(k); reset(); });
    dotBox.appendChild(d);
  });
  var dots=dotBox.querySelectorAll('span');

  function go(k){
    slides[i].classList.remove('on');
    dots[i].classList.remove('on');
    i=k;
    slides[i].classList.add('on');
    dots[i].classList.add('on');
  }
  function next(){ go((i+1)%slides.length); }
  function reset(){ if(timer) clearInterval(timer); timer=setInterval(next,6000); }

  if(!window.matchMedia('(prefers-reduced-motion: reduce)').matches){ reset(); }
})();
</script>

</body>
</html>`;
}
