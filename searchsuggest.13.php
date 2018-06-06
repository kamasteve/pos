<?php
//Get our database abstraction file
require('mysql.php');

if (isset($_GET['searchs']) && $_GET['searchs'] != '') {
	//Add slashes to any quotes to avoid SQL problems.
	$search = $_GET['searchs'];
	$r = ("SELECT * FROM suppliers WHERE company like('" .$search . "%') ORDER BY company ");
	$sql=mysqli_query($dbc,$r);
	while($suggest = mysqli_fetch_array(($sql))) {
		echo '<a href=stocking.php?is=' . $suggest['supplier_id'] . '>' . $suggest['company'] . "</a>\n";
	}
}
?>