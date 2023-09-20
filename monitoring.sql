-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2023 at 05:46 AM
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
(8, '3314150809010208', '124415322286765', 'Angga 123123', 'anton321@gmail.com', 'L', 4, 4, 2, 11, '081233456732', 'surakarta', '2023-08-16', 'Sragen 2', NULL, 'non-aktif', '2023-08-03 13:07:34', '2023-09-20 03:39:52', NULL),
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
(14, '3', 'D', 1, 6, '2023-09-15 03:28:21', '2023-09-15 03:28:21', NULL);

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
  `lokasi` enum('sekolah','rumah') NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monitoring_doa`
--

INSERT INTO `monitoring_doa` (`id`, `id_siswa`, `doa`, `lu`, `lokasi`, `created_by`, `created_at`) VALUES
(3, 5, 'r5refsd', 'ulang', 'sekolah', NULL, '2023-09-16 08:01:57'),
(4, 5, 'vas', 'lancar', 'sekolah', NULL, '2023-09-16 08:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_hadits`
--

CREATE TABLE `monitoring_hadits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` int(10) UNSIGNED NOT NULL,
  `hadits` varchar(255) NOT NULL,
  `lu` enum('lancar','ulang') NOT NULL,
  `lokasi` enum('sekolah','rumah') NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monitoring_hadits`
--

INSERT INTO `monitoring_hadits` (`id`, `id_siswa`, `hadits`, `lu`, `lokasi`, `created_by`, `created_at`) VALUES
(3, 4, 'afg', 'lancar', 'sekolah', NULL, '2023-09-16 07:56:22'),
(4, 4, '3td', 'lancar', 'sekolah', NULL, '2023-09-16 07:56:25'),
(5, 4, 'abc', 'lancar', 'rumah', NULL, '2023-09-19 04:17:30');

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_mahfudhot`
--

CREATE TABLE `monitoring_mahfudhot` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` int(10) UNSIGNED NOT NULL,
  `mahfudhot` varchar(255) NOT NULL,
  `lu` enum('lancar','ulang') NOT NULL,
  `lokasi` enum('sekolah','rumah') NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monitoring_mahfudhot`
--

INSERT INTO `monitoring_mahfudhot` (`id`, `id_siswa`, `mahfudhot`, `lu`, `lokasi`, `created_by`, `created_at`) VALUES
(2, 3, 'ad 23', 'lancar', 'sekolah', NULL, '2023-09-16 07:41:12'),
(3, 3, 'qaa', 'ulang', 'sekolah', NULL, '2023-09-16 07:41:22'),
(4, 5, 'AWS', 'lancar', 'sekolah', NULL, '2023-09-19 03:49:25'),
(5, 4, 'ABC', 'lancar', 'rumah', NULL, '2023-09-19 04:04:11');

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
  `lokasi` enum('sekolah','rumah') NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monitoring_tahfidz`
--

INSERT INTO `monitoring_tahfidz` (`id`, `id_siswa`, `id_surah`, `ayat`, `lu`, `lokasi`, `created_by`, `created_at`) VALUES
(1, 4, 1, '1', 'lancar', 'sekolah', NULL, '2023-09-19 03:39:09'),
(2, 4, 2, '12', 'ulang', 'sekolah', NULL, '2023-09-19 03:42:38'),
(4, 3, 3, '10-50', 'lancar', 'sekolah', NULL, '2023-09-19 03:57:14'),
(5, 3, 1, '1-7', 'lancar', 'rumah', NULL, '2023-09-19 04:01:12'),
(6, 5, 4, '1', 'lancar', 'sekolah', NULL, '2023-09-19 04:07:36');

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
  `lokasi` enum('sekolah','rumah') NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monitoring_tahsin`
--

