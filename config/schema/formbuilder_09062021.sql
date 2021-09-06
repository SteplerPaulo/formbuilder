/*
SQLyog Ultimate v9.10 
MySQL - 5.6.17 : Database - formbuilder
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `acos` */

DROP TABLE IF EXISTS `acos`;

CREATE TABLE `acos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT '',
  `foreign_key` int(10) unsigned DEFAULT NULL,
  `alias` varchar(255) DEFAULT '',
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `acos` */

insert  into `acos`(`id`,`parent_id`,`model`,`foreign_key`,`alias`,`lft`,`rght`) values (1,NULL,'User',NULL,'User',1,2),(2,NULL,'Form',NULL,'Form',3,4);

/*Table structure for table `aros` */

DROP TABLE IF EXISTS `aros`;

CREATE TABLE `aros` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL COMMENT 'Access Control Id',
  `model` varchar(255) DEFAULT '',
  `foreign_key` int(10) unsigned DEFAULT NULL COMMENT 'User ID',
  `alias` varchar(255) DEFAULT '',
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `aros` */

insert  into `aros`(`id`,`parent_id`,`model`,`foreign_key`,`alias`,`lft`,`rght`) values (1,NULL,'User',NULL,'Super',1,8),(2,NULL,'User',NULL,'Admin',9,10),(3,NULL,'User',NULL,'User',11,14),(4,1,'User',1,'User::1',2,3),(5,1,'User',2,'User::2',4,5),(6,1,'User',3,'User::3',6,7),(7,3,'User',4,'User::4',12,13);

/*Table structure for table `aros_acos` */

DROP TABLE IF EXISTS `aros_acos`;

CREATE TABLE `aros_acos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) unsigned NOT NULL,
  `aco_id` int(10) unsigned NOT NULL,
  `_create` char(2) NOT NULL DEFAULT '0',
  `_read` char(2) NOT NULL DEFAULT '0',
  `_update` char(2) NOT NULL DEFAULT '0',
  `_delete` char(2) NOT NULL DEFAULT '0',
  `_acl` char(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `aros_acos` */

insert  into `aros_acos`(`id`,`aro_id`,`aco_id`,`_create`,`_read`,`_update`,`_delete`,`_acl`) values (1,1,1,'1','1','1','1','1'),(2,2,1,'1','1','1','1','-1'),(3,3,1,'1','1','1','1','-1'),(4,1,2,'1','1','1','1','1');

/*Table structure for table `documents` */

DROP TABLE IF EXISTS `documents`;

CREATE TABLE `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `dir` tinyblob NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `documents` */

insert  into `documents`(`id`,`user_id`,`name`,`dir`,`created`,`modified`) values (1,1,'80dbb6bd1fe7e703d28f9c38d13a39ec.png',';\n’ְ&—#׳SVֲ›s.¶Ù\Z:>^=ןתüֶ#\'—‹«מהJ`פד‚כWװ½6־¶׃/–<wLק[€!ˆÊÜ\'**ek‏ֻֻmrr+&','2014-04-30 14:57:40','2020-08-05 21:07:56');

/*Table structure for table `domains` */

DROP TABLE IF EXISTS `domains`;

CREATE TABLE `domains` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `domains` */

insert  into `domains`(`id`,`name`,`description`) values (1,'I',''),(2,'I',''),(3,'National',''),(4,'I. Encircle the correct answer','I. Encircle the correct answer'),(5,'II. TRUE or FALSE','');

/*Table structure for table `educ_levels` */

DROP TABLE IF EXISTS `educ_levels`;

CREATE TABLE `educ_levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `alias` varchar(45) DEFAULT NULL,
  `educ_level` varchar(2) DEFAULT NULL,
  `index_order` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `educ_levels` */

insert  into `educ_levels`(`id`,`name`,`alias`,`educ_level`,`index_order`) values (1,'Grade 10','H10','HS',13),(2,'Grade 11','H11','SH',14),(3,'Grade 12','H12','SH',15),(4,'Grade 1','G1','GS',4),(5,'Grade 2','G2','GS',5),(6,'Grade 3','G3','GS',6),(7,'Grade 4','G4','GS',7),(8,'Grade 5','G5','GS',8),(9,'Grade 6','G6','GS',9),(10,'Grade 7','H7','HS',10),(11,'Grade 8','H8','HS',11),(12,'Grade 9','H9','HS',12),(13,'AC','N3','PS',1),(14,'JC','N1','PS',2),(15,'SC','N2','PS',3);

/*Table structure for table `election_report_details` */

DROP TABLE IF EXISTS `election_report_details`;

CREATE TABLE `election_report_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `election_report_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  `answer` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `election_report_details` */

insert  into `election_report_details`(`id`,`election_report_id`,`question_id`,`option_id`,`answer`) values (1,1,7,16,NULL),(2,1,8,18,NULL),(3,1,9,20,NULL),(4,1,9,21,NULL),(5,1,9,22,NULL),(6,1,9,NULL,'no answer'),(7,1,9,NULL,'no answer'),(8,1,9,NULL,'no answer'),(9,1,9,NULL,'no answer'),(10,1,9,NULL,'no answer'),(11,1,9,NULL,'no answer'),(12,1,9,NULL,'no answer'),(13,1,9,NULL,'no answer');

/*Table structure for table `election_reports` */

DROP TABLE IF EXISTS `election_reports`;

CREATE TABLE `election_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `election_reports` */

insert  into `election_reports`(`id`,`form_id`,`created`) values (1,3,'2014-03-03 14:00:38');

/*Table structure for table `evaluatees` */

DROP TABLE IF EXISTS `evaluatees`;

CREATE TABLE `evaluatees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `evaluatees` */

insert  into `evaluatees`(`id`,`name`) values (1,'paulo');

/*Table structure for table `evaluation_details` */

DROP TABLE IF EXISTS `evaluation_details`;

CREATE TABLE `evaluation_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `evaluation_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  `answer` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `evaluation_details` */

insert  into `evaluation_details`(`id`,`evaluation_id`,`question_id`,`option_id`,`answer`) values (1,1,1,2,NULL),(2,1,2,1,NULL),(3,1,3,2,NULL),(4,2,1,2,NULL),(5,2,2,2,NULL),(6,2,3,2,NULL),(7,3,1,2,NULL),(8,3,2,3,NULL),(9,3,3,4,NULL),(10,4,1,6,NULL),(11,4,2,6,NULL),(12,4,3,6,NULL),(13,5,1,5,NULL),(14,5,2,5,NULL),(15,5,3,5,NULL);

/*Table structure for table `evaluations` */

DROP TABLE IF EXISTS `evaluations`;

CREATE TABLE `evaluations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) DEFAULT NULL,
  `key_id` int(11) DEFAULT NULL,
  `evaluatee_id` int(11) DEFAULT NULL,
  `evaluator` varchar(100) DEFAULT NULL,
  `school_year_id` int(4) DEFAULT NULL,
  `period_id` int(11) DEFAULT NULL,
  `educ_level_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `evaluations` */

insert  into `evaluations`(`id`,`form_id`,`key_id`,`evaluatee_id`,`evaluator`,`school_year_id`,`period_id`,`educ_level_id`,`created`) values (1,1,1,1,'',2020,1,1,'2014-03-03 10:53:23'),(2,1,3,1,'',2020,1,1,'2014-03-03 11:09:52'),(3,1,5,1,'',2020,1,1,'2014-03-03 11:10:31'),(4,1,2,1,'',2020,1,1,'2014-03-03 11:11:14'),(5,1,4,1,'',2020,1,1,'2014-03-03 11:11:41');

/*Table structure for table `form_domains` */

DROP TABLE IF EXISTS `form_domains`;

CREATE TABLE `form_domains` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) DEFAULT NULL,
  `domain_id` int(11) DEFAULT NULL,
  `index_order` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `form_domains` */

insert  into `form_domains`(`id`,`form_id`,`domain_id`,`index_order`) values (1,1,1,NULL),(2,2,2,NULL),(3,3,3,NULL),(4,4,4,NULL),(5,4,5,NULL);

/*Table structure for table `form_types` */

DROP TABLE IF EXISTS `form_types`;

CREATE TABLE `form_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `form_types` */

insert  into `form_types`(`id`,`name`,`description`) values (1,'Quiz','Quiz'),(2,'Election Ballot','Election Ballot'),(3,'Evaluation','Evaluation');

/*Table structure for table `forms` */

DROP TABLE IF EXISTS `forms`;

CREATE TABLE `forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `description` text,
  `form_type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `forms` */

insert  into `forms`(`id`,`title`,`description`,`form_type_id`) values (1,'Evaluation 1','',3),(2,'Quiz 1','',1),(3,'Election Ballot 2014','',2),(4,'Sample Quiz No. 1','',1);

/*Table structure for table `key_headers` */

DROP TABLE IF EXISTS `key_headers`;

