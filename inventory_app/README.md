# Aplikasi Inventaris Barang (UKK Level 5 SMK Telkom Lampung)

Aplikasi sederhana berbasis PHP (vanilla PHP + PDO + Bootstrap 5) untuk pengelolaan inventaris barang, peminjaman, dan manajemen user.

## Fitur
- Login & Logout (role: super_admin, admin)
- Manajemen Barang (CRUD)
- Transaksi Peminjaman & Pengembalian dengan stok otomatis
- Manajemen User (hanya super_admin)
- Riwayat Transaksi

## Setup
1. Ekstrak `inventory_app.zip`.
2. Import `database/db.sql` ke MySQL/MariaDB.
3. Sesuaikan konfigurasi database di `config.php`.
4. Jalankan di local server (XAMPP/LAMP) dengan root project ditunjuk ke folder ini.

Default super admin:
- email: super@domain.test
- password: SuperPass123

