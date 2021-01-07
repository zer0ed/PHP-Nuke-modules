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

// copyright footer
function mycopyright() {
    echo "<br>";
    OpenTable();
    echo "<center>To Do List v1.0b - Copyright 2003, Wes Brewer [nd3]<br><a href=\"http://www.routerdesign.com\" target=\"_blank\">http://www.routerdesign.com</a></center>";
    CloseTable();
}

//###############################################
//      Show Todo List (Main Function)
//###############################################
function ShowTodos($sortby, $username) {
    global $prefix, $db, $sitename, $aid;
    // assign default sortby order
    if ( !isset($sortby) ) { $sortby = "priority"; }
    // assign default todo list for all users
    if ( !isset($username) ) { $username = "all"; }
    // Date Format
    $todays_date = gmdate("Y-m-d");
    include ("header.php");
    GraphicAdmin();
    title("$sitename -=- To Do List!");
    OpenTable();
    
    // set user options
    $sql = "select radminsuper from ".$prefix."_authors where aid='$aid'";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    if ($row['radminsuper'] == 1) {
        $useroptions = "<a href=\"admin.php?op=AddTodo\">[New Todo]</a> | <a href=\"admin.php?op=ClearFinTodos\">[Clear Finished]</a>";
    } else {
        $useroptions = "<a href=\"admin.php?op=AddTodo\">[New Todo]</a>";
    }

    echo "<br><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr>"
    ."<td align=\"center\"><b>Your Options:</b> $useroptions</td>"
    ."<td align=\"center\"><form action=\"admin.php\" method=\"post\">"
    ."Display To Do's For: <select name=\"username\" onChange='submit()'>"
    ."<option value=\"all\">[All Users]</option>";
    if ( $username == "[ANYBODY]" ) {
        echo "<option value=\"[ANYBODY]\" selected>[ANYBODY]</option>";
    } else {
        echo "<option value=\"[ANYBODY]\">[ANYBODY]</option>";
    }
    // fill selection with admin users
    $sql = "select aid from ".$prefix."_authors";
    $result = $db->sql_query($sql);
    while ( $row = $db->sql_fetchrow($result) ) {
        if ($row['aid'] == $username) {
            $selected = "selected";
        } else {
            $selected = "";
        }
        echo "<option value=\"$row[aid]\" $selected >$row[aid]</option>";
    }
    echo "</select>"
    ."<input type=\"hidden\" name=\"op\" value=\"ShowTodos\">"
    ."<input type=\"hidden\" name=\"sortby\" value=\"$sortby\">"
    ."</form></td></tr>"
    ."</table><br><br>";
    
    // check sort order
    if ($sortby == "column1") {
        $sortby = "priority";
        $sort1 = "*";
    } elseif ($sortby == "column2") {
        $sortby = "description";
        $sort2 = "*";
    } elseif ($sortby == "column3") {
        $sortby = "duedate";
        $sort3 = "*";
    } elseif ($sortby == "column4") {
        $sortby = "assignedto";
        $sort4 = "*";
    } elseif ($sortby == "column5") {
        $sortby = "status";
        $sort5 = "*";
    } else {
        $sortby = "priority";
        $sort1 = "*";
    }        
    echo "<table border=\"0\" bgcolor=\"#333333\" width=\"100%\" align=\"center\" cellpadding=\"3\" cellspacing=\"1\">"
    ."<tr bgcolor=\"#33CCCC\" background=\"images/admin-module-todo/header.gif\">"
    ."<td align=\"center\"><b><a href=\"admin.php?op=ShowTodos&amp;sortby=column1&amp;username=$username\">Priority $sort1</a></b></td>"
    ."<td align=\"center\"><b><a href=\"admin.php?op=ShowTodos&amp;sortby=column2&amp;username=$username\">Description $sort2</a></b></td>"
    ."<td align=\"center\"><b><a href=\"admin.php?op=ShowTodos&amp;sortby=column3&amp;username=$username\">Due Date $sort3</a></b></td>"
    ."<td align=\"center\"><b><a href=\"admin.php?op=ShowTodos&amp;sortby=column4&amp;username=$username\">Assigned To $sort4</a></b></td>"
    ."<td align=\"center\"><b><a href=\"admin.php?op=ShowTodos&amp;sortby=column5&amp;username=$username\">Status $sort5</a></b></td>"
    ."<td align=\"center\"><b>Notes</b></td></tr>";
    
    // get todos list for specific user or all users
    if ( $username == "all" ) {
        $sql = "select * from ".$prefix."_todo order by '$sortby'";
    } else {
        $sql = "select * from ".$prefix."_todo where assignedto='$username' order by '$sortby'";
    }
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        $id = $row['id'];
        $edittodo = "admin.php?op=EditTodo&amp;id=$id";
        $priority = $row['priority'];
        $description = $row['description'];
        
        // change due date 0000-00-00 to n/a
        if ($row['duedate'] == "0000-00-00") {
            $duedate = "&nbsp;";
        } else {
            $duedate = $row['duedate'];
        }
        $assignedto = $row['assignedto'];
        
        // change note to checkmark
        if ($row['note'] != NULL ) {
            $note = "<img src=\"images/admin-module-todo/note.gif\" width=\"15\" height=\"15\">";
        } else {
            $note = "&nbsp;";
        }

        // table priority colour code
        if ($priority == 1) {
            $rowcolour = "#FF8A8A";
        } elseif ($priority == 2) {
            $rowcolour = "#FFA79C";
        } elseif ($priority == 3) {
            $rowcolour = "#FFC4AE";
        } elseif ($priority == 4) {
            $rowcolour = "#FFE1C0";
        } elseif ($priority == 5) {
            $rowcolour = "#FFFFD2";
        }

        // change status to words and colour
        if ($row['status'] == 0) {
            $status = "&nbsp;";
        } elseif ($row['status'] == 1) {
            $status = "Started";
        } elseif ($row['status'] == 2) {
            $status = "Finished";
            $rowcolour = "#CCCCCC";
        }
        
        // create row with HyperCells :)
        echo "<tr bgcolor=\"$rowcolour\" onMouseOver=\"this.style.backgroundColor='#AAFFAA'\"; onMouseOut=\"this.style.backgroundColor='$rowcolour'\" onclick=\"window.location.href='$edittodo'\">"
        ."<td align=\"center\">$priority</td>"
        ."<td><a href=\"$edittodo\">$description</a></td>"
        ."<td align=\"center\">$duedate</td>"
        ."<td align=\"center\">$assignedto</td>"
        ."<td align=\"center\">$status</td>"
        ."<td align=\"center\">$note</td></tr>";
    }

    echo "</td></tr></table><br><center><b><i>Today's Date is: $todays_date</i></b></center><br><hr>"
    ."<u><b>Legend Key</b></u><br><br>"
    ."<table border=\"1\" cellspacing=\"0\" cellpadding=\"2\"><tr>"
    ."<td bgcolor=\"#33CCCC\" background=\"images/admin-module-todo/header.gif\">Header</td>"
    ."<td bgcolor=\"#FF8A8A\">Priority 1</td>"
    ."<td bgcolor=\"#FFA79C\">Priority 2</td>"
    ."<td bgcolor=\"#FFC4AE\">Priority 3</td>"
    ."<td bgcolor=\"#FFE1C0\">Priority 4</td>"
    ."<td bgcolor=\"#FFFFD2\">Priority 5</td>"
    ."<td bgcolor=\"#CCCCCC\">Finished</td>"
    ."<td bgcolor=\"#AAFFAA\">Selected</td></tr></table>"
    ."<br>* = Current Sort Order"
    ."<br>1 = Highest Priority"
    ."<br>5 = Lowest Priority"
    ."<br>Date Format is YYYY-MM-DD";
    CloseTable();
    mycopyright();
    include("footer.php");
}


