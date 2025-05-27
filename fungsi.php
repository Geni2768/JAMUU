<?php
session_start();
function getDB() {
    return new PDO('sqlite:jamu.db');
}
function getBahan() {
    $db = getDB();
    return $db->query("SELECT * FROM bahan")->fetchAll(PDO::FETCH_ASSOC);
}
function tambahKeKeranjang($id) {
    $_SESSION['keranjang'][] = $id;
}
function hapusDariKeranjang($id) {
    $_SESSION['keranjang'] = array_diff($_SESSION['keranjang'], [$id]);
}
function getKeranjang() {
    $db = getDB();
    $data = [];
    if (!isset($_SESSION['keranjang'])) return $data;
    foreach ($_SESSION['keranjang'] as $id) {
        $stmt = $db->prepare("SELECT * FROM bahan WHERE id = ?");
        $stmt->execute([$id]);
        $data[] = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    return $data;
}
function totalHarga() {
    $total = 0;
    foreach (getKeranjang() as $item) $total += $item['harga'];
    return $total;
}
