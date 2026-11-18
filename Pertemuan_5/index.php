<?php
require_once __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

$cari     = trim((string) ($_GET['cari'] ?? ''));
$kategori = trim((string) ($_GET['kategori'] ?? ''));
$status   = trim((string) ($_GET['status'] ?? ''));

// Query ringkasan seluruh koleksi
$ringkasanQuery = $koneksi->query('
    SELECT
        COUNT(*) AS total_judul,
        COALESCE(SUM(stok), 0) AS total_stok,
        COALESCE(SUM(CASE WHEN stok = 0 THEN 1 ELSE 0 END), 0) AS total_habis
    FROM buku
');
$ringkasan = $ringkasanQuery->fetch_assoc();

// Query pencarian & filter dengan prepared statement
$sql = "SELECT * FROM buku
        WHERE (judul LIKE ? OR kode LIKE ? OR penulis LIKE ?)
        AND (? = '' OR kategori = ?)
        AND (? = '' OR (? = 'tersedia' AND stok > 0) OR (? = 'habis' AND stok = 0))
        ORDER BY judul ASC, id ASC";

$stmt = $koneksi->prepare($sql);
$keywordLike = '%' . $cari . '%';
$stmt->bind_param(
    'ssssssss',
    $keywordLike,
    $keywordLike,
    $keywordLike,
    $kategori,
    $kategori,
    $status,
    $status,
    $status
);
$stmt->execute();
$hasil = $stmt->get_result();
$daftarBuku = $hasil->fetch_all(MYSQLI_ASSOC);

$flash = get_flash();
$token = csrf_token();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Koleksi Perpustakaan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="header-bar">
        <div>
            <h1>Katalog Koleksi Perpustakaan</h1>
            <p>Manajemen Inventaris Buku — Praktikum Pemrograman Berbasis Web</p>
        </div>
        <a href="create.php" class="btn btn-light">+ Tambah Buku Baru</a>
    </div>

    <?php if ($flash): ?>
        <div class="alert alert-<?= e($flash['tipe']) ?>">
            <?= e($flash['pesan']) ?>
        </div>
    <?php endif; ?>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Total Judul Buku</div>
            <div class="stat-value"><?= (int) $ringkasan['total_judul'] ?> Judul</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Eksemplar</div>
            <div class="stat-value"><?= (int) $ringkasan['total_stok'] ?> Eksemplar</div>
        </div>
        <div class="stat-card warning">
            <div class="stat-label">Judul Stok Habis</div>
            <div class="stat-value"><?= (int) $ringkasan['total_habis'] ?> Judul</div>
        </div>
    </div>

    <div class="card">
        <form method="GET" action="index.php" class="filter-form">
            <div class="form-group">
                <label for="cari">Cari Judul, Kode, atau Penulis</label>
                <input type="text" id="cari" name="cari" value="<?= e($cari) ?>" placeholder="Contoh: LIB-001, Laskar, Rinaldi...">
            </div>

            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select id="kategori" name="kategori">
                    <option value="">Semua kategori</option>
                    <?php foreach (daftar_kategori() as $kat): ?>
                        <option value="<?= e($kat) ?>" <?= $kategori === $kat ? 'selected' : '' ?>>
                            <?= e($kat) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="status">Ketersediaan</label>
                <select id="status" name="status">
                    <option value="">Semua status</option>
                    <option value="tersedia" <?= $status === 'tersedia' ? 'selected' : '' ?>>Tersedia</option>
                    <option value="habis" <?= $status === 'habis' ? 'selected' : '' ?>>Habis</option>
                </select>
            </div>

            <div style="display: flex; gap: 8px;">
                <button type="submit" class="btn btn-primary">Filter</button>
                <?php if ($cari !== '' || $kategori !== '' || $status !== ''): ?>
                    <a href="index.php" class="btn btn-secondary">Reset</a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="info-count">
            Menampilkan <strong><?= count($daftarBuku) ?></strong> judul buku
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($daftarBuku)): ?>
                        <tr>
                            <td colspan="8" style="text-align: center; color: #64748b; padding: 24px;">
                                Tidak ada data buku yang sesuai dengan filter pencarian.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($daftarBuku as $buku): ?>
                            <?php $tersedia = ((int) $buku['stok']) > 0; ?>
                            <tr>
                                <td><strong><?= e($buku['kode']) ?></strong></td>
                                <td><?= e($buku['judul']) ?></td>
                                <td><?= e($buku['penulis']) ?></td>
                                <td><span class="badge badge-category"><?= e($buku['kategori']) ?></span></td>
                                <td><?= (int) $buku['tahun'] ?></td>
                                <td><?= (int) $buku['stok'] ?></td>
                                <td>
                                    <?php if ($tersedia): ?>
                                        <span class="badge badge-available">Tersedia</span>
                                    <?php else: ?>
                                        <span class="badge badge-empty">Habis</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="actions">
                                        <a href="edit.php?id=<?= (int) $buku['id'] ?>" class="btn btn-warning">Edit</a>
                                        <form method="POST" action="delete.php" onsubmit="return confirm('Yakin ingin menghapus buku <?= e($buku['judul']) ?>?');">
                                            <input type="hidden" name="id" value="<?= (int) $buku['id'] ?>">
                                            <input type="hidden" name="csrf_token" value="<?= e($token) ?>">
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>