<?php
session_start();

//Pengecekan dia itu udah login apa nggak, klo blum balik ke index.php
if (!isset($_SESSION["nama"]))
{
header("location: index.php");
}
?>

<?php

$_SESSION['survey_id'] = 7; // Atur nilai yang sesuai dengan data di tabel m_survey
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
            <h1 class="m-0">Informasi Orangtua</h1>
          </div>
          <div class="col-sm-6">
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Informasi Orangtua</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <form action="submit_data_ortu.php" method="POST">
                  <div class="form-group">
                    <label for="Tanggal">Tanggal</label>
                    <input type="date" class="form-control" name="Tanggal" id="Tanggal" placeholder="Tanggal" required>
                  </div>

                  <div class="form-group">
                    <label for="Nama">Nama</label>
                    <input type="text" class="form-control" name="Nama" id="Nama" placeholder="Nama" required>
                  </div>

                  <div class="form-group">
                    <label for="JK">Jenis Kelamin</label>
                    <input type="text" class="form-control" name="JK" id="JK" placeholder="Jenis Kelamin" required>
                  </div>

                  <div class="form-group">
                    <label for="Umur">Umur</label>
                    <input type="number" class="form-control" name="Umur" id="Umur" placeholder="Umur" required>
                  </div>
                
                  <div class="form-group">
                    <label for="Nomer">Nomor Hp</label>
                    <input type="text" class="form-control" name="Nomer" id="Nomer" placeholder="Nomor Hp" required>
                  </div>

                  <div class="form-group">
                    <label for="Pendidikan">Pendidikan</label>
                    <input type="text" class="form-control" name="Pendidikan" id="Pendidikan" placeholder="Pendidikan" required>
                  </div>

                  <div class="form-group">
                    <label for="Pekerjaan">Pekerjaan</label>
                    <input type="text" class="form-control" name="Pekerjaan" id="Pekerjaan" placeholder="Pekerjaan" required>
                  </div>

                  <div class="form-group">
                    <label for="Penghasilan">Penghasilan</label>
                    <input type="text" class="form-control" name="Penghasilan" id="Penghasilan" placeholder="Penghasilan" required>
                  </div>

                  <div class="form-group">
                    <label for="NIM_Mahasiswa">NIM Mahasiswa</label>
                    <input type="text" class="form-control" name="NIM_Mahasiswa" id="NIM_Mahasiswa" placeholder="NIM Mahasiswa" required>
                  </div>

                  <div class="form-group">
                    <label for="Nama_Mahasiswa">Nama Mahasiswa</label>
                    <input type="text" class="form-control" name="Nama_Mahasiswa" id="Nama_Mahasiswa" placeholder="Nama Mahasiswa" required>
                  </div>
                
                  <div class="form-group">
                    <label for="Prodi_Mahasiswa">Prodi Mahasiswa</label>
                    <input type="text" class="form-control" name="Prodi_Mahasiswa" id="Prodi_Mahasiswa" placeholder="Prodi Mahasiswa" required>
                  </div>

                  <div class="card-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>

 <?php include "footer.php"; ?>

</div>

<!-- REQUIRED SCRIPTS -->
<script src="app/plugins/jquery/jquery.min.js"></script>
<script src="app/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="app/dist/js/adminlte.min.js"></script>
</body>
</html>
