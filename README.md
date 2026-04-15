# Laravel Eloquent Project - Employee Management System

## Overview
Proyek ini dikembangkan untuk memenuhi tugas materi Laravel Eloquent. Sistem ini mengelola data karyawan, gaji, dan departemen dengan fitur pencarian, pengurutan, dan paginasi yang efisien.

## Features implemented
1.  **New Relationship Model**: Menambahkan model `Departemen` yang terelasi dengan `Karyawan` (One-to-Many).
2.  **Eloquent Joins**: Menampilkan data gabungan dari tabel `karyawans`, `gajis`, dan `departemens` menggunakan Eager Loading `with()`.
3.  **Advanced Filtering/Sorting**:
    *   **Search**: Mencari karyawan berdasarkan nama atau posisi.
    *   **Sorting**: Fitur pengurutan data berdasarkan nama atau posisi secara ascending/descending.
    *   **Pagination**: Pembagian data menjadi beberapa halaman untuk performa lebih baik.
4.  **Premium Custom UI**: Menggunakan desain modern bertema "Midnight & Cyan" dengan efek glassmorphism, gradient text, dan micro-animations pada tombol.

## Database Schema Changes
- Tabel `departemens`: Menyimpan daftar departemen perusahaan.
- Kolom `departemen_id` pada tabel `karyawans`: Foreign key yang menghubungkan karyawan ke departemennya.

## Screenshots
<img width="1366" height="716" alt="image" src="https://github.com/user-attachments/assets/805443bd-1c1b-4abf-b317-0d311b490d1d" />


## How to Run
1. Clone repository.
2. Run `composer install`.
3. Set up `.env` (SQLite).
4. Run `php artisan migrate`.
5. Run `php artisan tinker seed_departemen.php` (Jika tersedia script seeder).
6. Run `php artisan serve`.
