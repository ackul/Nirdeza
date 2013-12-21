DROP TABLE IF EXISTS `sql_iden`;

CREATE TABLE `sql_iden` (
  `ID` int(20) NOT NULL auto_increment,
  `UniqueID` varchar(24) NOT NULL,
  `Server` varchar(60) NOT NULL,
  `Password` text NOT NULL,
  `User` varchar(60) NOT NULL,
  `Database` text NOT NULL,
  `Timestamp` varchar(11) NOT NULL,
  `Status` int(11) NOT NULL default '0',
  `Data` longtext NOT NULL,
  `Cookies` int(1) NOT NULL default '0',
  `IpLock` tinyint(1) NOT NULL default '0',
  `Ip` varchar(15) NOT NULL,
  `NoTimeout` int(1) NOT NULL default '0',
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `UNIQUE` (`UniqueID`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `sql_keys`;

CREATE TABLE `sql_keys` (
  `key` varchar(15) NOT NULL,
  `value` varchar(15) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  UNIQUE KEY `key` (`key`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `sql_user`;

CREATE TABLE `sql_user` (
  `ID` int(11) NOT NULL auto_increment,
  `Admin` int(11) default '0',
  `toUser` int(11) NOT NULL default '0',
  `Name` text,
  `Password` longtext,
  `Server` text,
  `Database` text,
  `Tables` longtext,
  `Admin_User` text,
  `Admin_Pass` longtext,
  `UnID` varchar(20) default NULL,
  `EMail` text NOT NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `UnID` (`UnID`)
) TYPE=MyISAM;