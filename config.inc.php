<?php
$config['root']="plug02";

$config['banner_text']="Madtast Plug";
$config['footer']="Use of this signifies your agreement to the <a href=\"?page=terms\">Terms of Service</a>.";
$config['copyright_line']="Copyright &copy; 2008 Paul A. Serra";
$config['theme']="madtast-plug"; /*Also try madtast-plug-black*/

$config['title_prefix']=""; /*not sure if this is implemented yet*/
$config['sidebar']="off"; /*This is something really old, however; it may be implemented in the future*/

$config['plugins']="plugins";
$config['plugin_back_color'] = "#FFFFFF"; /*madtast-plug-black theme color, change to color of your background*/
$config['navbar']="Nava";
$config['media_albums'] = "media/albums/";

$config['check_forms']=true; //Run checks on forms, keep in mind you must define what occurs when check_forms is true in your code with plug_check_forms();
$config['database']=false; //Enable load database (must be enabled if the login_system module is enabled)
$config['login_system']=false; //Enable Module Based login, you may write your own login system and buy pass this one if you like)
$config['error_display']=false; //Enable display error (for testing/beta) Shows JavaScript alert() messages
$config['css_preprocessor']=true; //Allow the use of styling.php in themes and ?css call to plug.

/*Some Video Stuff*/
$config['no_cover'] = "resources/images/no_cover.png";

//Tack Stylings (You can use these for plugins if you wish, or you can remove them and just enter your class names manually)$TACK['Blank'] = "";
$TACK['Spacer'] = "tack_spacer";
$TACK['Center'] = "tack_center";
?>
