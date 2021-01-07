<?php

/*******************************************************
* AmCE - Admin miniChat Engine v0.2b for PHP-Nuke 5.5
* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
*  By: Wes Brewer (nd3@routerdesign.com)
*  http://www.routerdesign.com
*  Copyright © 2002 by Wes Brewer [nd3]
********************************************************/

// The message box where you type your chat message.
function messagebox($nick, $reload) {
	// Make sure a nick has been passed, otherwise deny access
	if (isset($nick) && $nick != "") {
		echo "<html><head><meta name=\"robots\" content=\"noindex\"><title>MessageBox</title></head>"
		."<body bgcolor=\"#990000\" text=\"#FFFFFF\" link=\"#FFFFFF\" alink=\"#FFFFFF\" vlink=\"#FFFFFF\">"
		."<font size=\"2\">"
		."<form name=\"chat\" method=\"post\" action=\"minichat.php?func=writemessage\">"
		."<center>"
		."<input type=\"hidden\" name=\"nick\" value=\"$nick\">"
		."<input type=\"hidden\" name=\"reload\" value=\"$reload\">"
		."Message:<br>"
		."<input type=\"text\" name=\"message\" size=\"10\"><br>"
		."<input type=\"hidden\" name=\"msgtype\" value=\"norm\">"
		."</center>"
		."</form>"
		."</font>"
		."</body></html>";
	} else { die ("Access Denied"); }
}


// Code to write out to the messages.html file (chatlog)
function writemessage($nick, $reload, $message, $msgtype) {
	// Setup Timestamps
	$timestamp = gmdate("H:i:s") . " GMT";

	// Read each line of chatlog into an array
	$message_array = file("messages.html");

	// Get just the last 9 chat messages from the array (not the header & footer)
	for ($counter = 1; $counter < 10; $counter++) {
		$old_messages .= $message_array[$counter];
	}

	// Setup the new message based on it's msgtype
	if ($msgtype == "enterchat") {
	$new_message = "<center><font color=\"#FFD700\">.-= ($timestamp) - <b>$nick</b> has entered chat. [refresh: $reload seconds] =-.</font></center><br>\n";
	} elseif ($msgtype == "exitchat") {
	$new_message = "<center><font color=\"#FFD700\">.-= ($timestamp) - <b>$nick</b> has left chat. =-.</font></center><br>\n";
	} elseif ($msgtype == "adminlogin") {
	$new_message = "<center><font color=\"#FFD700\">.-= ($timestamp) - <b>$nick</b> has logged in. =-.</font></center><br>\n";
	} elseif ($msgtype == "adminlogout") {
	$new_message = "<center><font color=\"#FFD700\">.-= ($timestamp) - <b>$nick</b> has logged out. =-.</font></center><br>\n";
	} elseif ($msgtype == "norm") {
	$message = htmlspecialchars($message);
	$new_message = "<font color=\"#DD0000\"><b>$nick:</b></font> $message<br>\n";
	}

	// Setup the header and footer for the chatlog
	$header = "<html><head><meta http-equiv=\"refresh\" content=\"$reload\"><meta name=\"robots\" content=\"noindex\"></head><body bgcolor=\"#000000\" text=\"#00FF00\">\n";
	$footer = "<hr><center><font size=\"2\" color=\"#FFFFFF\">[ AmCE - Admin miniChat Engine: v0.2b || &copy 2002 Wes Brewer || Refresh: $reload sec ]</font></center></body></html>";

	// Open chatlog, empty it, save the new message, save the last 9 old messages, close chatlog
	$open_file = fopen("messages.html", "w");
	fputs($open_file, $header);
	fputs($open_file, stripslashes($new_message));
	fputs($open_file, $old_messages);
	fputs($open_file, $footer);
	fclose($open_file);
	
	// Return to the messagebox function (if that's what called this function)
	if ($msgtype == "norm") {
	Header("Location: minichat.php?nick=$nick&reload=$reload");
	}
}


// Code to write out to the online.txt file (onlinelog)
function writeonline($nick, $ontype) {
	// Read each line of onlinelog into an array
	$online_array = file("online.txt");

	// Get each line of the online array, explode the seperator (,), drop duplicate nicks, dump into a new var
	foreach ($online_array as $user_on) {
		$fields = explode(",",$user_on);	

		// Drop duplicate nicks
		if ($fields[0] == "$nick"){
			break;
		}

		// Dump new online data into a new variable
			$updated .= $user_on;
	}

	// Add this users new online status to the new online variable
	$updated .= "$nick\,$ontype \n";
	$online = stripslashes($updated);

	// Open onlinelog, empty it, save the new online variable/data, close onlinelog
	$open_file = fopen("online.txt", w);
	fputs($open_file, $online);
	fclose($open_file);
}


