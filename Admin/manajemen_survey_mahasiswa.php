<?php
session_start();

// Pengecekan apakah pengguna sudah login atau belum, jika belum arahkan ke index.php
if (!isset($_SESSION["nama"])) {
    header("location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Survey Kepuasan Pelanggan Polinema</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../app/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../app/dist/css/adminlte.min.css">
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

        <?php include "../navbar.php"; ?>
        <?php include "sidebar2.php"; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Manajemen Survey</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6"></div><!-- /.col -->
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
                                    <h3 class="card-title">Kategori Survey Mahasiswa</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama Kategori</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                include '../koneksi/koneksi.php';

                                                // Query SQL untuk mengambil kategori_id dan kategori_nama
                                                $sql = "SELECT DISTINCT m_kategori.kategori_id, m_kategori.kategori_nama
                                                        FROM m_survey_soal 
                                                        JOIN m_kategori ON m_survey_soal.kategori_id = m_kategori.kategori_id 
                                                        WHERE m_survey_soal.kategori_id IN (1, 2, 3)";
                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                    $no = 1;
                                                    while ($row = $result->fetch_assoc()) {
                                                        $infoSoalLink = '#';
                                                        switch ($row['kategori_nama']) {
                                                            case 'Layanan Mahasiswa':
                                                                $infoSoalLink = 'info_soal_layanan_mahasiswa.php?kategori_id=' . htmlspecialchars($row['kategori_id']);
                                                                break;
                                                            case 'Fasilitas Mahasiswa':
                                                                $infoSoalLink = 'info_soal_fasilitas_mahasiswa.php?kategori_id=' . htmlspecialchars($row['kategori_id']);
                                                                break;
                                                            case 'Akademik Mahasiswa':
                                                                $infoSoalLink = 'info_soal_akademik_mahasiswa.php?kategori_id=' . htmlspecialchars($row['kategori_id']);
                                                                break;
                                                        }
                                                        echo "<tr>";
                                                        echo "<td>" . $no++ . ".</td>";
                                                        echo "<td>" . htmlspecialchars($row['kategori_nama']) . "</td>";
                                                        echo '<td>
                                                            <a href="' . $infoSoalLink . '" class="btn btn-success">Info Soal</a>
                                                            <button type="button" class="btn btn-danger" onclick="deleteKategori(' . htmlspecialchars($row['kategori_id']) . ')">Hapus</button>
                                                          </td>';
                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='3'>Tidak ada data.</td></tr>";
                                                }

                                                $conn->close();
                                                ?>
                                            </tbody>
                                        </table>
                                        <div class="card-footer">
                                            <a href="tambah_kategori.php" class="btn btn-primary">Tambah kategori</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>

        <?php include "../footer.php"; ?>

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <script src="../app/plugins/jquery/jquery.min.js"></script>
    <script src="../app/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../app/dist/js/adminlte.min.js"></script>
</body>

</html>

<script>
    function deleteKategori(id) {
        if (confirm("Apakah anda yakin ingin menghapus kategori ini?")) {
            let formData = new FormData();
            formData.append('id', id);

            fetch('hapus_survey_mahasiswa.php', {
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