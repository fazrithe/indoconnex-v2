
ALTER TABLE `pfe_articles` CHANGE `pdb_business_id` `pbd_business_id` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'if type business_id';
ALTER TABLE `pbd_business_files` CHANGE `pdb_business_id` `pbd_business_id` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `pbd_business_files_categories` CHANGE `pdb_business_id` `pbd_business_id` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `pbd_business_follows` CHANGE `pdb_business_id` `pbd_business_id` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'this user action to follow people';
ALTER TABLE `pbd_business_likes` CHANGE `pdb_business_id` `pbd_business_id` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'this user action to follow people';
ALTER TABLE `pbd_business_photo` CHANGE `pdb_business_id` `pbd_business_id` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, CHANGE `pdb_business_categories_id` `pbd_business_categories_id` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Optional';
ALTER TABLE `pbd_business_photo_categories` CHANGE `pdb_business_id` `pbd_business_id` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `pbd_items` CHANGE `pdb_business_id` `pbd_business_id` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `pbd_items_categories` CHANGE `pdb_business_id` `pbd_business_id` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `pbd_items_follows` CHANGE `pdb_items_id` `pbd_items_id` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'this user action to follow people';
ALTER TABLE `pbd_items_likes` CHANGE `pdb_items_id` `pbd_items_id` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'this user action to follow people';
ALTER TABLE `pbd_items_photo` CHANGE `pdb_business_id` `pbd_business_id` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, CHANGE `pdb_items_id` `pbd_items_id` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, CHANGE `pdb_items_photo_categories_id` `pbd_items_photo_categories_id` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Optional';
ALTER TABLE `pbd_items_photo_categories` CHANGE `pdb_business_id` `pbd_business_id` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

