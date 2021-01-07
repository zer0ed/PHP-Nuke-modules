<?php
/********************************************/
/* QScrollBlocks v1.2 for PHP-Nuke 6.x      */
/* By: Wes Brewer (nd3@routerdesign.com)    */
/* http://www.routerdesign.com              */
/* Copyright © 2003-2005 by Wes Brewer      */
/********************************************/

// check for direct access
if (isset($iblockfile) && $iblockfile != "" ) {

// Grab phpnuke variables
require_once("mainfile.php");

// Include the original block-file, grab $contents
include("blocks/$iblockfile");

// Load users selected theme, or else default theme
if (is_user($user)) {
  $user2 = base64_decode($user);
  $cookie = explode(':', $user2);
  if ($cookie[9]=='') {
    $cookie[9]=$Default_Theme;
  }
  if (isset ($theme)) {
    $cookie[9]=$theme;
  }
  if (!$file=@opendir("themes/$cookie[9]")) {
    $ThemeSel = $Default_Theme;
  } else {
    $ThemeSel = $cookie[9];
  }
} else {
  $ThemeSel = $Default_Theme;
}

// Create new page for iframe
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">\n"
    ."<html>\n"
    ."<head>\n"
    // load followed links in top window
    ."<BASE target=\"_top\">"
    // load selected theme CSS
    ."<LINK REL=\"StyleSheet\" HREF=\"themes/$ThemeSel/style/style.css\" TYPE=\"text/css\">\n\n"

    // force body style user settings (override theme CSS)
    ."<style>\n"
    ."<!--\n"
    ."body { background-color : #$ibgcolour ;\n"
    ." background-image : url($ibgimage) ;\n"
    ."}\n"
    ."-->\n"
    ."</style>\n\n"

    // Javascript scroll code
    ."<!-- The following JavaScript code is originally from\n"
    ." the Crossnuke project found @ http://lophas.phpwebhosting.com -->\n"
    ."<!-- This version is barely modified by Wes Brewer [nd3] -->\n"
    ."<script language=\"JavaScript\" type=\"text/javascript\">\n"
    ."<!--\n";

    // Scroll mode (start code)
    if ( $iscrollmode == "0" ) {
        echo "var sspeed = 0;\n";
    } elseif ( $iscrollmode == "1" ) {
        echo "var sspeed = 1;\n";
    } elseif ( $iscrollmode == "2" ) {
        echo "var sspeed = 1;\n";
    } elseif ( $iscrollmode == "3" ) {
        echo "var sspeed = 1;\n";
    }
    
    // scroll by x pixels each time
    echo "var scrollAmount = $iscrollspeed;\n"
    // number of milliseconds between scrolls
    ."var scrollInterval = 25;\n"
    ."var documentYposition = 0;\n"
    ."var documentXposition = 0;\n"
    // workaround for Internet Explorer
    ."var lastScrollTop = 0;\n\n"

    ."function getWindowYOffsetSpy() {\n"
    ."  if ( window.pageYOffset || window.pageYOffset == 0 )\n"
    ."    return window.pageYOffset;\n"
    ."  if ( document.body.scrollTop || document.body.scrollTop == 0 )\n"
    ."    return document.body.scrollTop;\n"
    ."}\n\n"

    ."function getWindowXOffsetSpy() {\n"
    ."  if ( window.pageXOffset || window.pageXOffset == 0 )\n"
    ."    return window.pageXOffset;\n"
    ."  if ( document.body.scrollTop || document.body.scrollTop == 0 )\n"
    ."    return document.body.scrollTop;\n"
    ."}\n\n"

    ."function autoScroll() {\n"
    ."  if (sspeed == 1)\n"
    ."  {\n"
    ."    documentYposition = getWindowYOffsetSpy() + scrollAmount;\n"
    ."    documentXposition = getWindowXOffsetSpy();\n"
    ."    lastScrollTop = getWindowYOffsetSpy();\n"
    ."    window.scroll(0,documentYposition);\n"
    ."  if (getWindowYOffsetSpy() == lastScrollTop || getWindowYOffsetSpy() == 0)\n"
    ."  {\n"
    ."    scrollAmount *= -1;\n"
    ."    scrolltim=500;\n"
    ."  }\n"
    ."  else\n"
    ."    scrolltim=scrollInterval;\n"
    ."  }\n"
    ."  setTimeout('autoScroll()',scrolltim);\n"
    ."}\n"
    ."//-->\n"
    ."</script>\n"
    ."</head>\n\n"

    // on page load, start autoscroll code    
    ."<body onLoad=\"autoScroll();\">\n"
    // table for Opera 5 onmouseout bug
    ."<table border=\"0\" cellpadding=\"1\" cellspacing=\"0\"><tr><td>\n";
    // Scroll mode (mouseover code)
    if ( $iscrollmode == "1" ) {
        // when mouse moves over block, stop scrolling permanently
        echo "<div onmouseover=\"sspeed=0\">\n";
    } elseif ( $iscrollmode == "2" ) {
        // while mouse is over block, stop scrolling then continue when mouse is removed
        echo "<div onmouseover=\"sspeed=0\" onmouseout=\"sspeed=1\">\n";
    }    

    echo "$content\n"
    ."</div>\n"
    ."</td></tr></table>\n"
    ."</body>\n"
    ."</html>";

// End check for direct access
} else { die ("Access Denied"); }

?>
