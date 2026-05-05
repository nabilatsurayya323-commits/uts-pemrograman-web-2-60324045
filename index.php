<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kategori - UTS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php
require_once 'config/database.php';

// Query data kategori (prepared statement)
$stmt = $conn->prepare("SELECT * FROM kategori ORDER BY id_kategori DESC");
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar kategori Buku</h2>
        <a href="create.php" class="btn btn-primary">Tambah Kategori</a>
    </div>

    <!-- Pesan sukses/error -->
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <?= $_GET['success']; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger">
            <?= $_GET['error']; ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th width="100">Kode</th>
                        <th>Nama Kategori</th>
                        <th>Dekripsi</th>
                        <th width="100">Status</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                $no = 1;
                while ($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['kode_kategori']; ?></td>
                    <td><?= $row['nama_kategori']; ?></td>
                    <td><?= $row['deskripsi']; ?></td>
                    <td>
                        <?php if ($row['status'] == 'Aktif'): ?>
                            <span class="badge bg-success">Aktif</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Nonaktif</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="edit.php?id=<?= $row['id_kategori']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <button onclick="confirmDelete(<?= $row['id_kategori']; ?>)" class="btn btn-danger btn-sm">Hapus</button>
                    </td>
                </tr>
                <?php endwhile; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function confirmDelete(id) {
    if (confirm('Anda yakin ingin menghapus kategori ini?')) {
        window.location.href = 'delete.php?id=' + id;
    }
}
</script>

</body>
</html>