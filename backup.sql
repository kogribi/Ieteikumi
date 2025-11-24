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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` VALUES (9,1,10),(4,1,11),(3,1,12),(8,1,15);
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recommendations`
--

LOCK TABLES `recommendations` WRITE;
/*!40000 ALTER TABLE `recommendations` DISABLE KEYS */;
INSERT INTO `recommendations` VALUES (5,'Kaspars',7,'Produkti','3',3000.00,1,'2025-10-31 17:47:56','Nopirku no lokala pircēja cēsis teica ka pardos vel tapec iesaku nopirkt lokacija: joiasjdoawjdoi','Laba un Lēta mašina','uploads/6904f64c69bfe.webp'),(6,'Kaspars',7,'Vietas','4',1.00,1,'2025-11-01 16:17:25','Ezers Ninieris ir ainavisks un mierpilns ūdenstilpnis, kas atrodas gleznainā Latvijas nostūrī, kur satiekas meži, pļavas un klusums. Tā ūdeņi spoguļo debesu atspulgus un vēja pieskārienus, radot īpašu harmonijas sajūtu. Ezeru ieskauj lēzeni krasti ar bagātīgu veģetāciju — niedrēm, meldriem un ūdensrožu laukiem, kas vasaras pilnbriedā piešķir tam košu un dzīvīgu izskatu.\r\n\r\nNinieris ir mājvieta daudzām putnu un zivju sugām. Pavasarī te ligzdo ūdensputni, bet makšķernieki bieži sastopami agrās rīta stundās, cerot uz bagātīgu lomu. Apkārtnē ved nelieli meža celiņi, kas aicina nesteidzīgās pastaigās un ļauj izbaudīt dabas mieru.\r\n\r\nLeģenda vēsta, ka senos laikos ezers radies tur, kur reiz bijis neliels ciems, ko pārņēmusi nakts vētra un lietusgāze. Cilvēki, kas tur dzīvojuši, esot pazuduši ūdeņos, un kopš tā laika ezers reizēm “elpo” — naktīs dzirdamas klusās skaņas, it kā zeme vēl atcerētos seno ciemu.\r\n\r\nŠodien Ninieris ir vieta, kur laiks it kā apstājas — ideāla atpūtai, dabas vērošanai un do','Ezers \"Ninieris','uploads/6906329543139.webp'),(7,'Kaspars',10,'Ēdiens','1',20.00,1,'2025-11-01 16:26:09','Sulīgs liellopa gaļas burgers ar mājās gatavotām mērcēm un kraukšķīgiem frī kartupeļiem. Ideāli piemērots ātrai pusdienai.\r\nMalto gaļu (vai zivi) liek bļodā, pievieno olu, šķipsniņu sāls, piparus, smalki sagrieztus sīpolus un ķiplokus, rīvmaizi un visu samīca viendabīgā masā.\r\nJa gaļu vēlas pikantāku, var pievienot maltus čili piparus vai čili mērci.\r\nUzkarsē pannā eļļu. Ar mitrām rokām veido kotletes un tās “pieplacina” uz gaļas dēlīša.\r\nLiek uz pannas un cep no abām pusēm brūnas. Cepšanas laikā kotletes “sarausies”, tāpēc veidojiet tās diametrā 1–2 cm lielākas, nekā ir jūsu maizītes.\r\nJa gatavo pikšas kotletes, tad masai pievieno rīvētu muskatriekstu un pirms cepšanas uz pannas kotletes panē rīvmaizē.\r\nKamēr kotletes cepas, sagatavo mērci: bļodiņā liek krējumu vai majonēzi, pievieno aso čili mērci un samaisa. Pagaršo. Mērcei ir jābūt pikantai. Ja nepieciešams, pievieno sāli un šķipsniņu cukura.\r\nSalātus noskalo un nosusina. Tomātus noskalo, sagriež ripiņās. Marinētos gurķus sagriež šķēlītēs','Perfekta burgera recepte','uploads/690634a1eebf8.jpg'),(8,'Kaspars',7,'Produkti','5',67.00,1,'2025-11-01 16:27:27','Piemers ar kaut ko','Piemers','uploads/690634efa1400.jpg'),(9,'Kaspars',7,'Vietas','2',23.00,1,'2025-11-01 16:33:18','Lieliska pārgājienu taka. Taka vijas gar Latvijas garāko upi Gauju. Daudz meža, dažās kalnainās takas daļās jāredz spoguļklintis. Takas sākumā, sākot no upes krasta, ir lieliskas kempinga vietas ar informācijas centru, daži pludmales volejbola laukumi un laivu noma. Tur var viegli pavadīt visu dienu vai pāris dienas. Tāpat ir lieliskas makšķerēšanas vietas. Ja jums patīk daba, šī ir lieliska vieta.','Cīrulīšu dabas takas','uploads/6906364e942ec.webp'),(10,'Kaspars',6,'Vietas','8',1.00,23,'2025-11-01 17:16:39','Super Lielā Dabas Taka ir plaša un daudzveidīga maršruta taka, kas ved cauri Latvijas krāšņākajām ainavām — mežiem, pļavām, purviem un upju ielejām. Tā ir ideāla vieta gan mierīgai pastaigai, gan garākam pārgājienam dabas mīļotājiem, putnu vērotājiem un fotogrāfiem. Taka piedāvā vairākus atpūtas punktus, skatu torņus un informācijas stendus, kas iepazīstina ar vietējo floru un faunu.\r\n\r\nTakas kopējais garums pārsniedz 20 kilometrus, un tā ir sadalīta vairākos posmos, kas piemēroti dažādiem fiziskās sagatavotības līmeņiem. Gar maršrutu izvietoti dabas vērojumu punkti, soliņi, ugunskura vietas un telšu laukumi, kas ļauj pavadīt dienu vai pat visu nedēļas nogali dabas tuvumā.\r\n\r\nĪpašas iezīmes:\r\n\r\nPanorāmas skats no skatu torņa uz apkārtējiem mežiem un ezeriem\r\n\r\nKoka laipas pāri purviem un mitrājiem\r\n\r\nIespēja novērot retus putnus un dzīvniekus\r\n\r\nInformatīvi stendi ar vietējās ekosistēmas aprakstiem\r\n\r\nĢimenēm draudzīgi posmi un bērnu piedzīvojumu laukumi\r\n\r\nIeteikumi apmeklētājiem:\r\nŅem līdzi dzeramo ūdeni, ērtus apavus un fotoaparātu — Super Lielā Dabas Taka ir vieta, kur daba atklājas visā savā varenībā. Labākais laiks apmeklējumam ir pavasarī un rudenī, kad daba ir īpaši koša un dzīvīga.','Super liela dabas taka','uploads/690640772895e.jpg'),(11,'Kaspars',8,'Aktivitāte','1',1.00,1,'2025-11-05 17:54:51','1 nedēļas treniņu ceļvedis\r\nPirmdiena – Augšējā ķermeņa spēks\r\n\r\nSiltums: 5 min viegla skriešana vai lecamaukla\r\n\r\n3x10 stieņa spiešana guļus\r\n\r\n3x12 hanteles bicepsu cēlieni\r\n\r\n3x15 plecu pacelšana ar hantelēm\r\n\r\n3x12 tricepsa atspiedieni pie sola\r\n\r\nNoslēgums: 5 min stiepšanās\r\n\r\nOtrdiena – Kardiotreniņš\r\n\r\n20 min skriešana vai velo\r\n\r\n10 min intervāli: 30 s sprint + 30 s lēna staigāšana\r\n\r\n5 min vēdera muskuļu vingrinājumi (planks 3x30 s, kāju pacelšana 3x12)\r\n\r\nTrešdiena – Kājas & apakšējā ķermeņa spēks\r\n\r\nSiltums: 5–10 min lecamaukla\r\n\r\n3x12 pietupieni ar svaru\r\n\r\n3x10 izklupieni ar hantelēm\r\n\r\n3x15 teļu pacelšana stāvus\r\n\r\n3x12 glute bridges\r\n\r\nNoslēgums: stiepšanās 5–10 min\r\n\r\nCeturtdiena – Atpūta / viegla mobilitāte\r\n\r\n20–30 min pastaiga vai joga\r\n\r\nVieglas stiepšanās\r\n\r\nFokusēties uz elpošanu un locītavu mobilitāti\r\n\r\nPiektdiena – Pilna ķermeņa HIIT\r\n\r\n5 min siltums: skriešana vai jumping jacks\r\n\r\n30 s katrs, 3 apļi:\r\n\r\nBurpees\r\n\r\nSquat jumps\r\n\r\nPush-ups\r\n\r\nMountain climbers\r\n\r\nPlank\r\n\r\n5–10 min noslēgums: stiepšanās\r\n\r\nSestdiena – Core un stabilitāte\r\n\r\nPlanks 3x45 s\r\n\r\nSide plank 3x30 s katrai pusei\r\n\r\nRussian twists 3x20\r\n\r\nV-up 3x15\r\n\r\nSuperman 3x12\r\n\r\nSvētdiena – Brīva izvēle / aktīva atpūta\r\n\r\nPastaiga, velobraukšana, peldēšana vai jebkura cita viegla aktivitāte','Trenēšanās ceļvedis','uploads/690b8f6ba1184.jpg'),(12,'Kaspars',7,'Video','3',1.00,1,'2025-11-05 18:10:42','Rouza, kuru piespiež precēties ar bagātu vīrieti, iemīlas Džekā, talantīgā māksliniekā, uz nenogremdējamā Titānika klāja.','Filma \"Titāniks\" 1997','uploads/690b9322cd053.jpg'),(14,'Kaspars',9,'Spēles','40',30.00,1,'2025-11-05 18:18:51','Grand Theft Auto V ir 2013. gada piedzīvojumu spēle, ko izstrādāja Rockstar North un publicēja Rockstar Games. Tā ir septītā galvenā spēle Grand Theft Auto sērijā pēc 2008. gada Grand Theft Auto IV un kopumā piecpadsmitā daļa.','Spēle \"GTA V\" 2013','uploads/690b950bc95c7.jpg'),(15,'Kaspars',7,'Spēles','1',18.00,1,'2025-11-19 22:15:56','Sandbox spele ar daudz iespējam','Spēle \"Minecraft\"','uploads/691e419c8acb0.jpg'),(16,'Kaspars',8,'Produkti','0',500.00,0,'2025-11-24 17:16:39','Iepazīstinām ar Xiaomi Robot Vacuum X20+, pavisam jaunu universālu robotizētu putekļsūcēju, kas pārsniedz cerības. Ar savu jaudīgo bāzes staciju, spēcīgo putekļsūcēja un grīdas mazgāšanu, veiklo šķēršļu apiešanu un inteliģento mijiedarbību tas var bez piepūles apmierināt visas jūsu grīdas tīrīšanas vajadzības. Ir pienācis laiks baudīt dzīvi bez raizēm. https://www.euronics.lv/en/housekeeping/vacuum-cleaners/robotic-vacuum-cleaners/bhr8124eu/xiaomi-x20-wet-dry-white-robot-vacuum-cleaner','Automatiskais putekļu sūcējs \"','uploads/692492f78cc6a.png');
/*!40000 ALTER TABLE `recommendations` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-24 21:25:42
