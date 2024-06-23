<?php
// Mulai sesi
session_start();


include '../koneksi/koneksi.php';

// Ambil data dari form
$kategori = $_POST['kategori'];

// Siapkan dan eksekusi statement SQL
$sql = "INSERT INTO m_kategori (kategori_nama) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $kategori);

if ($stmt->execute()) {
    echo "Data berhasil disimpan";
} else {
    echo "Error: " . $stmt->error;
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
?>
