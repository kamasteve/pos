<?php
//Get our database abstraction file
session_start();
ini_set('display_errors', 1);
require('mysql.php');

if (isset($_GET['searchs']) && $_GET['searchs'] != '') {
	//Add slashes to any quotes to avoid SQL problems.
	$search = $_GET['searchs'];
	$s =("SELECT distinct(category)as category FROM products WHERE category like('" .$search . "%') ORDER BY category limit 1");
	$sql=mysqli_query($dbc,$s);
	while($suggest = mysqli_fetch_array($sql)) {
	
		echo '<a href=best_cat.php?id='.($_SESSION['category']=$suggest['category']).' >' . $suggest['category'] . "</a>\n";
	}
}
?>