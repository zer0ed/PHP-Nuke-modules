<?php
/********************************************/
/* QScrollBlocks v1.1 for PHP-Nuke 5.6      */
/* By: Wes Brewer (nd3@routerdesign.com)    */
/* http://www.routerdesign.com              */
/* Copyright © 2003 by Wes Brewer           */
/********************************************/

//#######################[ USER Config/Setup ]##############################

$iblockfile = "block-Modules.php";        // Blockfile to use for content (filename.ext)
$ibgcolour = "CCCCCC";                    // Background colour to use (RRGGBB)
$ibgimage = "null";                       // Background Image to use (URL, "null" for none)
$iwidth = "123";                          // Width of the sidebar (about 15 pixels less then your theme)
$iheight = "150";                         // Height of the sidebar
$iscrollspeed = "1";                      // Auto-scroll speed to use (higher is faster)
$iscrollbars = "2";                       // Manual scroll bars? (2=auto, 1=yes, 0=no)
$iframeborder = "0";                      // Frame Boarder? (1=yes, 0=no)


//######################[ Main Code, dont touch ]#############################

// get content from original block
include("blocks/$iblockfile");

// move $content from original block to a new variable
$noiframe_content = $content;

// set proper scrollbars code
if ( $iscrollbars == "2" ) {
  $iscrollbars = "auto";
} elseif ( $iscrollbars == "1" ) {
  $iscrollbars = "yes";
} else {
  $iscrollbars = "no";
}

// make iwidth smaller if frameborder is shown
if ( $iframeborder == "1" ) {
  $iwidth = ( $iwidth-2 );
}

// create <IFRAME> and noiframe content
$content = "<iframe src=\"scroll.php?iblockfile=$iblockfile&amp;ibgcolour=$ibgcolour&amp;ibgimage=$ibgimage&amp;iscrollspeed=$iscrollspeed\" width=\"$iwidth\" height=\"$iheight\" marginwidth=\"0\" marginheight=\"0\" hspace=\"0\" vspace=\"0\" frameborder=\"$iframeborder\" scrolling=\"$iscrollbars\">";
$content .= "$noiframe_content</iframe>";

?>