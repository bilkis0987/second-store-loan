# AI Rules: Second Store Loan

## Stack

| Layer | Teknologi |
|-------|-----------|
| Frontend | Flutter |
| Backend | Laravel API |
| Database | MySQL |
| Auth | Laravel Sanctum / JWT |
| Styling | Flutter Material 3 |

## Stack UI / Library (WAJIB)

- State management: Provider atau Riverpod
- HTTP client: Dio
- Routing: GoRouter
- Form validation: Flutter Form + validator
- Local storage: SharedPreferences
- Image picker: image_picker
- Carousel banner kendaraan: carousel_slider
- Date picker untuk sewa: table_calendar atau date picker bawaan
- Loading & feedback: snackbar, dialog konfirmasi, dan loading overlay

## Dokumentasi yang Harus Dibaca

Sebelum coding, baca file di folder `docs/`:
1. `01-product-brief.md` — visi & fitur
2. `03-database-schema.md` — skema database
3. `06-task-backlog.md` — task yang sedang dikerjakan

## Aturan

- Fokus dulu pada MVP
- Jangan menambahkan fitur di luar scope tanpa diminta
- Gunakan Flutter untuk frontend mobile
- Gunakan Laravel API untuk backend
- Semua label UI pakai Bahasa Indonesia
- Buat struktur kode yang rapi dan scalable
- Gunakan reusable component
- Semua form wajib validasi
- Semua data kendaraan harus punya status yang jelas
- Prioritaskan performa aplikasi mobile
- Desain harus modern, clean, dan mudah dipahami user umum

## Konvensi Kode

- Gunakan arsitektur feature-first
- Pisahkan layer presentation, domain, dan data
- Gunakan Bahasa Indonesia untuk label UI
- Nama variabel dan function pakai bahasa Inggris yang jelas
- Semua response API harus konsisten
- Gunakan reusable widget untuk card, form field, button, dan badge status

## Larangan

- Jangan ubah file .env tanpa izin
- Jangan hapus atau rename file docs/
- Jangan menambah fitur di luar MVP tanpa diminta
- Jangan ganti stack teknologi
- Jangan ganti library/pola UI yang sudah ditetapkan di **Stack UI / Library**
- Jangan pakai `alert()`, `confirm()`, `prompt()` native jika SweetAlert2 sudah ditetapkan
