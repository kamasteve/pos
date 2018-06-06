<?php
//Get our database abstraction file
require('mysql.php');

if (isset($_GET['searchs']) && $_GET['searchs'] != '') {
	//Add slashes to any quotes to avoid SQL problems.
	$search = $_GET['searchs'];
	$s= ("SELECT * FROM products WHERE description like('" .$search . "%') ORDER BY description  ");
	$sql=mysqli_query($dbc,$s);
	while($suggest =mysqli_fetch_array($sql)) {
		echo '<a href=return_in.php?id=' . $suggest['product_id'] . '>' . $suggest['description'] . "</a>\n";
	}
}
?>