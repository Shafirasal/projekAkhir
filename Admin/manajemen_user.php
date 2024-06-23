<?php
session_start();

//Pengecekan dia itu udah login apa nggak, klo blum balik ke index.php
if (!isset($_SESSION["nama"]))
{
header("location: ../index.php");
}
?>

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
    <link rel="stylesheet" href="../app/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../app/dist/css/adminlte.min.css">
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

        <?php include "../navbar.php"; ?>
        
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
                                    
                                    include '../koneksi/koneksi.php';

                                    // Query untuk mengambil data dari tabel users
                                    $sql = "SELECT user_id, username, nama, password, level FROM m_user";
                                    $result = $conn->query($sql);

                                    // Tampilkan data dalam tabel HTML
                                    if ($result->num_rows > 0) {
                                        echo "<table class='table table-striped'>";
                                        echo "<thead>";
                                        echo "<tr>";
                                        echo "<th>No</th>";
                                        echo "<th>Username</th>";
                                        echo "<th>Nama</th>";
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
                                            echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['password']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['level']) . "</td>";
                                            echo "<td>";
                                            echo "<button class='btn btn-success' onclick='showEditModal(" . $row['user_id'] . ")'>Edit</button> ";
                                            echo "<button class='btn btn-danger' onclick='showDeleteModal(" . $row['user_id'] . ")'>Hapus</button>";
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

        <?php include "../footer.php"; ?>
    </div>
    <!-- ./wrapper -->

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editUserForm" method="POST" action="edit_user.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editUserId">
                        <div class="form-group">
                            <label for="editUsername">Username</label>
                            <input type="text" class="form-control" id="editUsername" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="editNama">Nama</label>
                            <input type="text" class="form-control" id="editNama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="editPassword">Password</label>
                            <input type="password" class="form-control" id="editPassword" name="password" required>
                        </div>
                        <div class="form-group">
                             <label for="level">Level</label>
                            <select class="form-control" id="level" name="level">
                            <option value="admin">admin</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete User Modal -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteUserForm" method="POST" action="delete_user.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteUserModalLabel">Hapus User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="deleteUserId">
                        <p>Apakah anda yakin ingin menghapus user ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="../app/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../app/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../app/dist/js/adminlte.min.js"></script>

    <script>
        function showEditModal(id) {
            document.cookie = "action=edit; path=/";
            document.cookie = "userId=" + id + "; path=/";
            $('#editUserModal').modal('show');
        }

        function showDeleteModal(id) {
            document.cookie = "action=delete; path=/";
            document.cookie = "userId=" + id + "; path=/";
            $('#deleteUserModal').modal('show');
        }

        $(document).ready(function() {
            const cookies = document.cookie.split(';').reduce((cookies, cookie) => {
                const [name, value] = cookie.split('=').map(c => c.trim());
                cookies[name] = value;
                return cookies;
            }, {});

            if (cookies.action === 'edit') {
                $('#editUserId').val(cookies.userId);
                $('#editUserModal').modal('show');
            }

            if (cookies.action === 'delete') {
                $('#deleteUserId').val(cookies.userId);
                $('#deleteUserModal').modal('show');
            }

            document.cookie = "action=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "userId=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        });
    </script>
</body>

</html> 