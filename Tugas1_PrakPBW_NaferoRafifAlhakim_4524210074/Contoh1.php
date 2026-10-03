<?php
// kalkulator.php - Versi Modifikasi
$hasil = null;
$pesan = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = (float) ($_POST['a'] ?? 0);
    $b = (float) ($_POST['b'] ?? 0);
    $operator = $_POST['operator'] ?? '+';

    switch ($operator) {
        case '+':
            $hasil = $a + $b;
            break;
        case '-':
            $hasil = $a - $b;
            break;
        case '*':
            $hasil = $a * $b;
            break;
        case '/':
            if ($b == 0) {
                $pesan = 'Error: Pembagian dengan nol tidak diperbolehkan.';
            } else {
                $hasil = $a / $b;
            }
            break;
        case '%': // Modifikasi 1: Operator Modulo
            if ($b == 0) {
                $pesan = 'Error: Modulo dengan angka nol tidak diperbolehkan.';
            } else {
                $hasil = fmod($a, $b);
            }
            break;
        case '^': // Modifikasi 1: Operator Pangkat
            $hasil = pow($a, $b);
            break;
        default:
            $pesan = 'Error: Operator tidak valid.';
    }
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Moderen</title>
    <style>
        * { box-sizing: border-box; font-family: 'Segoe UI', Tahoma, sans-serif; }
        body { background-color: #0f172a; color: #f8fafc; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .card { background-color: #1e293b; padding: 30px; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); width: 100%; max-width: 420px; border: 1px solid #334155; }
        h1 { font-size: 22px; text-align: center; margin-bottom: 24px; color: #38bdf8; }
        form { display: flex; flex-direction: column; gap: 15px; }
        input, select, button { padding: 12px; border-radius: 8px; border: 1px solid #475569; background-color: #0f172a; color: #fff; font-size: 16px; outline: none; }
        input:focus, select:focus { border-color: #38bdf8; }
        button { background-color: #0284c7; color: white; border: none; font-weight: bold; cursor: pointer; transition: 0.2s; }
        button:hover { background-color: #0369a1; }
        .alert-error { background-color: #7f1d1d; color: #fca5a5; padding: 12px; border-radius: 8px; margin-top: 20px; border: 1px solid #991b1b; }
        .alert-success { background-color: #064e3b; color: #6ee7b7; padding: 12px; border-radius: 8px; margin-top: 20px; border: 1px solid #065f46; font-size: 18px; font-weight: bold; text-align: center; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Kalkulator Modern</h1>
        <form method="post">
            <input type="number" step="any" name="a" placeholder="Masukkan Angka Pertama" value="<?= htmlspecialchars($_POST['a'] ?? '') ?>" required>
            
            <select name="operator">
                <option value="+" <?= (isset($_POST['operator']) && $_POST['operator'] == '+') ? 'selected' : '' ?>>+ (Pertambahan)</option>
                <option value="-" <?= (isset($_POST['operator']) && $_POST['operator'] == '-') ? 'selected' : '' ?>>- (Pengurangan)</option>
                <option value="*" <?= (isset($_POST['operator']) && $_POST['operator'] == '*') ? 'selected' : '' ?>>* (Perkalian)</option>
                <option value="/" <?= (isset($_POST['operator']) && $_POST['operator'] == '/') ? 'selected' : '' ?>>/ (Pembagian)</option>
                <option value="%" <?= (isset($_POST['operator']) && $_POST['operator'] == '%') ? 'selected' : '' ?>>% (Modulo / Sisa Bagi)</option>
                <option value="^" <?= (isset($_POST['operator']) && $_POST['operator'] == '^') ? 'selected' : '' ?>>^ (Pangkat)</option>
            </select>
            
            <input type="number" step="any" name="b" placeholder="Masukkan Angka Kedua" value="<?= htmlspecialchars($_POST['b'] ?? '') ?>" required>
            
            <button type="submit">Hitung Hasil</button>
        </form>

        <?php if ($pesan): ?>
            <div class="alert-error"><?= htmlspecialchars($pesan) ?></div>
        <?php elseif ($hasil !== null): ?>
            <div class="alert-success">Hasil: <?= htmlspecialchars((string)$hasil) ?></div>
        <?php endif; ?>
    </div>
</body>
</html>