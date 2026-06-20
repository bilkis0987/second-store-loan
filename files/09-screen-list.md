# Screen List: Second Store Loan

**Dibuat:** Kamis, 25 Juni 2026

Baseline 24 halaman/screen untuk versi awal (MVP). Halaman tambahan boleh dibuat untuk pengembangan lanjutan, tapi 24 ini adalah baseline utama.

---

## 1. Splash Screen
**Isi:** Logo & nama aplikasi, slogan, background bernuansa otomotif modern, loading indicator.
**Fungsi:** Menampilkan identitas brand, mengecek session login, mengarahkan ke onboarding/home.

## 2. Onboarding / Intro
**Isi:** 3 slide pengenalan (jual, beli, sewa), judul & deskripsi tiap slide, tombol Lewati/Selanjutnya/Mulai.
**Fungsi:** Menjelaskan manfaat utama aplikasi, mengarahkan ke login/register.

## 3. Login
**Isi:** Logo, input email/HP, input password, toggle lihat password, tombol Masuk, link Lupa Password & Daftar Akun.
**Fungsi:** Autentikasi user/seller/rental/admin, validasi field, pesan error login gagal.

## 4. Register
**Isi:** Nama lengkap, email, no HP, password, konfirmasi password, pilihan role (user/seller/rental), checkbox syarat & ketentuan, tombol Daftar.
**Fungsi:** Registrasi akun baru, validasi form, simpan role awal.

## 5. Home / Beranda
**Isi:** App bar, search bar, banner promo, shortcut kategori, section kendaraan jual/sewa terbaru & populer, filter cepat, bottom navigation.
**Fungsi:** Pusat navigasi utama, menampilkan listing terbaru & rekomendasi.

## 6. Daftar Kendaraan Jual
**Isi:** Search bar, tombol filter, card kendaraan (foto, judul, harga, lokasi, tahun, transmisi, badge status, tombol favorit).
**Fungsi:** Menampilkan semua listing jual, memudahkan pencarian ke detail.

## 7. Daftar Kendaraan Sewa
**Isi:** Search bar, tombol filter, card kendaraan sewa (foto, nama, harga/hari, lokasi, jenis, badge status, tombol favorit).
**Fungsi:** Menampilkan semua listing sewa sesuai kebutuhan user.

## 8. Detail Kendaraan
**Isi:** Carousel foto, nama, harga jual/sewa, status, spesifikasi (tahun, warna, transmisi, bahan bakar, KM), lokasi, deskripsi, info seller/rental, tombol Hubungi Penjual / Ajukan Beli / Ajukan Sewa / Wishlist.
**Fungsi:** Informasi lengkap kendaraan, titik konversi utama ke transaksi.

## 9. Search & Filter Kendaraan
**Isi:** Input kata kunci, filter merek/kategori/jenis transaksi/harga min-max/lokasi/tahun/transmisi/bahan bakar, tombol Reset & Terapkan Filter.
**Fungsi:** Membantu user menemukan kendaraan secara relevan dan cepat.

## 10. Wishlist
**Isi:** Daftar kendaraan tersimpan (card dengan foto, nama, harga, lokasi, status), tombol hapus & buka detail, empty state.
**Fungsi:** Menyimpan kendaraan favorit untuk dipertimbangkan nanti.

## 11. Form Ajukan Beli
**Isi:** Ringkasan kendaraan, nama & no HP user, pesan ke penjual, input penawaran harga, checkbox persetujuan data, tombol Kirim Pengajuan.
**Fungsi:** Mengirim minat beli ke seller, simpan data pengajuan, validasi field wajib.

## 12. Form Ajukan Sewa
**Isi:** Ringkasan unit sewa, nama & no HP, tanggal mulai/selesai sewa, durasi, catatan, estimasi total biaya, tombol Ajukan Sewa.
**Fungsi:** Mengirim permintaan sewa, hitung estimasi biaya, validasi tanggal & kelengkapan.

## 13. Riwayat Transaksi
**Isi:** Tab transaksi beli/sewa/selesai, daftar riwayat dengan status, tanggal, nominal, tombol lihat detail, empty state.
**Fungsi:** Menampilkan histori aktivitas, status pengajuan, dan transaksi selesai user.

## 14. Profil User
**Isi:** Foto profil, nama, email, no HP, alamat, tombol edit profil/ubah password/logout.
**Fungsi:** Mengelola data akun pengguna.

## 15. Dashboard Seller
**Isi:** Ringkasan total listing/aktif/terjual/pengajuan masuk, shortcut tambah listing, daftar listing dengan status, tombol edit/ubah status.
**Fungsi:** Pusat pengelolaan listing jual milik seller.

## 16. Dashboard Rental
**Isi:** Ringkasan total unit/tersedia/disewa/permintaan masuk, shortcut tambah unit, daftar unit dengan status, tombol edit/kelola permintaan.
**Fungsi:** Pusat pengelolaan kendaraan sewa.

## 17. Tambah Listing Kendaraan
**Isi:** Upload foto, judul, merek, kategori, jenis transaksi (jual/sewa), harga jual, tarif harian/mingguan/bulanan, tahun, warna, transmisi, bahan bakar, KM, lokasi, deskripsi, tombol Simpan.
**Fungsi:** Membuat listing baru, simpan ke database.

## 18. Edit Listing Kendaraan
**Isi:** Semua field dari halaman Tambah Listing dengan data lama terisi otomatis, tombol Update, tombol hapus foto tertentu.
**Fungsi:** Mengubah data listing yang sudah ada secara real-time.

## 19. Manajemen Listing / Status Kendaraan
**Isi:** Daftar listing milik seller/rental, filter status, badge status (tersedia/pending/terjual/disewa/nonaktif), tombol ubah status/nonaktifkan/lihat detail.
**Fungsi:** Menjaga akurasi status kendaraan yang tampil di aplikasi.

## 20. Login Admin
**Isi:** Input email & password admin, tombol login, info akses terbatas.
**Fungsi:** Mengamankan akses ke panel admin.

## 21. Dashboard Admin
**Isi:** Ringkasan total user/seller/rental/listing/listing pending verifikasi, statistik transaksi, menu cepat ke verifikasi & manajemen user.
**Fungsi:** Pusat kontrol utama admin.

## 22. Verifikasi Listing
**Isi:** Daftar listing menunggu verifikasi, foto, detail singkat, identitas pemilik, tombol Setujui/Tolak, input catatan verifikasi, filter status.
**Fungsi:** Memastikan hanya listing valid yang tampil di aplikasi.

## 23. Manajemen User
**Isi:** Daftar user, filter role, search, detail (nama/email/HP/role/status), tombol aktifkan/nonaktifkan, lihat detail.
**Fungsi:** Mengelola akun pengguna secara administratif.

## 24. Notifikasi
**Isi:** Daftar notifikasi dengan ikon tipe, judul, pesan, timestamp, indikator read/unread, tombol Baca Semua.
**Fungsi:** Menampilkan notifikasi in-app (verifikasi kendaraan, status pengajuan beli/sewa).

---

## Catatan untuk AI / Developer

- Setiap halaman wajib punya state: loading, success, error, dan empty state (jika relevan)
- Semua input penting wajib validasi
- Navigasi konsisten, desain modern & mudah dipahami
- Ikuti role akses: user, seller, rental, admin
- Jangan buat halaman hanya berupa judul/konten kosong — setiap screen harus siap dipakai sebagai screen MVP yang realistis
