<?php
require "config.inc.php";
if($config['database'])
	require "database.php";

require "extensions/functions.php"; //Plug functions
require "extensions/extended.php"; //Extended functions
if($config['css_preprocessor'] && file_exists("extensions/css_preprocessor.php"))
{
  require "extensions/css_preprocessor.php";
}
else
{
  echo "Error: CSS Preprocessor 'Enabled' but Not Installed! -- Disabling<br>";
  $config['css_preprocessor'] = false;
}

$theme_request = $_REQUEST['theme'];
$process_css = $_REQUEST['css'];
$rss = $_REQUEST['rss'];

/*For testing purposes you may want to load a different theme by argument*/

if(!empty($theme_request))
{
	$config['theme'] = $theme_request;
}

$headlines = ""; //The lines added to the head section

//Look to see about upgraderequire "extentions/extended.php"; //Extended functions

if(file_exists("upgrade/upgrade.alp"))
{
	echo("<html></body>\n");
	$file = fopen("upgrade/upgrade.alp","r");
	while(!feof($file))
	{
		$source=rtrim(fgets($file));
		$dest=rtrim(fgets($file));
		if($source!='')
		{
			if($source!='')
			{
				copy("upgrade/$source",$dest);
				echo("($source, $dest) was Successful!<br>\n");
			}
			else
			{
				echo 'No Path';
			}
		}
	}
	fclose($file);

	//Remove files and directory of upgrade so site can return to normal operation.
	$dir = "upgrade/"; 
	$d = dir($dir); 
	while($entry = $d->read())
	{ 
	    if ($entry!= "." && $entry!= "..")
	    { 
		unlink($dir.$entry); 
	    } 
	} 
	$d->close(); 
	rmdir($dir);

	die("<h2>Upgrade Complete!</h2>\n</body></html>");
}

session_start(); //Start session, and site.

if(isset($_SESSION['username'])) {
	$logged_in = TRUE;
	$user_id = $_SESSION['user_id'];
}
else {
	$logged_in = FALSE;
}
$root = $config['root'];

global $logged_in;
global $user_id;

$page = $_REQUEST['page'];
if(!isset($_REQUEST['page']))
    $page = "master";
$path = 'pages/'.$page;

function plug_body()
{
    global $TACK, $config, $path, $page, $toggle;

    if(file_exists("$path.php"))
    {
	$pType = "php";
        global $output;
        include "$path.php";
	return $pType;
    }
    else if(file_exists("$path.html"))
    {
	$pType = "html";
	global $output;
	$fh = fopen("$path.html", 'r');
	$output = fread($fh, filesize("$path.html"));
	fclose($fh);
	return $pType;
    }
    else if(file_exists("$path.txt"))
    {
	$pType = "text";
	global $output;
	$fh = fopen("$path.txt", 'r');
	$output = fread($fh, filesize("$path.txt"));
	fclose($fh);
	return $pType;
    }
    else if(file_exists("$path.bb"))
    {
	$pType = "BBCode";
	global $output;
	$fh = fopen("$path.bb", 'r');
	$output = articleFormat(fread($fh, filesize("$path.bb")));
	fclose($fh);
	return $pType;
    }

    else
    {
        return "Page Not Found!";
    }
}

function plug_theme()
{
    global $config;
    return $config['theme'];
}

function plug_path($file) //Does not support reclusive
{
    global $page;
    $sp = explode('/', $page);
    return "pages/${sp[0]}/$file";
}

function plug_headline($line) //Add line to the head section
{
    global $headlines;
    $headlines .= $line."\n";
}

function plug_head() //Call to return lines added to head area
{
    global $headlines;
    return $headlines;
}

function plug_banner() //Call to return banner text from config
{
    global $config;
    return $config['banner_text'];
}

function plug_navbar() //Call to return nav plugin name from config
{
    global $config;
    return $config['navbar'];
}

function plug_check_forms()
{
    global $config;
    return $config['check_forms'];
}

function plug_database($table)
{
    global $DatabaseTables;
    return $DatabaseTables[$table];
}

if($config['error_display'])
{
    function plug_errors()
    {
      global $page, $config;
	   $file = fopen("errors.cfg","r");
	   while(!feof($file))
	   {
	      $name=rtrim(fgets($file));
	      $message=rtrim(fgets($file));
	      if($name==$page)
	      {
		     if($message!='')
		       return "alert('".addslashes($message)."')";
	      }
	    }
      fclose($file);
    }
}
else
{
    function plug_errors() {}
}

if($config['login_system']) //Login Functions
{
    function plug_logged_in()
    {
	    global $logged_in;
	    return $logged_in;
    }

    function plug_do_login()
    {
	    $right_here = urlencode($_SERVER['SCRIPT_NAME'].'?'.$_SERVER['QUERY_STRING']);
	    echo('<meta http-equiv="refresh" content="0;url=?page=user/login&arg=s3&url='.$right_here.'">');
    }
    
    function plug_check_login($username, $password, $action='')
    {
        $sql="SELECT * FROM ".plug_database("Users")." WHERE username='$username' AND password='$password';";
        $result=mysql_query($sql);

	if($action == "login") /*This will set the session vars*/
	{
		if(plug_logged_in())
		{
			session_destroy();
		}
		while($row = mysql_fetch_array($result))
		{
			$user_id = $row['id'];
			$access_level = $row['access'];
			$ulname = $row['first_name'];
			$ufname = $row['last_name'];
			$username = $row['username'];

			/*Access System*/
			if($access_level >= 50)
				$access = "basic";
			if($access_level >= 100)
				$access = "moderate";
			if($access_level >= 150)
				$access = "advanced";
			if($access_level >= 200)
				$access = "advanced";
			if($access_level >= 250)
				$access = "admin";

			$_SESSION['username'] = $username;
			$_SESSION['first_name'] = $ufname;
			$_SESSION['last_name'] = $ulname;
			$_SESSION['user_id'] = $user_id;
			$_SESSION['access_level'] = $access_level;
			$_SESSION['access'] = $access;
		}
	}

        // Count rows; This is the only thing that is run if action is not set to login.
        $count=mysql_num_rows($result);
        // If result matched $username and $password, table row must be 1 row

        if($count==1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
}

/*In case we are calling the CSS file with ?css=theme_name*/

if(isset($process_css) && $config['css_preprocessor'])
{
    $config['theme'] = $process_css;
    require_once plug_theme_path("styling.php");
}
else
{
  require 'themes/'.$config['theme'].'/main.php'; //Load theme file
}


?>
