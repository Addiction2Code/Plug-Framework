<?php

    global $page;

    if($page == "master" || $page == "terms" || $page == "donate")
    {
	    $list = '
			<div class="sponsor_left">
			  <a class="blank" href="http://www.tpuc.org/"><img class="blank" src="resources/images/sponsor/tpuc_100x42.png" /></a>
			</div>
			<div class="sponsor_right">
			  <a class="blank" href="http://PastGone.com/"><img class="blank" src="resources/images/sponsor/PastGone_150x48_d.png" /></a>
			</div>
		';
    }
    else
    {
	$list = '<!-- No Sponsor Links on Play Page -->';
    }

    $plugin['root'] = "single";
    $plugin['body'] = $list;

?>
