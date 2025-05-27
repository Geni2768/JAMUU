<?php
require_once 'src/fungsi.php';
session_start();

if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $bahan = ambilBahanById($id);
    if ($bahan) {
        $_SESSION['keranjang'][] = $bahan;
    }
}

$keranjang = $_SESSION['keranjang'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Keranjang Jamu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Keranjang Jamu</h1>
    <table>
        <tr>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Harga</th>
        </tr>
        <?php foreach ($keranjang as $item): ?>
        <tr>
            <td><?= htmlspecialchars($item['nama']) ?></td>
            <td><?= htmlspecialchars($item['jenis']) ?></td>
            <td><?= htmlspecialchars($item['harga']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="bayar.php">Bayar</a>
</body>
</html>

