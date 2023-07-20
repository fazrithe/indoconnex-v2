ALTER TABLE `pcj_jobs_industries`
    ADD `parent` VARCHAR(25) NOT NULL AFTER `id`;

ALTER TABLE `pbd_business`
    ADD `bd_address_zipcode` VARCHAR(30) NULL AFTER `bd_address`;