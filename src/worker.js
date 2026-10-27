// Cloudflare Worker: Router, SSR Engine, Admin API, and Static Asset Gateway

import { renderLayout } from './templates/layout.js';
import { renderHomePage } from './templates/home.js';
import { renderVehicleRentalPage } from './templates/vehicle-rental.js';
import { renderOneWayTaxiPage } from './templates/one-way-taxi.js';
import { renderTourPackagesPage } from './templates/tour-packages.js';
import { renderPackageDetailPage } from './templates/package-detail.js';
import { renderPlacesPage } from './templates/places.js';
import { renderPlaceDetailPage } from './templates/place-detail.js';
import { renderContactPage } from './templates/contact.js';
import {
  renderCancellationPolicyPage,
  renderPrivacyPolicyPage,
  renderTermsPage
} from './templates/legal.js';
import {
  getSession,
  verifyPassword,
  hashPassword,
  createSessionToken,
  makeSessionCookie,
  clearSessionCookie
} from './auth.js';

// Default fallback data when D1 is not bound or during connection fallback
const FALLBACK_SETTINGS = {
  biz_name: 'Madhavi Cab Kutch',
  biz_phone: '+918128807488',
  biz_phone_display: '+91 81288 07488',
  biz_whatsapp: '918128807488',
  biz_email: 'madhavicabkutch@gmail.com',
  biz_street: '4, Yogeswar Nagar',
  biz_city: 'Bhuj, Kutch',
  biz_pin: '370001',
  fb_url: 'https://www.facebook.com/ramesh.ahir.90813',
  ig_url: 'https://www.instagram.com/madhavi_cab_kutch/',
  stat_years: '12+',
  stat_vehicles: '40+',
  stat_support: '24×7'
};

const FALLBACK_ROUTES = [
  { id: 1, from_city: 'Bhuj', to_city: 'Ahmedabad', slug: 'bhuj-to-ahmedabad', distance_km: 335, duration: '6.5 hours', sedan_fare: 4500, suv_fare: 6200, tempo_fare: 11000, show_on_home: 1, sort_order: 1, is_active: 1 },
  { id: 2, from_city: 'Bhuj', to_city: 'Rajkot', slug: 'bhuj-to-rajkot', distance_km: 235, duration: '4.5 hours', sedan_fare: 3500, suv_fare: 4800, tempo_fare: 8500, show_on_home: 1, sort_order: 2, is_active: 1 },
  { id: 3, from_city: 'Bhuj', to_city: 'Dholavira', slug: 'bhuj-to-dholavira', distance_km: 215, duration: '4.0 hours', sedan_fare: 5000, suv_fare: 6500, tempo_fare: 11500, show_on_home: 1, sort_order: 3, is_active: 1 },
  { id: 4, from_city: 'Bhuj', to_city: 'Mandvi', slug: 'bhuj-to-mandvi', distance_km: 60, duration: '1.2 hours', sedan_fare: 1500, suv_fare: 2200, tempo_fare: 4000, show_on_home: 1, sort_order: 4, is_active: 1 },
  { id: 5, from_city: 'Bhuj', to_city: 'Dhordo (White Rann)', slug: 'bhuj-to-dhordo-white-rann', distance_km: 85, duration: '1.8 hours', sedan_fare: 2200, suv_fare: 3000, tempo_fare: 5500, show_on_home: 1, sort_order: 5, is_active: 1 },
  { id: 6, from_city: 'Bhuj', to_city: 'Vadodara', slug: 'bhuj-to-vadodara', distance_km: 445, duration: '8.0 hours', sedan_fare: 6500, suv_fare: 8800, tempo_fare: 15500, show_on_home: 1, sort_order: 6, is_active: 1 },
  { id: 7, from_city: 'Bhuj', to_city: 'Surat', slug: 'bhuj-to-surat', distance_km: 590, duration: '11.0 hours', sedan_fare: 8500, suv_fare: 11500, tempo_fare: 20000, show_on_home: 0, sort_order: 7, is_active: 1 },
  { id: 8, from_city: 'Bhuj', to_city: 'Jamnagar', slug: 'bhuj-to-jamnagar', distance_km: 260, duration: '5.0 hours', sedan_fare: 4000, suv_fare: 5500, tempo_fare: 9500, show_on_home: 0, sort_order: 8, is_active: 1 },
  { id: 9, from_city: 'Bhuj', to_city: 'Gandhidham', slug: 'bhuj-to-gandhidham', distance_km: 58, duration: '1.0 hour', sedan_fare: 1400, suv_fare: 2000, tempo_fare: 3500, show_on_home: 0, sort_order: 9, is_active: 1 }
];

