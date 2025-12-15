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
CREATE DATABASE recommendations_db;
USE recommendations_db;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` VALUES (3,1,21);
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
  `length` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `description` text NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recommendations`
--

LOCK TABLES `recommendations` WRITE;
/*!40000 ALTER TABLE `recommendations` DISABLE KEYS */;
INSERT INTO `recommendations` VALUES (4,'Kaspars',1,1,'Video','1',1.00,'1','2025-12-15 10:49:08','1','1','uploads/693fe7a48d955.webp'),(5,'Kaspars',1,1,'Ēdiens','1',1.00,'1','2025-12-15 10:49:15','1','1','uploads/693fe7abe1518.webp'),(6,'Kaspars',1,1,'Ēdiens','1',1.00,'1','2025-12-15 10:49:23','1','1','uploads/693fe7b3bc9b5.webp'),(7,'Kaspars',1,1,'Video','1',1.00,'1','2025-12-15 10:49:32','1','1','uploads/693fe7bc0d824.webp'),(8,'Kaspars',1,1,'Ēdiens','1',1.00,'1','2025-12-15 10:49:43','1','1','uploads/693fe7c7b241b.webp'),(9,'Kaspars',1,1,'Ēdiens','1',1.00,'1','2025-12-15 10:49:51','1','1','uploads/693fe7cfa58a5.webp'),(10,'Kaspars',1,1,'Ēdiens','1',1.00,'1','2025-12-15 10:50:00','1','1','uploads/693fe7d848b7c.webp'),(11,'Kaspars',1,1,'Ēdiens','1',1.00,'1','2025-12-15 10:50:08','1','1','uploads/693fe7e0677c6.webp'),(12,'Kaspars',1,1,'Ēdiens','1',1.00,'1','2025-12-15 10:50:16','1','1','uploads/693fe7e8761bc.webp'),(13,'Kaspars',1,1,'Ēdiens','1',1.00,'1','2025-12-15 10:50:28','1','1','uploads/693fe7f432388.webp'),(14,'Kaspars',1,1,'Video','1',1.00,'1','2025-12-15 10:50:36','1','1','uploads/693fe7fc53439.webp'),(15,'Kaspars',1,1,'Ēdiens','1',1.00,'1','2025-12-15 10:50:44','1','1','uploads/693fe8045efff.webp'),(16,'Kaspars',1,1,'Ēdiens','1',1.00,'1','2025-12-15 10:50:54','1','1','uploads/693fe80e68b7c.webp'),(17,'Kaspars',1,1,'Ēdiens','1',1.00,'1','2025-12-15 10:51:02','1','1','uploads/693fe8167da4e.webp'),(18,'Kaspars',1,1,'Ēdiens','1',1.00,'1','2025-12-15 10:51:11','1','1','uploads/693fe81f102cc.webp'),(19,'Kaspars',1,1,'Ēdiens','1',1.00,'1','2025-12-15 10:51:23','1','1','uploads/693fe82bc92d0.webp'),(20,'Kaspars',1,1,'Ēdiens','1',1.00,'1','2025-12-15 10:51:36','1','1','uploads/693fe83831018.webp'),(21,'Kaspars',1,8,'Video','123',123.00,'123','2025-12-15 10:52:38','123','231','uploads/693fe876e6062.webp');
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

-- Dump completed on 2025-12-15 13:36:24
