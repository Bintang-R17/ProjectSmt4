# ProjectSmt4
# Campus Project Chapter 4

Sistem Informasi Klinik berbasis PHP Native yang dirancang untuk mengelola rekam medis, jadwal konsultasi, serta integrasi pengambilan keputusan hasil laboratorium menggunakan metode SPK (Sistem Pendukung Keputusan) dan LLM (Large Language Model).

---

## ✨ Fitur Utama

- **Login dan Dashboard Multiuser**

  - Role: Admin, Dokter, Petugas, Pasien
  - Setiap role memiliki tampilan dashboard berbeda.

- **Rekam Medis dan Riwayat Konsultasi**

  - Menyimpan diagnosa, keluhan, tindakan medis, dan resep.
  - Data dapat dicari berdasarkan pasien dan tanggal.

- **Sistem Pendukung Keputusan Hasil Lab**
  - Prediksi hasil pemeriksaan laboratorium menggunakan SPK.
  - Integrasi dengan LLM untuk memberikan solusi dan rekomendasi diet.

---

## 🧩 Struktur Folder

PROJECTSMT4/
├── assets/ # CSS, JS, ikon, gambar
├── autoload/ # Autoload model/controller
├── config/ # File konfigurasi (session, koneksi DB)
├── controller/ # Logika aplikasi (semua controller)
├── database/ # SQL file atau dokumentasi DB
├── model/ # Model data untuk tiap tabel
├── view/ # Tampilan halaman (HTML + PHP)
└── index.php # Routing utama

---

## 🚀 Cara Instalasi

### 🔧 Persiapan

1. Install **XAMPP**, **Laragon**, atau software sejenis.
2. Clone atau salin proyek ini ke folder `htdocs` (XAMPP) atau `www` (Laragon).

### 📂 Langkah Instalasi

1. **Import database:**

   - Buka `phpMyAdmin`.
   - Buat database baru (misalnya: `project_ch4`).
   - Import file `.sql` dari folder `database/`.

2. **Sesuaikan koneksi database:**

   - Buka `config/database.php`
   - Sesuaikan nama database, user, dan password:
     ```php
     private $host = "localhost";
     private $db_name = "project_ch4";
     private $username = "root";
     private $password = "";
     ```

3. **Jalankan aplikasi:**
   - Akses di browser:  
     `http://localhost/PROJECTSMT4/index.php`

---

## 🛠 Stack Teknologi

- **Backend:** PHP Native
- **Database:** MySQL
- **Frontend:** Bootstrap 5, CSS, JavaScript

---

## 🧠 Catatan Developer

- FE sementara masih statis
- Akses FE sementara memakai link lewat routes
- Fitur utama belum jadi
- Hanya manajemen users saja yang baru jadi ( atribut masih kurang )

---

## 📌 Penutup

Proyek ini merupakan bagian dari tugas akhir _Chapter 4_ Semester 4 Informatika.  
Tujuannya adalah membangun sistem informasi klinik modern dengan pendekatan integrasi kecerdasan buatan dalam pengambilan keputusan medis.

---
