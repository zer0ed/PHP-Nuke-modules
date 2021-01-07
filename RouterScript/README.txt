/********************************************/
/* RouterScript 1.71 for PHP-Nuke 5.5.0     */
/* By: Wes Brewer (nd3@routerdesign.com)    */
/* http://www.routerdesign.com              */
/* Copyright © 2002 by Wes Brewer           */
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
RouterScript is a picture & info library for routers (see http://www.routerdesign.com
for an example).  It requires PHP-Nuke 5.5.0 to be installed and working properly.


2. Installation
---------------
Extract archive to temp dir and copy included as noted below(and chmod if shown):
---------------------------------------------------------------------------------
README.txt (do not upload)
sql/*.* ---------------------------------> These are provided for your satisfaction

html/mainfile.php -----------------------> mainfile.php  ++ See note A1 below
html/admin/case/*.* ---------------------> admin/case/*.*
html/admin/link/*.* ---------------------> admin/link/*.*
html/admin/modules/*.* ------------------> admin/modules/*.*
html/blocks/*.* -------------------------> blocks/*.*
html/images/routerscript/*.* ------------> images/routerscript/*.*
html/images/admin/*.* -------------------> images/admin/*.*
html/modules/Routers/*.* ----------------> modules/Routers/*.*
html/themes/Example/*.* -----------------> themes/Example/*.*

3. Use
------
* Set the user setting variables in modules/Routers/rs_config.php.
* If using an older php version then change any round functions to substr functions.
* Make sure you create the main router directory (maindir) with permissions 777 so 
the server can write to it if your going to use the auto thumbnail option.
* For the theme skin part.. see themes/Example/routers.html for an example of the template.  In order
for the theme template to work you must include a routerstheme function in your theme.php file.  See
themes/Example/theme.php for the proper code.


4. NOTES
--------
A1) If you do not want to overwrite your mainfile.php with the included copy, open your copy in a text
    editor and find function adminblock() then add the following at the end of the submissions.

   $result = sql_query("select * from ".$prefix."_routers_pending", $dbi); 
   $num = sql_num_rows($result, $dbi);
   $content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"admin.php?op=routers\">Waiting Routers</a>: $num<br>";

    Then reupload it to your site.

*** As with any script, backup the site before using this. ***
To use this script, just copy the files to the directories listed above. Then just run
it like expected file.


5. To Do's
----------
* Fix auto thumbnail code, (pics won't load properly after creation in PHP Safe Mode).
* Build a better submit router function, a form that allows multiple uploads and implement
   it to work with the nuke_routers_pending table already created. Most of the functions
   have been already created for this.

6. Changelog
------------
(RouterScript 1.71)
* Fixed add a new router bug which wouldn't save a new router in the database due to
   a missing value for the new vote_avg entry.
* Fixed clear votes bug which wouldn't work due to the missing value for the new
   vote_avg entry in the database (nuke_routers table).
* Fixed minor display bug in the router poll block.

(RouterScript 1.7)
* Added better routerlist sorting functionality (routers per page, sortby, sortorder)
* Improved the overall routerlist header & footer look
* Fixed a bug that displayed the router's wrong build time on some pages.
* Fixed a bug with the average rating not being rounded properly.
* Average rating is now stored in the database.
* Changed the routers theme to allow display of total votes and average rating.
* Slightly modified the look of the routers poll block & routers theme.
* HTML checked by a validator (validator.w3.org) and now passes. All HTML corrected.

(RouterScript 1.5)
* Fixed routers per page bug (was wrong if there were 2 pages).
* Added "Router Poll" block & other voting functionality (idea from Hot or Not block @ www.trashbin.net).
* User setting variables moved to 1 configuration file used by all scripts.

(RouterScript 1.2b)
* 1st official release
