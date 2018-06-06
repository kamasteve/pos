<?php
require_once('functions.php');




$name=mysql_real_escape_string($_POST['name']);
$phone=mysql_real_escape_string($_POST['phone']);
$id=$_POST['id'];
$limit=$_POST['limit'];
mysql_query("UPDATE accounts set name='$name',phone='$phone',descc='$limit' where id='$id'");

  header("location: customers.php");
		


mysql_close($con)

	
?>