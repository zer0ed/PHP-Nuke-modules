<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

//############################################
// To Do List v1.2 for PHP-Nuke 7.6
// By: Wes Brewer (nd3@routerdesign.com)
// http://www.routerdesign.com
// Copyright @ 2003-2005 by Wes Brewer
//############################################

if ( !defined('ADMIN_FILE') )
{
	die("Illegal File Access");
}
global $admin_file;
adminmenu("".$admin_file.".php?op=ShowTodos", "ToDo List", "ToDo_List.gif");

?>