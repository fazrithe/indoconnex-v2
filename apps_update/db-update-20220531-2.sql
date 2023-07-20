ALTER TABLE `pbd_items`
    ADD `data_email` VARCHAR(255) NULL AFTER `status_price_display`,  
	ADD `data_phone` VARCHAR(255) NULL AFTER `data_email`;

ALTER TABLE `pbd_items_sells`
    ADD `data_email` VARCHAR(255) NULL AFTER `data_detail_address`,  
	ADD `data_phone` VARCHAR(255) NULL AFTER `data_email`;
