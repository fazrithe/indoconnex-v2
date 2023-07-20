ALTER TABLE `pbd_business`  
  ADD `cover_file_path` VARCHAR(100) NULL  AFTER `file_json`,  
  ADD `cover_file_name_thumbnail` VARCHAR(255) NULL  AFTER `cover_file_path`,  
  ADD `cover_file_name_original` VARCHAR(255) NULL  AFTER `cover_file_name_thumbnail`,  
  ADD `cover_file_json` TEXT NULL  AFTER `cover_file_name_original`;