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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tingkat_kepuasan'])) {
    // Untuk setiap opsi jawaban, sisipkan data ke dalam tabel t_jawaban_dosen
    foreach ($_POST['tingkat_kepuasan'] as $soal_id => $tingkat_kepuasan) {
        // Jika ada opsi jawaban yang dipilih
        if (!empty($tingkat_kepuasan)) {
            // Sisipkan data ke dalam tabel t_jawaban_dosen
            $sql = "INSERT INTO t_jawaban_tendik (soal_id, jawaban) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $soal_id, $tingkat_kepuasan);
            $stmt->execute();
        }
    }
    echo "Data survei berhasil disimpan ke dalam tabel t_jawaban_tendik.";
} else {
    echo "Metode pengiriman data tidak valid atau tidak ada data yang dikirimkan.";
}

// Tutup koneksi
$conn->close();
?>
