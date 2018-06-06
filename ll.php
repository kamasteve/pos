<?
require_once('functions.php');
$r=mysql_query("select * from lcode");
$row=mysql_fetch_array($r);
$code=$row['code'];
$r=mysql_query("update lcode set code=code+1");
$supplier=$_POST['supplier'];
$expected=$_POST['expected'];
$date=$_POST['date'];
$invoice=$_POST['invoice'];
$_SESSION['project']=$project;
$_SESSION['date']=$date;
$_SESSION['expected']=$expected;
$_SESSION['supplier']=$supplier;
$_SESSION['SEMBER']=$code;
$url='lpp.php';


ob_end_clean();
header("Location: $url");
?>