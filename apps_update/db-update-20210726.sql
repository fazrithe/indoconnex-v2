CREATE TABLE `pfe_posts`
(
    `id`                        varchar(25) NOT NULL,
    `parent`                    varchar(25) NOT NULL DEFAULT '0' COMMENT 'if post quotes / reply from other post',
    `users_id`                  varchar(25) NOT NULL,
    `data_description`          longtext,
    `file_image_path`           varchar(120)         DEFAULT NULL,
    `file_image_name_thumbnail` varchar(255)         DEFAULT NULL,
    `file_image_name_original`  varchar(255)         DEFAULT NULL,
    `file_image_url`            varchar(255)         DEFAULT NULL,
    `file_video_path`           varchar(150)         DEFAULT NULL,
    `file_video_name`           varchar(150)         DEFAULT NULL,
    `file_video_url`            varchar(255)         DEFAULT NULL COMMENT 'if external link, (ex : Youtube Link)',
    `published`                 datetime    NOT NULL,
    `status`                    smallint(1) NOT NULL DEFAULT '0',
    `created_at`                datetime    NOT NULL,
    `created_by`                varchar(25)          DEFAULT NULL,
    `updated_at`                timestamp   NOT NULL,
    `updated_by`                varchar(25)          DEFAULT NULL,
    `deleted_at`                datetime             DEFAULT NULL,
    `deleted_by`                varchar(25)          DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pfe_posts`
--
ALTER TABLE `pfe_posts`
    ADD PRIMARY KEY (`id`),
    ADD KEY `users_id` (`users_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pfe_posts`
--
ALTER TABLE `pfe_posts`
    ADD CONSTRAINT `pfe_posts_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


CREATE TABLE `pfe_articles_categories`
(
    `id`                  varchar(25)  NOT NULL,
    `data_position`       int(11)      NOT NULL DEFAULT '0',
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
  DEFAULT CHARSET = utf8 COMMENT ='pfe_articles_categories';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pfe_articles_categories`
--
ALTER TABLE `pfe_articles_categories`
    ADD PRIMARY KEY (`id`);


CREATE TABLE `pfe_articles`
(
    `id`                  varchar(25)                  NOT NULL,
    `users_id`            varchar(25)                  NOT NULL,
    `pdb_business_id`     varchar(25)                           DEFAULT NULL COMMENT 'if type business_id',
    `data_type`           enum ('personal','business') NOT NULL,
    `data_name`           varchar(255)                 NOT NULL,
    `data_name_lang`      text,
    `data_permalinks`     varchar(255)                          DEFAULT NULL,
    `data_description`    text,
    `data_categories`     text,
    `data_tags`           text,
    `file_path`           varchar(120)                          DEFAULT NULL,
    `file_name_thumbnail` varchar(255)                          DEFAULT NULL,
    `file_name_original`  varchar(255)                          DEFAULT NULL,
    `file_json`           text,
    `published`           datetime                     NOT NULL,
    `status`              smallint(1)                  NOT NULL DEFAULT '0',
    `created_at`          datetime                     NOT NULL,
    `created_by`          varchar(25)                           DEFAULT NULL,
    `updated_at`          timestamp                    NOT NULL,
    `updated_by`          varchar(25)                           DEFAULT NULL,
    `deleted_at`          datetime                              DEFAULT NULL,
    `deleted_by`          varchar(25)                           DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pfe_articles`
--
ALTER TABLE `pfe_articles`
    ADD PRIMARY KEY (`id`),
    ADD KEY `users_id` (`users_id`),
    ADD KEY `pdb_business_id` (`pdb_business_id`);

ALTER TABLE `pfe_articles`
    ADD CONSTRAINT `pfe_articles_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `pfe_articles_ibfk_2` FOREIGN KEY (`pdb_business_id`) REFERENCES `pbd_business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


CREATE TABLE `mst_licenses`
(
    `id`                  varchar(25)  NOT NULL,
    `data_position`       int(11)      NOT NULL DEFAULT '0',
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

ALTER TABLE `mst_licenses`
    ADD PRIMARY KEY (`id`);


CREATE TABLE `mst_works_experiences`
(
    `id`                  varchar(25)  NOT NULL,
    `data_position`       int(11)      NOT NULL DEFAULT '0',
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

ALTER TABLE `mst_works_experiences`
    ADD PRIMARY KEY (`id`);


CREATE TABLE `mst_courses_privates`
(
    `id`                  varchar(25)  NOT NULL,
    `data_position`       int(11)      NOT NULL DEFAULT '0',
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

ALTER TABLE `mst_courses_privates`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
    ADD `data_status`    VARCHAR(255) NULL AFTER `email`,
    ADD `data_locations` TEXT         NULL AFTER `data_status`;



INSERT INTO `users_albums_categories` (`id`, `data_position`, `data_name`, `data_name_lang`, `data_permalinks`,
                                       `data_description`, `file_path`, `file_name_thumbnail`, `file_name_original`,
                                       `file_json`, `published`, `status`, `status_disable`, `created_at`, `created_by`,
                                       `updated_at`, `updated_by`, `deleted_at`, `deleted_by`)
VALUES ('21072660FE4AABD20B2', 0, 'Profile Photos', NULL, NULL, 'Use for categories profile photos', NULL, NULL, NULL,
        NULL, '2021-07-26 00:00:00', 1, 0, '2021-07-26 12:39:55', NULL, '2021-07-26 05:39:55', NULL, NULL, NULL),
       ('21072660FE4ACBC1A27', 0, 'Cover Photos', NULL, NULL, 'Use for categories cover photos', NULL, NULL, NULL, NULL,
        '2021-07-26 00:00:00', 1, 0, '2021-07-26 12:40:27', NULL, '2021-07-26 05:40:27', NULL, NULL, NULL),
       ('21072660FE4AD740B73', 0, 'Timeline Photos', NULL, NULL, 'Use for categories timeline photos', NULL, NULL, NULL,
        NULL, '2021-07-26 00:00:00', 1, 0, '2021-07-26 12:40:39', NULL, '2021-07-26 05:40:39', NULL, NULL, NULL);
