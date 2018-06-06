
<?
require_once('functions.php');




require_once('mysql.php');
if(isset($_POST['submit'])){
$s="select * from rcode";
$sql=mysqli_query($dbc,$s);
$row=mysqli_fetch_array($sql);
$code=$row['code'];
$_SESSION['CREDIT']=$code;
$_SESSION['SESS']=$_POST['receipt'];
$url='return_in.php';
ob_end_clean();
header("Location: $url");
}
$type='BACK OFFICE';

Permission($_SESSION['department'],$type);
	
	 ?>
	 
	 <!DOCTYPE html>
<html dir="ltr" lang="en-US"><head><!-- Created by Artisteer v4.0.0.58475 -->
        <meta charset="utf-8">
        <title>Create Credit Note</title>
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
	 
	 <style>
input[type='text'] { font-size: 20px; }
</style>
	 <style type="text/css">
    .fieldset-auto-width {
         display: inline-block;
    }
</style><div align="center"><fieldset class="fieldset-auto-width">
<form action="return_r.php" method="post">
<H3>RECEIPT NO:</H3><br />
<input name="receipt"  REQUIRED="REQUIRED" value="" size="50"/>

<br />



<input name="submit" type="submit" value="GET">
</form>
<div\>
