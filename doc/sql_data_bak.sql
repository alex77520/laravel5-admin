-- MySQL dump 10.13  Distrib 5.7.11, for Linux (x86_64)
--
-- Host: localhost    Database: kw_yuanquan
-- ------------------------------------------------------
-- Server version	5.7.11

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cm_admin_groups`
--

DROP TABLE IF EXISTS `cm_admin_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_admin_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(64) NOT NULL DEFAULT '' COMMENT '组名',
  `node_type` int(11) NOT NULL DEFAULT '3',
  `operator` varchar(256) NOT NULL DEFAULT '' COMMENT '操作人',
  `description` text NOT NULL COMMENT '备注',
  `old_id` int(11) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '加入时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uidx` (`groupname`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_admin_groups`
--

LOCK TABLES `cm_admin_groups` WRITE;
/*!40000 ALTER TABLE `cm_admin_groups` DISABLE KEYS */;
INSERT INTO `cm_admin_groups` VALUES (1,'后台开发组',3,'','后台开发组',0,'2016-02-24 22:41:11','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `cm_admin_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_admin_modules`
--

DROP TABLE IF EXISTS `cm_admin_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_admin_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(64) NOT NULL DEFAULT '' COMMENT '模块名称',
  `module_cn` varchar(64) NOT NULL DEFAULT '' COMMENT '模块中文名称',
  `action` varchar(64) NOT NULL DEFAULT '' COMMENT '模块子项',
  `action_cn` varchar(64) NOT NULL DEFAULT '' COMMENT '模块子项中文名称',
  `module_type` int(1) NOT NULL DEFAULT '0' COMMENT '模块类型,0:不绑定资产;1:绑定资产;2:公司',
  `description` text NOT NULL COMMENT '模块描述',
  `order_by` int(11) NOT NULL DEFAULT '0',
  `gname` varchar(64) NOT NULL DEFAULT '' COMMENT '模块子项组名',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '加入时间',
  `column_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uidx` (`module`,`action`),
  KEY `module` (`module`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_admin_modules`
--

LOCK TABLES `cm_admin_modules` WRITE;
/*!40000 ALTER TABLE `cm_admin_modules` DISABLE KEYS */;
INSERT INTO `cm_admin_modules` VALUES (1,'personal','个人中心','profile','个人中心',0,'',101,'','2016-02-17 21:14:35','0000-00-00 00:00:00',1),(2,'personal','个人中心','changepw','修改密码',0,'',102,'','2016-02-17 21:15:30','0000-00-00 00:00:00',1),(3,'user','用户管理','account','用户列表',0,'',1101,'','2016-02-17 21:21:31','0000-00-00 00:00:00',2),(4,'user','用户管理','group','组管理',0,'',1102,'','2016-02-17 21:22:11','0000-00-00 00:00:00',2),(5,'privilege','权限管理','role','角色列表',0,'',1201,'','2016-02-19 23:36:43','0000-00-00 00:00:00',2),(6,'privilege','权限管理','grant','赋予/回收角色',0,'',1202,'','2016-02-19 23:37:39','0000-00-00 00:00:00',2),(7,'privilege','权限管理','view','查看权限',0,'',1203,'','2016-02-19 23:38:12','0000-00-00 00:00:00',2),(8,'module','后台设置','modulelist','模块列表',0,'模块',1301,'','2016-03-25 07:33:26','0000-00-00 00:00:00',2),(28,'company','分公司','kuwo','酷我',2,'酷我公司的权限',0,'','2016-03-23 18:49:47','2016-03-23 08:00:00',0),(29,'company','分公司','kugou','酷狗',2,'酷狗公司的权限',0,'','2016-03-23 18:49:47','2016-03-23 08:00:00',0);
/*!40000 ALTER TABLE `cm_admin_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_admin_permissions`
--

DROP TABLE IF EXISTS `cm_admin_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_admin_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `permission` varchar(64) NOT NULL DEFAULT '' COMMENT '权限名称',
  `module_id` int(11) NOT NULL DEFAULT '0' COMMENT '模块ID',
  `node_id` int(11) NOT NULL DEFAULT '0' COMMENT '资产ID(或者公司id)',
  `node_type` int(1) NOT NULL DEFAULT '0' COMMENT '0:不绑定资产;1:绑定资产;2:公司',
  `description` text NOT NULL COMMENT '权限描述',
  `operator` varchar(256) NOT NULL DEFAULT '' COMMENT '操作人/创建人',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '加入时间',
  PRIMARY KEY (`id`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_admin_permissions`
--

LOCK TABLES `cm_admin_permissions` WRITE;
/*!40000 ALTER TABLE `cm_admin_permissions` DISABLE KEYS */;
INSERT INTO `cm_admin_permissions` VALUES (1,1,'',1,0,0,'','','2016-02-19 20:35:18','0000-00-00 00:00:00'),(2,1,'',2,0,0,'','','2016-02-19 20:35:25','0000-00-00 00:00:00'),(3,1,'',3,0,0,'','','2016-02-19 20:35:26','0000-00-00 00:00:00'),(4,1,'',4,0,0,'','','2016-02-19 20:35:30','0000-00-00 00:00:00'),(5,2,'',1,0,0,'','','2016-02-19 20:35:46','0000-00-00 00:00:00'),(6,2,'',2,0,0,'','','2016-02-26 01:41:20','0000-00-00 00:00:00'),(7,1,'',5,0,0,'','','2016-02-19 23:46:52','0000-00-00 00:00:00'),(8,1,'',6,0,0,'','','2016-02-19 23:46:56','0000-00-00 00:00:00'),(9,1,'',7,0,0,'','','2016-02-19 23:47:05','0000-00-00 00:00:00'),(10,1,'',8,0,0,'','','2016-02-19 23:47:19','0000-00-00 00:00:00'),(39,1,'',29,0,0,'','','2016-03-25 03:49:47','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `cm_admin_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_admin_roles`
--

DROP TABLE IF EXISTS `cm_admin_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_admin_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(64) NOT NULL DEFAULT '' COMMENT '角色名称',
  `owner` varchar(64) NOT NULL DEFAULT '' COMMENT '角色属主',
  `description` text NOT NULL COMMENT '角色描述',
  `operator` varchar(256) NOT NULL DEFAULT '' COMMENT '操作人/创建人',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '加入时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uidx` (`role`),
  KEY `role` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_admin_roles`
--

LOCK TABLES `cm_admin_roles` WRITE;
/*!40000 ALTER TABLE `cm_admin_roles` DISABLE KEYS */;
INSERT INTO `cm_admin_roles` VALUES (1,'admin','admin','系统管理员','','2013-12-22 21:37:33','0000-00-00 00:00:00'),(2,'default','admin','普通用户','','2014-04-11 03:01:41','0000-00-00 00:00:00'),(3,'权限管理','runqin.yuan','权限管理','','2016-02-25 22:52:02','0000-00-00 00:00:00'),(6,'test','runqin.yuan','','','2016-03-16 03:36:29','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `cm_admin_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_admin_user_group`
--

DROP TABLE IF EXISTS `cm_admin_user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_admin_user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT 'User ID',
  `group_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Group ID',
  `is_leader` int(1) NOT NULL DEFAULT '0' COMMENT '是否组长;0:不是,1:是',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '加入时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uidx` (`user_id`,`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_admin_user_group`
--

LOCK TABLES `cm_admin_user_group` WRITE;
/*!40000 ALTER TABLE `cm_admin_user_group` DISABLE KEYS */;
INSERT INTO `cm_admin_user_group` VALUES (11,14,1,1,'2016-03-25 09:01:47','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `cm_admin_user_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_admin_user_role`
--

DROP TABLE IF EXISTS `cm_admin_user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_admin_user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `operator` varchar(256) NOT NULL DEFAULT '' COMMENT '操作人/创建人',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '加入时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uidx` (`role_id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_admin_user_role`
--

LOCK TABLES `cm_admin_user_role` WRITE;
/*!40000 ALTER TABLE `cm_admin_user_role` DISABLE KEYS */;
INSERT INTO `cm_admin_user_role` VALUES (16,2,14,'','2016-03-21 17:55:26','0000-00-00 00:00:00'),(17,1,14,'','2016-03-21 21:21:10','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `cm_admin_user_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cm_users`
--

DROP TABLE IF EXISTS `cm_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cm_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL DEFAULT '' COMMENT '用户名',
  `nickname` varchar(64) NOT NULL DEFAULT '' COMMENT '昵称或显示名',
  `password` varchar(256) NOT NULL DEFAULT '' COMMENT '密码',
  `pwdmd5` varchar(256) NOT NULL DEFAULT '' COMMENT '密码MD5',
  `mobile` varchar(64) NOT NULL DEFAULT '' COMMENT '手机',
  `email` varchar(256) NOT NULL DEFAULT '' COMMENT '电邮',
  `last` datetime NOT NULL DEFAULT '1970-01-01 00:00:01' COMMENT '上次登录时间',
  `last_ip` varchar(256) NOT NULL DEFAULT '' COMMENT '上次登录ip',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '用户状态(0,无效;1:有效)',
  `operator` varchar(256) NOT NULL DEFAULT '' COMMENT '操作人',
  `start_page` varchar(256) NOT NULL DEFAULT '',
  `remember_token` varchar(100) NOT NULL DEFAULT '',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '加入时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uidx` (`username`),
  key `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cm_users`
--

LOCK TABLES `cm_users` WRITE;
/*!40000 ALTER TABLE `cm_users` DISABLE KEYS */;
INSERT INTO `cm_users` VALUES (13,'daozhu','daozhu','$2y$10$D2Slsnp0SU8XEwws.andIehqXunX8jUZljBpqIKoWZexEmf034GbK','','15133336666','jing@test.cn','1970-01-01 00:00:01','',1,'','','yN6bhXKyi493hWN9AqcQXkypcnJtYVtGAFKsdiauOnCZhsXHm8uBNxd0BAzC','2016-03-24 19:45:18','0000-00-00 00:00:00'),(14,'admin','管理员','$2y$10$udG5CQLkZ7Yc8g2UhZI8QuzKvRldahBVzojrEhv3ixdYz9lviSIqa','','15133665522','admin_test@test.cn','1970-01-01 00:00:01','',1,'','','','2016-03-25 08:26:02','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `cm_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-25 17:29:33
