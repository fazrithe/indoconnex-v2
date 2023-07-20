ALTER TABLE `pbd_business`
    ADD `data_username` VARCHAR(150) NULL AFTER `id`;
ALTER TABLE `pbd_business`
    ADD `data_facilities` TEXT NULL AFTER `data_locations`;
ALTER TABLE `pbd_business`
    ADD `data_facilities` TEXT NULL AFTER `data_locations`;

ALTER TABLE `pbd_items`
    ADD `status_buy_sells` TINYINT(1) NOT NULL DEFAULT '0' AFTER `status`;

ALTER TABLE `pnu_news`
    ADD `data_short_description` VARCHAR(255) NULL AFTER `data_permalinks`;

ALTER TABLE `pnu_news`
    ADD `data_locations` VARCHAR(255) NULL AFTER `data_categories`;
ALTER TABLE `pnu_news`
    ADD `inj_log` VARCHAR(50) NULL AFTER `status`;

ALTER TABLE `pnu_news_categories`
    ADD `inj_log` VARCHAR(50) NULL AFTER `status`;

ALTER TABLE `pbd_business`
    CHANGE `bd_hours_work` `bd_hours_work` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `pbd_items`
    ADD `data_short_description` VARCHAR(255) NULL AFTER `data_permalinks`;
ALTER TABLE `pbd_items_categories`
    ADD `inj_log` VARCHAR(50) NULL AFTER `status`;
ALTER TABLE `pbd_items`
    ADD `inj_log` VARCHAR(50) NULL AFTER `status`;
ALTER TABLE `pbd_items`
    ADD `data_locations` TEXT NULL AFTER `data_categories`;

ALTER TABLE `pbd_items`
    CHANGE `pbd_business_id` `pbd_business_id` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;
ALTER TABLE `pnu_news`
    CHANGE `pbd_business_id` `pbd_business_id` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;
ALTER TABLE `pbd_items`
    ADD `status_price_display` TINYINT(1) NOT NULL DEFAULT '0' AFTER `status_buy_sells`;

ALTER TABLE `pbd_items`
    ADD `data_type` ENUM ('product','service','') NOT NULL AFTER `pbd_business_id`;