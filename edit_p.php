<?
require_once('functions.php');
$mini=$_POST['minimum'];
$maxi=$_POST['maximum'];
$rate=$_POST['rate'];
$id=$_POST['id'];
$r=mysql_query("update tax set rate='$rate',mini='$mini',maxi='$maxi' where tax_id='$id'");
UserAudit($_SESSION['user'],"Edited Tax Brackets Id No $id
														 ",date("Y/m/d"),$ip);
  header("location: administer_paye.php");