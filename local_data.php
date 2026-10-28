<?php
// local_data.php - Seed fallback data and local storage when MySQL is not connected

function get_initial_routes() {
    return array(
        array('id' => 1, 'from_city' => 'Bhuj', 'to_city' => 'Ahmedabad', 'slug' => 'bhuj-to-ahmedabad', 'distance_km' => 335, 'duration' => '6.5 hours', 'sedan_fare' => 4500, 'suv_fare' => 6200, 'tempo_fare' => 11000, 'description' => 'Direct one way taxi from Bhuj to Ahmedabad via Samakhiali and Viramgam.', 'show_on_home' => 1, 'sort_order' => 1, 'is_active' => 1),
        array('id' => 2, 'from_city' => 'Bhuj', 'to_city' => 'Rajkot', 'slug' => 'bhuj-to-rajkot', 'distance_km' => 235, 'duration' => '4.5 hours', 'sedan_fare' => 3500, 'suv_fare' => 4800, 'tempo_fare' => 8500, 'description' => 'Fast one way drop from Bhuj to Rajkot via Morbi bypass.', 'show_on_home' => 1, 'sort_order' => 2, 'is_active' => 1),
        array('id' => 3, 'from_city' => 'Bhuj', 'to_city' => 'Dholavira', 'slug' => 'bhuj-to-dholavira', 'distance_km' => 215, 'duration' => '4.0 hours', 'sedan_fare' => 5000, 'suv_fare' => 6500, 'tempo_fare' => 11500, 'description' => 'Sightseeing drop to Dholavira crossing the iconic Road to Heaven.', 'show_on_home' => 1, 'sort_order' => 3, 'is_active' => 1),
        array('id' => 4, 'from_city' => 'Bhuj', 'to_city' => 'Mandvi', 'slug' => 'bhuj-to-mandvi', 'distance_km' => 60, 'duration' => '1.2 hours', 'sedan_fare' => 1500, 'suv_fare' => 2200, 'tempo_fare' => 4000, 'description' => 'One way cab from Bhuj to Mandvi Beach or Vijay Vilas Palace.', 'show_on_home' => 1, 'sort_order' => 4, 'is_active' => 1),
        array('id' => 5, 'from_city' => 'Bhuj', 'to_city' => 'Dhordo (White Rann)', 'slug' => 'bhuj-to-dhordo-white-rann', 'distance_km' => 85, 'duration' => '1.8 hours', 'sedan_fare' => 2200, 'suv_fare' => 3000, 'tempo_fare' => 5500, 'description' => 'Drop from Bhuj railway station/airport to Dhordo Tent City & White Rann.', 'show_on_home' => 1, 'sort_order' => 5, 'is_active' => 1),
        array('id' => 6, 'from_city' => 'Bhuj', 'to_city' => 'Vadodara', 'slug' => 'bhuj-to-vadodara', 'distance_km' => 445, 'duration' => '8.0 hours', 'sedan_fare' => 6500, 'suv_fare' => 8800, 'tempo_fare' => 15500, 'description' => 'Outstation one way cab from Bhuj to Vadodara.', 'show_on_home' => 1, 'sort_order' => 6, 'is_active' => 1),
        array('id' => 7, 'from_city' => 'Bhuj', 'to_city' => 'Surat', 'slug' => 'bhuj-to-surat', 'distance_km' => 590, 'duration' => '11.0 hours', 'sedan_fare' => 8500, 'suv_fare' => 11500, 'tempo_fare' => 20000, 'description' => 'One side taxi booking from Bhuj to Surat.', 'show_on_home' => 0, 'sort_order' => 7, 'is_active' => 1),
        array('id' => 8, 'from_city' => 'Bhuj', 'to_city' => 'Jamnagar', 'slug' => 'bhuj-to-jamnagar', 'distance_km' => 260, 'duration' => '5.0 hours', 'sedan_fare' => 4000, 'suv_fare' => 5500, 'tempo_fare' => 9500, 'description' => 'One way cab to Jamnagar via Gandhidham.', 'show_on_home' => 0, 'sort_order' => 8, 'is_active' => 1),
        array('id' => 9, 'from_city' => 'Bhuj', 'to_city' => 'Gandhidham', 'slug' => 'bhuj-to-gandhidham', 'distance_km' => 58, 'duration' => '1.0 hour', 'sedan_fare' => 1400, 'suv_fare' => 2000, 'tempo_fare' => 3500, 'description' => 'Quick point-to-point transfer between Bhuj and Gandhidham.', 'show_on_home' => 0, 'sort_order' => 9, 'is_active' => 1)
    );
}

