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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

/*Data for the table `data_files` */

insert  into `data_files`(`ID_FILES`,`JENIS`,`ID_MENU`,`NAMA`,`URL`,`KET`,`URUTAN`) values (2,'pdf',25,'TES','zgqt7lnak9.pdf','',4),(3,'gbr',24,'TES','80jn1gevg3.jpg','',3),(4,'gbr',25,'TES','bi4vuhnn6t.jpg','',2),(5,'vid',24,'TES','f72vr5bfz9.mp4','',4),(6,'vid',24,'TES','08tm169hri.mp4','',7),(7,'vid',24,'TES','bawnh2odog.mp4','',5),(8,'vid',25,'TES','tjpu0b8h61.mp4','',3),(9,'teks',24,NULL,'','sdkjfsdjfsjkd',1),(10,'teks',24,NULL,'','hoaaahhmmm',6),(11,'teks',25,NULL,'','wkwkwkwkwk\r\n',1),(12,'teks',26,NULL,'','ongis nade\r\nongis nade\r\nongis nade\r\nongis nade\r\nongis nade\r\nongis nade\r\n',1),(13,'pdf',26,'TES','0gbbjft3uq.pdf','lamaran',2),(14,'gbr',26,'TES','glgienbael.JPG','bi kah',4),(15,'teks',26,NULL,'','AJSHDFKJSAHDFKJDSFKSKDFJKJSDJF',3),(23,'teks',25,NULL,'','<b>dshfgskdfjsjkdf</b>',5),(24,'pdf',25,'TES','kshdqekput.pdf','',6),(25,'gbr',25,'TES','prhs82qi0j.jpg','',7),(26,'vid',25,'TES','8qdo1n6frz.mp4','',8),(27,'teks',22,NULL,'','sdfhsdjkfhksdfhk<br>\r\nhahahaha',2),(28,'teks',22,NULL,'','hahahahhahahahahahahahahahah<br>\r\n<b>hihihihih</b>',1),(29,'gbr',1,'TES','q9iyw6ua1l.jpg','',1),(30,'pdf',24,'coba coba','gfd9chzc6m.pdf','',9),(31,'teks',24,'','','coba coba juga',8),(32,'teks',29,'','','<p style=\"text-align: center;\">dendi<strong> tamvan</strong></p>\r\n<p style=\"text-align: center;\"><strong>ntaps</strong><em>jos </em></p>\r\n<p style=\"text-align: center;\"><em>hahahahahhahahaha</em></p>',1),(33,'teks',29,'','','<p style=\"text-align: right;\"><strong><span style=\"text-decoration: underline;\">&ldquo;PENGEMBANGAN LEMBAR KERJA MAHASISWA BERBASIS ANDROID UNTUK</span></strong><br /><strong><span style=\"text-decoration: underline;\">MATAKULIAH LANDESKUNDE I SEBAGAI SARANA BELAJAR MANDIRI MAHASISWA</span></strong><br /><strong><span style=\"text-decoration: underline;\">JURUSAN SASTRA JERMAN UNIVERSITAS NEGERI MALANG ANGKATAN 2016&rdquo;</span></strong></p>',4),(35,'pdf',29,'coba pdf toefl','h8yzl6kfta.pdf','coba pdf toefl',5),(36,'gbr',29,'coba gbr toefl','y2yismcb3b.jpg','coba gbr toefl',7),(37,'vid',29,'mariyo huget','vpjuu35h4i.mp4','mariyo huget',6),(38,'teks',29,'','','<h4><em>Lembar Kerja Mahasiswa ini dibuat pada Tahun 2016 oleh Adilah Vicky Fauziyyah,</em><br /><em>seorang mahasiswi Jurusan Sastra Jerman Fakultas Sastra Universitas Negeri Malang</em><br /><em>untuk diteliti dan dikembangkan melalui skripsi yang berjudul</em></h4>',2),(39,'teks',24,'','','<h1 style=\"text-align: center;\"><strong>opo yo....</strong></h1>',10),(41,'teks',40,'','','<p>ruqyah = jampi2<br /><br />diperbolehkan selama tdk ada kesyirikan<br />abu dawud<br /><br />seperti dari ayat2 al quran, lebih utama yg diajarkan rosulullah<br />ruqyah syirik= mengandung permohonan pada jin/wali dll selain Allah</p>',1),(42,'vid',40,'coba','uk20f7hljn.flv','',2);

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `ID_MENU` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA` varchar(30) DEFAULT NULL,
  `LOGO` varchar(30) DEFAULT NULL,
  `LEVEL` tinyint(4) DEFAULT NULL,
  `PARENT` int(11) DEFAULT NULL,
  `CONTENT` tinyint(4) DEFAULT '0',
  `JENIS` varchar(5) DEFAULT NULL,
  `URUTAN` int(11) DEFAULT NULL,
  `KET` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID_MENU`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

/*Data for the table `menu` */

insert  into `menu`(`ID_MENU`,`NAMA`,`LOGO`,`LEVEL`,`PARENT`,`CONTENT`,`JENIS`,`URUTAN`,`KET`) values (-1,'Uncategorized','fa-home',1,0,0,'',999,''),(1,'Profil Sekolah','fa-anchor',1,0,1,'',0,''),(2,'Dokumen','fa-home',1,0,0,'',3,''),(3,'Kegiatan Sekolah','fa-anchor',1,0,0,'',4,''),(4,'Kurikulum','fa-home',2,2,0,'',1,''),(5,'HUMAS','fa-anchor',2,2,0,'',2,''),(6,'SARPRAS','fa-home',2,2,0,'',3,''),(7,'Kesiswaan','fa-anchor',2,2,0,'',4,''),(8,'RPP','fa-home',3,4,0,'',1,''),(9,'Silabus','fa-anchor',3,4,0,'',2,''),(22,'mantab jiwa','fa-home',3,7,1,'',2,'dendi tampvan dan berani'),(24,'ntaps','fa-anchor',3,5,1,'',6,'qwerty zxcvbnm,'),(25,'Test 123','fa-home',1,0,1,'',5,'yuhu'),(26,'arema','fa-anchor',2,3,1,'',0,'yuhuu'),(29,'Test 789','fa-home',2,-1,1,'',1,''),(30,'kat1','fa-anchor',2,3,0,'',4,''),(31,'kat2.1','fa-home',3,30,0,'',1,''),(33,'kat2.2.1','fa-anchor',4,39,0,'',1,'ngoahahaaha'),(34,'kat2.2.2','fa-home',4,39,0,'',2,'ada deh'),(35,'kat2.2.2.1','fa-anchor',5,34,0,'',1,''),(36,'kat2.2.2.2','fa-home',5,34,0,'',2,''),(37,'kat2.2.2.3','fa-anchor',5,34,0,'',3,''),(38,'kat2.2.1.1','fa-home',5,33,0,'',1,''),(39,'kategori2.2','fa-anchor',3,30,0,'',5,''),(40,'tes data baru','2',3,5,1,'',7,'');

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
