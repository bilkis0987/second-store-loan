# Database Schema: Second Store Loan

**Dibuat:** Kamis, 25 Juni 2026
**Database:** MySQL

---

### Tabel: `users`

| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | BIGINT UNSIGNED AUTO_INCREMENT | Primary Key |
| name | VARCHAR(255) | Nama lengkap |
| email | VARCHAR(255) UNIQUE | Email login |
| phone | VARCHAR(20) | Nomor HP |
| password | VARCHAR(255) | Hash password (bcrypt) |
| role | ENUM('user','seller','rental','admin') | Role pengguna |
| address | TEXT | Alamat |
| photo | VARCHAR(255) | Foto profil (nullable) |
| is_active | TINYINT(1) DEFAULT 1 | Status aktif |
| created_at | TIMESTAMP | - |
| updated_at | TIMESTAMP | - |

**Relasi:** 1-N vehicles, 1-N purchase_requests, 1-N rental_requests, 1-N wishlists, 1-N device_tokens, 1-N notifications

### Tabel: `vehicle_brands`

| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | BIGINT UNSIGNED AUTO_INCREMENT | Primary Key |
| name | VARCHAR(255) | Nama brand/merek |
| created_at | TIMESTAMP | - |
| updated_at | TIMESTAMP | - |

**Relasi:** 1-N vehicles

### Tabel: `vehicles`

| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | BIGINT UNSIGNED AUTO_INCREMENT | Primary Key |
| owner_id | BIGINT UNSIGNED | FK ke users |
| brand_id | BIGINT UNSIGNED | FK ke vehicle_brands |
| title | VARCHAR(255) | Judul listing |
| slug | VARCHAR(255) UNIQUE | URL slug |
| category | VARCHAR(100) | Kategori (misal: SUV, Sedan, Hatchback, MPV, Sport, dll) |
| transaction_type | ENUM('jual','sewa') | Jenis transaksi |
| price | DECIMAL(15,2) | Harga jual (nullable untuk sewa) |
| rental_price_daily | DECIMAL(15,2) | Tarif harian (nullable) |
| rental_price_weekly | DECIMAL(15,2) | Tarif mingguan (nullable) |
| rental_price_monthly | DECIMAL(15,2) | Tarif bulanan (nullable) |
| year | INT | Tahun kendaraan |
| color | VARCHAR(50) | Warna |
| transmission | ENUM('manual','matic') | Transmisi |
| fuel_type | ENUM('bensin','diesel','listrik','hybrid') | Bahan bakar |
| mileage | INT | Kilometer |
| location | VARCHAR(255) | Lokasi kendaraan |
| description | TEXT | Deskripsi |
| status | ENUM('pending','available','sold','rented','rejected') | Status listing |
| thumbnail | VARCHAR(255) | Path foto utama |
| created_at | TIMESTAMP | - |
| updated_at | TIMESTAMP | - |

**Relasi:** milik users (owner_id), milik vehicle_brands (brand_id), 1-N vehicle_images, 1-N purchase_requests, 1-N rental_requests, 1-N wishlists, 1-N transactions, 1-N admin_verifications

### Tabel: `vehicle_images`

| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | BIGINT UNSIGNED AUTO_INCREMENT | Primary Key |
| vehicle_id | BIGINT UNSIGNED | FK ke vehicles |
| image_url | VARCHAR(255) | Path gambar |
| sort_order | INT DEFAULT 0 | Urutan tampilan |
| created_at | TIMESTAMP | - |
| updated_at | TIMESTAMP | - |

**Relasi:** milik vehicles

### Tabel: `purchase_requests`

| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | BIGINT UNSIGNED AUTO_INCREMENT | Primary Key |
| vehicle_id | BIGINT UNSIGNED | FK ke vehicles |
| user_id | BIGINT UNSIGNED | FK ke users (pembeli) |
| message | TEXT | Pesan ke penjual (nullable) |
| offer_price | DECIMAL(15,2) | Harga penawaran |
| status | ENUM('pending','approved','rejected','cancelled') | Status pengajuan |
| created_at | TIMESTAMP | - |
| updated_at | TIMESTAMP | - |

**Relasi:** milik vehicles & users

### Tabel: `rental_requests`

| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | BIGINT UNSIGNED AUTO_INCREMENT | Primary Key |
| vehicle_id | BIGINT UNSIGNED | FK ke vehicles |
| user_id | BIGINT UNSIGNED | FK ke users (penyewa) |
| rental_start_date | DATE | Tanggal mulai sewa |
| rental_end_date | DATE | Tanggal selesai sewa |
| total_days | INT | Total hari |
| total_price | DECIMAL(15,2) | Total biaya |
| note | TEXT | Catatan (nullable) |
| status | ENUM('pending','approved','rejected','active','completed','cancelled') | Status pengajuan |
| created_at | TIMESTAMP | - |
| updated_at | TIMESTAMP | - |

**Relasi:** milik vehicles & users

### Tabel: `wishlists`

| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | BIGINT UNSIGNED AUTO_INCREMENT | Primary Key |
| user_id | BIGINT UNSIGNED | FK ke users |
| vehicle_id | BIGINT UNSIGNED | FK ke vehicles |
| created_at | TIMESTAMP | - |

