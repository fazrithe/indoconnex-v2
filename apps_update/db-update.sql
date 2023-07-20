-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 14, 2021 at 09:42 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `2021indoconnex`
--

-- --------------------------------------------------------

--
-- Table structure for table `apps_operator`
--

CREATE TABLE `apps_operator`
(
    `id`                  varchar(25)  NOT NULL,
    `username`            varchar(255) NOT NULL,
    `password`            varchar(255) NOT NULL,
    `email`               varchar(255) NOT NULL,
    `name_full`           varchar(255) NOT NULL,
    `name_nick`           varchar(255) NOT NULL,
    `phone`               varchar(255) NOT NULL,
    `file_path`           varchar(120)          DEFAULT NULL,
    `file_name_thumbnail` varchar(255)          DEFAULT NULL,
    `file_name_original`  varchar(255)          DEFAULT NULL,
    `file_json`           text,
    `operator_access`     varchar(255) NOT NULL COMMENT 'JSON Level Access',
    `status`              smallint(2)  NOT NULL DEFAULT '0',
    `created_at`          datetime              DEFAULT NULL,
    `created_by`          varchar(25)           DEFAULT NULL,
    `updated_at`          timestamp    NULL     DEFAULT NULL,
    `updated_by`          varchar(25)           DEFAULT NULL,
    `deleted_at`          datetime              DEFAULT NULL,
    `deleted_by`          varchar(25)           DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

--
-- Dumping data for table `apps_operator`
--

INSERT INTO `apps_operator` (`id`, `username`, `password`, `email`, `name_full`, `name_nick`, `phone`, `file_path`,
                             `file_name_thumbnail`, `file_name_original`, `file_json`, `operator_access`, `status`,
                             `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`)
VALUES ('21070760E52834C6893', 'admin_1',
        '9da4f01d42c15a78550a062cd14dbdabf8ac69fcbc9f4d516ae3bb838183fe25d7ea65ae332941de07753419a882bd3f51cdbea71f3808583b16408c2d9e9463slzcoGuS2782pu410ijSCda7n1GaO/qo+sPPRF6z/bQ9PdhZMJb/o/1rGvKYaDKqmWuIEgEK9ai76Qp3FQvWe9/1RtrYcKlpcCSp0otZK6Q=',
        '4bb5421e52ff9178b6f3212dc59d64da0dee42305d1bc64fbd2f9947739e07019914cfd549b016c34cf4275d0d9092c98604a1f65711c0c5836cc7fbca4769b3vm920lQpPCtqEZabNw+MBA0vjCwkf4bo+7L8WESSFWZZXLFv2+lWD479/49Rty37',
        '262a8faaa8abcce267a38846321e065af92a5caccfda8213683078fcac4d6839fcc42531ff3d3621a59acb5d637bc66b56782cfa53e360a7ed088664f67d13acXF2LE6IIH/L3uukIVL0ZoqLIPcdhpjYILSBT9bQ2+4gVgQ9d0lPD0lQU1V2fR5Af',
        '7c66232e75e6efa3d08d7ab329918824efc8cecf77746f41d3e104a179a775be137e330563ce13d3e13364453a54f51860afc30d86820f7f84480649cc4a52beLphuovxaZo3qynI6iK92rHchsnroGeSosbrxCrYkhsU=',
        '2354688dfdee0c457823e76f73361630d47980257793b59d01df4c22f8934265961509e703318f7f657e2a982da082c59aab1c1997c9189bfb2eee8129811499Y53R+gv4xd8sCuPc4negC7Cnprr/+io7d6x5GDHdutc=',
        NULL, NULL, NULL, NULL,
        'd4881a8d511f54623893da2336b80582aabbc9278b8da8f03aa74d0eeaf7593dcd0a20896bae9ba01261ce376482b998c0be417572e93dd3efb72c4282e22348vF4VHCzC0fIteYPEPzLefm6nIatWDY1X9RsZ+tR+e+Y=',
        1, '2021-07-08 15:27:57', NULL, '2021-07-08 08:27:57', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `apps_operator_acl`
--

CREATE TABLE `apps_operator_acl`
(
    `id`                  bigint(20) UNSIGNED NOT NULL,
    `data_name`           varchar(255)        NOT NULL,
    `data_name_lang`      text,
    `file_path`           varchar(120)                 DEFAULT NULL,
    `file_name_thumbnail` varchar(255)                 DEFAULT NULL,
    `file_name_original`  varchar(255)                 DEFAULT NULL,
    `file_json`           text,
    `published`           datetime            NOT NULL,
    `status`              smallint(6)         NOT NULL DEFAULT '0',
    `created_at`          datetime            NOT NULL,
    `created_by`          varchar(25)         NOT NULL,
    `updated_at`          timestamp           NOT NULL,
    `updated_by`          varchar(25)         NOT NULL,
    `deleted_at`          datetime                     DEFAULT NULL,
    `deleted_by`          varchar(25)                  DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

--
-- Dumping data for table `apps_operator_acl`
--

INSERT INTO `apps_operator_acl` (`id`, `data_name`, `data_name_lang`, `file_path`, `file_name_thumbnail`,
                                 `file_name_original`, `file_json`, `published`, `status`, `created_at`, `created_by`,
                                 `updated_at`, `updated_by`, `deleted_at`, `deleted_by`)
VALUES (1, 'Member Level 1', NULL, NULL, NULL, NULL, NULL, '2021-07-07 10:51:27', 1, '2021-07-07 10:51:27', '1',
        '2021-07-06 20:51:27', '1', NULL, NULL),
       (2, 'Member Level 2', NULL, NULL, NULL, NULL, NULL, '2021-07-07 10:51:27', 1, '2021-07-07 10:51:27', '1',
        '2021-07-06 20:51:27', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions`
(
    `id`         varchar(128)     NOT NULL,
    `ip_address` varchar(45)      NOT NULL,
    `timestamp`  int(10) UNSIGNED NOT NULL DEFAULT '0',
    `data`       blob             NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`)
VALUES ('eb5393e485f02b5657d53c7c55ebb88307b187e5', '::1', 1626230133,
        0x5f5f63695f6c6173745f726567656e65726174657c693a313632363233303039363b637372666b65795f6d6f645f61757468656e7469636174696f6e7c733a383a226774645135627359223b6373726676616c75655f6d6f645f61757468656e7469636174696f6e7c733a32303a2268665358626775766f4964775a4e724451313246223b4944585f534553537c613a363a7b733a393a226170705f656d61696c223b733a3139323a223462623534323165353266663931373862366633323132646335396436346461306465653432333035643162633634666264326639393437373339653037303139393134636664353439623031366333346366343237356430643930393263393836303461316636353731316330633538333663633766626361343736396233766d3932306c517050437471455a61624e772b4d424130766a43776b6634626f2b374c385745535346575a5a584c4676322b6c57443437392f34395274793337223b733a31373a226170705f757365725f757365726e616d65223b733a373a2261646d696e5f31223b733a31333a226170705f757365725f6e616d65223b733a3139323a2232363261386661616138616263636532363761333838343633323165303635616639326135636163636664613832313336383330373866636163346436383339666363343235333166663364333632316135396163623564363337626336366235363738326366613533653336306137656430383836363466363764313361635846324c45364949482f4c3375756b49564c305a6f714c4950636468706a59494c534254396251322b34675667513964306c5044306c51553156326652354166223b733a31323a226170705f757365725f61636c223b4e3b733a363a226170705f6964223b733a31393a2232313037303736304535323833344336383933223b733a31343a226170705f6c6173745f636865636b223b693a313632363233303133333b7d6f75747075745f737563636573735f7469746c657c733a373a2253756363657373223b5f5f63695f766172737c613a323a7b733a32303a226f75747075745f737563636573735f7469746c65223b733a333a226e6577223b733a31343a226f75747075745f73756363657373223b733a333a226e6577223b7d6f75747075745f737563636573737c733a32323a2257656c636f6d6520746f206170706c69636174696f6e223b);

-- --------------------------------------------------------

--
-- Table structure for table `mst_educations`
--

CREATE TABLE `mst_educations`
(
    `id`                  varchar(25)  NOT NULL,
    `data_name`           varchar(255) NOT NULL,
    `data_name_lang`      text,
    `data_permalinks`     varchar(255)          DEFAULT NULL,
    `data_description`    text,
    `file_path`           varchar(120)          DEFAULT NULL,
    `file_name_thumbnail` varchar(255)          DEFAULT NULL,
    `file_name_original`  varchar(255)          DEFAULT NULL,
    `file_json`           text,
    `published`           datetime     NOT NULL,
    `status`              smallint(6)  NOT NULL DEFAULT '0',
    `created_at`          datetime     NOT NULL,
    `created_by`          varchar(25)           DEFAULT NULL,
    `updated_at`          timestamp    NOT NULL,
    `updated_by`          varchar(25)           DEFAULT NULL,
    `deleted_at`          datetime              DEFAULT NULL,
    `deleted_by`          varchar(25)           DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mst_hobbies`
--

CREATE TABLE `mst_hobbies`
(
    `id`                  varchar(25)  NOT NULL,
    `data_name`           varchar(255) NOT NULL,
    `data_name_lang`      text,
    `data_permalinks`     varchar(255)          DEFAULT NULL,
    `data_description`    text,
    `file_path`           varchar(120)          DEFAULT NULL,
    `file_name_thumbnail` varchar(255)          DEFAULT NULL,
    `file_name_original`  varchar(255)          DEFAULT NULL,
    `file_json`           text,
    `published`           datetime     NOT NULL,
    `status`              smallint(6)  NOT NULL DEFAULT '0',
    `created_at`          datetime     NOT NULL,
    `created_by`          varchar(25)           DEFAULT NULL,
    `updated_at`          timestamp    NOT NULL,
    `updated_by`          varchar(25)           DEFAULT NULL,
    `deleted_at`          datetime              DEFAULT NULL,
    `deleted_by`          varchar(25)           DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mst_skills`
--

CREATE TABLE `mst_skills`
(
    `id`                  varchar(25)  NOT NULL,
    `data_name`           varchar(255) NOT NULL,
    `data_name_lang`      text,
    `data_permalinks`     varchar(255)          DEFAULT NULL,
    `data_description`    text,
    `file_path`           varchar(120)          DEFAULT NULL,
    `file_name_thumbnail` varchar(255)          DEFAULT NULL,
    `file_name_original`  varchar(255)          DEFAULT NULL,
    `file_json`           text,
    `published`           datetime     NOT NULL,
    `status`              smallint(6)  NOT NULL DEFAULT '0',
    `created_at`          datetime     NOT NULL,
    `created_by`          varchar(25)           DEFAULT NULL,
    `updated_at`          timestamp    NOT NULL,
    `updated_by`          varchar(25)           DEFAULT NULL,
    `deleted_at`          datetime              DEFAULT NULL,
    `deleted_by`          varchar(25)           DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pbd_business`
--

CREATE TABLE `pbd_business`
(
    `id`                  varchar(25)  NOT NULL,
    `data_name`           varchar(255) NOT NULL,
    `data_name_lang`      text,
    `data_permalinks`     varchar(255)          DEFAULT NULL,
    `data_description`    text,
    `bd_regnumber`        varchar(255)          DEFAULT NULL,
    `bd_email`            varchar(255)          DEFAULT NULL,
    `bd_phone`            varchar(255)          DEFAULT NULL,
    `bd_address`          varchar(255)          DEFAULT NULL,
    `bd_hours_open`       varchar(255)          DEFAULT NULL,
    `bd_hours_work`       varchar(255)          DEFAULT NULL,
    `bd_paymentmethod`    varchar(255)          DEFAULT NULL,
    `bd_team_number`      varchar(255)          DEFAULT NULL,
    `bd_annual_sales`     varchar(255)          DEFAULT NULL,
    `bd_established_year` varchar(4)            DEFAULT NULL,
    `bd_established_date` date                  DEFAULT NULL,
    `bd_main_markets`     varchar(255)          DEFAULT NULL,
    `stats_resume_follow` bigint(20)   NOT NULL DEFAULT '0' COMMENT 'counting data',
    `stats_resume_likes`  bigint(20)   NOT NULL DEFAULT '0' COMMENT 'counting data',
    `data_categories`     text COMMENT 'Data format JSON, multiple id categories',
    `data_types`          text COMMENT 'Data format JSON, multiple id categories',
    `data_about`          text COMMENT 'Data format JSON',
    `data_social_links`   text COMMENT 'Data format JSON',
    `data_team`           text COMMENT 'Data format JSON',
    `data_staff`          text COMMENT 'Data format JSON',
    `data_locations`      text COMMENT 'Data format JSON',
    `data_certifications` text COMMENT 'Data format JSON',
    `file_path`           varchar(120)          DEFAULT NULL,
    `file_name_thumbnail` varchar(255)          DEFAULT NULL,
    `file_name_original`  varchar(255)          DEFAULT NULL,
    `file_json`           text,
    `published`           datetime     NOT NULL,
    `status_verification` tinyint(1)   NOT NULL DEFAULT '0',
    `status_privacy`      tinyint(1)   NOT NULL DEFAULT '0',
    `status`              smallint(6)  NOT NULL DEFAULT '0',
    `created_at`          datetime     NOT NULL,
    `created_by`          varchar(25)           DEFAULT NULL,
    `updated_at`          timestamp    NOT NULL,
    `updated_by`          varchar(25)           DEFAULT NULL,
    `deleted_at`          datetime              DEFAULT NULL,
    `deleted_by`          varchar(25)           DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pbd_business_categories`
--

CREATE TABLE `pbd_business_categories`
(
    `id`                  varchar(25)  NOT NULL,
    `data_name`           varchar(255) NOT NULL,
    `data_name_lang`      text,
    `data_permalinks`     varchar(255)          DEFAULT NULL,
    `data_description`    text,
    `file_path`           varchar(120)          DEFAULT NULL,
    `file_name_thumbnail` varchar(255)          DEFAULT NULL,
    `file_name_original`  varchar(255)          DEFAULT NULL,
    `file_json`           text,
    `published`           datetime     NOT NULL,
    `status`              smallint(6)  NOT NULL DEFAULT '0',
    `created_at`          datetime     NOT NULL,
    `created_by`          varchar(25)           DEFAULT NULL,
    `updated_at`          timestamp    NOT NULL,
    `updated_by`          varchar(25)           DEFAULT NULL,
    `deleted_at`          datetime              DEFAULT NULL,
    `deleted_by`          varchar(25)           DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pbd_business_files`
--

CREATE TABLE `pbd_business_files`
(
    `id`                               varchar(25) NOT NULL,
    `pdb_business_id`                  varchar(25) NOT NULL,
    `pbd_business_files_categories_id` varchar(25)          DEFAULT NULL COMMENT 'Optional',
    `file_position`                    int(11)              DEFAULT '0' COMMENT 'ordering data',
    `file_type`                        varchar(255)         DEFAULT NULL,
    `file_caption`                     varchar(255)         DEFAULT NULL,
    `file_alt`                         varchar(255)         DEFAULT NULL,
    `file_dimension`                   varchar(100)         DEFAULT NULL,
    `file_path`                        varchar(120)         DEFAULT NULL,
    `file_name_thumbnail`              varchar(255)         DEFAULT NULL,
    `file_name_original`               varchar(255)         DEFAULT NULL,
    `published`                        datetime    NOT NULL,
    `status`                           smallint(6) NOT NULL DEFAULT '0',
    `created_at`                       datetime    NOT NULL,
    `created_by`                       varchar(25)          DEFAULT NULL,
    `updated_at`                       timestamp   NOT NULL,
    `updated_by`                       varchar(25)          DEFAULT NULL,
    `deleted_at`                       datetime             DEFAULT NULL,
    `deleted_by`                       varchar(25)          DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pbd_business_files_categories`
--

CREATE TABLE `pbd_business_files_categories`
(
    `id`                  varchar(25)  NOT NULL,
    `pdb_business_id`     varchar(25)           DEFAULT NULL,
    `data_name`           varchar(255) NOT NULL,
    `data_name_lang`      text,
    `data_permalinks`     varchar(25)           DEFAULT NULL,
    `data_description`    text,
    `file_path`           varchar(120)          DEFAULT NULL,
    `file_name_thumbnail` varchar(255)          DEFAULT NULL,
    `file_name_original`  varchar(255)          DEFAULT NULL,
    `file_json`           text,
    `published`           datetime     NOT NULL,
    `status`              smallint(6)  NOT NULL DEFAULT '0',
    `status_disable`      tinyint(1)   NOT NULL DEFAULT '0' COMMENT '0 : Default , 1 : Can''t Delete',
    `created_at`          datetime     NOT NULL,
    `created_by`          varchar(25)           DEFAULT NULL,
    `updated_at`          timestamp    NOT NULL,
    `updated_by`          varchar(25)           DEFAULT NULL,
    `deleted_at`          datetime              DEFAULT NULL,
    `deleted_by`          varchar(25)           DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pbd_business_follows`
--

CREATE TABLE `pbd_business_follows`
(
    `id`              bigint(20)  NOT NULL,
    `pdb_business_id` varchar(25) NOT NULL COMMENT 'this user action to follow people',
    `user_follow_id`  varchar(25) NOT NULL COMMENT 'people',
    `created_at`      datetime    NOT NULL,
    `updated_at`      datetime    NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pbd_business_likes`
--

CREATE TABLE `pbd_business_likes`
(
    `id`              bigint(20)  NOT NULL,
    `pdb_business_id` varchar(25) NOT NULL COMMENT 'this user action to follow people',
    `user_follow_id`  varchar(25) NOT NULL COMMENT 'people',
    `created_at`      datetime    NOT NULL,
    `updated_at`      datetime    NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pbd_business_photo`
--

CREATE TABLE `pbd_business_photo`
(
    `id`                         varchar(25) NOT NULL,
    `pdb_business_id`            varchar(25) NOT NULL,
    `pdb_business_categories_id` varchar(25)          DEFAULT NULL COMMENT 'Optional',
    `file_position`              int(11)              DEFAULT '0' COMMENT 'ordering data',
    `file_type`                  varchar(255)         DEFAULT NULL,
    `file_caption`               varchar(255)         DEFAULT NULL,
    `file_alt`                   varchar(255)         DEFAULT NULL,
    `file_dimension`             varchar(100)         DEFAULT NULL,
    `file_path`                  varchar(120)         DEFAULT NULL,
    `file_name_thumbnail`        varchar(255)         DEFAULT NULL,
    `file_name_original`         varchar(255)         DEFAULT NULL,
    `published`                  datetime    NOT NULL,
    `status`                     smallint(6) NOT NULL DEFAULT '0',
    `created_at`                 datetime    NOT NULL,
    `created_by`                 varchar(25)          DEFAULT NULL,
    `updated_at`                 timestamp   NOT NULL,
    `updated_by`                 varchar(25)          DEFAULT NULL,
    `deleted_at`                 datetime             DEFAULT NULL,
    `deleted_by`                 varchar(25)          DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pbd_business_photo_categories`
--

CREATE TABLE `pbd_business_photo_categories`
(
    `id`                  varchar(25)  NOT NULL,
    `pdb_business_id`     varchar(25)           DEFAULT NULL,
    `data_name`           varchar(255) NOT NULL,
    `data_name_lang`      text,
    `data_permalinks`     varchar(255)          DEFAULT NULL,
    `data_description`    text,
    `file_path`           varchar(120)          DEFAULT NULL,
    `file_name_thumbnail` varchar(255)          DEFAULT NULL,
    `file_name_original`  varchar(255)          DEFAULT NULL,
    `file_json`           text,
    `published`           datetime     NOT NULL,
    `status`              smallint(6)  NOT NULL DEFAULT '0',
    `status_disable`      tinyint(1)   NOT NULL DEFAULT '0' COMMENT '0 : Default , 1 : Can''t Delete',
    `created_at`          datetime     NOT NULL,
    `created_by`          varchar(25)           DEFAULT NULL,
    `updated_at`          timestamp    NOT NULL,
    `updated_by`          varchar(25)           DEFAULT NULL,
    `deleted_at`          datetime              DEFAULT NULL,
    `deleted_by`          varchar(25)           DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pbd_business_types`
--

CREATE TABLE `pbd_business_types`
(
    `id`                  varchar(25)  NOT NULL,
    `data_name`           varchar(255) NOT NULL,
    `data_name_lang`      text,
    `data_permalinks`     varchar(255)          DEFAULT NULL,
    `data_description`    text,
    `file_path`           varchar(120)          DEFAULT NULL,
    `file_name_thumbnail` varchar(255)          DEFAULT NULL,
    `file_name_original`  varchar(255)          DEFAULT NULL,
    `file_json`           text,
    `published`           datetime     NOT NULL,
    `status`              smallint(6)  NOT NULL DEFAULT '0',
    `created_at`          datetime     NOT NULL,
    `created_by`          varchar(25)           DEFAULT NULL,
    `updated_at`          timestamp    NOT NULL,
    `updated_by`          varchar(25)           DEFAULT NULL,
    `deleted_at`          datetime              DEFAULT NULL,
    `deleted_by`          varchar(25)           DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pbd_items`
--

CREATE TABLE `pbd_items`
(
    `id`                  varchar(25)  NOT NULL,
    `pdb_business_id`     varchar(25)  NOT NULL,
    `data_name`           varchar(255) NOT NULL,
    `data_name_lang`      text,
    `data_permalinks`     varchar(255)          DEFAULT NULL,
    `data_description`    text,
    `data_categories`     text COMMENT 'Data format JSON, multiple id categories',
    `price_low`           double       NOT NULL DEFAULT '0',
    `price_high`          double       NOT NULL DEFAULT '0',
    `price_discount`      double       NOT NULL DEFAULT '0' COMMENT 'Optional',
    `file_path`           varchar(120)          DEFAULT NULL,
    `file_name_thumbnail` varchar(255)          DEFAULT NULL,
    `file_name_original`  varchar(255)          DEFAULT NULL,
    `file_json`           text,
    `published`           datetime     NOT NULL,
    `status`              smallint(6)  NOT NULL DEFAULT '0',
    `created_at`          datetime     NOT NULL,
    `created_by`          varchar(25)           DEFAULT NULL,
    `updated_at`          timestamp    NOT NULL,
    `updated_by`          varchar(25)           DEFAULT NULL,
    `deleted_at`          datetime              DEFAULT NULL,
    `deleted_by`          varchar(25)           DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pbd_items_categories`
--

CREATE TABLE `pbd_items_categories`
(
    `id`                  varchar(25)  NOT NULL,
    `pdb_business_id`     varchar(25)           DEFAULT NULL,
    `data_name`           varchar(255) NOT NULL,
    `data_name_lang`      text,
    `data_permalinks`     varchar(255)          DEFAULT NULL,
    `data_description`    text,
    `file_path`           varchar(120)          DEFAULT NULL,
    `file_name_thumbnail` varchar(255)          DEFAULT NULL,
    `file_name_original`  varchar(255)          DEFAULT NULL,
    `file_json`           text,
    `published`           datetime     NOT NULL,
    `status`              smallint(6)  NOT NULL DEFAULT '0',
    `created_at`          datetime     NOT NULL,
    `created_by`          varchar(25)           DEFAULT NULL,
    `updated_at`          timestamp    NOT NULL,
    `updated_by`          varchar(25)           DEFAULT NULL,
    `deleted_at`          datetime              DEFAULT NULL,
    `deleted_by`          varchar(25)           DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pbd_items_follows`
--

CREATE TABLE `pbd_items_follows`
(
    `id`             bigint(20)  NOT NULL,
    `pdb_items_id`   varchar(25) NOT NULL COMMENT 'this user action to follow people',
    `user_follow_id` varchar(25) NOT NULL COMMENT 'people',
    `created_at`     datetime    NOT NULL,
    `updated_at`     datetime    NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pbd_items_likes`
--

CREATE TABLE `pbd_items_likes`
(
    `id`             bigint(20)  NOT NULL,
    `pdb_items_id`   varchar(25) NOT NULL COMMENT 'this user action to follow people',
    `user_follow_id` varchar(25) NOT NULL COMMENT 'people',
    `created_at`     datetime    NOT NULL,
    `updated_at`     datetime    NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pbd_items_photo`
--

CREATE TABLE `pbd_items_photo`
(
    `id`                            varchar(25) NOT NULL,
    `pdb_business_id`               varchar(25) NOT NULL,
    `pdb_items_id`                  varchar(25) NOT NULL,
    `pdb_items_photo_categories_id` varchar(25)          DEFAULT NULL COMMENT 'Optional',
    `file_position`                 int(11)              DEFAULT '0',
    `file_type`                     varchar(255)         DEFAULT NULL,
    `file_caption`                  varchar(255)         DEFAULT NULL,
    `file_alt`                      varchar(255)         DEFAULT NULL,
    `file_dimension`                varchar(100)         DEFAULT NULL,
    `file_path`                     varchar(120)         DEFAULT NULL,
    `file_name_thumbnail`           varchar(255)         DEFAULT NULL,
    `file_name_original`            varchar(255)         DEFAULT NULL,
    `published`                     datetime    NOT NULL,
    `status`                        smallint(6) NOT NULL DEFAULT '0',
    `created_at`                    datetime    NOT NULL,
    `created_by`                    varchar(25)          DEFAULT NULL,
    `updated_at`                    timestamp   NOT NULL,
    `updated_by`                    varchar(25)          DEFAULT NULL,
    `deleted_at`                    datetime             DEFAULT NULL,
    `deleted_by`                    varchar(25)          DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pbd_items_photo_categories`
--

CREATE TABLE `pbd_items_photo_categories`
(
    `id`                  varchar(25)  NOT NULL,
    `pdb_business_id`     varchar(25)           DEFAULT NULL,
    `data_name`           varchar(255) NOT NULL,
    `data_name_lang`      text,
    `data_permalinks`     varchar(255) NOT NULL,
    `data_description`    text,
    `file_path`           varchar(120)          DEFAULT NULL,
    `file_name_thumbnail` varchar(255)          DEFAULT NULL,
    `file_name_original`  varchar(255)          DEFAULT NULL,
    `file_json`           text,
    `published`           datetime     NOT NULL,
    `status`              smallint(6)  NOT NULL DEFAULT '0',
    `status_disable`      tinyint(1)   NOT NULL DEFAULT '0' COMMENT '0 : Default , 1 : Can''t Delete',
    `created_at`          datetime     NOT NULL,
    `created_by`          varchar(25)           DEFAULT NULL,
    `updated_at`          timestamp    NOT NULL,
    `updated_by`          varchar(25)           DEFAULT NULL,
    `deleted_at`          datetime              DEFAULT NULL,
    `deleted_by`          varchar(25)           DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pcs_communities`
--

CREATE TABLE `pcs_communities`
(
    `id`                  varchar(25)  NOT NULL,
    `users_id`            varchar(25)  NOT NULL COMMENT 'Creators',
    `data_name`           varchar(255) NOT NULL,
    `data_name_lang`      text,
    `data_permalinks`     varchar(255)          DEFAULT NULL,
    `data_description`    text,
    `data_categories`     text COMMENT '	Data format JSON, multiple id categories',
    `file_path`           varchar(120)          DEFAULT NULL,
    `file_name_thumbnail` varchar(255)          DEFAULT NULL,
    `file_name_original`  varchar(255)          DEFAULT NULL,
    `file_json`           text,
    `published`           datetime     NOT NULL,
    `status_privacy`      tinyint(1)   NOT NULL DEFAULT '0',
    `status`              smallint(6)  NOT NULL DEFAULT '0',
    `created_at`          datetime     NOT NULL,
    `created_by`          varchar(25)           DEFAULT NULL,
    `updated_at`          timestamp    NOT NULL,
    `updated_by`          varchar(25)           DEFAULT NULL,
    `deleted_at`          datetime              DEFAULT NULL,
    `deleted_by`          varchar(25)           DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pcs_communities_albums`
--

CREATE TABLE `pcs_communities_albums`
(
    `id`                  varchar(25)  NOT NULL,
    `user_id`             varchar(25)  NOT NULL COMMENT 'Creator Albums',
    `pcs_communities_id`  varchar(25)  NOT NULL,
    `data_name`           varchar(255) NOT NULL,
    `data_name_lang`      text,
    `data_permalinks`     varchar(255)          DEFAULT NULL,
    `data_description`    text,
    `file_path`           varchar(120)          DEFAULT NULL,
    `file_name_thumbnail` varchar(255)          DEFAULT NULL,
    `file_name_original`  varchar(255)          DEFAULT NULL,
    `file_json`           text,
    `published`           datetime     NOT NULL,
    `status`              smallint(6)  NOT NULL DEFAULT '0',
    `created_at`          datetime     NOT NULL,
    `created_by`          varchar(25)           DEFAULT NULL,
    `updated_at`          timestamp    NOT NULL,
    `updated_by`          varchar(25)           DEFAULT NULL,
    `deleted_at`          datetime              DEFAULT NULL,
    `deleted_by`          varchar(25)           DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pcs_communities_albums_photo`
--

CREATE TABLE `pcs_communities_albums_photo`
(
    `id`                        varchar(25) NOT NULL,
    `users_id`                  varchar(25) NOT NULL,
    `pcs_communities_id`        varchar(25)          DEFAULT NULL,
    `pcs_communities_albums_id` varchar(25)          DEFAULT NULL COMMENT 'Optional',
    `file_position`             int(11)              DEFAULT '0',
    `file_type`                 varchar(255)         DEFAULT NULL,
    `file_caption`              varchar(255)         DEFAULT NULL,
    `file_alt`                  varchar(255)         DEFAULT NULL,
    `file_dimension`            varchar(100)         DEFAULT NULL,
    `file_path`                 varchar(120)         DEFAULT NULL,
    `file_name_thumbnail`       varchar(255)         DEFAULT NULL,
    `file_name_original`        varchar(255)         DEFAULT NULL,
    `published`                 datetime    NOT NULL,
    `status`                    smallint(6) NOT NULL DEFAULT '0',
    `created_at`                datetime    NOT NULL,
    `created_by`                varchar(25)          DEFAULT NULL,
    `updated_at`                timestamp   NOT NULL,
    `updated_by`                varchar(25)          DEFAULT NULL,
    `deleted_at`                datetime             DEFAULT NULL,
    `deleted_by`                varchar(25)          DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pcs_communities_categories`
--

CREATE TABLE `pcs_communities_categories`
(
    `id`                  varchar(25)  NOT NULL,
    `data_name`           varchar(255) NOT NULL,
    `data_name_lang`      text,
    `data_permalinks`     varchar(255)          DEFAULT NULL,
    `data_description`    text,
    `file_path`           varchar(120)          DEFAULT NULL,
    `file_name_thumbnail` varchar(255)          DEFAULT NULL,
    `file_name_original`  varchar(255)          DEFAULT NULL,
    `file_json`           text,
    `published`           datetime     NOT NULL,
    `status`              smallint(6)  NOT NULL DEFAULT '0',
    `created_at`          datetime     NOT NULL,
    `created_by`          varchar(25)           DEFAULT NULL,
    `updated_at`          timestamp    NOT NULL,
    `updated_by`          varchar(25)           DEFAULT NULL,
    `deleted_at`          datetime              DEFAULT NULL,
    `deleted_by`          varchar(25)           DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users`
(
    `id`                       varchar(25)  NOT NULL,
    `username`                 varchar(255) NOT NULL,
    `password`                 varchar(255) NOT NULL,
    `email`                    varchar(255)          DEFAULT NULL,
    `data_permalinks`          varchar(255) NOT NULL,
    `name_full`                varchar(255) NOT NULL,
    `name_nick`                varchar(255) NOT NULL,
    `phone`                    varchar(255)          DEFAULT NULL,
    `stats_user_followers`     int(11)      NOT NULL DEFAULT '0',
    `stats_user_following`     int(11)      NOT NULL DEFAULT '0',
    `stats_business_follow`    int(11)      NOT NULL DEFAULT '0',
    `stats_business_following` int(11)      NOT NULL DEFAULT '0',
    `data_pro_status`          varchar(255)          DEFAULT NULL COMMENT 'Use for Status',
    `data_pro_hobby`           text COMMENT 'Data Format JSON',
    `data_pro_skills`          text COMMENT 'Data Format JSON',
    `data_social_links`        text COMMENT 'Data Format JSON',
    `data_community`           text COMMENT 'Data Format JSON',
    `data_education`           text COMMENT 'Data Format JSON',
    `data_license`             text COMMENT 'Data Format JSON',
    `data_crs_private`         text COMMENT 'Data Format JSON',
    `data_exp_work`            text COMMENT 'Data Format JSON',
    `data_exp_volunteer`       text COMMENT 'Data Format JSON',
    `data_contact_info`        text COMMENT 'Data Format JSON',
    `file_path`                varchar(120)          DEFAULT NULL,
    `file_name_thumbnail`      varchar(255)          DEFAULT NULL,
    `file_name_original`       varchar(255)          DEFAULT NULL,
    `file_json`                text,
    `code_registration`        text,
    `users_access`             varchar(255) NOT NULL COMMENT 'JSON Level Access',
    `status_privacy`           tinyint(1)   NOT NULL DEFAULT '0' COMMENT '0 : private, 1 : public',
    `status`                   smallint(2)  NOT NULL DEFAULT '0' COMMENT '0 : Not Active, 1 : Active',
    `created_at`               timestamp    NULL     DEFAULT NULL,
    `created_by`               int(11)               DEFAULT NULL,
    `updated_at`               timestamp    NULL     DEFAULT NULL,
    `updated_by`               int(11)               DEFAULT NULL,
    `deleted_at`               timestamp    NULL     DEFAULT NULL,
    `deleted_by`               int(11)               DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_acl`
--

CREATE TABLE `users_acl`
(
    `id`                  varchar(25)  NOT NULL,
    `data_name`           varchar(255) NOT NULL,
    `data_name_lang`      text,
    `file_path`           varchar(120)          DEFAULT NULL,
    `file_name_thumbnail` varchar(255)          DEFAULT NULL,
    `file_name_original`  varchar(255)          DEFAULT NULL,
    `file_json`           text,
    `published`           datetime     NOT NULL,
    `status`              smallint(6)  NOT NULL DEFAULT '0',
    `created_at`          datetime     NOT NULL,
    `created_by`          varchar(25)  NOT NULL,
    `updated_at`          timestamp    NOT NULL,
    `updated_by`          varchar(25)  NOT NULL,
    `deleted_at`          datetime              DEFAULT NULL,
    `deleted_by`          varchar(25)           DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

--
-- Dumping data for table `users_acl`
--

INSERT INTO `users_acl` (`id`, `data_name`, `data_name_lang`, `file_path`, `file_name_thumbnail`, `file_name_original`,
                         `file_json`, `published`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`,
                         `deleted_at`, `deleted_by`)
VALUES ('1', 'Member Level 1', NULL, NULL, NULL, NULL, NULL, '2021-07-07 10:51:27', 1, '2021-07-07 10:51:27', '1',
        '2021-07-07 03:51:27', '1', NULL, NULL),
       ('2', 'Member Level 2', NULL, NULL, NULL, NULL, NULL, '2021-07-07 10:51:27', 1, '2021-07-07 10:51:27', '1',
        '2021-07-07 03:51:27', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_albums`
--

CREATE TABLE `users_albums`
(
    `id`                         varchar(25)  NOT NULL,
    `users_id`                   varchar(25)  NOT NULL,
    `users_albums_categories_id` varchar(25)  NOT NULL,
    `data_name`                  varchar(255) NOT NULL,
    `data_name_lang`             text,
    `data_permalinks`            varchar(255)          DEFAULT NULL,
    `data_description`           text,
    `file_path`                  varchar(120)          DEFAULT NULL,
    `file_name_thumbnail`        varchar(255)          DEFAULT NULL,
    `file_name_original`         varchar(255)          DEFAULT NULL,
    `file_json`                  text,
    `published`                  datetime     NOT NULL,
    `status`                     smallint(6)  NOT NULL DEFAULT '0',
    `created_at`                 datetime     NOT NULL,
    `created_by`                 varchar(25)           DEFAULT NULL,
    `updated_at`                 timestamp    NOT NULL,
    `updated_by`                 varchar(25)           DEFAULT NULL,
    `deleted_at`                 datetime              DEFAULT NULL,
    `deleted_by`                 varchar(25)           DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_albums_categories`
--

CREATE TABLE `users_albums_categories`
(
    `id`                  varchar(25)  NOT NULL,
    `data_name`           varchar(255) NOT NULL,
    `data_name_lang`      text,
    `data_permalinks`     varchar(255)          DEFAULT NULL,
    `data_description`    text,
    `file_path`           varchar(120)          DEFAULT NULL,
    `file_name_thumbnail` varchar(255)          DEFAULT NULL,
    `file_name_original`  varchar(255)          DEFAULT NULL,
    `file_json`           text,
    `published`           datetime     NOT NULL,
    `status`              smallint(6)  NOT NULL DEFAULT '0',
    `status_disable`      tinyint(1)   NOT NULL DEFAULT '0' COMMENT '0 : Default , 1 : Can''t Delete',
    `created_at`          datetime     NOT NULL,
    `created_by`          varchar(25)           DEFAULT NULL,
    `updated_at`          timestamp    NOT NULL,
    `updated_by`          varchar(25)           DEFAULT NULL,
    `deleted_at`          datetime              DEFAULT NULL,
    `deleted_by`          varchar(25)           DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8 COMMENT ='Data Categories Made by Administrators';

-- --------------------------------------------------------

--
-- Table structure for table `users_albums_photo`
--

CREATE TABLE `users_albums_photo`
(
    `id`                  varchar(25) NOT NULL,
    `users_id`            varchar(25) NOT NULL,
    `users_albums_id`     varchar(25)          DEFAULT NULL COMMENT 'Optional',
    `file_position`       int(11)              DEFAULT '0',
    `file_type`           varchar(255)         DEFAULT NULL,
    `file_caption`        varchar(255)         DEFAULT NULL,
    `file_alt`            varchar(255)         DEFAULT NULL,
    `file_dimension`      varchar(100)         DEFAULT NULL,
    `file_path`           varchar(120)         DEFAULT NULL,
    `file_name_thumbnail` varchar(255)         DEFAULT NULL,
    `file_name_original`  varchar(255)         DEFAULT NULL,
    `published`           datetime    NOT NULL,
    `status`              smallint(6) NOT NULL DEFAULT '0',
    `created_at`          datetime    NOT NULL,
    `created_by`          varchar(25)          DEFAULT NULL,
    `updated_at`          timestamp   NOT NULL,
    `updated_by`          varchar(25)          DEFAULT NULL,
    `deleted_at`          datetime             DEFAULT NULL,
    `deleted_by`          varchar(25)          DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_devices_sess`
--

CREATE TABLE `users_devices_sess`
(
    `id`               varchar(25)               NOT NULL,
    `user_id`          varchar(25)                        DEFAULT NULL,
    `devices_type`     enum ('Mobile','Website') NOT NULL,
    `devices_agents`   text,
    `devices_name`     varchar(255)              NOT NULL,
    `devices_location` text,
    `devices_added`    datetime                           DEFAULT NULL,
    `status`           smallint(6)               NOT NULL DEFAULT '0' COMMENT '0: Not Active , 1: Active, 2 : Log Off',
    `created_at`       datetime                  NOT NULL,
    `created_by`       varchar(25)                        DEFAULT NULL,
    `updated_at`       timestamp                 NOT NULL,
    `updated_by`       varchar(25)                        DEFAULT NULL,
    `deleted_at`       datetime                           DEFAULT NULL,
    `deleted_by`       varchar(25)                        DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_follows`
--

CREATE TABLE `users_follows`
(
    `id`             bigint(20)  NOT NULL,
    `user_id`        varchar(25) NOT NULL COMMENT 'this user action to follow people',
    `user_follow_id` varchar(25) NOT NULL COMMENT 'people',
    `created_at`     datetime    NOT NULL,
    `updated_at`     datetime    NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `_samples`
--

CREATE TABLE `_samples`
(
    `id`                    varchar(25)  NOT NULL,
    `product_categories_id` varchar(25)           DEFAULT NULL,
    `data_name`             varchar(255) NOT NULL,
    `data_name_lang`        text,
    `data_permalinks`       varchar(255)          DEFAULT NULL,
    `data_description`      tinytext,
    `file_path`             varchar(120)          DEFAULT NULL,
    `file_name_thumbnail`   varchar(255)          DEFAULT NULL,
    `file_name_original`    varchar(255)          DEFAULT NULL,
    `file_json`             text,
    `published`             datetime     NOT NULL,
    `status`                smallint(2)  NOT NULL DEFAULT '0',
    `created_at`            datetime     NOT NULL,
    `created_by`            varchar(25)           DEFAULT NULL,
    `updated_at`            timestamp    NOT NULL,
    `updated_by`            varchar(25)           DEFAULT NULL,
    `deleted_at`            datetime              DEFAULT NULL,
    `deleted_by`            varchar(25)           DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

--
-- Dumping data for table `_samples`
--

INSERT INTO `_samples` (`id`, `product_categories_id`, `data_name`, `data_name_lang`, `data_permalinks`,
                        `data_description`, `file_path`, `file_name_thumbnail`, `file_name_original`, `file_json`,
                        `published`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`,
                        `deleted_by`)
VALUES ('21070560E283058AA5D', '18446744073709551615', '12312', NULL, NULL, '3123123', NULL, NULL, NULL, NULL,
        '2021-07-05 00:00:00', 0, '2021-07-05 10:56:53', NULL, '2021-07-05 03:56:53', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `_samples_categories`
--

CREATE TABLE `_samples_categories`
(
    `id`                  varchar(25)  NOT NULL,
    `data_name`           varchar(255) NOT NULL,
    `data_name_lang`      text,
    `data_permalinks`     varchar(255)          DEFAULT NULL,
    `data_description`    text,
    `file_path`           varchar(120)          DEFAULT NULL,
    `file_name_thumbnail` varchar(255)          DEFAULT NULL,
    `file_name_original`  varchar(255)          DEFAULT NULL,
    `file_json`           text,
    `published`           datetime     NOT NULL,
    `status`              smallint(6)  NOT NULL DEFAULT '0',
    `created_at`          datetime     NOT NULL,
    `created_by`          varchar(25)           DEFAULT NULL,
    `updated_at`          timestamp    NOT NULL,
    `updated_by`          varchar(25)           DEFAULT NULL,
    `deleted_at`          datetime              DEFAULT NULL,
    `deleted_by`          varchar(25)           DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

--
-- Dumping data for table `_samples_categories`
--

INSERT INTO `_samples_categories` (`id`, `data_name`, `data_name_lang`, `data_permalinks`, `data_description`,
                                   `file_path`, `file_name_thumbnail`, `file_name_original`, `file_json`, `published`,
                                   `status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`,
                                   `deleted_by`)
VALUES ('18446744073709551615', 'Category 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-05 00:00:00', 0,
        '2021-07-05 09:22:41', NULL, '2021-07-05 02:22:41', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `_samples_files`
--

CREATE TABLE `_samples_files`
(
    `id`                  varchar(25) NOT NULL,
    `table_relation_id`   varchar(25) NOT NULL,
    `file_position`       int(11)              DEFAULT '0',
    `file_type`           varchar(255)         DEFAULT NULL,
    `file_caption`        varchar(255)         DEFAULT NULL,
    `file_alt`            varchar(255)         DEFAULT NULL,
    `file_dimension`      varchar(100)         DEFAULT NULL,
    `file_path`           varchar(120)         DEFAULT NULL,
    `file_name_thumbnail` varchar(255)         DEFAULT NULL,
    `file_name_original`  varchar(255)         DEFAULT NULL,
    `published`           datetime    NOT NULL,
    `status`              smallint(6) NOT NULL DEFAULT '0',
    `created_at`          datetime    NOT NULL,
    `created_by`          varchar(25)          DEFAULT NULL,
    `updated_at`          timestamp   NOT NULL,
    `updated_by`          varchar(25)          DEFAULT NULL,
    `deleted_at`          datetime             DEFAULT NULL,
    `deleted_by`          varchar(25)          DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apps_operator`
--
ALTER TABLE `apps_operator`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apps_operator_acl`
--
ALTER TABLE `apps_operator_acl`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
    ADD PRIMARY KEY (`id`),
    ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `mst_educations`
--
ALTER TABLE `mst_educations`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_hobbies`
--
ALTER TABLE `mst_hobbies`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_skills`
--
ALTER TABLE `mst_skills`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pbd_business`
--
ALTER TABLE `pbd_business`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pbd_business_categories`
--
ALTER TABLE `pbd_business_categories`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pbd_business_files`
--
ALTER TABLE `pbd_business_files`
    ADD PRIMARY KEY (`id`),
    ADD KEY `user_albums_id` (`pdb_business_id`),
    ADD KEY `pbd_business_files_id` (`pbd_business_files_categories_id`);

--
-- Indexes for table `pbd_business_files_categories`
--
ALTER TABLE `pbd_business_files_categories`
    ADD PRIMARY KEY (`id`),
    ADD KEY `pdb_business_id` (`pdb_business_id`);

--
-- Indexes for table `pbd_business_follows`
--
ALTER TABLE `pbd_business_follows`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pbd_business_likes`
--
ALTER TABLE `pbd_business_likes`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pbd_business_photo`
--
ALTER TABLE `pbd_business_photo`
    ADD PRIMARY KEY (`id`),
    ADD KEY `user_albums_id` (`pdb_business_id`),
    ADD KEY `pdb_business_categories_id` (`pdb_business_categories_id`);

--
-- Indexes for table `pbd_business_photo_categories`
--
ALTER TABLE `pbd_business_photo_categories`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pbd_business_types`
--
ALTER TABLE `pbd_business_types`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pbd_items`
--
ALTER TABLE `pbd_items`
    ADD PRIMARY KEY (`id`),
    ADD KEY `pdb_business_id` (`pdb_business_id`);

--
-- Indexes for table `pbd_items_categories`
--
ALTER TABLE `pbd_items_categories`
    ADD PRIMARY KEY (`id`),
    ADD KEY `pdb_business_id` (`pdb_business_id`);

--
-- Indexes for table `pbd_items_follows`
--
ALTER TABLE `pbd_items_follows`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pbd_items_likes`
--
ALTER TABLE `pbd_items_likes`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pbd_items_photo`
--
ALTER TABLE `pbd_items_photo`
    ADD PRIMARY KEY (`id`),
    ADD KEY `user_albums_id` (`pdb_items_id`),
    ADD KEY `pdb_items_photo_categories` (`pdb_items_photo_categories_id`),
    ADD KEY `pdb_business_id` (`pdb_business_id`);

--
-- Indexes for table `pbd_items_photo_categories`
--
ALTER TABLE `pbd_items_photo_categories`
    ADD PRIMARY KEY (`id`),
    ADD KEY `pdb_business_id` (`pdb_business_id`);

--
-- Indexes for table `pcs_communities`
--
ALTER TABLE `pcs_communities`
    ADD PRIMARY KEY (`id`),
    ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `pcs_communities_albums`
--
ALTER TABLE `pcs_communities_albums`
    ADD PRIMARY KEY (`id`),
    ADD KEY `user_id` (`user_id`),
    ADD KEY `users_albums_categories_id` (`pcs_communities_id`);

--
-- Indexes for table `pcs_communities_albums_photo`
--
ALTER TABLE `pcs_communities_albums_photo`
    ADD PRIMARY KEY (`id`),
    ADD KEY `user_id` (`users_id`),
    ADD KEY `users_albums_id` (`pcs_communities_id`),
    ADD KEY `albums_id` (`pcs_communities_albums_id`);

--
-- Indexes for table `pcs_communities_categories`
--
ALTER TABLE `pcs_communities_categories`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_acl`
--
ALTER TABLE `users_acl`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_albums`
--
ALTER TABLE `users_albums`
    ADD PRIMARY KEY (`id`),
    ADD KEY `user_id` (`users_id`),
    ADD KEY `users_albums_categories_id` (`users_albums_categories_id`);

--
-- Indexes for table `users_albums_categories`
--
ALTER TABLE `users_albums_categories`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_albums_photo`
--
ALTER TABLE `users_albums_photo`
    ADD PRIMARY KEY (`id`),
    ADD KEY `user_id` (`users_id`),
    ADD KEY `users_albums_id` (`users_albums_id`);

--
-- Indexes for table `users_devices_sess`
--
ALTER TABLE `users_devices_sess`
    ADD PRIMARY KEY (`id`),
    ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users_follows`
--
ALTER TABLE `users_follows`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_samples`
--
ALTER TABLE `_samples`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_samples_categories`
--
ALTER TABLE `_samples_categories`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_samples_files`
--
ALTER TABLE `_samples_files`
    ADD PRIMARY KEY (`id`),
    ADD KEY `user_albums_id` (`table_relation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apps_operator_acl`
--
ALTER TABLE `apps_operator_acl`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 3;

--
-- AUTO_INCREMENT for table `pbd_business_follows`
--
ALTER TABLE `pbd_business_follows`
    MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pbd_business_likes`
--
ALTER TABLE `pbd_business_likes`
    MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pbd_items_follows`
--
ALTER TABLE `pbd_items_follows`
    MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pbd_items_likes`
--
ALTER TABLE `pbd_items_likes`
    MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_follows`
--
ALTER TABLE `users_follows`
    MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pbd_business_files`
--
ALTER TABLE `pbd_business_files`
    ADD CONSTRAINT `pbd_business_files_ibfk_1` FOREIGN KEY (`pdb_business_id`) REFERENCES `pbd_business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `pbd_business_files_ibfk_2` FOREIGN KEY (`pbd_business_files_categories_id`) REFERENCES `pbd_business_files_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pbd_business_files_categories`
--
ALTER TABLE `pbd_business_files_categories`
    ADD CONSTRAINT `pbd_business_files_categories_ibfk_1` FOREIGN KEY (`pdb_business_id`) REFERENCES `pbd_business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pbd_business_photo`
--
ALTER TABLE `pbd_business_photo`
    ADD CONSTRAINT `pbd_business_photo_ibfk_1` FOREIGN KEY (`pdb_business_id`) REFERENCES `pbd_business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `pbd_business_photo_ibfk_2` FOREIGN KEY (`pdb_business_categories_id`) REFERENCES `pbd_business_photo_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pbd_items`
--
ALTER TABLE `pbd_items`
    ADD CONSTRAINT `pbd_items_ibfk_1` FOREIGN KEY (`pdb_business_id`) REFERENCES `pbd_business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pbd_items_categories`
--
ALTER TABLE `pbd_items_categories`
    ADD CONSTRAINT `pbd_items_categories_ibfk_1` FOREIGN KEY (`pdb_business_id`) REFERENCES `pbd_business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pbd_items_photo`
--
ALTER TABLE `pbd_items_photo`
    ADD CONSTRAINT `pbd_items_photo_ibfk_2` FOREIGN KEY (`pdb_items_id`) REFERENCES `pbd_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `pbd_items_photo_ibfk_3` FOREIGN KEY (`pdb_items_photo_categories_id`) REFERENCES `pbd_items_photo_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `pbd_items_photo_ibfk_4` FOREIGN KEY (`pdb_business_id`) REFERENCES `pbd_business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pbd_items_photo_categories`
--
ALTER TABLE `pbd_items_photo_categories`
    ADD CONSTRAINT `pbd_items_photo_categories_ibfk_1` FOREIGN KEY (`pdb_business_id`) REFERENCES `pbd_business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pcs_communities`
--
ALTER TABLE `pcs_communities`
    ADD CONSTRAINT `pcs_communities_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pcs_communities_albums`
--
ALTER TABLE `pcs_communities_albums`
    ADD CONSTRAINT `pcs_communities_albums_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `pcs_communities_albums_ibfk_2` FOREIGN KEY (`pcs_communities_id`) REFERENCES `pcs_communities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pcs_communities_albums_photo`
--
ALTER TABLE `pcs_communities_albums_photo`
    ADD CONSTRAINT `pcs_communities_albums_photo_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `pcs_communities_albums_photo_ibfk_2` FOREIGN KEY (`pcs_communities_id`) REFERENCES `pcs_communities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `pcs_communities_albums_photo_ibfk_3` FOREIGN KEY (`pcs_communities_albums_id`) REFERENCES `pcs_communities_albums` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_albums`
--
ALTER TABLE `users_albums`
    ADD CONSTRAINT `users_albums_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
    ADD CONSTRAINT `users_albums_ibfk_2` FOREIGN KEY (`users_albums_categories_id`) REFERENCES `users_albums_categories` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `users_albums_photo`
--
ALTER TABLE `users_albums_photo`
    ADD CONSTRAINT `users_albums_photo_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `users_albums_photo_ibfk_2` FOREIGN KEY (`users_albums_id`) REFERENCES `users_albums` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_devices_sess`
--
ALTER TABLE `users_devices_sess`
    ADD CONSTRAINT `users_devices_sess_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
