ALTER TABLE pfe_media_likes
    ADD parent BIGINT NOT NULL DEFAULT '0' AFTER id;

CREATE TABLE `pfe_posts_lookfoor`
(
    `id`                        varchar(25)  NOT NULL,
    `parent`                    varchar(25)  NOT NULL DEFAULT '0' COMMENT 'if post quotes / reply from other post',
    `users_id`                  varchar(25)  NOT NULL,
    `pbd_business_id`           varchar(25)  NOT NULL,
    `data_option`               enum('business','distributor','jobs') NOT NULL,
    `data_type_table`           varchar(150) NOT NULL,
    `data_type_value`           text,
    `data_categories_table`     varchar(150) NOT NULL,
    `data_categories_value`     text,
    `data_description`          longtext,
    `file_image_path`           varchar(120)          DEFAULT NULL,
    `file_image_name_thumbnail` varchar(255)          DEFAULT NULL,
    `file_image_name_original`  varchar(255)          DEFAULT NULL,
    `file_image_url`            varchar(255)          DEFAULT NULL,
    `file_video_path`           varchar(150)          DEFAULT NULL,
    `file_video_name`           varchar(150)          DEFAULT NULL,
    `file_video_url`            varchar(255)          DEFAULT NULL COMMENT 'if external link, (ex : Youtube Link)',
    `published`                 datetime     NOT NULL,
    `status`                    smallint(1) NOT NULL DEFAULT '0',
    `created_at`                datetime     NOT NULL,
    `created_by`                varchar(25)           DEFAULT NULL,
    `updated_at`                timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `updated_by`                varchar(25)           DEFAULT NULL,
    `deleted_at`                datetime              DEFAULT NULL,
    `deleted_by`                varchar(25)           DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pfe_posts_lookfoor`
--
ALTER TABLE `pfe_posts_lookfoor`
    ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `users_id` (`users_id`) USING BTREE;


CREATE TABLE `pbd_business_distributor_types`
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
-- Indexes for table `pbd_business_distributor_types`
--
ALTER TABLE `pbd_business_distributor_types`
    ADD PRIMARY KEY (`id`) USING BTREE;


CREATE TABLE `pbd_business_partnership_types`
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
-- Indexes for table `pbd_business_partnership_types`
--
ALTER TABLE `pbd_business_partnership_types`
    ADD PRIMARY KEY (`id`) USING BTREE;
