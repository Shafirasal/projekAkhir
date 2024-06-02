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

// Ambil ID user yang akan dihapus
$id = $_POST['id'];

// Query untuk menghapus user
$sql = "DELETE FROM m_user WHERE user_id = $id";

if ($conn->query($sql) === TRUE) {
    echo "User berhasil dihapus.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
