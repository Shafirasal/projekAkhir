<?php
session_start();
require_once 'config.php';
require_once 'database.php';
require_once 'koneksi/koneksi.php'; // Ensure this includes the database connection

// Initialize error message
$errorMessage = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $user_status = isset($_POST['user_type']) ? $_POST['user_type'] : '';

    if (empty($username) || empty($password) || empty($user_status)) {
        $errorMessage = 'Tolong isi semua kolom.';
    } else {
        $user_status = str_replace('-', ' ', $user_status);

        // Protect against SQL Injection
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);
        $user_status = mysqli_real_escape_string($conn, $user_status);

        // Find the user in the database
        $sql = "SELECT * FROM m_user WHERE username = '$username' AND level = '$user_status'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Check if the password matches
            if ($password === $row['password']) {
                // Successful login
                $_SESSION['username'] = $username;
                $_SESSION['user_type'] = $user_status;
                $_SESSION['nama'] = $row['nama'];
                $_SESSION['user_id'] = $row['user_id'];

                switch ($user_status) {
                    case 'Mahasiswa':
                        header("Location: dashboard.php");
                        break;
                    case 'Dosen':
                        header("Location: dashboard_dosen.php");
                        break;
                    case 'Admin':
                        header("Location: Admin/adminDash.php");
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
                        $errorMessage = 'User type not found';
                        break;
                }
                exit();
            } else {
                // Incorrect password
                $errorMessage = 'Wrong password';
            }
        } else {
            // User not found
            $errorMessage = 'User not found';
        }
    }
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

        <?php if ($errorMessage): ?>
          <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

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
  <script src="app/dist/js/adminlte.min.js"></script>
</body>
</html>
<?php
if (isset($conn)) {
    $conn->close();
}
?>
