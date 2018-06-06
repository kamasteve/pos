<?
require_once('functions.php');
$type=$_GET['s'];
if($type=='SALES'){
	
$r=mysql_query("SELECT * ,sum(qty)as qty,sum(total_p)as total from sales where 
date =date(NOW())

");
$row=mysql_fetch_array($r);
$sales=$row['total'];
$sale=number_format($sales);
$r=mysql_query("SELECT * ,sum(qty)as qty,sum(total_p)as total from sales where 
date =date(NOW())

and type='INVOICE'");
$row=mysql_fetch_array($r);
$invoice=$row['total'];
$cash=number_format($sales-$invoice);
$invoice=number_format($row['total']);
$date=date("Y/m/d");
$sms="Hi System report as at $date is as follows,total sales $sale,Cash sales $cash, Invoice Sales $invoice";
$phone='0722454424';
	SendSMS($host, $port, $username, $password, $phone, $sms);
}