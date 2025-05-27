<?php
require_once 'src/fungsi.php';

$keranjang = ambilKeranjang();
$total = 0;
foreach ($keranjang as $item) {
    $total += $item['harga'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bayar Jamu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Rincian Pembayaran</h1>
    <ul>
        <?php foreach ($keranjang as $item): ?>
        <li><?= htmlspecialchars($item['nama']) ?> - Rp<?= htmlspecialchars($item['harga']) ?></li>
        <?php endforeach; ?>
    </ul>
    <h2>Total: Rp<?= $total ?></h2>
    <a href="index.php">Selesai</a>
</body>
</html>

