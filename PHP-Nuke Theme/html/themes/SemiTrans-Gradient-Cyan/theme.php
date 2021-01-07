<?php

$bgcolor1 = "#EEEEEE";
$bgcolor2 = "#EEEEEE";
$bgcolor3 = "#EEEEEE";
$bgcolor4 = "#EEEEEE";
$textcolor1 = "#000000";
$textcolor2 = "#000000";
include("themes/SemiTrans-Gradient-Cyan/tables.php");

/* Function themeheader() */
function themeheader() {
   global $user, $banners, $sitename, $slogan, $cookie, $prefix, $db;
   cookiedecode($user);
   $userid = $cookie[0];
   $username = $cookie[1];
   if ($username == "") { $username = "Anonymous"; }
   echo "<body bgcolor=\"#CCCCCC\" text=\"#000000\" link=\"#0000CC\" vlink=\"#0000CC\" alink=\"#0000CC\">";
   if ($banners == 1) { include("banners.php"); }

   if ($username == "Anonymous") {
      $theuser = "<a href=\"modules.php?name=Your_Account&amp;op=new_user\">New User</a>";
      $loginout = "<a href=\"modules.php?name=Your_Account\">Login!</a>";
      $userbar = "Settings unavailable: you are not logged in!";
   } else {
      $sql = "select * from ".$prefix."_bbprivmsgs WHERE privmsgs_to_userid='$userid' AND (privmsgs_type='5' OR privmsgs_type='1')";
      $result = $db->sql_query($sql);
      $msgnum = sql_num_rows($result);

      $theuser = "Hello $username!";
      $loginout = "<a href=\"modules.php?name=Your_Account&amp;op=logout\">Logout!</a>";
      if ($userid == "2") {
         $userbar = "<a href=\"modules.php?name=Private_Messages\">$msgnum New Messages</a>&nbsp;&middot;&nbsp;<a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=editprofile\">Forum Profile</a>&nbsp;&middot;&nbsp;<a href=\"modules.php?name=Your_Account\">Account Settings</a>&nbsp;&middot;&nbsp;<a href=\"admin.php\">Admin</a>";
      } else {
         $userbar = "<a href=\"modules.php?name=Private_Messages\">$msgnum New Messages</a>&nbsp;&middot;&nbsp;<a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=editprofile\">Forum Profile</a>&nbsp;&middot;&nbsp;<a href=\"modules.php?name=Your_Account\">Account Settings</a>";
      }
      // create sound if new messages
      if ($msgnum > "0") {
         $msgsound = "\n\n<bgsound src=\"themes/SemiTrans-Gradient-Cyan/sounds/newmsg.wav\">";
      } else {
         $msgsound = "";
      }
   }
   
   // Use LiveClock Javascript, otherwise grab date using php (static clock)
   $statictime = gmdate(" H:i:s") . " GMT";
   $datetime = gmdate("M d y | ");
   $datetime .= "<script language=\"javascript\"><!--
   new LiveClock();
   //--></script>";
   $datetime .= "<NOSCRIPT> $statictime </NOSCRIPT>";
   
   $tmpl_file = "themes/SemiTrans-Gradient-Cyan/header.html";

   $public_msg = public_message();
   $thefile = implode("", file($tmpl_file));
   $thefile = addslashes($thefile);
   $thefile = "\$r_file=\"".$thefile."\";";
   eval($thefile);
   print $r_file;
   blocks(left);
   $tmpl_file = "themes/SemiTrans-Gradient-Cyan/left_center.html";
   $thefile = implode("", file($tmpl_file));
   $thefile = addslashes($thefile);
   $thefile = "\$r_file=\"".$thefile."\";";
   eval($thefile);
   print $r_file;
}

