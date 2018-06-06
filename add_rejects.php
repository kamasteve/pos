<?session_start();
require_once('functions.php');
$user=$_SESSION['user'];
$product=mysqli_real_escape_string($dbc,$_POST['PNAME']);
$qty=$_POST['QTY'];

$code=$_POST['pcode'];
$receipt=$_POST['receipt'];
$credit=$_POST['CREDIT'];
$y="select * from sales where number='$receipt'  and p_name='$product'  limit 1";
$sql=mysqli_query($dbc,$y);
 $k=mysqli_num_rows($sql);
if($k==1){
$row=mysqli_fetch_array($sql);
$vat=$row['vat'];
$qty1=$row['qty'];
$price=$row['price'];
$total=$row['price']*$qty;
$totall=$row['p_price']*$qty;
$id=$row['sale_id'];
$vvat=16/100*$total;
$sid=GetStock();
$cash=GetCash();
$cost=GetCostG();
$sales=GetSALES();
$vid=GetVat();
$kid=GetKra();
if($qty1>$qty||$qty1==$qty){
$name=mysqli_real_escape_string($dbc,$row['p_name']);
$y="update sales set qty=qty-'$qty',total_p=total_p-'$total',vat=vat-'$vvat' where sale_id='$id' and number='$receipt'";
$sql=mysqli_query($dbc,$y);
$y="update products set left_p=left_p+'$qty',sold=sold-'$qty'  where p_name='$product' ";
$sql=mysqli_query($dbc,$y);
$d="update x_report set amount=amount-$total where receipt='$receipt' limit 1";
$dd=mysqli_query($dbc,$d);

$t="update customer_ledgers set debit=debit-'$total' where code='$receipt'";
$tt=mysqli_query($dbc,$t);
$r="update ledgers set debit=debit-'$total' where receipt='$receipt' and account_id='$cash'";
$sql=mysqli_query($dbc,$r);
$r="update ledgers set credit=credit-'$total' where receipt='$receipt' and account_id='$sales'";
$sql=mysqli_query($dbc,$r);
$r="update ledgers set debit=debit-'$totall' where receipt='$receipt' and account_id='$cost'";
$sql=mysqli_query($dbc,$r);
$r="update ledgers set credit=credit-'$totall' where receipt='$receipt' and account_id='$sid'";
$sql=mysqli_query($dbc,$r);
$r="update ledgers set debit=debit-'$vvat' where receipt='$receipt' and account_id='$vid'";
$sql=mysqli_query($dbc,$r);
$r="update ledgers set credit=credit-'$vvat' where receipt='$receipt' and account_id='$kid'";
$sql=mysqli_query($dbc,$r);

$r="insert into  return_in(product,code,qty,date,price,vat,total_p,receipt,credit)values('$product','$code',
'$qty',NOW(),'$price','$vvat','$total','$receipt','$credit')";
$sql=mysqli_query($dbc,$r);
$c="select * from products where _name='$product' limit 1";
$cc=mysqli_query($dbc,$c);
$ccc=mysqli_fetch_array($cc);
$stock=$ccc['left_p'];
$pid=$ccc['product_id'];
$v="insert into audit(product,date,value,reason,qty,number,stock,user)VALUES('$pid',NOW(),'RETURN IN','CREDIT NOTE','$qty','$credit','$stock','$user')";
$vv=mysqli_query($dbc,$v);
}
}
header("location: return_in.php");
?>