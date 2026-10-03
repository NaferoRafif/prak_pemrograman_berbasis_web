<?php
// identitas.php - Versi Modifikasi OOP
interface Identitas
{
    public function ringkasan(): string;
}

class Mahasiswa implements Identitas
{
    private string $nim;
    private string $nama;
    private string $prodi;
    private int $semester;
    protected float $ipk;

    public function __construct(string $nim, string $nama, string $prodi, int $semester, float $ipk)
    {
        $this->nim = $nim;
        $this->nama = $nama;
        $this->prodi = $prodi;
        $this->semester = $semester;
        $this->setIpk($ipk);
    }

    public function setIpk(float $ipk): void
    {
        if ($ipk < 0 || $ipk > 4.00) {
            throw new InvalidArgumentException('Nilai IPK tidak valid! Harus berada dalam rentang 0.00 hingga 4.00.');
        }
        $this->ipk = $ipk;
    }

    public function getIpk(): float
    {
        return $this->ipk;
    }

    public function getNim(): string { return $this->nim; }
    public function getNama(): string { return $this->nama; }
    public function getProdi(): string { return $this->prodi; }
    public function getSemester(): int { return $this->semester; }

    public function getStatusKelulusan(): string
    {
        if ($this->ipk >= 3.75) return 'With Honors (Cumlaude)';
        if ($this->ipk >= 3.50) return 'Sangat Memuaskan';
        if ($this->ipk >= 3.00) return 'Memuaskan';
        return 'Perlu Peningkatan';
    }

    public function ringkasan(): string
    {
        return "[$this->nim] $this->nama ($this->prodi - Sem $this->semester) | IPK: $this->ipk";
    }
}

// Inisialisasi Objek dengan Try-Catch Handling
$errorMsg = '';
$mhs = null;

try {
    $mhs = new Mahasiswa('4524210074', 'Nafero Rafif Alhakim', 'Teknik Informatika', 4, 3.85);
} catch (InvalidArgumentException $e) {
    $errorMsg = $e->getMessage();
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Identitas Mahasiswa (OOP)</title>
    <style>
        * { box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #0f172a; color: #f8fafc; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; padding: 20px; }
        .card { background-color: #1e293b; border-radius: 16px; padding: 32px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); width: 100%; max-width: 500px; border: 1px solid #334155; }
        h1 { color: #38bdf8; font-size: 22px; text-align: center; margin-bottom: 24px; border-bottom: 2px solid #334155; padding-bottom: 12px; }
        .detail-item { display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #334155; font-size: 15px; }
        .detail-item:last-child { border-bottom: none; }
        .label { color: #94a3b8; font-weight: 600; }
        .value { color: #f8fafc; font-weight: 500; }
        .badge-status { margin-top: 20px; background-color: #065f46; color: #34d399; border: 1px solid #059669; padding: 12px; border-radius: 10px; text-align: center; font-weight: bold; }
        .alert-danger { background-color: #7f1d1d; color: #fca5a5; border: 1px solid #991b1b; padding: 16px; border-radius: 10px; text-align: center; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Identitas Mahasiswa</h1>

        <?php if ($errorMsg): ?>
            <div class="alert-danger"><?= htmlspecialchars($errorMsg) ?></div>
        <?php elseif ($mhs): ?>
            <div class="detail-item">
                <span class="label">NPM</span>
                <span class="value"><?= htmlspecialchars($mhs->getNim()) ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Nama Lengkap</span>
                <span class="value"><?= htmlspecialchars($mhs->getNama()) ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Program Studi</span>
                <span class="value"><?= htmlspecialchars($mhs->getProdi()) ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Semester</span>
                <span class="value"><?= htmlspecialchars((string)$mhs->getSemester()) ?></span>
            </div>
            <div class="detail-item">
                <span class="label">IPK</span>
                <span class="value"><?= htmlspecialchars(number_format($mhs->getIpk(), 2)) ?></span>
            </div>

            <div class="badge-status">
                Predikat: <?= htmlspecialchars($mhs->getStatusKelulusan()) ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>