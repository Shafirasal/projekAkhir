<?php

include '../koneksi/koneksi.php';

// Tangkap data dari formulir
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tingkat_kepuasan'])) {
    // Untuk setiap opsi jawaban, sisipkan data ke dalam tabel t_jawaban_dosen
    foreach ($_POST['tingkat_kepuasan'] as $soal_id => $tingkat_kepuasan) {
        // Jika ada opsi jawaban yang dipilih
        if (!empty($tingkat_kepuasan)) {
            // Sisipkan data ke dalam tabel t_jawaban_dosen
            $sql = "INSERT INTO t_jawaban_mahasiswa (soal_id, jawaban) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $soal_id, $tingkat_kepuasan);
            $stmt->execute();
        }
    }
    echo "Data survei berhasil disimpan ke dalam tabel t_jawaban_mahasiswa.";
} else {
    echo "Metode pengiriman data tidak valid atau tidak ada data yang dikirimkan.";
}

// Tutup koneksi
$conn->close();
?>
