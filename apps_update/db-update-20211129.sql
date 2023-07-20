ALTER TABLE `pbd_business`
    ADD `data_contact_info` TEXT NULL  AFTER `data_certifications`;

ALTER TABLE `pbd_business`
    ADD `data_contact_website` TEXT NULL  AFTER `data_contact_info`;