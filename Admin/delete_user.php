<?php

include '../koneksi/koneksi.php';

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}

// Ambil ID user yang akan dihapus
$id = $_POST['id'];

// Periksa apakah ID adalah angka
if (is_numeric($id)) {
    // Mulai transaksi
    $conn->begin_transaction();

    try {
        // Hapus baris terkait dari tabel m_survey_soal yang mengacu pada m_survey
        $stmt_survey_soal = $conn->prepare("DELETE FROM m_survey_soal WHERE survey_id IN (SELECT survey_id FROM m_survey WHERE user_id = ?)");
        $stmt_survey_soal->bind_param("i", $id);
        $stmt_survey_soal->execute();
        $stmt_survey_soal->close();

        // Hapus baris terkait dari tabel m_survey
        $stmt_survey = $conn->prepare("DELETE FROM m_survey WHERE user_id = ?");
        $stmt_survey->bind_param("i", $id);
        $stmt_survey->execute();
        $stmt_survey->close();

        // Hapus user dari tabel m_user
        $stmt_user = $conn->prepare("DELETE FROM m_user WHERE user_id = ?");
        $stmt_user->bind_param("i", $id);
        $stmt_user->execute();
        $stmt_user->close();

        // Commit transaksi
        $conn->commit();

        echo "User berhasil dihapus.";
    } catch (Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        $conn->rollback();

        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID tidak valid.";
}

// Tutup koneksi
$conn->close();
?>
