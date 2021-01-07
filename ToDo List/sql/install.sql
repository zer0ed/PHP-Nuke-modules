# phpMyAdmin MySQL-Dump
# version 2.2.6
# http://phpwizard.net/phpMyAdmin/
# http://www.phpmyadmin.net/ (download page)
#
# Host: localhost
# Generation Time: Jun 18, 2003 at 11:45 PM
# Server version: 4.00.01
# PHP Version: 4.2.2
# Database : `nuke`
# --------------------------------------------------------

#
# Table structure for table `nuke_todo`
#

DROP TABLE IF EXISTS nuke_todo;
CREATE TABLE nuke_todo (
  id int(10) NOT NULL auto_increment,
  priority tinyint(2) NOT NULL default '0',
  description varchar(200) NOT NULL default '',
  duedate date NOT NULL default '0000-00-00',
  assignedto varchar(50) NOT NULL default '',
  note text NOT NULL,
  status tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

