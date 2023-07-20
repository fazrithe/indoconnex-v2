ALTER TABLE `pcs_communities_categories`
    ADD `parent` VARCHAR(25) NOT NULL DEFAULT '0' AFTER `id`;