ALTER TABLE `pbd_business_categories`
    ADD `inj_log` VARCHAR(50) NULL AFTER `status`;

ALTER TABLE `pbd_business_categories`
    ADD `parent` VARCHAR(25) NOT NULL DEFAULT '0' AFTER `id`;