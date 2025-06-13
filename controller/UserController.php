<?php 
require_once __DIR__ . '/../autoload/autoloads.php';
class UserController {
    public function registerForm() {
        require __DIR__ . '/../view/admin/create/petugas.php';
    }

    public function registerProcess()
    {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user = new User;
        $user->username = $_POST['username'];
        $user->password = $_POST['password'];
        $user->nama_lengkap = $_POST['nama_lengkap'];
        $user->role = $_POST['role'];

        if ($user->create()) {
            // Simpan ID user terakhir ke session untuk dipakai di step berikutnya
            $_SESSION['register_user_id'] = $user->id;
            $_SESSION['register_role'] = $user->role;

            // Redirect ke form sesuai role
            switch ($user->role) {
                case 'dokter':
                    header('Location: view/admin/create/dokter.php');
                    break;
                case 'petugas':
                    header('Location: view/admin/create/petugas.php');
                    break;
                case 'pasien':
                    header('Location: view/admin/create/pasien.php');
                    break;
                default:
                    echo "Role tidak dikenali.";
            }
            exit;
        } else {
            echo "Gagal mendaftarkan user.";
        }
    } else {
        // Tampilkan form register umum
        require_once __DIR__ . '/../view/register.php';
        }
    }

    public function showUser(){
        if (!isset($_GET['id'])) {
            echo "ID user tidak ditemukan.";
            return;
        }

        $user = new User;
        $user->id = $_GET['id'];
        $user->readOne();

        if ($user->username) {
            require __DIR__ . '/../view/admin/update/user.php';
        } else {
            echo "User tidak ditemukan.";
        }
    }
    public function updateUser() {
    

    $user = new User;
    $user->id = $_POST['id'];
    $user->username = $_POST['username'];
    $user->nama_lengkap = $_POST['nama_lengkap'];
    $user->role = $_POST['role'];

    if ($user->update()) {
        header('Location: index.php?page=dashboard-admin&status=success');
        exit;
    } else {
        header('Location: index.php?page=dashboard-admin&status=error');
        exit;
        }
    }

    public function deleteUser() {
        if (!isset($_GET['id'])) {
            echo "ID user tidak ditemukan.";
            return;
        }

        $user = new User;
        $user->id = $_GET['id'];

        if ($user->delete()) {
            header('Location: index.php?page=dashboard-admin&status=deleted');
            exit;
        } else {
            echo "Gagal menghapus user.";
        }
    }

    public function manageUser(){
        require __DIR__ . '/../view/admin/manage/dokter.php';
    }
    
}
?>