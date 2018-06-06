<?
require_once('functions.php');
	$r=mysql_query("ALTER TABLE `products` ADD `stockist` DECIMAL( 10, 2 ) NOT NULL ");