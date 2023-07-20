ALTER TABLE `pcs_communities`
    ADD `data_social_links` TEXT NULL AFTER `data_categories`, ADD `data_contact_website` TEXT NULL AFTER `data_social_links`;

ALTER TABLE `pcs_communities`
    ADD `cover_file_path` VARCHAR(100) NULL AFTER `file_json`, ADD `cover_file_name_thumbnail` VARCHAR(255) NULL AFTER `cover_file_path`, ADD `cover_file_name_original` VARCHAR(255) NULL AFTER `cover_file_name_thumbnail`, ADD `cover_file_json` TEXT NULL AFTER `cover_file_name_original`;


ALTER TABLE `pcs_communities`
    ADD `data_contact_info` TEXT NULL  AFTER `data_categories`;

CREATE TABLE `pcs_communities_follows`
(
    `id`                 bigint(20) NOT NULL,
    `pcs_communities_id` varchar(25) NOT NULL COMMENT 'this user action to follow people',
    `user_follow_id`     varchar(25) NOT NULL COMMENT 'people',
    `created_at`         datetime    NOT NULL,
    `updated_at`         datetime    NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `pcs_posts`
(
    `id`                        varchar(25) NOT NULL,
    `parent`                    varchar(25) NOT NULL DEFAULT '0' COMMENT 'if post quotes / reply from other post',
    `users_id`                  varchar(25) NOT NULL,
    `pcs_communities_id`        varchar(25) NOT NULL,
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
    `updated_at`                timestamp   NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `updated_by`                varchar(25)          DEFAULT NULL,
    `deleted_at`                datetime             DEFAULT NULL,
    `deleted_by`                varchar(25)          DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;