<?php

include '../koneksi/koneksi.php';

// Ambil data dari request
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Buat query untuk menghapus kategori
    $sql = "DELETE FROM m_kategori WHERE kategori_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Kategori berhasil dihapus.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Tutup koneksi
    $stmt->close();
}

$conn->close();
?>
