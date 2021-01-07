<?php

$bgcolor1 = "#ffffff";
$bgcolor2 = "#cccccc";
$bgcolor3 = "#ffffff";
$bgcolor4 = "#eeeeee";
$textcolor1 = "#ffffff";
$textcolor2 = "#000000";

function OpenTable() {
    global $bgcolor1, $bgcolor2;
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"$bgcolor2\"><tr><td>\n";
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"8\" bgcolor=\"$bgcolor1\"><tr><td>\n";
}

function OpenTable2() {
    global $bgcolor1, $bgcolor2;
    echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"$bgcolor2\" align=\"center\"><tr><td>\n";
    echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"8\" bgcolor=\"$bgcolor1\"><tr><td>\n";
}

function CloseTable() {
    echo "</td></tr></table></td></tr></table>\n";
}

function CloseTable2() {
    echo "</td></tr></table></td></tr></table>\n";
}

function FormatStory($thetext, $notes, $aid, $informant) {
    global $anonymous;
    if ($notes != "") {
	$notes = "<b>"._NOTE."</b> <i>$notes</i>\n";
    } else {
	$notes = "";
    }
    if ("$aid" == "$informant") {
	echo "<font class=\"content\">$thetext<br>$notes</font>\n";
    } else {
	if($informant != "") {
	    $boxstuff = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;uname=$informant\">$informant</a> ";
	} else {
	    $boxstuff = "$anonymous ";
	}
	$boxstuff .= ""._WRITES." <i>\"$thetext\"</i> $notes\n";
	echo "<font class=\"content\">$boxstuff</font>\n";
    }
}

function themeheader() {
   global $user, $banners, $sitename, $slogan, $cookie, $prefix, $db;
   cookiedecode($user);
   $userid = $cookie[0];
   $username = $cookie[1];
   if ($username == "") { $username = "Anonymous"; }
   echo "<body bgcolor=\"ffffff\" text=\"000000\" link=\"0000ff\" vlink=\"0000ff\">";
   if ($banners == 1) { include("banners.php"); }

   if ($username == "Anonymous") {
      $theuser = "<a href=\"modules.php?name=Your_Account&op=new_user\">New User</a>";
      $loginout = "<a href=\"modules.php?name=Your_Account\">Login!</a>";
      $userbar = "Settings unavailable: you are not logged in!";
   } else {
      $sql = "select * from ".$prefix."_bbprivmsgs WHERE privmsgs_to_userid='$userid' AND (privmsgs_type='5' OR privmsgs_type='1')";
      $result = $db->sql_query($sql);
      $msgnum = sql_num_rows($result);

      $theuser = "Hello $username!";
      $loginout = "<a href=\"modules.php?name=Your_Account&op=logout\">Logout!</a>";
      if ($userid == "2") {
         $userbar = "<a href=\"modules.php?name=Private_Messages\">$msgnum New Messages</a>&nbsp;&middot;&nbsp;<a href=\"modules.php?name=Forums&file=profile&mode=editprofile\">Forum Profile</a>&nbsp;&middot;&nbsp;<a href=\"modules.php?name=Your_Account\">Account Settings</a>&nbsp;&middot;&nbsp;<a href=\"admin.php\">Admin</a>";
      } else {
         $userbar = "<a href=\"modules.php?name=Private_Messages\">$msgnum New Messages</a>&nbsp;&middot;&nbsp;<a href=\"modules.php?name=Forums&file=profile&mode=editprofile\">Forum Profile</a>&nbsp;&middot;&nbsp;<a href=\"modules.php?name=Your_Account\">Account Settings</a>";
      }
   }
   
   $datetime = gmdate("M d | H:i:s") . " GMT";

   $public_msg = public_message();
   echo "<center><img src=\"themes/ExtraLite-RDP/images/rdptitle.gif\" width=\"491\" height=\"75\" alt=\"Router Design Project\"></center>"
       ."<table border=\"0\" cellspacing=\"1\" cellpadding=\"0\" width=\"95%\" bgcolor=\"000000\" align=\"center\"><tr><td>"
       ."<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\" bgcolor=\"FFFFFF\">"
       ."<tr><td class=\"topbar\" width=\"25%\" nowrap>$theuser &nbsp;&middot;&nbsp; $loginout</td>"
       ."<td class=\"topbar\" width=\"50%\" align=\"center\">$userbar</td>"
       ."<td class=\"topbar\" width=\"25%\" nowrap align=\"right\">$datetime</td></tr></table></td></tr></table>$public_msg"
       ."<br><table border=\"0\" cellspacing=\"0\" cellpadding=\"2\" width=\"100%\"><tr><td valign=\"top\" width=\"150\" bgcolor=\"ffffff\">";
   blocks(left);
   echo "<img src=\"images/pix.gif\" border=\"0\" width=\"150\" height=\"1\"></td><td>&nbsp;&nbsp;</td><td width=\"100%\" valign=\"top\">";
}

function themefooter() {
    global $index;
    if ($index == 1) {
	echo "</td><td>&nbsp;&nbsp;</td><td valign=\"top\" bgcolor=\"#ffffff\">";
	blocks(right);
	echo "</td>";
    }
    echo "</td></tr></table></td></tr></table>";
    footmsg();
}

