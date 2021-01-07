<?php

/********************************************/
/* RouterScript 1.71 for PHP-Nuke 5.5.0      */
/* By: Wes Brewer (nd3@routerdesign.com)    */
/* http://www.routerdesign.com              */
/* Copyright © 2002 by Wes Brewer           */
/********************************************/

if (!eregi("modules.php", $PHP_SELF)) {
   die ("You can't access this file directly...");
}

// get user settings
include("modules/Routers/rs_config.php");
$index = 1;

function RouterList($perpg, $sortby, $sortord, $page) {
   global $dbi, $prefix, $maindir, $thumbdir, $mainpicfile, $copyright;
   include("header.php");

   // Navigation bar, used for multiple pages
   if(!isSet($page)){$page = 1;}
   $result = sql_query("select * from ".$prefix."_routers", $dbi); 
   $numrouters = sql_num_rows($result, $dbi);
   if (!isSet($perpg)) {$perpg = "10";}
   $totalpages = ceil($numrouters / $perpg);
   $nextpage = $page + 1;
   $prevpage = $page - 1;
   $start = ($page - 1) * $perpg;
   // set navigation bar links
   if(($page == 1) && ($nextpage <= $totalpages)){
      //you're at the beginning of the photo gallery
      $navbar = "<td width=\"20%\" align=\"left\">&nbsp;</td><td width=\"60%\" align=\"center\"><b>Page $page of $totalpages</b> ($numrouters total routers)</td><td width=\"20%\" align=\"right\"><b><a href=\"modules.php?name=Routers&amp;file=index&amp;perpg=$perpg&amp;sortby=$sortby&amp;sortord=$sortord&amp;page=$nextpage\">next</a> &#187</b></td>";
   } elseif (($page > 1) && ($nextpage <= $totalpages)){
      //you're in the middle of the photo gallery
      $navbar = "<td width=\"20%\" align=\"left\"><b>&#171; <a href=\"modules.php?name=Routers&amp;file=index&amp;perpg=$perpg&amp;sortby=$sortby&amp;sortord=$sortord&amp;page=$prevpage\">prev</a></b></td><td width=\"60%\" align=\"center\"><b>Page $page of $totalpages</b> ($numrouters total routers)</td><td width=\"20%\" align=\"right\"><b><a href=\"modules.php?name=Routers&amp;file=index&amp;perpg=$perpg&amp;sortby=$sortby&amp;sortord=$sortord&amp;page=$nextpage\">next</a> &#187</b></td>";
   } elseif(($page == 1) && ($nextpage > $totalpages)){
      //you're in a photo gallery with only one page of photos
      $navbar = "<td width=\"20%\" align=\"left\">&nbsp;</td><td width=\"60%\" align=\"center\"><b>Page $page of $totalpages</b> ($numrouters total routers)</td><td width=\"20%\" align=\"right\">&nbsp;</td>";
   } else {
      //you're at the end of the photo galley
      $navbar = "<td width=\"20%\" align=\"left\"><b>&#171; <a href=\"modules.php?name=Routers&amp;file=index&amp;perpg=$perpg&amp;sortby=$sortby&amp;sortord=$sortord&amp;page=$prevpage\">prev</a></b></td><td width=\"60%\" align=\"center\"><b>Page $page of $totalpages</b> ($numrouters total routers)</td><td width=\"20%\" align=\"right\">&nbsp;</td>";
   }

   // set # of routers per page (perpg) method & keep option selected
   if ($perpg == "5") {
      $perpgsel1 = "selected";
      $perpgsel2 = "";
      $perpgsel3 = "";
      $perpgsel4 = "";
      $perpgsel5 = "";
   } elseif ($perpg == "10") {
      $perpgsel1 = "";
      $perpgsel2 = "selected";
      $perpgsel3 = "";
      $perpgsel4 = "";
      $perpgsel5 = "";
   } elseif ($perpg == "15") {
      $perpgsel1 = "";
      $perpgsel2 = "";
      $perpgsel3 = "selected";
      $perpgsel4 = "";
      $perpgsel5 = "";
   } elseif ($perpg == "20") {
      $perpgsel1 = "";
      $perpgsel2 = "";
      $perpgsel3 = "";
      $perpgsel4 = "selected";
      $perpgsel5 = "";
   } elseif ($perpg == "25") {
      $perpgsel1 = "";
      $perpgsel2 = "";
      $perpgsel3 = "";
      $perpgsel4 = "";
      $perpgsel5 = "selected";
   } else {
      $perpg = "10";
      $perpgsel1 = "";
      $perpgsel2 = "selected";
      $perpgsel3 = "";
      $perpgsel4 = "";
      $perpgsel5 = "";
   }      

   // set sortby method & keep option selected
   if ($sortby == "routerid") {
      $sortby = "rid";
      $sortbysel1 = "selected";
      $sortbysel2 = "";
      $sortbysel3 = "";
      $sortbysel4 = "";
   } elseif ($sortby == "routername") {
      $sortby = "rname";
      $sortbysel1 = "";
      $sortbysel2 = "selected";
      $sortbysel3 = "";
      $sortbysel4 = "";
   } elseif ($sortby == "totalvotes") {
      $sortby = "vote_total";
      $sortbysel1 = "";
      $sortbysel2 = "";
      $sortbysel3 = "selected";
      $sortbysel4 = "";
   } elseif ($sortby == "avgrating") {
      $sortby = "vote_avg";
      $sortbysel1 = "";
      $sortbysel2 = "";
      $sortbysel3 = "";
      $sortbysel4 = "selected";
   } else {
      $sortby = "rid";
      $sortbysel1 = "selected";
      $sortbysel2 = "";
      $sortbysel3 = "";
      $sortbysel4 = "";
   }      

   // set sort order method & keep option selected
   if ($sortord == "asc") {
      $sortord = "ASC";
      $sortordsel1 = "selected";
      $sortordsel2 = "";
   } elseif ($sortord == "desc") {
      $sortord = "DESC";
      $sortordsel1 = "";
      $sortordsel2 = "selected";
   } else {
      $sortord = "DESC";
      $sortordsel1 = "";
      $sortordsel2 = "selected";
   }

   // Router List Header
   OpenTable();
   echo "<form action=\"modules.php?name=Routers&amp;file=index&amp;func=OneRouter\" method=\"post\">"
   ."<table width=\"100%\" border=\"0\" cellspacing=\"3\"><tr>"
   ."<td align=\"center\"><a href=\"modules.php?name=Routers&amp;file=index&amp;func=SubmitRouter\">Submit Your Router Design</a></td>"
   ."<td align=\"center\">Jump To ID#: <input type=\"text\" NAME=\"rid\" SIZE=\"10\"></td>"
   ."<td align=\"center\"><input type=\"submit\" value=\"Jump\"></td>"
   ."</tr></table></form>";
   CloseTable();
   echo "<br>";
   
   OpenTable();
   echo "<form action=\"modules.php?name=Routers&amp;file=index\" method=\"post\">"
   ."<table width=\"100%\" border=\"0\" cellspacing=\"3\"><tr>"
   ."<td align=\"center\">Per Page: <select name=\"perpg\">"
   ."<option value=\"5\" $perpgsel1>5</option>"
   ."<option value=\"10\" $perpgsel2>10</option>"
   ."<option value=\"15\" $perpgsel3>15</option>"
   ."<option value=\"20\" $perpgsel4>20</option>"
   ."<option value=\"25\" $perpgsel5>25</option></select></td>"
   
   ."<td align=\"center\">Sort By: <select name=\"sortby\">"
   ."<option value=\"routerid\" $sortbysel1>Router ID</option>"
   ."<option value=\"routername\" $sortbysel2>Router Name</option>"
   ."<option value=\"totalvotes\" $sortbysel3>Total Votes</option>"
   ."<option value=\"avgrating\" $sortbysel4>Avg. Rating</option></select></td>"
    
   ."<td align=\"center\">Sort Order: <select name=\"sortord\">"
   ."<option value=\"asc\" $sortordsel1 >Ascending</option>"
   ."<option value=\"desc\" $sortordsel2 >Descending</option></select></td>"
	
   ."<td align=\"center\"><input type=\"submit\" value=\"Sort\"><td>"
   ."</tr></table></form>";
   CloseTable();
   echo "<br>";

   OpenTable();
   echo "<table width=\"100%\" border=\"0\" cellspacing=\"5\"><tr>$navbar</tr></table>";
   CloseTable();
   echo "<br>";

   $result = sql_query("SELECT * FROM ".$prefix."_routers $qdb $querylang ORDER BY $sortby $sortord limit $start, $perpg", $dbi);
   while (list($rid, $rname, $rauthorname, $rauthoremail, $rsitename, $rsiteurl, $rtime, $rcost, $rsoft, $rcpu, $rram, $rif1, $rif2, $rif3, $rhub, $rdrives, $rnote, $rdetails, $vote_total, $vote_avg) = sql_fetch_row($result, $dbi)) {
      $thumbsize = getimagesize("$maindir/$rid/$thumbdir/$mainpicfile");
      $mainpic = "<a href=\"$maindir/$rid/$mainpicfile\"><img src=\"$maindir/$rid/$thumbdir/$mainpicfile\" border=\"0\" $thumbsize[3] alt=\"\"></a>";
      $morepicslink = "<a href=\"modules.php?name=Routers&amp;file=index&amp;func=MorePics&amp;rid=$rid\">More Pictures</a>";
      $detailslink = "<a href=\"modules.php?name=Routers&amp;file=index&amp;func=Details&amp;rid=$rid\">More Details</a>";
      $voteslink = "<a href=\"modules.php?name=Routers&amp;file=index&amp;func=VoteResults&amp;rid=$rid\">Voting Details</a>";
      // Display the better value of rtime, not the stored one
      $optvalue = array("0-9h", "10-19h", "20-29h", "30-39h", "40-47h", "2-3d", "4-5d", "6-7d", "1-4w", "more1m", "more1y");
      $optname = array("0-9 Hours", "10-19 Hours", "20-29 Hours", "30-39 Hours", "40-47 Hours", "2-3 Days", "4-5 Days", "6-7 Days", "1-4 Weeks", "> 1 Month", "> 1 Year");
      for ($cnt=0; $cnt < sizeof($optvalue); $cnt++) {
         if ($rtime == $optvalue[$cnt]) { $rtime = $optname[$cnt]; }
      }
      // load the themerouters function in theme.php for the routers.html template
      themerouters($rid, $rname, $rauthorname, $rauthoremail, $rsitename, $rsiteurl, $rtime, $rcost, $rsoft, $rcpu, $rram, $rif1, $rif2, $rif3, $rhub, $rdrives, $rnote, $vote_total, $vote_avg, $mainpic, $morepicslink, $detailslink, $voteslink);
   }

   // Router List Footer
   OpenTable();
   echo "<table width=\"100%\" border=\"0\" cellspacing=\"5\"><tr>$navbar</tr></table>";
   CloseTable();
   
   echo "<center><p class=\"copyright\">$copyright</p></center>";
   include("footer.php");
}

