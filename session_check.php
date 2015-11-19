<?php

session_start();

if(!isset($_SESSION['username']) &&
   !isset ($_SESSION['password'])){
	header("Location: loginscreen.php");
	exit();
	
}

?>

