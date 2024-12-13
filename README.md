# CI4 - E-Commerce (BukuKu)

## Deskripsi

BukuKu adalah sebuah aplikasi e-commerce buku yang dibangun menggunakan CodeIgniter 4.5.5 dan Bootstrap 5.

## Kebutuhan Sistem untuk CodeIgniter 4

- Minimal menggunakan PHP 8.1
- XAMPP atau Laragon (yang sudah terinstall MySQL)
- Composer

## Langkah Instalasi

Download file Zip repository ini dan ekstrak file source code, buka di VSCode, lalu buka terminal dan jalankan:

```bash
composer install
```

Copy file `.env-example` dan rename ke `.env`, lalu sesuaikan dengan konfigurasi database yang telah dibuat. Buat database bernama `bukuku`, lalu jalankan:

```bash
php spark migrate
```

Untuk menambahkan data dummy, jalankan:

```bash
php spark db:seed Users
php spark db:seed Categories
php spark db:seed Products
php spark db:seed Orders
php spark db:seed OrderDetails
```

Jalankan aplikasi dengan perintah:

```bash
php spark serve
```
