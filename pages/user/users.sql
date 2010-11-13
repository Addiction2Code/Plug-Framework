CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(150) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `access` int(55) NOT NULL,
  `email` varchar(350) NOT NULL,
  `password` varchar(400) NOT NULL,
  `register_date` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `website` varchar(500) NOT NULL,
  `photo` varchar(500) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
