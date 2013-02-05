-- MySQL dump 10.13  Distrib 5.5.16, for Linux (i686)
--
-- Host: localhost    Database: cbdb
-- ------------------------------------------------------
-- Server version	5.5.16

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
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_assignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_assignment`
--

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` VALUES ('admin',1,NULL,'N;'),('Authority',1,'','s:0:\"\";'),('borrower',52,NULL,'N;'),('viewer',53,NULL,'N;'),('wishlistAccess',54,'','s:0:\"\";');
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` VALUES ('admin',2,'',NULL,'N;'),('AuditTrailIndex',0,'','','s:0:\"\";'),('Authority',2,'srbac role','','s:0:\"\";'),('BookAdmin',0,'admin access to books',NULL,'N;'),('BookCreate',0,'create a book',NULL,'N;'),('BookCreateAuthor',0,'create an author for a book',NULL,'N;'),('BookDelete',0,'delete a book',NULL,'N;'),('BookIndex',0,'index of books',NULL,'N;'),('BookRemoveAuthor',0,'remove an author from a book',NULL,'N;'),('BookUpdate',0,'update a book',NULL,'N;'),('BookView',0,'read a book',NULL,'N;'),('borrower',2,'',NULL,'N;'),('JobAdmin',0,NULL,NULL,'N;'),('JobCreate',0,NULL,NULL,'N;'),('JobDelete',0,NULL,NULL,'N;'),('JobIndex',0,'','','s:0:\"\";'),('JobList',0,NULL,NULL,'N;'),('jobsAndReports',1,'','','s:0:\"\";'),('JobUpdate',0,NULL,NULL,'N;'),('JobView',0,NULL,NULL,'N;'),('LibraryIndex',0,'index of library',NULL,'N;'),('LibraryLend',0,'lend item from library, and remove request',NULL,'N;'),('LibraryRequest',0,'request item from library',NULL,'N;'),('manageAuditTrail',1,'','','s:0:\"\";'),('manageBook',1,'manage book entries',NULL,'N;'),('managePublisher',1,'manage publisher entries',NULL,'N;'),('manageUser',1,'manage user entries',NULL,'N;'),('manageWish',1,'manage wish entries',NULL,'N;'),('PublisherAdmin',0,'admin access to publishers',NULL,'N;'),('PublisherCreate',0,'create a publisher',NULL,'N;'),('PublisherDelete',0,'delete a publisher',NULL,'N;'),('PublisherIndex',0,'index of publishers',NULL,'N;'),('PublisherUpdate',0,'update a publisher',NULL,'N;'),('PublisherView',0,'read a publisher',NULL,'N;'),('ReportIndex',0,'','','s:0:\"\";'),('ScheduledJobAdmin',0,NULL,NULL,'N;'),('ScheduledJobCreate',0,NULL,NULL,'N;'),('ScheduledJobDelete',0,NULL,NULL,'N;'),('ScheduledJobIndex',0,NULL,NULL,'N;'),('ScheduledJobUpdate',0,NULL,NULL,'N;'),('ScheduledJobView',0,NULL,NULL,'N;'),('UpdateOwnUser',1,'update own user entry','return (Yii::app()->user->id==Yii::app()->getRequest()->getQuery(\'id\') || Yii::app()->user->id == $params[\'id\']);','s:0:\"\";'),('UserAclist',0,'autocomplete list for user',NULL,'N;'),('UserAssignRole',0,'for user form','','s:0:\"\";'),('UserCreate',0,'create a user',NULL,'N;'),('UserDelete',0,'delete a user',NULL,'N;'),('UserIndex',0,'index of users',NULL,'N;'),('UserReloadRoles',0,'user form, reload list of roles not assigned to selected user','','s:0:\"\";'),('UserRevokeRole',0,'for user form, revoke a role from a user','','s:0:\"\";'),('UserUpdate',0,'update a user',NULL,'N;'),('UserView',0,'read a user',NULL,'N;'),('viewer',2,'',NULL,'N;'),('WishAdmin',0,'admin access to wishes',NULL,'N;'),('WishClaim',0,'claim a wish',NULL,'N;'),('WishCreate',0,'create a wish',NULL,'N;'),('WishCreateAuthor',0,'create an author for a wish',NULL,'N;'),('WishDelete',0,'delete a wish',NULL,'N;'),('WishIndex',0,'index of wishes',NULL,'N;'),('wishlistAccess',2,'',NULL,'N;'),('WishRemoveAuthor',0,'remove an author from a wish',NULL,'N;'),('WishUpdate',0,'update a wish',NULL,'N;'),('WishView',0,'read a wish',NULL,'N;');
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item_child`
--

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` VALUES ('manageAuditTrail','AuditTrailIndex'),('manageBook','BookAdmin'),('manageBook','BookCreate'),('manageBook','BookCreateAuthor'),('manageBook','BookDelete'),('viewer','BookIndex'),('manageBook','BookRemoveAuthor'),('manageBook','BookUpdate'),('viewer','BookView'),('admin','borrower'),('jobsAndReports','JobAdmin'),('jobsAndReports','JobCreate'),('jobsAndReports','JobDelete'),('jobsAndReports','JobIndex'),('jobsAndReports','JobList'),('admin','jobsAndReports'),('jobsAndReports','JobUpdate'),('jobsAndReports','JobView'),('borrower','LibraryIndex'),('admin','LibraryLend'),('borrower','LibraryRequest'),('admin','manageAuditTrail'),('admin','manageBook'),('admin','managePublisher'),('admin','manageUser'),('admin','manageWish'),('managePublisher','PublisherAdmin'),('managePublisher','PublisherCreate'),('managePublisher','PublisherDelete'),('managePublisher','PublisherIndex'),('managePublisher','PublisherUpdate'),('managePublisher','PublisherView'),('jobsAndReports','ReportIndex'),('jobsAndReports','ScheduledJobAdmin'),('jobsAndReports','ScheduledJobCreate'),('jobsAndReports','ScheduledJobDelete'),('jobsAndReports','ScheduledJobIndex'),('jobsAndReports','ScheduledJobUpdate'),('jobsAndReports','ScheduledJobView'),('wishlistAccess','UpdateOwnUser'),('manageUser','UserAclist'),('manageUser','UserAssignRole'),('manageUser','UserCreate'),('manageUser','UserDelete'),('manageUser','UserIndex'),('manageUser','UserReloadRoles'),('manageUser','UserRevokeRole'),('manageUser','UserUpdate'),('UpdateOwnUser','UserUpdate'),('manageUser','UserView'),('borrower','viewer'),('manageWish','WishAdmin'),('wishlistAccess','WishClaim'),('manageWish','WishCreate'),('manageWish','WishCreateAuthor'),('manageWish','WishDelete'),('wishlistAccess','WishIndex'),('viewer','wishlistAccess'),('manageWish','WishRemoveAuthor'),('manageWish','WishUpdate'),('wishlistAccess','WishView');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `publisher_id` int(10) unsigned DEFAULT NULL,
  `issue_number` varchar(10) DEFAULT NULL,
  `borrower_id` int(10) unsigned DEFAULT NULL,
  `lendable` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`),
  KEY `grade_id` (`grade_id`),
  KEY `borrower_id` (`borrower_id`),
  KEY `publisher_id` (`publisher_id`),
  CONSTRAINT `book_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`),
  CONSTRAINT `book_ibfk_2` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`),
  CONSTRAINT `book_ibfk_3` FOREIGN KEY (`borrower_id`) REFERENCES `user` (`id`),
  CONSTRAINT `book_ibfk_4` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book`
