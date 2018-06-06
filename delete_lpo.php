<?php
require_once('mysql.php');
				  if (isset($_GET['id']))
	{

$id = $_GET['id'];



$v=("DELETE FROM lpo WHERE id='$id'");
$vv=mysqli_query($dbc,$v);

header("location: lpp.php");
//mysql_close($con);
}
?>