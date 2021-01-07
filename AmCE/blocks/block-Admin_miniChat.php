<?php

/*******************************************************
* AmCE - Admin miniChat Engine v0.2b for PHP-Nuke 5.5
* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
*  By: Wes Brewer (nd3@routerdesign.com)
*  http://www.routerdesign.com
*  Copyright © 2002 by Wes Brewer [nd3]
********************************************************/

if (eregi("block-Admin_miniChat.php",$PHP_SELF)) {
    Header("Location: index.php");
    die();
}

// Load global variables
global $prefix, $dbi, $admin, $aid;

// Get admin name and use it for chat nick
if (isset($aid) && $aid != "") {
	// use $aid if already set & decoded elsewhere (admin web pages)
	$nick = $aid;
} else {
	// otherwise decode $admin to get $aid (regular web pages)
  $admin = base64_decode($admin);
  $admin = explode(":", $admin);
  $nick = "$admin[0]";
}

// Check if this user is in chat or not
// Read each line of onlinelog into an array
$online_array = file("minichat/online.txt");
// Get each line of the online array, explode the seperator (,), check if this user is in chat
foreach ($online_array as $user_on) {
	$fields = explode(",",$user_on);	
	if ($fields[0] == "$nick" and $fields[1] == 2) {
		$chat = 1;
	} else { $chat = 0;	}
}

// Who is online title
$content = "<u>Who&acute;s Online?</u><br>";

// Read each line of onlinelog into an array
$online_array = file("minichat/online.txt");
// Get each line of the online array, explode the seperator (,), and display user status (see legend)
foreach ($online_array as $user_on) {
	$fields = explode(",",$user_on);	
	if ($fields[1] == 2) {
		// Blue for users in chat
		$content .= "<font class=\"tiny\" color=\"#0000CC\"><b>$fields[0]</b></font><br>";
	} elseif ($fields[1] == 1) {
		// Green for users logged in
		$content .= "<font class=\"tiny\" color=\"#006600\"><b>$fields[0]</b></font><br>";
	} elseif ($fields[1] == 0) {
		// Red for users logged off and not online
		$content .= "<font class=\"tiny\" color=\"#CC0000\"><b>$fields[0]</b></font><br>";
	}
}

// Status Legend Key
$content .= "<br><u>Legend (status)</u><br>";
$content .= "<font class=\"tiny\" color=\"#0000CC\"><b>[X]</b></font> = In miniChat<br>";
$content .= "<font class=\"tiny\" color=\"#006600\"><b>[X]</b></font> = Online<br>";
$content .= "<font class=\"tiny\" color=\"#CC0000\"><b>[X]</b></font> = Offline<br>";


if ($chat == 1) {
	// Display this if user is in chat
	$content .= "<hr>";
	$content .= "<center>";
	$content .= "<form name=\"minichat\" method=\"post\" action=\"/minichat/minichat.php\">";
	$content .= "<input type=\"hidden\" name=\"nick\" value=\"$nick\">";
	$content .= "<input type=\"hidden\" name=\"reload\" value=\"15\">";
	$content .= "<input type=\"hidden\" name=\"func\" value=\"exitchat\">";
	$content .= "<input type=\"submit\" value=\"Exit Chat\">";
	$content .= "</form>";
	$content .= "</center>";
} else {
	// Display this if user is in not in chat
	$content .= "<hr>";
	$content .= "<center>";
	$content .= "<form name=\"minichat\" method=\"post\" action=\"/minichat/minichat.php\">";
	$content .= "Chatbox Position:<br>";
	$content .= "<select name=\"position\">";
	$content .= " <option value=\"Top\" selected>Top";
	$content .= " <option value=\"Bottom\">Bottom";
	$content .= "</select><br>";
	$content .= "Refresh Interval:<br>";
	$content .= "<select name=\"reload\">";
	$content .= " <option value=\"15\" selected>15 sec";
	$content .= " <option value=\"20\">20 sec";
	$content .= " <option value=\"30\">30 sec";
	$content .= " <option value=\"40\">40 sec";
	$content .= " <option value=\"50\">50 sec";
	$content .= " <option value=\"60\">1 min";
	$content .= " <option value=\"90\">1.5 min";
	$content .= "</select><br>";
	$content .= "<input type=\"hidden\" name=\"nick\" value=\"$nick\">";
	$content .= "<input type=\"hidden\" name=\"func\" value=\"enterchat\">";
	$content .= "<input type=\"submit\" value=\"Enter Chat\">";
	$content .= "</form>";
	$content .= "</center>";
}

// Version info
$content .= "<font class=\"tiny\">AmCE v0.2b [nd3]</font>";

?>