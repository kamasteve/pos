<?php
require_once('functions.php');
$con = mysql_connect("localhost","mulken","muwake");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  $session=session_id();

mysql_select_db("point_of_sale", $con);
$pname=mysqli_real_escape_string($dbc,$_POST['PNAME']);
$date=$_POST['date'];
$QTY=$_POST['QTY'];

$TOTAL=$_POST['TOTAL'];
$discou=$_POST['DISCOUNT'];
$supplier=$_SESSION['supplier'];

 $CODE=$_SESSION['MEMBER'];

$TOTALL=$_POST['TOTALL'];
$PCODES=mysqli_real_escape_string($dbc,$_POST['PCODES']);
$PPRICE=$_POST['PPRICE'];
$id=$_POST['product_id'];
$datetime=$_POST['date'];
$previous=$_POST['buying'];
$selling=$_POST['selling'];
$date=$_SESSION['date'];
$expected=$_SESSION['expected'];
if($previous!=$PPRICE){
$t="insert into changed(product_id,product,previous,current,date,price,supplier,invoice)
values('$id','$pname','$previous','$PPRICE',NOW(),'$selling','$supplier','$CODE')";
$tt=mysqli_query($dbc,$t);
}

$vat=$_POST['VAT'];
$session=session_id();
$R=mysql_query("select * from stocking where product_id='$id' and qty='$QTY'");
if(mysql_num_rows($R)==0){
if($QTY>0){
$j=mysql_query("INSERT INTO stocking(product_id, qty, total_p, t_code,p_date,price,discount,tax,received,session,supplier)
VALUES ('$id',  '$QTY', '$TOTALL', '$CODE', '$date', '$PPRICE','$discou','$vat',NOW(),'$session','$supplier')");

}
$result = mysql_query("SELECT * FROM products where product_id='$id'");

while($row = mysql_fetch_array($result))
  {
  $m=$row['left_p'];
  }
  $ab=$m+$QTY;

  $froms=GetStock();


PurchasesRecord($date,$CODE,$TOTALL,$session,$expected,$froms,$supplier);


$v=GetVat();
$kra=GetKra();
PurchasesVat($date,$v,$vat,$kra,$CODE,$session);




mysql_query("UPDATE products SET left_p = '$ab',buying='$PPRICE'
WHERE product_id = '$id'");

$sa="select * from products where product_id='$id'";
$as=mysqli_query($dbc,$sa);
$df=mysqli_fetch_array($as);
$stock=$df['left_p'];
$pname=$df['description'];
$r="insert into audit(product,stock,date,reason,value,qty,number,session)
values('$id','$stock',NOW(),'PURCHASES','PURCHASES','$QTY','$CODE','$session')";
$sql=mysqli_query($dbc,$r);
}
session_regenerate_id();
header("location: stocking.php");
mysql_close($con);
?>


