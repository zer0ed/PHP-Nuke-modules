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
 <!-- BEGIN switch_groups_joined -->
 <tr> 
  <th colspan="2" align="center" class="thHead" height="25">{L_GROUP_MEMBERSHIP_DETAILS}</th>
 </tr>
 <!-- BEGIN switch_groups_member -->
 <tr> 
  <td class="row1"><span class="gen">{L_YOU_BELONG_GROUPS}</span></td>
  <td class="row2" align="right"> 
  <table width="90%" cellspacing="0" cellpadding="0" border="0">
   <tr><form method="post" action="{S_USERGROUP_ACTION}">
    <td width="40%"><span class="gensmall">{GROUP_MEMBER_SELECT}</span></td>
    <td align="center" width="30%"><input type="submit" value="{L_VIEW_INFORMATION}" class="liteoption" />{S_HIDDEN_FIELDS}</td>
   </form></tr>
  </table>
  </td>
 </tr>
 <!-- END switch_groups_member -->
 <!-- BEGIN switch_groups_pending -->
 <tr> 
  <td class="row1"><span class="gen">{L_PENDING_GROUPS}</span></td>
  <td class="row2" align="right"> 
  <table width="90%" cellspacing="0" cellpadding="0" border="0">
   <tr><form method="post" action="{S_USERGROUP_ACTION}">
    <td width="40%"><span class="gensmall">{GROUP_PENDING_SELECT}</span></td>
    <td align="center" width="30%"><input type="submit" value="{L_VIEW_INFORMATION}" class="liteoption" />{S_HIDDEN_FIELDS}</td>
   </form></tr>
  </table>
  </td>
 </tr>
 <!-- END switch_groups_pending -->
 <!-- END switch_groups_joined -->
 <!-- BEGIN switch_groups_remaining -->
 <tr> 
  <th colspan="2" align="center" class="thHead" height="25">{L_JOIN_A_GROUP}</th>
 </tr>
 <tr> 
  <td class="row1"><span class="gen">{L_SELECT_A_GROUP}</span></td>
  <td class="row2" align="right"> 
  <table width="90%" cellspacing="0" cellpadding="0" border="0">
   <tr><form method="post" action="{S_USERGROUP_ACTION}">
    <td width="40%"><span class="gensmall">{GROUP_LIST_SELECT}</span></td>
    <td align="center" width="30%"><input type="submit" value="{L_VIEW_INFORMATION}" class="liteoption" />{S_HIDDEN_FIELDS}</td>
   </form></tr>
  </table>
  </td>
 </tr>
 <!-- END switch_groups_remaining -->
</table>
