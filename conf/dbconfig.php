<?php

try {
    $con = new PDO('mysql:host=localhost;dbname=projek_akhir', 'root', '', array(PDO::ATTR_PERSISTENT => true));
} catch (PDOException $e) {
    echo $e->getMessage();
}

include_once 'auth.php';

$user = new auth($con);
?>