<script language="Javascript" type="text/javascript">
	//
	// Should really check the browser to stop this whining ...
	//
	function select_switch(status)
	{
		for (i = 0; i < document.privmsg_list.length; i++)
		{
			document.privmsg_list.elements[i].checked = status;
		}
	}
</script>

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

<table border="0" cellspacing="0" cellpadding="0" align="center" width="100%">
 <tr> 
  <td valign="top" align="center" width="100%"> 
   <table height="40" cellspacing="2" cellpadding="2" border="0">
    <tr valign="middle"> 
     <td>{INBOX_IMG}</td>
     <td><span class="cattitle">{INBOX} &nbsp;</span></td>
     <td>{SENTBOX_IMG}</td>
     <td><span class="cattitle">{SENTBOX} &nbsp;</span></td>
     <td>{OUTBOX_IMG}</td>
     <td><span class="cattitle">{OUTBOX} &nbsp;</span></td>
     <td>{SAVEBOX_IMG}</td>
     <td><span class="cattitle">{SAVEBOX} &nbsp;</span></td>
    </tr>
   </table>
  </td>
  <td align="right"> 
  <!-- BEGIN switch_box_size_notice -->
   <table width="175" cellspacing="1" cellpadding="2" border="0" class="bodyline">
    <tr> 
     <td colspan="3" width="100%" class="row1" nowrap="nowrap"><span class="gensmall">{BOX_SIZE_STATUS}</span></td>
    </tr>
    <tr> 
     <td colspan="3" width="100%" class="row2">
      <table cellspacing="0" cellpadding="1" border="0">
       <tr> 
        <td bgcolor="{T_TD_COLOR2}"><img src="modules/Forums/templates/RDP/images/spacer.gif" width="{INBOX_LIMIT_IMG_WIDTH}" height="8" alt="{INBOX_LIMIT_PERCENT}"></td>
       </tr>
      </table>
     </td>
    </tr>
    <tr> 
     <td width="33%" class="row1"><span class="gensmall">0%</span></td>
     <td width="34%" align="center" class="row1"><span class="gensmall">50%</span></td>
     <td width="33%" align="right" class="row1"><span class="gensmall">100%</span></td>
    </tr>
   </table>
   <!-- END switch_box_size_notice -->
  </td>
 </tr>
</table>
<br><hr>

<form method="post" name="privmsg_list" action="{S_PRIVMSGS_ACTION}">
 <table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
   <td align="left" valign="top">
    <span class="gensmall">{S_TIMEZONE}</span><br>
    <span class="nav">&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a><br><br>
    {POST_PM_IMG}
   </td>
   <td class="gensmall" align="right" valign="middle" nowrap>
    {L_DISPLAY_MESSAGES}: <select name="msgdays">{S_SELECT_MSG_DAYS}</select>
    <input type="submit" value="{L_GO}" name="submit_msgdays" class="liteoption"><br><br>
    <a href="javascript:select_switch(true);">{L_MARK_ALL}</a> :: <a href="javascript:select_switch(false);">{L_UNMARK_ALL}</a>
   </td>
  </tr>
 </table>
 <br>
 
 <table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
  <tr> 
   <th width="5%" height="25" class="thCornerL" nowrap="nowrap">&nbsp;{L_FLAG}&nbsp;</th>
   <th width="55%" class="thTop" nowrap="nowrap">&nbsp;{L_SUBJECT}&nbsp;</th>
   <th width="20%" class="thTop" nowrap="nowrap">&nbsp;{L_FROM_OR_TO}&nbsp;</th>
   <th width="15%" class="thTop" nowrap="nowrap">&nbsp;{L_DATE}&nbsp;</th>
   <th width="5%" class="thCornerR" nowrap="nowrap">&nbsp;{L_MARK}&nbsp;</th>
  </tr>
  <!-- BEGIN listrow -->
  <tr> 
   <td class="{listrow.ROW_CLASS}" width="5%" align="center" valign="middle"><img src="{listrow.PRIVMSG_FOLDER_IMG}" width="19" height="18" alt="{listrow.L_PRIVMSG_FOLDER_ALT}" title="{listrow.L_PRIVMSG_FOLDER_ALT}"></td>
   <td width="55%" valign="middle" class="{listrow.ROW_CLASS}"><span class="topictitle">&nbsp;<a href="{listrow.U_READ}" class="topictitle">{listrow.SUBJECT}</a></span></td>
   <td width="20%" valign="middle" align="center" class="{listrow.ROW_CLASS}"><span class="name">&nbsp;<a href="{listrow.U_FROM_USER_PROFILE}" class="name">{listrow.FROM}</a></span></td>
   <td width="15%" align="center" valign="middle" class="{listrow.ROW_CLASS}"><span class="postdetails">{listrow.DATE}</span></td>
   <td width="5%" align="center" valign="middle" class="{listrow.ROW_CLASS}"><span class="postdetails"><input type="checkbox" name="mark[]2" value="{listrow.S_MARK_ID}"></span></td>
  </tr>
  <!-- END listrow -->
  <!-- BEGIN switch_no_messages -->
  <tr> 
   <td class="row1" colspan="5" align="center" valign="middle"><span class="gen">{L_NO_MESSAGES}</span></td>
  </tr>
  <!-- END switch_no_messages -->
  <tr> 
   <td class="catBottom" colspan="5" height="28" align="right"> {S_HIDDEN_FIELDS} 
    <input type="submit" name="save" value="{L_SAVE_MARKED}" class="mainoption"> &nbsp; 
    <input type="submit" name="delete" value="{L_DELETE_MARKED}" class="liteoption"> &nbsp; 
    <input type="submit" name="deleteall" value="{L_DELETE_ALL}" class="liteoption">
	</td>
  </tr>
 </table>
</form>

<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
 <tr> 
  <td class="nav" align="left" valign="top" width="50">{POST_PM_IMG}</td>
  <td align="center" valign="top">{JUMPBOX}</td>
  <td class="nav" align="right" valign="top" nowrap="nowrap">{PAGE_NUMBER}<br>
   {PAGINATION} 
  </td>
 </tr>
</table>

