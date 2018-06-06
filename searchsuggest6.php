<?php
//Get our database abstraction file
require('database.php');

if (isset($_GET['searchs']) && $_GET['searchs'] != '') {
	//Add slashes to any quotes to avoid SQL problems.
	$search = $_GET['searchs'];
	$suggest_query = db_query("SELECT * FROM products WHERE code like('" .$search . "%') ORDER BY code LIMIT 100");
	while($suggest = db_fetch_array($suggest_query)) {
		echo '<a href=invoice.php?id=' . $suggest['product_id'] . '>' . $suggest['code'] . "</a>\n";
	}
}
?>