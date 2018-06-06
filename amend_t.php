<?
require_once('functions.php');
if($_GET['submitt']){



 $id=$_GET['idd'];
if($id){
$amount=$_GET['amount'];
 $debit=$_GET['debit'];
$credit=$_GET['credit'];
$date=$_GET['date'];
$new=$_GET['new'];
$m=mysql_query("select * from ledgers where session='$id' and debit>0");
$mm=mysql_fetch_array($m);
$namee=Legers($mm['account_id']);
$name=Legers($mm['froms']);
UserAudit($_SESSION['user'],"Amended Transaction that credited $name ,debited $namee from $amount to $new",date("Y/m/d"),$ip);
$f="update ledgers set account_id='$debit',froms='$credit',debit='$new' where  session='$id' and debit='$amount' and date='$date'";
$ff=mysqli_query($dbc,$f);
$f="update ledgers set account_id='$credit',froms='$debit',credit='$new' where  session='$id' and credit='$amount' and date='$date'";
$ff=mysqli_query($dbc,$f);

}

$url='cancel_t.php';
ob_end_clean();
header("Location: $url");
}
?>
<fieldset><legend><b>Edit Transactions</b></legend>
<form action="amend_t.php" method="GET" name="abc">




<?
$idd=$_GET['idd'];
$date=$_GET['date'];
$amount=$_GET['amount'];
mysql_connect('localhost','root','');
mysql_select_db('point_of_sale');
$result=@mysql_query("SELECT *
FROM `accounts`");
print"<b>Debit:</br>";

print"<select name=\"debit\" required='required'>";
print "<option></option>";
while ($row=mysql_fetch_assoc($result)){
$id=$row['id'];
$name=$row['name'];
print"<option value=$id>$name\n";
}
print"</select>\n";
print"</p>\n";
?>
</td></tr>


<?
mysql_connect('localhost','root','');
mysql_select_db('point_of_sale');
$result=@mysql_query("SELECT *
FROM `accounts`");
print"<b>Credit:</br>";

print"<select name=\"credit\" required='required'>";
print "<option></option>";
while ($row=mysql_fetch_assoc($result)){
$id=$row['id'];
$name=$row['name'];
print"<option value=$id>$name\n";
}
print"</select>\n";
print"</p>\n";
 echo '<label>Amount</label><input type="text" name="new" value="'
. $amount. '"/>';
 echo '<input type="hidden" name="idd" value="'
. $idd. '" />';
 echo '<input type="hidden" name="date" value="'
. $date. '" />';
 echo '<input type="hidden" name="amount" value="'
. $amount. '" />';
?>
</td></tr>




<input name="submitt" style="height: 50px;background-color#4AC948;  width: 150px;
	cursor:pointer;" type="submit" value="Edit Transactions">
</form></fieldset>