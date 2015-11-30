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
        require_once 'login.php';
        include_once 'sanitize.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        $resultuser = 0;
        if ($conn->connect_error) die($conn->connect_error);
        
        if (isset($_SESSION['username'])&& isset($_SESSION['customer_id'])) {
            $username1 = $_SESSION['username'];
            $cust_id = $_SESSION['customer_id'];
            }
        
        if (isset($_GET['id'])) {
            $product_id = $_GET['id'];
            $query = "SELECT * FROM product WHERE product_id=$product_id";
             $result=$conn->query($query);
        if (!$result) {
       die($conn->error);
        }
        $rows=$result->num_rows;
        
        for($j=0; $j<$rows; $j++) { 
	$result->data_seek($j);
	$row=$result->fetch_array(MYSQLI_NUM);
             echo <<<_END
<div class="formDiv">
<form action="Order_form.php" method="post" class ="addForm"><pre>
             <input type="hidden" name="order_id"><br>
	     <input type="hidden" name="customer_id" value="$cust_id"><br>
	     <input type="hidden" name="product_id" value="$row[0]"><br>
             Product Name: $row[1]<br>
	     Available Materials: $row[4] <br>
             <input type="text" name="material" placeholder="Please type desired material"><br>
             Price: $$row[3]<br>
	     Quantity: <select name="quantity">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
	   <input type ="submit" class = "addButton" value="PLACE ORDER">
</pre></form>
</div>
<div class="formDiv">
<form action="add_customer.php" method="post" class="addForm"><pre>
        <input type="submit" class = "addButton" value="NEED A CUSTOM ORDER?">
</form>
</div>
_END;
             

        }
}

 if (isset($_POST['order_id']) &&
	isset($_POST['customer_id']) &&
	isset($_POST['product_id']) &&
	isset($_POST['material']) &&
        isset($_POST['quantity']))
     {
	$order_id = mysql_entities_fix_string($conn, $_POST['order_id']);
	$customer_id = mysql_entities_fix_string($conn, $_POST['customer_id']);
	$product_id = mysql_entities_fix_string($conn, $_POST['product_id']);
        $material= mysql_entities_fix_string($conn, $_POST['material']);
	$quantity = mysql_entities_fix_string($conn, $_POST['quantity']);
       
	
	$query2 = "INSERT INTO order (order_id, customer_id, product_id, material, quantity) VALUES" . 
		"('$order_id', '$customer_id', '$product_id', '$material', '$quantity')";
	$result2 = $conn->query($query2);
	if (!$result2) echo "INSERT failed: $query2<br>" . 
		$conn->error . "<br><br>";
	}    
     

$conn->close();
function get_post($conn, $var) {
	return $conn->real_escape_string($_POST[$var]);
}

function mysql_entities_fix_string($conn, $string){
return htmlentities(mysql_fix_string($conn, $string));

}

function mysql_fix_string($conn, $string){
	if(get_magic_quotes_gpc()) $string = stripslashes($string);
	return $conn->real_escape_string($string);
}

?>    
    
        
    </body>
</html>
