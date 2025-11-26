<?php
// 1. Muat konfigurasi ORM dan Model
require 'config.php';
require 'models/Mahasiswa.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

// --- LOGIKA READ (by ID) ---
$mhs = Mahasiswa::find($id);

if (!$mhs) {
    echo "Data tidak ditemukan!";
    exit;
}

// --- LOGIKA UPDATE ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['npm'])) {
    
    // Ambil data
    $npm = $_POST['npm'] ?? '';
    $nama = $_POST['nama'] ?? '';
    $jurusan = $_POST['jurusan'] ?? '';

    // INI ADALAH ORM: Menggantikan query "UPDATE ..."
    if ($npm && $nama && $jurusan) {
        $mhs->update([
            'npm' => $npm,
            'nama' => $nama,
            'jurusan' => $jurusan
        ]);
    }
    
    // Redirect kembali ke index
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data Mahasiswa</title>
    <style>
        body { font-family: sans-serif; margin: 2em; background-color: #f4f4f4; }
        .container { max-width: 900px; margin: 0 auto; }
        .card { background: #fff; border-radius: 8px; padding: 20px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h3 { margin-top: 0; }
        .form-row { margin-bottom: 10px; }
        .form-row label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-row input { width: 100%; padding: 8px; box-sizing: border-box; }
        .btn { background: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; }
        .btn-back { background: #6c757d; }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h3>Edit Data (Update)</h3>
        <form method="POST" action="edit.php?id=<?php echo $mhs->id; ?>">
            <div class="form-row">
                <label for="npm">NPM</label>
                <input type="text" name="npm" id="npm" required maxlength="15" value="<?php echo htmlspecialchars($mhs->npm); ?>">
            </div>
            <div class="form-row">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" required value="<?php echo htmlspecialchars($mhs->nama); ?>">
            </div>
            <div class="form-row">
                <label for="jurusan">Jurusan</label>
                <input type="text" name="jurusan" id="jurusan" required value="<?php echo htmlspecialchars($mhs->jurusan); ?>">
            </div>
            <button type="submit" class="btn">Update Data</button>
            <a href="index.php" class="btn btn-back">Batal</a>
        </form>
    </div>
</div>

</body>
</html>