//###############################################
//              Add Todo
//###############################################
function AddTodo() {
    global $prefix, $db;
    include ("header.php");
    GraphicAdmin();
    title("Add Todo");

    OpenTable();
    echo "<br><center><form name=\"addtodo\" action=\"admin.php\" method=\"post\">"
    ."Priority: <select name=\"priority\">";
    // fill selection with priority #
    for ($cnt = 1; $cnt <= 5; $cnt++) {
        if ($cnt == 3) {
            $selected = "selected";
        } else {
            $selected = "";
        }
        echo "<option value=\"$cnt\" $selected >$cnt</option>";
    }
    echo "</select> &nbsp;&nbsp;&nbsp;"
    ."Due Date (YYYY-MM-DD): <input type=\"text\" name=\"duedate\" value=\"0000-00-00\" size=\"12\" maxlength=\"10\">"
    // PopCalendarXP Lite Button & Calendar Open
    ."<a href=\"javascript:void(0)\" onclick=\"gfPop.fPopCalendar(document.addtodo.duedate);return false;\" HIDEFOCUS><img name=\"popcal\" align=\"absbottom\" src=\"images/admin-module-todo/calbtn.gif\" width=\"34\" height=\"22\" border=\"0\" alt=\"\"></a><br><br>"
    ."Assigned To: <select name=\"assignedto\">"
    ."<option value=\"[ANYBODY]\">[ANYBODY]</option>";
    // fill selection with admin users
    $sql = "select username from ".$prefix."_users where user_level='2' or user_level='3'";
    $result = $db->sql_query($sql);
    while ( $row = $db->sql_fetchrow($result) ) {
        echo "<option value=\"$row[username]\">$row[username]</option>";
    }
    echo "</select> &nbsp;&nbsp;&nbsp;"
    ."Status: <select name=\"status\">";
    // fill selection with status values
    $status = array("Normal", "Started", "Finished");
    for ($cnt = 0; $cnt <= 2; $cnt++) {
        echo "<option value=\"$cnt\">$status[$cnt]</option>";
    }
    echo "</select><br><br>"
    ."Description:<br><input type=\"text\" name=\"description\" size=\"50\" maxlength=\"200\"><br><br>"
    ."Notes:<br><textarea name=\"note\" rows=\"5\" cols=\"40\"></textarea>"
    ."<input type=\"hidden\" name=\"op\" value=\"SaveTodo\">"
    ."<br><br><input type=\"submit\" value=\"Save Todo\">"
    ."</form>"
    ."<hr><a href=\"admin.php?op=ShowTodos\">[Back To To Do List]</a>";
    CloseTable();
    mycopyright();
    // PopCalendarXP Lite Engine
    echo "<iframe width=174 height=189 name=\"gToday:normal\" id=\"gToday:normal\" src=\"images/admin-module-todo/ipopeng.htm\" scrolling=\"no\" frameborder=\"0\" style=\"visibility:visible; z-index:999; position:absolute; left:-500px; top:0px;\">";
}

