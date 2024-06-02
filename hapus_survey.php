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

// Buat query untuk delete survey
$sql = "DELETE FROM m_survey WHERE survey_id=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Survey berhasil dihapus.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>
