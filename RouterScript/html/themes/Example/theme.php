<?php

/* Function themerouters()  */

function themerouters ($rid, $rname, $rauthorname, $rauthoremail, $rsitename, $rsiteurl, $rtime, $rcost, $rsoft, $rcpu, $rram, $rif1, $rif2, $rif3, $rhub, $rdrives, $rnote, $vote_total, $vote_avg, $mainpic, $morepicslink, $detailslink, $voteslink) {
    global $anonymous, $tipath;

    $tmpl_file = "themes/RDP-Purple/routers.html";
    $thefile = implode("", file($tmpl_file));
    $thefile = addslashes($thefile);
    $thefile = "\$r_file=\"".$thefile."\";";
    eval($thefile);
    print $r_file;
}


?>