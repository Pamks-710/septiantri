<?php
// Ambil koneksi & model 
require 'config.php';
require 'models/mahasiswa.php';   

// Ambil semua data mahasiswa (pakai Eloquent)
$mahasiswa = Mahasiswa::orderBy('created_at', 'desc')->get();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Mahasiswa</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            margin: 30px;
        }
        .header-laporan {
            text-align: center;
            margin-bottom: 20px;
        }
        .header-laporan h1 {
            margin: 0;
            font-size: 18px;
        }
        .header-laporan p {
            margin: 2px 0;
            font-size: 11px;
        }
        hr {
            margin: 10px 0 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }
        th, td {
            border: 1px solid #000;
            padding: 4px 6px;
        }
        th {
            background-color: #f0f0f0;
        }
        .footer-laporan {
            margin-top: 15px;
            font-size: 10px;
            text-align: right;
        }
    </style>
</head>
<body onload="window.print()">
<div class="header-laporan">
    
    <h1>LAPORAN DATA MAHASISWA</h1>
    <p>Lab RPL 2 – Pertemuan 6</p>
    <p>Universitas Gunadarma</p>
</div>
<hr>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>NPM</th>
            <th>Nama</th>
            <th>Jurusan</th>
            <th>Tanggal Input</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($mahasiswa) > 0): ?>
            <?php $no = 1; ?>
            <?php foreach ($mahasiswa as $m): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($m->npm); ?></td>
                    <td><?= htmlspecialchars($m->nama); ?></td>
                    <td><?= htmlspecialchars($m->jurusan); ?></td>
                    <td><?= date('d-m-Y H:i', strtotime($m->created_at)); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" style="text-align:center;">Tidak ada data</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<div class="footer-laporan">
    Dicetak pada: <?= date('d-m-Y H:i'); ?>
</div>

</body>
</html>
