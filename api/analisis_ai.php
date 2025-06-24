<?php

require_once __DIR__ . '/../controller/MedicalAnalysisController.php';

try {
    $controller = new MedicalAnalysisController();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->handleApiRequest();
        exit;
    }

    if (isset($_GET['action']) && $_GET['action'] === 'get_lab_results') {
        $results = $controller->getLabResults();
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $results
        ]);
        exit;
    }

} catch (Exception $e) {
    error_log("Fatal error: " . $e->getMessage());
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'error' => 'Internal server error: ' . $e->getMessage()
    ]);
}
