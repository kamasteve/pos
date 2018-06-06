<?php
$con=mysql_connect("localhost","root","","gikomba");
if(!$con){
die('could not connect:'.mysql_error());
}
$db_selected=mysql_select_db("gikomba",$con);

?>