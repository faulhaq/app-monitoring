-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2023 at 09:20 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monitoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` char(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmp_lahir` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama` enum('islam','kristen','katholik','budha','kong hu cu','hindu') COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendidikan` enum('sd','smp/sltp','sma/smk','d1/d2/d3','s1','s2','s3') COLLATE utf8mb4_unicode_ci NOT NULL,
  `goldar` enum('A','B','AB','O') COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nik`, `nip`, `nama`, `jk`, `telp`, `tmp_lahir`, `tgl_lahir`, `agama`, `pendidikan`, `goldar`, `pekerjaan`, `alamat`, `foto`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, '3314150809010009', '196506061992032001', 'abc', 'L', '081265345346', 'bantul', '2023-05-29', 'islam', 'd1/d2/d3', 'A', 'guru', 'Sragen', 'uploads/guru/00470414062023_Logomi.png', '2023-06-13 21:47:00', '2023-06-13 21:47:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `guru_siswa`
--

CREATE TABLE `guru_siswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_guru` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kelas` enum('1','2','3','4','5','6') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_guru` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `id_guru`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', NULL, '2023-06-08 00:45:28', '2023-06-08 00:52:41', '2023-06-08 00:52:41'),
(2, '2', NULL, '2023-06-08 00:48:20', '2023-06-08 00:48:20', NULL),
(3, '1', NULL, '2023-06-08 22:46:01', '2023-06-08 22:46:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_rumah`
--

CREATE TABLE `monitoring_rumah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tipe` enum('yes_no','isian') NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`data`)),
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monitoring_rumah`
--

INSERT INTO `monitoring_rumah` (`id`, `tipe`, `data`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'yes_no', '{\"q\":\"asdasdasd\",\"tipe\":\"yes_no\"}', NULL, '2023-07-11 06:52:30', '2023-07-11 07:19:34', '2023-07-11 07:19:34');

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_rumah_data`
--

CREATE TABLE `monitoring_rumah_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `id_monitoring` bigint(20) UNSIGNED NOT NULL,
  `jawaban` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`jawaban`)),
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orang_tua`
--

CREATE TABLE `orang_tua` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` char(16) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `telp` varchar(64) NOT NULL,
  `tmp_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `agama` enum('islam','kristen','katholik','budha','kong hu cu','hindu') NOT NULL,
  `pendidikan` enum('sd','smp/sltp','sma/smk','d1/d2/d3','s1','s2','s3') DEFAULT NULL,
  `goldar` enum('A','B','AB','O') NOT NULL,
  `pekerjaan` varchar(64) NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orang_tua`
--

INSERT INTO `orang_tua` (`id`, `nik`, `nama`, `jk`, `telp`, `tmp_lahir`, `tgl_lahir`, `agama`, `pendidikan`, `goldar`, `pekerjaan`, `alamat`, `foto`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, '1234567890098765', 'bapak', 'L', '123456789', 'solo', '2023-06-01', 'islam', 'sd', 'A', 'guruuuu', 'solooo', '', NULL, '2023-06-13 08:27:07', '2023-06-13 08:27:07'),
(5, '1212121212121231', 'ibu', 'P', '1435575745645', 'solo', '2023-06-02', 'islam', 's1', 'A', 'dosen', 'solo', '', NULL, NULL, NULL),
(6, '3314110809010001', 'abc', 'L', '08123456732', 'sragen', '2023-06-01', 'islam', 's1', 'A', 'dosen', 'Sragen', 'uploads/orang_tua/52471919042020_male.jpg', '2023-06-13 00:35:29', '2023-06-13 00:35:29', NULL),
(7, '3314150809010003', 'aZxs', 'P', '08623456789', 'bantull', '2023-06-01', 'islam', 'sma/smk', 'B', 'tani', 'Sragen', 'uploads/orang_tua/54271513062023_Logomi.png', '2023-06-13 08:27:54', '2023-06-13 08:28:21', '2023-06-13 08:28:21'),
(9, '3314150809010005', 'aZxs', 'L', '081265345346', 'Sleman', '2023-06-09', 'islam', 's1', 'A', 'guru', 'Sragen', 'uploads/orang_tua/24140414062023_male.jpg', '2023-06-13 21:14:24', '2023-06-13 21:20:08', '2023-06-13 21:20:08'),
(10, '3314150809010008', 'aku', 'L', '081234532654', 'bantul', '2023-05-30', 'islam', 'd1/d2/d3', 'B', 'guru', 'Sragen', 'uploads/orang_tua/52471919042020_male.jpg', '2023-06-13 21:19:32', '2023-06-13 21:20:07', '2023-06-13 21:20:07');

-- --------------------------------------------------------

--
-- Table structure for table `orang_tua_siswa`
--

CREATE TABLE `orang_tua_siswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_orang_tua` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orang_tua_siswa`
--

INSERT INTO `orang_tua_siswa` (`id`, `id_orang_tua`, `id_siswa`, `created_at`) VALUES
(2, 5, 1, '2023-06-14 07:54:06'),
(3, 6, 3, '2023-07-10 03:29:47'),
(4, 6, 2, '2023-07-10 03:29:47');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `opsi` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `opsi`, `isi`, `created_at`, `updated_at`) VALUES
(1, 'pengumuman', 'Halo Halo', '2021-01-11 01:01:19', '2023-06-07 23:57:04');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` char(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmp_lahir` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama` enum('islam','kristen','katholik','budha','kong hu cu','hindu') COLLATE utf8mb4_unicode_ci NOT NULL,
  `goldar` enum('A','B','AB','O') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nik`, `nis`, `nama`, `jk`, `telp`, `tmp_lahir`, `tgl_lahir`, `agama`, `goldar`, `alamat`, `foto`, `id_kelas`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '123', '12345', 'paul23', 'L', '08111111111', 'sragen', '2020-01-09', 'islam', NULL, 'sragen', 'uploads/siswa/08430509062023_logoyayasan.png', 3, '2023-06-08 22:43:08', '2023-07-09 21:19:38', NULL),
