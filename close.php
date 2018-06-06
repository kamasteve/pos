<?
require_once('functions.php');
$type='ADMIN';

Permission($_SESSION['department'],$type);

if(isset($_POST['idd'])){
 $id=$_POST['idd'];

 $status=$_POST['sure'];
if($id){
if($status=='Yes'){
$start=$_POST['start'];
$end=$_POST['end'];
UserAudit($_SESSION['user_id'],"Closed Financial Year $start To $end",date("Y/m/d"),$ip);
CloseYear($id);

}


}


$url='financial_year.php';
ob_end_clean();
header("Location: $url");
}
?>


<?
require_once('conf.php');
$id = $_GET['id'];
$r=mysql_query("select * from financial_year where id='$id'");
$row=mysql_fetch_array($r);
 echo '<form action="close.php" method="POST">
 <h3>Start Date: ' . $row['start'] . ' End Date: ' . $row['end'] . '</h3>
 <p><b>Are you sure you want to Close This Financial Year ?<br />
 <input type="radio" name="sure"
value="Yes" /> Yes
 <input type="radio" name="sure" value=
"No" checked="checked" /> No</p>
 <p><input type="submit" name="submit"
value="Close Year " /></p>
 <input type="hidden" name="submitted"
value="TRUE" />
 <input type="hidden" name="idd" value="'
. $id . '" />
 <input type="hidden" name="start" value="'
. $row['start'] . '" />
 <input type="hidden" name="end" value="'
. $row['end'] . '" />
 
 </form>';
 



 ?>
 