// Code to enter minichat (via html frames) and notify that we are chat.
function enterchat($nick, $reload, $position) {
	// Code to setup chatbox position (top or bottom?)
	if ($position == "Top") {
		echo "<html><head><title>Site Admin with Mini Chat (Top)</title></head>"
		."<frameset rows=\"75, *\">"
			."<frameset cols=\"110, *\">"
				."<frame src=\"minichat.php?nick=$nick&amp;reload=$reload\" scrolling=\"no\">"
				."<frame src=\"messages.html\">"
			."</frameset>"
			."<frame src=\"../admin.php\">"
		."<noframes><body>Your browser doesn't support frames so you will be unable	to use the Mini Admin Chat."
		."<br><br>Continue to the <a href=\"../admin.php\">Admin Section</a></body></noframes>"
		."</frameset>"
		."</html>";

		// Update onlinelog to show we are in chat
		writeonline($nick, 2);
		
		// Update chatlog with enterchat message
		writemessage($nick, $reload, null, "enterchat");

	} elseif ($position == "Bottom") {
		echo "<html><head><title>Site Admin with Mini Chat (Bottom)</title></head>"
		."<frameset rows=\"*, 75\">"
			."<frame src=\"../admin.php\">"
			."<frameset cols=\"110, *\">"
				."<frame src=\"minichat.php?nick=$nick&amp;reload=$reload\" scrolling=\"no\">"
				."<frame src=\"messages.html\">"
			."</frameset>"
			."<noframes><body>Your browser doesn't support frames so you will be unable	to use the Mini Admin Chat."
		 	."<br><br>Continue to the <a href=\"../admin.php\">Admin Section</a></body></noframes>"
		."</frameset>"
		."</html>";

		// Update onlinelog to show we are in chat
		writeonline($nick, 2);
	
		// Update chatlog with enterchat message
		writemessage($nick, $reload, null, "enterchat");
	}
}


// Code to exit minichat (via breaking out of html frames) and notify that we have left chat
function exitchat($nick, $reload) {
	// Update onlinelog to show we have left chat
	writeonline($nick, 1);

	// Update chatlog with exitchat message
	writemessage($nick, $reload, null, "exitchat");
	
	// Exit minichat (frames) and load admin page
	breakframes("/admin.php");
}


// Code to notify that we are now online and logged in (admin style)
function adminlogin($nick) {
	// Update onlinelog to show we are now logged in
	writeonline($nick, 1);
	
	// Update chatlog with adminlogin message
	writemessage($nick, 15, null, "adminlogin");
	
	// Continue on to admin page
  Header("Location: /admin.php");
}


// Code to notify that we are now offline and logged out (admin style)
// and exit minichat (via breaking out of html frames) if nessasary.
function adminlogout($nick) {
	// Check if user is still in chat, if yes then use breakframes code
	// Read each line of onlinelog into an array
	$online_array = file("online.txt");
	// Get each line of the online array, explode the seperator (,), check if user is still in chat
	foreach ($online_array as $user_on) {
		$fields = explode(",",$user_on);	
		// check if in chat
		if ($fields[0] == "$nick" && $fields[1] == 2){
			$framed = 1;
		} else { $framed = 0; }
	}

	// Update onlinelog to show we are now logged out
	writeonline($nick, 0);
	
	// Update chatlog with adminlogout message
	writemessage($nick, 15, null, "adminlogout");

	if ($framed == 1) {
		// Exit minichat (frames) and load index page
		breakframes("/index.php");
	} else {
		// Just load the index page
	  Header("Location: /index.php");
	}
}


// Code to break out of html frames automaticlly and manually.
function breakframes($toppage) {
	// Exit frames and load proper page (Auto: JavaScript, Manual: Link)
	echo "<html><head><title></title>"
	."<script type=\"text/javascript\">"
	."top.location.href = \"$toppage\""
	."</script></head>"
	."<body><center><h4>Please Wait...</h4></center>"
	."<p>If you browser doesn't support JavaScript or you have it disabled it then. "
	."this page will not break out of the frameset automaticlly! "
	."To proceed you can break the frameset manually by clicking <a href=\"$toppage\" target=\"_top\">here</a>."
	."</body></html>";
}


// Switch function mode based on supplied func variable supplied in URL or HTML Form
switch($func) {

    default:
    messagebox($nick, $reload);
    break;
    
    case "writemessage":
    writemessage($nick, $reload, $message, $msgtype);
    break;
		
		case "writeonline";
		writemessage($nick, $ontype);
		break;

    case "enterchat":
    enterchat($nick, $reload, $position);
    break;

    case "exitchat":
    exitchat($nick, $reload);
    break;

    case "adminlogin":
    adminlogin($nick);
    break;

    case "adminlogout":
    adminlogout($nick);
    break;		
		
    case "breakframes":
    breakframes($toppage);
    break;
	
}

?>