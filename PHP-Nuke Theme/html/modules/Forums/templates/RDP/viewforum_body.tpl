<form method="post" action="{S_POST_DAYS_ACTION}">
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
   <td align="left" valign="top">
    <a class="maintitle" href="{U_VIEW_FORUM}">{FORUM_NAME}</a><br>
    <span class="gensmall"><b>{L_MODERATOR}: {MODERATORS}<br>
    {LOGGED_IN_USER_LIST}</b><br>
    {S_TIMEZONE}</span><br>
    <span class="nav">&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> <a class="nav" href="{U_VIEW_FORUM}">{FORUM_NAME}</a></span><br><br>
    <a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" /></a>
   </td>
   <td class="gensmall" align="right" valign="middle" nowrap>
    {S_AUTH_LIST}<br><br>
    <a href="{U_MARK_READ}">{L_MARK_TOPICS_READ}</a><br>
    <b>{PAGINATION}</b>
   </td>
  </tr>
 </table>
 <br>
 
 <table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
  <tr> 
   <th colspan="2" align="center" height="25" class="thCornerL" nowrap="nowrap">&nbsp;{L_TOPICS}&nbsp;</th>
   <th width="50" align="center" class="thTop" nowrap="nowrap">&nbsp;{L_REPLIES}&nbsp;</th>
   <th width="100" align="center" class="thTop" nowrap="nowrap">&nbsp;{L_AUTHOR}&nbsp;</th>
   <th width="50" align="center" class="thTop" nowrap="nowrap">&nbsp;{L_VIEWS}&nbsp;</th>
   <th align="center"  nowrap="nowrap" class="thCornerR" nowrap="nowrap">&nbsp;{L_LASTPOST}&nbsp;</th>
  </tr>
  <!-- BEGIN topicrow -->
  <tr> 
   <td class="row1" align="center" valign="middle" width="20"><img src="{topicrow.TOPIC_FOLDER_IMG}" width="19" height="18" alt="{topicrow.L_TOPIC_FOLDER_ALT}" title="{topicrow.L_TOPIC_FOLDER_ALT}" /></td>
   <td class="row1" width="100%" onMouseOver="this.style.backgroundColor='#EEEEEE'; this.style.cursor='hand';" onMouseOut=this.style.backgroundColor="#DDDDDD" onclick="window.location.href='{topicrow.U_VIEW_TOPIC}'"><span class="topictitle">{topicrow.NEWEST_POST_IMG}{topicrow.TOPIC_TYPE}<a href="{topicrow.U_VIEW_TOPIC}" class="topictitle">{topicrow.TOPIC_TITLE}</a></span><span class="gensmall"><br />
    {topicrow.GOTO_PAGE}</span></td>
   <td class="row2" align="center" valign="middle"><span class="postdetails">{topicrow.REPLIES}</span></td>
   <td class="row3" align="center" valign="middle"><span class="name">{topicrow.TOPIC_AUTHOR}</span></td>
   <td class="row2" align="center" valign="middle"><span class="postdetails">{topicrow.VIEWS}</span></td>
   <td class="row3Right" align="center" valign="middle" nowrap="nowrap"><span class="postdetails">{topicrow.LAST_POST_TIME}<br />{topicrow.LAST_POST_AUTHOR} {topicrow.LAST_POST_IMG}</span></td>
  </tr>
  <!-- END topicrow -->
  <!-- BEGIN switch_no_topics -->
  <tr> 
   <td class="row1" colspan="6" height="30" align="center" valign="middle"><span class="gen">{L_NO_TOPICS}</span></td>
  </tr>
  <!-- END switch_no_topics -->
  <tr> 
   <td class="catBottom" align="center" valign="middle" colspan="6" height="28"><span class="genmed">{L_DISPLAY_TOPICS}:&nbsp;{S_SELECT_TOPIC_DAYS}&nbsp;<input type="submit" class="liteoption" value="{L_GO}" name="submit" /></span></td>
  </tr>
 </table>
</form>

<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
 <tr> 
  <td align="left" valign="top" width="50">
   <a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" /></a>
  </td>
  <td align="center" valign="top">{JUMPBOX}</td>
  <td class="nav" align="right" valign="top" nowrap="nowrap">
   {PAGE_NUMBER}<br>
   {PAGINATION} 
  </td>
 </tr>
</table>
<br><hr>

<table width="100%" cellspacing="0" border="0" align="center" cellpadding="0">
 <tr>
  <td align="center" valign="top">
   <table cellspacing="3" cellpadding="0" border="0">
    <tr>
     <td width="20" align="left"><img src="{FOLDER_NEW_IMG}" alt="{L_NEW_POSTS}" width="19" height="18" /></td>
     <td class="gensmall">{L_NEW_POSTS}</td>
     <td>&nbsp;&nbsp;</td>
     <td width="20" align="center"><img src="{FOLDER_IMG}" alt="{L_NO_NEW_POSTS}" width="19" height="18" /></td>
     <td class="gensmall">{L_NO_NEW_POSTS}</td>
     <td>&nbsp;&nbsp;</td>
     <td width="20" align="center"><img src="{FOLDER_ANNOUNCE_IMG}" alt="{L_ANNOUNCEMENT}" width="19" height="18" /></td>
     <td class="gensmall">{L_ANNOUNCEMENT}</td>
    </tr>
    <tr> 
     <td width="20" align="center"><img src="{FOLDER_HOT_NEW_IMG}" alt="{L_NEW_POSTS_HOT}" width="19" height="18" /></td>
     <td class="gensmall">{L_NEW_POSTS_HOT}</td>
     <td>&nbsp;&nbsp;</td>
     <td width="20" align="center"><img src="{FOLDER_HOT_IMG}" alt="{L_NO_NEW_POSTS_HOT}" width="19" height="18" /></td>
     <td class="gensmall">{L_NO_NEW_POSTS_HOT}</td>
     <td>&nbsp;&nbsp;</td>
     <td width="20" align="center"><img src="{FOLDER_STICKY_IMG}" alt="{L_STICKY}" width="19" height="18" /></td>
     <td class="gensmall">{L_STICKY}</td>
    </tr>
    <tr>
     <td class="gensmall"><img src="{FOLDER_LOCKED_NEW_IMG}" alt="{L_NEW_POSTS_TOPIC_LOCKED}" width="19" height="18" /></td>
     <td class="gensmall">{L_NEW_POSTS_LOCKED}</td>
     <td>&nbsp;&nbsp;</td>
     <td class="gensmall"><img src="{FOLDER_LOCKED_IMG}" alt="{L_NO_NEW_POSTS_TOPIC_LOCKED}" width="19" height="18" /></td>
     <td class="gensmall">{L_NO_NEW_POSTS_LOCKED}</td>
    </tr>
   </table>
  </td>
 </tr>
</table>

