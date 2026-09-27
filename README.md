TUGAS 1 
Contoh 1: 
Screenshot sebelom: 
  <img width="707" height="460" alt="image" src="https://github.com/user-attachments/assets/7b60f703-701b-460d-9917-3f339fb5b110" />

Screenshot sesudah: 
  <img width="679" height="733" alt="image" src="https://github.com/user-attachments/assets/3655cba5-9e3a-45fb-b823-afe672315f59" />

 
 
Output sesudah: 
  <img width="594" height="334" alt="image" src="https://github.com/user-attachments/assets/c492c4ce-960e-48a2-ace4-c3df25a1c293" />

1. MODIFIKASI YANG DILAKUKAN 
-	Modifikasi 1 (Penambahan Operator Aritmatika Baru): 
     Menambahkan fitur kalkulasi untuk Modulo / Sisa Bagi (%) dan Pangkat (^). 
-	Modifikasi 2 (Validasi Input Tambahan): 
     Menambahkan validasi kondisi khusus saat pengisian angka nol pada operasi Modulo. 
-	Modifikasi 3 (Pengembangan Interface & User Experience): 
     Menambahkan CSS Modern (Dark Mode, Card Container, Responsive Form, serta Alert Box bermotif warna untuk status error/sukses). 
2. PENJELASAN 5 BAGIAN KODE PALING PENTING 
a.	if ($_SERVER['REQUEST_METHOD'] === 'POST') 
      Memastikan skrip PHP hanya mengeksekusi perhitungan matematika ketika form dikirim menggunakan metode HTTP POST, sehingga mencegah terjadinya error saat halaman pertama kali diakses. 
b.	(float) ($_POST['a'] ?? 0) 
      Mengambil data input nama 'a' dari form lalu melakukan typecasting secara eksplisit ke tipe bilangan float (desimal). Operator Null Coalescing (??) digunakan untuk memberikan nilai default 0 jika form belum diisi. 
c.	switch ($operator) 
      Struktur kontrol logika yang mengevaluasi simbol operator yang dipilih pengguna dari dropdown menu untuk menentukan eksekusi rumus matematika yang sesuai.    d. if ($b == 0) 
      Blok validasi untuk mengecek kondisi angka kedua. Jika nilai $b adalah 0 pada operasi pembagian (/) atau modulo (%), program akan mencegat proses dan memberikan pesan error, bukan crash. 
   e. htmlspecialchars(...) 
      Fungsi keamanan (output escaping) yang mengubah karakter khusus menjadi entitas HTML aman sebelum dicetak ke layar, guna mencegah serangan Cross-Site Scripting (XSS). 
3. ERROR YANG PERNAH MUNCUL, PENYEBAB, DAN LANGKAH PERBAIKANNYA 
-	Error yang Muncul: 
     Fatal error: Uncaught DivisionByZeroError: Division by zero in kalkulator.php on line 21 
-	Penyebab: 
     Pengguna memasukkan angka 0 pada input angka kedua ($b) lalu memilih operator Pembagian (/) atau Modulo (%). Secara matematis dan dalam runtime PHP, pembagian dengan angka nol tidak terdefinisi sehingga menyebabkan Fatal Error. 
-	Langkah Perbaikan: 
     Menambahkan pengecekan kondisi sebelum operasi aritmatika dieksekusi: 
     if ($b == 0) { 
         $pesan = 'Error: Pembagian/Modulo dengan nol tidak diperbolehkan.'; 
     } else { 
         $hasil = $a / $b; 
     } 
     Dengan penanganan ini, sistem dapat menampilkan pesan peringatan ramah pengguna tanpa menghentikan jalannya seluruh program PHP. 
Contoh 2 
Screenshot sebelum: 
  
 <img width="769" height="380" alt="image" src="https://github.com/user-attachments/assets/31c32962-5800-43e4-8f80-16bc5ec1c27e" />

 
 
 
 
Screenshot sesudah: 
  <img width="770" height="668" alt="image" src="https://github.com/user-attachments/assets/dc98afb9-6cc7-4f0a-b38e-4836073adc66" />

Output sesudah: 
  <img width="745" height="416" alt="image" src="https://github.com/user-attachments/assets/a3076152-92c6-4dec-8320-6e880ef1cfc3" />

1. MODIFIKASI YANG DILAKUKAN 
-	Modifikasi 1 (Kondisi dan Nilai Return Baru pada Fungsi): 
     Menambahkan batas kelayakan predikat kelulusan baru pada fungsi statusKelulusan(), yaitu syarat 'With Honors (Cumlaude)' bagi nilai IPK >= 3.75. 
-	Modifikasi 2 (Penambahan Field/Data Baru pada Array Associative): 
     Menambahkan dua field informasi baru dalam array $mahasiswa yaitu 'email' dan 'no_hp', serta memperbarui data identitas utama. 
