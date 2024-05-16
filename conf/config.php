<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'projek_akhir';

$koneksi = mysqli_connect($host, $user, $password, $database);

// Mengecek koneksi
if (!$koneksi) {
    // Handle connection error gracefully
    die("Koneksi Gagal: " . mysqli_connect_error());
} else {
    echo "Koneksi Berhasil";
}
?>
