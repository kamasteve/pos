<?//require_once('account.php');?>



<a href="javascript:void(processPrint());"><input type="image" value=<img src="print.png"/></a>
<?
require_once('mysql.php');
require_once('print.php');
$t="select * from employee where e_no='$n'";
$tt=mysqli_query($dbc,$t);
$row=mysqli_fetch_array(
$y = date( "Y" );
$m=date("M");

$t="SELECT basic_salary+house_allowance+allowance+bonus-nssf AS gross
FROM payslip WHERE employee_id='$id'";
$gg=mysqli_query($dbc,$t);
$row = mysqli_fetch_assoc($gg);
$gross = $row['gross'];
$dd="SELECT tax_id FROM tax WHERE '$gross' BETWEEN mini and maxi";
$ff=mysqli_query($dbc,$dd);

$row =mysqli_fetch_assoc($ff);
$tax_id = $row['tax_id'];
$ll="SELECT mini,rate FROM tax WHERE  tax_id='$tax_id'";
$cc=mysqli_query($dbc,$ll);
$row = mysqli_fetch_assoc($cc);
$mini = $row['mini'];
$rate = $row['rate'];
$taxable=$gross-$mini;
  $firstpaye =$taxable*$rate/100;
$id2=$tax_id-1;
$y="SELECT tax FROM tax WHERE tax_id='$id2'";
$xx=mysqli_query($dbc,$y);
$row = mysqli_fetch_assoc($xx);
$tax = $row['tax'];
$paye=$tax+$firstpaye-1162;
if($paye<=0){
$paye=0.0;
}
$z="SELECT rate FROM nhif WHERE '$gross' BETWEEN mini and maxi";
$zz=mysqli_query($dbc,$z);
$row = mysqli_fetch_assoc($zz);
//$nhif = $row['rate'];


$s="SELECT basic_salary,bonus,absences,
 allowance, house_allowance,advances,
 hardship,pension,  nssf,nhif, loan,(basic_salary+house_allowance+allowance+bonus)
 AS total,
 (loan+'$paye'+nssf+nhif+advances+absences+pension)as deductions,(basic_salary+house_allowance+allowance+bonus)-
 (loan+'$paye'+nssf+nhif+advances+absences+pension)as net FROM payslip,employee
 
 WHERE payslip.employee_id='$id'

 
";
$sql=mysqli_query($dbc,$s);
$row = mysqli_fetch_assoc($sql);
$names = $row['names'];
$id=$row['id_no'];
$absences = $row['absences'];
$basic_salary = $row['basic_salary'];
$allowance = $row['allowance'];
$advance = $row['advances'];
$bonus= $row['bonus'];
$pension= $row['pension'];
$month= $row['month'];
$year= $row['year'];
$nhif=$row['nhif'];

$house_allowance = $row['house_allowance'];
$nssf = $row['nssf'];

$total = $row['total'];
//$nhif =$row['nhif'];
$loan = $row['loan'];
$date = $row['date(NOW())'];

$deductions = $row['deductions'];
$net =$row['net'];

?>
<div id="printMe">
<table border="1" style="background-color:#ffffff"; rules="NONE"
        frame="BOX" width="530" align="center" 
 cellpadding="5" cellspacing="0" style="Trebuchet MS";>
  <tr>
   <td width="85" style="border-color:#090; border-style:solid; border-width:0px";>
   <div align="left"><strong><img border="0" src="log.jpg" width="80" height="81">
   </strong></div></td><td width="655"><strong><div style="text-transform: uppercase;font-size:16px;color:green">
   
   
  &nbsp;&nbsp; &nbsp;&nbsp;G.N.T SACCO L.T.D<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;P.O.BOX 267, Gatundu, TEL:0717 247 600<br>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;www.fountaingatechurch.org<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TEL:0716-919783<br>
 <td width="85" style="border-color:#090; border-style:solid; border-width:0px";>
   <div align="right"><strong><img border="0" src="log.jpg" width="80" height="81">
   </strong></div></td></tr><tr><td>
   <b>NAME &nbsp;&nbsp;&nbsp;&nbsp;:</td><td><u><?echo $names;?></u></td></tr><tr>
   <td><b>PAYSLIP&nbsp;&nbsp;:</td><td><u> FOR THE MONTH OF <? echo $month;?> YEAR <?echo  $year;?></td></tr><tr>
</table><table border="1" style="background-color:#ffffff"; rules="NONE"
        frame="BOX" width="530" align="center" 
 cellpadding="4" cellspacing="0" style="Trebuchet MS";><tr>
<td style="border-color:#090;background-color:grey; border-style:solid; border-width:1px";>
BASIC SALARY</td><td style="border-color:#090;background-color:grey; border-style:solid; border-width:1px";><?echo $basic_salary;?></td></tr><tr>
<td style="border-color:#090; border-style:solid; border-width:1px";>
ALLOWANCES</td><td style="border-color:#090; border-style:solid; border-width:1px";><?echo $allowance;?></td></tr><tr>
<td style="border-color:#090;background-color:grey; border-style:solid; border-width:1px";>
HOUSE ALLOWANCE</td><td style="border-color:#090;background-color:grey; border-style:solid; border-width:1px";><?echo $house_allowance;?></td></tr><tr>
<td style="border-color:#090; border-style:solid; border-width:1px";>
BONUS</td><td style="border-color:#090; border-style:solid; border-width:1px";><?echo $bonus;?></td></tr><tr>
<td style="border-color:#090;background-color:grey; border-style:solid; border-width:1px";><b>GROSS PAY
</td><td style="border-color:#090;background-color:grey; border-style:solid; border-width:1px";><b><?echo number_format($gross,2);?></td></tr><tr><td><b>DEDUCTIONS</td></tr><tr>
<td style="border-color:#090;background-color:grey; border-style:solid; border-width:1px";>
PAYE</td><td style="border-color:#090;background-color:grey; border-style:solid; border-width:1px";><?echo number_format($paye,2);?></td></tr><tr>
<td style="border-color:#090; border-style:solid; border-width:1px";>
N.S.S.F</td><td style="border-color:#090; border-style:solid; border-width:1px";><?echo $nssf;?></td></tr><tr>
<td style="border-color:#090;background-color:grey; border-style:solid; border-width:1px";>
N.H.I.F</td><td style="border-color:#090;background-color:grey; border-style:solid; border-width:1px";><?echo $nhif;?></td></tr><tr>
<td style="border-color:#090; border-style:solid; border-width:1px";>
ADVANCE</td><td style="border-color:#090; border-style:solid; border-width:1px";><?echo $advance;?></td></tr>
<td style="border-color:#090;background-color:grey; border-style:solid; border-width:1px";>
LOAN</td><td style="border-color:#090;background-color:grey; border-style:solid; border-width:1px";><?echo $loan;?></td></tr><tr>
<td style="border-color:#090; border-style:solid; border-width:1px";>
<b>TOTAL DEDUCTIONS</td><td style="border-color:#090; border-style:solid; border-width:1px";><b><?echo $deductions;?></td></tr><tr>
<td style="border-color:#090;background-color:grey; border-style:solid; border-width:1px";>
<b>NET PAY</td><td style="border-color:#090;background-color:grey; border-style:solid; border-width:1px";><b><?echo $net;?></td></tr></table>
<table border="1" style="background-color:#ffffff"; rules="NONE"
        frame="BOX" width="530" align="center" 
 cellpadding="4" cellspacing="0" style="Trebuchet MS";>
<tr><td>SIGNED BY<br>.......................................</td></tr>
<tr>
			<td>STAMP</td><td>
			
			<textarea cols="29" rows="3"></textarea></td></tr></table>
 