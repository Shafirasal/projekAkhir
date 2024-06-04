<?php
require_once 'config.php';
require_once 'database.php';
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
  <!-- Font Awesome -->
  <link rel="stylesheet" href="app/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="app/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="app/dist/css/adminlte.min.css">
  <!-- link bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <h5><b>survey kepuasan pelanggan polinema</b></h5>
      </div>
      <div class="card-body">

        <form method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Username" name="username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <select class="form-select" aria-label="Default select example" name="user_type">
                  <option selected>Login Sebagai</option>
                  <option value="Admin">Admin</option>
                  <option value="Dosen">Dosen</option>
                  <option value="Tendik">Tendik</option>
                  <option value="Mahasiswa">Mahasiswa</option>
                  <option value="Alumni">Alumni</option>
                  <option value="Ortu">Ortu</option>
                  <option value="Industri">Industri</option>
                </select>

              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Log In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <!-- /.social-auth-links -->
        <p class="mb-1">
          <a href="forgot-password.php">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="register.php" class="text-center">Register a new account</a>
        </p>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="app/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap  -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  <!-- AdminLTE App -->
  <script src="app/dist/js/adminlte.mi.js"></script>
</body>

</html>

<?php
session_start();
$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "projek_akhir";

// Buat koneksi
$conn = new mysqli($servername, $username_db, $password_db, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan data yang dikirimkan dari JavaScript
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $user_status = isset($_POST['user_type']) ? $_POST['user_type'] : '';

    if(empty($username) || empty($password) || empty($user_status)) {
        echo "Please fill in all fields.";
        exit;
    }

    $user_status = str_replace('-', ' ', $user_status);

    // Melindungi dari SQL Injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $user_status = mysqli_real_escape_string($conn, $user_status);

    // Mencari pengguna dengan username tertentu di database
    $sql = "SELECT * FROM m_user WHERE username = '$username' AND level = '$user_status'";
    $result = $conn->query($sql);

    // Periksa apakah username dan password cocok
    if ($result->num_rows > 0) {
        // Pengguna ditemukan, ambil data dari database
        $row = $result->fetch_assoc();
        
        // Periksa apakah password yang dimasukkan sesuai dengan password di database
        if ($password === $row['password']) {
            // Password cocok, login berhasil

            // Check if the user belongs to the correct user type
            session_start(); // Memulai sesi
            $_SESSION['username'] = $username; // Simpan username ke sesi
            $_SESSION['user_type'] = $user_status; // Simpan user_status ke sesi
            $_SESSION['nama'] = $row['nama']; // simpan nama user ke sesi
            $_SESSION['user_id'] = $row['user_id']; // simpan user_id ke sesi
            
            switch ($user_status) {
                case 'Mahasiswa':
                    header("Location: dashboard.php");
                    break;
                case 'Dosen':
                    header("Location: dashboard_dosen.php");
                    break;
                case 'Admin':
                    header("Location: adminDash.php");
                    break;
                case 'Ortu':
                    header("Location: dashboard_ortu.php");
                    break;
                case 'Alumni':
                    header("Location: dashboard_alumni.php");
                    break;
                case 'Industri':
                    header("Location: dashboard_industri.php");
                    break;
                case 'Tendik':
                    header("Location: dashboard_tendik.php");
                    break;
                default:
                    echo "user_not_found";
                    break;
            }
            exit();
        } else {
            // Password salah
            echo "wrong_password";
        }
    } else {
        // Pengguna tidak ditemukan
        echo "user_not_found";
    }
}

$conn->close();
?>
