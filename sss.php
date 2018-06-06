<?
<?session_start();
require_once('conf.php');
$r=mysql_query("select * from lcode");
$row=mysql_fetch_array($r);
$code=$row['code'];
 $_SESSION['SEMBER']=$code;
$t=mysql_query("update lcode set code=code+1");
header("location: lpp.php");
?>