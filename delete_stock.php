<?php
				  if (isset($_GET['id']))
	{
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("gikomba", $con);
$messages_id = $_GET['id'];
$result = mysql_query("SELECT * FROM stocking where id='$messages_id'");
while($row = mysql_fetch_array($result))
  {
  $code=$row['product_id'];
  $f=$row['qty'];
   $number=$row['t_code'];
   $session=$row['session'];
  }
$result1 = mysql_query("SELECT * FROM products where product_id='$code'");

while($row1 = mysql_fetch_array($result1))
  {
  $pleft=$row1['left_p'];
    $name=$row1['p_name'];
  }
  
$dugang=$pleft-$f;

mysql_query("UPDATE products SET left_p = '$dugang'
WHERE product_id = '$code'");

mysql_query("DELETE FROM stocking WHERE id='$messages_id'");
mysql_query("DELETE FROM ledgers WHERE session='$session'");
mysql_query("DELETE FROM audit where session='$session'limit 1");
header("location: stocking.php");
mysql_close($con);
}
?>