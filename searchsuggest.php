<?php
//Get our database abstraction file
require('database.php');

if (isset($_GET['searchs']) && $_GET['searchs'] != '') {
	//Add slashes to any quotes to avoid SQL problems.
	$search = $_GET['searchs'];
	$suggest_query = db_query("SELECT *,serial FROM stocking,products WHERE serial like('" .$search . "%') AND stocking.code=products.code ORDER BY serial LIMIT 100");
	while($suggest = db_fetch_array($suggest_query)) {
		echo '<a href=input.php?id=' . $suggest['product_id'] . '>' . $suggest['serial'] . "</a>\n";
	}
}
?>