--
-- Table structure for table `announcements`
--

CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int(11) NOT NULL auto_increment,
  `description` text NOT NULL,
  `displayorder` int(2) NOT NULL,
  `startdate` date default NULL,
  `enddate` date default NULL,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `datesearch` (`startdate`,`enddate`,`active`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `announcements`
--
