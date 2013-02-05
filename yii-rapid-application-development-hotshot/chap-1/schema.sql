SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO type VALUES(1,'trade');
INSERT INTO type VALUES(2,'graphic novel');
INSERT INTO type VALUES(3,'issue');

DROP TABLE IF EXISTS `grade`;
CREATE TABLE `grade` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO grade VALUES(1,'mint');
INSERT INTO grade VALUES(2,'near mint');
INSERT INTO grade VALUES(3,'very fine');
INSERT INTO grade VALUES(4,'fine');
INSERT INTO grade VALUES(5,'very good');
INSERT INTO grade VALUES(6,'good');
INSERT INTO grade VALUES(7,'fair');
INSERT INTO grade VALUES(8,'poor');

DROP TABLE IF EXISTS `book`;
CREATE TABLE `book` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(256) NOT NULL, 
  `type_id` int(10) unsigned, 
  `publication_date` date,
  `value` decimal(10,2),
  `price` decimal(10,2),
-- image - link
-- issue info
  `notes` text,
  `signed` boolean,
  `grade_id` int(10) unsigned, 
  `bagged` boolean,
  PRIMARY KEY (`id`),
  CONSTRAINT FOREIGN KEY (`type_id`) REFERENCES `type` (`id`),
  CONSTRAINT FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `publisher`;
CREATE TABLE `publisher` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(64) NOT NULL, 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `bookpublisher`;
CREATE TABLE `bookpublisher` (
  `book_id` int(10) unsigned NOT NULL,
  `publisher_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`book_id`, `publisher_id`),
  CONSTRAINT FOREIGN KEY (`book_id`) REFERENCES `book` (`id`),
  CONSTRAINT FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `person`;
CREATE TABLE `person` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(64) NOT NULL, 
  `lname` VARCHAR(64) NOT NULL, 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `bookauthor`;
CREATE TABLE `bookauthor` (
  `book_id` int(10) unsigned NOT NULL,
  `author_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`book_id`, `author_id`),
  CONSTRAINT FOREIGN KEY (`book_id`) REFERENCES `book` (`id`),
  CONSTRAINT FOREIGN KEY (`author_id`) REFERENCES `person` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `bookillustrator`;
CREATE TABLE `bookillustrator` (
  `book_id` int(10) unsigned NOT NULL,
  `illustrator_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`book_id`, `illustrator_id`),
  CONSTRAINT FOREIGN KEY (`book_id`) REFERENCES `book` (`id`),
  CONSTRAINT FOREIGN KEY (`illustrator_id`) REFERENCES `person` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` VARCHAR(64) NOT NULL, 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `booktag`;
CREATE TABLE `booktag` (
  `book_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`book_id`, `tag_id`),
  CONSTRAINT FOREIGN KEY (`book_id`) REFERENCES `book` (`id`),
  CONSTRAINT FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

