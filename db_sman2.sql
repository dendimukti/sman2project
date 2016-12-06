/*
SQLyog Ultimate v9.01 
MySQL - 5.5.5-10.1.19-MariaDB : Database - db_sman2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_sman2` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_sman2`;

/*Table structure for table `data_files` */

DROP TABLE IF EXISTS `data_files`;

CREATE TABLE `data_files` (
  `ID_FILES` int(11) NOT NULL AUTO_INCREMENT,
  `JENIS` varchar(5) DEFAULT NULL,
  `ID_MENU` int(11) DEFAULT NULL,
  `NAMA` varchar(30) DEFAULT NULL,
  `URL` varchar(30) DEFAULT NULL,
  `KET` text,
  `URUTAN` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_FILES`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;

/*Data for the table `data_files` */

insert  into `data_files`(`ID_FILES`,`JENIS`,`ID_MENU`,`NAMA`,`URL`,`KET`,`URUTAN`) values (66,'pdf',1,'Profil Sekolah','7fdg23or6n.pdf','Profil Sekolah',1),(67,'pdf',45,'Physics','5i4s3zigu6.pdf','physics',3),(68,'pdf',46,'Kalender Pendidikan','ahfr58ardj.pdf','Kalender Pendidikan',3),(69,'gbr',1,'Anonim Quotes','q278kp5rz4.png','',2),(70,'vid',1,'Olah Raga Versi 9gag','kkopzrwabx.mp4','',3),(71,'flash',45,'Latihan Soal Fisika','t1fvbqqjgb.swf','hahahahahaha',1),(72,'flash',45,'Flash Music Composer','4t3vcrty7b.swf','ysdasdfksadk',2),(79,'teks',46,'','','<h3>Lecturer\'s Message</h3>\r\nThis year, so many miracles and graces from Allah, which were granted to me... Got some grants which could be used to support many activities I have, can support my students to do important experiences which might be once and couldnt be repeat again... these really made me exhausted...but full happiness. My students, I really want to say sorry if I did something that make you inconvenient or scare of me, because I want you do all the best thing you could do... i think I did over acts... so start from now, I\'m trying to be nice , it means I won\'t to pay attention to much to you in detail... so please continue your work, do your best even I dont push you much... ganbatte... !!!',1),(80,'teks',46,'','','<h3>Lecturer\'s Message 2</h3>This year, so many miracles and graces from Allah, which were granted to me... Got some grants which could be used to support many activities I have, can support my students to do important experiences which might be once and couldnt be repeat again... these really made me exhausted...but full happiness. My students, I really want to say sorry if I did something that make you inconvenient or scare of me, because I want you do all the best thing you could do... i think I did over acts... so start from now, I\'m trying to be nice , it means I won\'t to pay attention to much to you in detail... so please continue your work, do your best even I dont push you much... ganbatte... !!!',2),(89,'gbr',50,'Internet Speed','3z06ow9z38.jpg','dsfs',0);

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `ID_MENU` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA` varchar(30) DEFAULT NULL,
  `LOGO` varchar(30) DEFAULT 'fa-circle-o',
  `LEVEL` tinyint(4) DEFAULT NULL,
  `PARENT` int(11) DEFAULT NULL,
  `CONTENT` tinyint(4) DEFAULT '0',
  `JENIS` varchar(5) DEFAULT NULL,
  `URUTAN` int(11) DEFAULT NULL,
  `KET` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID_MENU`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

/*Data for the table `menu` */

insert  into `menu`(`ID_MENU`,`NAMA`,`LOGO`,`LEVEL`,`PARENT`,`CONTENT`,`JENIS`,`URUTAN`,`KET`) values (-1,'Uncategorized','fa-home',1,0,0,'',999,''),(1,'Profil Sekolah','fa-home',1,0,1,'',1,''),(2,'Dokumen','fa-file-text',1,0,0,'',2,''),(3,'Kegiatan Sekolah','fa-bell',1,0,0,'',3,''),(4,'Kurikulum','fa-folder-o',2,2,0,'',1,''),(5,'HUMAS','fa-folder-o',2,2,0,'',2,''),(6,'SARPRAS','fa-folder-o',2,2,0,'',3,''),(7,'Kesiswaan','fa-folder-o',2,2,0,'',4,''),(8,'RPP','fa-folder-o',3,4,0,'',1,''),(9,'Silabus','fa-folder-o',3,4,0,'',2,''),(45,'Fisika','fa-file',4,8,1,'',2,''),(46,'Kalender Pendidikan','fa-file',3,7,1,'',3,''),(47,'Testing Coba','fa-folder-o',2,3,0,'',4,'coba2'),(50,'Test 123','fa-file',4,9,1,'',1,'');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `ID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `USN` varchar(15) DEFAULT NULL,
  `PWD` varchar(15) DEFAULT NULL,
  `STATUS` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`ID`,`USN`,`PWD`,`STATUS`) values (1,'adminsman2','adminsman2',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
