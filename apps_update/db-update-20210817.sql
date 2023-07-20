
ALTER TABLE `users` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;


ALTER TABLE `users_acl` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;


ALTER TABLE `users_albums` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;


ALTER TABLE `users_albums_categories` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;


ALTER TABLE `users_albums_photo` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;
    

ALTER TABLE `users_devices_sess` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;


ALTER TABLE `mst_courses_privates` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;

ALTER TABLE `mst_educations` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;

ALTER TABLE `mst_hobbies` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;

ALTER TABLE `mst_licenses` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;

ALTER TABLE `mst_skills` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;

ALTER TABLE `mst_work_experiences` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;

ALTER TABLE `pbd_business` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;

ALTER TABLE `pbd_business_categories` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;

ALTER TABLE `pbd_business_files` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;

ALTER TABLE `pbd_business_files_categories` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;

ALTER TABLE `pbd_business_photo` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;

ALTER TABLE `pbd_business_photo_categories` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;

ALTER TABLE `pbd_business_types` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;

ALTER TABLE `pbd_items` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;

ALTER TABLE `pbd_items_categories` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;

ALTER TABLE `pbd_items_photo` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;

ALTER TABLE `pbd_items_photo_categories` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;

ALTER TABLE `pcs_communities` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;

ALTER TABLE `pcs_communities_albums` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;

ALTER TABLE `pcs_communities_albums_photo` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;

ALTER TABLE `pcs_communities_categories` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;

ALTER TABLE `pfe_articles` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;

ALTER TABLE `pfe_articles_categories` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;

ALTER TABLE `pfe_posts` 
    CHANGE `created_by` `created_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `updated_by` `updated_by` VARCHAR(25) NULL DEFAULT NULL, 
    CHANGE `deleted_by` `deleted_by` VARCHAR(25) NULL DEFAULT NULL;


CREATE TABLE `pfe_media_comments` (
  `id` varchar(25) NOT NULL,
  `relate_id` varchar(25) NOT NULL COMMENT 'foreign key from table',
  `relate_table` varchar(255) NOT NULL COMMENT 'relation table name. ex : users_albums_photo',
  `parent` varchar(25) NOT NULL DEFAULT '0' COMMENT 'if post quotes / reply from other post',
  `users_id` varchar(25) NOT NULL,
  `data_description` longtext,
  `file_image_path` varchar(120) DEFAULT NULL,
  `file_image_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_image_name_original` varchar(255) DEFAULT NULL,
  `file_image_url` varchar(255) DEFAULT NULL,
  `file_video_path` varchar(150) DEFAULT NULL,
  `file_video_name` varchar(150) DEFAULT NULL,
  `file_video_url` varchar(255) DEFAULT NULL COMMENT 'if external link, (ex : Youtube Link)',
  `published` datetime NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `pfe_media_likes` (
  `id` bigint(20) NOT NULL,
  `users_id` varchar(25) NOT NULL COMMENT 'people',
  `relate_id` varchar(25) NOT NULL COMMENT 'foreign key from table',
  `relate_table` varchar(100) NOT NULL COMMENT 'relation table name. ex : users_albums_photo',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `pfe_articles_categories`  ADD `parent` VARCHAR(25) NOT NULL DEFAULT '0'  AFTER `id`;


CREATE TABLE `pcj_jobs_experiences` (
  `id` varchar(25) NOT NULL,
  `data_position` int(11) NOT NULL DEFAULT '0',
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for table `pcj_jobs_experiences`
--
ALTER TABLE `pcj_jobs_experiences`
  ADD PRIMARY KEY (`id`);


CREATE TABLE `pcj_jobs_industries` (
  `id` varchar(25) NOT NULL,
  `data_position` int(11) NOT NULL DEFAULT '0',
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pcj_jobs_industries`
--
ALTER TABLE `pcj_jobs_industries`
  ADD PRIMARY KEY (`id`);


