<?
require_once('functions.php');

if($_POST['submitted']){

$status=$_POST['sure'];
$date=$_POST['date'];
 $id=$_POST['id'];
  $amount=$_POST['amount'];
if($id){
if($status=='Yes'){
$m=mysql_query("select * from ledgers where session='$id' and debit>0");
$mm=mysql_fetch_array($m);
$namee=Legers($mm['account_id']);
$name=Legers($mm['froms']);
$amount=$mm['debit'];
$name=Legers($income);UserAudit($_SESSION['user'],"Deleted Transaction that credited $name ,debited $namee with $amount",date("Y/m/d"),$ip);
$f="delete from ledgers where session='$id' and date='$date' and debit='$amount'";
$ff=mysqli_query($dbc,$f);
$f="delete from ledgers where session='$id' and date='$date' and credit='$amount'";
$ff=mysqli_query($dbc,$f);
}
}

$url='cancel_t.php';
ob_end_clean();
header("Location: $url");
}
?>


<?
require_once('conf.php');
$id = $_GET['id'];
$date= $_GET['date'];
$r=mysql_query("select * from ledgers where session='$id' and debit>0");
$row=mysql_fetch_array($r);
 echo '<form action="delete_t.php"method="post">
 <h3>Account Name: ' . legers($row['account_id']) . '</h3>
 <p><b>Are you sure you want to Delete  This Transaction ?<br />
 <input type="radio" name="sure"
value="Yes" /> Yes
 <input type="radio" name="sure" value=
"No" checked="checked" /> No</p>
 <p><input type="submit" name="submit"
value="Delete Accounts" /></p>
 <input type="hidden" name="submitted"
value="TRUE" />
 <input type="hidden" name="id" value="'
. $id . '" />
<input type="hidden" name="date" value="'
. $date. '" />
 </form>';
 



 ?>
 