# Prompt Starter — Second Store Loan

Copy-paste prompt ini ke AI untuk memulai development.

---

## Prompt Awal (Setup Project)

```
Kamu developer untuk project "Second Store Loan".

Baca dulu dokumentasi berikut:
- docs/01-product-brief.md
- docs/03-database-schema.md
- docs/05-ui-guidelines.md
- AI-RULES.md

Stack:
- Frontend: Flutter
- Backend: Laravel API
- Database: MySQL
- Auth: Laravel Sanctum / JWT
- Styling: Flutter Material 3

Stack UI / Library (WAJIB):
- State management: Provider atau Riverpod
- HTTP client: Dio
- Routing: GoRouter
- Form validation: Flutter Form + validator
- Local storage: SharedPreferences
- Image picker: image_picker
- Carousel banner kendaraan: carousel_slider
- Date picker untuk sewa: table_calendar atau date picker bawaan
- Loading & feedback: snackbar, dialog konfirmasi, dan loading overlay

Task: Setup project dari awal + implementasi Fase 1 dari docs/06-task-backlog.md

Constraint:
- Ikuti semua aturan di AI-RULES.md
- Patuhi Stack UI / Library — jangan ganti library/pola UI
- Bahasa UI: Bahasa Indonesia
- Jangan tambah fitur di luar MVP

Selesai jika semua item di docs/07-acceptance-criteria.md untuk fase ini terpenuhi.
```

---

## Prompt Lanjutan (Per Fitur)

```
Lanjutkan project "Second Store Loan".

Baca docs/06-task-backlog.md — kerjakan task berikutnya yang belum selesai.

Sebelum coding:
1. Cek kode yang sudah ada
2. Baca docs/02-user-flows.md untuk fitur ini
3. Ikuti docs/04-api-spec.md untuk API

Jangan ubah modul yang sudah selesai.
```

---

## Prompt Fix Bug

```
Ada bug di project "Second Store Loan":

[JELASKAN BUG DI SINI]

Langkah:
1. Identifikasi root cause
2. Fix dengan minimal perubahan
3. Pastikan tidak break fitur lain
4. Jelaskan apa yang diperbaiki

Ikuti AI-RULES.md
```

---

## Prompt Review

```
Review kode project "Second Store Loan" untuk task [NAMA TASK].

Cek terhadap:
- docs/07-acceptance-criteria.md
- docs/05-ui-guidelines.md
- AI-RULES.md

Laporkan: apa yang sudah OK, apa yang kurang, apa yang perlu diperbaiki.
```
