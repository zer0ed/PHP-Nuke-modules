/*******************************************************
* AmCE - Admin miniChat Engine v1.2 for PHP-Nuke 7.6
* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
*  By: Wes Brewer (nd3@routerdesign.com)
*  http://www.routerdesign.com
*  Copyright © 2002-2005 by Wes Brewer [nd3]
********************************************************/

0. Copyright Notice
-------------------
- Our Package name and link MUST REMAIN in the credit footer of all generated pages.
  Translations are permitted but not renaming.
- This package CAN NOT be ported without written permission.
- This package CAN NOT be mirrored without written permission.
- Use of this package requires that credits to the original PHPNuke remain in all
  site generated pages.
- Currently there is only 1 project license granted at this time. The PHP-Nuke Project
  is the only project allowed to duplicate our scripts.


1. Introduction and Requirements
--------------------------------
AmCE - Admin miniChat Engine is a small html based chat room for admins or selected users
at a PHP-Nuke driven website.  It requires PHP-Nuke 7.x to be installed and working
properly.  AmCE now supports 2 engine modes, one for use with PHPNuke site admins only
(admin mode) and one for selected users only (usermode).  Admin mode has more connection
options but only people logged in as admins may use it!  User mode forces connection to
chat when an authorized user logs in and forces disconnection when he/she logs out.

Currently you need register_globals set to ON in your php.ini file
for your webserver.  This will be changed in a later release!
The browser that uses the chat engine need to support frames!  If
frames support is not available or off the user will be notified
that chat will not load.  When exiting chat some javascript is used
to break out of the frames automatically.  If the browser doesn't
support javascript or it is off then the user will have a link to
break out of frames manually!

AmCE is very light weight and non-cpu intensive on either the server
or the client.  It doesn't use a database, just files and it's not realtime
but close enough.. it uses user set HTML META refreshes (time set by admin)!

The Engine itself is 1 file minichat.php with many functions. Since AmCE is very
light, it has minimal security using a keycode set by the admin!!  
The files online.txt (onlinelog) and auth.txt have no security at all!!

You should also setup a robots file and deny search engines from webcrawling
that directory as explained below.

To Install follow the steps for the mode you wish to use.  Do not use both modes
on the same website.  This is untested and not recommended as it will surely cause
problems!


