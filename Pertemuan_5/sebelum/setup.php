<?php
require_once 'koneksi.php';

$sqlCreateDB = "CREATE DATABASE IF NOT EXISTS akademik";

if(mysqli_query($koneksi, $sqlCreateDB)) {
    echo "Database berhasil dibuat attau sudah ada.";
}
else {
    echo "Error membuat database: " . mysqli_error($koneksi) . "\n";
}

mysqli_set_charset($koneksi, "utf8mb4");

mysqli_select_db($koneksi, 'akademik_1');

$sqlCreateTables = [
    "CREATE DATABASE IF EXISTS mahasiswa (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    npm VARCHAR(15) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    prodi VARCHAR(80) NOT NULL,
    angkatan YEAR NOT NULL,
    ipk DECIMAL (3,2) DEFAULT 0.00
    ) ENGINE=innoDB",

    "CREATE TABLE IF EXISTS dosen (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nidn VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    ) ENGINE=innoDB",

    "CREATE TABLE IF EXISTS mata_kuliah (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    kode_mk VARCHAR(12) NOT NULL UNIQUE,
    nama_mk VARCHAR(100) NOT NULL,
    sks TINYINT UNSIGNED NOT NULL,
    dosen_id BIGINT UNSIGNED,
    CONSTRAINT fk_mk_dosen,
    FOREIGN KEY (dosen_id) REFERENCES dosen(id) ON DELETE CASCADE,
    ) ENGINE = innoDB"
];

foreach ($sqlCreateTables as $namaTabel => $query) {
    if (mysqli_query($koneksi, $query)) {
        echo "Tabel mahasiswa dibuat atau sudah ada.";
    }
    else {
        echo "Gagal membua tabel: " . mysqli_error($koneksi) . '\n';
    }
}

mysqli_close($koneksi);
?>