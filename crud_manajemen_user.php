<?php
require_once 'Database.php';

class Crud
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Create
    public function create($username, $nama_lengkap, $password, $level)
    {
        $query = "INSERT INTO m_user (username, nama_lengkap, password, level) VALUES ('$username', '$nama_lengkap', '$password', '$level')";
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

    // Update
    public function update($id, $username, $nama_lengkap, $password, $level)
    {
        $query = "UPDATE m_user SET username = '$username', nama_lengkap = '$nama_lengkap', password = '$password', level = '$level' WHERE user_id = $id";
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