function OneRouter($rid) {
   global $dbi, $prefix, $maindir, $thumbdir, $mainpicfile;
   if ($rid !="") {
      include("header.php");
      $result = sql_query("SELECT * FROM ".$prefix."_routers $qdb $querylang WHERE rid like '$rid'", $dbi);
      list($rid, $rname, $rauthorname, $rauthoremail, $rsitename, $rsiteurl, $rtime, $rcost, $rsoft, $rcpu, $rram, $rif1, $rif2, $rif3, $rhub, $rdrives, $rnote, $rdetails, $vote_total, $vote_avg) = sql_fetch_row($result, $dbi);
      $thumbsize = getimagesize("$maindir/$rid/$thumbdir/$mainpicfile");
      $mainpic = "<a href=\"$maindir/$rid/$mainpicfile\"><img src=\"$maindir/$rid/$thumbdir/$mainpicfile\" border=\"0\" $thumbsize[3] alt=\"\"></a>";
      $morepicslink = "<a href=\"modules.php?name=Routers&amp;file=index&amp;func=MorePics&amp;rid=$rid\">More Pictures</a>";
      $detailslink = "<a href=\"modules.php?name=Routers&amp;file=index&amp;func=Details&amp;rid=$rid\">More Details</a>";
      $voteslink = "<a href=\"modules.php?name=Routers&amp;file=index&amp;func=VoteResults&amp;rid=$rid\">Voting Details</a>";
      // Display the better value of rtime, not the stored one
      $optvalue = array("0-9h", "10-19h", "20-29h", "30-39h", "40-47h", "2-3d", "4-5d", "6-7d", "1-4w", "more1m", "more1y");
      $optname = array("0-9 Hours", "10-19 Hours", "20-29 Hours", "30-39 Hours", "40-47 Hours", "2-3 Days", "4-5 Days", "6-7 Days", "1-4 Weeks", "> 1 Month", "> 1 Year");
      for ($cnt=0; $cnt < sizeof($optvalue); $cnt++) {
         if ($rtime == $optvalue[$cnt]) { $rtime = $optname[$cnt]; }
      }
      // load the themerouters function in theme.php for the routers.html template
      themerouters($rid, $rname, $rauthorname, $rauthoremail, $rsitename, $rsiteurl, $rtime, $rcost, $rsoft, $rcpu, $rram, $rif1, $rif2, $rif3, $rhub, $rdrives, $rnote, $vote_total, $vote_avg, $mainpic, $morepicslink, $detailslink, $voteslink);
      include("footer.php");
   } else { Header("Location: modules.php?name=Routers&amp;file=index"); }
}

