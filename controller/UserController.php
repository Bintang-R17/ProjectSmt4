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
        $_SESSION['success'] = "Data berhasil diupdate!";
            header("Location: index.php?page=manage-user");
            exit();
    } else {
        header('Location: index.php?page=dashboard-admin&status=error');
        exit;
        }
    }

    public function deleteUser() {
    // Set header untuk JSON response
    header('Content-Type: application/json');
    
    // Cek apakah request method adalah POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode([
            'success' => false, 
            'message' => 'Method tidak diizinkan. Gunakan POST.'
        ]);
        return;
    }
    
    // Cek apakah ID ada dalam POST data
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        echo json_encode([
            'success' => false, 
            'message' => 'ID user tidak ditemukan atau kosong.'
        ]);
        return;
    }
    
    try {
        $id = intval($_POST['id']); // Konversi ke integer untuk keamanan
        
        // Validasi ID harus lebih dari 0
        if ($id <= 0) {
            echo json_encode([
                'success' => false, 
                'message' => 'ID user tidak valid.'
            ]);
            return;
        }
        
        // Buat instance User dan hapus data
        $userModel = new User();
        $userModel->id = $id;
                
        // Eksekusi delete
        $result = $userModel->delete();
        
        if ($result) {
            echo json_encode([
                'success' => true, 
                'message' => 'Data user berhasil dihapus.'
            ]);
        } else {
            echo json_encode([
                'success' => false, 
                'message' => 'Gagal menghapus data user. Silakan coba lagi.'
            ]);
        }
        
    } catch (Exception $e) {
        // Log error untuk debugging (sesuaikan dengan sistem logging Anda)
        error_log("Error deleting user: " . $e->getMessage());
        
        echo json_encode([
            'success' => false, 
            'message' => 'Terjadi kesalahan sistem. Silakan coba lagi.'
        ]);
    }
}

    public function manageUser() {
        $database = new Database();
        $db = $database->getConnection();
        $user = new User();

        $dokterList = $user->getByRole('dokter');
        $adminList = $user->getByRole('admin');
        $petugasList = $user->getByRole('petugas');
        $pasienList = $user->getByRole('pasien');

    include_once __DIR__ . '/../view/admin/manage/manage.php';
}
}
?>