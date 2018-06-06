
<?
ob_start();



require_once('functions.php');
session_start();
$session=session_id();
$level=$_SESSION['admin_level'];

require_once('functions.php');

require_once('mysql.php');
	ini_set('display_errors', 0);
	
	$user=$_SESSION['user_name'];
if(isset($_POST["submit"])){

	 $user=$_SESSION['user_name'];
	 $cash=$_POST['cash'];
	
	$ip=get_client_ip() ;
		 $till=teller($ip);
		 $r="insert into cpick(cash,user,till,date,time,session)values
		 ('$cash','$user','$till',NOW(),NOW(),'$session')";
		 $sql=mysqli_query($dbc,$r);
		 $d="select * from pick";
		 $dd=mysqli_query($dbc,$d);
		 $ddd=mysqli_fetch_array($dd);
		 $no=$ddd['code'];
		 $l="update pick set code=code+1";
		 $ll=mysqli_query($dbc,$l);
	CashPick($session,$cash,$till,$user,$no);
session_regenerate_id();
	}
	$type='BACK OFFICE';

Permission($_SESSION['department'],$type);
	 ?>
	 <!DOCTYPE html>
<html dir="ltr" lang="en-US"><head><!-- Created by Artisteer v4.0.0.58475 -->
        <meta charset="utf-8">
        <title>CASH PICK</title>
        <!--<meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">-->
        <meta name="HandheldFriendly" content="True"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
        <meta name="HandheldFriendly" content="true" />
        <meta name="MobileOptimized" content="true" />

        <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <link rel="stylesheet" href="style.css" media="screen">
        <!--[if lte IE 7]><link rel="stylesheet" href="style.ie7.css" media="screen" /><![endif]-->
        <link rel="stylesheet" href="style.responsive.css" media="all">


        <script src="jquery.js"></script>
        <script src="script.js"></script>
        <script src="script.responsive.js"></script>
        <meta name="description" content="NEURO DATA">
        <meta name="keywords" content="EZ-SACCO">
 <nav class="art-nav clearfix">
                <?php headermenu($_SESSION['department'],'BACK OFFICE'); ?> 
            </nav>
	 <style type="text/css">
    .fieldset-auto-width {
         display: inline-block;
    }
</style><form action="cash.php" method="post"><div align="center"><fieldset class="fieldset-auto-width"><legend>Create Cash Pick Report</legend>

CASH PICK AMOUNT:<br />
<input name="cash" type="text" REQUIRED="REQUIRED" value="" size="50"/>




<br />




<input name="submit" type="submit" value="CREATE">
</form>
<div\>