function MorePics($rid) {
   global $dbi, $prefix, $maindir, $thumbdir, $mainpicfile;
   include("header.php");
   $result = sql_query("SELECT * FROM ".$prefix."_routers $qdb $querylang WHERE rid LIKE '$rid'", $dbi);
   list($rid, $rname, $rauthorname, $rauthoremail, $rsitename, $rsiteurl, $rtime, $rcost, $rsoft, $rcpu, $rram, $rif1, $rif2, $rif3, $rhub, $rdrives, $rnote, $rdetails, $vote_total, $vote_avg) = sql_fetch_row($result, $dbi);
   $thumbsize = getimagesize("$maindir/$rid/$thumbdir/$mainpicfile");
   $mainpic = "<a href=\"$maindir/$rid/$mainpicfile\"><img src=\"$maindir/$rid/$thumbdir/$mainpicfile\" border=\"0\" $thumbsize[3] alt=\"\"></a>";
   $morepicslink = "More Pictures";
   $detailslink = "<a href=\"modules.php?name=Routers&amp;file=index&amp;func=Details&amp;rid=$rid\">More Details</a>";
   $voteslink = "<a href=\"modules.php?name=Routers&amp;file=index&amp;func=VoteResults&amp;rid=$rid\">Voting Details</a>";
   // Display the better value of rtime, not the stored one
   $optvalue = array("0-9h", "10-19h", "20-29h", "30-39h", "40-47h", "2-3d", "4-5d", "6-7d", "1-4w", "more1m", "more1y");
   $optname = array("0-9 Hours", "10-19 Hours", "20-29 Hours", "30-39 Hours", "40-47 Hours", "2-3 Days", "4-5 Days", "6-7 Days", "1-4 Weeks", "> 1 Month", "> 1 Year");
   for ($cnt=0; $cnt < sizeof($optvalue); $cnt++) {
      if ($rtime == $optvalue[$cnt]) { $rtime = $optname[$cnt]; }
   }
   // load the themerouters function in theme.php for the routers.html template
   themerouters($rid, $rname, $rauthorname, $rauthoremail, $rsitename, $rsiteurl, $rtime, $rcost, $rsoft, $rcpu, $rram, $rif1, $rif2, $rif3, $rhub, $rdrives, $rnote, $vote_total, $vote_avg, $mainpic, $morepicslink, $detailslink, $voteslink);
 
   OpenTable();
   echo "<div align=\"center\">";
   echo "<p>More pictures of $rname</p>\n";
   // Router Picture counter, to show each router picture avaiable
   $handle = opendir("$maindir/$rid");
   while ($file = readdir($handle)) {
      if ( (ereg("^([0-9a-z]+)([.]{1})([a-z0-9]{3})$", $file)) ) {$piclist .= "$file ";}
   }
   closedir($handle);
   $piclist = explode(" ", $piclist);
   sort($piclist);
   for ($cnt=1; $cnt <= sizeof($piclist); $cnt++){
      if($piclist[$cnt]!="") {
         $thumbsize = getimagesize("$maindir/$rid/$thumbdir/$piclist[$cnt]");
         echo "<a href=\"$maindir/$rid/$piclist[$cnt]\"><img src=\"$maindir/$rid/$thumbdir/$piclist[$cnt]\" vspace=\"3\" hspace=\"2\" border=\"0\" $thumbsize[3] alt=\"\"></a>\n";
      }
   }
   echo "</div>";
   CloseTable();
   include("footer.php");
}

