# Media Pembelajaran Interaktif Berbasis Gamifikasi

## Deskripsi
Media Pembelajaran Interaktif Berbasis Gamifikasi merupakan aplikasi berbasis web yang dikembangkan sebagai produk skripsi untuk mendukung proses pembelajaran pada mata pelajaran Informatika, khususnya materi **Algoritma dan Pemrograman**. Media ini dirancang agar pembelajaran menjadi lebih menarik, interaktif, dan mampu meningkatkan motivasi belajar siswa melalui penerapan konsep gamifikasi.

## Informasi Penelitian

**Judul Skripsi:**

> Pengembangan Media Pembelajaran Interaktif Berbasis Gamifikasi pada Materi Algoritma dan Pemrograman Mata Pelajaran Informatika

**Pengembang:**
Wahyu Mulia Maharani
220631100096

**Program Studi:**
S1 Pendidikan Informatika

**Universitas:**
Universitas Trunodjoyo Madura

---

## Fitur Utama

### Guru
- Login guru
- Dashboard guru
- Manajemen kelas
- Manajemen materi pembelajaran
- Manajemen video pembelajaran
- Manajemen evaluasi
- Manajemen soal
- Melihat hasil evaluasi siswa
- Monitoring perkembangan belajar siswa

### Siswa
- Login siswa
- Dashboard siswa
- Membaca materi pembelajaran
- Menonton video pembelajaran
- Mengerjakan evaluasi
- Melihat hasil evaluasi
- Melihat progres pembelajaran

---

## Teknologi yang Digunakan

- Laravel 10
- PHP 8.x
- MySQL
- Bootstrap 5
- JavaScript
- HTML5
- CSS3

---

## Cara Menjalankan Project

### 1. Clone Repository

```bash
git clone <repository-url>
```

### 2. Masuk ke Folder Project

```bash
cd Alpro
```

### 3. Install Dependency

```bash
composer install
```

```bash
npm install
```

### 4. Salin File Environment

```bash
cp .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Konfigurasi Database

Sesuaikan konfigurasi database pada file `.env`.

### 7. Jalankan Migrasi

```bash
php artisan migrate
```

### 8. Jalankan Server

```bash
php artisan serve
```

Kemudian buka browser pada alamat:

```
http://127.0.0.1:8000
```

---

## Struktur Folder

```
Alpro/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
├── artisan
├── composer.json
└── README.md
```

---

## Tujuan Pengembangan

Media pembelajaran ini dikembangkan untuk:

- Meningkatkan motivasi belajar siswa.
- Membantu guru dalam menyampaikan materi Algoritma dan Pemrograman.
- Menyediakan media pembelajaran yang interaktif dan mudah diakses.
- Mengintegrasikan unsur gamifikasi dalam proses pembelajaran.

---

## Lisensi

Produk ini dikembangkan sebagai bagian dari penelitian skripsi pada Program Studi S1 Pendidikan Informatika Universitas Trunojoyo Madura dan digunakan untuk kepentingan akademik.
