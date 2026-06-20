# AGENTS.md — Second Store Loan

Panduan untuk AI agent yang bekerja di project ini.

## Project Overview

Membangun aplikasi marketplace kendaraan yang memudahkan pengguna untuk menjual kendaraan, membeli kendaraan bekas atau baru dari seller terpercaya, serta menyewa kendaraan harian, mingguan, atau bulanan dalam satu platform. Aplikasi ini harus membantu transaksi jadi lebih cepat, transparan, dan praktis, baik untuk individu, dealer, maupun rental kendaraan.

## Tech Stack

| Layer | Technology |
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

## Documentation

| File | Purpose |
|------|---------|
| docs/01-product-brief.md | Product vision & features |
| docs/02-user-flows.md | User journey steps |
| docs/03-database-schema.md | Database tables & relations |
| docs/04-api-spec.md | API conventions |
| docs/05-ui-guidelines.md | Visual design rules |
| docs/06-task-backlog.md | Development phases |
| docs/07-acceptance-criteria.md | Definition of done |
| docs/08-sample-data.md | Sample/seed data |

## Workflow

1. Read relevant docs before coding
2. Work on ONE phase/task at a time from backlog
3. Follow rules in AI-RULES.md
4. Validate against acceptance criteria when done

## Constraints

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
