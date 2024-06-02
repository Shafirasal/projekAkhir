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

// Ambil data dari form
$survey_id = $_POST['survey_id'];
$kategori_id = $_POST['kategori_id'];
$soal_nama = $_POST['soal_nama'];
$tingkat_kepuasan = implode(", ", $_POST['tingkat_kepuasan']);

// Siapkan query untuk menyimpan data ke database
$sql = "INSERT INTO m_survey_soal (survey_id, kategori_id, soal_nama, tingkat_kepuasan) 
        VALUES ('$survey_id', '$kategori_id', '$soal_nama', '$tingkat_kepuasan')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
