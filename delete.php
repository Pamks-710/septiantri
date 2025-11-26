<?php
// 1. Muat konfigurasi ORM dan Model
require 'bootstrap.php';
require 'models/Mahasiswa.php';

$id = $_GET['id'] ?? null;

if ($id) {
    // --- LOGIKA DELETE ---
    $mhs = Mahasiswa::find($id);
    
    if ($mhs) {
        $mhs->delete();
    }
}

// Redirect kembali ke index
header("Location: index.php");
exit;