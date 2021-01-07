<?php

/************************************************************/
/* OpenTable Functions                                      */
/*                                                          */
/* OpenTable has a 100% width and OpenTable2 has a width    */
/* according with the table content                         */
/************************************************************/

function OpenTable() {
   echo "<table class=\"block-border\" width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">\n";
   echo "<tr><td class=\"block-body\">\n";
}

function OpenTable2() {
   echo "<table class=\"block-border\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\" align=\"center\">\n";
   echo "<tr><td class=\"block-body\">\n";
}

function CloseTable() {
   echo "</td></tr></table>\n";
}

function CloseTable2() {
   echo "</td></tr></table>\n";
}

?>