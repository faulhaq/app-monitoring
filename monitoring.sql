-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2023 at 04:38 PM
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
  `id` int(10) UNSIGNED NOT NULL,
  `nik` char(16) NOT NULL,
  `nip` char(18) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` enum('islam','kristen','katholik','budha','kong hu cu','hindu') NOT NULL,
  `goldar` enum('A','B','AB','O') NOT NULL,
  `pendidikan` enum('sd','smp/sltp','sma/smk','d1/d2/d3','s1','s2','s3') DEFAULT NULL,
  `pekerjaan` varchar(64) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `role` enum('admin','wali_kelas','guru') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nik`, `nip`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `agama`, `goldar`, `pendidikan`, `pekerjaan`, `alamat`, `role`) VALUES
(1, '1234567890098765', NULL, 'Alex', 'L', '2001-09-08', 'islam', 'A', 's1', 'guru', 'sleman', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_kelas` varchar(16) NOT NULL,
  `id_wali_kelas` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_hafalan`
--

CREATE TABLE `laporan_hafalan` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_siswa` int(10) UNSIGNED NOT NULL,
  `nama_surat` varchar(64) NOT NULL,
  `id_orang_tua` int(10) UNSIGNED DEFAULT NULL,
  `id_guru` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_ngaji`
--

CREATE TABLE `laporan_ngaji` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_siswa` int(10) UNSIGNED NOT NULL,
  `nama_surat` varchar(64) NOT NULL,
  `ayat_mulai` smallint(5) UNSIGNED NOT NULL,
  `ayat_selesai` smallint(5) UNSIGNED NOT NULL,
  `id_orang_tua` int(10) UNSIGNED DEFAULT NULL,
  `id_guru` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orang_tua`
--

CREATE TABLE `orang_tua` (
  `id` int(10) UNSIGNED NOT NULL,
  `nik` char(16) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` enum('islam','kristen','katholik','budha','kong hu cu','hindu') NOT NULL,
  `goldar` enum('A','B','AB','O') NOT NULL,
  `pendidikan` enum('sd','smp/sltp','sma/smk','d1/d2/d3','s1','s2','s3') DEFAULT NULL,
  `pekerjaan` varchar(64) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orang_tua_siswa`
--

CREATE TABLE `orang_tua_siswa` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_orang_tua` int(10) UNSIGNED NOT NULL,
  `id_siswa` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(10) UNSIGNED NOT NULL,
  `nik` char(16) NOT NULL,
  `nis` char(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nama_panggilan` varchar(255) NOT NULL,
  `jenis_kelamin` enum('P','L') NOT NULL,
  `tempat_lahir` varchar(64) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` enum('islam','kristen','katholik','budha','kong hu cu','hindu') NOT NULL,
  `goldar` enum('A','B','AB','O') NOT NULL,
  `id_tahun_ajaran` int(10) UNSIGNED NOT NULL,
  `status` enum('aktif','non-aktif') NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `id_kelas` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id` int(10) UNSIGNED NOT NULL,
  `tahun_awal` year(4) NOT NULL,
  `tahun_akhir` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD KEY `nama` (`nama`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_kelas` (`nama_kelas`),
  ADD KEY `id_wali_kelas` (`id_wali_kelas`);

--
-- Indexes for table `laporan_hafalan`
--
ALTER TABLE `laporan_hafalan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `nama_surat` (`nama_surat`),
  ADD KEY `id_orang_tua` (`id_orang_tua`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `laporan_ngaji`
--
ALTER TABLE `laporan_ngaji`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `nama_surat` (`nama_surat`),
  ADD KEY `id_orang_tua` (`id_orang_tua`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `orang_tua`
--
ALTER TABLE `orang_tua`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD KEY `nama` (`nama`),
  ADD KEY `ttl` (`tanggal_lahir`),
  ADD KEY `goldar` (`goldar`),
  ADD KEY `pekerjaan` (`pekerjaan`),
  ADD KEY `agama` (`agama`),
  ADD KEY `jenis_kelamin` (`jenis_kelamin`);
ALTER TABLE `orang_tua` ADD FULLTEXT KEY `alamat` (`alamat`);

--
-- Indexes for table `orang_tua_siswa`
--
ALTER TABLE `orang_tua_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_orang_tua` (`id_orang_tua`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nis` (`nis`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD KEY `nama` (`nama`),
  ADD KEY `ttl` (`tanggal_lahir`),
  ADD KEY `agama` (`agama`),
  ADD KEY `goldar` (`goldar`),
  ADD KEY `status` (`status`),
  ADD KEY `nama_panggilan` (`nama_panggilan`),
  ADD KEY `jenis_kelamin` (`jenis_kelamin`),
  ADD KEY `tempat_lahir` (`tempat_lahir`),
  ADD KEY `id_tahun_ajaran` (`id_tahun_ajaran`),
  ADD KEY `id_kelas` (`id_kelas`);
ALTER TABLE `siswa` ADD FULLTEXT KEY `alamat` (`alamat`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tahun_awal` (`tahun_awal`),
  ADD KEY `tahun_akhir` (`tahun_akhir`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan_hafalan`
--
ALTER TABLE `laporan_hafalan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan_ngaji`
--
ALTER TABLE `laporan_ngaji`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orang_tua`
--
ALTER TABLE `orang_tua`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orang_tua_siswa`
--
ALTER TABLE `orang_tua_siswa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_wali_kelas`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laporan_hafalan`
--
ALTER TABLE `laporan_hafalan`
  ADD CONSTRAINT `laporan_hafalan_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laporan_hafalan_ibfk_2` FOREIGN KEY (`id_orang_tua`) REFERENCES `orang_tua` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laporan_hafalan_ibfk_3` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laporan_ngaji`
--
ALTER TABLE `laporan_ngaji`
  ADD CONSTRAINT `laporan_ngaji_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laporan_ngaji_ibfk_2` FOREIGN KEY (`id_orang_tua`) REFERENCES `orang_tua` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laporan_ngaji_ibfk_3` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tahun_ajaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
