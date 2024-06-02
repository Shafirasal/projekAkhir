<?php
// Mulai sesi
session_start();

// Koneksi ke database
$servername = "localhost"; // Ganti dengan nama server database Anda
$username = "root"; // Ganti dengan nama pengguna database Anda
$password = ""; // Ganti dengan kata sandi database Anda
$dbname = "projek_akhir"; // Ganti dengan nama database Anda

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

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
