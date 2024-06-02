<?php
// Koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projek_akhir";
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}

// Ambil data dari request
$id = $_POST['id'];
$username = $_POST['username'];
$nama_lengkap = $_POST['nama_lengkap'];
$password = $_POST['password'];
$level = $_POST['level'];

// Buat query untuk update user
$sql = "UPDATE m_user SET username=?, nama_lengkap=?, password=?, level=? WHERE user_id=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssii", $username, $nama_lengkap, $password, $level, $id);

if ($stmt->execute()) {
    echo "User berhasil diperbarui.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>
