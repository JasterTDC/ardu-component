CREATE DATABASE IF NOT EXISTS `components`;

DROP TABLE IF EXISTS `components`.`ambient`;

CREATE TABLE `components`.`ambient` (
    `id`            INT(10) AUTO_INCREMENT NOT NULL,
    `temperature`   FLOAT(4, 2) NOT NULL,
    `humidity`      FLOAT(4, 2) NOT NULL,
    `createdAt`     DATETIME NOT NULL,

    PRIMARY KEY(`id`)
)Engine=InnoDB DEFAULT charset = utf8;