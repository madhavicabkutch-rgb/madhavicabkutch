-- Cloudflare D1 Migration: Seed Data for Madhavi Cab Kutch

-- 1. Business Settings
INSERT OR REPLACE INTO settings (setting_key, setting_value) VALUES
  ('biz_phone', '+918128807488'),
  ('biz_phone_display', '+91 81288 07488'),
  ('biz_whatsapp', '918128807488'),
  ('biz_email', 'madhavicabkutch@gmail.com'),
  ('biz_street', '4, Yogeswar Nagar'),
  ('biz_city', 'Bhuj, Kutch'),
  ('biz_pin', '370001'),
  ('fb_url', 'https://www.facebook.com/ramesh.ahir.90813'),
  ('ig_url', 'https://www.instagram.com/madhavi_cab_kutch/'),
  ('stat_years', '12+'),
  ('stat_vehicles', '40+'),
  ('stat_support', '24×7');

-- 2. Admin User (Default username: admin, password: adminPassword123)
-- SHA-256 hash of 'adminPassword123' with salt
INSERT OR IGNORE INTO admin_users (id, username, password_hash, full_name) VALUES
  (1, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'Madhavi Cab Admin');

-- 3. One Way Taxi Routes
INSERT OR REPLACE INTO routes (id, from_city, to_city, slug, distance_km, duration, sedan_fare, suv_fare, tempo_fare, description, show_on_home, sort_order, is_active) VALUES
  (1, 'Bhuj', 'Ahmedabad', 'bhuj-to-ahmedabad', 335, '6.5 hours', 4500, 6200, 11000, 'Direct one way taxi from Bhuj to Ahmedabad via Samakhiali and Viramgam.', 1, 1, 1),
  (2, 'Bhuj', 'Rajkot', 'bhuj-to-rajkot', 235, '4.5 hours', 3500, 4800, 8500, 'Fast one way drop from Bhuj to Rajkot via Morbi bypass.', 1, 2, 1),
  (3, 'Bhuj', 'Dholavira', 'bhuj-to-dholavira', 215, '4.0 hours', 5000, 6500, 11500, 'Sightseeing drop to Dholavira crossing the iconic Road to Heaven.', 1, 3, 1),
  (4, 'Bhuj', 'Mandvi', 'bhuj-to-mandvi', 60, '1.2 hours', 1500, 2200, 4000, 'One way cab from Bhuj to Mandvi Beach or Vijay Vilas Palace.', 1, 4, 1),
  (5, 'Bhuj', 'Dhordo (White Rann)', 'bhuj-to-dhordo-white-rann', 85, '1.8 hours', 2200, 3000, 5500, 'Drop from Bhuj railway station/airport to Dhordo Tent City & White Rann.', 1, 5, 1),
  (6, 'Bhuj', 'Vadodara', 'bhuj-to-vadodara', 445, '8.0 hours', 6500, 8800, 15500, 'Outstation one way cab from Bhuj to Vadodara.', 1, 6, 1),
  (7, 'Bhuj', 'Surat', 'bhuj-to-surat', 590, '11.0 hours', 8500, 11500, 20000, 'One side taxi booking from Bhuj to Surat.', 0, 7, 1),
  (8, 'Bhuj', 'Jamnagar', 'bhuj-to-jamnagar', 260, '5.0 hours', 4000, 5500, 9500, 'One way cab to Jamnagar via Gandhidham.', 0, 8, 1),
  (9, 'Bhuj', 'Gandhidham', 'bhuj-to-gandhidham', 58, '1.0 hour', 1400, 2000, 3500, 'Quick point-to-point transfer between Bhuj and Gandhidham.', 0, 9, 1);