CREATE TABLE `key_headers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `key_headers` */

insert  into `key_headers`(`id`,`form_id`,`created`) values (1,1,'2014-03-03 10:31:27'),(2,2,'2014-03-03 11:20:15'),(3,3,'2014-03-03 13:45:20');

/*Table structure for table `keys` */

DROP TABLE IF EXISTS `keys`;

CREATE TABLE `keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key_header_id` int(11) DEFAULT NULL,
  `value` varchar(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '0 = active, 1 = used',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `keys` */

insert  into `keys`(`id`,`key_header_id`,`value`,`status`) values (1,1,'1986e3994c5',1),(2,1,'b4a5bf24fc9',1),(3,1,'dba090f3201',1),(4,1,'a6c4eb73c43',1),(5,1,'0a18a874210',1),(6,2,'046aa1ec0ba',1),(7,2,'6d64ccf4ef0',0),(8,2,'8f5690ff90f',1),(9,2,'74c579bc2ed',0),(10,2,'75434a7cdfc',1),(11,3,'48a8547e6b8',0),(12,3,'324beb05f86',0),(13,3,'b54cac5dee0',0),(14,3,'91423e1fb48',0),(15,3,'0a49a675f73',0);

/*Table structure for table `option_types` */

DROP TABLE IF EXISTS `option_types`;

CREATE TABLE `option_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `description` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `option_types` */

insert  into `option_types`(`id`,`name`,`description`) values (1,'checkbox','checkbox'),(2,'radio','radio'),(3,'text','text');

/*Table structure for table `options` */

DROP TABLE IF EXISTS `options`;

CREATE TABLE `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text,
  `value` int(11) DEFAULT NULL,
  `is_correct` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

/*Data for the table `options` */

insert  into `options`(`id`,`text`,`value`,`is_correct`) values (1,'No Answer',0,0),(2,'O1',1,0),(3,'O2',2,0),(4,'O3',3,0),(5,'O4',4,0),(6,'O5',5,0),(7,'Q1O1',1,1),(8,'Q1O2',0,0),(9,'Q1O3',0,0),(10,'Q2O1',1,1),(11,'Q2O2',0,0),(12,'Q2O3',0,0),(13,'Q3O1',1,1),(14,'Q3O2',0,0),(15,'Q3O3',0,0),(16,'Jejomar Binay',1,0),(17,'Remon \"Bong\" Revilla',1,0),(18,'Allan Peter Cayetano',1,0),(19,'Jinggoy Estrada',1,0),(20,'Grace Poe',1,0),(21,'Loren Legarda',1,0),(22,'Chiz Escudero',1,0),(23,'Nancy Binay',1,0),(24,'Sonny Angara',1,0),(25,'Bam Aquino',1,0),(26,'Koko Pimentel',1,0),(27,'Antonio Trillanes',1,0),(28,'Cynthia Villar',1,0),(29,'JV Ejercito',1,0),(30,'Gregorio Honasan',1,0),(31,'A. Mannheim',0,0),(32,'B. Marx',1,1),(33,'C. Weber',0,0),(34,'A. consistency.',1,1),(35,'B. relevancy. ',0,0),(36,'C. representativeness. ',0,0),(37,'True',0,0),(38,'False',1,1),(39,'True',0,0),(40,'False',1,1);

/*Table structure for table `periods` */

DROP TABLE IF EXISTS `periods`;

CREATE TABLE `periods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) DEFAULT NULL,
  `alias` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `periods` */

insert  into `periods`(`id`,`name`,`alias`) values (1,'First Period','1st Period'),(2,'Second Period','2nd Period'),(3,'Third Period','3rd Period'),(4,'Fourth Period','4th Period');

/*Table structure for table `question_options` */

DROP TABLE IF EXISTS `question_options`;

CREATE TABLE `question_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL DEFAULT '0',
  `option_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

/*Data for the table `question_options` */

insert  into `question_options`(`id`,`question_id`,`option_id`) values (1,1,2),(2,2,2),(3,3,2),(4,1,3),(5,2,3),(6,3,3),(7,1,4),(8,2,4),(9,3,4),(10,1,5),(11,2,5),(12,3,5),(13,1,6),(14,2,6),(15,3,6),(19,5,10),(20,5,11),(21,5,12),(22,4,7),(24,4,8),(25,4,9),(26,6,13),(27,6,14),(28,6,15),(29,7,16),(30,7,17),(31,8,18),(32,8,19),(33,9,20),(34,9,21),(35,9,22),(36,9,23),(37,9,24),(38,9,25),(39,9,26),(40,9,27),(41,9,28),(42,9,29),(43,9,30),(44,10,31),(46,10,33),(47,12,34),(48,12,35),(49,12,36),(51,10,32),(52,13,37),(53,13,38);

/*Table structure for table `questions` */

DROP TABLE IF EXISTS `questions`;

CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text,
  `form_id` int(11) DEFAULT NULL,
  `domain_id` int(11) DEFAULT NULL,
  `option_type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `questions` */

insert  into `questions`(`id`,`text`,`form_id`,`domain_id`,`option_type_id`) values (1,'Q1',1,1,2),(2,'Q2',1,1,2),(3,'Q3',1,1,2),(4,'Q1',2,2,2),(5,'Q2',2,2,2),(6,'Q3',2,2,2),(7,'President',3,3,2),(8,'Vice President',3,3,2),(9,'Senators',3,3,1),(10,'1. Who is the author of \"Das Kapital\"?',4,4,2),(11,'2. Reliability is the same as: ',4,4,1),(12,'2. Reliability is the same as: ',4,4,2),(13,'3. Jean Piaget made some revolutionary discoveries about child behavior during the nineteenth\ncentury. ',4,5,2),(14,'4. Everyone should exercise daily.',4,5,2),(15,'5. All types of cars have some type of engine.',4,5,2);

/*Table structure for table `quiz_details` */

DROP TABLE IF EXISTS `quiz_details`;

CREATE TABLE `quiz_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  `answer` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `quiz_details` */

insert  into `quiz_details`(`id`,`quiz_id`,`question_id`,`option_id`,`answer`) values (1,1,4,7,NULL),(2,1,5,10,NULL),(3,1,6,14,NULL),(4,2,4,7,NULL),(5,2,6,15,NULL),(6,3,4,7,NULL),(7,3,5,1,NULL),(8,3,6,13,NULL);

/*Table structure for table `quizzes` */

DROP TABLE IF EXISTS `quizzes`;

CREATE TABLE `quizzes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) DEFAULT NULL,
  `key_id` int(11) DEFAULT NULL,
  `examinee` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `quizzes` */

insert  into `quizzes`(`id`,`form_id`,`key_id`,`examinee`,`created`) values (1,2,6,'Garry','2014-03-03 11:20:54'),(2,2,8,'Val','2014-03-03 13:23:48'),(3,2,10,'Dave','2014-03-03 13:29:18');

/*Table structure for table `rest_logs` */

DROP TABLE IF EXISTS `rest_logs`;

CREATE TABLE `rest_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `class` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `controller` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `action` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `model_id` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `requested` datetime NOT NULL,
  `apikey` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `httpcode` smallint(3) unsigned NOT NULL,
  `error` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ratelimited` tinyint(1) unsigned NOT NULL,
  `data_in` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data_out` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `responded` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

/*Data for the table `rest_logs` */

