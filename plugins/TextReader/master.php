<?php

function reader($file) {
	$fh = fopen($file, 'r');
	$theData = nl2br(htmlentities(fread($fh, filesize($file))));
	fclose($fh);
	return $theData;
}

  $plugin['root'] = 'single'; 
  $plugin['body'] = reader($argument[0]);

?>
