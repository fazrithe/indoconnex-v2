ALTER TABLE `pub_page_banners`
    ADD `data_name_sub` VARCHAR(255) NULL  AFTER `data_name_lang`,  ADD `data_name_sub_lang` TEXT NULL  AFTER `data_name_sub`;