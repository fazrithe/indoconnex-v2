CREATE TABLE `apps_menus` (
  `id` VARCHAR(25) NOT NULL,
  `parent` VARCHAR(255) DEFAULT '#',
  `menu_ordering` INT(11) DEFAULT 1,
  `menu_level` INT(11) DEFAULT 1,
  `menu_name` VARCHAR(255) DEFAULT NULL,
  `menu_icon` VARCHAR(255) DEFAULT NULL,
  `menu_link` VARCHAR(255) DEFAULT NULL,
  `status` SMALLINT(2) DEFAULT 1,
  `menu_display` SMALLINT(2) DEFAULT 1,
  `created_at` DATETIME DEFAULT NULL,
  `created_by` VARCHAR(25) DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  `updated_by` VARCHAR(25) DEFAULT NULL,
  `deleted_at` DATETIME DEFAULT NULL,
  `deleted_by` VARCHAR(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `apps_operator_privilege` (
  `operator_id` VARCHAR(25) NOT NULL,
  `menus_id` VARCHAR(25) NOT NULL,
  `privilege` INT(4) DEFAULT '1111',
  PRIMARY KEY (`operator_id`,`menus_id`),
  KEY `menus_id` (`menus_id`),
  CONSTRAINT `apps_operator_privilege_ibfk_1` FOREIGN KEY (`operator_id`) REFERENCES `apps_operator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `apps_operator_privilege_ibfk_2` FOREIGN KEY (`menus_id`) REFERENCES `apps_menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8;