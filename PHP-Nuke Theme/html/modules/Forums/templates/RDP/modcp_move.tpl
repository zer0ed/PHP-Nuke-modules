<table width="100%" cellspacing="0" cellpadding="10" border="0" align="center"> 
 <tr> 
  <td align="center" valign="top" nowrap="nowrap"><span class="mainmenu">&nbsp;<a href="{U_FAQ}" class="mainmenu"><img src="modules/Forums/templates/RDP/images/icon_mini_faq.gif" width="12" height="13" border="0" alt="{L_FAQ}" hspace="3">Forum FAQ</a>&nbsp; &nbsp;
   <a href="{U_SEARCH}" class="mainmenu"><img src="modules/Forums/templates/RDP/images/icon_mini_search.gif" width="12" height="13" border="0" alt="{L_SEARCH}" hspace="3">Search Forums</a>&nbsp; &nbsp;
   <a href="{U_MEMBERLIST}" class="mainmenu"><img src="modules/Forums/templates/RDP/images/icon_mini_members.gif" width="12" height="13" border="0" alt="{L_MEMBERLIST}" hspace="3">Site MemberList</a><br>
   <a href="{U_GROUP_CP}" class="mainmenu"><img src="modules/Forums/templates/RDP/images/icon_mini_groups.gif" width="12" height="13" border="0" alt="{L_USERGROUPS}" hspace="3">Forum UserGroups</a>&nbsp;
   <a href="{U_PROFILE}" class="mainmenu"><img src="modules/Forums/templates/RDP/images/icon_mini_profile.gif" width="12" height="13" border="0" alt="{L_PROFILE}" hspace="3">Your Forum Profile</a></span>
  </td>
 </tr>
</table>
<hr>

<form action="{S_MODCP_ACTION}" method="post">
 <table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
   <td align="left" class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></td>
  </tr>
 </table>
 <br>

 <table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
  <tr> 
   <th height="25" class="thHead"><b>{MESSAGE_TITLE}</b></th>
  </tr>
  <tr> 
   <td class="row1"> 
    <table width="100%" border="0" cellspacing="0" cellpadding="1">
     <tr> 
      <td>&nbsp;</td>
     </tr>
     <tr> 
      <td align="center"><span class="gen">{L_MOVE_TO_FORUM} &nbsp; {S_FORUM_SELECT}<br><br>
       <input type="checkbox" name="move_leave_shadow" checked="checked">{L_LEAVESHADOW}<br><br>
       {MESSAGE_TEXT}</span><br><br>
       {S_HIDDEN_FIELDS} 
       <input class="mainoption" type="submit" name="confirm" value="{L_YES}"> &nbsp;&nbsp; 
       <input class="liteoption" type="submit" name="cancel" value="{L_NO}">
      </td>
     </tr>
     <tr> 
      <td>&nbsp;</td>
     </tr>
    </table>
   </td>
  </tr>
 </table>
</form>
