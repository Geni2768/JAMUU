<?php
session_start();

// Inisialisasi daftar bahan di session (hanya sekali)
if (!isset($_SESSION['bahanList'])) {
    $_SESSION['bahanList'] = [
        "Kunyit"     => ["harga" => 1500, "jenis" => "Bahan utama"],
        "Jahe"       => ["harga" => 1200, "jenis" => "Bahan utama"],
        "Gula Merah" => ["harga" => 1000, "jenis" => "Pemanis"],
    ];
}

// Tangani form “Tambah Bahan”
if (isset($_POST['tambahBahan'])) {
    $nama  = trim($_POST['namaBahan']);
    $jenis = trim($_POST['jenisBahan']);
    $harga = intval($_POST['hargaBahan']);
    if ($nama !== "" && $harga > 0) {
        // Tambahkan ke daftar
        $_SESSION['bahanList'][$nama] = [
            "harga" => $harga,
            "jenis" => $jenis
        ];
    }
}

// Lanjutkan dengan keranjang seperti biasa...
$bahanList = &$_SESSION['bahanList'];
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}
if (isset($_POST['tambah'])) {
    $n = $_POST['nama'];
    $j = max(1, intval($_POST['jumlah'] ?? 1));
    if (isset($bahanList[$n])) {
        $_SESSION['keranjang'][$n] = $j;
    }
}
if (isset($_POST['hapus'])) {
    unset($_SESSION['keranjang'][$_POST['hapus']]);
}
if (isset($_POST['reset'])) {
    $_SESSION['keranjang'] = [];
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Aplikasi Jamu - Tambah Bahan</title>
  <style>
    /* gaya sederhana */
    body { font-family: sans-serif; padding:20px; }
    form, table { margin-bottom:20px; }
    input, select { padding:4px; }
    button { padding:6px 12px; background:#00796b; color:#fff; border:none; cursor:pointer; }
    table { width:100%; border-collapse: collapse; }
    th, td { border:1px solid #ccc; padding:8px; text-align:center; }
    th { background:#004d40; color:#fff; }
  </style>
</head>
<body>

  <!-- Form Tambah Bahan Baru -->
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

  <!-- Tabel Daftar Bahan (dinamis) -->
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
        <td><?= number_format($info['harga'],0,',','.') ?></td>
        <td><input type="number" name="jumlah" value="1" min="1" style="width:60px"></td>
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
      <tr><th>Nama</th><th>Jumlah</th><th>Subtotal</th><th>Aksi</th></tr>
      <?php $total=0; foreach($_SESSION['keranjang'] as $n=>$j): 
        $sub = $bahanList[$n]['harga']*$j; $total+=$sub; ?>
      <tr>
        <form method="post">
          <td><?= htmlspecialchars($n) ?></td>
          <td><?= $j ?></td>
          <td><?= number_format($sub,0,',','.') ?></td>
          <td>
            <button type="submit" name="hapus" value="<?= htmlspecialchars($n) ?>">Hapus</button>
          </td>
        </form>
      </tr>
      <?php endforeach; ?>
      <tr>
        <td colspan="2"><strong>Total Belanja:</strong></td>
        <td colspan="2"><?= number_format($total,0,',','.') ?></td>
      </tr>
    </table>
    <form method="post">
      <button type="submit" name="reset">Reset Keranjang</button>
    </form>
  </div>

</body>
</html>

