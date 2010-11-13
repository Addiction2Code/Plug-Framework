<?php
$arg1 = $_REQUEST['url'];
plug_headline('<meta http-equiv="REFRESH" content="0;url='.$arg1.'">');
$output .= "If you are not redirected click <a href=\"$arg1\">Here</a>";
?>
