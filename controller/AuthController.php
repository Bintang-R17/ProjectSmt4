<?php
require_once __DIR__ . '/../autoload/autoloads.php';

startSession();
class AuthController {
    public function loginForm() {
        require __DIR__ . '/../view/login/index.php';    
    }
    public function loginProcess() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = new User();
        if ($user->login($username, $password)) {
            // Simpan ke session
            $_SESSION['user_id'] = $user->id;
            $_SESSION['username'] = $user->username;
            $_SESSION['role'] = $user->role;
            $_SESSION['nama_lengkap'] = $user->nama_lengkap;

            // Arahkan ke dashboard sesuai role
            switch ($user->role) {
                case 'admin':
                    header("Location: index.php?page=dashboard-admin");
                    break;
                case 'dokter':
                    header("Location: index.php?page=dashboard-dokter");
                    break;
                case 'pasien':
                    header("Location: index.php?page=dashboard-pasien");
                    break;
                case 'petugas':
                    header("Location: index.php?page=dashboard-petugas");
                    break;
                default:
                    echo "Role tidak dikenali.";
                    break;
            }
        } else {
            echo "Username atau password salah.";
        }
    }
    
    public function logout() {
        startSession();             // Mulai session jika belum dimulai
        session_unset();           // Hapus semua variabel session
        session_destroy();         // Hancurkan session
        header("Location: index.php?page=login");  // Redirect ke halaman login
        exit();
    }
}
?>
