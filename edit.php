<?php
require_once('functions.php');

$user=$_SESSION['user'];
require_once('mysql.php');
	$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("point_of_sale", $con);

$a=mysqli_real_escape_string($dbc,$_POST['a']);
$c=mysqli_real_escape_string($dbc,$_POST['c']);
$bar=mysqli_real_escape_string($dbc,$_POST['bar']);
$e=mysqli_real_escape_string($dbc,$_POST['ee']);
$m=mysqli_real_escape_string($dbc,$_POST['m']);
$p=mysqli_real_escape_string($dbc,$_POST['p']);
$cat=mysqli_real_escape_string($dbc,$_POST['cat']);
$sup=mysqli_real_escape_string($dbc,$_POST['sup']);
$minimum=mysqli_real_escape_string($dbc,$_POST['minimum']);
$pro=$_POST['p'];
$gg=$_POST['gg'];
$vat=$_POST['vat'];
$k=mysqli_real_escape_string($dbc,$_POST['k']);
$re=mysqli_real_escape_string($dbc,$_POST['f']);
$res=mysqli_real_escape_string($dbc,$_POST['x']);
$buying=mysqli_real_escape_string($dbc,$_POST['buying']);

mysql_query("UPDATE products SET vat='$vat',category='$cat', buying='$buying',
 price = '$e',p_name='$p',reorder='$re',minimum='$minimum',code='$bar'
WHERE product_id = '$m'");
$r="insert into audit(product,stock,qty,reason,date,value,user)value('$m','$d','0','$res',NOW(),'Product Edit ','$user')";
$sql=mysqli_query($dbc,$r);
  header("location: products_view.php");
		


mysql_close($con)

	
?>