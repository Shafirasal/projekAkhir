<?php
session_start();
// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["nama"])) {
    header("location: ../index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $level = $_POST['level'];

    include '../koneksi/koneksi.php';

    // Insert data into database
    $sql = "INSERT INTO m_user (username, password, nama, email, level) VALUES ('$username', '$password', '$nama', '$email', '$level')";

    if ($conn->query($sql) === TRUE) {
        echo "User sudah ditambahkan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
