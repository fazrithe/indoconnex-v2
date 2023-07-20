ALTER TABLE `2021indoconnex`.`apps_operator_privilege`   
  CHANGE `privilege` `privilege` VARCHAR(4) DEFAULT '1111' NULL;

UPDATE apps_operator_privilege
SET privilege = '0000'
WHERE privilege = '0';