-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table saw.hasil
CREATE TABLE IF NOT EXISTS `hasil` (
  `kd_hasil` int(11) NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL,
  `nis` char(9) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `rangking` int(11) DEFAULT NULL,
  `tahun` char(4) DEFAULT NULL,
  PRIMARY KEY (`kd_hasil`),
  KEY `fk_mahasiswa` (`nis`),
  KEY `fk_beasiswa` (`kode`),
  CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `hasil_ibfk_2` FOREIGN KEY (`kode`) REFERENCES `jenis` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table saw.hasil: ~7 rows (approximately)
/*!40000 ALTER TABLE `hasil` DISABLE KEYS */;
INSERT INTO `hasil` (`kd_hasil`, `kode`, `nis`, `nama`, `nilai`, `rangking`, `tahun`) VALUES
	(1, 2, '8097', 'wina', 5.25, 1, '2022'),
	(2, 2, '125610080', 'Nur Afifah Safitri', 2.5, 2, '2017'),
	(3, 2, '12345566', 'ayin cembut', 2.25, 3, '2022'),
	(4, 2, '122112221', 'Dandi Irawan', 2, 4, '2022'),
	(5, 2, '125610036', 'Anisa Reviana Sakti', 2, 5, '2017'),
	(6, 2, '125610076', 'Heni Nurhidayati', 1.5, 6, '2017'),
	(7, 2, '123321', 'wicahyani', 0.5, 7, '2022');
/*!40000 ALTER TABLE `hasil` ENABLE KEYS */;

-- Dumping structure for table saw.jenis
CREATE TABLE IF NOT EXISTS `jenis` (
  `kode` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table saw.jenis: ~0 rows (approximately)
/*!40000 ALTER TABLE `jenis` DISABLE KEYS */;
INSERT INTO `jenis` (`kode`, `nama`) VALUES
	(2, 'Rangking Tertinggi');
/*!40000 ALTER TABLE `jenis` ENABLE KEYS */;

-- Dumping structure for table saw.kriteria
CREATE TABLE IF NOT EXISTS `kriteria` (
  `kd_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `sifat` enum('min','max') DEFAULT NULL,
  `bobot` double NOT NULL,
  PRIMARY KEY (`kd_kriteria`),
  KEY `kd_beasiswa` (`kode`),
  KEY `kd_beasiswa_2` (`kode`),
  CONSTRAINT `fk_beasiswa` FOREIGN KEY (`kode`) REFERENCES `jenis` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table saw.kriteria: ~6 rows (approximately)
/*!40000 ALTER TABLE `kriteria` DISABLE KEYS */;
INSERT INTO `kriteria` (`kd_kriteria`, `kode`, `nama`, `sifat`, `bobot`) VALUES
	(1, 2, 'Nilai Rata Rata Rapor', 'max', 0.1),
	(2, 2, 'Tes Tulis Ilmu Pengetahuan Alam', 'max', 0.15),
	(3, 2, 'Tes Tulis Ilmu Pengetahuan Sosial', 'max', 0.15),
	(4, 2, 'Tes Tulis Matematika', 'max', 0.15),
	(5, 2, 'Tes Tulis Bahasa Inggris', 'max', 0.15),
	(6, 2, 'Prestasi ', 'max', 0.3);
/*!40000 ALTER TABLE `kriteria` ENABLE KEYS */;

-- Dumping structure for table saw.model
CREATE TABLE IF NOT EXISTS `model` (
  `kd_model` int(11) NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL,
  `kd_kriteria` int(11) NOT NULL,
  `bobot` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`kd_model`),
  KEY `fk_kriteria` (`kd_kriteria`),
  KEY `fk_beasiswa` (`kode`),
  CONSTRAINT `model_ibfk_1` FOREIGN KEY (`kd_kriteria`) REFERENCES `kriteria` (`kd_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `model_ibfk_2` FOREIGN KEY (`kode`) REFERENCES `jenis` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table saw.model: ~3 rows (approximately)
/*!40000 ALTER TABLE `model` DISABLE KEYS */;
INSERT INTO `model` (`kd_model`, `kode`, `kd_kriteria`, `bobot`) VALUES
	(4, 2, 1, '0.40'),
	(5, 2, 2, '0.40'),
	(6, 2, 3, '0.20');
/*!40000 ALTER TABLE `model` ENABLE KEYS */;

-- Dumping structure for table saw.nilai
CREATE TABLE IF NOT EXISTS `nilai` (
  `kd_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `kode` int(11) DEFAULT NULL,
  `kd_kriteria` int(11) NOT NULL,
  `nis` char(9) NOT NULL,
  `nilai` float DEFAULT NULL,
  PRIMARY KEY (`kd_nilai`),
  KEY `fk_kriteria` (`kd_kriteria`),
  KEY `fk_mahasiswa` (`nis`),
  KEY `fk_beasiswa` (`kode`),
  CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`kd_kriteria`) REFERENCES `kriteria` (`kd_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nilai_ibfk_3` FOREIGN KEY (`kode`) REFERENCES `jenis` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=latin1;

-- Dumping data for table saw.nilai: ~28 rows (approximately)
/*!40000 ALTER TABLE `nilai` DISABLE KEYS */;
INSERT INTO `nilai` (`kd_nilai`, `kode`, `kd_kriteria`, `nis`, `nilai`) VALUES
	(9, 2, 1, '125610036', 3),
	(11, 2, 2, '125610036', 3),
	(12, 2, 3, '125610036', 2),
	(13, 2, 1, '125610080', 2),
	(14, 2, 2, '125610080', 4),
	(15, 2, 3, '125610080', 4),
	(16, 2, 1, '125610076', 1),
	(17, 2, 2, '125610076', 2),
	(18, 2, 3, '125610076', 3),
	(144, 2, 1, '122112221', 4),
	(145, 2, 2, '122112221', 1),
	(146, 2, 3, '122112221', 3),
	(150, 2, 1, '12345566', 4),
	(151, 2, 2, '12345566', 4),
	(152, 2, 3, '12345566', 1),
	(182, 2, 1, '123321', 2),
	(183, 2, 2, '123321', 0),
	(184, 2, 3, '123321', 0),
	(185, 2, 1, '8097', 2),
	(186, 2, 2, '8097', 3),
	(187, 2, 3, '8097', 4),
	(188, 2, 4, '8097', 5),
	(189, 2, 5, '8097', 5),
	(190, 2, 6, '8097', 5),
	(191, 2, 1, '102029191', 1),
	(192, 2, 2, '102029191', 1),
	(193, 2, 3, '102029191', 1),
	(194, 2, 4, '102029191', 2),
	(195, 2, 5, '102029191', 1),
	(196, 2, 6, '102029191', 2);
/*!40000 ALTER TABLE `nilai` ENABLE KEYS */;

-- Dumping structure for table saw.pengguna
CREATE TABLE IF NOT EXISTS `pengguna` (
  `kd_pengguna` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` enum('petugas','puket','mahasiswa') DEFAULT NULL,
  PRIMARY KEY (`kd_pengguna`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table saw.pengguna: ~3 rows (approximately)
/*!40000 ALTER TABLE `pengguna` DISABLE KEYS */;
INSERT INTO `pengguna` (`kd_pengguna`, `username`, `email`, `password`, `status`) VALUES
	(6, 'cobain', 'cobain@gmail.com', '$2y$10$9meUUXxmLW38Ni7s40i6qumKQqgxi.RYIzMuhQs0OJ558Ee5.yED.', 'mahasiswa'),
	(7, 'petugas', 'petugas@gmail.com', '$2y$10$/l2lKN94L6/tcMpJU6lp3.vMaFLD0WdyEGXIceqI9bVo4QrhCgJoC', 'petugas'),
	(8, 'puket', 'puket@gmail.com', '$2y$10$mxAfuE/5HBb07FpoYV5yVesdb4JwIwSkyuajqHc9jli6iF30lAr5W', 'puket');
/*!40000 ALTER TABLE `pengguna` ENABLE KEYS */;

-- Dumping structure for table saw.penilaian
CREATE TABLE IF NOT EXISTS `penilaian` (
  `kd_penilaian` int(11) NOT NULL AUTO_INCREMENT,
  `kode` int(11) DEFAULT NULL,
  `kd_kriteria` int(11) NOT NULL,
  `keterangan` varchar(20) NOT NULL,
  `bobot` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`kd_penilaian`),
  KEY `fk_kriteria` (`kd_kriteria`),
  KEY `fk_beasiswa` (`kode`),
  CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`kd_kriteria`) REFERENCES `kriteria` (`kd_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`kode`) REFERENCES `jenis` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=latin1;

-- Dumping data for table saw.penilaian: ~36 rows (approximately)
/*!40000 ALTER TABLE `penilaian` DISABLE KEYS */;
INSERT INTO `penilaian` (`kd_penilaian`, `kode`, `kd_kriteria`, `keterangan`, `bobot`) VALUES
	(13, 2, 1, ' 0 - 49', 0),
	(14, 2, 1, ' 50 - 59', 1),
	(15, 2, 1, '  60 - 69', 2),
	(16, 2, 1, ' 70 - 79', 3),
	(17, 2, 2, ' 0 - 49', 0),
	(18, 2, 2, '  50 - 59', 1),
	(19, 2, 2, '   60 - 69', 2),
	(20, 2, 2, '70 - 79', 3),
	(21, 2, 3, ' 0 - 49', 0),
	(22, 2, 3, '50 - 59', 1),
	(23, 2, 3, ' 60 - 69', 2),
	(24, 2, 3, '70 - 79', 3),
	(151, 2, 1, ' 80 - 89', 4),
	(152, 2, 1, ' 90 - 100', 5),
	(153, 2, 2, ' 80 - 89', 4),
	(154, 2, 2, '  90 - 100', 5),
	(155, 2, 3, ' 80 - 89', 4),
	(156, 2, 3, ' 90 - 100', 5),
	(157, 2, 4, ' 0 - 49', 0),
	(158, 2, 4, ' 50 - 59', 1),
	(159, 2, 4, '60 - 69', 2),
	(160, 2, 4, '70 - 79', 3),
	(161, 2, 4, '80 - 89', 4),
	(162, 2, 4, ' 80 - 89', 4),
	(163, 2, 4, '90 - 100', 5),
	(164, 2, 5, ' 0 - 49', 0),
	(165, 2, 5, ' 50 - 59', 1),
	(166, 2, 5, '60 - 69', 2),
	(167, 2, 5, '70 - 79', 3),
	(168, 2, 5, ' 80 - 89', 4),
	(169, 2, 5, ' 90 - 100', 5),
	(170, 2, 6, 'Tidak Ada', 0),
	(171, 2, 6, 'Kecamatan', 2),
	(172, 2, 6, 'Kabupaten', 3),
	(173, 2, 6, 'Provinsi', 4),
	(174, 2, 6, ' Nasional', 5);
/*!40000 ALTER TABLE `penilaian` ENABLE KEYS */;

-- Dumping structure for table saw.siswa
CREATE TABLE IF NOT EXISTS `siswa` (
  `nis` char(9) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `tahun_daftar` char(4) NOT NULL,
  PRIMARY KEY (`nis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table saw.siswa: ~8 rows (approximately)
/*!40000 ALTER TABLE `siswa` DISABLE KEYS */;
INSERT INTO `siswa` (`nis`, `nama`, `alamat`, `jenis_kelamin`, `tahun_daftar`) VALUES
	('102029191', 'blangkon', 'bondowoso', 'Laki-laki', '2022'),
	('122112221', 'Dandi Irawan', 'bondowoso', 'Laki-laki', '2022'),
	('123321', 'wicahyani', 'tasnan', 'Perempuan', '2022'),
	('12345566', 'ayin cembut', 'bandung', 'Perempuan', '2022'),
	('125610036', 'Anisa Reviana Sakti', 'Jogja', 'Perempuan', '2017'),
	('125610076', 'Heni Nurhidayati', 'palembang', 'Perempuan', '2017'),
	('125610080', 'Nur Afifah Safitri', 'Medan', 'Perempuan', '2017'),
	('8097', 'wina', 'jember', 'Perempuan', '2022');
/*!40000 ALTER TABLE `siswa` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
