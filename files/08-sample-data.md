# Sample Data: Second Store Loan

**Dibuat:** Kamis, 25 Juni 2026

Data contoh untuk seed database dan testing.

---

## Data Custom

Kendaraan: Toyota Avanza 2021, otomatis, hitam, Jakarta, Rp185000000
Kendaraan sewa: Honda Brio 2022, manual, Surabaya, Rp350000 per hari
User: Andi Pratama, andi@email.com, role user
Seller: Showroom Maju Motor, role seller
Rental: Sewa Mobil Nusantara, role rental

---

## Template Seed User

```json
{
  "users": [
    {
      "name": "Admin",
      "email": "admin@example.com",
      "password": "password",
      "role": "admin"
    },
    {
      "name": "User Biasa",
      "email": "user@example.com",
      "password": "password",
      "role": "user"
    }
  ]
}
```

---

## Catatan

- Gunakan password dummy untuk development
- Jangan commit credential asli ke git
- Sesuaikan data dengan schema di `03-database-schema.md`
