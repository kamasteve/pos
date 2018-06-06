<?php
//Get our database abstraction file
require('conf.php');

if (isset($_GET['searchs']) && $_GET['searchs'] != '') {
	//Add slashes to any quotes to avoid SQL problems.
	$search = $_GET['searchs'];
	$suggest_query =mysql_query ("SELECT * FROM products

WHERE name like('" .$search . "%')
");
	while($suggest = mysql_fetch_array($suggest_query)) {
		echo '<a href=lpp.php?id=' . $suggest['id'] . '>' . $suggest['name'] . "</a>\n";
	}
}
?>