**Relasi:** milik users & vehicles. Unique composite: (user_id, vehicle_id)

### Tabel: `transactions`

| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | BIGINT UNSIGNED AUTO_INCREMENT | Primary Key |
| vehicle_id | BIGINT UNSIGNED | FK ke vehicles |
| buyer_id | BIGINT UNSIGNED | FK ke users |
| seller_id | BIGINT UNSIGNED | FK ke users |
| rental_request_id | BIGINT UNSIGNED | FK ke rental_requests (nullable, hanya untuk sewa) |
| transaction_type | ENUM('jual','sewa') | Jenis transaksi |
| amount | DECIMAL(15,2) | Jumlah transaksi |
| payment_status | ENUM('pending','paid','failed','refunded') | Status pembayaran |
| transaction_status | ENUM('pending','processing','completed','cancelled') | Status transaksi |
| created_at | TIMESTAMP | - |
| updated_at | TIMESTAMP | - |

**Relasi:** milik vehicles, users (buyer & seller)

### Tabel: `admin_verifications`

| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | BIGINT UNSIGNED AUTO_INCREMENT | Primary Key |
| vehicle_id | BIGINT UNSIGNED | FK ke vehicles |
| admin_id | BIGINT UNSIGNED | FK ke users (admin) |
| notes | TEXT | Catatan verifikasi (nullable) |
| status | ENUM('approved','rejected') | Hasil verifikasi |
| verified_at | TIMESTAMP | Waktu verifikasi |
| created_at | TIMESTAMP | - |
| updated_at | TIMESTAMP | - |

**Relasi:** milik vehicles, diverifikasi oleh admin (users)

### Tabel: `device_tokens`

| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | BIGINT UNSIGNED AUTO_INCREMENT | Primary Key |
| user_id | BIGINT UNSIGNED | FK ke users |
| token | VARCHAR(500) | FCM device token |
| device_type | VARCHAR(20) DEFAULT 'android' | Tipe device |
| created_at | TIMESTAMP | - |
| updated_at | TIMESTAMP | - |

**Relasi:** milik users. Unique composite: (user_id, token)

### Tabel: `notifications`

| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | BIGINT UNSIGNED AUTO_INCREMENT | Primary Key |
| user_id | BIGINT UNSIGNED | FK ke users |
| type | VARCHAR(50) | Tipe (vehicle_verified, purchase_status_updated, dll) |
| title | VARCHAR(255) | Judul notifikasi |
| message | TEXT | Isi notifikasi |
| data | JSON | Data tambahan (nullable) |
| is_read | TINYINT(1) DEFAULT 0 | Status baca |
| read_at | TIMESTAMP | Waktu dibaca (nullable) |
| created_at | TIMESTAMP | - |
| updated_at | TIMESTAMP | - |

**Relasi:** milik users. Index: (user_id, is_read)

### Tabel: `password_reset_tokens` (Laravel default)

| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| email | VARCHAR(255) | Email user |
| token | VARCHAR(255) | Reset token |
| created_at | TIMESTAMP | - |

### Tabel: `failed_jobs` (Laravel default)

| Kolom | Tipe |
|-------|------|
| id | BIGINT UNSIGNED AUTO_INCREMENT |
| uuid | VARCHAR(255) UNIQUE |
| connection | TEXT |
| queue | TEXT |
| payload | LONGTEXT |
| exception | LONGTEXT |
| failed_at | TIMESTAMP DEFAULT CURRENT_TIMESTAMP |

### Tabel: `personal_access_tokens` (Sanctum default)

| Kolom | Tipe |
|-------|------|
| id | BIGINT UNSIGNED AUTO_INCREMENT |
| tokenable_type | VARCHAR(255) |
| tokenable_id | BIGINT UNSIGNED |
| name | VARCHAR(255) |
| token | VARCHAR(64) UNIQUE |
| abilities | TEXT |
| last_used_at | TIMESTAMP |
| expires_at | TIMESTAMP |
| created_at | TIMESTAMP |
| updated_at | TIMESTAMP |

---

## Relasi Lengkap

- `users` 1-N `vehicles` (via owner_id)
- `vehicle_brands` 1-N `vehicles` (via brand_id)
- `vehicles` 1-N `vehicle_images`
- `users` 1-N `purchase_requests`
- `vehicles` 1-N `purchase_requests`
- `users` 1-N `rental_requests`
- `vehicles` 1-N `rental_requests`
- `users` 1-N `wishlists`
- `vehicles` 1-N `wishlists`
- `vehicles` 1-N `transactions`
- `users` 1-N `transactions` (via buyer_id / seller_id)
- `vehicles` 1-N `admin_verifications`
- `users` 1-N `admin_verifications` (via admin_id)
- `users` 1-N `device_tokens`
- `users` 1-N `notifications`

---

## Konvensi

- Primary key: `id` (BIGINT UNSIGNED AUTO_INCREMENT)
- Timestamp: `created_at`, `updated_at`
- Soft delete: `deleted_at` (jika diperlukan)
- Foreign key: `{table_singular}_id`
- Enum values lowercase
- Semua tabel menggunakan InnoDB engine
