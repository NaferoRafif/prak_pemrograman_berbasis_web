<?php
require_once __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id || $id <= 0) {
    set_flash('error', 'ID buku tidak valid.');
    header('Location: index.php', true, 303);
    exit;
}

if (!isset($data)) {
    $stmt = $koneksi->prepare('SELECT * FROM buku WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $buku = $stmt->get_result()->fetch_assoc();

    if (!$buku) {
        set_flash('error', 'Data buku tidak ditemukan.');
        header('Location: index.php', true, 303);
        exit;
    }

    $data = $buku;
}

$errors      = $errors ?? [];
$actionUrl   = 'update.php?id=' . $id;
$submitLabel = 'Simpan Perubahan';
$token       = csrf_token();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku - Katalog Perpustakaan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="header-bar">
        <div>
            <h1>Edit Data Buku</h1>
            <p>Perbarui informasi koleksi buku yang dipilih</p>
        </div>
        <a href="index.php" class="btn btn-light">&larr; Kembali ke Katalog</a>
    </div>

    <div class="card form-card">
        <?php require __DIR__ . '/form_buku.php'; ?>
    </div>
</div>
</body>
</html>