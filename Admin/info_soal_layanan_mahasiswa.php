<?php
session_start();

//Pengecekan dia itu udah login apa nggak, klo blum balik ke index.php
if (!isset($_SESSION["nama"])) {
    header("location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Survey kepuasan pelanggan Polinema</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../app/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../app/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include "../navbar.php"; ?>
        <?php include "sidebar2.php"; ?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Informasi Soal Layanan Mahasiswa</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Layanan</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method='post' action='hapus_soal.php' id='surveyForm'>
                                        <table class='table table-striped'>
                                            <thead class='judul-table'>
                                                <tr>
                                                    <th scope='col'>Soal</th>
                                                    <th scope='col'>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id='surveyBody'>
                                                <?php

                                                include '../koneksi/koneksi.php';

                                                $sql = "SELECT * FROM m_survey_soal WHERE kategori_id = 1";
                                                $result = $conn->query($sql);
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<tr>";
                                                        echo "<td>" . $row['soal_nama'] . "</td>";
                                                        echo "<td>";
                                                        echo "<input type='hidden' name='soal_id' value='" . $row['soal_id'] . "'>";
                                                        echo "<button type='submit' name='hapus' class='btn btn-danger remove-level'>Hapus</button>";
                                                        echo "</td>";
                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='2'>Tidak ada data.</td></tr>";
                                                }
                                                $conn->close();
                                                ?>
                                            </tbody>
                                        </table>
                                        <a href='tambah_soal.php' class='btn btn-primary'>Tambah</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "../footer.php"; ?>
    </div>

    <script src="../app/plugins/jquery/jquery.min.js"></script>
    <script src="../app/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../app/dist/js/adminlte.min.js"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.remove-level', function () {
                return confirm('Apakah Anda yakin ingin menghapus soal ini?');
            });
        });
    </script>
</body>

</html>