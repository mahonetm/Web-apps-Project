<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="Styles.css">
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
                <a href = "Order_form.php">CUSTOM ORDER</a>
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
        <div class="GenDiv" id="conWelcome">
            <h3 id="contactHead">Create User Account!</h3>
            <p id='contactContent'>
                Create a user account to help track your orders,<br>
                and to have access to upcoming features on the site!<br>
            </p>
        </div>
<?php

require_once 'login.php';
include_once 'sanitize.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if (isset($_POST['customer_id']) &&
	isset($_POST['customer_fname']) &&
	isset($_POST['customer_lname']) &&
	isset($_POST['customer_email']) &&
	isset($_POST['customer_phone']) &&
	isset($_POST['customer_password']) &&
	isset($_POST['username']))
{
        $salt1 = "qm&h*";
        $salt2 = "pg!@";
        
	$customer_id = mysql_entities_fix_string($conn, $_POST['customer_id']);
	$customer_fname = mysql_entities_fix_string($conn, $_POST['customer_fname']);
	$customer_lname = mysql_entities_fix_string($conn, $_POST['customer_lname']);
	$customer_email = mysql_entities_fix_string($conn, $_POST['customer_email']);
	$customer_phone = mysql_entities_fix_string($conn, $_POST['customer_phone']);
	$customer_password = mysql_entities_fix_string($conn, $_POST['customer_password']);
        $username = mysql_entities_fix_string($conn, $_POST['username']);
        $customer_token = hash('ripemd128', "$salt1$customer_password$salt2");
	
	$query = "INSERT INTO customer (customer_id, customer_fname, customer_lname, customer_email, customer_phone, customer_token, username) VALUES" . 
		"('$customer_id', '$customer_fname', '$customer_lname', '$customer_email', '$customer_phone', '$customer_token', '$username')";
	$result = $conn->query($query);
	if (!$result) echo "INSERT failed: $query<br>" . 
		$conn->error . "<br><br>";
        else{
            header("Location: user_login.php");    
        }
	}

echo <<<_END
    <div class ="formDiv"> 
    <p id ="regParagraph">Please provide the following information to create an account</p>
    <form action="register_user.php" method="post" class ="addForm"><pre>
	     <input type="hidden" name="customer_id"><br>
	     <input type="text" name="customer_fname" placeholder ="First Name"><br>
             <input type="text" name="customer_lname" placeholder ="Last Name"><br>
             <input type="text" name="customer_email" placeholder ="E-mail Address"><br>
	     <input type="text" name="customer_phone" placeholder ="Phone Number"<br>
        
             <input type="text" name="username"placeholder ="Create Username"><br>
	     <input type="password" name="customer_password" placeholder ="Create Password"><br>
                <input type ="submit" class ="addButton" id="registerAdd" value="Sign Up">
    </pre></form>
    </div>
_END;


$conn->close();
//hello all

//sanitization code

function mysql_entities_fix_string($conn, $string){
	return htmlentities(mysql_fix_string($conn, $string));
}

function mysql_fix_string($conn, $string){
	if(get_magic_quotes_gpc()) $string = stripslashes($string);
	return $conn->real_escape_string($string);
}

/*
function get_post($conn, $var) {
	return $conn->real_escape_string($_POST[$var]);
}*/
?>
