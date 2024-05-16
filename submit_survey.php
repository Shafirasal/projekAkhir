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

// Tangkap data dari formulir
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tingkat_kepuasan']) && isset($_POST['responden_mahasiswa_id'])) {
    // Mendapatkan responden_mahasiswa_id dari formulir
    $responden_mahasiswa_id = $_POST['responden_mahasiswa_id'];

    // Loop melalui data yang diterima
    foreach ($_POST['tingkat_kepuasan'] as $soal_id => $tingkat_kepuasan) {
        // Sisipkan data ke dalam tabel t_jawaban_mahasiswa
        $sql = "INSERT INTO t_jawaban_mahasiswa (jawaban) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $tingkat_kepuasan); // Mengikat nilai jawaban sebagai string
        $stmt->execute();
    }
    echo "Data survei berhasil disimpan ke dalam tabel t_jawaban_mahasiswa.";
} else {
    echo "Metode pengiriman data tidak valid atau tidak ada data yang dikirimkan.";
}

// Tutup koneksi
$conn->close();
?>
