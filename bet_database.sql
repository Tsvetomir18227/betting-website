-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.27-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for bet
CREATE DATABASE IF NOT EXISTS `bet` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `bet`;

-- Dumping structure for table bet.bets
CREATE TABLE IF NOT EXISTS `bets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team1` varchar(50) NOT NULL DEFAULT '0',
  `team2` varchar(50) NOT NULL DEFAULT '0',
  `winner` int(11) DEFAULT NULL,
  `bet_amount` int(11) DEFAULT NULL,
  `userid` int(11) NOT NULL DEFAULT 0,
  `matchid` int(11) DEFAULT NULL,
  `betDate` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=402 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bet.bets: ~14 rows (approximately)
INSERT INTO `bets` (`id`, `team1`, `team2`, `winner`, `bet_amount`, `userid`, `matchid`, `betDate`) VALUES
	(388, 'Манчестър Сити', 'Челси', 2, 20, 8, 300, '2023-04-24'),
	(389, 'Ливърпул', 'Манчестър Юнайтед', 1, 10, 8, 301, '2023-04-24'),
	(390, 'Барселона', 'Реал Мадрид', 1, 6, 8, 302, '2023-04-24'),
	(391, 'Барселона', 'Реал Мадрид', 0, 11111, 26, 302, '2023-04-24'),
	(392, 'Тотнъм', 'Арсенал', 1, 2, 8, 307, '2023-04-24'),
	(393, 'Атлетико Мадрид', 'Райо Валекано', 1, 10, 8, 310, '2023-04-24'),
	(394, 'Евертън', 'Нюкасъл', 2, 7, 8, 311, '2023-04-25'),
	(395, 'Фулъм', 'Брайтън', 0, 3, 8, 312, '2023-04-25'),
	(396, 'Кристъл Палас', 'Лестър', 2, 10, 8, 313, '2023-04-26'),
	(397, 'Виляреал', 'Севиля', 2, 20, 27, 314, '2023-04-27'),
	(398, 'Борнемут', 'Уест Хам', 1, 10, 27, 316, '2023-04-27'),
	(399, 'Виляреал', 'Севиля', 2, 30, 19, 314, '2023-04-27'),
	(400, 'Ейбар', 'Гранада', 0, 10, 8, 317, '2023-05-20'),
	(401, 'Нотингам Форест', 'Уулвърхямптън', 2, 20, 28, 319, '2023-05-22');

-- Dumping structure for table bet.championship
CREATE TABLE IF NOT EXISTS `championship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team` varchar(255) DEFAULT NULL,
  `matches` int(11) DEFAULT 0,
  `wins` int(11) DEFAULT 0,
  `ties` int(11) DEFAULT 0,
  `loses` int(11) DEFAULT 0,
  `gd` int(11) DEFAULT 0,
  `g` int(11) DEFAULT 0,
  `d` int(11) DEFAULT 0,
  `points` int(11) DEFAULT 0,
  `nextMatches` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bet.championship: ~24 rows (approximately)
