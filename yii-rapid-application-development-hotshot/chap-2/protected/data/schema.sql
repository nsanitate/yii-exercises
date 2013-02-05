SET FOREIGN_KEY_CHECKS=0;

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE `book` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `type_id` int(10) unsigned DEFAULT NULL,
  `publication_date` date DEFAULT NULL,
  `value` decimal(10,2) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `notes` text,
  `signed` tinyint(1) DEFAULT NULL,
  `grade_id` int(10) unsigned DEFAULT NULL,
  `bagged` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`),
  KEY `grade_id` (`grade_id`),
  CONSTRAINT `book_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`),
  CONSTRAINT `book_ibfk_2` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

LOCK TABLES `book` WRITE;
INSERT INTO `book` VALUES (1,'Batman',2,'2012-05-08',50.00,3.00,'',0,1,1),(2,'The Amazing Spider Man',1,'2012-02-13',10.00,3.00,'This book is awesome. ',1,1,1),(3,'X-Men',3,'0000-00-00',5.00,1.00,'Awesome',1,6,0),(4,'Sandman',2,'2012-05-17',8.00,3.00,'',0,2,0),(5,'Green Lantern',3,'2012-05-01',3.00,3.00,'',0,1,0),(6,'Witchblade',3,'2000-03-01',15.00,2.00,'',0,1,1),(7,'300',2,'2002-10-01',15.00,3.00,'',0,6,0),(8,'Wolverine',3,'1982-05-01',67.00,1.00,'',1,1,1),(9,'Stardust',1,'0000-00-00',0.00,0.00,'',0,1,0),(10,'The Phantom Programmer',3,'2012-05-08',1.00,1.00,'',1,4,1);
UNLOCK TABLES;

--
-- Table structure for table `bookauthor`
--

DROP TABLE IF EXISTS `bookauthor`;
CREATE TABLE `bookauthor` (
  `book_id` int(10) unsigned NOT NULL,
  `author_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`book_id`,`author_id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `bookauthor_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE,
  CONSTRAINT `bookauthor_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `person` (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookauthor`
--

LOCK TABLES `bookauthor` WRITE;
INSERT INTO `bookauthor` VALUES (10,1);
UNLOCK TABLES;

--
-- Table structure for table `bookillustrator`
--

DROP TABLE IF EXISTS `bookillustrator`;
CREATE TABLE `bookillustrator` (
  `book_id` int(10) unsigned NOT NULL,
  `illustrator_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`book_id`,`illustrator_id`),
  KEY `illustrator_id` (`illustrator_id`),
  CONSTRAINT `bookillustrator_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE,
  CONSTRAINT `bookillustrator_ibfk_2` FOREIGN KEY (`illustrator_id`) REFERENCES `person` (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookillustrator`
--

LOCK TABLES `bookillustrator` WRITE;
INSERT INTO `bookillustrator` VALUES (10,2), (10,3);
UNLOCK TABLES;

--
-- Table structure for table `bookpublisher`
--

DROP TABLE IF EXISTS `bookpublisher`;
CREATE TABLE `bookpublisher` (
  `book_id` int(10) unsigned NOT NULL,
  `publisher_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`book_id`,`publisher_id`),
  KEY `publisher_id` (`publisher_id`),
  CONSTRAINT `bookpublisher_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE,
  CONSTRAINT `bookpublisher_ibfk_2` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookpublisher`
--

LOCK TABLES `bookpublisher` WRITE;
INSERT INTO `bookpublisher` VALUES (10,1);
UNLOCK TABLES;

--
-- Table structure for table `booktag`
--

DROP TABLE IF EXISTS `booktag`;
CREATE TABLE `booktag` (
  `book_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`book_id`,`tag_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `booktag_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE,
  CONSTRAINT `booktag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booktag`
--

LOCK TABLES `booktag` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `grade`
--

DROP TABLE IF EXISTS `grade`;
CREATE TABLE `grade` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade`
--

LOCK TABLES `grade` WRITE;
INSERT INTO `grade` VALUES (1,'mint'),(2,'near mint'),(3,'very fine'),(4,'fine'),(5,'very good'),(6,'good'),(7,'fair'),(8,'poor');
UNLOCK TABLES;

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
CREATE TABLE `person` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(64) NOT NULL,
  `lname` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person`
--

LOCK TABLES `person` WRITE;
INSERT INTO `person` VALUES (1,'Comic', 'Author'),(2,'Illus', 'Trator'),(3,'Manga', 'Maniac');
UNLOCK TABLES;

--
-- Table structure for table `publisher`
--

DROP TABLE IF EXISTS `publisher`;
CREATE TABLE `publisher` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publisher`
--

LOCK TABLES `publisher` WRITE;
INSERT INTO `publisher` VALUES (1, 'Pub Co');
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
UNLOCK TABLES;

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

LOCK TABLES `type` WRITE;
INSERT INTO `type` VALUES (1,'trade'),(2,'graphic novel'),(3,'issue');
UNLOCK TABLES;

SET FOREIGN_KEY_CHECKS=1;
