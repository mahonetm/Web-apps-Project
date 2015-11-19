<?php

session_start();

if(isset($_SESSION['username']) &&
    isset($_SESSION['password'])){
	session_destroy();
	
	$_SESSION = array(); 
	echo "Logout is successful<br>";
	

	
}

	echo <<<_END
	<pre>
	
	<a href="index.php.php">Return to Login Screen</a>
	
_END;

       
?>

