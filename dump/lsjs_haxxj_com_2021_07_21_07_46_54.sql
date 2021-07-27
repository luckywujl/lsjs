-- MySQL dump 10.13  Distrib 8.0.16, for linux-glibc2.12 (x86_64)
--
-- Host: localhost    Database: lsjs_haxxj_com
-- ------------------------------------------------------
-- Server version	8.0.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `lsjs_admin`
--

DROP TABLE IF EXISTS `lsjs_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lsjs_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '用户名',
  `nickname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '昵称',
  `password` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '密码',
  `salt` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '密码盐',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '头像',
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '电子邮箱',
  `loginfailure` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '失败次数',
  `logintime` int(10) DEFAULT NULL COMMENT '登录时间',
  `loginip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '登录IP',
  `createtime` int(10) DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(10) DEFAULT NULL COMMENT '更新时间',
  `token` varchar(59) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'Session标识',
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal' COMMENT '状态',
  `company_id` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '数据归属',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsjs_admin`
--

LOCK TABLES `lsjs_admin` WRITE;
/*!40000 ALTER TABLE `lsjs_admin` DISABLE KEYS */;
INSERT INTO `lsjs_admin` VALUES (1,'admin','Admin','218ca8d77fb63391333d6cf3ba94ef91','1872a3','/uploads/20210517/ffbdabe1c2b351d6cdc0da2fe8b6d71b.jpg','admin@admin.com',0,1621267556,'127.0.0.1',1491635035,1621267556,'86e988bf-6b26-4b2a-a816-daa9a7618501','normal',NULL),(2,'1001','管理员','04f31f2288a5e3598dd51700ace31762','QxH80O','/uploads/20210518/00938e8174d7ec682e3a58fe1751c2bb.jpg','1001@qq.com',0,1621270046,'192.168.0.102',1621267505,1621270046,'29b09e32-6889-46ad-b149-89015db9644b','normal','2');
/*!40000 ALTER TABLE `lsjs_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsjs_admin_log`
--

DROP TABLE IF EXISTS `lsjs_admin_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lsjs_admin_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `admin_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `username` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '管理员名字',
  `url` varchar(1500) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '操作页面',
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '日志标题',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '内容',
  `ip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'IP',
  `useragent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'User-Agent',
  `createtime` int(10) DEFAULT NULL COMMENT '操作时间',
  PRIMARY KEY (`id`),
  KEY `name` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理员日志表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsjs_admin_log`
--

LOCK TABLES `lsjs_admin_log` WRITE;
/*!40000 ALTER TABLE `lsjs_admin_log` DISABLE KEYS */;
INSERT INTO `lsjs_admin_log` VALUES (1,0,'Unknown','/kFsbVjKLge.php/index/login?url=%2FkFsbVjKLge.php','','{\"url\":\"\\/kFsbVjKLge.php\",\"__token__\":\"***\",\"username\":\"admin\",\"password\":\"***\",\"captcha\":\"fk5w\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1619536242),(2,0,'Unknown','/kFsbVjKLge.php/index/login?url=%2FkFsbVjKLge.php','','{\"url\":\"\\/kFsbVjKLge.php\",\"__token__\":\"***\",\"username\":\"admin\",\"password\":\"***\",\"captcha\":\"fk5w\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1619536244),(3,1,'admin','/kFsbVjKLge.php/index/login','登录','{\"__token__\":\"***\",\"username\":\"admin\",\"password\":\"***\",\"captcha\":\"WDJD\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1619536260),(4,1,'admin','/kFsbVjKLge.php/index/login','登录','{\"__token__\":\"***\",\"username\":\"admin\",\"password\":\"***\",\"captcha\":\"r8qe\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621264022),(5,1,'admin','/kFsbVjKLge.php/ajax/upload','','[]','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621264384),(6,1,'admin','/kFsbVjKLge.php/general.profile/update','常规管理 / 个人资料 / 更新个人信息','{\"__token__\":\"***\",\"row\":{\"avatar\":\"\\/uploads\\/20210517\\/ffbdabe1c2b351d6cdc0da2fe8b6d71b.jpg\",\"email\":\"admin@admin.com\",\"nickname\":\"Admin\",\"password\":\"***\"}}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621264386),(7,1,'admin','/kFsbVjKLge.php/index/login','登录','{\"__token__\":\"***\",\"username\":\"admin\",\"password\":\"***\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621264686),(8,1,'admin','/kFsbVjKLge.php/addon/install','插件管理','{\"name\":\"command\",\"force\":\"0\",\"uid\":\"25581\",\"token\":\"***\",\"version\":\"1.0.6\",\"faversion\":\"1.2.0.20210401_beta\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621266947),(9,1,'admin','/kFsbVjKLge.php/command/get_field_list','在线命令管理','{\"table\":\"lsjs_admin\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621266952),(10,1,'admin','/kFsbVjKLge.php/command/get_field_list','在线命令管理','{\"table\":\"lsjs_base_custom_type\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621266961),(11,1,'admin','/kFsbVjKLge.php/command/command/action/command','在线命令管理','{\"commandtype\":\"crud\",\"isrelation\":\"0\",\"local\":\"1\",\"delete\":\"0\",\"force\":\"1\",\"table\":\"lsjs_base_custom_type\",\"controller\":\"base\\/customtype\",\"model\":\"\",\"setcheckboxsuffix\":\"\",\"enumradiosuffix\":\"\",\"imagefield\":\"\",\"filefield\":\"\",\"intdatesuffix\":\"\",\"switchsuffix\":\"\",\"citysuffix\":\"\",\"selectpagesuffix\":\"\",\"selectpagessuffix\":\"\",\"ignorefields\":\"\",\"sortfield\":\"\",\"editorsuffix\":\"\",\"headingfilterfield\":\"\",\"action\":\"command\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621266979),(12,1,'admin','/kFsbVjKLge.php/command/command/action/execute','在线命令管理','{\"commandtype\":\"crud\",\"isrelation\":\"0\",\"local\":\"1\",\"delete\":\"0\",\"force\":\"1\",\"table\":\"lsjs_base_custom_type\",\"controller\":\"base\\/customtype\",\"model\":\"\",\"setcheckboxsuffix\":\"\",\"enumradiosuffix\":\"\",\"imagefield\":\"\",\"filefield\":\"\",\"intdatesuffix\":\"\",\"switchsuffix\":\"\",\"citysuffix\":\"\",\"selectpagesuffix\":\"\",\"selectpagessuffix\":\"\",\"ignorefields\":\"\",\"sortfield\":\"\",\"editorsuffix\":\"\",\"headingfilterfield\":\"\",\"action\":\"execute\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621266981),(13,1,'admin','/kFsbVjKLge.php/command/get_controller_list','在线命令管理','{\"q_word\":[\"\"],\"pageNumber\":\"1\",\"pageSize\":\"10\",\"andOr\":\"OR \",\"orderBy\":[[\"name\",\"ASC\"]],\"searchTable\":\"tbl\",\"showField\":\"name\",\"keyField\":\"id\",\"searchField\":[\"name\"],\"name\":\"\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621266988),(14,1,'admin','/kFsbVjKLge.php/command/get_controller_list','在线命令管理','{\"q_word\":[\"\"],\"pageNumber\":\"2\",\"pageSize\":\"10\",\"andOr\":\"OR \",\"orderBy\":[[\"name\",\"ASC\"]],\"searchTable\":\"tbl\",\"showField\":\"name\",\"keyField\":\"id\",\"searchField\":[\"name\"],\"name\":\"\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621266992),(15,1,'admin','/kFsbVjKLge.php/command/get_controller_list','在线命令管理','{\"q_word\":[\"\"],\"pageNumber\":\"1\",\"pageSize\":\"10\",\"andOr\":\"OR \",\"orderBy\":[[\"name\",\"ASC\"]],\"searchTable\":\"tbl\",\"showField\":\"name\",\"keyField\":\"id\",\"searchField\":[\"name\"],\"name\":\"\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621266996),(16,1,'admin','/kFsbVjKLge.php/command/get_controller_list','在线命令管理','{\"q_word\":[\"\"],\"pageNumber\":\"1\",\"pageSize\":\"10\",\"andOr\":\"OR \",\"orderBy\":[[\"name\",\"ASC\"]],\"searchTable\":\"tbl\",\"showField\":\"name\",\"keyField\":\"id\",\"searchField\":[\"name\"],\"name\":\"\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621266998),(17,1,'admin','/kFsbVjKLge.php/command/command/action/command','在线命令管理','{\"commandtype\":\"menu\",\"allcontroller\":\"0\",\"delete\":\"0\",\"force\":\"1\",\"controllerfile_text\":\"\",\"controllerfile\":\"base\\/Customtype.php\",\"action\":\"command\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267001),(18,1,'admin','/kFsbVjKLge.php/command/command/action/execute','在线命令管理','{\"commandtype\":\"menu\",\"allcontroller\":\"0\",\"delete\":\"0\",\"force\":\"1\",\"controllerfile_text\":\"\",\"controllerfile\":\"base\\/Customtype.php\",\"action\":\"execute\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267003),(19,1,'admin','/kFsbVjKLge.php/command/get_field_list','在线命令管理','{\"table\":\"lsjs_base_install_place\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267017),(20,1,'admin','/kFsbVjKLge.php/command/command/action/command','在线命令管理','{\"commandtype\":\"crud\",\"isrelation\":\"0\",\"local\":\"1\",\"delete\":\"0\",\"force\":\"1\",\"table\":\"lsjs_base_install_place\",\"controller\":\"base\\/installplace\",\"model\":\"\",\"setcheckboxsuffix\":\"\",\"enumradiosuffix\":\"\",\"imagefield\":\"\",\"filefield\":\"\",\"intdatesuffix\":\"\",\"switchsuffix\":\"\",\"citysuffix\":\"\",\"selectpagesuffix\":\"\",\"selectpagessuffix\":\"\",\"ignorefields\":\"\",\"sortfield\":\"\",\"editorsuffix\":\"\",\"headingfilterfield\":\"\",\"action\":\"command\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267028),(21,1,'admin','/kFsbVjKLge.php/command/command/action/execute','在线命令管理','{\"commandtype\":\"crud\",\"isrelation\":\"0\",\"local\":\"1\",\"delete\":\"0\",\"force\":\"1\",\"table\":\"lsjs_base_install_place\",\"controller\":\"base\\/installplace\",\"model\":\"\",\"setcheckboxsuffix\":\"\",\"enumradiosuffix\":\"\",\"imagefield\":\"\",\"filefield\":\"\",\"intdatesuffix\":\"\",\"switchsuffix\":\"\",\"citysuffix\":\"\",\"selectpagesuffix\":\"\",\"selectpagessuffix\":\"\",\"ignorefields\":\"\",\"sortfield\":\"\",\"editorsuffix\":\"\",\"headingfilterfield\":\"\",\"action\":\"execute\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267029),(22,1,'admin','/kFsbVjKLge.php/command/get_field_list','在线命令管理','{\"table\":\"lsjs_base_install_type\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267034),(23,1,'admin','/kFsbVjKLge.php/command/command/action/command','在线命令管理','{\"commandtype\":\"crud\",\"isrelation\":\"0\",\"local\":\"1\",\"delete\":\"0\",\"force\":\"1\",\"table\":\"lsjs_base_install_type\",\"controller\":\"base\\/installtype\",\"model\":\"\",\"setcheckboxsuffix\":\"\",\"enumradiosuffix\":\"\",\"imagefield\":\"\",\"filefield\":\"\",\"intdatesuffix\":\"\",\"switchsuffix\":\"\",\"citysuffix\":\"\",\"selectpagesuffix\":\"\",\"selectpagessuffix\":\"\",\"ignorefields\":\"\",\"sortfield\":\"\",\"editorsuffix\":\"\",\"headingfilterfield\":\"\",\"action\":\"command\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267042),(24,1,'admin','/kFsbVjKLge.php/command/command/action/execute','在线命令管理','{\"commandtype\":\"crud\",\"isrelation\":\"0\",\"local\":\"1\",\"delete\":\"0\",\"force\":\"1\",\"table\":\"lsjs_base_install_type\",\"controller\":\"base\\/installtype\",\"model\":\"\",\"setcheckboxsuffix\":\"\",\"enumradiosuffix\":\"\",\"imagefield\":\"\",\"filefield\":\"\",\"intdatesuffix\":\"\",\"switchsuffix\":\"\",\"citysuffix\":\"\",\"selectpagesuffix\":\"\",\"selectpagessuffix\":\"\",\"ignorefields\":\"\",\"sortfield\":\"\",\"editorsuffix\":\"\",\"headingfilterfield\":\"\",\"action\":\"execute\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267043),(25,1,'admin','/kFsbVjKLge.php/command/get_field_list','在线命令管理','{\"table\":\"lsjs_base_production_info\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267047),(26,1,'admin','/kFsbVjKLge.php/command/command/action/command','在线命令管理','{\"commandtype\":\"crud\",\"isrelation\":\"0\",\"local\":\"1\",\"delete\":\"0\",\"force\":\"1\",\"table\":\"lsjs_base_production_info\",\"controller\":\"base\\/production\",\"model\":\"\",\"setcheckboxsuffix\":\"\",\"enumradiosuffix\":\"\",\"imagefield\":\"\",\"filefield\":\"\",\"intdatesuffix\":\"\",\"switchsuffix\":\"\",\"citysuffix\":\"\",\"selectpagesuffix\":\"\",\"selectpagessuffix\":\"\",\"ignorefields\":\"\",\"sortfield\":\"\",\"editorsuffix\":\"\",\"headingfilterfield\":\"\",\"action\":\"command\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267058),(27,1,'admin','/kFsbVjKLge.php/command/command/action/execute','在线命令管理','{\"commandtype\":\"crud\",\"isrelation\":\"0\",\"local\":\"1\",\"delete\":\"0\",\"force\":\"1\",\"table\":\"lsjs_base_production_info\",\"controller\":\"base\\/production\",\"model\":\"\",\"setcheckboxsuffix\":\"\",\"enumradiosuffix\":\"\",\"imagefield\":\"\",\"filefield\":\"\",\"intdatesuffix\":\"\",\"switchsuffix\":\"\",\"citysuffix\":\"\",\"selectpagesuffix\":\"\",\"selectpagessuffix\":\"\",\"ignorefields\":\"\",\"sortfield\":\"\",\"editorsuffix\":\"\",\"headingfilterfield\":\"\",\"action\":\"execute\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267059),(28,1,'admin','/kFsbVjKLge.php/command/get_field_list','在线命令管理','{\"table\":\"lsjs_base_purpose\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267063),(29,1,'admin','/kFsbVjKLge.php/command/command/action/command','在线命令管理','{\"commandtype\":\"crud\",\"isrelation\":\"0\",\"local\":\"1\",\"delete\":\"0\",\"force\":\"1\",\"table\":\"lsjs_base_purpose\",\"controller\":\"base\\/purpose\",\"model\":\"\",\"setcheckboxsuffix\":\"\",\"enumradiosuffix\":\"\",\"imagefield\":\"\",\"filefield\":\"\",\"intdatesuffix\":\"\",\"switchsuffix\":\"\",\"citysuffix\":\"\",\"selectpagesuffix\":\"\",\"selectpagessuffix\":\"\",\"ignorefields\":\"\",\"sortfield\":\"\",\"editorsuffix\":\"\",\"headingfilterfield\":\"\",\"action\":\"command\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267071),(30,1,'admin','/kFsbVjKLge.php/command/command/action/execute','在线命令管理','{\"commandtype\":\"crud\",\"isrelation\":\"0\",\"local\":\"1\",\"delete\":\"0\",\"force\":\"1\",\"table\":\"lsjs_base_purpose\",\"controller\":\"base\\/purpose\",\"model\":\"\",\"setcheckboxsuffix\":\"\",\"enumradiosuffix\":\"\",\"imagefield\":\"\",\"filefield\":\"\",\"intdatesuffix\":\"\",\"switchsuffix\":\"\",\"citysuffix\":\"\",\"selectpagesuffix\":\"\",\"selectpagessuffix\":\"\",\"ignorefields\":\"\",\"sortfield\":\"\",\"editorsuffix\":\"\",\"headingfilterfield\":\"\",\"action\":\"execute\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267072),(31,1,'admin','/kFsbVjKLge.php/command/get_field_list','在线命令管理','{\"table\":\"lsjs_base_sale_type\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267076),(32,1,'admin','/kFsbVjKLge.php/command/command/action/command','在线命令管理','{\"commandtype\":\"crud\",\"isrelation\":\"0\",\"local\":\"1\",\"delete\":\"0\",\"force\":\"1\",\"table\":\"lsjs_base_sale_type\",\"controller\":\"base\\/saletype\",\"model\":\"\",\"setcheckboxsuffix\":\"\",\"enumradiosuffix\":\"\",\"imagefield\":\"\",\"filefield\":\"\",\"intdatesuffix\":\"\",\"switchsuffix\":\"\",\"citysuffix\":\"\",\"selectpagesuffix\":\"\",\"selectpagessuffix\":\"\",\"ignorefields\":\"\",\"sortfield\":\"\",\"editorsuffix\":\"\",\"headingfilterfield\":\"\",\"action\":\"command\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267082),(33,1,'admin','/kFsbVjKLge.php/command/command/action/execute','在线命令管理','{\"commandtype\":\"crud\",\"isrelation\":\"0\",\"local\":\"1\",\"delete\":\"0\",\"force\":\"1\",\"table\":\"lsjs_base_sale_type\",\"controller\":\"base\\/saletype\",\"model\":\"\",\"setcheckboxsuffix\":\"\",\"enumradiosuffix\":\"\",\"imagefield\":\"\",\"filefield\":\"\",\"intdatesuffix\":\"\",\"switchsuffix\":\"\",\"citysuffix\":\"\",\"selectpagesuffix\":\"\",\"selectpagessuffix\":\"\",\"ignorefields\":\"\",\"sortfield\":\"\",\"editorsuffix\":\"\",\"headingfilterfield\":\"\",\"action\":\"execute\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267084),(34,1,'admin','/kFsbVjKLge.php/command/get_field_list','在线命令管理','{\"table\":\"lsjs_base_service_type\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267087),(35,1,'admin','/kFsbVjKLge.php/command/command/action/command','在线命令管理','{\"commandtype\":\"crud\",\"isrelation\":\"0\",\"local\":\"1\",\"delete\":\"0\",\"force\":\"1\",\"table\":\"lsjs_base_service_type\",\"controller\":\"base\\/servicetype\",\"model\":\"\",\"setcheckboxsuffix\":\"\",\"enumradiosuffix\":\"\",\"imagefield\":\"\",\"filefield\":\"\",\"intdatesuffix\":\"\",\"switchsuffix\":\"\",\"citysuffix\":\"\",\"selectpagesuffix\":\"\",\"selectpagessuffix\":\"\",\"ignorefields\":\"\",\"sortfield\":\"\",\"editorsuffix\":\"\",\"headingfilterfield\":\"\",\"action\":\"command\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267098),(36,1,'admin','/kFsbVjKLge.php/command/command/action/execute','在线命令管理','{\"commandtype\":\"crud\",\"isrelation\":\"0\",\"local\":\"1\",\"delete\":\"0\",\"force\":\"1\",\"table\":\"lsjs_base_service_type\",\"controller\":\"base\\/servicetype\",\"model\":\"\",\"setcheckboxsuffix\":\"\",\"enumradiosuffix\":\"\",\"imagefield\":\"\",\"filefield\":\"\",\"intdatesuffix\":\"\",\"switchsuffix\":\"\",\"citysuffix\":\"\",\"selectpagesuffix\":\"\",\"selectpagessuffix\":\"\",\"ignorefields\":\"\",\"sortfield\":\"\",\"editorsuffix\":\"\",\"headingfilterfield\":\"\",\"action\":\"execute\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267099),(37,1,'admin','/kFsbVjKLge.php/command/get_field_list','在线命令管理','{\"table\":\"lsjs_admin\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267154),(38,1,'admin','/kFsbVjKLge.php/command/get_field_list','在线命令管理','{\"table\":\"lsjs_base_service_valuation\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267159),(39,1,'admin','/kFsbVjKLge.php/command/command/action/command','在线命令管理','{\"commandtype\":\"crud\",\"isrelation\":\"0\",\"local\":\"1\",\"delete\":\"0\",\"force\":\"1\",\"table\":\"lsjs_base_service_valuation\",\"controller\":\"base\\/servicevaluation\",\"model\":\"\",\"setcheckboxsuffix\":\"\",\"enumradiosuffix\":\"\",\"imagefield\":\"\",\"filefield\":\"\",\"intdatesuffix\":\"\",\"switchsuffix\":\"\",\"citysuffix\":\"\",\"selectpagesuffix\":\"\",\"selectpagessuffix\":\"\",\"ignorefields\":\"\",\"sortfield\":\"\",\"editorsuffix\":\"\",\"headingfilterfield\":\"\",\"action\":\"command\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267172),(40,1,'admin','/kFsbVjKLge.php/command/command/action/execute','在线命令管理','{\"commandtype\":\"crud\",\"isrelation\":\"0\",\"local\":\"1\",\"delete\":\"0\",\"force\":\"1\",\"table\":\"lsjs_base_service_valuation\",\"controller\":\"base\\/servicevaluation\",\"model\":\"\",\"setcheckboxsuffix\":\"\",\"enumradiosuffix\":\"\",\"imagefield\":\"\",\"filefield\":\"\",\"intdatesuffix\":\"\",\"switchsuffix\":\"\",\"citysuffix\":\"\",\"selectpagesuffix\":\"\",\"selectpagessuffix\":\"\",\"ignorefields\":\"\",\"sortfield\":\"\",\"editorsuffix\":\"\",\"headingfilterfield\":\"\",\"action\":\"execute\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267173),(41,1,'admin','/kFsbVjKLge.php/command/get_controller_list','在线命令管理','{\"q_word\":[\"\"],\"pageNumber\":\"1\",\"pageSize\":\"10\",\"andOr\":\"OR \",\"orderBy\":[[\"name\",\"ASC\"]],\"searchTable\":\"tbl\",\"showField\":\"name\",\"keyField\":\"id\",\"searchField\":[\"name\"],\"name\":\"\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267176),(42,1,'admin','/kFsbVjKLge.php/command/get_controller_list','在线命令管理','{\"q_word\":[\"\"],\"pageNumber\":\"1\",\"pageSize\":\"10\",\"andOr\":\"OR \",\"orderBy\":[[\"name\",\"ASC\"]],\"searchTable\":\"tbl\",\"showField\":\"name\",\"keyField\":\"id\",\"searchField\":[\"name\"],\"name\":\"\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267179),(43,1,'admin','/kFsbVjKLge.php/command/get_controller_list','在线命令管理','{\"q_word\":[\"\"],\"pageNumber\":\"1\",\"pageSize\":\"10\",\"andOr\":\"OR \",\"orderBy\":[[\"name\",\"ASC\"]],\"searchTable\":\"tbl\",\"showField\":\"name\",\"keyField\":\"id\",\"searchField\":[\"name\"],\"name\":\"\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267180),(44,1,'admin','/kFsbVjKLge.php/command/get_controller_list','在线命令管理','{\"q_word\":[\"\"],\"pageNumber\":\"1\",\"pageSize\":\"10\",\"andOr\":\"OR \",\"orderBy\":[[\"name\",\"ASC\"]],\"searchTable\":\"tbl\",\"showField\":\"name\",\"keyField\":\"id\",\"searchField\":[\"name\"],\"name\":\"\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267185),(45,1,'admin','/kFsbVjKLge.php/command/get_controller_list','在线命令管理','{\"q_word\":[\"\"],\"pageNumber\":\"1\",\"pageSize\":\"10\",\"andOr\":\"OR \",\"orderBy\":[[\"name\",\"ASC\"]],\"searchTable\":\"tbl\",\"showField\":\"name\",\"keyField\":\"id\",\"searchField\":[\"name\"],\"name\":\"\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267186),(46,1,'admin','/kFsbVjKLge.php/command/get_controller_list','在线命令管理','{\"q_word\":[\"\"],\"pageNumber\":\"1\",\"pageSize\":\"10\",\"andOr\":\"OR \",\"orderBy\":[[\"name\",\"ASC\"]],\"searchTable\":\"tbl\",\"showField\":\"name\",\"keyField\":\"id\",\"searchField\":[\"name\"],\"name\":\"\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267187),(47,1,'admin','/kFsbVjKLge.php/command/get_controller_list','在线命令管理','{\"q_word\":[\"\"],\"pageNumber\":\"1\",\"pageSize\":\"10\",\"andOr\":\"OR \",\"orderBy\":[[\"name\",\"ASC\"]],\"searchTable\":\"tbl\",\"showField\":\"name\",\"keyField\":\"id\",\"searchField\":[\"name\"],\"name\":\"\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267188),(48,1,'admin','/kFsbVjKLge.php/command/get_controller_list','在线命令管理','{\"q_word\":[\"\"],\"pageNumber\":\"1\",\"pageSize\":\"10\",\"andOr\":\"OR \",\"orderBy\":[[\"name\",\"ASC\"]],\"searchTable\":\"tbl\",\"showField\":\"name\",\"keyField\":\"id\",\"searchField\":[\"name\"],\"name\":\"\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267189),(49,1,'admin','/kFsbVjKLge.php/command/get_controller_list','在线命令管理','{\"q_word\":[\"\"],\"pageNumber\":\"1\",\"pageSize\":\"10\",\"andOr\":\"OR \",\"orderBy\":[[\"name\",\"ASC\"]],\"searchTable\":\"tbl\",\"showField\":\"name\",\"keyField\":\"id\",\"searchField\":[\"name\"],\"name\":\"\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267195),(50,1,'admin','/kFsbVjKLge.php/command/command/action/command','在线命令管理','{\"commandtype\":\"menu\",\"allcontroller\":\"0\",\"delete\":\"0\",\"force\":\"1\",\"controllerfile_text\":\"\",\"controllerfile\":\"base\\/Servicevaluation.php,base\\/Installtype.php,base\\/Saletype.php,base\\/Servicetype.php,base\\/Production.php,base\\/Purpose.php,base\\/Installplace.php,base\\/Customtype.php\",\"action\":\"command\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267197),(51,1,'admin','/kFsbVjKLge.php/command/command/action/execute','在线命令管理','{\"commandtype\":\"menu\",\"allcontroller\":\"0\",\"delete\":\"0\",\"force\":\"1\",\"controllerfile_text\":\"\",\"controllerfile\":\"base\\/Servicevaluation.php,base\\/Installtype.php,base\\/Saletype.php,base\\/Servicetype.php,base\\/Production.php,base\\/Purpose.php,base\\/Installplace.php,base\\/Customtype.php\",\"action\":\"execute\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267201),(52,1,'admin','/kFsbVjKLge.php/auth/rule/edit/ids/92?dialog=1','权限管理 / 菜单规则 / 编辑','{\"dialog\":\"1\",\"__token__\":\"***\",\"row\":{\"ismenu\":\"1\",\"pid\":\"0\",\"name\":\"base\",\"title\":\"基础资料\",\"url\":\"\",\"icon\":\"fa fa-list\",\"weigh\":\"142\",\"condition\":\"\",\"menutype\":\"addtabs\",\"extend\":\"\",\"remark\":\"\",\"status\":\"normal\"},\"ids\":\"92\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267248),(53,1,'admin','/kFsbVjKLge.php/ajax/weigh','','{\"ids\":\"1,92,128,93,100,107,114,121,135,142,2,6,7,8,3,5,9,10,11,12,4,66,67,73,79,85\",\"changeid\":\"128\",\"pid\":\"92\",\"field\":\"weigh\",\"orderway\":\"desc\",\"table\":\"auth_rule\",\"pk\":\"id\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267310),(54,1,'admin','/kFsbVjKLge.php/ajax/weigh','','{\"ids\":\"1,92,128,93,100,107,114,121,135,142,2,6,7,8,3,5,9,10,11,12,4,66,67,73,79,85\",\"changeid\":\"128\",\"pid\":\"92\",\"field\":\"weigh\",\"orderway\":\"desc\",\"table\":\"auth_rule\",\"pk\":\"id\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267326),(55,1,'admin','/kFsbVjKLge.php/auth/rule/edit/ids/128?dialog=1','权限管理 / 菜单规则 / 编辑','{\"dialog\":\"1\",\"__token__\":\"***\",\"row\":{\"ismenu\":\"1\",\"pid\":\"92\",\"name\":\"base\\/production\",\"title\":\"产品信息\",\"url\":\"\",\"icon\":\"fa fa-circle-o\",\"weigh\":\"8\",\"condition\":\"\",\"menutype\":\"addtabs\",\"extend\":\"\",\"remark\":\"\",\"status\":\"normal\"},\"ids\":\"128\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267342),(56,1,'admin','/kFsbVjKLge.php/auth/rule/edit/ids/142?dialog=1','权限管理 / 菜单规则 / 编辑','{\"dialog\":\"1\",\"__token__\":\"***\",\"row\":{\"ismenu\":\"1\",\"pid\":\"92\",\"name\":\"base\\/installplace\",\"title\":\"安装位置\",\"url\":\"\",\"icon\":\"fa fa-circle-o\",\"weigh\":\"7\",\"condition\":\"\",\"menutype\":\"addtabs\",\"extend\":\"\",\"remark\":\"\",\"status\":\"normal\"},\"ids\":\"142\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267357),(57,1,'admin','/kFsbVjKLge.php/auth/rule/edit/ids/107?dialog=1','权限管理 / 菜单规则 / 编辑','{\"dialog\":\"1\",\"__token__\":\"***\",\"row\":{\"ismenu\":\"1\",\"pid\":\"92\",\"name\":\"base\\/installtype\",\"title\":\"安装管路\",\"url\":\"\",\"icon\":\"fa fa-circle-o\",\"weigh\":\"6\",\"condition\":\"\",\"menutype\":\"addtabs\",\"extend\":\"\",\"remark\":\"\",\"status\":\"normal\"},\"ids\":\"107\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267368),(58,1,'admin','/kFsbVjKLge.php/auth/rule/edit/ids/135?dialog=1','权限管理 / 菜单规则 / 编辑','{\"dialog\":\"1\",\"__token__\":\"***\",\"row\":{\"ismenu\":\"1\",\"pid\":\"92\",\"name\":\"base\\/purpose\",\"title\":\"净水用途\",\"url\":\"\",\"icon\":\"fa fa-circle-o\",\"weigh\":\"5\",\"condition\":\"\",\"menutype\":\"addtabs\",\"extend\":\"\",\"remark\":\"\",\"status\":\"normal\"},\"ids\":\"135\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267380),(59,1,'admin','/kFsbVjKLge.php/auth/rule/edit/ids/93?dialog=1','权限管理 / 菜单规则 / 编辑','{\"dialog\":\"1\",\"__token__\":\"***\",\"row\":{\"ismenu\":\"1\",\"pid\":\"92\",\"name\":\"base\\/customtype\",\"title\":\"客户类型\",\"url\":\"\",\"icon\":\"fa fa-circle-o\",\"weigh\":\"4\",\"condition\":\"\",\"menutype\":\"addtabs\",\"extend\":\"\",\"remark\":\"\",\"status\":\"normal\"},\"ids\":\"93\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267391),(60,1,'admin','/kFsbVjKLge.php/auth/rule/edit/ids/100?dialog=1','权限管理 / 菜单规则 / 编辑','{\"dialog\":\"1\",\"__token__\":\"***\",\"row\":{\"ismenu\":\"1\",\"pid\":\"92\",\"name\":\"base\\/servicevaluation\",\"title\":\"顾客评价\",\"url\":\"\",\"icon\":\"fa fa-circle-o\",\"weigh\":\"3\",\"condition\":\"\",\"menutype\":\"addtabs\",\"extend\":\"\",\"remark\":\"\",\"status\":\"normal\"},\"ids\":\"100\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267397),(61,1,'admin','/kFsbVjKLge.php/auth/rule/edit/ids/114?dialog=1','权限管理 / 菜单规则 / 编辑','{\"dialog\":\"1\",\"__token__\":\"***\",\"row\":{\"ismenu\":\"1\",\"pid\":\"92\",\"name\":\"base\\/saletype\",\"title\":\"销售渠道\",\"url\":\"\",\"icon\":\"fa fa-circle-o\",\"weigh\":\"2\",\"condition\":\"\",\"menutype\":\"addtabs\",\"extend\":\"\",\"remark\":\"\",\"status\":\"normal\"},\"ids\":\"114\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267404),(62,1,'admin','/kFsbVjKLge.php/auth/rule/edit/ids/121?dialog=1','权限管理 / 菜单规则 / 编辑','{\"dialog\":\"1\",\"__token__\":\"***\",\"row\":{\"ismenu\":\"1\",\"pid\":\"92\",\"name\":\"base\\/servicetype\",\"title\":\"服务类型\",\"url\":\"\",\"icon\":\"fa fa-circle-o\",\"weigh\":\"1\",\"condition\":\"\",\"menutype\":\"addtabs\",\"extend\":\"\",\"remark\":\"\",\"status\":\"normal\"},\"ids\":\"121\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267412),(63,1,'admin','/kFsbVjKLge.php/auth/group/roletree','权限管理 / 角色组','{\"pid\":\"1\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267420),(64,1,'admin','/kFsbVjKLge.php/auth/group/add?dialog=1','权限管理 / 角色组 / 添加','{\"dialog\":\"1\",\"__token__\":\"***\",\"row\":{\"rules\":\"1,8,9,10,11,13,14,15,16,17,29,30,31,32,33,34,40,41,42,43,44,45,46,47,48,49,50,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,2,5\",\"pid\":\"1\",\"name\":\"管理员\",\"status\":\"normal\"}}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267463),(65,1,'admin','/kFsbVjKLge.php/auth/group/del','权限管理 / 角色组 / 删除','{\"action\":\"del\",\"ids\":\"2\",\"params\":\"\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267468),(66,1,'admin','/kFsbVjKLge.php/auth/group/del','权限管理 / 角色组 / 删除','{\"action\":\"del\",\"ids\":\"3\",\"params\":\"\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267472),(67,1,'admin','/kFsbVjKLge.php/auth/group/del','权限管理 / 角色组 / 删除','{\"action\":\"del\",\"ids\":\"5\",\"params\":\"\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267474),(68,1,'admin','/kFsbVjKLge.php/auth/group/del','权限管理 / 角色组 / 删除','{\"action\":\"del\",\"ids\":\"2\",\"params\":\"\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267476),(69,1,'admin','/kFsbVjKLge.php/auth/group/del','权限管理 / 角色组 / 删除','{\"action\":\"del\",\"ids\":\"4\",\"params\":\"\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267479),(70,1,'admin','/kFsbVjKLge.php/auth/admin/add?dialog=1','权限管理 / 管理员管理 / 添加','{\"dialog\":\"1\",\"__token__\":\"***\",\"group\":[\"6\"],\"row\":{\"username\":\"1001\",\"email\":\"1001@qq.com\",\"nickname\":\"管理员\",\"password\":\"***\",\"status\":\"normal\"}}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267505),(71,1,'admin','/kFsbVjKLge.php/index/login','登录','{\"__token__\":\"***\",\"username\":\"admin\",\"password\":\"***\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621267556),(72,2,'1001','/kFsbVjKLge.php/index/login','登录','{\"__token__\":\"***\",\"username\":\"1001\",\"password\":\"***\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36',1621267569),(73,2,'1001','/kFsbVjKLge.php/ajax/upload','','[]','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36',1621267585),(74,2,'1001','/kFsbVjKLge.php/general.profile/update','常规管理 / 个人资料 / 更新个人信息','{\"__token__\":\"***\",\"row\":{\"avatar\":\"\\/uploads\\/20210518\\/00938e8174d7ec682e3a58fe1751c2bb.jpg\",\"email\":\"1001@qq.com\",\"nickname\":\"管理员\",\"password\":\"***\"}}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36',1621267586),(75,2,'1001','/kFsbVjKLge.php/base/production/add?dialog=1','基础资料 / 产品信息 / 添加','{\"dialog\":\"1\",\"row\":{\"production_name\":\"立升净水机\",\"production_type\":\"LH3-8AD\",\"production_consumable_material\":\"超滤膜\",\"production_replacement_cycle\":\"3\"}}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36',1621267768),(76,2,'1001','/kFsbVjKLge.php/base/installplace/add?dialog=1','基础资料 / 安装位置 / 添加','{\"dialog\":\"1\",\"row\":{\"install_place\":\"台下\"}}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36',1621268490),(77,2,'1001','/kFsbVjKLge.php/base/installtype/add?dialog=1','基础资料 / 安装管路 / 添加','{\"dialog\":\"1\",\"row\":{\"install_type\":\"总管\"}}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36',1621268517),(78,2,'1001','/kFsbVjKLge.php/base/purpose/add?dialog=1','基础资料 / 净水用途 / 添加','{\"dialog\":\"1\",\"row\":{\"purpose\":\"厨房净水\"}}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36',1621268527),(79,2,'1001','/kFsbVjKLge.php/base/customtype/add?dialog=1','基础资料 / 客户类型 / 添加','{\"dialog\":\"1\",\"row\":{\"custom_type\":\"直销客户\"}}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36',1621268538),(80,2,'1001','/kFsbVjKLge.php/base/servicevaluation/add?dialog=1','基础资料 / 顾客评价 / 添加','{\"dialog\":\"1\",\"row\":{\"service_valuation\":\"服务很好，技术专业\"}}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36',1621268552),(81,2,'1001','/kFsbVjKLge.php/base/saletype/add?dialog=1','基础资料 / 销售渠道 / 添加','{\"dialog\":\"1\",\"row\":{\"sale_type\":\"县区代理\"}}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36',1621268562),(82,2,'1001','/kFsbVjKLge.php/base/servicetype/add?dialog=1','基础资料 / 服务类型 / 添加','{\"dialog\":\"1\",\"row\":{\"service_type\":\"装机\"}}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36',1621268571),(83,1,'admin','/kFsbVjKLge.php/auth/rule/edit/ids/66?dialog=1','权限管理 / 菜单规则 / 编辑','{\"dialog\":\"1\",\"__token__\":\"***\",\"row\":{\"ismenu\":\"1\",\"pid\":\"0\",\"name\":\"user\",\"title\":\"客户管理\",\"url\":\"\",\"icon\":\"fa fa-list\",\"weigh\":\"141\",\"condition\":\"\",\"menutype\":\"addtabs\",\"extend\":\"\",\"remark\":\"\",\"status\":\"normal\"},\"ids\":\"66\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621269205),(84,1,'admin','/kFsbVjKLge.php/auth/rule/edit/ids/67?dialog=1','权限管理 / 菜单规则 / 编辑','{\"dialog\":\"1\",\"__token__\":\"***\",\"row\":{\"ismenu\":\"1\",\"pid\":\"66\",\"name\":\"user\\/user\",\"title\":\"客户资料\",\"url\":\"\",\"icon\":\"fa fa-user\",\"weigh\":\"0\",\"condition\":\"\",\"menutype\":\"addtabs\",\"extend\":\"\",\"remark\":\"\",\"status\":\"normal\"},\"ids\":\"67\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621269228),(85,1,'admin','/kFsbVjKLge.php/auth/rule/edit/ids/73?dialog=1','权限管理 / 菜单规则 / 编辑','{\"dialog\":\"1\",\"__token__\":\"***\",\"row\":{\"ismenu\":\"1\",\"pid\":\"66\",\"name\":\"user\\/group\",\"title\":\"客户分组\",\"url\":\"\",\"icon\":\"fa fa-users\",\"weigh\":\"0\",\"condition\":\"\",\"menutype\":\"addtabs\",\"extend\":\"\",\"remark\":\"\",\"status\":\"normal\"},\"ids\":\"73\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.115 Safari/537.36 Qaxbrowser',1621269247),(86,2,'1001','/kFsbVjKLge.php/index/login?url=%2FkFsbVjKLge.php','登录','{\"url\":\"\\/kFsbVjKLge.php\",\"__token__\":\"***\",\"username\":\"1001\",\"password\":\"***\"}','192.168.0.102','Mozilla/5.0 (Linux; Android 10; MI 9) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.117 Mobile Safari/537.36',1621269926),(87,2,'1001','/kFsbVjKLge.php/index/login?url=%2FkFsbVjKLge.php%2Fbase%2Fproduction%3Fref%3Daddtabs','登录','{\"url\":\"\\/kFsbVjKLge.php\\/base\\/production?ref=addtabs\",\"__token__\":\"***\",\"username\":\"1001\",\"password\":\"***\"}','192.168.0.102','Mozilla/5.0 (Linux; Android 10; MI 9 Build/QKQ1.190825.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/77.0.3865.120 MQQBrowser/6.2 TBS/045614 Mobile Safari/537.36 V1_AND_SQ_8.7.5_1738_YYB_D A_8070510 QQ/8.7.5.5330 NetType/WIFI WebP/0.3',1621270046);
/*!40000 ALTER TABLE `lsjs_admin_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsjs_area`
--

DROP TABLE IF EXISTS `lsjs_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lsjs_area` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `pid` int(10) DEFAULT NULL COMMENT '父id',
  `shortname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '简称',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '名称',
  `mergename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '全称',
  `level` tinyint(4) DEFAULT NULL COMMENT '层级 0 1 2 省市区县',
  `pinyin` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '拼音',
  `code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '长途区号',
  `zip` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '邮编',
  `first` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '首字母',
  `lng` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '经度',
  `lat` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '纬度',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='地区表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsjs_area`
--

LOCK TABLES `lsjs_area` WRITE;
/*!40000 ALTER TABLE `lsjs_area` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsjs_area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsjs_attachment`
--

DROP TABLE IF EXISTS `lsjs_attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lsjs_attachment` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `admin_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员ID',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '物理路径',
  `imagewidth` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '宽度',
  `imageheight` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '高度',
  `imagetype` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '图片类型',
  `imageframes` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '图片帧数',
  `filename` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '文件名称',
  `filesize` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `mimetype` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'mime类型',
  `extparam` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '透传数据',
  `createtime` int(10) DEFAULT NULL COMMENT '创建日期',
  `updatetime` int(10) DEFAULT NULL COMMENT '更新时间',
  `uploadtime` int(10) DEFAULT NULL COMMENT '上传时间',
  `storage` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'local' COMMENT '存储位置',
  `sha1` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '文件 sha1编码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='附件表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsjs_attachment`
--

LOCK TABLES `lsjs_attachment` WRITE;
/*!40000 ALTER TABLE `lsjs_attachment` DISABLE KEYS */;
INSERT INTO `lsjs_attachment` VALUES (1,1,0,'/assets/img/qrcode.png','150','150','png',0,'qrcode.png',21859,'image/png','',1491635035,1491635035,1491635035,'local','17163603d0263e4838b9387ff2cd4877e8b018f6'),(2,1,0,'/uploads/20210517/ffbdabe1c2b351d6cdc0da2fe8b6d71b.jpg','3840','2400','jpg',0,'cristina-gottardi-wndpWTiDuT0-unsplash.jpg',1885674,'image/jpeg','',1621264384,1621264384,1621264384,'local','d7a20e1a8054b037bfbbf8b699c4c6430f5e796b'),(3,2,0,'/uploads/20210518/00938e8174d7ec682e3a58fe1751c2bb.jpg','3840','2160','jpg',0,'willian-justen-de-vasconcellos-ASKGjAeIY_U-unsplash.jpg',701641,'image/jpeg','',1621267585,1621267585,1621267585,'local','a78188331e6e0cdc0facdc7b3a630da0c5e784f2');
/*!40000 ALTER TABLE `lsjs_attachment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsjs_auth_group`
--

DROP TABLE IF EXISTS `lsjs_auth_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lsjs_auth_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父组别',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '组名',
  `rules` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '规则ID',
  `createtime` int(10) DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(10) DEFAULT NULL COMMENT '更新时间',
  `status` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='分组表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsjs_auth_group`
--

LOCK TABLES `lsjs_auth_group` WRITE;
/*!40000 ALTER TABLE `lsjs_auth_group` DISABLE KEYS */;
INSERT INTO `lsjs_auth_group` VALUES (1,0,'Admin group','*',1491635035,1491635035,'normal'),(6,1,'管理员','1,8,9,10,11,13,14,15,16,17,29,30,31,32,33,34,40,41,42,43,44,45,46,47,48,49,50,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,2,5',1621267463,1621267463,'normal');
/*!40000 ALTER TABLE `lsjs_auth_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsjs_auth_group_access`
--

DROP TABLE IF EXISTS `lsjs_auth_group_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lsjs_auth_group_access` (
  `uid` int(10) unsigned NOT NULL COMMENT '会员ID',
  `group_id` int(10) unsigned NOT NULL COMMENT '级别ID',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='权限分组表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsjs_auth_group_access`
--

LOCK TABLES `lsjs_auth_group_access` WRITE;
/*!40000 ALTER TABLE `lsjs_auth_group_access` DISABLE KEYS */;
INSERT INTO `lsjs_auth_group_access` VALUES (1,1),(2,6);
/*!40000 ALTER TABLE `lsjs_auth_group_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsjs_auth_rule`
--

DROP TABLE IF EXISTS `lsjs_auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lsjs_auth_rule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('menu','file') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'file' COMMENT 'menu为菜单,file为权限节点',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '规则名称',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '规则名称',
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '图标',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '规则URL',
  `condition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '条件',
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '备注',
  `ismenu` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为菜单',
  `menutype` enum('addtabs','blank','dialog','ajax') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '菜单类型',
  `extend` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '扩展属性',
  `createtime` int(10) DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(10) DEFAULT NULL COMMENT '更新时间',
  `weigh` int(10) NOT NULL DEFAULT '0' COMMENT '权重',
  `status` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '状态',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE,
  KEY `pid` (`pid`),
  KEY `weigh` (`weigh`)
) ENGINE=InnoDB AUTO_INCREMENT=149 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='节点表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsjs_auth_rule`
--

LOCK TABLES `lsjs_auth_rule` WRITE;
/*!40000 ALTER TABLE `lsjs_auth_rule` DISABLE KEYS */;
INSERT INTO `lsjs_auth_rule` VALUES (1,'file',0,'dashboard','Dashboard','fa fa-dashboard','','','Dashboard tips',1,NULL,'',1491635035,1491635035,143,'normal'),(2,'file',0,'general','General','fa fa-cogs','','','',1,NULL,'',1491635035,1491635035,137,'normal'),(3,'file',0,'category','Category','fa fa-leaf','','','Category tips',1,NULL,'',1491635035,1491635035,119,'normal'),(4,'file',0,'addon','Addon','fa fa-rocket','','','Addon tips',1,NULL,'',1491635035,1491635035,0,'normal'),(5,'file',0,'auth','Auth','fa fa-group','','','',1,NULL,'',1491635035,1491635035,99,'normal'),(6,'file',2,'general/config','Config','fa fa-cog','','','Config tips',1,NULL,'',1491635035,1491635035,60,'normal'),(7,'file',2,'general/attachment','Attachment','fa fa-file-image-o','','','Attachment tips',1,NULL,'',1491635035,1491635035,53,'normal'),(8,'file',2,'general/profile','Profile','fa fa-user','','','',1,NULL,'',1491635035,1491635035,34,'normal'),(9,'file',5,'auth/admin','Admin','fa fa-user','','','Admin tips',1,NULL,'',1491635035,1491635035,118,'normal'),(10,'file',5,'auth/adminlog','Admin log','fa fa-list-alt','','','Admin log tips',1,NULL,'',1491635035,1491635035,113,'normal'),(11,'file',5,'auth/group','Group','fa fa-group','','','Group tips',1,NULL,'',1491635035,1491635035,109,'normal'),(12,'file',5,'auth/rule','Rule','fa fa-bars','','','Rule tips',1,NULL,'',1491635035,1491635035,104,'normal'),(13,'file',1,'dashboard/index','View','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,136,'normal'),(14,'file',1,'dashboard/add','Add','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,135,'normal'),(15,'file',1,'dashboard/del','Delete','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,133,'normal'),(16,'file',1,'dashboard/edit','Edit','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,134,'normal'),(17,'file',1,'dashboard/multi','Multi','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,132,'normal'),(18,'file',6,'general/config/index','View','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,52,'normal'),(19,'file',6,'general/config/add','Add','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,51,'normal'),(20,'file',6,'general/config/edit','Edit','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,50,'normal'),(21,'file',6,'general/config/del','Delete','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,49,'normal'),(22,'file',6,'general/config/multi','Multi','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,48,'normal'),(23,'file',7,'general/attachment/index','View','fa fa-circle-o','','','Attachment tips',0,NULL,'',1491635035,1491635035,59,'normal'),(24,'file',7,'general/attachment/select','Select attachment','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,58,'normal'),(25,'file',7,'general/attachment/add','Add','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,57,'normal'),(26,'file',7,'general/attachment/edit','Edit','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,56,'normal'),(27,'file',7,'general/attachment/del','Delete','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,55,'normal'),(28,'file',7,'general/attachment/multi','Multi','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,54,'normal'),(29,'file',8,'general/profile/index','View','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,33,'normal'),(30,'file',8,'general/profile/update','Update profile','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,32,'normal'),(31,'file',8,'general/profile/add','Add','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,31,'normal'),(32,'file',8,'general/profile/edit','Edit','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,30,'normal'),(33,'file',8,'general/profile/del','Delete','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,29,'normal'),(34,'file',8,'general/profile/multi','Multi','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,28,'normal'),(35,'file',3,'category/index','View','fa fa-circle-o','','','Category tips',0,NULL,'',1491635035,1491635035,142,'normal'),(36,'file',3,'category/add','Add','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,141,'normal'),(37,'file',3,'category/edit','Edit','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,140,'normal'),(38,'file',3,'category/del','Delete','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,139,'normal'),(39,'file',3,'category/multi','Multi','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,138,'normal'),(40,'file',9,'auth/admin/index','View','fa fa-circle-o','','','Admin tips',0,NULL,'',1491635035,1491635035,117,'normal'),(41,'file',9,'auth/admin/add','Add','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,116,'normal'),(42,'file',9,'auth/admin/edit','Edit','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,115,'normal'),(43,'file',9,'auth/admin/del','Delete','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,114,'normal'),(44,'file',10,'auth/adminlog/index','View','fa fa-circle-o','','','Admin log tips',0,NULL,'',1491635035,1491635035,112,'normal'),(45,'file',10,'auth/adminlog/detail','Detail','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,111,'normal'),(46,'file',10,'auth/adminlog/del','Delete','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,110,'normal'),(47,'file',11,'auth/group/index','View','fa fa-circle-o','','','Group tips',0,NULL,'',1491635035,1491635035,108,'normal'),(48,'file',11,'auth/group/add','Add','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,107,'normal'),(49,'file',11,'auth/group/edit','Edit','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,106,'normal'),(50,'file',11,'auth/group/del','Delete','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,105,'normal'),(51,'file',12,'auth/rule/index','View','fa fa-circle-o','','','Rule tips',0,NULL,'',1491635035,1491635035,103,'normal'),(52,'file',12,'auth/rule/add','Add','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,102,'normal'),(53,'file',12,'auth/rule/edit','Edit','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,101,'normal'),(54,'file',12,'auth/rule/del','Delete','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,100,'normal'),(55,'file',4,'addon/index','View','fa fa-circle-o','','','Addon tips',0,NULL,'',1491635035,1491635035,0,'normal'),(56,'file',4,'addon/add','Add','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,0,'normal'),(57,'file',4,'addon/edit','Edit','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,0,'normal'),(58,'file',4,'addon/del','Delete','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,0,'normal'),(59,'file',4,'addon/downloaded','Local addon','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,0,'normal'),(60,'file',4,'addon/state','Update state','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,0,'normal'),(63,'file',4,'addon/config','Setting','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,0,'normal'),(64,'file',4,'addon/refresh','Refresh','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,0,'normal'),(65,'file',4,'addon/multi','Multi','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,0,'normal'),(66,'file',0,'user','客户管理','fa fa-list','','','',1,'addtabs','',1491635035,1621269205,141,'normal'),(67,'file',66,'user/user','客户资料','fa fa-user','','','',1,'addtabs','',1491635035,1621269228,0,'normal'),(68,'file',67,'user/user/index','View','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,0,'normal'),(69,'file',67,'user/user/edit','Edit','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,0,'normal'),(70,'file',67,'user/user/add','Add','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,0,'normal'),(71,'file',67,'user/user/del','Del','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,0,'normal'),(72,'file',67,'user/user/multi','Multi','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,0,'normal'),(73,'file',66,'user/group','客户分组','fa fa-users','','','',1,'addtabs','',1491635035,1621269247,0,'normal'),(74,'file',73,'user/group/add','Add','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,0,'normal'),(75,'file',73,'user/group/edit','Edit','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,0,'normal'),(76,'file',73,'user/group/index','View','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,0,'normal'),(77,'file',73,'user/group/del','Del','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,0,'normal'),(78,'file',73,'user/group/multi','Multi','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,0,'normal'),(79,'file',66,'user/rule','User rule','fa fa-circle-o','','','',1,NULL,'',1491635035,1491635035,0,'normal'),(80,'file',79,'user/rule/index','View','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,0,'normal'),(81,'file',79,'user/rule/del','Del','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,0,'normal'),(82,'file',79,'user/rule/add','Add','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,0,'normal'),(83,'file',79,'user/rule/edit','Edit','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,0,'normal'),(84,'file',79,'user/rule/multi','Multi','fa fa-circle-o','','','',0,NULL,'',1491635035,1491635035,0,'normal'),(85,'file',0,'command','在线命令管理','fa fa-terminal','','','',1,NULL,'',1621266946,1621266946,0,'normal'),(86,'file',85,'command/index','查看','fa fa-circle-o','','','',0,NULL,'',1621266946,1621266946,0,'normal'),(87,'file',85,'command/add','添加','fa fa-circle-o','','','',0,NULL,'',1621266946,1621266946,0,'normal'),(88,'file',85,'command/detail','详情','fa fa-circle-o','','','',0,NULL,'',1621266946,1621266946,0,'normal'),(89,'file',85,'command/execute','运行','fa fa-circle-o','','','',0,NULL,'',1621266946,1621266946,0,'normal'),(90,'file',85,'command/del','删除','fa fa-circle-o','','','',0,NULL,'',1621266946,1621266946,0,'normal'),(91,'file',85,'command/multi','批量更新','fa fa-circle-o','','','',0,NULL,'',1621266946,1621266946,0,'normal'),(92,'file',0,'base','基础资料','fa fa-list','','','',1,'addtabs','',1621267003,1621267248,142,'normal'),(93,'file',92,'base/customtype','客户类型','fa fa-circle-o','','','',1,'addtabs','',1621267003,1621267391,4,'normal'),(94,'file',93,'base/customtype/import','Import','fa fa-circle-o','','','',0,NULL,'',1621267003,1621267200,0,'normal'),(95,'file',93,'base/customtype/index','查看','fa fa-circle-o','','','',0,NULL,'',1621267003,1621267200,0,'normal'),(96,'file',93,'base/customtype/add','添加','fa fa-circle-o','','','',0,NULL,'',1621267003,1621267200,0,'normal'),(97,'file',93,'base/customtype/edit','编辑','fa fa-circle-o','','','',0,NULL,'',1621267003,1621267200,0,'normal'),(98,'file',93,'base/customtype/del','删除','fa fa-circle-o','','','',0,NULL,'',1621267003,1621267200,0,'normal'),(99,'file',93,'base/customtype/multi','批量更新','fa fa-circle-o','','','',0,NULL,'',1621267003,1621267200,0,'normal'),(100,'file',92,'base/servicevaluation','顾客评价','fa fa-circle-o','','','',1,'addtabs','',1621267199,1621267397,3,'normal'),(101,'file',100,'base/servicevaluation/import','Import','fa fa-circle-o','','','',0,NULL,'',1621267199,1621267199,0,'normal'),(102,'file',100,'base/servicevaluation/index','查看','fa fa-circle-o','','','',0,NULL,'',1621267199,1621267199,0,'normal'),(103,'file',100,'base/servicevaluation/add','添加','fa fa-circle-o','','','',0,NULL,'',1621267199,1621267199,0,'normal'),(104,'file',100,'base/servicevaluation/edit','编辑','fa fa-circle-o','','','',0,NULL,'',1621267199,1621267199,0,'normal'),(105,'file',100,'base/servicevaluation/del','删除','fa fa-circle-o','','','',0,NULL,'',1621267199,1621267199,0,'normal'),(106,'file',100,'base/servicevaluation/multi','批量更新','fa fa-circle-o','','','',0,NULL,'',1621267199,1621267199,0,'normal'),(107,'file',92,'base/installtype','安装管路','fa fa-circle-o','','','',1,'addtabs','',1621267199,1621267368,6,'normal'),(108,'file',107,'base/installtype/import','Import','fa fa-circle-o','','','',0,NULL,'',1621267199,1621267199,0,'normal'),(109,'file',107,'base/installtype/index','查看','fa fa-circle-o','','','',0,NULL,'',1621267199,1621267199,0,'normal'),(110,'file',107,'base/installtype/add','添加','fa fa-circle-o','','','',0,NULL,'',1621267199,1621267199,0,'normal'),(111,'file',107,'base/installtype/edit','编辑','fa fa-circle-o','','','',0,NULL,'',1621267199,1621267199,0,'normal'),(112,'file',107,'base/installtype/del','删除','fa fa-circle-o','','','',0,NULL,'',1621267199,1621267199,0,'normal'),(113,'file',107,'base/installtype/multi','批量更新','fa fa-circle-o','','','',0,NULL,'',1621267199,1621267199,0,'normal'),(114,'file',92,'base/saletype','销售渠道','fa fa-circle-o','','','',1,'addtabs','',1621267199,1621267404,2,'normal'),(115,'file',114,'base/saletype/import','Import','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(116,'file',114,'base/saletype/index','查看','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(117,'file',114,'base/saletype/add','添加','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(118,'file',114,'base/saletype/edit','编辑','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(119,'file',114,'base/saletype/del','删除','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(120,'file',114,'base/saletype/multi','批量更新','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(121,'file',92,'base/servicetype','服务类型','fa fa-circle-o','','','',1,'addtabs','',1621267200,1621267412,1,'normal'),(122,'file',121,'base/servicetype/import','Import','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(123,'file',121,'base/servicetype/index','查看','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(124,'file',121,'base/servicetype/add','添加','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(125,'file',121,'base/servicetype/edit','编辑','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(126,'file',121,'base/servicetype/del','删除','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(127,'file',121,'base/servicetype/multi','批量更新','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(128,'file',92,'base/production','产品信息','fa fa-circle-o','','','',1,'addtabs','',1621267200,1621267342,8,'normal'),(129,'file',128,'base/production/import','Import','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(130,'file',128,'base/production/index','查看','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(131,'file',128,'base/production/add','添加','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(132,'file',128,'base/production/edit','编辑','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(133,'file',128,'base/production/del','删除','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(134,'file',128,'base/production/multi','批量更新','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(135,'file',92,'base/purpose','净水用途','fa fa-circle-o','','','',1,'addtabs','',1621267200,1621267380,5,'normal'),(136,'file',135,'base/purpose/import','Import','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(137,'file',135,'base/purpose/index','查看','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(138,'file',135,'base/purpose/add','添加','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(139,'file',135,'base/purpose/edit','编辑','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(140,'file',135,'base/purpose/del','删除','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(141,'file',135,'base/purpose/multi','批量更新','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(142,'file',92,'base/installplace','安装位置','fa fa-circle-o','','','',1,'addtabs','',1621267200,1621267357,7,'normal'),(143,'file',142,'base/installplace/import','Import','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(144,'file',142,'base/installplace/index','查看','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(145,'file',142,'base/installplace/add','添加','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(146,'file',142,'base/installplace/edit','编辑','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(147,'file',142,'base/installplace/del','删除','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal'),(148,'file',142,'base/installplace/multi','批量更新','fa fa-circle-o','','','',0,NULL,'',1621267200,1621267200,0,'normal');
/*!40000 ALTER TABLE `lsjs_auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsjs_base_custom_type`
--

DROP TABLE IF EXISTS `lsjs_base_custom_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lsjs_base_custom_type` (
  `custom_type_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '客户类型ID',
  `custom_type` varchar(45) NOT NULL COMMENT '客户类型',
  `company_id` varchar(45) DEFAULT NULL COMMENT '数据归属',
  PRIMARY KEY (`custom_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='客户类型';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsjs_base_custom_type`
--

LOCK TABLES `lsjs_base_custom_type` WRITE;
/*!40000 ALTER TABLE `lsjs_base_custom_type` DISABLE KEYS */;
INSERT INTO `lsjs_base_custom_type` VALUES (1,'直销客户','2');
/*!40000 ALTER TABLE `lsjs_base_custom_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsjs_base_install_place`
--

DROP TABLE IF EXISTS `lsjs_base_install_place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lsjs_base_install_place` (
  `install_place_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '安装位置ID',
  `install_place` varchar(45) NOT NULL COMMENT '安装位置',
  `company_id` int(10) DEFAULT NULL COMMENT '数据归属',
  PRIMARY KEY (`install_place_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='安装位置';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsjs_base_install_place`
--

LOCK TABLES `lsjs_base_install_place` WRITE;
/*!40000 ALTER TABLE `lsjs_base_install_place` DISABLE KEYS */;
INSERT INTO `lsjs_base_install_place` VALUES (1,'台下',2);
/*!40000 ALTER TABLE `lsjs_base_install_place` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsjs_base_install_type`
--

DROP TABLE IF EXISTS `lsjs_base_install_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lsjs_base_install_type` (
  `install_type_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '安装管路ID',
  `install_type` varchar(45) NOT NULL COMMENT '安装管路',
  `company_id` varchar(45) DEFAULT NULL COMMENT '数据归属',
  PRIMARY KEY (`install_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='安装管路';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsjs_base_install_type`
--

LOCK TABLES `lsjs_base_install_type` WRITE;
/*!40000 ALTER TABLE `lsjs_base_install_type` DISABLE KEYS */;
INSERT INTO `lsjs_base_install_type` VALUES (1,'总管','2');
/*!40000 ALTER TABLE `lsjs_base_install_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsjs_base_production_info`
--

DROP TABLE IF EXISTS `lsjs_base_production_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lsjs_base_production_info` (
  `production_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '产品信息ID',
  `production_name` varchar(45) NOT NULL COMMENT '产品名称',
  `production_type` varchar(45) NOT NULL COMMENT '产品型号',
  `production_consumable_material` varchar(45) NOT NULL COMMENT '使用耗材',
  `production_replacement_cycle` int(5) NOT NULL COMMENT '维护周期',
  `company_id` int(10) DEFAULT NULL COMMENT '数据归属',
  PRIMARY KEY (`production_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='产品信息';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsjs_base_production_info`
--

LOCK TABLES `lsjs_base_production_info` WRITE;
/*!40000 ALTER TABLE `lsjs_base_production_info` DISABLE KEYS */;
INSERT INTO `lsjs_base_production_info` VALUES (1,'立升净水机','LH3-8AD','超滤膜',3,2);
/*!40000 ALTER TABLE `lsjs_base_production_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsjs_base_purpose`
--

DROP TABLE IF EXISTS `lsjs_base_purpose`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lsjs_base_purpose` (
  `purpose_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '净水用途ID',
  `purpose` varchar(45) NOT NULL COMMENT '净水用途',
  `company_id` int(10) DEFAULT NULL COMMENT '数据归属',
  PRIMARY KEY (`purpose_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='净水用途';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsjs_base_purpose`
--

LOCK TABLES `lsjs_base_purpose` WRITE;
/*!40000 ALTER TABLE `lsjs_base_purpose` DISABLE KEYS */;
INSERT INTO `lsjs_base_purpose` VALUES (1,'厨房净水',2);
/*!40000 ALTER TABLE `lsjs_base_purpose` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsjs_base_sale_type`
--

DROP TABLE IF EXISTS `lsjs_base_sale_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lsjs_base_sale_type` (
  `sale_type_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '销售渠道ID',
  `sale_type` varchar(45) NOT NULL COMMENT '销售渠道',
  `company_id` int(10) DEFAULT NULL COMMENT '数据归属',
  PRIMARY KEY (`sale_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='销售渠道';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsjs_base_sale_type`
--

LOCK TABLES `lsjs_base_sale_type` WRITE;
/*!40000 ALTER TABLE `lsjs_base_sale_type` DISABLE KEYS */;
INSERT INTO `lsjs_base_sale_type` VALUES (1,'县区代理',2);
/*!40000 ALTER TABLE `lsjs_base_sale_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsjs_base_service_type`
--

DROP TABLE IF EXISTS `lsjs_base_service_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lsjs_base_service_type` (
  `service_type_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '服务类型ID',
  `service_type` varchar(45) NOT NULL COMMENT '服务类型',
  `company_id` int(10) DEFAULT NULL COMMENT '数据归属',
  PRIMARY KEY (`service_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='服务类型';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsjs_base_service_type`
--

LOCK TABLES `lsjs_base_service_type` WRITE;
/*!40000 ALTER TABLE `lsjs_base_service_type` DISABLE KEYS */;
INSERT INTO `lsjs_base_service_type` VALUES (1,'装机',2);
/*!40000 ALTER TABLE `lsjs_base_service_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsjs_base_service_valuation`
--

DROP TABLE IF EXISTS `lsjs_base_service_valuation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lsjs_base_service_valuation` (
  `service_valuation_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '顾客评价ID',
  `service_valuation` varchar(45) NOT NULL COMMENT '顾客评价',
  `company_id` varchar(45) DEFAULT NULL COMMENT '数据归属',
  PRIMARY KEY (`service_valuation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='顾客评价';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsjs_base_service_valuation`
--

LOCK TABLES `lsjs_base_service_valuation` WRITE;
/*!40000 ALTER TABLE `lsjs_base_service_valuation` DISABLE KEYS */;
INSERT INTO `lsjs_base_service_valuation` VALUES (1,'服务很好，技术专业','2');
/*!40000 ALTER TABLE `lsjs_base_service_valuation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsjs_category`
--

DROP TABLE IF EXISTS `lsjs_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lsjs_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '栏目类型',
  `name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `nickname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `flag` set('hot','index','recommend') COLLATE utf8mb4_unicode_ci DEFAULT '',
  `image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '图片',
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '关键字',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '描述',
  `diyname` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '自定义名称',
  `createtime` int(10) DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(10) DEFAULT NULL COMMENT '更新时间',
  `weigh` int(10) NOT NULL DEFAULT '0' COMMENT '权重',
  `status` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `weigh` (`weigh`,`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='分类表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsjs_category`
--

LOCK TABLES `lsjs_category` WRITE;
/*!40000 ALTER TABLE `lsjs_category` DISABLE KEYS */;
INSERT INTO `lsjs_category` VALUES (1,0,'page','官方新闻','news','recommend','/assets/img/qrcode.png','','','news',1491635035,1491635035,1,'normal'),(2,0,'page','移动应用','mobileapp','hot','/assets/img/qrcode.png','','','mobileapp',1491635035,1491635035,2,'normal'),(3,2,'page','微信公众号','wechatpublic','index','/assets/img/qrcode.png','','','wechatpublic',1491635035,1491635035,3,'normal'),(4,2,'page','Android开发','android','recommend','/assets/img/qrcode.png','','','android',1491635035,1491635035,4,'normal'),(5,0,'page','软件产品','software','recommend','/assets/img/qrcode.png','','','software',1491635035,1491635035,5,'normal'),(6,5,'page','网站建站','website','recommend','/assets/img/qrcode.png','','','website',1491635035,1491635035,6,'normal'),(7,5,'page','企业管理软件','company','index','/assets/img/qrcode.png','','','company',1491635035,1491635035,7,'normal'),(8,6,'page','PC端','website-pc','recommend','/assets/img/qrcode.png','','','website-pc',1491635035,1491635035,8,'normal'),(9,6,'page','移动端','website-mobile','recommend','/assets/img/qrcode.png','','','website-mobile',1491635035,1491635035,9,'normal'),(10,7,'page','CRM系统 ','company-crm','recommend','/assets/img/qrcode.png','','','company-crm',1491635035,1491635035,10,'normal'),(11,7,'page','SASS平台软件','company-sass','recommend','/assets/img/qrcode.png','','','company-sass',1491635035,1491635035,11,'normal'),(12,0,'test','测试1','test1','recommend','/assets/img/qrcode.png','','','test1',1491635035,1491635035,12,'normal'),(13,0,'test','测试2','test2','recommend','/assets/img/qrcode.png','','','test2',1491635035,1491635035,13,'normal');
/*!40000 ALTER TABLE `lsjs_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsjs_command`
--

DROP TABLE IF EXISTS `lsjs_command`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lsjs_command` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `type` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '类型',
  `params` varchar(1500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '参数',
  `command` varchar(1500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '命令',
  `content` text COMMENT '返回结果',
  `executetime` int(10) unsigned DEFAULT NULL COMMENT '执行时间',
  `createtime` int(10) unsigned DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(10) unsigned DEFAULT NULL COMMENT '更新时间',
  `status` enum('successed','failured') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'failured' COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='在线命令表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsjs_command`
--

LOCK TABLES `lsjs_command` WRITE;
/*!40000 ALTER TABLE `lsjs_command` DISABLE KEYS */;
INSERT INTO `lsjs_command` VALUES (1,'crud','[\"--force=1\",\"--table=lsjs_base_custom_type\",\"--controller=base\\/customtype\"]','php think crud --force=1 --table=lsjs_base_custom_type --controller=base/customtype','Build Successed',1621266981,1621266981,1621266981,'successed'),(2,'menu','[\"--controller=base\\/Customtype\"]','php think menu --controller=base/Customtype','Build Successed!',1621267002,1621267002,1621267003,'successed'),(3,'crud','[\"--force=1\",\"--table=lsjs_base_install_place\",\"--controller=base\\/installplace\"]','php think crud --force=1 --table=lsjs_base_install_place --controller=base/installplace','Build Successed',1621267029,1621267029,1621267029,'successed'),(4,'crud','[\"--force=1\",\"--table=lsjs_base_install_type\",\"--controller=base\\/installtype\"]','php think crud --force=1 --table=lsjs_base_install_type --controller=base/installtype','Build Successed',1621267043,1621267043,1621267043,'successed'),(5,'crud','[\"--force=1\",\"--table=lsjs_base_production_info\",\"--controller=base\\/production\"]','php think crud --force=1 --table=lsjs_base_production_info --controller=base/production','Build Successed',1621267059,1621267059,1621267059,'successed'),(6,'crud','[\"--force=1\",\"--table=lsjs_base_purpose\",\"--controller=base\\/purpose\"]','php think crud --force=1 --table=lsjs_base_purpose --controller=base/purpose','Build Successed',1621267072,1621267072,1621267072,'successed'),(7,'crud','[\"--force=1\",\"--table=lsjs_base_sale_type\",\"--controller=base\\/saletype\"]','php think crud --force=1 --table=lsjs_base_sale_type --controller=base/saletype','Build Successed',1621267083,1621267083,1621267083,'successed'),(8,'crud','[\"--force=1\",\"--table=lsjs_base_service_type\",\"--controller=base\\/servicetype\"]','php think crud --force=1 --table=lsjs_base_service_type --controller=base/servicetype','Build Successed',1621267098,1621267098,1621267099,'successed'),(9,'crud','[\"--force=1\",\"--table=lsjs_base_service_valuation\",\"--controller=base\\/servicevaluation\"]','php think crud --force=1 --table=lsjs_base_service_valuation --controller=base/servicevaluation','Build Successed',1621267173,1621267173,1621267173,'successed'),(10,'menu','[\"--controller=base\\/Servicevaluation\",\"--controller=base\\/Installtype\",\"--controller=base\\/Saletype\",\"--controller=base\\/Servicetype\",\"--controller=base\\/Production\",\"--controller=base\\/Purpose\",\"--controller=base\\/Installplace\",\"--controller=base\\/Customtype\"]','php think menu --controller=base/Servicevaluation --controller=base/Installtype --controller=base/Saletype --controller=base/Servicetype --controller=base/Production --controller=base/Purpose --controller=base/Installplace --controller=base/Customtype','Build Successed!',1621267199,1621267199,1621267200,'successed');
/*!40000 ALTER TABLE `lsjs_command` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsjs_config`
--

DROP TABLE IF EXISTS `lsjs_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lsjs_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '变量名',
  `group` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '分组',
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '变量标题',
  `tip` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '变量描述',
  `type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '类型:string,text,int,bool,array,datetime,date,file',
  `value` text COLLATE utf8mb4_unicode_ci COMMENT '变量值',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '变量字典数据',
  `rule` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '验证规则',
  `extend` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '扩展属性',
  `setting` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '配置',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统配置';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsjs_config`
--

LOCK TABLES `lsjs_config` WRITE;
/*!40000 ALTER TABLE `lsjs_config` DISABLE KEYS */;
INSERT INTO `lsjs_config` VALUES (1,'name','basic','Site name','请填写站点名称','string','立升净水','','required','',''),(2,'beian','basic','Beian','粤ICP备15000000号-1','string','','','','',''),(3,'cdnurl','basic','Cdn url','如果全站静态资源使用第三方云储存请配置该值','string','','','','',''),(4,'version','basic','Version','如果静态资源有变动请重新配置该值','string','1.0.2','','required','',''),(5,'timezone','basic','Timezone','','string','Asia/Shanghai','','required','',''),(6,'forbiddenip','basic','Forbidden ip','一行一条记录','text','','','','',''),(7,'languages','basic','Languages','','array','{\"backend\":\"zh-cn\",\"frontend\":\"zh-cn\"}','','required','',''),(8,'fixedpage','basic','Fixed page','请尽量输入左侧菜单栏存在的链接','string','dashboard','','required','',''),(9,'categorytype','dictionary','Category type','','array','{\"default\":\"Default\",\"page\":\"Page\",\"article\":\"Article\",\"test\":\"Test\"}','','','',''),(10,'configgroup','dictionary','Config group','','array','{\"basic\":\"Basic\",\"email\":\"Email\",\"dictionary\":\"Dictionary\",\"user\":\"User\",\"example\":\"Example\"}','','','',''),(11,'mail_type','email','Mail type','选择邮件发送方式','select','1','[\"请选择\",\"SMTP\"]','','',''),(12,'mail_smtp_host','email','Mail smtp host','错误的配置发送邮件会导致服务器超时','string','smtp.qq.com','','','',''),(13,'mail_smtp_port','email','Mail smtp port','(不加密默认25,SSL默认465,TLS默认587)','string','465','','','',''),(14,'mail_smtp_user','email','Mail smtp user','（填写完整用户名）','string','10000','','','',''),(15,'mail_smtp_pass','email','Mail smtp password','（填写您的密码或授权码）','string','password','','','',''),(16,'mail_verify_type','email','Mail vertify type','（SMTP验证方式[推荐SSL]）','select','2','[\"无\",\"TLS\",\"SSL\"]','','',''),(17,'mail_from','email','Mail from','','string','10000@qq.com','','','','');
/*!40000 ALTER TABLE `lsjs_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsjs_ems`
--

DROP TABLE IF EXISTS `lsjs_ems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lsjs_ems` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `event` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '事件',
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '邮箱',
  `code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '验证码',
  `times` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '验证次数',
  `ip` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'IP',
  `createtime` int(10) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='邮箱验证码表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsjs_ems`
--

LOCK TABLES `lsjs_ems` WRITE;
/*!40000 ALTER TABLE `lsjs_ems` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsjs_ems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsjs_sms`
--

DROP TABLE IF EXISTS `lsjs_sms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lsjs_sms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `event` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '事件',
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '手机号',
  `code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '验证码',
  `times` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '验证次数',
  `ip` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'IP',
  `createtime` int(10) unsigned DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='短信验证码表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsjs_sms`
--

LOCK TABLES `lsjs_sms` WRITE;
/*!40000 ALTER TABLE `lsjs_sms` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsjs_sms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsjs_test`
--

DROP TABLE IF EXISTS `lsjs_test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lsjs_test` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `admin_id` int(10) NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `category_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类ID(单选)',
  `category_ids` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分类ID(多选)',
  `week` enum('monday','tuesday','wednesday') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '星期(单选):monday=星期一,tuesday=星期二,wednesday=星期三',
  `flag` set('hot','index','recommend') COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '标志(多选):hot=热门,index=首页,recommend=推荐',
  `genderdata` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'male' COMMENT '性别(单选):male=男,female=女',
  `hobbydata` set('music','reading','swimming') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '爱好(多选):music=音乐,reading=读书,swimming=游泳',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '标题',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '内容',
  `image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '图片',
  `images` varchar(1500) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '图片组',
  `attachfile` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '附件',
  `keywords` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '关键字',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '描述',
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '省市',
  `json` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '配置:key=名称,value=值',
  `price` float(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '价格',
  `views` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击',
  `startdate` date DEFAULT NULL COMMENT '开始日期',
  `activitytime` datetime DEFAULT NULL COMMENT '活动时间(datetime)',
  `year` year(4) DEFAULT NULL COMMENT '年',
  `times` time DEFAULT NULL COMMENT '时间',
  `refreshtime` int(10) DEFAULT NULL COMMENT '刷新时间(int)',
  `createtime` int(10) DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(10) DEFAULT NULL COMMENT '更新时间',
  `deletetime` int(10) DEFAULT NULL COMMENT '删除时间',
  `weigh` int(10) NOT NULL DEFAULT '0' COMMENT '权重',
  `switch` tinyint(1) NOT NULL DEFAULT '0' COMMENT '开关',
  `status` enum('normal','hidden') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal' COMMENT '状态',
  `state` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '状态值:0=禁用,1=正常,2=推荐',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='测试表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsjs_test`
--

LOCK TABLES `lsjs_test` WRITE;
/*!40000 ALTER TABLE `lsjs_test` DISABLE KEYS */;
INSERT INTO `lsjs_test` VALUES (1,0,12,'12,13','monday','hot,index','male','music,reading','我是一篇测试文章','<p>我是测试内容</p>','/assets/img/avatar.png','/assets/img/avatar.png,/assets/img/qrcode.png','/assets/img/avatar.png','关键字','描述','广西壮族自治区/百色市/平果县','{\"a\":\"1\",\"b\":\"2\"}',0.00,0,'2017-07-10','2017-07-10 18:24:45',2017,'18:24:45',1491635035,1491635035,1491635035,NULL,0,1,'normal','1');
/*!40000 ALTER TABLE `lsjs_test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsjs_user`
--

DROP TABLE IF EXISTS `lsjs_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lsjs_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '组别ID',
  `username` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '用户名',
  `nickname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '昵称',
  `password` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '密码',
  `salt` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '密码盐',
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '电子邮箱',
  `mobile` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '手机号',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '头像',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '等级',
  `gender` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '性别',
  `birthday` date DEFAULT NULL COMMENT '生日',
  `bio` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '格言',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '余额',
  `score` int(10) NOT NULL DEFAULT '0' COMMENT '积分',
  `successions` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '连续登录天数',
  `maxsuccessions` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '最大连续登录天数',
  `prevtime` int(10) DEFAULT NULL COMMENT '上次登录时间',
  `logintime` int(10) DEFAULT NULL COMMENT '登录时间',
  `loginip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '登录IP',
  `loginfailure` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '失败次数',
  `joinip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '加入IP',
  `jointime` int(10) DEFAULT NULL COMMENT '加入时间',
  `createtime` int(10) DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(10) DEFAULT NULL COMMENT '更新时间',
  `token` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'Token',
  `status` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '状态',
  `verification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '验证',
  `first` date DEFAULT NULL COMMENT '首次购买日期',
  `last` date DEFAULT NULL COMMENT '最后购买日期',
  `number` int(5) DEFAULT NULL COMMENT '购买台数',
  `company_id` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '数据归属',
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `email` (`email`),
  KEY `mobile` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='会员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsjs_user`
--

LOCK TABLES `lsjs_user` WRITE;
/*!40000 ALTER TABLE `lsjs_user` DISABLE KEYS */;
INSERT INTO `lsjs_user` VALUES (1,1,'admin','admin','90db0d489ec20fe13d4168a9d112fa5a','558c6a','admin@163.com','13888888888','',0,0,'2017-04-08','',0.00,0,1,1,1491635035,1491635035,'127.0.0.1',0,'127.0.0.1',1491635035,0,1491635035,'','normal','','2021-03-01','2021-05-20',2,'2');
/*!40000 ALTER TABLE `lsjs_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsjs_user_group`
--

DROP TABLE IF EXISTS `lsjs_user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lsjs_user_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '组名',
  `rules` text COLLATE utf8mb4_unicode_ci COMMENT '权限节点',
  `createtime` int(10) DEFAULT NULL COMMENT '添加时间',
  `updatetime` int(10) DEFAULT NULL COMMENT '更新时间',
  `status` enum('normal','hidden') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='会员组表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsjs_user_group`
--

LOCK TABLES `lsjs_user_group` WRITE;
/*!40000 ALTER TABLE `lsjs_user_group` DISABLE KEYS */;
INSERT INTO `lsjs_user_group` VALUES (1,'默认组','1,2,3,4,5,6,7,8,9,10,11,12',1491635035,1491635035,'normal');
/*!40000 ALTER TABLE `lsjs_user_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsjs_user_money_log`
--

DROP TABLE IF EXISTS `lsjs_user_money_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lsjs_user_money_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员ID',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '变更余额',
  `before` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '变更前余额',
  `after` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '变更后余额',
  `memo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '备注',
  `createtime` int(10) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='会员余额变动表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsjs_user_money_log`
--

LOCK TABLES `lsjs_user_money_log` WRITE;
/*!40000 ALTER TABLE `lsjs_user_money_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsjs_user_money_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsjs_user_rule`
--

DROP TABLE IF EXISTS `lsjs_user_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lsjs_user_rule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) DEFAULT NULL COMMENT '父ID',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '名称',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '标题',
  `remark` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '备注',
  `ismenu` tinyint(1) DEFAULT NULL COMMENT '是否菜单',
  `createtime` int(10) DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(10) DEFAULT NULL COMMENT '更新时间',
  `weigh` int(10) DEFAULT '0' COMMENT '权重',
  `status` enum('normal','hidden') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='会员规则表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsjs_user_rule`
--

LOCK TABLES `lsjs_user_rule` WRITE;
/*!40000 ALTER TABLE `lsjs_user_rule` DISABLE KEYS */;
INSERT INTO `lsjs_user_rule` VALUES (1,0,'index','Frontend','',1,1491635035,1491635035,1,'normal'),(2,0,'api','API Interface','',1,1491635035,1491635035,2,'normal'),(3,1,'user','User Module','',1,1491635035,1491635035,12,'normal'),(4,2,'user','User Module','',1,1491635035,1491635035,11,'normal'),(5,3,'index/user/login','Login','',0,1491635035,1491635035,5,'normal'),(6,3,'index/user/register','Register','',0,1491635035,1491635035,7,'normal'),(7,3,'index/user/index','User Center','',0,1491635035,1491635035,9,'normal'),(8,3,'index/user/profile','Profile','',0,1491635035,1491635035,4,'normal'),(9,4,'api/user/login','Login','',0,1491635035,1491635035,6,'normal'),(10,4,'api/user/register','Register','',0,1491635035,1491635035,8,'normal'),(11,4,'api/user/index','User Center','',0,1491635035,1491635035,10,'normal'),(12,4,'api/user/profile','Profile','',0,1491635035,1491635035,3,'normal');
/*!40000 ALTER TABLE `lsjs_user_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsjs_user_score_log`
--

DROP TABLE IF EXISTS `lsjs_user_score_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lsjs_user_score_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员ID',
  `score` int(10) NOT NULL DEFAULT '0' COMMENT '变更积分',
  `before` int(10) NOT NULL DEFAULT '0' COMMENT '变更前积分',
  `after` int(10) NOT NULL DEFAULT '0' COMMENT '变更后积分',
  `memo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '备注',
  `createtime` int(10) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='会员积分变动表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsjs_user_score_log`
--

LOCK TABLES `lsjs_user_score_log` WRITE;
/*!40000 ALTER TABLE `lsjs_user_score_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsjs_user_score_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsjs_user_token`
--

DROP TABLE IF EXISTS `lsjs_user_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lsjs_user_token` (
  `token` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Token',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员ID',
  `createtime` int(10) DEFAULT NULL COMMENT '创建时间',
  `expiretime` int(10) DEFAULT NULL COMMENT '过期时间',
  PRIMARY KEY (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='会员Token表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsjs_user_token`
--

LOCK TABLES `lsjs_user_token` WRITE;
/*!40000 ALTER TABLE `lsjs_user_token` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsjs_user_token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lsjs_version`
--

DROP TABLE IF EXISTS `lsjs_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lsjs_version` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `oldversion` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '旧版本号',
  `newversion` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '新版本号',
  `packagesize` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '包大小',
  `content` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '升级内容',
  `downloadurl` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '下载地址',
  `enforce` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '强制更新',
  `createtime` int(10) DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(10) DEFAULT NULL COMMENT '更新时间',
  `weigh` int(10) NOT NULL DEFAULT '0' COMMENT '权重',
  `status` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='版本表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lsjs_version`
--

LOCK TABLES `lsjs_version` WRITE;
/*!40000 ALTER TABLE `lsjs_version` DISABLE KEYS */;
/*!40000 ALTER TABLE `lsjs_version` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-07-21  7:46:54
