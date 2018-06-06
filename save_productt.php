<?php

	$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("point_of_sale", $con);

$a=$_POST['a'];
$c=$_POST['c'];
$d=$_POST['d'];
$e=$_POST['e'];
$p=$_POST['p'];
$f='0';	

	
	$sql="INSERT INTO product (code,description,left_p, price, sold,p_name)
VALUES ('$a', '$c', '$d', '$e', '$f','$p')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
  header("location: productss_view.php");
			exit();


mysql_close($con)

	
?>