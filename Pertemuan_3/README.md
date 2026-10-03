# Laporan Tugas Praktikum Individu - Pertemuan 3

## 1. Penjelasan Lima Bagian Kode Penting

Berikut adalah penjelasan lima bagian kode/query SQL utama yang digunakan dalam praktikum ini:

1. **`CREATE TABLE dosen`**: Digunakan untuk membuat struktur tabel dosen dengan kolom `nidn` sebagai Primary Key, serta kolom `nama` dan `email` untuk menyimpan data pengajar.
2. **`CREATE TABLE mata_kuliah`**: Digunakan untuk membuat struktur tabel mata kuliah yang berisi `kode_mk` (Primary Key), `nama_mk`, `sks`, serta `nidn` sebagai Foreign Key yang terhubung ke tabel dosen.
3. **`INSERT INTO dosen`**: Query penambahan data untuk mengisi record dosen baru ke dalam tabel `dosen` (menambahkan Dosen Sigil Rendang, M.T dengan NIDN 111 dan Budi Santoso, M.Si dengan NIDN 222).
4. **`INSERT INTO mata_kuliah`**: Query penambahan data ke dalam tabel `mata_kuliah` untuk memetakan mata kuliah (Pemrograman Berbasis Web dan Pemrograman Berbasis Objek) dengan dosen pengampunya berdasarkan `nidn`.
5. **`SELECT * FROM [nama_tabel]`**: Query dasar yang digunakan untuk menampilkan dan memverifikasi seluruh baris data yang telah berhasil diinput ke dalam tabel.

---

## 2. Tangkapan Layar (Documentation)

### Tabel Dosen
* **Sebelum (Before):**
  ![Dosen Before](./Screenshot/dosen%20(before).png)

* **Sesudah (After):**
  ![Dosen After](./Screenshot/dosen%20(after).png)

---

### Tabel Mata Kuliah
* **Sebelum (Before):**
  ![Mata Kuliah Before](./Screenshot/mata_kuliah%20(before).png)

* **Sesudah (After):**
  ![Mata Kuliah After](./Screenshot/mata_kuliah%20(after).png)
---

## 3. Penanganan Error (Troubleshooting)

* **Pesan Error yang Muncul**: 
  `ERROR 1146 (42S02): Table 'akademik_1.dosen' doesn't exist` atau `Unknown column 'nidn' in 'field list'`.
* **Penyebab**: 
  Terjadi kegagalan saat menjalankan query `INSERT INTO` karena tabel belum dibuat sebelumnya di dalam database `akademik_1`, atau terdapat kesalahan penulisan (*typo*) pada nama kolom/tabel.
* **Langkah Perbaikan**: 
  1. Memastikan database `akademik_1` sudah dipilih/aktif menggunakan perintah `USE akademik_1;`.
  2. Memeriksa ulang struktur tabel dengan mengeksekusi query `CREATE TABLE` terlebih dahulu untuk memastikan tabel dan nama kolom sudah sesuai sebelum memasukkan data.
