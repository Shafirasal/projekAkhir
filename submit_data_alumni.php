<?php
// Mulai sesi
session_start();

// Koneksi ke database
$servername = "localhost";
$username = "username";
$password = "";
$dbname = "projek_akhir";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
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
$stmt = $conn->prepare("INSERT INTO survey_alumni (responde_tanggal, responden_nim, responden_nama, responden_prodi, responden_email, responden_hp, tahun_lulus) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sisssss", $tanggal, $nim, $nama, $prodi, $email, $nomer, $tahun);

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
