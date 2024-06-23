<?php
session_start();

// Pengecekan dia itu udah login apa nggak, klo blum balik ke index.php
if (!isset($_SESSION["nama"])) {
    header("location: ../index.php");
    exit();
}
?>

<?php
require_once 'database.php';

class Crud
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Create
    public function create($username, $email, $nama, $password, $level)
    {
        $query = "INSERT INTO m_user (username, email, nama, password, level) VALUES ('$username', '$email','$nama', '$password', '$level')";
        return $this->db->conn->query($query);
    }

    // Read
    public function read()
    {
        $query = "SELECT * FROM m_user";
        $result = $this->db->conn->query($query);

        $data = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    // Read By Id
    public function readById($id)
    {
        $query = "SELECT * FROM m_user WHERE user_id = $id";
        $result = $this->db->conn->query($query);
        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    // Read By Username or Email
    public function readByUsername($username, $email)
    {
        $query = "SELECT * FROM m_user WHERE username = '$username' OR email = '$email'";
        $result = $this->db->conn->query($query);
        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    // Update
    public function update($id, $username, $password, $level)
    {
        $query = "UPDATE m_user SET username = '$username', password = '$password', level = '$level' WHERE user_id = $id";
        return $this->db->conn->query($query);
    }

    // Delete
    public function delete($id)
    {
        $query = "DELETE FROM m_user WHERE user_id = $id";
        return $this->db->conn->query($query);
    }
}
?>
