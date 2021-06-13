/*
 Navicat MySQL Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80023
 Source Host           : localhost:3306
 Source Schema         : bttgive

 Target Server Type    : MySQL
 Target Server Version : 80023
 File Encoding         : 65001

 Date: 13/06/2021 20:32:39
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for achievement
-- ----------------------------
DROP TABLE IF EXISTS `achievement`;
CREATE TABLE `achievement` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `id_member` bigint DEFAULT NULL,
  `rating_reward` decimal(15,2) DEFAULT NULL,
  `id_rating` bigint DEFAULT NULL,
  `btt_amount` decimal(15,5) DEFAULT NULL,
  `id_user` bigint DEFAULT NULL,
  `user_wallet` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `proccessed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_rating` (`id_rating`),
  KEY `id_user` (`id_user`),
  KEY `id_member` (`id_member`),
  CONSTRAINT `achievement_ibfk_1` FOREIGN KEY (`id_rating`) REFERENCES `rating` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `achievement_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `achievement_ibfk_3` FOREIGN KEY (`id_member`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of achievement
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for authentication_log
-- ----------------------------
DROP TABLE IF EXISTS `authentication_log`;
CREATE TABLE `authentication_log` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `authenticatable_type` varchar(255) NOT NULL,
  `authenticatable_id` bigint unsigned NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `login_at` timestamp NULL DEFAULT NULL,
  `logout_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `authentication_log_authenticatable_type_authenticatable_id_index` (`authenticatable_type`,`authenticatable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of authentication_log
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for bonus
-- ----------------------------
DROP TABLE IF EXISTS `bonus`;
CREATE TABLE `bonus` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `debit` decimal(40,30) DEFAULT NULL,
  `credit` decimal(40,30) DEFAULT NULL,
  `type` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_member` bigint NOT NULL,
  `id_withdrawal` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_withdrawal` (`id_withdrawal`),
  KEY `id_member` (`id_member`),
  CONSTRAINT `bonus_ibfk_1` FOREIGN KEY (`id_withdrawal`) REFERENCES `withdrawal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bonus_ibfk_2` FOREIGN KEY (`id_member`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of bonus
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for contract
-- ----------------------------
DROP TABLE IF EXISTS `contract`;
CREATE TABLE `contract` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `price` decimal(15,2) DEFAULT NULL,
  `max_claim` int DEFAULT NULL,
  `min_wd` decimal(15,2) DEFAULT NULL,
  `max_wd` decimal(15,0) DEFAULT NULL,
  `fee_wd` int DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `price` (`price`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of contract
-- ----------------------------
BEGIN;
INSERT INTO `contract` VALUES (1, 50.00, 150, 10.00, 50, 5, '2021-05-05 00:00:00', '2021-05-05 00:00:00', NULL);
INSERT INTO `contract` VALUES (2, 100.00, 175, 10.00, 50, 5, '2021-05-05 00:00:00', '2021-05-05 00:00:00', NULL);
INSERT INTO `contract` VALUES (3, 200.00, 200, 10.00, 50, 5, '2021-05-05 00:00:00', '2021-05-05 00:00:00', NULL);
INSERT INTO `contract` VALUES (4, 500.00, 225, 10.00, 50, 5, '2021-05-05 00:00:00', '2021-05-05 00:00:00', NULL);
INSERT INTO `contract` VALUES (5, 1000.00, 250, 10.00, 50, 5, '2021-05-05 00:00:00', '2021-05-05 00:00:00', NULL);
INSERT INTO `contract` VALUES (6, 2000.00, 275, 10.00, 50, 5, '2021-05-05 00:00:00', '2021-05-05 00:00:00', NULL);
INSERT INTO `contract` VALUES (7, 5000.00, 300, 10.00, 50, 5, '2021-05-05 00:00:00', '2021-05-05 00:00:00', NULL);
INSERT INTO `contract` VALUES (8, 10000.00, 350, 10.00, 50, 5, '2021-05-05 00:00:00', '2021-05-05 00:00:00', NULL);
COMMIT;

-- ----------------------------
-- Table structure for deposit
-- ----------------------------
DROP TABLE IF EXISTS `deposit`;
CREATE TABLE `deposit` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `id_member` bigint DEFAULT NULL,
  `coin_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `wallet` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `amount` decimal(20,10) DEFAULT NULL,
  `requisite` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `id_user` bigint DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `information` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_member` (`id_member`),
  KEY `id_user` (`id_user`),
  KEY `coin_name` (`coin_name`),
  CONSTRAINT `deposit_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `deposit_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `deposit_ibfk_3` FOREIGN KEY (`coin_name`) REFERENCES `payment` (`name`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of deposit
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for information
-- ----------------------------
DROP TABLE IF EXISTS `information`;
CREATE TABLE `information` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `id_user` bigint DEFAULT NULL,
  `title` longtext,
  `content` longtext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `information_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of information
-- ----------------------------
BEGIN;
INSERT INTO `information` VALUES (1, 1, 'Hy', '<h3>Welcome</h3>', '2021-06-11 00:00:00', '2021-06-11 00:00:00');
INSERT INTO `information` VALUES (2, 1, 'Just Enjoy', 'Enjoy our program', '2021-06-11 00:00:00', '2021-06-11 00:00:00');
COMMIT;

-- ----------------------------
-- Table structure for invalid_turnover
-- ----------------------------
DROP TABLE IF EXISTS `invalid_turnover`;
CREATE TABLE `invalid_turnover` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `amount` decimal(65,2) NOT NULL,
  `position` tinyint(1) NOT NULL,
  `from_member` bigint NOT NULL,
  `id_member` bigint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_member` (`id_member`),
  CONSTRAINT `invalid_turnover_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of invalid_turnover
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_01_26_221915_create_coinpayment_transactions_table', 1);
INSERT INTO `migrations` VALUES (5, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (6, '2020_11_26_000000_create_spammers_table', 1);
INSERT INTO `migrations` VALUES (7, '2020_11_30_030150_create_coinpayment_transaction_items_table', 1);
INSERT INTO `migrations` VALUES (8, '2017_09_01_000000_create_authentication_log_table', 2);
COMMIT;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for payment
-- ----------------------------
DROP TABLE IF EXISTS `payment`;
CREATE TABLE `payment` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `wallet` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of payment
-- ----------------------------
BEGIN;
INSERT INTO `payment` VALUES (1, 'BTT', 'BTT_IDR', 'TDsk4h4nomdqqEXShRpWyUXXrANESRhVgT', 'BitTorrent Token', '2021-06-01 00:00:00', '2021-06-01 00:00:00', NULL);
INSERT INTO `payment` VALUES (2, 'DOGE', 'DOGE_IDR', 'D6amJueYAKWgNTQtELhbiVr9gqt1JZaqZA', 'Doge', '2021-06-01 00:00:00', '2021-06-01 00:00:00', NULL);
COMMIT;

-- ----------------------------
-- Table structure for rating
-- ----------------------------
DROP TABLE IF EXISTS `rating`;
CREATE TABLE `rating` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `min_turnover` decimal(15,2) DEFAULT NULL,
  `reward` decimal(15,2) DEFAULT NULL,
  `sort` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rating
-- ----------------------------
BEGIN;
INSERT INTO `rating` VALUES (1, 10000.00, 200.00, 1, '2021-06-07 00:00:00', '2021-06-07 00:00:00');
INSERT INTO `rating` VALUES (2, 50000.00, 1000.00, 2, '2021-06-07 00:00:00', '2021-06-07 00:00:00');
INSERT INTO `rating` VALUES (3, 100000.00, 2000.00, 3, '2021-06-07 00:00:00', '2021-06-07 00:00:00');
INSERT INTO `rating` VALUES (4, 500000.00, 10000.00, 4, '2021-06-07 00:00:00', '2021-06-07 00:00:00');
COMMIT;

-- ----------------------------
-- Table structure for recovery
-- ----------------------------
DROP TABLE IF EXISTS `recovery`;
CREATE TABLE `recovery` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `token` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `email` (`email`),
  CONSTRAINT `recovery_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of recovery
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for spammers
-- ----------------------------
DROP TABLE IF EXISTS `spammers`;
CREATE TABLE `spammers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) NOT NULL,
  `attempts` int NOT NULL,
  `blocked_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of spammers
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for ticket
-- ----------------------------
DROP TABLE IF EXISTS `ticket`;
CREATE TABLE `ticket` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `contract_price` decimal(15,2) DEFAULT NULL,
  `kode` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ticket
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `contract_price` decimal(15,2) DEFAULT NULL,
  `network` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `upline` bigint DEFAULT NULL,
  `position` smallint DEFAULT NULL,
  `left_referral` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `right_referral` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `id_rating` bigint DEFAULT NULL,
  `wallet` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `remember_token` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `google2fa_secret` text,
  `role` tinyint(1) DEFAULT '1',
  `actived_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `member_user` (`username`),
  UNIQUE KEY `member_email` (`email`) USING BTREE,
  KEY `anggota_paket_id_fkey` (`contract_price`),
  KEY `anggota_peringkat_id_fkey` (`id_rating`),
  KEY `user_ibfk_3` (`upline`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`contract_price`) REFERENCES `contract` (`price`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`id_rating`) REFERENCES `rating` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `user_ibfk_3` FOREIGN KEY (`upline`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES (1, 'administrator', '$2y$10$x7.wABGL.nWrpbTQjKBiZOSfmdlJUB6s4SZ/dRtHSAm8zaUcU82qi', 'Andi Fajar Nugraha', 'admin@bttgift.com', NULL, ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-05-05 00:00:00', '2021-06-13 12:26:00', NULL);
INSERT INTO `user` VALUES (10, 'james', '$2y$10$6RWytVL6R1r0EeHX8kOzIO13MCN59toig1puotiIL5EpiEZ./oUJa', 'Jaes Blund', 'andifajarlah@gmail.com', 500.00, '', NULL, NULL, '24bc50d85ad8fa9cda686145cf1f8aca0', '24bc50d85ad8fa9cda686145cf1f8aca1', '2021-06-15', NULL, '234234123', NULL, NULL, 1, '2021-06-09 00:00:00', '2021-06-09 04:30:35', '2021-06-13 12:11:57', NULL);
COMMIT;

-- ----------------------------
-- Table structure for withdrawal
-- ----------------------------
DROP TABLE IF EXISTS `withdrawal`;
CREATE TABLE `withdrawal` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `wallet` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `fee` decimal(15,2) NOT NULL,
  `btt_price` decimal(15,10) DEFAULT NULL,
  `acceptance` decimal(15,2) DEFAULT NULL,
  `accepted_btt` decimal(30,10) DEFAULT NULL,
  `id_member` bigint NOT NULL,
  `id_user` bigint DEFAULT NULL,
  `information` text,
  `processed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_member` (`id_member`),
  KEY `withdrawal_ibfk_2` (`id_user`),
  CONSTRAINT `withdrawal_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `withdrawal_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of withdrawal
-- ----------------------------
BEGIN;
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