insert  into `rest_logs`(`id`,`class`,`username`,`controller`,`action`,`model_id`,`ip`,`requested`,`apikey`,`httpcode`,`error`,`ratelimited`,`data_in`,`meta`,`data_out`,`responded`,`created`,`modified`) values (1,'','','ElectionReports','index','0','::1','2020-06-03 07:51:21','',200,'',0,'null','{\"href\":\"http:\\/\\/localhost\\/formbuilder\\/election_reports\\/index.json\",\"time_local\":\"Wed, 03 Jun 2020 07:51:22 +0200\",\"prev\":null,\"next\":null,\"last\":\"http:\\/\\/localhost\\/formbuilder\\/election_reports\\/index.json?page=1\",\"page\":1,\"pages\":1,\"count\":1,\"time_epoch\":\"1591163482\",\"protocol\":\"HTTP\\/1.1\",\"status\":\"ok\",\"feedback\":[{\"message\":\"Unable to establish class\",\"level\":\"warning\"}],\"version\":\"1.0.0\"}','{\"data\":{\"0\":{\"ElectionReport\":{\"id\":\"1\",\"form_id\":\"3\",\"created\":\"2014-03-03 14:00:38\"},\"Form\":{\"id\":\"3\",\"title\":\"Election Ballot 2014\",\"description\":\"\",\"form_type_id\":\"2\"},\"ElectionReportDetail\":[{\"id\":\"1\",\"election_report_id\":\"1\",\"question_id\":\"7\",\"option_id\":\"16\",\"answer\":null},{\"id\":\"2\",\"election_report_id\":\"1\",\"question_id\":\"8\",\"option_id\":\"18\",\"answer\":null},{\"id\":\"3\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":\"20\",\"answer\":null},{\"id\":\"4\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":\"21\",\"answer\":null},{\"id\":\"5\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":\"22\",\"answer\":null},{\"id\":\"6\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":null,\"answer\":\"no answer\"},{\"id\":\"7\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":null,\"answer\":\"no answer\"},{\"id\":\"8\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":null,\"answer\":\"no answer\"},{\"id\":\"9\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":null,\"answer\":\"no answer\"},{\"id\":\"10\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":null,\"answer\":\"no answer\"},{\"id\":\"11\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":null,\"answer\":\"no answer\"},{\"id\":\"12\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":null,\"answer\":\"no answer\"},{\"id\":\"13\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":null,\"answer\":\"no answer\"}]},\"count\":1}}','2020-06-03 07:51:22','2020-06-03 07:51:23','2020-06-03 07:51:23'),(2,'','','Evaluations','index','0','::1','2020-06-03 07:54:12','',200,'',0,'null','{\"href\":\"http:\\/\\/localhost\\/formbuilder\\/evaluations\\/index.json\",\"time_local\":\"Wed, 03 Jun 2020 07:54:12 +0200\",\"prev\":null,\"next\":null,\"last\":\"http:\\/\\/localhost\\/formbuilder\\/evaluations\\/index.json?page=1\",\"page\":1,\"pages\":1,\"count\":1,\"time_epoch\":\"1591163652\",\"protocol\":\"HTTP\\/1.1\",\"status\":\"ok\",\"feedback\":[{\"message\":\"Unable to establish class\",\"level\":\"warning\"}],\"version\":\"1.0.0\"}','{\"data\":{\"count\":1}}','2020-06-03 07:54:12','2020-06-03 07:54:12','2020-06-03 07:54:12'),(3,'','','Evaluations','index','0','::1','2020-06-03 07:58:09','',200,'',0,'null','{\"href\":\"http:\\/\\/localhost\\/formbuilder\\/evaluations\\/index.json\",\"time_local\":\"Wed, 03 Jun 2020 07:58:09 +0200\",\"prev\":null,\"next\":null,\"last\":\"http:\\/\\/localhost\\/formbuilder\\/evaluations\\/index.json?page=1\",\"page\":1,\"pages\":1,\"count\":1,\"time_epoch\":\"1591163889\",\"protocol\":\"HTTP\\/1.1\",\"status\":\"ok\",\"feedback\":[{\"message\":\"Unable to establish class\",\"level\":\"warning\"}],\"version\":\"1.0.0\"}','{\"data\":{\"count\":1}}','2020-06-03 07:58:09','2020-06-03 07:58:09','2020-06-03 07:58:09'),(4,'','','Evaluations','index','0','::1','2020-06-03 07:59:29','',200,'',0,'null','{\"href\":\"http:\\/\\/localhost\\/formbuilder\\/evaluations\\/index.json\",\"time_local\":\"Wed, 03 Jun 2020 07:59:29 +0200\",\"prev\":null,\"next\":null,\"last\":\"http:\\/\\/localhost\\/formbuilder\\/evaluations\\/index.json?page=1\",\"page\":1,\"pages\":1,\"count\":1,\"time_epoch\":\"1591163969\",\"protocol\":\"HTTP\\/1.1\",\"status\":\"ok\",\"feedback\":[{\"message\":\"Unable to establish class\",\"level\":\"warning\"}],\"version\":\"1.0.0\"}','{\"data\":{\"count\":1}}','2020-06-03 07:59:29','2020-06-03 07:59:29','2020-06-03 07:59:29'),(5,'','','Evaluations','index','0','::1','2020-06-03 08:00:33','',200,'',0,'null','{\"href\":\"http:\\/\\/localhost\\/formbuilder\\/evaluations\\/index.json\",\"time_local\":\"Wed, 03 Jun 2020 08:00:33 +0200\",\"prev\":null,\"next\":null,\"last\":\"http:\\/\\/localhost\\/formbuilder\\/evaluations\\/index.json?page=1\",\"page\":1,\"pages\":1,\"count\":1,\"time_epoch\":\"1591164033\",\"protocol\":\"HTTP\\/1.1\",\"status\":\"ok\",\"feedback\":[{\"message\":\"Unable to establish class\",\"level\":\"warning\"}],\"version\":\"1.0.0\"}','{\"data\":{\"count\":1}}','2020-06-03 08:00:33','2020-06-03 08:00:33','2020-06-03 08:00:33'),(6,'','','Evaluations','index','0','::1','2020-06-03 08:01:13','',200,'',0,'null','{\"href\":\"http:\\/\\/localhost\\/formbuilder\\/evaluations\\/index.json\",\"time_local\":\"Wed, 03 Jun 2020 08:01:13 +0200\",\"prev\":null,\"next\":null,\"last\":\"http:\\/\\/localhost\\/formbuilder\\/evaluations\\/index.json?page=1\",\"page\":1,\"pages\":1,\"count\":1,\"time_epoch\":\"1591164073\",\"protocol\":\"HTTP\\/1.1\",\"status\":\"ok\",\"feedback\":[{\"message\":\"Unable to establish class\",\"level\":\"warning\"}],\"version\":\"1.0.0\"}','{\"data\":{\"count\":1}}','2020-06-03 08:01:13','2020-06-03 08:01:13','2020-06-03 08:01:13'),(7,'','','Evaluations','index','0','::1','2020-06-03 08:01:43','',200,'',0,'null','{\"href\":\"http:\\/\\/localhost\\/formbuilder\\/evaluations\\/index.json\",\"time_local\":\"Wed, 03 Jun 2020 08:01:43 +0200\",\"prev\":null,\"next\":null,\"last\":\"http:\\/\\/localhost\\/formbuilder\\/evaluations\\/index.json?page=1\",\"page\":1,\"pages\":1,\"count\":1,\"time_epoch\":\"1591164103\",\"protocol\":\"HTTP\\/1.1\",\"status\":\"ok\",\"feedback\":[{\"message\":\"Unable to establish class\",\"level\":\"warning\"}],\"version\":\"1.0.0\"}','{\"data\":{\"0\":{\"Evaluation\":{\"id\":\"1\",\"form_id\":\"1\",\"key_id\":\"1\",\"evaluatee_id\":\"1\",\"evaluator\":\"\",\"school_year_id\":\"2020\",\"period_id\":\"1\",\"educ_level_id\":\"1\",\"created\":\"2014-03-03 10:53:23\"},\"Form\":{\"id\":\"1\",\"title\":\"Evaluation 1\",\"description\":\"\",\"form_type_id\":\"3\"},\"Key\":{\"id\":\"1\",\"key_header_id\":\"1\",\"value\":\"1986e3994c5\",\"status\":\"1\",\"status_str\":\"Used\"},\"Evaluatee\":{\"id\":\"1\",\"name\":\"paulo\"},\"SchoolYear\":{\"id\":\"2020\",\"name\":\"2020-2021\",\"is_default\":\"1\"},\"Period\":{\"id\":\"1\",\"name\":\"First Period\",\"alias\":\"1st Period\"},\"EducLevel\":{\"id\":\"1\",\"name\":\"Grade 10\",\"alias\":\"H10\",\"educ_level\":\"HS\",\"index_order\":\"13\"}},\"count\":1}}','2020-06-03 08:01:43','2020-06-03 08:01:43','2020-06-03 08:01:43'),(8,'','','Forms','index','0','::1','2020-06-03 08:02:21','',200,'',0,'null','{\"href\":\"http:\\/\\/localhost\\/formbuilder\\/forms\\/index.json\",\"time_local\":\"Wed, 03 Jun 2020 08:02:21 +0200\",\"prev\":null,\"next\":null,\"last\":\"http:\\/\\/localhost\\/formbuilder\\/forms\\/index.json?page=1\",\"page\":1,\"pages\":1,\"count\":3,\"time_epoch\":\"1591164141\",\"protocol\":\"HTTP\\/1.1\",\"status\":\"ok\",\"feedback\":[{\"message\":\"Unable to establish class\",\"level\":\"warning\"}],\"version\":\"1.0.0\"}','{\"data\":[{\"Form\":{\"id\":\"2\",\"title\":\"Quiz 1\",\"description\":\"\",\"form_type_id\":\"1\"},\"FormType\":{\"id\":\"1\",\"name\":\"Quiz\",\"description\":\"Quiz\"},\"FormDomain\":[{\"id\":\"2\",\"form_id\":\"2\",\"domain_id\":\"2\",\"index_order\":null}],\"Question\":[{\"id\":\"4\",\"text\":\"Q1\",\"form_id\":\"2\",\"domain_id\":\"2\",\"option_type_id\":\"2\"},{\"id\":\"5\",\"text\":\"Q2\",\"form_id\":\"2\",\"domain_id\":\"2\",\"option_type_id\":\"2\"},{\"id\":\"6\",\"text\":\"Q3\",\"form_id\":\"2\",\"domain_id\":\"2\",\"option_type_id\":\"2\"}],\"QuestionCount\":{\"count\":3}},{\"Form\":{\"id\":\"3\",\"title\":\"Election Ballot 2014\",\"description\":\"\",\"form_type_id\":\"2\"},\"FormType\":{\"id\":\"2\",\"name\":\"Election Ballot\",\"description\":\"Election Ballot\"},\"FormDomain\":[{\"id\":\"3\",\"form_id\":\"3\",\"domain_id\":\"3\",\"index_order\":null}],\"Question\":[{\"id\":\"7\",\"text\":\"President\",\"form_id\":\"3\",\"domain_id\":\"3\",\"option_type_id\":\"2\"},{\"id\":\"8\",\"text\":\"Vice President\",\"form_id\":\"3\",\"domain_id\":\"3\",\"option_type_id\":\"2\"},{\"id\":\"9\",\"text\":\"Senators\",\"form_id\":\"3\",\"domain_id\":\"3\",\"option_type_id\":\"1\"}],\"QuestionCount\":{\"count\":3}},{\"Form\":{\"id\":\"1\",\"title\":\"Evaluation 1\",\"description\":\"\",\"form_type_id\":\"3\"},\"FormType\":{\"id\":\"3\",\"name\":\"Evaluation\",\"description\":\"Evaluation\"},\"FormDomain\":[{\"id\":\"1\",\"form_id\":\"1\",\"domain_id\":\"1\",\"index_order\":null}],\"Question\":[{\"id\":\"1\",\"text\":\"Q1\",\"form_id\":\"1\",\"domain_id\":\"1\",\"option_type_id\":\"2\"},{\"id\":\"2\",\"text\":\"Q2\",\"form_id\":\"1\",\"domain_id\":\"1\",\"option_type_id\":\"2\"},{\"id\":\"3\",\"text\":\"Q3\",\"form_id\":\"1\",\"domain_id\":\"1\",\"option_type_id\":\"2\"}],\"QuestionCount\":{\"count\":3}}]}','2020-06-03 08:02:21','2020-06-03 08:02:21','2020-06-03 08:02:21'),(9,'','','KeyHeaders','index','0','::1','2020-06-03 08:02:24','',200,'',0,'null','{\"href\":\"http:\\/\\/localhost\\/formbuilder\\/key_headers\\/index.json\",\"time_local\":\"Wed, 03 Jun 2020 08:02:24 +0200\",\"prev\":null,\"next\":null,\"last\":\"http:\\/\\/localhost\\/formbuilder\\/key_headers\\/index.json?page=1\",\"page\":1,\"pages\":1,\"count\":3,\"time_epoch\":\"1591164144\",\"protocol\":\"HTTP\\/1.1\",\"status\":\"ok\",\"feedback\":[{\"message\":\"Unable to establish class\",\"level\":\"warning\"}],\"version\":\"1.0.0\"}','{\"data\":[{\"KeyHeader\":{\"id\":\"1\",\"form_id\":\"1\",\"created\":\"2014-03-03 10:31:27\"},\"Form\":{\"id\":\"1\",\"title\":\"Evaluation 1\",\"description\":\"\",\"form_type_id\":\"3\"},\"Key\":{\"0\":{\"id\":\"1\",\"key_header_id\":\"1\",\"value\":\"1986e3994c5\",\"status\":\"1\",\"status_str\":\"Used\"},\"1\":{\"id\":\"2\",\"key_header_id\":\"1\",\"value\":\"b4a5bf24fc9\",\"status\":\"1\",\"status_str\":\"Used\"},\"2\":{\"id\":\"3\",\"key_header_id\":\"1\",\"value\":\"dba090f3201\",\"status\":\"1\",\"status_str\":\"Used\"},\"3\":{\"id\":\"4\",\"key_header_id\":\"1\",\"value\":\"a6c4eb73c43\",\"status\":\"1\",\"status_str\":\"Used\"},\"4\":{\"id\":\"5\",\"key_header_id\":\"1\",\"value\":\"0a18a874210\",\"status\":\"1\",\"status_str\":\"Used\"},\"count\":5}},{\"KeyHeader\":{\"id\":\"2\",\"form_id\":\"2\",\"created\":\"2014-03-03 11:20:15\"},\"Form\":{\"id\":\"2\",\"title\":\"Quiz 1\",\"description\":\"\",\"form_type_id\":\"1\"},\"Key\":{\"0\":{\"id\":\"6\",\"key_header_id\":\"2\",\"value\":\"046aa1ec0ba\",\"status\":\"1\",\"status_str\":\"Used\"},\"1\":{\"id\":\"7\",\"key_header_id\":\"2\",\"value\":\"6d64ccf4ef0\",\"status\":\"0\",\"status_str\":\"Active\"},\"2\":{\"id\":\"8\",\"key_header_id\":\"2\",\"value\":\"8f5690ff90f\",\"status\":\"1\",\"status_str\":\"Used\"},\"3\":{\"id\":\"9\",\"key_header_id\":\"2\",\"value\":\"74c579bc2ed\",\"status\":\"0\",\"status_str\":\"Active\"},\"4\":{\"id\":\"10\",\"key_header_id\":\"2\",\"value\":\"75434a7cdfc\",\"status\":\"1\",\"status_str\":\"Used\"},\"count\":5}},{\"KeyHeader\":{\"id\":\"3\",\"form_id\":\"3\",\"created\":\"2014-03-03 13:45:20\"},\"Form\":{\"id\":\"3\",\"title\":\"Election Ballot 2014\",\"description\":\"\",\"form_type_id\":\"2\"},\"Key\":{\"0\":{\"id\":\"11\",\"key_header_id\":\"3\",\"value\":\"48a8547e6b8\",\"status\":\"0\",\"status_str\":\"Active\"},\"1\":{\"id\":\"12\",\"key_header_id\":\"3\",\"value\":\"324beb05f86\",\"status\":\"0\",\"status_str\":\"Active\"},\"2\":{\"id\":\"13\",\"key_header_id\":\"3\",\"value\":\"b54cac5dee0\",\"status\":\"0\",\"status_str\":\"Active\"},\"3\":{\"id\":\"14\",\"key_header_id\":\"3\",\"value\":\"91423e1fb48\",\"status\":\"0\",\"status_str\":\"Active\"},\"4\":{\"id\":\"15\",\"key_header_id\":\"3\",\"value\":\"0a49a675f73\",\"status\":\"0\",\"status_str\":\"Active\"},\"count\":5}}]}','2020-06-03 08:02:24','2020-06-03 08:02:24','2020-06-03 08:02:24'),(10,'','','ElectionReports','index','0','::1','2020-06-03 08:02:29','',200,'',0,'null','{\"href\":\"http:\\/\\/localhost\\/formbuilder\\/election_reports\\/index.json\",\"time_local\":\"Wed, 03 Jun 2020 08:02:29 +0200\",\"prev\":null,\"next\":null,\"last\":\"http:\\/\\/localhost\\/formbuilder\\/election_reports\\/index.json?page=1\",\"page\":1,\"pages\":1,\"count\":1,\"time_epoch\":\"1591164149\",\"protocol\":\"HTTP\\/1.1\",\"status\":\"ok\",\"feedback\":[{\"message\":\"Unable to establish class\",\"level\":\"warning\"}],\"version\":\"1.0.0\"}','{\"data\":{\"0\":{\"ElectionReport\":{\"id\":\"1\",\"form_id\":\"3\",\"created\":\"2014-03-03 14:00:38\"},\"Form\":{\"id\":\"3\",\"title\":\"Election Ballot 2014\",\"description\":\"\",\"form_type_id\":\"2\"},\"ElectionReportDetail\":[{\"id\":\"1\",\"election_report_id\":\"1\",\"question_id\":\"7\",\"option_id\":\"16\",\"answer\":null},{\"id\":\"2\",\"election_report_id\":\"1\",\"question_id\":\"8\",\"option_id\":\"18\",\"answer\":null},{\"id\":\"3\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":\"20\",\"answer\":null},{\"id\":\"4\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":\"21\",\"answer\":null},{\"id\":\"5\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":\"22\",\"answer\":null},{\"id\":\"6\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":null,\"answer\":\"no answer\"},{\"id\":\"7\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":null,\"answer\":\"no answer\"},{\"id\":\"8\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":null,\"answer\":\"no answer\"},{\"id\":\"9\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":null,\"answer\":\"no answer\"},{\"id\":\"10\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":null,\"answer\":\"no answer\"},{\"id\":\"11\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":null,\"answer\":\"no answer\"},{\"id\":\"12\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":null,\"answer\":\"no answer\"},{\"id\":\"13\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":null,\"answer\":\"no answer\"}]},\"count\":1}}','2020-06-03 08:02:29','2020-06-03 08:02:29','2020-06-03 08:02:29'),(11,'','','Quizzes','index','0','::1','2020-06-03 08:02:36','',200,'',0,'null','{\"href\":\"http:\\/\\/localhost\\/formbuilder\\/quizzes\\/index.json\",\"time_local\":\"Wed, 03 Jun 2020 08:02:37 +0200\",\"prev\":null,\"next\":null,\"last\":\"http:\\/\\/localhost\\/formbuilder\\/quizzes\\/index.json?page=1\",\"page\":1,\"pages\":1,\"count\":3,\"time_epoch\":\"1591164157\",\"protocol\":\"HTTP\\/1.1\",\"status\":\"ok\",\"feedback\":[{\"message\":\"Unable to establish class\",\"level\":\"warning\"}],\"version\":\"1.0.0\"}','{\"data\":{\"0\":{\"Quiz\":{\"id\":\"3\",\"form_id\":\"2\",\"key_id\":\"10\",\"examinee\":\"Dave\",\"created\":\"2014-03-03 13:29:18\"},\"Form\":{\"id\":\"2\",\"title\":\"Quiz 1\",\"description\":\"\",\"form_type_id\":\"1\"},\"Key\":{\"id\":\"10\",\"key_header_id\":\"2\",\"value\":\"75434a7cdfc\",\"status\":\"1\",\"status_str\":\"Used\"},\"QuizDetail\":[{\"id\":\"6\",\"quiz_id\":\"3\",\"question_id\":\"4\",\"option_id\":\"7\",\"answer\":null},{\"id\":\"7\",\"quiz_id\":\"3\",\"question_id\":\"5\",\"option_id\":\"1\",\"answer\":null},{\"id\":\"8\",\"quiz_id\":\"3\",\"question_id\":\"6\",\"option_id\":\"13\",\"answer\":null}]},\"1\":{\"Quiz\":{\"id\":\"1\",\"form_id\":\"2\",\"key_id\":\"6\",\"examinee\":\"Garry\",\"created\":\"2014-03-03 11:20:54\"},\"Form\":{\"id\":\"2\",\"title\":\"Quiz 1\",\"description\":\"\",\"form_type_id\":\"1\"},\"Key\":{\"id\":\"6\",\"key_header_id\":\"2\",\"value\":\"046aa1ec0ba\",\"status\":\"1\",\"status_str\":\"Used\"},\"QuizDetail\":[{\"id\":\"1\",\"quiz_id\":\"1\",\"question_id\":\"4\",\"option_id\":\"7\",\"answer\":null},{\"id\":\"2\",\"quiz_id\":\"1\",\"question_id\":\"5\",\"option_id\":\"10\",\"answer\":null},{\"id\":\"3\",\"quiz_id\":\"1\",\"question_id\":\"6\",\"option_id\":\"14\",\"answer\":null}]},\"2\":{\"Quiz\":{\"id\":\"2\",\"form_id\":\"2\",\"key_id\":\"8\",\"examinee\":\"Val\",\"created\":\"2014-03-03 13:23:48\"},\"Form\":{\"id\":\"2\",\"title\":\"Quiz 1\",\"description\":\"\",\"form_type_id\":\"1\"},\"Key\":{\"id\":\"8\",\"key_header_id\":\"2\",\"value\":\"8f5690ff90f\",\"status\":\"1\",\"status_str\":\"Used\"},\"QuizDetail\":[{\"id\":\"4\",\"quiz_id\":\"2\",\"question_id\":\"4\",\"option_id\":\"7\",\"answer\":null},{\"id\":\"5\",\"quiz_id\":\"2\",\"question_id\":\"6\",\"option_id\":\"15\",\"answer\":null}]},\"count\":3}}','2020-06-03 08:02:37','2020-06-03 08:02:37','2020-06-03 08:02:37'),(12,'','','Quizzes','index','0','::1','2020-06-03 08:02:52','',200,'',0,'null','{\"href\":\"http:\\/\\/localhost\\/formbuilder\\/quizzes\\/index.json\",\"time_local\":\"Wed, 03 Jun 2020 08:02:52 +0200\",\"prev\":null,\"next\":null,\"last\":\"http:\\/\\/localhost\\/formbuilder\\/quizzes\\/index.json?page=1\",\"page\":1,\"pages\":1,\"count\":3,\"time_epoch\":\"1591164172\",\"protocol\":\"HTTP\\/1.1\",\"status\":\"ok\",\"feedback\":[{\"message\":\"Unable to establish class\",\"level\":\"warning\"}],\"version\":\"1.0.0\"}','{\"data\":{\"0\":{\"Quiz\":{\"id\":\"3\",\"form_id\":\"2\",\"key_id\":\"10\",\"examinee\":\"Dave\",\"created\":\"2014-03-03 13:29:18\"},\"Form\":{\"id\":\"2\",\"title\":\"Quiz 1\",\"description\":\"\",\"form_type_id\":\"1\"},\"Key\":{\"id\":\"10\",\"key_header_id\":\"2\",\"value\":\"75434a7cdfc\",\"status\":\"1\",\"status_str\":\"Used\"},\"QuizDetail\":[{\"id\":\"6\",\"quiz_id\":\"3\",\"question_id\":\"4\",\"option_id\":\"7\",\"answer\":null},{\"id\":\"7\",\"quiz_id\":\"3\",\"question_id\":\"5\",\"option_id\":\"1\",\"answer\":null},{\"id\":\"8\",\"quiz_id\":\"3\",\"question_id\":\"6\",\"option_id\":\"13\",\"answer\":null}]},\"1\":{\"Quiz\":{\"id\":\"1\",\"form_id\":\"2\",\"key_id\":\"6\",\"examinee\":\"Garry\",\"created\":\"2014-03-03 11:20:54\"},\"Form\":{\"id\":\"2\",\"title\":\"Quiz 1\",\"description\":\"\",\"form_type_id\":\"1\"},\"Key\":{\"id\":\"6\",\"key_header_id\":\"2\",\"value\":\"046aa1ec0ba\",\"status\":\"1\",\"status_str\":\"Used\"},\"QuizDetail\":[{\"id\":\"1\",\"quiz_id\":\"1\",\"question_id\":\"4\",\"option_id\":\"7\",\"answer\":null},{\"id\":\"2\",\"quiz_id\":\"1\",\"question_id\":\"5\",\"option_id\":\"10\",\"answer\":null},{\"id\":\"3\",\"quiz_id\":\"1\",\"question_id\":\"6\",\"option_id\":\"14\",\"answer\":null}]},\"2\":{\"Quiz\":{\"id\":\"2\",\"form_id\":\"2\",\"key_id\":\"8\",\"examinee\":\"Val\",\"created\":\"2014-03-03 13:23:48\"},\"Form\":{\"id\":\"2\",\"title\":\"Quiz 1\",\"description\":\"\",\"form_type_id\":\"1\"},\"Key\":{\"id\":\"8\",\"key_header_id\":\"2\",\"value\":\"8f5690ff90f\",\"status\":\"1\",\"status_str\":\"Used\"},\"QuizDetail\":[{\"id\":\"4\",\"quiz_id\":\"2\",\"question_id\":\"4\",\"option_id\":\"7\",\"answer\":null},{\"id\":\"5\",\"quiz_id\":\"2\",\"question_id\":\"6\",\"option_id\":\"15\",\"answer\":null}]},\"count\":3}}','2020-06-03 08:02:52','2020-06-03 08:02:52','2020-06-03 08:02:52'),(13,'','','ElectionReports','index','0','::1','2020-06-03 08:02:53','',200,'',0,'null','{\"href\":\"http:\\/\\/localhost\\/formbuilder\\/election_reports\\/index.json\",\"time_local\":\"Wed, 03 Jun 2020 08:02:53 +0200\",\"prev\":null,\"next\":null,\"last\":\"http:\\/\\/localhost\\/formbuilder\\/election_reports\\/index.json?page=1\",\"page\":1,\"pages\":1,\"count\":1,\"time_epoch\":\"1591164173\",\"protocol\":\"HTTP\\/1.1\",\"status\":\"ok\",\"feedback\":[{\"message\":\"Unable to establish class\",\"level\":\"warning\"}],\"version\":\"1.0.0\"}','{\"data\":{\"0\":{\"ElectionReport\":{\"id\":\"1\",\"form_id\":\"3\",\"created\":\"2014-03-03 14:00:38\"},\"Form\":{\"id\":\"3\",\"title\":\"Election Ballot 2014\",\"description\":\"\",\"form_type_id\":\"2\"},\"ElectionReportDetail\":[{\"id\":\"1\",\"election_report_id\":\"1\",\"question_id\":\"7\",\"option_id\":\"16\",\"answer\":null},{\"id\":\"2\",\"election_report_id\":\"1\",\"question_id\":\"8\",\"option_id\":\"18\",\"answer\":null},{\"id\":\"3\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":\"20\",\"answer\":null},{\"id\":\"4\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":\"21\",\"answer\":null},{\"id\":\"5\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":\"22\",\"answer\":null},{\"id\":\"6\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":null,\"answer\":\"no answer\"},{\"id\":\"7\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":null,\"answer\":\"no answer\"},{\"id\":\"8\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":null,\"answer\":\"no answer\"},{\"id\":\"9\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":null,\"answer\":\"no answer\"},{\"id\":\"10\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":null,\"answer\":\"no answer\"},{\"id\":\"11\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":null,\"answer\":\"no answer\"},{\"id\":\"12\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":null,\"answer\":\"no answer\"},{\"id\":\"13\",\"election_report_id\":\"1\",\"question_id\":\"9\",\"option_id\":null,\"answer\":\"no answer\"}]},\"count\":1}}','2020-06-03 08:02:53','2020-06-03 08:02:53','2020-06-03 08:02:53'),(14,'','','KeyHeaders','index','0','::1','2020-06-03 08:02:54','',200,'',0,'null','{\"href\":\"http:\\/\\/localhost\\/formbuilder\\/key_headers\\/index.json\",\"time_local\":\"Wed, 03 Jun 2020 08:02:54 +0200\",\"prev\":null,\"next\":null,\"last\":\"http:\\/\\/localhost\\/formbuilder\\/key_headers\\/index.json?page=1\",\"page\":1,\"pages\":1,\"count\":3,\"time_epoch\":\"1591164174\",\"protocol\":\"HTTP\\/1.1\",\"status\":\"ok\",\"feedback\":[{\"message\":\"Unable to establish class\",\"level\":\"warning\"}],\"version\":\"1.0.0\"}','{\"data\":[{\"KeyHeader\":{\"id\":\"1\",\"form_id\":\"1\",\"created\":\"2014-03-03 10:31:27\"},\"Form\":{\"id\":\"1\",\"title\":\"Evaluation 1\",\"description\":\"\",\"form_type_id\":\"3\"},\"Key\":{\"0\":{\"id\":\"1\",\"key_header_id\":\"1\",\"value\":\"1986e3994c5\",\"status\":\"1\",\"status_str\":\"Used\"},\"1\":{\"id\":\"2\",\"key_header_id\":\"1\",\"value\":\"b4a5bf24fc9\",\"status\":\"1\",\"status_str\":\"Used\"},\"2\":{\"id\":\"3\",\"key_header_id\":\"1\",\"value\":\"dba090f3201\",\"status\":\"1\",\"status_str\":\"Used\"},\"3\":{\"id\":\"4\",\"key_header_id\":\"1\",\"value\":\"a6c4eb73c43\",\"status\":\"1\",\"status_str\":\"Used\"},\"4\":{\"id\":\"5\",\"key_header_id\":\"1\",\"value\":\"0a18a874210\",\"status\":\"1\",\"status_str\":\"Used\"},\"count\":5}},{\"KeyHeader\":{\"id\":\"2\",\"form_id\":\"2\",\"created\":\"2014-03-03 11:20:15\"},\"Form\":{\"id\":\"2\",\"title\":\"Quiz 1\",\"description\":\"\",\"form_type_id\":\"1\"},\"Key\":{\"0\":{\"id\":\"6\",\"key_header_id\":\"2\",\"value\":\"046aa1ec0ba\",\"status\":\"1\",\"status_str\":\"Used\"},\"1\":{\"id\":\"7\",\"key_header_id\":\"2\",\"value\":\"6d64ccf4ef0\",\"status\":\"0\",\"status_str\":\"Active\"},\"2\":{\"id\":\"8\",\"key_header_id\":\"2\",\"value\":\"8f5690ff90f\",\"status\":\"1\",\"status_str\":\"Used\"},\"3\":{\"id\":\"9\",\"key_header_id\":\"2\",\"value\":\"74c579bc2ed\",\"status\":\"0\",\"status_str\":\"Active\"},\"4\":{\"id\":\"10\",\"key_header_id\":\"2\",\"value\":\"75434a7cdfc\",\"status\":\"1\",\"status_str\":\"Used\"},\"count\":5}},{\"KeyHeader\":{\"id\":\"3\",\"form_id\":\"3\",\"created\":\"2014-03-03 13:45:20\"},\"Form\":{\"id\":\"3\",\"title\":\"Election Ballot 2014\",\"description\":\"\",\"form_type_id\":\"2\"},\"Key\":{\"0\":{\"id\":\"11\",\"key_header_id\":\"3\",\"value\":\"48a8547e6b8\",\"status\":\"0\",\"status_str\":\"Active\"},\"1\":{\"id\":\"12\",\"key_header_id\":\"3\",\"value\":\"324beb05f86\",\"status\":\"0\",\"status_str\":\"Active\"},\"2\":{\"id\":\"13\",\"key_header_id\":\"3\",\"value\":\"b54cac5dee0\",\"status\":\"0\",\"status_str\":\"Active\"},\"3\":{\"id\":\"14\",\"key_header_id\":\"3\",\"value\":\"91423e1fb48\",\"status\":\"0\",\"status_str\":\"Active\"},\"4\":{\"id\":\"15\",\"key_header_id\":\"3\",\"value\":\"0a49a675f73\",\"status\":\"0\",\"status_str\":\"Active\"},\"count\":5}}]}','2020-06-03 08:02:54','2020-06-03 08:02:54','2020-06-03 08:02:54'),(15,'','','Forms','index','0','::1','2020-06-03 08:02:56','',200,'',0,'null','{\"href\":\"http:\\/\\/localhost\\/formbuilder\\/forms\\/index.json\",\"time_local\":\"Wed, 03 Jun 2020 08:02:56 +0200\",\"prev\":null,\"next\":null,\"last\":\"http:\\/\\/localhost\\/formbuilder\\/forms\\/index.json?page=1\",\"page\":1,\"pages\":1,\"count\":3,\"time_epoch\":\"1591164176\",\"protocol\":\"HTTP\\/1.1\",\"status\":\"ok\",\"feedback\":[{\"message\":\"Unable to establish class\",\"level\":\"warning\"}],\"version\":\"1.0.0\"}','{\"data\":[{\"Form\":{\"id\":\"2\",\"title\":\"Quiz 1\",\"description\":\"\",\"form_type_id\":\"1\"},\"FormType\":{\"id\":\"1\",\"name\":\"Quiz\",\"description\":\"Quiz\"},\"FormDomain\":[{\"id\":\"2\",\"form_id\":\"2\",\"domain_id\":\"2\",\"index_order\":null}],\"Question\":[{\"id\":\"4\",\"text\":\"Q1\",\"form_id\":\"2\",\"domain_id\":\"2\",\"option_type_id\":\"2\"},{\"id\":\"5\",\"text\":\"Q2\",\"form_id\":\"2\",\"domain_id\":\"2\",\"option_type_id\":\"2\"},{\"id\":\"6\",\"text\":\"Q3\",\"form_id\":\"2\",\"domain_id\":\"2\",\"option_type_id\":\"2\"}],\"QuestionCount\":{\"count\":3}},{\"Form\":{\"id\":\"3\",\"title\":\"Election Ballot 2014\",\"description\":\"\",\"form_type_id\":\"2\"},\"FormType\":{\"id\":\"2\",\"name\":\"Election Ballot\",\"description\":\"Election Ballot\"},\"FormDomain\":[{\"id\":\"3\",\"form_id\":\"3\",\"domain_id\":\"3\",\"index_order\":null}],\"Question\":[{\"id\":\"7\",\"text\":\"President\",\"form_id\":\"3\",\"domain_id\":\"3\",\"option_type_id\":\"2\"},{\"id\":\"8\",\"text\":\"Vice President\",\"form_id\":\"3\",\"domain_id\":\"3\",\"option_type_id\":\"2\"},{\"id\":\"9\",\"text\":\"Senators\",\"form_id\":\"3\",\"domain_id\":\"3\",\"option_type_id\":\"1\"}],\"QuestionCount\":{\"count\":3}},{\"Form\":{\"id\":\"1\",\"title\":\"Evaluation 1\",\"description\":\"\",\"form_type_id\":\"3\"},\"FormType\":{\"id\":\"3\",\"name\":\"Evaluation\",\"description\":\"Evaluation\"},\"FormDomain\":[{\"id\":\"1\",\"form_id\":\"1\",\"domain_id\":\"1\",\"index_order\":null}],\"Question\":[{\"id\":\"1\",\"text\":\"Q1\",\"form_id\":\"1\",\"domain_id\":\"1\",\"option_type_id\":\"2\"},{\"id\":\"2\",\"text\":\"Q2\",\"form_id\":\"1\",\"domain_id\":\"1\",\"option_type_id\":\"2\"},{\"id\":\"3\",\"text\":\"Q3\",\"form_id\":\"1\",\"domain_id\":\"1\",\"option_type_id\":\"2\"}],\"QuestionCount\":{\"count\":3}}]}','2020-06-03 08:02:56','2020-06-03 08:02:56','2020-06-03 08:02:56'),(16,'','','Quizzes','index','0','::1','2020-06-07 07:52:06','',200,'',0,'null','{\"href\":\"http:\\/\\/localhost\\/formbuilder\\/quizzes\\/index.json\",\"time_local\":\"Sun, 07 Jun 2020 07:52:07 +0200\",\"prev\":null,\"next\":null,\"last\":\"http:\\/\\/localhost\\/formbuilder\\/quizzes\\/index.json?page=1\",\"page\":1,\"pages\":1,\"count\":3,\"time_epoch\":\"1591509127\",\"protocol\":\"HTTP\\/1.1\",\"status\":\"ok\",\"feedback\":[{\"message\":\"Unable to establish class\",\"level\":\"warning\"}],\"version\":\"1.0.0\"}','{\"data\":{\"0\":{\"Quiz\":{\"id\":\"3\",\"form_id\":\"2\",\"key_id\":\"10\",\"examinee\":\"Dave\",\"created\":\"2014-03-03 13:29:18\"},\"Form\":{\"id\":\"2\",\"title\":\"Quiz 1\",\"description\":\"\",\"form_type_id\":\"1\"},\"Key\":{\"id\":\"10\",\"key_header_id\":\"2\",\"value\":\"75434a7cdfc\",\"status\":\"1\",\"status_str\":\"Used\"},\"QuizDetail\":[{\"id\":\"6\",\"quiz_id\":\"3\",\"question_id\":\"4\",\"option_id\":\"7\",\"answer\":null},{\"id\":\"7\",\"quiz_id\":\"3\",\"question_id\":\"5\",\"option_id\":\"1\",\"answer\":null},{\"id\":\"8\",\"quiz_id\":\"3\",\"question_id\":\"6\",\"option_id\":\"13\",\"answer\":null}]},\"1\":{\"Quiz\":{\"id\":\"1\",\"form_id\":\"2\",\"key_id\":\"6\",\"examinee\":\"Garry\",\"created\":\"2014-03-03 11:20:54\"},\"Form\":{\"id\":\"2\",\"title\":\"Quiz 1\",\"description\":\"\",\"form_type_id\":\"1\"},\"Key\":{\"id\":\"6\",\"key_header_id\":\"2\",\"value\":\"046aa1ec0ba\",\"status\":\"1\",\"status_str\":\"Used\"},\"QuizDetail\":[{\"id\":\"1\",\"quiz_id\":\"1\",\"question_id\":\"4\",\"option_id\":\"7\",\"answer\":null},{\"id\":\"2\",\"quiz_id\":\"1\",\"question_id\":\"5\",\"option_id\":\"10\",\"answer\":null},{\"id\":\"3\",\"quiz_id\":\"1\",\"question_id\":\"6\",\"option_id\":\"14\",\"answer\":null}]},\"2\":{\"Quiz\":{\"id\":\"2\",\"form_id\":\"2\",\"key_id\":\"8\",\"examinee\":\"Val\",\"created\":\"2014-03-03 13:23:48\"},\"Form\":{\"id\":\"2\",\"title\":\"Quiz 1\",\"description\":\"\",\"form_type_id\":\"1\"},\"Key\":{\"id\":\"8\",\"key_header_id\":\"2\",\"value\":\"8f5690ff90f\",\"status\":\"1\",\"status_str\":\"Used\"},\"QuizDetail\":[{\"id\":\"4\",\"quiz_id\":\"2\",\"question_id\":\"4\",\"option_id\":\"7\",\"answer\":null},{\"id\":\"5\",\"quiz_id\":\"2\",\"question_id\":\"6\",\"option_id\":\"15\",\"answer\":null}]},\"count\":3}}','2020-06-07 07:52:07','2020-06-07 07:52:07','2020-06-07 07:52:07'),(17,'','','Quizzes','index','0','::1','2020-06-07 07:52:30','',200,'',0,'null','{\"href\":\"http:\\/\\/localhost\\/formbuilder\\/quizzes\\/index.json\",\"time_local\":\"Sun, 07 Jun 2020 07:52:30 +0200\",\"prev\":null,\"next\":null,\"last\":\"http:\\/\\/localhost\\/formbuilder\\/quizzes\\/index.json?page=1\",\"page\":1,\"pages\":1,\"count\":3,\"time_epoch\":\"1591509150\",\"protocol\":\"HTTP\\/1.1\",\"status\":\"ok\",\"feedback\":[{\"message\":\"Unable to establish class\",\"level\":\"warning\"}],\"version\":\"1.0.0\"}','{\"data\":{\"0\":{\"Quiz\":{\"id\":\"3\",\"form_id\":\"2\",\"key_id\":\"10\",\"examinee\":\"Dave\",\"created\":\"2014-03-03 13:29:18\"},\"Form\":{\"id\":\"2\",\"title\":\"Quiz 1\",\"description\":\"\",\"form_type_id\":\"1\"},\"Key\":{\"id\":\"10\",\"key_header_id\":\"2\",\"value\":\"75434a7cdfc\",\"status\":\"1\",\"status_str\":\"Used\"},\"QuizDetail\":[{\"id\":\"6\",\"quiz_id\":\"3\",\"question_id\":\"4\",\"option_id\":\"7\",\"answer\":null},{\"id\":\"7\",\"quiz_id\":\"3\",\"question_id\":\"5\",\"option_id\":\"1\",\"answer\":null},{\"id\":\"8\",\"quiz_id\":\"3\",\"question_id\":\"6\",\"option_id\":\"13\",\"answer\":null}]},\"1\":{\"Quiz\":{\"id\":\"1\",\"form_id\":\"2\",\"key_id\":\"6\",\"examinee\":\"Garry\",\"created\":\"2014-03-03 11:20:54\"},\"Form\":{\"id\":\"2\",\"title\":\"Quiz 1\",\"description\":\"\",\"form_type_id\":\"1\"},\"Key\":{\"id\":\"6\",\"key_header_id\":\"2\",\"value\":\"046aa1ec0ba\",\"status\":\"1\",\"status_str\":\"Used\"},\"QuizDetail\":[{\"id\":\"1\",\"quiz_id\":\"1\",\"question_id\":\"4\",\"option_id\":\"7\",\"answer\":null},{\"id\":\"2\",\"quiz_id\":\"1\",\"question_id\":\"5\",\"option_id\":\"10\",\"answer\":null},{\"id\":\"3\",\"quiz_id\":\"1\",\"question_id\":\"6\",\"option_id\":\"14\",\"answer\":null}]},\"2\":{\"Quiz\":{\"id\":\"2\",\"form_id\":\"2\",\"key_id\":\"8\",\"examinee\":\"Val\",\"created\":\"2014-03-03 13:23:48\"},\"Form\":{\"id\":\"2\",\"title\":\"Quiz 1\",\"description\":\"\",\"form_type_id\":\"1\"},\"Key\":{\"id\":\"8\",\"key_header_id\":\"2\",\"value\":\"8f5690ff90f\",\"status\":\"1\",\"status_str\":\"Used\"},\"QuizDetail\":[{\"id\":\"4\",\"quiz_id\":\"2\",\"question_id\":\"4\",\"option_id\":\"7\",\"answer\":null},{\"id\":\"5\",\"quiz_id\":\"2\",\"question_id\":\"6\",\"option_id\":\"15\",\"answer\":null}]},\"count\":3}}','2020-06-07 07:52:30','2020-06-07 07:52:30','2020-06-07 07:52:30'),(18,'','','Forms','index','0','::1','2020-06-07 07:52:37','',200,'',0,'null','{\"href\":\"http:\\/\\/localhost\\/formbuilder\\/forms\\/index.json\",\"time_local\":\"Sun, 07 Jun 2020 07:52:37 +0200\",\"prev\":null,\"next\":null,\"last\":\"http:\\/\\/localhost\\/formbuilder\\/forms\\/index.json?page=1\",\"page\":1,\"pages\":1,\"count\":3,\"time_epoch\":\"1591509157\",\"protocol\":\"HTTP\\/1.1\",\"status\":\"ok\",\"feedback\":[{\"message\":\"Unable to establish class\",\"level\":\"warning\"}],\"version\":\"1.0.0\"}','{\"data\":[{\"Form\":{\"id\":\"2\",\"title\":\"Quiz 1\",\"description\":\"\",\"form_type_id\":\"1\"},\"FormType\":{\"id\":\"1\",\"name\":\"Quiz\",\"description\":\"Quiz\"},\"FormDomain\":[{\"id\":\"2\",\"form_id\":\"2\",\"domain_id\":\"2\",\"index_order\":null}],\"Question\":[{\"id\":\"4\",\"text\":\"Q1\",\"form_id\":\"2\",\"domain_id\":\"2\",\"option_type_id\":\"2\"},{\"id\":\"5\",\"text\":\"Q2\",\"form_id\":\"2\",\"domain_id\":\"2\",\"option_type_id\":\"2\"},{\"id\":\"6\",\"text\":\"Q3\",\"form_id\":\"2\",\"domain_id\":\"2\",\"option_type_id\":\"2\"}],\"QuestionCount\":{\"count\":3}},{\"Form\":{\"id\":\"3\",\"title\":\"Election Ballot 2014\",\"description\":\"\",\"form_type_id\":\"2\"},\"FormType\":{\"id\":\"2\",\"name\":\"Election Ballot\",\"description\":\"Election Ballot\"},\"FormDomain\":[{\"id\":\"3\",\"form_id\":\"3\",\"domain_id\":\"3\",\"index_order\":null}],\"Question\":[{\"id\":\"7\",\"text\":\"President\",\"form_id\":\"3\",\"domain_id\":\"3\",\"option_type_id\":\"2\"},{\"id\":\"8\",\"text\":\"Vice President\",\"form_id\":\"3\",\"domain_id\":\"3\",\"option_type_id\":\"2\"},{\"id\":\"9\",\"text\":\"Senators\",\"form_id\":\"3\",\"domain_id\":\"3\",\"option_type_id\":\"1\"}],\"QuestionCount\":{\"count\":3}},{\"Form\":{\"id\":\"1\",\"title\":\"Evaluation 1\",\"description\":\"\",\"form_type_id\":\"3\"},\"FormType\":{\"id\":\"3\",\"name\":\"Evaluation\",\"description\":\"Evaluation\"},\"FormDomain\":[{\"id\":\"1\",\"form_id\":\"1\",\"domain_id\":\"1\",\"index_order\":null}],\"Question\":[{\"id\":\"1\",\"text\":\"Q1\",\"form_id\":\"1\",\"domain_id\":\"1\",\"option_type_id\":\"2\"},{\"id\":\"2\",\"text\":\"Q2\",\"form_id\":\"1\",\"domain_id\":\"1\",\"option_type_id\":\"2\"},{\"id\":\"3\",\"text\":\"Q3\",\"form_id\":\"1\",\"domain_id\":\"1\",\"option_type_id\":\"2\"}],\"QuestionCount\":{\"count\":3}}]}','2020-06-07 07:52:37','2020-06-07 07:52:37','2020-06-07 07:52:37'),(19,'','','Forms','index','0','::1','2020-08-05 21:11:25','',200,'',0,'null','{\"href\":\"http:\\/\\/localhost\\/formbuilder\\/forms\\/index.json\",\"time_local\":\"Wed, 05 Aug 2020 21:11:25 +0200\",\"prev\":null,\"next\":null,\"last\":\"http:\\/\\/localhost\\/formbuilder\\/forms\\/index.json?page=1\",\"page\":1,\"pages\":1,\"count\":4,\"time_epoch\":\"1596654685\",\"protocol\":\"HTTP\\/1.1\",\"status\":\"ok\",\"feedback\":[{\"message\":\"Unable to establish class\",\"level\":\"warning\"}],\"version\":\"1.0.0\"}','{\"data\":[{\"Form\":{\"id\":\"2\",\"title\":\"Quiz 1\",\"description\":\"\",\"form_type_id\":\"1\"},\"FormType\":{\"id\":\"1\",\"name\":\"Quiz\",\"description\":\"Quiz\"},\"FormDomain\":[{\"id\":\"2\",\"form_id\":\"2\",\"domain_id\":\"2\",\"index_order\":null}],\"Question\":[{\"id\":\"4\",\"text\":\"Q1\",\"form_id\":\"2\",\"domain_id\":\"2\",\"option_type_id\":\"2\"},{\"id\":\"5\",\"text\":\"Q2\",\"form_id\":\"2\",\"domain_id\":\"2\",\"option_type_id\":\"2\"},{\"id\":\"6\",\"text\":\"Q3\",\"form_id\":\"2\",\"domain_id\":\"2\",\"option_type_id\":\"2\"}],\"QuestionCount\":{\"count\":3}},{\"Form\":{\"id\":\"4\",\"title\":\"Sample Quiz No. 1\",\"description\":\"Sample Quiz No. 1\",\"form_type_id\":\"1\"},\"FormType\":{\"id\":\"1\",\"name\":\"Quiz\",\"description\":\"Quiz\"},\"FormDomain\":[],\"Question\":[],\"QuestionCount\":{\"count\":0}},{\"Form\":{\"id\":\"3\",\"title\":\"Election Ballot 2014\",\"description\":\"\",\"form_type_id\":\"2\"},\"FormType\":{\"id\":\"2\",\"name\":\"Election Ballot\",\"description\":\"Election Ballot\"},\"FormDomain\":[{\"id\":\"3\",\"form_id\":\"3\",\"domain_id\":\"3\",\"index_order\":null}],\"Question\":[{\"id\":\"7\",\"text\":\"President\",\"form_id\":\"3\",\"domain_id\":\"3\",\"option_type_id\":\"2\"},{\"id\":\"8\",\"text\":\"Vice President\",\"form_id\":\"3\",\"domain_id\":\"3\",\"option_type_id\":\"2\"},{\"id\":\"9\",\"text\":\"Senators\",\"form_id\":\"3\",\"domain_id\":\"3\",\"option_type_id\":\"1\"}],\"QuestionCount\":{\"count\":3}},{\"Form\":{\"id\":\"1\",\"title\":\"Evaluation 1\",\"description\":\"\",\"form_type_id\":\"3\"},\"FormType\":{\"id\":\"3\",\"name\":\"Evaluation\",\"description\":\"Evaluation\"},\"FormDomain\":[{\"id\":\"1\",\"form_id\":\"1\",\"domain_id\":\"1\",\"index_order\":null}],\"Question\":[{\"id\":\"1\",\"text\":\"Q1\",\"form_id\":\"1\",\"domain_id\":\"1\",\"option_type_id\":\"2\"},{\"id\":\"2\",\"text\":\"Q2\",\"form_id\":\"1\",\"domain_id\":\"1\",\"option_type_id\":\"2\"},{\"id\":\"3\",\"text\":\"Q3\",\"form_id\":\"1\",\"domain_id\":\"1\",\"option_type_id\":\"2\"}],\"QuestionCount\":{\"count\":3}}]}','2020-08-05 21:11:25','2020-08-05 21:11:25','2020-08-05 21:11:25'),(20,'','','Forms','index','0','::1','2020-08-05 21:12:26','',200,'',0,'null','{\"href\":\"http:\\/\\/localhost\\/formbuilder\\/forms\\/index.json\",\"time_local\":\"Wed, 05 Aug 2020 21:12:26 +0200\",\"prev\":null,\"next\":null,\"last\":\"http:\\/\\/localhost\\/formbuilder\\/forms\\/index.json?page=1\",\"page\":1,\"pages\":1,\"count\":4,\"time_epoch\":\"1596654746\",\"protocol\":\"HTTP\\/1.1\",\"status\":\"ok\",\"feedback\":[{\"message\":\"Unable to establish class\",\"level\":\"warning\"}],\"version\":\"1.0.0\"}','{\"data\":[{\"Form\":{\"id\":\"2\",\"title\":\"Quiz 1\",\"description\":\"\",\"form_type_id\":\"1\"},\"FormType\":{\"id\":\"1\",\"name\":\"Quiz\",\"description\":\"Quiz\"},\"FormDomain\":[{\"id\":\"2\",\"form_id\":\"2\",\"domain_id\":\"2\",\"index_order\":null}],\"Question\":[{\"id\":\"4\",\"text\":\"Q1\",\"form_id\":\"2\",\"domain_id\":\"2\",\"option_type_id\":\"2\"},{\"id\":\"5\",\"text\":\"Q2\",\"form_id\":\"2\",\"domain_id\":\"2\",\"option_type_id\":\"2\"},{\"id\":\"6\",\"text\":\"Q3\",\"form_id\":\"2\",\"domain_id\":\"2\",\"option_type_id\":\"2\"}],\"QuestionCount\":{\"count\":3}},{\"Form\":{\"id\":\"4\",\"title\":\"Sample Quiz No. 1\",\"description\":\"Sample Quiz No. 1\",\"form_type_id\":\"1\"},\"FormType\":{\"id\":\"1\",\"name\":\"Quiz\",\"description\":\"Quiz\"},\"FormDomain\":[],\"Question\":[],\"QuestionCount\":{\"count\":0}},{\"Form\":{\"id\":\"3\",\"title\":\"Election Ballot 2014\",\"description\":\"\",\"form_type_id\":\"2\"},\"FormType\":{\"id\":\"2\",\"name\":\"Election Ballot\",\"description\":\"Election Ballot\"},\"FormDomain\":[{\"id\":\"3\",\"form_id\":\"3\",\"domain_id\":\"3\",\"index_order\":null}],\"Question\":[{\"id\":\"7\",\"text\":\"President\",\"form_id\":\"3\",\"domain_id\":\"3\",\"option_type_id\":\"2\"},{\"id\":\"8\",\"text\":\"Vice President\",\"form_id\":\"3\",\"domain_id\":\"3\",\"option_type_id\":\"2\"},{\"id\":\"9\",\"text\":\"Senators\",\"form_id\":\"3\",\"domain_id\":\"3\",\"option_type_id\":\"1\"}],\"QuestionCount\":{\"count\":3}},{\"Form\":{\"id\":\"1\",\"title\":\"Evaluation 1\",\"description\":\"\",\"form_type_id\":\"3\"},\"FormType\":{\"id\":\"3\",\"name\":\"Evaluation\",\"description\":\"Evaluation\"},\"FormDomain\":[{\"id\":\"1\",\"form_id\":\"1\",\"domain_id\":\"1\",\"index_order\":null}],\"Question\":[{\"id\":\"1\",\"text\":\"Q1\",\"form_id\":\"1\",\"domain_id\":\"1\",\"option_type_id\":\"2\"},{\"id\":\"2\",\"text\":\"Q2\",\"form_id\":\"1\",\"domain_id\":\"1\",\"option_type_id\":\"2\"},{\"id\":\"3\",\"text\":\"Q3\",\"form_id\":\"1\",\"domain_id\":\"1\",\"option_type_id\":\"2\"}],\"QuestionCount\":{\"count\":3}}]}','2020-08-05 21:12:26','2020-08-05 21:12:26','2020-08-05 21:12:26');

