<?php
$id = $_REQUEST['id'];
$result = mysql_query("SELECT * FROM ".plug_database("Users")." WHERE id='{$id}'");
while($row = mysql_fetch_array($result))
{
    $uname = $row['username'];
    $fname = $row['first_name'];
    $lname = $row['last_name'];
    $photo = $row['photo'];
    $last_login = $row['last_login'];
    $email = $row['email'];
    $website = $row['website'];
}

if(mysql_num_rows($result))
{
    $ll = date('l, F N Y', strtotime($last_login));
    $output .= "<table border=\"0\" width=\"100%\"><tr><td align=\"left\">";
    $output .= "<font class=\"textish\">Username: {$uname}</font><br>";
    $output .= "<font class=\"textish\">Real Name: {$fname} {$lname}</font><br>";
    $output .= "<font class=\"textish\">Last Login: <b>{$ll}</b></font><br>";
    $output .= "<font class=\"textish\">Private Email: <a href=\"?page=user/mail&select={$id}\">Here</a></font>";
    if(!empty($website))
        $output .= "<hr><font class=\"textish\">Website: <a target=\"new\" href=\"{$website}\">{$website}</a></font>";
    $output .= "</td><td align=\"right\">";
    $output .= "<img src=\"{$photo}\" height=\"100px\" width=\"100px\"/>";
    $output .= "</tr></table>";
}

$result2 = mysql_query("SELECT * FROM ".plug_database("Categories")." WHERE author='{$id}'");
if(mysql_num_rows($result))
	$output .= "<h3>Comic Contributions</h3><hr>";
while($row2 = mysql_fetch_array($result2))
{
    $cid = $row2['id'];
    $name = $row2['name'];
    $type = $row2['type'];
    $output .= "<font class=\"textish\"><a href=\"?page=comics/collections&id={$cid}\">{$name}</a><br></font>";
}


?>
