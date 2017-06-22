/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.7.9 : Database - iteh1
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`iteh1` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `iteh1`;

/*Table structure for table `receipt` */

DROP TABLE IF EXISTS `receipt`;

CREATE TABLE `receipt` (
  `receiptID` int(11) NOT NULL AUTO_INCREMENT,
  `time` datetime DEFAULT NULL,
  `person` varchar(50) DEFAULT NULL,
  `amount` double DEFAULT '0',
  `tableNumber` int(11) DEFAULT NULL,
  PRIMARY KEY (`receiptID`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `receipt` */

insert  into `receipt`(`receiptID`,`time`,`person`,`amount`,`tableNumber`) values (16,'2017-06-22 11:11:33','Lagano',231232,312),(14,'2017-06-22 10:20:10','Zezanje',3123,32),(15,'2017-06-22 10:57:55','Dusan',321312,142);

/*Table structure for table `receipt_item` */

DROP TABLE IF EXISTS `receipt_item`;

CREATE TABLE `receipt_item` (
  `receiptID` int(11) NOT NULL,
  `receiptItemID` int(11) NOT NULL AUTO_INCREMENT,
  `amount` double DEFAULT NULL,
  `product` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`receiptID`,`receiptItemID`),
  KEY `stavkaRacunaID` (`receiptItemID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `receipt_item` */

insert  into `receipt_item`(`receiptID`,`receiptItemID`,`amount`,`product`,`quantity`) values (1,1,200,'Koca',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