-	Modifikasi 3 (Pengembangan Interface & Styling UI): 
     Mengubah tampilan daftar elemen HTML <ul> dan <li> menjadi bentuk kartu profil bernuansa Dark Mode dengan styling CSS modern. 
2. PENJELASAN 5 BAGIAN KODE PALING PENTING 
a.	function statusKelulusan(float $ipk): string 
      Mendefinisikan fungsi kustom dengan parameter bertipe tegas float ($ipk) dan menetapkan tipe kembalian data berupa string. 
b.	$mahasiswa = ['nim' => '4524210074', 'nama' => 'Nafero Rafif Alhakim', ...] 
      Penggunaan struktur data Array Associative untuk menyimpan elemen informasi profil mahasiswa dalam bentuk pasangan kunci (key) dan nilai (value). 
c.	foreach ($mahasiswa as $kunci => $nilai) 
      Struktur perulangan (looping) untuk melintasi seluruh elemen array asosiatif secara otomatis tanpa perlu memanggil kuncinya satu per satu. 
d.	ucfirst($kunci) / str_replace('_', ' ', ...) 
      Fungsi pemrosesan string bawaan PHP untuk mengubah huruf pertama kunci menjadi huruf besar dan mengganti karakter underscore dengan spasi agar tampilan label terlihat rapi.    e. htmlspecialchars((string)$nilai) 
      Mekanisme pengamanan utama untuk mengonversi karakter khusus HTML menjadi entitas aman guna mencegah serangan Cross-Site Scripting (XSS). 
3. ERROR YANG PERNAH MUNCUL, PENYEBAB, DAN LANGKAH PERBAIKANNYA 
-	Error yang Muncul: 
     TypeError: statusKelulusan(): Argument #1 ($ipk) must be of type float, string given 
-	Penyebab: 
     Sistem menerima tipe data string (seperti "3.72") pada pemanggilan fungsi statusKelulusan(), sedangkan parameter fungsi telah didefinisikan secara ketat untuk hanya menerima tipe float (float $ipk). 
-	Langkah Perbaikan: 
     Melakukan konversi tipe data (typecasting) secara eksplisit saat pemanggilan fungsi atau pada array asal: 
     $ipkClean = (float) $mahasiswa['ipk'];      echo statusKelulusan($ipkClean); 
     Dengan memastikan variabel diubah menjadi tipe float terlebih dahulu, fungsi dapat mengeksekusi perbandingan matematis tanpa memicu TypeError.




  TUGAS 2
Contoh 1:
Screenshot sebelom:
 <img width="690" height="356" alt="image" src="https://github.com/user-attachments/assets/00e0f3d5-0788-4977-88f8-54e9305e93fc" />

Screenshot sesudah:
 
<img width="514" height="836" alt="image" src="https://github.com/user-attachments/assets/0207a3b0-8e1d-4eb8-8048-9b43be664f96" />



Output sesudah:
 <img width="664" height="372" alt="image" src="https://github.com/user-attachments/assets/38f95f55-b1ff-4e40-84c0-f4e4130c1376" />

1. MODIFIKASI YANG DILAKUKAN
   - Modifikasi 1 (Penambahan Property & Method Baru pada Class):
     Menambahkan atribut privat $prodi dan $semester serta method getter-nya. Menambahkan method getStatusKelulusan() untuk menghitung kualifikasi akademik secara otomatis.
   - Modifikasi 2 (Penerapan Error Handling Try-Catch):
     Menambahkan penanganan eksepsi (Exception Handling) menggunakan blok try-catch untuk menangkap pemicu error dari throw new InvalidArgumentException ketika IPK berada di luar rentang validasi (0 - 4.00).
   - Modifikasi 3 (Interface UI Modern):
     Mengubah output string sederhana menjadi tampilan UI bertema Dark Mode dengan susunan komponen profil berbasis struktur CSS Card modern.
2. PENJELASAN 5 BAGIAN KODE PALING PENTING
   a. interface Identitas { public function ringkasan(): string; }
      Kontrak pemrograman OOP (Interface) yang mewajibkan seluruh class turunan yang mengimplementasikannya untuk menyediakan definisi method ringkasan().
   b. class Mahasiswa implements Identitas
      Pendefinisian class konkrit yang mengimplementasikan interface Identitas serta menerapkan prinsip Encapsulation dengan modifier private pada properti data.
   c. public function setIpk(float $ipk): void
      Method mutator (setter) yang berfungsi memvalidasi batas kelayakan nilai IPK sebelum disimpan ke dalam property $ipk, guna menjaga integritas data.
   d. throw new InvalidArgumentException(...)
      Mekanisme pelemparan eksepsi (Exception) secara eksplisit untuk menghentikan alur program secara aman jika data parameter yang diberikan tidak memenuhi kriteria logika.
   e. try { ... } catch (InvalidArgumentException $e) { ... }
      Blok pengontrol kesalahan yang bertugas menangkap error eksepsi dan mengarahkannya ke variabel pesan error tanpa membuat program PHP mengalami crash.
