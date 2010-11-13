<?php

//Use Juice to load up plugins (development)

function LoadFiles($path='')
{
	if ($handle = opendir($path)) {
	    $f_array = array();
	    /* This is the correct way to loop over the directory. */
	    while (false !== ($file = readdir($handle))) {
		if($file != "." && $file != "..")
		{
			$f_array[] = $file."|".filemtime($path.'/'.$file);
		}
	    }
	    closedir($handle);
	}

	foreach($f_array as $file)
	{
		$n1 = explode("|", $file);
		$content .= "<a href=\"".curPageURL()."&load={$n1[0]}\">{$n1[0]}</a><br>\n";
	}
	return $content;
}

global $config;

$load = $_REQUEST['load'];
if(isset($load))
{
	$output .= plugin($load, $TACK['Blank'], $args);
}
else
{
	$output .= LoadFiles($config['plugins']);
}

?>
