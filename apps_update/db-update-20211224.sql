SET
SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET
time_zone = "+00:00";


CREATE TABLE `pbt_tender`
(
    `id`                  varchar(25)  NOT NULL,
    `users_id`            varchar(25)  NOT NULL,
    `pbd_business_id`     varchar(25)           DEFAULT NULL,
    `data_name`           varchar(255) NOT NULL,
    `data_name_lang`      text,
    `data_permalinks`     varchar(255)          DEFAULT NULL,
    `data_description`    text,
    `data_categories`     text,
    `data_types`          text,
    `data_locations`      text,
    `date_open`           datetime              DEFAULT NULL,
    `date_close`          datetime              DEFAULT NULL,
    `file_path`           varchar(120)          DEFAULT NULL,
    `file_name_thumbnail` varchar(255)          DEFAULT NULL,
    `file_name_original`  varchar(255)          DEFAULT NULL,
    `file_json`           text,
    `published`           datetime     NOT NULL,
    `status`              smallint(6) NOT NULL DEFAULT '0',
    `inj_log`             varchar(50)           DEFAULT NULL,
    `created_at`          datetime     NOT NULL,
    `created_by`          varchar(25)           DEFAULT NULL,
    `updated_at`          timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `updated_by`          varchar(25)           DEFAULT NULL,
    `deleted_at`          datetime              DEFAULT NULL,
    `deleted_by`          varchar(25)           DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pbt_tender`
--
ALTER TABLE `pbt_tender`
    ADD PRIMARY KEY (`id`) USING BTREE;


CREATE TABLE `pbt_tender_categories`
(
    `id`                  varchar(25)  NOT NULL,
    `parent`              varchar(25)  NOT NULL DEFAULT '0',
    `data_position`       int(11) NOT NULL DEFAULT '0',
    `data_name`           varchar(255) NOT NULL,
    `data_name_lang`      text,
    `data_permalinks`     varchar(255)          DEFAULT NULL,
    `data_description`    text,
    `file_path`           varchar(120)          DEFAULT NULL,
    `file_name_thumbnail` varchar(255)          DEFAULT NULL,
    `file_name_original`  varchar(255)          DEFAULT NULL,
    `file_json`           text,
    `published`           datetime     NOT NULL,
    `status`              smallint(6) NOT NULL DEFAULT '0',
    `inj_log`             varchar(50)           DEFAULT NULL,
    `created_at`          datetime     NOT NULL,
    `created_by`          varchar(25)           DEFAULT NULL,
    `updated_at`          timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `updated_by`          varchar(25)           DEFAULT NULL,
    `deleted_at`          datetime              DEFAULT NULL,
    `deleted_by`          varchar(25)           DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pbt_tender_categories`
--
ALTER TABLE `pbt_tender_categories`
    ADD PRIMARY KEY (`id`) USING BTREE;


CREATE TABLE `pbt_tender_types`
(
    `id`                  varchar(25)  NOT NULL,
    `parent`              varchar(25)  NOT NULL DEFAULT '0',
    `data_position`       int(11) NOT NULL DEFAULT '0',
    `data_name`           varchar(255) NOT NULL,
    `data_name_lang`      text,
    `data_permalinks`     varchar(255)          DEFAULT NULL,
    `data_description`    text,
    `file_path`           varchar(120)          DEFAULT NULL,
    `file_name_thumbnail` varchar(255)          DEFAULT NULL,
    `file_name_original`  varchar(255)          DEFAULT NULL,
    `file_json`           text,
    `published`           datetime     NOT NULL,
    `status`              smallint(6) NOT NULL DEFAULT '0',
    `inj_log`             varchar(50)           DEFAULT NULL,
    `created_at`          datetime     NOT NULL,
    `created_by`          varchar(25)           DEFAULT NULL,
    `updated_at`          timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `updated_by`          varchar(25)           DEFAULT NULL,
    `deleted_at`          datetime              DEFAULT NULL,
    `deleted_by`          varchar(25)           DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pbt_tender_types`
--
ALTER TABLE `pbt_tender_types`
    ADD PRIMARY KEY (`id`) USING BTREE;


CREATE TABLE `pbd_items_sells_brands`
(
    `id`                  varchar(25)  NOT NULL,
    `data_position`       int(11) NOT NULL DEFAULT '0',
    `data_name`           varchar(255) NOT NULL,
    `data_name_lang`      text,
    `data_permalinks`     varchar(255)          DEFAULT NULL,
    `data_description`    text,
    `file_path`           varchar(120)          DEFAULT NULL,
    `file_name_thumbnail` varchar(255)          DEFAULT NULL,
    `file_name_original`  varchar(255)          DEFAULT NULL,
    `file_json`           text,
    `published`           datetime     NOT NULL,
    `status`              smallint(6) NOT NULL DEFAULT '0',
    `created_at`          datetime     NOT NULL,
    `created_by`          varchar(25)           DEFAULT NULL,
    `updated_at`          timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `updated_by`          varchar(25)           DEFAULT NULL,
    `deleted_at`          datetime              DEFAULT NULL,
    `deleted_by`          varchar(25)           DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pbd_items_sells_brands`
--
ALTER TABLE `pbd_items_sells_brands`
    ADD PRIMARY KEY (`id`) USING BTREE;


CREATE TABLE `pbd_items_sells`
(
    `id`                   varchar(25)  NOT NULL,
    `users_id`             varchar(25)  NOT NULL,
    `pbd_items_id`         varchar(25)  NOT NULL,
    `pbd_business_id`      varchar(25)  DEFAULT NULL,
    `data_type_sub`        enum('item','vehicle','property') NOT NULL COMMENT 'Type Selling',
    `data_condition`       varchar(11)  NOT NULL,
    `data_status`          varchar(100) NOT NULL,
    `data_description`     varchar(255) DEFAULT NULL,
    `data_detail_year`     varchar(20)  DEFAULT NULL,
    `data_detail_brand`    text,
    `data_detail_model`    varchar(100) DEFAULT NULL,
    `data_detail_bedroom`  varchar(100) DEFAULT NULL,
    `data_detail_bathroom` varchar(100) DEFAULT NULL,
    `data_detail_size`     varchar(150) DEFAULT NULL,
    `data_detail_facility` varchar(255) DEFAULT NULL,
    `data_detail_address`  varchar(255) DEFAULT NULL,
    `created_at`           datetime     NOT NULL,
    `created_by`           varchar(25)  NOT NULL,
    `updated_at`           timestamp NULL DEFAULT NULL,
    `updated_by`           varchar(25)  NOT NULL,
    `deleted_at`           datetime     DEFAULT NULL,
    `deleted_by`           varchar(25)  DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pbd_items_sells`
--
ALTER TABLE `pbd_items_sells`
    ADD PRIMARY KEY (`id`);