const FALLBACK_PLACES = [
  {
    id: 1,
    title: 'White Desert (Great Rann of Kutch)',
    slug: 'white-rann',
    category: 'Salt Desert',
    distance_bhuj: '85 km',
    best_time: 'Nov to Feb (Sunset & Full Moon)',
    short_desc: 'The world-famous salt desert of Dhordo. Vast stretches of pristine white salt, cultural performances during Rann Utsav, and unforgettable sunsets.',
    description: 'The Great Rann of Kutch is a seasonal salt marsh located in the Thar Desert in the Kutch District of Gujarat. Dhordo is the gateway to the White Rann where tourists flock during the world-famous Rann Utsav. Experience unforgettable sunsets across miles of shimmering salt crust.',
    image: 'white-rann.jpg',
    sort_order: 1,
    is_active: 1
  },
  {
    id: 2,
    title: 'Dholavira Harappan Civilization Site',
    slug: 'dholavira',
    category: 'UNESCO World Heritage',
    distance_bhuj: '215 km',
    best_time: 'Oct to Mar (Early morning start recommended)',
    short_desc: 'Ancient 5000-year-old Indus Valley metropolis with monumental water reservoirs, accessed via the breathtaking Road to Heaven across the Rann.',
    description: 'Dholavira is an archaeological site at Khadirbet in Bhachau Taluka of Kutch. It is one of the five largest Harappan sites and the most prominent archaeological site in India belonging to the Indus Valley Civilization. The journey via the elevated Road to Heaven across salt flats is a once-in-a-lifetime drive.',
    image: 'dholavira.jpg',
    sort_order: 2,
    is_active: 1
  },
  {
    id: 3,
    title: 'Kalo Dungar (Black Hill)',
    slug: 'kalo-dungar',
    category: 'Scenic Viewpoint',
    distance_bhuj: '95 km',
    best_time: 'Oct to Mar (Late afternoon for sunset)',
    short_desc: 'The highest point in Kutch at 462 meters, offering panoramic views where the horizon dissolves into the great white salt plains. Famous 400-year-old Dattatreya Temple.',
    description: 'Kalo Dungar is the highest point in Kutch, Gujarat, at 462 m above sea level. It offers a spectacular panoramic view of the Great Rann of Kutch. The 400-year-old Dattatreya temple at the top is known for the daily jackal feeding ritual. Combine this trip with Dhordo White Rann on the same afternoon.',
    image: 'kalo-dungar.jpg',
    sort_order: 3,
    is_active: 1
  },
  {
    id: 4,
    title: 'Mandvi Beach & Vijay Vilas Palace',
    slug: 'mandvi-beach',
    category: 'Coast & Heritage',
    distance_bhuj: '60 km',
    best_time: 'Open all year (Pleasant evenings)',
    short_desc: 'Peaceful Arabian Sea coastline with soft sands, camel rides, and the grand red sandstone Vijay Vilas Palace set in private coastal grounds.',
    description: 'Mandvi was once a major port town of the Kutch region and features a clean golden sand beach along the Arabian Sea. Nearby lies Vijay Vilas Palace, a grand royal summer retreat built in 1929 featuring eclectic Rajput architecture and manicured beachside grounds.',
    image: 'mandvi.jpg',
    sort_order: 4,
    is_active: 1
  },
  {
    id: 5,
    title: 'Aina Mahal & Prag Mahal',
    slug: 'aina-mahal',
    category: 'Bhuj Heritage',
    distance_bhuj: 'Within Bhuj City',
    best_time: 'Open all year (9:00 AM - 12:00 PM & 3:00 PM - 6:00 PM)',
    short_desc: 'The Palace of Mirrors with Venetian glass, European mirrors and gilded carvings, paired with Prag Mahal\'s majestic Gothic-style clock tower.',
    description: 'Located inside the heart of old Bhuj, the Aina Mahal (Mirror Palace) was built by Rao Lakhpatji in 1752, mastercrafted by the legendary artisan Ramsinh Malam. Adjacent stands the Prag Mahal with its 45-foot bell tower and grand Italian Gothic design.',
    image: 'aina-mahel-bhuj-hariom.webp',
    sort_order: 5,
    is_active: 1
  },
  {
    id: 6,
    title: 'Road to Heaven',
    slug: 'road-to-heaven',
    category: 'Scenic Drive',
    distance_bhuj: '180 km from Bhuj',
    best_time: 'Oct to Mar',
    short_desc: 'A spectacular 30-km highway cutting straight through the shimmering White Rann on both sides on the route to Khadir Bet island.',
    description: 'The newly constructed highway connecting Khavda to Dholavira cuts directly through the salt flats of the Great Rann. Known popularly as the Road to Heaven, travelers stop along the elevated tarmac for surreal photos with endless white desert on both horizons.',
    image: 'road-to-heaven-hariom.jpg',
    sort_order: 6,
    is_active: 1
  }
];

