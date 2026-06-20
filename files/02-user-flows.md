# User Flows: Second Store Loan

**Dibuat:** Kamis, 25 Juni 2026

Dokumen ini menjelaskan alur kerja pengguna langkah demi langkah.
AI menggunakan ini untuk membuat UI, validasi, dan logika bisnis.

---

## Flow 1: Beli Kendaraan

1. User buka aplikasi
2. User login atau register
3. User cari kendaraan berdasarkan kategori atau filter
4. User buka detail kendaraan
5. User lihat foto, spesifikasi, harga, lokasi, dan kontak seller
6. User klik tombol minat beli / hubungi penjual
7. User kirim permintaan atau lanjut komunikasi
8. Seller menerima permintaan
9. Transaksi diproses offline atau melalui sistem lanjutan
10. Status kendaraan diperbarui menjadi terjual bila selesai

---

## Flow 2: Sewa Kendaraan

1. User buka aplikasi
2. User login atau register
3. User cari kendaraan sewa
4. User filter berdasarkan lokasi, harga sewa, durasi, dan jenis kendaraan
5. User buka detail unit sewa
6. User pilih tanggal mulai dan durasi sewa
7. User ajukan permintaan sewa
8. Penyedia rental menerima atau menolak permintaan
9. User menerima konfirmasi
10. Status kendaraan berubah menjadi disewa selama periode aktif

---

## Flow 3: Seller Menjual Kendaraan

1. Seller login
2. Seller masuk ke dashboard
3. Seller tambah listing kendaraan
4. Seller isi data kendaraan dan upload foto
5. Admin verifikasi listing
6. Listing tampil di aplikasi
7. Seller menerima minat beli dari user
8. Seller ubah status kendaraan saat transaksi selesai

---

## Flow 4: Rental Menambahkan Unit Sewa

1. Rental login
2. Rental masuk ke dashboard
3. Rental tambah unit kendaraan sewa
4. Rental isi tarif harian, mingguan, bulanan
5. Rental upload foto dan syarat sewa
6. Admin verifikasi listing
7. Unit tampil untuk user
8. Rental menerima permintaan sewa dari user

---

## Catatan

- Setiap flow harus punya titik awal dan akhir yang jelas
- Tambahkan flow baru jika ada fitur baru
- Sertakan error case jika perlu (misal: login gagal → tampilkan pesan)
