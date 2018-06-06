<?
require_once('functions.php');
$type='ADMIN';

Permission($_SESSION['department'],$type);

if($_POST['submitted']){
$id=$_POST['id'];
$status=$_POST['sure'];
if($id){
if($status=='Yes'){


$t="delete  from users  where user_id='$id'";
$tt=mysqli_query($dbc,$t);

}


}


$url='administer_users.php';
ob_end_clean();
header("Location: $url");
}
?>


<?
require_once('conf.php');
$id = $_GET['id'];
$r=mysql_query("select * from users where user_id='$id'");
$row=mysql_fetch_array($r);
 echo '<form action="delete_a.php"method="post">
 <h3>Account Name: ' . $row['name'] . '</h3>
 <p><b>Are you sure you want to Delete  This User Account ?<br />
 <input type="radio" name="sure"
value="Yes" /> Yes
 <input type="radio" name="sure" value=
"No" checked="checked" /> No</p>
 <p><input type="submit" name="submit"
value="Delete Account" /></p>
 <input type="hidden" name="submitted"
value="TRUE" />
 <input type="hidden" name="id" value="'
. $id . '" />
 </form>';
 



 ?>
 