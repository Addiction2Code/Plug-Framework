<?php
global $root;
if(!empty($root))
{
	$root = $root.'/';
}
$output = '';
$output .= '
<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" class="login_table_head">
<tr>
<form name="form1" method="post" action="/'.$root.'?page=user/checklogin">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="login_table_body">';
$arg1 = $_REQUEST['arg'];
if(!empty($_REQUEST['read']))
{
	$goto_url = urlencode("/?read=".$_REQUEST['read']);
}

if(!empty($_REQUEST['url']))
{
	$goto_url = urlencode(substr($_REQUEST['url'], 1));
}

if($arg1 == "s2")
{ $output .= '<tr><td colspan="3" class="mItem">Wrong Username or Password.</td></tr>'; }
if($arg1 == "s3")
{ $output .= '<tr><td colspan="3" class="mItem">You must be logged in to do that.</td></tr>'; }
if($arg1 == "logout")
{
	if(!plug_logged_in()) { $output = '<tr><td colspan="3" class="mItem">You weren\'t logged in.</td></tr>'; }
	else {
		session_destroy();
		$output .= '<tr><td colspan="3" class="mItem">You are now Logged Out</td></tr>';
	}
}
if($arg1 == "" & plug_logged_in()) {
	$output .= '<meta http-equiv="refresh" content="4;url=?">';
	$output .= '<tr><td colspan="3" class="mItem">You Will Be Redirected In 4 Seconds</td></tr>';
	$output .= '<tr><td colspan="3" class="mItem"><a href="?page=user/login&arg=logout">Would You Like To Logout?</a></td></tr>';
	//echo('<tr><td colspan="3" class="mItem"><a href="index.php?page=cpanel">Did you mean Control Panel?</a></td></tr>');
}
else
{
    $output .= '<tr><td colspan="3" class="mItem">Not A Member? <a href="?page=user/register">Register Here.</a></td></tr>';
}
$output .= '<tr>
<td colspan="3"><strong>Member Login</strong></td>
</tr>
<tr>
<td width="78">Username</td>
<td width="6">:</td>
<td width="294"><input name="myusername" type="text" id="myusername"></td>
</tr>
<tr>
<td>Password</td>
<td>:</td>
<td><input name="mypassword" type="password" id="mypassword"></td>
<input type="hidden" name="url" value="'.$goto_url.'">
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Login"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>';
