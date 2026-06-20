# Product Brief: Second Store Loan

**Dibuat:** Kamis, 25 Juni 2026
**Tagline:** Jual, beli, dan sewa kendaraan lebih mudah, aman, dan terpercaya.

---

## Tujuan

Membangun aplikasi marketplace kendaraan yang memudahkan pengguna untuk menjual kendaraan, membeli kendaraan bekas atau baru dari seller terpercaya, serta menyewa kendaraan harian, mingguan, atau bulanan dalam satu platform. Aplikasi ini harus membantu transaksi jadi lebih cepat, transparan, dan praktis, baik untuk individu, dealer, maupun rental kendaraan.

## Target Pengguna

- Pembeli kendaraan
- Penjual kendaraan pribadi
- Dealer kendaraan
- Penyedia rental kendaraan
- Admin platform

## Problem Statement

Saat ini proses jual beli dan sewa kendaraan sering tersebar di berbagai platform, informasi kendaraan tidak selalu lengkap, proses negosiasi tidak terstruktur, dan pencarian unit sewa memakan waktu. Aplikasi ini diharapkan menjadi solusi terpusat untuk listing kendaraan, pencarian unit, pengajuan sewa, dan pengelolaan transaksi secara lebih efisien.

---

## Fitur MVP (Versi Pertama)

- Login & Register
- Login dengan role user, seller, rental, admin
- Profil pengguna
- Listing kendaraan jual
- Listing kendaraan sewa
- Detail kendaraan lengkap
- Pencarian kendaraan
- Filter berdasarkan merek, tipe, harga, lokasi, tahun, transmisi
- Ajukan beli kendaraan
- Ajukan sewa kendaraan
- Wishlist / simpan kendaraan
- Chat / kontak penjual via tombol WhatsApp atau kontak langsung
- Upload foto kendaraan
- Dashboard seller / rental
- Kelola listing kendaraan
- Status kendaraan tersedia, terjual, disewa
- Riwayat transaksi user
- Verifikasi data listing oleh admin
- Manajemen pengguna oleh admin

## Fitur Non-MVP (Ditunda)

- Integrasi payment gateway
- Booking fee online
- Simulasi cicilan / pembiayaan
- Notifikasi push
- Review dan rating seller / rental
- Live chat dalam aplikasi
- Integrasi GPS / maps
- Upload video kendaraan
- Promo dan voucher
- Multi cabang rental / dealer

## Di Luar Scope

- Lelang kendaraan
- Tracking kendaraan real-time
- Marketplace sparepart
- Integrasi asuransi otomatis
- AI pricing prediction

---

## Stack Teknologi

| Layer | Teknologi |
|-------|-----------|
| Frontend | Flutter |
| Backend | Laravel API |
| Database | MySQL |
| Auth | Laravel Sanctum / JWT |
| Styling | Flutter Material 3 |
| Hosting | Shared hosting untuk backend Laravel dan MySQL, serta build Flutter untuk distribusi aplikasi mobile |

### Teknologi Lain

REST API
Firebase Cloud Messaging untuk notifikasi nanti
Cloud storage untuk upload gambar
WhatsApp deep link untuk kontak seller
Struktur deployment Laravel harus kompatibel dengan shared hosting

## Stack UI / Library

- State management: Provider atau Riverpod
- HTTP client: Dio
- Routing: GoRouter
- Form validation: Flutter Form + validator
- Local storage: SharedPreferences
- Image picker: image_picker
- Carousel banner kendaraan: carousel_slider
- Date picker untuk sewa: table_calendar atau date picker bawaan
- Loading & feedback: snackbar, dialog konfirmasi, dan loading overlay

## Konvensi Kode

- Gunakan arsitektur feature-first
- Pisahkan layer presentation, domain, dan data
- Gunakan Bahasa Indonesia untuk label UI
- Nama variabel dan function pakai bahasa Inggris yang jelas
- Gunakan reusable widget untuk card, form field, button, dan badge status

---

## Panduan Logo & Navigasi

### 1. File Aset Logo
- **Nama Aset:** `assets/images/logo_second_store_loan.png` (diambil dari `logo-second-store-loan.png`).
- **Warna Brand:** 
  - Primary: Brand Blue `#0066FF`
  - Accent/CTA: Vibrant Orange `#FF5500`
  - Shadow/Text: Deep Navy `#0B1E4E`

### 2. Penempatan Logo & Animasi
- **Splash Screen:** Logo diletakkan di tengah dengan animasi Fade-In dan Scale-Up (durasi 1.2 - 1.5 detik) yang mulus, diikuti oleh slogan ("Jual, beli, dan sewa kendaraan lebih mudah, aman, dan terpercaya.") yang muncul di bawahnya dengan efek Fade-In + Slide-Up lambat.
- **Login/Register:** Logo berukuran sedang di bagian atas form.
- **Beranda (App Bar):** Logo mini di pojok kiri atas sebagai identitas brand.

### 3. Struktur Bottom Navigation Bar (User)
Mempunyai **5 menu utama**:
1. **Beranda** (Akses ke rekomendasi & banner).
2. **Cari** (Daftar unit jual/sewa).
3. **Wishlist** (Unit favorit tersimpan).
4. **Transaksi** (Riwayat pengajuan beli/sewa).
5. **Profil** (Pengaturan data akun).

