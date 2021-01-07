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
// To Do List v1.0b for PHP-Nuke 6.5 - 6.7
// By: Wes Brewer (nd3@routerdesign.com)
// http://www.routerdesign.com
// Copyright @ 2003 by Wes Brewer
//############################################


if (!eregi("admin.php", $_SERVER['PHP_SELF'])) { die ("Access Denied"); }

switch($op) {

    case "ShowTodos":
    case "AddTodo":
    case "EditTodo":
    case "SaveTodo":
    case "UpdateTodo":
    case "DeleteTodo":
    case "ClearFinTodos":
    include ("admin/modules/todo.php");
    break;

}

?>
