<?php
// Mulai sesi
session_start();

// Koneksi ke database
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "m_survey";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
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
$stmt = $conn->prepare("INSERT INTO user_info (responden_tanggal, responden_nama, responden_jk, responden_umur, responden_hp, responden_pendidikan, responden_pekerjaan, responden_penghasilan, mahasiswa_nim, mahasiswa_nama, mahasiswa_prodi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssss", $tanggal, $nama, $jk, $umur, $nomer, $pendidikan, $pekerjaan, $penghasilan, $nim_mahasiswa, $nama_mahasiswa, $prodi_mahasiswa);

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