const FALLBACK_VEHICLES = [
  {
    id: 1,
    name: 'Swift Dzire / Toyota Etios',
    category: 'Car',
    models: 'Swift Dzire, Toyota Etios',
    seats: '4',
    luggage: '2 Bags',
    per_km: '12',
    description: 'Comfortable air-conditioned sedan ideal for airport transfers, city travel in Bhuj, and small family trips across Kutch.',
    image: 'sedan.jpg',
    sort_order: 1,
    is_active: 1,
    local_8h_80km_ac: '2,000',
    local_8h_80km_nonac: '1,800',
    local_12h_300km_ac: '3,500',
    local_12h_300km_nonac: '3,000',
    extra_km_ac: '12/km',
    airport_transfer: '800',
    daily_min_km: 300,
    driver_night_allowance: '300'
  },
  {
    id: 2,
    name: 'Maruti Ertiga',
    category: 'Car',
    models: 'Maruti Suzuki Ertiga',
    seats: '6-7',
    luggage: '3-4 Bags',
    per_km: '15',
    description: 'Spacious MUV with flexible seating, great fuel efficiency, and ample legroom. Excellent for family day trips to White Rann and Dholavira.',
    image: 'suv.jpg',
    sort_order: 2,
    is_active: 1,
    local_8h_80km_ac: '2,800',
    local_8h_80km_nonac: '2,400',
    local_12h_300km_ac: '4,800',
    local_12h_300km_nonac: '4,200',
    extra_km_ac: '15/km',
    airport_transfer: '1,200',
    daily_min_km: 300,
    driver_night_allowance: '350'
  },
  {
    id: 3,
    name: 'Toyota Innova Crysta',
    category: 'Car',
    models: 'Toyota Innova Crysta',
    seats: '6-7',
    luggage: '4 Bags',
    per_km: '19',
    description: 'Premium long-distance comfort with captain seats, powerful dual AC, and unmatched ride quality for outstation Gujarat tours.',
    image: 'innova.jpg',
    sort_order: 3,
    is_active: 1,
    local_8h_80km_ac: '3,500',
    local_8h_80km_nonac: '3,000',
    local_12h_300km_ac: '6,000',
    local_12h_300km_nonac: '5,200',
    extra_km_ac: '19/km',
    airport_transfer: '1,500',
    daily_min_km: 300,
    driver_night_allowance: '400'
  },
  {
    id: 4,
    name: 'Tempo Traveller (12-17 Seater)',
    category: 'Bus',
    models: 'Force Tempo Traveller 12-17 Seats',
    seats: '12-17',
    luggage: '8-12 Bags',
    per_km: '24',
    description: 'High-roof AC luxury tempo traveller with pushback seats, individual AC vents, and large luggage capacity for groups and corporate tours.',
    image: 'tempo-traveller.jpg',
    sort_order: 4,
    is_active: 1,
    local_8h_80km_ac: '4,500',
    local_8h_80km_nonac: '3,800',
    local_12h_300km_ac: '8,000',
    local_12h_300km_nonac: '7,000',
    extra_km_ac: '24/km',
    airport_transfer: '2,500',
    daily_min_km: 300,
    driver_night_allowance: '500'
  },
  {
    id: 5,
    name: 'Mini Bus / Luxury Coach',
    category: 'Bus',
    models: '24-56 Seater Luxury Coach',
    seats: '24-56',
    luggage: 'Full Coach Luggage Boot',
    per_km: '38',
    description: 'Deluxe 2x2 pushback buses with air suspension, PA system, and experienced highway drivers for wedding parties, schools, and pilgrim tours.',
    image: 'bus.jpg',
    sort_order: 5,
    is_active: 1,
    local_8h_80km_ac: '7,500',
    local_8h_80km_nonac: '6,500',
    local_12h_300km_ac: '13,000',
    local_12h_300km_nonac: '11,500',
    extra_km_ac: '38/km',
    airport_transfer: '4,500',
    daily_min_km: 350,
    driver_night_allowance: '600'
  },
  {
    id: 6,
    name: 'Toyota Fortuner',
    category: 'Premium',
    models: 'Toyota Fortuner 4x4 / 4x2',
    seats: '6-7',
    luggage: '4 Bags',
    per_km: '35',
    description: 'Executive VIP SUV for corporate delegates, luxury desert safaris, and VIP arrivals in Bhuj.',
    image: 'fortuner.jpg',
    sort_order: 6,
    is_active: 1,
    local_8h_80km_ac: '6,500',
    local_8h_80km_nonac: '',
    local_12h_300km_ac: '11,500',
    local_12h_300km_nonac: '',
    extra_km_ac: '35/km',
    airport_transfer: '3,000',
    daily_min_km: 300,
    driver_night_allowance: '500'
  }
];

