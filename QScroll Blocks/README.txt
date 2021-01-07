/********************************************/
/* QScroll Blocks v1.1 for PHP-Nuke 5.6     */
/* By: Wes Brewer (nd3@routerdesign.com)    */
/* http://www.routerdesign.com              */
/* Copyright © 2003 by Wes Brewer           */
/********************************************/

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
QScroll Blocks allows any nuke block/sidebar to be autoscrolled (see http://www.routerdesign.com
for an example).  It requires PHP-Nuke 5.6 to be installed and working properly.  No database is
needed, as this is a quick and dirty solution.. therefore it is not very optimized for speed.


2. Installation
---------------
Extract archive to temp dir and copy included as noted below(and chmod if shown):
---------------------------------------------------------------------------------
README.txt (do not upload)

html/scroll.php -------------------------> mainfile.php
html/blocks/*.* -------------------------> blocks/*.*  +see notes below

3. Use
------
* Set the user setting variables in the block files.
* Setup nuke to use the new QScroll block, drop the old block
* Keep both the QScroll block and the old block files, as the QScroll blocks use the old blocks for content.


4. NOTES
--------
* You can make your own blocks by coping the blocks provided, then renaming them to something
   similar to the old block with _QScroll in the filename.  You must then set the variables
   inside the new QScroll file to point to the old block file (for content generation).  Set
   the remaining settings as needed.
* If the users browser doesn't support <IFRAME> then the block will display as normal (that is
   like it use to with no scrolling).

*** As with any script, backup the site before using this. ***
To use this script, just copy the files to the directories listed above. Then just run
it like expected file.


5. To Do's
----------
* On mouse over show scroll bars?
* Make the code not so "quick and dirty" so load times are better!  Currently loads 3-4 files
   instead of 2.

6. Changelog
------------
(QScroll Blocks v1.1)
* Fixed bug where followed links would load inside the iframe/scrollblock.  Now they load as
   the top page.. like they should ;)

(QScroll Blocks v1.0)
* 1st official release