function get_initial_places() {
    return array(
        array('id' => 1, 'title' => 'White Rann of Kutch', 'slug' => 'white-rann', 'category' => 'DESERT', 'distance_bhuj' => '80 from Bhuj', 'best_time' => 'Nov to Feb (Sunset & Full Moon)', 'short_desc' => 'The White Rann of Kutch is one of the largest salt deserts in the world and a breathtaking natural wonder located near Dhordo.', 'description' => 'The Great Rann of Kutch is a seasonal salt marsh located in the Thar Desert in the Kutch District of Gujarat. Dhordo is the gateway to the White Rann where tourists flock during the world-famous Rann Utsav. Experience unforgettable sunsets, camel safaris, and full moon nights across miles of shimmering salt crust.', 'image' => 'white-rann.jpg', 'sort_order' => 1, 'is_active' => 1),
        array('id' => 2, 'title' => 'Rann Utsav', 'slug' => 'rann-utsav', 'category' => 'FESTIVAL', 'distance_bhuj' => '80 from Bhuj', 'best_time' => 'Nov to Feb', 'short_desc' => 'Rann Utsav is a vibrant cultural festival held every year in the vast white salt desert of the Great Rann of Kutch with music, dance, and tent city.', 'description' => 'Rann Utsav is Gujarat\'s premier desert carnival celebrated annually from November to February in Dhordo. The festival celebrates the colorful heritage, traditional Kutchi folk music and dance, exquisite handicrafts, hot air ballooning, and luxury glamping in the tent city.', 'image' => 'rann-utsav-hariom.jpg', 'sort_order' => 2, 'is_active' => 1),
        array('id' => 3, 'title' => 'UNESCO World Heritage Site Dholavira', 'slug' => 'dholavira', 'category' => 'ARCHAEOLOGICAL', 'distance_bhuj' => '140 from Bhuj', 'best_time' => 'Oct to Mar', 'short_desc' => 'Dholavira is a UNESCO World Heritage Site and one of the most remarkable archaeological sites of the ancient Indus Valley Civilization dating back 4500 years.', 'description' => 'Dholavira is an ancient Harappan metropolis situated on Khadir Bet island in Kutch. It features magnificent stone architecture, world-famous water reservoirs, underground drainage, and a massive citadel, offering profound insights into ancient town planning.', 'image' => 'dholavira.jpg', 'sort_order' => 3, 'is_active' => 1),
        array('id' => 4, 'title' => 'Fossil Park - Dholavira', 'slug' => 'fossil-park-dholavira', 'category' => 'GEOLOGICAL SITE', 'distance_bhuj' => '140 from Bhuj', 'best_time' => 'Oct to Mar', 'short_desc' => 'Fossil Park in Kutch is a fascinating natural attraction that takes visitors on a journey millions of years back with petrified tree wood from the Jurassic era.', 'description' => 'Located near Dholavira on Khadir Bet, the Jurassic Fossil Park contains ancient petrified tree trunks and marine fossils that are over 160 million years old, preserved by mineral substitution into stone.', 'image' => 'fossil-park-dholavira-hariom.jpg', 'sort_order' => 4, 'is_active' => 1),
        array('id' => 5, 'title' => 'Road to Heaven', 'slug' => 'road-to-heaven', 'category' => 'VIEWPOINT', 'distance_bhuj' => '100 from Bhuj', 'best_time' => 'Oct to Mar', 'short_desc' => 'The Road to Heaven is one of the most breathtaking and Instagram-famous stretches in Kutch, connecting Khadir Bet with white salt flats on both sides.', 'description' => 'The newly constructed 30-km highway connecting Khavda to Dholavira cuts directly through the salt flats of the Great Rann. Known popularly as the Road to Heaven, travelers stop along the elevated tarmac for surreal photos with endless white desert on both horizons.', 'image' => 'road-to-heaven-hariom.jpg', 'sort_order' => 5, 'is_active' => 1),
        array('id' => 6, 'title' => 'Sunset Point Dholavira', 'slug' => 'sunset-point-dholavira', 'category' => 'NATURE', 'distance_bhuj' => '140 from Bhuj', 'best_time' => 'Oct to Mar (Late Afternoon)', 'short_desc' => 'Sunset Point in Dholavira is a stunning viewpoint that offers one of the most spectacular sunset experiences in the Rann, painting the horizon in crimson.', 'description' => 'Perched on the northern edge of Khadir Bet, Sunset Point Dholavira overlooks the boundless desert marshland. As the sun sets, the vast salt plains reflect vibrant shades of orange, pink, and violet, creating an unforgettable vista.', 'image' => 'sunset-point-dholavira-hariom-tours-and-travels.webp', 'sort_order' => 6, 'is_active' => 1),
        array('id' => 7, 'title' => 'Archaeological Museum, Dholavira', 'slug' => 'archaeological-museum-dholavira', 'category' => 'MUSEUM', 'distance_bhuj' => '140 from Bhuj', 'best_time' => 'Oct to Mar', 'short_desc' => 'The Archaeological Museum at Dholavira displays excavated Harappan artifacts, seals, pottery, terracotta ornaments, and ancient weights.', 'description' => 'Managed by the Archaeological Survey of India (ASI), this museum preserves authentic relics discovered during Dholavira excavations, showcasing the sophisticated urban lifestyle and craftsmanship of Harappan inhabitants.', 'image' => 'archaeology-museum-hariom.webp', 'sort_order' => 7, 'is_active' => 1),
        array('id' => 8, 'title' => 'Chari-Dhand Wetland Conservation', 'slug' => 'chari-dhand-wetland', 'category' => 'WILDLIFE SANCTUARY', 'distance_bhuj' => '60 from Bhuj', 'best_time' => 'Nov to Feb', 'short_desc' => 'Chari-Dhand Wetland Conservation is famous for migratory birds including thousands of pink flamingos, common cranes, and rare desert birds in winter.', 'description' => 'Located on the edge of the Banni grasslands, Chari-Dhand is a shallow seasonal wetland that attracts nearly 200 species of migratory birds every winter. It is a paradise for wildlife photographers and bird watchers.', 'image' => 'slide2.jpg', 'sort_order' => 8, 'is_active' => 1),
        array('id' => 9, 'title' => 'Narayan Sarovar', 'slug' => 'narayan-sarovar', 'category' => 'TEMPLE', 'distance_bhuj' => '160 from Bhuj', 'best_time' => 'Open all year', 'short_desc' => 'Narayan Sarovar is one of the 5 sacred lakes of Hindu theology, famous for historic temples, peaceful ghats, and spiritual pilgrimages on the western border.', 'description' => 'Revered alongside Mansarovar, Bindu Sarovar, Pushkar, and Pampa Sarovar, Narayan Sarovar features ancient temples dedicated to Shri Trikamraiji, Laxminarayan, and Adinarayan, drawing devotees from across the nation.', 'image' => 'narayan-sarovar-hariom.jpg', 'sort_order' => 9, 'is_active' => 1),
        array('id' => 10, 'title' => 'Koteshwar Mahadev Temple', 'slug' => 'koteshwar-mahadev-temple', 'category' => 'TEMPLE', 'distance_bhuj' => '162 from Bhuj', 'best_time' => 'Open all year (Sunset time)', 'short_desc' => 'Koteshwar Mahadev Temple is an ancient and highly revered Shiva temple located at the westernmost tip of India, standing majestically over the Arabian Sea.', 'description' => 'Steeped in Ramayana legends involving Ravana and Lord Shiva, Koteshwar Mahadev is situated at the edge where the western Indian coastline meets the sea. The temple offers spiritual bliss and mesmerizing sunsets over the ocean.', 'image' => 'koteshwar-mahadev-temple-hariom.jpg', 'sort_order' => 10, 'is_active' => 1),
        array('id' => 11, 'title' => 'Mata No Madh (Ashapura Mata Temple)', 'slug' => 'mata-no-madh', 'category' => 'TEMPLE', 'distance_bhuj' => '100 from Bhuj', 'best_time' => 'Open all year', 'short_desc' => 'Mata No Madh is one of the most important and revered pilgrimage sites in Kutch, home to Maa Ashapura, the divine Kuldevi of the region.', 'description' => 'Surrounded by low hills in Lakhpat taluka, Mata No Madh is the principal shrine of Goddess Ashapura. Lakhs of devotees travel here on foot during Navratri to seek blessings at this historic, high-energy spiritual temple.', 'image' => 'mata-no-madh-hariom.jpg', 'sort_order' => 11, 'is_active' => 1),
        array('id' => 12, 'title' => 'Kadiya Dhro', 'slug' => 'kadiya-dhro', 'category' => 'SCENIC POINT', 'distance_bhuj' => '35 from Bhuj', 'best_time' => 'Oct to Mar', 'short_desc' => 'Kadiya Dhro is one of the most spectacular hidden natural wonders of Kutch, popularly known as the \'Grand Canyon of Kutch\' for its colorful rock formations.', 'description' => 'Featured in international travel magazines, Kadiya Dhro is a breathtaking canyon carved by centuries of river water flow through layered sedimentary rocks, displaying vibrant shades of red, yellow, and orange.', 'image' => 'fossil-park-dholavira-hariom.jpg', 'sort_order' => 12, 'is_active' => 1),
        array('id' => 13, 'title' => '72 Jinalay Temple, Mandvi', 'slug' => '72-jinalay-mandvi', 'category' => 'JAIN TEERTH', 'distance_bhuj' => '50 from Bhuj', 'best_time' => 'Open all year', 'short_desc' => '72 Jinalay is a magnificent Jain temple complex located at Koday village near Mandvi, renowned for its pristine white marble carvings and 72 shrines.', 'description' => 'Also known as Adiswar Bavan Jinalay, this sprawling white marble pilgrimage complex houses 72 individual deris around a central sanctum, offering architectural brilliance and profound tranquility.', 'image' => '72-jinalaya-mandvi-hariom.webp', 'sort_order' => 13, 'is_active' => 1),
        array('id' => 14, 'title' => 'Vijay Vilas Palace, Mandvi', 'slug' => 'vijay-vilas-palace-mandvi', 'category' => 'PALACE', 'distance_bhuj' => '70 from Bhuj', 'best_time' => 'Open all year (Pleasant evenings)', 'short_desc' => 'Vijay Vilas Palace is a stunning royal heritage monument located near Mandvi, set amidst manicured coastal orchards with its own private beach.', 'description' => 'Built in 1929 by Maharao Shri Khengarji III as a summer retreat, Vijay Vilas Palace features Rajput and European architecture in red sandstone with carved jharokhas, royal museum rooms, and a rooftop offering panoramic Arabian Sea views.', 'image' => 'vijay-vilas-palace-hariom.png', 'sort_order' => 14, 'is_active' => 1),
        array('id' => 15, 'title' => 'Shyamji Krishna Verma Kranti Teerth, Mandvi', 'slug' => 'shyamji-krishna-verma-mandvi', 'category' => 'MEMORIAL', 'distance_bhuj' => '65 from Bhuj', 'best_time' => 'Open all year', 'short_desc' => 'Shyamji Krishna Verma Kranti Teerth is a proud national memorial honoring the great freedom fighter, featuring a replica of London\'s India House.', 'description' => 'Located near Mandvi beach, this patriotic memorial honors Pandit Shyamji Krishna Varma who spearheaded India\'s freedom struggle from Europe. It houses his ashes, historical exhibits, and an exact replica of India House in London.', 'image' => 'shyamji-krishna-varma-memorial-hariom.webp', 'sort_order' => 15, 'is_active' => 1),
        array('id' => 16, 'title' => 'Gurudwara Lakhpat Sahib', 'slug' => 'gurudwara-lakhpat-sahib', 'category' => 'TEMPLE', 'distance_bhuj' => '145 from Bhuj', 'best_time' => 'Open all year', 'short_desc' => 'Gurudwara Lakhpat Sahib is a deeply revered Sikh pilgrimage site located within the historic Lakhpat Fort where Guru Nanak Dev Ji stayed on his journey.', 'description' => 'This UNESCO Asia-Pacific heritage award-winning Gurudwara preserves the charan paduka (wooden footwear) and sacred relics of Guru Nanak Dev Ji, who stayed here during his missionary journey to Mecca.', 'image' => 'shree-swaminarayan-temple-bhuj-hariom.webp', 'sort_order' => 16, 'is_active' => 1),
        array('id' => 17, 'title' => 'Ship Building Yard, Mandvi', 'slug' => 'ship-building-yard-mandvi', 'category' => 'VILLAGE CRAFT', 'distance_bhuj' => '80 from Bhuj', 'best_time' => 'Open all year', 'short_desc' => 'The Ship Building Yard at Mandvi is a 400-year-old living maritime heritage site where handcrafted wooden cargo vessels (dhows) are constructed by master carpenters.', 'description' => 'Along the banks of the Rukmavati river, skilled artisans continue the ancient tradition of building massive ocean-going wooden ships completely by hand without modern blueprints, supplying traders across the Persian Gulf and Africa.', 'image' => 'mandvi.jpg', 'sort_order' => 17, 'is_active' => 1),
        array('id' => 18, 'title' => 'Rogan Art (Nirona Village), Kutch', 'slug' => 'rogan-art-nirona', 'category' => 'HANDICRAFT / VILLAGE', 'distance_bhuj' => '45 from Bhuj', 'best_time' => 'Open all year', 'short_desc' => 'Rogan Art is a rare and exquisite 400-year-old craft practiced exclusively by the Khatri family in Nirona village using castor oil colors and a metal stylus.', 'description' => 'Nirona village is the global home of Rogan Painting, where master artisans paint intricate floral and geometric motifs onto silk and cotton without touching the fabric. It was famously gifted by Prime Minister Narendra Modi to the President of the United States.', 'image' => 'rogan-art-hariom.jpg', 'sort_order' => 18, 'is_active' => 1),
        array('id' => 19, 'title' => 'Regional Science Centre, Bhuj', 'slug' => 'regional-science-centre-bhuj', 'category' => 'MUSEUM', 'distance_bhuj' => 'City Tour from Bhuj', 'best_time' => 'Open all year', 'short_desc' => 'The Regional Science Centre in Bhuj is a modern science museum featuring interactive galleries on space, energy, marine life, and life-size dinosaurs.', 'description' => 'Built atop Mirzapar road near Bhuj, this sprawling science centre features life-size dinosaur replicas, 3D planetarium shows, interactive physical science experiments, and engaging educational galleries for families and children.', 'image' => 'smritivan-earthquake-memorial-museum-bhuj-hariom.jpg', 'sort_order' => 19, 'is_active' => 1),
        array('id' => 20, 'title' => 'Bharatiya Sanskruti Darshan Museum, Bhuj', 'slug' => 'bharatiya-sanskriti-darshan-museum-bhuj', 'category' => 'MUSEUM', 'distance_bhuj' => 'City Tour from Bhuj', 'best_time' => 'Open all year', 'short_desc' => 'Bharatiya Sanskruti Darshan Museum is a cultural treasure house in Bhuj showcasing Kutchi folk art, embroidery, rural lifestyle, and tribal heritage.', 'description' => 'Founded by scholar Ramsinhji Rathod, this folk museum houses authentic Kutchi rural huts (Bhunga), rare tribal textiles, woodcarvings, musical instruments, and traditional artifacts representing the vibrant ethnographic soul of Kutch.', 'image' => 'kutch-museum-hariom.jpg', 'sort_order' => 20, 'is_active' => 1),
        array('id' => 21, 'title' => 'Sign Board Site, Dholavira', 'slug' => 'sign-board-site-dholavira', 'category' => 'ARCHAEOLOGICAL', 'distance_bhuj' => '140 from Bhuj', 'best_time' => 'Oct to Mar', 'short_desc' => 'The Sign Board Site at Dholavira features one of the oldest inscribed wooden signboards in human history, containing 10 large Indus script symbols.', 'description' => 'Discovered near the northern gate of the Dholavira citadel, this ancient inscription is considered the world\'s oldest known public billboard, crafted from crystalline mineral gypsum inlaid into a wooden plank.', 'image' => 'dholavira.jpg', 'sort_order' => 21, 'is_active' => 1),
        array('id' => 22, 'title' => 'Kala Dungar (Black Hill)', 'slug' => 'kalo-dungar', 'category' => 'HIGHEST POINT OF KUTCH', 'distance_bhuj' => '90 from Bhuj', 'best_time' => 'Oct to Mar (Sunset)', 'short_desc' => 'Kala Dungar, also known as Black Hill, is the highest point in Kutch at 462m, offering panoramic views where the horizon dissolves into the great white salt plains.', 'description' => 'Kala Dungar is the highest point in Kutch, Gujarat, offering a spectacular 360-degree panoramic view of the Great Rann. The 400-year-old Dattatreya temple at the summit is famous for the daily jackal feeding ritual. Best visited before sunset combined with Dhordo White Rann.', 'image' => 'kalo-dungar.jpg', 'sort_order' => 22, 'is_active' => 1),
        array('id' => 23, 'title' => 'Aina Mahal, Bhuj', 'slug' => 'aina-mahal-bhuj', 'category' => 'PALACE', 'distance_bhuj' => 'City Tour from Bhuj', 'best_time' => 'Open all year', 'short_desc' => 'Aina Mahal, the \'Palace of Mirrors\', is a stunning 18th-century royal palace in Bhuj renowned for Venetian glass, mirrored pillars, and gilded artistry.', 'description' => 'Commissioned in 1752 by Rao Lakhpatji and designed by master craftsman Ramsinh Malam, Aina Mahal boasts a magnificent Pleasure Hall surrounded by water fountains, European clocks, Belgian glass chandeliers, and antique Kutchi weaponry.', 'image' => 'aina-mahel-bhuj-hariom.webp', 'sort_order' => 23, 'is_active' => 1),
        array('id' => 24, 'title' => 'Prag Mahal, Bhuj', 'slug' => 'prag-mahal-bhuj', 'category' => 'PALACE', 'distance_bhuj' => 'City Tour from Bhuj', 'best_time' => 'Open all year', 'short_desc' => 'Prag Mahal is a grand 19th-century Italian Gothic palace in Bhuj featuring a 45-foot clock tower, grand durbar hall, and Corinthian columns.', 'description' => 'Built in 1865 by Maharao Pragmalji II and designed by Colonel Henry Saint Wilkins, Prag Mahal is famous for its towering bell tower with panoramic views over Bhuj, chandelier-lit royal Durbar hall, and taxidermy trophies.', 'image' => 'bhuj-heritage.jpg', 'sort_order' => 24, 'is_active' => 1)
    );
}

