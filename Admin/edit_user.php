<?php

include '../koneksi/koneksi.php';

// Ambil data dari request
$id = $_POST['id'];
$username = $_POST['username'];
$nama = $_POST['nama'];
$password = $_POST['password'];
$level = $_POST['level'];

// Buat query untuk update user
$sql = "UPDATE m_user SET username=?, nama=?, password=?, level=? WHERE user_id=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssii", $username, $nama, $password, $level, $id);

if ($stmt->execute()) {
    echo "User berhasil diperbarui.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>
