<?php
// produk.php - Versi Modifikasi OOP Advanced
interface BisaDihitung
{
    public function hargaAkhir(): float;
}

class Produk implements BisaDihitung
{
    public function __construct(
        protected string $nama,
        protected float $harga
    ) {}

    public function hargaAkhir(): float
    {
        return $this->harga;
    }

    public function getNama(): string
    {
        return $this->nama;
    }

    public function getHargaAwal(): float
    {
        return $this->harga;
    }
}

class ProdukDiskon extends Produk
{
    public function __construct(string $nama, float $harga, private float $diskon)
    {
        parent::__construct($nama, $harga);
    }

    public function hargaAkhir(): float
    {
        return $this->harga * (1 - $this->diskon / 100);
    }

    public function getDiskon(): float
    {
        return $this->diskon;
    }
}

// Modifikasi 1: Class Baru dengan Penerapan PPN / Pajak
class ProdukPajak extends Produk
{
    public function __construct(string $nama, float $harga, private float $pajakPersen = 11)
    {
        parent::__construct($nama, $harga);
    }

    public function hargaAkhir(): float
    {
        return $this->harga + ($this->harga * ($this->pajakPersen / 100));
    }

    public function getPajak(): float
    {
        return $this->pajakPersen;
    }
}

// Modifikasi 2: Array Katalog Produk Lebih Lengkap
$daftar = [
    new Produk('PC Desktop Gaming', 10900000),
    new ProdukDiskon('Mechanical Keyboard', 450000, 15),
    new ProdukDiskon('Wireless Mouse', 250000, 10),
    new ProdukPajak('Monitor Curved 24 Inch', 1800000, 11)
];

// Perhitungan Total Seluruh Produk
$totalKeseluruhan = 0;
foreach ($daftar as $p) {
    $totalKeseluruhan += $p->hargaAkhir();
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk & Kasir OOP</title>
    <!-- Modifikasi 3: Responsive UI Dark Mode -->
    <style>
        * { box-sizing: border-box; font-family: 'Segoe UI', Tahoma, sans-serif; }
        body { background-color: #0f172a; color: #f8fafc; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; padding: 20px; }
        .card { background-color: #1e293b; border-radius: 16px; padding: 32px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); width: 100%; max-width: 550px; border: 1px solid #334155; }
        h1 { color: #38bdf8; font-size: 22px; text-align: center; margin-bottom: 24px; border-bottom: 2px solid #334155; padding-bottom: 12px; }
        .product-item { display: flex; justify-content: space-between; align-items: center; padding: 14px 0; border-bottom: 1px solid #334155; }
        .product-info { display: flex; flex-direction: column; }
        .product-name { font-weight: 600; color: #f8fafc; font-size: 15px; }
        .product-tag { font-size: 12px; color: #94a3b8; margin-top: 4px; }
        .product-price { font-weight: bold; color: #38bdf8; font-size: 16px; }
        .total-box { margin-top: 24px; background-color: #065f46; color: #34d399; border: 1px solid #059669; padding: 16px; border-radius: 10px; display: flex; justify-content: space-between; align-items: center; font-weight: bold; font-size: 18px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Daftar Transaksi Produk</h1>

        <?php foreach ($daftar as $produk): ?>
            <div class="product-item">
                <div class="product-info">
                    <span class="product-name"><?= htmlspecialchars($produk->getNama()) ?></span>
                    <span class="product-tag">
                        <?php 
                            if ($produk instanceof ProdukDiskon) {
                                echo "Diskon " . $produk->getDiskon() . "% (Harga Normal: Rp " . number_format($produk->getHargaAwal(), 0, ',', '.') . ")";
                            } elseif ($produk instanceof ProdukPajak) {
                                echo "Termasuk PPN " . $produk->getPajak() . "%";
                            } else {
                                echo "Harga Normal";
                            }
                        ?>
                    </span>
                </div>
                <div class="product-price">
                    Rp <?= number_format($produk->hargaAkhir(), 0, ',', '.') ?>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="total-box">
            <span>Total Bayar</span>
            <span>Rp <?= number_format($totalKeseluruhan, 0, ',', '.') ?></span>
        </div>
    </div>
</body>
</html>