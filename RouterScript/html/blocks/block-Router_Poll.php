<?php

/********************************************/
/* RouterScript 1.5 for PHP-Nuke 5.5.0     */
/* By: Wes Brewer (nd3@routerdesign.com)    */
/* http://www.routerdesign.com              */
/* Copyright © 2002 by Wes Brewer           */
/********************************************/

if (eregi("block-Router_Poll.php",$PHP_SELF)) {
    Header("Location: index.php");
    die();
}

//globals
global $prefix, $dbi;

// get user settings
include("modules/Routers/rs_config.php");

// get list of pics to work with!
// get all subdirectories under routers maindir.
$handle = opendir("$maindir");
while ($rdir = readdir($handle)) {
   if ( (ereg("^([0-9a-z]+)$", $rdir)) ) {$rdirlist .= "$rdir ";}
}
closedir($handle);
$rdirlist = explode(" ", $rdirlist);
sort($rdirlist);

// get random router
srand((double)microtime()*1000000);
$randrouter = rand($rdirlist[1], sizeof($rdirlist) - 1);

// get vote data for selected random router
$result = sql_query("SELECT vote_total, vote_1, vote_2, vote_3, vote_4, vote_5, vote_6, vote_7, vote_8, vote_9, vote_10 FROM ".$prefix."_routers $qdb $querylang WHERE rid LIKE '$randrouter'", $dbi);
list($vote_total, $vote_1, $vote_2, $vote_3, $vote_4, $vote_5, $vote_6, $vote_7, $vote_8, $vote_9, $vote_10) = sql_fetch_row($result, $dbi);

$vthumbsize = getimagesize("$maindir/$randrouter/$thumbdir/$mainpicfile");
$content = "<center><a href=\"modules.php?name=Routers&amp;file=index&amp;func=OneRouter&amp;rid=$randrouter\">Router ID: $randrouter</a><br>";
$content .= "<a href=\"$maindir/$randrouter/$mainpicfile\"><img src=\"$maindir/$randrouter/$thumbdir/$mainpicfile\" border=\"0\" ($vthumbsize[3])></a><br>";
$content .= "Rate this router:<br>";

// table used to display properly in a non-image browser
$content .= "<table width=\"120\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr>";
// display all voting images 1 to 10
for ($cnt=1; $cnt<=10; $cnt++) {
   $voteimg = "vote" . "$cnt" . ".gif";
   $content .= "<td width=\"12\" height=\"13\" valign=\"middle\" align=\"center\"><a href=\"modules.php?name=Routers&amp;file=index&amp;func=VoteRouter&amp;rid=$randrouter&amp;rvote=$cnt\"><img src=\"images/routerscript/$voteimg\" alt=\"\" border=\"0\" height=\"13\" width=\"11\"></a></td>\n";
}
$content .= "</tr></table>";

// display voting details if any
if ($vote_total != "0") {
   // calculate average rating (substr used instead of round so compatible with older versions of php)
   $voteavg = substr((($vote_1 * 1) + ($vote_2 * 2) + ($vote_3 * 3) + ($vote_4 * 4) + ($vote_5 * 5) + ($vote_6 * 6) + ($vote_7 * 7) + ($vote_8 * 8) + ($vote_9 * 9) + ($vote_10 * 10)) / $vote_total, 0, 3);

   $content .= "<br>Total Votes: $vote_total<br>";
   $content .= "Average Rating: $voteavg<br>";
   $content .= "</center>";
} else {
   $content .= "<br>No voting data available, be the first to vote!";
   $content .= "</center>";
}

?>