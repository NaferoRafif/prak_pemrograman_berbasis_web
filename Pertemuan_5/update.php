<?php
require_once __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id || $id <= 0) {
    set_flash('error', 'ID buku tidak valid.');
    header('Location: index.php', true, 303);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: edit.php?id=' . $id, true, 303);
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
            'UPDATE buku SET kode = ?, judul = ?, penulis = ?, kategori = ?, tahun = ?, stok = ? WHERE id = ?'
        );
        $tahunInt = (int) $data['tahun'];
        $stokInt  = (int) $data['stok'];

        $stmt->bind_param(
            'ssssiii',
            $data['kode'],
            $data['judul'],
            $data['penulis'],
            $data['kategori'],
            $tahunInt,
            $stokInt,
            $id
        );
        $stmt->execute();

        set_flash('success', 'Perubahan data buku berhasil disimpan.');
        header('Location: index.php', true, 303);
        exit;
    } catch (mysqli_sql_exception $error) {
        if ($error->getCode() === 1062) {
            $errors[] = 'Kode buku sudah digunakan oleh buku lain. Gunakan kode berbeda.';
        } else {
            throw $error;
        }
    }
}

http_response_code(422);
require __DIR__ . '/edit.php';