<?php
session_start();

// Daftar bahan
$bahanList = [
    "Kunyit"     => ["harga" => 1500, "jenis" => "Bahan utama"],
    "Jahe"       => ["harga" => 1200, "jenis" => "Bahan utama"],
    "Gula Merah" => ["harga" => 1000, "jenis" => "Pemanis"]
];

// Inisialisasi keranjang
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

// Tambah bahan ke keranjang
if (isset($_POST['tambah'])) {
    $nama   = $_POST['nama'];
    $jumlah = max(1, intval($_POST['jumlah'] ?? 1));
    if (isset($bahanList[$nama])) {
        $_SESSION['keranjang'][$nama] = $jumlah;
    }
}

// Hapus satu item
if (isset($_POST['hapus'])) {
    $nama = $_POST['hapus'];
    unset($_SESSION['keranjang'][$nama]);
}

// Reset seluruh keranjang
if (isset($_POST['reset'])) {
    $_SESSION['keranjang'] = [];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Aplikasi Jamu</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
    h2 { color: #00796b; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
    th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
    th { background: #004d40; color: #fff; }
    input[type="number"] { width: 60px; }
    button { background: #00796b; color: #fff; border: none; padding: 6px 12px; cursor: pointer; }
    .keranjang { background: #e0f2f1; padding: 15px; border-radius: 6px; }
  </style>
</head>
<body>

  <!-- Tabel Daftar Bahan -->
  <h2>Daftar Bahan</h2>
  <table>
    <tr>
      <th>Nama</th>
      <th>Jenis</th>
      <th>Harga (Rp)</th>
      <th>Jumlah</th>
      <th>Aksi</th>
    </tr>
    <?php foreach ($bahanList as $nama => $info): ?>
    <tr>
      <form method="post">
        <td><?= htmlspecialchars($nama) ?></td>
        <td><?= htmlspecialchars($info['jenis']) ?></td>
        <td><?= number_format($info['harga'],0,',','.') ?></td>
        <td>
          <input type="number" name="jumlah" value="1" min="1">
        </td>
        <td>
          <input type="hidden" name="nama" value="<?= htmlspecialchars($nama) ?>">
          <button type="submit" name="tambah">Tambah</button>
        </td>
      </form>
    </tr>
    <?php endforeach; ?>
  </table>

  <!-- Tabel Keranjang Belanja -->
  <div class="keranjang">
    <h2>Keranjang Belanja</h2>
    <table>
      <tr>
        <th>Nama</th>
        <th>Jumlah</th>
        <th>Subtotal (Rp)</th>
        <th>Aksi</th>
      </tr>
      <?php
        $total = 0;
        foreach ($_SESSION['keranjang'] as $nama => $jumlah):
          $harga    = $bahanList[$nama]['harga'];
          $subtotal = $harga * $jumlah;
          $total   += $subtotal;
      ?>
      <tr>
        <form method="post">
          <td><?= htmlspecialchars($nama) ?></td>
          <td><?= $jumlah ?></td>
          <td><?= number_format($subtotal,0,',','.') ?></td>
          <td>
            <input type="hidden" name="hapus" value="<?= htmlspecialchars($nama) ?>">
            <button type="submit">Hapus</button>
          </td>
        </form>
      </tr>
      <?php endforeach; ?>
      <tr>
        <td colspan="2"><strong>Total Belanja:</strong></td>
        <td colspan="2"><strong><?= number_format($total,0,',','.') ?></strong></td>
      </tr>
    </table>
    <form method="post">
      <button type="submit" name="reset">Reset Keranjang</button>
    </form>
  </div>

</body>
</html>

