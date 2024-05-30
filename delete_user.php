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

// Periksa apakah ada input dengan nama 'user_id' yang dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    // Validasi input
    $id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
    if ($id === false) {
        die("ID pengguna tidak valid.");
    }

    // Query untuk menghapus data pengguna
    $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
    if (!$stmt) {
        die("Kesalahan persiapan kueri: " . $conn->error);
    }
    
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Data berhasil dihapus.";
        } else {
            echo "Tidak ada data yang dihapus dengan ID tersebut.";
        }
    } else {
        echo "Gagal menghapus data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Input ID pengguna tidak ditemukan.";
}

// Tutup koneksi
$conn->close();
?>