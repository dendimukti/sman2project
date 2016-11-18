/*
SQLyog Ultimate v9.01 
MySQL - 5.5.32 : Database - db_sman2
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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

/*Data for the table `data_files` */

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

/*Data for the table `menu` */

insert  into `menu`(`ID_MENU`,`NAMA`,`LOGO`,`LEVEL`,`PARENT`,`CONTENT`,`JENIS`,`URUTAN`,`KET`) values (-1,'Uncategorized','fa-home',1,0,0,'',999,''),(1,'Profil Sekolah','fa-university',1,0,1,'',3,''),(2,'Dokumen','fa-file-text',1,0,0,'',4,''),(3,'Kegiatan Sekolah','fa-bell',1,0,0,'',5,''),(4,'Kurikulum','fa-folder-o',2,2,0,'',1,''),(5,'HUMAS','fa-folder-o',2,2,0,'',2,''),(6,'SARPRAS','fa-folder-o',2,2,0,'',3,''),(7,'Kesiswaan','fa-folder-o',2,2,0,'',4,''),(8,'RPP','fa-folder-o',3,4,0,'',1,''),(9,'Silabus','fa-folder-o',3,4,0,'',2,'');

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
