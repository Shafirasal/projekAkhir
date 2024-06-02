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
    // Misalnya, kita mendapatkan survey_id dari sesi atau metode lain
    session_start();
    $survey_id = $_SESSION['survey_id'];

    // Ambil responden_tendik_id dari tabel t_responden_tendik
    $sql = "SELECT responden_tendik_id FROM t_responden_tendik WHERE survey_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $survey_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Ambil responden_tendik_id
        $row = $result->fetch_assoc();
        $responden_tendik_id = $row['responden_tendik_id'];

        // Untuk setiap opsi jawaban, sisipkan data ke dalam tabel t_jawaban_tendik
        foreach ($_POST['tingkat_kepuasan'] as $soal_id => $tingkat_kepuasan) {
            // Jika ada opsi jawaban yang dipilih
            if (!empty($tingkat_kepuasan)) {
                // Sisipkan data ke dalam tabel t_jawaban_tendik
                $sql_insert = "INSERT INTO t_jawaban_tendik (responden_tendik_id, soal_id, jawaban) VALUES (?, ?, ?)";
                $stmt_insert = $conn->prepare($sql_insert);
                $stmt_insert->bind_param("iis", $responden_tendik_id, $soal_id, $tingkat_kepuasan);
                $stmt_insert->execute();
            }
        }
        echo "Data survei berhasil disimpan ke dalam tabel t_jawaban_tendik.";
    } else {
        echo "Tidak ditemukan responden dengan survey_id tersebut.";
    }
    $stmt->close();
} else {
    echo "Metode pengiriman data tidak valid atau tidak ada data yang dikirimkan.";
}

// Tutup koneksi
$conn->close();
?>
