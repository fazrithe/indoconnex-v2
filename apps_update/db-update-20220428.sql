# create table sitemaps
CREATE TABLE `sitemaps` (
  `id` INT NOT NULL AUTO_INCREMENT, 
  `slug_url` VARCHAR(255) NOT NULL, 
  `last_update` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

# insert data to table sitemaps
INSERT INTO sitemaps(slug_url) 
VALUES 
  ("/user/login"), 
  ("/user/register"), 
  ("/user/reset"), 
  ("/about-us"), 
  ("/partners"), 
  ("/news"), 
  ("/covid/info"), 
  ("/contact-us"), 
  ("/service/Indoconnex-Website"), 
  ("/service/Digital-Marketing"), 
  ("/service/Graphic-Design"), 
  ("/service/Content-Creator"), 
  ("/service/Business-Consultant"), 
  (
    "/service/Software-Development-Outsourcing"
  ), 
  ("/service/Corporate-Identity"), 
  ("/service/Business-Matching"), 
  (
    "/service/Document-Distilation"
  ), 
  ("/service/Brochure"), 
  ("/terms"), 
  ("/privacy"), 
  ("/infocenter"), 
  ("/page/jobs/employee-search"), 
  ("/page/shopping-centre"), 
  ("/page/supermarket"), 
  ("/page/beauty-and-care"), 
  ("/page/best-destination"), 
  ("/page/entertainment");