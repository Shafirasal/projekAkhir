<?php
session_start();

//Pengecekan dia itu udah login apa nggak, klo blum balik ke index.php
if (!isset($_SESSION["nama"]))
{
header("location: index.php");
}
?>

<?php
$_SESSION['survey_id'] = 9; // Atur nilai yang sesuai dengan data di tabel m_survey
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
<?php include "sidebar_industri.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Informasi Industri</h1>
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
                <h3 class="card-title">Informasi Industri</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                <form action="submit_data_industri.php" method="POST">
                  <div class="form-group">
                    <label for="Tanggal">Tanggal</label>
                    <input type="date" class="form-control" name="Tanggal" id="Tanggal" placeholder="Tanggal">
                  </div>

                  <div class="form-group">
                    <label for="Nama">Nama</label>
                    <input type="text" class="form-control" name="Nama" id="Nama" placeholder="Nama">
                  </div>

                  <div class="form-group">
                    <label for="Jabatan">Jabatan</label>
                    <input type="text" class="form-control" name="Jabatan" id="Jabatan" placeholder="Jabatan">
                  </div>

                  <div class="form-group">
                    <label for="Perusahaan">Perusahaan</label>
                    <input type="text" class="form-control" name="Perusahaan" id="Perusahaan" placeholder="Perusahaan">
                  </div>

                  <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="email" class="form-control" name="Email" id="Email" placeholder="Email">
                  </div>
                
                  <div class="form-group">
                    <label for="Nomer">Nomor HP</label>
                    <input type="number" class="form-control" name="Nomer" id="Nomer" placeholder="Nomor HP">
                  </div>

                  <div class="form-group">
                    <label for="Kota">Kota</label>
                    <input type="text" class="form-control" name="Kota" id="Kota" placeholder="Kota">
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
    </div><!-- /.content -->
  </div><!-- /.content-wrapper -->

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
