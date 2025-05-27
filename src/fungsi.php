<?php
// Menghubungkan ke database SQLite
function koneksi()
{
    return new PDO('sqlite:jamu.db');
}

// Mengambil semua data bahan dari database
function getSemuaBahan()
{
    $db = koneksi();
    $stmt = $db->prepare("SELECT * FROM bahan");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Mengambil satu data bahan berdasarkan ID
function getBahanById($id)
{
    $db = koneksi();
    $stmt = $db->prepare("SELECT * FROM bahan WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Hitung total harga dari keranjang
function hitungTotal($keranjang, $porsi)
{
    $total = 0;
    foreach ($keranjang as $id => $jumlah) {
        $bahan = getBahanById($id);
        if ($bahan) {
            $total += $bahan['harga'] * $jumlah;
        }
    }
    return $total * $porsi;
}

// Menyimpan keranjang ke sesi
function simpanKeranjang($id)
{
    if (!isset($_SESSION['keranjang'])) {
        $_SESSION['keranjang'] = [];
    }

    if (isset($_SESSION['keranjang'][$id])) {
        $_SESSION['keranjang'][$id]++;
    } else {
        $_SESSION['keranjang'][$id] = 1;
    }
}

// Menghapus item dari keranjang
function hapusDariKeranjang($id)
{
    if (isset($_SESSION['keranjang'][$id])) {
        unset($_SESSION['keranjang'][$id]);
    }
}

// Mengatur jumlah bahan tertentu di keranjang
function ubahJumlah($id, $jumlah)
{
    if ($jumlah <= 0) {
        hapusDariKeranjang($id);
    } else {
        $_SESSION['keranjang'][$id] = $jumlah;
    }
}
?>
<?php
// Menghubungkan ke database SQLite
function koneksi()
{
    return new PDO('sqlite:jamu.db');
}

// Mengambil semua data bahan dari database
function getSemuaBahan()
{
    $db = koneksi();
    $stmt = $db->prepare("SELECT * FROM bahan");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Mengambil satu data bahan berdasarkan ID
function getBahanById($id)
{
    $db = koneksi();
    $stmt = $db->prepare("SELECT * FROM bahan WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Hitung total harga dari keranjang
function hitungTotal($keranjang, $porsi)
{
    $total = 0;
    foreach ($keranjang as $id => $jumlah) {
        $bahan = getBahanById($id);
        if ($bahan) {
            $total += $bahan['harga'] * $jumlah;
        }
    }
    return $total * $porsi;
}

// Menyimpan keranjang ke sesi
function simpanKeranjang($id)
{
    if (!isset($_SESSION['keranjang'])) {
        $_SESSION['keranjang'] = [];
    }

    if (isset($_SESSION['keranjang'][$id])) {
        $_SESSION['keranjang'][$id]++;
    } else {
        $_SESSION['keranjang'][$id] = 1;
    }
}

// Menghapus item dari keranjang
function hapusDariKeranjang($id)
{
    if (isset($_SESSION['keranjang'][$id])) {
        unset($_SESSION['keranjang'][$id]);
    }
}

// Mengatur jumlah bahan tertentu di keranjang
function ubahJumlah($id, $jumlah)
{
    if ($jumlah <= 0) {
        hapusDariKeranjang($id);
    } else {
        $_SESSION['keranjang'][$id] = $jumlah;
    }
}
?>

