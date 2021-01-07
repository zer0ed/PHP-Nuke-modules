<?php

/********************************************/
/* ThemeStats v1.0 for PHP-Nuke 6.x         */
/* By: Wes Brewer (nd3@routerdesign.com)    */
/* http://www.routerdesign.com              */
/* Copyright © 2004-2005 by Wes Brewer      */
/********************************************/

if (!eregi("modules.php", $PHP_SELF)) {
    die ("You can't access this file directly...");
}

// rightside blocks on
$index = 1;

// Main Code
function ThemeStats() {
    global $dbi, $prefix;
    include("header.php");
    
    $total2 = 0;
    $query2=sql_query("SELECT user_regdate FROM ".$prefix."_users where user_id !='1' ", $dbi);
    while(list($ti) = sql_fetch_row($query2, $dbi)){
        $total2++;
    }

    OpenTable();
    echo "<table width=100% cellspacing=\"0\" cellpadding=\"4\" border=\"0\" align=\"center\"><tr><td colspan=\"4\">\n";
    echo "<center><b>Theme Statisitcs</b></center><br></td></tr>\n";
    echo "<tr><td width=\"30%\"><b>Theme</b></td><td align=\"right\" width=\"20\"><b>%</b></td><td align=\"center\" width=\"20\"><b>&nbsp;&nbsp;Users</b></td><td align=\"center\" width=\"70%\"><b>% Bar</b></td></tr>\n";
    // Open themes dir and make themes list
    $handle=opendir('themes');
    while ($file = readdir($handle)) {
        if ( (!ereg("[.]",$file)) ) {
            $themes .= "$file ";
        }
    }
    closedir($handle);
    $themes = explode(" ", $themes);
    sort($themes);
    
    for ($i=0; $i < sizeof($themes); $i++) {
        $uthemes = 0;
        $utheme = sql_query("select theme from ".$prefix."_users where theme='$themes[$i]' and  user_id !='1'", $dbi);
        while (list($theme) = sql_fetch_row($utheme, $dbi)) {
            $uthemes++;
        }
        if ($themes[$i] == ""){
            $themes[$i] = "Default Theme";
            $themedir = "modules/ThemeStats/images";
        } else {
            $themedir = "themes/$themes[$i]/images";
        }
        if ( $total2 !=0){
            echo "<tr><td width=15%>$themes[$i]:</td><td width=6% align=\"right\">".round((100*$uthemes)/$total2,2)."</td><td  align=\"right\"> $uthemes </td><td width=79%>".mk_percbar(round((100*$uthemes)/$total2,0),100,$themedir)."</td></tr>\n";
        }else{
            echo "<tr><td width=15%>$themes[$i]:</td><td width=6% align=\"right\">0</td><td  align=\"right\"> $uthemes </td><td width=79%>".mk_percbar(0,100,$themedir)."</td></tr>\n";
        }
    }
    echo "</table>\n";
    
    CloseTable();
    include("footer.php");
}
 
// code to build percent bar
function mk_percbar($pperc,$width=100,$themedir) {
    $pperc=round($pperc,0);
    $ipperc=100-$pperc;
    if($pperc==100) { $what="<table width=$width% height=11 border=0 cellspacing=0 cellpadding=0><tr><td align=\"right\"><img src=\"$themedir/leftbar.gif\" height=\"11\" width=\"3\"></td><td width=\"100%\" background=\"$themedir/mainbar.gif\"></td><td width=\"$ipperc%\" align=\"left\"><img src=\"$themedir/rightbar.gif\" height=\"11\" width=\"3\"></td></tr></table>"; }
    elseif($pperc==0) { $what="<table width=$width% height=11 border=0 cellspacing=0 cellpadding=0><tr><td width=\"100%\"><img src=\"$themedir/leftbar.gif\" height=\"11\" width=\"3\"><img src=\"$themedir/rightbar.gif\" height=\"11\" width=\"3\"></td></tr></table>"; }
    else {
    if($pperc >= 70){
    $pperc = $pperc-6;
    $ipperc = $ipperc+6;
    }
    $what="<table width=$width% height=11 border=0 cellspacing=0 cellpadding=0><tr><td align=\"right\"><img src=\"$themedir/leftbar.gif\" height=\"11\" width=\"3\"></td><td width=\"$pperc%\" background=\"$themedir/mainbar.gif\"></td><td width=\"$ipperc%\" align=\"left\"><img src=\"$themedir/rightbar.gif\" height=\"11\" width=\"3\"></td></tr></table>";
    }
 return $what;
}


switch($func) {
    default:
    ThemeStats();
    break;
}

?>
