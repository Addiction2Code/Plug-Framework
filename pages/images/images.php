<?php

global $config;

function RemoveExtension($strName)
{
	$ext = strrchr($strName, '.');

	if($ext !== false)
	{
		$strName = substr($strName, 0, -strlen($ext));
	}
	return $strName;
}

function get_all_pictures($path)
{
	$r = array();
	if ($h = opendir($path)) {
		while (false !== ($f = readdir($h))) {
			$e = substr($f, -4);
			if($e == '.jpg' || $e == '.png')
			{
				$ee = substr($f, -12);
				if($ee != '.default.jpg')
				{
					$r[] = $f;
				}
			}
		}
		closedir($h);
		return $r;
	}
	else
	{
		return false;
	}
}

function get_all_albums($path)
{
	$r = array();
	if ($h = opendir($path)) {
		while (false !== ($f = readdir($h))) {
			$e = substr($f, -6);
			if($e == '.album')
				$r[] = $f;
		}
		closedir($h);
		return $r;
	}
	else
	{
		return false;
	}
}

$x = 0;
$cstat = false;
$rstat = false;
$output = '';
$path = $config['media_albums'];
$create = $_POST['create'];
$rename = $_POST['rename'];
$album = $_REQUEST['album'];
$edit = $_REQUEST['edit'];
$add = $_REQUEST['add'];
$Args = pass_args();

if(isset($add) && $_SESSION['access'] == "admin")
{
	if(isset($create) && mkdir("{$path}".urlencode($create).".album", "0700"))
	{
		$message = "{$add} Was Created!";
		$cstat = true;
	}
	if(!$cstat)
	{
		$output .= '<form method="post" action='.curPageURL().'><input type="text" name="create" value="" /><br><input type="submit" name="submit" value="Create" /></form><br><hr/><br>';
	}
}

if(isset($edit) && $_SESSION['access'] == "admin")
{
	if(isset($rename) && rename("{$path}{$edit}", "{$path}".plug_web_safe($rename).".album"))
	{
		$message = "{$edit} Renamed to {$rename}.album";
		$rstat = true;
	}
	if(!$rstat)
	{
		$output .= '<form method="post" action='.curPageURL().'><input type="text" name="rename" value="'.RemoveExtension($edit).'" /><br><input type="submit" name="submit" value="Rename" /></form><br><hr/><br>';
	}
}

if(isset($album))
{
	$output .= "<table width=\"500px\" align=\"center\"><tr><td style=\"text-align: left;\"><h3>{$album}</h3></td><td style=\"text-align: right;\"><h3><a href=\"?page=images/images\">Back</a></h3></td></tr></table>";
	$output .= '<table id="gallery" align="center"><tr>';
	$array = get_all_pictures("{$path}{$album}/");
	if($array != false)
	{
		foreach($array as $photo)
		{
			$photos = '<td class="thumb-image">'.plug_image($path.$album.'/'.$photo, 90, 90, $album).'</td>';
			if($x % 4 == 0)
			{
				$output .= "</tr><tr>{$photos}";
			}
			else
			{
				$output .= $photos;
			}
			$x++;
		}
	}
	else
	{
		$output .= "<h3>No Such Album, Sorry.</h3>";
	}
}
else
{
	if($_SESSION['access'] == "admin")
	{
		$output .= "<a href=\"".plug_argument_change('add', "album")."\">Create Album</a>&nbsp;<a href=\"?page=images/upload\">Upload Images</a><hr/><br>";
	}
	$output .= "<center><h3>All Albums</h3></center>";
	$array = get_all_albums($path);
	$output .= '<table id="gallery" align="center"><tr>';
	if($array != false)
	{
		foreach($array as $album)
		{
			if($_SESSION['access'] == "admin")
			{
				$tdiv = '<a class="blank" href="'.plug_argument_change('edit', $album, 'images/images').'"><img class="blank" src="resources/images/edit.png" /></a>';
			}

			$default_cover_image = $path.$album.'/cover.default.jpg';
			if(file_exists($default_cover_image))
			{
				$cover_image = $default_cover_image;
			}
			else
			{
				$cover_image = $config['no_cover'];
			}

			$albums = '<td class="thumb_image"><a href="?page=images/images&album='.$album.''.$Args.'" title="'.$album.'">'.
					'<img src="resources/timthumb.php?src='.$cover_image.'&h=125&w=125&zc=1" alt="'.$album.'"></img></a><div class="image_edit">'.$tdiv.'&nbsp;'.RemoveExtension($album).'</div></td>';
			if($x % 4 == 0)
			{
				$output .= "</tr><tr>{$albums}";
			}
			else
			{
				$output .= $albums;
			}
			$x++;
		}
	}
	else
	{
		$output .= "<h3>No Albums, Sorry.</h3>";
	}
}
$output .= '</tr></table>';

?>
