<?
require_once('functions.php');
require_once('print.php');

$id=$_POST['account'];
$date1=$_POST['date1'];
$date2=$_POST['date2'];
 $sub=$_POST['sub'];
 

//ini_set('display_errors', 1);
$type='ACCOUNTS';

Permission($_SESSION['department'],$type)
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US"><head><!-- Created by Artisteer v4.0.0.58475 -->
        <meta charset="utf-8">
        <title>Ledger Report</title>
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
                <?php headermenu($_SESSION['department'],'ACCOUNTS'); ?>
            </nav><div id="layer2" style="margin-right:800px;">
			
			<?
			if($sub==''){
			require_once('table.php');
			?>
			<div id="layer2" style="margin-right:1000px;">
<form name="export" action="export.php" method="post">
    <input type="image" value=<img src="excel.png" width="50" height="41"/></a>
    <input type="hidden" value="<? echo $csv_hdr; ?>" name="csv_hdr">
    <input type="hidden" value="<? echo $csv_output; ?>" name="csv_output">
	<input type="hidden" value="<? echo $date2; ?>" name="date2">
	<input type="hidden" value="<? echo $date1; ?>" name="date1">
	<input type="hidden" value="<? echo $id; ?>" name="id">
</form></div></center><?

ledgerView($id,$date1,$date2);
}
			if($sub){
SubledgerView($id,$date1,$date2,$sub);
}
