<?php

$plugin['framework_version'] = '2.x';
$plugin['functions'] = 'functions.php';

if($plugins['argv'][0] == "major") /*Major Runtime*/
{
  require("{$plugin['here']}/master.php");
}

if($plugins['argv'][1] == "administrative") /*Major Runtime*/
{
  require("{$plugin['here']}/admin.php");
}

?>