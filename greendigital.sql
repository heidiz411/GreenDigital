/*
 Navicat Premium Dump SQL

 Source Server         : Docker MySQL
 Source Server Type    : MySQL
 Source Server Version : 90001 (9.0.1)
 Source Host           : localhost:3306
 Source Schema         : greendigital

 Target Server Type    : MySQL
 Target Server Version : 90001 (9.0.1)
 File Encoding         : 65001

 Date: 23/11/2025 17:26:36
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_contents
-- ----------------------------
DROP TABLE IF EXISTS `tb_contents`;
CREATE TABLE `tb_contents` (
  `content_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `body` text,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `publish_at` datetime DEFAULT NULL,
  `expire_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`content_id`,`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Table structure for tb_forgotpassword
-- ----------------------------
DROP TABLE IF EXISTS `tb_forgotpassword`;
CREATE TABLE `tb_forgotpassword` (
  `forgot_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `question` enum('สัตว์เลี้ยงที่ชื่นชอบ','อาหารที่ชื่นชอบ','สีที่ชื่นชอบ','') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'สัตว์เลี้ยงที่ชื่นชอบ',
  `answer` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`forgot_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Table structure for tb_logins
-- ----------------------------
DROP TABLE IF EXISTS `tb_logins`;
CREATE TABLE `tb_logins` (
  `log_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Table structure for tb_organizations
-- ----------------------------
DROP TABLE IF EXISTS `tb_organizations`;
CREATE TABLE `tb_organizations` (
  `org_id` int NOT NULL AUTO_INCREMENT,
  `org_name` varchar(255) DEFAULT NULL,
  `org_address` varchar(255) DEFAULT NULL,
  `org_sub` varchar(100) DEFAULT NULL,
  `org_dis` varchar(100) DEFAULT NULL,
  `org_pro` varchar(100) DEFAULT NULL,
  `org_zip` varchar(5) DEFAULT NULL,
  `org_phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`org_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Table structure for tb_reports
-- ----------------------------
DROP TABLE IF EXISTS `tb_reports`;
CREATE TABLE `tb_reports` (
  `rep_id` int NOT NULL AUTO_INCREMENT,
  `rep_content` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rep_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Table structure for tb_users
-- ----------------------------
DROP TABLE IF EXISTS `tb_users`;
CREATE TABLE `tb_users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `sub` varchar(100) DEFAULT NULL,
  `dis` varchar(100) DEFAULT NULL,
  `prov` varchar(100) DEFAULT NULL,
  `zipcode` int DEFAULT NULL,
  `role` enum('ประชาชน','รัฐบาล','แอดมิน','') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'ประชาชน',
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `org_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  KEY `idx_users_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Table structure for tb_wallets
-- ----------------------------
DROP TABLE IF EXISTS `tb_wallets`;
CREATE TABLE `tb_wallets` (
  `wall_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `credit` decimal(12,2) DEFAULT NULL,
  `cash` decimal(14,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`wall_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Table structure for tb_wasterecords
-- ----------------------------
DROP TABLE IF EXISTS `tb_wasterecords`;
CREATE TABLE `tb_wasterecords` (
  `rec_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `org_id` int DEFAULT NULL,
  `type_id` int DEFAULT NULL,
  `weight` decimal(10,3) DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` enum('ใช้งานอยู่','ระงับ','ลบ') NOT NULL DEFAULT 'ใช้งานอยู่',
  `note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`rec_id`),
  KEY `idx_waste_user` (`user_id`),
  KEY `idx_waste_org` (`org_id`),
  KEY `idx_waste_type` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Table structure for tb_wastetypes
-- ----------------------------
DROP TABLE IF EXISTS `tb_wastetypes`;
CREATE TABLE `tb_wastetypes` (
  `type_id` int NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) DEFAULT NULL,
  `type_unit` varchar(50) DEFAULT NULL,
  `type_cash` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

SET FOREIGN_KEY_CHECKS = 1;
