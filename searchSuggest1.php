<?php
//Get our database abstraction file
require('mysql.php');

if (isset($_GET['searchs']) && $_GET['searchs'] != '') {
	//Add slashes to any quotes to avoid SQL problems.
	$search = mysqli_real_escape_string($dbc,$_GET['searchs']);
	$r= ("SELECT * FROM products WHERE p_name like('%" .$search . "%')  ORDER BY p_name limit 50");
	$sql=mysqli_query($dbc,$r);
	while($suggest = mysqli_fetch_array($sql)) {
		echo '<a href=namee.php?td=' . $suggest['product_id'] . '>' . UCWORDS($suggest['p_name']) . "</a>\n";
	}
}
?>