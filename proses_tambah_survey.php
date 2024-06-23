<?php

include 'koneksi/koneksi.php';

// Get the form data
$user_id = $_POST['user_id'];
$jenis = $_POST['jenis'];
$kode = $_POST['kode'];
$nama = $_POST['nama'];
$deskripsi = $_POST['deskripsi'];
$tanggal = $_POST['tanggal'];

// Insert data into the database
$sql = "INSERT INTO m_survey (user_id, survey_jenis, survey_kode, survey_nama, survey_deskripsi, survey_tanggal) VALUES ('$user_id', '$jenis', '$kode', '$nama', '$deskripsi', '$tanggal')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
