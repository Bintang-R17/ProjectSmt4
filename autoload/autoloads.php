<?php

// Autoload config
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/session.php';
startSession();
require_once __DIR__ . '/../config/database.php';

// Autoload controller
require_once __DIR__ . '/../controller/AuthController.php';
require_once __DIR__ . '/../controller/UserController.php';
require_once __DIR__ . '/../controller/JadwalController.php';
require_once __DIR__ . '/../controller/PetugasController.php';
require_once __DIR__ . '/../controller/DokterController.php';
require_once __DIR__ . '/../controller/PasienController.php';
require_once __DIR__ . '/../controller/RujukanController.php';
require_once __DIR__ . '/../controller/MedicalAnalysisController.php';


// Autoload utils
require_once __DIR__ . '/../controller/utils/middleware.php';

// Autoload Model
require_once __DIR__ . '/../model/dokter.php';
require_once __DIR__ . '/../model/petugas.php';
require_once __DIR__ . '/../model/pasien.php';
require_once __DIR__ . '/../model/user.php';
require_once __DIR__ . '/../model/hasilPemeriksaan.php';
require_once __DIR__ . '/../model/rekamMedis.php';
require_once __DIR__ . '/../model/rujukan.php';
require_once __DIR__ . '/../model/LabResultDAO.php';
require_once __DIR__ . '/../model/sessionManager.php';
require_once __DIR__ . '/../model/jadwalKonsultasi.php';
require_once __DIR__ . '/../model/konsultasi.php';
require_once __DIR__ . '/../model/GroqAIServices.php';
require_once __DIR__ . '/../model/rekomendasiLlm.php';
require_once __DIR__ . '/../model/spk.php';
require_once __DIR__ . '/../model/jadwalKosong.php';


?>