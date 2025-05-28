<?php
session_start();

// Daftar bahan (lengkap)
$bahanList = [
    "Kunyit"     => ["harga" => 1500, "jenis" => "Bahan utama"],
    "Jahe"       => ["harga" => 1200, "jenis" => "Bahan utama"],
    "Gula Merah" => ["harga" => 1000, "jenis" => "Pemanis"],
    "Madu"       => ["harga" => 2000, "jenis" => "Pemanis"],
    "Mengkudu"   => ["harga" => 1800, "jenis" => "Bahan utama"],
    "Serai"      => ["harga" =>  800, "jenis" => "Bahan utama"],
    "Kapulaga"   => ["harga" => 2200, "jenis" => "Bumbu"],
    "Stevia"     => ["harga" => 2500, "jenis" => "Pemanis"],
    "Daun Pandan"=> ["harga" =>  500, "jenis" => "Bumbu"],
    "Delima"     => ["harga" => 3000, "jenis" => "Buah"]
];

// Inisialisasi keranjang
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

// ... lalu sisanya seperti sebelumnya ...