2. Installation
---------------
Extract archive to temp dir and copy included as noted below(and chmod if shown):
---------------------------------------------------------------------------------
readme.txt (do not upload)
blocks/*.* ------------------------------> blocks/*.*     (if using adminmode, not needed for usermode)
minichat/*.* ----------------------------> minichat/*.*


3. Install (Admin Mode)
-----------------------
* Set the chatkey value to a random 15 character code (replace 123456789012345) in
   the following files..  minichat/chatlog.php (1st line), blocks/block-Admin_miniChat.php
	 (line 14 under user settings section), and minichat/minichat.php (line 13).  All
	 3 files must have the same value to work correctly.

* Set the other options you wish in the blocks/block-Admin_miniChat.php file at the top under
	 the user settings section.  Chatkey is explained above, chat flashing picture will show
	 a flashing message picture beside any user in chat (better visability then just colour coded).
	 Connect mode is just as described in that file. Default position sets the default position
	 of the chat window for auto connect and forced modes. It also sets it as the default for
	 manual connect modes but the user can change this.  Default refresh sets the refresh time
	 for the chat window to check for new messages and display them.  The faster you set this
	 the higher the load on the server.  Example if it's set to 10 seconds then AmCE checks
	 the chatlog 6 times per minute per user. You can set this to whatever you want but anywhere
	 from 10 to 30 seconds are good values for most people.

* Login as the admin in your php-nuke site, add the new Admin miniChat block in the
   blocks section and make sure you set it so only Administrators can see that block!

* Change permissions on both online.txt and chatlog.php so the web server can write
   to them.  If your unsure try 755 or 775 or 777 (in that order).

* Add the minichat/ directory to the robots.txt file so search engines don't crawl
   that direcorty.  (eg. Disallow: /minichat/)

* Add the following code to your admin.php file...
  
		Near the bottem of the file in the case switch where it says...
		 
		case "logout":
		setcookie("admin");
		include("header.php");
		OpenTable();
		echo "<center><font class=\"title\"><b>"._YOUARELOGGEDOUT."</b></font></center>";
		CloseTable();
		include("footer.php");
		break;

   Change it to this...
	 
	case "logout":
	setcookie("admin");
	$admin = "";
  // include("header.php");
	// OpenTable();
	// echo "<center><font class=\"title\"><b>"._YOUARELOGGEDOUT."</b></font></center>";
	// CloseTable();
	// include("footer.php");
		// added by admin MiniChat
		Header("Location: /minichat/minichat.php?func=adminlogout&nick=$aid");
	break;

* Add the following code to your auth.php file...
   Near the top of the file under the 1st if statement where it says...
	
    if($aid!="" AND $pwd!="") {
	$pwd = md5($pwd);
	$sql = "SELECT pwd, admlanguage FROM ".$prefix."_authors WHERE aid='$aid'";
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	if($row[pwd] == $pwd) {
	    $admin = base64_encode("$aid:$pwd:$row[admlanguage]");
	    setcookie("admin","$admin",time()+2592000);
	    unset($op);
	}

		Change it to this ....
	 
    if($aid!="" AND $pwd!="") {
	$pwd = md5($pwd);
	$sql = "SELECT pwd, admlanguage FROM ".$prefix."_authors WHERE aid='$aid'";
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	if($row[pwd] == $pwd) {
	    $admin = base64_encode("$aid:$pwd:$row[admlanguage]");
	    setcookie("admin","$admin",time()+2592000);
	    unset($op);
					// added by admin MiniChat
					Header("Location: /minichat/minichat.php?func=adminlogin&nick=$aid");
	}
	

* If you want added security then use your web servers authentication method to restrict access
   to the minichat/ directory as mentioned above in section 1.

   
4. Install (User Mode)
----------------------
* Set the chatkey value to a random 15 character code (replace 123456789012345) in
   the following files..  minichat/chatlog.php (1st line), and minichat/minichat.php (line 13).
   All 3 files must have the same value to work correctly.  You will need this chatkey

* Add users nicks (from php-nuke site) that you wish to allow access to chat into
  auth.txt each on a new line!

* Change permissions on both online.txt and chatlog.php so the web server can write
   to them.  If your unsure try 755 or 775 or 777 (in that order).

* Add the minichat/ directory to the robots.txt file so search engines don't crawl
   that direcorty.  (eg. Disallow: /minichat/)

* Add the following code to your /modules/Your_Account/index.php file...
  
	Near the bottem of the file in the case switch where it says...
 
	case "login":
	login($username, $user_password, $redirect, $mode, $f, $t, $random_num, $gfx_check);
	break;

   Change it to this...

	case "login":
	login($username, $user_password, $redirect, $mode, $f, $t, $random_num, $gfx_check);
	
        // ############################# Added by AmCE ######################################    
        // Read each line of auth.txt into an array
        $auth_array = file("minichat/auth.txt");
        foreach ($auth_array as $autheduser) {
          $autheduser = rtrim($autheduser);  # Get rid of newline characters cuz file() grabs CR/NL data
          // If user is listed in auth.txt then login to chat.
          if ($username == $autheduser) {
            Header("Location: /minichat/minichat.php?func=enterchat_usermode&nick=$username&reload=10&position=Top&chatkey=123456789012345");
          }
        }
	// ##################################################################################
	
	break;
	

* In the line Header("Location: .....); change the chatkey= variable to the one you used earlier.
  You can change the default refresh rate by changing the reload= variable (in seconds).
  You can change the default position= variable to Bottom if you want chat at the bottom of the page.
  Default refresh sets the refresh time
  for the chat window to check for new messages and display them.  The faster you set this
  the higher the load on the server.  Example if it's set to 10 seconds then AmCE checks
  the chatlog 6 times per minute per user. You can set this to whatever you want but anywhere
  from 10 to 30 seconds are good values for most people.

   
* Add the following code to your /modules/Your_Account/index.php file...
   
   	In the logout function about line 745 in this version find the following code..

    $db->sql_query("DELETE FROM ".$prefix."_session WHERE uname='$r_username'");
    $db->sql_query("DELETE FROM ".$prefix."_bbsessions WHERE session_user_id='$r_uid'");
    $user = "";
    @include("header.php");
	

  Change it to this ....
	 
    $db->sql_query("DELETE FROM ".$prefix."_session WHERE uname='$r_username'");
    $db->sql_query("DELETE FROM ".$prefix."_bbsessions WHERE session_user_id='$r_uid'");
    
    // ############################# Added by AmCE ######################################     
    // Read each line of auth.txt into an array
    $auth_array = file("minichat/auth.txt");
    foreach ($auth_array as $autheduser) {
      $autheduser = rtrim($autheduser);  # Get rid of newline characters cuz file() grabs CR/NL data
      // If user is listed in auth.txt then logout of chat.
      if ($r_username == $autheduser) {
        Header("Location: /minichat/minichat.php?func=exitchat_usermode&nick=$r_username&reload=10");
        $user = "";
      }
    }
    // ##################################################################################
    
    $user = "";
    @include("header.php");



* If you want added security then use your web servers authentication method to restrict access
   to the minichat/ directory as mentioned above in section 1.

5. To Do's
----------
* Add timeout values.. incase user's PC crashed and onlinelog was not updated.
* Run with registar_globals in ON or OFF mode (for users who don't have control of their webserver).


6. Changelog
------------
(AmCE 1.2)
* non-public
* Added new engine mode called usermode where selected users can use chat. No need to be admins.
* Fixed chat frames to fit better in more browsers.

(AmCE 1.0)
* non-public, final stage
* Added chatkey code for security! Now the chatlog is protected unless a user knows the chatkey.
   minichap.php, chatlog.php, and the AmCE block all know this chatkey to communicate with each other securely.
   All this and the only person that needs to know the chatkey is the Admin who installs AmCE.
* messages.html is now chatlog.php with 1 line of php code for the new chatkey security check.
* Fixed some bugs in the admin logout code to break out of chat even if user didn't exit chat.
* Added more code for auto hyperlink generation.  If a message contains www it will create proper
   <a href> code.
* Lots of cosmetic changes making chat more colourful with better layout.
* All messages have timestamps now not just status messages. (server time)
* Now has 3 "connect to chat" modes.  Manual connect only, Auto connect, and Forced connect!
* Added flashing message picture as an option, now admin can set it on or off.
* Removed users ability to set refresh time, admin now sets default refresh for everyone and it can be any value!
* Chatlog now keeps up to 20 lines of logged messages instead of the former 10 lines.

(AmCE 0.4b)
* non-public, beta stage
* Added code to clear the chatlog (messages.html file) once all users leave chat (for some security)
* Added a new faster chat refresh time of 10 seconds (refresh 6x per minute for each user).
* Added a flashing message picture to the AmCE block beside users in chat!
* Fixed a typo in breakframes code

(AmCE 0.3b)
* non-public, beta stage
* Fixed bad update onlinelog code which cause some users to be droped from
   the list.
* Fixed bad inchat check code in the block
* Added prepatched admin.php and auth.php files created with php-nuke 5.6
* Added code to sort the onlinelog list alphabetically
* Added code for auto hyperlink generation (web and email).  If a message
   contains either http:// or @ it will create the proper <a href> code.

(AmCE 0.2b)
* Re-Coded, non-public, beta stage
* Documentation, readme.txt
* 3 Files merged into 1 Engine file with multiple functions
* Minor Security added to Engine
* Added extra enterchat, exitchat, breakframes code
* Added login and logout checking and code
* Much faster and less buggy code

(AmCE 0.1a)
* 1st attempt, non-public, alpha stage
* No info or readme.txt
* 3 files for Engine
* No login, logout checking and code
* No security
* Very buggy but it works, well somewhat
