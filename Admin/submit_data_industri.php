<?php
// Mulai sesi
session_start();


include '../koneksi/koneksi.php';

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
$nama = $_POST['Nama'];
$jabatan = $_POST['Jabatan'];
$perusahaan = $_POST['Perusahaan'];
$email = $_POST['Email'];
$nomer = $_POST['Nomer'];
$kota = $_POST['Kota'];

// Siapkan dan bind
$stmt = $conn->prepare("INSERT INTO t_responden_industri (survey_id,responden_tanggal, responden_nama, responden_jabatan, responden_perusahaan, responden_email, responden_hp, responden_kota) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssssss", $survey_id, $tanggal, $nama, $jabatan, $perusahaan, $email, $nomer, $kota);

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
