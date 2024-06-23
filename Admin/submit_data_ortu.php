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
$jk = $_POST['JK'];
$umur = $_POST['Umur'];
$nomer = $_POST['Nomer'];
$pendidikan = $_POST['Pendidikan'];
$pekerjaan = $_POST['Pekerjaan'];
$penghasilan = $_POST['Penghasilan'];
$nim_mahasiswa = $_POST['NIM_Mahasiswa'];
$nama_mahasiswa = $_POST['Nama_Mahasiswa'];
$prodi_mahasiswa = $_POST['Prodi_Mahasiswa'];

// Siapkan dan bind
$stmt = $conn->prepare("INSERT INTO t_responden_ortu (survey_id, responden_tanggal, responden_nama, responden_jk, responden_umur, responden_hp, responden_pendidikan, responden_pekerjaan, responden_penghasilan, mahasiswa_nim, mahasiswa_nama, mahasiswa_prodi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssssssssss", $survey_id, $tanggal, $nama, $jk, $umur, $nomer, $pendidikan, $pekerjaan, $penghasilan, $nim_mahasiswa, $nama_mahasiswa, $prodi_mahasiswa);

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
