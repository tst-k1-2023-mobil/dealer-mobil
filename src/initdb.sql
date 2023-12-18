-- Adminer 4.8.3 MySQL 8.2.0 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `dealer`;
CREATE DATABASE `dealer` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `dealer`;

DROP TABLE IF EXISTS `loyalitas`;
CREATE TABLE `loyalitas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `threshold` decimal(12,2) NOT NULL,
  `diskon` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `loyalitas` (`id`, `nama`, `threshold`, `diskon`) VALUES
(1,	'Bronze',	0.00,	0.00),
(2,	'Silver',	300000000.00,	0.05),
(3,	'Gold',	1000000000.00,	0.10),
(4,	'Platinum',	5000000000.00,	0.20);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `loyalitasId` int NOT NULL DEFAULT '1',
  `totalSpending` decimal(13,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `loyalitasId` (`loyalitasId`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`loyalitasId`) REFERENCES `loyalitas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user` (`id`, `nama`, `email`, `password`, `admin`, `loyalitasId`, `totalSpending`) VALUES
(1,	'Joni',	'admin@email.com',	'$2a$12$.NLgaQqR4HFuSEeoiD5kNebKdve6ff7FITll9s2lSGLpGZcre/X5y',	1,	1,	0.00),
(2,	'Jono',	'user@email.com',	'$2a$12$.NLgaQqR4HFuSEeoiD5kNebKdve6ff7FITll9s2lSGLpGZcre/X5y',	0,	1,	100000000.00);

DELIMITER ;;

CREATE TRIGGER `user_levelCalc_insert` BEFORE INSERT ON `user` FOR EACH ROW
begin
  set new.loyalitasId =
  (select id from loyalitas where threshold <= new.totalSpending order by id desc limit 1);
end;;

CREATE TRIGGER `user_levelCalc_update` BEFORE UPDATE ON `user` FOR EACH ROW
begin
  set new.loyalitasId =
  (select id from loyalitas where threshold <= new.totalSpending order by id desc limit 1);
end;;

DELIMITER ;

DROP TABLE IF EXISTS `pemesanan`;
CREATE TABLE `pemesanan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tglPesan` date NOT NULL DEFAULT (curdate()),
  `tglKirim` date NOT NULL,
  `mobilId` int NOT NULL,
  `jumlah` int NOT NULL DEFAULT '1',
  `totalHarga` decimal(13,2) NOT NULL,
  `userId` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  KEY `mobilId` (`mobilId`),
  CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`),
  CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`mobilId`) REFERENCES `pabrik`.`mobil` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `pemesanan` (`id`, `tglPesan`, `tglKirim`, `mobilId`, `jumlah`, `totalHarga`, `userId`) VALUES
(1,	'2023-12-14',	'2023-12-14',	1,	1,	100000000.00,	2);

DELIMITER ;;

CREATE TRIGGER `pemesanan_checkQty` BEFORE INSERT ON `pemesanan` FOR EACH ROW
begin
  if new.jumlah < 1 then
    signal sqlstate '45000' SET message_text = 'Jumlah pemesanan minimal 1';
  end if;
end;;

CREATE TRIGGER `pemesanan_totalCalc_insert` AFTER INSERT ON `pemesanan` FOR EACH ROW
begin
  update user set totalSpending = totalSpending + new.totalHarga where id=new.userId;
end;;

CREATE TRIGGER `pemesanan_totalCalc_update` AFTER UPDATE ON `pemesanan` FOR EACH ROW
begin
  update user set totalSpending = totalSpending - old.totalHarga where id=old.userId;
  update user set totalSpending = totalSpending + new.totalHarga where id=new.userId;
end;;

CREATE TRIGGER `pemesanan_totalCalc_delete` BEFORE DELETE ON `pemesanan` FOR EACH ROW
begin
  update user set totalSpending = totalSpending - old.totalHarga where id=old.userId;
end;;

DELIMITER ;

SET GLOBAL event_scheduler = ON;

-- 2023-12-15 23:27:26