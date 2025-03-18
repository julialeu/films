# ************************************************************
# Database: films
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table f_film
# ------------------------------------------------------------

DROP DATABASE IF EXISTS `films`;

CREATE DATABASE `films`;

USE `films`;

DROP TABLE IF EXISTS `f_film`;

CREATE TABLE `f_film` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `rating` float NOT NULL DEFAULT '0',
  `title` varchar(150) NOT NULL DEFAULT '',
  `year` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `f_film` WRITE;
/*!40000 ALTER TABLE `f_film` DISABLE KEYS */;

INSERT INTO `f_film` (`id`, `rating`, `title`, `year`)
VALUES
	(1,9.2,'The Shawshank Redemption',1994),
	(2,9.2,'The Godfather',1972),
	(3,8.9,'The Dark Knight',2008),
	(4,8.9,'Schindler\'s List',1993),
	(5,8.5,'Pulp Fiction',1994),
	(6,8.9,'The Good, the Bad and the Ugly',1966);

/*!40000 ALTER TABLE `f_film` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table f_image
# ------------------------------------------------------------

DROP TABLE IF EXISTS `f_image`;

CREATE TABLE `f_image` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `film_fk` int(11) unsigned NOT NULL,
  `image_url` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `film_fk` (`film_fk`),
  CONSTRAINT `f_image_ibfk_1` FOREIGN KEY (`film_fk`) REFERENCES `f_film` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `f_image` WRITE;
/*!40000 ALTER TABLE `f_image` DISABLE KEYS */;

INSERT INTO `f_image` (`id`, `film_fk`, `image_url`)
VALUES
	(1,1,'https://m.media-amazon.com/images/M/MV5BMDAyY2FhYjctNDc5OS00MDNlLThiMGUtY2UxYWVkNGY2ZjljXkEyXkFqcGc@._V1_.jpg'),
	(2,2,'http://www.sfsymphony.org/SanFranciscoSymphony/media/Library/Event-Images/TheGodfather_583x336.jpg?width=583&height=336&ext=.jpg'),
	(3,3,'https://m.media-amazon.com/images/M/MV5BZWFjNTdlZjctZTRkNC00OTQ1LWI3NDktOWY0ZWZmNzFiOTNkXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg'),
	(4,4,'http://thelibertarianrepublic.com/wp-content/uploads/2014/01/schindlers-list-17523-hd-wallpapers.jpg'),
	(5,5,'https://upload.wikimedia.org/wikipedia/en/3/3b/Pulp_Fiction_%281994%29_poster.jpg'),
	(6,6,'https://upload.wikimedia.org/wikipedia/en/4/45/Good_the_bad_and_the_ugly_poster.jpg');

/*!40000 ALTER TABLE `f_image` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
