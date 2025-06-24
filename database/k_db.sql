-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 19, 2025 at 11:42 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `k_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`) VALUES
(2);

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `spesialisasi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id`, `user_id`, `spesialisasi`) VALUES
(7, 65, 'Neurologi');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_lab`
--

CREATE TABLE `hasil_lab` (
  `id` int NOT NULL,
  `pasien_id` int NOT NULL,
  `tanggal` date NOT NULL,
  `catatan` text,
  `jenis_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hasil_lab`
--

INSERT INTO `hasil_lab` (`id`, `pasien_id`, `tanggal`, `catatan`, `jenis_id`) VALUES
(1, 67, '2025-06-17', 'Pasien mengalami gejala pegal dan meriang', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hasil_parameter`
--

CREATE TABLE `hasil_parameter` (
  `id` int NOT NULL,
  `hasil_lab_id` int DEFAULT NULL,
  `parameter_id` int DEFAULT NULL,
  `nilai` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hasil_parameter`
--

INSERT INTO `hasil_parameter` (`id`, `hasil_lab_id`, `parameter_id`, `nilai`) VALUES
(1, 1, 53, '11.8'),
(2, 1, 54, '35'),
(3, 1, 55, '4.2'),
(4, 1, 56, '13000'),
(5, 1, 57, '180000'),
(6, 1, 58, '85'),
(7, 1, 59, '28'),
(8, 1, 60, '33'),
(9, 1, 61, '65'),
(10, 1, 62, '25'),
(11, 1, 63, '5'),
(12, 1, 64, '3'),
(13, 1, 65, '2');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_konsultasi`
--

CREATE TABLE `jadwal_konsultasi` (
  `id` int NOT NULL,
  `dokter_id` int NOT NULL,
  `pasien_id` int NOT NULL,
  `waktu` datetime NOT NULL,
  `status` enum('terjadwal','selesai','batal') DEFAULT 'terjadwal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pemeriksaan`
--

CREATE TABLE `jenis_pemeriksaan` (
  `id` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jenis_pemeriksaan`
--

INSERT INTO `jenis_pemeriksaan` (`id`, `nama`) VALUES
(1, 'Cek Darah');

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id` int NOT NULL,
  `pasien_id` int NOT NULL,
  `dokter_id` int NOT NULL,
  `keluhan` text,
  `tanggal_konsultasi` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('menunggu','selesai') DEFAULT 'menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `llm_rekomendasi`
--

CREATE TABLE `llm_rekomendasi` (
  `id` int NOT NULL,
  `spk_hasil_id` int NOT NULL,
  `diet` text,
  `solusi` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parameter_pemeriksaan`
--

CREATE TABLE `parameter_pemeriksaan` (
  `id` int NOT NULL,
  `jenis_id` int DEFAULT NULL,
  `nama_parameter` varchar(100) DEFAULT NULL,
  `satuan` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `parameter_pemeriksaan`
--

INSERT INTO `parameter_pemeriksaan` (`id`, `jenis_id`, `nama_parameter`, `satuan`) VALUES
(53, 1, 'Hemoglobin (Hb)', 'g/dL'),
(54, 1, 'Hematokrit (Ht)', '%'),
(55, 1, 'Eritrosit (RBC)', 'juta/μL'),
(56, 1, 'Leukosit (WBC)', 'ribu/μL'),
(57, 1, 'Trombosit (Plt)', 'ribu/μL'),
(58, 1, 'MCV', 'fL'),
(59, 1, 'MCH', 'pg'),
(60, 1, 'MCHC', 'g/dL'),
(61, 1, 'Neutrofil', '%'),
(62, 1, 'Limfosit', '%'),
(63, 1, 'Monosit', '%'),
(64, 1, 'Eosinofil', '%'),
(65, 1, 'Basofil', '%');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `alamat` text,
  `tanggal_lahir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `user_id`, `nik`, `alamat`, `tanggal_lahir`) VALUES
(1, 67, '01234567891234567890', 'zxc', '2025-06-04');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `kontak` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `user_id`, `kontak`) VALUES
(9, 66, '085155244833');

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medis`
--

CREATE TABLE `rekam_medis` (
  `id` int NOT NULL,
  `pasien_id` int NOT NULL,
  `dokter_id` int NOT NULL,
  `tanggal` datetime NOT NULL,
  `keluhan` text,
  `diagnosa` text,
  `tindakan` text,
  `resep_obat` text,
  `hasil_lab` text,
  `anjuran` text,
  `rujukan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `spk_hasil`
--

CREATE TABLE `spk_hasil` (
  `id` int NOT NULL,
  `hasil_lab_id` int NOT NULL,
  `prediksi` text,
  `confidence` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `spk_hasil`
--

INSERT INTO `spk_hasil` (`id`, `hasil_lab_id`, `prediksi`, `confidence`, `created_at`) VALUES
(1, 1, 'Anemia', 78, '2025-06-05 05:34:21'),
(2, 1, 'Anemia', 78, '2025-06-05 05:34:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `role` enum('admin','dokter','pasien','petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`, `role`) VALUES
(2, 'asd', '$2y$10$kl9hG0Bm6uVdHVDdC.M.e.K8CjoLxQXet8jzDbt./5AFBh313bqGu', 'Rizqi Anugrahaa', 'admin'),
(65, '123', '$2y$10$saKYnNkIlWpBLyfXAnllQOa.FTmiMR70cm2N/SlrsDTLHPt9U9n1a', '123', 'dokter'),
(66, 'qwe', '$2y$10$d8Gw12MKuXptX.s.6t7p/.utj3e19emWj3FZY0GJtx56HZFafA8Ra', 'qwe', 'petugas'),
(67, 'zxc', '$2y$10$Fvg8AtdlqFkxlvnP0qFikeJBUPCyRzVBx4tkPg5m1nGTOG2RGKSBK', 'zxc', 'pasien');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `hasil_lab`
--
ALTER TABLE `hasil_lab`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pasien_id` (`pasien_id`),
  ADD KEY `jenis_id` (`jenis_id`);

--
-- Indexes for table `hasil_parameter`
--
ALTER TABLE `hasil_parameter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hasil_lab_id` (`hasil_lab_id`),
  ADD KEY `parameter_id` (`parameter_id`);

--
-- Indexes for table `jadwal_konsultasi`
--
ALTER TABLE `jadwal_konsultasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dokter_id` (`dokter_id`),
  ADD KEY `pasien_id` (`pasien_id`);

--
-- Indexes for table `jenis_pemeriksaan`
--
ALTER TABLE `jenis_pemeriksaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pasien_id` (`pasien_id`),
  ADD KEY `dokter_id` (`dokter_id`);

--
-- Indexes for table `llm_rekomendasi`
--
ALTER TABLE `llm_rekomendasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spk_hasil_id` (`spk_hasil_id`);

--
-- Indexes for table `parameter_pemeriksaan`
--
ALTER TABLE `parameter_pemeriksaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_id` (`jenis_id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pasien_id` (`pasien_id`),
  ADD KEY `dokter_id` (`dokter_id`);

--
-- Indexes for table `spk_hasil`
--
ALTER TABLE `spk_hasil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hasil_lab_id` (`hasil_lab_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hasil_lab`
--
ALTER TABLE `hasil_lab`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hasil_parameter`
--
ALTER TABLE `hasil_parameter`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `jadwal_konsultasi`
--
ALTER TABLE `jadwal_konsultasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_pemeriksaan`
--
ALTER TABLE `jenis_pemeriksaan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `llm_rekomendasi`
--
ALTER TABLE `llm_rekomendasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parameter_pemeriksaan`
--
ALTER TABLE `parameter_pemeriksaan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spk_hasil`
--
ALTER TABLE `spk_hasil`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `dokter_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hasil_lab`
--
ALTER TABLE `hasil_lab`
  ADD CONSTRAINT `hasil_lab_ibfk_1` FOREIGN KEY (`pasien_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `hasil_lab_ibfk_2` FOREIGN KEY (`jenis_id`) REFERENCES `jenis_pemeriksaan` (`id`);

--
-- Constraints for table `hasil_parameter`
--
ALTER TABLE `hasil_parameter`
  ADD CONSTRAINT `hasil_parameter_ibfk_1` FOREIGN KEY (`hasil_lab_id`) REFERENCES `hasil_lab` (`id`),
  ADD CONSTRAINT `hasil_parameter_ibfk_2` FOREIGN KEY (`parameter_id`) REFERENCES `parameter_pemeriksaan` (`id`);

--
-- Constraints for table `jadwal_konsultasi`
--
ALTER TABLE `jadwal_konsultasi`
  ADD CONSTRAINT `jadwal_konsultasi_ibfk_1` FOREIGN KEY (`dokter_id`) REFERENCES `dokter` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_konsultasi_ibfk_2` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD CONSTRAINT `konsultasi_ibfk_1` FOREIGN KEY (`pasien_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `konsultasi_ibfk_2` FOREIGN KEY (`dokter_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `llm_rekomendasi`
--
ALTER TABLE `llm_rekomendasi`
  ADD CONSTRAINT `llm_rekomendasi_ibfk_1` FOREIGN KEY (`spk_hasil_id`) REFERENCES `spk_hasil` (`id`);

--
-- Constraints for table `parameter_pemeriksaan`
--
ALTER TABLE `parameter_pemeriksaan`
  ADD CONSTRAINT `parameter_pemeriksaan_ibfk_1` FOREIGN KEY (`jenis_id`) REFERENCES `jenis_pemeriksaan` (`id`);

--
-- Constraints for table `pasien`
--
ALTER TABLE `pasien`
  ADD CONSTRAINT `pasien_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `petugas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD CONSTRAINT `rekam_medis_ibfk_1` FOREIGN KEY (`pasien_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `rekam_medis_ibfk_2` FOREIGN KEY (`dokter_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `spk_hasil`
--
ALTER TABLE `spk_hasil`
  ADD CONSTRAINT `spk_hasil_ibfk_1` FOREIGN KEY (`hasil_lab_id`) REFERENCES `hasil_lab` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
