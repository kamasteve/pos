<?
require_once('functions.php');
require_once('print.php');

$date=$_POST['date'];
$type='ACCOUNTS';

Permission($_SESSION['department'],$type);
ini_set('display_errors', '0');
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US"><head><!-- Created by Artisteer v4.0.0.58475 -->
        <meta charset="utf-8">
        <title>Payroll Report</title>
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
            </nav>
			<a href="javascript:void(processPrint());"><input type="image" value=<img src="print.png"/></a>
<div id="printMe">
			<?
			$r=mysql_query("select * from employee");
			while($row=mysql_fetch_array($r)){
ViewPayslips($row['employee_id'],$date);
}

?>