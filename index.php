<?php
// ==== Bagian Fungsi ====

if (!function_exists('koneksi')) {
    function koneksi() {
        try {
            $conn = new PDO("sqlite:jamuku.db");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("Koneksi gagal: " . $e->getMessage());
        }
    }
}

if (!function_exists('tampilkanJudulAplikasi')) {
    function tampilkanJudulAplikasi() {
        return "Selamat Datang di Aplikasi Jamuku!";
    }
}

// Tambahkan fungsi lain yang diperlukan di sini
// contoh:
// function hitungTotal() { ... }

// ==== Bagian Tampilan ====

echo "<h1>" . tampilkanJudulAplikasi() . "</h1>";

// Tes koneksi database
$conn = koneksi();
if ($conn) {
    echo "<p>Koneksi ke database berhasil.</p>";
} else {
    echo "<p>Gagal koneksi ke database.</p>";
}
?>

