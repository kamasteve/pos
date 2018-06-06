<?function ledgerViewP($date1,$date2){
   require_once('print.php');

  
   
echo' 
 <div align="center"> <tr><td><center><img src="images/logos.png" width="124" height="124"/></center></td></tr>   </strong></div>
 <div align="center"><h2><strong>Sweet-world Supemarket Ruai Branch</h2></strong></div>
<div align="center">Purchases Report For The Date: <strong>'.$date1.'  To '.$date2.'</strong></div>
<table width="950" align="center" cellpadding="0" cellspacing="0" style="font-size:14px; border-color:#000000;background-color:#ffffff; border-style:solid; border-width:1px;">
  <tr><td width="5" style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center"><strong>No.</strong></div></td>
    <th width="85" style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center"><strong>View Particulars</strong></div></th>
    <td width="85" style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left"><strong>Date</strong></div></td>
    <td width="169" style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center"><strong>Invoice No. </strong></div></td>
     <td width="169" style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center"><strong>Invoice Status. </strong></div></td>
     <td width="1907" style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center"><strong>Supplier </strong></div></td>
   <td width="174" style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center"><strong>Supplier P.I.N </strong></div></td>
 <td width="154" style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center"><strong> Net </strong></div></td>
 <td width="154" style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center"><strong> V.A.T Amount </strong></div></td>
    <td width="87" style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center"><strong>Total</strong></div></td>
	  <td width="87" style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center"><strong>Debit-Notes Amount</strong></div></td>
  </tr>';
  
  
  require_once('mysql.php');
  function formatMoney($number, $fractional=false) {
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
  }
$t=1;
$r=mysql_query("SELECT *, sum(total_p) as totals, sum(tax) as taxes FROM stocking where 
 p_date BETWEEN '$date1' AND '$date2'
 group by t_code order by supplier asc


");


$rr=mysql_query("SELECT sum(total_p)as t FROM stocking where 
 p_date BETWEEN '$date1' AND '$date2' 
");
$rows=mysql_fetch_array($rr);
$to=$rows['t'];
while($row = mysql_fetch_array($r))
{
  echo '<tr>';
    echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center">'.$t++.'</div></td>';
     echo '<td><div align="center">'.
    '<a rel="facebox" href=preview.php?idd=' . $row["t_code"] .'&id=' . $row["supplier"] .'>VIEW</a>'.' </div></td>';
    echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center">'.$row['p_date'].'</div></td>';
    echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.$row['t_code'].'</div></td>';
    echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="right">'.$row['step'].'</div></td>';
   echo '<td style="border-color:#000000; border-style:solid; border-width:2px;"><div align="left">'.MODE($row['supplier']).'</div></td>';
    echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center">'.getvats($row['supplier']).'</div></td>';
     $eee=$row['totals'];
    echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="right">'.formatMoney($eee*100/116,2).'</div></td>';
     echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="right">'.$row['taxes'].'</div></td>';

    echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="right">';

  
  echo formatMoney($eee, true);
   echo '<td style="border-color:#000000; border-style:solid; value="00" border-width:1px;"><div align="right">'.formatMoney(getdebits($row['supplier'],$date1,$date2)).'</div></td>';
  echo '</div></td>';
    echo '</tr>';
 }
 
 ?>
  <tr>
    <td colspan="7" style="border-color:#000000; border-style:solid; border-width:1px;"><div align="right"><strong> Total Purchases</strong></div></td>
    <td width="127" style="border-color:#000000; border-style:solid; border-width:1px;">
  
    <div align="right"><strong>
    <?
    
{
  
  echo formatMoney($to++, true);
 }

  echo  '
    </strong></tr></div></div></div></div></div>
 </div>';
 ?> 
 

 <?}
 