INSERT INTO `championship` (`id`, `team`, `matches`, `wins`, `ties`, `loses`, `gd`, `g`, `d`, `points`, `nextMatches`) VALUES
	(1, 'Шефилд Юнайтед', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(2, 'Бърнли', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(3, 'Лутън', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(4, 'Мидълзбро', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(5, 'Милоул', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(6, 'Уест Бромич', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(7, 'Блекбърн', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(8, 'Съндърланд', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(9, 'Ковънтри', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(10, 'Престън', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(11, 'Норич', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(12, 'Уотфорд', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(13, 'Суонзи', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(14, 'Бристол Сити', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(15, 'Бирмингам', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(16, 'Хъл Сити', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(17, 'Стоук Сити', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(18, 'Родъръм', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(19, 'Хъдърсфийлд', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(20, 'КПР', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(21, 'Кардиф Сити', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(22, 'Рединг', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(23, 'Блекпул', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(24, 'Уиган ', 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- Dumping structure for table bet.countries
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `championship` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bet.countries: ~6 rows (approximately)
INSERT INTO `countries` (`id`, `name`, `championship`) VALUES
	(1, 'Англия', 'Премиър Лийг'),
	(2, 'Англия', 'Чемпиъншип'),
	(3, 'Испания', 'Ла Лига'),
	(4, 'Испания', 'Ла Лига 2'),
	(5, 'Италия', 'Сериа А'),
	(6, 'Италия', 'Сериа Б');

-- Dumping structure for table bet.la_liga
CREATE TABLE IF NOT EXISTS `la_liga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team` varchar(255) DEFAULT NULL,
  `matches` int(11) DEFAULT 0,
  `wins` int(11) DEFAULT 0,
  `ties` int(11) DEFAULT 0,
  `loses` int(11) DEFAULT 0,
  `gd` int(11) DEFAULT 0,
  `g` int(11) DEFAULT 0,
  `d` int(11) DEFAULT 0,
  `points` int(11) DEFAULT 0,
  `nextMatches` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bet.la_liga: ~20 rows (approximately)
INSERT INTO `la_liga` (`id`, `team`, `matches`, `wins`, `ties`, `loses`, `gd`, `g`, `d`, `points`, `nextMatches`) VALUES
	(1, 'Барселона', 1, 1, 0, 0, 2, 3, 1, 3, 0),
	(2, 'Реал Мадрид', 1, 0, 0, 1, -2, 1, 3, 0, 0),
	(3, 'Атлетико Мадрид', 1, 0, 0, 1, -2, 2, 4, 0, 0),
	(4, 'Реал Сосиедад', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(5, 'Бетис', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(6, 'Виляреал', 0, 0, 0, 0, 0, 0, 0, 0, 1),
	(7, 'Атлетик Билбао', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(8, 'Осасуна', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(9, 'Райо Валекано', 1, 1, 0, 0, 2, 4, 2, 3, 0),
	(10, 'Жирона', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(11, 'Майорка', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(12, 'Селта', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(13, 'Севиля', 0, 0, 0, 0, 0, 0, 0, 0, 1),
	(14, 'Валядолид', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(15, 'Кадис', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(16, 'Хетафе', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(17, 'Валенсия', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(18, 'Алмерия', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(19, 'Еспаньол', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(20, 'Елче', 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- Dumping structure for table bet.la_liga_2
CREATE TABLE IF NOT EXISTS `la_liga_2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team` varchar(255) DEFAULT NULL,
  `matches` int(11) DEFAULT 0,
  `wins` int(11) DEFAULT 0,
  `ties` int(11) DEFAULT 0,
  `loses` int(11) DEFAULT 0,
  `gd` int(11) DEFAULT 0,
  `g` int(11) DEFAULT 0,
  `d` int(11) DEFAULT 0,
  `points` int(11) DEFAULT 0,
  `nextMatches` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bet.la_liga_2: ~22 rows (approximately)
INSERT INTO `la_liga_2` (`id`, `team`, `matches`, `wins`, `ties`, `loses`, `gd`, `g`, `d`, `points`, `nextMatches`) VALUES
	(1, 'Ейбар', 1, 0, 0, 1, -1, 2, 3, 0, 0),
	(2, 'Гранада', 1, 1, 0, 0, 1, 3, 2, 3, 0),
	(3, 'Лас Палмас', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(4, 'Алавес', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(5, 'Леванте', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(6, 'Албасете', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(7, 'Картахена', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(8, 'Бургос', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(9, 'ФК Андора', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(10, 'Сарагоса', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(11, 'Тенерифе', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(12, 'Уеска', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(13, 'Виляреал Б', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(14, 'Овиедо', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(15, 'Леганес', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(16, 'Мирандес', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(17, 'Спортинг Хихон', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(18, 'Расинг Сантандер', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(19, 'Малага', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(20, 'Понферадина', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(21, 'Ибиса', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(22, 'Луго', 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- Dumping structure for table bet.premier_league
CREATE TABLE IF NOT EXISTS `premier_league` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team` varchar(50) NOT NULL DEFAULT '0',
  `matches` int(11) DEFAULT 0,
  `wins` int(11) DEFAULT 0,
  `ties` int(11) DEFAULT 0,
  `loses` int(11) DEFAULT 0,
  `gd` int(11) DEFAULT 0,
  `g` int(11) DEFAULT 0,
  `d` int(11) DEFAULT 0,
  `points` int(11) DEFAULT 0,
  `nextMatches` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bet.premier_league: ~20 rows (approximately)
INSERT INTO `premier_league` (`id`, `team`, `matches`, `wins`, `ties`, `loses`, `gd`, `g`, `d`, `points`, `nextMatches`) VALUES
	(1, 'Манчестър Сити', 1, 1, 0, 0, 2, 3, 1, 3, 0),
	(2, 'Манчестър Юнайтед', 1, 0, 0, 1, -4, 0, 4, 0, 0),
	(3, 'Нюкасъл', 1, 0, 0, 1, -4, 0, 4, 0, 0),
	(4, 'Тотнъм', 1, 1, 0, 0, 4, 4, 0, 3, 0),
	(5, 'Арсенал', 1, 0, 0, 1, -4, 0, 4, 0, 0),
	(6, 'Астън Вила', 0, 0, 0, 0, 0, 0, 0, 0, 1),
	(7, 'Брентфорд', 0, 0, 0, 0, 0, 0, 0, 0, 1),
	(8, 'Евертън', 1, 1, 0, 0, 4, 4, 0, 3, 0),
	(9, 'Нотингам Форест', 0, 0, 0, 0, 0, 0, 0, 0, 1),
	(10, 'Борнемут', 1, 1, 0, 0, 3, 4, 1, 3, 0),
	(11, 'Лестър', 1, 0, 0, 1, -1, 0, 1, 0, 0),
	(12, 'Саутхямптън', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(13, 'Лийдс', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(14, 'Уулвърхямптън', 0, 0, 0, 0, 0, 0, 0, 0, 1),
	(15, 'Фулъм', 1, 1, 0, 0, 4, 4, 0, 3, 0),
	(16, 'Брайтън', 1, 0, 0, 1, -4, 0, 4, 0, 0),
	(17, 'Кристъл Палас', 1, 1, 0, 0, 1, 1, 0, 3, 0),
	(18, 'Уест Хам ', 1, 0, 0, 1, -3, 1, 4, 0, 0),
	(19, 'Ливърпул', 1, 1, 0, 0, 4, 4, 0, 3, 0),
	(20, 'Челси', 1, 0, 0, 1, -2, 1, 3, 0, 0);

-- Dumping structure for table bet.schedule
CREATE TABLE IF NOT EXISTS `schedule` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `team1` varchar(50) DEFAULT NULL,
  `team2` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `score1` int(11) DEFAULT NULL,
  `score2` int(11) DEFAULT NULL,
  PRIMARY KEY (`index`),
  KEY `FK_schedule_countries` (`country_id`) USING BTREE,
  CONSTRAINT `country_id_schedule_countries` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=320 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bet.schedule: ~12 rows (approximately)
INSERT INTO `schedule` (`index`, `team1`, `team2`, `date`, `time`, `country_id`, `score1`, `score2`) VALUES
	(300, 'Манчестър Сити', 'Челси', '2023-04-24', '19:43:30', 1, 3, 1),
	(301, 'Ливърпул', 'Манчестър Юнайтед', '2023-04-24', '19:45:00', 1, 4, 0),
	(302, 'Барселона', 'Реал Мадрид', '2023-04-24', '23:00:00', 3, 3, 1),
	(307, 'Тотнъм', 'Арсенал', '2023-04-24', '21:17:40', 1, 4, 0),
	(310, 'Атлетико Мадрид', 'Райо Валекано', '2023-04-24', '23:38:00', 3, 2, 4),
	(311, 'Евертън', 'Нюкасъл', '2023-04-25', '19:00:00', 1, 4, 0),
	(312, 'Фулъм', 'Брайтън', '2023-04-25', '20:00:00', 1, 4, 0),
	(313, 'Кристъл Палас', 'Лестър', '2023-04-26', '01:41:00', 1, 1, 0),
	(316, 'Борнемут', 'Уест Хам', '2023-04-27', '11:42:30', 1, 4, 1),
	(317, 'Ейбар', 'Гранада', '2023-05-20', '18:11:30', 4, 2, 3),
	(318, 'Астън Вила', 'Брентфорд', '2023-05-23', '20:00:00', 1, NULL, NULL),
	(319, 'Нотингам Форест', 'Уулвърхямптън', '2023-05-22', '23:59:59', 1, NULL, NULL);

-- Dumping structure for table bet.seria_a
CREATE TABLE IF NOT EXISTS `seria_a` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team` varchar(255) DEFAULT NULL,
  `matches` int(11) DEFAULT 0,
  `wins` int(11) DEFAULT 0,
  `ties` int(11) DEFAULT 0,
  `loses` int(11) DEFAULT 0,
  `gd` int(11) DEFAULT 0,
  `g` int(11) DEFAULT 0,
  `d` int(11) DEFAULT 0,
  `points` int(11) DEFAULT 0,
  `nextMatches` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bet.seria_a: ~20 rows (approximately)
INSERT INTO `seria_a` (`id`, `team`, `matches`, `wins`, `ties`, `loses`, `gd`, `g`, `d`, `points`, `nextMatches`) VALUES
	(1, 'Наполи', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(2, 'Лацио', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(3, 'Рома', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(4, 'Милан', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(5, 'Интер', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(6, 'Аталанта', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(7, 'Ювентус', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(8, 'Болоня', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(9, 'Фиорентина', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(10, 'Сасуоло', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(11, 'Торино', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(12, 'Удинезе', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(13, 'Монца', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(14, 'Емполи', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(15, 'Салернитана', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(16, 'Лече', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(17, 'Специя', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(18, 'Верона', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(19, 'Кремонезе', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(20, 'Сампдория', 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- Dumping structure for table bet.seria_b
CREATE TABLE IF NOT EXISTS `seria_b` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team` varchar(255) DEFAULT NULL,
  `matches` int(11) DEFAULT 0,
  `wins` int(11) DEFAULT 0,
  `ties` int(11) DEFAULT 0,
  `loses` int(11) DEFAULT 0,
  `gd` int(11) DEFAULT 0,
  `g` int(11) DEFAULT 0,
  `d` int(11) DEFAULT 0,
  `points` int(11) DEFAULT 0,
  `nextMatches` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bet.seria_b: ~20 rows (approximately)
INSERT INTO `seria_b` (`id`, `team`, `matches`, `wins`, `ties`, `loses`, `gd`, `g`, `d`, `points`, `nextMatches`) VALUES
	(1, 'Фрозиноне', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(2, 'Дженоа', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(3, 'Бари', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(4, 'Зюдтирол', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(5, 'Реджина', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(6, 'Каляри', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(7, 'Парма', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(8, 'Пиза', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(9, 'Палермо', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(10, 'Тернана', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(11, 'Модена', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(12, 'Асколи', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(13, 'Комо', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(14, 'Венеция', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(15, 'Читадела', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(16, 'Козенца', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(17, 'Преуджа', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(18, 'СПАЛ 2013', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(19, 'Бреша', 0, 0, 0, 0, 0, 0, 0, 0, 0),
	(20, 'Беневенто', 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- Dumping structure for table bet.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `ownMoney` int(11) DEFAULT NULL,
  `moneyInPage` int(11) DEFAULT NULL,
  `adminId` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bet.users: ~5 rows (approximately)
INSERT INTO `users` (`id`, `username`, `email`, `password`, `ownMoney`, `moneyInPage`, `adminId`) VALUES
	(8, 'tsvetomir', 'cvetomirmutashki123@gmail.com', 'f68fb29e3debb9b33ecf674c66ccf324', 0, 10, 1),
	(19, 'denkata', 'denkata@gmail.com', 'd252801f58f0d086f39542377cf393dc', 78, 0, 0),
	(27, 'cecko', 'cecko@abv.bg', '15f5ed0f7ba70f108506a4c47648c286', 10, 30, 0),
	(28, 'uktc123', 'uktc123@gmail.com', 'a37f8cd7f2bbd8aea92b6a51b193d513', 20, 10, 0),
	(29, '    ', 'a@abv.bg', '628631f07321b22d8c176c200c855e1b', 123, 0, 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
