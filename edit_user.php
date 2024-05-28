<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projek_akhir";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['user_id'];
    $username = $_POST['username'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $level = $_POST['level'];

    // Query untuk update data pengguna
    $stmt = $conn->prepare("UPDATE users SET username=?, nama_lengkap=?, level=? WHERE id=?");
    $stmt->bind_param("sssi", $username, $nama_lengkap, $level, $id);

    if ($stmt->execute()) {
        echo "Data berhasil diupdate.";
    } else {
        echo "Gagal mengupdate data: " . $stmt->error;
    }

    $stmt->close();
}

// Tutup koneksi
$conn->close();
?>