// Database query helpers with fallback
async function getSettings(env) {
  if (!env?.DB) return FALLBACK_SETTINGS;
  try {
    const res = await env.DB.prepare('SELECT setting_key, setting_value FROM settings').all();
    if (res.results && res.results.length) {
      const out = { ...FALLBACK_SETTINGS };
      for (const row of res.results) {
        if (row.setting_value) out[row.setting_key] = row.setting_value;
      }
      return out;
    }
  } catch (err) {}
  return FALLBACK_SETTINGS;
}

async function getPopularRoutes(env) {
  if (!env?.DB) return FALLBACK_ROUTES.slice(0, 5);
  try {
    const res = await env.DB.prepare('SELECT to_city FROM routes WHERE is_active=1 ORDER BY sort_order ASC, id ASC LIMIT 5').all();
    if (res.results && res.results.length) return res.results;
  } catch (err) {}
  return FALLBACK_ROUTES.slice(0, 5);
}

async function getRoutes(env, onlyHome = false) {
  if (!env?.DB) {
    return onlyHome ? FALLBACK_ROUTES.filter(r => r.show_on_home) : FALLBACK_ROUTES;
  }
  try {
    const sql = onlyHome
      ? 'SELECT * FROM routes WHERE is_active=1 AND show_on_home=1 ORDER BY sort_order ASC, id ASC LIMIT 6'
      : 'SELECT * FROM routes WHERE is_active=1 ORDER BY sort_order ASC, id ASC';
    const res = await env.DB.prepare(sql).all();
    if (res.results && res.results.length) return res.results;
  } catch (err) {}
  return onlyHome ? FALLBACK_ROUTES.filter(r => r.show_on_home) : FALLBACK_ROUTES;
}

