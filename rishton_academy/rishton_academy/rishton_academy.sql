/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 5.7.36 : Database - rishton_academy
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`rishton_academy` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `rishton_academy`;

/*Table structure for table `classes` */

DROP TABLE IF EXISTS `classes`;

CREATE TABLE `classes` (
  `ClassID` int(11) NOT NULL AUTO_INCREMENT,
  `ClassName` varchar(50) NOT NULL,
  `Capacity` int(11) NOT NULL,
  PRIMARY KEY (`ClassID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `classes` */

insert  into `classes`(`ClassID`,`ClassName`,`Capacity`) values 
(1,'Year Three',10),
(2,'Year Five',10);

/*Table structure for table `librarybooks` */

DROP TABLE IF EXISTS `librarybooks`;

CREATE TABLE `librarybooks` (
  `BookID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) NOT NULL,
  `Author` varchar(255) NOT NULL,
  `ISBN` varchar(20) NOT NULL,
  `Available_Copies` int(11) NOT NULL,
  PRIMARY KEY (`BookID`),
  UNIQUE KEY `ISBN` (`ISBN`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `librarybooks` */

insert  into `librarybooks`(`BookID`,`Title`,`Author`,`ISBN`,`Available_Copies`) values 
(1,'Whispers in the Wind','Jane Austen','978-3-16-148410-0',5),
(2,'The Lost Chronicles','George Orwell','978-0-14-103613-7',3),
(3,'Echoes of Eternity','Agatha Christie','978-0-00-712083-5',4),
(4,'Beneath the Starlit Sky','J.K. Rowling','978-1-4088-5675-3',6),
(5,'The Enchanted Forest','Charles Dickens','978-0-19-953634-7',2);

/*Table structure for table `parents` */

DROP TABLE IF EXISTS `parents`;

CREATE TABLE `parents` (
  `ParentID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Address` text NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`ParentID`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `parents` */

insert  into `parents`(`ParentID`,`Name`,`Address`,`Email`,`Phone`) values 
(1,'Elodie Fontaine','25 Market Street, Manchester, M1 1WR','elodie.fontaine@example.com','07405 567890'),
(2,'Florent Dubois','100 Oxford Street, London, W1D 1LL','florent.dubois@example.com','07406 678901'),
(3,'Giselle Lambert','30 Castle Street, Edinburgh, EH2 3HT','giselle.lambert@example.com','07407 789012'),
(4,'Hugo Marchand','75 King Street, Glasgow, G1 5RB','hugo.marchand@example.com','07408 890123'),
(5,'Isabeau Martin','200 Church Road, Birmingham, B15 3TB','isabeau.martin@example.com','07409 901234'),
(6,'Jules Laurent','45 Park Lane, Leeds, LS1 2HL','jules.laurent@example.com','07410 012345'),
(7,'Kylian Rousseau','60 Victoria Road, Sheffield, S10 2DL','kylian.rousseau@example.com','07411 112233'),
(8,'Leonie Bernard','85 Albert Road, Liverpool, L17 8TX','leonie.bernard@example.com','07412 223344'),
(9,'Marceline Petit','120 Queens Avenue, Newcastle, NE1 7RU','marceline.petit@example.com','07413 334455'),
(10,'Nicolas Girard','35 Princes Street, Cardiff, CF10 3BA','nicolas.girard@example.com','07414 445566'),
(11,'Odette Lefebvre','150 George Street, Belfast, BT1 2LS','odette.lefebvre@example.com','07415 556677'),
(12,'Pascaline Roy','40 Regent Street, London, SW1Y 4PE','pascaline.roy@example.com','07416 667788'),
(13,'Quentin Dupuis','55 Duke Street, Brighton, BN1 1AG','quentin.dupuis@example.com','07417 778899'),
(14,'Romane Blanchet','70 York Road, Leicester, LE1 5XY','romane.blanchet@example.com','07418 889900'),
(15,'Sylvie Morel','95 St. Johns Lane, Bristol, BS3 5AD','sylvie.morel@example.com','07419 990011'),
(16,'Thibault Lefevre','110 Kings Cross Road, London, WC1X 9DS','thibault.lefevre@example.com','07420 101112'),
(17,'Ursule Gauthier','130 Highfield Road, Birmingham, B28 0HS','ursule.gauthier@example.com','07421 121314'),
(18,'Valentin Fournier','145 Elm Street, Nottingham, NG1 5FS','valentin.fournier@example.com','07422 131415'),
(19,'Wendy Caron','160 Oak Avenue, Southampton, SO14 6RA','wendy.caron@example.com','07423 141516'),
(20,'Xavier Renaud','175 Maple Road, Coventry, CV1 2HN','xavier.renaud@example.com','07424 151617');

/*Table structure for table `pupils` */

DROP TABLE IF EXISTS `pupils`;

CREATE TABLE `pupils` (
  `PupilID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Address` text NOT NULL,
  `MedicalInfo` text,
  `ClassID` int(11) DEFAULT NULL,
  `ParentOneID` int(11) DEFAULT NULL,
  `ParentTwoID` int(11) DEFAULT NULL,
  PRIMARY KEY (`PupilID`),
  KEY `ClassID` (`ClassID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `pupils` */

insert  into `pupils`(`PupilID`,`Name`,`Address`,`MedicalInfo`,`ClassID`,`ParentOneID`,`ParentTwoID`) values 
(1,'Araminta Blythe','10 Downing Street, Westminster, London, SW1A 2AA','Asthma',1,1,2),
(2,'Barnaby Thorne','221B Baker Street, Marylebone, London, NW1 6XE','Diabetes',1,3,4),
(3,'Cecily Hawthorne','50 High Street, Cambridge, CB1 1PT','Hypertension',1,5,6),
(4,'Digby Fairfax','15 Queen’s Road, Bristol, BS8 1QE','Epilepsy',1,7,8),
(5,'Euphemia Lark','25 Market Street, Manchester, M1 1WR','Asthma',1,9,10),
(6,'Fergus Montague','100 Oxford Street, London, W1D 1LL','Diabetes',2,11,12),
(7,'Georgiana Pemberton','30 Castle Street, Edinburgh, EH2 3HT','Hypertension',2,13,14),
(8,'Horatio Blackwood','75 King Street, Glasgow, G1 5RB','Epilepsy',2,15,16),
(9,'Isolde Merriweather','200 Church Road, Birmingham, B15 3TB','Asthma',2,17,18),
(10,'Jemima Winslow','45 Park Lane, Leeds, LS1 2HL','Diabetes',2,19,20);

/*Table structure for table `teachers` */

DROP TABLE IF EXISTS `teachers`;

CREATE TABLE `teachers` (
  `TeacherID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Address` text NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Salary` decimal(10,2) NOT NULL,
  `BackgroundCheck` text NOT NULL,
  `ClassID` int(11) DEFAULT NULL,
  PRIMARY KEY (`TeacherID`),
  UNIQUE KEY `ClassID` (`ClassID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `teachers` */

insert  into `teachers`(`TeacherID`,`Name`,`Address`,`Phone`,`Salary`,`BackgroundCheck`,`ClassID`) values 
(1,'Adeline Dupont','10 Downing Street, Westminster, London, SW1A 2AA','07401 123456',31500.00,'CRB',1),
(2,'Bastien Moreau','221B Baker Street, Marylebone, London, NW1 6XE','07402 234567',35000.00,'CHECK',2),
(3,'Capucine Lefevre','50 High Street, Cambridge, CB1 1PT','07403 345678',42000.00,'CHECK',3),
(4,'Dorianne Boucher','15 Queen’s Road, Bristol, BS8 1QE','07404 456789',50000.00,'COMPLETE',4);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`pass`,`status`) values 
(1,'ADMIN','admin@gmail.com','202cb962ac59075b964b07152d234b70',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
