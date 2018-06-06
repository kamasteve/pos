<?php
include('functions.php');
$r=mysql_query("SELECT *,qty as  q,total_p as 
 total FROM sales WHERE DAY( date ) = DAY(CURRENT_DATE )
AND MONTH(date)=MONTH(NOW())
AND YEAR(date)=YEAR(NOW())
and status='ACTIVE' group by sale_id order by number desc");
$sa=mysql_query("select sum(total_p)as total from sales where date=CURDATE()");
$sal=mysql_fetch_array($sa);
$row=mysql_fetch_array($r);
$tod=$sal['total'];
//$h=mysql_query("select sum(debit)as tot  from ledgers where date =CURDATE() and description='Supplier Payments'");
//$g=mysql_query("select sum(debit)as tok  from ledgers where date =CURDATE() and description='FUNDS TRANSFER'");
//$yt=mysql_query("select sum(amount)as amn from expenses where date=CURDATE()");
//$CA=MYSQL_QUERY("select sum(cash)as pick from cpick where date=CURDATE()");
$pi=mysql_fetch_array($CA);
$gh=mysql_fetch_array($yt);
$rw=mysql_fetch_array($h);
$ty=mysql_fetch_array($g);
$tot=$rw['tot'];
$tok=$ty['tok'];
$amn=$gh['amn'];
$td=$pi['pick'];
     $total+=$row['total'];
 //$cum=$td+$total;
 //$ex=$tot+$amn+$tok;
// $fin=$cum-$ex;
	$mes='Today\'s sales as at 5:40 PM are '.number_format($tod).',  Suppliers were paid a total of '.number_format($tot).', other expenses for the day stood at
	'.number_format($gh).'  the final amount for the day is '.number_format($fin).'';
					  $x = SendSMS("127.0.0.1", 8800, "josh", "josh", "0702225082", $mes);
					  echo $x;?>