INSERT INTO `monitoring_tahsin` (`id`, `id_siswa`, `n`, `tipe`, `halaman`, `lu`, `lokasi`, `created_by`, `created_at`) VALUES
(8, 4, 2, 'iqro', 18, 'lancar', 'sekolah', NULL, '2023-09-13 13:01:25'),
(9, 4, 2, 'iqro', 100, 'lancar', 'sekolah', NULL, '2023-09-15 03:34:14'),
(10, 3, 1, 'iqro', 15, 'ulang', 'sekolah', NULL, '2023-09-15 03:36:54'),
(11, 4, 1, 'iqro', 10, 'lancar', 'sekolah', NULL, '2023-09-19 03:54:28'),
(12, 4, 1, 'iqro', 111, 'lancar', 'rumah', NULL, '2023-09-19 03:55:58'),
(13, 6, 1, 'iqro', 123, 'lancar', 'rumah', NULL, '2023-09-19 04:07:59'),
(14, 2, 1, 'iqro', 123, 'lancar', 'sekolah', NULL, '2023-09-19 04:17:16');

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
(1, 3, '1634567890098765', 'Ayah', 'ayah@gmail.com', 'L', 1, 1, 1, 1, '081231231234', 'solo', '2023-09-01', 'solo', NULL, '2023-09-20 04:28:44', NULL),
(2, 3, '1214215621212313', 'Ibu', 'ibu@gmail.com', 'P', 1, 2, 1, 1, '089274517442', 'solo', '2023-09-02', 'solo', NULL, '2023-09-20 04:28:44', NULL),
(4, 1, '3314110809910001', 'Ayah Angga', 'ayahangga@gmail.com', 'L', 1, 1, 4, 10, '08123156732', 'Solo', '2023-09-01', 'Solo', '2023_09_20__03_07_20_Andhika-Saedya-transformed.png', '2023-09-20 03:07:20', '2023-09-20 03:07:20'),
(6, 1, '3314150809018605', 'Ibu Angga', 'ibuangga@gmail.com', 'P', 1, 1, 1, 10, '081265345141', 'sragen', '2023-09-01', 'Solo', NULL, '2023-09-20 03:24:12', '2023-09-20 03:24:12');

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
(11, '2037/2038', '2023-09-15 03:31:13', '2023-09-15 03:31:13');

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
(1, 'admin', 'admin@gmail.com', '$2y$10$W5v5GzmFnQwSAAETT4ls1OKho2joKUg74A.2/RufKP8ZRfJpeqcWO', NULL, NULL, 'yWWLMhRJHGiflzGA9DXFliW9OIb4qdqfEJJLhkNDoYuXBVC6jsgcy79yVHg9', '2023-07-27 12:15:00', NULL),
(11, 'guru', 'guru001@gmail.com', '$2y$10$1OtCw2oVhV8AwQgfTh2Dlursg/9TVWIdXI3TQlfXX9A1VFbUWgUg6', 4, NULL, NULL, '2023-08-14 08:18:51', '2023-08-23 03:50:14'),
(12, 'orang_tua', 'anton@gmail.com', '$2y$10$QG0vR.SZozIW..f0J4mKFOy2vWUXxsRKvz4cmWpxH6iVMccNvrNRS', NULL, 1, NULL, '2023-09-15 03:32:00', '2023-09-15 03:32:00');

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
-- Indexes for table `monitoring_doa`
--
ALTER TABLE `monitoring_doa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `doa` (`doa`),
  ADD KEY `lu` (`lu`),
  ADD KEY `lokasi` (`lokasi`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `monitoring_hadits`
--
ALTER TABLE `monitoring_hadits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `hadits` (`hadits`),
  ADD KEY `lu` (`lu`),
  ADD KEY `lokasi` (`lokasi`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `monitoring_mahfudhot`
--
ALTER TABLE `monitoring_mahfudhot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `mafudhot` (`mahfudhot`),
  ADD KEY `lu` (`lu`),
  ADD KEY `lokasi` (`lokasi`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `monitoring_tahfidz`
--
ALTER TABLE `monitoring_tahfidz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_surah` (`id_surah`),
  ADD KEY `lu` (`lu`),
  ADD KEY `lokasi` (`lokasi`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `monitoring_tahsin`
--
ALTER TABLE `monitoring_tahsin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `n` (`n`),
  ADD KEY `tipe` (`tipe`),
  ADD KEY `lu` (`lu`),
  ADD KEY `lokasi` (`lokasi`),
  ADD KEY `created_by` (`created_by`),
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
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `monitoring_hadits`
--
ALTER TABLE `monitoring_hadits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `monitoring_mahfudhot`
--
ALTER TABLE `monitoring_mahfudhot`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `monitoring_tahfidz`
--
ALTER TABLE `monitoring_tahfidz`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `monitoring_tahsin`
--
ALTER TABLE `monitoring_tahsin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orang_tua`
--
ALTER TABLE `orang_tua`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tahun_ajaran_aktif`
--
ALTER TABLE `tahun_ajaran_aktif`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- Constraints for table `monitoring_doa`
--
ALTER TABLE `monitoring_doa`
  ADD CONSTRAINT `monitoring_doa_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_doa_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `guru` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `monitoring_hadits`
--
ALTER TABLE `monitoring_hadits`
  ADD CONSTRAINT `monitoring_hadits_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_hadits_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `guru` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `monitoring_mahfudhot`
--
ALTER TABLE `monitoring_mahfudhot`
  ADD CONSTRAINT `monitoring_mahfudhot_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_mahfudhot_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `guru` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `monitoring_tahfidz`
--
ALTER TABLE `monitoring_tahfidz`
  ADD CONSTRAINT `monitoring_tahfidz_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_tahfidz_ibfk_2` FOREIGN KEY (`id_surah`) REFERENCES `surah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_tahfidz_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `guru` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `monitoring_tahsin`
--
ALTER TABLE `monitoring_tahsin`
  ADD CONSTRAINT `monitoring_tahsin_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_tahsin_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `guru` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

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
