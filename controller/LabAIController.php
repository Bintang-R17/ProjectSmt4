<?php

class LabAIController {
    public function detail() {
        session_start();
        $conn = (new Database())->getConnection();
        $hasil_lab_id = $_GET['id'] ?? null;

        if (!$hasil_lab_id || !$conn) die("Data tidak lengkap.");

        $stmt = $conn->prepare("
            SELECT hl.id AS hasil_lab_id, hl.tanggal, hl.catatan, jp.nama AS jenis_pemeriksaan,
                   u.nama_lengkap AS nama_pasien, p.nik, p.alamat, p.tanggal_lahir
            FROM hasil_lab hl
            JOIN jenis_pemeriksaan jp ON hl.jenis_id = jp.id
            JOIN users u ON hl.user_id = u.id
            LEFT JOIN pasien p ON u.id = p.user_id
            WHERE hl.id = ?
        ");
        $stmt->bind_param("i", $hasil_lab_id);
        $stmt->execute();
        $pasienResult = $stmt->get_result();
        $pasienData = $pasienResult->fetch_assoc();

        $stmt2 = $conn->prepare("
            SELECT pp.nama_parameter, pp.satuan, hp.nilai, pp.jenis_id, jp.nama AS nama_jenis,
                   pp.nilai_min, pp.nilai_max
            FROM hasil_parameter hp
            JOIN parameter_pemeriksaan pp ON hp.parameter_id = pp.id
            JOIN jenis_pemeriksaan jp ON pp.jenis_id = jp.id
            WHERE hp.hasil_lab_id = ?
            ORDER BY jp.nama, pp.nama_parameter
        ");
        $stmt2->bind_param("i", $hasil_lab_id);
        $stmt2->execute();
        $paramResult = $stmt2->get_result();

        $parametersData = [];
        while ($row = $paramResult->fetch_assoc()) {
            $nilai = floatval($row['nilai']);
            $min = isset($row['nilai_min']) ? floatval($row['nilai_min']) : null;
            $max = isset($row['nilai_max']) ? floatval($row['nilai_max']) : null;

            $status = 'Normal';
            $statusClass = 'success';
            if (!is_null($min) && !is_null($max)) {
                if ($nilai < $min) {
                    $status = 'Rendah'; $statusClass = 'warning';
                } elseif ($nilai > $max) {
                    $status = 'Tinggi'; $statusClass = 'danger';
                }
            }

            $parametersData[] = array_merge($row, [
                'status' => $status,
                'status_class' => $statusClass,
                'nilai_numeric' => $nilai
            ]);
        }

        require __DIR__ . '/../views/lab/detail.php';
    }

    public function analisisAI() {
        header('Content-Type: application/json');
        $payload = json_decode(file_get_contents('php://input'), true);

        if (!$payload || !isset($payload['message'])) {
            echo json_encode([
                'success' => false,
                'error' => 'Data tidak valid.'
            ]);
            return;
        }

        // Simulasi respons dari AI / bisa integrasi Groq API / OpenAI API di sini
        $fakeResponse = "**Hasil Analisis AI**\n\n1. Hasil hemoglobin rendah menunjukkan kemungkinan anemia.\n\n" .
                        "2. Disarankan pemeriksaan lanjutan ke dokter umum atau internis.\n\n" .
                        "*Disclaimer: Ini adalah simulasi.*";

        echo json_encode([
            'success' => true,
            'content' => $fakeResponse,
            'timestamp' => date('Y-m-d H:i:s'),
        ]);
    }
}