-- 4. Sightseeing Places
INSERT OR REPLACE INTO places (id, title, slug, category, distance_bhuj, best_time, short_desc, description, image, sort_order, is_active) VALUES
  (1, 'White Desert (Great Rann of Kutch)', 'white-rann', 'Salt Desert', '85 km', 'Nov to Feb (Sunset & Full Moon)',
   'The world-famous salt desert of Dhordo. Vast stretches of pristine white salt, cultural performances during Rann Utsav, and unforgettable sunsets.',
   'The Great Rann of Kutch is a seasonal salt marsh located in the Thar Desert in the Kutch District of Gujarat. Dhordo is the gateway to the White Rann where tourists flock during the world-famous Rann Utsav. Experience unforgettable sunsets across miles of shimmering salt crust.',
   'white-rann.jpg', 1, 1),

  (2, 'Dholavira Harappan Civilization Site', 'dholavira', 'UNESCO World Heritage', '215 km', 'Oct to Mar (Early morning start recommended)',
   'Ancient 5000-year-old Indus Valley metropolis with monumental water reservoirs, accessed via the breathtaking Road to Heaven across the Rann.',
   'Dholavira is an archaeological site at Khadirbet in Bhachau Taluka of Kutch. It is one of the five largest Harappan sites and the most prominent archaeological site in India belonging to the Indus Valley Civilization. The journey via the elevated Road to Heaven across salt flats is a once-in-a-lifetime drive.',
   'dholavira.jpg', 2, 1),

  (3, 'Kalo Dungar (Black Hill)', 'kalo-dungar', 'Scenic Viewpoint', '95 km', 'Oct to Mar (Late afternoon for sunset)',
   'The highest point in Kutch at 462 meters, offering panoramic views where the horizon dissolves into the great white salt plains. Famous 400-year-old Dattatreya Temple.',
   'Kalo Dungar is the highest point in Kutch, Gujarat, at 462 m above sea level. It offers a spectacular panoramic view of the Great Rann of Kutch. The 400-year-old Dattatreya temple at the top is known for the daily jackal feeding ritual. Combine this trip with Dhordo White Rann on the same afternoon.',
   'kalo-dungar.jpg', 3, 1),

  (4, 'Mandvi Beach & Vijay Vilas Palace', 'mandvi-beach', 'Coast & Heritage', '60 km', 'Open all year (Pleasant evenings)',
   'Peaceful Arabian Sea coastline with soft sands, camel rides, and the grand red sandstone Vijay Vilas Palace set in private coastal grounds.',
   'Mandvi was once a major port town of the Kutch region and features a clean golden sand beach along the Arabian Sea. Nearby lies Vijay Vilas Palace, a grand royal summer retreat built in 1929 featuring eclectic Rajput architecture and manicured beachside grounds.',
   'mandvi.jpg', 4, 1),

  (5, 'Aina Mahal & Prag Mahal', 'aina-mahal', 'Bhuj Heritage', 'Within Bhuj City', 'Open all year (9:00 AM - 12:00 PM & 3:00 PM - 6:00 PM)',
   'The Palace of Mirrors with Venetian glass, European mirrors and gilded carvings, paired with Prag Mahal''s majestic Gothic-style clock tower.',
   'Located inside the heart of old Bhuj, the Aina Mahal (Mirror Palace) was built by Rao Lakhpatji in 1752, mastercrafted by the legendary artisan Ramsinh Malam. Adjacent stands the Prag Mahal with its 45-foot bell tower and grand Italian Gothic design.',
   'aina-mahel-bhuj-hariom.webp', 5, 1),

  (6, 'Road to Heaven', 'road-to-heaven', 'Scenic Drive', '180 km from Bhuj', 'Oct to Mar',
   'A spectacular 30-km highway cutting straight through the shimmering White Rann on both sides on the route to Khadir Bet island.',
   'The newly constructed highway connecting Khavda to Dholavira cuts directly through the salt flats of the Great Rann. Known popularly as the Road to Heaven, travelers stop along the elevated tarmac for surreal photos with endless white desert on both horizons.',
   'road-to-heaven-hariom.jpg', 6, 1),

  (7, 'Mata Na Madh', 'mata-no-madh', 'Pilgrimage', '135 km from Bhuj', 'Open all year',
   'Historical temple dedicated to Maa Ashapura, the Kuldevi of Kutch, situated in the western part of Kutch district.',
   'Mata no Madh is a village in Lakhpat Taluka of Kutch. The village lies surrounded by hills and hosts the prominent historic temple of Ashapura Mata, revered by millions of pilgrims across Gujarat.',
   'mata-no-madh-hariom.jpg', 7, 1),

  (8, 'Narayan Sarovar & Koteshwar', 'narayan-sarovar', 'Sacred Lake & Coast', '155 km from Bhuj', 'Nov to Feb (Sunset at Arabian sea)',
   'One of the five holy lakes of Sanatan Dharma alongside the ancient Koteshwar Shiva Temple perched dramatically right over the Arabian Sea.',
   'Narayan Sarovar is one of the most sacred pilgrimage sites in India. Just 4 km further west sits Koteshwar Mahadev Temple, the westernmost point of India where the land meets the Arabian Sea, famous for evening aarti and sunset over the water.',
   'narayan-sarovar-hariom.jpg', 8, 1);

