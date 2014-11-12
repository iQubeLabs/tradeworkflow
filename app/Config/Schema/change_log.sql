# ALTER TABLE  `shippings` ADD  `date_cleared` DATETIME NULL DEFAULT NULL AFTER  `is_cleared` ;

# 14/08/2014
-- ALTER TABLE  `received_sms_requested` ADD PRIMARY KEY (  `id` ) ;
-- ALTER TABLE  `received_web_requested` ADD PRIMARY KEY (  `id` ) ;
-- ALTER TABLE  `response_sms_requests` ADD PRIMARY KEY (  `id` ) ;
-- ALTER TABLE  `response_web_requests` ADD PRIMARY KEY (  `id` ) ;

-- 20/08/2014
-- ALTER TABLE  `trades` ADD  `name` VARCHAR( 255 ) NOT NULL AFTER  `id` ;
-- ALTER TABLE  `couriers` CHANGE  `id`  `id` INT( 11 ) NOT NULL AUTO_INCREMENT ;

-- 22/08/2014
-- ALTER TABLE  `shippings` ADD  `demurrage_cost_per_day` FLOAT(11) NULL AFTER  `date_cleared` ;
-- ALTER TABLE  `shippings` ADD  `demurrage_last_day` DATETIME NULL AFTER  `demurrage_cost_per_day` ;

-- 13/09/2014
ALTER TABLE  `sellers` ADD  `address` TEXT NOT NULL AFTER  `contact_phone_number` ;
ALTER TABLE  `form_m` ADD  `customer_id` INT NOT NULL AFTER  `good_id` ,
ADD INDEX (  `form_m`.`customer_id` ) ;
ALTER TABLE  `form_m` DROP FOREIGN KEY  `loading_port_id` ;

ALTER TABLE  `form_m` ADD CONSTRAINT  `loading_port_id` FOREIGN KEY (  `loading_port_id` ) REFERENCES  `tradeworkflow`.`ports` (
`id`
) ON DELETE SET NULL ON UPDATE SET NULL ;

ALTER TABLE  `form_m` DROP FOREIGN KEY  `discharge_port_id` ;

ALTER TABLE  `form_m` ADD CONSTRAINT  `discharge_port_id` FOREIGN KEY (  `discharge_port_id` ) REFERENCES  `tradeworkflow`.`ports` (
`id`
) ON DELETE SET NULL ON UPDATE SET NULL ;