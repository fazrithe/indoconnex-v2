ALTER TABLE `pbd_business`
    ADD `users_id` VARCHAR(25) NULL AFTER `id`;
ALTER TABLE `pbd_items`
    ADD `users_id` VARCHAR(25) NULL AFTER `id`;