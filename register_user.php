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
        <div class="GenDiv" id="conWelcome">
            <h3 id="contactHead">Create User Account!</h3>
            <p id='contactContent'>
                Create a user account to help track your orders,<br>
                and to have access to upcoming features on the site!<br>
            </p>
        </div>
<?php

require_once 'login.php';
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
        
	$customer_id = get_post($conn, 'customer_id');
	$customer_fname = get_post($conn, 'customer_fname');
	$customer_lname = get_post($conn, 'customer_lname');
	$customer_email = get_post($conn, 'customer_email');
	$customer_phone = get_post($conn, 'customer_phone');
	$customer_password = get_post($conn, 'customer_password');
        $customer_token = hash('ripemd128', "$salt1$customer_password$salt2");
	$username = get_post($conn, 'username');
	$query = "INSERT INTO customer (customer_id, customer_fname, customer_lname, customer_email, customer_phone, customer_token, username) VALUES" . 
		"('$customer_id', '$customer_fname', '$customer_lname', '$customer_email', '$customer_phone', '$customer_token', '$username')";
	$result = $conn->query($query);
	if (!$result) echo "INSERT failed: $query<br>" . 
		$conn->error . "<br><br>";
	}

echo <<<_END
<form action="register_user.php" method="post"><pre>
	      <input type="hidden" name="customer_id"><br>
	     First Name:<input type="text" name="customer_fname"><br>
              Last Name:<input type="text" name="customer_lname"><br>
	  Email Address:<input type="text" name="customer_email"><br>
	   Phone Number:<input type="text" name="customer_phone"><br>
	   Set Password:<input type="password" name="customer_password"><br>
	   Set Username:<input type="text" name="username"><br>
			     <input type ="submit" value="ADD RECORD">
</pre></form>
_END;


$conn->close();
//hello all

function get_post($conn, $var) {
	return $conn->real_escape_string($_POST[$var]);
}
?>
