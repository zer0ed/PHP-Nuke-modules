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

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
 <tr> 
  <td align="left">
   <span class="gensmall">{S_TIMEZONE}</span><br>
   &nbsp;<span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span>
  </td>
  <td valign="top" align="right">{JUMPBOX}</td>
 </tr>
</table>
<br>

<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
 <tr> 
  <th width="35%" class="thCornerL" height="25">&nbsp;{L_USERNAME}&nbsp;</th>
  <th width="25%" class="thTop">&nbsp;{L_LAST_UPDATE}&nbsp;</th>
  <th width="40%" class="thCornerR">&nbsp;{L_FORUM_LOCATION}&nbsp;</th>
 </tr>
 <tr> 
  <td class="catSides" colspan="3" height="28"><span class="cattitle"><b>{TOTAL_REGISTERED_USERS_ONLINE}</b></span></td>
 </tr>
 <!-- BEGIN reg_user_row -->
 <tr> 
  <td width="35%" class="{reg_user_row.ROW_CLASS}">&nbsp;<span class="gen"><a href="{reg_user_row.U_USER_PROFILE}" class="gen">{reg_user_row.USERNAME}</a></span>&nbsp;</td>
  <td width="25%" align="center" nowrap="nowrap" class="{reg_user_row.ROW_CLASS}">&nbsp;<span class="gen">{reg_user_row.LASTUPDATE}</span>&nbsp;</td>
  <td width="40%" class="{reg_user_row.ROW_CLASS}">&nbsp;<span class="gen"><a href="{reg_user_row.U_FORUM_LOCATION}" class="gen">{reg_user_row.FORUM_LOCATION}</a></span>&nbsp;</td>
 </tr>
 <!-- END reg_user_row -->
 <tr> 
  <td colspan="3" height="1" class="row3"><img src="modules/Forums/templates/RDP/images/spacer.gif" width="1" height="1" alt="."></td>
 </tr>
 <tr> 
  <td class="catSides" colspan="3" height="28"><span class="cattitle"><b>{TOTAL_GUEST_USERS_ONLINE}</b></span></td>
 </tr>
 <!-- BEGIN guest_user_row -->
 <tr> 
  <td width="35%" class="{guest_user_row.ROW_CLASS}">&nbsp;<span class="gen">{guest_user_row.USERNAME}</span>&nbsp;</td>
  <td width="25%" align="center" nowrap="nowrap" class="{guest_user_row.ROW_CLASS}">&nbsp;<span class="gen">{guest_user_row.LASTUPDATE}</span>&nbsp;</td>
  <td width="40%" class="{guest_user_row.ROW_CLASS}">&nbsp;<span class="gen"><a href="{guest_user_row.U_FORUM_LOCATION}" class="gen">{guest_user_row.FORUM_LOCATION}</a></span>&nbsp;</td>
 </tr>
 <!-- END guest_user_row -->
</table>
