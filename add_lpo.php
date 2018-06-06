<?
session_start();
require_once('mysql.php');
$id=$_POST['id'];
$qty=$_POST['QTYY'];
$total=$_POST['TOTALL'];
$price=$_POST['PPRICE'];
$invoice=$_POST['CODE'];

$vat=$_POST['VAT'];
$name=$_POST['PNAME'];
$supplier=$_SESSION['supplier'];
$mat=$_SESSION['expected'];
$date=$_SESSION['date'];
$dim=mysqli_real_escape_string($dbc,$_POST['dim']);
$others=mysqli_real_escape_string($dbc,$_POST['other']);
$d="insert into lpo(exp_id,amount,qty,price,vat,session,invoice,name,dim,others,mat_date,date,supplier)
values('$id','$total','$qty','$price','$vat','$session','$invoice','$name','$dim','$others','$mat','$date','$supplier')";
$dd=mysqli_query($dbc,$d);

header("location: lpp.php");
?>