<?php

//The following functions were ported over from Madtast.com using some code from php.net,
//these functions will allow your plug site to pre-process css varibles in a styling.php file in your theme

function find_files_by_type($file_type, $location)
{
    /* file extension must be four characters e.x. .png */
    $files = array();
    $dir = opendir ($location);
    while (false !== ($file = readdir($dir))) {
      if (end(explode('.', $file)) == 'css') {
        $files[] = $file;
      }
    }
    return $files;
}

/*Added from Madtast.com (Alpha Feature)*/
function plug_load_css($css_file='', $dynamic_css=FALSE)
{

  if($dynamic_css) {	
    global $styling_defines;
    $dec_pat = '/^\/\*\@css_const\s+\[(.*)\]\s+\*\//Ums';
    preg_match_all($dec_pat,$styling_defines,$m);
    $lhs = array();
    $rhs = array();
    foreach($m[1] as &$p) {
      $p = explode(",",$p);
      foreach($p as &$q) {
         list($k,$v) = explode("=",trim($q));
     	   $lhs[] = '/(\w+\:).*\/\*' . $k . '\*\/;$/Um';
     	   $rhs[] = '\1' . $v . ';';
      }
    }
  }
      
  if(empty($css_file))
  {
    $css_file[] = find_files_by_type(".css", plug_theme_path());
    foreach($css_file[0] as $css)
    {
      if($dyanmic_css)
      {
        $contents .=  preg_replace($lhs,$rhs,file_get_contents(plug_theme_path($css))); /* include dynamic css using comments as alt values */
      }
      else
      {
        $contents .= file_get_contents(plug_theme_path($css)); /* include plain css with comments */
      }
    }
  }
  else
  {
    if($dynamic_css)
    {
      $contents .=  preg_replace($lhs,$rhs,file_get_contents(plug_theme_path($css_file))); /* include dynamic css using comments as alt values */
    }
    else
    {
      $contents .= file_get_contents(plug_theme_path($css_file)); /* include plain css with comments */
    }
  }
  return $contents;
}

?>
