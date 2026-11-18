<?php
require_once __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: create.php', true, 303);
    exit;
}

if (!verifikasi_csrf($_POST['csrf_token'] ?? null)) {
    http_response_code(403);
    exit('Token keamanan sesi tidak valid. Silakan muat ulang halaman.');
}

[$data, $errors] = validasi_buku($_POST);

if (empty($errors)) {
    try {
        $stmt = $koneksi->prepare(
            'INSERT INTO buku (kode, judul, penulis, kategori, tahun, stok) VALUES (?, ?, ?, ?, ?, ?)'
        );
        $tahunInt = (int) $data['tahun'];
        $stokInt  = (int) $data['stok'];

        $stmt->bind_param(
            'ssssii',
            $data['kode'],
            $data['judul'],
            $data['penulis'],
            $data['kategori'],
            $tahunInt,
            $stokInt
        );
        $stmt->execute();

        set_flash('success', 'Buku berhasil ditambahkan.');
        header('Location: index.php', true, 303);
        exit;
    } catch (mysqli_sql_exception $error) {
        if ($error->getCode() === 1062) {
            $errors[] = 'Kode buku sudah digunakan. Gunakan kode lain.';
        } else {
            throw $error;
        }
    }
}

http_response_code(422);
require __DIR__ . '/create.php';