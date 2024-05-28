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

    // Query untuk menghapus data pengguna
    $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Gagal menghapus data: " . $stmt->error;
    }

    $stmt->close();
}

// Tutup koneksi
$conn->close();
?>