--

LOCK TABLES `book` WRITE;
/*!40000 ALTER TABLE `book` DISABLE KEYS */;
INSERT INTO `book` VALUES (1,'Batman',2,'2012-05-08',50.00,3.00,'',0,1,1,NULL,'',1,1),(2,'The Amazing Spider Man',1,'2012-02-13',10.00,3.00,'This book is awesome. ',1,1,1,NULL,'',52,1),(3,'X-Men',3,'0000-00-00',5.00,1.00,'Awesome',1,6,0,NULL,'',53,1),(4,'Sandman',1,'2012-05-17',8.00,3.00,'',0,2,0,NULL,'',NULL,0),(5,'Green Lantern',3,'2012-05-01',3.00,3.00,'',0,1,0,1,NULL,NULL,1),(6,'Witchblade',3,'2000-03-01',15.00,2.00,'',0,1,1,1,NULL,NULL,1),(7,'300',2,'2002-10-01',15.00,3.00,'',0,6,0,NULL,NULL,NULL,1),(8,'Wolverine',3,'1982-05-01',67.00,1.00,'',1,1,1,NULL,NULL,NULL,1),(9,'Stardust',1,'0000-00-00',0.00,0.00,'',0,1,0,1,NULL,1,1),(12,'Hellboy',1,'2012-05-24',10000.00,10000.00,'best evarh',1,1,1,1,'3',52,1),(13,'Hellboy',1,'2012-05-01',10000.00,10000.00,'super',1,1,1,1,'4',NULL,1),(14,'Test Book',1,'2012-06-15',3.00,7.00,'so great',0,1,0,NULL,'3',NULL,1),(15,'Test Book',1,'0000-00-00',1.00,5.00,'testing borrower on create',1,1,0,NULL,'3',53,1);
/*!40000 ALTER TABLE `book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookauthor`
--

DROP TABLE IF EXISTS `bookauthor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookauthor` (
  `book_id` int(10) unsigned NOT NULL,
  `author_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`book_id`,`author_id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `bookauthor_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE,
  CONSTRAINT `bookauthor_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `person` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookauthor`
--

LOCK TABLES `bookauthor` WRITE;
/*!40000 ALTER TABLE `bookauthor` DISABLE KEYS */;
INSERT INTO `bookauthor` VALUES (10,1),(12,5),(13,6),(12,31),(1,216),(15,239),(1,243);
/*!40000 ALTER TABLE `bookauthor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookillustrator`
--

DROP TABLE IF EXISTS `bookillustrator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookillustrator` (
  `book_id` int(10) unsigned NOT NULL,
  `illustrator_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`book_id`,`illustrator_id`),
  KEY `illustrator_id` (`illustrator_id`),
  CONSTRAINT `bookillustrator_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE,
  CONSTRAINT `bookillustrator_ibfk_2` FOREIGN KEY (`illustrator_id`) REFERENCES `person` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookillustrator`
--

LOCK TABLES `bookillustrator` WRITE;
/*!40000 ALTER TABLE `bookillustrator` DISABLE KEYS */;
INSERT INTO `bookillustrator` VALUES (10,2),(10,3);
/*!40000 ALTER TABLE `bookillustrator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookpublisher`
--

DROP TABLE IF EXISTS `bookpublisher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookpublisher` (
  `book_id` int(10) unsigned NOT NULL,
  `publisher_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`book_id`,`publisher_id`),
  KEY `publisher_id` (`publisher_id`),
  CONSTRAINT `bookpublisher_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE,
  CONSTRAINT `bookpublisher_ibfk_2` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookpublisher`
--

LOCK TABLES `bookpublisher` WRITE;
/*!40000 ALTER TABLE `bookpublisher` DISABLE KEYS */;
INSERT INTO `bookpublisher` VALUES (6,1),(10,1);
/*!40000 ALTER TABLE `bookpublisher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booktag`
--

DROP TABLE IF EXISTS `booktag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booktag` (
  `book_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`book_id`,`tag_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `booktag_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE,
  CONSTRAINT `booktag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booktag`
--

LOCK TABLES `booktag` WRITE;
/*!40000 ALTER TABLE `booktag` DISABLE KEYS */;
/*!40000 ALTER TABLE `booktag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grade`
--

DROP TABLE IF EXISTS `grade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grade` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grade`
--

LOCK TABLES `grade` WRITE;
/*!40000 ALTER TABLE `grade` DISABLE KEYS */;
INSERT INTO `grade` VALUES (1,'mint'),(2,'near mint'),(3,'very fine'),(4,'fine'),(5,'very good'),(6,'good'),(7,'fair'),(8,'poor');
/*!40000 ALTER TABLE `grade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job`
--

DROP TABLE IF EXISTS `job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `action` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job`
--

LOCK TABLES `job` WRITE;
/*!40000 ALTER TABLE `job` DISABLE KEYS */;
INSERT INTO `job` VALUES (1,'Send Bday Wishlist Email','SendWishlist'),(2,'Generate a Report','RunReport'),(3,'Send Game Winning Certificate','SendCert');
/*!40000 ALTER TABLE `job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `person` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(64) NOT NULL,
  `lname` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=244 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person`
--

LOCK TABLES `person` WRITE;
/*!40000 ALTER TABLE `person` DISABLE KEYS */;
INSERT INTO `person` VALUES (1,'Comic','Fan'),(2,'Illus','Trato'),(3,'Manga','Maniac'),(5,'Mike','Comic'),(6,'Comic','Writer'),(31,'Lauren','Person'),(216,'Bob','Miller'),(226,'Joe','Jones'),(227,'John','Smith'),(237,'Best','Friend'),(238,'Another','Friend'),(239,'Lauren','OMeara'),(240,'Test','WishGiver'),(241,'Test','Create'),(242,'Test','Create'),(243,'Test','Author2');
/*!40000 ALTER TABLE `person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publisher`
--

DROP TABLE IF EXISTS `publisher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publisher` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publisher`
--

LOCK TABLES `publisher` WRITE;
/*!40000 ALTER TABLE `publisher` DISABLE KEYS */;
INSERT INTO `publisher` VALUES (1,'Pub Co');
/*!40000 ALTER TABLE `publisher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request`
--

DROP TABLE IF EXISTS `request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request` (
  `book_id` int(10) unsigned NOT NULL,
  `requester_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`book_id`,`requester_id`),
  KEY `requester_id` (`requester_id`),
  KEY `book_id` (`book_id`),
  CONSTRAINT `request_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`),
  CONSTRAINT `request_ibfk_2` FOREIGN KEY (`requester_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request`
--

LOCK TABLES `request` WRITE;
/*!40000 ALTER TABLE `request` DISABLE KEYS */;
INSERT INTO `request` VALUES (2,1),(3,1),(7,1),(9,52),(12,52),(9,53),(12,53);
/*!40000 ALTER TABLE `request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scheduled_job`
--

DROP TABLE IF EXISTS `scheduled_job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scheduled_job` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `params` text,
  `output` text,
  `job_id` int(10) unsigned NOT NULL,
  `scheduled_time` datetime DEFAULT NULL,
  `started` datetime DEFAULT NULL,
  `completed` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `job_id` (`job_id`),
  CONSTRAINT `scheduled_job_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `job` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scheduled_job`
--

LOCK TABLES `scheduled_job` WRITE;
/*!40000 ALTER TABLE `scheduled_job` DISABLE KEYS */;
INSERT INTO `scheduled_job` VALUES (1,'',NULL,1,'2012-08-12 21:52:47','2012-08-14 23:15:20','2012-08-14 23:15:20',1),(2,'','{\"data\":[{\"label\":\"bars\",\"data\":[[1,12],[2,16],[3,89],[4,44],[5,38]],\"bars\":{\"show\":true}}],\"options\":{\"legend\":{\"position\":\"nw\",\"show\":true,\"margin\":10,\"backgroundOpacity\":0.5}},\"htmlOptions\":{\"style\":\"width:400px;height:400px;\"}}',2,'2012-08-14 23:10:13','2012-08-18 10:08:38','2012-08-18 10:08:38',1),(3,'',NULL,3,'2012-08-12 07:00:00',NULL,NULL,0);
/*!40000 ALTER TABLE `scheduled_job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_audit_trail`
--

DROP TABLE IF EXISTS `tbl_audit_trail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_audit_trail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `old_value` text,
  `new_value` text,
  `action` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `field` varchar(255) NOT NULL,
  `stamp` datetime NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `model_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_audit_trail_user_id` (`user_id`),
  KEY `idx_audit_trail_model_id` (`model_id`),
  KEY `idx_audit_trail_model` (`model`),
  KEY `idx_audit_trail_field` (`field`),
  KEY `idx_audit_trail_action` (`action`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_audit_trail`
--

LOCK TABLES `tbl_audit_trail` WRITE;
/*!40000 ALTER TABLE `tbl_audit_trail` DISABLE KEYS */;
INSERT INTO `tbl_audit_trail` VALUES (1,'tcreate','tcreater','CHANGE','User','username','2012-07-09 07:46:28','1','55');
/*!40000 ALTER TABLE `tbl_audit_trail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_migration`
--

DROP TABLE IF EXISTS `tbl_migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_migration`
--

LOCK TABLES `tbl_migration` WRITE;
/*!40000 ALTER TABLE `tbl_migration` DISABLE KEYS */;
INSERT INTO `tbl_migration` VALUES ('m000000_000000_base',1341812680),('m110517_155003_create_tables_audit_trail',1341812682);
/*!40000 ALTER TABLE `tbl_migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type`
--

LOCK TABLES `type` WRITE;
/*!40000 ALTER TABLE `type` DISABLE KEYS */;
INSERT INTO `type` VALUES (1,'trade'),(2,'graphic novel'),(3,'issue');
/*!40000 ALTER TABLE `type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `pwd_hash` varchar(64) NOT NULL,
  `person_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `userperson_ibfk_2` (`person_id`),
  CONSTRAINT `userperson_ibfk_2` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','$1$3hLcBLJq$nly6jlBLe5UB8iAKm46is.',1),(52,'borrower','$1$3hLcBLJq$nly6jlBLe5UB8iAKm46is.',237),(53,'afriend','$1$3hLcBLJq$nly6jlBLe5UB8iAKm46is.',238),(54,'twg','$1$BNAa/N1B$8eDkrq0A194jFBFb9nsxx1',240),(55,'tcreate','$1$c.bhpJgL$DtsYsC9PxOmVeGqq6MGaS1',242);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wish`
--

DROP TABLE IF EXISTS `wish`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wish` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `issue_number` varchar(10) DEFAULT NULL,
  `type_id` int(10) unsigned DEFAULT NULL,
  `publication_date` date DEFAULT NULL,
  `publisher_id` int(10) unsigned DEFAULT NULL,
  `store_link` varchar(255) DEFAULT NULL,
  `notes` text,
  `got_it` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`),
  KEY `publisher_id` (`publisher_id`),
  KEY `got_it` (`got_it`),
  CONSTRAINT `wish_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`),
  CONSTRAINT `wish_ibfk_2` FOREIGN KEY (`publisher_id`) REFERENCES `type` (`id`),
  CONSTRAINT `wish_ibfk_3` FOREIGN KEY (`got_it`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wish`
--

LOCK TABLES `wish` WRITE;
/*!40000 ALTER TABLE `wish` DISABLE KEYS */;
INSERT INTO `wish` VALUES (1,'Moebius\' Airtight Garage Vol.1','1',1,'0000-00-00',NULL,'http://www.amazon.com/Moebius-Airtight-Garage-Vol-1-No/dp/B00178YGFE/ref=sr_1_3?s=books&ie=UTF8&qid=1339476850&sr=1-3','',NULL),(2,'The Squiddy Avenger','1',1,'2012-06-21',NULL,'www.amazon.com','',NULL),(3,'another great title','',1,'2012-06-21',NULL,'','',52);
/*!40000 ALTER TABLE `wish` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishauthor`
--

DROP TABLE IF EXISTS `wishauthor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wishauthor` (
  `wish_id` int(10) unsigned NOT NULL,
  `author_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`wish_id`,`author_id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `wishauthor_ibfk_1` FOREIGN KEY (`wish_id`) REFERENCES `wish` (`id`),
  CONSTRAINT `wishauthor_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `person` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishauthor`
--

LOCK TABLES `wishauthor` WRITE;
/*!40000 ALTER TABLE `wishauthor` DISABLE KEYS */;
INSERT INTO `wishauthor` VALUES (2,226),(1,227);
/*!40000 ALTER TABLE `wishauthor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishillustrator`
--

DROP TABLE IF EXISTS `wishillustrator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wishillustrator` (
  `wish_id` int(10) unsigned NOT NULL,
  `illustrator_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`wish_id`,`illustrator_id`),
  KEY `illustrator_id` (`illustrator_id`),
  CONSTRAINT `wishillustrator_ibfk_1` FOREIGN KEY (`wish_id`) REFERENCES `wish` (`id`),
  CONSTRAINT `wishillustrator_ibfk_2` FOREIGN KEY (`illustrator_id`) REFERENCES `person` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishillustrator`
--

LOCK TABLES `wishillustrator` WRITE;
/*!40000 ALTER TABLE `wishillustrator` DISABLE KEYS */;
/*!40000 ALTER TABLE `wishillustrator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishpublisher`
--

DROP TABLE IF EXISTS `wishpublisher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wishpublisher` (
  `wish_id` int(10) unsigned NOT NULL,
  `publisher_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`wish_id`,`publisher_id`),
  KEY `publisher_id` (`publisher_id`),
  CONSTRAINT `wishpublisher_ibfk_1` FOREIGN KEY (`wish_id`) REFERENCES `wish` (`id`),
  CONSTRAINT `wishpublisher_ibfk_2` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishpublisher`
--

LOCK TABLES `wishpublisher` WRITE;
/*!40000 ALTER TABLE `wishpublisher` DISABLE KEYS */;
/*!40000 ALTER TABLE `wishpublisher` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-08-18 10:32:06
