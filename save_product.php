<?php
//require_once('mysql.php');

	$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("gikomba", $con);
$b=mysql_real_escape_String($_POST['b']);
$a=mysql_real_escape_String($_POST['bar']);
$c=mysql_real_escape_String($_POST['c']);
$de=mysql_real_escape_String($_POST['de']);
 $l=mysql_real_escape_string($_POST['category']);
$d=$_POST['d'];
$e=$_POST['e'];
$p=$_POST['p'];
$m=$_POST['m'];
$v=$_POST['v'];
$package=$_POST['package'];
$order=$_POST['order'];
$minimum=$_POST['minimum'];
$price=$_POST['SELLING'];
$r="select * from categories where id='$l'";
$sql=mysqli_query($dbc,$r);
$row=mysqli_fetch_array($sql);
$category=$row['name'];
$number=$row['current'];
$number=$number+1;

$f='0';	

$nm="update categories set current='$number' where name='$category'";
$mn=mysqli_query($dbc,$nm);	


	$sql="INSERT INTO products (p_name,description,code,sold,left_p,price,reorder,system,category,company,buying,vat,factor)
VALUES ('$b','$b','$b','$f','0','$price','$re','$number','$l','$c','$e','$v','$package')";
  if (!mysql_query($sql,$con)){

  }
 header("location: products_view.php");
		exit();


mysql_close($con)

	
?>