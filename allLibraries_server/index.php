<?php

header("Access-Control-Allow-Origin: *");

include('config/connection.php');

$controller = new Controller();
$controller->router();

?> 


