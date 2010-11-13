<?php

/*For each page you want a counter, you should create the appropriate page_counter.txt file, although it does create it automatically*/
/*Use Tack Styles to type, if you don't want a separate counter per page, leave args blank (with use with plugin function)*/

function increase_count($counter='') {
	$count_my_page = ("plugins/HitCounter/{$counter}_counter.txt");
	$hits = file($count_my_page);
	$hits[0] ++;
	$fp = fopen($count_my_page , "w");
	fputs($fp , "$hits[0]");
	fclose($fp);
	return str_pad($hits[0], 4, 0, STR_PAD_LEFT);
}

    $plugin['root'] = "single";
    $plugin['body'] = increase_count($argument[0]);

?>
