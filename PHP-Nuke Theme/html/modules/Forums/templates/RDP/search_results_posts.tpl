<table class="block-border" width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="block-body">
 <table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
   <td align="left">
    <span class="maintitle">{L_SEARCH_MATCHES}</span><br>
    <span class="gensmall">{S_TIMEZONE}</span><br>
    &nbsp;<span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span>
   </td>
  </tr>
 </table>
</td></tr></table>
<br>

<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline" align="center">
 <tr> 
  <th width="150" height="25" class="thCornerL" nowrap="nowrap">{L_AUTHOR}</th>
  <th width="100%" class="thCornerR" nowrap="nowrap">{L_MESSAGE}</th>
 </tr>
 <!-- BEGIN searchresults -->
 <tr> 
  <td class="catHead" colspan="2" height="28"><span class="topictitle"><img src="modules/Forums/templates/RDP/images/folder.gif" align="absmiddle">&nbsp; {L_TOPIC}:&nbsp;<a href="{searchresults.U_TOPIC}" class="topictitle">{searchresults.TOPIC_TITLE}</a></span></td>
 </tr>
 <tr> 
  <td width="150" align="left" valign="top" class="row1" rowspan="2"><span class="name"><b>{searchresults.POSTER_NAME}</b></span><br><br>
   <span class="postdetails">{L_REPLIES}: <b>{searchresults.TOPIC_REPLIES}</b><br>
   {L_VIEWS}: <b>{searchresults.TOPIC_VIEWS}</b></span><br />
  </td>
  <td width="100%" valign="top" class="row1"><img src="{searchresults.MINI_POST_IMG}" width="12" height="9" alt="{searchresults.L_MINI_POST_ALT}" title="{searchresults.L_MINI_POST_ALT}" border="0" /><span class="postdetails">{L_FORUM}:&nbsp;<b><a href="{searchresults.U_FORUM}" class="postdetails">{searchresults.FORUM_NAME}</a></b>&nbsp; &nbsp;{L_POSTED}: {searchresults.POST_DATE}&nbsp; &nbsp;{L_SUBJECT}: <b><a href="{searchresults.U_POST}">{searchresults.POST_SUBJECT}</a></b></span></td>
 </tr>
 <tr>
  <td valign="top" class="row1"><span class="postbody">{searchresults.MESSAGE}</span></td>
 </tr>
 <!-- END searchresults -->
 <tr> 
  <td class="catBottom" colspan="2" height="28" align="center">&nbsp; </td>
 </tr>
</table>
<br>

<table class="block-border" width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="block-body">
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
</td></tr></table>
