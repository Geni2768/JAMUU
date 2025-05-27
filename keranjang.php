<?php
require_once 'src/fungsi.php';

if (isset($_GET['tambah'])) {
    $id = $_GET['tambah'];
    tambahKeranjang($id);
} elseif (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    hapusKeranjang($id);
}

$keranjang = ambilKeranjang();
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
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($keranjang as $item): ?>
        <tr>
            <td><?= htmlspecialchars($item['nama']) ?></td>
            <td><?= htmlspecialchars($item['harga']) ?></td>
            <td><a href="keranjang.php?hapus=<?= $item['id'] ?>">Hapus</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="index.php">Kembali</a> |
    <a href="bayar.php">Bayar</a>
</body>
</html>

