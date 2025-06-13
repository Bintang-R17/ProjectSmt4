<?php
// models/User.php
require_once __DIR__ . '/../autoload/autoloads.php';
class User {
    protected $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $password;
    public $nama_lengkap;
    public $role;

    public function __construct() {
        $database = new database();
        $this->conn = $database->getConnection();
    }

    // CREATE
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET username=?, password=?, nama_lengkap=?, role=?";
        
        $stmt = $this->conn->prepare($query);
        
        // Hash password
        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
        
        $stmt->bind_param("ssss", 
            $this->username, 
            $hashed_password, 
            $this->nama_lengkap, 
            $this->role
        );

        if($stmt->execute()) {
            $this->id = $this->conn->insert_id;
            return true;
        }
        return false;
    }

    // READ ALL
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $result = $this->conn->query($query);
        return $result;
    }

    // READ ONE
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if($row) {
            $this->username = $row['username'];
            $this->password = $row['password'];
            $this->nama_lengkap = $row['nama_lengkap'];
            $this->role = $row['role'];
            return true;
        }
        return false;
    }

    // UPDATE
    public function update() {
    if (!$this->conn) {
        echo "Koneksi gagal.";
        return false;
    }

    $query = "UPDATE " . $this->table_name . " 
              SET username=?, nama_lengkap=?, role=? 
              WHERE id=?";
    
    $stmt = $this->conn->prepare($query);
    if (!$stmt) {
        echo "Gagal prepare: " . $this->conn->error;
        return false;
    }

    $stmt->bind_param("sssi", 
        $this->username, 
        $this->nama_lengkap, 
        $this->role, 
        $this->id
    );

    return $stmt->execute();
}


    // UPDATE PASSWORD
    public function updatePassword() {
        $query = "UPDATE " . $this->table_name . " 
                  SET password=? 
                  WHERE id=?";
        
        $stmt = $this->conn->prepare($query);
        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt->bind_param("si", $hashed_password, $this->id);

        return $stmt->execute();
    }

    // DELETE
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        
        return $stmt->execute();
    }

    // LOGIN
    public function login($username, $password) {
    $query = "SELECT * FROM " . $this->table_name . " WHERE username = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            $this->id = $row['id'];
            $this->username = $row['username'];
            $this->nama_lengkap = $row['nama_lengkap'];
            $this->role = $row['role'];
            return true;
        }
    }

    return false;
}
    // GET BY ID
    public static function getById($id) {
        global $koneksi;
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = mysqli_prepare($koneksi, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    // GET BY ROLE
    public function getByRole($role) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE role = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $role);
        $stmt->execute();
        
        return $stmt->get_result();
    }

    
}
?>