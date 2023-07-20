-- Table User Favorites

CREATE TABLE `users_favorites`
(
    `id`                  bigint(20) NOT NULL,
    `user_id`             varchar(25)  NOT NULL COMMENT 'this user id',
    `relation_module`     varchar(200) NOT NULL,
    `relation_table_name` varchar(150) NOT NULL,
    `relation_table_id`   varchar(25)  NOT NULL,
    `created_at`          datetime     NOT NULL,
    `updated_at`          datetime     NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `users_favorites`
    ADD PRIMARY KEY (`id`) USING BTREE;
ALTER TABLE `users_favorites`
    MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

-- Table Community Look For
CREATE TABLE `pcs_posts_lookfoor`
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

ALTER TABLE `pcs_posts_lookfoor`
    ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `users_id` (`users_id`) USING BTREE;


ALTER TABLE `pcs_posts_lookfoor` CHANGE `pbd_business_id` `pcs_communities_id` VARCHAR (25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;