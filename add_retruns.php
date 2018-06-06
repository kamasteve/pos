<?
require_once('functions.php');
$user=$_SESSION['user_name'];
$product=mysqli_real_escape_string($dbc,$_POST['PNAME']);
$qty=$_POST['QTY'];
$supplier=$_SESSION['supplier'];
$invoice=$_SESSION['SESS'];

$code=$_POST['pcode'];
$receipt=$_POST['receipt'];
$credit=$_POST['CREDIT'];
 $id=$_POST['product_id'];
$r=mysql_query("select * from stocking where t_code='$invoice' and supplier='$supplier' and product_id='$id' and qty<='$qty' ");
if(mysql_num_rows($r)==1){

$rew=mysql_fetch_array($r);
$ppr=$rew['price'];
$tax=$rew['tax'];
$totalp=$ppr*$qty;
$idd=$rew['id'];
$f=mysql_query("update stocking set qty=qty-'$qty',total_p=total_p-'$total_p' where id='$idd'");

$sa="select * from products where product_id='$id'";
$as=mysqli_query($dbc,$sa);
$df=mysqli_fetch_array($as);
$buying=$df['buying'];
$tax=$df['vat'];
$vat=$totalp-(100/116*$totalp);

$total=$buying*$qty;
$name=mysqli_real_escape_string($dbc,$row['PNAME']);

$y="update products set left_p=left_p-'$qty'  where product_id='$id' ";
$sql=mysqli_query($dbc,$y);
$h="insert into  return_out(product_id,qty,date,price,total_p,receipt,credit,supplier)values('$id',
'$qty',NOW(),'$ppr','$totalp','$invoice','$credit','$supplier')";
$sql=mysqli_query($dbc,$h);
$v=GetVat();
$kra=GetKra();
 $froms=GetStock();
 $ly=mysql_query("update ledgers set debit=debit-'$totalp' where account_id='$froms' and invoice='$invoice'");
  $ly=mysql_query("update ledgers set credit=credit-'$totalp' where account_id='$supplier' and invoice='$invoice'");
   $ly=mysql_query("update ledgers set debit=debit-'$vat' where account_id='$kra' and invoice='$invoice'");
    $ly=mysql_query("update ledgers set credit=credit-'$vat' where account_id='$v' and invoice='$invoice'");
$c="select * from products where product_id='$id' limit 1";
$cc=mysqli_query($dbc,$c);
$ccc=mysqli_fetch_array($cc);
$stock=$ccc['left_p'];
$v="insert into audit(product,date,value,reason,qty,number,stock,user)
VALUES('$id',NOW(),'RETURN OUT','DEBIT NOTE','$qty','$credit','$stock','$user')";
$vv=mysqli_query($dbc,$v);
}
header("location: return_out.php");
?>