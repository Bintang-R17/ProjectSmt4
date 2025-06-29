<?php

include_once __DIR__ . '/autoload/autoloads.php';

$page = $_GET['page'] ?? 'login'; // default login

switch ($page) {

    // AUTH //
    case 'login':
        $auth = new AuthController();
        $auth->loginForm();
        break;

    case 'logout':
        $auth = new AuthController();
        $auth->logout();
        break;
    
    case 'login-process':
        $auth = new AuthController();
        $auth->loginProcess();
        break;
    
        // REGISTER //
    case 'register-process':
        $user = new UserController();
        $user->registerProcess();
        break;
    
    case 'registerD-process':
        $user = new DokterController();
        $user->registerProcess();
        break;    

    case 'registerP-process':
        $user = new PetugasController();
        $user->registerProcess();
        break;

    case 'registerPasien-process':
        $user = new PasienController();
        $user->registerProcess();
        break;
    

    // DASHBOARD //
    case 'dashboard-admin';
        checkRole('admin');
        require 'view/admin/dashboard.php';
        break;

    case 'dashboard-dokter':
        // checkRole('dokter');
        require 'view/dokter/dashboard.php';
        break;

    case 'dashboard-petugas':
        checkRole('petugas');
        require 'view/petugas/dashboard.php';
        break;

    case 'dashboard-pasien':
        checkRole('pasien');
        require 'view/pasien/dashboard.php';
        break;

    // USER MANAGEMENT // 
    case 'delete-user';
        $user = new UserController();
        $user->deleteUser();
        break;

    case 'edit-user';
        $user = new UserController();
        $user->showUser();
        break;

    case 'update-user';
        checkRole('admin'); 
        $user = new UserController();
        $user->updateUser();
        break;
 
    case 'create-user':
        checkRole('admin');
        require 'view/admin/create/index.php';
        break;
    
    case 'manage-user';
        $user = new UserController();
        $user->manageUser();
        break;
    
    // DOKTER //
    case 'list-pasien':
        $controller = new DokterController();
        $controller->listPasien();
        break;
    case 'analyze-lab':
        $controller = new MedicalAnalysisController();
        $controller->handleApiRequest();
        break;
    case 'manage-pasien';
        $dokter = new DokterController();
        $dokter->listPasien();
        break;
    case 'detail-pasien':
        $dokter = new DokterController();
        $dokter->listHasilLabPasien($_GET['id']);
        break;
    
    case 'detail-hasil-lab':
    $controller = new MedicalAnalysisController();
    $controller->showLabResultDetail($_GET['id']); // id = hasil_lab_id
    break;
    
    // case 'jadwal-konsultasi':
    //     $petugas = new JadwalController();
    //     $petugas->listJadwal();
    //     break;

    default:
        echo "404 - Halaman tidak ditemukan.";
        break;
}
?>
