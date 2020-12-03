<?php
session_start();
require_once('controllerUser.class.php');
require_once('user.class.php');

$action = "";

if (isset($_GET["action"]) && trim($_GET["action"]) != "" ) {
	$action = $_GET["action"];
}



switch ($action) {
	case 'login':

		$_ctrlUser = new ControllerUser();

		if (isset($_POST)) {

			if($_ctrlUser->validate($_POST)){

				$_ctrlUser->login($_POST);
			}
		}
		header("Location: index.php");
		break;

	case 'signout':

		$_ctrlUser = new ControllerUser();

		if (isset($_SESSION["token"])) {
			$_ctrlUser->signout($_SESSION["token"]);
		}
		header("Location: index.php");
		break;
	
	default:
		header("Location: index.php");
		break;
}




