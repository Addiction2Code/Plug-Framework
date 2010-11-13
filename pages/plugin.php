<?php
$plugin = $_REQUEST['plug'];
$argument = $_REQUEST['arg'];

$output .= plugin($plugin, $TACK['Blank'], $argument);
?>
