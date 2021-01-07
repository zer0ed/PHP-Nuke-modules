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

<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0" align="center">
 <tr>
  <th class="thHead">{L_FAQ_TITLE}</th>
 </tr>
 <tr>
  <td class="row1">
  <!-- BEGIN faq_block_link -->
  <span class="gen"><b>{faq_block_link.BLOCK_TITLE}</b></span><br>
  <!-- BEGIN faq_row_link -->
  <span class="gen"><a href="{faq_block_link.faq_row_link.U_FAQ_LINK}" class="postlink">{faq_block_link.faq_row_link.FAQ_LINK}</a></span><br>
  <!-- END faq_row_link -->
  <br>
  <!-- END faq_block_link -->
  </td>
 </tr>
 <tr>
  <td class="catBottom" height="28">&nbsp;</td>
 </tr>
</table>
<br>

<!-- BEGIN faq_block -->
<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0" align="center">
 <tr> 
  <td class="catHead" height="28" align="center"><span class="cattitle">{faq_block.BLOCK_TITLE}</span></td>
 </tr>
<!-- BEGIN faq_row -->  
 <tr> 
  <td class="{faq_block.faq_row.ROW_CLASS}" align="left" valign="top"><span class="postbody"><a name="{faq_block.faq_row.U_FAQ_ID}"></a><b>{faq_block.faq_row.FAQ_QUESTION}</b></span><br><span class="postbody">{faq_block.faq_row.FAQ_ANSWER}<br><a class="postlink" href="#Top">{L_BACK_TO_TOP}</a></span></td>
 </tr>
 <tr>
  <td class="spaceRow" height="1"><img src="modules/Forums/templates/RDP/images/spacer.gif" alt="" width="1" height="1"></td>
 </tr>
<!-- END faq_row -->
</table>
<br>
<!-- END faq_block -->
