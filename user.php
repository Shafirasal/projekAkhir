<?php
include 'Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function editUser($id, $username, $namaLengkap, $level) {
        $sql = "UPDATE m_user SET username = ?, nama_lengkap = ?, level = ? WHERE user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sssi", $username, $namaLengkap, $level, $id);

        if ($stmt->execute()) {
            echo "User updated successfully.";
        } else {
            echo "Error updating user: " . $this->db->error;
        }
    }

    public function deleteUser($id) {
        $sql = "DELETE FROM m_user WHERE user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "User deleted successfully.";
        } else {
            echo "Error deleting user: " . $this->db->error;
        }
    }

    public function getUsers() {
        $sql = "SELECT user_id, username, nama_lengkap, level FROM m_user";
        $result = $this->db->query($sql);
        return $result;
    }
}
?>
