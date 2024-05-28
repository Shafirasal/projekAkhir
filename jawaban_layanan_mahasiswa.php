<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projek_akhir";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}

// Ambil data dari form
$jawaban = $_POST['tingkat_kepuasan'];

foreach ($jawaban as $soal_id => $nilai) {
    $sql = "INSERT INTO t_jawaban_mahasiswa (soal_id, jawaban) VALUES ('$soal_id', '$nilai')";
    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

echo "Survey berhasil disimpan";

// Tutup koneksi
$conn->close();
?>
