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
   <span class="maintitle">{L_SEARCH_MATCHES}</span><br>
   <span class="gensmall">{S_TIMEZONE}</span><br>
   &nbsp;<span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span>
  </td>
 </tr>
</table>
<br>

<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
 <tr> 
  <th width="4%" height="25" class="thCornerL" nowrap="nowrap">&nbsp;</th>
  <th class="thTop" nowrap="nowrap">&nbsp;{L_FORUM}&nbsp;</th>
  <th class="thTop" nowrap="nowrap">&nbsp;{L_TOPICS}&nbsp;</th>
  <th class="thTop" nowrap="nowrap">&nbsp;{L_AUTHOR}&nbsp;</th>
  <th class="thTop" nowrap="nowrap">&nbsp;{L_REPLIES}&nbsp;</th>
  <th class="thTop" nowrap="nowrap">&nbsp;{L_VIEWS}&nbsp;</th>
  <th class="thCornerR" nowrap="nowrap">&nbsp;{L_LASTPOST}&nbsp;</th>
 </tr>
 <!-- BEGIN searchresults -->
 <tr> 
  <td class="row1" align="center" valign="middle"><img src="{searchresults.TOPIC_FOLDER_IMG}" width="19" height="18" alt="{searchresults.L_TOPIC_FOLDER_ALT}" title="{searchresults.L_TOPIC_FOLDER_ALT}" /></td>
  <td class="row1"><span class="forumlink"><a href="{searchresults.U_VIEW_FORUM}" class="forumlink">{searchresults.FORUM_NAME}</a></span></td>
  <td class="row2"><span class="topictitle">{searchresults.NEWEST_POST_IMG}{searchresults.TOPIC_TYPE}<a href="{searchresults.U_VIEW_TOPIC}" class="topictitle">{searchresults.TOPIC_TITLE}</a></span><br /><span class="gensmall">{searchresults.GOTO_PAGE}</span></td>
  <td class="row1" align="center" valign="middle"><span class="name">{searchresults.TOPIC_AUTHOR}</span></td>
  <td class="row2" align="center" valign="middle"><span class="postdetails">{searchresults.REPLIES}</span></td>
  <td class="row1" align="center" valign="middle"><span class="postdetails">{searchresults.VIEWS}</span></td>
  <td class="row2" align="center" valign="middle" nowrap="nowrap"><span class="postdetails">{searchresults.LAST_POST_TIME}<br />{searchresults.LAST_POST_AUTHOR} {searchresults.LAST_POST_IMG}</span></td>
 </tr>
 <!-- END searchresults -->
 <tr> 
  <td class="catBottom" colspan="7" height="28" valign="middle">&nbsp; </td>
 </tr>
</table>
<br>

<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
 <tr> 
  <td align="left" valign="top" width="50"><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" /></a></td>
  <td align="center" valign="top">{JUMPBOX}</td>
  <td class="nav" align="right" valign="top" nowrap="nowrap">
   {PAGE_NUMBER}<br>
   {PAGINATION} 
  </td>
 </tr>
</table>

