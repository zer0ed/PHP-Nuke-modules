/*********************************************/
/* nd3's Gradient Themepak for PHP-Nuke 6.9  */
/* By: Wes Brewer (nd3@routerdesign.com)     */
/* http://www.routerdesign.com               */
/* Copyright © 2002-2005 by Wes Brewer       */
/*********************************************/

0. Copyright Notice
-------------------
- This package CAN NOT be ported without written permission.
- This package CAN NOT be mirrored without written permission.
- Use of this package requires that credits to the original PHPNuke remain in all
  site generated pages.
- Currently there is only 1 project license granted at this time. The PHP-Nuke Project
  is the only project allowed to duplicate our scripts.


1. Introduction and Requirements
--------------------------------
This themepak is designed to work with php-nuke 6.9 and phpBB 2 forums (included with nuke).  
The style sheets (css) are combined into one file and therefore work as
one overall site theme. You don't need to use the included phpBB template. All themes
are created from scratch by me (except ExtraLite which was modified by me). All themes
support the RouterScript 1.7 module (also coded by me).

You can include the ThemeStats module on your site (included with this pack) to view
usage statistics about your themes.  (How many users use which theme etc...)


2. Installation
---------------
Extract archive to temp dir and copy included as noted below(and chmod if shown):
---------------------------------------------------------------------------------
README.txt (do not upload)
Extras/photoshop/*.* --------------------> Provided for your satisfaction.
Extras/header.htm -----------------------> also for your satisfaction.

html/modules/Forums/templates/RDP/*.* ---> /modules/Forums/templates/RDP/*.*
html/modules/ThemeStats/*.* -------------> /modules/ThemeStats/*.*
html/themes/*.* -------------------------> /themes/*.*


3. Use
------
* If you want to use the phpBB template then upload it and add it in the forums admin.
* If you want to keep track of theme usages stats, upload the ThemeStats module.
* To use the php-nuke themes just upload them.
* If you want a status bar clock (Javascript) then see the header.htm file for the code
and add it too the header & footer templates in each theme.



4. NOTES
--------

*** As with any script, backup the site before using this. ***
To use this script, just copy the files to the directories listed above. Then just run
it like expected.


5. To Do's
----------


6. Changelog
------------
[v041223]
* X-mas (Winter) theme added (with falling javascript snowflakes)
* Added ThemeStats module (to see user stats on which themes they use!)
* Fixed RDP-ExtraLite theme to include %bar pics (used for stats throughout the site, including ThemeStats)

[v030613]
* Fixed some bugs in phpBB admin templates
* Holloween Theme Added

[v030530]
* Old gradient themes grays are now brighter (blockbody, copyright, topbar) from #CCCCCC to #DDDDDD
* New SemiTransparent themes added (blockbody uses a new transparent looking image)
* Topbar Private message code updated to work with nuke 6.5
* If user has any new private messages then a sound is played saying "you have a message" (browser
   must support the <bgsound> tag)
* Added new user menu graphics stolen from another theme
* Fixed RDP phpBB forums template to look better under nuke 6.5
* Changed some of the colours used in the RDP phpBB forums template
* Fixed HyperCell Code to display new colours
* Added Badge hack to display the Avatar along with Rank on the users profile page

[v030604]
* Used new PHP-Nuke/phpBB SQL Abstraction Layer code (replaced depreciated SQL code)
* Added code for Broadcast Private Message in case needed
* Added new copyright footer code
* Added PHP-Nuke theme and phpBB template by message
* Added Page Generation Time at bottom
