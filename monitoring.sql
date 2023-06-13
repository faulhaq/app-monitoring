-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2023 at 05:28 PM
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

INSERT INTO `guru` (`id`, `nip`, `nama`, `jk`, `telp`, `tmp_lahir`, `tgl_lahir`, `agama`, `pendidikan`, `goldar`, `pekerjaan`, `alamat`, `foto`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Andika P', 'L', '08123456789', 'Sleman', '2023-06-01', 'islam', 'sd', 'A', '', '', 'uploads/guru/35251431012020_male.jpg', '2023-06-08 00:03:29', '2023-06-08 00:30:38', '2023-06-08 00:30:38'),
(2, '196506061992032001', 'Andi', 'L', '08123456789', 'bantul', '2023-06-02', 'islam', 'sd', 'A', '', '', 'uploads/guru/57310708062023_card.jpg', '2023-06-08 00:31:57', '2023-06-08 00:31:57', NULL);

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
(2, '2', 2, '2023-06-08 00:48:20', '2023-06-08 00:48:20', NULL),
(3, '1', 2, '2023-06-08 22:46:01', '2023-06-08 22:46:01', NULL);

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
(7, '3314150809010003', 'aZxs', 'P', '08623456789', 'bantull', '2023-06-01', 'islam', 'sma/smk', 'B', 'tani', 'Sragen', 'uploads/orang_tua/54271513062023_Logomi.png', '2023-06-13 08:27:54', '2023-06-13 08:28:21', '2023-06-13 08:28:21');

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
  `no_induk` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmp_lahir` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama` enum('islam','kristen','katholik','budha','kong hu cu','hindu') COLLATE utf8mb4_unicode_ci NOT NULL,
  `goldar` enum('A','B','AB','O') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `no_induk`, `nis`, `nama`, `jk`, `telp`, `tmp_lahir`, `tgl_lahir`, `agama`, `goldar`, `alamat`, `foto`, `id_kelas`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '123', '12345', 'paul', 'L', '08123456789', 'sragen', '2020-01-09', 'islam', NULL, '', 'uploads/siswa/08430509062023_logoyayasan.png', 2, '2023-06-08 22:43:08', '2023-06-08 22:45:19', NULL);

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
  `role` enum('Admin','Guru','Siswa','Operator') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_siswa` bigint(20) UNSIGNED DEFAULT NULL,
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

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `id_siswa`, `id_guru`, `id_orang_tua`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$c2HfpsvcWRt2.qoJ3zRSpOhUn201OewYpbPGTe0T4Alii2nlgTZmG', 'Admin', NULL, NULL, 0, 'kYfDECa258fkSLaHeVBnE7aLgNPBNiCZuVPIJsUYmCAFWIDTU1adbHXNSBkR', '2021-01-11 01:01:19', '2023-06-08 00:27:39', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `telp` (`telp`,`nip`),
  ADD KEY `agama` (`agama`),
  ADD KEY `pendidikan` (`pendidikan`),
  ADD KEY `pekerjaan` (`pekerjaan`),
  ADD KEY `goldar` (`goldar`),
  ADD KEY `tmp_lahir` (`tmp_lahir`,`tgl_lahir`,`nama`,`jk`);
ALTER TABLE `guru` ADD FULLTEXT KEY `alamat` (`alamat`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nama_kelas` (`nama_kelas`),
  ADD KEY `id_guru` (`id_guru`);

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
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_induk` (`no_induk`,`nis`,`telp`),
  ADD KEY `agama` (`agama`),
  ADD KEY `goldar` (`goldar`),
  ADD KEY `nama` (`nama`,`jk`,`tmp_lahir`,`tgl_lahir`,`id_kelas`);
ALTER TABLE `siswa` ADD FULLTEXT KEY `alamat` (`alamat`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_orang_tua` (`id_orang_tua`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orang_tua`
--
ALTER TABLE `orang_tua`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`id_orang_tua`) REFERENCES `orang_tua` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