CREATE TABLE `pcj_jobs_salary_period` (
  `id` varchar(25) NOT NULL,
  `data_position` int(11) NOT NULL DEFAULT '0',
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pcj_jobs_salary_period`
--
ALTER TABLE `pcj_jobs_salary_period`
  ADD PRIMARY KEY (`id`);


CREATE TABLE `pcj_jobs_types` (
  `id` varchar(25) NOT NULL,
  `data_position` int(11) NOT NULL DEFAULT '0',
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pcj_jobs_types`
--
ALTER TABLE `pcj_jobs_types`
  ADD PRIMARY KEY (`id`);

CREATE TABLE `pcj_jobs` (
  `id` varchar(25) NOT NULL,
  `users_id` varchar(25) NOT NULL,
  `pbd_business_id` varchar(25) DEFAULT NULL COMMENT 'if type business_id',
  `data_type` enum('personal','business') NOT NULL,
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `data_categories` text COMMENT 'Data format JSON, multiple id categories',
  `data_location` text,
  `jobs_types_id` varchar(25) NOT NULL,
  `jobs_industries_id` varchar(25) NOT NULL,
  `jobs_salary_period_id` varchar(25) NOT NULL,
  `jobs_experiences_id` varchar(25) NOT NULL,
  `jb_salary_min` double NOT NULL DEFAULT '0',
  `jb_salary_max` double NOT NULL DEFAULT '0',
  `jb_contact_from` varchar(100) DEFAULT NULL,
  `jb_contact_number` varchar(50) DEFAULT NULL,
  `jb_receive_app_email` tinyint(1) NOT NULL DEFAULT '0',
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pcj_jobs`
--
ALTER TABLE `pcj_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pdb_business_id` (`pbd_business_id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `jobs_experiences_id` (`jobs_experiences_id`),
  ADD KEY `jobs_industries_id` (`jobs_industries_id`),
  ADD KEY `jobs_salary_period_id` (`jobs_salary_period_id`),
  ADD KEY `jobs_types_id` (`jobs_types_id`);


--
-- Constraints for table `pcj_jobs`
--
ALTER TABLE `pcj_jobs`
  ADD CONSTRAINT `pcj_jobs_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pcj_jobs_ibfk_2` FOREIGN KEY (`pbd_business_id`) REFERENCES `pbd_business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pcj_jobs_ibfk_3` FOREIGN KEY (`jobs_experiences_id`) REFERENCES `pcj_jobs_experiences` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pcj_jobs_ibfk_4` FOREIGN KEY (`jobs_industries_id`) REFERENCES `pcj_jobs_industries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pcj_jobs_ibfk_5` FOREIGN KEY (`jobs_salary_period_id`) REFERENCES `pcj_jobs_salary_period` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pcj_jobs_ibfk_6` FOREIGN KEY (`jobs_types_id`) REFERENCES `pcj_jobs_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


CREATE TABLE `pcj_jobs_applicants` (
  `id` bigint(20) NOT NULL,
  `users_id` varchar(25) NOT NULL COMMENT 'people',
  `jobs_id` varchar(25) NOT NULL,
  `data_description` text,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pcj_jobs_applicants`
--
ALTER TABLE `pcj_jobs_applicants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `jobs_id` (`jobs_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pcj_jobs_applicants`
--
ALTER TABLE `pcj_jobs_applicants`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pcj_jobs_applicants`
--
ALTER TABLE `pcj_jobs_applicants`
  ADD CONSTRAINT `pcj_jobs_applicants_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `pcj_jobs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pcj_jobs_applicants_ibfk_2` FOREIGN KEY (`jobs_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


CREATE TABLE `pnu_news_categories` (
  `id` varchar(25) NOT NULL,
  `parent` varchar(25) NOT NULL DEFAULT '0',
  `data_position` int(11) NOT NULL DEFAULT '0',
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='pfe_articles_categories';


ALTER TABLE `pnu_news_categories`
  ADD PRIMARY KEY (`id`);


CREATE TABLE `pnu_news` (
  `id` varchar(25) NOT NULL,
  `users_id` varchar(25) NOT NULL,
  `pbd_business_id` varchar(25) DEFAULT NULL COMMENT 'if type business_id',
  `data_type` enum('personal','business') NOT NULL,
  `data_name` varchar(255) NOT NULL,
  `data_name_lang` text,
  `data_permalinks` varchar(255) DEFAULT NULL,
  `data_description` text,
  `data_categories` text,
  `data_tags` text,
  `file_path` varchar(120) DEFAULT NULL,
  `file_name_thumbnail` varchar(255) DEFAULT NULL,
  `file_name_original` varchar(255) DEFAULT NULL,
  `file_json` text,
  `published` datetime NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `pnu_news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `pdb_business_id` (`pbd_business_id`);

ALTER TABLE `pnu_news`
  ADD CONSTRAINT `pnu_news_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pnu_news_ibfk_2` FOREIGN KEY (`pbd_business_id`) REFERENCES `pbd_business` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
