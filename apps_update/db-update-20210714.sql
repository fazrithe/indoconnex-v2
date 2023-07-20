ALTER TABLE `users_devices_sess`
    ADD `browser_name` VARCHAR(255) NULL AFTER `devices_added`,
    ADD `ip_address`   VARCHAR(255) NULL AFTER `browser_name`;

ALTER TABLE `users`
    ADD `cover_file_path`           VARCHAR(120) NULL AFTER `file_json`,
    ADD `cover_file_name_thumbnail` VARCHAR(255) NULL AFTER `cover_file_path`,
    ADD `cover_file_name_original`  VARCHAR(255) NULL AFTER `cover_file_name_thumbnail`,
    ADD `cover_file_json`           TEXT         NULL AFTER `cover_file_name_original`;

ALTER TABLE `pbd_business_categories`
    ADD `data_position` INT NOT NULL DEFAULT '0' AFTER `id`;
ALTER TABLE `users_albums_categories`
    ADD `data_position` INT NOT NULL DEFAULT '0' AFTER `id`;
ALTER TABLE `pcs_communities_categories`
    ADD `data_position` INT NOT NULL DEFAULT '0' AFTER `id`;

ALTER TABLE `mst_educations`
    ADD `data_position` INT NOT NULL DEFAULT '0' AFTER `id`;
ALTER TABLE `mst_hobbies`
    ADD `data_position` INT NOT NULL DEFAULT '0' AFTER `id`;
ALTER TABLE `mst_skills`
    ADD `data_position` INT NOT NULL DEFAULT '0' AFTER `id`;
