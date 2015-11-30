<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="Styles.css">
        <link rel="stylesheet" type="text/css" href="LoginStyles.css">
        <meta charset="UTF-8">
    </head>
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
            <h3 id="contactHead">Contact Me!</h3>
            <p id='contactContent'>
                I would love to answer any question you may have,<br>
                plan a time to meet in person, and discuss any custom<br>
                projects you have in mind! I'm here to help and I promise<br>
                I don't bite!
            </p>
        </div>

<?php

require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if(isset($_SESSION['username']) &&
   isset($_SESSION['password'])){
echo <<<_END
<div class="formDiv">
<textarea name ="emailBody" form ="email" class ="emailBody" rows ="9" cols="50">Your message...</textarea>
<form action="form-to-email.php" method="post" class ="addForm" id="email"><pre>
	   <input type ="submit" class = "addButton" value="SEND">
</pre></form>
</div>
_END;
   }else{
       echo <<<_END
       <div class="formDiv" id="contactNLI">
       <p id="pNLI">Please login <a href ="user_login.php" id="aNLI">here</a> to get in touch with me</p>
       </div>
_END;
   }

$conn->close();

function get_post($conn, $var) {
	return $conn->real_escape_string($_POST[$var]);
}


















?>
