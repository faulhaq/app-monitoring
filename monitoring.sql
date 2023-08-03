-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2023 at 03:24 PM
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
-- Table structure for table `agama`
--

CREATE TABLE `agama` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agama`
--

INSERT INTO `agama` (`id`, `nama`) VALUES
(7, 'Budha'),
(4, 'Hindu'),
(1, 'Islam'),
(6, 'Katholik'),
(8, 'Kong Hu Cu'),
(2, 'Kristen');

-- --------------------------------------------------------

--
-- Table structure for table `goldar`
--

CREATE TABLE `goldar` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `goldar`
--

INSERT INTO `goldar` (`id`, `nama`) VALUES
(1, 'A'),
(4, 'AB'),
(2, 'B'),
(3, 'O');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(20) UNSIGNED NOT NULL,
  `nik` char(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` tinyint(3) UNSIGNED NOT NULL,
  `goldar` tinyint(3) UNSIGNED NOT NULL,
  `pekerjaan` smallint(5) UNSIGNED DEFAULT NULL,
  `pendidikan` smallint(5) UNSIGNED DEFAULT NULL,
  `telp` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmp_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('aktif','non-aktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nik`, `nip`, `nama`, `email`, `jk`, `agama`, `goldar`, `pekerjaan`, `pendidikan`, `telp`, `tmp_lahir`, `tgl_lahir`, `alamat`, `foto`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, '1234512345123451', '123123', 'Guru AAAAA', 'guru001@gmail.com', 'L', 1, 1, 1, 1, '081123123123', 'Jogja', '2023-07-31', 'Jogja', '2023_08_02__12_31_19_download (3).png', 'aktif', '2023-08-02 03:36:45', '2023-08-02 12:31:19', NULL),
(5, '1234512345123453', '122123', 'Guru BBBBBBB', 'guru002@gmail.com', 'L', 1, 1, 1, 1, '083123123', 'Jogja', '2023-07-31', 'Jogja', '2023_08_02__12_31_19_download (3).png', 'aktif', '2023-08-02 03:36:45', '2023-08-02 12:31:19', NULL),
(6, '1234512345122453', '121123', 'AAAAAAAAAA', 'guru003@gmail.com', 'L', 1, 1, 1, 1, '08344123123', 'Jogja', '2023-07-31', 'Jogja', '2023_08_03__12_58_13_Simulasi Forward Chaining Diagram.png', 'aktif', '2023-08-02 03:36:45', '2023-08-03 12:58:13', NULL),
(7, '3314150809010009', '196481271994031004', 'Anton', 'anton@gmail.com', 'L', 1, 4, 1, 1, '081265345346', 'sragen', '2023-07-31', 'Sragen', '2023_08_03__13_01_21_Andhika-Saedya-transformed.png', 'aktif', '2023-08-03 13:01:21', '2023-08-03 13:01:21', NULL),
(8, '3314150809010208', '124415322286765', 'Angga 123123', 'anton321@gmail.com', 'L', 4, 4, 2, 11, '081233456732', 'surakarta', '2023-08-16', 'Sragen 2', NULL, 'non-aktif', '2023-08-03 13:07:34', '2023-08-03 13:08:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(20) UNSIGNED NOT NULL,
  `tingkatan` enum('1','2','3','4','5','6') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tahun_ajaran` int(20) UNSIGNED NOT NULL,
  `id_guru` int(20) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `tingkatan`, `nama`, `id_tahun_ajaran`, `id_guru`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, '1', 'A', 1, 6, '2023-08-02 12:11:27', '2023-08-03 12:54:11', NULL),
(6, '2', 'B', 1, 5, '2023-08-02 12:50:44', '2023-08-02 12:50:44', NULL),
(7, '1', 'C', 4, 5, '2023-08-02 12:51:27', '2023-08-03 12:28:32', NULL),
(8, '2', 'D', 1, 6, '2023-08-02 12:51:42', '2023-08-02 12:51:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelas_siswa`
--

CREATE TABLE `kelas_siswa` (
  `id` int(20) UNSIGNED NOT NULL,
  `id_siswa` int(20) UNSIGNED NOT NULL,
  `id_kelas` int(20) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas_siswa`
--

INSERT INTO `kelas_siswa` (`id`, `id_siswa`, `id_kelas`, `created_at`, `updated_at`) VALUES
(10, 11, 5, '2023-08-02 12:40:08', '2023-08-02 12:40:08'),
(11, 14, 7, '2023-08-03 11:54:58', '2023-08-03 11:55:41'),
(12, 16, 8, '2023-08-03 13:22:56', '2023-08-03 13:23:25'),
(14, 15, 5, '2023-08-03 13:23:59', '2023-08-03 13:23:59');

-- --------------------------------------------------------

--
-- Table structure for table `orang_tua`
--

CREATE TABLE `orang_tua` (
  `id` int(20) UNSIGNED NOT NULL,
  `nik` char(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` tinyint(3) UNSIGNED NOT NULL,
  `goldar` tinyint(3) UNSIGNED NOT NULL,
  `pekerjaan` smallint(5) UNSIGNED DEFAULT NULL,
  `pendidikan` smallint(5) UNSIGNED DEFAULT NULL,
  `telp` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmp_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orang_tua`
--

INSERT INTO `orang_tua` (`id`, `nik`, `nama`, `email`, `jk`, `agama`, `goldar`, `pekerjaan`, `pendidikan`, `telp`, `tmp_lahir`, `tgl_lahir`, `alamat`, `foto`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, '1234512345123452', 'CCCCCCC', 'orangtua@gmail.com', 'L', 1, 1, 1, 1, '081123123122', 'Solo', '2023-08-07', 'Solo', '2023_08_02__03_45_55_SS SCAM BOSSY ALPHA JR & PHILLIP.png', '2023-08-02 03:45:55', '2023-08-02 12:48:03', NULL),
(4, '1234512444123452', 'BBBBBBBBBBBB', 'orangtua11@gmail.com', 'L', 1, 1, 1, 1, '081193123122', 'Solo', '2023-08-07', 'Solo', '2023_08_02__03_45_55_SS SCAM BOSSY ALPHA JR & PHILLIP.png', '2023-08-02 03:45:55', '2023-08-02 12:47:52', NULL),
(5, '1234512345122452', 'Kevin AaAAA', 'orangtua22@gmail.com', 'L', 1, 1, 1, 1, '081523123122', 'Solo', '2023-08-07', 'Solo', '2023_08_02__03_45_55_SS SCAM BOSSY ALPHA JR & PHILLIP.png', '2023-08-02 03:45:55', '2023-08-02 03:47:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`id`, `nama`) VALUES
(1, 'Guru'),
(2, 'Polisi'),
(4, 'Satpam'),
(3, 'Tentara');

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan`
--

CREATE TABLE `pendidikan` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendidikan`
--

INSERT INTO `pendidikan` (`id`, `nama`) VALUES
(10, 'D1'),
(11, 'D2'),
(12, 'D3'),
(8, 'MA'),
(9, 'MTS'),
(1, 'S1'),
(2, 'S2'),
(3, 'S3'),
(7, 'SD'),
(4, 'SMA'),
(6, 'SMK'),
(13, 'SMP');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `opsi` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `opsi`, `isi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'pengumuman', '', '2023-07-27 07:17:05', '2023-08-02 12:21:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(20) UNSIGNED NOT NULL,
  `nik` char(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` tinyint(3) UNSIGNED NOT NULL,
  `goldar` tinyint(3) UNSIGNED NOT NULL,
  `pendidikan` smallint(5) UNSIGNED DEFAULT NULL,
  `telp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmp_lahir` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('non-aktif','aktif','lulus','pindah') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `id_kelas_aktif` int(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nik`, `nis`, `nama`, `jk`, `agama`, `goldar`, `pendidikan`, `telp`, `tmp_lahir`, `tgl_lahir`, `alamat`, `foto`, `status`, `id_kelas_aktif`, `created_at`, `updated_at`, `deleted_at`) VALUES
(11, '3314110809010001', '3211111', 'Drs Mukhtar Ahmadi ,MPd.', 'L', 4, 4, NULL, '08123456732', 'bantul', '2023-08-02', 'Sragen', '2023_08_03__12_59_54_Fat simul.png', 'aktif', 5, '2023-08-02 12:40:08', '2023-08-03 12:59:54', NULL),
(12, '3314113809010001', '3211121', 'BBBBBBBBBBBB', 'L', 4, 4, NULL, '081231456732', 'bantul', '2023-08-02', 'Sragen', NULL, 'pindah', 5, '2023-08-02 12:40:08', '2023-08-03 12:21:20', NULL),
(13, '3314913809010001', '3251121', 'AAAAAAAAAAAAAAAAA', 'L', 4, 4, NULL, '081432456732', 'bantul', '2023-08-02', 'Sragen', NULL, 'lulus', 5, '2023-08-02 12:40:08', '2023-08-03 12:21:02', NULL),
(14, '3314110809010201', '32111113', 'Angga 2', 'L', 4, 4, NULL, '08123456733', 'surakarta', '2023-08-03', 'Sragen', NULL, 'aktif', 7, '2023-08-03 11:54:58', '2023-08-03 11:55:41', NULL),
(15, '3314150800010005', '32154', 'Budha', 'P', 1, 1, NULL, '12312312312', 'bantull', '2023-07-30', 'Sragen', NULL, 'non-aktif', 5, '2023-08-03 13:18:27', '2023-08-03 13:23:59', NULL),
(16, '3314110809012001', '12345', 'Angga qqqqq', 'L', 4, 4, NULL, '08123456789', 'surakarta', '2023-08-10', 'Sragen', NULL, 'non-aktif', 8, '2023-08-03 13:22:20', '2023-08-03 13:23:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id` int(20) UNSIGNED NOT NULL,
  `tahun` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id`, `tahun`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2022/2023', '2023-07-27 08:10:58', NULL, NULL),
(3, '2023/2024', '2023-07-27 09:25:36', '2023-07-27 09:25:36', NULL),
(4, '2024/2025', '2023-07-27 09:25:41', '2023-07-27 09:25:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran_aktif`
--

CREATE TABLE `tahun_ajaran_aktif` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `id_tahun_ajaran` int(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tahun_ajaran_aktif`
--

INSERT INTO `tahun_ajaran_aktif` (`id`, `id_tahun_ajaran`) VALUES
(13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) UNSIGNED NOT NULL,
  `role` enum('admin','guru','orang_tua') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_guru` int(20) UNSIGNED DEFAULT NULL,
  `id_orang_tua` int(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `email`, `password`, `id_guru`, `id_orang_tua`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$W5v5GzmFnQwSAAETT4ls1OKho2joKUg74A.2/RufKP8ZRfJpeqcWO', NULL, NULL, 'izwq9zeRs03JBLmHvasHfkVfHCZoPEpZ27aX2gdwEHFHZomryCsIJMUGZYHE', '2023-07-27 12:15:00', NULL),
(7, 'admin', 'admin2@gmail.com', '$2y$10$Z1fe57ZMbUdEcatOAFTuy.wxgeeRdGbBlvJRmipz/JUVjydEf4TG2', NULL, NULL, NULL, '2023-08-02 05:17:43', '2023-08-02 05:17:43'),
(8, 'guru', 'guru001@gmail.com', '$2y$10$oEKuREHlzeoVbYXxnKl/ceTKm.Ma.8xbx8MV7XjW.iNqAtsvgpZru', 4, NULL, NULL, '2023-08-02 05:18:55', '2023-08-02 05:18:55'),
(9, 'orang_tua', 'orangtua@gmail.com', '$2y$10$hUcmNzMOYktbeeQsglhP0u20UGWz.g3yWyywJMP5Tf7pF3rUFDkhm', NULL, 3, NULL, '2023-08-02 05:19:01', '2023-08-02 05:19:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agama`
--
ALTER TABLE `agama`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `goldar`
--
ALTER TABLE `goldar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD KEY `nama` (`nama`),
  ADD KEY `jk` (`jk`),
  ADD KEY `agama` (`agama`),
  ADD KEY `goldar` (`goldar`),
  ADD KEY `pekerjaan` (`pekerjaan`),
  ADD KEY `pendidikan` (`pendidikan`),
  ADD KEY `telp` (`telp`),
  ADD KEY `tmp_lahir` (`tmp_lahir`),
  ADD KEY `tgl_lahir` (`tgl_lahir`),
  ADD KEY `status` (`status`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `deleted_at` (`deleted_at`);
ALTER TABLE `guru` ADD FULLTEXT KEY `alamat` (`alamat`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tingkatan` (`tingkatan`),
  ADD KEY `nama` (`nama`),
  ADD KEY `id_tahun_ajaran` (`id_tahun_ajaran`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `deleted_at` (`deleted_at`);

--
-- Indexes for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `orang_tua`
--
ALTER TABLE `orang_tua`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `nama` (`nama`),
  ADD KEY `jk` (`jk`),
  ADD KEY `agama` (`agama`),
  ADD KEY `goldar` (`goldar`),
  ADD KEY `pekerjaan` (`pekerjaan`),
  ADD KEY `pendidikan` (`pendidikan`),
  ADD KEY `telp` (`telp`),
  ADD KEY `tmp_lahir` (`tmp_lahir`),
  ADD KEY `tgl_lahir` (`tgl_lahir`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `deleted_at` (`deleted_at`);
ALTER TABLE `orang_tua` ADD FULLTEXT KEY `alamat` (`alamat`);

--
-- Indexes for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `deleted_at` (`deleted_at`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD UNIQUE KEY `nis` (`nis`),
  ADD KEY `nama` (`nama`),
  ADD KEY `jk` (`jk`),
  ADD KEY `agama` (`agama`),
  ADD KEY `goldar` (`goldar`),
  ADD KEY `pendidikan` (`pendidikan`),
  ADD KEY `telp` (`telp`),
  ADD KEY `tmp_lahir` (`tmp_lahir`),
  ADD KEY `tgl_lahir` (`tgl_lahir`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `deleted_at` (`deleted_at`),
  ADD KEY `id_kelas_aktif` (`id_kelas_aktif`),
  ADD KEY `status` (`status`);
ALTER TABLE `siswa` ADD FULLTEXT KEY `alamat` (`alamat`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tahun` (`tahun`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `deleted_at` (`deleted_at`);

--
-- Indexes for table `tahun_ajaran_aktif`
--
ALTER TABLE `tahun_ajaran_aktif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tahun_ajaran` (`id_tahun_ajaran`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`),
  ADD KEY `email` (`email`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_orang_tua` (`id_orang_tua`),
  ADD KEY `remember_token` (`remember_token`),
  ADD KEY `created_at` (`created_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agama`
--
ALTER TABLE `agama`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `goldar`
--
ALTER TABLE `goldar`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orang_tua`
--
ALTER TABLE `orang_tua`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pendidikan`
--
ALTER TABLE `pendidikan`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tahun_ajaran_aktif`
--
ALTER TABLE `tahun_ajaran_aktif`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_fk1` FOREIGN KEY (`agama`) REFERENCES `agama` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `guru_fk2` FOREIGN KEY (`goldar`) REFERENCES `goldar` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `guru_fk3` FOREIGN KEY (`pekerjaan`) REFERENCES `pekerjaan` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `guru_fk4` FOREIGN KEY (`pendidikan`) REFERENCES `pendidikan` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_fk1` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tahun_ajaran` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `kelas_fk2` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  ADD CONSTRAINT `kelas_siswa_fk1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kelas_siswa_fk2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orang_tua`
--
ALTER TABLE `orang_tua`
  ADD CONSTRAINT `orang_tua_fk1` FOREIGN KEY (`agama`) REFERENCES `agama` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orang_tua_fk2` FOREIGN KEY (`goldar`) REFERENCES `goldar` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orang_tua_fk3` FOREIGN KEY (`pekerjaan`) REFERENCES `pekerjaan` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orang_tua_fk4` FOREIGN KEY (`pendidikan`) REFERENCES `pendidikan` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_fk1` FOREIGN KEY (`agama`) REFERENCES `agama` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_fk2` FOREIGN KEY (`goldar`) REFERENCES `goldar` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_fk3` FOREIGN KEY (`pendidikan`) REFERENCES `pendidikan` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas_aktif`) REFERENCES `kelas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tahun_ajaran_aktif`
--
ALTER TABLE `tahun_ajaran_aktif`
  ADD CONSTRAINT `tahun_ajaran_aktif_fk1` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tahun_ajaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_fk1` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_fk2` FOREIGN KEY (`id_orang_tua`) REFERENCES `orang_tua` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
