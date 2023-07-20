ALTER TABLE `pbd_items_categories`
    ADD `data_position` INT NOT NULL DEFAULT '0' AFTER `id`;
ALTER TABLE `pbd_business_files_categories`
    ADD `data_position` INT NOT NULL DEFAULT '0' AFTER `id`;
ALTER TABLE `pbd_business_photo_categories`
    ADD `data_position` INT NOT NULL DEFAULT '0' AFTER `id`;
ALTER TABLE `pbd_business_types`
    ADD `data_position` INT NOT NULL DEFAULT '0' AFTER `id`;