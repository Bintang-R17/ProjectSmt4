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
            // Simpan data umum ke session
            $_SESSION['user_id'] = $user->id;
            $_SESSION['username'] = $user->username;
            $_SESSION['role'] = $user->role;
            $_SESSION['nama_lengkap'] = $user->nama_lengkap;

            $conn = (new Database())->getConnection();

            // Pisahkan berdasarkan role
            switch ($user->role) {
                case 'dokter':
                    $dokterModel = new Dokter($conn);
                    $dokter = $dokterModel->getByUserId($user->id);
                    $user_id = $_SESSION['user_id'] ?? null;
        if ($user_id) {
            $dokter = $dokterModel->getByUserId($user_id);
            if ($dokter) {
                $_SESSION['dokter_id'] = $dokter['id'];
            }
        }
                    if ($dokter) {
                        $_SESSION['dokter_id'] = $dokter['id'];
                        header("Location: index.php?page=dashboard-dokter");
                        exit;
                    } else {
                        echo "Akun dokter tidak ditemukan.";
                        exit;
                    }

                case 'pasien':
                    $pasienModel = new Pasien($conn);
                    $pasien = $pasienModel->getByUserId($user->id);
                    if ($pasien) {
                        $_SESSION['pasien_id'] = $pasien['id'];
                        header("Location: index.php?page=dashboard-pasien");
                        exit;
                    } else {
                        echo "Akun pasien tidak ditemukan.";
                        exit;
                    }

                case 'petugas':
                    $petugasModel = new Petugas($conn);
                    $petugas = $petugasModel->getByUserId($user->id);
                    if ($petugas) {
                        $_SESSION['petugas_id'] = $petugas['id'];
                        header("Location: index.php?page=dashboard-petugas");
                        exit;
                    } else {
                        echo "Akun petugas tidak ditemukan.";
                        exit;
                    }

                case 'admin':
                    header("Location: index.php?page=dashboard-admin");
                    exit;

                default:
                    echo "Role tidak dikenali.";
                    exit;
            }
        } else {
            echo "Username atau password salah.";
        }
    }

    public function logout() {
        startSession(); // Jika belum dimulai
        session_unset(); // Hapus semua variabel session
        session_destroy(); // Hancurkan session
        header("Location: index.php?page=login");
        exit();
    }
}