function Details($rid) {
   global $dbi, $prefix, $maindir, $thumbdir, $mainpicfile;
   include("header.php");
   $result = sql_query("SELECT * FROM ".$prefix."_routers $qdb $querylang WHERE rid LIKE '$rid'", $dbi);
   list($rid, $rname, $rauthorname, $rauthoremail, $rsitename, $rsiteurl, $rtime, $rcost, $rsoft, $rcpu, $rram, $rif1, $rif2, $rif3, $rhub, $rdrives, $rnote, $rdetails, $vote_total, $vote_avg) = sql_fetch_row($result, $dbi);
   $thumbsize = getimagesize("$maindir/$rid/$thumbdir/$mainpicfile");
   $mainpic = "<a href=\"$maindir/$rid/$mainpicfile\"><img src=\"$maindir/$rid/$thumbdir/$mainpicfile\" border=\"0\" $thumbsize[3] alt=\"\"></a>";
   $morepicslink = "<a href=\"modules.php?name=Routers&amp;file=index&amp;func=MorePics&amp;rid=$rid\">More Pictures</a>";
   $detailslink = "More Details";
   $voteslink = "<a href=\"modules.php?name=Routers&amp;file=index&amp;func=VoteResults&amp;rid=$rid\">Voting Details</a>";
   // Display the better value of rtime, not the stored one
   $optvalue = array("0-9h", "10-19h", "20-29h", "30-39h", "40-47h", "2-3d", "4-5d", "6-7d", "1-4w", "more1m", "more1y");
   $optname = array("0-9 Hours", "10-19 Hours", "20-29 Hours", "30-39 Hours", "40-47 Hours", "2-3 Days", "4-5 Days", "6-7 Days", "1-4 Weeks", "> 1 Month", "> 1 Year");
   for ($cnt=0; $cnt < sizeof($optvalue); $cnt++) {
      if ($rtime == $optvalue[$cnt]) { $rtime = $optname[$cnt]; }
   }
   // load the themerouters function in theme.php for the routers.html template
   themerouters($rid, $rname, $rauthorname, $rauthoremail, $rsitename, $rsiteurl, $rtime, $rcost, $rsoft, $rcpu, $rram, $rif1, $rif2, $rif3, $rhub, $rdrives, $rnote, $vote_total, $vote_avg, $mainpic, $morepicslink, $detailslink, $voteslink);

   OpenTable();
   echo "<div align=\"center\"><p>More Details of $rname</p></div>\n";
   echo "$rdetails";
   CloseTable();
   include("footer.php");
}

