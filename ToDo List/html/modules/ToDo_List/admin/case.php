<?php

/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

//############################################
// To Do List v1.2 for PHP-Nuke  7.6
// By: Wes Brewer (nd3@routerdesign.com)
// http://www.routerdesign.com
// Copyright @ 2003-2005 by Wes Brewer
//############################################

if ( !defined('ADMIN_FILE') )
{
	die("Illegal File Access");
}

$module_name = "ToDo_List";

switch($op) {

    case "ShowTodos":
    case "AddTodo":
    case "EditTodo":
    case "SaveTodo":
    case "UpdateTodo":
    case "DeleteTodo":
    case "ClearFinTodos":
    @include("modules/$module_name/admin/index.php");
    break;

}

?>
