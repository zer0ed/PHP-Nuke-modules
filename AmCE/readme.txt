/*******************************************************
* AmCE - Admin miniChat Engine v0.4b for PHP-Nuke 6.9
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
AmCE - Admin miniChat Engine is a small html based chat room for admins at a
PHP-Nuke driven website.  It requires PHP-Nuke 6.x to be installed and working
properly.  Currently you need register_globals set to ON in your php.ini file
for your webserver.  This will be changed in a later release!

AmCE is very light weight and non-cpu intensive on either the server
or the client.  It doesn't use a database, just files and it's not realtime
but close enough.. it uses user set HTML META refreshes!

The Engine itself is 1 file minichat.php with many functions. Since AmCE is very
light, it has very poor security!!  Both it's online.txt (onlinelog) and
messages.html (chatlog) files have very poor security!  The Engine (minichat.php)
has some minimal security checks built in, but don't depend on them!

If security is a consern then use something else!!  If you still want to use miniChat
then at least use your webserver's authentication method to set up restricted access
to the minichat/ direcorty (.htaccess in Apache).  You should also setup a robots
file and deny search engines from webcrawling that directory as explained below.


2. Installation
---------------
Extract archive to temp dir and copy included as noted below(and chmod if shown):
---------------------------------------------------------------------------------
readme.txt (do not upload)
blocks/*.* ------------------------------> blocks/*.*
minichat/*.* ----------------------------> minichat/*.*


3. Use
------
* Login as the admin in your php-nuke site, add the new Admin miniChat block in the
   blocks section and make sure you set it so only Administrators can see that block!

* Change permissions on both online.txt and messages.html so the web server can write
   to them.  If your unsure try 755 or 775 or 777 (in that order).

* Add the minichat/ directory to the robots.txt file so search engines don't crawl
   that direcorty.  (eg. Disallow: /minichat/)

* Add the following code to your admin.php file...
   If you have the default files that came with phpnuke 6.9 then you can use the files
	 provided instead of manually editing them.
  
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
		include("header.php");
		OpenTable();
		echo "<center><font class=\"title\"><b>"._YOUARELOGGEDOUT."</b></font></center>";
		CloseTable();
		include("footer.php");
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


4. To Do's
----------
* Better Security.
* Add timeout values.. incase user's PC crashed and onlinelog was not updated.
* Run with registar_globals in ON or OFF mode (for users who don't have control of their webserver).
* Add ability to invite someone to chat.


5. Changelog
------------
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
