<?php
session_start();

//Pengecekan dia itu udah login apa nggak, klo blum balik ke index.php
if (!isset($_SESSION["nama"]))
{
header("location: index.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Survey Kepuasan Pelanggan Polinema</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="app/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="app/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include "navbar.php"; ?>
        <?php include "sidebar_ortu.php"; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Tambah Soal</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Tambah Kategori</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">

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
                                        die("Koneksi gagal: " . $conn->connect_error);
                                    }

                                    // Ambil data survey_id
                                    $resultSurvey = $conn->query("SELECT survey_id, survey_nama FROM m_survey");
                                    $surveys = $resultSurvey->fetch_all(MYSQLI_ASSOC);

                                    // Ambil data kategori_id
                                    $resultKategori = $conn->query("SELECT kategori_id, kategori_nama FROM m_kategori");
                                    $kategoris = $resultKategori->fetch_all(MYSQLI_ASSOC);
                                    ?>

<form action="submit_tambah_soal.php" method="POST">
    <div class="form-group">
        <label for="survey_id">Pilih Survey</label>
        <select class="form-control" name="survey_id" id="survey_id" required>
            <?php foreach ($surveys as $survey) : ?>
                <option value="<?= htmlspecialchars($survey['survey_id']) ?>"><?= htmlspecialchars($survey['survey_nama']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="kategori_id">Pilih Kategori </label>
        <select class="form-control" name="kategori_id" id="kategori_id" required>
            <?php foreach ($kategoris as $kategori) : ?>
                <option value="<?= htmlspecialchars($kategori['kategori_id']) ?>"><?= htmlspecialchars($kategori['kategori_nama']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="soalNama">Pertanyaan</label>
        <input type="text" class="form-control" name="soal_nama" id="soalNama" placeholder="Pertanyaan" required>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
</form>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>

                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <?php include "footer.php"; ?>

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="app/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="app/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="app/dist/js/adminlte.min.js"></script>
</body>

</html>
