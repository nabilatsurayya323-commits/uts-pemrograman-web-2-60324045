<?php
require_once 'config/database.php';

// TODO: Validasi ID dari GET
if (!isset($_GET['id'])) {
    header("LOcation: index.php?error=ID tidak ditemukan");
    exit;
}

$id = $_GET['id'];

// TODO: Cek keberadaan data
$stmt = $conn->prepare("SELECT id_kategori FROM kategori WHERE id_kategori = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: index.php?error=Data tidak ditemukan");
    exit;
}

// TODO: Delete data
$stmt = $conn->prepare("DELETE FROM kategori WHERE id_kategori = ?");
$stmt->bind_param("i", $id);

$stmt->execute();

// TODO: Redirect dengan pesan
if ($stmt->affected_rows > 0) {
    header("Location: index.php?success=Data berhasil dihapus");
} else {
    header("Location: index.php?error=Gagal menghapus data");
}
exit;
?>