function VoteRouter($rid, $rvote) {
   global $prefix, $dbi;
   $result = sql_query("SELECT vote_total, vote_1, vote_2, vote_3, vote_4, vote_5, vote_6, vote_7, vote_8, vote_9, vote_10 FROM ".$prefix."_routers $qdb $querylang WHERE rid LIKE '$rid'", $dbi);
   list($vote_total, $vote_1, $vote_2, $vote_3, $vote_4, $vote_5, $vote_6, $vote_7, $vote_8, $vote_9, $vote_10) = sql_fetch_row($result, $dbi);
   if ($rvote == "1") { $vote_1++; }
   elseif ($rvote == "2") { $vote_2++; }
   elseif ($rvote == "3") { $vote_3++; }
   elseif ($rvote == "4") { $vote_4++; }
   elseif ($rvote == "5") { $vote_5++; }
   elseif ($rvote == "6") { $vote_6++; }
   elseif ($rvote == "7") { $vote_7++; }
   elseif ($rvote == "8") { $vote_8++; }
   elseif ($rvote == "9") { $vote_9++; }
   elseif ($rvote == "10") { $vote_10++; }
   else { echo "Error: No vote value"; }
   $vote_total++;
   // calculate average rating (substr used instead of round so compatible with older versions of php)
   // $vote_avg = substr((($vote_1 * 1) + ($vote_2 * 2) + ($vote_3 * 3) + ($vote_4 * 4) + ($vote_5 * 5) + ($vote_6 * 6) + ($vote_7 * 7) + ($vote_8 * 8) + ($vote_9 * 9) + ($vote_10 * 10)) / $vote_total, 0, 3);
   $vote_avg = round((($vote_1 * 1) + ($vote_2 * 2) + ($vote_3 * 3) + ($vote_4 * 4) + ($vote_5 * 5) + ($vote_6 * 6) + ($vote_7 * 7) + ($vote_8 * 8) + ($vote_9 * 9) + ($vote_10 * 10)) / $vote_total, 3);
   sql_query("update ".$prefix."_routers set vote_total='$vote_total', vote_avg='$vote_avg', vote_1='$vote_1', vote_2='$vote_2', vote_3='$vote_3', vote_4='$vote_4', vote_5='$vote_5', vote_6='$vote_6', vote_7='$vote_7', vote_8='$vote_8', vote_9='$vote_9', vote_10='$vote_10' where rid='$rid'", $dbi);
   Header("Location: modules.php?name=Routers&file=index&func=VoteResults&rid=$rid");
}

