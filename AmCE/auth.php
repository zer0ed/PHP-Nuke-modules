<?php

/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

/***********************************************
* Modified and added code                      *
* ~~~~~~~~~~~~~~~~~~~~~~~                      *
* Lines: (39-41)                               *
*                                              *
* - AmCE Admin miniChat Engine v0.2b           *
************************************************/

require_once("mainfile.php");

if (eregi("auth.php",$PHP_SELF)) {
    Header("Location: index.php");
    die();
}

if ((isset($aid)) && (isset($pwd)) && ($op == "login")) {
    if($aid!="" AND $pwd!="") {
	$pwd = md5($pwd);
	$result=sql_query("select pwd, admlanguage from ".$prefix."_authors where aid='$aid'", $dbi);
	list($pass, $admlanguage)=sql_fetch_row($result, $dbi);
	if($pass == $pwd) {
	    $admin = base64_encode("$aid:$pwd:$admlanguage");
	    setcookie("admin","$admin",time()+2592000);
	    unset($op);
			//*************************** nd3's moded code Admin miniChat ***********************
			Header("Location: /minichat/minichat.php?func=adminlogin&nick=$aid");
			//***********************************************************************************
	}
    }
}

$admintest = 0;

if(isset($admin) && $admin != "") {
  $admin = base64_decode($admin);
  $admin = explode(":", $admin);
  $aid = "$admin[0]";
  $pwd = "$admin[1]";
  $admlanguage = "$admin[2]";
  if ($aid=="" || $pwd=="") {
    $admintest=0;
    echo "<html>\n";
    echo "<title>INTRUDER ALERT!!!</title>\n";
    echo "<body bgcolor=\"#FFFFFF\" text=\"#000000\">\n\n<br><br><br>\n\n";
    echo "<center><img src=\"images/eyes.gif\" border=\"0\"><br><br>\n";
    echo "<font face=\"Verdana\" size=\"+4\"><b>Get Out!</b></font></center>\n";
    echo "</body>\n";
    echo "</html>\n";
    exit;
  }
  $result=sql_query("select pwd from ".$prefix."_authors where aid='$aid'", $dbi);
  if(!$result) {
        echo "Selection from database failed!";
        exit;
  } else {
    list($pass)=sql_fetch_row($result, $dbi);
    if($pass == $pwd && $pass != "") {
        $admintest = 1;
    }
  }
}
?>