3. ERROR YANG PERNAH MUNCUL, PENYEBAB, DAN LANGKAH PERBAIKANNYA
   - Error yang Muncul:
     Uncaught InvalidArgumentException: IPK harus 0 sampai 4. in identitas.php on line 24
   - Penyebab:
     Sistem mencoba memasukkan nilai IPK di luar batas (misalnya 4.5 atau -1.0) pada saat instansiasi objek new Mahasiswa(). Karena dipanggil tanpa pengaman, exception yang di-throw oleh setIpk() tidak tertangkap dan menghentikan seluruh eksekusi program.
   - Langkah Perbaikan:
     Membungkus proses instansiasi objek dalam blok try-catch:
     try {
         $mhs = new Mahasiswa('4524210074', 'Nafero Rafif Alhakim', 'TI', 4, 4.5);
     } catch (InvalidArgumentException $e) {
         echo "Gagal membuat objek: " . $e->getMessage();
     }
     Dengan begitu, error dapat ditangani secara fleksibel dan pesan kesalahan dapat ditampilkan dengan rapi di antarmuka pengguna.

Contoh 2
Screenshot sebelum:
 <img width="689" height="341" alt="image" src="https://github.com/user-attachments/assets/590aa446-db22-4694-a610-1636b2622924" />




Screenshot sesudah:
 <img width="613" height="854" alt="image" src="https://github.com/user-attachments/assets/9d202b17-f5ee-4cad-a8fe-2eb2ec9dbbd3" />

Output sesudah:
 

<img width="654" height="367" alt="image" src="https://github.com/user-attachments/assets/6ba7b7ee-7347-42cf-8d2e-17cbb87c89db" />



1. MODIFIKASI YANG DILAKUKAN
   - Modifikasi 1 (Penambahan Subclass Baru ProdukPajak):
     Membuat class turunan baru bernama ProdukPajak yang melakukan override pada method hargaAkhir() untuk menambahkan perhitungan PPN (Pajak Pertambahan Nilai) sebesar 11%.
   - Modifikasi 2 (Implementasi Polymorphism & Akumulasi Total):
     Menambahkan item pada array $daftar serta menghitung kalkulasi akumulasi total bayar dari seluruh objek produk yang berbeda tipe (Polymorphism).
   - Modifikasi 3 (Pengembangan Interface Visual):
     Mendesain ulang tampilan daftar produk menjadi tabel ringkasan transaksi berbasis CSS Card Dark Mode dengan detail status harga.
2. PENJELASAN 5 BAGIAN KODE PALING PENTING
   a. interface BisaDihitung { public function hargaAkhir(): float; }
      Interface yang berfungsi sebagai kontrak wajib agar setiap class produk memiliki implementasi method hargaAkhir() dengan nilai kembalian float.
   b. class ProdukDiskon extends Produk
      Penerapan konsep Pewarisan (Inheritance), di mana class ProdukDiskon mewarisi properti $nama dan $harga dari parent class Produk.
   c. parent::__construct($nama, $harga);
      Sintaks untuk memanggil constructor milik parent class (Produk) agar inisialisasi atribut dasar $nama dan $harga dapat ditangani oleh class induk.
   d. public function hargaAkhir(): float
      Penerapan Polimorfisme (Method Overriding), di mana class turunan mengubah cara kerja perhitungan hargaAkhir() sesuai karakteristik masing-masing (misal: dikurangi diskon atau ditambah pajak).
   e. $produk instanceof ProdukDiskon
      Operator pengecekan tipe objek yang digunakan untuk mengevaluasi jenis class dari instansi produk tertentu secara dinamis saat perulangan.
3. ERROR YANG PERNAH MUNCUL, PENYEBAB, DAN LANGKAH PERBAIKANNYA
   - Error yang Muncul:
     Fatal error: Cannot override final method Produk::hargaAkhir() in produk.php on line 28
   - Penyebab:
     Error ini terjadi jika method hargaAkhir() pada parent class (Produk) diberi keyword 'final'. Keyword final mencegah class turunan (seperti ProdukDiskon) untuk melakukan Method Overriding.

   - Langkah Perbaikan:
     Menghapus kata kunci 'final' pada pendefinisian method hargaAkhir() di parent class Produk:
     // Sebelum (Salah):
     final public function hargaAkhir(): float { ... }
     // Sesudah (Benar):
     public function hargaAkhir(): float { ... }
     Dengan menghapus keyword final, class turunan seperti ProdukDiskon dan ProdukPajak dapat secara bebas mendefinisikan ulang rumus perhitungan harga akhirnya masing-masing.

