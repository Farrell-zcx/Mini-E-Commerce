# 🛒 BreeCommerce - Mini E-Commerce Pro

BreeCommerce adalah aplikasi e-commerce mini berbasis web yang dibangun menggunakan framework **CodeIgniter 4** dan database **MySQL**. Aplikasi ini dirancang agar ringan, responsif, dan mudah dipahami, dengan tampilan antarmuka yang bersih memanfaatkan **Bootstrap 5** dan **Bootstrap Icons**.

Aplikasi ini mencakup alur penuh transaksi e-commerce dasar mulai dari autentikasi pengguna, manajemen katalog produk, penambahan kategori dinamis via modal pop-up, sistem keranjang belanja berbasis session, hingga proses checkout yang secara otomatis memotong stok produk di database.

---

## Fitur Utama

Aplikasi ini dilengkapi dengan fitur-fitur penting berikut:

1. **Autentikasi Pengguna (Auth)**:
   - **Registrasi**: Pendaftaran akun baru dengan password terenkripsi aman menggunakan `password_hash()`.
   - **Login & Session**: Validasi akun menggunakan `password_verify()` dan penyimpanan detail sesi (`isLoggedIn`, `user_id`, `nama_lengkap`, `role`).
   - **Logout**: Pembersihan data session secara aman.

2. **Katalog Produk (Shop Catalog)**:
   - Menampilkan daftar produk dengan nama, kategori, deskripsi, gambar produk, harga yang terformat dalam rupiah (`Rp`), dan jumlah stok saat ini.
   - Pilihan operasi tambah produk baru, edit produk, serta hapus produk bagi pengelola.

3. **Manajemen Produk (CRUD)**:
   - **Tambah Produk**: Formulir lengkap dengan unggahan file gambar (JPG, JPEG, PNG) acak unik.
   - **Tambah Kategori Instan**: Tombol modal `➕ Kategori` yang menempel di sebelah dropdown kategori untuk menambah kategori baru secara dinamis tanpa berpindah halaman.
   - **Edit & Update**: Mengubah spesifikasi produk, harga, stok, dan mengganti foto produk (foto lama akan dihapus otomatis dari server agar hemat penyimpanan).
   - **Hapus Produk**: Menghapus produk dari database.

4. **Sistem Keranjang Belanja (Shopping Cart)**:
   - Ditangani di sisi server melalui Session.
   - Proteksi stok: Pengguna tidak dapat menambahkan item ke keranjang melebihi batas stok yang tersedia di database.
   - Halaman detail keranjang yang menampilkan rincian harga, jumlah item, subtotal per item, dan total belanjaan.

5. **Proses Checkout (CO)**:
   - Pengurangan stok produk secara otomatis di database MySQL setelah berhasil checkout.
   - Pembersihan otomatis isi keranjang belanja pada session setelah transaksi sukses.

---

## Tech Stack & Kebutuhan Sistem

- **Server Language**: PHP (Direkomendasikan PHP 8.1 / 8.2 / 8.3)
- **Framework**: CodeIgniter 4.x
- **Database**: MySQL / MariaDB (melalui driver `MySQLi`)
- **Frontend & Styling**: Bootstrap 5.3.0 & Bootstrap Icons 1.11.3
- **Development Tooling**: Laragon / XAMPP (Local Web Server)

---

## Struktur Database & Migrasi

Project ini menggunakan fitur **CodeIgniter Migrations** dan **Seeds** untuk menyiapkan struktur tabel serta data awal.

### 1. Daftar Tabel (Migrations)
*   **`users`** (`CreateUsersTable`): Menyimpan data akun pengguna (nama, email, password terhash, role, timestamps).
*   **`kategori`** (`CreateKategoriTable`): Menyimpan nama-nama kategori produk (timestamps).
*   **`produk`** (`CreateProdukTable`): Menyimpan data produk, relasi ke kategori via `kategori_id`, deskripsi, harga, stok, nama file foto, dan timestamps.

### 2. Data Awal (Seeds)
Terdapat file `ShopSeeder` yang otomatis mengisi 3 kategori awal serta 3 produk demo berkualitas tinggi untuk kebutuhan uji coba pertama kali.

---

## Panduan Instalasi & Pengaturan

Ikuti langkah-langkah di bawah ini untuk menjalankan project ini di komputer lokal Anda:

### Langkah 1: Kloning & Pindahkan Project
Letakkan folder project ini di direktori root server lokal Anda (misal `C:/laragon/www/mini-ecommerce` untuk Laragon, atau `C:/xampp/htdocs/mini-ecommerce` untuk XAMPP).

### Langkah 2: Konfigurasi File `.env`
1. Salin atau ubah nama file `env` bawaan CodeIgniter menjadi **`.env`** di root folder project.
2. Atur URL aplikasi dan detail koneksi database Anda:
   ```ini
   CI_ENVIRONMENT = development

   app.baseURL = 'http://localhost:8080/' # Sesuaikan dengan port server Anda

   database.default.DBDriver = MySQLi
   database.default.hostname = localhost
   database.default.database = mini_ecommerce_mysql
   database.default.username = root
   database.default.password = 
   database.default.port = 3306
   ```

### Langkah 3: Membuat Database & Jalankan Migrasi
1. Buat database baru di MySQL dengan nama **`mini_ecommerce_mysql`** (atau sesuaikan dengan nama di `.env` Anda).
2. Jalankan perintah migrasi di terminal root project untuk membuat tabel-tabel secara otomatis:
   ```bash
   php spark migrate
   ```
3. Isi data kategori dan produk demo dengan menjalankan seeder:
   ```bash
   php spark db:seed ShopSeeder
   ```

### Langkah 4: Jalankan Server Lokal
Anda bisa langsung mengakses project melalui domain Laragon (contoh: `http://mini-ecommerce.test/`) atau menggunakan perintah bawaan CodeIgniter:
```bash
php spark serve
```
Buka peramban (browser) dan akses alamat `http://localhost:8080`.

---

## Struktur Folder Utama

```text
mini-ecommerce/
├── app/
│   ├── Config/          # Berkas konfigurasi aplikasi (Routes, Database, dll)
│   ├── Controllers/     # Logika aplikasi (Auth.php, Shop.php, dll)
│   ├── Database/        # Migrasi tabel database dan Seeder data awal
│   ├── Models/          # Berkas Model interaksi database (UserModel, ProdukModel, dll)
│   └── Views/           # Halaman UI (shop_view, keranjang_view, login_view, dll)
├── public/
│   ├── uploads/         # Folder tempat penyimpanan gambar produk yang diunggah
│   ├── index.php        # Titik masuk utama aplikasi (Entry point)
│   └── favicon.ico
├── _ide_helper.php      # File bantuan agar IDE/VS Code tidak menampilkan error merah (Intelephense)
├── .env                 # Konfigurasi environment lokal (Database & App URL)
└── README.md            # Dokumentasi project
```

---

## Informasi Tambahan 

*   **Pencegahan Error Merah di VS Code**: Project ini menyertakan file **`_ide_helper.php`** di root direktori. File ini secara khusus bertindak sebagai deklarator bagi ekstensi seperti *PHP Intelephense* agar mengenali fungsi-fungsi helper CodeIgniter (`csrf_field()`, `esc()`, `session()`, `base_url()`) tanpa memicu tanda error merah di editor Anda.
*   **Folder Upload Gambar**: Semua file gambar produk yang diunggah akan otomatis masuk ke folder `public/uploads/`. Pastikan folder ini memiliki hak akses menulis (*write permission*) pada lingkungan produksi.
