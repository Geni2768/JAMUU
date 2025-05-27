<?php
require_once 'src/fungsi.php';
$data = ambilSemuaBahan();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Bahan Jamu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Daftar Bahan Jamu</h1>
    <table>
        <tr>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($data as $bahan): ?>
        <tr>
            <td><?= htmlspecialchars($bahan['nama']) ?></td>
            <td><?= htmlspecialchars($bahan['jenis']) ?></td>
            <td><?= htmlspecialchars($bahan['deskripsi']) ?></td>
            <td><?= htmlspecialchars($bahan['harga']) ?></td>
            <td>
                <a href="keranjang.php?id=<?= $bahan['id'] ?>">Tambah</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

