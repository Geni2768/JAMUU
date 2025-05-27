<?php
function koneksi() {
    return new PDO('sqlite:jamu.db');
}

function ambilSemuaBahan() {
    $db = koneksi();
    $stmt = $db->query("SELECT * FROM bahan");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function ambilBahanById($id) {
    $db = koneksi();
    $stmt = $db->prepare("SELECT * FROM bahan WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

