-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2023 at 11:40 AM
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
(1, 'Islam');

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
(1, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(20) UNSIGNED NOT NULL,
  `nik` char(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `status` enum('aktif','non-aktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nik`, `nip`, `nama`, `jk`, `agama`, `goldar`, `pekerjaan`, `pendidikan`, `telp`, `tmp_lahir`, `tgl_lahir`, `alamat`, `foto`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1234567890098765', '119284928492848172', 'Guru AAAAA', 'L', 1, 1, 1, 1, '08123123123', 'Yogyakarta', '1992-10-10', 'Yogyakarta', NULL, 'aktif', '2023-07-27 08:11:21', '2023-07-27 08:32:12', NULL),
(2, '3314110809010001', '196506061992032001', 'AAAAAAAAAAA', 'L', 1, 1, 1, 1, '08123456789', 'qqqq', '2023-07-05', 'Sragen', NULL, 'aktif', '2023-07-27 07:50:49', '2023-07-27 09:02:40', NULL),
(3, '3314150809010005', '1244153465886765', 'Drs Mukhtar Ahmadi ,MPd.', 'L', 1, 1, 1, 1, '08623456789', 'qweqwe', '2023-07-08', 'Sragen', '2023_07_27__07_51_37_yayasan-removebg.png', 'aktif', '2023-07-27 07:51:37', '2023-07-27 07:58:06', '2023-07-27 07:58:06');

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
(1, '1', 'A', 1, 1, '2023-07-27 08:12:15', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelas_siswa`
--

CREATE TABLE `kelas_siswa` (
  `id` int(20) UNSIGNED NOT NULL,
  `id_siswa` int(20) UNSIGNED NOT NULL,
  `id_kelas` int(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas_siswa`
--

INSERT INTO `kelas_siswa` (`id`, `id_siswa`, `id_kelas`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orang_tua`
--

CREATE TABLE `orang_tua` (
  `id` int(20) UNSIGNED NOT NULL,
  `nik` char(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `orang_tua` (`id`, `nik`, `nama`, `jk`, `agama`, `goldar`, `pekerjaan`, `pendidikan`, `telp`, `tmp_lahir`, `tgl_lahir`, `alamat`, `foto`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1234567890098765', 'Orang Tua AAAAAAA', 'L', 1, 1, 1, 1, '08111111111', 'Semarang', '1999-12-12', 'Semarang', NULL, '2023-07-27 07:39:37', '2023-07-27 08:58:38', NULL),
(2, '3314150809011005', 'Orang Tua BBBBBBB', 'L', 1, 1, 1, 1, '081234567892', 'Sleman', '2023-07-01', 'Sragen', '2023_07_27__09_00_46_USDGROW.png', '2023-07-27 08:59:09', '2023-07-27 09:02:20', '2023-07-27 09:02:20');

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
(1, 'Guru');

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
(1, 'S1');

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
(1, 'qqq', 'halo', '2023-07-27 07:17:05', NULL, NULL),
(2, 'qweqwe', 'halo test', '2023-07-27 07:17:05', NULL, NULL);

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
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nik`, `nis`, `nama`, `jk`, `agama`, `goldar`, `pendidikan`, `telp`, `tmp_lahir`, `tgl_lahir`, `alamat`, `foto`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1634567890098765', '123123', 'Kevin', 'L', 1, 1, NULL, NULL, 'Solo', '2013-10-10', 'Solo', NULL, '2023-07-27 08:21:53', NULL, NULL);

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
(4, 3);

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
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `email`, `password`, `id_guru`, `id_orang_tua`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$W5v5GzmFnQwSAAETT4ls1OKho2joKUg74A.2/RufKP8ZRfJpeqcWO', NULL, NULL, NULL, '2023-07-27 12:15:00', NULL, NULL);

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
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `orang_tua`
--
ALTER TABLE `orang_tua`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`),
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
  ADD KEY `deleted_at` (`deleted_at`);
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
  ADD KEY `created_at` (`created_at`),
  ADD KEY `deleted_at` (`deleted_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agama`
--
ALTER TABLE `agama`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `goldar`
--
ALTER TABLE `goldar`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orang_tua`
--
ALTER TABLE `orang_tua`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pendidikan`
--
ALTER TABLE `pendidikan`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tahun_ajaran_aktif`
--
ALTER TABLE `tahun_ajaran_aktif`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_fk1` FOREIGN KEY (`agama`) REFERENCES `agama` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `guru_fk2` FOREIGN KEY (`goldar`) REFERENCES `goldar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `guru_fk3` FOREIGN KEY (`pekerjaan`) REFERENCES `pekerjaan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `guru_fk4` FOREIGN KEY (`pendidikan`) REFERENCES `pendidikan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_fk1` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tahun_ajaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
  ADD CONSTRAINT `orang_tua_fk1` FOREIGN KEY (`agama`) REFERENCES `agama` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orang_tua_fk2` FOREIGN KEY (`goldar`) REFERENCES `goldar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orang_tua_fk3` FOREIGN KEY (`pekerjaan`) REFERENCES `pekerjaan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orang_tua_fk4` FOREIGN KEY (`pendidikan`) REFERENCES `pendidikan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_fk1` FOREIGN KEY (`agama`) REFERENCES `agama` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_fk2` FOREIGN KEY (`goldar`) REFERENCES `goldar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_fk3` FOREIGN KEY (`pendidikan`) REFERENCES `pendidikan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
