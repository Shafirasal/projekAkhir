<!DOCTYPE html>
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
    <style>
        a {
            color: white;
            text-decoration: none;
        }

        a :hover {
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
                            <h1 class="m-0">Manajemen User</h1>
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
                                    <h3 class="card-title">Manajemen User</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i></button>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    
                                    <?php
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

                                    // Query untuk mengambil data dari tabel users
                                    $sql = "SELECT user_id, username, nama_lengkap, password, level FROM m_user";
                                    $result = $conn->query($sql);

                                    // Tampilkan data dalam tabel HTML
                                    if ($result->num_rows > 0) {
                                        echo "<table class='table table-striped'>";
                                        echo "<thead>";
                                        echo "<tr>";
                                        echo "<th>No</th>";
                                        echo "<th>Username</th>";
                                        echo "<th>Nama Lengkap</th>";
                                        echo "<th>Password</th>";
                                        echo "<th>Level</th>";
                                        echo "<th>Aksi</th>";
                                        echo "</tr>";
                                        echo "</thead>";
                                        echo "<tbody>";
                                        $no = 1;
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $no++ . "</td>";
                                            echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['nama_lengkap']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['password']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['level']) . "</td>";
                                            echo "<td>";
                                            echo "<button class='btn btn-success' onclick='editUser(" . $row['user_id'] . ")'>Edit</button> ";
                                            echo "<button class='btn btn-danger' onclick='deleteUser(" . $row['user_id'] . ")'>Hapus</button>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                        echo "</tbody>";
                                        echo "</table>";
                                    } else {
                                        echo "Tidak ada data.";
                                    }

                                    // Tutup koneksi
                                    $conn->close();
                                    ?>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary"><a href="admin_tambah.php">Tambah User</a></button>
                                    </div>
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

    <script>
        function editUser(id) {
            let username = prompt("Enter new username:");
            let nama_lengkap = prompt("Enter new nama lengkap:");
            let password = prompt("Enter new password:");
            let level = prompt("Enter new level:");

            if (username && nama_lengkap && level && password) {
                let formData = new FormData();
                formData.append('id', id);
                formData.append('username', username);
                formData.append('nama_lengkap', nama_lengkap);
                formData.append('level', level);
                formData.append('password', password);

                fetch('edit_user.php', {
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

        function deleteUser(id) {
            if (confirm("Are you sure you want to delete this user?")) {
                let formData = new FormData();
                formData.append('id', id);

                fetch('delete_user.php', {
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