-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: localhost    Database: monitoring
-- ------------------------------------------------------
-- Server version	8.0.36-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `agama`
--

DROP TABLE IF EXISTS `agama`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agama` (
  `id` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama` (`nama`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agama`
--

LOCK TABLES `agama` WRITE;
/*!40000 ALTER TABLE `agama` DISABLE KEYS */;
INSERT INTO `agama` VALUES (10,'ABC'),(7,'Budha'),(4,'Hindu'),(1,'Islam'),(6,'Katholik'),(8,'Kong Hu Cu'),(2,'Kristen');
/*!40000 ALTER TABLE `agama` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_harian`
--

DROP TABLE IF EXISTS `data_harian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_harian` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `bulan` tinyint unsigned NOT NULL,
  `tahun` year NOT NULL,
  `id_kelas` int unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bulan` (`bulan`),
  KEY `tahun` (`tahun`),
  KEY `id_kelas` (`id_kelas`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`),
  CONSTRAINT `data_harian_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_harian`
--

LOCK TABLES `data_harian` WRITE;
/*!40000 ALTER TABLE `data_harian` DISABLE KEYS */;
INSERT INTO `data_harian` VALUES (21,2,2024,18,'2024-02-23 01:03:47','2024-02-23 01:03:47'),(22,2,2024,19,'2024-02-23 01:04:35','2024-02-23 01:04:35');
/*!40000 ALTER TABLE `data_harian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goldar`
--

DROP TABLE IF EXISTS `goldar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `goldar` (
  `id` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama` (`nama`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goldar`
--

LOCK TABLES `goldar` WRITE;
/*!40000 ALTER TABLE `goldar` DISABLE KEYS */;
INSERT INTO `goldar` VALUES (1,'A'),(4,'AB'),(7,'AE'),(2,'B'),(3,'O');
/*!40000 ALTER TABLE `goldar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guru`
--

DROP TABLE IF EXISTS `guru`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `guru` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nik` char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nsm` char(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` tinyint unsigned NOT NULL,
  `goldar` tinyint unsigned NOT NULL,
  `pekerjaan` smallint unsigned DEFAULT NULL,
  `pendidikan` smallint unsigned DEFAULT NULL,
  `telp` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmp_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('aktif','non-aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nik` (`nik`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `nip` (`nsm`),
  KEY `nama` (`nama`),
  KEY `jk` (`jk`),
  KEY `agama` (`agama`),
  KEY `goldar` (`goldar`),
  KEY `pekerjaan` (`pekerjaan`),
  KEY `pendidikan` (`pendidikan`),
  KEY `telp` (`telp`),
  KEY `tmp_lahir` (`tmp_lahir`),
  KEY `tgl_lahir` (`tgl_lahir`),
  KEY `status` (`status`),
  KEY `created_at` (`created_at`),
  KEY `deleted_at` (`deleted_at`),
  FULLTEXT KEY `alamat` (`alamat`),
  CONSTRAINT `guru_fk1` FOREIGN KEY (`agama`) REFERENCES `agama` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `guru_fk2` FOREIGN KEY (`goldar`) REFERENCES `goldar` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `guru_fk3` FOREIGN KEY (`pekerjaan`) REFERENCES `pekerjaan` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `guru_fk4` FOREIGN KEY (`pendidikan`) REFERENCES `pendidikan` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guru`
--

LOCK TABLES `guru` WRITE;
/*!40000 ALTER TABLE `guru` DISABLE KEYS */;
INSERT INTO `guru` VALUES (1,'2582668149791338',NULL,'Ratih Wahyuni','ratihwahyuni@gmail.com','P',1,4,NULL,NULL,NULL,'Bantul','1992-12-12','Bantul',NULL,'aktif','2024-02-21 13:02:24',NULL,NULL),(2,'2363395548413331',NULL,'Jasmin Prastuti','jasminprastuti@gmail.com','P',1,1,NULL,NULL,NULL,'Bantul','1995-02-09','Bantul',NULL,'aktif','2024-02-21 13:02:24',NULL,NULL);
/*!40000 ALTER TABLE `guru` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kelas`
--

DROP TABLE IF EXISTS `kelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kelas` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `tingkatan` enum('1','2','3','4','5','6') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_tahun_ajaran` int unsigned NOT NULL,
  `id_guru` int unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tingkatan` (`tingkatan`),
  KEY `nama` (`nama`),
  KEY `id_tahun_ajaran` (`id_tahun_ajaran`),
  KEY `id_guru` (`id_guru`),
  KEY `created_at` (`created_at`),
  KEY `deleted_at` (`deleted_at`),
  CONSTRAINT `kelas_fk1` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tahun_ajaran` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `kelas_fk2` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kelas`
--

LOCK TABLES `kelas` WRITE;
/*!40000 ALTER TABLE `kelas` DISABLE KEYS */;
INSERT INTO `kelas` VALUES (18,'2',NULL,3,2,'2024-02-22 00:43:59','2024-02-22 00:43:59',NULL),(19,'1',NULL,3,1,'2024-02-22 02:02:48','2024-02-22 02:02:48',NULL);
/*!40000 ALTER TABLE `kelas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kelas_siswa`
--

DROP TABLE IF EXISTS `kelas_siswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kelas_siswa` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_siswa` int unsigned NOT NULL,
  `id_kelas` int unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_siswa` (`id_siswa`),
  KEY `id_kelas` (`id_kelas`),
  KEY `created_at` (`created_at`),
  CONSTRAINT `kelas_siswa_fk1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kelas_siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kelas_siswa`
--

LOCK TABLES `kelas_siswa` WRITE;
/*!40000 ALTER TABLE `kelas_siswa` DISABLE KEYS */;
INSERT INTO `kelas_siswa` VALUES (46,3,18,'2024-02-22 02:00:07',NULL),(47,9,18,'2024-02-22 02:00:07',NULL),(48,10,18,'2024-02-22 02:00:07',NULL),(49,11,18,'2024-02-22 02:00:07',NULL),(50,2,18,'2024-02-22 02:00:07',NULL),(51,4,19,'2024-02-22 02:06:53',NULL),(52,5,19,'2024-02-22 02:06:53',NULL),(53,6,19,'2024-02-22 02:06:53',NULL),(54,8,19,'2024-02-22 02:06:53',NULL),(55,12,19,'2024-02-22 02:06:53',NULL);
/*!40000 ALTER TABLE `kelas_siswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kk`
--

DROP TABLE IF EXISTS `kk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kk` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `no_kk` char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `no_kk` (`no_kk`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kk`
--

LOCK TABLES `kk` WRITE;
/*!40000 ALTER TABLE `kk` DISABLE KEYS */;
INSERT INTO `kk` VALUES (1,'1234567890123456','2023-08-10 09:01:35','2023-08-10 09:01:35'),(3,'1231211111111111','2023-08-10 09:10:41','2023-08-10 09:10:41'),(5,'1231211111111146','2023-08-14 08:15:06','2023-08-14 08:15:06'),(6,'1231211111211146','2023-08-23 03:36:31','2023-08-23 03:36:31'),(9,'7896417867454573',NULL,NULL),(10,'8747561943032509',NULL,NULL),(11,'5852855020025290',NULL,NULL),(12,'8538660763751405',NULL,NULL),(13,'1399733792565701',NULL,NULL),(14,'6642227171951529',NULL,NULL),(15,'8631724790134725',NULL,NULL);
/*!40000 ALTER TABLE `kk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kunci_monitoring_harian`
--

DROP TABLE IF EXISTS `kunci_monitoring_harian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kunci_monitoring_harian` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_data_harian` int unsigned NOT NULL,
  `id_siswa` int unsigned NOT NULL,
  `point` int unsigned NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_data_harian` (`id_data_harian`),
  KEY `id_siswa` (`id_siswa`),
  KEY `tanggal` (`tanggal`),
  KEY `point` (`point`),
  CONSTRAINT `kunci_monitoring_harian_ibfk_1` FOREIGN KEY (`id_data_harian`) REFERENCES `data_harian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kunci_monitoring_harian_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kunci_monitoring_harian`
--

LOCK TABLES `kunci_monitoring_harian` WRITE;
/*!40000 ALTER TABLE `kunci_monitoring_harian` DISABLE KEYS */;
/*!40000 ALTER TABLE `kunci_monitoring_harian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monitoring_doa`
--

DROP TABLE IF EXISTS `monitoring_doa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `monitoring_doa` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_siswa` int unsigned NOT NULL,
  `doa` varchar(255) NOT NULL,
  `lu` enum('lancar','ulang') NOT NULL,
  `created_by` int unsigned DEFAULT NULL,
  `feedback` text,
  `feedback_by` int unsigned DEFAULT NULL,
  `tanggal` date NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_siswa` (`id_siswa`),
  KEY `doa` (`doa`),
  KEY `lu` (`lu`),
  KEY `created_by` (`created_by`),
  KEY `created_at` (`created_at`),
  KEY `feedback_by` (`feedback_by`),
  KEY `tanggal` (`tanggal`),
  FULLTEXT KEY `feedback` (`feedback`),
  CONSTRAINT `monitoring_doa_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `monitoring_doa_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `monitoring_doa_ibfk_3` FOREIGN KEY (`feedback_by`) REFERENCES `orang_tua` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monitoring_doa`
--

LOCK TABLES `monitoring_doa` WRITE;
/*!40000 ALTER TABLE `monitoring_doa` DISABLE KEYS */;
/*!40000 ALTER TABLE `monitoring_doa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monitoring_hadits`
--

DROP TABLE IF EXISTS `monitoring_hadits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `monitoring_hadits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_siswa` int unsigned NOT NULL,
  `hadits` varchar(255) NOT NULL,
  `lu` enum('lancar','ulang') NOT NULL,
  `created_by` int unsigned DEFAULT NULL,
  `feedback` text,
  `feedback_by` int unsigned DEFAULT NULL,
  `tanggal` date NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_siswa` (`id_siswa`),
  KEY `hadits` (`hadits`),
  KEY `lu` (`lu`),
  KEY `created_by` (`created_by`),
  KEY `created_at` (`created_at`),
  KEY `feedback_by` (`feedback_by`),
  KEY `tanggal` (`tanggal`),
  FULLTEXT KEY `feedback` (`feedback`),
  CONSTRAINT `monitoring_hadits_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `monitoring_hadits_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `monitoring_hadits_ibfk_3` FOREIGN KEY (`feedback_by`) REFERENCES `orang_tua` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monitoring_hadits`
--

LOCK TABLES `monitoring_hadits` WRITE;
/*!40000 ALTER TABLE `monitoring_hadits` DISABLE KEYS */;
/*!40000 ALTER TABLE `monitoring_hadits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monitoring_harian`
--

DROP TABLE IF EXISTS `monitoring_harian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `monitoring_harian` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_siswa` int unsigned NOT NULL,
  `id_pertanyaan` int unsigned NOT NULL,
  `jawaban` text,
  `tanggal` date NOT NULL,
  `created_by` int unsigned DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pertanyaan` (`id_pertanyaan`),
  KEY `updated_at` (`updated_at`),
  KEY `created_at` (`created_at`),
  KEY `tanggal` (`tanggal`),
  KEY `id_siswa` (`id_siswa`),
  KEY `created_by` (`created_by`),
  FULLTEXT KEY `jawaban` (`jawaban`),
  CONSTRAINT `monitoring_harian_ibfk_1` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan_data_harian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `monitoring_harian_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `monitoring_harian_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `orang_tua` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monitoring_harian`
--

LOCK TABLES `monitoring_harian` WRITE;
/*!40000 ALTER TABLE `monitoring_harian` DISABLE KEYS */;
INSERT INTO `monitoring_harian` VALUES (30,4,19,'ya','2024-02-23',2,'2024-02-23 01:15:42',NULL),(31,4,20,'membantu menyapu dan mencuci piring','2024-02-23',2,'2024-02-23 01:15:42',NULL),(32,4,19,'ya','2024-02-02',2,'2024-02-23 01:16:35',NULL),(33,4,20,'membantu siram tanaman','2024-02-02',2,'2024-02-23 01:16:35',NULL);
/*!40000 ALTER TABLE `monitoring_harian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monitoring_mahfudhot`
--

DROP TABLE IF EXISTS `monitoring_mahfudhot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `monitoring_mahfudhot` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_siswa` int unsigned NOT NULL,
  `mahfudhot` varchar(255) NOT NULL,
  `lu` enum('lancar','ulang') NOT NULL,
  `created_by` int unsigned DEFAULT NULL,
  `feedback` text,
  `feedback_by` int unsigned DEFAULT NULL,
  `tanggal` date NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_siswa` (`id_siswa`),
  KEY `mafudhot` (`mahfudhot`),
  KEY `lu` (`lu`),
  KEY `created_by` (`created_by`),
  KEY `created_at` (`created_at`),
  KEY `feedback_by` (`feedback_by`),
  KEY `tanggal` (`tanggal`),
  FULLTEXT KEY `feedback` (`feedback`),
  CONSTRAINT `monitoring_mahfudhot_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `monitoring_mahfudhot_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `monitoring_mahfudhot_ibfk_3` FOREIGN KEY (`feedback_by`) REFERENCES `orang_tua` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monitoring_mahfudhot`
--

LOCK TABLES `monitoring_mahfudhot` WRITE;
/*!40000 ALTER TABLE `monitoring_mahfudhot` DISABLE KEYS */;
/*!40000 ALTER TABLE `monitoring_mahfudhot` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monitoring_tahfidz`
--

DROP TABLE IF EXISTS `monitoring_tahfidz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `monitoring_tahfidz` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_siswa` int unsigned NOT NULL,
  `id_surah` tinyint unsigned NOT NULL,
  `ayat` varchar(16) NOT NULL,
  `lu` enum('lancar','ulang') NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `created_by` int unsigned DEFAULT NULL,
  `feedback` text,
  `feedback_by` int unsigned DEFAULT NULL,
  `tanggal` date NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_siswa` (`id_siswa`),
  KEY `id_surah` (`id_surah`),
  KEY `lu` (`lu`),
  KEY `created_by` (`created_by`),
  KEY `created_at` (`created_at`),
  KEY `feedback_by` (`feedback_by`),
  KEY `tanggal` (`tanggal`),
  FULLTEXT KEY `feedback` (`feedback`),
  CONSTRAINT `monitoring_tahfidz_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `monitoring_tahfidz_ibfk_2` FOREIGN KEY (`id_surah`) REFERENCES `surah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `monitoring_tahfidz_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `monitoring_tahfidz_ibfk_4` FOREIGN KEY (`feedback_by`) REFERENCES `orang_tua` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monitoring_tahfidz`
--

LOCK TABLES `monitoring_tahfidz` WRITE;
/*!40000 ALTER TABLE `monitoring_tahfidz` DISABLE KEYS */;
/*!40000 ALTER TABLE `monitoring_tahfidz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monitoring_tahsin`
--

DROP TABLE IF EXISTS `monitoring_tahsin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `monitoring_tahsin` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_siswa` int unsigned NOT NULL,
  `n` tinyint unsigned NOT NULL,
  `tipe` enum('iqro','juz') NOT NULL,
  `halaman` varchar(32) NOT NULL,
  `lu` enum('lancar','ulang') NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `created_by` int unsigned DEFAULT NULL,
  `feedback` text,
  `feedback_by` int unsigned DEFAULT NULL,
  `tanggal` date NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_siswa` (`id_siswa`),
  KEY `n` (`n`),
  KEY `tipe` (`tipe`),
  KEY `lu` (`lu`),
  KEY `created_by` (`created_by`),
  KEY `created_at` (`created_at`),
  KEY `feedback_by` (`feedback_by`),
  KEY `tanggal` (`tanggal`),
  FULLTEXT KEY `feedback` (`feedback`),
  CONSTRAINT `monitoring_tahsin_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `monitoring_tahsin_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `monitoring_tahsin_ibfk_3` FOREIGN KEY (`feedback_by`) REFERENCES `orang_tua` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monitoring_tahsin`
--

LOCK TABLES `monitoring_tahsin` WRITE;
/*!40000 ALTER TABLE `monitoring_tahsin` DISABLE KEYS */;
INSERT INTO `monitoring_tahsin` VALUES (6,2,12,'iqro','1','lancar',NULL,NULL,NULL,NULL,'2024-02-28','2024-03-01 19:08:30');
/*!40000 ALTER TABLE `monitoring_tahsin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orang_tua`
--

DROP TABLE IF EXISTS `orang_tua`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orang_tua` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_kk` int unsigned NOT NULL,
  `nik` char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` tinyint unsigned NOT NULL,
  `goldar` tinyint unsigned NOT NULL,
  `pekerjaan` smallint unsigned DEFAULT NULL,
  `pendidikan` smallint unsigned DEFAULT NULL,
  `telp` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmp_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nik` (`nik`),
  UNIQUE KEY `email` (`email`),
  KEY `id_kk` (`id_kk`),
  KEY `nama` (`nama`),
  KEY `jk` (`jk`),
  KEY `agama` (`agama`),
  KEY `goldar` (`goldar`),
  KEY `pekerjaan` (`pekerjaan`),
  KEY `pendidikan` (`pendidikan`),
  KEY `telp` (`telp`),
  KEY `tmp_lahir` (`tmp_lahir`),
  KEY `tgl_lahir` (`tgl_lahir`),
  KEY `created_at` (`created_at`),
  FULLTEXT KEY `alamat` (`alamat`),
  CONSTRAINT `orang_tua_fk1` FOREIGN KEY (`id_kk`) REFERENCES `kk` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `orang_tua_fk2` FOREIGN KEY (`agama`) REFERENCES `agama` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `orang_tua_fk3` FOREIGN KEY (`goldar`) REFERENCES `goldar` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `orang_tua_fk4` FOREIGN KEY (`pekerjaan`) REFERENCES `pekerjaan` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `orang_tua_fk5` FOREIGN KEY (`pendidikan`) REFERENCES `pendidikan` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orang_tua`
--

LOCK TABLES `orang_tua` WRITE;
/*!40000 ALTER TABLE `orang_tua` DISABLE KEYS */;
INSERT INTO `orang_tua` VALUES (2,3,'1214215621212313','Elma Hartati','elmahartati@gmail.com','P',1,2,1,1,'089274517442','Solo','1992-03-01','Solo',NULL,'2023-09-20 04:28:44','2024-02-21 11:37:58'),(6,1,'3314150809018605','Amalia Novitasari','amalianovitasari@gmail.com','P',1,3,1,10,'081265345141','Sragen','1987-02-03','Sragen',NULL,'2023-09-20 03:24:12','2024-02-21 11:36:34'),(8,9,'2938670989801205','Eka Iswahyudi','ekaiswahyudi@gmail.com','L',1,1,1,2,'088884733724','Sleman','1985-06-01','Sleman',NULL,'2024-02-21 12:24:09',NULL),(9,10,'1261394734176118','Dadi Natsir','dadinatsir@gmail.com','L',1,4,1,1,'081290088839','Bantul','1985-06-03','Bantul',NULL,'2024-02-21 12:24:09',NULL),(10,11,'5221015854971387','Purwadi Waluyo','purwadiwaluyo@gmail.com','L',1,2,NULL,NULL,'08544869565','Sleman','1985-06-18','Sleman',NULL,'2024-02-21 12:24:09',NULL),(11,12,'2393058558891069','Enteng Kuswoyo','entengkuswoyo@gmail.com','L',1,3,NULL,NULL,'085132428063','Yogyakarta','1985-02-01','Yogyakarta',NULL,'2024-02-21 12:24:09',NULL),(12,14,'2769570321658946','Harjasa Maulana','harjasamaulana@gmail.com','L',1,1,NULL,NULL,'082275636101','Solo','1985-06-09','Solo',NULL,'2024-02-21 12:24:09',NULL),(13,15,'5802049577995185','Agnes Astuti','agnesastuti@gmail.com','P',1,4,NULL,NULL,NULL,'Sleman','1999-01-12','Sleman',NULL,'2024-02-21 12:52:51',NULL),(14,5,'6053610362289979','Tania Wulandari','taniawulandari@gmail.com','P',1,2,NULL,NULL,NULL,'Bantul','1991-02-09','Bantul',NULL,'2024-02-21 12:52:51',NULL),(15,6,'9130035922768820','Ida Wijayanti','idawijayanti@gmail.com','P',1,3,NULL,NULL,NULL,'Sleman','1994-05-20','Sleman',NULL,'2024-02-21 12:52:51',NULL);
/*!40000 ALTER TABLE `orang_tua` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pekerjaan`
--

DROP TABLE IF EXISTS `pekerjaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pekerjaan` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama` (`nama`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pekerjaan`
--

LOCK TABLES `pekerjaan` WRITE;
/*!40000 ALTER TABLE `pekerjaan` DISABLE KEYS */;
INSERT INTO `pekerjaan` VALUES (7,'Dosen'),(1,'Guru'),(2,'Polisi'),(4,'Satpam'),(3,'Tentara');
/*!40000 ALTER TABLE `pekerjaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pendidikan`
--

DROP TABLE IF EXISTS `pendidikan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pendidikan` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama` (`nama`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pendidikan`
--

LOCK TABLES `pendidikan` WRITE;
/*!40000 ALTER TABLE `pendidikan` DISABLE KEYS */;
INSERT INTO `pendidikan` VALUES (10,'D1'),(11,'D2'),(12,'D3'),(8,'MA'),(9,'MTS'),(16,'PROF'),(1,'S1'),(2,'S2'),(3,'S3'),(7,'SD'),(4,'SMA'),(6,'SMK'),(13,'SMP');
/*!40000 ALTER TABLE `pendidikan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengumuman`
--

DROP TABLE IF EXISTS `pengumuman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengumuman` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `opsi` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_at` (`created_at`),
  KEY `deleted_at` (`deleted_at`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengumuman`
--

LOCK TABLES `pengumuman` WRITE;
/*!40000 ALTER TABLE `pengumuman` DISABLE KEYS */;
INSERT INTO `pengumuman` VALUES (1,'pengumuman','halo gaisss','2023-07-27 07:17:05','2023-09-27 04:22:10',NULL);
/*!40000 ALTER TABLE `pengumuman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pertanyaan_data_harian`
--

DROP TABLE IF EXISTS `pertanyaan_data_harian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pertanyaan_data_harian` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_data_harian` int unsigned NOT NULL,
  `pertanyaan` text NOT NULL,
  `tipe` enum('opsi','isian') NOT NULL,
  `list_opsi` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_data_harian` (`id_data_harian`),
  KEY `tipe` (`tipe`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`),
  FULLTEXT KEY `pertanyaan` (`pertanyaan`),
  CONSTRAINT `pertanyaan_data_harian_ibfk_1` FOREIGN KEY (`id_data_harian`) REFERENCES `data_harian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pertanyaan_data_harian`
--

LOCK TABLES `pertanyaan_data_harian` WRITE;
/*!40000 ALTER TABLE `pertanyaan_data_harian` DISABLE KEYS */;
INSERT INTO `pertanyaan_data_harian` VALUES (17,21,'apakah sudah mengaji ?','opsi','[\"ya\",\"tidak\"]','2024-02-23 01:03:47',NULL),(18,21,'apakah anak membantu orang tua ? apa yang dibantu oleh anak ?','isian',NULL,'2024-02-23 01:03:47',NULL),(19,22,'apakah sudah sholat ?','opsi','[\"ya\",\"tidak\"]','2024-02-23 01:04:35',NULL),(20,22,'apa yang dilakukan anak ketika dirumah ?','isian',NULL,'2024-02-23 01:04:35',NULL);
/*!40000 ALTER TABLE `pertanyaan_data_harian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `siswa`
--

DROP TABLE IF EXISTS `siswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `siswa` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_kk` int unsigned NOT NULL,
  `nik` char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` tinyint unsigned NOT NULL,
  `goldar` tinyint unsigned DEFAULT NULL,
  `pendidikan` smallint unsigned DEFAULT NULL,
  `telp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmp_lahir` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('non-aktif','aktif','lulus','pindah') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nik` (`nik`),
  UNIQUE KEY `nis` (`nis`),
  KEY `id_kk` (`id_kk`),
  KEY `nama` (`nama`),
  KEY `jk` (`jk`),
  KEY `agama` (`agama`),
  KEY `goldar` (`goldar`),
  KEY `pendidikan` (`pendidikan`),
  KEY `telp` (`telp`),
  KEY `tmp_lahir` (`tmp_lahir`),
  KEY `tgl_lahir` (`tgl_lahir`),
  KEY `created_at` (`created_at`),
  KEY `status` (`status`),
  FULLTEXT KEY `alamat` (`alamat`),
  CONSTRAINT `siswa_fk1` FOREIGN KEY (`id_kk`) REFERENCES `kk` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `siswa_fk2` FOREIGN KEY (`agama`) REFERENCES `agama` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `siswa_fk3` FOREIGN KEY (`goldar`) REFERENCES `goldar` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `siswa_fk4` FOREIGN KEY (`pendidikan`) REFERENCES `pendidikan` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `siswa`
--

LOCK TABLES `siswa` WRITE;
/*!40000 ALTER TABLE `siswa` DISABLE KEYS */;
INSERT INTO `siswa` VALUES (2,1,'3314110809010001','123453','Atmaja Maulana','L',1,1,NULL,'08123456789','Bantul','2010-01-20','Bantul',NULL,'aktif','2023-08-14 07:32:54','2024-02-21 10:38:25'),(3,15,'3314150809010905','321126','Hendra Gunawan','L',1,1,NULL,NULL,'Bantul','2011-06-10','Bantul',NULL,'aktif','2023-08-14 07:51:59','2024-02-21 10:39:02'),(4,3,'3314150809010685','1234588','Taufan Nainggolan','L',1,1,NULL,'08123456789','Sleman','2010-01-07','Godean',NULL,'aktif','2023-08-14 08:01:43','2024-02-21 10:36:04'),(5,5,'3314150809636905','321115','Daniswara Hidayanto','L',1,2,NULL,'0812345326543','Sleman','2010-02-01','Gamping',NULL,'aktif','2023-08-14 08:16:50','2024-02-21 10:37:35'),(6,6,'3314110346210001','14678','Hendra Sirait','L',1,1,NULL,'08923456789','Bantul','2010-03-02','Kasihan',NULL,'aktif','2023-08-23 03:40:21','2024-02-21 10:36:49'),(8,11,'5851085732965262','12312312','Anita Lestari','P',1,4,7,NULL,'Yogyakarta','2014-02-05','Yogyakarta',NULL,'aktif','2024-02-21 11:42:48',NULL),(9,14,'2602815764258682','88246','Usyi Oktaviani','P',1,2,7,NULL,'Bantul','2011-02-09','Bantul',NULL,'aktif','2024-02-21 11:42:48',NULL),(10,9,'7563877722641167','58879','Vera Wijayanti','P',1,1,7,NULL,'Gunung Kidul','2011-05-20','Srandakan',NULL,'aktif','2024-02-21 11:42:48',NULL),(11,12,'9441657787218956','25382','Novi Pratiwi','P',1,3,7,NULL,'Solo','2011-02-22','Sleman',NULL,'aktif','2024-02-21 11:42:48',NULL),(12,10,'6018861246747347','92977','Chelsea Hartati','P',1,1,7,NULL,'Sleman','2011-10-26','Sleman',NULL,'aktif','2024-02-21 11:42:48',NULL);
/*!40000 ALTER TABLE `siswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `surah`
--

DROP TABLE IF EXISTS `surah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `surah` (
  `id` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `jumlah_ayat` smallint NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama` (`nama`),
  KEY `jumlah_ayat` (`jumlah_ayat`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `surah`
--

LOCK TABLES `surah` WRITE;
/*!40000 ALTER TABLE `surah` DISABLE KEYS */;
INSERT INTO `surah` VALUES (1,'Al-Fatiha',7),(2,'Al-Baqara',286),(3,'Aal-Imran',200),(4,'An-Nisaa\'',176),(5,'Al-Ma\'ida',120),(6,'Al-An\'am',165),(7,'Al-A\'raf',206),(8,'Al-Anfal',75),(9,'Al-Tawba',129),(10,'Yunus',109),(11,'Hud',123),(12,'Yusuf',111),(13,'Ar-Ra\'d',43),(14,'Ibrahim',52),(15,'Al-Hijr',99),(16,'An-Nahl',128),(17,'Al-Israa',111),(18,'Al-Kahf',110),(19,'Maryam',98),(20,'Ta-Ha',135),(21,'Al-Anbiya',112),(22,'Al-Hajj',78),(23,'Al-Muminun',118),(24,'An-Nur',64),(25,'Al-Furqan',77),(26,'Ash-Shuara',227),(27,'An-Naml',93),(28,'Al-Qasas',88),(29,'Al-Ankabut',69),(30,'Ar-Rum',60),(31,'Luqman',34),(32,'As-Sajdah',30),(33,'Al-Ahzab',73),(34,'Saba',54),(35,'Fatir',45),(36,'Yasin',83),(37,'As-Saffat',182),(38,'Sad',88),(39,'Az-Zumar',75),(40,'Ghafir',85),(41,'Fussilat',54),(42,'Ash-Shura',53),(43,'Az-Zukhruf',89),(44,'Ad-Dukhan',59),(45,'Al-Jathiya',37),(46,'Al-Ahqaf',35),(47,'Muhammad',38),(48,'Al-Fath',29),(49,'Al-Hujurat',18),(50,'Qaf',45),(51,'Az-Zariyat',60),(52,'At-Tur',49),(53,'An-Najm',62),(54,'Al-Qamar',55),(55,'Ar-Rahman',78),(56,'Al-Waqia',96),(57,'Al-Hadid',29),(58,'Al-Mujadilah',22),(59,'Al-Hashr',24),(60,'Al-Mumtahinah',13),(61,'As-Saff',14),(62,'Al-Jumu\'ah',11),(63,'Al-Munafiqun',11),(64,'At-Taghabun',18),(65,'At-Talaq',12),(66,'At-Tahrim',12),(67,'Al-Mulk',30),(68,'Al-Qalam',52),(69,'Al-Haqqah',52),(70,'Al-Ma\'arij',44),(71,'Nuh',28),(72,'Al-Jinn',28),(73,'Al-Muzzammil',20),(74,'Al-Muddaththir',56),(75,'Al-Qiyamah',40),(76,'Al-Insan',31),(77,'Al-Mursalat',50),(78,'An-Naba',40),(79,'An-Naziat',46),(80,'Abasa',42),(81,'At-Takwir',29),(82,'Al-Infitar',19),(83,'Al-Mutaffifin',36),(84,'Al-Inshiqaq',25),(85,'Al-Buruj',22),(86,'At-Tariq',17),(87,'Al-Ala',19),(88,'Al-Ghashiyah',26),(89,'Al-Fajr',30),(90,'Al-Balad',20),(91,'Ash-Shams',15),(92,'Al-Lail',21),(93,'Ad-Duha',11),(94,'Ash-Sharh',8),(95,'At-Tin',8),(96,'Al-Alaq',19),(97,'Al-Qadr',5),(98,'Al-Bayinah',8),(99,'Az-Zalzalah',8),(100,'Al-Adiyat',11),(101,'Al-Qariah',11),(102,'Al-Takathur',8),(103,'Al-Asr',3),(104,'Al-Humazah',9),(105,'Al-Fil',5),(106,'Quraish',4),(107,'Al-Ma\'un',7),(108,'Al-Kauthar',3),(109,'Al-Kafirun',6),(110,'An-Nasr',3),(111,'Al-Masad',5),(112,'Al-Ikhlas',4),(113,'Al-Falaq',5),(114,'An-Nas',6);
/*!40000 ALTER TABLE `surah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tahun_ajaran`
--

DROP TABLE IF EXISTS `tahun_ajaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tahun_ajaran` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `tahun` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tahun` (`tahun`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tahun_ajaran`
--

LOCK TABLES `tahun_ajaran` WRITE;
/*!40000 ALTER TABLE `tahun_ajaran` DISABLE KEYS */;
INSERT INTO `tahun_ajaran` VALUES (1,'2022/2023','2023-07-27 08:10:58',NULL),(3,'2023/2024','2023-07-27 09:25:36','2023-07-27 09:25:36'),(4,'2024/2025','2023-07-27 09:25:41','2023-07-27 09:25:41'),(5,'2026/2027','2023-08-03 13:41:30','2023-08-03 13:41:30'),(6,'2027/2028','2023-08-03 13:42:55','2023-08-03 13:42:55'),(7,'2028/2029','2023-08-03 13:43:04','2023-08-03 13:43:04'),(8,'2029/2030','2023-08-04 02:48:45','2023-08-04 02:48:45'),(9,'2030/2031','2023-08-14 08:18:16','2023-08-14 08:18:16'),(10,'2043/2044','2023-08-23 03:42:49','2023-08-23 03:42:49'),(11,'2037/2038','2023-09-15 03:31:13','2023-09-15 03:31:13'),(12,'2031/2032','2023-09-26 06:24:25','2023-09-26 06:24:25'),(13,'2032/2033','2023-09-26 06:25:15','2023-09-26 06:25:15');
/*!40000 ALTER TABLE `tahun_ajaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tahun_ajaran_aktif`
--

DROP TABLE IF EXISTS `tahun_ajaran_aktif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tahun_ajaran_aktif` (
  `id` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `id_tahun_ajaran` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tahun_ajaran` (`id_tahun_ajaran`),
  CONSTRAINT `tahun_ajaran_aktif_fk1` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tahun_ajaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tahun_ajaran_aktif`
--

LOCK TABLES `tahun_ajaran_aktif` WRITE;
/*!40000 ALTER TABLE `tahun_ajaran_aktif` DISABLE KEYS */;
INSERT INTO `tahun_ajaran_aktif` VALUES (33,3);
/*!40000 ALTER TABLE `tahun_ajaran_aktif` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `role` enum('admin','guru','orang_tua') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_guru` int unsigned DEFAULT NULL,
  `id_orang_tua` int unsigned DEFAULT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role` (`role`),
  KEY `email` (`email`),
  KEY `id_guru` (`id_guru`),
  KEY `id_orang_tua` (`id_orang_tua`),
  KEY `remember_token` (`remember_token`),
  KEY `created_at` (`created_at`),
  CONSTRAINT `users_fk1` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_fk2` FOREIGN KEY (`id_orang_tua`) REFERENCES `orang_tua` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@gmail.com','$2y$10$iqO92iUBxlecYnPIzREt6O/nUf90PWyAoU.x7fIxnq0MJ409M8lt2',NULL,NULL,'nPgQq5otks1woM8p6XMGUXdNnvAaTm55Xm2wL4HEHlK94ixL4rgmfgiOjK3k','2023-07-27 12:15:00','2023-11-13 08:44:22'),(16,'orang_tua','elmahartati@gmail.com','$2y$10$GSYdp7AvqF0D3RA3B6J1v.Mx4vjCh8ikQ8S68VfJznmpUl97dlOOO',NULL,2,NULL,'2024-02-22 02:13:37','2024-02-22 02:14:06'),(17,'orang_tua','amalianovitasari@gmail.com','$2y$10$LLGkgVf6CuALGNO/KgBfSeCDcGvVikcae3yJtquuy7kMAXHS.0WTW',NULL,6,NULL,'2024-02-22 14:49:30','2024-02-22 14:49:39'),(18,'orang_tua','ekaiswahyudi@gmail.com','$2y$10$J3Y3x2Mkw6IBu0/JByG/1ejsQ1vYP5FgTeLMvXQEAAnUymrbZYS9W',NULL,8,NULL,'2024-02-22 14:49:47','2024-02-22 14:50:33'),(19,'orang_tua','dadinatsir@gmail.com','$2y$10$JinI1mLa9Yasi2kIitRlJucjy24NsqEu62GkUqdIsdDPiZV0oGGAe',NULL,9,NULL,'2024-02-22 14:49:53','2024-02-22 14:50:43'),(20,'orang_tua','purwadiwaluyo@gmail.com','$2y$10$ydfxUmxwuUz2JsVTtOQghOv3RmFhU50UM73XnNkM8biP4Pt6CBYMq',NULL,10,NULL,'2024-02-22 14:49:58','2024-02-22 14:50:50'),(21,'orang_tua','entengkuswoyo@gmail.com','$2y$10$Zo80GEdNfCEdqQRhlrzsWOBJJhKSdQEguAuE1gLYFtcx/bTte7Qm2',NULL,11,NULL,'2024-02-22 14:50:03','2024-02-22 14:51:00'),(22,'orang_tua','harjasamaulana@gmail.com','$2y$10$5w2QFHLsR6EG2LZFzgvcLen3jHdZkYI0WVxMn0yCUvRVkgr3BTT/i',NULL,12,NULL,'2024-02-22 14:50:09','2024-02-22 14:51:12'),(23,'orang_tua','agnesastuti@gmail.com','$2y$10$ocqG6vyzgVxlb2j1qY.bHuqhKsjqOxX7OpDB.As9kWpE4gniBDqCy',NULL,13,NULL,'2024-02-22 14:50:15','2024-02-22 14:51:21'),(24,'orang_tua','taniawulandari@gmail.com','$2y$10$goTzn9DHuOB5dv7m0a/9aOFHZ9mf9KZIpGlZ6Dqr5CWizvflv2pTG',NULL,14,NULL,'2024-02-22 14:50:20','2024-02-22 14:51:28'),(25,'orang_tua','idawijayanti@gmail.com','$2y$10$Cto9/B5/d56iUOUCp35qS.neqQ55GEv6NZP8bNQ9eW6xk6QQMZQJS',NULL,15,NULL,'2024-02-22 14:50:24','2024-02-22 14:50:24'),(26,'guru','ratihwahyuni@gmail.com','$2y$10$QuE35KcoF3dksHNWdM2nKuFtGg3HY7evsISaKut9HWMolugQz2zM6',1,NULL,NULL,'2024-02-22 14:51:35','2024-02-22 14:51:52'),(27,'guru','jasminprastuti@gmail.com','$2y$10$MpSGFwEvhRqmRXxOE2UJQedU3DbuxqI9rZ0HrehJPO3jiqzRO5.3u',2,NULL,NULL,'2024-02-22 14:51:39','2024-02-22 14:52:03');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-07  5:44:25
