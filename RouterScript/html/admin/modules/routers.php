<?php

/********************************************/
/* RouterScript 1.7 for PHP-Nuke 5.5.0     */
/* By: Wes Brewer (nd3@routerdesign.com)    */
/* http://www.routerdesign.com              */
/* Copyright © 2002 by Wes Brewer           */
/********************************************/

if (!eregi("admin.php", $PHP_SELF)) { die ("Access Denied"); }
   $result = sql_query("select radminency, radminsuper from ".$prefix."_authors where aid='$aid'", $dbi);
   list($radminency, $radminsuper) = sql_fetch_row($result, $dbi);
if (($radminency==1) OR ($radminsuper==1)) {

// get user settings
include("modules/Routers/rs_config.php");

/*********************************************************/
/* 3rd party PHP Functions                               */
/*********************************************************/

// Ported PHP resize bicubic function, found @ http://www.php.net/manual/en/function.imagecopyresized.php
// Port to PHP code by John Jensen (rze@counter-strike.net) July 10 2001 (updated 4/21/02)
// Original code in C, for the PHP GD Module by jernberg@fairtale.se
function ImageCopyResampleBicubic (&$dst_img, &$src_img, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h) {
   $palsize = ImageColorsTotal ($src_img);
   for ($i = 0; $i < $palsize; $i++) {  // get palette.
      $colors = ImageColorsForIndex ($src_img, $i);
      ImageColorAllocate ($dst_img, $colors['red'], $colors['green'],
      $colors['blue']);
   }
   $scaleX = ($src_w - 1) / $dst_w;
   $scaleY = ($src_h - 1) / $dst_h;
   $scaleX2 = (int) ($scaleX / 2);
   $scaleY2 = (int) ($scaleY / 2);

   for ($j = $src_y; $j < $dst_h; $j++) {
      $sY = (int) ($j * $scaleY);
      $y13 = $sY + $scaleY2;
      for ($i = $src_x; $i < $dst_w; $i++) {
         $sX = (int) ($i * $scaleX);
         $x34 = $sX + $scaleX2;

         $color1 = ImageColorsForIndex ($src_img, ImageColorAt ($src_img, $sX, $y13));
         $color2 = ImageColorsForIndex ($src_img, ImageColorAt ($src_img, $sX, $sY));
         $color3 = ImageColorsForIndex ($src_img, ImageColorAt ($src_img, $x34, $y13));
         $color4 = ImageColorsForIndex ($src_img, ImageColorAt ($src_img, $x34, $sY));
         $red = ($color1['red'] + $color2['red'] + $color3['red'] + $color4['red']) / 4;
         $green = ($color1['green'] + $color2['green'] + $color3['green'] + $color4['green']) / 4;
         $blue = ($color1['blue'] + $color2['blue'] + $color3['blue'] + $color4['blue']) / 4;

         ImageSetPixel ($dst_img, $i + $dst_x - $src_x, $j + $dst_y - $src_y, ImageColorClosest ($dst_img, $red, $green, $blue));
      }
   }
}

/*********************************************************/
/* Router Manager Functions                              */
/*********************************************************/

function routers() {
   global $prefix, $dbi;
   include("header.php");
   GraphicAdmin();
   title("Router Manager");
    
   // List waiting routers if any
   $result = sql_query("select rpid, rname from ".$prefix."_routers_pending order by rpid", $dbi);
   $numrows = sql_num_rows($result, $dbi);
   if ($numrows>0) {
      OpenTable();
      echo "<center><font class=\"storycat\"><b>Waiting Routers</b></font></center><br>"
      ."<form action=\"admin.php\" method=\"post\">"
      ."<table border=\"1\" align=\"center\"><tr bgcolor=\"$bgcolor2\">"
      ."<td class=\"boxtitle\">Router Name (ID)</td>"
      ."<td align=\"center\" class=\"boxtitle\">Options</td></tr>";
      while(list($rpid, $rname) = sql_fetch_row($result, $dbi)) {
         echo "<tr>"
         ."<td>$rname ($rpid)</td>"
         ."<td align=\"center\"><font size=\"2\">[<a href=\"admin.php?op=detailsUser&chng_upid=$upid\">"._DETUSER."</a>]<br>[<a href=\"admin.php?op=router_approve&amp;rpid=$rpid\">"._APPROVE."</a>]<br>[<a href=\"admin.php?op=denyUser&chng_upid=$upid\">"._DENY."</a>]</font></td>"
         ."</tr>";
      }
   echo "</table></form>";
   CloseTable();
   echo "<br>";
   } else { }

   OpenTable();
   echo "<center><b>Last 20 Routers Posted</b></center><br>";
   $result = sql_query("select rid, rname, rauthorname, rauthoremail from ".$prefix."_routers $queryalang order by rid desc limit 0,20", $dbi);
   echo "<center><table border=\"1\" width=\"100%\" bgcolor=\"$bgcolor1\">";
   echo "<tr><td align=\"center\"><b>ID#</b></td>"
   ."<td align=\"center\"><b>Name</b></td>"
   ."<td align=\"center\"><b>Author</b></td>"
   ."<td align=\"center\"><b>Options</b></td></tr>";
   while(list($rid, $rname, $rauthorname, $rauthoremail) = sql_fetch_row($result, $dbi)) {
      echo "<tr><td align=\"right\">$rid</td>"
      ."<td align=\"left\" width=\"100%\"><a href=\"modules.php?name=Routers&amp;func=OneRouter&amp;file=index&amp;rid=$rid\">$rname</a></td>"
      ."<td align=\"left\" width=\"100%\"><a href=\"mailto:$rauthoremail\">$rauthorname</a></td>"
      ."<td align=\"right\" nowrap>(<a href=\"admin.php?op=router_edit&amp;rid=$rid\">Edit</a>-<a href=\"admin.php?op=router_delete&amp;rid=$rid\">Delete</a>)</td></tr>";
   }
   echo "</table>"
   ."<center><form action=\"admin.php\" method=\"post\">"
   ."Router ID#: <input type=\"text\" NAME=\"rid\" SIZE=\"10\">"
   ."<select name=\"op\">"
   ."<option value=\"router_edit\" SELECTED>Edit Router</option>"
   ."<option value=\"router_delete\">Delete Router</option>"
   ."</select>"
   ."<input type=\"submit\">"
   ."</form></center>";
   CloseTable();
   echo "<br>";
   OpenTable();
   
   echo "<center><b>Add New Router</b></center><br><br>"
   ."<form action=\"admin.php\" method=\"post\">"
   ."<table width=\"100%\" cellspacing=\"5\" border=\"0\">"

   ."<tr>"
   ."<td colspan=\"2\"><b>Router Name:</b><br>"
   ."<input type=\"text\" name=\"rname\" size=\"30\" maxlength=\"80\"></td>"
   ."</tr>"

   ."<tr>"
   ."<td width=\"50%\"><b>Author's Name:</b><br>"
   ."<input type=\"text\" name=\"rauthorname\" size=\"30\" maxlength=\"80\"></td>"
   ."<td width=\"50%\"><b>Author's Email Address:</b><br>"
   ."<input type=\"text\" name=\"rauthoremail\" size=\"30\" maxlength=\"40\"></td>"
   ."<tr>"

   ."<tr>"
   ."<td><b>Authors Website Name:</b><br>"
   ."<input type=\"text\" name=\"rsitename\" size=\"30\" maxlength=\"80\"></td>"
   ."<td><b>Authors Website URL:</b><br>"
   ."<input type=\"text\" name=\"rsiteurl\" size=\"30\" maxlength=\"150\"></td>"
   ."</tr>"

   ."<tr><td colspan=\"2\">&nbsp;</td></tr>"
   ."<tr><td colspan=\"2\">&nbsp;</td></tr>"

   ."<tr>"
   ."<td><b>Apx. Build Time:</b>"
   ."<select name=\"rtime\">"
      ."<option value=\"0-9h\" selected>0-9 Hours</option>"
      ."<option value=\"10-19h\">10-19 Hours</option>"
      ."<option value=\"20-29h\">20-29 Hours</option>"
      ."<option value=\"30-39h\">30-39 Hours</option>"
      ."<option value=\"40-47h\">40-47 Hours</option>"
      ."<option value=\"2-3d\">2-3 Days</option>"
      ."<option value=\"4-5d\">4-5 Days</option>"
      ."<option value=\"6-7d\">6-7 Days</option>"
      ."<option value=\"1-4w\">1-4 Weeks</option>"
      ."<option value=\"more1m\">> 1 Month</option>"
      ."<option value=\"more1y\">> 1 Year</option></select></td>"
   ."<td><b>Total Cost:</b><br>"
   ."<input type=\"text\" name=\"rcost\" size=\"20\" maxlength=\"20\"></td>"
   ."</tr>"

   ."<tr>"
   ."<td><b>Router Software / OS:</b><br>"
   ."<input type=\"text\" name=\"rsoft\" size=\"30\" maxlength=\"30\"></td>"
   ."<td><b>CPU:</b><br>"
   ."<input type=\"text\" name=\"rcpu\" size=\"30\" maxlength=\"30\"></td>"
   ."</tr>"
	
   ."<tr>"
   ."<td><b>RAM:</b><br>"
   ."<input type=\"text\" name=\"rram\" size=\"30\" maxlength=\"30\"></td>"
   ."<td><b>Interface 1:</b><br>"
   ."<input type=\"text\" name=\"rif1\" size=\"30\" maxlength=\"30\"></td>"
   ."</tr>"

   ."<tr>"
   ."<td><b>Hub / Switch:</b><br>"
   ."<input type=\"text\" name=\"rhub\" size=\"30\" maxlength=\"30\"></td>"
   ."<td><b>Interface 2:</b><br>"
   ."<input type=\"text\" name=\"rif2\" size=\"30\" maxlength=\"30\"></td>"
   ."</tr>"

   ."<tr>"
   ."<td><b>Drives:</b><br>"
   ."<input type=\"text\" name=\"rdrives\" size=\"30\" maxlength=\"80\"></td>"
   ."<td><b>Interface 3:</b><br>"
   ."<input type=\"text\" name=\"rif3\" size=\"30\" maxlength=\"30\"></td>"
   ."</tr>"

   ."<tr>"
   ."<td colspan=\"2\"><b>Extra Notes:</b><br>"
   ."<input type=\"text\" name=\"rnote\" size=\"30\" maxlength=\"100\"></td>"
   ."</tr>"

   ."<tr>"
   ."<td colspan=\"2\"><b>Details:</b><br>"
   ."<textarea name=\"rdetails\" rows=\"30\" cols=\"60\"></textarea></td>"
   ."</tr>"
   ."</table>"

   ."<input type=\"hidden\" name=\"op\" value=\"router_save\">"
   ."<input type=\"submit\" value=\"Submit\">"
   ."</form>";
   
   CloseTable();
   include("footer.php");
}

function router_edit($rid) {
   global $prefix, $dbi;
   include("header.php");
   GraphicAdmin();
   title("Router Manager");
   
   $result = sql_query("select * from ".$prefix."_routers WHERE rid='$rid'", $dbi);
   list($rid, $rname, $rauthorname, $rauthoremail, $rsitename, $rsiteurl, $rtime, $rcost, $rsoft, $rcpu, $rram, $rif1, $rif2, $rif3, $rhub, $rdrives, $rnote, $rdetails) = sql_fetch_row($result, $dbi);
   OpenTable();
   echo "<center><b>Edit Router: $rid</b></center><br><br>"
   ."<form action=\"admin.php\" method=\"post\">"
   ."<table width=\"100%\" cellspacing=\"5\" border=\"0\">"

   ."<tr>"
   ."<td colspan=\"2\"><b>Router Name:</b><br>"
   ."<input type=\"text\" name=\"rname\" value=\"$rname\" size=\"30\" maxlength=\"80\"></td>"
   ."</tr>"

   ."<tr>"
   ."<td width=\"50%\"><b>Author's Name:</b><br>"
   ."<input type=\"text\" name=\"rauthorname\" value=\"$rauthorname\" size=\"30\" maxlength=\"80\"></td>"
   ."<td width=\"50%\"><b>Author's Email Address:</b><br>"
   ."<input type=\"text\" name=\"rauthoremail\" value=\"$rauthoremail\" size=\"30\" maxlength=\"40\"></td>"
   ."<tr>"

   ."<tr>"
   ."<td><b>Author's Website Name:</b><br>"
   ."<input type=\"text\" name=\"rsitename\" value=\"$rsitename\" size=\"30\" maxlength=\"80\"></td>"
   ."<td><b>Author's Website URL:</b><br>"
   ."<input type=\"text\" name=\"rsiteurl\" value=\"$rsiteurl\" size=\"30\" maxlength=\"150\"></td>"
   ."</tr>"

   ."<tr><td colspan=\"2\">&nbsp;</td></tr>"
   ."<tr><td colspan=\"2\">&nbsp;</td></tr>"

   ."<tr>"
   ."<td><b>Apx. Build Time:</b> "
   ."<select name=\"rtime\">";
   // select the old value from the form list
   $optvalue = array("0-9h", "10-19h", "20-29h", "30-39h", "40-47h", "2-3d", "4-5d", "6-7d", "1-4w", "more1m", "more1y");
   $optname = array("0-9 Hours", "10-19 Hours", "20-29 Hours", "30-39 Hours", "40-47 Hours", "2-3 Days", "4-5 Days", "6-7 Days", "1-4 Weeks", "> 1 Month", "> 1 Year");
   for ($cnt=0; $cnt < sizeof($optvalue); $cnt++) {
      echo "<option value=\"$optvalue[$cnt]\" ";
      if ($rtime == $optvalue[$cnt]) { echo "selected"; }
      echo ">$optname[$cnt]</option>\n";
   }
   echo "</select></td>"
        
   ."<td><b>Total Cost:</b><br>"
   ."<input type=\"text\" name=\"rcost\" value=\"$cost\" size=\"20\" maxlength=\"20\"></td>"
   ."</tr>"

   ."<tr>"
   ."<td><b>Router Software / OS:</b><br>"
   ."<input type=\"text\" name=\"rsoft\" value=\"$rsoft\" size=\"30\" maxlength=\"30\"></td>"
   ."<td><b>CPU:</b><br>"
   ."<input type=\"text\" name=\"rcpu\" value=\"$rcpu\" size=\"30\" maxlength=\"30\"></td>"
   ."</tr>"
	
   ."<tr>"
   ."<td><b>RAM:</b><br>"
   ."<input type=\"text\" name=\"rram\" value=\"$rram\" size=\"30\" maxlength=\"30\"></td>"
   ."<td><b>Interface 1:</b><br>"
   ."<input type=\"text\" name=\"rif1\" value=\"$rif1\" size=\"30\" maxlength=\"30\"></td>"
   ."</tr>"

   ."<tr>"
   ."<td><b>Hub / Switch:</b><br>"
   ."<input type=\"text\" name=\"rhub\" value=\"$rhub\" size=\"30\" maxlength=\"30\"></td>"
   ."<td><b>Interface 2:</b><br>"
   ."<input type=\"text\" name=\"rif2\" value=\"$rif2\" size=\"30\" maxlength=\"30\"></td>"
   ."</tr>"

   ."<tr>"
   ."<td><b>Drives:</b><br>"
   ."<input type=\"text\" name=\"rdrives\" value=\"$rdrives\" size=\"30\" maxlength=\"80\"></td>"
   ."<td><b>Interface 3:</b><br>"
   ."<input type=\"text\" name=\"rif3\" value=\"$rif3\" size=\"30\" maxlength=\"30\"></td>"
   ."</tr>"

   ."<tr>"
   ."<td colspan=\"2\"><b>Extra Notes:</b><br>"
   ."<input type=\"text\" name=\"rnote\" value=\"$rnote\" size=\"30\" maxlength=\"100\"></td>"
   ."</tr>"

   ."<tr>"
   ."<td colspan=\"2\"><b>Details:</b><br>"
   ."<textarea name=\"rdetails\" rows=\"20\" cols=\"60\">$rdetails</textarea></td>"
   ."</tr>"

   ."<tr><td colspan=\"2\">&nbsp;</td></tr>"
   ."<tr><td colspan=\"2\">&nbsp;</td></tr>"

   ."<tr>"
   ."<td align=\"center\" colspan=\"2\"><b>NOTE:</b> Using any of the below switches (radio buttons) will result in the above details not being updated!</b><br></td>"
   ."</tr>"

   ."<tr>"
   ."<td align=\"center\" colspan=\"2\"><b>Clear Voting Data?</b><br>"
   ."<input type=\"radio\" name=\"clearvote\" value=\"1\">&nbsp;Yes&nbsp&nbsp;<input type=\"radio\" name=\"clearvote\" value=\"0\" checked>&nbsp;No<br></td>"
   ."</tr>"
   
   ."<tr>"
   ."<td align=\"center\" colspan=\"2\"><b>Auto Generate Thumbnails?</b><br>"
   ."<input type=\"radio\" name=\"autothumb\" value=\"1\">&nbsp;Yes&nbsp&nbsp;<input type=\"radio\" name=\"autothumb\" value=\"0\" checked>&nbsp;No<br></td>"
   ."</tr>"
	
   ."<tr>"
   ."<td align=\"center\">"
   ."Thumbnail Width (in Pixels): <input type=\"text\" name=\"thumb_x\" size=\"10\"><br>"
   ."Thumbnail Height (in Pixels): <input type=\"text\" name=\"thumb_y\" size=\"10\"><br>"
   ."Thumbnail JPEG Quality (1-100): <input type=\"text\" name=\"thumbqual\" value=\"75\" size=\"10\"></td>"
   ."<td align=\"center\"><input type=\"checkbox\" name=\"keep_aratio\" value=\"1\" checked>Keep Aspect Ratio</td>"
   ."</tr>"

   ."<tr><td align=\"center\" colspan=\"2\"><br><b>Note:</b> You must have the original pictures in the proper directory, allow the "
   ."server write permission (chmod 777) in the directory, and the original pics must be JPEG format! "
   ."In order to keep the aspect ratio, just specify either height or width not both and check that option. If you want to strech or skew the thumbnail then make sure to "
   ."uncheck the keep aspect ratio option and specify both the height and width values."
   ."</table>"

   ."<input type=\"hidden\" name=\"rid\" value=\"$rid\">"
   ."<input type=\"hidden\" name=\"op\" value=\"router_save_edit\">"
   ."<input type=\"submit\" value=\"Save Changes\">"
   ."</form>";
   CloseTable();
   include("footer.php");
}

function router_delete($rid, $ok=0) {
   global $prefix, $dbi;
   if ($ok==1) {
      sql_query("delete from ".$prefix."_routers where rid='$rid'", $dbi);
      Header("Location: admin.php?op=routers");
   } else {
      include("header.php");
      GraphicAdmin();
      title("Router Manager");
      $result = sql_query("select rname from ".$prefix."_routers where rid='$rid'", $dbi);
      list($rname) = sql_fetch_row($result, $dbi);

      OpenTable();
      echo "<center><b>Delete Router: $rname</b><br><br>"
      ."Are you sure you want to delete: $rname ?<br><br>"
      ."[ <a href=\"admin.php?op=routers\">"._NO."</a> | <a href=\"admin.php?op=router_delete&amp;rid=$rid&amp;ok=1\">"._YES."</a> ]</center>";
      CloseTable();
      include("footer.php");
    }
}

function router_save($rname, $rauthorname, $rauthoremail, $rsitename, $rsiteurl, $rtime, $rcost, $rsoft, $rcpu, $rram, $rif1, $rif2, $rif3, $rhub, $rdrives, $rnote, $rdetails) {
   global $prefix, $dbi;
//   sql_query("insert into ".$prefix."_routers value (NULL, '$rname', '$rauthorname', '$rauthoremail', '$rsitename', '$rsiteurl', '$rtime', '$rcost', '$rsoft', '$rcpu', '$rram', '$rif1', '$rif2', '$rif3', '$rhub', '$rdrives', '$rnote', '$rdetails', "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0")", $dbi);
   sql_query("insert into ".$prefix."_routers values (NULL, '$rname', '$rauthorname', '$rauthoremail', '$rsitename', '$rsiteurl', '$rtime', '$rcost', '$rsoft', '$rcpu', '$rram', '$rif1', '$rif2', '$rif3', '$rhub', '$rdrives', '$rnote', '$rdetails', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0')", $dbi);
//   sql_query("insert into ".$prefix."_routers SET rid=NULL, rname='$rname', rauthorname='$rauthorname', rauthoremail='$rauthoremail', rsitename='$rsitename', rsiteurl='$rsiteurl', rtime='$rtime', rcost='$rcost', rsoft='$rsoft', rcpu='$rcpu', rram='$rram', rif1='$rif1', rif2='$rif2', rif3='$rif3', rhub='$rhub', rdrives='$rdrives', rnote='$rnote', rdetails='$rdetails', vote_total=NULL, vote_1=NULL, vote_2=NULL, vote_3=NULL, vote_4=NULL, vote_5=NULL, vote_6=NULL, vote_7=NULL, vote_8=NULL, vote_9=NULL, vote_10=NULL", $dbi);
   Header("Location: admin.php?op=routers");
}

function router_save_edit($rid, $rname, $rauthorname, $rauthoremail, $rsitename, $rsiteurl, $rtime, $rcost, $rsoft, $rcpu, $rram, $rif1, $rif2, $rif3, $rhub, $rdrives, $rnote, $rdetails, $clearvote, $autothumb, $keep_aratio, $thumb_x, $thumb_y, $thumbqual) {
   global $prefix, $dbi, $maindir, $thumbdir, $gdver;

   if ($clearvote == "1" ) {
      // clear votes code
      sql_query("update ".$prefix."_routers set vote_total='0', vote_1='0', vote_2='0', vote_3='0', vote_4='0', vote_5='0', vote_6='0', vote_7='0', vote_8='0', vote_9='0', vote_10='0' where rid='$rid'", $dbi);
   } elseif ($authothumb == "1" ) {
      // Router Picture counter, to auto thumbnail each picture
      $handle = opendir("$maindir/$rid");
      // check for thumbnail directory, if no them make one with permissions 777
      if (!file_exists("$maindir/$rid/$thumbdir")) {
         mkdir("$maindir/$rid/$thumbdir", 0755);  // php safemode cheat to allow 777
         chmod ("$maindir/$rid/$thumbdir", 0777);
      }
      while ($file = readdir($handle)) {
         if ( (ereg("^([0-9a-z]+)([.]{1})([a-z0-9]{3})$", $file)) ) {$piclist .= "$file ";}
      }
      closedir($handle);
      $piclist = explode(" ", $piclist);
      sort($piclist);
      for ($cnt=1; $cnt <= sizeof($piclist); $cnt++){
         if($piclist[$cnt]!="") {
            $picsize = getimagesize("$maindir/$rid/$piclist[$cnt]");
            // keep aspect code
            if (($keep_aratio == "1" ) && ($thumb_x != "")) {
               $aratio = $picsize[1] / $picsize[0];
               $thumb_y = round($thumb_x * $aratio);
            } elseif (($keep_aratio == "1" ) && ($thumb_y != "")) {
               $aratio = $picsize[0] / $picsize[1];
               $thumb_x = round($thumb_y * $aratio);
            }
            // Get the dimensions of the source picture
            $source_x  = $picsize[0];
            $source_y  = $picsize[1];
            $source_id = imageCreateFromJPEG("$maindir/$rid/$piclist[$cnt]");
            // Create a new image object
            $target_id = imagecreate($thumb_x, $thumb_y);
            // Resize the original picture and copy it into the just created image object.
            if ($gdver = "1") {imagecopyresized($target_id, $source_id, 0, 0, 0, 0, $thumb_x, $thumb_y, $source_x, $source_y);}
            elseif ($gdver = "1+hack") {ImageCopyResampleBicubic($target_id, $source_id, 0, 0, 0, 0, $thumb_x, $thumb_y, $source_x, $source_y);}
            elseif ($gdver = "2") {imagecopyresampled($target_id, $source_id, 0, 0, 0, 0, $thumb_x, $thumb_y, $source_x, $source_y);}
            // Dump the thumbnail to a file
            imagejpeg ($target_id,"$maindir/$rid/$thumbdir/$piclist[$cnt]",$thumbqual);
            // free server memory as these are no longer needed.
            imagedestroy ($source_id);
            imagedestroy ($target_id);
         }
      }
   } else {
      // update all other details
      sql_query("update ".$prefix."_routers set rname='$rname', rauthorname='$rauthorname', rauthoremail='$rauthoremail', rsitename='$rsitename', rsiteurl='$rsiteurl', rtime='$rtime', rcost='$rcost', rsoft='$rsoft', rcpu='$rcpu', rram='$rram', rif1='$rif1', rif2='$rif2', rif3='$rif3', rhub='$rhub', rdrives='$rdrives', rnote='$rnote', rdetails='$rdetails' where rid='$rid'", $dbi);
   }
   Header("Location: admin.php?op=routers");
}

function router_approve($rpid, $ok=0) {
   global $prefix, $dbi;
   if ($ok==1) {
      $result = sql_query("SELECT * FROM ".$prefix."_routers_pending WHERE rpid='$rpid'", $dbi);
      list($rpid, $rname, $rauthorname, $rauthoremail, $rsitename, $rsiteurl, $rtime, $rcost, $rsoft, $rcpu, $rram, $rif1, $rif2, $rif3, $rhub, $rdrives, $rnote, $rdetails) = sql_fetch_row($result, $dbi);
      $result2 = sql_query("insert into ".$prefix."_routers set rname='$rname', rauthorname='$rauthorname', rauthoremail='$rauthoremail', rsitename='$rsitename', rsiteurl='$rsiteurl', rtime='$rtime', rcost='$rcost', rsoft='$rsoft', rcpu='$rcpu', rram='$rram', rif1='$rif1', rif2='$rif2', rif3='$rif3', rhub='$rhub', rdrives='$rdrives', rnote='$rnote', rdetails='$rdetails'", $dbi);
      $message = "Congratulations, your router was approved for viewing at $sitename!\n\n "._YOUUSEDEMAIL." ($email) to submit a router design to $sitename.";
      $subject="Router Approved at $sitename!";
      $from="$adminmail";
      mail($rauthoremail, $subject, $message, "From: $from\nX-Mailer: PHP/" . phpversion());
      sql_query("delete from ".$prefix."_routers_pending where rpid='$rpid'", $dbi);
      Header("Location: admin.php?op=routers");
   } else {
      include("header.php");
      GraphicAdmin();
      title("Router Manager");
      echo "<br>";
      OpenTable();
      echo "<center><font class=\"option\"><b>Approve Router</b></font><br><br>"
      ."Are you sure you want to approve $rpid?<br><br>"
      ."[ <a href=\"admin.php?op=routers\">"._NO."</a> | <a href=\"admin.php?op=router_approve&amp;rpid=$rpid&amp;ok=1\">"._YES."</a> ]</center>";
      CloseTable();
      include("footer.php");
   }   
}

function router_deny($rpid, $ok=0) {
   global $prefix, $dbi;
   if ($ok==1) {
      $result = sql_query("SELECT rauthoremail FROM ".$prefix."_routers_pending WHERE rpid='$rpid'", $dbi);
      list($rauthoremail) = sql_fetch_row($result, $dbi);
      $message = "Sorry, your router was denied for use at $sitename.\n\n "._YOUUSEDEMAIL." ($email) to submit a router design to $sitename.";
      $subject="Router Denied at $sitename!";
      $from="$adminmail";
      mail($rauthoremail, $subject, $message, "From: $from\nX-Mailer: PHP/" . phpversion());
      sql_query("delete from ".$prefix."_routers_pending where rpid='$rpid'", $dbi);
      Header("Location: admin.php?op=routers");
   } else {
      include("header.php");
      GraphicAdmin();
      title("Router Manager");
      echo "<br>";
      OpenTable();
      echo "<center><font class=\"option\"><b>Deny Router</b></font><br><br>"
      ."Are you sure you want to deny $rpid?<br><br>"
      ."[ <a href=\"admin.php?op=routers\">"._NO."</a> | <a href=\"admin.php?op=router_deny&amp;rpid=$rpid&amp;ok=1\">"._YES."</a> ]</center>";
      CloseTable();
      include("footer.php");
   }   
}
   
switch ($op) {

    case "routers":
    routers();
    break;

    case "router_edit":
    router_edit($rid);
    break;

    case "router_delete":
    router_delete($rid, $ok);
    break;

    case "router_save":
    router_save($rname, $rauthorname, $rauthoremail, $rsitename, $rsiteurl, $rtime, $rcost, $rsoft, $rcpu, $rram, $rif1, $rif2, $rif3, $rhub, $rdrives, $rnote, $rdetails);
    break;

    case "router_save_edit":
    router_save_edit($rid, $rname, $rauthorname, $rauthoremail, $rsitename, $rsiteurl, $rtime, $rcost, $rsoft, $rcpu, $rram, $rif1, $rif2, $rif3, $rhub, $rdrives, $rnote, $rdetails, $clearvote, $autothumb, $keep_aratio, $thumb_x, $thumb_y, $thumbqual);
    break;

    case "router_approve":
    router_approve($rpid, $ok);
    break;

    case "router_deny":
    router_deny($rpid, $ok);
    break;
}

} else {
    echo "Access Denied";
}

?>