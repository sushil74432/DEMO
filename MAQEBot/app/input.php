<?php 

include "maqeBot.php";

// $cmd = $argv;
$cmd = $argv[1];
$bot = new maqeBot($cmd);

echo $bot->getCurrentLocation();

 ?>