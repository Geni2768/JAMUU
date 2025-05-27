<?php
session_start();

function koneksi()
{
    return new PDO('sqlite:jamu.db');
}

function ambilSemuaBahan()
{
    $db = koneksi();
    $stmt = $db->query("SELECT * FROM bahan");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function tambahKeranjang($id)
{
    if (!isset($_SESSION['keranjang'])) {
        $_SESSION['keranjang'] = [];
    }
    $_SESSION['keranjang'][] = $id;
}

function hapusKeranjang($id)
{
    if (isset($_SESSION['keranjang'])) {
        $_SESSION['keranjang'] = array_filter($_SESSION['keranjang'], fn($i) => $i != $id);
    }
}

function ambilKeranjang()
{
    $bahan = ambilSemuaBahan();
    $keranjang = [];
    if (isset($_SESSION['keranjang'])) {
        foreach ($_SESSION['keranjang'] as $id) {
            foreach ($bahan as $b) {
                if ($b['id'] == $id) {
                    $keranjang[] = $b;
                }
            }
        }
    }
    return $keranjang;
}

