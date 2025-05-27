<?php
require_once 'src/fungsi.php';
if (isset($_GET['tambah'])) tambahKeKeranjang($_GET['tambah']);
if (isset($_GET['hapus'])) hapusDariKeranjang($_GET['hapus']);
$keranjang = getKeranjang();
$total = totalHarga();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Keranjang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Keranjang Belanja</h1>
<table>
<tr><th>Nama</th><th>Harga</th><th>Aksi</th></tr>
<?php foreach ($keranjang as $item): ?>
<tr>
    <td><?= $item['nama'] ?></td>
    <td><?= $item['harga'] ?></td>
    <td><a href="?hapus=<?= $item['id'] ?>">Hapus</a></td>
</tr>
<?php endforeach; ?>
</table>
<p>Total: Rp<?= $total ?></p>
<a href="bayar.php">Bayar</a>
</body>
</html>
