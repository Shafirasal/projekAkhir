<?php
// Mulai sesi
session_start();


include '../koneksi/koneksi.php';

// Ambil data dari form
$tanggal = $_POST['Tanggal'];
$nim = $_POST['NIM'];
$nama = $_POST['Nama'];
$prodi = $_POST['prodi'];
$email = $_POST['Email'];
$nomer = $_POST['Nomer'];
$tahun = $_POST['Tahun'];

// Siapkan dan bind
$stmt = $conn->prepare("INSERT INTO t_responden_mahasiswa (responde_tanggal, responden_nim, responden_nama, responden_prodi, responden_email, responden_hp, tahun_lulus) VALUES (?, ?, ?, ?, ?, ?, ?)");
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