//###############################################
//              Edit Todo
//###############################################
function EditTodo($id) {
    global $prefix, $db;
    include ("header.php");
    GraphicAdmin();
    title("View/Edit Todo: #$id");

    OpenTable();
    $sql = "select * from ".$prefix."_todo where id='$id'";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    
    echo "<br><center><form name=\"edittodo\" action=\"admin.php\" method=\"post\">"
    ."Priority: <select name=\"priority\">";
    // fill selection with priority #
    for ($cnt = 1; $cnt <= 5; $cnt++) {
        if ($cnt == $row['priority']) {
            $selected = "selected";
        } else {
            $selected = "";
        }
        echo "<option value=\"$cnt\" $selected >$cnt</option>";
    }
    echo "</select> &nbsp;&nbsp;&nbsp;"
    ."Due Date (YYYY-MM-DD): <input type=\"text\" name=\"duedate\" value=\"$row[duedate]\" size=\"12\" maxlength=\"10\">"
    // PopCalendarXP Lite Button & Calendar Open
    ."<a href=\"javascript:void(0)\" onclick=\"gfPop.fPopCalendar(document.edittodo.duedate);return false;\" HIDEFOCUS><img name=\"popcal\" align=\"absbottom\" src=\"images/admin-module-todo/calbtn.gif\" width=\"34\" height=\"22\" border=\"0\" alt=\"\"></a><br><br>"
    ."Assigned To: <select name=\"assignedto\">"
    ."<option value=\"[ANYBODY]\">[ANYBODY]</option>";
    // fill selection with admin users
    $sql2 = "select username from ".$prefix."_users where user_level='2' or user_level='3'";
    $result2 = $db->sql_query($sql2);
    while ( $row2 = $db->sql_fetchrow($result2) ) {
        if ($row2['username'] == $row['assignedto']) {
            $selected = "selected";
        } else {
            $selected = "";
        }
        echo "<option value=\"$row2[username]\" $selected >$row2[username]</option>";
    }
    echo "</select> &nbsp;&nbsp;&nbsp;"
    ."Status: <select name=\"status\">";
    // fill selection with status values
    $status = array("Normal", "Started", "Finished");
    for ($cnt = 0; $cnt <= 2; $cnt++) {
        if ($row['status'] == $cnt ) {
            $selected = "selected";
        } else {
            $selected = "";
        }
        echo "<option value=\"$cnt\" $selected >$status[$cnt]</option>";
    }
    echo "</select><br><br>"
    ."Description:<br><input type=\"text\" name=\"description\" value=\"$row[description]\" size=\"50\" maxlength=\"200\"><br><br>"
    ."Notes:<br><textarea name=\"note\" rows=\"5\" cols=\"40\">$row[note]</textarea>"
    ."<input type=\"hidden\" name=\"op\" value=\"UpdateTodo\">"
    ."<input type=\"hidden\" name=\"id\" value=\"$id\">"
    ."<br><br><input type=\"submit\" value=\"Save Changes\">"
    ."</form>"
    ."<hr><a href=\"admin.php?op=DeleteTodo&amp;id=$id\">[Delete This To Do]</a> | <a href=\"admin.php?op=ShowTodos\">[Back To To Do List]</a>";
    CloseTable();
    mycopyright();
    // PopCalendarXP Lite Engine
    echo "<iframe width=174 height=189 name=\"gToday:normal\" id=\"gToday:normal\" src=\"images/admin-module-todo/ipopeng.htm\" scrolling=\"no\" frameborder=\"0\" style=\"visibility:visible; z-index:999; position:absolute; left:-500px; top:0px;\">";
}


