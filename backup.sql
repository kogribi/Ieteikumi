-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: recommendations_db
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `likes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_like` (`user_id`,`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` VALUES (14,1,17),(18,1,21),(17,1,25),(15,3,17);
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recommendations`
--

DROP TABLE IF EXISTS `recommendations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recommendations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `user_id` int NOT NULL,
  `rating` int NOT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `length` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `description` text NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recommendations`
--

LOCK TABLES `recommendations` WRITE;
/*!40000 ALTER TABLE `recommendations` DISABLE KEYS */;
INSERT INTO `recommendations` VALUES (17,'Kaspars',1,1,'Ēdiens','1',4.00,0,'2025-11-25 16:39:23','sis ir lielesiokl','test','uploads/6925dbbb73c04.jpg'),(18,'Peteris1998',3,8,'Ēdiens','0',5.00,30,'2025-11-25 17:09:38','Klasiska itāļu pica ar sieru un tomātiem','Pica Margherita','uploads/6925e2d28b3bb.jpg'),(19,'Peteris1998',3,9,'Spēles','2',15.00,0,'2025-11-25 17:14:42','Minecraft ir “sandbox” spēle, ko izstrādājusi un publicējusi “Mojang Studios”. Formāli izlaista personālajiem datoriem 2011. gada 18. novembrī pēc sākotnējās publiskās alfa versijas izlaišanas 2009. gada 17. maijā, tā ir pārnesta uz daudzām platformām, tostarp mobilajām ierīcēm un dažādām videospēļu konsolēm.','Minecraft','uploads/6925e402aed00.webp'),(20,'Peteris1998',3,7,'Vietas','0',0.00,5,'2025-11-25 17:16:04','Lieliska vieta, kur iegādāties svaigus produktus','Rīgas Centrāltirgus','uploads/6925e4540d22c.jpg'),(21,'Peteris1998',3,8,'Aktivitāte','2',5.00,0,'2025-11-25 17:17:35','Relaksējoša aktivitāte svaigā gaisā','Jogas nodarbība parkā','uploads/6925e4af1929c.jpg'),(22,'Peteris1998',3,7,'Video','3',0.00,0,'2025-11-25 17:21:24','Rouza, kuru piespiež precēties ar bagātu vīrieti, iemīlas Džekā, talantīgā māksliniekā, uz nenogremdējamā Titānika klāja. Diemžēl kuģis ietriecas aisbergā, apdraudot viņu dzīvības.','Filma \"Titaniks\"','uploads/6925e594dbce2.jpeg'),(23,'Peteris1998',3,9,'Ēdiens','1',10.00,0,'2025-11-25 17:24:09','1. Malto gaļu izdauza pret galdu, lai tā paliktu viendabīgāka. Tad izveido no tās divas vienādas bumbinjas un saspiež tās starp pārtikas plēvi, lai izveidoajs divas plānas un apaļas gaļas plāksnites, kuras sasaldē.\r\n2. Sīpolu sagriež ripiņās un pārspiež ar citrona sulu.\r\n3. Kad gaļa sasalusi liek to uz karstas un ietaukotas pannas un pārkaisa ar sāli un pipariem, apcep no vienas puses, tad apgriež otrādi un atkal apkaisa.\r\n4. Maizītes pārgriež uz pusēm un apgrauzdē.\r\n5. Kārto: maizīte, gaļa, sīpoli, siers, salātlapa, majonēze/mērce pēc izveles, maizīte.\r\nBauda siltu\r\n\r\nLabu apetiiti!','Siera burgers','uploads/6925e6395c89e.jpg'),(24,'Peteris1998',3,7,'Vietas','0',0.00,5,'2025-11-25 17:26:09','Perfekta vieta prieks peldešanās, bet parasti daudz cilvēku.','Ninieris','uploads/6925e6b1836c3.png'),(25,'Peteris1998',3,8,'Spēles','32',20.00,0,'2025-11-25 17:29:58','Grand Theft Auto V ir 2013. gada piedzīvojumu spēle, ko izstrādāja Rockstar North un publicēja Rockstar Games. Tā ir septītā galvenā spēle Grand Theft Auto sērijā pēc 2008. gada Grand Theft Auto IV un kopumā piecpadsmitā daļa.','GTA V','uploads/6925e79696a71.avif');
/*!40000 ALTER TABLE `recommendations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Kaspars','ksokolovs50@gmail.com','$2y$10$rR9TNRlR7uicBlNfaV6VR.4honRH1S1dkwOVUONn4TONyfPm9h4a2','2025-10-30 16:07:50'),(2,'TEST_123','TESTING@gmail.com','$2y$10$gTjq6INS1F3cIUOWw9DaYO6.vQkaxCKVyRvpMa8QmJhOsNwMQ7muO','2025-10-31 12:48:25'),(3,'Peteris1998','peters123@gmail.com','$2y$10$.7K3DffqQ/wl3dq3AQ4rTuZpxvl2MhGjlea3lsLAZ/Ca3FDXzvsbK','2025-11-25 16:48:29');
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

-- Dump completed on 2025-11-25 20:18:43