(2, '5471085732965262', '10198', 'adi', 'L', NULL, 'jogja', '2023-07-10', 'islam', 'AB', 'jogja', 'qqqq', 2, NULL, '2023-07-09 21:33:24', NULL),
(3, '13412456432657', '1536', 'nana', 'P', NULL, 'solo', '2023-07-01', 'islam', 'A', 'adsqad', 'qqqq', 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Admin','Guru','WaliKelas','OrangTua') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_guru` bigint(20) UNSIGNED DEFAULT NULL,
  `id_orang_tua` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `id_guru`, `id_orang_tua`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$c2HfpsvcWRt2.qoJ3zRSpOhUn201OewYpbPGTe0T4Alii2nlgTZmG', 'Admin', NULL, 0, 'XL3Ha221yNldjfeQPHtkL26KGDHdRL1mTGXSTIrAzLYc8niiaKIixoexoOSq', '2021-01-11 01:01:19', '2023-06-08 00:27:39', NULL),
(5, 'ibu', 'orangtua@gmail.com', NULL, '$2y$10$usXyaHZyg2JapPiuvZS7GeXxYVyQY9dCMcjjjoi6/w.aXqrzytn2S', 'OrangTua', NULL, 5, '4ednyMnhkvvkoE2CIPmHLqZIybjqZ6OxGDM7awUIbd1z1Bg72Qcn4a61feVf', '2023-06-13 21:55:17', '2023-06-13 21:55:17', NULL),
(6, 'abc', 'abc@gmail.com', NULL, '$2y$10$tEy0FlDXRQv8N60QjBAwrO2pIsHoNWXapeYL8Wump3Gu5DQjOyFre', 'OrangTua', NULL, 6, 'ZjwGiD48SKhhLgcwseGcoj9UmImJAhkLoZC2k1IbMDTmGCvDafwECbas5uTV', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD UNIQUE KEY `telp` (`telp`,`nip`),
  ADD KEY `agama` (`agama`),
  ADD KEY `pendidikan` (`pendidikan`),
  ADD KEY `pekerjaan` (`pekerjaan`),
  ADD KEY `goldar` (`goldar`),
  ADD KEY `tmp_lahir` (`tmp_lahir`,`tgl_lahir`,`nama`,`jk`);
ALTER TABLE `guru` ADD FULLTEXT KEY `alamat` (`alamat`);

--
-- Indexes for table `guru_siswa`
--
ALTER TABLE `guru_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nama_kelas` (`nama_kelas`),
  ADD KEY `id_guru` (`id_guru`);

--
-- Indexes for table `monitoring_rumah`
--
ALTER TABLE `monitoring_rumah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipe` (`tipe`),
  ADD KEY `created_at` (`created_at`,`deleted_at`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_at` (`updated_at`);

--
-- Indexes for table `monitoring_rumah_data`
--
ALTER TABLE `monitoring_rumah_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_monitoring` (`id_monitoring`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `deleted_at` (`deleted_at`),
  ADD KEY `updated_at` (`updated_at`);

--
-- Indexes for table `orang_tua`
--
ALTER TABLE `orang_tua`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD UNIQUE KEY `telp` (`telp`),
  ADD KEY `nama` (`nama`,`jk`,`tmp_lahir`,`tgl_lahir`,`agama`,`pendidikan`,`goldar`,`pekerjaan`);
ALTER TABLE `orang_tua` ADD FULLTEXT KEY `alamat` (`alamat`);

--
-- Indexes for table `orang_tua_siswa`
--
ALTER TABLE `orang_tua_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_orang_tua` (`id_orang_tua`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`,`nis`,`telp`) USING BTREE,
  ADD KEY `agama` (`agama`),
  ADD KEY `goldar` (`goldar`),
  ADD KEY `nama` (`nama`,`jk`,`tmp_lahir`,`tgl_lahir`,`id_kelas`),
  ADD KEY `id_kelas` (`id_kelas`);
ALTER TABLE `siswa` ADD FULLTEXT KEY `alamat` (`alamat`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_orang_tua` (`id_orang_tua`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `guru_siswa`
--
ALTER TABLE `guru_siswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `monitoring_rumah`
--
ALTER TABLE `monitoring_rumah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `monitoring_rumah_data`
--
ALTER TABLE `monitoring_rumah_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orang_tua`
--
ALTER TABLE `orang_tua`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orang_tua_siswa`
--
ALTER TABLE `orang_tua_siswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guru_siswa`
--
ALTER TABLE `guru_siswa`
  ADD CONSTRAINT `guru_siswa_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `guru_siswa_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `monitoring_rumah`
--
ALTER TABLE `monitoring_rumah`
  ADD CONSTRAINT `monitoring_rumah_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `monitoring_rumah_data`
--
ALTER TABLE `monitoring_rumah_data`
  ADD CONSTRAINT `monitoring_rumah_data_ibfk_1` FOREIGN KEY (`id_monitoring`) REFERENCES `monitoring_rumah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_rumah_data_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_rumah_data_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `orang_tua` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orang_tua_siswa`
--
ALTER TABLE `orang_tua_siswa`
  ADD CONSTRAINT `orang_tua_siswa_ibfk_1` FOREIGN KEY (`id_orang_tua`) REFERENCES `orang_tua` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orang_tua_siswa_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`id_orang_tua`) REFERENCES `orang_tua` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
