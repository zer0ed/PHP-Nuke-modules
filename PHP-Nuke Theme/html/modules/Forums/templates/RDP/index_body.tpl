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

<table width="100%" cellspacing="0" cellpadding="2" border="0" align="center">
 <tr> 
  <td class="gensmall" align="left" valign="bottom">
   <!-- BEGIN switch_user_logged_in -->
   {LAST_VISIT_DATE}<br>
   <!-- END switch_user_logged_in -->
   {CURRENT_TIME}<br>
   {S_TIMEZONE}<br>
   <a href="{U_INDEX}" class="nav">{L_INDEX}</a>
  </td>
  <td class="gensmall" align="right" valign="bottom">
   <!-- BEGIN switch_user_logged_out -->
   <b><a href="modules.php?name=Your_Account" class="gensmall">Click here to login</a></b><br>
   <!-- END switch_user_logged_out -->
   <!-- BEGIN switch_user_logged_in -->
   <a href="{U_SEARCH_NEW}" class="gensmall">{L_SEARCH_NEW}</a><br>
   <a href="{U_SEARCH_SELF}" class="gensmall">{L_SEARCH_SELF}</a><br>
   <!-- END switch_user_logged_in -->
   <a href="{U_SEARCH_UNANSWERED}" class="gensmall">{L_SEARCH_UNANSWERED}</a><br>
   <a href="{U_MARK_READ}" class="gensmall">{L_MARK_FORUMS_READ}</a>
  </td>
 </tr>
</table>
<br>

<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
 <tr> 
  <th colspan="2" class="thCornerL" height="25" nowrap="nowrap">&nbsp;{L_FORUM}&nbsp;</th>
  <th width="50" class="thTop" nowrap="nowrap">&nbsp;{L_TOPICS}&nbsp;</th>
  <th width="50" class="thTop" nowrap="nowrap">&nbsp;{L_POSTS}&nbsp;</th>
  <th class="thCornerR" nowrap="nowrap">&nbsp;{L_LASTPOST}&nbsp;</th>
 </tr>
 <!-- BEGIN catrow -->
 <tr> 
  <td class="catLeft" colspan="2" height="28"><span class="cattitle"><a href="{catrow.U_VIEWCAT}" class="cattitle">{catrow.CAT_DESC}</a></span></td>
  <td class="rowpic" colspan="3" align="right">&nbsp;</td>
 </tr>
 <!-- BEGIN forumrow -->
 <tr> 
  <td class="row1" align="center" valign="middle" height="50"><img src="{catrow.forumrow.FORUM_FOLDER_IMG}" width="46" height="25" alt="{catrow.forumrow.L_FORUM_FOLDER_ALT}" title="{catrow.forumrow.L_FORUM_FOLDER_ALT}"></td>
  <td class="row1" width="100%" onMouseOver="this.className='hoveron'; this.style.cursor='hand';" onMouseOut="this.className='hoveroff'" onclick="window.location.href='{catrow.forumrow.U_VIEWFORUM}'"> <span class="forumlink"> <a href="{catrow.forumrow.U_VIEWFORUM}" class="forumlink">{catrow.forumrow.FORUM_NAME}</a></span><br />
   <span class="genmed">{catrow.forumrow.FORUM_DESC}</span><br>
   <span class="gensmall">{catrow.forumrow.L_MODERATOR} {catrow.forumrow.MODERATORS}</span>
  </td>
  <td class="row2" align="center" valign="middle" height="50"><span class="gensmall">{catrow.forumrow.TOPICS}</span></td>
  <td class="row2" align="center" valign="middle" height="50"><span class="gensmall">{catrow.forumrow.POSTS}</span></td>
  <td class="row2" align="center" valign="middle" height="50" nowrap="nowrap"> <span class="gensmall">{catrow.forumrow.LAST_POST}</span></td>
 </tr>
 <!-- END forumrow -->
 <!-- END catrow -->
</table>
<br>

<table cellspacing="3" border="0" align="center" cellpadding="0">
 <tr> 
  <td width="20" align="center"><img src="modules/Forums/templates/RDP/images/folder_new.gif" alt="{L_NEW_POSTS}"></td>
  <td><span class="gensmall">{L_NEW_POSTS}</span></td>
  <td>&nbsp;&nbsp;</td>
  <td width="20" align="center"><img src="modules/Forums/templates/RDP/images/folder.gif" alt="{L_NO_NEW_POSTS}"></td>
  <td><span class="gensmall">{L_NO_NEW_POSTS}</span></td>
  <td>&nbsp;&nbsp;</td>
  <td width="20" align="center"><img src="modules/Forums/templates/RDP/images/folder_lock.gif" alt="{L_FORUM_LOCKED}"></td>
  <td><span class="gensmall">{L_FORUM_LOCKED}</span></td>
 </tr>
</table>
<br><hr>

<table width="100%" cellspacing="0" border="0" align="center" cellpadding="2">
 <tr> 
  <td class="catHead" colspan="2" height="28"><span class="cattitle"><a href="{U_VIEWONLINE}" class="cattitle">{L_WHO_IS_ONLINE}</a></span></td>
 </tr>
 <tr> 
  <td class="row1" align="center" valign="middle" rowspan="2"><img src="modules/Forums/templates/RDP/images/whosonline.gif" alt="{L_WHO_IS_ONLINE}" /></td>
  <td class="row1" align="left" width="100%"><span class="gensmall">
   {TOTAL_POSTS}<br>
   {TOTAL_USERS}<br>
   {NEWEST_USER}
  </span></td>
 </tr>
 <tr> 
  <td class="row1" align="left"><span class="gensmall">
   {TOTAL_USERS_ONLINE} &nbsp; [ {L_WHOSONLINE_ADMIN} ] &nbsp; [ {L_WHOSONLINE_MOD} ]<br>
   {RECORD_USERS}<br>
   {LOGGED_IN_USER_LIST}
  </span></td>
 </tr>
</table>
					      