async function getPlaces(env, limit = null) {
  if (!env?.DB) {
    return limit ? FALLBACK_PLACES.slice(0, limit) : FALLBACK_PLACES;
  }
  try {
    const sql = limit
      ? `SELECT * FROM places WHERE is_active=1 ORDER BY sort_order ASC, id ASC LIMIT ${Number(limit)}`
      : 'SELECT * FROM places WHERE is_active=1 ORDER BY sort_order ASC, id ASC';
    const res = await env.DB.prepare(sql).all();
    if (res.results && res.results.length) return res.results;
  } catch (err) {}
  return limit ? FALLBACK_PLACES.slice(0, limit) : FALLBACK_PLACES;
}

async function getPlaceBySlug(env, slug) {
  if (!env?.DB) {
    return FALLBACK_PLACES.find(p => p.slug === slug) || null;
  }
  try {
    const res = await env.DB.prepare('SELECT * FROM places WHERE slug=? AND is_active=1 LIMIT 1').bind(slug).first();
    if (res) return res;
  } catch (err) {}
  return FALLBACK_PLACES.find(p => p.slug === slug) || null;
}

async function getVehicles(env, category = null) {
  if (!env?.DB) {
    return category ? FALLBACK_VEHICLES.filter(v => v.category === category) : FALLBACK_VEHICLES;
  }
  try {
    const sql = category
      ? 'SELECT * FROM vehicles WHERE is_active=1 AND category=? ORDER BY sort_order ASC, id ASC'
      : 'SELECT * FROM vehicles WHERE is_active=1 ORDER BY sort_order ASC, id ASC';
    const stmt = category ? env.DB.prepare(sql).bind(category) : env.DB.prepare(sql);
    const res = await stmt.all();
    if (res.results && res.results.length) return res.results;
  } catch (err) {}
  return category ? FALLBACK_VEHICLES.filter(v => v.category === category) : FALLBACK_VEHICLES;
}

// Helper: Response with HTML
function htmlResponse(html, status = 200) {
  return new Response(html, {
    status,
    headers: {
      'Content-Type': 'text/html; charset=UTF-8',
      'X-Content-Type-Options': 'nosniff'
    }
  });
}

// Helper: JSON response
function jsonResponse(data, status = 200, headers = {}) {
  return new Response(JSON.stringify(data), {
    status,
    headers: {
      'Content-Type': 'application/json',
      ...headers
    }
  });
}

