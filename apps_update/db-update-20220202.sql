ALTER TABLE `pub_widgets`
    ADD `data_align` VARCHAR(100) NULL  AFTER `data_link_name`;



CREATE TABLE `csg_config`
(
    `id`                  varchar(25)  NOT NULL,
    `parent`              int(11) NOT NULL DEFAULT '0',
    `data_name`           varchar(255) NOT NULL,
    `data_value`          varchar(255)          DEFAULT NULL,
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
-- Indexes for table `csg_config`
--
ALTER TABLE `csg_config`
    ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `pub_page_banners`  ADD `data_align` VARCHAR(100) NULL  AFTER `data_description`;