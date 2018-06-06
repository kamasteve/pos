<?
require_once('functions.php');

$date=$_POST['date'];
$debit=$_POST['debit'];
$cheque=$_POST['cheque'];
$credit=$_POST['credit'];
$date=$_POST['date'];
$amount=$_POST['amount'];
$session=session_id();
$_SESSION['multiple']=$session;

$_SESSION['credit']=$credit;
$_SESSION['date']=$date;
$_SESSION['debit']=$debit;
$_SESSION['cheque']=$cheque;
$_SESSION['amount']=$amount;
if($debit==''&&$credit!=''){
$url='double_entrym.php';
$_SESSION['gg']=$credit;
}
if($credit==''&&$debit!=''){
$url='double_entrym.php';
$_SESSION['gg']=$debit;
}
if($debit!=''&&$credit!=''){
$url='double.php?msg=**Please Choose Either A Debit Or A Credit Not Both**';

}
if($date==''){
$url='double.php?msg=**Please Choose A Valid Date**';

}



ob_end_clean();
header("Location: $url");
?>