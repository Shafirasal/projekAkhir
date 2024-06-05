<?php
session_start();

// Pengecekan apakah sudah login, jika tidak arahkan ke halaman login
if (!isset($_SESSION["nama"])) {
    header("location: index.php");
    exit();
}

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projek_akhir";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari form dengan pengecekan
$survey_id = isset($_POST['survey_id']) ? $_POST['survey_id'] : null;
$kategori_id = isset($_POST['kategori_id']) ? $_POST['kategori_id'] : null;
$soal_nama = isset($_POST['soal_nama']) ? $_POST['soal_nama'] : null;

// Validasi data
if ($survey_id && $kategori_id && $soal_nama) {
    // Siapkan query untuk menyimpan data ke database
    $stmt = $conn->prepare("INSERT INTO m_survey_soal (survey_id, kategori_id, soal_nama) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $survey_id, $kategori_id, $soal_nama);

    if ($stmt->execute()) {
        echo "Soal berhasil ditambahkan!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Tutup statement
    $stmt->close();
} else {
    echo "Error: Missing or invalid input data.";
}

$conn->close();
?>