/*Table structure for table `school_years` */

DROP TABLE IF EXISTS `school_years`;

CREATE TABLE `school_years` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(9) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2021 DEFAULT CHARSET=latin1;

/*Data for the table `school_years` */

insert  into `school_years`(`id`,`name`,`is_default`) values (2013,'2013-2014',0),(2014,'2014-2015',0),(2015,'2015-2016',0),(2016,'2016-2017',0),(2017,'2017-2018',0),(2018,'2018-2019',0),(2019,'2019-2020',1),(2020,'2020-2021',1);

/*Table structure for table `systems_defaults` */

DROP TABLE IF EXISTS `systems_defaults`;

CREATE TABLE `systems_defaults` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field` varchar(50) NOT NULL,
  `value` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `systems_defaults` */

insert  into `systems_defaults`(`id`,`field`,`value`) values (1,'SCHOOL_NAME','Holy Trinity Academy'),(2,'SCHOOL_ALIAS','HTA'),(3,'SCHOOL_LOGO','tmplt/hta.png'),(4,'SY_START','2012'),(5,'SY_ACTIVE','2012'),(6,'SEM_START','1'),(7,'SEM_ACTIVE','1'),(8,'PERIOD_START','1'),(9,'PERIOD_ACTIVE','1'),(10,'ISMS_LOGO','isms.logo.png'),(11,'ISMS_ICON','/isms/img/isms.ico.png');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `last_name` varchar(75) DEFAULT NULL,
  `first_name` varchar(75) DEFAULT NULL,
  `middle_name` varchar(75) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`last_name`,`first_name`,`middle_name`,`modified`,`created`) values (1,'superuser','8ed5503e0eb2706a0f78b2f1c19d6d53a654801d',NULL,NULL,NULL,'2020-08-05 21:07:56','2014-04-30 10:48:10'),(2,'adminuser','8ed5503e0eb2706a0f78b2f1c19d6d53a654801d',NULL,NULL,NULL,'2014-04-30 10:50:06','2014-04-30 10:50:06'),(3,'useruser','8ed5503e0eb2706a0f78b2f1c19d6d53a654801d','User','User','User','2014-04-30 11:21:39','2014-04-30 10:51:03'),(4,'paulo','8ed5503e0eb2706a0f78b2f1c19d6d53a654801d','Biscocho','Paulo','T','2020-06-03 06:59:36','2020-06-03 06:59:36');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
