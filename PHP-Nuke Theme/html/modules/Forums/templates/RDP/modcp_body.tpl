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

<form method="post" action="{S_MODCP_ACTION}">
 <table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
  <tr> 
   <td class="catHead" colspan="5" align="center" height="28"><span class="cattitle">{L_MOD_CP}</span></td>
  </tr>
  <tr> 
   <td class="spaceRow" colspan="5" align="center"><span class="gensmall">{L_MOD_CP_EXPLAIN}</span></td>
  </tr>
  <tr> 
   <th width="4%" class="thLeft" nowrap="nowrap">&nbsp;</th>
   <th nowrap="nowrap">&nbsp;{L_TOPICS}&nbsp;</th>
   <th width="8%" nowrap="nowrap">&nbsp;{L_REPLIES}&nbsp;</th>
   <th width="17%" nowrap="nowrap">&nbsp;{L_LASTPOST}&nbsp;</th>
   <th width="5%" class="thRight" nowrap="nowrap">&nbsp;{L_SELECT}&nbsp;</th>
  </tr>
  <!-- BEGIN topicrow -->
  <tr> 
   <td class="row1" align="center" valign="middle"><img src="{topicrow.TOPIC_FOLDER_IMG}" width="19" height="18" alt="{topicrow.L_TOPIC_FOLDER_ALT}" title="{topicrow.L_TOPIC_FOLDER_ALT}"></td>
   <td class="row1">&nbsp;<span class="topictitle">{topicrow.TOPIC_TYPE}<a href="{topicrow.U_VIEW_TOPIC}" class="topictitle">{topicrow.TOPIC_TITLE}</a></span></td>
   <td class="row2" align="center" valign="middle"><span class="postdetails">{topicrow.REPLIES}</span></td>
   <td class="row1" align="center" valign="middle"><span class="postdetails">{topicrow.LAST_POST_TIME}</span></td>
   <td class="row2" align="center" valign="middle"> 
    <input type="checkbox" name="topic_id_list[]" value="{topicrow.TOPIC_ID}">
   </td>
  </tr>
  <!-- END topicrow -->
  <tr align="right"> 
   <td class="catBottom" colspan="5" height="29"> {S_HIDDEN_FIELDS} 
    <input type="submit" name="delete" class="liteoption" value="{L_DELETE}"> &nbsp; 
    <input type="submit" name="move" class="liteoption" value="{L_MOVE}"> &nbsp; 
    <input type="submit" name="lock" class="liteoption" value="{L_LOCK}">	&nbsp; 
    <input type="submit" name="unlock" class="liteoption" value="{L_UNLOCK}">
   </td>
  </tr>
 </table>
</form>

<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
 <tr> 
  <td class="nav" align="right" valign="top" nowrap="nowrap">
   {PAGE_NUMBER}<br>
   {PAGINATION} 
  </td>
 </tr>
</table>
