# Task Backlog: Second Store Loan

**Dibuat:** Kamis, 25 Juni 2026

Kerjakan task **satu fase per sesi AI**. Jangan minta semua sekaligus.

---

## Fase Development

### Fase 1: Setup project Flutter dan backend API
- [x] Inisialisasi Flutter project dengan struktur feature-first
- [x] Setup Laravel API dengan Sanctum auth
- [x] Konfigurasi database MySQL
- [x] Setup routing (GoRouter)
- [x] Setup state management (Riverpod)
- [x] Setup Dio HTTP client dengan interceptor

### Fase 2: Auth, role user, dan profil
- [x] Register screen dengan pilihan role
- [x] Login screen (user + admin)
- [x] Splash screen dengan session check
- [x] Onboarding screen
- [x] Profile screen
- [x] Edit profile screen
- [x] Change password screen
- [x] Backend: AuthController (register, login, logout, me, updateProfile, changePassword)

### Fase 3: Listing kendaraan jual dan sewa
- [x] Vehicle list screen (jual + sewa)
- [x] Vehicle detail screen (carousel, spek, kontak)
- [x] Search screen dengan pagination
- [x] Filter screen
- [x] Listing form screen (add/edit)
- [x] Listing management screen
- [x] Backend: VehicleController + Brand model

### Fase 4: Detail kendaraan, search, filter, wishlist
- [x] Wishlist screen
- [x] Wishlist toggle di card & detail
- [x] Filter by brand, type, price, location, year, transmission
- [x] Backend: WishlistController

### Fase 5: Pengajuan beli dan pengajuan sewa
- [x] Purchase form screen
- [x] Rental form screen
- [x] Transactions screen (tab Beli + Sewa)
- [x] Backend: RequestController

### Fase 6: Dashboard seller / rental
- [x] Seller dashboard screen (stats, requests approve/reject)
- [x] Rental dashboard screen (stats, requests approve/reject)
- [x] Backend: DashboardController

### Fase 7: Admin panel verifikasi listing
- [x] Admin login
- [x] Admin dashboard
- [x] Verification screen (approve/reject)
- [x] User management screen
- [x] Backend: AdminController

### Fase 8: Riwayat transaksi dan penyempurnaan UI
- [x] Transaction history dari API transactions
- [x] Status badges konsisten
- [x] Empty states di semua screen
- [x] Loading states
- [x] Reusable widgets

### Fase 9: Integrasi notifikasi dan deployment
- [x] FCM setup (firebase_core, firebase_messaging)
- [x] FcmService (init, token, permission)
- [x] Device token management API
- [x] Notification inbox screen + API (in-app notifications)
- [x] Notification triggers di event verify, purchase, rental
- [x] ProGuard/R8 minification
- [x] Release APK build (--split-per-abi)


---

## Checklist Fitur MVP

- [x] Login & Register
- [x] Login dengan role user, seller, rental, admin
- [x] Profil pengguna
- [x] Listing kendaraan jual
- [x] Listing kendaraan sewa
- [x] Detail kendaraan lengkap
- [x] Pencarian kendaraan
- [x] Filter berdasarkan merek, tipe, harga, lokasi, tahun, transmisi
- [x] Ajukan beli kendaraan
- [x] Ajukan sewa kendaraan
- [x] Wishlist / simpan kendaraan
- [x] Chat / kontak penjual via tombol WhatsApp atau kontak langsung
- [x] Upload foto kendaraan
- [x] Dashboard seller / rental
- [x] Kelola listing kendaraan
- [x] Status kendaraan tersedia, terjual, disewa
- [x] Riwayat transaksi user
- [x] Verifikasi data listing oleh admin
- [x] Manajemen pengguna oleh admin
- [x] Notifikasi in-app

---

## Cara Assign Task ke AI

Berikan prompt berikut ke AI:

```
Baca docs/01-product-brief.md, docs/03-database-schema.md, dan AI-RULES.md.
Kerjakan Fase [X] dari docs/06-task-backlog.md.
Jangan ubah modul yang sudah selesai.
```

---

## Status

| Fase | Status | Catatan |
|------|--------|---------|
| Fase 1 | ✅ Selesai | |
| Fase 2 | ✅ Selesai | |
| Fase 3 | ✅ Selesai | |
| Fase 4 | ✅ Selesai | |
| Fase 5 | ✅ Selesai | |
| Fase 6 | ✅ Selesai | |
| Fase 7 | ✅ Selesai | |
| Fase 8 | ✅ Selesai | |
| Fase 9 | ✅ Selesai | FCM disabled (Firebase dihapus), in-app notification aktif |
