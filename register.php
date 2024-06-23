<?php
require_once 'crud_manajemen_user.php';

$Crud = new Crud();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrasi Sivey Polinema</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="app/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="app/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="app/dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <h1><b>Registrasi Sivey Polinema</b></h1>
    </div>
    <div class="card-body">

      <?php
      // Variable to store success message
      $successMessage = '';

      // Check if form is submitted
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $username = trim($_POST['username']);
          $email = trim($_POST['email']);
          $nama = trim($_POST['nama']);
          $password = trim($_POST['password']);
          $level = trim($_POST['user_type']);
          $terms = isset($_POST['terms']) ? $_POST['terms'] : '';

          // Basic validation
          if (empty($username) || empty($email) || empty($nama) || empty($password) || empty($level) || $terms != 'agree') {
              echo "<div class='alert alert-danger'>Please fill in all fields and agree to the terms.</div>";
          } else {
              // Check if email is valid
              if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  echo "<div class='alert alert-danger'>Invalid email format</div>";
              } else {
                  // Check if username or email already exists
                  $result = $Crud->readByUsername($username, $email);

                  if ($result) {
                      echo "<div class='alert alert-danger'>Username or email already exists.</div>";
                  } else {
                      // Insert user data into database
                      if ($Crud->create($username, $email, $nama, $password, $level)) {
                          $successMessage = "Registration successful!";
                          echo "<div class='alert alert-success'>$successMessage</div>";
                          echo "<script>
                                  setTimeout(function(){
                                    window.location.href = 'index.php';
                                  }, 3000);
                                </script>";
                      } else {
                          echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
                      }
                  }
              }
          }
      }
      ?>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Nama" name="nama" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <select class="form-select" aria-label="Default select example" name="user_type" required>
            <option selected>Login Sebagai</option>
            <option value="Dosen">Dosen</option>
            <option value="Tendik">Tendik</option>
            <option value="Mahasiswa">Mahasiswa</option>
            <option value="Alumni">Alumni</option>
            <option value="Ortu">Ortu</option>
            <option value="Industri">Industri</option>
          </select>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
              <label for="agreeTerms">
                I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
        </div>
      </form>

      <p class="mb-0">
        <a href="index.php" class="text-center">Already have an account</a>
      </p>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="app/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="app/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="app/dist/js/adminlte.min.js"></script>
</body>
</html>
