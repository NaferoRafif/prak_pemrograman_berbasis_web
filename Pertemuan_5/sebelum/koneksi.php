<?php
$host = '127.0.0.1';
$user = 'root';
$password = ""; // isi jika menggunakan password
$port = 3306; // port default MySQL adalah 3306, sesuaikan dengan port MySQL Anda
$db = 'akademik_1'; // nama database yang ingin digunakan
$koneksi = mysqli_connect($host, $user, $password, $db, $port);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
echo "Koneksi ke server MySQL berhasil!\n";
?>