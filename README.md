## Sistem Manajemen Kategori Buku

## Biodata
Nama: Nabila Tsurayya Ahmad
NIM: 60324045
Kelas: Pemrograman WEB 2 (B)

Project ini dibuat untuk memenuhi tugas UTS Praktikum Pemrograman Web 2 yang diampu oleh Bapak Reza Maulana M.Kom.

Aplikasi ini digunakan untuk mengelola data kategori buku dengan fitur CRUD (Create, Read, Update, Delete) menggunakan PHP dan MySQL.

## Struktur Folder
```text
uts_60324045/
├── config/
│   └── database.php
├── index.php
├── create.php
├── edit.php
└── delete.php

```
## Tahapan Pengerjaan

1. Setup Database
- Membuat database dengan nama: `uts_perpustakaan_60324045`
- Membuat tabel `kategori` sesuai struktur soal
- Menambahkan beberapa sample data

2. Koneksi Database
- Membuat file `config/database.php`
- Menggunakan `mysqli` untuk koneksi
- Menambahkan fungsi helper untuk keamanan input

3. READ (Menampilkan Data)
- File: `index.php`
- Mengambil data dari database menggunakan prepared statement
- Menampilkan data dalam bentuk tabel Bootstrap
- Status ditampilkan dengan badge: Untuk Aktif, digambarkan dengar warna hijau. Jika Nonaktif, digambarkan dengan warna merah

4. CREATE (Tambah Data)
- File: `create.php`
- Form input kategori
- Validasi:
    1. Kode harus format `KAT-XXX`
    2. Nama minimal 3 karakter
    3. Tidak boleh duplikat
    4. Data disimpan menggunakan prepared statement

5. UPDATE (Edit Data)
- File: `edit.php`
- Data diambil berdasarkan `id_kategori`
- Form otomatis terisi (pre-filled)
- Validasi sama seperti CREATE
- Cek duplikasi dengan mengecualikan data yang sedang diedit

6. DELETE (Hapus Data)
- File: `delete.php`
- Menghapus data berdasarkan `id_kategori`
- Menggunakan prepared statement
- Menampilkan pesan sukses atau error setelah proses

Cara Menjalankan Project
1. Jalankan XAMPP (Apache & MySQL)
2. Import database ke phpMyAdmin
3. Simpan project di folder `htdocs`
4. Buka browser:   http://localhost/uts_60324045/index.php

Teknologi Saya yang Digunakan
1. PHP (Native)
2. MySQL
3. Bootstrap 5
