<?php
session_start();

//Pengecekan dia itu udah login apa nggak, klo blum balik ke index.php
if (!isset($_SESSION["nama"]))
{
header("location: index.php");
}
?>

<?php
$_SESSION['survey_id'] = 8; // Atur nilai yang sesuai dengan data di tabel m_survey
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Survey kepuasan pelanggan Polinema</title>

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

<?php include "sidebar_tendik.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Informasi Tendik</h1>
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
                <h3 class="card-title">Informasi Tendik</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <!-- Form mulai di sini -->
                <form action="submit_data_tendik.php" method="POST">
                  <div class="form-group">
                    <label for="Tanggal">Tanggal</label>
                    <input type="date" class="form-control" name="Tanggal" id="Tanggal" placeholder="Tanggal">
                  </div>
                  
                  <div class="form-group">
                    <label for="No">No pegawai</label>
                    <input type="number" class="form-control" name="No" id="No" placeholder="No">
                  </div>

                  <div class="form-group">
                    <label for="Nama">Nama</label>
                    <input type="text" class="form-control" name="Nama" id="Nama" placeholder="Nama">
                  </div>

                  <div class="form-group">
                    <label for="unit">Unit</label>
                    <input type="text" class="form-control" name="unit" id="unit" placeholder="Unit">
                  </div>

                  <div class="card-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                  </div>
                </form>
                <!-- Form selesai di sini -->
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