//###############################################
//              Save Todo
//###############################################
function SaveTodo($priority, $description, $duedate, $assignedto, $note, $status) {
    global $prefix, $db;
    $sql = "insert into ".$prefix."_todo values (NULL, '$priority', '$description', '$duedate', '$assignedto', '$note', '$status')";
    $db->sql_query($sql);
    Header("Location: admin.php?op=ShowTodos");
}


//###############################################
//              Update Todo
//###############################################
function UpdateTodo($id, $priority, $description, $duedate, $assignedto, $note, $status) {
    global $prefix, $db;
    $sql = "update ".$prefix."_todo set priority='$priority', description='$description', duedate='$duedate', assignedto='$assignedto', note='$note', status='$status' where id='$id'";
    $db->sql_query($sql);
    Header("Location: admin.php?op=ShowTodos");
}


//###############################################
//              Delete Todo
//###############################################
function DeleteTodo($id, $ok=0) {
    global $prefix, $db;
    
    if ($ok==1) {
        $sql = "delete from ".$prefix."_todo where id='$id'";
        $db->sql_query($sql);
        Header("Location: admin.php?op=ShowTodos");
    } else {
        include("header.php");
        GraphicAdmin();
        title("Delete Todo: #$id");
        $sql = "select description from ".$prefix."_todo where id='$id'";
        $result = $db->sql_query($sql);
        $row = $db->sql_fetchrow($result);
        OpenTable();
        echo "<center><b>Delete Todo: $id</b><br><br>"
        ."Are you sure you want to delete: $row[description] ?<br><br>"
        ."[ <a href=\"admin.php?op=ShowTodos\">"._NO."</a> | <a href=\"admin.php?op=DeleteTodo&amp;id=$id&amp;ok=1\">"._YES."</a> ]</center>";
        CloseTable();
        mycopyright();
        include("footer.php");
    }
}

//###############################################
//         Clear Finished Todos Todo
//###############################################
function ClearFinTodos($ok=0) {
    global $prefix, $db, $aid;
    
    // check if user is has superuser permission
    $sql = "select radminsuper from ".$prefix."_authors where aid='$aid'";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    if ($row['radminsuper'] == 0) { die ("Access Denied"); }

    if ($ok==1) {
        $sql = "select id from ".$prefix."_todo where status='2'";
        $result = $db->sql_query($sql);
        while ( $row = $db->sql_fetchrow($result) ) {
            $sql2 = "delete from ".$prefix."_todo where id='$row[id]'";
            $db->sql_query($sql2);
        }
        Header("Location: admin.php?op=ShowTodos");
    } else {
        include("header.php");
        GraphicAdmin();
        title("Clear Finished Todos");
        OpenTable();
        echo "<center><b>Clear Finished</b><br><br>"
        ."Are you sure you want to delete all finished todo's ?<br><br>"
        ."[ <a href=\"admin.php?op=ShowTodos\">"._NO."</a> | <a href=\"admin.php?op=ClearFinTodos&amp;ok=1\">"._YES."</a> ]</center>";
        CloseTable();
        mycopyright();
        include("footer.php");
    }
}


switch($op) {

    case "ShowTodos":
    ShowTodos($sortby, $username);
    break;

    case "AddTodo":
    AddTodo();
    break;

    case "EditTodo":
    EditTodo($id);
    break;

    case "SaveTodo":
    SaveTodo($priority, $description, $duedate, $assignedto, $note, $status);
    break;

    case "UpdateTodo":
    UpdateTodo($id, $priority, $description, $duedate, $assignedto, $note, $status);
    break;
    
    case "DeleteTodo":
    DeleteTodo($id, $ok);
    break;

    case "ClearFinTodos":
    ClearFinTodos($ok);
    break;

}


?>