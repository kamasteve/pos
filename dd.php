<?
require_once('functions.php');
$_SESSION['status']='';
$_SESSION['msg']='';
$project=$_POST['project'];
$supplier=$_POST['supplier'];
$expected=$_POST['expected'];
$date=$_POST['date'];
$invoice=$_POST['invoice'];
$_SESSION['type']=$_POST['sale'];
$_SESSION['project']=$project;
$_SESSION['date']=$date;
$_SESSION['expected']=$expected;
$_SESSION['customer']=$supplier;
$_SESSION['MEMBER']=$invoice;
$status=DateStatus($date);
$r=mysql_query("select * from accounts where id='$supplier'");
$row=mysql_fetch_array($r);
$limit=$row['descc'];
	$_SESSION['limit']=$limit;	
	$l=mysql_query("select sum(debit)-sum(credit) as balance from ledgers where account_id='$supplier'");
	$rew=mysql_fetch_array($l);
	$balance=$rew['balance'];
	$_SESSION['balanced']=$balance;	
	if($status!='CLOSED'){

$url='creditors.php';
}else{
$_SESSION['status']='Transaction Not Possible ! Financial Year Already Closed !!';
$url='creditorss.php';
}


ob_end_clean();
header("Location: $url");
?>