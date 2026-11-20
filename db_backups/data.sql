-- MySQL dump 10.13  Distrib 8.0.46, for Linux (x86_64)
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_gallery`
--

LOCK TABLES `post_gallery` WRITE;
/*!40000 ALTER TABLE `post_gallery` DISABLE KEYS */;
INSERT INTO `post_gallery` VALUES (1,5,'AMWIM24.jpg','storage/images/2024',0),(2,5,'puchar_uw.jpeg','storage/images/2024',1),(3,5,'puchar_uw_2.jpeg','storage/images/2024',2),(4,10,'AMWIM_2025.jpg.webp','storage/images/2026/amwim',0),(5,10,'na_wodzie.jpg','storage/images/2026/amwim',1),(6,10,'podium_1.jpeg','storage/images/2026/amwim',2),(7,10,'podium_2.jpg','storage/images/2026/amwim',3),(8,10,'zaloga_1.jpg','storage/images/2026/amwim',4),(9,10,'zaloga_2.jpg','storage/images/2026/amwim',5),(10,10,'zaloga_3.jpg','storage/images/2026/amwim',6),(11,10,'zaloga_5.jpg','storage/images/2026/amwim',7),(12,11,'amp_2026_cover.webp','storage/images/2026/amp',10),(13,11,'IMG_9640.jpeg','storage/images/2026/amp',11),(14,11,'IMG_9750.JPG','storage/images/2026/amp',2),(15,11,'IMG_9751.JPG','storage/images/2026/amp',3),(16,11,'IMG_9752.JPG','storage/images/2026/amp',4),(17,11,'IMG_9753.JPG','storage/images/2026/amp',5),(18,11,'IMG_9754.JPG','storage/images/2026/amp',6),(19,11,'IMG_9755.JPG','storage/images/2026/amp',7),(20,11,'IMG_9756.JPG','storage/images/2026/amp',8),(21,11,'IMG_9757.JPG','storage/images/2026/amp',9),(22,11,'att.G5xWBDuB_vEV_TJqyz3n4Pgim3HJ3SBCdVWpl9LUhz4.JPG','storage/images/2026/amp',0),(23,11,'podium_1.JPG','storage/images/2026/amp',1),(28,13,'test2_6a33e0062b9d9.jpg','storage/images/2026/test2',1),(29,13,'test2_6a33e006e3805.jpg','storage/images/2026/test2',2),(30,13,'test2_6a33e0079a69c.jpg','storage/images/2026/test2',3);
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
  `photo_credits` tinyint(1) DEFAULT 0,
  `status` enum('draft','pending','published') DEFAULT 'draft',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'Akademickie Mistrzostwa Polski w Żeglarstwie 2025','2025-06-01','Aleksander Szczygielski','W tym roku Argo do najważniejszych regat w sezonie wystawiło dwie załogi.','storage/images/2025/AMP25.jpg','<p>\r\n    W tym roku Argo do najważniejszych regat w sezonie wystawiło dwie załogi. Zawody AMP 2025 ponownie okazały się wymagającym sprawdzianem — zmienne warunki na wodzie, momentami bardzo nieprzewidywalny wiatr oraz ciasna rywalizacja sprawiły, że o każdym miejscu decydowały detale. Obie nasze ekipy przez cały czas walczyły równo i konsekwentnie, zdobywając cenne doświadczenie na przyszłość. Choć nie obyło się bez trudniejszych momentów, wyjeżdżamy z poczuciem dobrze wykonanej pracy i sportowej satysfakcji.\r\n</p>','https://www.upwind24.pl/amp-2025',1,'published'),(2,'Jak wyglądają nasze treningi?','2024-05-10','GALL ANONIM','Prace w toku...','storage/images/2024/Amp1.jpg',NULL,NULL,0,'published'),(3,'Jak dbamy o sprzęt?','2024-05-10','GALL ANONIM','Prace w toku...','storage/images/2024/boat_sleep.webp',NULL,NULL,0,'published'),(4,'Skąd wzięła się nazwa Argo?','2024-05-10','GALL ANONIM','Prace w toku...','storage/images/argo_painting.jpg',NULL,NULL,0,'published'),(5,'Akademickie Mistrzostwa Warszawy i Mazowsza w Żeglarstwie 2024','2024-05-11','Aleksander Szczygielski','W tym roku Argo wystawiło dwie załogi.','storage/images/2024/puchar_uw.jpeg','<p>\r\n    Akademickie Mistrzostwa Mazowsza i Warszawy przyniosły nam bardzo dobrą rywalizację oraz wyjątkowo mocną stawkę, w której od początku do końca nie było miejsca na błędy. Niestety, w jednym z wyścigów falstart pozbawił nas szansy na podium, ale mimo to jesteśmy bardzo zadowoleni z naszej żeglarskiej pracy — a to właśnie ona jest dla nas najważniejsza. Zawody były też świetną okazją do integracji z organizatorami oraz Klubem Żeglarskim UW, za co serdecznie dziękujemy. Wracamy z cennym doświadczeniem i już z niecierpliwością ruszamy na AMP-y z dużą chęcią rewanżu.\r\n</p>','https://www.upwind24.pl/regatta/regaty-o-puchar-rektora-uw-2024',1,'published'),(6,'Akademickie Mistrzostwa Polski w Żeglarstwie 2024','2024-05-26','Aleksander Szczygielski','W tym roku Argo do najważniejszych regat w sezonie wystawiło trzy załogi.','storage/images/2024/AMP24.jpg','<p>\r\n    Tegoroczne regaty dostarczyły nam wielu emocji i były prawdziwym sprawdzianem umiejętności. Podczas wyścigów mierzyliśmy się zarówno z bardzo silnym, jak i wyjątkowo słabym wiatrem, co wymagało szybkiego dostosowywania się do zmiennych warunków na wodzie. Nie obyło się również bez falstartów, które kosztowały nas kilka pozycji w klasyfikacji końcowej. Mimo tych trudności jesteśmy bardzo zadowoleni z osiągniętego wyniku i wracamy z jeszcze większą motywacją. Za rok na pewno powalczymy o jeszcze więcej!\r\n</p>','https://www.upwind24.pl/amp-2024',1,'published'),(7,'Akademickie Mistrzostwa Polski w Żeglarstwie 2023','2023-05-26','Aleksander Szczygielski','W tym roku Argo do najważniejszych regat w sezonie wystawiło trzy załogi.','storage/images/2023/AMP23.jpg','W tym roku Argo do najważniejszych regat w sezonie wystawiło trzy załogi.','https://www.upwind24.pl/regatta/amp-2023',1,'published'),(8,'Prace Przedsezonowe','2026-03-20','Aleksander Szczygielski','Przed sezonem dbamy dokładnie o nasz sprzęt!','storage/images/2026/clean.jpg','<p>Przed sezonem dbamy dokładnie o nasz sprzęt! Łódki czyste i wypolerowane pływają szybciej, więc członkowie ARGO zaangażowali się do pracy.</p>',NULL,0,'published'),(9,'Rozpoczynamy treningi','2026-04-26','Aleksander Szczygielski','Wraz z początkiem kwietnia rozpoczynamy nasze przygotowania do sezonu regatowego.','storage/images/2026/trening3.JPG','<p>Wraz z początkiem kwietnia rozpoczynamy nasze przygotowania do sezonu regatowego. Zwroty, starty, sparingi - wszystkie te elementy mają nas rozgrzać przed mistrzostwami wojewódzkimi oraz zawodami z cyklu Pucharu Polskiej Klasy Omega. Nie zapominamy także o Akademickich Mistrzostwach Polski, które odbędą się już pod koniec maja.</p>','',0,'published'),(10,'AZS Sailing Cup – Otwarty Puchar Mazowsza w żeglarstwie, Akademickie Mistrzostwa Warszawy i Mazowsza','2026-05-11','Gabriela Cielecka','Załoga ARGO AGH Kraków wraca z brązem z regat AMWIM na Zegrzu!','storage/images/2026/amwim/zaloga_4.jpg','<p>\r\n        Miniony weekend był dla naszej załogi prawdziwym sprawdzianem żeglarskich umiejętności.\r\n        Podczas Akademickich Mistrzostw Warszawy i Mazowsza rozegranych na Zalewie Zegrzyńskim\r\n        reprezentacja ARGO AGH Kraków wywalczyła <strong>3. miejsce</strong>, pokazując charakter\r\n        i skuteczność w bardzo wymagających taktycznie warunkach.\r\n    </p>\r\n\r\n    <p>\r\n        Zmienny i niestabilny wiatr sprawiał, że kluczowe znaczenie miała taktyka,\r\n        szybkie podejmowanie decyzji oraz dobra komunikacja na pokładzie.\r\n        Każdy wyścig wymagał pełnego skupienia i umiejętności odnalezienia się\r\n        w trudnej sytuacji na trasie.\r\n    </p>\r\n\r\n    <p>\r\n        Mimo wymagających warunków nasza załoga utrzymywała równe tempo przez całe regaty,\r\n        konsekwentnie walcząc o czołowe lokaty w kolejnych wyścigach.\r\n        Ostatecznie pozwoliło to stanąć na podium i zakończyć rywalizację\r\n        z bardzo dobrym wynikiem.\r\n    </p>\r\n\r\n    <p>\r\n        Dziękujemy organizatorom za świetnie przygotowane zawody oraz wszystkim\r\n        za wsparcie i doping.\r\n    </p>\r\n\r\n    <p>\r\n        Teraz pałeczkę przejmuje kolejna załoga, która już za tydzień w Morągu zwoduje łódkę\r\n        podczas regat Pucharu Polski. Trzymamy mocno kciuki za kolejne starty\r\n        i życzymy powodzenia na wodzie!\r\n    </p>\r\n\r\n    <p class=\"fw-semibold mb-5\">\r\n        Do zobaczenia na regatach!\r\n    </p>','https://www.upwind24.pl/regatta/amwim-w-zeglarstwie-2026',1,'published'),(11,'Akademickie Mistrzostwa Polski w Żeglarstwie 2026','2026-05-26','Gabriela Cielecka','Wicemistrzostwo Polski w UTE!','storage/images/2026/amp/podium_1.JPG','<p>\r\n        Tegoroczne Akademickie Mistrzostwa Polski upłynęły pod znakiem wymagających, niemal bezwietrznych warunków. Słaby wiatr sprawiał, że każdy błąd kosztował podwójnie, a o końcowym wyniku decydowały precyzja, cierpliwość i pełne skupienie na trasie.\r\n    </p>\r\n\r\n    <p>\r\n        Mimo trudnych warunków nasze załogi bardzo dobrze poradziły sobie w eliminacjach. Wszystkie trzy awansowały do złotej floty, co już samo w sobie było dużym sukcesem i potwierdzeniem wysokiego poziomu sportowego całej drużyny.\r\n    </p>\r\n\r\n    <p>\r\n        Finały przyniosły kolejne powody do dumy. Załoga Leona wywalczyła 3. miejsce w klasyfikacji indywidualnej uczelni technicznych, pokazując świetne przygotowanie i konsekwencję w każdym wyścigu.\r\n    </p>\r\n\r\n    <p>\r\n        Równie dobrze zaprezentowała się cała reprezentacja, zdobywając 2. miejsce w klasyfikacji drużynowej uczelni technicznych. To rezultat wspólnej pracy, zaangażowania i walki do ostatniego wyścigu.\r\n    </p>\r\n\r\n    <p>\r\n        AMP-y były nie tylko sportową rywalizacją, ale także kolejnym cennym doświadczeniem zdobytym na wodzie. Wracamy z medalami, motywacją do dalszej pracy i apetytem na jeszcze więcej w kolejnych startach.\r\n    </p>','https://www.upwind24.pl/regatta/akademickie-mistrzostwa-polski-w-zeglarstwie-2026-2026',1,'published'),(13,'Test2','2026-06-18','Stanisław Staszic','Testowy','storage/images/2026/test2/test2_6a33e0062b9d9.jpg','<p>Jhksjdbd.</p>','',0,'pending');
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

-- Dump completed on 2026-06-28  6:16:01
