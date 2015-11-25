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
			<li class ="navLink">
                <a href = "register_user.php">CREATE ACCOUNT</a>
            <li class ="navLink">
                <a href = "add_customer.php">CONTACT</a>
            </li>
            <li class ="navLink">
                <a href = "order.php">CUSTOM ORDER</a>
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
        <?php
        // put your code here
        ?>
    </body>
</html>
