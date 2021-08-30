
CREATE TABLE IF NOT EXISTS `starratinglog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mytime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `articleid` int(11) DEFAULT NULL,
  `result` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


INSERT INTO `starratinglog` (`id`, `mytime`, `articleid`, `result`) VALUES
	(1, '2021-01-07 11:41:57', 1221, 4),
	(2, '2021-08-30 14:57:45', 1221, 4);

