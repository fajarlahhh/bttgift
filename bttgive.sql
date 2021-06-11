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

 Date: 11/06/2021 16:42:44
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of achievement
-- ----------------------------
BEGIN;
INSERT INTO `achievement` VALUES (1, 10, 10000.00, 1, 1000.00000, NULL, NULL, NULL, NULL, NULL);
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
  CONSTRAINT `bonus_ibfk_1` FOREIGN KEY (`id_withdrawal`) REFERENCES `withdrawal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of bonus
-- ----------------------------
BEGIN;
INSERT INTO `bonus` VALUES (7, 'Referral 10% of 200.00 by fajasf', 0.000000000000000000000000000000, 0.000000000000000000000000000000, 'Referral', 10, NULL, '2021-06-10 22:12:47', '2021-06-10 22:12:47', NULL);
INSERT INTO `bonus` VALUES (8, 'Referral 10% of 200.00 by asdf', 0.000000000000000000000000000000, 0.000000000000000000000000000000, 'Referral', 10, NULL, '2021-06-10 22:12:48', '2021-06-10 22:12:48', NULL);
INSERT INTO `bonus` VALUES (9, 'Referral 10% of 200.00 by 2asdf', 0.000000000000000000000000000000, 0.000000000000000000000000000000, 'Referral', 10, NULL, '2021-06-10 22:12:49', '2021-06-10 22:12:49', NULL);
INSERT INTO `bonus` VALUES (10, 'Referral 10% of 200.00 by 2asdf124', 0.000000000000000000000000000000, 0.000000000000000000000000000000, 'Referral', 10, NULL, '2021-06-10 22:12:50', '2021-06-10 22:12:50', NULL);
INSERT INTO `bonus` VALUES (11, 'Referral 10% of 500.00 by 1234', 0.000000000000000000000000000000, 0.000000000000000000000000000000, 'Referral', 10, NULL, '2021-06-10 22:19:52', '2021-06-10 22:19:52', NULL);
INSERT INTO `bonus` VALUES (12, 'Referral 10% of 500.00 by asdf123', 0.000000000000000000000000000000, 0.000000000000000000000000000000, 'Referral', 10, NULL, '2021-06-10 22:46:55', '2021-06-10 22:46:55', NULL);
INSERT INTO `bonus` VALUES (13, 'Referral 10% of 100.00 by asdf123', 0.000000000000000000000000000000, 10.000000000000000000000000000000, 'Referral', 10, NULL, '2021-06-10 23:12:56', '2021-06-10 23:12:56', NULL);
INSERT INTO `bonus` VALUES (14, 'Pairing bonus 5% of 100.00 by asdf123', 0.000000000000000000000000000000, 5.000000000000000000000000000000, 'Turnover Growth', 10, NULL, '2021-06-10 23:12:56', '2021-06-10 23:12:56', NULL);
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
  `id_user` bigint NOT NULL,
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
INSERT INTO `contract` VALUES (1, 50.00, 150, 10.00, 50, 5, 1, '2021-05-05 00:00:00', '2021-05-05 00:00:00', NULL);
INSERT INTO `contract` VALUES (2, 100.00, 175, 10.00, 50, 5, 1, '2021-05-05 00:00:00', '2021-05-05 00:00:00', NULL);
INSERT INTO `contract` VALUES (3, 200.00, 200, 10.00, 50, 5, 1, '2021-05-05 00:00:00', '2021-05-05 00:00:00', NULL);
INSERT INTO `contract` VALUES (4, 500.00, 225, 10.00, 50, 5, 1, '2021-05-05 00:00:00', '2021-05-05 00:00:00', NULL);
INSERT INTO `contract` VALUES (5, 1000.00, 250, 10.00, 50, 5, 1, '2021-05-05 00:00:00', '2021-05-05 00:00:00', NULL);
INSERT INTO `contract` VALUES (6, 2000.00, 275, 10.00, 50, 5, 1, '2021-05-05 00:00:00', '2021-05-05 00:00:00', NULL);
INSERT INTO `contract` VALUES (7, 5000.00, 300, 10.00, 50, 5, 1, '2021-05-05 00:00:00', '2021-05-05 00:00:00', NULL);
INSERT INTO `contract` VALUES (8, 10000.00, 350, 10.00, 50, 5, 1, '2021-05-05 00:00:00', '2021-05-05 00:00:00', NULL);
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
  CONSTRAINT `deposit_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of deposit
