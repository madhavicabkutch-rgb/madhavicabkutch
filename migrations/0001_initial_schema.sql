-- Cloudflare D1 Migration: Initial Schema for Madhavi Cab Kutch

CREATE TABLE IF NOT EXISTS settings (
  setting_key TEXT PRIMARY KEY,
  setting_value TEXT
);

CREATE TABLE IF NOT EXISTS admin_users (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  username TEXT UNIQUE NOT NULL,
  password_hash TEXT NOT NULL,
  full_name TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS routes (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  from_city TEXT NOT NULL DEFAULT 'Bhuj',
  to_city TEXT NOT NULL,
  slug TEXT UNIQUE NOT NULL,
  distance_km INTEGER,
  duration TEXT,
  sedan_fare REAL,
  suv_fare REAL,
  tempo_fare REAL,
  description TEXT,
  show_on_home INTEGER DEFAULT 0,
  sort_order INTEGER DEFAULT 0,
  is_active INTEGER DEFAULT 1
);

CREATE TABLE IF NOT EXISTS places (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  title TEXT NOT NULL,
  slug TEXT UNIQUE NOT NULL,
  category TEXT,
  distance_bhuj TEXT,
  best_time TEXT,
  short_desc TEXT,
  description TEXT,
  image TEXT,
  sort_order INTEGER DEFAULT 0,
  is_active INTEGER DEFAULT 1
);

CREATE TABLE IF NOT EXISTS vehicles (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL,
  category TEXT NOT NULL DEFAULT 'Car',
  models TEXT,
  seats TEXT,
  luggage TEXT,
  per_km TEXT,
  description TEXT,
  image TEXT,
  sort_order INTEGER DEFAULT 0,
  is_active INTEGER DEFAULT 1,
  local_8h_80km_ac TEXT,
  local_8h_80km_nonac TEXT,
  local_12h_300km_ac TEXT,
  local_12h_300km_nonac TEXT,
  extra_km_ac TEXT,
  extra_km_nonac TEXT,
  airport_transfer TEXT,
  daily_min_km INTEGER,
  driver_night_allowance TEXT,
  notes TEXT
);

CREATE TABLE IF NOT EXISTS local_rates (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  label TEXT NOT NULL,
  sedan_fare REAL,
  suv_fare REAL,
  tempo_fare REAL,
  extra_km TEXT,
  extra_hour TEXT,
  sort_order INTEGER DEFAULT 0,
  is_active INTEGER DEFAULT 1
);

CREATE TABLE IF NOT EXISTS outstation_rates (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  vehicle TEXT NOT NULL,
  per_km REAL,
  daily_min_km INTEGER,
  night_allowance REAL,
  seats TEXT,
  sort_order INTEGER DEFAULT 0,
  is_active INTEGER DEFAULT 1
);

CREATE TABLE IF NOT EXISTS packages (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  title TEXT NOT NULL,
  slug TEXT UNIQUE NOT NULL,
  pkg_type TEXT DEFAULT 'day',
  duration_label TEXT,
  distance_label TEXT,
  price_from REAL,
  short_desc TEXT,
  highlights TEXT,
  itinerary TEXT,
  inclusions TEXT,
  exclusions TEXT,
  image TEXT,
  show_on_home INTEGER DEFAULT 0,
  sort_order INTEGER DEFAULT 0,
  is_active INTEGER DEFAULT 1
);

CREATE TABLE IF NOT EXISTS faqs (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  page TEXT NOT NULL DEFAULT 'home',
  question TEXT NOT NULL,
  answer TEXT NOT NULL,
  sort_order INTEGER DEFAULT 0,
  is_active INTEGER DEFAULT 1
);

CREATE TABLE IF NOT EXISTS reviews (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  customer_name TEXT NOT NULL,
  customer_city TEXT,
  rating INTEGER DEFAULT 5,
  review_text TEXT NOT NULL,
  sort_order INTEGER DEFAULT 0,
  is_active INTEGER DEFAULT 1
);

-- Indices for performance
CREATE INDEX IF NOT EXISTS idx_routes_active_home ON routes(is_active, show_on_home, sort_order);
CREATE INDEX IF NOT EXISTS idx_places_active ON places(is_active, sort_order);
CREATE INDEX IF NOT EXISTS idx_places_slug ON places(slug);
CREATE INDEX IF NOT EXISTS idx_vehicles_active_cat ON vehicles(is_active, category, sort_order);
