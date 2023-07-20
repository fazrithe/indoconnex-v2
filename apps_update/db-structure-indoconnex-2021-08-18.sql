/*
 Navicat MySQL Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 50732
 Source Host           : localhost:3306
 Source Schema         : 2021indoconnex

 Target Server Type    : MySQL
 Target Server Version : 50732
 File Encoding         : 65001

 Date: 18/08/2021 03:24:32
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for _samples
-- ----------------------------
DROP TABLE IF EXISTS `_samples`;
CREATE TABLE `_samples` (
  `id` varchar(25) NOT NULL,
  `product_categories_id` varchar(25) DEFAULT NULL,
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` tinytext,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(2) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for _samples_categories
-- ----------------------------
DROP TABLE IF EXISTS `_samples_categories`;
CREATE TABLE `_samples_categories` (
  `id` varchar(25) NOT NULL,
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for _samples_files
-- ----------------------------
DROP TABLE IF EXISTS `_samples_files`;
CREATE TABLE `_samples_files` (
  `id` varchar(25) NOT NULL,
  `table_relation_id` varchar(25) NOT NULL,
  `file_position` int(11) DEFAULT '0',
  `file_type` varchar(255) DEFAULT NULL,
  `file_caption` varchar(255) DEFAULT NULL,
  `file_alt` varchar(255) DEFAULT NULL,
  `file_dimension` varchar(100) DEFAULT NULL,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_albums_id` (`table_relation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for apps_menus
-- ----------------------------
DROP TABLE IF EXISTS `apps_menus`;
CREATE TABLE `apps_menus` (
  `id` varchar(25) NOT NULL,
  `parent` varchar(255) DEFAULT '#',
  `menu_ordering` int(11) DEFAULT '1',
  `menu_level` int(11) DEFAULT '1',
  `menu_name` varchar(255) DEFAULT NULL,
  `menu_icon` varchar(255) DEFAULT NULL,
  `menu_link` varchar(255) DEFAULT NULL,
  `status` smallint(2) DEFAULT '1',
  `menu_display` smallint(2) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for apps_operator
-- ----------------------------
DROP TABLE IF EXISTS `apps_operator`;
CREATE TABLE `apps_operator` (
  `id` varchar(25) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name_full` varchar(255) NOT NULL,
  `name_nick` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `operator_access` varchar(255) NOT NULL COMMENT 'JSON Level Access',
  `status` smallint(2) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for apps_operator_acl
-- ----------------------------
DROP TABLE IF EXISTS `apps_operator_acl`;
CREATE TABLE `apps_operator_acl` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) NOT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for apps_operator_privilege
-- ----------------------------
DROP TABLE IF EXISTS `apps_operator_privilege`;
CREATE TABLE `apps_operator_privilege` (
  `operator_id` varchar(25) NOT NULL,
  `menus_id` varchar(25) NOT NULL,
  `privilege` int(4) DEFAULT '1111',
  PRIMARY KEY (`operator_id`,`menus_id`),
  KEY `menus_id` (`menus_id`),
  CONSTRAINT `apps_operator_privilege_ibfk_1` FOREIGN KEY (`operator_id`) REFERENCES `apps_operator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `apps_operator_privilege_ibfk_2` FOREIGN KEY (`menus_id`) REFERENCES `apps_menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ci_sessions
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mst_courses_privates
-- ----------------------------
DROP TABLE IF EXISTS `mst_courses_privates`;
CREATE TABLE `mst_courses_privates` (
  `id` varchar(25) NOT NULL,
  `data_position` int(11) NOT NULL DEFAULT '0',
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mst_educations
-- ----------------------------
DROP TABLE IF EXISTS `mst_educations`;
CREATE TABLE `mst_educations` (
  `id` varchar(25) NOT NULL,
  `data_position` int(11) NOT NULL DEFAULT '0',
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mst_hobbies
-- ----------------------------
DROP TABLE IF EXISTS `mst_hobbies`;
CREATE TABLE `mst_hobbies` (
  `id` varchar(25) NOT NULL,
  `data_position` int(11) NOT NULL DEFAULT '0',
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mst_licenses
-- ----------------------------
DROP TABLE IF EXISTS `mst_licenses`;
CREATE TABLE `mst_licenses` (
  `id` varchar(25) NOT NULL,
  `data_position` int(11) NOT NULL DEFAULT '0',
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mst_skills
-- ----------------------------
DROP TABLE IF EXISTS `mst_skills`;
CREATE TABLE `mst_skills` (
  `id` varchar(25) NOT NULL,
  `data_position` int(11) NOT NULL DEFAULT '0',
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mst_works_experiences
-- ----------------------------
DROP TABLE IF EXISTS `mst_works_experiences`;
CREATE TABLE `mst_works_experiences` (
  `id` varchar(25) NOT NULL,
  `data_position` int(11) NOT NULL DEFAULT '0',
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pbd_business
-- ----------------------------
DROP TABLE IF EXISTS `pbd_business`;
CREATE TABLE `pbd_business` (
  `id` varchar(25) NOT NULL,
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `bd_regnumber` varchar(255) DEFAULT NULL,
  `bd_email` varchar(255) DEFAULT NULL,
  `bd_phone` varchar(255) DEFAULT NULL,
  `bd_address` varchar(255) DEFAULT NULL,
  `bd_hours_open` varchar(255) DEFAULT NULL,
  `bd_hours_work` varchar(255) DEFAULT NULL,
  `bd_paymentmethod` varchar(255) DEFAULT NULL,
  `bd_team_number` varchar(255) DEFAULT NULL,
  `bd_annual_sales` varchar(255) DEFAULT NULL,
  `bd_established_year` varchar(4) DEFAULT NULL,
  `bd_established_date` date DEFAULT NULL,
  `bd_main_markets` varchar(255) DEFAULT NULL,
  `stats_resume_follow` bigint(20) NOT NULL DEFAULT '0' COMMENT 'counting data',
  `stats_resume_likes` bigint(20) NOT NULL DEFAULT '0' COMMENT 'counting data',
  `data_categories` text COMMENT 'Data format JSON, multiple id categories',
  `data_types` text COMMENT 'Data format JSON, multiple id categories',
  `data_about` text COMMENT 'Data format JSON',
  `data_social_links` text COMMENT 'Data format JSON',
  `data_team` text COMMENT 'Data format JSON',
  `data_staff` text COMMENT 'Data format JSON',
  `data_locations` text COMMENT 'Data format JSON',
  `data_certifications` text COMMENT 'Data format JSON',
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status_verification` tinyint(1) NOT NULL DEFAULT '0',
  `status_privacy` tinyint(1) NOT NULL DEFAULT '0',
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pbd_business_categories
-- ----------------------------
DROP TABLE IF EXISTS `pbd_business_categories`;
CREATE TABLE `pbd_business_categories` (
  `id` varchar(25) NOT NULL,
  `data_position` int(11) NOT NULL DEFAULT '0',
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pbd_business_files
-- ----------------------------
DROP TABLE IF EXISTS `pbd_business_files`;
CREATE TABLE `pbd_business_files` (
  `id` varchar(25) NOT NULL,
  `pbd_business_id` varchar(25) NOT NULL,
  `pbd_business_files_categories_id` varchar(25) DEFAULT NULL COMMENT 'Optional',
  `file_position` int(11) DEFAULT '0' COMMENT 'ordering data',
  `file_type` varchar(255) DEFAULT NULL,
  `file_caption` varchar(255) DEFAULT NULL,
  `file_alt` varchar(255) DEFAULT NULL,
  `file_dimension` varchar(100) DEFAULT NULL,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_albums_id` (`pbd_business_id`),
  KEY `pbd_business_files_id` (`pbd_business_files_categories_id`),
  CONSTRAINT `pbd_business_files_ibfk_1` FOREIGN KEY (`pbd_business_id`) REFERENCES `pbd_business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pbd_business_files_ibfk_2` FOREIGN KEY (`pbd_business_files_categories_id`) REFERENCES `pbd_business_files_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pbd_business_files_categories
-- ----------------------------
DROP TABLE IF EXISTS `pbd_business_files_categories`;
CREATE TABLE `pbd_business_files_categories` (
  `id` varchar(25) NOT NULL,
  `data_position` int(11) NOT NULL DEFAULT '0',
  `pbd_business_id` varchar(25) DEFAULT NULL,
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(25) DEFAULT NULL,
  `data_description` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `status_disable` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 : Default , 1 : Can''t Delete',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pdb_business_id` (`pbd_business_id`),
  CONSTRAINT `pbd_business_files_categories_ibfk_1` FOREIGN KEY (`pbd_business_id`) REFERENCES `pbd_business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pbd_business_follows
-- ----------------------------
DROP TABLE IF EXISTS `pbd_business_follows`;
CREATE TABLE `pbd_business_follows` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pbd_business_id` varchar(25) NOT NULL COMMENT 'this user action to follow people',
  `user_follow_id` varchar(25) NOT NULL COMMENT 'people',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pbd_business_likes
-- ----------------------------
DROP TABLE IF EXISTS `pbd_business_likes`;
CREATE TABLE `pbd_business_likes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pbd_business_id` varchar(25) NOT NULL COMMENT 'this user action to follow people',
  `user_follow_id` varchar(25) NOT NULL COMMENT 'people',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pbd_business_photo
-- ----------------------------
DROP TABLE IF EXISTS `pbd_business_photo`;
CREATE TABLE `pbd_business_photo` (
  `id` varchar(25) NOT NULL,
  `pbd_business_id` varchar(25) NOT NULL,
  `pbd_business_categories_id` varchar(25) DEFAULT NULL COMMENT 'Optional',
  `file_position` int(11) DEFAULT '0' COMMENT 'ordering data',
  `file_type` varchar(255) DEFAULT NULL,
  `file_caption` varchar(255) DEFAULT NULL,
  `file_alt` varchar(255) DEFAULT NULL,
  `file_dimension` varchar(100) DEFAULT NULL,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_albums_id` (`pbd_business_id`),
  KEY `pdb_business_categories_id` (`pbd_business_categories_id`),
  CONSTRAINT `pbd_business_photo_ibfk_1` FOREIGN KEY (`pbd_business_id`) REFERENCES `pbd_business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pbd_business_photo_ibfk_2` FOREIGN KEY (`pbd_business_categories_id`) REFERENCES `pbd_business_photo_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pbd_business_photo_categories
-- ----------------------------
DROP TABLE IF EXISTS `pbd_business_photo_categories`;
CREATE TABLE `pbd_business_photo_categories` (
  `id` varchar(25) NOT NULL,
  `data_position` int(11) NOT NULL DEFAULT '0',
  `pbd_business_id` varchar(25) DEFAULT NULL,
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `status_disable` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 : Default , 1 : Can''t Delete',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pbd_business_types
-- ----------------------------
DROP TABLE IF EXISTS `pbd_business_types`;
CREATE TABLE `pbd_business_types` (
  `id` varchar(25) NOT NULL,
  `data_position` int(11) NOT NULL DEFAULT '0',
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pbd_items
-- ----------------------------
DROP TABLE IF EXISTS `pbd_items`;
CREATE TABLE `pbd_items` (
  `id` varchar(25) NOT NULL,
  `pbd_business_id` varchar(25) NOT NULL,
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `data_categories` text COMMENT 'Data format JSON, multiple id categories',
  `price_low` double NOT NULL DEFAULT '0',
  `price_high` double NOT NULL DEFAULT '0',
  `price_discount` double NOT NULL DEFAULT '0' COMMENT 'Optional',
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pdb_business_id` (`pbd_business_id`),
  CONSTRAINT `pbd_items_ibfk_1` FOREIGN KEY (`pbd_business_id`) REFERENCES `pbd_business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pbd_items_categories
-- ----------------------------
DROP TABLE IF EXISTS `pbd_items_categories`;
CREATE TABLE `pbd_items_categories` (
  `id` varchar(25) NOT NULL,
  `data_position` int(11) NOT NULL DEFAULT '0',
  `pbd_business_id` varchar(25) DEFAULT NULL,
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pdb_business_id` (`pbd_business_id`),
  CONSTRAINT `pbd_items_categories_ibfk_1` FOREIGN KEY (`pbd_business_id`) REFERENCES `pbd_business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pbd_items_follows
-- ----------------------------
DROP TABLE IF EXISTS `pbd_items_follows`;
CREATE TABLE `pbd_items_follows` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pbd_items_id` varchar(25) NOT NULL COMMENT 'this user action to follow people',
  `user_follow_id` varchar(25) NOT NULL COMMENT 'people',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pbd_items_likes
-- ----------------------------
DROP TABLE IF EXISTS `pbd_items_likes`;
CREATE TABLE `pbd_items_likes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pbd_items_id` varchar(25) NOT NULL COMMENT 'this user action to follow people',
  `user_follow_id` varchar(25) NOT NULL COMMENT 'people',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pbd_items_photo
-- ----------------------------
DROP TABLE IF EXISTS `pbd_items_photo`;
CREATE TABLE `pbd_items_photo` (
  `id` varchar(25) NOT NULL,
  `pbd_business_id` varchar(25) NOT NULL,
  `pbd_items_id` varchar(25) NOT NULL,
  `pbd_items_photo_categories_id` varchar(25) DEFAULT NULL COMMENT 'Optional',
  `file_position` int(11) DEFAULT '0',
  `file_type` varchar(255) DEFAULT NULL,
  `file_caption` varchar(255) DEFAULT NULL,
  `file_alt` varchar(255) DEFAULT NULL,
  `file_dimension` varchar(100) DEFAULT NULL,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_albums_id` (`pbd_items_id`),
  KEY `pdb_items_photo_categories` (`pbd_items_photo_categories_id`),
  KEY `pdb_business_id` (`pbd_business_id`),
  CONSTRAINT `pbd_items_photo_ibfk_2` FOREIGN KEY (`pbd_items_id`) REFERENCES `pbd_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pbd_items_photo_ibfk_3` FOREIGN KEY (`pbd_items_photo_categories_id`) REFERENCES `pbd_items_photo_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pbd_items_photo_ibfk_4` FOREIGN KEY (`pbd_business_id`) REFERENCES `pbd_business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pbd_items_photo_categories
-- ----------------------------
DROP TABLE IF EXISTS `pbd_items_photo_categories`;
CREATE TABLE `pbd_items_photo_categories` (
  `id` varchar(25) NOT NULL,
  `pbd_business_id` varchar(25) DEFAULT NULL,
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) NOT NULL,
  `data_description` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `status_disable` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 : Default , 1 : Can''t Delete',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pdb_business_id` (`pbd_business_id`),
  CONSTRAINT `pbd_items_photo_categories_ibfk_1` FOREIGN KEY (`pbd_business_id`) REFERENCES `pbd_business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pcj_jobs
-- ----------------------------
DROP TABLE IF EXISTS `pcj_jobs`;
CREATE TABLE `pcj_jobs` (
  `id` varchar(25) NOT NULL,
  `users_id` varchar(25) NOT NULL,
  `pbd_business_id` varchar(25) DEFAULT NULL COMMENT 'if type business_id',
  `data_type` enum('personal','business') NOT NULL,
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `data_categories` text COMMENT 'Data format JSON, multiple id categories',
  `data_location` text,
  `jobs_types_id` varchar(25) NOT NULL,
  `jobs_industries_id` varchar(25) NOT NULL,
  `jobs_salary_period_id` varchar(25) NOT NULL,
  `jobs_experiences_id` varchar(25) NOT NULL,
  `jb_salary_min` double NOT NULL DEFAULT '0',
  `jb_salary_max` double NOT NULL DEFAULT '0',
  `jb_contact_from` varchar(100) DEFAULT NULL,
  `jb_contact_number` varchar(50) DEFAULT NULL,
  `jb_receive_app_email` tinyint(1) NOT NULL DEFAULT '0',
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pdb_business_id` (`pbd_business_id`),
  KEY `users_id` (`users_id`),
  KEY `jobs_experiences_id` (`jobs_experiences_id`),
  KEY `jobs_industries_id` (`jobs_industries_id`),
  KEY `jobs_salary_period_id` (`jobs_salary_period_id`),
  KEY `jobs_types_id` (`jobs_types_id`),
  CONSTRAINT `pcj_jobs_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pcj_jobs_ibfk_2` FOREIGN KEY (`pbd_business_id`) REFERENCES `pbd_business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pcj_jobs_ibfk_3` FOREIGN KEY (`jobs_experiences_id`) REFERENCES `pcj_jobs_experiences` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pcj_jobs_ibfk_4` FOREIGN KEY (`jobs_industries_id`) REFERENCES `pcj_jobs_industries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pcj_jobs_ibfk_5` FOREIGN KEY (`jobs_salary_period_id`) REFERENCES `pcj_jobs_salary_period` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pcj_jobs_ibfk_6` FOREIGN KEY (`jobs_types_id`) REFERENCES `pcj_jobs_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pcj_jobs_applicants
-- ----------------------------
DROP TABLE IF EXISTS `pcj_jobs_applicants`;
CREATE TABLE `pcj_jobs_applicants` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `users_id` varchar(25) NOT NULL COMMENT 'people',
  `jobs_id` varchar(25) NOT NULL,
  `data_description` text,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`users_id`),
  KEY `jobs_id` (`jobs_id`),
  CONSTRAINT `pcj_jobs_applicants_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `pcj_jobs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pcj_jobs_applicants_ibfk_2` FOREIGN KEY (`jobs_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pcj_jobs_experiences
-- ----------------------------
DROP TABLE IF EXISTS `pcj_jobs_experiences`;
CREATE TABLE `pcj_jobs_experiences` (
  `id` varchar(25) NOT NULL,
  `data_position` int(11) NOT NULL DEFAULT '0',
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pcj_jobs_industries
-- ----------------------------
DROP TABLE IF EXISTS `pcj_jobs_industries`;
CREATE TABLE `pcj_jobs_industries` (
  `id` varchar(25) NOT NULL,
  `data_position` int(11) NOT NULL DEFAULT '0',
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pcj_jobs_salary_period
-- ----------------------------
DROP TABLE IF EXISTS `pcj_jobs_salary_period`;
CREATE TABLE `pcj_jobs_salary_period` (
  `id` varchar(25) NOT NULL,
  `data_position` int(11) NOT NULL DEFAULT '0',
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pcj_jobs_types
-- ----------------------------
DROP TABLE IF EXISTS `pcj_jobs_types`;
CREATE TABLE `pcj_jobs_types` (
  `id` varchar(25) NOT NULL,
  `data_position` int(11) NOT NULL DEFAULT '0',
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pcs_communities
-- ----------------------------
DROP TABLE IF EXISTS `pcs_communities`;
CREATE TABLE `pcs_communities` (
  `id` varchar(25) NOT NULL,
  `users_id` varchar(25) NOT NULL COMMENT 'Creators',
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `data_categories` text COMMENT '	Data format JSON, multiple id categories',
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status_privacy` tinyint(1) NOT NULL DEFAULT '0',
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`users_id`),
  CONSTRAINT `pcs_communities_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pcs_communities_albums
-- ----------------------------
DROP TABLE IF EXISTS `pcs_communities_albums`;
CREATE TABLE `pcs_communities_albums` (
  `id` varchar(25) NOT NULL,
  `user_id` varchar(25) NOT NULL COMMENT 'Creator Albums',
  `pcs_communities_id` varchar(25) NOT NULL,
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `users_albums_categories_id` (`pcs_communities_id`),
  CONSTRAINT `pcs_communities_albums_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pcs_communities_albums_ibfk_2` FOREIGN KEY (`pcs_communities_id`) REFERENCES `pcs_communities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pcs_communities_albums_photo
-- ----------------------------
DROP TABLE IF EXISTS `pcs_communities_albums_photo`;
CREATE TABLE `pcs_communities_albums_photo` (
  `id` varchar(25) NOT NULL,
  `users_id` varchar(25) NOT NULL,
  `pcs_communities_id` varchar(25) DEFAULT NULL,
  `pcs_communities_albums_id` varchar(25) DEFAULT NULL COMMENT 'Optional',
  `file_position` int(11) DEFAULT '0',
  `file_type` varchar(255) DEFAULT NULL,
  `file_caption` varchar(255) DEFAULT NULL,
  `file_alt` varchar(255) DEFAULT NULL,
  `file_dimension` varchar(100) DEFAULT NULL,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`users_id`),
  KEY `users_albums_id` (`pcs_communities_id`),
  KEY `albums_id` (`pcs_communities_albums_id`),
  CONSTRAINT `pcs_communities_albums_photo_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pcs_communities_albums_photo_ibfk_2` FOREIGN KEY (`pcs_communities_id`) REFERENCES `pcs_communities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pcs_communities_albums_photo_ibfk_3` FOREIGN KEY (`pcs_communities_albums_id`) REFERENCES `pcs_communities_albums` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pcs_communities_categories
-- ----------------------------
DROP TABLE IF EXISTS `pcs_communities_categories`;
CREATE TABLE `pcs_communities_categories` (
  `id` varchar(25) NOT NULL,
  `data_position` int(11) NOT NULL DEFAULT '0',
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='pfe_articles_categories';

-- ----------------------------
-- Table structure for pfe_articles
-- ----------------------------
DROP TABLE IF EXISTS `pfe_articles`;
CREATE TABLE `pfe_articles` (
  `id` varchar(25) NOT NULL,
  `users_id` varchar(25) NOT NULL,
  `pbd_business_id` varchar(25) DEFAULT NULL COMMENT 'if type business_id',
  `data_type` enum('personal','business') NOT NULL,
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `data_categories` text,
  `data_tags` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`users_id`),
  KEY `pdb_business_id` (`pbd_business_id`),
  CONSTRAINT `pfe_articles_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pfe_articles_ibfk_2` FOREIGN KEY (`pbd_business_id`) REFERENCES `pbd_business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pfe_articles_categories
-- ----------------------------
DROP TABLE IF EXISTS `pfe_articles_categories`;
CREATE TABLE `pfe_articles_categories` (
  `id` varchar(25) NOT NULL,
  `parent` varchar(25) NOT NULL DEFAULT '0',
  `data_position` int(11) NOT NULL DEFAULT '0',
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='pfe_articles_categories';

-- ----------------------------
-- Table structure for pfe_media_comments
-- ----------------------------
DROP TABLE IF EXISTS `pfe_media_comments`;
CREATE TABLE `pfe_media_comments` (
  `id` varchar(25) NOT NULL,
  `relate_id` varchar(25) NOT NULL COMMENT 'foreign key from table',
  `relate_table` varchar(255) NOT NULL COMMENT 'relation table name. ex : users_albums_photo',
  `parent` varchar(25) NOT NULL DEFAULT '0' COMMENT 'if post quotes / reply from other post',
  `users_id` varchar(25) NOT NULL,
  `data_description` longtext,
  `file_image_path` varchar(120) DEFAULT NULL,
  `file_image_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_image_name_original` varchar(255) DEFAULT NULL,
  `file_image_url` varchar(255) DEFAULT NULL,
  `file_video_path` varchar(150) DEFAULT NULL,
  `file_video_name` varchar(150) DEFAULT NULL,
  `file_video_url` varchar(255) DEFAULT NULL COMMENT 'if external link, (ex : Youtube Link)',
  `published` datetime NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pfe_media_likes
-- ----------------------------
DROP TABLE IF EXISTS `pfe_media_likes`;
CREATE TABLE `pfe_media_likes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `users_id` varchar(25) NOT NULL COMMENT 'people',
  `relate_id` varchar(25) NOT NULL COMMENT 'foreign key from table',
  `relate_table` varchar(100) NOT NULL COMMENT 'relation table name. ex : users_albums_photo',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pfe_posts
-- ----------------------------
DROP TABLE IF EXISTS `pfe_posts`;
CREATE TABLE `pfe_posts` (
  `id` varchar(25) NOT NULL,
  `parent` varchar(25) NOT NULL DEFAULT '0' COMMENT 'if post quotes / reply from other post',
  `users_id` varchar(25) NOT NULL,
  `data_description` longtext,
  `file_image_path` varchar(120) DEFAULT NULL,
  `file_image_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_image_name_original` varchar(255) DEFAULT NULL,
  `file_image_url` varchar(255) DEFAULT NULL,
  `file_video_path` varchar(150) DEFAULT NULL,
  `file_video_name` varchar(150) DEFAULT NULL,
  `file_video_url` varchar(255) DEFAULT NULL COMMENT 'if external link, (ex : Youtube Link)',
  `published` datetime NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`users_id`),
  CONSTRAINT `pfe_posts_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pnu_news
-- ----------------------------
DROP TABLE IF EXISTS `pnu_news`;
CREATE TABLE `pnu_news` (
  `id` varchar(25) NOT NULL,
  `users_id` varchar(25) NOT NULL,
  `pbd_business_id` varchar(25) DEFAULT NULL COMMENT 'if type business_id',
  `data_type` enum('personal','business') NOT NULL,
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `data_categories` text,
  `data_tags` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`users_id`),
  KEY `pdb_business_id` (`pbd_business_id`),
  CONSTRAINT `pnu_news_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pnu_news_ibfk_2` FOREIGN KEY (`pbd_business_id`) REFERENCES `pbd_business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pnu_news_categories
-- ----------------------------
DROP TABLE IF EXISTS `pnu_news_categories`;
CREATE TABLE `pnu_news_categories` (
  `id` varchar(25) NOT NULL,
  `parent` varchar(25) NOT NULL DEFAULT '0',
  `data_position` int(11) NOT NULL DEFAULT '0',
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='pfe_articles_categories';

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` varchar(25) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `data_status` varchar(255) DEFAULT NULL,
  `data_locations` text,
  `data_permalinks` varchar(255) NOT NULL,
  `name_full` varchar(255) NOT NULL,
  `name_nick` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `stats_user_followers` int(11) NOT NULL DEFAULT '0',
  `stats_user_following` int(11) NOT NULL DEFAULT '0',
  `stats_business_follow` int(11) NOT NULL DEFAULT '0',
  `stats_business_following` int(11) NOT NULL DEFAULT '0',
  `data_pro_status` varchar(255) DEFAULT NULL COMMENT 'Use for Status',
  `data_pro_hobby` text COMMENT 'Data Format JSON',
  `data_pro_skills` text COMMENT 'Data Format JSON',
  `data_social_links` text COMMENT 'Data Format JSON',
  `data_community` text COMMENT 'Data Format JSON',
  `data_education` text COMMENT 'Data Format JSON',
  `data_license` text COMMENT 'Data Format JSON',
  `data_crs_private` text COMMENT 'Data Format JSON',
  `data_exp_work` text COMMENT 'Data Format JSON',
  `data_exp_volunteer` text COMMENT 'Data Format JSON',
  `data_contact_info` text COMMENT 'Data Format JSON',
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `cover_file_path` varchar(120) DEFAULT NULL,
  `cover_file_name_thumbnail` varchar(255) DEFAULT NULL,
  `cover_file_name_original` varchar(255) DEFAULT NULL,
  `cover_file_json` text,
  `code_registration` text,
  `users_access` varchar(255) NOT NULL COMMENT 'JSON Level Access',
  `status_privacy` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 : private, 1 : public',
  `status` smallint(2) NOT NULL DEFAULT '0' COMMENT '0 : Not Active, 1 : Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for users_acl
-- ----------------------------
DROP TABLE IF EXISTS `users_acl`;
CREATE TABLE `users_acl` (
  `id` varchar(25) NOT NULL,
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) NOT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for users_albums
-- ----------------------------
DROP TABLE IF EXISTS `users_albums`;
CREATE TABLE `users_albums` (
  `id` varchar(25) NOT NULL,
  `users_id` varchar(25) NOT NULL,
  `users_albums_categories_id` varchar(25) NOT NULL,
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`users_id`),
  KEY `users_albums_categories_id` (`users_albums_categories_id`),
  CONSTRAINT `users_albums_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `users_albums_ibfk_2` FOREIGN KEY (`users_albums_categories_id`) REFERENCES `users_albums_categories` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for users_albums_categories
-- ----------------------------
DROP TABLE IF EXISTS `users_albums_categories`;
CREATE TABLE `users_albums_categories` (
  `id` varchar(25) NOT NULL,
  `data_position` int(11) NOT NULL DEFAULT '0',
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `status_disable` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 : Default , 1 : Can''t Delete',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Data Categories Made by Administrators';

-- ----------------------------
-- Table structure for users_albums_photo
-- ----------------------------
DROP TABLE IF EXISTS `users_albums_photo`;
CREATE TABLE `users_albums_photo` (
  `id` varchar(25) NOT NULL,
  `users_id` varchar(25) NOT NULL,
  `users_albums_id` varchar(25) DEFAULT NULL COMMENT 'Optional',
  `file_position` int(11) DEFAULT '0',
  `file_type` varchar(255) DEFAULT NULL,
  `file_caption` varchar(255) DEFAULT NULL,
  `file_alt` varchar(255) DEFAULT NULL,
  `file_dimension` varchar(100) DEFAULT NULL,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`users_id`),
  KEY `users_albums_id` (`users_albums_id`),
  CONSTRAINT `users_albums_photo_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_albums_photo_ibfk_2` FOREIGN KEY (`users_albums_id`) REFERENCES `users_albums` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for users_devices_sess
-- ----------------------------
DROP TABLE IF EXISTS `users_devices_sess`;
CREATE TABLE `users_devices_sess` (
  `id` varchar(25) NOT NULL,
  `user_id` varchar(25) DEFAULT NULL,
  `devices_type` enum('Mobile','Website') NOT NULL,
  `devices_agents` text,
  `devices_name` varchar(255) NOT NULL,
  `devices_location` text,
  `devices_added` datetime DEFAULT NULL,
  `browser_name` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0' COMMENT '0: Not Active , 1: Active, 2 : Log Off',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `users_devices_sess_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for users_follows
-- ----------------------------
DROP TABLE IF EXISTS `users_follows`;
CREATE TABLE `users_follows` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(25) NOT NULL COMMENT 'this user action to follow people',
  `user_follow_id` varchar(25) NOT NULL COMMENT 'people',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
