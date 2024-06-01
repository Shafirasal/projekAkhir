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
$no_pegawai = $_POST['No'];
$nama = $_POST['Nama'];
$unit = $_POST['unit'];

// Siapkan dan bind
$stmt = $conn->prepare("INSERT INTO tendik_info (responden_tanggal, responden_nopeg, responden_nama, responden_unit) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $tanggal, $no_pegawai, $nama, $unit);

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
