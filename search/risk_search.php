<?php
session_start();
include_once '../conf.php';
include_once '../froms.php';
$q = $_GET["q"];
persornalinformationsearch($q);

function persornalinformationsearch($m) {
    $chqry = mysql_query('select * from newmember where membernumber = "' . base64_encode($m) . '"') or die(mysql_error());
    if (mysql_num_rows($chqry)==1) {
        $row = mysql_fetch_array($chqry);
	$_SESSION['no']=$row['membernumber'];
	$_SESSION['f']=$row['firstname'];
	$_SESSION['l']=$row['lastname'];

       
    } else {
        echo '<span class="red">Sorry member number '.$m.' did not match..proceed and complete member number</span>';
        include_once '../loading.html';
    }
}
	

?>