function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
    global $anonymous;
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" bgcolor=\"000000\" width=\"100%\"><tr><td>"
        ."<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" width=\"100%\"><tr><td bgcolor=\"ffffff\">"
        ."<b>$title</b><br>"
        ."<font class=\"tiny\">"
        .""._POSTEDBY." <b>";
    formatAidHeader($aid);
    echo "</b> "._ON." $time $timezone ($counter "._READS.")<br>"
	."</font></td></tr><tr><td bgcolor=\"ffffff\">";
    FormatStory($thetext, $notes, $aid, $informant);
    echo "<br><br>"
        ."</td></tr><tr><td bgcolor=\"ffffff\" align=\"right\">"
        ."<font class=\"content\">$morelink</font>"
        ."</td></tr></table></td></tr></table>"
	."<br>";
}

function themerouters ($rid, $rname, $rauthorname, $rauthoremail, $rsitename, $rsiteurl, $rtime, $rcost, $rsoft, $rcpu, $rram, $rif1, $rif2, $rif3, $rhub, $rdrives, $rnote, $vote_total, $vote_avg, $mainpic, $morepicslink, $detailslink, $voteslink) {
   global $anonymous, $tipath;
   echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"1\" width=\"100%\" bgcolor=\"000000\"><tr><td>"
       ."<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\" bgcolor=\"FFFFFF\"><tr>"
       ."<td>$rname</td></tr><tr><td>"
       ."<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">"
       ."<tr><td colspan=\"2\" align=\"center\"><h3>$rname</h3></td></tr>"
       ."<tr><td width=\"40%\" align=\"center\" valign=\"middle\">$mainpic<br><br>"
       ."<b>Average Rating:</b> $vote_avg<br><b>Total Votes:</b> $vote_total<br><br></td>"
       ."<td width=\"60%\">"
       ."<b>Built By:</b> <a href=\"mailto:$rauthoremail?Subject=Router @ RDP\">$rauthorname</a><br>"
       ."<b>Website:</b> <a href=\"$rsiteurl\" target=\"_blank\">$rsitename</a><br>"
       ."<b>Build Time:</b> $rtime<br><b>Total Cost:</b> $rcost<br><br>"
       ."<b>Router Software:</b> $rsoft<br><b>CPU:</b> $rcpu<br>"
       ."<b>RAM:</b> $rram<br><b>Interface 1:</b> $rif1<br>"
       ."<b>Interface 2:</b> $rif2<br><b>Interface 3:</b> $rif3<br>"
       ."<b>Hub/Switch:</b> $rhub<br><b>Drives:</b> $rdrives"
       ."</td></tr><tr><td colspan=\"2\"><b>Notes:</b> $rnote<br></td></tr>"
       ."<tr><td colspan=\"2\" align=\"center\"><b>Router ID:</b> $rid <strong><big>·</big></strong> $morepicslink <strong><big>·</big></strong> $detailslink <strong><big>·</big></strong> $voteslink</td></tr>"
       ."</table></td></tr></table></td></tr></table><br>";
}

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext) {
    global $admin, $sid;
    if ("$aid" == "$informant") {
	echo"
	<table border=0 cellpadding=0 cellspacing=0 align=center bgcolor=000000 width=100%><tr><td>
	<table border=0 cellpadding=3 cellspacing=1 width=100%><tr><td bgcolor=FFFFFF>
	<b>$title</b><br><font class=tiny>".translate("Posted on ")." $datetime";
	if ($admin) {
	    echo "&nbsp;&nbsp; $font2 [ <a href=admin.php?op=EditStory&sid=$sid>".translate("Edit")."</a> | <a href=admin.php?op=RemoveStory&sid=$sid>".translate("Delete")."</a> ]";
	}
	echo "
	<br>".translate("Topic").": <a href=modules.php?name=Search&amp;query=&topic=$topic&author=>$topictext</a>
	</td></tr><tr><td bgcolor=ffffff>
	$thetext
	</td></tr></table></td></tr></table><br>";
    } else {
	if($informant != "") $informant = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&uname=$informant\">$informant</a> ";
	else $boxstuff = "$anonymous ";
	$boxstuff .= "".translate("writes")." <i>\"$thetext\"</i> $notes";
	echo "
	<table border=0 cellpadding=0 cellspacing=0 align=center bgcolor=000000 width=100%><tr><td>
	<table border=0 cellpadding=3 cellspacing=1 width=100%><tr><td bgcolor=FFFFFF>
	<b>$title</b><br><font class=content>".translate("Contributed by ")." $informant ".translate("on")." $datetime</font>";
	if ($admin) {
	    echo "&nbsp;&nbsp; $font2 [ <a href=admin.php?op=EditStory&sid=$sid>".translate("Edit")."</a> | <a href=admin.php?op=RemoveStory&sid=$sid>".translate("Delete")."</a> ]";
	}
	echo "
	<br>".translate("Topic").": <a href=modules.php?name=Search&amp;query=&topic=$topic&author=>$topictext</a>
	</td></tr><tr><td bgcolor=ffffff>
	$thetext
	</td></tr></table></td></tr></table><br>";
    }
}

function themesidebox($title, $content) {
   echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"150\" bgcolor=\"000000\"><tr><td>"
       ."<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\"><tr><td bgcolor=\"ffffff\" align=\"center\">"
       ."<font class=\"content\"><b>$title</b></font></td></tr><tr><td bgcolor=\"ffffff\"><font class=\"content\">"
       ."$content"
       ."</font></td></tr></table></td></tr></table><br>";
}

?>