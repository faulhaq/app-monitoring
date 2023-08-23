-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2023 at 06:37 AM
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
(8, '3314150809010208', '124415322286765', 'Angga 123123', 'anton321@gmail.com', 'L', 4, 4, 2, 11, '081233456732', 'surakarta', '2023-08-16', 'Sragen 2', NULL, 'aktif', '2023-08-03 13:07:34', '2023-08-10 06:56:01', NULL),
(9, '3314150807654205', '196506061992032001', 'AWEfsg', 'syifaulhaq008@gmail.com', 'L', 1, 1, 1, 1, '086234567895', 'sragenn', '2023-07-30', 'srageh', NULL, 'aktif', '2023-08-23 03:44:46', '2023-08-23 03:44:46', NULL),
(10, '3314145739010001', NULL, 'fuog', 'alexr23@gmail.com', 'L', 1, 1, 1, 1, '088765345346', 'bantul', '2023-08-02', 'grogol', NULL, 'aktif', '2023-08-23 03:45:46', '2023-08-23 03:45:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(20) UNSIGNED NOT NULL,
  `tingkatan` enum('1','2','3','4','5','6') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(8, '2', 'D', 1, 4, '2023-08-02 12:51:42', '2023-08-23 04:23:25', NULL),
(9, '6', 'D', 3, 7, '2023-08-03 13:27:31', '2023-08-03 13:27:45', NULL),
(13, '1', 'A', 1, 4, '2023-08-23 04:35:48', '2023-08-23 04:37:35', NULL);

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
(8, 2, 9, '2023-08-23 03:46:23', NULL),
(9, 5, 9, '2023-08-23 03:46:23', NULL),
(10, 3, 9, '2023-08-23 03:46:23', NULL),
(16, 5, 8, '2023-08-23 04:29:17', NULL),
(17, 6, 8, '2023-08-23 04:33:09', NULL),
(18, 2, 13, '2023-08-23 04:37:07', NULL),
(20, 3, 13, '2023-08-23 04:37:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kk`
--

CREATE TABLE `kk` (
  `id` int(20) UNSIGNED NOT NULL,
  `no_kk` char(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kk`
--

INSERT INTO `kk` (`id`, `no_kk`, `updated_at`, `created_at`) VALUES
(1, '1234567890123456', '2023-08-10 09:01:35', '2023-08-10 09:01:35'),
(3, '1231211111111111', '2023-08-10 09:10:41', '2023-08-10 09:10:41'),
(5, '1231211111111146', '2023-08-14 08:15:06', '2023-08-14 08:15:06'),
(6, '1231211111211146', '2023-08-23 03:36:31', '2023-08-23 03:36:31');

-- --------------------------------------------------------

--
-- Table structure for table `orang_tua`
--

CREATE TABLE `orang_tua` (
  `id` int(20) UNSIGNED NOT NULL,
  `id_kk` int(20) UNSIGNED NOT NULL,
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

INSERT INTO `orang_tua` (`id`, `id_kk`, `nik`, `nama`, `email`, `jk`, `agama`, `goldar`, `pekerjaan`, `pendidikan`, `telp`, `tmp_lahir`, `tgl_lahir`, `alamat`, `foto`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '3314110809010001', 'Antonnnn', 'anton@gmail.com', 'L', 1, 1, 2, 3, '08123456732', 'sragen', '2023-08-01', 'Sragen', NULL, '2023-08-14 07:40:49', '2023-08-14 07:58:46', NULL),
(2, 1, '3314150809010809', 'abcd', 'antoni@gmail.com', 'P', 1, 2, 1, 1, '08123456789', 'Sleman', '2023-07-30', 'Sragen', '2023_08_14__07_58_31_Hanna-transformed.png', '2023-08-14 07:50:34', '2023-08-14 07:58:31', NULL),
(3, 5, '3314110809018601', 'paulfgd', 'alex123@gmail.com', 'L', 1, 1, 2, 1, '08123456732', 'sragen', '2023-08-06', 'sleman', NULL, '2023-08-14 08:15:48', '2023-08-14 08:15:48', NULL),
(4, 6, '3314150809010908', 'ABCDEF', 'abc@gmail.com', 'L', 1, 1, 2, 2, '086234567893', 'sragen', '2023-07-30', 'Sragen', NULL, '2023-08-23 03:39:14', '2023-08-23 03:39:33', NULL);

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
(1, 'pengumuman', 'halo semuanya', '2023-07-27 07:17:05', '2023-08-04 03:01:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(20) UNSIGNED NOT NULL,
  `id_kk` int(20) UNSIGNED NOT NULL,
  `nik` char(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` tinyint(3) UNSIGNED NOT NULL,
  `goldar` tinyint(3) UNSIGNED DEFAULT NULL,
  `pendidikan` smallint(5) UNSIGNED DEFAULT NULL,
  `telp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmp_lahir` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('non-aktif','aktif','lulus','pindah') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `id_kk`, `nik`, `nis`, `nama`, `jk`, `agama`, `goldar`, `pendidikan`, `telp`, `tmp_lahir`, `tgl_lahir`, `alamat`, `foto`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 1, '3314110809010001', '123453', 'Angga', 'L', 4, 1, NULL, '08123456789', 'sragenn', '2023-08-10', 'Sragen', NULL, 'aktif', '2023-08-14 07:32:54', '2023-08-14 07:32:54', NULL),
(3, 1, '3314150809010905', '321', 'paull', 'L', 1, 1, NULL, NULL, 'sragen', '2023-07-30', 'Sragen 2', '2023_08_14__07_59_11_Andhika-Saedya-transformed.png', 'aktif', '2023-08-14 07:51:59', '2023-08-14 07:59:11', NULL),
(4, 3, '3314150809010685', '1234588', 'A', 'L', 1, 1, NULL, '08123456789', 'solo', '2023-07-31', 'solo', '2023_08_14__08_01_43_lokasi-logo-25373.png', 'aktif', '2023-08-14 08:01:43', '2023-08-14 08:01:43', NULL),
(5, 5, '3314150809636905', '321115', 'Andi', 'P', 1, 2, NULL, '0812345326543', 'Sleman', '2023-08-25', 'sleman', NULL, 'aktif', '2023-08-14 08:16:50', '2023-08-14 08:16:50', NULL),
(6, 6, '3314110346210001', '14678', 'ABCDES', 'L', 1, 1, NULL, '08923456789', 'sragen', '2023-08-01', 'Sragen', NULL, 'aktif', '2023-08-23 03:40:21', '2023-08-23 03:40:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id` int(20) UNSIGNED NOT NULL,
  `tahun` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id`, `tahun`, `created_at`, `updated_at`) VALUES
(1, '2022/2023', '2023-07-27 08:10:58', NULL),
(3, '2023/2024', '2023-07-27 09:25:36', '2023-07-27 09:25:36'),
(4, '2024/2025', '2023-07-27 09:25:41', '2023-07-27 09:25:41'),
(5, '2026/2027', '2023-08-03 13:41:30', '2023-08-03 13:41:30'),
(6, '2027/2028', '2023-08-03 13:42:55', '2023-08-03 13:42:55'),
(7, '2028/2029', '2023-08-03 13:43:04', '2023-08-03 13:43:04'),
(8, '2029/2030', '2023-08-04 02:48:45', '2023-08-04 02:48:45'),
(9, '2030/2031', '2023-08-14 08:18:16', '2023-08-14 08:18:16'),
(10, '2043/2044', '2023-08-23 03:42:49', '2023-08-23 03:42:49');

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
(28, 1);

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
(1, 'admin', 'admin@gmail.com', '$2y$10$W5v5GzmFnQwSAAETT4ls1OKho2joKUg74A.2/RufKP8ZRfJpeqcWO', NULL, NULL, 'yWWLMhRJHGiflzGA9DXFliW9OIb4qdqfEJJLhkNDoYuXBVC6jsgcy79yVHg9', '2023-07-27 12:15:00', NULL),
(11, 'guru', 'guru001@gmail.com', '$2y$10$1OtCw2oVhV8AwQgfTh2Dlursg/9TVWIdXI3TQlfXX9A1VFbUWgUg6', 4, NULL, NULL, '2023-08-14 08:18:51', '2023-08-23 03:50:14');

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
-- Indexes for table `kk`
--
ALTER TABLE `kk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_kk` (`no_kk`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `orang_tua`
--
ALTER TABLE `orang_tua`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_kk` (`id_kk`),
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
  ADD KEY `id_kk` (`id_kk`),
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
  ADD KEY `status` (`status`);
ALTER TABLE `siswa` ADD FULLTEXT KEY `alamat` (`alamat`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tahun` (`tahun`),
  ADD KEY `created_at` (`created_at`);

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
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `goldar`
--
ALTER TABLE `goldar`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `kk`
--
ALTER TABLE `kk`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orang_tua`
--
ALTER TABLE `orang_tua`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pendidikan`
--
ALTER TABLE `pendidikan`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tahun_ajaran_aktif`
--
ALTER TABLE `tahun_ajaran_aktif`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  ADD CONSTRAINT `kelas_siswa_fk1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `kelas_siswa_fk2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `orang_tua`
--
ALTER TABLE `orang_tua`
  ADD CONSTRAINT `orang_tua_fk1` FOREIGN KEY (`id_kk`) REFERENCES `kk` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orang_tua_fk2` FOREIGN KEY (`agama`) REFERENCES `agama` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orang_tua_fk3` FOREIGN KEY (`goldar`) REFERENCES `goldar` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orang_tua_fk4` FOREIGN KEY (`pekerjaan`) REFERENCES `pekerjaan` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orang_tua_fk5` FOREIGN KEY (`pendidikan`) REFERENCES `pendidikan` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_fk1` FOREIGN KEY (`id_kk`) REFERENCES `kk` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_fk2` FOREIGN KEY (`agama`) REFERENCES `agama` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_fk3` FOREIGN KEY (`goldar`) REFERENCES `goldar` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_fk4` FOREIGN KEY (`pendidikan`) REFERENCES `pendidikan` (`id`) ON UPDATE CASCADE;

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