export default {
  async fetch(request, env, ctx) {
    const url = new URL(request.url);
    const path = url.pathname;
    const method = request.method;

    // 1. Redirect legacy *.php URLs to extensionless clean URLs (HTTP 301 Permanent Redirect)
    // Matches existing .htaccess and router.php behavior
    if (path.endsWith('.php')) {
      const cleanPath = path.replace(/\.php$/, '');
      const redirectTarget = (cleanPath === '/index' || cleanPath === '') ? '/' : cleanPath;
      const targetUrl = new URL(redirectTarget, url.origin);
      targetUrl.search = url.search;
      return Response.redirect(targetUrl.toString(), 301);
    }

    // 2. Serve static assets via Cloudflare Workers Static Assets binding (env.ASSETS)
    if (
      path.startsWith('/assets/') ||
      path === '/robots.txt' ||
      path === '/sitemap.xml' ||
      path === '/google3ebd36e3d137923c.html' ||
      path === '/favicon.ico'
    ) {
      if (env.ASSETS) {
        return await env.ASSETS.fetch(request);
      }
    }

    // 3. Admin SPA routing: /admin or /admin/
    if (path === '/admin' || path === '/admin/' || path === '/admin/index.html') {
      if (env.ASSETS) {
        const assetUrl = new URL('/admin/index.html', url.origin);
        return await env.ASSETS.fetch(new Request(assetUrl, request));
      }
    }

    // 4. API Endpoints
    if (path.startsWith('/api/')) {

      // Public API: /api/routes
      if (path === '/api/routes' && method === 'GET') {
        const routes = await getRoutes(env);
        return jsonResponse(routes);
      }

      // Public API: /api/places
      if (path === '/api/places' && method === 'GET') {
        const places = await getPlaces(env);
        return jsonResponse(places);
      }

      // Public API: /api/vehicles
      if (path === '/api/vehicles' && method === 'GET') {
        const cat = url.searchParams.get('category');
        const vehicles = await getVehicles(env, cat);
        return jsonResponse(vehicles);
      }

      // Admin API: /api/admin/login
      if (path === '/api/admin/login' && method === 'POST') {
        try {
          const body = await request.json();
          const { username, password } = body;
          if (!username || !password) {
            return jsonResponse({ error: 'Username and password required.' }, 400);
          }

          let user = null;
          if (env.DB) {
            try {
              user = await env.DB.prepare('SELECT id, username, password_hash FROM admin_users WHERE username=? LIMIT 1').bind(username).first();
            } catch (e) {}
          }

          // Fallback admin check if DB is empty/unseeded
          if (!user && username === 'admin') {
            user = { id: 1, username: 'admin', password_hash: '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918' };
          }

          if (!user || !(await verifyPassword(password, user.password_hash))) {
            return jsonResponse({ error: 'Invalid username or password.' }, 401);
          }

          const token = await createSessionToken({ admin_id: user.id, username: user.username }, env);
          return jsonResponse({ ok: true, username: user.username }, 200, {
            'Set-Cookie': makeSessionCookie(token)
          });
        } catch (err) {
          return jsonResponse({ error: 'Login request error.' }, 500);
        }
      }

      // Admin API: /api/admin/logout
      if (path === '/api/admin/logout' && method === 'POST') {
        return jsonResponse({ ok: true }, 200, {
          'Set-Cookie': clearSessionCookie()
        });
      }

      // Authentication guard for remaining /api/admin/* endpoints
      if (path.startsWith('/api/admin/')) {
        const session = await getSession(request, env);
        if (!session) {
          return jsonResponse({ error: 'Unauthorized' }, 401);
        }

        // GET /api/admin/me
        if (path === '/api/admin/me' && method === 'GET') {
          return jsonResponse({ ok: true, username: session.username });
        }

        // GET /api/admin/stats
        if (path === '/api/admin/stats' && method === 'GET') {
          let nRoutes = FALLBACK_ROUTES.length;
          let nPlaces = FALLBACK_PLACES.length;
          let nVehicles = FALLBACK_VEHICLES.length;
          if (env.DB) {
            try {
              const r1 = await env.DB.prepare('SELECT COUNT(*) as c FROM routes WHERE is_active=1').first();
              const r2 = await env.DB.prepare('SELECT COUNT(*) as c FROM places WHERE is_active=1').first();
              const r3 = await env.DB.prepare('SELECT COUNT(*) as c FROM vehicles WHERE is_active=1').first();
              if (r1) nRoutes = r1.c;
              if (r2) nPlaces = r2.c;
              if (r3) nVehicles = r3.c;
            } catch (e) {}
          }
          return jsonResponse({ routes: nRoutes, places: nPlaces, vehicles: nVehicles });
        }

        // CRUD /api/admin/routes
        if (path === '/api/admin/routes') {
          if (method === 'GET') {
            const routes = await getRoutes(env);
            return jsonResponse(routes);
          }
          if (method === 'POST') {
            const b = await request.json();
            const slug = (b.from_city + '-to-' + b.to_city).toLowerCase().replace(/[^a-z0-9]+/g, '-');
            if (env.DB) {
              await env.DB.prepare(`
                INSERT INTO routes (from_city, to_city, slug, distance_km, duration, sedan_fare, suv_fare, tempo_fare, description, show_on_home, is_active)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
              `).bind(b.from_city, b.to_city, slug, b.distance_km || 0, b.duration || '', b.sedan_fare || 0, b.suv_fare || 0, b.tempo_fare || 0, b.description || '', b.show_on_home ? 1 : 0, b.is_active ? 1 : 0).run();
            }
            return jsonResponse({ ok: true });
          }
          if (method === 'PUT') {
            const b = await request.json();
            if (env.DB && b.id) {
              await env.DB.prepare(`
                UPDATE routes SET from_city=?, to_city=?, distance_km=?, duration=?, sedan_fare=?, suv_fare=?, tempo_fare=?, description=?, show_on_home=?, is_active=?
                WHERE id=?
              `).bind(b.from_city, b.to_city, b.distance_km || 0, b.duration || '', b.sedan_fare || 0, b.suv_fare || 0, b.tempo_fare || 0, b.description || '', b.show_on_home ? 1 : 0, b.is_active ? 1 : 0, b.id).run();
            }
            return jsonResponse({ ok: true });
          }
          if (method === 'DELETE') {
            const id = Number(url.searchParams.get('id'));
            if (env.DB && id) {
              await env.DB.prepare('DELETE FROM routes WHERE id=?').bind(id).run();
            }
            return jsonResponse({ ok: true });
          }
        }

        // CRUD /api/admin/places
        if (path === '/api/admin/places') {
          if (method === 'GET') {
            const places = await getPlaces(env);
            return jsonResponse(places);
          }
          if (method === 'POST') {
            const b = await request.json();
            const slug = (b.title).toLowerCase().replace(/[^a-z0-9]+/g, '-');
            if (env.DB) {
              await env.DB.prepare(`
                INSERT INTO places (title, slug, category, distance_bhuj, best_time, image, short_desc, description, is_active)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
              `).bind(b.title, slug, b.category || '', b.distance_bhuj || '', b.best_time || '', b.image || '', b.short_desc || '', b.description || '', b.is_active ? 1 : 0).run();
            }
            return jsonResponse({ ok: true });
          }
          if (method === 'PUT') {
            const b = await request.json();
            if (env.DB && b.id) {
              await env.DB.prepare(`
                UPDATE places SET title=?, category=?, distance_bhuj=?, best_time=?, image=?, short_desc=?, description=?, is_active=?
                WHERE id=?
              `).bind(b.title, b.category || '', b.distance_bhuj || '', b.best_time || '', b.image || '', b.short_desc || '', b.description || '', b.is_active ? 1 : 0, b.id).run();
            }
            return jsonResponse({ ok: true });
          }
          if (method === 'DELETE') {
            const id = Number(url.searchParams.get('id'));
            if (env.DB && id) {
              await env.DB.prepare('DELETE FROM places WHERE id=?').bind(id).run();
            }
            return jsonResponse({ ok: true });
          }
        }

        // CRUD /api/admin/vehicles
        if (path === '/api/admin/vehicles') {
          if (method === 'GET') {
            const vehicles = await getVehicles(env);
            return jsonResponse(vehicles);
          }
          if (method === 'POST') {
            const b = await request.json();
            if (env.DB) {
              await env.DB.prepare(`
                INSERT INTO vehicles (name, category, models, seats, luggage, per_km, local_8h_80km_ac, local_12h_300km_ac, image, description, is_active)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
              `).bind(b.name, b.category || 'Car', b.models || '', b.seats || '', b.luggage || '', b.per_km || '', b.local_8h_80km_ac || '', b.local_12h_300km_ac || '', b.image || '', b.description || '', b.is_active ? 1 : 0).run();
            }
            return jsonResponse({ ok: true });
          }
          if (method === 'PUT') {
            const b = await request.json();
            if (env.DB && b.id) {
              await env.DB.prepare(`
                UPDATE vehicles SET name=?, category=?, models=?, seats=?, luggage=?, per_km=?, local_8h_80km_ac=?, local_12h_300km_ac=?, image=?, description=?, is_active=?
                WHERE id=?
              `).bind(b.name, b.category || 'Car', b.models || '', b.seats || '', b.luggage || '', b.per_km || '', b.local_8h_80km_ac || '', b.local_12h_300km_ac || '', b.image || '', b.description || '', b.is_active ? 1 : 0, b.id).run();
            }
            return jsonResponse({ ok: true });
          }
          if (method === 'DELETE') {
            const id = Number(url.searchParams.get('id'));
            if (env.DB && id) {
              await env.DB.prepare('DELETE FROM vehicles WHERE id=?').bind(id).run();
            }
            return jsonResponse({ ok: true });
          }
        }

        // POST /api/admin/change-password
        if (path === '/api/admin/change-password' && method === 'POST') {
          const { current, newPassword } = await request.json();
          if (!current || !newPassword || newPassword.length < 8) {
            return jsonResponse({ error: 'Password must be at least 8 characters long.' }, 400);
          }
          if (env.DB) {
            const user = await env.DB.prepare('SELECT id, password_hash FROM admin_users WHERE id=?').bind(session.admin_id).first();
            if (!user || !(await verifyPassword(current, user.password_hash))) {
              return jsonResponse({ error: 'Current password is incorrect.' }, 400);
            }
            const newHash = await hashPassword(newPassword);
            await env.DB.prepare('UPDATE admin_users SET password_hash=? WHERE id=?').bind(newHash, session.admin_id).run();
          }
          return jsonResponse({ ok: true });
        }
      }
    }

    // 5. Edge Server-Side Rendering (SSR) for Web Pages
    const settings = await getSettings(env);
    const popularRoutes = await getPopularRoutes(env);

    // Normalize path by removing trailing slashes except for root
    const cleanPath = (path !== '/' && path.endsWith('/')) ? path.slice(0, -1) : path;

    // Homepage: /
    if (cleanPath === '' || cleanPath === '/') {
      const routes = await getRoutes(env, true);
      const places = await getPlaces(env, 4);
      return htmlResponse(renderHomePage({ routes, places, settings, popularRoutes }));
    }

    // Vehicle Rental: /vehicle-rental
    if (cleanPath === '/vehicle-rental') {
      const type = url.searchParams.get('type') || 'Car';
      const vehicles = await getVehicles(env, type);
      return htmlResponse(renderVehicleRentalPage({ type, vehicles, settings, popularRoutes }));
    }

    // One Way Taxi: /one-way-taxi
    if (cleanPath === '/one-way-taxi') {
      const routes = await getRoutes(env, false);
      return htmlResponse(renderOneWayTaxiPage({ routes, settings, popularRoutes }));
    }

    // Fixed Kutch Tour Packages: /fixed-kutch-tour-package
    if (cleanPath === '/fixed-kutch-tour-package') {
      return htmlResponse(renderTourPackagesPage({ settings, popularRoutes }));
    }

    // Package Detail: /package-detail
    if (cleanPath === '/package-detail') {
      const code = url.searchParams.get('p') || '';
      return htmlResponse(renderPackageDetailPage({ code, settings, popularRoutes }));
    }

    // Places to Visit: /places-to-visit
    if (cleanPath === '/places-to-visit') {
      const places = await getPlaces(env);
      return htmlResponse(renderPlacesPage({ places, settings, popularRoutes }));
    }

    // Place Detail: /place-detail
    if (cleanPath === '/place-detail') {
      const slug = url.searchParams.get('slug') || '';
      const place = await getPlaceBySlug(env, slug);
      let others = [];
      if (place) {
        const allPlaces = await getPlaces(env);
        others = allPlaces.filter(p => p.id !== place.id).slice(0, 4);
      }
      return htmlResponse(renderPlaceDetailPage({ slug, place, others, settings, popularRoutes }));
    }

    // Contact: /contact
    if (cleanPath === '/contact') {
      return htmlResponse(renderContactPage({ settings, popularRoutes }));
    }

    // Policy Pages
    if (cleanPath === '/cancellation-policy') {
      return htmlResponse(renderCancellationPolicyPage({ settings, popularRoutes }));
    }
    if (cleanPath === '/privacy-policy') {
      return htmlResponse(renderPrivacyPolicyPage({ settings, popularRoutes }));
    }
    if (cleanPath === '/terms') {
      return htmlResponse(renderTermsPage({ settings, popularRoutes }));
    }

    // 404 Fallback
    const notFoundContent = `
    <section class="phero">
      <div class="wrap">
        <h1>404 &mdash; Page Not Found</h1>
        <p>The page you are looking for does not exist or has been moved.</p>
        <div class="cta">
          <a href="/" class="btn btn-gold">Back to Homepage</a>
        </div>
      </div>
    </section>
    `;
    return htmlResponse(renderLayout({
      title: '404 Page Not Found | Madhavi Cab Kutch',
      description: 'The requested page was not found.',
      canonical: 'https://madhavicabkutch.com/',
      active: '',
      settings,
      popularRoutes,
      content: notFoundContent
    }), 404);
  }
};
