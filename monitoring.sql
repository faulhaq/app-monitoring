-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2023 at 10:06 AM
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
-- Table structure for table `data_harian`
--

CREATE TABLE `data_harian` (
  `id` int(10) UNSIGNED NOT NULL,
  `bulan` tinyint(3) UNSIGNED NOT NULL,
  `tahun` year(4) NOT NULL,
  `id_kelas` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_harian`
--

INSERT INTO `data_harian` (`id`, `bulan`, `tahun`, `id_kelas`, `created_at`, `updated_at`) VALUES
(6, 4, 2024, 15, '2023-12-01 09:06:04', '2023-12-01 09:06:04');

-- --------------------------------------------------------

--
-- Table structure for table `data_harian_isian`
--

CREATE TABLE `data_harian_isian` (
  `id` int(10) UNSIGNED NOT NULL,
  `pertanyaan` text NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Master data monitoring harian isian';

--
-- Dumping data for table `data_harian_isian`
--

INSERT INTO `data_harian_isian` (`id`, `pertanyaan`, `tgl_mulai`, `tgl_selesai`, `created_at`, `updated_at`) VALUES
(14, 'Siapa nama Anda?', '2023-11-01', '2023-11-30', '2023-11-14 07:46:18', '2023-11-14 07:50:02'),
(15, 'apakah kalian sehat ?', '2023-11-01', '2023-11-30', '2023-11-18 13:28:31', '2023-11-18 13:28:31'),
(16, 'apakah hari ini sehat ?', '2023-11-01', '2023-11-30', '2023-11-29 06:44:51', '2023-11-29 06:44:51');

-- --------------------------------------------------------

--
-- Table structure for table `data_harian_isian_kelas`
--

CREATE TABLE `data_harian_isian_kelas` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_data` int(10) UNSIGNED NOT NULL,
  `id_kelas` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_harian_isian_kelas`
--

INSERT INTO `data_harian_isian_kelas` (`id`, `id_data`, `id_kelas`) VALUES
(38, 14, 15),
(39, 14, 8),
(40, 14, 14),
(41, 15, 15),
(42, 15, 8),
(43, 15, 14),
(44, 16, 15),
(45, 16, 8),
(46, 16, 14);

-- --------------------------------------------------------

--
-- Table structure for table `data_harian_yn`
--

CREATE TABLE `data_harian_yn` (
  `id` int(10) UNSIGNED NOT NULL,
  `pertanyaan` text NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Master data monitoring harian yn/pilihan';

--
-- Dumping data for table `data_harian_yn`
--

INSERT INTO `data_harian_yn` (`id`, `pertanyaan`, `tgl_mulai`, `tgl_selesai`, `created_at`, `updated_at`) VALUES
(7, 'Sudah makan belum?', '2023-11-15', '2023-11-30', '2023-11-14 07:52:20', '2023-11-18 13:38:17');

-- --------------------------------------------------------

--
-- Table structure for table `data_harian_yn_kelas`
--

CREATE TABLE `data_harian_yn_kelas` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_data` int(10) UNSIGNED NOT NULL,
  `id_kelas` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_harian_yn_kelas`
--

INSERT INTO `data_harian_yn_kelas` (`id`, `id_data`, `id_kelas`) VALUES
(24, 7, 15),
(25, 7, 8),
(26, 7, 14);

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
(4, '1234512345123451', '123123', 'Guru 1', 'guru001@gmail.com', 'L', 1, 2, 1, 1, '081123123123', 'Jogja', '2023-07-31', 'Jogja', '2023_11_13__11_01_22_Screenshot_3.png', 'aktif', '2023-08-02 03:36:45', '2023-11-24 14:48:05', NULL),
(5, '1234512345123453', '122123', 'Guru BBBBBBB', 'guru002@gmail.com', 'L', 1, 1, 1, 1, '083123123', 'Jogja', '2023-07-31', 'Jogja', '2023_08_02__12_31_19_download (3).png', 'aktif', '2023-08-02 03:36:45', '2023-08-02 12:31:19', NULL),
(6, '1234512345122453', NULL, 'AAAAAAAAAA', 'guru003@gmail.com', 'L', 1, 1, 1, 1, '08344123123', 'Jogja', '2023-07-31', 'Jogja', '2023_08_03__12_58_13_Simulasi Forward Chaining Diagram.png', 'aktif', '2023-08-02 03:36:45', '2023-08-03 12:58:13', NULL),
(7, '3314150809010009', '196481271994031004', 'Anton', 'anton@gmail.com', 'L', 1, 4, 1, 1, '081265345346', 'sragen', '2023-07-31', 'Sragen', '2023_08_03__13_01_21_Andhika-Saedya-transformed.png', 'aktif', '2023-08-03 13:01:21', '2023-08-03 13:01:21', NULL),
(8, '3314150809010208', '124415322286765', 'Angga 123123', 'anton321@gmail.com', 'L', 4, 4, 2, 11, '081233456732', 'surakarta', '2023-08-16', 'Sragen 2', NULL, 'aktif', '2023-08-03 13:07:34', '2023-10-18 04:34:54', NULL),
(9, '3314150807654205', '196506061992032001', 'AWEfsg', 'syifaulhaq008@gmail.com', 'L', 1, 1, 1, 1, '086234567895', 'sragenn', '2023-07-30', 'srageh', NULL, 'aktif', '2023-08-23 03:44:46', '2023-08-23 03:44:46', NULL),
(10, '3314145739010001', NULL, 'fuog', 'alexr23@gmail.com', 'L', 1, 1, 1, 1, '088765345346', 'bantul', '2023-08-02', 'grogol', NULL, 'aktif', '2023-08-23 03:45:46', '2023-08-23 03:45:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(10) UNSIGNED NOT NULL,
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
(14, '3', NULL, 1, 6, '2023-09-15 03:28:21', '2023-09-26 04:00:32', NULL),
(15, '1', NULL, 1, 9, '2023-09-26 03:59:13', '2023-09-26 03:59:13', NULL);

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
(21, 4, 8, '2023-08-23 07:03:24', NULL),
(22, 2, 14, '2023-09-15 03:30:10', NULL),
(23, 3, 14, '2023-09-15 03:30:10', NULL);

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
-- Table structure for table `monitoring_doa`
--

CREATE TABLE `monitoring_doa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` int(10) UNSIGNED NOT NULL,
  `doa` varchar(255) NOT NULL,
  `lu` enum('lancar','ulang') NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `feedback_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monitoring_doa`
--

INSERT INTO `monitoring_doa` (`id`, `id_siswa`, `doa`, `lu`, `created_by`, `feedback`, `feedback_by`, `created_at`) VALUES
(1, 5, 'doa mau makan', 'lancar', NULL, NULL, NULL, '2023-11-24 14:59:22');

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_hadits`
--

CREATE TABLE `monitoring_hadits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` int(10) UNSIGNED NOT NULL,
  `hadits` varchar(255) NOT NULL,
  `lu` enum('lancar','ulang') NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `feedback_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monitoring_hadits`
--

INSERT INTO `monitoring_hadits` (`id`, `id_siswa`, `hadits`, `lu`, `created_by`, `feedback`, `feedback_by`, `created_at`) VALUES
(1, 2, 'hadis orang tua', 'lancar', NULL, NULL, NULL, '2023-11-24 14:58:44');

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_harian_isian`
--

CREATE TABLE `monitoring_harian_isian` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_siswa` int(10) UNSIGNED NOT NULL,
  `id_data` int(10) UNSIGNED NOT NULL,
  `jawaban` text NOT NULL,
  `tanggal` date NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monitoring_harian_isian`
--

INSERT INTO `monitoring_harian_isian` (`id`, `id_siswa`, `id_data`, `jawaban`, `tanggal`, `created_by`, `updated_at`, `created_at`) VALUES
(15, 4, 14, 'zxczxc', '2023-11-01', 1, NULL, '2023-11-15 08:11:57'),
(16, 4, 14, 'asdasd', '2023-11-14', 1, NULL, '2023-11-15 08:12:28'),
(23, 2, 14, 'aaaaaa', '2023-11-15', 4, NULL, '2023-11-15 08:24:46'),
(25, 3, 14, 'ddddddddd', '2023-11-15', 4, NULL, '2023-11-15 08:24:53'),
(26, 3, 14, 'zzzz', '2023-11-14', 4, NULL, '2023-11-15 08:25:00'),
(27, 4, 14, 'abc', '2023-11-17', 1, NULL, '2023-11-17 13:34:22'),
(30, 2, 14, 'asdasd', '2023-11-16', 4, NULL, '2023-11-17 14:40:17'),
(31, 2, 14, 'zzzzzzzzzzzzzzzzzzzzzzz', '2023-11-08', 4, NULL, '2023-11-17 14:49:35'),
(41, 2, 14, 'qwe', '2023-11-18', 4, NULL, '2023-11-18 13:52:08'),
(42, 2, 15, 'qwe', '2023-11-18', 4, NULL, '2023-11-18 13:52:08'),
(45, 4, 14, 'Andi', '2023-11-18', 1, NULL, '2023-11-18 14:03:27'),
(46, 4, 15, 'Ya sehat', '2023-11-18', 1, NULL, '2023-11-18 14:03:27'),
(47, 4, 14, 'A', '2023-11-24', 1, NULL, '2023-11-24 15:13:49'),
(48, 4, 15, 'ya', '2023-11-24', 1, NULL, '2023-11-24 15:13:49'),
(49, 4, 14, 'A', '2023-11-23', 1, NULL, '2023-11-24 15:14:00'),
(50, 4, 15, 'B', '2023-11-23', 1, NULL, '2023-11-24 15:14:00'),
(51, 2, 14, 'angga', '2023-11-29', 4, NULL, '2023-11-29 06:58:02'),
(52, 2, 15, 'ya sehat', '2023-11-29', 4, NULL, '2023-11-29 06:58:02'),
(53, 2, 16, 'benar sehat', '2023-11-29', 4, NULL, '2023-11-29 06:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_harian_yn`
--

CREATE TABLE `monitoring_harian_yn` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_siswa` int(10) UNSIGNED NOT NULL,
  `id_data` int(10) UNSIGNED NOT NULL,
  `jawaban` enum('y','n') NOT NULL,
  `tanggal` date NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monitoring_harian_yn`
--

INSERT INTO `monitoring_harian_yn` (`id`, `id_siswa`, `id_data`, `jawaban`, `tanggal`, `created_by`, `updated_at`, `created_at`) VALUES
(38, 2, 7, 'y', '2023-11-18', 4, NULL, '2023-11-18 13:52:08'),
(40, 4, 7, 'y', '2023-11-18', 1, NULL, '2023-11-18 14:03:27'),
(42, 4, 7, 'y', '2023-11-24', 1, NULL, '2023-11-24 15:13:49'),
(43, 4, 7, 'n', '2023-11-23', 1, NULL, '2023-11-24 15:14:00'),
(44, 2, 7, 'y', '2023-11-29', 4, NULL, '2023-11-29 06:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_mahfudhot`
--

CREATE TABLE `monitoring_mahfudhot` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` int(10) UNSIGNED NOT NULL,
  `mahfudhot` varchar(255) NOT NULL,
  `lu` enum('lancar','ulang') NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `feedback_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monitoring_mahfudhot`
--

INSERT INTO `monitoring_mahfudhot` (`id`, `id_siswa`, `mahfudhot`, `lu`, `created_by`, `feedback`, `feedback_by`, `created_at`) VALUES
(1, 4, 'abc', 'lancar', 11, 'oke', 1, '2023-10-21 06:31:09');

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_tahfidz`
--

CREATE TABLE `monitoring_tahfidz` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` int(10) UNSIGNED NOT NULL,
  `id_surah` tinyint(3) UNSIGNED NOT NULL,
  `ayat` varchar(16) NOT NULL,
  `lu` enum('lancar','ulang') NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `feedback_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monitoring_tahfidz`
--

INSERT INTO `monitoring_tahfidz` (`id`, `id_siswa`, `id_surah`, `ayat`, `lu`, `created_by`, `feedback`, `feedback_by`, `created_at`) VALUES
(1, 4, 3, '123', 'lancar', NULL, 'terimakasih', 1, '2023-10-18 05:54:35'),
(2, 4, 2, '1-100', 'lancar', 11, 'terimakasih banyak', 1, '2023-10-21 06:27:57'),
(3, 4, 1, '1', 'lancar', 11, 'makasih pak', 1, '2023-11-06 05:53:02');

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_tahsin`
--

CREATE TABLE `monitoring_tahsin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` int(10) UNSIGNED NOT NULL,
  `n` tinyint(3) UNSIGNED NOT NULL,
  `tipe` enum('iqro','juz') NOT NULL,
  `halaman` smallint(5) NOT NULL,
  `lu` enum('lancar','ulang') NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `feedback_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monitoring_tahsin`
--

INSERT INTO `monitoring_tahsin` (`id`, `id_siswa`, `n`, `tipe`, `halaman`, `lu`, `created_by`, `feedback`, `feedback_by`, `created_at`) VALUES
(2, 4, 1, 'iqro', 10, 'lancar', NULL, 'abcd', 1, '2023-10-18 04:51:29'),
(3, 4, 1, 'iqro', 1, 'lancar', NULL, 'asdfasdfasdf', 1, '2023-10-18 05:13:11'),
(4, 5, 1, 'iqro', 12, 'lancar', 15, NULL, NULL, '2023-10-21 06:11:42'),
(5, 4, 1, 'iqro', 10, 'lancar', 11, 'terimakasih', 1, '2023-11-06 05:49:58'),
(6, 4, 1, 'iqro', 45, 'lancar', 11, 'baik', 1, '2023-11-08 05:01:17'),
(7, 4, 4, 'iqro', 124, 'lancar', NULL, 'okee', 1, '2023-11-13 07:36:52');

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
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orang_tua`
--

INSERT INTO `orang_tua` (`id`, `id_kk`, `nik`, `nama`, `email`, `jk`, `agama`, `goldar`, `pekerjaan`, `pendidikan`, `telp`, `tmp_lahir`, `tgl_lahir`, `alamat`, `foto`, `created_at`, `updated_at`) VALUES
(1, 3, '1634567890098765', 'Ayah', 'ayah@gmail.com', 'L', 1, 1, 1, 1, '081231231234', 'solo', '2023-09-01', 'solo', NULL, '2023-09-20 04:28:44', '2023-11-14 06:51:38'),
(2, 3, '1214215621212313', 'Ibu', 'ibu@gmail.com', 'P', 1, 2, 1, 1, '089274517442', 'solo', '2023-09-02', 'solo', NULL, '2023-09-20 04:28:44', NULL),
(4, 1, '3314110809910001', 'Ayahe angga', 'ayahangga@gmail.com', 'L', 1, 1, 2, 10, '08123156732', 'Solo', '2023-09-01', 'Solo', '2023_09_20__03_07_20_Andhika-Saedya-transformed.png', '2023-09-20 03:07:20', '2023-11-17 13:35:36'),
(6, 1, '3314150809018605', 'Ibu 1', 'ibuangga@gmail.com', 'P', 1, 3, 4, 10, '081265345141', 'sragen', '2023-09-01', 'Solo', NULL, '2023-09-20 03:24:12', '2023-09-23 00:59:59'),
(7, 1, '3314150853678005', 'Ibu 2', 'Ibuuuu@gmail.com', 'P', 1, 3, 1, 11, '08115856732', 'sragen', '2023-08-27', 'Solo', NULL, '2023-09-20 03:55:00', '2023-09-23 01:00:04');

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
(1, 'pengumuman', 'halo gaisss', '2023-07-27 07:17:05', '2023-09-27 04:22:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan_data_harian`
--

CREATE TABLE `pertanyaan_data_harian` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_data_harian` int(10) UNSIGNED NOT NULL,
  `pertanyaan` text NOT NULL,
  `tipe` enum('opsi','isian') NOT NULL,
  `list_opsi` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pertanyaan_data_harian`
--

INSERT INTO `pertanyaan_data_harian` (`id`, `id_data_harian`, `pertanyaan`, `tipe`, `list_opsi`, `created_at`, `updated_at`) VALUES
(1, 6, 'ascasc', 'isian', NULL, '2023-12-01 09:06:04', NULL),
(2, 6, 'ascasc', 'opsi', '[\"ya\",\"tidak\"]', '2023-12-01 09:06:04', NULL);

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
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `id_kk`, `nik`, `nis`, `nama`, `jk`, `agama`, `goldar`, `pendidikan`, `telp`, `tmp_lahir`, `tgl_lahir`, `alamat`, `foto`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, '3314110809010001', '123453', 'Angga', 'L', 4, 1, NULL, '08123456789', 'sragenn', '2023-08-10', 'Sragen', NULL, 'aktif', '2023-08-14 07:32:54', '2023-08-14 07:32:54'),
(3, 1, '3314150809010905', '321', 'paull', 'L', 1, 1, NULL, NULL, 'sragen', '2023-07-30', 'Sragen 2', '2023_08_14__07_59_11_Andhika-Saedya-transformed.png', 'aktif', '2023-08-14 07:51:59', '2023-08-14 07:59:11'),
(4, 3, '3314150809010685', '1234588', 'A', 'L', 1, 1, NULL, '08123456789', 'solo', '2023-07-31', 'solo', '2023_08_14__08_01_43_lokasi-logo-25373.png', 'aktif', '2023-08-14 08:01:43', '2023-08-14 08:01:43'),
(5, 5, '3314150809636905', '321115', 'Andi', 'P', 1, 2, NULL, '0812345326543', 'Sleman', '2023-08-25', 'sleman', NULL, 'aktif', '2023-08-14 08:16:50', '2023-08-14 08:16:50'),
(6, 6, '3314110346210001', '14678', 'ABCDES', 'L', 1, 1, NULL, '08923456789', 'sragen', '2023-08-01', 'Sragen', NULL, 'aktif', '2023-08-23 03:40:21', '2023-08-23 03:40:21');

-- --------------------------------------------------------

--
-- Table structure for table `surah`
--

CREATE TABLE `surah` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jumlah_ayat` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surah`
--

INSERT INTO `surah` (`id`, `nama`, `jumlah_ayat`) VALUES
(1, 'Al-Fatiha', 7),
(2, 'Al-Baqara', 286),
(3, 'Aal-Imran', 200),
(4, 'An-Nisaa\'', 176),
(5, 'Al-Ma\'ida', 120),
(6, 'Al-An\'am', 165),
(7, 'Al-A\'raf', 206),
(8, 'Al-Anfal', 75),
(9, 'Al-Tawba', 129),
(10, 'Yunus', 109),
(11, 'Hud', 123),
(12, 'Yusuf', 111),
(13, 'Ar-Ra\'d', 43),
(14, 'Ibrahim', 52),
(15, 'Al-Hijr', 99),
(16, 'An-Nahl', 128),
(17, 'Al-Israa', 111),
(18, 'Al-Kahf', 110),
(19, 'Maryam', 98),
(20, 'Ta-Ha', 135),
(21, 'Al-Anbiya', 112),
(22, 'Al-Hajj', 78),
(23, 'Al-Muminun', 118),
(24, 'An-Nur', 64),
(25, 'Al-Furqan', 77),
(26, 'Ash-Shuara', 227),
(27, 'An-Naml', 93),
(28, 'Al-Qasas', 88),
(29, 'Al-Ankabut', 69),
(30, 'Ar-Rum', 60),
(31, 'Luqman', 34),
(32, 'As-Sajdah', 30),
(33, 'Al-Ahzab', 73),
(34, 'Saba', 54),
(35, 'Fatir', 45),
(36, 'Yasin', 83),
(37, 'As-Saffat', 182),
(38, 'Sad', 88),
(39, 'Az-Zumar', 75),
(40, 'Ghafir', 85),
(41, 'Fussilat', 54),
(42, 'Ash-Shura', 53),
(43, 'Az-Zukhruf', 89),
(44, 'Ad-Dukhan', 59),
(45, 'Al-Jathiya', 37),
(46, 'Al-Ahqaf', 35),
(47, 'Muhammad', 38),
(48, 'Al-Fath', 29),
(49, 'Al-Hujurat', 18),
(50, 'Qaf', 45),
(51, 'Az-Zariyat', 60),
(52, 'At-Tur', 49),
(53, 'An-Najm', 62),
(54, 'Al-Qamar', 55),
(55, 'Ar-Rahman', 78),
(56, 'Al-Waqia', 96),
(57, 'Al-Hadid', 29),
(58, 'Al-Mujadilah', 22),
(59, 'Al-Hashr', 24),
(60, 'Al-Mumtahinah', 13),
(61, 'As-Saff', 14),
(62, 'Al-Jumu\'ah', 11),
(63, 'Al-Munafiqun', 11),
(64, 'At-Taghabun', 18),
(65, 'At-Talaq', 12),
(66, 'At-Tahrim', 12),
(67, 'Al-Mulk', 30),
(68, 'Al-Qalam', 52),
(69, 'Al-Haqqah', 52),
(70, 'Al-Ma\'arij', 44),
(71, 'Nuh', 28),
(72, 'Al-Jinn', 28),
(73, 'Al-Muzzammil', 20),
(74, 'Al-Muddaththir', 56),
(75, 'Al-Qiyamah', 40),
(76, 'Al-Insan', 31),
(77, 'Al-Mursalat', 50),
(78, 'An-Naba', 40),
(79, 'An-Naziat', 46),
(80, 'Abasa', 42),
(81, 'At-Takwir', 29),
(82, 'Al-Infitar', 19),
(83, 'Al-Mutaffifin', 36),
(84, 'Al-Inshiqaq', 25),
(85, 'Al-Buruj', 22),
(86, 'At-Tariq', 17),
(87, 'Al-Ala', 19),
(88, 'Al-Ghashiyah', 26),
(89, 'Al-Fajr', 30),
(90, 'Al-Balad', 20),
(91, 'Ash-Shams', 15),
(92, 'Al-Lail', 21),
(93, 'Ad-Duha', 11),
(94, 'Ash-Sharh', 8),
(95, 'At-Tin', 8),
(96, 'Al-Alaq', 19),
(97, 'Al-Qadr', 5),
(98, 'Al-Bayinah', 8),
(99, 'Az-Zalzalah', 8),
(100, 'Al-Adiyat', 11),
(101, 'Al-Qariah', 11),
(102, 'Al-Takathur', 8),
(103, 'Al-Asr', 3),
(104, 'Al-Humazah', 9),
(105, 'Al-Fil', 5),
(106, 'Quraish', 4),
(107, 'Al-Ma\'un', 7),
(108, 'Al-Kauthar', 3),
(109, 'Al-Kafirun', 6),
(110, 'An-Nasr', 3),
(111, 'Al-Masad', 5),
(112, 'Al-Ikhlas', 4),
(113, 'Al-Falaq', 5),
(114, 'An-Nas', 6);

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
(10, '2043/2044', '2023-08-23 03:42:49', '2023-08-23 03:42:49'),
(11, '2037/2038', '2023-09-15 03:31:13', '2023-09-15 03:31:13'),
(12, '2031/2032', '2023-09-26 06:24:25', '2023-09-26 06:24:25'),
(13, '2032/2033', '2023-09-26 06:25:15', '2023-09-26 06:25:15');

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
(30, 1);

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
(1, 'admin', 'admin@gmail.com', '$2y$10$iqO92iUBxlecYnPIzREt6O/nUf90PWyAoU.x7fIxnq0MJ409M8lt2', NULL, NULL, 'dFEFgsHqBa83DKl0ajCe4HJLef0yB3akDHEiB8GwmdJIpfPe0wMhC6UGsWRA', '2023-07-27 12:15:00', '2023-11-13 08:44:22'),
(11, 'guru', 'guru001@gmail.com', '$2y$10$nkbNg2CuYC1XctKjmTDLQenw2efFdjEmS.I3xR1twt3j5tWt2k3e6', 4, NULL, NULL, '2023-08-14 08:18:51', '2023-10-02 07:20:26'),
(13, 'orang_tua', 'ayah@gmail.com', '$2y$10$ZJQjennnqoePQv3YbTDtv./X95CbZ9nFXzRG8S5ZI3HtQJPbY43ne', NULL, 1, NULL, '2023-10-02 08:04:32', '2023-10-02 08:04:40'),
(14, 'orang_tua', 'ayahangga@gmail.com', '$2y$10$Mu6GmYhKo.n3G5xaY0jYSekvRuraMLvwl//pHahrM4cBHeTvdP3BW', NULL, 4, NULL, '2023-10-02 08:05:40', '2023-10-02 08:05:48'),
(15, 'guru', 'anton321@gmail.com', '$2y$10$H1BWv0t5xAlygmqVM27WyOJfmc6/rOufNZnUeOAG0x61Vv0RMXH2e', 8, NULL, NULL, '2023-10-11 07:48:20', '2023-10-17 03:47:12');

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
-- Indexes for table `data_harian`
--
ALTER TABLE `data_harian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bulan` (`bulan`),
  ADD KEY `tahun` (`tahun`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`);

--
-- Indexes for table `data_harian_isian`
--
ALTER TABLE `data_harian_isian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`),
  ADD KEY `tgl_mulai` (`tgl_mulai`),
  ADD KEY `tgl_selesai` (`tgl_selesai`);
ALTER TABLE `data_harian_isian` ADD FULLTEXT KEY `pertanyaan` (`pertanyaan`);

--
-- Indexes for table `data_harian_isian_kelas`
--
ALTER TABLE `data_harian_isian_kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_data` (`id_data`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `data_harian_yn`
--
ALTER TABLE `data_harian_yn`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`),
  ADD KEY `tgl_mulai` (`tgl_mulai`),
  ADD KEY `tgl_selesai` (`tgl_selesai`);
ALTER TABLE `data_harian_yn` ADD FULLTEXT KEY `pertanyaan` (`pertanyaan`);

--
-- Indexes for table `data_harian_yn_kelas`
--
ALTER TABLE `data_harian_yn_kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_data` (`id_data`),
  ADD KEY `id_kelas` (`id_kelas`);

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
-- Indexes for table `monitoring_doa`
--
ALTER TABLE `monitoring_doa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `doa` (`doa`),
  ADD KEY `lu` (`lu`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `feedback_by` (`feedback_by`);
ALTER TABLE `monitoring_doa` ADD FULLTEXT KEY `feedback` (`feedback`);

--
-- Indexes for table `monitoring_hadits`
--
ALTER TABLE `monitoring_hadits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `hadits` (`hadits`),
  ADD KEY `lu` (`lu`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `feedback_by` (`feedback_by`);
ALTER TABLE `monitoring_hadits` ADD FULLTEXT KEY `feedback` (`feedback`);

--
-- Indexes for table `monitoring_harian_isian`
--
ALTER TABLE `monitoring_harian_isian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_at` (`updated_at`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `id_data` (`id_data`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `tanggal` (`tanggal`);

--
-- Indexes for table `monitoring_harian_yn`
--
ALTER TABLE `monitoring_harian_yn`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_at` (`updated_at`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `id_data` (`id_data`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `tanggal` (`tanggal`);

--
-- Indexes for table `monitoring_mahfudhot`
--
ALTER TABLE `monitoring_mahfudhot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `mafudhot` (`mahfudhot`),
  ADD KEY `lu` (`lu`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `feedback_by` (`feedback_by`);
ALTER TABLE `monitoring_mahfudhot` ADD FULLTEXT KEY `feedback` (`feedback`);

--
-- Indexes for table `monitoring_tahfidz`
--
ALTER TABLE `monitoring_tahfidz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_surah` (`id_surah`),
  ADD KEY `lu` (`lu`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `feedback_by` (`feedback_by`);
ALTER TABLE `monitoring_tahfidz` ADD FULLTEXT KEY `feedback` (`feedback`);

--
-- Indexes for table `monitoring_tahsin`
--
ALTER TABLE `monitoring_tahsin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `n` (`n`),
  ADD KEY `tipe` (`tipe`),
  ADD KEY `lu` (`lu`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `feedback_by` (`feedback_by`);
ALTER TABLE `monitoring_tahsin` ADD FULLTEXT KEY `feedback` (`feedback`);

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
  ADD KEY `created_at` (`created_at`);
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
-- Indexes for table `pertanyaan_data_harian`
--
ALTER TABLE `pertanyaan_data_harian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_data_harian` (`id_data_harian`),
  ADD KEY `tipe` (`tipe`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`);
ALTER TABLE `pertanyaan_data_harian` ADD FULLTEXT KEY `pertanyaan` (`pertanyaan`);

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
  ADD KEY `status` (`status`);
ALTER TABLE `siswa` ADD FULLTEXT KEY `alamat` (`alamat`);

--
-- Indexes for table `surah`
--
ALTER TABLE `surah`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`),
  ADD KEY `jumlah_ayat` (`jumlah_ayat`);

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
-- AUTO_INCREMENT for table `data_harian`
--
ALTER TABLE `data_harian`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `data_harian_isian`
--
ALTER TABLE `data_harian_isian`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `data_harian_isian_kelas`
--
ALTER TABLE `data_harian_isian_kelas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `data_harian_yn`
--
ALTER TABLE `data_harian_yn`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `data_harian_yn_kelas`
--
ALTER TABLE `data_harian_yn_kelas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `kk`
--
ALTER TABLE `kk`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `monitoring_doa`
--
ALTER TABLE `monitoring_doa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `monitoring_hadits`
--
ALTER TABLE `monitoring_hadits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `monitoring_harian_isian`
--
ALTER TABLE `monitoring_harian_isian`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `monitoring_harian_yn`
--
ALTER TABLE `monitoring_harian_yn`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `monitoring_mahfudhot`
--
ALTER TABLE `monitoring_mahfudhot`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `monitoring_tahfidz`
--
ALTER TABLE `monitoring_tahfidz`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `monitoring_tahsin`
--
ALTER TABLE `monitoring_tahsin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orang_tua`
--
ALTER TABLE `orang_tua`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- AUTO_INCREMENT for table `pertanyaan_data_harian`
--
ALTER TABLE `pertanyaan_data_harian`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `surah`
--
ALTER TABLE `surah`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tahun_ajaran_aktif`
--
ALTER TABLE `tahun_ajaran_aktif`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_harian`
--
ALTER TABLE `data_harian`
  ADD CONSTRAINT `data_harian_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_harian_isian_kelas`
--
ALTER TABLE `data_harian_isian_kelas`
  ADD CONSTRAINT `data_harian_isian_kelas_ibfk_1` FOREIGN KEY (`id_data`) REFERENCES `data_harian_isian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_harian_isian_kelas_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_harian_yn_kelas`
--
ALTER TABLE `data_harian_yn_kelas`
  ADD CONSTRAINT `data_harian_yn_kelas_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_harian_yn_kelas_ibfk_3` FOREIGN KEY (`id_data`) REFERENCES `data_harian_yn` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `monitoring_doa`
--
ALTER TABLE `monitoring_doa`
  ADD CONSTRAINT `monitoring_doa_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_doa_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_doa_ibfk_3` FOREIGN KEY (`feedback_by`) REFERENCES `orang_tua` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `monitoring_hadits`
--
ALTER TABLE `monitoring_hadits`
  ADD CONSTRAINT `monitoring_hadits_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_hadits_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_hadits_ibfk_3` FOREIGN KEY (`feedback_by`) REFERENCES `orang_tua` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `monitoring_harian_isian`
--
ALTER TABLE `monitoring_harian_isian`
  ADD CONSTRAINT `monitoring_harian_isian_ibfk_1` FOREIGN KEY (`id_data`) REFERENCES `data_harian_isian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_harian_isian_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_harian_isian_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `orang_tua` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `monitoring_harian_yn`
--
ALTER TABLE `monitoring_harian_yn`
  ADD CONSTRAINT `monitoring_harian_yn_ibfk_1` FOREIGN KEY (`id_data`) REFERENCES `data_harian_yn` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_harian_yn_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_harian_yn_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `orang_tua` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `monitoring_mahfudhot`
--
ALTER TABLE `monitoring_mahfudhot`
  ADD CONSTRAINT `monitoring_mahfudhot_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_mahfudhot_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_mahfudhot_ibfk_3` FOREIGN KEY (`feedback_by`) REFERENCES `orang_tua` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `monitoring_tahfidz`
--
ALTER TABLE `monitoring_tahfidz`
  ADD CONSTRAINT `monitoring_tahfidz_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_tahfidz_ibfk_2` FOREIGN KEY (`id_surah`) REFERENCES `surah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_tahfidz_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_tahfidz_ibfk_4` FOREIGN KEY (`feedback_by`) REFERENCES `orang_tua` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `monitoring_tahsin`
--
ALTER TABLE `monitoring_tahsin`
  ADD CONSTRAINT `monitoring_tahsin_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_tahsin_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_tahsin_ibfk_3` FOREIGN KEY (`feedback_by`) REFERENCES `orang_tua` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

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
-- Constraints for table `pertanyaan_data_harian`
--
ALTER TABLE `pertanyaan_data_harian`
  ADD CONSTRAINT `pertanyaan_data_harian_ibfk_1` FOREIGN KEY (`id_data_harian`) REFERENCES `data_harian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
