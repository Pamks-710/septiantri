<?php
// 1. Muat konfigurasi ORM dan Model
require 'config.php';
require 'models/mahasiswa.php';

// Atur header default ke halaman ini
$self = $_SERVER['PHP_SELF'];

// --- LOGIKA CREATE (INSERT) ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['npm'])) {
    
    // Ambil data 
    $npm = $_POST['npm'] ?? '';
    $nama = $_POST['nama'] ?? '';
    $jurusan = $_POST['jurusan'] ?? '';

    // INI ADALAH ORM: Menggantikan query "INSERT INTO"
    if ($npm && $nama && $jurusan) {
        Mahasiswa::create([
            'npm' => $npm,
            'nama' => $nama,
            'jurusan' => $jurusan
        ]);
    }
    
    // Redirect untuk mencegah form resubmission
    header("Location: $self");
    exit;
}

// --- LOGIKA READ (SELECT) ---
// INI ADALAH ORM: Menggantikan query "SELECT * FROM"
$data_mahasiswa = Mahasiswa::orderBy('id', 'desc')->get();

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RPL2 Act4 - PHP + ORM</title>
    <style>
        body { font-family: sans-serif; margin: 2em; background-color: #f4f4f4; }
        .container { max-width: 900px; margin: 0 auto; }
        .card { background: #fff; border-radius: 8px; padding: 20px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h3 { margin-top: 0; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f9f9f9; }
        .form-row { margin-bottom: 10px; }
        .form-row label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-row input { width: 100%; padding: 8px; box-sizing: border-box; }
        .btn { background: #007bff; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; }
        .btn-edit { background: #ffc107; color: black; }
        .btn-delete { background: #dc3545; color: white; }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h3>Tambah Data (Create)</h3>
        <form method="POST" action="<?php echo $self; ?>">
            <div class="form-row">
                <label for="npm">NPM</label>
                <input type="text" name="npm" id="npm" required maxlength="15">
            </div>
            <div class="form-row">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" required>
            </div>
            <div class="form-row">
                <label for="jurusan">Jurusan</label>
                <input type="text" name="jurusan" id="jurusan" required>
            </div>
            <button type="submit" class="btn">Simpan</button>
        </form>
    </div>

<div style="margin-bottom: 10px; display:flex; justify-content:space-between; align-items:center;">
    <h2 style="margin:0;">Data Mahasiswa</h2>
    <a href="report_mahasiswa.php" target="_blank" 
       style="padding:6px 10px; background:#007bff; color:#fff; text-decoration:none; border-radius:4px;">
        Print ke PDF
    </a>
</div>

    <div class="card">
        <h3>Data Tersimpan (Read)</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($data_mahasiswa->count() > 0): ?>
                    <?php foreach ($data_mahasiswa as $mhs): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($mhs->id); ?></td>
                            <td><?php echo htmlspecialchars($mhs->npm); ?></td>
                            <td><?php echo htmlspecialchars($mhs->nama); ?></td>
                            <td><?php echo htmlspecialchars($mhs->jurusan); ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $mhs->id; ?>" class="btn btn-edit">Edit</a>
                                <a href="delete.php?id=<?php echo $mhs->id; ?>" 
                                   onclick="return confirm('Yakin ingin menghapus data ini?');" 
                                   class="btn btn-delete">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">Belum ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>