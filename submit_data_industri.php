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
$nama = $_POST['Nama'];
$jabatan = $_POST['Jabatan'];
$perusahaan = $_POST['Perusahaan'];
$email = $_POST['Email'];
$nomer = $_POST['Nomer'];
$kota = $_POST['Kota'];

// Siapkan dan bind
$stmt = $conn->prepare("INSERT INTO survey_industri (responden_tanggal, responden_nama, responden_jabatan, responden_perusahaan, responden_email, responden_hp, responden_kota) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $tanggal, $nama, $jabatan, $perusahaan, $email, $nomer, $kota);

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
