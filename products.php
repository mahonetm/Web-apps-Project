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
                <a href = "register_user.php">CREATE USER</a>
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
        <h1>Explore my 100% hand made with customer in mind products</h1>
        <?php
 require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die($conn->connect_error);
}
        $query="SELECT * FROM product";
        $result=$conn->query($query);
        if (!$result) {
       die($conn->error);
        }
        $rows=$result->num_rows;
        for($j=0; $j<$rows; $j++) { 
	$result->data_seek($j);
	$row=$result->fetch_array(MYSQLI_NUM);
	
        
   
   
	echo <<<_END
	
         <table id ="table" class ="details_table">
            <tr>
                <td><img src ="$row[1].jpg" class = "infoimg"/>
                </td>
                <td>
                    <h2><a href= "Order_form.php">$row[1]</a></h2>
                    <p>$row[3]</p>
                    <p>Available in:    $row[4]</p>
                </td>  
            </tr>
            <br><br>
                
            
_END;
        }
        
	
	$result->close();
	$conn->close();
	
        
        ?>
    </body>
</html>
