-- MySQL dump 10.13  Distrib 8.0.44, for Win64 (x86_64)
--
-- Host: localhost    Database: blooms
-- ------------------------------------------------------
-- Server version	8.0.12

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `arrangement_flowers`
--

DROP TABLE IF EXISTS `arrangement_flowers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `arrangement_flowers` (
  `arrangement_id` int(11) NOT NULL,
  `flower_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`arrangement_id`,`flower_id`),
  KEY `fk_af_flower` (`flower_id`),
  CONSTRAINT `fk_af_arrangement` FOREIGN KEY (`arrangement_id`) REFERENCES `arrangements` (`arrangement_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_af_flower` FOREIGN KEY (`flower_id`) REFERENCES `flowers` (`flower_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arrangement_flowers`
--

LOCK TABLES `arrangement_flowers` WRITE;
/*!40000 ALTER TABLE `arrangement_flowers` DISABLE KEYS */;
/*!40000 ALTER TABLE `arrangement_flowers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `arrangement_occasions`
--

DROP TABLE IF EXISTS `arrangement_occasions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `arrangement_occasions` (
  `arrangement_id` int(11) NOT NULL,
  `occasion_id` int(11) NOT NULL,
  PRIMARY KEY (`arrangement_id`,`occasion_id`),
  KEY `fk_ao_occasion` (`occasion_id`),
  CONSTRAINT `fk_ao_arrangement` FOREIGN KEY (`arrangement_id`) REFERENCES `arrangements` (`arrangement_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_ao_occasion` FOREIGN KEY (`occasion_id`) REFERENCES `occasions` (`occasion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arrangement_occasions`
--

LOCK TABLES `arrangement_occasions` WRITE;
/*!40000 ALTER TABLE `arrangement_occasions` DISABLE KEYS */;
/*!40000 ALTER TABLE `arrangement_occasions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `arrangements`
--

DROP TABLE IF EXISTS `arrangements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `arrangements` (
  `arrangement_id` int(11) NOT NULL AUTO_INCREMENT,
  `arrangement_name` varchar(255) DEFAULT NULL,
  `description` text,
  `base_price` decimal(10,2) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT NULL,
  `is_custom` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`arrangement_id`),
  KEY `fk_arr_category` (`category_id`),
  CONSTRAINT `fk_arr_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arrangements`
--

LOCK TABLES `arrangements` WRITE;
/*!40000 ALTER TABLE `arrangements` DISABLE KEYS */;
INSERT INTO `arrangements` VALUES (1,'Classic Rose Elegance','Premium red roses arrangement',45.99,NULL,'https://i.pinimg.com/1200x/d2/8a/62/d28a62936363ac3f40f15cdbeff9045a.jpg',15,NULL),(2,'Spring Garden Mix','Vibrant seasonal flowers in a rustic basket',38.99,NULL,'https://i.pinimg.com/736x/a8/63/ac/a863ac5e0c1adb2c90be3f7e05493f2b.jpg',12,NULL),(3,'Luxury Peonies','Exquisite pink peonies with eucalyptus',65.99,NULL,'https://i.pinimg.com/736x/7a/53/aa/7a53aa225ddb4a0995610ad6785a9c71.jpg',6,NULL),(4,'Blossom Harmony','Colorful mixed flower arrangement',49.99,NULL,'https://i.pinimg.com/1200x/7b/19/47/7b1947b950adde1d31dded39628af2f1.jpg',10,NULL),(5,'White Serenity','Elegant white roses bouquet',42.50,NULL,'https://i.pinimg.com/736x/ae/27/42/ae27429867ba2fa156a95b8521f42037.jpg',20,NULL),(6,'Sunny Bouquet','Bright sunflowers with greenery',34.99,NULL,'https://i.pinimg.com/1200x/de/36/88/de3688c5aeec84964b0c770da5bdd555.jpg',18,NULL),(7,'Valentine Romance','Red roses with chocolates',59.99,NULL,'https://i.pinimg.com/1200x/e2/5f/1c/e25f1cf586d527102d87db97293d83d1.jpg',25,NULL),(8,'Lavender Dreams','Purple lavender bouquet',41.99,NULL,'https://i.pinimg.com/1200x/df/54/71/df5471df73a2410f6f0faa3f1e7101f1.jpg',13,NULL),(9,'Tropical Paradise','Exotic tropical flowers arrangement',55.99,NULL,'https://i.pinimg.com/1200x/0f/91/f8/0f91f8b8ad2e79cd5e111c800571be93.jpg',7,NULL),(10,'Baby Bliss','Soft pastel baby arrangement',47.99,NULL,'https://i.pinimg.com/1200x/6c/79/d3/6c79d3b9323063c98ef60cc477f20664.jpg',11,NULL),(11,'Graduation Glory','Bright celebration bouquet',52.99,NULL,'https://i.pinimg.com/736x/1c/0c/5c/1c0c5cffc2e053090cf4852c4e2c6992.jpg',16,NULL),(12,'Get Well Wishes','Cheerful healing flowers',39.99,NULL,'https://i.pinimg.com/1200x/a1/36/58/a1365836296a63bfc1810cd17f1f923f.jpg',22,NULL),(13,'Elegant Orchids','Luxury white orchids arrangement',72.99,NULL,'https://i.pinimg.com/1200x/e2/ec/24/e2ec24979b9d5565aeef9a6fcff63b67.jpg',5,NULL),(14,'Rustic Charm','Wildflower wedding bouquet',68.99,NULL,'https://i.pinimg.com/1200x/eb/be/64/ebbe640b1da3795e1133c91cbe5f5519.jpg',9,NULL),(15,'Pink Perfection','Beautiful pink roses bouquet',43.99,NULL,'https://i.pinimg.com/1200x/7f/1b/2c/7f1b2cbcc6506c49fbf400ee6aa959d8.jpg',17,NULL),(16,'Peaceful Memorial','White lilies memorial arrangement',56.99,NULL,'https://i.pinimg.com/1200x/71/7b/5d/717b5d330a748b9feeec13412a33a930.jpg',12,NULL),(17,'Autumn Harvest','Warm fall colors bouquet',44.99,NULL,'https://i.pinimg.com/1200x/3a/ab/86/3aab86b1fdaf97452871baa0a78e996c.jpg',19,NULL),(18,'Garden Delight','Mixed garden flowers arrangement',37.99,NULL,'https://i.pinimg.com/1200x/64/04/4b/64044b909d2c59c63c376ccd94edf772.jpg',21,NULL);
/*!40000 ALTER TABLE `arrangements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custom_order_flowers`
--

DROP TABLE IF EXISTS `custom_order_flowers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `custom_order_flowers` (
  `flower_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`flower_id`,`order_id`),
  KEY `fk_custom_order` (`order_id`),
  CONSTRAINT `fk_custom_flower` FOREIGN KEY (`flower_id`) REFERENCES `flowers` (`flower_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_custom_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custom_order_flowers`
--

LOCK TABLES `custom_order_flowers` WRITE;
/*!40000 ALTER TABLE `custom_order_flowers` DISABLE KEYS */;
INSERT INTO `custom_order_flowers` VALUES (1,21,1,3.50),(2,7,2,8.00),(3,6,1,2.80),(4,5,2,6.40),(5,6,3,16.50),(6,5,2,9.00);
/*!40000 ALTER TABLE `custom_order_flowers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'arab','hannoon','arab@gmail.com','05997300265','ABCDEFGH','anabta','tulkarm','059','2025-12-25'),(2,'rasha','zreaq','rasha25@gmail.com','0599727224','Reesho002','naqura','nablus','102','2025-12-04'),(3,'shahd','rajab','shahd@gmail.com',NULL,'Sheesho004',NULL,NULL,NULL,NULL),(4,'nadeen','dd','nad@nad.nad',NULL,'hiu949kkK',NULL,NULL,NULL,NULL),(5,'deedo',NULL,'deedo@gmail.com',NULL,'R12345678D',NULL,NULL,NULL,NULL),(7,'soso','momo','soso@soso.com',NULL,'So12345so',NULL,NULL,NULL,NULL),(8,'sanabel','ss','San12@san.com',NULL,'San123bola',NULL,NULL,NULL,NULL),(9,'misk','hanon','misk@gmail.com',NULL,'Mi98765sk',NULL,NULL,NULL,NULL),(10,'shosho','','shosho@gmail.com',NULL,'Sh12345sh',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flowers`
--

DROP TABLE IF EXISTS `flowers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `flowers` (
  `flower_id` int(11) NOT NULL AUTO_INCREMENT,
  `flower_name` varchar(255) DEFAULT NULL,
  `color` varchar(55) DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `availability_status` varchar(55) DEFAULT NULL,
  `image_url` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`flower_id`),
  KEY `fk_flower_supplier` (`supplier_id`),
  CONSTRAINT `fk_flower_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `supliers` (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flowers`
--

LOCK TABLES `flowers` WRITE;
/*!40000 ALTER TABLE `flowers` DISABLE KEYS */;
INSERT INTO `flowers` VALUES (1,'Red Rose','Red',3.50,150,NULL,'Available','https://i.pinimg.com/736x/87/af/07/87af0754e5bdb85c62044dae5c18c1f7.jpg'),(2,'White Lily','White',4.00,80,NULL,'Available','https://i.pinimg.com/736x/94/9f/fe/949ffe0064f8cb8ac35a79e1ece33b3a.jpg'),(3,'Pink Tulip','Pink',2.80,120,NULL,'Available','https://i.pinimg.com/736x/53/05/18/530518d503f7f6ac68ef204fdb760e07.jpg'),(4,'Sunflower','Yellow',3.20,95,NULL,'Available','https://i.pinimg.com/1200x/2c/ae/05/2cae05182397557119ba8d41ece9100a.jpg'),(5,'Purple Orchid','Purple',5.50,15,NULL,'Available','https://i.pinimg.com/1200x/5b/09/0d/5b090db78f273fa8d3c87f30203aa7a7.jpg'),(6,'Blue Hydrangea','Blue',4.50,60,NULL,'Available','https://i.pinimg.com/1200x/1b/ee/57/1bee575de6f5d8e902a531d02d03d6b9.jpg');
/*!40000 ALTER TABLE `flowers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `occasions`
--

DROP TABLE IF EXISTS `occasions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `occasions` (
  `occasion_id` int(11) NOT NULL AUTO_INCREMENT,
  `occasion_name` varchar(100) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`occasion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `occasions`
--

LOCK TABLES `occasions` WRITE;
/*!40000 ALTER TABLE `occasions` DISABLE KEYS */;
INSERT INTO `occasions` VALUES (1,'Birthday','Perfect flowers to celebrate birthdays'),(2,'Wedding','Elegant arrangements for weddings'),(3,'Anniversary','Romantic flowers for anniversaries'),(4,'Valentine','Red roses and romantic gifts'),(5,'Get Well','Bright flowers to cheer someone up'),(6,'Thank You','Appreciation flowers'),(7,'New Baby','Soft colors for new arrivals'),(8,'Sympathy','Peaceful arrangements for condolences'),(9,'Just Because','Beautiful flowers for any day');
/*!40000 ALTER TABLE `occasions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_arrangements`
--

DROP TABLE IF EXISTS `order_arrangements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_arrangements` (
  `order_id` int(11) NOT NULL,
  `arrangement_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`order_id`,`arrangement_id`),
  KEY `fk_oa_arrangement` (`arrangement_id`),
  CONSTRAINT `fk_oa_arrangement` FOREIGN KEY (`arrangement_id`) REFERENCES `arrangements` (`arrangement_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_oa_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_arrangements`
--

LOCK TABLES `order_arrangements` WRITE;
/*!40000 ALTER TABLE `order_arrangements` DISABLE KEYS */;
INSERT INTO `order_arrangements` VALUES (1,5,1,42.50),(2,2,1,38.99),(3,2,1,38.99),(4,2,1,38.99),(5,3,1,65.99),(6,3,1,65.99),(6,4,1,49.99),(6,5,2,42.50),(7,2,1,38.99),(7,8,2,41.99),(8,2,1,38.99),(8,8,2,41.99),(9,2,1,38.99),(10,2,1,38.99),(11,2,1,38.99),(12,2,1,38.99),(13,2,1,38.99),(14,2,1,38.99),(15,2,1,38.99),(16,6,2,34.99),(17,6,2,34.99),(18,6,2,34.99),(19,6,2,34.99),(20,6,2,34.99),(21,3,1,65.99),(22,3,1,65.99),(23,2,1,38.99),(24,6,1,34.99),(25,3,1,65.99),(26,5,1,42.50),(27,1,1,45.99),(28,6,2,34.99),(29,3,2,65.99),(30,4,1,49.99),(30,8,1,41.99),(31,3,1,65.99),(32,16,1,56.99),(33,3,1,65.99),(33,8,1,41.99);
/*!40000 ALTER TABLE `order_arrangements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `order_date` date DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `discount_amount` decimal(10,2) DEFAULT NULL,
  `final_amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(55) DEFAULT NULL,
  `payment_method` varchar(55) DEFAULT NULL,
  `payment_status` varchar(55) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `delivery_time` time DEFAULT NULL,
  `delivery_address` varchar(55) DEFAULT NULL,
  `special_instructions` text,
  `assigned_staff_id` int(11) DEFAULT NULL,
  `card_message` text,
  `delivery_fee` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `fk_order_customer` (`customer_id`),
  KEY `fk_order_staff` (`assigned_staff_id`),
  CONSTRAINT `fk_order_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_order_staff` FOREIGN KEY (`assigned_staff_id`) REFERENCES `staff` (`staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,7,'2025-12-07',52.50,NULL,NULL,'Canceled','Cash on Delivery',NULL,'2025-12-07','16:49:00','tulkarm','never put them in the dark',NULL,'happy birthday',10.00),(2,7,'2025-12-07',48.99,NULL,NULL,'Processing','Cash on Delivery',NULL,'2025-12-07','16:53:00','tulkarm','never put it in the dark',NULL,'happy birthday',10.00),(3,7,'2025-12-07',48.99,NULL,NULL,'Processing','Cash on Delivery',NULL,'2025-12-26','23:19:00','NABLUS','',NULL,'thanks',10.00),(4,7,'2025-12-07',48.99,NULL,NULL,'Processing','Cash on Delivery',NULL,'2025-12-31','07:36:00','tulkarm','',NULL,'merci',10.00),(5,7,'2025-12-08',75.99,NULL,NULL,'Processing','Cash on Delivery',NULL,'2025-12-31','14:30:00','nablus','',NULL,'',10.00),(6,8,'2025-12-08',210.98,NULL,NULL,'Canceled','Cash on Delivery',NULL,'2025-12-18','12:47:00','jenin','',NULL,'',10.00),(7,9,'2025-12-09',132.97,NULL,NULL,'Processing','Cash on Delivery',NULL,'2026-01-06','20:10:00','tulkarm','',NULL,'',10.00),(8,9,'2025-12-09',132.97,NULL,NULL,'Processing','Cash on Delivery',NULL,'2025-12-13','13:47:00','nablus','',NULL,'',10.00),(9,9,'2025-12-09',48.99,NULL,NULL,'Processing','Cash on Delivery',NULL,'2025-12-25','15:38:00','tulkarm','',NULL,'',10.00),(10,9,'2025-12-09',48.99,NULL,NULL,'Processing','Cash on Delivery',NULL,'2025-12-12','15:40:00','tul','',NULL,'',10.00),(11,9,'2025-12-09',48.99,NULL,NULL,'Processing','Cash on Delivery',NULL,'2025-12-12','15:40:00','tul','',NULL,'',10.00),(12,7,'2025-12-09',48.99,NULL,NULL,'Processing','Cash on Delivery',NULL,'2025-12-18','15:52:00','jenin','',NULL,'',10.00),(13,7,'2025-12-09',48.99,NULL,NULL,'Processing','Cash on Delivery',NULL,'2025-12-26','16:47:00','ggg','',NULL,'',10.00),(14,7,'2025-12-09',48.99,NULL,NULL,'Processing','Cash on Delivery',NULL,'2025-12-26','16:07:00','vv','',NULL,'',10.00),(15,7,'2025-12-09',48.99,NULL,NULL,'Processing','Cash on Delivery',NULL,'2025-12-26','16:07:00','vv','',NULL,'',10.00),(16,2,'2025-12-09',79.98,NULL,NULL,'Processing','Cash on Delivery',NULL,'2026-01-16','05:55:00','nablus','no ',NULL,'thanks',10.00),(17,2,'2025-12-09',79.98,NULL,NULL,'Processing','Cash on Delivery',NULL,'2026-01-16','05:55:00','nablus','no ',NULL,'thanks',10.00),(18,2,'2025-12-09',79.98,NULL,NULL,'Processing','Cash on Delivery',NULL,'2026-01-16','05:55:00','nablus','no ',NULL,'thanks',10.00),(19,2,'2025-12-09',79.98,NULL,NULL,'Processing','Cash on Delivery',NULL,'2025-12-31','18:04:00','aaa','ghh',NULL,'mbb',10.00),(20,2,'2025-12-09',79.98,NULL,NULL,'Processing','Cash on Delivery',NULL,'2025-12-31','18:04:00','aaa','ghh',NULL,'mbb',10.00),(21,2,'2025-12-09',75.99,NULL,NULL,'Processing','Cash on Delivery',NULL,'2025-12-31','12:04:00','nablus','no',NULL,'no',10.00),(22,2,'2025-12-09',75.99,NULL,NULL,'Processing','Cash on Delivery',NULL,'2025-12-26','19:17:00','jenin','',NULL,'',10.00),(23,2,'2025-12-10',48.99,NULL,NULL,'Processing','Cash on Delivery',NULL,'2025-12-18','15:51:00','nablus','',NULL,'',10.00),(24,2,'2025-12-11',44.99,NULL,NULL,'Processing','Cash on Delivery',NULL,'2025-12-31','12:12:00','jenin','',NULL,'',10.00),(25,2,'2025-12-11',75.99,NULL,NULL,'Canceled','Cash on Delivery',NULL,'2025-12-29','10:15:00','ram','',NULL,'',10.00),(26,2,'2025-12-11',52.50,NULL,NULL,'Canceled','Cash on Delivery',NULL,'2025-12-26','20:04:00','jenin','',NULL,'',10.00),(27,2,'2025-12-11',55.99,NULL,NULL,'Processing','Cash on Delivery',NULL,'2026-01-01','21:08:00','nablus','',NULL,'',10.00),(28,2,'2025-12-12',79.98,NULL,NULL,'Canceled','Cash on Delivery',NULL,'2025-12-25','15:28:00','tulkarm','',NULL,'',10.00),(29,2,'2025-12-12',141.98,NULL,NULL,'Processing','Cash on Delivery',NULL,'2025-12-24','19:25:00','tgrh','',NULL,'',10.00),(30,2,'2025-12-13',101.98,NULL,NULL,'Processing','Cash on Delivery',NULL,'2025-12-14','14:00:00','nablus','',NULL,'congratulations',10.00),(31,2,'2025-12-13',75.99,NULL,NULL,'Processing','Cash on Delivery',NULL,'2025-12-26','23:15:00','ااا','',NULL,'',10.00),(32,10,'2025-12-14',66.99,NULL,NULL,'Canceled','Cash on Delivery',NULL,'2025-12-25','11:16:00','tulkarm','',NULL,'',10.00),(33,10,'2025-12-14',117.98,NULL,NULL,'Processing','Cash on Delivery',NULL,'2025-12-25','19:03:00','tulkarm','',NULL,'thanks',10.00);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supliers`
--

DROP TABLE IF EXISTS `supliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `supliers` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supliers`
--

LOCK TABLES `supliers` WRITE;
/*!40000 ALTER TABLE `supliers` DISABLE KEYS */;
/*!40000 ALTER TABLE `supliers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-02-02 22:52:13
