<?php
require_once __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php', true, 303);
    exit;
}

if (!verifikasi_csrf($_POST['csrf_token'] ?? null)) {
    http_response_code(403);
    exit('Token keamanan sesi tidak valid.');
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id || $id <= 0) {
    set_flash('error', 'ID buku tidak valid.');
    header('Location: index.php', true, 303);
    exit;
}

$stmt = $koneksi->prepare('DELETE FROM buku WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    set_flash('success', 'Buku berhasil dihapus dari katalog.');
} else {
    set_flash('error', 'Buku tidak ditemukan atau sudah terhapus.');
}

header('Location: index.php', true, 303);
exit;