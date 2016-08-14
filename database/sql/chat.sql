--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE `chat` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `usrname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chattext` text COLLATE utf8_unicode_ci NOT NULL,
  `chattime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `chat_users`
--

DROP TABLE IF EXISTS `chat_users`;
CREATE TABLE `chat_users` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `firstname` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

