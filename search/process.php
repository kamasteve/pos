<?php
session_start();
include_once '../conf.php';
include_once '../froms.php';
$q = $_GET["q"];
persornalinformationsearch($q);

function persornalinformationsearch($m) {
$t=mysql_query("select * ,datediff(NOW(),expected)as diff from member_with where member='$m' and status='ACTIVE'");
    if (mysql_num_rows($t)==1) {
        $row = mysql_fetch_array($t);
 $diff=$row['diff'];
 if($diff<0){
 $penalty=$row['credit']*3/100;}else{
 $penalty=0;}
$_SESSION['credit']=$row['credit'];
$_SESSION['maturity']=$row['expected'];
$_SESSION['input']=$row['date']; 
$_SESSION['member']=$row['member']; 
$_SESSION['penalty']=$penalty; 
    } else {
        echo '<span class="red">Sorry member number '.$m.' did not match..proceed and complete member number</span>';
        include_once '../loading.html';
    }
}
	

?>
