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
    <style>
        a {
            color: white;
            text-decoration: none;
        }

        a:hover {
            color: white;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include "navbar.php"; ?>
        <?php include "sidebar2.php"; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Manajemen Survey</h1>
                        </div>
                        <div class="col-sm-6"></div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Manajemen Survey</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Jenis Survey</th>
                                                    <th>Nama Survey</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Koneksi ke database
                                                $koneksi = mysqli_connect("localhost", "root", "", "projek_akhir");

                                                // Periksa koneksi
                                                if (mysqli_connect_error()) {
                                                    echo "Koneksi database gagal: " . mysqli_connect_error();
                                                    exit();
                                                }

                                                // Query untuk mengambil data survey
                                                $query = "SELECT survey_id, survey_jenis, survey_nama FROM m_survey";
                                                $result = mysqli_query($koneksi, $query);

                                                $no = 1;
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    // Menentukan tautan berdasarkan jenis survei
                                                    $link = '';
                                                    if ($row['survey_jenis'] == 'alumni') {
                                                        $link = 'manajemen_survey_alumni.php';
                                                    } elseif ($row['survey_jenis'] == 'dosen') {
                                                        $link = 'manajemen_survey_dosen.php';
                                                    } elseif ($row['survey_jenis'] == 'mahasiswa') {
                                                        $link = 'manajemen_survey_mahasiswa.php';
                                                    } elseif ($row['survey_jenis'] == 'orang tua') {
                                                        $link = 'manajemen_survey_ortu.php';
                                                    } elseif ($row['survey_jenis'] == 'tendik') {
                                                        $link = 'manajemen_survey_tendik.php';
                                                    } elseif ($row['survey_jenis'] == 'industri') {
                                                        $link = 'manajemen_survey_lulusan.php';
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $no++; ?></td>
                                                        <td><?php echo htmlspecialchars($row['survey_jenis']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['survey_nama']); ?></td>
                                                        <td>
                                                            <a href="<?php echo $link; ?>" class="btn btn-success">Info Survey</a>
                                                            <button type="button" class="btn btn-danger" onclick="deleteSurvey(<?php echo $row['survey_id']; ?>)">Hapus</button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary"><a href="tambah_survey.php">Tambah Survey</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
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
    <script src="app/plugins/jquery/jquery.min.js"></script>
    <script src="app/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="app/dist/js/adminlte.min.js"></script>

    <script>
        function deleteSurvey(id) {
            if (confirm("Apakah anda yakin ingin menghapus survey ini?")) {
                let formData = new FormData();
                formData.append('id', id);

                fetch('hapus_survey.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    location.reload();
                });
            }
        }
    </script>
</body>

</html>

<?php
// Tutup koneksi
mysqli_close($koneksi);
?>
