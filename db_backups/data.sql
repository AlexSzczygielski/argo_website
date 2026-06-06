-- MySQL dump 10.13  Distrib 8.0.45, for Linux (x86_64)
--
-- Host: mysql.agh.edu.pl    Database: argo
-- ------------------------------------------------------
-- Server version	5.5.5-10.11.14-MariaDB-0+deb12u2

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
-- Table structure for table `post_gallery`
--

DROP TABLE IF EXISTS `post_gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `directory` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `post_gallery_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_gallery`
--

LOCK TABLES `post_gallery` WRITE;
/*!40000 ALTER TABLE `post_gallery` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `excerpt` varchar(255) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `results_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'Akademickie Mistrzostwa Polski w Żeglarstwie 2025','2025-06-01',NULL,'W tym roku Argo do najważniejszych regat w sezonie wystawiło dwie załogi.','storage/images/2025/AMP25.jpg',NULL,NULL),(2,'Jak wyglądają nasze treningi?','2024-05-10','GALL ANONIM','Prace w toku...','storage/images/2024/Amp1.jpg',NULL,NULL),(3,'Jak dbamy o sprzęt?','2024-05-10','GALL ANONIM','Prace w toku...','storage/images/2024/boat_sleep.webp',NULL,NULL),(4,'Skąd wzięła się nazwa Argo?','2024-05-10','GALL ANONIM','Prace w toku...','storage/images/argo_painting.jpg',NULL,NULL),(5,'Akademickie Mistrzostwa Warszawy i Mazowsza w Żeglarstwie 2024','2024-05-11','Aleksander Szczygielski','W tym roku Argo wystawiło dwie załogi.','storage/images/2024/puchar_uw.jpeg',NULL,NULL),(6,'Akademickie Mistrzostwa Polski w Żeglarstwie 2024','2024-05-26','Aleksander Szczygielski','W tym roku Argo do najważniejszych regat w sezonie wystawiło trzy załogi.','storage/images/2024/AMP24.jpg',NULL,NULL),(7,'Akademickie Mistrzostwa Polski w Żeglarstwie 2023','2023-05-26','Aleksander Szczygielski','W tym roku Argo do najważniejszych regat w sezonie wystawiło trzy załogi.','storage/images/2023/AMP23.jpg',NULL,NULL),(8,'Prace Przedsezonowe','2026-03-20','Aleksander Szczygielski','Przed sezonem dbamy dokładnie o nasz sprzęt!','storage/images/2026/clean.jpg',NULL,NULL),(9,'Rozpoczynamy treningi','2026-04-26','Aleksander Szczygielski','Wraz z początkiem kwietnia rozpoczynamy nasze przygotowania do sezonu regatowego.','storage/images/2026/trening3.JPG',NULL,NULL),(10,'AZS Sailing Cup – Otwarty Puchar Mazowsza w żeglarstwie, Akademickie Mistrzostwa Warszawy i Mazowsza','2026-05-11','Gabriela Cielecka','Załoga ARGO AGH Kraków wraca z brązem z regat AMWIM na Zegrzu!','storage/images/2026/amwim/zaloga_4.jpg',NULL,NULL),(11,'Akademickie Mistrzostwa Polski w Żeglarstwie 2026','2026-05-26','Gabriela Cielecka','Wicemistrzostwo Polski w UTE!','storage/images/2026/amp/podium_1.JPG',NULL,NULL);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-06 20:46:51
