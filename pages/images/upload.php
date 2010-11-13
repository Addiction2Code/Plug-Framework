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

function get_all_albums($path)
{
	$r = array();
	if ($h = opendir($path)) {
		while (false !== ($f = readdir($h))) {
			$e = substr($f, -6);
			if($e == '.album')
				$r[] = $f;
		}
	}
	closedir($h);
	return $r;
}

$albums = get_all_albums($config['media_albums']);

foreach($albums as $album)
{
	$salbums .= "<option value=\"{$album}\">".RemoveExtension($album)."</option>";
}

if(isset($_POST['submit']))
{
	$currentdir = getcwd();
	$output .= '<br>';
	$target_path = "{$currentdir}{$config['media_albums']}{$_POST['album']}/";
	$target_path = $target_path . plug_web_safe(basename($_FILES['uploadedfile']['name'])); 

	if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
	    $output .= "The file ".plug_web_safe(basename( $_FILES['uploadedfile']['name']))." has been uploaded to the album <a href=\"?page=images/images&album={$_POST['album']}\">".$_POST['album']."</a> view the image itself <a href=\"/{$config['root']}{$config['media_albums']}{$_POST['album']}/".plug_web_safe($_FILES['uploadedfile']['name'])."\">here</a><hr><br>";
	}
	else
	{
	    $output .= "There was an error uploading the file, please try again!<hr><br>";
	}
}

	$output .= '<form enctype="multipart/form-data" action="'.curPageURL().'" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="200000" />
Choose a file to upload: <input name="uploadedfile" type="file" /><br />
Select Album <select name="album">"'.$salbums.'"</select><br />
<input type="submit" name="submit" value="Upload File" />
</form>';


?>
