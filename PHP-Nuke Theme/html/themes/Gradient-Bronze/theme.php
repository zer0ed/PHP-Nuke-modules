<?php

/* Function for testing browser, called below */
function inAgent($agent) {
   global $HTTP_USER_AGENT;
   $notAgent = strpos($HTTP_USER_AGENT,$agent) === false;
   return !$notAgent;
}

$bgcolor1 = "#CCCCCC";
$bgcolor2 = "#CCCCCC";
$bgcolor3 = "#CCCCCC";
$bgcolor4 = "#CCCCCC";
$textcolor1 = "#000000";
$textcolor2 = "#000000";
include("themes/Gradient-Bronze/tables.php");

/* Function themeheader() */
function themeheader() {
   global $user, $banners, $sitename, $slogan, $cookie, $prefix, $dbi;
   cookiedecode($user);
   $userid = $cookie[0];
   $username = $cookie[1];
   if ($username == "") { $username = "Anonymous"; }
   echo "<body bgcolor=\"#CCCCCC\" text=\"#000000\" link=\"#0000CC\" vlink=\"#0000CC\" alink=\"#0000CC\">";
   if ($banners == 1) { include("banners.php"); }

   if ($username == "Anonymous") {
      $theuser = "<a href=\"modules.php?name=Your_Account&op=new_user\">New User</a>";
      $loginout = "<a href=\"modules.php?name=Your_Account\">Login!</a>";
      $userbar = "Settings unavailable: you are not logged in!";
   } else {
      $result = sql_query("select * from ".$prefix."_privmsgs where privmsgs_type='1' && privmsgs_to_userid='$userid'", $dbi);
      $msgnum = sql_num_rows($result, $dbi);

      $theuser = "Hello $username!";
      $loginout = "<a href=\"modules.php?name=Your_Account&op=logout\">Logout!</a>";
      if ($userid == "2") {
         $userbar = "<a href=\"modules.php?name=Forums&file=privmsg&folder=inbox\">$msgnum New Messages</a>&nbsp;&middot;&nbsp;<a href=\"modules.php?name=Forums&file=profile&mode=editprofile\">Forum Profile</a>&nbsp;&middot;&nbsp;<a href=\"modules.php?name=Your_Account\">Account Settings</a>&nbsp;&middot;&nbsp;<a href=\"admin.php\">Admin</a>";
      } else {
         $userbar = "<a href=\"modules.php?name=Forums&file=privmsg&folder=inbox\">$msgnum New Messages</a>&nbsp;&middot;&nbsp;<a href=\"modules.php?name=Forums&file=profile&mode=editprofile\">Forum Profile</a>&nbsp;&middot;&nbsp;<a href=\"modules.php?name=Your_Account\">Account Settings</a>";
      }
   }
   
   $datetime = gmdate("M d | H:i:s") . " GMT";

   // Check for Netscape 4, if yes use different template.    
   if ( inAgent('MSIE') or inAgent('Opera') ) {
      $tmpl_file = "themes/Gradient-Bronze/header.html";
   } elseif ( inAgent('Mozilla/4') ) {
      $tmpl_file = "themes/Gradient-Bronze/ns4_header.html";
   } else {
      $tmpl_file = "themes/Gradient-Bronze/header.html";
   }

   $thefile = implode("", file($tmpl_file));
   $thefile = addslashes($thefile);
   $thefile = "\$r_file=\"".$thefile."\";";
   eval($thefile);
   print $r_file;
   blocks(left);
   $tmpl_file = "themes/Gradient-Bronze/left_center.html";
   $thefile = implode("", file($tmpl_file));
   $thefile = addslashes($thefile);
   $thefile = "\$r_file=\"".$thefile."\";";
   eval($thefile);
   print $r_file;
}

/* Function themefooter()  */
function themefooter() {
   global $index, $foot1, $foot2, $foot3, $foot4;
   if ($index == 1) {
      $tmpl_file = "themes/Gradient-Bronze/center_right.html";
      $thefile = implode("", file($tmpl_file));
      $thefile = addslashes($thefile);
      $thefile = "\$r_file=\"".$thefile."\";";
      eval($thefile);
      print $r_file;
      blocks(right);
   }
   
   $footer_message = "$foot1<br>$foot2<br>$foot3<br>$foot4";
   $tmpl_file = "themes/Gradient-Bronze/footer.html";
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

   $tmpl_file = "themes/Gradient-Bronze/story_home.html";
   $thefile = implode("", file($tmpl_file));
   $thefile = addslashes($thefile);
   $thefile = "\$r_file=\"".$thefile."\";";
   eval($thefile);
   print $r_file;
}

/* Function themerouters()  */
function themerouters ($rid, $rname, $rauthorname, $rauthoremail, $rsitename, $rsiteurl, $rtime, $rcost, $rsoft, $rcpu, $rram, $rif1, $rif2, $rif3, $rhub, $rdrives, $rnote, $vote_total, $vote_avg, $mainpic, $morepicslink, $detailslink, $voteslink) {
   global $anonymous, $tipath;

   $tmpl_file = "themes/Gradient-Bronze/routers.html";
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

   $tmpl_file = "themes/Gradient-Bronze/story_page.html";
   $thefile = implode("", file($tmpl_file));
   $thefile = addslashes($thefile);
   $thefile = "\$r_file=\"".$thefile."\";";
   eval($thefile);
   print $r_file;
}

/* Function themesidebox()  */
function themesidebox($title, $content) {
   $tmpl_file = "themes/Gradient-Bronze/blocks.html";
   $thefile = implode("", file($tmpl_file));
   $thefile = addslashes($thefile);
   $thefile = "\$r_file=\"".$thefile."\";";
   eval($thefile);
   print $r_file;
}

?>