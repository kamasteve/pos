<?require_once('functions.php');
$type='SALES';

Permission($_SESSION['department'],$type);?><script type ="text/javascript" language ="javascript">
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
        </script>
		
<script language="JavaScript" type="text/javascript" src="shortcuts.js"></script>
  <script>
shortcut.add("end",function() {
window.location.replace  ("tables.php");
});;

shortcut.add("end",function() {
window.location.replace ("tables.php");
});;</script>
   <script>
shortcut.add("Ctrl",function() {
window.location.href = window.location.href;
});;

shortcut.add("Ctrl",function() {
window.location.href = window.location.href;
});;</script>

		<!DOCTYPE html>
<html dir="ltr" lang="en-US"><head><!-- Created by Artisteer v4.0.0.58475 -->
        <meta charset="utf-8">
        <title>Receipts</title>
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
               <?php headermenu($_SESSION['department'],'SALES'); ?> 
            </nav>

<?



DepositReceipt($_REQUEST['r'],$_REQUEST['c'],$_REQUEST['ch'],$_REQUEST['x'],$_SESSION['user'],$_REQUEST['d'],$_REQUEST['de']);
unset($_SESSION['products']);
	unset($_SESSION['RECEIPT']);
	unset($_SESSION['amount']);
	unset($_SESSION['deposit']);
	unset($_SESSION['date']);

	session_regenerate_id();

