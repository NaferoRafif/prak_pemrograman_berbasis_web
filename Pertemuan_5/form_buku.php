<?php
// Pastikan variabel $data, $errors, $actionUrl, $submitLabel, dan $token sudah disiapkan sebelum include file ini
$tahunSekarang = (int) date('Y');
?>

<?php if (!empty($errors)): ?>
    <div class="alert alert-error">
        <strong>Data belum dapat disimpan:</strong>
        <ul>
            <?php foreach ($errors as $err): ?>
                <li><?= e($err) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="<?= e($actionUrl) ?>">
    <input type="hidden" name="csrf_token" value="<?= e($token) ?>">

    <div class="form-group">
        <label for="kode">Kode Buku</label>
        <input type="text" id="kode" name="kode" value="<?= e($data['kode'] ?? '') ?>" placeholder="Contoh: LIB-006" required>
    </div>

    <div class="form-group">
        <label for="judul">Judul Buku</label>
        <input type="text" id="judul" name="judul" value="<?= e($data['judul'] ?? '') ?>" placeholder="Masukkan judul lengkap buku" required>
    </div>

    <div class="form-group">
        <label for="penulis">Penulis</label>
        <input type="text" id="penulis" name="penulis" value="<?= e($data['penulis'] ?? '') ?>" placeholder="Nama pengarang buku" required>
    </div>

    <div class="form-group">
        <label for="kategori">Kategori</label>
        <select id="kategori" name="kategori" required>
            <option value="">-- Pilih Kategori --</option>
            <?php foreach (daftar_kategori() as $kat): ?>
                <option value="<?= e($kat) ?>" <?= ($data['kategori'] ?? '') === $kat ? 'selected' : '' ?>>
                    <?= e($kat) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="tahun">Tahun Terbit</label>
        <input type="number" id="tahun" name="tahun" min="1900" max="<?= $tahunSekarang ?>" value="<?= e((string) ($data['tahun'] ?? $tahunSekarang)) ?>" required>
    </div>

    <div class="form-group">
        <label for="stok">Jumlah Stok</label>
        <input type="number" id="stok" name="stok" min="0" max="999" value="<?= e((string) ($data['stok'] ?? '1')) ?>" required>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><?= e($submitLabel) ?></button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </div>
</form>