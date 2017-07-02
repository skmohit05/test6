CREATE TABLE IF NOT EXISTS `cook_person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(111) NOT NULL,
  `email` varchar(111) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `orderdate` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1377 ;

CREATE TABLE IF NOT EXISTS `delivery_persons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(111) NOT NULL,
  `email` varchar(111) NOT NULL,
  `username` varchar(111) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `aadhar_pan_id` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `due_amount` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1377 ;
