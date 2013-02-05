DROP TABLE IF EXISTS `scheduled_job`;
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
) ENGINE=InnoDB;

LOCK TABLES `scheduled_job` WRITE;
INSERT INTO `scheduled_job` VALUES (1,'',NULL,1,'2012-08-12 21:52:47',NULL,NULL,1),(2,'',NULL,2,'2020-08-12 02:00:00',NULL,NULL,1),(3,'',NULL,3,'2012-08-12 07:00:00',NULL,NULL,0);
UNLOCK TABLES;
