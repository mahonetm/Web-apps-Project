<html>
    <head>
        <link rel="stylesheet" type="text/css" href="Styles.css">
        <link rel="stylesheet" type="text/css" href="LoginStyles.css">
        <meta charset="UTF-8">
        <title>BM Custom Woodwork - Home</title>
    </head>
    <div id = "header">
        <img src ="drawing.png" id = "logo"/>
        <ul id = "menu">
            <li class ="navLink">
               <?php
                session_start();    
                 if(isset($_SESSION['username']) &&
                   isset ($_SESSION['password'])){
                     echo <<<_END
                    <li class ="navLink">
                <a href = "user_logout.php">LOGOUT</a>
                    <li class ="navLink">
_END;
                }else{
                    echo <<<_END
                    <li class ="navLink">
                <a href = "user_login.php">LOGIN</a>
                    <li class ="navLink">
_END;
                }

                ?>
                <a href = "register_user.php">CREATE ACCOUNT</a>
            <li class ="navLink">
                <a href = "add_customer.php">CONTACT</a>
            </li>
            <li class ="navLink">
                <a href = "products.php">PRODUCTS</a>
            </li>
            <li class ="navLink">
                <a href = "index.php">HOME</a>
            </li>
            
        </ul>
        
    </div>
    
    </head>
    <body>
        <div>
            <img src ="trees.jpg" id ="trees"/>
        </div>

<?php

require_once 'login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

echo <<<_END

		<form action='user_login.php' method='post' class="login">
			Username: <input type='text' name='username' placeholder ='username'><br><br>
			Password: <input type='password' name='password' placeholder ='password'><br><br>
			<input type='submit' value='Login'>
		</form>
               
                
	


_END;

if (isset($_POST['username']) && isset($_POST['password'])) {
	
	$un_temp = mysql_entities_fix_string($conn, $_POST['username']);
	$pw_temp = mysql_entities_fix_string($conn, $_POST['password']);
	
	
	$query = "SELECT * from customer where username='$un_temp' ";
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	elseif($result->num_rows){
		$row = $result->fetch_array(MYSQLI_NUM);
		$correct_pw = $row[5];
		$name = $row[1];
		$username=$row[6];
		$result->close();
		
		$salt1 = "qm&h*";
                $salt2 = "pg!@";
		$token = hash('ripemd128', "$salt1$pw_temp$salt2" );
		
		if($token == $correct_pw){
			echo "Hi $name you are now logged in as $username";
			
			session_start();
			$_SESSION['username']=$username;
			$_SESSION['password']=$correct_pw;
			header("Location: index.php");
			
		}else{
			exit();
		}		
	}else{
		exit();
	}	
		
}else{
	exit();
}

$conn->close();

//sanitization code

function mysql_entities_fix_string($conn, $string){
	return htmlentities(mysql_fix_string($conn, $string));
}

function mysql_fix_string($conn, $string){
	if(get_magic_quotes_gpc()) $string = stripslashes($string);
	return $conn->real_escape_string($string);
}


?>

