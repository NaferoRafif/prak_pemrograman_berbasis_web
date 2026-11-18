<?php
require_once __DIR__ . '/../koneksi.php';

$result = $koneksi->query('SELECT kode, judul, penulis FROM buku ORDER BY id ASC');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Katalog Buku Perpustakaan - Sebelum Modifikasi</title>
    <style>
        body { font-family: system-ui, sans-serif; margin: 32px; color: #1e293b; }
        table { border-collapse: collapse; width: 100%; max-width: 720px; }
        th, td { border: 1px solid #cbd5e1; padding: 10px 14px; text-align: left; }
        th { background-color: #f1f5f9; }
    </style>
</head>
<body>
    <h2>Katalog Koleksi Buku (Versi Awal)</h2>
    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Judul</th>
                <th>Penulis</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['kode'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($row['judul'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($row['penulis'], ENT_QUOTES, 'UTF-8') ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>