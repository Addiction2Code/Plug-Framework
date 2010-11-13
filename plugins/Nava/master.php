<?php

//This file reads and processes the file navabar.cfg in this application/site's root directory.

function plugin_navbar()
{
	global $page, $config;
	$file = fopen("navabar.cfg","r");
	while(!feof($file))
	{
		$name=rtrim(fgets($file));
		$path=rtrim(fgets($file));
		if($name!='')
		{
			if($config['login_system'])
			{
				if($name == '&Login')
				{
					if(plug_logged_in())
					{
						$name = 'Logout';
						$path = 'user/login&arg=logout';
						$text = $_SESSION['username'];
					}
					else
					{
						$name = 'Login';
					}
				}
			}

			if($config['database'])
			{
				$name = explode('|', $name);
				if($name[0] == "&Content")
				{
					$name[0] = $name[1];
					$path = "plugin&plug=Content&arg={$path}";
				}
				$name = $name[0];
			}

			if($path == $page)
				echo '<li id="active"><a href="?page='.$path.'" id="current" title="'.$text.'">'.$name.'</a></li>';
			else if($path!='')
				echo '<li><a href="?page='.$path.'" title="'.$text.'">'.$name.'</a></li>';
			else
				echo '<li><a href="?">'.$name.'</a></li>';
		}
	}
    fclose($file);
}
    $plugin['root'] = "single";
    $plugin['body'] = plugin_navbar();
?>
