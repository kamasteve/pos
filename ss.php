<?
require_once('functions.php');
$_SESSION['status']='';
$project=$_POST['project'];
$supplier=$_POST['supplier'];
$expected=$_POST['expected'];
$date=$_POST['date'];
$invoice=$_POST['invoice'];
$_SESSION['project']=$project;
$_SESSION['date']=$date;
$_SESSION['expected']=$expected;
$_SESSION['supplier']=$supplier;
$_SESSION['MEMBER']=$invoice;
$status=DateStatus($date);
														 if($status!='CLOSED'){
UserAudit($_SESSION['user_id'],"Added Sales Invoice No $invoice",date("Y/m/d"),$ip);
$url='stocking.php';
}else{
$_SESSION['status']='Transaction Not Possible ! Financial Year Already Closed !!';
$url='stockk.php';
}


ob_end_clean();
header("Location: $url");
?>