-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: bookstore
-- ------------------------------------------------------
-- Server version	5.7.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1,'Zoya','Danielle Steele'),(2,'Pride and Prejudice','Jane Austen'),(3,'The Picture of Dorian Grey','Oscar Wilde'),(4,'Frankenstein','Mary Shelley'),(5,'Les Miserables','Victor Hugo'),(6,'On the Origin of Species','Charles Darwin'),(7,'Sense and Sensibility','Jane Austen'),(8,'<tags> & stuff','Andy Nerd'),(9,'Earthly Joys','Philippa Gregory'),(10,'The Snow Angel','Lulu Taylor'),(11,'Sword and Scimitar','Simon Scarrow'),(12,'Afterlight','Alex Scarrow'),(13,'Belle','Lesley Pearse'),(14,'The Candle Man','Alex Scarrow'),(15,'The Painted Man','Peter V. Brett'),(16,'Songbird','Josephine Cox'),(17,'Princess','Jean Sasson'),(18,'The September Girls','Maureen Lee'),(19,'Rogue','Danielle Steel'),(20,'The Girl on the Train','Paula Hawkins');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (3,'John','Doe','john@yahoo.com','johndoe','$2y$10$fa2oIXdGZstCtDD.U9/TceEdcR452A9Grx7i6Ob0GmzJS/yRIl9Xe','\0'),(2,'Mary','Green','mary@hotmail.com','maryg','$2y$10$GZpMWeTzA0C4PKdhF.QW5eyuVNxuF9dK0kULMNRwTi5t7gxpNL3pK','\0'),(4,'Jane','Doe','jane@gmail.com','janedoe','$2y$10$D15Wes5SqwSXc/J7orfSU.mlRxGq2en9pLNaFToq/CDDqzq2B8aeC','\0'),(5,'nadine','micallef','nadine@micallef.com','nadine','$2y$10$gR8ZQ2vlRNmNoUDM7BRrnuQBJYkv5bDEVu.eFVELRSBuxiRZxMfZu','\0'),(6,'John','Doe','john@gmail.com','johndoe2','$2y$10$SqsRQAv2oYjtOa4..4e8J.Z.JsXAotqVv3d6ZEXovC4slkCPZZ/qS','\0'),(7,'alfred','micallef','alfred.micallef@gov.mt','micaa042','$2y$10$O7T/UOupvKitpK8HfQMxieCnkK5EW3FtYQpRyGpJ4WERWh/cRfI6u','\0');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `membersId` int(11) NOT NULL,
  `booksId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `membersId` (`membersId`),
  KEY `booksId` (`booksId`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlist`
--

LOCK TABLES `wishlist` WRITE;
/*!40000 ALTER TABLE `wishlist` DISABLE KEYS */;
INSERT INTO `wishlist` VALUES (1,2,6),(2,2,12),(3,3,13),(4,5,13),(5,2,17),(6,5,1),(7,5,16),(8,7,16),(9,5,10),(10,5,7);
/*!40000 ALTER TABLE `wishlist` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-13  0:18:02
