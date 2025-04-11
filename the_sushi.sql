-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.39 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for the_sushi
CREATE DATABASE IF NOT EXISTS `the_sushi` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `the_sushi`;

-- Dumping structure for table the_sushi.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` varchar(100) NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table the_sushi.admin: ~1 rows (approximately)
INSERT INTO `admin` (`id`, `user`, `password`) VALUES
	(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055');

-- Dumping structure for table the_sushi.binhluan1
CREATE TABLE IF NOT EXISTS `binhluan1` (
  `mabl` int NOT NULL AUTO_INCREMENT,
  `mahh` int NOT NULL,
  `makh` int NOT NULL,
  `ngaybl` date NOT NULL,
  `noidung` text NOT NULL,
  PRIMARY KEY (`mabl`),
  KEY `fk_bl_mahh` (`mahh`),
  KEY `fk_bl_kh` (`makh`),
  CONSTRAINT `fk_bl_kh` FOREIGN KEY (`makh`) REFERENCES `khachhang1` (`makh`),
  CONSTRAINT `fk_bl_mahh` FOREIGN KEY (`mahh`) REFERENCES `hanghoa` (`mahh`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table the_sushi.binhluan1: ~8 rows (approximately)
INSERT INTO `binhluan1` (`mabl`, `mahh`, `makh`, `ngaybl`, `noidung`) VALUES
	(33, 1, 21, '2025-04-08', 'cũng hay'),
	(34, 1, 21, '2025-04-08', 'cũng hay'),
	(35, 1, 21, '2025-04-08', 'cũng hay'),
	(36, 1, 21, '2025-04-08', 'lol'),
	(37, 1, 24, '2025-04-11', 'xin gias');

-- Dumping structure for table the_sushi.cthoadon1
CREATE TABLE IF NOT EXISTS `cthoadon1` (
  `masohd` int NOT NULL,
  `mahh` int NOT NULL,
  `soluongmua` int NOT NULL,
  `maloai` varchar(10) NOT NULL,
  `thanhtien` int NOT NULL,
  `tinhtrang` int NOT NULL,
  PRIMARY KEY (`masohd`,`mahh`),
  KEY `fk_cthd_mahh` (`mahh`),
  CONSTRAINT `fk_cthd_mahd` FOREIGN KEY (`masohd`) REFERENCES `hoadon1` (`masohd`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_cthd_mahh` FOREIGN KEY (`mahh`) REFERENCES `hanghoa` (`mahh`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table the_sushi.cthoadon1: ~24 rows (approximately)
INSERT INTO `cthoadon1` (`masohd`, `mahh`, `soluongmua`, `maloai`, `thanhtien`, `tinhtrang`) VALUES
	(92, 3, 2, '3', 40, 0),
	(93, 4, 2, '3', 36, 0),
	(94, 4, 2, '3', 36, 0),
	(94, 11, 1, '1', 6, 0),
	(103, 12, 1, '10', 5, 0),
	(119, 9, 1, '5', 7, 0),
	(121, 1, 1, '6', 9, 0),
	(122, 1, 2, '6', 18, 0),
	(123, 1, 2, '6', 18, 0),
	(124, 1, 2, '6', 18, 0),
	(125, 1, 1, '6', 9, 0),
	(126, 1, 1, '6', 9, 0);

-- Dumping structure for table the_sushi.hanghoa
CREATE TABLE IF NOT EXISTS `hanghoa` (
  `mahh` int NOT NULL AUTO_INCREMENT,
  `tenhh` varchar(60) NOT NULL,
  `dongia` float NOT NULL,
  `giamgia` float NOT NULL,
  `hinh` varchar(250) NOT NULL,
  `Nhom` int NOT NULL,
  `maloai` int NOT NULL,
  `soluotxem` int NOT NULL,
  `ngaylap` date NOT NULL,
  `mota` varchar(2000) NOT NULL,
  `soluongton` int NOT NULL,
  `tinhtrang` tinyint(1) NOT NULL,
  PRIMARY KEY (`mahh`),
  KEY `FK_hanghoa_maloai` (`maloai`),
  CONSTRAINT `FK_hanghoa_maloai` FOREIGN KEY (`maloai`) REFERENCES `loai` (`maloai`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table the_sushi.hanghoa: ~18 rows (approximately)
INSERT INTO `hanghoa` (`mahh`, `tenhh`, `dongia`, `giamgia`, `hinh`, `Nhom`, `maloai`, `soluotxem`, `ngaylap`, `mota`, `soluongton`, `tinhtrang`) VALUES
	(1, 'Onigiri', 9, 0, 'Onigiri.jpg', 0, 6, 5, '2025-01-18', 'Cơm nắm Onigiri được xem là một trong những món ăn vặt phổ biến nhất của người Nhật bởi vị ngon, đặc biệt và sự tiện dụng.', 98, 0),
	(2, 'Spring Rolls', 15.99, 0, 'Spring Rolls sushi.jpg', 0, 1, 3, '2025-11-01', 'Món cuốn là một loạt các món khai vị ở dạng cuộn/cuốn hoặc điểm sấm được tìm thấy trong ẩm thực Đông Á, ẩm thực Nam Á, ẩm thực Trung Đông và ẩm thực Đông Nam Á và các quốc gia trên thế giới trong đó có Việt Nam.', 112, 1),
	(3, 'Sushi Rolls', 19.99, 2, 'Sushi Rolls.jpg', 0, 3, 4, '2025-03-30', 'Sushi Roll được làm bằng cách trải đều một lớp cơm lên trên tấm rong biển và ở trên cùng là một lớp gồm hải sản hay rau củ rồi sau đó cuộn nó lại', 0, 1),
	(4, 'Salmon Sushi', 17.99, 0, 'Salmon Sushi.jpg', 0, 3, 1, '2025-03-30', 'Siêu bất ngờ với hương vị lạ miệng mà sự kết hợp giữa các nguyên liệu của món ăn này mang lại. Một sự pha trộn thú vị đáng ngạc nhiên của kết cấu giòn của cá.', 0, 1),
	(5, 'Chef’s Choice – Luxury Platter', 12, 0, 'Chef’s Choice.png', 0, 4, 0, '2025-07-25', 'Beware, our sushi platters could steal the show at your next event!Available from December 1st, 2022, to January 31st, 2023 only.', 50, 0),
	(9, 'Monkey Brain Tuna', 7.4, 0, 'Monkey Brain Tuna.webp', 0, 5, 1, '2025-03-30', '4 crispy pieces of avocado garnished with a velvety tuna mix. Accompanied by our trio of sauces, they are a decadent treat!', 0, 1),
	(10, 'Passion Fruit Mayo', 7.45, 0, 'Passion Fruit Mayo.png', 0, 5, 1, '2025-01-13', 'Go ahead ... Add a little extra, we won’t judge you.', 0, 1),
	(11, 'Red Ruby', 5.7, 0, 'Red Ruby.png', 0, 1, 1, '2023-05-18', 'Each of our Blossom rolls offers ingredients in the roll as well as on top mimicking the beautiful Japanese flower.', 1000, 1),
	(12, 'Cranberry Fruit Juice and Basil Seed', 5, 1, 'Cranberry Fruit Juice and Basil Seed.png', 0, 10, 2, '2025-01-16', 'To the benefit of: Quebec Breast Cancer Foundation. For every beverage purchased, $1 will be donated to the Quebec Breast Cancer Foundation.', 0, 1),
	(15, 'Rainbow Jelly', 5, 0, 'BBTS-EXTRAS_GELEE-RAINBOW_350x350-350x350.png', 0, 6, 1, '2025-03-30', 'A fusion of fruity flavours that explodes in your mouth! Have fun trying them with each of our flavours!', 50, 0),
	(16, 'Coffee Jelly', 5, 1, 'Coffee Jelly.png', 0, 7, 2, '2024-06-20', 'With its mild coffee aroma and sweet notes, our jelly is a perfect match for our milk teas.', 50, 0),
	(18, 'Blueberry Popping Pearls', 5, 0.8, 'BBTS-EXTRAS_POPPING-BLEUET_350x350-350x350.png', 0, 3, 1, '2025-02-20', 'Customize your drink the way you want with our different types of extras.', 50, 0),
	(19, 'Karaage Chicken & Mango', 9, 0, 'Karaage Chicken & Mango.png', 0, 8, 1, '2024-06-08', 'All our Poke bowls come with the choice of white rice, brown rice, Sushi Shop’s unique Crispy sticky rice or lettuce. Try it, you will love it!', 50, 0),
	(20, 'DiabloTM', 10, 0, 'Karaage Chicken & Mango.png', 0, 8, 1, '2025-03-30', 'All our Poke bowls come with the choice of white rice, brown rice, Sushi Shop’s unique Crispy sticky rice or lettuce. Try it, you will love it!', 50, 0),
	(21, 'Spicy Salmon', 9.5, 0, 'BOLS-POKE_SAUMONEPICE-350x350.png', 0, 4, 1, '2025-03-30', 'All our Poke bowls come with the choice of white rice, brown rice, Sushi Shop’s unique Crispy sticky rice or lettuce. Try it, you will love it!', 50, 0),
	(22, 'Avocado', 4, 0.8, 'avocado.png', 0, 4, 1, '2024-07-18', 'Small rolls containing two or three ingredients. These come in sixes and are a great accompaniment or perfect for a quick bite. Simple and delicious.', 23, 0),
	(24, 'Kamikaze Salmon', 6, 0, 'Kamikaze Salmon.png', 0, 7, 1, '2023-11-25', 'Large rolls cut into five pieces. Simple as well as more complex flavour combinations. Discover them today!', 12, 0),
	(25, 'Spicy Tuna & Mango', 7, 0, 'Spicy Tuna & Mango.png', 0, 7, 1, '2025-01-24', 'Our Sushi Burrito are a good option for a meal on-the-go! Served with spicy light mayo, soy, sesame or Ying Yang sauce.', 12, 0);

-- Dumping structure for table the_sushi.hoadon1
CREATE TABLE IF NOT EXISTS `hoadon1` (
  `masohd` int NOT NULL AUTO_INCREMENT,
  `makh` int NOT NULL,
  `ngaydat` date NOT NULL,
  `tongtien` int NOT NULL,
  PRIMARY KEY (`masohd`),
  KEY `fk_hoadon_kh` (`makh`),
  CONSTRAINT `fk_hoadon_kh` FOREIGN KEY (`makh`) REFERENCES `khachhang1` (`makh`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table the_sushi.hoadon1: ~43 rows (approximately)
INSERT INTO `hoadon1` (`masohd`, `makh`, `ngaydat`, `tongtien`) VALUES
	(92, 21, '2025-03-30', 40),
	(93, 21, '2025-03-30', 36),
	(94, 21, '2025-03-30', 42),
	(95, 21, '2025-04-07', 0),
	(96, 21, '2025-04-07', 0),
	(97, 21, '2025-04-07', 0),
	(98, 21, '2025-04-07', 0),
	(99, 21, '2025-04-07', 0),
	(100, 21, '2025-04-07', 0),
	(101, 21, '2025-04-07', 0),
	(102, 21, '2025-04-07', 0),
	(103, 21, '2025-04-07', 5),
	(104, 21, '2025-04-07', 0),
	(105, 21, '2025-04-07', 0),
	(106, 21, '2025-04-07', 0),
	(107, 21, '2025-04-07', 0),
	(108, 21, '2025-04-07', 0),
	(109, 21, '2025-04-07', 0),
	(110, 21, '2025-04-07', 0),
	(111, 21, '2025-04-07', 0),
	(112, 21, '2025-04-07', 0),
	(113, 21, '2025-04-07', 0),
	(114, 21, '2025-04-07', 0),
	(115, 21, '2025-04-07', 0),
	(116, 21, '2025-04-07', 0),
	(117, 21, '2025-04-07', 0),
	(118, 21, '2025-04-07', 0),
	(119, 21, '2025-04-07', 7),
	(120, 21, '2025-04-07', 0),
	(121, 21, '2025-04-07', 9),
	(122, 21, '2025-04-08', 18),
	(123, 21, '2025-04-08', 18),
	(124, 21, '2025-04-08', 18),
	(125, 21, '2025-04-08', 21),
	(126, 24, '2025-04-11', 9);

-- Dumping structure for table the_sushi.khachhang1
CREATE TABLE IF NOT EXISTS `khachhang1` (
  `makh` int NOT NULL AUTO_INCREMENT,
  `tenkh` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `matkhau` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `diachi` text NOT NULL,
  `sodienthoai` varchar(12) NOT NULL,
  `vaitro` int DEFAULT '0',
  PRIMARY KEY (`makh`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table the_sushi.khachhang1: ~5 rows (approximately)
INSERT INTO `khachhang1` (`makh`, `tenkh`, `username`, `matkhau`, `email`, `diachi`, `sodienthoai`, `vaitro`) VALUES
	(21, 'Võ Thành Trung', 'ttrung2003', '81dc9bdb52d04dc20036dbd8313ed055', 'doanlaptrinh2003@gmail.com', 'TPHCM', '0395179799', 0),
	(24, 'Thành Trung Võ', 'vothanhtrung9379', '', 'vothanhtrung9379@gmail.com', 'HCM', '0999999', 0);

-- Dumping structure for table the_sushi.loai
CREATE TABLE IF NOT EXISTS `loai` (
  `maloai` int NOT NULL AUTO_INCREMENT,
  `tenloai` varchar(50) NOT NULL,
  `idmenu` int NOT NULL,
  PRIMARY KEY (`maloai`),
  KEY `FK_loai_menu` (`idmenu`),
  CONSTRAINT `FK_loai_menu` FOREIGN KEY (`idmenu`) REFERENCES `menu` (`idmenu`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table the_sushi.loai: ~11 rows (approximately)
INSERT INTO `loai` (`maloai`, `tenloai`, `idmenu`) VALUES
	(1, 'Nare sushi', 3),
	(3, 'Nigirizushi', 3),
	(4, 'Chirashizushi', 3),
	(5, 'Makimono', 3),
	(6, 'Gunkan', 3),
	(7, 'Oshizushi', 3),
	(8, 'Temaki', 3),
	(10, 'Nước', 3);

-- Dumping structure for table the_sushi.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `idmenu` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `link` varchar(150) NOT NULL,
  PRIMARY KEY (`idmenu`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table the_sushi.menu: ~5 rows (approximately)
INSERT INTO `menu` (`idmenu`, `name`, `link`) VALUES
	(1, 'Trang Chủ', 'index.php'),
	(3, 'Sushi', ''),
	(4, 'Liên Hệ', 'View/lienhe.php'),
	(5, 'Tài Khoản', 'View/gioithieu.php');

-- Dumping structure for table the_sushi.user1
CREATE TABLE IF NOT EXISTS `user1` (
  `makh` int NOT NULL AUTO_INCREMENT,
  `tenkh` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `sodienthoai` varchar(255) NOT NULL,
  PRIMARY KEY (`makh`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table the_sushi.user1: ~3 rows (approximately)
INSERT INTO `user1` (`makh`, `tenkh`, `email`, `diachi`, `sodienthoai`) VALUES
	(5, 'Võ Thành Trung', 'vothanhtrung9379@gmail.com', 'TPHCM', '0395179799'),
	(6, 'userdemo', 'vothanhtrung9379@gmail.com', 'TPHCM', '0395179799');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
