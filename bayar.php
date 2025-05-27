<?php
session_start();
$total = 0;

if (isset($_SESSION['keranjang'])) {
    foreach ($_SESSION['keranjang'] as $item) {
        $total += $item['harga'];
    }
    $_SESSION['keranjang'] = []; // kosongkan keranjang setelah bayar
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bayar Jamu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Terima Kasih!</h1>
    <p>Total pembayaran Anda: Rp <?= $total ?></p>
    <a href="index.php">Kembali ke Daftar</a>
</body>
</html>

