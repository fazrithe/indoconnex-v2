ALTER TABLE `pbd_items`
    ADD `price_type` VARCHAR(150) NULL  AFTER `price_discount`,  ADD `data_label` TEXT NULL  AFTER `price_type`,  ADD `data_sku` VARCHAR(100) NULL  AFTER `data_label`;

ALTER TABLE `pbd_items`
    ADD `price_variant` TEXT NULL  AFTER `price_type`,  ADD `price_currency` VARCHAR(100) NULL  AFTER `price_variant`;

ALTER TABLE `users`
    ADD `data_contact_website` TEXT NULL  AFTER `data_contact_info`,  ADD `data_contact_socialmedia` TEXT NULL  AFTER `data_contact_website`;


CREATE TABLE `pbd_items_labels`
(
    `id`                  varchar(25)  NOT NULL,
    `parent`              varchar(25)  NOT NULL DEFAULT '0',
    `data_position`       int(11) NOT NULL DEFAULT '0',
    `pbd_business_id`     varchar(25)           DEFAULT NULL,
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
-- Indexes for table `pbd_items_labels`
--
ALTER TABLE `pbd_items_labels`
    ADD PRIMARY KEY (`id`),
  ADD KEY `pdb_business_id` (`pbd_business_id`);