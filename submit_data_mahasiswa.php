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

$survey_id = $_SESSION['survey_id'];

// Verifikasi bahwa survey_id ada di tabel m_survey
$result = $conn->query("SELECT survey_id FROM m_survey WHERE survey_id = $survey_id");
if ($result->num_rows == 0) {
    die("survey_id tidak valid.");
}

// Ambil data dari form
$tanggal = $_POST['Tanggal'];
$nim = $_POST['NIM'];
$nama = $_POST['Nama'];
$prodi = $_POST['prodi'];
$email = $_POST['Email'];
$nomer = $_POST['Nomer'];
$tahun = $_POST['Tahun'];

// Siapkan dan bind
$stmt = $conn->prepare("INSERT INTO t_responden_mahasiswa (survey_id, responden_tanggal, responden_nim, responden_nama, responden_prodi, responden_email, responden_hp, tahun_masuk) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssssss", $survey_id, $tanggal, $nim, $nama, $prodi, $email, $nomer, $tahun);

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