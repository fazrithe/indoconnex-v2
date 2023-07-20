ALTER TABLE `users`  
    ADD `name_first` VARCHAR(150) NOT NULL  AFTER `name_nick`,  
    ADD `name_middle` VARCHAR(150) NOT NULL  AFTER `name_first`,  
    ADD `name_last` VARCHAR(150) NOT NULL  AFTER `name_middle`;