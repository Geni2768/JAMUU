<?php
require_once 'src/fungsi.php';
$bahan = ambilSemuaBahan();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Jamu</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Daftar Bahan Jamu</h1>

  <table border="1" cellpadding="10" cellspacing="0">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Jenis</th>
        <th>Deskripsi</th>
        <th>Harga</th>
        <th>Tambah</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($bahan as $index => $item): ?>
        <tr>
          <td><?= $index + 1 ?></td>
          <td><?= htmlspecialchars($item['nama']) ?></td>
          <td><?= htmlspecialchars($item['jenis']) ?></td>
          <td><?= htmlspecialchars($item['deskripsi']) ?></td>
          <td>Rp<?= number_format($item['harga'], 0, ',', '.') ?></td>
          <td>
            <form action="keranjang.php" method="post">
              <input type="hidden" name="id" value="<?= $item['id'] ?>">
              <button type="submit">Tambah</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <p><a href="keranjang.php">Lihat Keranjang</a></p>
</body>
</html>

