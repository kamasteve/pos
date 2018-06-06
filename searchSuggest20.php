a<?php
//Get our database abstraction file
require('database.php');

if (isset($_GET['searchs']) && $_GET['searchs'] != '') {
	//Add slashes to any quotes to avoid SQL problems.
	$search = $_GET['searchs'];
	$suggest_query = db_query("SELECT * FROM company WHERE company like('" .$search . "%') ORDER BY company ");
	while($suggest = db_fetch_array($suggest_query)) {
		echo '<a href=m_analysis.php?is=' . $suggest['id'] . '>' . $suggest['company'] . "</a>\n";
	}
}
?>