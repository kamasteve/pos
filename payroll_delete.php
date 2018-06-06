

<?
require_once('conf.php');
$id = $_GET['idd'];
$r=mysql_query("select * from pgroups where id='$id'");
$row=mysql_fetch_array($r);
 echo '<form action="payroll_votes.php"method="post">
 <h3>Vote Name: ' . $row['name'] . '</h3>
 <p><b>Are you sure you want to Delete This Vote ?<br />
 <input type="radio" name="sure"
value="Yes" /> Yes
 <input type="radio" name="sure" value=
"No" checked="checked" /> No</p>
 <p><input type="submit" name="submit"
value="Submit" /></p>
 <input type="hidden" name="submitted"
value="TRUE" />
 <input type="hidden" name="id" value="'
. $id . '" />
 </form>';
 



 ?>
 