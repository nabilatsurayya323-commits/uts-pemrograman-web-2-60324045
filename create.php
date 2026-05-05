<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori - UTS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php
require_once 'config/database.php';

$errors = [];
$kode = '';
$nama = '';
$deskripsi = '';
$status = 'Aktif';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // TODO: Ambil dan sanitasi data dari form
    $kode = trim($_POST['kode']);
    $nama = trim ($_POST['nama']);
    $deskripsi = trim($_POST['deskripsi']);
    $status = $_POST['status'];

    // TODO: Validasi kode kategori
    if (empty($kode)) {
        $errors[] = "Kode wajib diisi!";
    } elseif (strlen($kode) < 4 || strlen($kode) > 10) {
        $errors[] = "Kode harus 4-10 karakter";
    } elseif (strpos($kode, 'KAT-') !== 0) {
        $errors[] = "Format kode harus diawali dengan KAT-";
    }

    // TODO: Validasi nama kategori
    if (empty($kode)) {
    $errors[] = "Kode wajib diisi!";
    } elseif (strlen($nama) < 3 || strlen ($nama) > 50) {
        $errors[] = "Nama harus 3-50 karakter";
    }
    
    // TODO: Validasi deskripsi 
    if (!empty($deskripsi) && strlen($deskripsi) > 200) {
    $errors[] = "Deskripsi maksimal 200 karakter";
    }
    
    // TODO: Cek jika ada duplikasi kode
    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id_kategori FROM kategori WHERE kode_kategori = ?");
        $stmt->bind_param("s", $kode);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $errors[] = "Kode sudah digunakan";
        }
    }
    
    // TODO: Jika tidak ada error, maka kita insert datanya
    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO kategori (kode_kategori, nama_kategori, deskripsi, status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $kode, $nama, $deskripsi, $status);
        
        if ($stmt->execute()) {
            // TODO: Redirect jika berhasil
            header("Location: index.php?success=Data berhasil kita tambahkan!");
            exit;
        } else {
            $errors[] = "Gagal menyimpan data";
        }
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah kategori Baru</h4>
                </div>
                <div class="card-body">

                    <!-- TODO: Tampilkan error jika ada -->
                    <?php if (!empty($errors)): ?>
                        <div class= "alert alert-danger">
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li><?= $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST">
                        <!-- TODO: Form fields -->
                         
                        <div class="mb-3">
                            <label>Kode Kategori</label>
                            <input type="text" name="kode" class="form-control" value="<?= $kode; ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label>Nama Kategori</label>
                            <input type="text" name="nama" class="form-control" value="<?= $nama; ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" ><?= $deskripsi; ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Status</label>
                            <input type="radio" name="status" value="Aktif" <?= $status == 'Aktif' ? 'checked' : '' ?>> Aktif
                            <input type="radio" name="status" value="Nonaktif" <?= $status == 'Nonaktif' ? 'checked' : '' ?>> Nonaktif
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="index.php" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>