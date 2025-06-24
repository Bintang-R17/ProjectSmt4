<?php
header('Content-Type: application/json');

// Simulasi data
$data = [
  [
    'id' => 1,
    'nama_lengkap' => 'Ahmad Zaki',
    'username' => 'zaki123',
    'alamat' => 'Jakarta',
    'tanggal_lahir' => '1990-01-01',
    'user_id' => 67
  ],
  [
    'id' => 2,
    'nama_lengkap' => 'Dewi Lestari',
    'username' => 'dewi99',
    'alamat' => 'Bandung',
    'tanggal_lahir' => '1992-07-12',
    'user_id' => 68
  ]
];

echo json_encode($data);
