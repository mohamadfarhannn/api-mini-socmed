# Mini Social Media API - Laravel 11
# Dummy Project

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php)](https://www.php.net)
[![MySQL](https://img.shields.io/badge/MySQL-00758F?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com)

Ini adalah project latihan pertama saya dalam membangun **RESTful API** menggunakan **Laravel 11**. Project ini merupakan API media sosial sederhana yang mencakup fitur-fitur dasar seperti postingan, komentar, like, dan sistem pesan antar pengguna.

## 🚀 Fitur Utama

- **Authentication**: Menggunakan Laravel Sanctum (Token-based Auth).
- **Posts**: Create, Read, Update, Delete (CRUD) postingan.
- **Comments**: Memberikan komentar pada postingan.
- **Likes**: Menyukai postingan teman.
- **Messages**: Sistem kirim pesan sederhana.
- **API Versioning**: Menggunakan prefix `v1` untuk manajemen versi API yang lebih baik.

## 🛠️ Stack Teknologi

- **Framework:** Laravel 11
- **Bahasa:** PHP 8.2+
- **Database:** MySQL
- **Autentikasi:** Laravel Sanctum

## 📂 Struktur Endpoint (v1)

Semua endpoint diawali dengan `/api/v1`.

### Postingan (`/posts`)
- `GET /posts` - Mengambil semua postingan.
- `GET /posts/{id}` - Mengambil detail postingan berdasarkan ID.
- `POST /posts` - Membuat postingan baru.
- `PUT /posts/{id}` - Memperbarui postingan.
- `DELETE /posts/{id}` - Menghapus postingan.

### Komentar (`/comments`)
- `POST /comments` - Menambahkan komentar pada postingan.
- `DELETE /comments/{id}` - Menghapus komentar.

### Like (`/likes`)
- `POST /likes` - Menyukai postingan.
- `DELETE /likes/{id}` - Membatalkan like.

### Pesan (`/messages`)
- `POST /messages` - Mengirim pesan baru.
- `DELETE /messages/{id}` - Menghapus riwayat pesan.

## ⚙️ Instalasi

1. **Clone repository:**
   ```bash
   git clone https://github.com/mohamadfarhannn/apimini.git
   cd apimini
   ```

2. **Install dependensi:**
   ```bash
   composer install
   ```

3. **Duplikat file `.env.example` ke `.env`:**
   ```bash
   cp .env.example .env
   ```
   *Jangan lupa sesuaikan konfigurasi database di file `.env`.*

4. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

5. **Jalankan migrasi database:**
   ```bash
   php artisan migrate
   ```

6. **Jalankan server lokal:**
   ```bash
   php artisan serve
   ```

---
*Dibuat dengan ❤️ oleh [Mohamad Farhan](https://github.com/mohamadfarhannn)*
