-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2024 at 08:16 AM
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
(10, 'ABC'),
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
(21, 2, 2024, 18, '2024-02-23 01:03:47', '2024-02-23 01:03:47'),
(22, 2, 2024, 19, '2024-02-23 01:04:35', '2024-02-23 01:04:35'),
(23, 5, 2024, 19, '2024-05-31 10:10:37', '2024-05-31 10:10:37');

-- --------------------------------------------------------

--
-- Table structure for table `doa`
--

CREATE TABLE `doa` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doa`
--

INSERT INTO `doa` (`id`, `nama`) VALUES
(6, 'Keluar Kamar Mandi'),
(4, 'Keluar Masjid'),
(2, 'Makan dan minum'),
(5, 'Masuk Kamar Mandi'),
(3, 'Masuk Masjid');

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
(7, 'AE'),
(2, 'B'),
(3, 'O');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(10) UNSIGNED NOT NULL,
  `nik` char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nsm` char(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` tinyint(3) UNSIGNED NOT NULL,
  `goldar` tinyint(3) UNSIGNED NOT NULL,
  `pekerjaan` smallint(5) UNSIGNED DEFAULT NULL,
  `pendidikan` smallint(5) UNSIGNED DEFAULT NULL,
  `telp` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmp_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('aktif','non-aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nik`, `nsm`, `nama`, `email`, `jk`, `agama`, `goldar`, `pekerjaan`, `pendidikan`, `telp`, `tmp_lahir`, `tgl_lahir`, `alamat`, `foto`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2582668149791338', NULL, 'Ratih Wahyuni', 'ratihwahyuni@gmail.com', 'P', 1, 4, NULL, NULL, NULL, 'Bantul', '1992-12-12', 'Bantul', NULL, 'aktif', '2024-02-21 13:02:24', NULL, NULL),
(2, '2363395548413331', NULL, 'Jasmin Prastuti', 'jasminprastuti@gmail.com', 'P', 1, 1, NULL, NULL, NULL, 'Bantul', '1995-02-09', 'Bantul', NULL, 'aktif', '2024-02-21 13:02:24', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hadits`
--

CREATE TABLE `hadits` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hadits`
--

INSERT INTO `hadits` (`id`, `nama`) VALUES
(6, 'Agama adalah Nasihat'),
(5, 'Halal dan Haram'),
(3, 'Islam, Iman dan Ihsan'),
(8, 'Menahan Amarah'),
(7, 'Mengerjakan Perintah Sesuai Batas Kesanggupan'),
(2, 'Niat Penentu Amal Perbuatan'),
(4, 'Rukun Islam');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(10) UNSIGNED NOT NULL,
  `tingkatan` enum('1','2','3','4','5','6') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_tahun_ajaran` int(10) UNSIGNED NOT NULL,
  `id_guru` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `tingkatan`, `nama`, `id_tahun_ajaran`, `id_guru`, `created_at`, `updated_at`, `deleted_at`) VALUES
(18, '2', NULL, 3, 2, '2024-02-22 00:43:59', '2024-02-22 00:43:59', NULL),
(19, '1', NULL, 3, 1, '2024-02-22 02:02:48', '2024-02-22 02:02:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelas_siswa`
--

CREATE TABLE `kelas_siswa` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_siswa` int(10) UNSIGNED NOT NULL,
  `id_kelas` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas_siswa`
--

INSERT INTO `kelas_siswa` (`id`, `id_siswa`, `id_kelas`, `created_at`, `updated_at`) VALUES
(46, 3, 18, '2024-02-22 02:00:07', NULL),
(47, 9, 18, '2024-02-22 02:00:07', NULL),
(48, 10, 18, '2024-02-22 02:00:07', NULL),
(49, 11, 18, '2024-02-22 02:00:07', NULL),
(50, 2, 18, '2024-02-22 02:00:07', NULL),
(51, 4, 19, '2024-02-22 02:06:53', NULL),
(52, 5, 19, '2024-02-22 02:06:53', NULL),
(53, 6, 19, '2024-02-22 02:06:53', NULL),
(54, 8, 19, '2024-02-22 02:06:53', NULL),
(55, 12, 19, '2024-02-22 02:06:53', NULL),
(56, 13, 19, '2024-05-31 10:20:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kk`
--

CREATE TABLE `kk` (
  `id` int(10) UNSIGNED NOT NULL,
  `no_kk` char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kk`
--

INSERT INTO `kk` (`id`, `no_kk`, `updated_at`, `created_at`) VALUES
(1, '1234567890123456', '2023-08-10 09:01:35', '2023-08-10 09:01:35'),
(3, '1231211111111111', '2023-08-10 09:10:41', '2023-08-10 09:10:41'),
(5, '1231211111111146', '2023-08-14 08:15:06', '2023-08-14 08:15:06'),
(6, '1231211111211146', '2023-08-23 03:36:31', '2023-08-23 03:36:31'),
(9, '7896417867454573', NULL, NULL),
(10, '8747561943032509', NULL, NULL),
(11, '5852855020025290', NULL, NULL),
(12, '8538660763751405', NULL, NULL),
(13, '1399733792565701', NULL, NULL),
(14, '6642227171951529', NULL, NULL),
(15, '8631724790134725', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kunci_monitoring_harian`
--

CREATE TABLE `kunci_monitoring_harian` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_data_harian` int(10) UNSIGNED NOT NULL,
  `id_siswa` int(10) UNSIGNED NOT NULL,
  `point` int(10) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mahfudhot`
--

CREATE TABLE `mahfudhot` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahfudhot`
--

INSERT INTO `mahfudhot` (`id`, `nama`) VALUES
(3, 'Bersungguh-sungguh'),
(5, 'Kejujuran'),
(7, 'Kenikmatan'),
(6, 'Ketulusan'),
(8, 'Menolong sesama'),
(4, 'Sabar');

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_doa`
--

CREATE TABLE `monitoring_doa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` int(10) UNSIGNED NOT NULL,
  `id_doa` tinyint(3) UNSIGNED NOT NULL,
  `lu` enum('lancar','ulang') NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `feedback_by` int(10) UNSIGNED DEFAULT NULL,
  `tanggal` date NOT NULL,
  `created_at` datetime NOT NULL,
  `seen_by_ortu` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monitoring_doa`
--

INSERT INTO `monitoring_doa` (`id`, `id_siswa`, `id_doa`, `lu`, `created_by`, `feedback`, `feedback_by`, `tanggal`, `created_at`, `seen_by_ortu`) VALUES
(6, 13, 2, 'lancar', NULL, NULL, NULL, '2024-05-31', '2024-05-31 10:26:28', '0');

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_hadits`
--

CREATE TABLE `monitoring_hadits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` int(10) UNSIGNED NOT NULL,
  `id_hadits` tinyint(3) UNSIGNED NOT NULL,
  `lu` enum('lancar','ulang') NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `feedback_by` int(10) UNSIGNED DEFAULT NULL,
  `tanggal` date NOT NULL,
  `created_at` datetime NOT NULL,
  `seen_by_ortu` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monitoring_hadits`
--

INSERT INTO `monitoring_hadits` (`id`, `id_siswa`, `id_hadits`, `lu`, `created_by`, `feedback`, `feedback_by`, `tanggal`, `created_at`, `seen_by_ortu`) VALUES
(6, 4, 6, 'lancar', NULL, NULL, NULL, '2024-05-31', '2024-05-31 10:34:20', '0'),
(7, 13, 5, 'lancar', NULL, NULL, NULL, '2024-05-31', '2024-05-31 10:34:49', '0');

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_harian`
--

CREATE TABLE `monitoring_harian` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_siswa` int(10) UNSIGNED NOT NULL,
  `id_pertanyaan` int(10) UNSIGNED NOT NULL,
  `jawaban` text DEFAULT NULL,
  `tanggal` date NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monitoring_harian`
--

INSERT INTO `monitoring_harian` (`id`, `id_siswa`, `id_pertanyaan`, `jawaban`, `tanggal`, `created_by`, `created_at`, `updated_at`) VALUES
(30, 4, 19, 'ya', '2024-02-23', 2, '2024-02-23 01:15:42', NULL),
(31, 4, 20, 'membantu menyapu dan mencuci piring', '2024-02-23', 2, '2024-02-23 01:15:42', NULL),
(32, 4, 19, 'ya', '2024-02-02', 2, '2024-02-23 01:16:35', NULL),
(33, 4, 20, 'membantu siram tanaman', '2024-02-02', 2, '2024-02-23 01:16:35', NULL),
(34, 4, 22, 'ya', '2024-05-31', 2, '2024-05-31 11:00:02', NULL),
(35, 13, 22, 'ya', '2024-05-05', 2, '2024-05-31 11:12:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_mahfudhot`
--

CREATE TABLE `monitoring_mahfudhot` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` int(10) UNSIGNED NOT NULL,
  `id_mahfudhot` tinyint(3) UNSIGNED NOT NULL,
  `lu` enum('lancar','ulang') NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `feedback_by` int(10) UNSIGNED DEFAULT NULL,
  `tanggal` date NOT NULL,
  `created_at` datetime NOT NULL,
  `seen_by_ortu` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monitoring_mahfudhot`
--

INSERT INTO `monitoring_mahfudhot` (`id`, `id_siswa`, `id_mahfudhot`, `lu`, `created_by`, `feedback`, `feedback_by`, `tanggal`, `created_at`, `seen_by_ortu`) VALUES
(9, 13, 3, 'lancar', NULL, NULL, NULL, '2024-05-31', '2024-05-31 10:32:01', '0'),
(10, 4, 8, 'lancar', NULL, NULL, NULL, '2024-05-31', '2024-05-31 10:42:02', '0');

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
  `catatan` varchar(255) DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `feedback_by` int(10) UNSIGNED DEFAULT NULL,
  `tanggal` date NOT NULL,
  `created_at` datetime NOT NULL,
  `seen_by_ortu` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monitoring_tahfidz`
--

INSERT INTO `monitoring_tahfidz` (`id`, `id_siswa`, `id_surah`, `ayat`, `lu`, `catatan`, `created_by`, `feedback`, `feedback_by`, `tanggal`, `created_at`, `seen_by_ortu`) VALUES
(5, 3, 2, '1-25', 'lancar', 'lebih diperjelas kembali bacaannya', NULL, NULL, NULL, '2024-05-19', '2024-05-19 14:18:04', '0'),
(6, 4, 78, '1-20', 'lancar', 'Sudah Bagus', NULL, NULL, NULL, '2024-05-20', '2024-05-20 08:27:06', '0'),
(7, 4, 2, '1-20', 'lancar', 'Sudah Bagus', NULL, NULL, NULL, '2024-05-31', '2024-05-31 07:22:09', '0'),
(8, 4, 4, '1-20', 'lancar', 'Sudah Bagus', NULL, NULL, NULL, '2024-05-31', '2024-05-31 10:41:51', '0');

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_tahsin`
--

CREATE TABLE `monitoring_tahsin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` int(10) UNSIGNED NOT NULL,
  `n` tinyint(3) UNSIGNED NOT NULL,
  `tipe` enum('iqro','juz') NOT NULL,
  `halaman` varchar(32) NOT NULL,
  `lu` enum('lancar','ulang') NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `feedback_by` int(10) UNSIGNED DEFAULT NULL,
  `tanggal` date NOT NULL,
  `created_at` datetime NOT NULL,
  `seen_by_ortu` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monitoring_tahsin`
--

INSERT INTO `monitoring_tahsin` (`id`, `id_siswa`, `n`, `tipe`, `halaman`, `lu`, `catatan`, `created_by`, `feedback`, `feedback_by`, `tanggal`, `created_at`, `seen_by_ortu`) VALUES
(6, 2, 12, 'iqro', '1', 'lancar', NULL, NULL, NULL, NULL, '2024-02-28', '2024-03-01 19:08:30', '0'),
(7, 4, 1, 'iqro', '25', 'lancar', 'bacaan lebih ditata lagi', NULL, NULL, NULL, '2024-05-31', '2024-05-31 07:20:39', '1'),
(8, 4, 1, 'iqro', '10', 'lancar', 'bacaan lebih ditata lagi', NULL, NULL, NULL, '2024-05-31', '2024-05-31 07:20:49', '1'),
(9, 13, 1, 'iqro', '10', 'lancar', 'bacaan lebih ditata lagi', NULL, NULL, NULL, '2024-05-31', '2024-05-31 10:20:34', '1');

-- --------------------------------------------------------

--
-- Table structure for table `orang_tua`
--

CREATE TABLE `orang_tua` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_kk` int(10) UNSIGNED NOT NULL,
  `nik` char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` tinyint(3) UNSIGNED NOT NULL,
  `goldar` tinyint(3) UNSIGNED NOT NULL,
  `pekerjaan` smallint(5) UNSIGNED DEFAULT NULL,
  `pendidikan` smallint(5) UNSIGNED DEFAULT NULL,
  `telp` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmp_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orang_tua`
--

INSERT INTO `orang_tua` (`id`, `id_kk`, `nik`, `nama`, `email`, `jk`, `agama`, `goldar`, `pekerjaan`, `pendidikan`, `telp`, `tmp_lahir`, `tgl_lahir`, `alamat`, `foto`, `created_at`, `updated_at`) VALUES
(2, 3, '1214215621212313', 'Elma Hartati', 'elmahartati@gmail.com', 'P', 1, 2, 1, 1, '089274517442', 'Solo', '1992-03-01', 'Solo', NULL, '2023-09-20 04:28:44', '2024-02-21 11:37:58'),
(6, 1, '3314150809018605', 'Amalia Novitasari', 'amalianovitasari@gmail.com', 'P', 1, 3, 1, 10, '081265345141', 'Sragen', '1987-02-03', 'Sragen', NULL, '2023-09-20 03:24:12', '2024-02-21 11:36:34'),
(8, 9, '2938670989801205', 'Eka Iswahyudi', 'ekaiswahyudi@gmail.com', 'L', 1, 1, 1, 2, '088884733724', 'Sleman', '1985-06-01', 'Sleman', NULL, '2024-02-21 12:24:09', NULL),
(9, 10, '1261394734176118', 'Dadi Natsir', 'dadinatsir@gmail.com', 'L', 1, 4, 1, 1, '081290088839', 'Bantul', '1985-06-03', 'Bantul', NULL, '2024-02-21 12:24:09', NULL),
(10, 11, '5221015854971387', 'Purwadi Waluyo', 'purwadiwaluyo@gmail.com', 'L', 1, 2, NULL, NULL, '08544869565', 'Sleman', '1985-06-18', 'Sleman', NULL, '2024-02-21 12:24:09', NULL),
(11, 12, '2393058558891069', 'Enteng Kuswoyo', 'entengkuswoyo@gmail.com', 'L', 1, 3, NULL, NULL, '085132428063', 'Yogyakarta', '1985-02-01', 'Yogyakarta', NULL, '2024-02-21 12:24:09', NULL),
(12, 14, '2769570321658946', 'Harjasa Maulana', 'harjasamaulana@gmail.com', 'L', 1, 1, NULL, NULL, '082275636101', 'Solo', '1985-06-09', 'Solo', NULL, '2024-02-21 12:24:09', NULL),
(13, 15, '5802049577995185', 'Agnes Astuti', 'agnesastuti@gmail.com', 'P', 1, 4, NULL, NULL, NULL, 'Sleman', '1999-01-12', 'Sleman', NULL, '2024-02-21 12:52:51', NULL),
(14, 5, '6053610362289979', 'Tania Wulandari', 'taniawulandari@gmail.com', 'P', 1, 2, NULL, NULL, NULL, 'Bantul', '1991-02-09', 'Bantul', NULL, '2024-02-21 12:52:51', NULL),
(15, 6, '9130035922768820', 'Ida Wijayanti', 'idawijayanti@gmail.com', 'P', 1, 3, NULL, NULL, NULL, 'Sleman', '1994-05-20', 'Sleman', NULL, '2024-02-21 12:52:51', NULL);

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
(7, 'Dosen'),
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
(16, 'PROF'),
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
  `opsi` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(17, 21, 'apakah sudah mengaji ?', 'opsi', '[\"ya\",\"tidak\"]', '2024-02-23 01:03:47', NULL),
(18, 21, 'apakah anak membantu orang tua ? apa yang dibantu oleh anak ?', 'isian', NULL, '2024-02-23 01:03:47', NULL),
(19, 22, 'apakah sudah sholat ?', 'opsi', '[\"ya\",\"tidak\"]', '2024-02-23 01:04:35', NULL),
(20, 22, 'apa yang dilakukan anak ketika dirumah ?', 'isian', NULL, '2024-02-23 01:04:35', NULL),
(21, 23, 'a', 'isian', NULL, '2024-05-31 10:10:37', NULL),
(22, 23, 'b', 'opsi', '[\"ya\",\"tidak\"]', '2024-05-31 10:10:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_kk` int(10) UNSIGNED NOT NULL,
  `nik` char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` tinyint(3) UNSIGNED NOT NULL,
  `goldar` tinyint(3) UNSIGNED DEFAULT NULL,
  `pendidikan` smallint(5) UNSIGNED DEFAULT NULL,
  `telp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmp_lahir` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('non-aktif','aktif','lulus','pindah') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `id_kk`, `nik`, `nis`, `nama`, `jk`, `agama`, `goldar`, `pendidikan`, `telp`, `tmp_lahir`, `tgl_lahir`, `alamat`, `foto`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, '3314110809010001', '123453', 'Atmaja Maulana', 'L', 1, 1, NULL, '08123456789', 'Bantul', '2010-01-20', 'Bantul', NULL, 'aktif', '2023-08-14 07:32:54', '2024-02-21 10:38:25'),
(3, 15, '3314150809010905', '321126', 'Hendra Gunawan', 'L', 1, 1, NULL, NULL, 'Bantul', '2011-06-10', 'Bantul', NULL, 'aktif', '2023-08-14 07:51:59', '2024-02-21 10:39:02'),
(4, 3, '3314150809010685', '1234588', 'Taufan Nainggolan', 'L', 1, 1, NULL, '08123456789', 'Sleman', '2010-01-07', 'Godean', NULL, 'aktif', '2023-08-14 08:01:43', '2024-02-21 10:36:04'),
(5, 5, '3314150809636905', '321115', 'Daniswara Hidayanto', 'L', 1, 2, NULL, '0812345326543', 'Sleman', '2010-02-01', 'Gamping', NULL, 'aktif', '2023-08-14 08:16:50', '2024-02-21 10:37:35'),
(6, 6, '3314110346210001', '14678', 'Hendra Sirait', 'L', 1, 1, NULL, '08923456789', 'Bantul', '2010-03-02', 'Kasihan', NULL, 'aktif', '2023-08-23 03:40:21', '2024-02-21 10:36:49'),
(8, 11, '5851085732965262', '12312312', 'Anita Lestari', 'P', 1, 4, 7, NULL, 'Yogyakarta', '2014-02-05', 'Yogyakarta', NULL, 'aktif', '2024-02-21 11:42:48', NULL),
(9, 14, '2602815764258682', '88246', 'Usyi Oktaviani', 'P', 1, 2, 7, NULL, 'Bantul', '2011-02-09', 'Bantul', NULL, 'aktif', '2024-02-21 11:42:48', NULL),
(10, 9, '7563877722641167', '58879', 'Vera Wijayanti', 'P', 1, 1, 7, NULL, 'Gunung Kidul', '2011-05-20', 'Srandakan', NULL, 'aktif', '2024-02-21 11:42:48', NULL),
(11, 12, '9441657787218956', '25382', 'Novi Pratiwi', 'P', 1, 3, 7, NULL, 'Solo', '2011-02-22', 'Sleman', NULL, 'aktif', '2024-02-21 11:42:48', NULL),
(12, 10, '6018861246747347', '92977', 'Chelsea Hartati', 'P', 1, 1, 7, NULL, 'Sleman', '2011-10-26', 'Sleman', NULL, 'aktif', '2024-02-21 11:42:48', NULL),
(13, 3, '3314150809010149', '24212', 'Angga', 'L', 1, 1, NULL, '081234567323', 'sragen', '2024-04-28', 'Solo', NULL, 'aktif', '2024-05-31 10:19:50', '2024-05-31 10:19:50');

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
  `id` int(10) UNSIGNED NOT NULL,
  `tahun` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `id_tahun_ajaran` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tahun_ajaran_aktif`
--

INSERT INTO `tahun_ajaran_aktif` (`id`, `id_tahun_ajaran`) VALUES
(33, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` enum('admin','guru','orang_tua') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_guru` int(10) UNSIGNED DEFAULT NULL,
  `id_orang_tua` int(10) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `email`, `password`, `id_guru`, `id_orang_tua`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$iqO92iUBxlecYnPIzREt6O/nUf90PWyAoU.x7fIxnq0MJ409M8lt2', NULL, NULL, 'nPgQq5otks1woM8p6XMGUXdNnvAaTm55Xm2wL4HEHlK94ixL4rgmfgiOjK3k', '2023-07-27 12:15:00', '2023-11-13 08:44:22'),
(16, 'orang_tua', 'elmahartati@gmail.com', '$2y$10$GSYdp7AvqF0D3RA3B6J1v.Mx4vjCh8ikQ8S68VfJznmpUl97dlOOO', NULL, 2, NULL, '2024-02-22 02:13:37', '2024-02-22 02:14:06'),
(17, 'orang_tua', 'amalianovitasari@gmail.com', '$2y$10$LLGkgVf6CuALGNO/KgBfSeCDcGvVikcae3yJtquuy7kMAXHS.0WTW', NULL, 6, NULL, '2024-02-22 14:49:30', '2024-02-22 14:49:39'),
(18, 'orang_tua', 'ekaiswahyudi@gmail.com', '$2y$10$J3Y3x2Mkw6IBu0/JByG/1ejsQ1vYP5FgTeLMvXQEAAnUymrbZYS9W', NULL, 8, NULL, '2024-02-22 14:49:47', '2024-02-22 14:50:33'),
(19, 'orang_tua', 'dadinatsir@gmail.com', '$2y$10$JinI1mLa9Yasi2kIitRlJucjy24NsqEu62GkUqdIsdDPiZV0oGGAe', NULL, 9, NULL, '2024-02-22 14:49:53', '2024-02-22 14:50:43'),
(20, 'orang_tua', 'purwadiwaluyo@gmail.com', '$2y$10$ydfxUmxwuUz2JsVTtOQghOv3RmFhU50UM73XnNkM8biP4Pt6CBYMq', NULL, 10, NULL, '2024-02-22 14:49:58', '2024-02-22 14:50:50'),
(21, 'orang_tua', 'entengkuswoyo@gmail.com', '$2y$10$Zo80GEdNfCEdqQRhlrzsWOBJJhKSdQEguAuE1gLYFtcx/bTte7Qm2', NULL, 11, NULL, '2024-02-22 14:50:03', '2024-02-22 14:51:00'),
(22, 'orang_tua', 'harjasamaulana@gmail.com', '$2y$10$5w2QFHLsR6EG2LZFzgvcLen3jHdZkYI0WVxMn0yCUvRVkgr3BTT/i', NULL, 12, NULL, '2024-02-22 14:50:09', '2024-02-22 14:51:12'),
(23, 'orang_tua', 'agnesastuti@gmail.com', '$2y$10$ocqG6vyzgVxlb2j1qY.bHuqhKsjqOxX7OpDB.As9kWpE4gniBDqCy', NULL, 13, NULL, '2024-02-22 14:50:15', '2024-02-22 14:51:21'),
(24, 'orang_tua', 'taniawulandari@gmail.com', '$2y$10$goTzn9DHuOB5dv7m0a/9aOFHZ9mf9KZIpGlZ6Dqr5CWizvflv2pTG', NULL, 14, NULL, '2024-02-22 14:50:20', '2024-02-22 14:51:28'),
(25, 'orang_tua', 'idawijayanti@gmail.com', '$2y$10$Cto9/B5/d56iUOUCp35qS.neqQ55GEv6NZP8bNQ9eW6xk6QQMZQJS', NULL, 15, NULL, '2024-02-22 14:50:24', '2024-02-22 14:50:24'),
(26, 'guru', 'ratihwahyuni@gmail.com', '$2y$10$QuE35KcoF3dksHNWdM2nKuFtGg3HY7evsISaKut9HWMolugQz2zM6', 1, NULL, NULL, '2024-02-22 14:51:35', '2024-02-22 14:51:52'),
(27, 'guru', 'jasminprastuti@gmail.com', '$2y$10$MpSGFwEvhRqmRXxOE2UJQedU3DbuxqI9rZ0HrehJPO3jiqzRO5.3u', 2, NULL, NULL, '2024-02-22 14:51:39', '2024-02-22 14:52:03');

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
-- Indexes for table `doa`
--
ALTER TABLE `doa`
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
  ADD UNIQUE KEY `nip` (`nsm`),
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
-- Indexes for table `hadits`
--
ALTER TABLE `hadits`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

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
-- Indexes for table `kunci_monitoring_harian`
--
ALTER TABLE `kunci_monitoring_harian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_data_harian` (`id_data_harian`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `tanggal` (`tanggal`),
  ADD KEY `point` (`point`);

--
-- Indexes for table `mahfudhot`
--
ALTER TABLE `mahfudhot`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `monitoring_doa`
--
ALTER TABLE `monitoring_doa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `lu` (`lu`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `feedback_by` (`feedback_by`),
  ADD KEY `tanggal` (`tanggal`),
  ADD KEY `id_doa` (`id_doa`),
  ADD KEY `seen_by_ortu` (`seen_by_ortu`);
ALTER TABLE `monitoring_doa` ADD FULLTEXT KEY `feedback` (`feedback`);

--
-- Indexes for table `monitoring_hadits`
--
ALTER TABLE `monitoring_hadits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `lu` (`lu`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `feedback_by` (`feedback_by`),
  ADD KEY `tanggal` (`tanggal`),
  ADD KEY `id_hadits` (`id_hadits`),
  ADD KEY `seen_by_ortu` (`seen_by_ortu`);
ALTER TABLE `monitoring_hadits` ADD FULLTEXT KEY `feedback` (`feedback`);

--
-- Indexes for table `monitoring_harian`
--
ALTER TABLE `monitoring_harian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pertanyaan` (`id_pertanyaan`),
  ADD KEY `updated_at` (`updated_at`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `tanggal` (`tanggal`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `created_by` (`created_by`);
ALTER TABLE `monitoring_harian` ADD FULLTEXT KEY `jawaban` (`jawaban`);

--
-- Indexes for table `monitoring_mahfudhot`
--
ALTER TABLE `monitoring_mahfudhot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `lu` (`lu`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `feedback_by` (`feedback_by`),
  ADD KEY `tanggal` (`tanggal`),
  ADD KEY `id_mahfudhot` (`id_mahfudhot`),
  ADD KEY `seen_by_ortu` (`seen_by_ortu`);
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
  ADD KEY `feedback_by` (`feedback_by`),
  ADD KEY `tanggal` (`tanggal`),
  ADD KEY `seen_by_ortu` (`seen_by_ortu`);
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
  ADD KEY `feedback_by` (`feedback_by`),
  ADD KEY `tanggal` (`tanggal`),
  ADD KEY `seen_by_ortu` (`seen_by_ortu`);
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
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `data_harian`
--
ALTER TABLE `data_harian`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `doa`
--
ALTER TABLE `doa`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `goldar`
--
ALTER TABLE `goldar`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hadits`
--
ALTER TABLE `hadits`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `kk`
--
ALTER TABLE `kk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kunci_monitoring_harian`
--
ALTER TABLE `kunci_monitoring_harian`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mahfudhot`
--
ALTER TABLE `mahfudhot`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `monitoring_doa`
--
ALTER TABLE `monitoring_doa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `monitoring_hadits`
--
ALTER TABLE `monitoring_hadits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `monitoring_harian`
--
ALTER TABLE `monitoring_harian`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `monitoring_mahfudhot`
--
ALTER TABLE `monitoring_mahfudhot`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `monitoring_tahfidz`
--
ALTER TABLE `monitoring_tahfidz`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `monitoring_tahsin`
--
ALTER TABLE `monitoring_tahsin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orang_tua`
--
ALTER TABLE `orang_tua`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pendidikan`
--
ALTER TABLE `pendidikan`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pertanyaan_data_harian`
--
ALTER TABLE `pertanyaan_data_harian`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `surah`
--
ALTER TABLE `surah`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tahun_ajaran_aktif`
--
ALTER TABLE `tahun_ajaran_aktif`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_harian`
--
ALTER TABLE `data_harian`
  ADD CONSTRAINT `data_harian_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `kelas_siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kunci_monitoring_harian`
--
ALTER TABLE `kunci_monitoring_harian`
  ADD CONSTRAINT `kunci_monitoring_harian_ibfk_1` FOREIGN KEY (`id_data_harian`) REFERENCES `data_harian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kunci_monitoring_harian_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `monitoring_doa`
--
ALTER TABLE `monitoring_doa`
  ADD CONSTRAINT `monitoring_doa_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_doa_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_doa_ibfk_3` FOREIGN KEY (`feedback_by`) REFERENCES `orang_tua` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `monitoring_doa_ibfk_4` FOREIGN KEY (`id_doa`) REFERENCES `doa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `monitoring_hadits`
--
ALTER TABLE `monitoring_hadits`
  ADD CONSTRAINT `monitoring_hadits_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_hadits_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_hadits_ibfk_3` FOREIGN KEY (`feedback_by`) REFERENCES `orang_tua` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `monitoring_hadits_ibfk_4` FOREIGN KEY (`id_hadits`) REFERENCES `hadits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `monitoring_harian`
--
ALTER TABLE `monitoring_harian`
  ADD CONSTRAINT `monitoring_harian_ibfk_1` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan_data_harian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_harian_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_harian_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `orang_tua` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `monitoring_mahfudhot`
--
ALTER TABLE `monitoring_mahfudhot`
  ADD CONSTRAINT `monitoring_mahfudhot_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_mahfudhot_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `monitoring_mahfudhot_ibfk_3` FOREIGN KEY (`feedback_by`) REFERENCES `orang_tua` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `monitoring_mahfudhot_ibfk_4` FOREIGN KEY (`id_mahfudhot`) REFERENCES `mahfudhot` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
