CREATE TABLE `pub_page_banners`
(
    `id`                  varchar(25)  NOT NULL,
    `parent`              varchar(25)  NOT NULL DEFAULT '0',
    `data_position`       int(11) NOT NULL DEFAULT '0',
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
    `created_at`          datetime     NOT NULL,
    `created_by`          varchar(25)           DEFAULT NULL,
    `updated_at`          timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `updated_by`          varchar(25)           DEFAULT NULL,
    `deleted_at`          datetime              DEFAULT NULL,
    `deleted_by`          varchar(25)           DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `pub_page_banners`
    ADD PRIMARY KEY (`id`) USING BTREE;


CREATE TABLE `pub_partners`
(
    `id`                  varchar(25)  NOT NULL,
    `parent`              varchar(25)  NOT NULL DEFAULT '0',
    `data_position`       int(11) NOT NULL DEFAULT '0',
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
    `status_display_home` tinyint(1) NOT NULL DEFAULT '0',
    `created_at`          datetime     NOT NULL,
    `created_by`          varchar(25)           DEFAULT NULL,
    `updated_at`          timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `updated_by`          varchar(25)           DEFAULT NULL,
    `deleted_at`          datetime              DEFAULT NULL,
    `deleted_by`          varchar(25)           DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `pub_partners`
    ADD PRIMARY KEY (`id`) USING BTREE;


CREATE TABLE `pub_profile`
(
    `id`                  varchar(25)  NOT NULL,
    `parent`              varchar(25)  NOT NULL DEFAULT '0',
    `data_position`       int(11) NOT NULL DEFAULT '0',
    `data_section`        varchar(255)          DEFAULT NULL,
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
    `created_at`          datetime     NOT NULL,
    `created_by`          varchar(25)           DEFAULT NULL,
    `updated_at`          timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `updated_by`          varchar(25)           DEFAULT NULL,
    `deleted_at`          datetime              DEFAULT NULL,
    `deleted_by`          varchar(25)           DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `pub_profile`
    ADD PRIMARY KEY (`id`) USING BTREE;


CREATE TABLE `pub_supports`
(
    `id`                  varchar(25)  NOT NULL,
    `parent`              varchar(25)  NOT NULL DEFAULT '0',
    `data_position`       int(11) NOT NULL DEFAULT '0',
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
    `status_display_home` tinyint(1) NOT NULL DEFAULT '0',
    `created_at`          datetime     NOT NULL,
    `created_by`          varchar(25)           DEFAULT NULL,
    `updated_at`          timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `updated_by`          varchar(25)           DEFAULT NULL,
    `deleted_at`          datetime              DEFAULT NULL,
    `deleted_by`          varchar(25)           DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `pub_supports`
    ADD PRIMARY KEY (`id`) USING BTREE;


CREATE TABLE `pub_widgets`
(
    `id`                  varchar(25)  NOT NULL,
    `parent`              varchar(25)  NOT NULL DEFAULT '0',
    `data_position`       int(11) NOT NULL DEFAULT '0',
    `data_name`           varchar(255) NOT NULL,
    `data_name_lang`      text,
    `data_permalinks`     varchar(255)          DEFAULT NULL,
    `data_description`    text,
    `data_link`           varchar(255)          DEFAULT NULL,
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

ALTER TABLE `pub_widgets`
    ADD PRIMARY KEY (`id`) USING BTREE;


CREATE TABLE `pub_works`
(
    `id`                  varchar(25)  NOT NULL,
    `parent`              varchar(25)  NOT NULL DEFAULT '0',
    `data_position`       int(11) NOT NULL DEFAULT '0',
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
    `created_at`          datetime     NOT NULL,
    `created_by`          varchar(25)           DEFAULT NULL,
    `updated_at`          timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `updated_by`          varchar(25)           DEFAULT NULL,
    `deleted_at`          datetime              DEFAULT NULL,
    `deleted_by`          varchar(25)           DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `pub_works`
    ADD PRIMARY KEY (`id`) USING BTREE;


INSERT INTO `pub_widgets` (`id`, `parent`, `data_position`, `data_name`, `data_name_lang`, `data_permalinks`, `data_description`, `data_link`, `file_path`, `file_name_thumbnail`, `file_name_original`, `file_json`, `published`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`)
VALUES ('21120761AEDD0F00429', '0', 1, 'Business', NULL, NULL, '', '', NULL, NULL, NULL, NULL, '2021-12-07 00:00:00', 1, '2021-12-07 11:03:27', '21070760E52834C6893', '2021-12-07 04:04:58', '21070760E52834C6893', NULL, NULL),
       ('21120761AEDD163374B', '0', 2, 'Jobs', NULL, NULL, '', '', NULL, NULL, NULL, NULL, '2021-12-07 00:00:00', 1, '2021-12-07 11:03:34', '21070760E52834C6893', '2021-12-07 04:04:58', '21070760E52834C6893', NULL, NULL),
       ('21120761AEDD22418AB', '0', 3, 'Lifestyle & Hobbies', NULL, NULL, '', '', NULL, NULL, NULL, NULL, '2021-12-07 00:00:00', 1, '2021-12-07 11:03:46', '21070760E52834C6893', '2021-12-07 04:04:58', '21070760E52834C6893', NULL, NULL),
       ('21120761AEDD285CB98', '0', 4, 'Personal Care', NULL, NULL, '', '', NULL, NULL, NULL, NULL, '2021-12-07 00:00:00', 1, '2021-12-07 11:03:52', '21070760E52834C6893', '2021-12-07 04:04:58', '21070760E52834C6893', NULL, NULL),
       ('21120761AEDD2E71C2F', '0', 5, 'Travel & Leisure', NULL, NULL, '', '', NULL, NULL, NULL, NULL, '2021-12-07 00:00:00', 1, '2021-12-07 11:03:58', '21070760E52834C6893', '2021-12-07 04:04:58', '21070760E52834C6893', NULL, NULL),
       ('21120761AEDD353235C', '0', 6, 'Health', NULL, NULL, '', '', NULL, NULL, NULL, NULL, '2021-12-07 00:00:00', 1, '2021-12-07 11:04:05', '21070760E52834C6893', '2021-12-07 04:04:58', '21070760E52834C6893', NULL, NULL),
       ('21120761AEDD3D059D3', '0', 7, 'Public Resources', NULL, NULL, '', '', NULL, NULL, NULL, NULL, '2021-12-07 00:00:00', 1, '2021-12-07 11:04:13', '21070760E52834C6893', '2021-12-07 04:04:58', '21070760E52834C6893', NULL, NULL),
       ('21120761AEDD48CFE5D', '0', 8, 'Property', NULL, NULL, '', '', NULL, NULL, NULL, NULL, '2021-12-07 00:00:00', 1, '2021-12-07 11:04:24', '21070760E52834C6893', '2021-12-07 04:04:58', '21070760E52834C6893', NULL, NULL),
       ('21120761AEDD526CC8F', '0', 9, 'Telecommunication', NULL, NULL, '', '', NULL, NULL, NULL, NULL, '2021-12-07 00:00:00', 1, '2021-12-07 11:04:34', '21070760E52834C6893', '2021-12-07 04:04:58', '21070760E52834C6893', NULL, NULL),
       ('21120761AEDD5A3935A', '0', 10, 'Community & Charity', NULL, NULL, '', '', NULL, NULL, NULL, NULL, '2021-12-07 00:00:00', 1, '2021-12-07 11:04:42', '21070760E52834C6893', '2021-12-07 04:04:58', '21070760E52834C6893', NULL, NULL);


INSERT INTO `pub_works` (`id`, `parent`, `data_position`, `data_name`, `data_name_lang`, `data_permalinks`, `data_description`, `file_path`, `file_name_thumbnail`, `file_name_original`, `file_json`, `published`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`)
VALUES ('21120761AEDDB6EB1B9', '0', 1, 'Connecting Businesses', NULL, NULL, '', NULL, NULL, NULL, NULL, '2021-12-07 00:00:00', 1, '2021-12-07 11:06:14', '21070760E52834C6893', '2021-12-07 04:07:02', '21070760E52834C6893', NULL, NULL),
       ('21120761AEDDBEEC623', '0', 2, 'Connecting Opportunities', NULL, NULL, '', NULL, NULL, NULL, NULL, '2021-12-07 00:00:00', 1, '2021-12-07 11:06:22', '21070760E52834C6893', '2021-12-07 04:07:03', '21070760E52834C6893', NULL, NULL),
       ('21120761AEDDC64C523', '0', 3, 'Connecting People', NULL, NULL, '', NULL, NULL, NULL, NULL, '2021-12-07 00:00:00', 1, '2021-12-07 11:06:30', '21070760E52834C6893', '2021-12-07 04:07:05', '21070760E52834C6893', NULL, NULL),
       ('21120761AEDDCE21B2C', '0', 4, 'Connecting Kindness', NULL, NULL, '', NULL, NULL, NULL, NULL, '2021-12-07 00:00:00', 1, '2021-12-07 11:06:38', '21070760E52834C6893', '2021-12-07 04:07:07', '21070760E52834C6893', NULL, NULL);


INSERT INTO `pub_profile` (`id`, `parent`, `data_position`, `data_section`, `data_name`, `data_name_lang`, `data_permalinks`, `data_description`, `file_path`, `file_name_thumbnail`, `file_name_original`, `file_json`, `published`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`)
VALUES ('21120761AED9E5282AD', '0', 1, 'section_about', 'About Us', NULL, NULL,
        '<p>IndoConnex is an integrated online platform that connects Indonesia to the world and the world to Indonesia, making everyday needs accessible from one unified source. Providing comprehensive information of all products, services, and resources in Indonesia and worldwide, this platform serves to facilitate and accelerate trade, investment, business exposure, employment opportunities, charity, tourism, and so forth.\r\n</p><p>\r\nDesigned and developed by PT Murni Solusindo Nusantara, a prominent solution provider and ICT-based companies with over 30 years of proven expertise in Indonesia and globally, IndoConnex aims to enhance multilateral relations between Indonesia and all countries worldwide.</p>',
        NULL, NULL, NULL, NULL, '2021-12-07 00:00:00', 1, '2021-12-07 10:49:57', '21070760E52834C6893', '2021-12-07 04:08:13', '21070760E52834C6893', NULL, NULL),
       ('21120761AEDE4286F7B', '0', 2, 'section_vision', 'Vision', NULL, NULL, 'Connecting people and supporting businesses from every scale and countries to thrive in the global market', NULL, NULL, NULL, NULL, '2021-12-07 00:00:00', 1, '2021-12-07 11:08:34', '21070760E52834C6893', '2021-12-07 04:08:34', '21070760E52834C6893', NULL, NULL),
       ('21120761AEDE51A7BBC', '0', 3, 'section_mission', 'Mission', NULL, NULL, '', NULL, NULL, NULL, NULL, '2021-12-07 00:00:00', 1, '2021-12-07 11:08:49', '21070760E52834C6893', '2021-12-07 04:08:49', '21070760E52834C6893', NULL, NULL),
       ('21120761AEDE6FA7D0B', '21120761AEDE51A7BBC', 4, 'section_mission_1', 'Connecting Businesses ', NULL, NULL, '<p>How we do it?<br></p>', NULL, NULL, NULL, NULL, '2021-12-07 00:00:00', 1, '2021-12-07 11:09:19', '21070760E52834C6893', '2021-12-07 04:09:19', '21070760E52834C6893', NULL, NULL),
       ('21120761AEDE812221F', '21120761AEDE51A7BBC', 5, 'section_mission_2', 'Connecting Opportunities', NULL, NULL, '', NULL, NULL, NULL, NULL, '2021-12-07 00:00:00', 1, '2021-12-07 11:09:37', '21070760E52834C6893', '2021-12-07 04:09:37', '21070760E52834C6893', NULL, NULL),
       ('21120761AEDE9385BC3', '21120761AEDE51A7BBC', 6, 'section_mission_3', 'Connecting People', NULL, NULL, '', NULL, NULL, NULL, NULL, '2021-12-07 00:00:00', 1, '2021-12-07 11:09:55', '21070760E52834C6893', '2021-12-07 04:09:55', '21070760E52834C6893', NULL, NULL),
       ('21120761AEDFF5AD6FC', '21120761AEDE51A7BBC', 7, 'section_mission_1', 'Connecting Kindness', NULL, NULL, '', NULL, NULL, NULL, NULL, '2021-12-07 00:00:00', 1, '2021-12-07 11:15:49', '21070760E52834C6893', '2021-12-07 04:15:49', '21070760E52834C6893', NULL, NULL),
       ('21120761AEE02C47AD4', '0', 8, 'section_quote', 'section_quote', NULL, NULL, '<p>“We are a solid team of future-driven professionals committed to making a difference in the world by providing a holistic and integrated global platform that connects, facilitates, and accelerates changes for people and business across the globe\"\r\n</p>\r\n<p></p><blockquote>Christian Liadinata Founder of IndoConnex</blockquote><p></p>', NULL, NULL, NULL, NULL, '2021-12-07 00:00:00', 1, '2021-12-07 11:16:44', '21070760E52834C6893', '2021-12-07 04:16:44', '21070760E52834C6893', NULL, NULL),
       ('21120761AEE04938E09', '0', 9, 'section_about_short', 'About Indoconnex', NULL, NULL,
        'IndoConnex is an integrated online platform that connects Indonesia to the world and the world to Indonesia, making everyday needs accessible from one unified source. Providing comprehensive information of all products, services, and resources in Indonesia and worldwide, this platform serves to facilitate and accelerate trade, investment, business exposure, employment opportunities, charity, tourism, and so forth. Designed and developed by PT Murni Solusindo Nusantara, a prominent solution provider and ICT-based companies with over 30 years of proven expertise in Indonesia and globally, IndoConnex aims to enhance multilateral relations between Indonesia and all countries worldwide.',
        NULL, NULL, NULL, NULL, '2021-12-07 00:00:00', 1, '2021-12-07 11:17:13', '21070760E52834C6893', '2021-12-07 04:17:13', '21070760E52834C6893', NULL, NULL),
       ('21120761AEE065080B7', '0', 10, 'section_join_our_community', 'Join Our Community', NULL, NULL, 'Join us now and be part of a global network that is committed to building a better future together.', NULL, NULL, NULL, NULL, '2021-12-07 00:00:00', 1, '2021-12-07 11:17:41', '21070760E52834C6893', '2021-12-07 04:17:41', '21070760E52834C6893', NULL, NULL),
       ('21120761AEE08F71A0D', '0', 11, 'section_grow_global', 'Be Part of Our Growing Global Community', NULL, NULL, 'Ready to expand your reach and make an impact every day? IndoConnex offers unlimited possibilities to help you envision your goals and reach your full potential while building a better future for all.', NULL, NULL, NULL, NULL, '2021-12-07 00:00:00', 1, '2021-12-07 11:18:23', '21070760E52834C6893', '2021-12-07 04:18:23', '21070760E52834C6893', NULL, NULL);
