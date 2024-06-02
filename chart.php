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
  <!-- chart -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
              <h1 class="m-0">Laporan Chart</h1>
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
                  <h3 class="card-title">Laporan chart</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 mb-4">

                      <div style="width: 100%;">
                        <canvas id="chartDosen"></canvas>
                      </div>
                    </div>
                    <div class="col-md-6 mb-4">         
                      <div style="width: 100%;">
                        <canvas id="chartMahasiswa"></canvas>
                      </div>
                    </div>
                    <div class="col-md-6 mb-4">  
                      <div style="width: 100%;">
                        <canvas id="chartOrtu"></canvas>
                      </div>
                    </div>
                    <div class="col-md-6 mb-4">  
                      <div style="width: 100%;">
                        <canvas id="chartIndustri"></canvas>
                      </div>
                    </div>
                    <div class="col-md-6 mb-4">       
                      <div style="width: 100%;">
                        <canvas id="chartTendik"></canvas>
                      </div>
                    </div>
                    <div class="col-md-6 mb-4">
                      <div style="width: 100%;">
                        <canvas id="chartAlumni"></canvas>
                      </div>
                    </div>
                  </div>

                  <?php
                  // Connect to database
                  $conn = new mysqli("localhost", "root", "", "projek_akhir");

                  // Check connection
                  if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                  }

                  // Function to get data from a table
                  function getJawabanData($conn, $table) {
                    $sql = "SELECT jawaban FROM $table";
                    $result = $conn->query($sql);

                    $jawaban = [];
                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                        $jawaban[] = $row['jawaban'];
                      }
                    }
                    return $jawaban;
                  }

                  // Get data from all tables
                  $jawabanDosen = getJawabanData($conn, 't_jawaban_dosen');
                  $jawabanMahasiswa = getJawabanData($conn, 't_jawaban_mahasiswa');
                  $jawabanOrtu = getJawabanData($conn, 't_jawaban_ortu');
                  $jawabanIndustri = getJawabanData($conn, 't_jawaban_industri');
                  $jawabanTendik = getJawabanData($conn, 't_jawaban_tendik');
                  $jawabanAlumni = getJawabanData($conn, 't_jawaban_alumni');

                  $conn->close();
                  ?>

                  <script>
                    // Data from PHP
                    const jawabanDosen = <?php echo json_encode($jawabanDosen); ?>;
                    const jawabanMahasiswa = <?php echo json_encode($jawabanMahasiswa); ?>;
                    const jawabanOrtu = <?php echo json_encode($jawabanOrtu); ?>;
                    const jawabanIndustri = <?php echo json_encode($jawabanIndustri); ?>;
                    const jawabanTendik = <?php echo json_encode($jawabanTendik); ?>;
                    const jawabanAlumni = <?php echo json_encode($jawabanAlumni); ?>;

                    // Function to count occurrences of each answer
                    function countOccurrences(arr) {
                      const counts = [0, 0, 0, 0]; // For answers 1 to 4
                      arr.forEach(num => {
                        if (num >= 1 && num <= 4) {
                          counts[num - 1]++;
                        }
                      });
                      return counts;
                    }

                    // Count the occurrences of each answer for all datasets
                    const countsDosen = countOccurrences(jawabanDosen);
                    const countsMahasiswa = countOccurrences(jawabanMahasiswa);
                    const countsOrtu = countOccurrences(jawabanOrtu);
                    const countsIndustri = countOccurrences(jawabanIndustri);
                    const countsTendik = countOccurrences(jawabanTendik);
                    const countsAlumni = countOccurrences(jawabanAlumni);

                    // Function to create chart
                    function createChart(chartId, chartLabel, chartData) {
                      const data = {
                        labels: ['1', '2', '3', '4'],
                        datasets: [{
                          label: chartLabel,
                          data: chartData,
                          backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)'
                          ],
                          borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)'
                          ],
                          borderWidth: 1
                        }]
                      };

                      const config = {
                        type: 'pie',
                        data: data,
                        options: {
                          responsive: true,
                          plugins: {
                            legend: {
                              position: 'top',
                            },
                            tooltip: {
                              callbacks: {
                                label: function (tooltipItem) {
                                  let label = tooltipItem.label || '';
                                  if (label) {
                                    label += ': ';
                                  }
                                  label += Math.round(tooltipItem.raw * 100 / tooltipItem.chart.data.datasets[0].data.reduce((a, b) => a + b, 0));
                                  label += '%';
                                  return label;
                                }
                              }
                            },
                            title: {
                              display: true,
                              text: chartLabel
                            }
                          }
                        }
                      };

                      new Chart(document.getElementById(chartId), config);
                    }

                    // Create charts
                    createChart('chartDosen', 'Jawaban Dosen', countsDosen);
                    createChart('chartMahasiswa', 'Jawaban Mahasiswa', countsMahasiswa);
                    createChart('chartOrtu', 'Jawaban Orang Tua', countsOrtu);
                    createChart('chartIndustri', 'Jawaban Industri', countsIndustri);
                    createChart('chartTendik', 'Jawaban Tenaga Pendidik', countsTendik);
                    createChart('chartAlumni', 'Jawaban Alumni', countsAlumni);
                  </script>

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
