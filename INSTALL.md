# 🚀 Panduan Instalasi Trinova Digital

## Stack

- **Backend**: Laravel 12
- **Frontend**: Livewire 3 + Alpine.js (bawaan Livewire)
- **CSS**: Tailwind CSS v4
- **Build**: Vite
- **Database**: MySQL

---

## Prasyarat

Pastikan sudah terinstall:

- PHP 8.2+
- Composer
- Node.js 18+
- MySQL (via Laragon, XAMPP, atau standalone)

---

## Langkah Instalasi

### 1. Install PHP Dependencies

Buka terminal di folder `d:\Website\trinovadigital` dan jalankan:

```bash
composer install
```

### 2. Salin file `.env`

```bash
copy .env.example .env
```

### 3. Generate App Key

```bash
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env`, ubah bagian ini:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=trinova_digital
DB_USERNAME=root
DB_PASSWORD=          # kosong jika Laragon default
```

Kemudian buat database MySQL bernama `trinova_digital` melalui phpMyAdmin atau HeidiSQL.

### 5. Jalankan Migrations

```bash
php artisan migrate
```

### 6. Install Node Dependencies

```bash
npm install
```

### 7. Jalankan Dev Server

Buka **dua terminal** secara bersamaan, atau jalankan file helper `run_dev.bat`:

**Terminal 1** — Server Lokal Laravel (Port 8000):

```bash
php artisan serve
```

**Terminal 2** — Compiler Frontend Vite (Tailwind CSS + HMR):

```bash
npm run dev
```

---

## 🔗 Daftar URL Akses Halaman (Lokal)

- **Landing Page Utama**: [http://localhost:8000](http://localhost:8000)
- **Form Analisa Bisnis**: [http://localhost:8000/analisa-bisnis-gratis](http://localhost:8000/analisa-bisnis-gratis)
- **Dashboard Admin / CMS**: [http://localhost:8000/admin](http://localhost:8000/admin)
- **Halaman Daftar Program**: [http://localhost:8000/program](http://localhost:8000/program)
- **Halaman Daftar Blog**: [http://localhost:8000/blog](http://localhost:8000/blog)

### Login Admin
Email: [admin@trinovadigital.com]
Password: [admin123]

---

## Catatan Penting

- Isi nomor WhatsApp di `.env`: `WHATSAPP_NUMBER=628xxxxxxxxxx`
- Untuk production, jalankan `npm run build` terlebih dahulu
- Pastikan extension PHP aktif: `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`

---

> Setelah instalasi selesai, lanjutkan ke pengisian konten **Integrasikan fitur yang ada di modul Kelola Program dengan yang ada di landing page <http://127.0.0.1:8000/program/start>**
