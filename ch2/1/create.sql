CREATE TABLE `yesno` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`mytime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`articleid` INT(11) NULL DEFAULT NULL,
	`result` VARCHAR(10) NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=2
;