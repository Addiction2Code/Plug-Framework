<?php

global $config;

// Connect to server and select databse.

// username and password sent from form
if(isset($_POST['url']))
	$url = '/'.htmlentities($_POST['url']);
$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$mypassword = md5($mypassword);

if(empty($config['root']))
    $pretack = "";
else
    $pretack = '/'.$config['root'];

if(plug_check_login($myusername, $mypassword, 'login')) /*If Correct, login and return true, else return false*/
{
	$output .= "<div style=\"text-align: center\"><img src=\"resources/images/loading.gif\"></div>";
	if(strlen($url) > 1)
	{
		plug_headline("<META HTTP-EQUIV=REFRESH CONTENT=\"3; URL=".urldecode($url)."\">");
	}
	else
	{
		plug_headline("<META HTTP-EQUIV=REFRESH CONTENT=\"3; URL={$pretack}/?\">");
	}
}
else
{
	if(!empty($_POST['url']))
		$pre = "&url=/{$_POST['url']}";
	echo("<META HTTP-EQUIV=REFRESH CONTENT=\"0; URL={$pretack}/?page=user/login&arg=s2{$pre}\">");
}
?>
