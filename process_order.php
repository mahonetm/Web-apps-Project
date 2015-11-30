<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) {
        die($conn->connect_error);
}
if (
	isset($_POST['customer_id']) &&
	isset($_POST['product_id'])&&
	isset($_POST['quantity']) &&
        isset($_POST['material_type']))
            
{

	$customer_id = mysql_entities_fix_string($conn, $_POST['customer_id']);
	$product_id = mysql_entities_fix_string($conn, $_POST['product_id']);
	$quantity = mysql_entities_fix_string($conn, $_POST['quantity']);
        $material_type = mysql_entities_fix_string($conn, $_POST['material_type']);
       
	
	$query="INSERT INTO wood_working.order (customer_id, product_id, quantity, material_type) VALUES " .
			"('$customer_id','$product_id','$quantity','$material_type')";
		$result=$conn->query($query);
		if(!$result){ echo "INSERT failed: $query <br>" .
                $conn->error . "<br><br>";
        }else{
            echo "Your order was placed successfully. I'll be in touch with you personally to work out the details." . "<br>";
            echo "Check out more pruducts <a href ='products.php'>here  </a>";
            
            
        }
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