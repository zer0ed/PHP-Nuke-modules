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

<form method="post" action="{S_SPLIT_ACTION}">
 <table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
   <td align="left">
    <span class="gensmall">{S_TIMEZONE}</span><br>
    &nbsp;<span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span>
   </td>
  </tr>
 </table>
 <br>
 
 <table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
  <tr> 
   <th height="25" class="thHead" colspan="3" nowrap="nowrap">{L_SPLIT_TOPIC}</th>
  </tr>
  <tr> 
   <td class="row2" colspan="3" align="center"><span class="gensmall">{L_SPLIT_TOPIC_EXPLAIN}</span></td>
  </tr>
  <tr> 
   <td class="row1" nowrap="nowrap"><span class="gen">{L_SPLIT_SUBJECT}</span></td>
   <td class="row2" colspan="2"><span class="courier"><input type="text" size="35" style="width: 350px" maxlength="100" name="subject" class="post"></span></td>
  </tr>
  <tr> 
   <td class="row1" nowrap="nowrap"><span class="gen">{L_SPLIT_FORUM}</span></td>
   <td class="row2" colspan="2"><span class="courier">{S_FORUM_SELECT}</span></td>
  </tr>
  <tr> 
   <td class="catHead" colspan="3" height="28"> 
    <table width="60%" cellspacing="0" cellpadding="0" border="0" align="center">
     <tr> 
      <td width="50%" align="center"> 
       <input class="liteoption" type="submit" name="split_type_all" value="{L_SPLIT_POSTS}">
      </td>
      <td width="50%" align="center"> 
       <input class="liteoption" type="submit" name="split_type_beyond" value="{L_SPLIT_AFTER}">
      </td>
     </tr>
    </table>
   </td>
  </tr>
  <tr> 
   <th class="thLeft" nowrap="nowrap">{L_AUTHOR}</th>
   <th nowrap="nowrap">{L_MESSAGE}</th>
   <th class="thRight" nowrap="nowrap">{L_SELECT}</th>
  </tr>
  <!-- BEGIN postrow -->
  <tr> 
   <td align="left" valign="top" class="{postrow.ROW_CLASS}"><span class="name"><a name="{postrow.U_POST_ID}" class="name"></a>{postrow.POSTER_NAME}</span></td>
   <td width="100%" valign="top" class="{postrow.ROW_CLASS}"> 
    <table width="100%" cellspacing="0" cellpadding="3" border="0">
     <tr> 
      <td valign="middle"><img src="modules/Forums/templates/RDP/images/icon_minipost.gif" alt="{L_POST}"><span class="postdetails">{L_POSTED}: 
       {postrow.POST_DATE}&nbsp;&nbsp;&nbsp;&nbsp;{L_POST_SUBJECT}: {postrow.POST_SUBJECT}
      </span></td>
     </tr>
     <tr> 
      <td valign="top"> 
      <hr size="1" />
      <span class="postbody">{postrow.MESSAGE}</span></td> 
     </tr>
    </table>
   </td>
   <td width="5%" align="center" class="{postrow.ROW_CLASS}">{postrow.S_SPLIT_CHECKBOX}</td>
  </tr>
  <tr> 
   <td colspan="3" height="1" class="row3"><img src="modules/Forums/templates/RDP/images/spacer.gif" width="1" height="1" alt="."></td>
  </tr>
  <!-- END postrow -->
  <tr> 
   <td class="catBottom" colspan="3" height="28"> 
    <table width="60%" cellspacing="0" cellpadding="0" border="0" align="center">
     <tr> 
      <td width="50%" align="center"> 
       <input class="liteoption" type="submit" name="split_type_all" value="{L_SPLIT_POSTS}" />
      </td>
      <td width="50%" align="center"> 
       <input class="liteoption" type="submit" name="split_type_beyond" value="{L_SPLIT_AFTER}" />
       {S_HIDDEN_FIELDS}
      </td>
     </tr>
    </table>
   </td>
  </tr>
 </table>
</form>
