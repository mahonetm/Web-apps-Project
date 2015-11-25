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
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) die($conn->connect_error);
        
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
<form action="add_customer.php" method="post" class ="addForm"><pre>
             <input type="hidden" name="order_id"><br>
	     <input type="hidden" name="customer_id"><br>
	     <input type="hidden" name="product_id" value="$row[0]"><br>
             Product Name: $row[1]<br>
	     Available Materials: $row[4] <br>
             <input type="text" name="material_type" placeholder="Please type desired material"><br>
             Price: $$row[3]<br>
	     Quantity: <select name="Quantity">
				<option value="5">5</option>
				<option value="10">10</option>
				<option value="15">15</option>
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
        
       /* if (isset($_POST['order_id']) &&
	isset($_POST['customer_id']) &&
	isset($_POST['product_id']) &&
        isset($_POST['product_name']) &&
        isset($_POST['product_type']) &&
        isset($_POST['price']) &&
        isset($_POST['material_name']) &&
	isset($_POST['quantity']))
{
	$order_id = get_post($conn, 'order_id');
	$customer_id = get_post($conn, 'customer_id');
	$product_id = get_post($conn, 'product_id');
	$quantity = get_post($conn, 'quantity');
       
	
	$query = "INSERT INTO order (order_id, customer_id, product_id, quantity) VALUES" . 
		"('$order_id', '$customer_id', '$product_id', '$quantity')";
	$result = $conn->query($query);
	if (!$result) echo "INSERT failed: $query<br>" . 
		$conn->error . "<br><br>";
	}*/
/*if(isset($_SESSION['username']) &&
   isset($_SESSION['password'])){*/

   /*}else{
       echo <<<_END
       <div class="formDiv" id="contactNLI">
       <p id="pNLI">Please login <a href ="user_login.php" id="aNLI">here</a> first to place an order</p>
       </div>
_END;
   }*/

$conn->close();
function get_post($conn, $var) {
	return $conn->real_escape_string($_POST[$var]);
}
        
?>    
    
        
    </body>
</html>
