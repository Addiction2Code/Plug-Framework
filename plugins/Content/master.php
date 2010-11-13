<?php

if(isset($args))
	$page = $args;
else
	global $page;

$resulta = mysql_query("SELECT * FROM ".plug_database("Content")." WHERE page='$page'");
while($row = mysql_fetch_array($resulta))
{
	$a_id = $row['author_id'];
	$resultb = mysql_query("SELECT * FROM ".plug_database("Users")." WHERE id='$a_id'");
	$row2 = mysql_fetch_array($resultb);
	$author = $row2['username'];
	$photo = $row2['photo'];
	$content = $row['content'];
}

	$plugin['root'] = 'single';
	$plugin['body'] = "<div class=\"information\"><p><img src=\"$photo\" class=\"float_right\">{$content}</p></div>";

?>
