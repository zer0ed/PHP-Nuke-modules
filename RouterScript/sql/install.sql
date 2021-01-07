# phpMyAdmin MySQL-Dump
# version 2.2.0
# http://phpwizard.net/phpMyAdmin/
# http://phpmyadmin.sourceforge.net/ (download page)
# --------------------------------------------------------

#
# Table structure for table `nuke_routers`
#

DROP TABLE IF EXISTS nuke_routers;
CREATE TABLE nuke_routers (
  rid int(10) NOT NULL auto_increment,
  rname varchar(80) default NULL,
  rauthorname varchar(80) default NULL,
  rauthoremail varchar(40) default NULL,
  rsitename varchar(80) default NULL,
  rsiteurl varchar(150) default NULL,
  rtime varchar(8) default NULL,
  rcost varchar(20) default NULL,
  rsoft varchar(30) default NULL,
  rcpu varchar(30) default NULL,
  rram varchar(30) default NULL,
  rif1 varchar(30) default NULL,
  rif2 varchar(30) default NULL,
  rif3 varchar(30) default NULL,
  rhub varchar(30) default NULL,
  rdrives varchar(80) default NULL,
  rnote varchar(100) default NULL,
  rdetails text,
  vote_total int(10) NOT NULL default '0',
  vote_avg decimal(4,2) NOT NULL default '0.00',
  vote_1 int(10) NOT NULL default '0',
  vote_2 int(10) NOT NULL default '0',
  vote_3 int(10) NOT NULL default '0',
  vote_4 int(10) NOT NULL default '0',
  vote_5 int(10) NOT NULL default '0',
  vote_6 int(10) NOT NULL default '0',
  vote_7 int(10) NOT NULL default '0',
  vote_8 int(10) NOT NULL default '0',
  vote_9 int(10) NOT NULL default '0',
  vote_10 int(10) NOT NULL default '0',
  PRIMARY KEY  (rid)
) TYPE=MyISAM;

#
# Table structure for table `nuke_routers_pending`
#

DROP TABLE IF EXISTS nuke_routers_pending;
CREATE TABLE nuke_routers_pending (
  rpid int(10) NOT NULL auto_increment,
  rname varchar(80) default NULL,
  rauthorname varchar(80) default NULL,
  rauthoremail varchar(40) default NULL,
  rsitename varchar(80) default NULL,
  rsiteurl varchar(150) default NULL,
  rtime varchar(8) default NULL,
  rcost varchar(20) default NULL,
  rsoft varchar(30) default NULL,
  rcpu varchar(30) default NULL,
  rram varchar(30) default NULL,
  rif1 varchar(30) default NULL,
  rif2 varchar(30) default NULL,
  rif3 varchar(30) default NULL,
  rhub varchar(30) default NULL,
  rdrives varchar(80) default NULL,
  rnote varchar(100) default NULL,
  rdetails text,
  PRIMARY KEY  (rpid)
) TYPE=MyISAM;
   