function get_initial_vehicles() {
    return array(
        array('id' => 1, 'name' => 'Swift Dzire / Toyota Etios', 'category' => 'Car', 'models' => 'Swift Dzire, Toyota Etios', 'seats' => '4', 'luggage' => '2 Bags', 'per_km' => '12', 'description' => 'Comfortable air-conditioned sedan ideal for airport transfers, city travel in Bhuj, and small family trips across Kutch.', 'image' => 'sedan.jpg', 'sort_order' => 1, 'is_active' => 1, 'local_8h_80km_ac' => '2,000', 'local_8h_80km_nonac' => '1,800', 'local_12h_300km_ac' => '3,500', 'local_12h_300km_nonac' => '3,000', 'extra_km_ac' => '12/km', 'extra_km_nonac' => '10/km', 'airport_transfer' => '800', 'daily_min_km' => 300, 'driver_night_allowance' => '300', 'notes' => 'Toll and parking at actuals.'),
        array('id' => 2, 'name' => 'Maruti Ertiga', 'category' => 'Car', 'models' => 'Maruti Suzuki Ertiga', 'seats' => '6-7', 'luggage' => '3-4 Bags', 'per_km' => '15', 'description' => 'Spacious MUV with flexible seating, great fuel efficiency, and ample legroom. Excellent for family day trips to White Rann and Dholavira.', 'image' => 'suv.jpg', 'sort_order' => 2, 'is_active' => 1, 'local_8h_80km_ac' => '2,800', 'local_8h_80km_nonac' => '2,400', 'local_12h_300km_ac' => '4,800', 'local_12h_300km_nonac' => '4,200', 'extra_km_ac' => '15/km', 'extra_km_nonac' => '13/km', 'airport_transfer' => '1,200', 'daily_min_km' => 300, 'driver_night_allowance' => '350', 'notes' => 'Toll and parking at actuals.'),
        array('id' => 3, 'name' => 'Toyota Innova Crysta', 'category' => 'Car', 'models' => 'Toyota Innova Crysta', 'seats' => '6-7', 'luggage' => '4 Bags', 'per_km' => '19', 'description' => 'Premium long-distance comfort with captain seats, powerful dual AC, and unmatched ride quality for outstation Gujarat tours.', 'image' => 'innova.jpg', 'sort_order' => 3, 'is_active' => 1, 'local_8h_80km_ac' => '3,500', 'local_8h_80km_nonac' => '3,000', 'local_12h_300km_ac' => '6,000', 'local_12h_300km_nonac' => '5,200', 'extra_km_ac' => '19/km', 'extra_km_nonac' => '17/km', 'airport_transfer' => '1,500', 'daily_min_km' => 300, 'driver_night_allowance' => '400', 'notes' => 'Toll and parking at actuals.'),
        array('id' => 4, 'name' => 'Tempo Traveller (12-17 Seater)', 'category' => 'Bus', 'models' => 'Force Tempo Traveller 12-17 Seats', 'seats' => '12-17', 'luggage' => '8-12 Bags', 'per_km' => '24', 'description' => 'High-roof AC luxury tempo traveller with pushback seats, individual AC vents, and large luggage capacity for groups and corporate tours.', 'image' => 'tempo-traveller.jpg', 'sort_order' => 4, 'is_active' => 1, 'local_8h_80km_ac' => '4,500', 'local_8h_80km_nonac' => '3,800', 'local_12h_300km_ac' => '8,000', 'local_12h_300km_nonac' => '7,000', 'extra_km_ac' => '24/km', 'extra_km_nonac' => '21/km', 'airport_transfer' => '2,500', 'daily_min_km' => 300, 'driver_night_allowance' => '500', 'notes' => 'Driver allowance included.'),
        array('id' => 5, 'name' => 'Mini Bus / Luxury Coach', 'category' => 'Bus', 'models' => '24-56 Seater Luxury Coach', 'seats' => '24-56', 'luggage' => 'Full Coach Luggage Boot', 'per_km' => '38', 'description' => 'Deluxe 2x2 pushback buses with air suspension, PA system, and experienced highway drivers for wedding parties, schools, and pilgrim tours.', 'image' => 'bus.jpg', 'sort_order' => 5, 'is_active' => 1, 'local_8h_80km_ac' => '7,500', 'local_8h_80km_nonac' => '6,500', 'local_12h_300km_ac' => '13,000', 'local_12h_300km_nonac' => '11,500', 'extra_km_ac' => '38/km', 'extra_km_nonac' => '34/km', 'airport_transfer' => '4,500', 'daily_min_km' => 350, 'driver_night_allowance' => '600', 'notes' => 'Driver and helper allowance included.'),
        array('id' => 6, 'name' => 'Toyota Fortuner', 'category' => 'Premium', 'models' => 'Toyota Fortuner 4x4 / 4x2', 'seats' => '6-7', 'luggage' => '4 Bags', 'per_km' => '35', 'description' => 'Executive VIP SUV for corporate delegates, luxury desert safaris, and VIP arrivals in Bhuj.', 'image' => 'fortuner.jpg', 'sort_order' => 6, 'is_active' => 1, 'local_8h_80km_ac' => '6,500', 'local_8h_80km_nonac' => '', 'local_12h_300km_ac' => '11,500', 'local_12h_300km_nonac' => '', 'extra_km_ac' => '35/km', 'extra_km_nonac' => '', 'airport_transfer' => '3,000', 'daily_min_km' => 300, 'driver_night_allowance' => '500', 'notes' => 'Toll and parking at actuals.')
    );
}

