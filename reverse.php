<?
require_once('functions.php');
$type='ADMIN';

Permission($_SESSION['department'],$type);

if($_POST['submitted']){
$id=$_POST['id'];
$status=$_POST['sure'];
if($id){
if($status=='Yes'){
$f="select * from users where user_id='$id'";
$ff=mysqli_query($dbc,$f);
while($row=mysqli_fetch_array($ff)){

$t="update users set status='DISABLED' where user_id='$id'";
$tt=mysqli_query($dbc,$t);

}

;
}
}

$url='administer_users.php';
ob_end_clean();
header("Location: $url");
}
?>


<?
require_once('conf.php');
$id = $_POST['id'];


 echo '<form action="receipt_r.php"method="post">
 <h3>Receipt : ' . $id . '</h3>
 <p><b>Are you sure you want to Reverse This  Receipt ?<br />
 <input type="radio" name="sure"
value="Yes" /> Yes
 <input type="radio" name="sure" value=
"No" checked="checked" /> No</p>
 <p><input type="submit" name="submit"
value="Reverse Receipt" /></p>
 <input type="hidden" name="reverse"
value="TRUE" />
 <input type="hidden" name="id" value="'
. $id . '" />
 </form>';
 



 ?>
 