<?php

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

	$content .= "<div style=\"text-align: center;\"><pre>";
	foreach($f_array as $file)
	{
		$n1 = explode("|", $file);
		$content .= str_pad($n1[0], 50)."Last modified ".date("l, dS F, Y @ h:ia", $n1[1])."\n";
	}
	$content .= "</pre></div>";
	return $content;
}

  $plugin['root'] = 'single';

  /*Handling*/
  if($argument[0] == NULL)
  {
    $plugin['body'] = "<pre>For Plugin: {$plugin_name}; Invalid Argument Set!</pre>";
  }
  else
  {
    $plugin['body'] = LoadFiles($argument[0]);
  }

?>
