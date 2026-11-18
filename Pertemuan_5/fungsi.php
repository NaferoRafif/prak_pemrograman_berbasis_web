<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function e(?string $nilai): string
{
    return htmlspecialchars((string) $nilai, ENT_QUOTES, 'UTF-8');
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verifikasi_csrf(?string $token): bool
{
    return is_string($token)
        && isset($_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $token);
}

function set_flash(string $tipe, string $pesan): void
{
    $_SESSION['flash'] = ['tipe' => $tipe, 'pesan' => $pesan];
}

function get_flash(): ?array
{
    if (!isset($_SESSION['flash'])) {
        return null;
    }
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $flash;
}

function daftar_kategori(): array
{
    return ['Teknologi', 'Novel', 'Pengembangan Diri', 'Sejarah', 'Pendidikan', 'Sains'];
}

function validasi_buku(array $input): array
{
    $data = [
        'kode'     => strtoupper(trim((string) ($input['kode'] ?? ''))),
        'judul'    => trim((string) ($input['judul'] ?? '')),
        'penulis'  => trim((string) ($input['penulis'] ?? '')),
        'kategori' => trim((string) ($input['kategori'] ?? '')),
        'tahun'    => trim((string) ($input['tahun'] ?? '')),
        'stok'     => trim((string) ($input['stok'] ?? '')),
    ];

    $errors = [];

    if ($data['kode'] === '') {
        $errors[] = 'Kode buku wajib diisi.';
    } elseif (!preg_match('/^[A-Z0-9-]{2,20}$/', $data['kode'])) {
        $errors[] = 'Kode buku hanya boleh huruf kapital, angka, atau tanda hubung (2–20 karakter).';
    }

    if ($data['judul'] === '') {
        $errors[] = 'Judul buku wajib diisi.';
    } elseif (mb_strlen($data['judul']) > 150) {
        $errors[] = 'Judul buku maksimal 150 karakter.';
    }

    if ($data['penulis'] === '') {
        $errors[] = 'Nama penulis wajib diisi.';
    } elseif (mb_strlen($data['penulis']) > 100) {
        $errors[] = 'Nama penulis maksimal 100 karakter.';
    }

    if (!in_array($data['kategori'], daftar_kategori(), true)) {
        $errors[] = 'Pilih kategori buku yang valid.';
    }

    $tahunSekarang = (int) date('Y');
    if (filter_var($data['tahun'], FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 1900, 'max_range' => $tahunSekarang],
    ]) === false) {
        $errors[] = "Tahun terbit harus bilangan bulat antara 1900 hingga {$tahunSekarang}.";
    }

    if (filter_var($data['stok'], FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 0, 'max_range' => 999],
    ]) === false) {
        $errors[] = 'Stok harus bilangan bulat 0–999.';
    }

    return [$data, $errors];
}