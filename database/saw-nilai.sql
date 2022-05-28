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

-- Dumping structure for table saw.nilai
DROP TABLE IF EXISTS `nilai`;
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

-- Dumping data for table saw.nilai: ~30 rows (approximately)
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

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
