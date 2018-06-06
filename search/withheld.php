<?
include_once '../conf.php';
include_once '../froms.php';
include_once '../function.php';
$q = $_GET["q"];
$r=mysql_query("select *,amount-rem as held from g_percentage where gnumber='$q' and status='ACTIVE' order by held desc");
    echo ' <a href="javascript:void(processPrint());"><input type="image" value=<img src="print.png"/></a>
<div id="printMe"><div align="center"><h2>Withheld Shares Information For Member '.$q.' </h2></div>
<table class="tables" border="1" cellspacing="0">
        <tr><th>Member No</th><th>Shares</th><th>Loan Type</th><th>Guaranteed</th><th>Freed</th><th>Held</th></tr>';
		 while ($row=mysql_fetch_array($r)){
		 
		 $g+=$row['amount'];
		 $p+=$row['rem'];
		 $h+=$row['held'];
 
  echo '<tr><td>' . ($row['membernumber']). '</td><td>' .($row['shares']). '</td><td>' .LoanName($row['transid']). '</td><td>' .number_format($row['amount'],0). '</td>
  <td>' . number_format(($row['rem']),0). '</td><td>' . number_format(($row['held']),0). '</td></tr>';
  }
    echo '<tr><td colspan="3"><b>TOTAL</td><td><b>' .number_format($g,0). '</td>
  <td><b>' . number_format(($p),0). '</td><td><b>' . number_format(($h),0). '</td></tr></table></div>';
