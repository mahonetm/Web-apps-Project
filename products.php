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
                <a href = "user_login.php">LOGIN</a>
			<li class ="navLink">
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
        <p>These are our products</p>
        <?php
 require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die($conn->connect_error);
}

if (isset($_POST['delete']) && isset($_POST['order_id']))
{
	$order_id = get_post($conn, 'order_id');
	$query = "DELETE FROM order WHERE order_id= '$order_id'";
	$result = $conn->query($query);
	if (!$result) {
        echo "DELETE failed: $query<br>" . $conn->error . "<br><br>";
    }
}

if (isset($_POST['customer_id']) &&
	isset($_POST['product_id']) &&
	isset($_POST['quantity']) &&
	isset($_POST['order_id']))
	{
		$customer_id = get_post($conn, 'customer_id');
		$product_id = get_post($conn, 'product_id');
		$quantity = get_post($conn, 'quantity');
		$order_id = get_post($conn, 'order_id');
		$query = "INSERT INTO order VALUES" . "('$customer_id', '$product_id', '$quantity', '$order_id')";
		$result = $conn->query($query);
		if (!$result) {
        echo "INSERT failed: $query<br>" . $conn->error . "<br><br>";
    }
}
	
	echo <<<_END
	<form action="customer_form.php" method="post"><pre>
order_id <input type="text" name="order_id">
customer_id <input type="text" name="customer_id">
product_id <input type="text" name="product_id">
quantity <input type="text" name="quantity">
	<input type="submit" value="Order Now">
	</pre></form>
        
_END;
	
	$query = "SELECT * FROM order";
	$result = $conn->query($query);
	if (!$result) {
    die("Database access failed: " . $conn->error);
}

$rows = $result->num_rows;
	
	for ($j = 0 ; $j < $rows ; ++$j)
	{
		$result->data_seek($j);
		$row = $result->fetch_array(MYSQLI_NUM);
		
		echo <<<_END
		<pre>
order_id $row[0]
customer_id $row[1]
product_id $row[2]
quantity $row[3]
</pre>
<form action="customer_form.php" method="post">
<input type="hidden" name="delete" value="yes">
<input type="hidden" name="order_id" value="$row[0]">
<input type="submit" value="DELETE RECORD"></form>
_END;
	}
	
	$result->close();
	$conn->close();
	
	function get_post($conn, $var)
	{
		return $conn->real_escape_string($_POST[$var]);
	}
        
        ?>
    </body>
</html>