-- 5. Vehicles Fleet
INSERT OR REPLACE INTO vehicles (id, name, category, models, seats, luggage, per_km, description, image, sort_order, is_active, local_8h_80km_ac, local_8h_80km_nonac, local_12h_300km_ac, local_12h_300km_nonac, extra_km_ac, extra_km_nonac, airport_transfer, daily_min_km, driver_night_allowance, notes) VALUES
  (1, 'Swift Dzire / Toyota Etios', 'Car', 'Swift Dzire, Toyota Etios', '4', '2 Bags', '12',
   'Comfortable air-conditioned sedan ideal for airport transfers, city travel in Bhuj, and small family trips across Kutch.',
   'sedan.jpg', 1, 1, '2,000', '1,800', '3,500', '3,000', '12/km', '10/km', '800', 300, '300', 'Toll and parking at actuals.'),

  (2, 'Maruti Ertiga', 'Car', 'Maruti Suzuki Ertiga', '6-7', '3-4 Bags', '15',
   'Spacious MUV with flexible seating, great fuel efficiency, and ample legroom. Excellent for family day trips to White Rann and Dholavira.',
   'suv.jpg', 2, 1, '2,800', '2,400', '4,800', '4,200', '15/km', '13/km', '1,200', 300, '350', 'Toll and parking at actuals.'),

  (3, 'Toyota Innova Crysta', 'Car', 'Toyota Innova Crysta', '6-7', '4 Bags', '19',
   'Premium long-distance comfort with captain seats, powerful dual AC, and unmatched ride quality for outstation Gujarat tours.',
   'innova.jpg', 3, 1, '3,500', '3,000', '6,000', '5,200', '19/km', '17/km', '1,500', 300, '400', 'Toll and parking at actuals.'),

  (4, 'Tempo Traveller (12-17 Seater)', 'Bus', 'Force Tempo Traveller 12-17 Seats', '12-17', '8-12 Bags', '24',
   'High-roof AC luxury tempo traveller with pushback seats, individual AC vents, and large luggage capacity for groups and corporate tours.',
   'tempo-traveller.jpg', 4, 1, '4,500', '3,800', '8,000', '7,000', '24/km', '21/km', '2,500', 300, '500', 'Driver allowance included.'),

  (5, 'Mini Bus / Luxury Coach', 'Bus', '24-56 Seater Luxury Coach', '24-56', 'Full Coach Luggage Boot', '38',
   'Deluxe 2x2 pushback buses with air suspension, PA system, and experienced highway drivers for wedding parties, schools, and pilgrim tours.',
   'bus.jpg', 5, 1, '7,500', '6,500', '13,000', '11,500', '38/km', '34/km', '4,500', 350, '600', 'Driver and helper allowance included.'),

  (6, 'Toyota Fortuner', 'Premium', 'Toyota Fortuner 4x4 / 4x2', '6-7', '4 Bags', '35',
   'Executive VIP SUV for corporate delegates, luxury desert safaris, and VIP arrivals in Bhuj.',
   'fortuner.jpg', 6, 1, '6,500', '', '11,500', '', '35/km', '', '3,000', 300, '500', 'Chauffeur in uniform.');
