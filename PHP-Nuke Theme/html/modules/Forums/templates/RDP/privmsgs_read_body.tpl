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

<table cellspacing="2" cellpadding="2" border="0" align="center">
 <tr> 
  <td valign="middle">{INBOX_IMG}</td>
  <td valign="middle"><span class="cattitle">{INBOX} &nbsp;</span></td>
  <td valign="middle">{SENTBOX_IMG}</td>
  <td valign="middle"><span class="cattitle">{SENTBOX} &nbsp;</span></td>
  <td valign="middle">{OUTBOX_IMG}</td>
  <td valign="middle"><span class="cattitle">{OUTBOX} &nbsp;</span></td>
  <td valign="middle">{SAVEBOX_IMG}</td>
  <td valign="middle"><span class="cattitle">{SAVEBOX}</span></td>
 </tr>
</table>
<br><hr>

<form method="post" action="{S_PRIVMSGS_ACTION}">
 <table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr>
   <td valign="middle">
    <span class="gensmall">{S_TIMEZONE}</span><br>
    <span class="nav">&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a></span><br><br>
    {REPLY_PM_IMG}
   </td>
  </tr>
 </table>
 <br>

 <table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
  <tr> 
   <th colspan="3" class="thHead" nowrap="nowrap">{BOX_NAME} :: {L_MESSAGE}</th>
  </tr>
  <tr> 
   <td class="row2"><span class="genmed">{L_FROM}:</span></td>
   <td width="100%" class="row2" colspan="2"><span class="genmed">{MESSAGE_FROM}</span></td>
  </tr>
  <tr> 
   <td class="row2"><span class="genmed">{L_TO}:</span></td>
   <td width="100%" class="row2" colspan="2"><span class="genmed">{MESSAGE_TO}</span></td>
  </tr>
  <tr> 
   <td class="row2"><span class="genmed">{L_POSTED}:</span></td>
   <td width="100%" class="row2" colspan="2"><span class="genmed">{POST_DATE}</span></td>
  </tr>
  <tr> 
   <td class="row2"><span class="genmed">{L_SUBJECT}:</span></td>
   <td width="100%" class="row2"><span class="genmed">{POST_SUBJECT}</span></td>
   <td nowrap="nowrap" class="row2" align="right"> {QUOTE_PM_IMG} {EDIT_PM_IMG}</td>
  </tr>
  <tr> 
   <td valign="top" colspan="3" class="row1"><span class="postbody">{MESSAGE}</span></td>
  </tr>
  <tr> 
   <td width="78%" height="28" valign="bottom" colspan="3" class="row1"> 
    <table cellspacing="0" cellpadding="0" border="0" height="18">
     <tr> 
      <td valign="middle" nowrap="nowrap">{PROFILE_IMG} {PM_IMG} {EMAIL_IMG} {WWW_IMG} {AIM_IMG} {YIM_IMG} {MSN_IMG}</td>
      <td>&nbsp;</td>
      <td valign="top" nowrap="nowrap"><script language="JavaScript" type="text/javascript"><!-- 
       if ( navigator.userAgent.toLowerCase().indexOf('mozilla') != -1 && navigator.userAgent.indexOf('5.') == -1 )
         document.write('{ICQ_IMG}');
       else
         document.write('<div style="position:relative"><div style="position:absolute">{ICQ_IMG}</div><div style="position:absolute;left:3px">{ICQ_STATUS_IMG}</div></div>');
       //--></script><noscript>{ICQ_IMG}</noscript>
      </td>
     </tr>
    </table>
   </td>
  </tr>
  <tr>
   <td class="catBottom" colspan="3" height="28" align="right"> {S_HIDDEN_FIELDS} 
    <input type="submit" name="save" value="{L_SAVE_MSG}" class="liteoption"> &nbsp; 
    <input type="submit" name="delete" value="{L_DELETE_MSG}" class="liteoption">
   </td>
  </tr>
 </table>
</form>

<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
 <tr> 
  <td class="nav" align="left" valign="top" width="50">{REPLY_PM_IMG}</td>
  <td align="center" valign="top">{JUMPBOX}</td>
 </tr>
</table>
