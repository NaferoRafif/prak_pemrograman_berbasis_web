<?php
// biodata.php - Versi Modifikasi
function statusKelulusan(float $ipk): string
{
    // Modifikasi 1: Logik & Syarat Baru (Predikat Cumlaude & Cemerlang)
    if ($ipk >= 3.75) return 'With Honors (Cumlaude)';
    if ($ipk >= 3.50) return 'Sangat Memuaskan';
    if ($ipk >= 3.00) return 'Memuaskan';
    return 'Perlu Peningkatan';
}

// Modifikasi 2: Penambahan Medan Baru (Email & No. Telefon)
$mahasiswa = [
    'nim' => '4524210074',
    'nama' => 'Nafero Rafif Alhakim',
    'prodi' => 'Teknik Informatika',
    'semester' => 1,
    'ipk' => 3.72,
    'email' => 'nafero.rafif@mhs.ac.id',
    'no_hp' => '081234567890'
];
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Mahasiswa Modern</title>
    <!-- Modifikasi 3: Rekaan Antaramuka (UI) Dark Mode Modern -->
    <style>
        * { box-sizing: border-box; font-family: 'Segoe UI', Tahoma, sans-serif; }
        body { background-color: #0f172a; color: #f8fafc; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; padding: 20px; }
        .card { background-color: #1e293b; border-radius: 16px; padding: 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); width: 100%; max-width: 480px; border: 1px solid #334155; }
        h1 { color: #38bdf8; font-size: 24px; text-align: center; margin-bottom: 24px; border-bottom: 2px solid #334155; padding-bottom: 12px; }
        .info-list { display: flex; flex-direction: column; gap: 12px; margin-bottom: 24px; }
        .info-item { display: flex; justify-content: space-between; background-color: #0f172a; padding: 12px 16px; border-radius: 8px; border: 1px solid #1e293b; }
        .info-label { color: #94a3b8; font-weight: 600; text-transform: uppercase; font-size: 13px; }
        .info-value { color: #f8fafc; font-weight: 500; }
        .badge { background-color: #065f46; color: #34d399; border: 1px solid #059669; padding: 14px; border-radius: 10px; text-align: center; font-weight: bold; font-size: 16px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Biodata Mahasiswa</h1>
        <div class="info-list">
            <?php foreach ($mahasiswa as $kunci => $nilai): ?>
                <div class="info-item">
                    <span class="info-label"><?= htmlspecialchars(str_replace('_', ' ', ucfirst($kunci))) ?></span>
                    <span class="info-value"><?= htmlspecialchars((string)$nilai) ?></span>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="badge">
            Predikat: <?= htmlspecialchars(statusKelulusan($mahasiswa['ipk'])) ?>
        </div>
    </div>
</body>
</html>