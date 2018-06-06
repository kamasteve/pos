<?php
//Get our database abstraction file
require('mysql.php');

if (isset($_GET['searchs']) && $_GET['searchs'] != '') {
	//Add slashes to any quotes to avoid SQL problems.
	$search = $_GET['searchs'];
	$s =("SELECT * FROM products WHERE p_name like('%" .$search . "%') ORDER BY p_name limit 50");
	$sql=mysqli_query($dbc,$s);
	while($suggest =mysqli_fetch_array($sql)) {
		echo '<a href=audited.php?id=' . $suggest['product_id'] . '>' . $suggest['p_name'] . "</a>\n";
	}
}
?>