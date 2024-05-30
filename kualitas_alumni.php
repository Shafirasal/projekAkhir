<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Survey kepuasan pelanggan Polinema</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="app/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="app/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include "navbar.php"; ?>

        <?php include "sidebar_alumni.php"; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">akademik</h1>
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
                                    <h3 class="card-title">Layanan</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">

                                    <table class="table">
                                        <thead>
                                            <tr>

                                            </tr>
                                        </thead>
                                        <tbody>

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

                                            // Query untuk mengambil data dari tabel m_survey_soal dengan kategori_id 1
                                            $sql = "SELECT * FROM m_survey_soal WHERE kategori_id = 11";
                                            $result = $conn->query($sql);

                                            // Tampilkan data dalam tabel HTML
                                            if ($result->num_rows > 0) {
                                                echo "<form method='post' action='submit_survey.php'>"; // Form untuk submit survey
                                                echo "<table class='table table-striped'>";
                                                echo "<thead class='judul-table'>";
                                                echo "<tr>";
                                                echo "<th scope='col'>Soal</th>";
                                                echo "<th scope='col'>Tingkat Kepuasan</th>";
                                                echo "</tr>";
                                                echo "</thead>";
                                                echo "<tbody>";
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row['soal_nama'] . "</td>";
                                                    echo "<td>";
                                                    // Buat radio button untuk setiap tingkat kepuasan
                                                    for ($i = 1; $i <= 4; $i++) {
                                                        echo "<label><input type='radio' name='tingkat_kepuasan[" . $row['soal_id'] . "]' value='$i'>$i</label>";
                                                    }
                                                    echo "</td>";
                                                    echo "</tr>";
                                                }
                                                echo "</tbody>";
                                                echo "</table>";
                                                echo "<button type='submit' class='btn btn-primary'>Submit</button>"; // Tombol submit
                                                echo "</form>";
                                            } else {
                                                echo "Tidak ada data.";
                                            }

                                            // Tutup koneksi
                                            $conn->close();
                                            ?>


                                        </tbody>
                                    </table>


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