function VoteResults($rid) {
   global $dbi, $prefix, $maindir, $thumbdir, $mainpicfile;
   include("header.php");
   $result = sql_query("SELECT * FROM ".$prefix."_routers $qdb $querylang WHERE rid LIKE '$rid'", $dbi);
   list($rid, $rname, $rauthorname, $rauthoremail, $rsitename, $rsiteurl, $rtime, $rcost, $rsoft, $rcpu, $rram, $rif1, $rif2, $rif3, $rhub, $rdrives, $rnote, $rdetails, $vote_total, $vote_avg, $vote_1, $vote_2, $vote_3, $vote_4, $vote_5, $vote_6, $vote_7, $vote_8, $vote_9, $vote_10) = sql_fetch_row($result, $dbi);
   $thumbsize = getimagesize("$maindir/$rid/$thumbdir/$mainpicfile");
   $mainpic = "<a href=\"$maindir/$rid/$mainpicfile\"><img src=\"$maindir/$rid/$thumbdir/$mainpicfile\" border=\"0\" $thumbsize[3] alt=\"\"></a>";
   $morepicslink = "<a href=\"modules.php?name=Routers&amp;file=index&amp;func=MorePics&amp;rid=$rid\">More Pictures</a>";
   $detailslink = "<a href=\"modules.php?name=Routers&amp;file=index&amp;func=Details&amp;rid=$rid\">More Details</a>";
   $voteslink = "Voting Details";
   // Display the better value of rtime, not the stored one
   $optvalue = array("0-9h", "10-19h", "20-29h", "30-39h", "40-47h", "2-3d", "4-5d", "6-7d", "1-4w", "more1m", "more1y");
   $optname = array("0-9 Hours", "10-19 Hours", "20-29 Hours", "30-39 Hours", "40-47 Hours", "2-3 Days", "4-5 Days", "6-7 Days", "1-4 Weeks", "> 1 Month", "> 1 Year");
   for ($cnt=0; $cnt < sizeof($optvalue); $cnt++) {
      if ($rtime == $optvalue[$cnt]) { $rtime = $optname[$cnt]; }
   }
   // load the themerouters function in theme.php for the routers.html template
   themerouters($rid, $rname, $rauthorname, $rauthoremail, $rsitename, $rsiteurl, $rtime, $rcost, $rsoft, $rcpu, $rram, $rif1, $rif2, $rif3, $rhub, $rdrives, $rnote, $vote_total, $vote_avg, $mainpic, $morepicslink, $detailslink, $voteslink);
 
   OpenTable();
   echo "<div align=\"center\"><p>Vote Results of $rname</p><br>\n";
   echo "<table cellspacing=\"0\" cellpadding=\"2\" border=\"0\" align=\"center\">\n";
   echo "<tr><td width=\"40\"><b>Rating</b></td><td width=\"30\" align=\"right\"><b>%</b></td><td width=\"30\" align=\"center\"><b>Votes</b></td><td>&nbsp;<td></tr>\n";
   if ($vote_total != "0") {$perbarsize = substr(100 * $vote_1 / $vote_total, 0, 4);}
   echo "<tr><td><img src=\"images/routerscript/vote1.gif\" border=\"0\" alt=\"\">&nbsp;1: </td><td align=\"right\">$perbarsize</td><td align=\"center\">$vote_1</td><td><img src=\"images/routerscript/bar_left.gif\" height=\"11\" width=\"3\" alt=\"\"><img src=\"images/routerscript/bar_mid.gif\" height=\"11\" width=", $perbarsize * 2, " alt=\"\"><img src=\"images/routerscript/bar_right.gif\" height=\"11\" width=\"3\" alt=\"\"></td></tr>\n";
   if ($vote_total != "0") {$perbarsize = substr(100 * $vote_2 / $vote_total, 0, 4);}
   echo "<tr><td><img src=\"images/routerscript/vote2.gif\" border=\"0\" alt=\"\">&nbsp;2: </td><td align=\"right\">$perbarsize</td><td align=\"center\">$vote_2</td><td><img src=\"images/routerscript/bar_left.gif\" height=\"11\" width=\"3\" alt=\"\"><img src=\"images/routerscript/bar_mid.gif\" height=\"11\" width=", $perbarsize * 2, " alt=\"\"><img src=\"images/routerscript/bar_right.gif\" height=\"11\" width=\"3\" alt=\"\"></td></tr>\n";
   if ($vote_total != "0") {$perbarsize = substr(100 * $vote_3 / $vote_total, 0, 4);}
   echo "<tr><td><img src=\"images/routerscript/vote3.gif\" border=\"0\" alt=\"\">&nbsp;3: </td><td align=\"right\">$perbarsize</td><td align=\"center\">$vote_3</td><td><img src=\"images/routerscript/bar_left.gif\" height=\"11\" width=\"3\" alt=\"\"><img src=\"images/routerscript/bar_mid.gif\" height=\"11\" width=", $perbarsize * 2, " alt=\"\"><img src=\"images/routerscript/bar_right.gif\" height=\"11\" width=\"3\" alt=\"\"></td></tr>\n";
   if ($vote_total != "0") {$perbarsize = substr(100 * $vote_4 / $vote_total, 0, 4);}
   echo "<tr><td><img src=\"images/routerscript/vote4.gif\" border=\"0\" alt=\"\">&nbsp;4: </td><td align=\"right\">$perbarsize</td><td align=\"center\">$vote_4</td><td><img src=\"images/routerscript/bar_left.gif\" height=\"11\" width=\"3\" alt=\"\"><img src=\"images/routerscript/bar_mid.gif\" height=\"11\" width=", $perbarsize * 2, " alt=\"\"><img src=\"images/routerscript/bar_right.gif\" height=\"11\" width=\"3\" alt=\"\"></td></tr>\n";
   if ($vote_total != "0") {$perbarsize = substr(100 * $vote_5 / $vote_total, 0, 4);}
   echo "<tr><td><img src=\"images/routerscript/vote5.gif\" border=\"0\" alt=\"\">&nbsp;5: </td><td align=\"right\">$perbarsize</td><td align=\"center\">$vote_5</td><td><img src=\"images/routerscript/bar_left.gif\" height=\"11\" width=\"3\" alt=\"\"><img src=\"images/routerscript/bar_mid.gif\" height=\"11\" width=", $perbarsize * 2, " alt=\"\"><img src=\"images/routerscript/bar_right.gif\" height=\"11\" width=\"3\" alt=\"\"></td></tr>\n";
   if ($vote_total != "0") {$perbarsize = substr(100 * $vote_6 / $vote_total, 0, 4);}
   echo "<tr><td><img src=\"images/routerscript/vote6.gif\" border=\"0\" alt=\"\">&nbsp;6: </td><td align=\"right\">$perbarsize</td><td align=\"center\">$vote_6</td><td><img src=\"images/routerscript/bar_left.gif\" height=\"11\" width=\"3\" alt=\"\"><img src=\"images/routerscript/bar_mid.gif\" height=\"11\" width=", $perbarsize * 2, " alt=\"\"><img src=\"images/routerscript/bar_right.gif\" height=\"11\" width=\"3\" alt=\"\"></td></tr>\n";
   if ($vote_total != "0") {$perbarsize = substr(100 * $vote_7 / $vote_total, 0, 4);}
   echo "<tr><td><img src=\"images/routerscript/vote7.gif\" border=\"0\" alt=\"\">&nbsp;7: </td><td align=\"right\">$perbarsize</td><td align=\"center\">$vote_7</td><td><img src=\"images/routerscript/bar_left.gif\" height=\"11\" width=\"3\" alt=\"\"><img src=\"images/routerscript/bar_mid.gif\" height=\"11\" width=", $perbarsize * 2, " alt=\"\"><img src=\"images/routerscript/bar_right.gif\" height=\"11\" width=\"3\" alt=\"\"></td></tr>\n";
   if ($vote_total != "0") {$perbarsize = substr(100 * $vote_8 / $vote_total, 0, 4);}
   echo "<tr><td><img src=\"images/routerscript/vote8.gif\" border=\"0\" alt=\"\">&nbsp;8: </td><td align=\"right\">$perbarsize</td><td align=\"center\">$vote_8</td><td><img src=\"images/routerscript/bar_left.gif\" height=\"11\" width=\"3\" alt=\"\"><img src=\"images/routerscript/bar_mid.gif\" height=\"11\" width=", $perbarsize * 2, " alt=\"\"><img src=\"images/routerscript/bar_right.gif\" height=\"11\" width=\"3\" alt=\"\"></td></tr>\n";
   if ($vote_total != "0") {$perbarsize = substr(100 * $vote_9 / $vote_total, 0, 4);}
   echo "<tr><td><img src=\"images/routerscript/vote9.gif\" border=\"0\" alt=\"\">&nbsp;9: </td><td align=\"right\">$perbarsize</td><td align=\"center\">$vote_9</td><td><img src=\"images/routerscript/bar_left.gif\" height=\"11\" width=\"3\" alt=\"\"><img src=\"images/routerscript/bar_mid.gif\" height=\"11\" width=", $perbarsize * 2, " alt=\"\"><img src=\"images/routerscript/bar_right.gif\" height=\"11\" width=\"3\" alt=\"\"></td></tr>\n";
   if ($vote_total != "0") {$perbarsize = substr(100 * $vote_10 / $vote_total, 0, 4);}
   echo "<tr><td><img src=\"images/routerscript/vote10.gif\" border=\"0\" alt=\"\">&nbsp;10: </td><td align=\"right\">$perbarsize</td><td align=\"center\">$vote_10</td><td><img src=\"images/routerscript/bar_left.gif\" height=\"11\" width=\"3\" alt=\"\"><img src=\"images/routerscript/bar_mid.gif\" height=\"11\" width=", $perbarsize * 2, " alt=\"\"><img src=\"images/routerscript/bar_right.gif\" height=\"11\" width=\"3\" alt=\"\"></td></tr>\n";
   echo "</table><br>";
   echo "Total Votes: $vote_total<br>";

   if ($vote_total != "0") { echo "Average Rating: $vote_avg</div>";}
   else { echo "Average Rating: N/A</div>"; }
   CloseTable();
   include("footer.php");
}

