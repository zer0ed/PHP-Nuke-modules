<?php

/********************************************/
/* RouterScript 0.4b for PHP-Nuke 5.5.0     */
/* By: Wes Brewer (nd3@routerdesign.com)    */
/* http://www.routerdesign.com              */
/* Copyright © 2002 by Wes Brewer           */
/********************************************/

if (!eregi("admin.php", $PHP_SELF)) { die ("Access Denied"); }

switch($op) {

    case "routers":
    case "router_edit":
    case "router_delete":
    case "router_save":
    case "router_save_edit":
    case "router_approve":
    case "router_deny":
    include("admin/modules/routers.php");
    break;

}

?>