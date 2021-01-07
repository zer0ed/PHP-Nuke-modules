<?php

/*******************************************************
* AmCE - Admin miniChat Engine v1.0 for PHP-Nuke 6.9
* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
*  By: Wes Brewer (nd3@routerdesign.com)
*  http://www.routerdesign.com
*  Copyright © 2002-2005 by Wes Brewer [nd3]
********************************************************/

// ***********************[ User Settings ]********************************

// Security Key (up to 15 chars)
$chatkey = "123456789012345";

// In chat flashing picture (0 - off, 1 - on)
$inchatpic = 1;

// Connect Mode Settings
//   0 - Manual Connect, users can only connect to chat manually.
//   1 - Auto Connect, connect to chat if another user is in chat [recommended].
//   2 - Forced Connect, always connect all users to chat.
$connectmode = 1;

// Default chat window postition (Top, Bottom)
$defposition = "Top";

// Default chat window refresh (in seconds)
$defrefresh = "10";

// ***********************[ User Settings End ]****************************

// If file was called by itself then deny access (security check)
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

// Who is online title
$content = "<u>Who&acute;s Online?</u><br>";

// Read each line of onlinelog into an array
$online_array = file("minichat/online.txt");
// Get each line of the online array, explode the seperator (,), and display user status (see legend)
foreach ($online_array as $user_on) {
	$fields = explode(",",$user_on);	
	if ($fields[1] == 2) {
		// Blue for users in chat (with flashing message picture if option set)
		$content .= "<font class=\"tiny\" color=\"#0000CC\"><b>$fields[0]</b></font>";
		if ($inchatpic == 1) {	$content .= " <img src=\"minichat/in_chat.gif\" width=\"16\" height=\"15\" alt=\"\">"; }
		$content .= "<br>";
	} elseif ($fields[1] == 1) {
		// Green for users logged in
		$content .= "<font class=\"tiny\" color=\"#006600\"><b>$fields[0]</b></font><br>";
	} elseif ($fields[1] == 0) {
		// Red for users logged off and not online
		$content .= "<font class=\"tiny\" color=\"#CC0000\"><b>$fields[0]</b></font><br>";
	}
}

// Check if this user is in chat or not
// Read each line of onlinelog into an array
$online_array = file("minichat/online.txt");
// Get each line of the online array, explode the seperator (,)
foreach ($online_array as $user_on) {
	$fields = explode(",",$user_on);	
	// check if this user is in chat
	if ($fields[0] == "$nick" and $fields[1] == 2) {
		$inchat = 1;
	}

	// Auto Connect Code
	if ($connectmode == 1) {
		// check if other users are in chat
		if ($fields[0] != "$nick" and $fields[1] == 2) {
			$othersinchat = 1;
		}
	}
}

// Status Legend Key
$content .= "<br><u>Legend (status)</u><br>";
$content .= "<font class=\"tiny\" color=\"#0000CC\"><b>[X]</b></font> = In miniChat<br>";
$content .= "<font class=\"tiny\" color=\"#006600\"><b>[X]</b></font> = Online<br>";
$content .= "<font class=\"tiny\" color=\"#CC0000\"><b>[X]</b></font> = Offline<br>";

if ($inchat == 1 && $connectmode == 2) {
	// Display this if user is in chat and Forced Connect mode enabled (user not allowed to exit manually)
	$content .= "<hr>";
	$content .= "<center>";
	$content .= "<b>Forced Connect<br>";
	$content .= "Mode</b>";
	$content .= "</center>";
} elseif ($inchat == 1 && $othersinchat == 1) {
	// Display this if user is in chat and was autoconnected (user not allowed to exit manually)
	$content .= "<hr>";
	$content .= "<center>";
	$content .= "<b>Auto Connect<br>";
	$content .= "Mode</b>";
	$content .= "</center>";
} elseif ($inchat == 1) {
	// Display this if user is in chat with no special connect modes
	$content .= "<hr>";
	$content .= "<center>";
	$content .= "<form name=\"minichat\" method=\"post\" action=\"/minichat/minichat.php\">";
	$content .= "<input type=\"hidden\" name=\"nick\" value=\"$nick\">";
	$content .= "<input type=\"hidden\" name=\"reload\" value=\"10\">";
	$content .= "<input type=\"hidden\" name=\"func\" value=\"exitchat\">";
	$content .= "<input type=\"submit\" value=\"Exit Chat\">";
	$content .= "</form>";
	$content .= "</center>";
} elseif ($connectmode == 2) {
	// Forced Connect to chat if option enabled
	Header("Location: /minichat/minichat.php?func=enterchat&nick=$nick&reload=$defrefresh&position=$defposition&chatkey=$chatkey");
} elseif ($othersinchat == 1) {
	// Auto Connect to chat if option enabled and other users are in chat
	Header("Location: /minichat/minichat.php?func=enterchat&nick=$nick&reload=$defrefresh&position=$defposition&chatkey=$chatkey");
} else {
	// Display this if user is in not in chat with no special connect modes
	$content .= "<hr>";
	$content .= "<center>";
	$content .= "<form name=\"minichat\" method=\"post\" action=\"/minichat/minichat.php\">";
	$content .= "Chatbox Position:<br>";
	$content .= "<select name=\"position\">";
	// select based on default position set in user settings
	if ($defposition == "Top") {
		$content .= " <option value=\"Top\" selected>Top";
		$content .= " <option value=\"Bottom\">Bottom";
	} else {
		$content .= " <option value=\"Top\">Top";
		$content .= " <option value=\"Bottom\" selected>Bottom";
	}
	$content .= "</select><br><br>";
	$content .= "<input type=\"hidden\" name=\"nick\" value=\"$nick\">";
	$content .= "<input type=\"hidden\" name=\"chatkey\" value=\"$chatkey\">";
	$content .= "<input type=\"hidden\" name=\"reload\" value=\"$defrefresh\">";
	$content .= "<input type=\"hidden\" name=\"func\" value=\"enterchat\">";
	$content .= "<input type=\"submit\" value=\"Enter Chat\">";
	$content .= "</form>";
	$content .= "</center>";
}

$content .= "<hr>";

// Version info
$content .= "<div align=\"right\"><font class=\"tiny\">AmCE v1.0 [nd3]</font></div>";

?>
