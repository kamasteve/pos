<?
require_once('functions.php');
$type='ADMIN';

Permission($_SESSION['department'],$type);

if(isset($_POST['id'])){
$id=$_POST['id'];
$status=$_POST['sure'];
if($id){
if($status=='Yes'){

$name=$_POST['name'];
UserAudit($_SESSION['user_id'],"Reactivated Ledger $name",date("Y/m/d"),$ip);
$t="update accounts set status='ACTIVE'  where id='$id'";
$tt=mysqli_query($dbc,$t);

}


}


$url='add_accounts.php';
ob_end_clean();
header("Location: $url");
}
?>


<?
require_once('conf.php');
$id = $_GET['id'];
$r=mysql_query("select * from accounts where id='$id'");
$row=mysql_fetch_array($r);
 echo '<form action="reactivate.php"method="post">
 <h3>Account Name: ' . $row['name'] . '</h3>
 <p><b>Are you sure you want to Activate  This Ledger Account ?<br />
 <input type="radio" name="sure"
value="Yes" /> Yes
 <input type="radio" name="sure" value=
"No" checked="checked" /> No</p>
 <p><input type="submit" name="submit"
value="Deactivate Account" /></p>
 <input type="hidden" name="submitted"
value="TRUE" />
 <input type="hidden" name="id" value="'
. $id . '" /> <input type="hidden" name="name" value="'
. $row['name'] . '" />

 </form>';
 



 ?>
 