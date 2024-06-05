<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hapus'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "projek_akhir";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Koneksi Gagal: " . $conn->connect_error);
    }
    
    $soal_id = $_POST['soal_id'];
    
    $sql = "DELETE FROM m_survey_soal WHERE soal_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $soal_id);
    

    $stmt->close();
    $conn->close();
} else {
    header("Location: index.php");
    exit();
}
?>