// Local JSON file storage helpers
function get_local_storage_file($type) {
    $dir = __DIR__ . DIRECTORY_SEPARATOR . 'data';
    if (!is_dir($dir)) {
        @mkdir($dir, 0777, true);
    }
    return $dir . DIRECTORY_SEPARATOR . $type . '.json';
}

function load_local_data($type) {
    $file = get_local_storage_file($type);
    if (file_exists($file)) {
        $json = @file_get_contents($file);
        $data = @json_decode($json, true);
        if (is_array($data) && count($data)) {
            return $data;
        }
    }
    // Initialize defaults
    $init = array();
    if ($type === 'routes') $init = get_initial_routes();
    if ($type === 'places') $init = get_initial_places();
    if ($type === 'vehicles') $init = get_initial_vehicles();

    @file_put_contents($file, json_encode($init, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    return $init;
}

function save_local_data($type, $items) {
    $file = get_local_storage_file($type);
    @file_put_contents($file, json_encode(array_values($items), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function sync_save_vehicle($data, $id = 0) {
    $items = load_local_data('vehicles');
    $found = false;
    if ($id) {
        foreach ($items as &$v) {
            if ($v['id'] == $id) {
                $v = array_merge($v, $data);
                $v['id'] = (int)$id;
                $found = true;
                break;
            }
        }
    }
    if (!$found) {
        $newId = $id ? (int)$id : (count($items) ? max(array_column($items, 'id')) + 1 : 1);
        $data['id'] = $newId;
        $items[] = $data;
    }
    save_local_data('vehicles', $items);
}

function sync_delete_vehicle($id) {
    $items = load_local_data('vehicles');
    $items = array_values(array_filter($items, function($v) use ($id) { return $v['id'] != $id; }));
    save_local_data('vehicles', $items);
}

function sync_toggle_vehicle($id) {
    $items = load_local_data('vehicles');
    foreach ($items as &$v) {
        if ($v['id'] == $id) {
            $v['is_active'] = empty($v['is_active']) ? 1 : 0;
        }
    }
    save_local_data('vehicles', $items);
}

function sync_save_place($data, $id = 0) {
    $items = load_local_data('places');
    $found = false;
    if ($id) {
        foreach ($items as &$p) {
            if ($p['id'] == $id) {
                $p = array_merge($p, $data);
                $p['id'] = (int)$id;
                $found = true;
                break;
            }
        }
    }
    if (!$found) {
        $newId = $id ? (int)$id : (count($items) ? max(array_column($items, 'id')) + 1 : 1);
        $data['id'] = $newId;
        $items[] = $data;
    }
    save_local_data('places', $items);
}

function sync_delete_place($id) {
    $items = load_local_data('places');
    $items = array_values(array_filter($items, function($p) use ($id) { return $p['id'] != $id; }));
    save_local_data('places', $items);
}

function sync_toggle_place($id) {
    $items = load_local_data('places');
    foreach ($items as &$p) {
        if ($p['id'] == $id) {
            $p['is_active'] = empty($p['is_active']) ? 1 : 0;
        }
    }
    save_local_data('places', $items);
}

function sync_save_route($data, $id = 0) {
    $items = load_local_data('routes');
    $found = false;
    if ($id) {
        foreach ($items as &$r) {
            if ($r['id'] == $id) {
                $r = array_merge($r, $data);
                $r['id'] = (int)$id;
                $found = true;
                break;
            }
        }
    }
    if (!$found) {
        $newId = $id ? (int)$id : (count($items) ? max(array_column($items, 'id')) + 1 : 1);
        $data['id'] = $newId;
        $items[] = $data;
    }
    save_local_data('routes', $items);
}

function sync_delete_route($id) {
    $items = load_local_data('routes');
    $items = array_values(array_filter($items, function($r) use ($id) { return $r['id'] != $id; }));
    save_local_data('routes', $items);
}

function sync_toggle_route($id, $col = 'is_active') {
    $items = load_local_data('routes');
    foreach ($items as &$r) {
        if ($r['id'] == $id) {
            $r[$col] = empty($r[$col]) ? 1 : 0;
        }
    }
    save_local_data('routes', $items);
}
