# UI Guidelines: Second Store Loan

**Dibuat:** Kamis, 25 Juni 2026

---

## Identitas Visual

| Elemen | Nilai |
|--------|-------|
| Warna Utama | #0066FF |
| Warna Sekunder | #FF5500 |
| Font | Poppins |
| Gaya | Modern, clean, automotive marketplace, profesional, terpercaya, energik, mobile-first |
| Bahasa UI | Bahasa Indonesia |

---

## Referensi Desain

OLX otomotif
Traveloka style clean layout
Marketplace modern dengan card listing besar
Dashboard seller sederhana dan informatif

---

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

**Aturan:** Library/pola di atas WAJIB dipakai. Jangan ganti dengan alternatif lain tanpa izin.

---

## Aturan UI

- Sistem warna mengikuti identitas brand/logo: Brand Blue #0066FF (warna 'Second Store' di logo, kesan tepercaya/aman/profesional) sebagai primary color
- Vibrant Orange #FF5500 (warna 'Loan' & lengkungan panah di logo, kesan energik/cepat/menarik perhatian) sebagai accent/CTA color - alternatif: #FF4500
- Deep Navy #0B1E4E (warna bayang huruf S di logo, kesan kokoh/premium) untuk teks utama pengganti hitam pekat, latar footer, dan card dark mode - alternatif: #102A6B
- Warna netral: Clean White #FFFFFF dan Light Gray #F8F9FA untuk background aplikasi
- Komposisi warna ikuti aturan 60-30-10: 60% warna netral (background putih/abu muda), 30% Brand Blue (navigasi, judul, card, tombol sekunder), 10% Vibrant Orange (hanya untuk elemen krusial: tombol CTA seperti 'Ajukan Sekarang'/'Beli', notifikasi penting, badge aktif)
- Jangan pakai oranye berlebihan - khususkan hanya untuk elemen yang butuh perhatian instan user
- Animasi Splash Screen: Saat pertama kali dibuka, logo aplikasi memiliki efek animasi masuk yang halus (seperti Fade-In dengan Scale-Up/Zoom-In perlahan selama 1.2 - 1.5 detik), disusul oleh kemunculan slogan ("Jual, beli, dan sewa kendaraan lebih mudah, aman, dan terpercaya.") di bawahnya dengan efek Fade-In + Slide-Up lambat, serta kemunculan loading indicator yang smooth.
- Mobile-first
- Gunakan bottom navigation untuk user
- Gunakan dashboard tab untuk seller dan rental
- Card kendaraan harus menampilkan foto utama, harga, lokasi, tahun, dan status
- Gunakan badge warna untuk status tersedia, terjual, disewa, pending
- Filter dan search harus mudah dijangkau di mobile
- Form input dibuat ringkas dan jelas

---

## Komponen Standar

- State management: Provider atau Riverpod
- HTTP client: Dio
- Routing: GoRouter
- Form validation: Flutter Form + validator
- Local storage: SharedPreferences
- Image picker: image_picker
- Carousel banner kendaraan: carousel_slider
- Date picker untuk sewa: table_calendar atau date picker bawaan
- Loading & feedback: snackbar, dialog konfirmasi, dan loading overlay

---

## Layout

- Sidebar navigasi untuk dashboard/admin
- Header dengan user menu
- Content area dengan padding konsisten
- Breadcrumb untuk navigasi dalam
