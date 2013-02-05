CREATE TABLE `auth_item` (
        `name`                  varchar(64) NOT NULL,
        `type`                  int NOT NULL,
        `description`   text,
        `bizrule`               text,
        `data`                  text,
        PRIMARY KEY (`name`)
) ENGINE=InnoDB;

CREATE TABLE `auth_item_child` (
        `parent`        varchar(64) NOT NULL,
        `child`         varchar(64) NOT NULL,
        PRIMARY KEY (`parent`, `child`),
        FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
        FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `auth_assignment` (
        `itemname`      varchar(64) NOT NULL,
        -- NOTE - userid is the format the yii libraries expect
        `userid`        int(10) unsigned,
        `bizrule`       text,
        `data`          text,
        PRIMARY KEY (`itemname`, `userid`),
        FOREIGN KEY (`itemname`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

