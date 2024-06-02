<?php
// Mulai sesi
session_start();

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projek_akhir";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa apakah survey_id ada dalam sesi
if (!isset($_SESSION['survey_id'])) {
    die("survey_id tidak disetel dalam sesi.");
}

$survey_id = $_SESSION['survey_id'];

// Verifikasi bahwa survey_id ada di tabel m_survey
$result = $conn->query("SELECT survey_id FROM m_survey WHERE survey_id = $survey_id");
if ($result->num_rows == 0) {
    die("survey_id tidak valid.");
}

// Ambil data dari form
$tanggal = $_POST['Tanggal'];
$nip = $_POST['NIP'];
$nama = $_POST['Nama'];
$unit = $_POST['unit'];

// Siapkan dan bind
$stmt = $conn->prepare("INSERT INTO t_responden_dosen (survey_id, responden_tanggal, responden_nip, responden_nama, responden_unit) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("issss", $survey_id, $tanggal, $nip, $nama, $unit);

// Eksekusi statement
if ($stmt->execute()) {
    echo "Data berhasil disimpan";
} else {
    echo "Error: " . $stmt->error;
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
?>