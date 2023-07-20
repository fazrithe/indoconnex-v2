
CREATE TABLE `pub_promotions` (
                                  `id` varchar(25) NOT NULL,
                                  `parent` varchar(25) NOT NULL DEFAULT '0',
                                  `data_position` int(11) NOT NULL DEFAULT '0',
                                  `data_position_type` varchar(100) DEFAULT 'sidebar',
                                  `data_position_portal` varchar(100) DEFAULT 'public',
                                  `data_name` varchar(255) NOT NULL,
                                  `data_name_lang` text,
                                  `data_permalinks` varchar(255) DEFAULT NULL,
                                  `data_description` text,
                                  `data_link` varchar(255) DEFAULT NULL,
                                  `data_link_name` varchar(100) DEFAULT NULL,
                                  `file_path` varchar(120) DEFAULT NULL,
                                  `file_name_thumbnail` varchar(255) DEFAULT NULL,
                                  `file_name_original` varchar(255) DEFAULT NULL,
                                  `file_json` text,
                                  `published` datetime NOT NULL,
                                  `status` smallint(6) NOT NULL DEFAULT '0',
                                  `created_at` datetime NOT NULL,
                                  `created_by` varchar(25) DEFAULT NULL,
                                  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                                  `updated_by` varchar(25) DEFAULT NULL,
                                  `deleted_at` datetime DEFAULT NULL,
                                  `deleted_by` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pub_promotions`
--
ALTER TABLE `pub_promotions`
    ADD PRIMARY KEY (`id`) USING BTREE;