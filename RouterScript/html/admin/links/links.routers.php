<?php

/********************************************/
/* RouterScript 0.4b for PHP-Nuke 5.5.0     */
/* By: Wes Brewer (nd3@routerdesign.com)    */
/* http://www.routerdesign.com              */
/* Copyright © 2002 by Wes Brewer           */
/********************************************/

if (($radminsuper==1) OR ($radminency==1)) {
    adminmenu("admin.php?op=routers", "Edit Routers", "routers.gif");
}
	
?>