DROP TABLE IF EXISTS `job`;
CREATE TABLE `job` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `action` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB; 

LOCK TABLES `job` WRITE;
/*!40000 ALTER TABLE `job` DISABLE KEYS */;
INSERT INTO `job` VALUES (1,'Send Bday Wishlist Email', 'SendWishlist'),(2,'Generate a Report', 'RunReport'),(3,'Send Game Winning Certificate', 'SendCert');
UNLOCK TABLES;
