<?ob_start();
require_once('functions.php');
$type='BACK OFFICE';

Permission($_SESSION['department'],$type);




?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US"><head><!-- Created by Artisteer v4.0.0.58475 -->
        <meta charset="utf-8">
        <title>Z Report Users</title>
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
<script type ="text/javascript" language ="javascript">
            function Print(elementId)
            {
                var printContent = document.getElementById(elementId);
                var windowUrl = 'about:blank';
                var uniqueName = new Date();
                var windowName = 'Print' + uniqueName.getTime();
                var printWindow = window.open(windowUrl, windowName, 'left=0,top=0,width=0,height=0');
                printWindow.document.write(printContent.innerHTML);
                printWindow.document.close();
                printWindow.focus();
                printWindow.print();
                printWindow.close();
            }
        </script><?
require_once('mysql.php');
	ini_set('display_errors', 0);
	
	
	$user=$_SESSION['user'];
if(isset($_POST["submit"])){
require_once('functions.php');
	 $user=$_SESSION['user'];
	 $cash=$_POST['cash'];
	  $float=$_POST['float'];
	   $picked=$_POST['picked'];
	      $petty=$_POST['petty'];
	  $mpesa=$_POST['mpesa'];
	   $credit=$_POST['credit'];
	    $cheque=$_POST['cheque'];
	$_SESSION['SESSIONN']=session_id();
	$x=$_SESSION['SESSIONN'];
	
	$ip=get_client_ip() ;
		 $till=teller($ip);
	$u=$_POST['id'];
	CXreportU($user,$till,$cash,$credit,$mpesa,$cheque,$session,$float,$picked,$petty,$u);


	}
	  unset($_SESSION['SESSIONN']);
  session_regenerate_id();
	
	 ?>
	 <style type="text/css">
    .fieldset-auto-width {
         display: inline-block;
    }
</style><form action="user_pick.php" method="post"><div align="center"><fieldset class="fieldset-auto-width"><legend>Create Z Report For User <b><?echo $_GET['id'];?></b></legend>
Opening Float:<br />
<input name="float" type="text" REQUIRED="REQUIRED" value="" size="50"/>

<br />
Total Cash Picked:<br />
<input name="picked" type="text" REQUIRED="REQUIRED" value="" size="50"/>

<br />
Total Petty Cash :<br />
<input name="petty" type="text" REQUIRED="REQUIRED" value="" size="50"/>

<br />
Amount In Cash Drawer:<br />
<input name="cash" type="text" REQUIRED="REQUIRED" value="" size="50"/>

<br />
Mpesa Amount:<br />
<input name="mpesa" type="text" REQUIRED="REQUIRED" value="" size="50"/>

<br />
Credit Notes Amount:<br />
<input name="credit" type="text" REQUIRED="REQUIRED" value="" size="50"/>

<br />
Cheque Amount:<br />
<input name="cheque" type="text" REQUIRED="REQUIRED" value="" size="50"/>

<br />

<input type="hidden" name="id"  value="<?echo $_GET['id'];?>">

<input name="submit" type="submit" value="CREATE">
</form>
<div\>
