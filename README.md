# PORTAL DIGITAL GEREJA

Starter project web untuk digitalisasi gereja.

## Fitur V1
- Login jemaat/admin
- Dashboard jemaat
- Profil jemaat
- Pengumuman
- Tata ibadah
- Kalender kegiatan
- Jadwal pelayanan
- Permohonan doa
- Dashboard admin sederhana
- Struktur database MySQL

## Instalasi
1. Pastikan PHP 8.1+ dan MySQL/MariaDB tersedia.
2. Buat database, misalnya `portal_gereja`.
3. Import `database/schema.sql`.
4. Edit koneksi database di `config.php`.
5. Upload folder project ke hosting atau jalankan:
   `php -S localhost:8000`
6. Buka `http://localhost:8000`.

Akun demo:
- Admin: admin@gereja.local / admin123
- Jemaat: jemaat@gereja.local / jemaat123

Catatan: akun demo memakai password hash yang sudah tersedia di SQL. Segera ganti password pada instalasi nyata.