/* Function themefooter()  */
function themefooter() {
   global $index, $foot1, $foot2, $foot3, $total_time, $start_time;
    // Calculate Page Load Time
    $mtime = microtime();
    $mtime = explode(" ",$mtime);
    $mtime = $mtime[1] + $mtime[0];
    $end_time = $mtime;
    $total_time = ($end_time - $start_time);
    $total_time = ""._PAGEGENERATION." ".substr($total_time,0,5)." "._SECONDS."";

   if ($index == 1) {
      $tmpl_file = "themes/SemiTrans-Gradient-Cyan/center_right.html";
      $thefile = implode("", file($tmpl_file));
      $thefile = addslashes($thefile);
      $thefile = "\$r_file=\"".$thefile."\";";
      eval($thefile);
      print $r_file;
      blocks(right);
   }
   
   $footer_message = "$foot1<br>$foot2<br>$foot3";
   $tmpl_file = "themes/SemiTrans-Gradient-Cyan/footer.html";
   $thefile = implode("", file($tmpl_file));
   $thefile = addslashes($thefile);
   $thefile = "\$r_file=\"".$thefile."\";";
   eval($thefile);
   print $r_file;
}

/* Function themeindex()  */
function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
   global $anonymous, $tipath;
   if ($notes != "") {
      $notes = "<br><br><b>"._NOTE."</b> <i>$notes</i>\n";
   } else {
      $notes = "";
   }
    
   if ("$aid" == "$informant") {
      $content = "$thetext$notes\n";
   } else {
      if($informant != "") {
         $content = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;uname=$informant\">$informant</a> ";
      } else {
         $content = "$anonymous ";
      }
      $content .= ""._WRITES." <i>\"$thetext\"</i>$notes\n";
   }

   $posted = ""._POSTEDBY." ";
   $posted .= get_author($aid);
   $posted .= " "._ON." $time $timezone ($counter "._READS.")";

   $tmpl_file = "themes/SemiTrans-Gradient-Cyan/story_home.html";
   $thefile = implode("", file($tmpl_file));
   $thefile = addslashes($thefile);
   $thefile = "\$r_file=\"".$thefile."\";";
   eval($thefile);
   print $r_file;
}

/* Function themerouters()  */
function themerouters ($rid, $rname, $rauthorname, $rauthoremail, $rsitename, $rsiteurl, $rtime, $rcost, $rsoft, $rcpu, $rram, $rif1, $rif2, $rif3, $rhub, $rdrives, $rnote, $vote_total, $vote_avg, $mainpic, $morepicslink, $detailslink, $voteslink) {
   global $anonymous, $tipath;

   $tmpl_file = "themes/SemiTrans-Gradient-Cyan/routers.html";
   $thefile = implode("", file($tmpl_file));
   $thefile = addslashes($thefile);
   $thefile = "\$r_file=\"".$thefile."\";";
   eval($thefile);
   print $r_file;
}

/* Function themearticle()  */
function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext) {
   global $admin, $sid, $tipath;
   $posted = ""._POSTEDON." $datetime "._BY." ";
   $posted .= get_author($aid);
   
   if ($notes != "") {
      $notes = "<br><br><b>"._NOTE."</b> <i>$notes</i>\n";
   } else {
      $notes = "";
   }

   if ("$aid" == "$informant") {
      $content = "$thetext$notes\n";
   } else {
      if($informant != "") {
         $content = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;uname=$informant\">$informant</a> ";
      } else {
         $content = "$anonymous ";
      }
      $content .= ""._WRITES." <i>\"$thetext\"</i>$notes\n";
   }

   $tmpl_file = "themes/SemiTrans-Gradient-Cyan/story_page.html";
   $thefile = implode("", file($tmpl_file));
   $thefile = addslashes($thefile);
   $thefile = "\$r_file=\"".$thefile."\";";
   eval($thefile);
   print $r_file;
}

/* Function themesidebox()  */
function themesidebox($title, $content) {
   $tmpl_file = "themes/SemiTrans-Gradient-Cyan/blocks.html";
   $thefile = implode("", file($tmpl_file));
   $thefile = addslashes($thefile);
   $thefile = "\$r_file=\"".$thefile."\";";
   eval($thefile);
   print $r_file;
}

?>