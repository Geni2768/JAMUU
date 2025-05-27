<?php
require_once 'src/fungsi.php';
$bahan = getBahan();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Jamu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Daftar Bahan Jamu</h1>
<table>
    <tr><th>Nama</th><th>Jenis</th><th>Deskripsi</th><th>Harga</th><th>Aksi</th></tr>
    <?php foreach ($bahan as $b): ?>
    <tr>
        <td><?= $b['nama'] ?></td>
        <td><?= $b['jenis'] ?></td>
        <td><?= $b['deskripsi'] ?></td>
        <td><?= $b['harga'] ?></td>
        <td><a href="keranjang.php?tambah=<?= $b['id'] ?>">Tambah</a></td>
    </tr>
    <?php endforeach; ?>
</table>
<a href="keranjang.php">Lihat Keranjang</a>
</body>
</html>