-- ----------------------------
BEGIN;
INSERT INTO `deposit` VALUES (4, 10, 'DOGE', 'D6amJueYAKWgNTQtELhbiVr9gqt1JZaqZA', 1618.0000100000, 'Registration', 1, 'deposit/2021060905200602162321600260c04f82c3b4e.png', '12312312312312313123123123123', '2021-06-09 04:43:02', '2021-06-09 05:41:13', NULL, '2021-06-09 00:00:00');
INSERT INTO `deposit` VALUES (5, 11, 'DOGE', 'D6amJueYAKWgNTQtELhbiVr9gqt1JZaqZA', 1611.0000200000, 'Registration', 1, 'deposit/2021060905200602162321600260c04f82c3b4e.png', 'transfer jam 028312 dari wallet as23234', '2021-06-09 04:52:12', '2021-06-10 01:32:50', NULL, '2021-06-10 01:32:50');
INSERT INTO `deposit` VALUES (7, 11, 'DOGE', 'D6amJueYAKWgNTQtELhbiVr9gqt1JZaqZA', 1611.0000200000, 'Registration', 1, 'deposit/2021060905200602162321600260c04f82c3b4e.png', '12312312312312313123123123123\ntransfer jam 028312 dari wallet as23234', '2021-06-09 04:52:12', '2021-06-10 01:33:35', NULL, '2021-06-10 01:33:35');
INSERT INTO `deposit` VALUES (8, 11, 'DOGE', 'D6amJueYAKWgNTQtELhbiVr9gqt1JZaqZA', 1611.0000200000, 'Registration', 1, 'deposit/2021060905200602162321600260c04f82c3b4e.png', '12312312312312313123123123123\ntransfer jam 028312 dari wallet as23234', '2021-06-09 04:52:12', '2021-06-10 01:33:37', NULL, '2021-06-10 01:33:37');
INSERT INTO `deposit` VALUES (9, 11, 'DOGE', 'D6amJueYAKWgNTQtELhbiVr9gqt1JZaqZA', 1611.0000200000, 'Registration', 1, 'deposit/2021060905200602162321600260c04f82c3b4e.png', '12312312312312313123123123123\ntransfer jam 028312 dari wallet as23234', '2021-06-09 04:52:12', '2021-06-10 01:33:55', NULL, '2021-06-10 01:33:55');
INSERT INTO `deposit` VALUES (10, 11, 'DOGE', 'D6amJueYAKWgNTQtELhbiVr9gqt1JZaqZA', 1611.0000200000, 'Registration', 1, 'deposit/2021060905200602162321600260c04f82c3b4e.png', '12312312312312313123123123123\ntransfer jam 028312 dari wallet as23234', '2021-06-09 04:52:12', '2021-06-10 01:33:56', NULL, '2021-06-10 01:33:56');
INSERT INTO `deposit` VALUES (11, 11, 'DOGE', 'D6amJueYAKWgNTQtELhbiVr9gqt1JZaqZA', 1611.0000200000, 'Registration', 1, 'deposit/2021060905200602162321600260c04f82c3b4e.png', '12312312312312313123123123123\ntransfer jam 028312 dari wallet as23234', '2021-06-09 04:52:12', '2021-06-10 01:35:34', NULL, '2021-06-10 01:35:34');
INSERT INTO `deposit` VALUES (12, 11, 'DOGE', 'D6amJueYAKWgNTQtELhbiVr9gqt1JZaqZA', 1611.0000200000, 'Registration', 1, 'deposit/2021060905200602162321600260c04f82c3b4e.png', '12312312312312313123123123123\ntransfer jam 028312 dari wallet as23234', '2021-06-09 04:52:12', '2021-06-10 04:00:55', NULL, '2021-06-10 04:00:55');
INSERT INTO `deposit` VALUES (13, 11, 'DOGE', 'D6amJueYAKWgNTQtELhbiVr9gqt1JZaqZA', 1611.0000200000, 'Registration', 1, 'deposit/2021060905200602162321600260c04f82c3b4e.png', '12312312312312313123123123123\ntransfer jam 028312 dari wallet as23234', '2021-06-09 04:52:12', '2021-06-10 04:01:10', NULL, '2021-06-10 04:01:10');
INSERT INTO `deposit` VALUES (14, 11, 'DOGE', 'D6amJueYAKWgNTQtELhbiVr9gqt1JZaqZA', 1611.0000200000, 'Registration', 1, 'deposit/2021060905200602162321600260c04f82c3b4e.png', '12312312312312313123123123123\ntransfer jam 028312 dari wallet as23234', '2021-06-09 04:52:12', '2021-06-10 04:03:26', NULL, '2021-06-10 04:03:26');
INSERT INTO `deposit` VALUES (15, 11, 'DOGE', 'D6amJueYAKWgNTQtELhbiVr9gqt1JZaqZA', 1611.0000200000, 'Registration', 1, 'deposit/2021060905200602162321600260c04f82c3b4e.png', '12312312312312313123123123123\ntransfer jam 028312 dari wallet as23234', '2021-06-09 04:52:12', '2021-06-10 04:04:33', NULL, '2021-06-10 04:04:33');
INSERT INTO `deposit` VALUES (16, 11, 'DOGE', 'D6amJueYAKWgNTQtELhbiVr9gqt1JZaqZA', 1611.0000200000, 'Registration', 1, 'deposit/2021060905200602162321600260c04f82c3b4e.png', '12312312312312313123123123123\ntransfer jam 028312 dari wallet as23234', '2021-06-09 04:52:12', '2021-06-10 05:14:08', NULL, '2021-06-10 05:14:08');
INSERT INTO `deposit` VALUES (17, 12, 'DOGE', 'D6amJueYAKWgNTQtELhbiVr9gqt1JZaqZA', 632.0000100000, 'Registration', 1, 'deposit/2021060905200602162321600260c04f82c3b4e.png', 'asdf', '2021-06-10 15:38:01', '2021-06-10 22:12:47', NULL, '2021-06-10 22:12:47');
INSERT INTO `deposit` VALUES (18, 13, 'BTT', 'TDsk4h4nomdqqEXShRpWyUXXrANESRhVgT', 57693.0000200000, 'Registration', 1, 'deposit/2021060905200602162321600260c04f82c3b4e.png', 'asdf', '2021-06-10 22:00:07', '2021-06-10 22:12:48', NULL, '2021-06-10 22:12:48');
INSERT INTO `deposit` VALUES (19, 14, 'BTT', 'TDsk4h4nomdqqEXShRpWyUXXrANESRhVgT', 57693.0000200000, 'Registration', 1, 'deposit/2021060905200602162321600260c04f82c3b4e.png', 'asdf', '2021-06-10 22:02:03', '2021-06-10 22:12:49', NULL, '2021-06-10 22:12:49');
INSERT INTO `deposit` VALUES (20, 15, 'BTT', 'TDsk4h4nomdqqEXShRpWyUXXrANESRhVgT', 57693.0000300000, 'Registration', 1, 'deposit/2021060905200602162321600260c04f82c3b4e.png', 'asdf', '2021-06-10 22:03:27', '2021-06-10 22:12:50', NULL, '2021-06-10 22:12:50');
INSERT INTO `deposit` VALUES (21, 16, 'BTT', 'TDsk4h4nomdqqEXShRpWyUXXrANESRhVgT', 144231.0000100000, 'Registration', 1, 'deposit/1234-20210610-162336337760c28f31799fa.png', 'asdf', '2021-06-10 22:16:02', '2021-06-10 22:19:52', NULL, '2021-06-10 22:19:52');
INSERT INTO `deposit` VALUES (22, 17, 'DOGE', 'D6amJueYAKWgNTQtELhbiVr9gqt1JZaqZA', 1579.0000200000, 'Registration', 1, 'deposit/asdf123-20210610-162336371760c2908513bbc.png', 'asdf', '2021-06-10 22:21:46', '2021-06-10 23:12:56', NULL, '2021-06-10 23:12:56');
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of invalid_turnover
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`id`)
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ticket
-- ----------------------------
BEGIN;
INSERT INTO `ticket` VALUES (1, 500.00, 1, '2021-06-09', NULL, NULL);
INSERT INTO `ticket` VALUES (2, 500.00, 2, '2021-06-09', '2021-06-09 04:52:12', '2021-06-09 04:52:12');
INSERT INTO `ticket` VALUES (3, 200.00, 1, '2021-06-10', '2021-06-10 15:38:01', '2021-06-10 15:38:01');
INSERT INTO `ticket` VALUES (4, 200.00, 2, '2021-06-10', '2021-06-10 22:00:07', '2021-06-10 22:00:07');
INSERT INTO `ticket` VALUES (5, 200.00, 2, '2021-06-10', '2021-06-10 22:02:03', '2021-06-10 22:02:03');
INSERT INTO `ticket` VALUES (6, 200.00, 3, '2021-06-10', '2021-06-10 22:03:27', '2021-06-10 22:03:27');
INSERT INTO `ticket` VALUES (7, 500.00, 1, '2021-06-10', '2021-06-10 22:16:02', '2021-06-10 22:16:02');
INSERT INTO `ticket` VALUES (8, 500.00, 2, '2021-06-10', '2021-06-10 22:21:46', '2021-06-10 22:21:46');
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
INSERT INTO `user` VALUES (1, 'administrator', '$2y$10$7Apt6.YxianzCaEK4dp7K.C8aFqBEffbT5j2huz.e6JaXYtvg75Q6', 'Andi Fajar Nugraha', 'admin@bttgift.com', NULL, ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-05-05 00:00:00', '2021-06-11 07:18:48', NULL);
INSERT INTO `user` VALUES (10, 'fajar', '$2y$10$CvRFNEWVJO80I7ETb4XELO7RqisOXAVUqrLZY82TroGTVrfkc//m.', 'fajar', 'andifajarlahs@gmail.com', 500.00, '', NULL, NULL, '24bc50d85ad8fa9cda686145cf1f8aca0', '24bc50d85ad8fa9cda686145cf1f8aca1', NULL, NULL, '234234123', NULL, NULL, 1, '2021-06-09 00:00:00', '2021-06-09 04:30:35', '2021-06-11 07:18:57', NULL);
INSERT INTO `user` VALUES (11, 'andi', '$2y$10$H/sLeWTykoQHnRJIEKpn9uiZdBP.wtD9xndCPfpeE6hrxlIcKfdVG', 'andi', 'andi@gmail.com', 200.00, '10ki', 10, 0, 'ce0e5bf55e4f71749eade7a8b95c4e460', 'ce0e5bf55e4f71749eade7a8b95c4e461', NULL, NULL, '1234567890', NULL, NULL, 1, '2021-06-10 05:14:08', '2021-06-09 04:43:43', '2021-06-10 23:16:44', NULL);
INSERT INTO `user` VALUES (12, 'fajasf', '$2y$10$CxdhZm2uv9QT/dVtQEzGB.40zvXi9/I2byRGakDu6GUEdNsbQFcAC', '123', 'asdf@adf.casdf', 200.00, '10ki', 10, 0, 'a19e0863294c50a8833ce899ed52b0000', 'a19e0863294c50a8833ce899ed52b0001', NULL, NULL, NULL, NULL, NULL, 1, '2021-06-10 22:12:47', '2021-06-10 15:26:30', '2021-06-10 22:12:47', NULL);
INSERT INTO `user` VALUES (13, 'asdf', '$2y$10$n4aocj6uMRKrGz9TtUeGweThrMWcTshXxkHmAA0LgsXXD66cMqBoW', 'asdf', 'asdf@adsf', 200.00, '10ki', 10, 0, '912ec803b2ce49e4a541068d495ab5700', '912ec803b2ce49e4a541068d495ab5701', NULL, NULL, NULL, NULL, NULL, 1, '2021-06-10 22:12:47', '2021-06-10 21:57:36', '2021-06-10 22:12:48', NULL);
INSERT INTO `user` VALUES (14, '2asdf', '$2y$10$agXALWZr0J0F0G5eCaSSFu/87MpoLN.IxpSS1pYE63i6BZ2DVEdse', 'asdf', 'asd2123f@adf.casdf', 200.00, '10ki', 10, 0, 'a5f65d58f45b7c49649fbc3cae2cf1a70', 'a5f65d58f45b7c49649fbc3cae2cf1a71', NULL, NULL, NULL, NULL, NULL, 1, '2021-06-10 22:12:49', '2021-06-10 22:01:55', '2021-06-10 22:12:49', NULL);
INSERT INTO `user` VALUES (15, '2asdf124', '$2y$10$YRtxO2Ayy9zVMlmPHO79gOvV/yrB5/gSjBHrJubEo/Hon9m4YWI7.', 'asdf', '123asd2123f@adf.casdf', 200.00, '10ki', 10, 0, 'acc8a01f01eb525d81b7b548637f55c40', 'acc8a01f01eb525d81b7b548637f55c41', NULL, NULL, NULL, NULL, NULL, 1, '2021-06-10 22:12:50', '2021-06-10 22:03:20', '2021-06-10 22:12:50', NULL);
INSERT INTO `user` VALUES (16, '1234', '$2y$10$2turhWLUagC1CapYG1dRoujdmHe5ejYk1sLXDWhqybcRk7SWOgAAa', '1212123', 'asdf@asdfaf.asdf', 500.00, '10ka', 10, 1, '81dc9bdb52d04dc20036dbd8313ed0550', '81dc9bdb52d04dc20036dbd8313ed0551', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2021-06-10 22:15:56', '2021-06-10 22:19:52', NULL);
INSERT INTO `user` VALUES (17, 'asdf123', '$2y$10$wO.fhqyhczwaUFbtmAqGb.7O0O0zgIaRS3U1uImgx3ncuRJaomz8.', 'asdf', 'asdf@asdf.asdf', 100.00, '10ka', 10, 1, '6572bdaff799084b973320f43f09b3630', '6572bdaff799084b973320f43f09b3631', NULL, NULL, NULL, NULL, NULL, 1, '2021-06-10 23:12:56', '2021-06-10 22:21:38', '2021-06-10 23:12:56', NULL);
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