function SubmitRouter() {
   include("header.php");
   opentable();
   ?>
   <p>Note: Please do not submit your router if its just an everyday 
   looking computer case! It has to have some kind of modification 
   to make it stand out!</p>
   <p><b>How to submit a router design to RDP </b> </p>
   <ol>
      <li><a href="downloads/rdp/rdp_submit.zip">Download this file</a> to a temporary directory.</li>
      <li>Unzip / uncompress it using a tool such as <a href="http://www.winzip.com">Winzip</a></li>
      <li>Open and follow the instructions in the readme.html file included.</li>
      <li>Email your final package to the <a href="mailto:webmaster@routerdesign.com?Subject=Here's My Router">RDP Webmaster</a></li>
      <li>Thank You for submitting your design!!</li>
   </ol>
   <?php
   closetable();
   include("footer.php");
}

switch($func) {

    default:
    RouterList($perpg, $sortby, $sortord, $page);
    break;
    
    case "OneRouter":
    OneRouter($rid);
    break;

    case "MorePics":
    MorePics($rid);
    break;

    case "Details":
    Details($rid);
    break;

    case "VoteRouter":
    VoteRouter($rid, $rvote);
    break;

    case "VoteResults":
    VoteResults($rid);
    break;
    
    case "SubmitRouter":
    SubmitRouter($ok);
    break;
}

?>