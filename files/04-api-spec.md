# API Specification: Second Store Loan

**Dibuat:** Kamis, 25 Juni 2026
**Backend:** Laravel API

---

## Format Response Standar

### Sukses
```json
{
  "success": true,
  "message": "Data berhasil diambil",
  "data": {},
  "meta": {}
}
```

### Error Validasi (422)
```json
{
  "success": false,
  "message": "Validasi gagal",
  "errors": {
    "field_name": ["Pesan error"]
  }
}
```

### Error Umum (4xx / 5xx)
```json
{
  "success": false,
  "message": "Pesan error"
}
```

---

## Konvensi Endpoint

| Method | Pattern | Keterangan |
|--------|---------|------------|
| GET | /api/{resource} | List dengan pagination |
| GET | /api/{resource}/{id} | Detail |
| POST | /api/{resource} | Create |
| PUT/PATCH | /api/{resource}/{id} | Update |
| DELETE | /api/{resource}/{id} | Delete |

---

## Endpoint

### Auth (Public)

| Method | Endpoint | Deskripsi | Request Body |
|--------|----------|-----------|-------------|
| POST | /api/auth/register | Register user baru | `name`, `email`, `password`, `password_confirmation`, `role`, `phone?`, `address?` |
| POST | /api/auth/login | Login user | `email`, `password` |

**Response Login/Register:**
```json
{
  "success": true,
  "message": "...",
  "data": {
    "user": { "id", "name", "email", "role", "phone", "address", "photo", "is_active" },
    "access_token": "string"
  }
}
```

### Public — Kendaraan & Brand

| Method | Endpoint | Deskripsi | Parameter |
|--------|----------|-----------|-----------|
| GET | /api/brands | Daftar brand kendaraan | - |
| GET | /api/vehicles | Daftar kendaraan (list) | `transaction_type`, `category`, `brand_id`, `search`, `status`, `page`, `per_page` |
| GET | /api/vehicles/{id} | Detail kendaraan | - |

**Response GET /api/vehicles:**
```json
{
  "success": true,
  "data": [{ "id", "title", "price", "thumbnail", ... }],
  "meta": { "current_page", "last_page", "per_page", "total" }
}
```

### Auth Required (Bearer Token)

#### Profile

| Method | Endpoint | Deskripsi | Request Body |
|--------|----------|-----------|-------------|
| GET | /api/auth/me | Profil user login | - |
| PUT | /api/auth/me | Update profil | `name?`, `phone?`, `address?` |
| POST | /api/auth/change-password | Ubah password | `current_password`, `new_password`, `new_password_confirmation` |
| POST | /api/auth/logout | Logout (hapus token) | - |

#### Vehicles (CRUD)

| Method | Endpoint | Deskripsi | Request Body |
|--------|----------|-----------|-------------|
| POST | /api/vehicles | Tambah kendaraan | `title`, `brand_id`, `category`, `transaction_type`, `price?`, `rental_price_daily?`, ... + `thumbnail`, `images[]` |
| PUT | /api/vehicles/{id} | Update kendaraan | (same as store) |
| DELETE | /api/vehicles/{id} | Hapus kendaraan | - |

#### Purchase Requests

| Method | Endpoint | Deskripsi | Request Body |
|--------|----------|-----------|-------------|
| POST | /api/purchase-requests | Ajukan beli | `vehicle_id`, `offer_price`, `message?` |
| GET | /api/purchase-requests | List pengajuan (role-based) | - |
| PUT | /api/purchase-requests/{id}/status | Update status | `status`: approved/rejected/cancelled |

#### Rental Requests

| Method | Endpoint | Deskripsi | Request Body |
|--------|----------|-----------|-------------|
| POST | /api/rental-requests | Ajukan sewa | `vehicle_id`, `rental_start_date`, `rental_end_date`, `note?` |
| GET | /api/rental-requests | List pengajuan (role-based) | - |
| PUT | /api/rental-requests/{id}/status | Update status | `status`: approved/rejected/active/completed/cancelled |

#### Wishlist

| Method | Endpoint | Deskripsi | Request Body |
|--------|----------|-----------|-------------|
| GET | /api/wishlists | Daftar wishlist user | - |
| POST | /api/wishlists/toggle | Tambah/hapus wishlist | `vehicle_id` |
| GET | /api/wishlists/check/{vehicleId} | Cek status wishlist | - |

#### Notifications (In-App)

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | /api/notifications | Daftar notifikasi user + `unread_count` |
| PUT | /api/notifications/{id}/read | Tandai satu notifikasi sudah dibaca |
| PUT | /api/notifications/read-all | Tandai semua notifikasi sudah dibaca |

#### Transactions

| Method | Endpoint | Deskripsi | Parameter |
|--------|----------|-----------|-----------|
| GET | /api/transactions | List transaksi (role-based) | `type?` (jual/sewa), `status?` |
| GET | /api/transactions/{id} | Detail transaksi | - |

#### FCM Push Notification

| Method | Endpoint | Deskripsi | Request Body |
|--------|----------|-----------|-------------|
| POST | /api/fcm/register | Daftarkan token device | `token`, `device_type` |
| POST | /api/fcm/unregister | Hapus token device | `token` |

#### Dashboard

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | /api/dashboard | Statistik dashboard (role-based: admin/seller/rental/user) |

#### Admin Panel

| Method | Endpoint | Deskripsi | Request Body |
|--------|----------|-----------|-------------|
| GET | /api/admin/pending-vehicles | Listing menunggu verifikasi | - |
| PUT | /api/admin/verify-vehicle/{id} | Verifikasi listing | `status`: approved/rejected, `notes?` |
| GET | /api/admin/users | Daftar user | `role?`, `search?` |
| PUT | /api/admin/users/{id}/toggle-active | Aktif/nonaktifkan user | - |

---

## Aturan

- Semua endpoint (kecuali auth & public) butuh autentikasi (Bearer token via Sanctum)
- Gunakan pagination: `?page=1&per_page=15`
- Sorting: `?sort=created_at&order=desc`
- Filter: `?search=keyword&status=active`
- Format tanggal: `YYYY-MM-DD`
- Role values: `user`, `seller`, `rental`, `admin`
- Vehicle status: `pending`, `available`, `sold`, `rented`, `rejected`
- Transaction type: `jual`, `sewa`
- Payment status: `pending`, `paid`, `failed`, `refunded`
- Transaction status: `pending`, `processing`, `completed`, `cancelled`
