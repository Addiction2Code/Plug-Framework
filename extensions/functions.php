<?php

function plug_image($location, $h, $w, $a='images', $zc=1)
{
    if(empty($a))
    {
	return '<a class="blank thickbox" href="'.$location.'" rel="gallery"><img class="border" src="resources/timthumb.php?src='.$location.'&h='.$h.'&w='.$w.'&zc='.$zc.'" /></a>'."\n";
    }
    else
    {
	return '<a class="blank thickbox" href="'.$location.'" rel="gallery_'.$a.'"><img class="border" src="resources/timthumb.php?src='.$location.'&h='.$h.'&w='.$w.'&zc='.$zc.'" /></a>'."\n";
    }
}

function plug_theme_path($part) //Determining Importance
{
    return "themes/".plug_theme()."/{$part}";
}

function mysql2table($date)
{
	$new = explode("-",$date);
	$a=array ($new[1], $new[2], $new[0]);
	return $n_date=implode("/", $a);
}

function table2mysql($year,$month,$day)
{
	if ($day<=9) { $day="0".$day; }
	if ($month<=9) { $month="0".$month; }
	$a=array ($year, $month, $year);
	return $n_date=implode("-", $a);
}

function plug_web_safe($string)
{
	$what = array("\'", '\'', ' ');
	$replace = array('');
	$text = $string;
	$final = str_replace($what, $replace, $text);
	return $final;
}

function findexts($filename)
{
	$filename = strtolower($filename) ;
	$exts = split("[/\\.]", $filename) ;
	$n = count($exts)-1;
	$exts = $exts[$n];
	return $exts;
}

function plugin($plugin_name, $tackstyle /*CSS Class of Container Div*/, $arguments='')
{
    global $config;
    $master_page = "master.php";
    $plugin_path = "{$config['plugins']}/{$plugin_name}/{$master_page}";
	if(file_exists($plugin_path))
	{
	    $argument = explode("|", $arguments); /*Create Argument Array*/
	    require_once $plugin_path;
	    if(!empty($tackstyle)) /*If tack is empty, don't cover content in div*/
	    {
	        $divo = "<div class=\"{$tackstyle}\">";
	        $dive = "</div>";
	    }
	    $root = $plugin['root'];
	    if($root == "single")
	    {
	    	$result = $divo.$plugin['body'].$dive;
	        return $result;
	    }
	    else
	    {
	        $ext = findexts($root);
	        $root = $config['plugins'].'/'.$plugin_name.'/'.$root;
		    if($ext == "html")
		    {
			    $handle = fopen($app, 'r') or die("Couldn't load plugin");
			    $data = fread($handle, filesize($root));
			    fclose($handle);
	        	$result = $divo.$data.$dive;
			    echo $result;
		    }
		    else if($ext == "php")
		    {
			    global $plugin;
			    global $DatabaseTables;
			    require $root;
			    $result = $divo.$content.$dive;
			    return $result;
		    }
		    $headlines = $plugin['headlines']."\n";
	        return $headlines;
        }
   	}
	else
	{
	    echo "<br>Plugin Does Not Exist!<br>";
	}
}

function expand($title, $content)
{
    return '<font class="textish"><img src="resources/images/expand.gif" onclick="showContent(this);" />&nbsp;'.$title.'</font>
    <div class="expand" style="margin-left: 30px; display:none;">'.$content.'</div>';
}

function curPageURL()
{
	$pageURL = 'http';
	//if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80")
	{
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	}
	else
	{
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

// Function to parse a url and extract its arguments.
function process_url($url)
{
	$processed_url = parse_url( $url );
	$query_string = $processed_url[ 'query' ];

	# split into arguments and values

	$query_string = explode( '&amp;', $query_string );
	$args = array( ); // return array
	foreach( $query_string as $chunk )
	{
		$chunk = explode( '=', $chunk );
		// it's only really worth keeping if the parameter
		// has an argument.
		if ( count( $chunk ) == 2 )
		{
			list( $key, $val ) = $chunk;
			$args[ $key ] = urldecode( $val );
		}
	}

	return $args;
}

function plug_argument_change($what, $value, $page='')
{
	if(empty($page))
		global $page;

	$new_url = '?page='.$page;
	$url = htmlentities(curPageURL());
	$result = process_url($url);
	unset($result['page']);
	$result[$what] = $value;
	foreach($result as $name => $arg)
	{
		$new_url .= "&amp;{$name}={$arg}";
	}
	return $new_url;
}

function plug_get_args()
{
	$new_args = '';
	$result = process_url(htmlentities(curPageURL()));
	unset($result['page']);
	foreach($result as $name => $arg)
	{
		$new_args .= "&amp;{$name}={$arg}";
	}
	return $new_args;
}

function pass_args()
{
	global $args;
	return $args;
}

?>
