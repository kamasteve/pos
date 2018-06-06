<?php
//Get our database abstraction file
require('mysql.php');

if (isset($_GET['searchs']) && $_GET['searchs'] != '') {
	//Add slashes to any quotes to avoid SQL problems.
	$search = $_GET['searchs'];
	$r = ("SELECT * FROM products WHERE p_name like('" .$search . "%') ORDER BY p_name LIMIT 50");
	$sql=mysqli_query($dbc,$r);
	while($row= mysqli_fetch_array($sql)) {
		echo '<a href=stocking.php?id=' . $row['product_id'] . '>' . $row['p_name'] . "</a>\n";
	}
}
?>