<?php
session_start();

// Inisialisasi daftar bahan
if (!isset($_SESSION['bahanList'])) {
    $_SESSION['bahanList'] = [
        "Kunyit"      => ["harga" => 1500, "jenis" => "Bahan utama"],
        "Jahe"        => ["harga" => 1200, "jenis" => "Bahan utama"],
        "Madu"        => ["harga" => 2000, "jenis" => "Pemanis"],
        "Mengkudu"    => ["harga" => 1800, "jenis" => "Bahan utama"],
        "Serai"       => ["harga" =>  800,  "jenis" => "Bahan utama"],
        "Kapulaga"    => ["harga" => 2200, "jenis" => "Bumbu"],
        "Stevia"      => ["harga" => 2500, "jenis" => "Pemanis"],
        "Daun Pandan" => ["harga" =>  500,  "jenis" => "Bumbu"],
        "Delima"      => ["harga" => 3000, "jenis" => "Buah"],
        "Gula Merah"  => ["harga" => 1000, "jenis" => "Pemanis"]
    ];
}

// Tambah bahan baru
if (isset($_POST['tambahBahan'])) {
    $nama  = trim($_POST['namaBahan']);
    $jenis = trim($_POST['jenisBahan']);
    $harga = intval($_POST['hargaBahan']);
    if ($nama !== "" && $harga > 0) {
        $_SESSION['bahanList'][$nama] = ["harga" => $harga, "jenis" => $jenis];
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$bahanList = &$_SESSION['bahanList'];

// Inisialisasi keranjang
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

// Tambah ke keranjang
if (isset($_POST['tambah'])) {
    $n = $_POST['nama'];
    $j = max(1, intval($_POST['jumlah'] ?? 1));
    if (isset($bahanList[$n])) {
        $_SESSION['keranjang'][$n] = $j;
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Hapus item dari keranjang
if (isset($_POST['hapus'])) {
    unset($_SESSION['keranjang'][$_POST['hapus']]);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Reset keranjang
if (isset($_POST['reset'])) {
    $_SESSION['keranjang'] = [];
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Aplikasi Jamu</title>
  <style>
    body { font-family: sans-serif; padding: 20px; background-color: #f5f5f5; }
    form, table { margin-bottom: 20px; }
    input, select { padding: 4px; }
    button { padding: 6px 12px; background: #00796b; color: #fff; border: none; cursor: pointer; }
    table { width: 100%; border-collapse: collapse; background-color: #fff; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
    th { background: #004d40; color: #fff; }
    .keranjang { background: #e0f2f1; padding: 15px; border-radius: 6px; }
  </style>
</head>
<body>

<h2>Tambah Bahan Baru</h2>
<form method="post">
  <label>Nama Bahan:
    <input type="text" name="namaBahan" required>
  </label>
  <label>Jenis:
    <select name="jenisBahan">
      <option value="Bahan utama">Bahan Utama</option>
      <option value="Pemanis">Pemanis</option>
      <option value="Bumbu">Bumbu</option>
      <option value="Buah">Buah</option>
    </select>
  </label>
  <label>Harga:
    <input type="number" name="hargaBahan" min="1" required>
  </label>
  <button type="submit" name="tambahBahan">Tambah Bahan</button>
</form>

<h2>Daftar Bahan</h2>
<table>
  <tr>
    <th>Nama</th><th>Jenis</th><th>Harga (Rp)</th><th>Jumlah</th><th>Aksi</th>
  </tr>
  <?php foreach ($bahanList as $nama => $info): ?>
  <tr>
    <form method="post">
      <td><?= htmlspecialchars($nama) ?></td>
      <td><?= htmlspecialchars($info['jenis']) ?></td>
      <td><?= number_format($info['harga'], 0, ',', '.') ?></td>
      <td>
        <input type="number" name="jumlah" value="1" min="1" style="width:60px">
      </td>
      <td>
        <input type="hidden" name="nama" value="<?= htmlspecialchars($nama) ?>">
        <button type="submit" name="tambah">Tambah</button>
      </td>
    </form>
  </tr>
  <?php endforeach; ?>
</table>

<div class="keranjang">
  <h2>Keranjang Belanja</h2>
  <table>
    <tr><th>Nama</th><th>Jumlah</th><th>Subtotal</th><th>Aksi</th></tr>
    <?php $total = 0; foreach ($_SESSION['keranjang'] as $n => $j):
      $sub = $bahanList[$n]['harga'] * $j; $total += $sub; ?>
    <tr>
      <form method="post">
        <td><?= htmlspecialchars($n) ?></td>
        <td><?= $j ?></td>
        <td><?= number_format($sub, 0, ',', '.') ?></td>
        <td>
          <button type="submit" name="hapus" value="<?= htmlspecialchars($n) ?>">Hapus</button>
        </td>
      </form>
    </tr>
    <?php endforeach; ?>
    <tr>
      <td colspan="2"><strong>Total Belanja:</strong></td>
      <td colspan="2"><strong><?= number_format($total, 0, ',', '.') ?></strong></td>
    </tr>
  </table>
  <form method="post">
    <button type="submit" name="reset">Reset Keranjang</button>
  </form>
</div>

</body>
</html>

