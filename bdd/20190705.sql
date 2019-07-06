-- MySQL dump 10.16  Distrib 10.2.23-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: games
-- ------------------------------------------------------
-- Server version	10.2.23-MariaDB-1:10.2.23+maria~bionic

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
-- Table structure for table `deb_adminpage`
--

DROP TABLE IF EXISTS `deb_adminpage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deb_adminpage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deb_adminpage`
--

LOCK TABLES `deb_adminpage` WRITE;
/*!40000 ALTER TABLE `deb_adminpage` DISABLE KEYS */;
INSERT INTO `deb_adminpage` VALUES (1,'utilisateurs','user'),(2,'pages','page'),(3,'posts','post'),(4,'preferences','preferences');
/*!40000 ALTER TABLE `deb_adminpage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deb_pages`
--

DROP TABLE IF EXISTS `deb_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deb_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `alias` varchar(256) NOT NULL,
  `content` longtext NOT NULL,
  `published` tinyint(1) NOT NULL,
  `category` int(11) NOT NULL,
  `date_creation` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deb_pages`
--

LOCK TABLES `deb_pages` WRITE;
/*!40000 ALTER TABLE `deb_pages` DISABLE KEYS */;
INSERT INTO `deb_pages` VALUES (1,'mentions légales','mentions','<p>Lorem ipsum</p>',1,2,'2018-09-24 15:03:00','2018-09-24 15:03:00'),(2,'test','aliastest','<h3>Veni vidi vici</h3>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tristique eros lobortis, commodo ex mattis, maximus velit. Nulla aliquet sodales varius. Vestibulum tempus neque vel viverra pretium. Duis consectetur nunc nec felis vulputate semper at a mi. Vestibulum auctor sodales nisi, at viverra orci lacinia eu. Sed pellentesque ultricies metus, tincidunt congue nunc posuere quis. Vestibulum risus mauris, efficitur eu lectus in, semper porttitor turpis. Ut ultricies aliquet nunc eget luctus. In eleifend pellentesque turpis a placerat. Quisque sagittis eros arcu, at luctus lacus egestas nec. Ut consectetur sed magna vel sollicitudin.\r\n</p><p>\r\nInterdum et malesuada fames ac ante ipsum primis in faucibus. Morbi ut justo nisl. Pellentesque non imperdiet massa. Nullam volutpat euismod felis, quis cursus ex luctus a. Integer cursus leo sit amet urna pellentesque, eu blandit sapien dapibus. Duis ac congue augue. Nunc vitae mattis risus. Duis quis massa lorem. Nulla sed mattis elit. Nulla tincidunt, neque ut blandit consequat, nisl odio eleifend ante, non aliquet magna magna non magna.\r\n</p><p>\r\nProin est dui, consequat a lorem suscipit, auctor euismod lorem. Fusce augue nisl, luctus porttitor malesuada in, bibendum sit amet enim. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus eu congue arcu, in aliquet tellus. Quisque nibh ex, egestas vel vestibulum vitae, bibendum vitae nunc. Ut faucibus tincidunt risus, sit amet euismod ipsum pharetra eu. Nam porttitor consequat est. Praesent aliquet volutpat sapien sed interdum.\r\n</p><p>\r\nInterdum et malesuada fames ac ante ipsum primis in faucibus. Sed viverra venenatis leo non pharetra. Maecenas iaculis iaculis libero eget tristique. Curabitur mollis elementum placerat. Nam venenatis lacinia rhoncus. Curabitur fermentum eros sit amet lorem maximus auctor. Cras dignissim, nisl vitae auctor dictum, dolor lorem semper quam, ac congue enim sem ut purus. Vivamus vel velit libero. Donec placerat sed ante vel imperdiet. Praesent ut fringilla urna. Suspendisse finibus auctor imperdiet. Etiam pretium, turpis ultrices tincidunt lacinia, ex lacus mollis sem, eget facilisis nisi augue ac nibh.\r\n</p><p>\r\nProin suscipit dapibus pharetra. Fusce blandit accumsan ex at ornare. Phasellus quis facilisis dui, non commodo nisl. Nullam scelerisque et tellus et accumsan. Nulla facilisi. Quisque id commodo nisl, vel sagittis nisi. Duis nec libero nibh. Sed semper non ante vel porttitor. Pellentesque mi justo, aliquam id nibh a, lacinia vehicula nisl. Aenean dapibus, nulla vel dignissim eleifend, elit nibh mollis felis, ut bibendum nunc elit a enim. Suspendisse cursus venenatis ullamcorper. Quisque suscipit ut turpis vel pharetra.</p>',0,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,'a propos','a-propos','<p>Site et CMS r&eacute;alis&eacute; par Yashowa</p>',1,0,'2019-07-05 11:05:18','2019-07-05 11:05:18'),(4,'equipe','equipe','<p>Notre &eacute;quipe est compos&eacute;e de&nbsp; 1 membre</p>',1,0,'2019-07-05 11:10:02','2019-07-05 11:10:02'),(5,'notre equipe','notre-equipe','<p>Notre &eacute;quipe est compos&eacute;e de&nbsp; 1 membre</p>',1,0,'2019-07-05 11:14:40','2019-07-05 11:14:40'),(6,'page test','page-test','<p>qsdfghjkl:m&ugrave;mlkjhf;:!</p>',2,0,'2019-07-05 14:27:19','2019-07-05 14:27:19'),(7,'page test','page-test','<p>qsdfghjkl:m&ugrave;mlkjhf;:!</p>',2,0,'2019-07-05 14:27:56','2019-07-05 14:27:56'),(8,'sdf','sdfgh','<p>zerjukl</p>',1,0,'2019-07-05 14:30:01','2019-07-05 14:30:01'),(9,'df','hhdf','<p>ghj,k</p>',2,0,'2019-07-05 14:32:32','2019-07-05 14:32:32'),(10,'defrgthy','defrgthy','<p>ghjkl;:l</p>',2,0,'2019-07-05 14:39:46','2019-07-05 14:39:46'),(11,'defr','defrhh','<p>gyhjk;l</p>',2,0,'2019-07-05 14:56:58','2019-07-05 14:56:58'),(12,'sdfg','sdfg','<p>rgfthy</p>',2,0,'2019-07-05 15:00:03','2019-07-05 15:00:03');
/*!40000 ALTER TABLE `deb_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deb_users`
--

DROP TABLE IF EXISTS `deb_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deb_users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_profile` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passwd` varchar(60) NOT NULL,
  `last_connexion` date NOT NULL,
  `last_upddate` datetime NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deb_users`
--

LOCK TABLES `deb_users` WRITE;
/*!40000 ALTER TABLE `deb_users` DISABLE KEYS */;
INSERT INTO `deb_users` VALUES (1,1,'josue','nicolas','josue_nicolas@ymail.com','$2y$10$TID3fM8Io2BovHhuNInAyuLr6nTf3uYF4VM8RgpVGTBKj5xJvCE1O','2019-01-24','2019-01-24 00:00:00'),(65,2,'Jean','Benetti','benettijean@gmail.com','$2y$10$ppZKxwhn7aYo8FawA/KA5uWEgf7/tDvqa4TfeoRehvSpQX8AeyYRO','2019-06-27','2019-06-27 16:43:02'),(75,3,'josue','nicolas','josue_nicolas@outlook.fr','$2y$10$0eSNBrPRHjIWzFWQZjYzzu7dvgRtu.AEhK/DALiph8hhBzLYnM9zG','2019-07-01','2019-07-01 12:47:01'),(76,1,'Jean','Benetti','benettijean@gmail.com','$2y$10$1g8OrQ1nP/4BOv5kn23.0eOq2uvuKz/GuGXpvcS3k6mL7YenbDo8q','2019-07-01','2019-07-01 12:48:11'),(77,2,'laurine','bouillaud','josue_nicolas@ymail.com','$2y$10$lrQKS7.PoXgdJrEZPTyA4eopTJ9RAZVnO3nEixUEM/0JmbiMVbday','2019-07-01','2019-07-01 12:50:13'),(78,1,'josué','nicolas','contact@jnicolas.arts','$2y$10$KW9xUqmwkXCKwSe1/LfrsOJVdMiBTQSH8myEOK7E3TSbKubdvX7zG','2019-07-01','2019-07-01 12:51:00'),(79,3,'josue','nicolas','josue.nicolas@froid-chaud-service.com','$2y$10$HKW1YFxjmWDcAYhGJMP8b.aBETC2..mqFXSC/Gl8Yn.e8na2kGP9C','2019-07-01','2019-07-01 12:52:02'),(80,2,'josue','nicolas','josue_nicolas@ymail.com','$2y$10$Sxb6jXJTLRnrF77vPeBjt.fsvUrcuVEeP1FlhhV95Ml53vkjFuQkO','2019-07-01','2019-07-01 12:54:33'),(81,2,'josue','nicolas','josue_nicolas@outlook.fr','$2y$10$.fJURmxS9uWdvFEXXA7JVu3XVhtzY34OWkfh4yUhgCyktwwl2Aa.m','2019-07-01','2019-07-01 12:55:10'),(82,2,'josue','nicolas','josue_nicolas@outlook.fr','$2y$10$Tk244UtcuRf5OS/RQVwlqeVvlkwELk0MiJ1GcO8vjjCm/1yVv/xOS','2019-07-01','2019-07-01 12:55:49');
/*!40000 ALTER TABLE `deb_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-05 17:20:37
