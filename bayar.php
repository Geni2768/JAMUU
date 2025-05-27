<?php
require_once 'src/fungsi.php';
$keranjang = getKeranjang();
$total = totalHarga();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_destroy();
    echo "<p>Pembayaran berhasil. Terima kasih!</p>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bayar</title>
</head>
<body>
<h1>Form Pembayaran</h1>
<form method="post">
    Nama: <input type="text" name="nama"><br>
    Alamat: <input type="text" name="alamat"><br>
    <p>Total: Rp<?= $total ?></p>
    <button type="submit">Bayar Sekarang</button>
</form>
</body>
</html>
