
<?

REQUIRE_ONCE('face.php');
function ViewEmployee(){
$r=mysql_query("select * from employee
");
  echo '
     
<table border="1" width="500" cellspacing="0" class="tables"> 
                                                        <thead>
                                                            <tr>
															<th><left>Edit </th> 
															<th><left>Employee Name</th> 
                                                             <th><left>Employee No</th> 
															   <th><left>Phone No</th> 
   <th><left>Id No</th> 
      <th><left>Pin No</th> 
	     <th><left>N.S.S.F No</th> 
		    <th><left>N.H.I.F No</th> 
			   <th><left>Department</th> 
			     <th><left>Position</th> 
			   
                                                            </tr>

                                                        </thead>';

														while($row=mysql_fetch_array($r)){

    echo'<tr><td><a href=employees.php?idd=' . $row["employee_id"] .'>Edit Employee</a></td><td>' . (($row['names'])) . '</td>
	<td>' . (($row['eno'])) . '</td><td>' . (($row['phone'])) . '</td><td>' . (($row['id_no'])) . '</td><td>' . (($row['pin'])) . '</td>
	<td>' . (($row['nssf_no'])) . '</td><td>' . (($row['nhif_no'])) . '</td><td>' . (($row['dep'])) . '</td><td>' . (($row['position'])) . '</td>
	</tr>';
}
							echo "</table>";
}
function ViewPayslips($id,$date){
?>

<table border="1" style="background-color:#ffffff"; rules="NONE"
        frame="BOX" width="530" align="center" 
 cellpadding="5" cellspacing="0" style="Trebuchet MS";></table>
  <tr><td><center><img src="logo.jpg" width="530" height="120"/></center></td></tr> 
 
 <table border="1" style="background-color:#ffffff"; rules="NONE"
        frame="BOX" width="530" align="center" 
 cellpadding="5" cellspacing="0" style="Trebuchet MS";>
<tr><td>
   <b>NAME &nbsp;&nbsp;&nbsp;&nbsp;</td><td><?echo Employees($id);?></u></td></tr>
      <tr><td>
   <b>Id No &nbsp;&nbsp;&nbsp;&nbsp;</td><td><?echo IdNo($id);?></u></td></tr><tr>
   <tr><td>
   <b>Employee No &nbsp;&nbsp;&nbsp;&nbsp;</td><td><?echo EmployeeNo($id);?></u></td></tr><tr>
   <td><b>PAYSLIP&nbsp;&nbsp;</td><td> FOR THE MONTH OF <? echo date('M',strtotime($date))?>  Year <?echo date('Y',strtotime($date));?></td></tr><tr>
</table><table border="1" style="background-color:#ffffff"; rules="NONE"
        frame="BOX" width="530" align="center" 
 cellpadding="4" cellspacing="0" style="Trebuchet MS";><?
 $s=mysql_query("select * from employee_table where debit>0 and month(date)=month('$date') and employee_id='$id' group by group_id");
   $bg = '#eeeeee';
    echo '<tr><td><b><u>ALLOWANCES</td><td></td></tr>';
 while($row=mysql_fetch_array($s)){
  $bg = ($bg=='#eeeeee' ? '#bbbbbb' :
'#eeeeee');
 echo '<tr bgcolor="' . $bg . '"><td>'.Vname($row['group_id']).'</td><td>'.number_format($row['debit']).'</td></tr>';
 }
 echo '<tr><td><b>GROSS</td><td><b><u>'.number_format(GetGross($id,$date)+200).'</td></tr>'; 
  echo '<tr><td><b>TAXABLE AMOUNT</td><td><b><u>'.number_format(GetTaxableP($id,$date)).'</td></tr>'; 
   echo '<tr><td><b><u>DEDUCTIONS</td><td><u></td></tr>';
 echo '<tr><td><b>PAYE</td><td><b><u>'.number_format(GetPayeP($id,$date)).'</td></tr>'; 
 $s=mysql_query("select * from employee_table where credit>0 and month(date)=month('$date') and employee_id='$id' group by group_id");
   $bg = '#eeeeee';
 while($row=mysql_fetch_array($s)){
  $bg = ($bg=='#eeeeee' ? '#bbbbbb' :
'#eeeeee');
 echo '<tr bgcolor="' . $bg . '"><td>'.Vname($row['group_id']).'</td><td>'.number_format($row['credit']).'</td></tr>';
 }
 echo '<tr><td><b>DEDUCTIONS</td><td><b>'.number_format(GetDeductions($id,$date)).'</td></tr>'; 
 echo '<tr><td><b>TOTAL DEDUCTIONS</td><td><b><u>'.number_format(GetDeductions($id,$date)+GetPayeP($id,$date)).'</td></tr>'; 
 echo '<tr><td><b>NET PAY</td><td><b><u>'.number_format(GetNet($id,$date),2).'</td></tr>'; 
 echo '<tr><td>Employee Signature</td><td><b><u>.................................</td></tr>';
  echo '<tr><td>Employer Signature</td><td><b><u>.................................</td></tr>';
}
function PrePayroll(){
$r=mysql_query("select * from pgroups");
echo '
     
<table border="1" width="1000" cellspacing="0" class="tables"> 
                                                        <thead>
                                                            <tr><th><left>Employee</th>';
while($rew=mysql_fetch_array($r)){

echo '<th>'.ucfirst(strtolower($rew['name'])).'</th>';

}															
                                                              
																
                                                                    
                                                           echo'<th><left>Taxable</th> <th><left>Current Paye</th> </tr>';

                                                        echo '</thead>';
$l=mysql_query("select * from employee");
while($row=mysql_fetch_array($l)){
$e=$row['employee_id'];
$r=mysql_query("select * from pgroups");
echo '<tr><td>'.$row['names'].'</td>';
while($rew=mysql_fetch_array($r)){
$id=$rew['id'];
$status=$rew['status'];
if($status=='fixed'){
$d=mysql_query("select sum(credit)+sum(debit)as amount from  fixed where employee_id='$e' and group_id='$id'");
$roa=mysql_fetch_array($d);
$amount=$roa['amount'];
}
if($status=='vary'){
$d=mysql_query("select sum(credit)+sum(debit)as amount from  varance where employee_id='$e' and month(date)=month(NOW()) and group_id='$id'");
$roa=mysql_fetch_array($d);
$amount=$roa['amount'];
}
echo '<td>'.number_format($amount).'</td>';
}
echo '<td>'.number_format((0)).'</td>';
echo '<td>'.number_format((0)).'</td>';
echo '</tr>';
}

echo '</table>';

}
function ViewDeductions(){
$r=mysql_query("select * from pgroups where group_id='2'
");
  echo '
     
<table border="1" width="500" cellspacing="0" class="tables"> 
                                                        <thead>
                                                            <tr>
															<th><left>Delete Vote</th> 
															<th><left>Vote Name</th> 
                                                             
                                                                    
                                                            </tr>

                                                        </thead>';

														while($row=mysql_fetch_array($r)){

    echo'<tr><td><a rel="facebox" href=payroll_delete.php?idd=' . $row["id"] .'>Delete Vote</a></td><td>' . (($row['name'])) . '</td>
	</tr>';
}
							echo "</table>";
}
function ViewEmployees(){
$r=mysql_query("select * from employee
");
  echo '
     
<table border="1" width="1000" cellspacing="0" class="tables"> 
                                                        <thead>
                                                            <tr>
															<th><left>Flexible  Payroll </th> 
															<th><left>Fixed  Payroll </th> 
															<th><left>Employee Name</th> 
                                                             <th><left>Employee No</th> 
															   <th><left>Phone No</th> 
   <th><left>Id No</th> 
      <th><left>Pin</th> 
	     <th><left>N.S.S.F </th> 
		    <th><left>N.H.I.F </th> 
			   <th><left>Department</th> 
			     <th><left>Position</th> 
			   
                                                            </tr>

                                                        </thead>';

														while($row=mysql_fetch_array($r)){

    echo'<tr><td><a href=adjust_payroll.php?idd=' . $row["employee_id"] .'>Adjust</a></td>
	<td><a rel="facebox" href=adjust_fixed.php?ide=' . $row["employee_id"] .'>Adjust</a></td><td>' . (($row['names'])) . '</td>
	<td>' . (($row['eno'])) . '</td><td>' . (($row['phone'])) . '</td><td>' . (($row['id_no'])) . '</td><td>' . (($row['pin'])) . '</td>
	<td>' . (($row['nssf_no'])) . '</td><td>' . (($row['nhif_no'])) . '</td><td>' . (($row['dep'])) . '</td><td>' . (($row['position'])) . '</td>
	</tr>';
}
							echo "</table>";
}

function PostPayroll($date){
$r=mysql_query("select * from pgroups where id<>1");
echo '
     
<table border="1" width="1000" cellspacing="0" class="tables"> 
                                                        <thead>
                                                            <tr><th><left>Employee</th>';
while($rew=mysql_fetch_array($r)){

echo '<th>'.ucfirst(strtolower($rew['name'])).'</th>';

}															
                                                              
																
                                                                    
                                                           echo'<th><left>Taxable</th><th><left>Deductions</th> <th><left>Month Paye</th><th><left>Net Pay</th> </tr>';

                                                        echo '</thead>';
$l=mysql_query("select * from employee");
while($row=mysql_fetch_array($l)){
$e=$row['employee_id'];
$r=mysql_query("select * from pgroups where id<>1");
echo '<tr><td>'.$row['names'].'</td>';
while($rew=mysql_fetch_array($r)){
$id=$rew['id'];
$status=$rew['status'];

$d=mysql_query("select sum(credit)+sum(debit)as amount from  employee_table where employee_id='$e' and month(date)=month('$date') and group_id='$id'");
$roa=mysql_fetch_array($d);
$amount=$roa['amount'];


echo '<td>'.number_format($amount).'</td>';
$amount+=$amount;
}
$taxable+=GetTaxableP($e,$date);
$deductions+=GetDeductions($e,$date);
$paye+=GetPayeP($e,$date);
$net+=GetNet($e,$date);
echo '<td>'.number_format(GetTaxableP($e,$date)).'</td>';
echo '<td>'.number_format(GetDeductions($e,$date)).'</td>';
echo '<td>'.number_format(GetPayeP($e,$date)).'</td>';
echo '<td>'.number_format(GetNet($e,$date)).'</td>';
echo '</tr>';
}
echo '<tr><td></td><td>'.number_format($amount).'</td><td>'.number_format($taxable).'</td><td>'.number_format($deductions).'</td>
<td>'.number_format($paye).'</td><td>'.number_format($net).'</td></tr>';



}
function ViewAllowance(){
$r=mysql_query("select * from pgroups where group_id='1'
");
  echo '
     
<table border="1" width="500" cellspacing="0" class="tables"> 
                                                        <thead>
                                                            <tr>
															<th><left>Delete Vote</th> 
															<th><left>Vote Name</th> 
                                                             
                                                                    
                                                            </tr>

                                                        </thead>';

														while($row=mysql_fetch_array($r)){

    echo'<tr><td><a  rel="facebox" href=payroll_delete.php?idd=' . $row["id"] .'>Delete Vote</a></td><td>' . (($row['name'])) . '</td>
	</tr>';
}
							echo "</table>";
}

function LPOO($no){
$r=mysql_query("select * from lpo where invoice='$no' order by id");

?>
<table class="blue" border="0" style="background-color:#ffffff"; rules="NONE"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial";>
 <tr> <td>
  <strong><img border="0" src="logo.jpg" width="930" height="121"></td></tr></table> <table class="blue" border="0" style="background-color:#ffffff"; rules="NONE"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="Trebuchet MS";>
 <tr><td style="font-size: 20px">P.O BOX 7109-00300 Nairobi</td><td style="font-size: 20px">TEL: 0723 224 270: 0723 224 270</b></td></tr>
  </table><h4><div align="center">www.stylesandfinishes.co.ke; Email info@stylesandfinishes.co.ke</div></h4>
   <table class="blue" border="1" style="background-color:#ffffff"; rules="NONE"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="Trebuchet MS";>
 <tr><td style="font-size: 20px">TO : <?echo LpS($no);?><b><??></td><td></td></tr>
  <tr><td style="font-size: 20px">LPO DATE  &nbsp;&nbsp;&nbsp;&nbsp; <?echo LDate($no);?></b></td><td style="font-size: 22px">LPO NO: <u><?echo $no;?></u></b></td></tr>
  <tr><td style="font-size: 20px">SUPPLY DATE &nbsp;&nbsp; <?echo SDate($no);?></b></td><td></td></tr></table><br>
  <table class="blue" border="1" style="background-color:#ffffff"; rules="NONE"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial";>

</table>
<table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" style="font-size: 18px" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
 <tr> <td style="font-size: 20px"><b>PRODUCT</b></td><td style="font-size: 20px"><b>QTY:</b></td></tr>
 <?while ($row=mysql_fetch_array($r)){
 echo '<tr><td style="font-size: 18px">'.$row['name'].'</td><td style="font-size: 18px">'.$row['qty'].'</td></tr>';
 $total+=$row['price'];
 }?> 
 

 </table><br>
 <br><br>
			  <div align="center"><b>Issued By....................................................................................Signature............................</div><br><br>
			    <div align="center"><b>Approved By.................................................................................Signature..............................</div><br><br>
				
				<div align="center"><b>Authorised By.................................................................................Signature..............................</div><br><br>
				<div align="center"><b>Stamp</div>
 <?}

function Voucher($date,$no,$amount,$for,$mode,$cheque,$name,$transaction){


?>
				
               <table class="blue" border="0" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="10" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">    
                
                <tr><td style="font-family:Bell Gothic ,Verdana,Arial;font-size: 27px" ><img border="0" src="log.png" width="140" height="61"><b>G.N.T SAVINGS AND CREDIT SOCIETY</td></tr>
                 <tr><td style="font-family:Bell Gothic ,Verdana,Arial;font-size: 22px" ><center>P.O BOX 267,GATUNDU TEL: 0723 224 270: 0717 247 614</center></td></tr></table>
  
  <div align="center"><h4 style="font-family:Bell Gothic,Verdana,Arial";><u>PAYMENT  VOUCHER NO <?echo $no;?></u></h4></div>

<table class="blue" border="3" style="background-color:#ffffff"
       rules="NONE" frame="BOX" width="980" align="center" 
 cellpadding="12" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
  <tr><td style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px">Transaction No</td><td style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px"><?echo $transaction;?></td></tr>
 <tr><td style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px">Payment Date</td><td style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px"><?echo $date;?></td></tr>
 <tr><td style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px">Recipient's Name</td><td style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px"><?echo $name;?></td></tr>
 <tr><td style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px">Being Payment</td><td style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px"><?echo $for;?></td></tr>
 <tr><td style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px">Amount</td><td style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px"><u><b><?echo number_format($amount);?></u></td></tr>
 <tr><td style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px">Mode Of Payment</td><td style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px"><?echo $mode;?></td></tr>
 <tr><td style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px">Cheque No</td><td style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px"><b><u><? echo $cheque;?></u></td></tr></table>
 <table class="blue" border="0" style="background-color:#ffffff"
       rules="NONE" frame="BOX" width="980" align="center" 
 cellpadding="20" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
 <tr><td style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px">Stamp</td><td style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px"> <div align="right">Recipient's Signature.................................................</td></tr>
  <tr><td></td><td style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px"><div align="right">Treasurer's Signature.................................................</td></tr>
   <tr><td></td><td style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px"><div align="right">Chairman's Signature.................................................</td></tr></table>
   <div align="center" style="font-family:Bell Gothic ,Verdana;"><i>"Securing Your Investments"</i></div>
   
   <?}
function incomereceipt($user,$ptype,$amount,$for,$from,$date,$session)
{$users = new Users();
	$r=mysql_query("select * from receipt");
	$row=mysql_fetch_array($r);
	$number=$row['number'];
	$f=mysql_query("update receipt set number=number+1");
	$g=mysql_query("update ledgers set receipt='$number' where session='$session'");
				$id = "javascript:Print('stylized')";
				$mytable = '<body onload="' . $id . '"><div id="stylized">
       <table width="500" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 22px">
               
            
                   
                
                <tr><td ><h3><b><center>PACEMART JUICES & CANDIES</b></h3></td></tr>
				   <tr><td ><h3><b><center>GATUNDU  BRANCH</b></h3></td></tr>
                 <tr><td colspan="2"><center>P.O BOX 267,GATUNDU TEL: 0723 224 270:0717 0247 600</center></td></tr>
                   
                   <tr><td colspan="2"><center>Receipt No:' . $number . '</center></td></tr>
           <tr><td colspan="2"><center>Date:' . (date("Y/m/d")) . '</center></td></tr>
				 <tr><th>
				<hr size="10" noshade>  </th>
				</tr></table>
				            <table width="500" style="font-family:Bell Gothic ,Verdana,Arial;">
                <tr><td style="font-size: 20px">T. code:</td><td style="font-size: 22px">' . gmdate("dmyhisG")  . '</td></tr>
                <tr><td style="font-size: 20px">Payee:</td><td style="font-size: 22px">' . $from . '</td></tr>
                           
                <tr><td style="font-size: 20px">Account:</td><td style="font-size: 22px">' .Acc($for). '</td></tr>
                <tr><td style="font-size: 20px">P.Type:</td><td style="font-size: 22px">' . Acc($ptype) . '</td></tr>
                <tr><td style="font-size: 20px">Amount:</td><td style="font-size: 22px">' . number_format($amount) . '</td></tr>
                <tr><td colspan="2"style="font-size: 19px"><center>You were served by:' . ($users->checkuserlogin($_SESSION['users'])) .
								'</center></td></tr>
        </div></table>            
</div><input type="submit" name="btnPrint" value="print" asp:Button ID="btnPrint" runat="server" onclick="' .
								$id . '"/></body>';
				echo $mytable;
}
function ViewC(){
$r=mysql_query("select * from accounts
inner join  group_accounts on group_accounts.account_id=accounts.id
where group_id='4'
and name<>'STOCK'");
  echo '
     
<table border="1" width="500" cellspacing="0" class="tables"> 
                                                        <thead>
                                                            <tr>
															<th><left>Edit Account</th> 
															<th><left>Account Name</th> 
                                                              <th><left>Phone</th> 
																<th><left>Address</th> 
                                                                	    
                                                            </tr>

                                                        </thead>';

														while($row=mysql_fetch_array($r)){

    echo'<tr><td><a  rel="facebox" href=edit_c.php?id=' . $row["account_id"] .'>Edit Account</a></td><td>' . (($row['name'])) . '</td>
	<td>' . (($row['phone'])) . '</td>
	<td>' . (($row['address'])) . '</td>
	</tr>';
}
							echo "</table>";
}
function ViewCurrent(){
$r=mysql_query("select * from accounts
inner join  group_accounts on group_accounts.account_id=accounts.id
where group_id='4' OR group_id='13'
");
  echo '
     
<table border="1" width="500" cellspacing="0" class="tables"> 
                                                        <thead>
                                                            <tr>
															<th><left>De-Activate Ledger</th> 
															<th><left>Activate Ledger</th> 
															<th><left>Account Name</th> 
                                                              <th><left>Status</th> 
															
                                                                    
                                                            </tr>

                                                        </thead>';

														while($row=mysql_fetch_array($r)){

    echo'<tr><td><a rel="facebox" href=deactivate.php?id=' . $row["account_id"] .'>De-Activate Ledger</a></td>
	<td><a rel="facebox" href=reactivate.php?id=' . $row["account_id"] .'>Activate Ledger</a></td><td>' . (($row['name'])) . '</td>
	<td>' . (($row['status'])) . '</td>
	</tr>';
}
							echo "</table>";
}
function ledgerViewC($id,$date1,$date2){
 $group=GetGroup($id);
 if($group==2){
$r=mysql_query("select *,sum(credit)as 
credit,sum(debit) as debit,concat(receipt,' ',invoice) as receip from ledgers where account_id='$id' and date between '$date1' and '$date2' group by sub order by date");
}else{
$r=mysql_query("select *,sum(credit)as 
credit,sum(debit) as debit,concat(invoice,' ',receipt) as receip from ledgers where account_id='$id' and date between '$date1' and '$date2' group by sub order by date");}

?>          
                
               <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">    
                
                <tr><td style="font-size: 20px" ><center></td></tr>
                 <tr><td style="font-size: 20px" ><center>P.O BOX ,NAIROBI TEL: </center></td></tr></table>

  <div align="center"><h4 style="font-family:Bell Gothic,Verdana,Arial";><?echo Legers($id);?> Ledger Report For Date Between <?echo $date1;?> To <?echo $date2;?> </h2></div>

<table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
 <tr><td><b>DATE</b></td> <td><b>SUB ACCOUNT</b></td> <td><b>ACCOUNT</b></td><td><b>NO</b></td><td><b>DESCRIPTION</b></td><td><b>DEBIT</b></td><td><b>CREDIT:</b></td></tr>
 <?while ($row=mysql_fetch_array($r)){
 echo '<tr><td>'.$row['date'].'</td><td>'.SubName($row['sub']).'</td><td>'.Acc($row['froms']).'</td><td>'.Nosee($row['receip']).'</td><td>'.$row['description'].'</td><td>'.Nosee(number_format($row['debit'])).'</td><td>'.Nosee(number_format($row['credit'])).'</td></tr>';
 $debit+=$row['debit'];
 $credit+=$row['credit'];
 }
 echo '<tr><td colspan="5"><center>SUB TOTAL</td><td><center>'.number_format($debit).'</td><td><center>'.number_format($credit).'</td></tr>';
 $group=GetGroup($id);
 if($group==4||$group==1||$group==7||$group==6||$group==9||$group==10){
 $t=mysql_query("select sum(debit)-sum(credit)as debit from ledgers where account_id='$id' and date between '$date1' and '$date2' ");
 $row=mysql_fetch_array($t);
 $debit=$row['debit'];
 echo '<tr><td colspan="5"><b>Balance</td><td><b>'.number_format($debit).'</td></tr>';
 }
 if($group==3||$group==2||$group==5){
  $t=mysql_query("select sum(credit)-sum(debit)as debit from ledgers where account_id='$id' and date between '$date1' and '$date2' ");
 $row=mysql_fetch_array($t);
 $debit=$row['debit'];
 echo '<tr><td colspan="5"><center><b>Balance</td><td colspan="2"><b><center>'.number_format($debit).'</td></tr>';
 }
 ?> 
 

 </table><br>
 <?}
function Viewincome(){
$r=mysql_query("select * from accounts
inner join  group_accounts on group_accounts.account_id=accounts.id
where group_id='3'
");
  echo '
     
<table border="1" width="500" cellspacing="0" class="tables"> 
                                                        <thead>
                                                            <tr>
															<th><left>De-Activate Ledger</th> 
															<th><left>Activate Ledger</th> 
															<th><left>Account Name</th> 
                                                              <th><left>Status</th> 
															
                                                                    
                                                            </tr>

                                                        </thead>';

														while($row=mysql_fetch_array($r)){

    echo'<tr><td><a rel="facebox" href=deactivate.php?id=' . $row["account_id"] .'>De-Activate Ledger</a></td>
	<td><a rel="facebox" href=reactivate.php?id=' . $row["account_id"] .'>Activate Ledger</a></td><td>' . (($row['name'])) . '</td>
	<td>' . (($row['status'])) . '</td>
	</tr>';
}
							echo "</table>";
}
function ViewExpense(){
$r=mysql_query("select * from accounts
inner join  group_accounts on group_accounts.account_id=accounts.id
where group_id='1'
");
  echo '
     
<table border="1" width="500" cellspacing="0" class="tables"> 
                                                        <thead>
                                                            <tr>
															<th><left>De-Activate Ledger</th> 
															<th><left>Account Name</th> 
                                                              <th><left>Status</th> 
															
                                                                    
                                                            </tr>

                                                        </thead>';

														while($row=mysql_fetch_array($r)){

    echo'<tr><td><a rel="facebox" href=deactivate.php?id=' . $row["account_id"] .'>De-Activate Ledger</a></td>
	<td><a rel="facebox" href=reactivate.php?id=' . $row["account_id"] .'>Activate Ledger</a></td><td>' . (($row['name'])) . '</td>
	<td>' . (($row['status'])) . '</td>
	</tr>';
}
							echo "</table>";
}

function ViewMonetary(){
$r=mysql_query("select * from accounts
inner join  group_accounts on group_accounts.account_id=accounts.id
where group_id='10'
");
  echo '
     
<table border="1" width="500" cellspacing="0" class="tables"> 
                                                        <thead>
                                                            <tr>
															<th><left>De-Activate Ledger</th> 
															<th><left>Activate Ledger</th> 
															<th><left>Account Name</th> 
                                                              <th><left>Account Code</th> 
															
                                                                    
                                                            </tr>

                                                        </thead>';

														while($row=mysql_fetch_array($r)){

    echo'<tr><td><a rel="facebox" href=deactivate.php?id=' . $row["account_id"] .'>De-Activate Ledger</a></td>
	<td><a rel="facebox" href=reactivate.php?id=' . $row["account_id"] .'>Activate Ledger</a></td><td>' . (($row['name'])) . '</td>
	<td>' . (($row['status'])) . '</td>
	</tr>';
}
							echo "</table>";
}
function ReconceReport($bank,$date){
$d=mysql_query("select cash_book.debit,cash_book.date,cash_book.receipt,bank_account.receipt FROM bank_account,cash_book where 
cash_book.type='Bank'
AND cash_book.debit>0
AND cash_book.receipt=bank_account.receipt
and bank_account.account_id='$bank'
and cash_book.account_id='$bank'");

$q=mysql_query("select cash_book.credit,cash_book.date,cash_book.receipt,bank_account.receipt FROM bank_account, cash_book where cash_book.type='Bank Book'
AND cash_book.receipt=bank_statement.receipt
AND cash_book.credit>0
and bank_statement.account_id='$bank'
and cash_book.account_id='$bank
");

 
$e=mysql_query("SELECT cash_book.date, cash_book.credit, bank_statement.credit,cash_book.receipt
FROM bank_statement, cash_book
WHERE cash_book.credit = bank_statement.credit
AND bank_statement.credit >0

and bank_statement.t_date='$date'
AND cash_book.receipt=bank_statement.receipt
AND cash_book.type='Cash Book'
and bank_statement.account_id='$bank'
and cash_book.account_id='$bank'");

$v=mysql_query("SELECT cash_book.date, cash_book.debit, bank_statement.debit,cash_book.receipt
FROM bank_statement, cash_book
WHERE cash_book.debit = bank_statement.debit
AND bank_statement.debit >0

and bank_statement.t_date='$date'
AND cash_book.receipt=bank_statement.receipt
AND cash_book.type='Cash Book'
and bank_statement.account_id='$bank'
and cash_book.account_id='$bank'");

$g=mysql_query("SELECT bank_account.date,bank_account.credit, bank_statement.credit,bank_account.receipt
FROM bank_statement, bank_account
WHERE bank_account.credit = bank_statement.credit
AND bank_statement.credit >0
and bank_account.t_date='$date'
and bank_statement.t_date='$date'
AND bank_account.receipt=bank_statement.receipt
and bank_statement.account_id='$bank'
and bank_account.account_id='$bank");


$b=mysql_query("select sum(debit),sum(credit),sum(debit)-sum(credit) As balance FROM bank_book");

$l=mysql_query("select sum(debit),sum(credit),sum(debit)-sum(credit)As balance FROM cash_book
WHERE type='cash book'
and account_id='$bank'");

$row=mysql_fetch_array($l);
  $balance=$row[2];
  
  $k=mysql_query("select sum(debit),sum(credit),sum(debit)-sum(credit) As balance From bank_account
   where account_id='$bank'");
$row=mysql_fetch_array($k);

  $balance_bank=$row[2];
  
   $b=mysql_query("select sum(debit),sum(credit),sum(debit)-sum(credit) As balance From cash_book
    where account_id='$bank'");
 $row=mysql_fetch_array($b);
  $total=$row[2];
   $mn=mysql_query("SELECT sum(credit) from bank_statement where t_date='$date'
   and account_id='$bank'
AND type='Cash Book'");

  while ($row =mysql_fetch_array($mn))
  {
  $credit=$row[0];
  }
  $kl=mysql_query("SELECT sum(debit) from bank_statement where t_date='$date'
   and account_id='$bank'
AND type='Cash Book'");
$row=mysql_fetch_array($kl);

  $debit=$row[0];
  
  $revised=$debit-$credit;
  $balanced=$total-$revised; 
  
  echo '
     
<table border="1" width="500" cellspacing="0" class="tables"> 
                                                        <thead><tr><th colspan="3"><left>Balance At Bank As Per Cash Book '.number_format($balance).'</th> 
                                                              
														
                                                            </tr>
															<tr><th colspan="3"><left>Reciepts Not Present In The Cash book</th> 
                                                              
														
                                                            </tr>
                                                            <tr><th><left>Transaction Number</th> 
                                                              
															<th><left>Date</th> 	
  															<th><left>Amount</th> 
                                                            </tr>

                                                        </thead>';
					

$bg = '#eeeeee';
 while ($row = mysql_fetch_array($d)) {
 $bg = ($bg=='#ffffff' ? '#ffffff' :
'#ffffff');
 echo '<tr bgcolor="' . $bg . '">
 <td align="left">' . $row['receipt']. '</td>
 <td align="left">'. $row['date'].'</td>
 <td align="left">'. number_format($row['debit']).'</td>

 </tr>
 
 ';
 }
  echo '<tr bgcolor="' . $bg . '">
 <td colspan="3"><center>Balance at Bank as Per Cash Book After Adjustments '.number_format($total).'</td>


 </tr>';
  echo '</table>';
    
 echo '
     
<table border="1" width="500" cellspacing="0" class="tables"> 
                                                        <thead> <tr><th colspan="3"><left>Payments Not Present In Bank Statement</th> 
                                                              
														
                                                            </tr>
                                                            <tr><th><left>Transaction Number</th> 
                                                              
															<th><left>Date</th> 	
  															<th><left>Amount</th> 
                                                            </tr>

                                                        </thead>';
														$bg = '#eeeeee';
 while ($row = mysql_fetch_array($e)) {
 $bg = ($bg=='#ffffff' ? '#ffffff' :
'#ffffff');
 echo '<tr bgcolor="' . $bg . '">
 <td align="left">' . $row['receipt']. '</td>
 <td align="left">'. $row['date'].'</td>
 <td align="left">'. number_format($row['credit']).'</td>

 </tr>
 ';
  echo '</table>';
 }
  echo '
     
<table border="1" width="500" cellspacing="0" class="tables"> 
                                                        <thead> <tr><th colspan="3"><left>Cheques Not Presented In the Bank</th> 
                                                              
														
                                                            </tr>
                                                            <tr><th><left>Transaction Number</th> 
                                                              
															<th><left>Date</th> 	
  															<th><left>Amount</th> 
                                                            </tr>

                                                        </thead>';
														$bg = '#eeeeee';
 while ($row = mysql_fetch_array($v)) {
 $bg = ($bg=='#ffffff' ? '#ffffff' :
'#ffffff');
 echo '<tr bgcolor="' . $bg . '">
 <td align="left">' . $row['receipt']. '</td>
 <td align="left">'. $row['date'].'</td>
 <td align="left">'. number_format($row['debit']).'</td>

 </tr>
 ';
  echo '<tr bgcolor="' . $bg . '">
 <td colspan="3"><center>Balance At Bank As Per Balance Statement '.number_format($balanced).'</td>


 </tr>';
  echo '</table>';
 }
}
function ActiveBank($session){
$r=mysql_query("select *,sum(debit)as debit,sum(credit)as credit from cash_book where account_id='$session' and status='Active'
group by receipt");
  echo '
     
<table border="1" width="500" cellspacing="0" class="tables"> 
                                                        <thead>
                                                            <tr><th><left>Date</th> 
                                                              <th><left>Transaction No</th> 
																<th><left>Payments</th> 
																<th><left>Receipts</th> 
                                                                    
                                                            </tr>

                                                        </thead>';

														while($row=mysql_fetch_array($r)){

    echo'<tr><td>' . (($row['date'])) . '</td>
	<td>' . (($row['receipt'])) . '</td>
	<td>' . (number_format($row['credit'])) . '</td>
	<td>' . (number_format($row['debit'])) . '</td></tr>';
}
							echo "</table>";
}
function ViewBankR($session){
$r=mysql_query("select * from bank_account where session='$session'");
  echo '
     
<table border="1" width="500" cellspacing="0" class="tables"> 
                                                        <thead>
                                                            <tr><th><left>Date</th> 
                                                              <th><left>Transaction No</th> 
																<th><left>Payments</th> 
																<th><left>Receipts</th> 
                                                                    
                                                            </tr>

                                                        </thead>';

														while($row=mysql_fetch_array($r)){

    echo'<tr><td>' . (($row['date'])) . '</td>
	<td>' . (($row['receipt'])) . '</td>
	<td>' . (number_format($row['credit'])) . '</td>
	<td>' . (number_format($row['debit'])) . '</td></tr>';
}
							echo "</table>";
}
function  ViewStatutory(){
$r=mysql_query("select * from accounts
inner join  group_accounts on group_accounts.account_id=accounts.id
where group_id='11'
");
  echo '
     
<table border="1" width="500" cellspacing="0" class="tables"> 
                                                        <thead>
                                                            <tr>
															<th><left>Delete Account</th> 
															<th><left>Account Name</th> 
                                                              <th><left>Account Code</th> 
															
                                                                    
                                                            </tr>

                                                        </thead>';

														while($row=mysql_fetch_array($r)){

    echo'<tr><td><a rel="facebox" href=delete_a.php?id=' . $row["account_id"] .'>Delete Account</a></td><td>' . (($row['name'])) . '</td>
	<td>' . (($row['code'])) . '</td>
	</tr>';
}
							echo "</table>";
}
function ViewLiability(){
$r=mysql_query("select * from accounts
inner join  group_accounts on group_accounts.account_id=accounts.id
where group_id='2'
");
  echo '
     
<table border="1" width="500" cellspacing="0" class="tables"> 
                                                        <thead>
                                                            <tr>
															<th><left>De-Activate Ledger</th> 
															<th><left>Activate Ledger</th> 
															<th><left>Account Name</th> 
                                                              <th><left>Status</th> 
															
                                                                    
                                                            </tr>

                                                        </thead>';

														while($row=mysql_fetch_array($r)){

    echo'<tr><td><a rel="facebox" href=deactivate.php?id=' . $row["account_id"] .'>De-Activate Ledger</a></td>
	<td><a rel="facebox" href=reactivate.php?id=' . $row["account_id"] .'>Activate Ledger</a></td><td>' . (($row['name'])) . '</td>
	<td>' . (($row['status'])) . '</td>
	</tr>';
}
							echo "</table>";
}
function ViewCapital(){
$r=mysql_query("select * from accounts
inner join  group_accounts on group_accounts.account_id=accounts.id
where group_id='5'
");
  echo '
     
<table border="1" width="500" cellspacing="0" class="tables"> 
                                                        <thead>
                                                            <tr>
															<th><left>De-Activate Ledger</th> 
															<th><left>Activate Ledger</th> 
															<th><left>Account Name</th> 
                                                              <th><left>Status</th> 
															
                                                                    
                                                            </tr>

                                                        </thead>';

														while($row=mysql_fetch_array($r)){

    echo'<tr><td><a rel="facebox" href=deactivate.php?id=' . $row["account_id"] .'>De-Activate Ledger</a></td>
	<td><a rel="facebox" href=reactivate.php?id=' . $row["account_id"] .'>Activate Ledger</a></td><td>' . (($row['name'])) . '</td>
	<td>' . (($row['status'])) . '</td>
	</tr>';
}
							echo "</table>";
}

 function ledgerView($id,$date1,$date2){
 $group=GetGroup($id);
 if($group==2){
$r=mysql_query("select *,sum(credit)as 
credit,sum(debit) as debit,concat(receipt,' ',invoice) as receip from ledgers where account_id='$id'
 and date between '$date1' and '$date2' group by id order by date");
}else{
$r=mysql_query("select *,sum(credit)as 
credit,sum(debit) as debit,concat(invoice,' ',receipt) as receip from ledgers where account_id='$id'
 and date between '$date1' and '$date2' group by id order by date");}
 $opening=LedgerBalance($id,$date1);
?>          
         <a href="javascript:void(processPrint());"><input type="image" width="30" height="21" value=<img src="print.png"/></a></div><center>
<div id="printMe">       
               <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="1050" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">    
                
                <tr><td style="font-size: 20px" ><center></td></tr>
                 <tr><td style="font-size: 20px" ><center>P.O BOX ,NAIROBI TEL:</center></td></tr></table>

  <div align="center"><h4 style="font-family:Bell Gothic,Verdana,Arial";><?echo Legers($id);?> Ledger Report For Date Between <?echo $date1;?> To <?echo $date2;?> </h2></div>

<table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="1050" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial"> <tr><td  colspan="6"><b><center>LEDGER OPENING BALANCE</td><td ><b><?echo number_format($opening);?></b></td></tr>
 
 <tr><td><b>DATE</b></td>  <td><b>ACCOUNT</b></td><td><b>NO</b></td><td><b>DESCRIPTION</b></td><td><b>DEBIT</b></td><td><b>CREDIT</b></td><td><b>CLOSING</b></td></tr>

 <?
 

 $group=GetGroup($id);
 while ($row=mysql_fetch_array($r)){
   if($group==4||$group==1||$group==7||$group==6||$group==9||$group==10){
 $opening=$opening+$row['debit']-$row['credit'];
 $closing=$opening;
 }
  if($group==3||$group==2||$group==5||$group==14){
 $opening=$opening+$row['credit']-$row['debit'];
  $closing=$opening;
 }
 echo '<tr><td>'.$row['date'].'</td><td>'.Acc($row['froms']).'</td>
 <td>'.Nosee($row['receip']).'</td><td>'.$row['description'].'</td><td>'.Nosee(number_format($row['debit'])).'</td>
 <td>'.Nosee(number_format($row['credit'])).'</td><td><b>'.(number_format($opening)).'</b></td></tr>';

 $debit+=$row['debit'];
 $credit+=$row['credit'];
 }



 ?> 
 

 </table><br>
 <?}
 function SubledgerView($id,$date1,$date2,$sub){
$r=mysql_query("select * from ledgers where account_id='$id' and sub='$sub' and date between '$date1' and '$date2' group by session order by date");

?>          
                
               <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">    
                
                <tr><td style="font-size: 20px" ><center>PACEMART JUICES & CANDIES</td></tr>
                 <tr><td style="font-size: 20px" ><center>P.O BOX 71305-00622,NAIROBI TEL: 0723 224 270</center></td></tr></table>

  <div align="center"><h4 style="font-family:Bell Gothic,Verdana,Arial";><?echo SubName($sub);?> Sub Ledger Report For Date Between <?echo $date1;?> To <?echo $date2;?> </h2></div>

<table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
 <tr><td><b>DATE</b></td> <td><b>ACCOUNT</b></td><td><b>NO</b></td><td><b>DESCRIPTION</b></td><td><b>DEBIT</b></td><td><b>CREDIT:</b></td></tr>
 <?while ($row=mysql_fetch_array($r)){
 echo '<tr><td>'.$row['date'].'</td><td>'.Acc($row['froms']).'</td><td>'.Nosee($row['receipt']).'</td><td>'.$row['description'].'</td><td>'.Nosee(number_format($row['debit'])).'</td><td>'.(number_format($row['credit'])).'</td></tr>';
 $debit+=$row['debit'];
 $credit+=$row['credit'];
 }
 echo '<tr><td colspan="5"><center>SUB TOTAL</td><td><center>'.number_format($debit).'</td><td><center>'.number_format($credit).'</td></tr>';
 $group=GetGroup($id);
 if($group==4||$group==1||$group==7||$group==6||$group==9||$group==10){
 $t=mysql_query("select sum(debit)-sum(credit)as debit from ledgers where account_id='$id' and sub='$sub' and date between '$date1' and '$date2' ");
 $row=mysql_fetch_array($t);
 $debit=$row['debit'];
 echo '<tr><td colspan="5"><center><b>Balance</td><td colspan="2"><center><b>'.number_format($debit).'</td></tr>';
 }
 if($group==3||$group==2||$group==5){
  $t=mysql_query("select sum(credit)-sum(debit)as debit from ledgers where  account_id='$id' and sub='$sub' and date between '$date1' and '$date2' ");
 $row=mysql_fetch_array($t);
 $debit=$row['debit'];
 echo '<tr><td colspan="5"><center><b>Balance</td><td colspan="2"><center><b>'.number_format($debit).'</td></tr>';
 }
 ?> 
 

 </table><br>
 <?}
 function GeneralLedger($date1,$date2){
	 $group=GetGroup($id); 
$r=mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='1'");
while($ex=mysql_fetch_array($r)){
$id=$ex['account_id'];
 $opening=LedgerBalance1($id,$date1,$date2);
?>
<div align="center"><h4 style="font-family:Bell Gothic,Verdana,Arial";><?echo Legers($id);?> Ledger  </h2></div>

<table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>DATE</b></td> <td><b>ACCOUNT</b></td><td><b>NO</b></td><td><b>DESCRIPTION</b></td><td><b>DEBIT</b></td><td><b>CREDIT:</b></td><td><b>Closing</b></td></tr>
<?
 $group=GetGroup($id);
$ro=mysql_query("select * from ledgers where account_id='$id' and date between '$date1' and '$date2' order by date");
$d=0;
$c=0;
while($row=mysql_fetch_array($ro)){
	if($group==3||$group==2||$group==5||$group==14){
 $opening=$opening+$row['credit']-$row['debit'];
  $closing=$opening;
 }

echo '<tr><td>'.$row['date'].'</td><td>'.Acc($row['froms']).'</td><td>'.($row['receipt']).'</td><td>'.$row['description'].'</td><td>'.Nosee(number_format($row['debit'])).'</td><td>'.(number_format($row['credit'])).'</td><td>'.(number_format($opening)).'</td></tr>';
 $d+=$row['debit'];
 $c+=$row['credit'];
 }
 echo '<tr><td colspan="4"><center>SUB TOTAL</td><td><center>'.number_format($d).'</td><td><center>'.number_format($c).'</td></tr>';
 $group=GetGroup($id);

 $t=mysql_query("select sum(debit)-sum(credit)as debit from ledgers where account_id='$id' and date between '$date1' and '$date2' ");
 $row=mysql_fetch_array($t);
 $expe=$row['debit'];
 echo '<tr><td colspan="4"><b>Balance</td><td><b>'.number_format($expe).'</td></tr></table><br>';
 

}
$r=mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='2'");
while($ex=mysql_fetch_array($r)){
$id=$ex['account_id'];

?>
<br><br>
<div align="center"><h4 style="font-family:Bell Gothic,Verdana,Arial";><?echo Legers($id);?> Ledger  </h2></div>

<table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>DATE</b></td> <td><b>ACCOUNT</b></td><td><b>NO</b></td><td><b>DESCRIPTION</b></td><td><b>Product</b></td><td><b>Quantity</b></td><td><b>DEBIT</b></td><td><b>CREDIT:</b><td><b>ClOSING</b></td></td></tr>
<?
$re=mysql_query("select sum(credit)-sum(debit)as balance from ledgers where account_id='$id' and date <'$date1'");
$rw=mysql_fetch_array($re);
$bal=$rw['balance'];
$ro=mysql_query("select * from ledgers where account_id='$id' and date between '$date1' and '$date2' order by date");
$dei=0;
$cr=0;
while($row=mysql_fetch_array($ro)){
$closing=$bal+$row['credit']-$row['debit'];
echo '<tr><td>'.$row['date'].'</td><td>'.Acc($row['froms']).'</td><td>'.($row['receipt']).'</td><td>'.$row['description'].'</td><td>'.$row['product'].'</td><td>'.$row['quantity'].'</td><td>'.Nosee(number_format($row['debit'])).'</td><td>'.(number_format($row['credit'])).'</td><td>'.(number_format($closing)).'</td></tr>';
 $dei+=$row['debit'];
 $cr+=$row['credit'];
 }
 echo '<tr><td colspan="4"><td><td><center>SUB TOTAL</td><td><center>'.number_format($dei).'</td><td><center>'.number_format($cr).'</td></tr>';
 $group=GetGroup($id);

  $t=mysql_query("select sum(credit)-sum(debit)as debit from ledgers where account_id='$id' and date between '$date1' and '$date2' ");
 $row=mysql_fetch_array($t);
 $liab=$row['debit'];
 echo '<tr><td colspan="4"><center><td><td><td><b>Balance</td><td><b>'.number_format($liab).'</td></tr></table><br>';
 
}
$r=mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='3'");
while($ex=mysql_fetch_array($r)){
$id=$ex['account_id'];

?>
<br><br>
<div align="center"><h4 style="font-family:Bell Gothic,Verdana,Arial";><?echo Legers($id);?> Ledger  </h2></div>

<table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>DATE</b></td> <td><b>ACCOUNT</b></td><td><b>NO</b></td><td><b>DESCRIPTION</b></td><td><b>DEBIT</b></td><td><b>CREDIT:</b></td></tr>
<?
$ro=mysql_query("select * from ledgers where account_id='$id' and date between '$date1' and '$date2' order by date");
$deb=0;
$cre=0;
while($row=mysql_fetch_array($ro)){

echo '<tr><td>'.$row['date'].'</td><td>'.Acc($row['froms']).'</td><td>'.($row['receipt']).'</td><td>'.$row['description'].'</td><td>'.Nosee(number_format($row['debit'])).'</td><td>'.(number_format($row['credit'])).'</td></tr>';
 $deb+=$row['debit'];
 $cre+=$row['credit'];
 }
 echo '<tr><td colspan="4"><center>SUB TOTAL</td><td><center>'.number_format($deb).'</td><td><center>'.number_format($cre).'</td></tr>';
 $group=GetGroup($id);

 
  $t=mysql_query("select sum(credit)-sum(debit)as debit from ledgers where account_id='$id' and date between '$date1' and '$date2' ");
 $row=mysql_fetch_array($t);
 $inc=$row['debit'];
 echo '<tr><td colspan="4"><center><b>Balance</td><td><b>'.number_format($inc).'</td></tr></table><br>';
 
}
$r=mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='4'");
while($ex=mysql_fetch_array($r)){
$id=$ex['account_id'];

?>
<br><br>
<div align="center"><h4 style="font-family:Bell Gothic,Verdana,Arial";><?echo Legers($id);?> Ledger  </h2></div>

<table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>DATE</b></td> <td><b>ACCOUNT</b></td><td><b>NO</b></td><td><b>DESCRIPTION</b></td><td><b>DEBIT</b></td><td><b>CREDIT:</b></td></tr>
<?

$ro=mysql_query("select * from ledgers where account_id='$id' and date between '$date1' and '$date2' order by date");
$debi=0;
$cred=0;
while($row=mysql_fetch_array($ro)){

echo '<tr><td>'.$row['date'].'</td><td>'.Acc($row['froms']).'</td><td>'.($row['receipt']).'</td><td>'.$row['description'].'</td><td>'.Nosee(number_format($row['debit'])).'</td><td>'.(number_format($row['credit'])).'</td></tr>';
 $debi+=$row['debit'];
 $cred+=$row['credit'];
 }
 echo '<tr><td colspan="4"><center>SUB TOTAL</td><td><center>'.number_format($debi).'</td><td><center>'.number_format($cred).'</td></tr>';
 $group=GetGroup($id);

 $t=mysql_query("select sum(debit)-sum(credit)as debit from ledgers where account_id='$id' and date between '$date1' and '$date2' ");
 $row=mysql_fetch_array($t);
 $cur=$row['debit'];
 echo '<tr><td colspan="4"><b>Balance</td><td><b>'.number_format($cur).'</td></tr></table><br>';

}
$r=mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='10'");
while($ex=mysql_fetch_array($r)){
$id=$ex['account_id'];

?>
<br><br>
<div align="center"><h4 style="font-family:Bell Gothic,Verdana,Arial";><?echo Legers($id);?> Ledger  </h2></div>

<table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>DATE</b></td> <td><b>ACCOUNT</b></td><td><b>NO</b></td><td><b>DESCRIPTION</b></td><td><b>DEBIT</b></td><td><b>CREDIT:</b></td></tr>
<?

$ro=mysql_query("select * from ledgers where account_id='$id' and date between '$date1' and '$date2' order by date");
$debi=0;
$cred=0;
while($row=mysql_fetch_array($ro)){

echo '<tr><td>'.$row['date'].'</td><td>'.Acc($row['froms']).'</td><td>'.($row['receipt']).'</td><td>'.$row['description'].'</td><td>'.Nosee(number_format($row['debit'])).'</td><td>'.(number_format($row['credit'])).'</td></tr>';
 $debi+=$row['debit'];
 $cred+=$row['credit'];
 }
 echo '<tr><td colspan="4"><center>SUB TOTAL</td><td><center>'.number_format($debi).'</td><td><center>'.number_format($cred).'</td></tr>';
 $group=GetGroup($id);

 $t=mysql_query("select sum(debit)-sum(credit)as debit from ledgers where account_id='$id' and date between '$date1' and '$date2' ");
 $row=mysql_fetch_array($t);
 $cur=$row['debit'];
 echo '<tr><td colspan="4"><b>Balance</td><td><b>'.number_format($cur).'</td></tr></table><br>';

}
$r=mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='5'");
while($ex=mysql_fetch_array($r)){
$id=$ex['account_id'];

?>
<br><br>
<div align="center"><h4 style="font-family:Bell Gothic,Verdana,Arial";><?echo Legers($id);?> Ledger  </h2></div>

<table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>DATE</b></td> <td><b>ACCOUNT</b></td><td><b>NO</b></td><td><b>DESCRIPTION</b></td><td><b>DEBIT</b></td><td><b>CREDIT:</b></td></tr>
<?
$ro=mysql_query("select * from ledgers where account_id='$id' and date between '$date1' and '$date2' order by date");
$debit=0;
$cred=0;
while($row=mysql_fetch_array($ro)){

echo '<tr><td>'.$row['date'].'</td><td>'.Acc($row['froms']).'</td><td>'.($row['receipt']).'</td><td>'.$row['description'].'</td><td>'.Nosee(number_format($row['debit'])).'</td><td>'.(number_format($row['credit'])).'</td></tr>';
 $debit+=$row['debit'];
 $credi+=$row['credit'];
 }
 echo '<tr><td colspan="4"><center>SUB TOTAL</td><td><center>'.number_format($debit).'</td><td><center>'.number_format($credi).'</td></tr>';
 $group=GetGroup($id);
 
  $t=mysql_query("select sum(credit)-sum(debit)as debit from ledgers where account_id='$id' and date between '$date1' and '$date2' ");
 $row=mysql_fetch_array($t);
 $cap=$row['debit'];
 echo '<tr><td colspan="4"><center><b>Balance</td><td><b>'.number_format($cap).'</td></tr></table><br>';
 
}
$r=mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='7'");
while($ex=mysql_fetch_array($r)){
$id=$ex['account_id'];

?>
<br><br>
<div align="center"><h4 style="font-family:Bell Gothic,Verdana,Arial";><?echo Legers($id);?> Ledger  </h2></div>

<table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>DATE</b></td> <td><b>ACCOUNT</b></td><td><b>NO</b></td><td><b>DESCRIPTION</b></td><td><b>DEBIT</b></td><td><b>CREDIT:</b></td></tr>
<?
$ro=mysql_query("select * from ledgers where account_id='$id' and date between '$date1' and '$date2' order by date");
$debitt=0;
$credit=0;
while($row=mysql_fetch_array($ro)){

echo '<tr><td>'.$row['date'].'</td><td>'.Acc($row['froms']).'</td><td>'.($row['receipt']).'</td><td>'.$row['description'].'</td><td>'.Nosee(number_format($row['debit'])).'</td><td>'.(number_format($row['credit'])).'</td></tr>';
 $debitt+=$row['debit'];
 $credit+=$row['credit'];
 }
 echo '<tr><td colspan="4"><center>SUB TOTAL</td><td><center>'.number_format($debitt).'</td><td><center>'.number_format($credit).'</td></tr>';
 $group=GetGroup($id);

 $t=mysql_query("select sum(debit)-sum(credit)as debit from ledgers where account_id='$id' and date between '$date1' and '$date2' ");
 $row=mysql_fetch_array($t);
 $dire=$row['debit'];
 echo '<tr><td colspan="4"><b>Balance</td><td><b>'.number_format($dire).'</td></tr></table><br>';
 

}

$r=mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='8'");
while($ex=mysql_fetch_array($r)){
$id=$ex['account_id'];

?>
<br><br>
<div align="center"><h4 style="font-family:Bell Gothic,Verdana,Arial";><?echo Legers($id);?> Ledger  </h2></div>

<table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>DATE</b></td> <td><b>ACCOUNT</b></td><td><b>NO</b></td><td><b>DESCRIPTION</b></td><td><b>DEBIT</b></td><td><b>CREDIT:</b></td></tr>
<?
$debittt=0;
$creditt=0;
$ro=mysql_query("select * from ledgers where account_id='$id' and date between '$date1' and '$date2' order by date");
while($row=mysql_fetch_array($ro)){

echo '<tr><td>'.$row['date'].'</td><td>'.Acc($row['froms']).'</td><td>'.($row['receipt']).'</td><td>'.$row['description'].'</td><td>'.Nosee(number_format($row['debit'])).'</td><td>'.(number_format($row['credit'])).'</td></tr>';
 $debittt+=$row['debit'];
 $creditt+=$row['credit'];
 }
 echo '<tr><td colspan="4"><center>SUB TOTAL</td><td><center>'.number_format($debittt).'</td><td><center>'.number_format($creditt).'</td></tr>';
 $group=GetGroup($id);

 $t=mysql_query("select sum(debit)-sum(credit)as debit from ledgers where account_id='$id' and date between '$date1' and '$date2' ");
 $row=mysql_fetch_array($t);
 $liab=$row['debit'];
 echo '<tr><td colspan="4"><b>Balance</td><td><b>'.number_format($liab).'</td></tr></table><br>';
 

}
}
function Profit($date1,$date2){
 ?> 
 
           <table class="blue" border="1" style="background-color:#ffffff"; rules="NONE"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial";>
 <tr> <td>
  <strong><img border="0" src="logo.jpg" width="930" height="121"></td></tr></table> 
                
               <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">    
                
                <tr><td style="font-size: 20px" ><center></td></tr>
                 <tr><td style="font-size: 20px" ><center></center></td></tr></table>

  
  <div align="center"><h4 style="font-family:Bell Gothic,Verdana,Arial";>Profit Statement For Date Between <?echo $date1;?> To <?echo $date2;?> </h4></div>

<table class="blue" border="1" style="background-color:#ffffff"
       rules="NONE" frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial"><?

  echo '<tr><td><b>INCOME</td> <td></td></tr>';
 $h=mysql_query("select  sum(credit)as credit,ledgers.account_id as account_id from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='3'

and ledgers.date between '$date1' and '$date2'
and description<>'P & L'
group by ledgers.account_id
having credit>0
");

while($row=mysql_fetch_array($h)){
echo '<tr><td>'.Legers($row['account_id']).'</td> <td>'.number_format($row['credit']).'</td></tr>';
$income+=$row['credit'];
 }
 


  echo '<tr><td><b>TOTAL INCOME</td> <td><u><b>'.number_format($income).'</td></tr>';
 echo '<tr><td colspan="2"><b>DIRECT COST</td> </tr>';
  $c=mysql_query("select  sum(debit)as credit,ledgers.account_id as account_id   from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='7'
and description<>'P & L'
and ledgers.date between '$date1' and '$date2'
group by ledgers.account_id
having credit>0
");
while($row=mysql_fetch_array($c)){
echo '<tr><td>'.Legers($row['account_id'],$row['department']).'</td> <td>'.number_format($row['credit']).'</td></tr>';
$cost+=$row['credit'];
 }
 echo '<tr><td><b>TOTAL COST</td> <td><u><b>'.number_format($cost).'</td></tr>';
 echo '<tr><td><b>GROSS PROFIT</td> <td><b><u>'.number_format($income-$cost).'</td></tr>';
  echo '<tr><td colspan="2"><b>EXPENSES</td> </tr>';
  $co=mysql_query("select  sum(debit)-sum(credit)as credit,ledgers.account_id as account_id   from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='1' 
and description<>'P & L'
and ledgers.date between '$date1' and '$date2'

group by ledgers.account_id
having credit>0

");
while($row=mysql_fetch_array($co)){
echo '<tr><td>'.Legers($row['account_id'],$row['department']).'</td> <td>'.number_format($row['credit']).'</td></tr>';
$expenses+=$row['credit'];
 }

  echo '<tr><td><b>TOTAL EXPENSES</td> <td><u><b>'.number_format($expenses+$dep).'</td></tr>';
  echo '<tr><td><b>PROFIT FOR PERIOD</td> <td><u><b><u>'.number_format(($income-$cost)-($expenses+$dep)).'</td></tr></table><br>';
 }
 function BalanceS($date){
 //$r=mysql_query("select * from financial_year where status='ACTIVE' order by id desc limit 1");
 //$row
 
 ?>     <table class="blue" border="1" style="background-color:#ffffff"; rules="NONE"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial";>
 <tr> <td>
  <strong><img border="0" src="logo.jpg" width="930" height="121"></td></tr></table> 
               <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">    
                
                <tr><td style="font-size: 20px" ><center>PACEMART JUICES & CANDIES</td></tr>
                 <tr><td style="font-size: 20px" ><center>P.O BOX 71305-00622,NAIROBI TEL: 0723 224 270</center></td></tr></table>
  
  <div align="center"><h4 style="font-family:Bell Gothic,Verdana,Arial";>Balance Sheet Statement As Of Date  <?echo $date;?> </h4></div>

<table class="blue" border="1" style="background-color:#ffffff"
       rules="NONE" frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial"><?
   $he=mysql_query("select  sum(credit)-SUM(debit)as credit,ledgers.account_id as account_id  from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='3'
and date<='$date' 

group by ledgers.account_id
");

while($row=mysql_fetch_array($he)){

$incom+=$row['credit'];
 }
   $ce=mysql_query("select  sum(debit)-sum(credit)as credit,ledgers.account_id as account_id   from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='7'
and date<='$date' 

group by ledgers.account_id

");
while($row=mysql_fetch_array($ce)){

$cost+=$row['credit'];
 }
   $c=mysql_query("select  sum(debit)-sum(credit)as credit,ledgers.account_id as account_id   from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id ='1'
and date<='$date' 

group by ledgers.account_id
having credit>0
");
while($row=mysql_fetch_array($c)){

$expenses+=$row['credit'];
 }
    $ce=mysql_query("select  sum(credit)-sum(debit)as credit,ledgers.account_id as account_id   from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id ='14'

and date<='$date' 
group by ledgers.account_id

");
while($row=mysql_fetch_array($ce)){

 $equity+=$row['credit'];
 }
   $over=mysql_query("select  sum(debit)-sum(credit)as credit,ledgers.account_id as account_id   from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='2'
and date<='$date' 

group by ledgers.account_id
having credit>0

");
while($row=mysql_fetch_array($over)){

$pexpenses+=$row['credit'];
 }
 $retained=$equity+($incom-($cost+$expenses));

  echo '<tr><td><b>CAPITAL EMPLOYED</td> <td></td></tr>';
 $h=mysql_query("select  sum(credit)-sum(debit) as credit,ledgers.account_id as account_id  from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='5'
and date<='$date' 

group by ledgers.account_id
");

while($row=mysql_fetch_array($h)){
echo '<tr><td>'.Legers($row['account_id']).'</td> <td>'.number_format($row['credit']).'</td></tr>';
$income+=$row['credit'];
 }


 echo '<tr><td>RETAINED EARNINGS</td> <td><u><b>'.number_format($retained-$dep).'</td></tr>';


  echo '<tr><td><b>TOTAL SHAREHOLDERS FUND</td> <td><u><b>'.number_format($income+$retained-$dep).'</td></tr>';
 echo '<tr><td colspan="2"><b>LONG TERM LIABLITIES</td> </tr>';
  $c=mysql_query("select  sum(credit)-sum(debit)as credit,ledgers.account_id as account_id   from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='8'
and date<='$date' 
group by ledgers.account_id
");
while($row=mysql_fetch_array($c)){
echo '<tr><td>'.Legers($row['account_id']).'</td> <td>'.number_format($row['credit']).'</td></tr>';
$coste+=$row['credit'];
 }
 echo '<tr><td><b></td> <td><u><b>'.number_format($coste).'</td></tr>';
 echo '<tr><td><b></td> <td><b><u>'.number_format($income+$coste+$retained-$dep).'</td></tr>';
  echo '<tr><td colspan="2"><b>REPRESENTED BY</td> </tr>';
  echo '<tr><td colspan="2"><b>NON CURRENT ASSETS</td> </tr>';
  $c=mysql_query("select *,SUM(debit)-sum(credit) as credit from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
inner join accounts on accounts.id=ledgers.account_id
where group_id='6'
and date<='$date' 
group by ledgers.account_id
");
while($row=mysql_fetch_array($c)){
echo '<tr><td>'.Legers($row['account_id']).'</td> <td>'.number_format($row['credit']).'</td></tr>';
$fixedd+=$row['credit'];
 }
  echo '<tr><td><b></td> <td><u><b>'.number_format($fixedd).'</td></tr>';
    echo '<tr><td colspan="2"><b>CURRENT ASSETS</td> </tr>';
  $c=mysql_query("select  sum(debit)-sum(credit)as credit,ledgers.account_id as account_id   from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='4' 
and date<='$date' 

group by ledgers.account_id

");
while($row=mysql_fetch_array($c)){if($row['credit']!=0.00){
echo '<tr><td>'.Legers($row['account_id']).'</td> <td>'.number_format($row['credit']).'</td></tr>';}
$current+=$row['credit'];
 }
   $c=mysql_query("select  sum(debit)-sum(credit)as credit,ledgers.account_id as account_id   from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='10' 
and date<='$date' 

group by ledgers.account_id

");
while($row=mysql_fetch_array($c)){
echo '<tr><td>'.Legers($row['account_id']).'</td> <td>'.number_format($row['credit']).'</td></tr>';
$currentt+=$row['credit'];
 }
 $current=$current+$currentt;//$pexpenses;
echo '<tr><td colspan="2"><b>PRE-PAID EXPENSES</td> </tr>';
 $c=mysql_query("select  sum(credit)-sum(debit)as credit,ledgers.account_id as account_id   from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='1' 
and date<='$date' 

group by ledgers.account_id
having credit>0

");
while($row=mysql_fetch_array($c)){
if($row['credit']!=0.00){
echo '<tr><td>'.Legers($row['account_id']).'</td> <td>'.number_format($row['credit']).'</td></tr>';}
$currenttp+=$row['credit'];
 }
 echo '<tr><td colspan="2"><b>TRADE DEBTORS</td> </tr>';
 $c=mysql_query("select  sum(debit)-sum(credit)as credit,ledgers.account_id as account_id   from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='2' 
and ledgers.account_id<>'11'
and date<='$date' 

group by ledgers.account_id
having credit>0

");
while($row=mysql_fetch_array($c)){
if($row['credit']!=0.00){
echo '<tr><td>'.Legers($row['account_id']).'</td> <td>'.number_format($row['credit']).'</td></tr>';}
$currenttpp+=$row['credit'];
 }

 $current=$current+$currenttp+$currenttpp;
  echo '<tr><td><b></td> <td><u><b>'.number_format($current).'</td></tr>';
  echo '<tr><td colspan="2"><b>CURRENT LIABILITIES</td> </tr>';
  $c=mysql_query("select  sum(credit)-sum(debit)as credit,ledgers.account_id as account_id   from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='2'
and date<='$date' 
group by ledgers.account_id


");
while($row=mysql_fetch_array($c)){
if($row['credit']<0){
$cu=$row['credit']*-1;
}
else{
$cu=$row['credit'];
}if($cu!=0.00){
echo '<tr><td>'.Legers($row['account_id']).'</td> <td>'.number_format($cu).'</td></tr>';}
if($row['credit']<0){
$ty=$row['credit']*-1;
$currentl+=$ty;
}else{
$currentl+=$row['credit'];
}
 }
    echo '<tr><td colspan="2"><b>STATUTORY DEDUCTIONS</td> </tr>';
  $c=mysql_query("select  sum(credit)-sum(debit)as credit,ledgers.account_id as account_id   from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='12'
and date<='$date' 
group by ledgers.account_id


");
while($row=mysql_fetch_array($c)){
echo '<tr><td>'.Legers($row['account_id']).'</td> <td>'.number_format($row['credit']).'</td></tr>';
$currentll1+=$row['credit'];
 }
   echo '<tr><td colspan="2"><b>UNPAID SALARIES</td> </tr>';
  $c=mysql_query("select  sum(credit)-sum(debit)as credit,ledgers.account_id as account_id   from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='11'
and date<='$date' 
group by ledgers.account_id


");
while($row=mysql_fetch_array($c)){
echo '<tr><td>'.Legers($row['account_id']).'</td> <td>'.number_format($row['credit']).'</td></tr>';
$currentll+=$row['credit'];
 }
$currentl0=$currentl+$currentll+$currentll1;
  echo '<tr><td><b></td> <td><u><b>'.number_format($currentl).'</td></tr>';
  echo '<tr><td><b> NET CURRENT ASSETS</td> <td><u><b>'.number_format($current-$currentl0).'</td></tr>';
  echo '<tr><td></td> <td><u><b><u>'.number_format($fixedd+($current-$currentl0)+$currenttpp).'</td></tr></table><br>';
 }
  
function TrialBalance($date){
$assets=mysql_query("select sum(debit)-sum(credit)as debit,ledgers.account_id as id from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='4' 
and date<='$date' group by id
 having debit>0
");
$bassets=mysql_query("select sum(debit)-sum(credit)as debit,ledgers.account_id as id from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='4' 
and date<='$date'  group by id
 having debit<0
");
$equity=mysql_query("select sum(debit)-sum(credit)as debit,ledgers.account_id as id from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='14' 
and date<='$date'  group by id
 having debit>0
");
$equityy=mysql_query("select sum(debit)-sum(credit)as debit,ledgers.account_id as id from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='14' 
and date<='$date'  group by id
 having debit<0
");


 $asssets=mysql_query("select sum(debit)-sum(credit)as debit,ledgers.account_id as id from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='10' 
and date<='$date'  group by id
 having debit>0");
  $basssets=mysql_query("select sum(debit)-sum(credit)as debit,ledgers.account_id as id from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='10'
and date<='$date'  group by id
 having debit<0");
 $expenses=mysql_query("select sum(debit)-sum(credit)as debit,ledgers.account_id as id  from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='1' 
and date<='$date'  group by id having debit>0");
  $expensespo=mysql_query("select sum(credit)-sum(debit)as debit,ledgers.account_id as id  from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='1' 
and date<='$date'  group by id having debit>0");
 $fixed=mysql_query("select *,sum(debit)-sum(credit) as debit,accounts.id as id from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
inner join accounts on accounts.id=ledgers.account_id
where group_id='6'
and date<='$date' 
GROUP BY ledgers.account_id");

  $cost=mysql_query("select sum(debit)-sum(credit)as debit,ledgers.account_id as id  from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='7'
and date<='$date'  group by id");
   $income=mysql_query("select sum(credit)-sum(debit)as debit,ledgers.account_id as id  from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='3'
and date<='$date'  group by id");
    $liab=mysql_query("select sum(credit)-sum(debit)as debit,ledgers.account_id as id  from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='2' 
and date<='$date'  group by id
 having debit>0
 ");
   $bliab=mysql_query("select sum(credit)-sum(debit)as debit,ledgers.account_id as id  from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='2'
and date<='$date'  group by id
 having debit<0
 ");
   $liabb=mysql_query("select sum(credit)-sum(debit)as debit,ledgers.account_id as id  from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where  group_id='11'
and date<='$date'  group by id
 having debit>0");
  $bliabb=mysql_query("select sum(credit)-sum(debit)as debit,ledgers.account_id as id  from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where  group_id='11'
and date<='$date'  group by id
 having debit<0");
   $liabbb=mysql_query("select sum(credit)-sum(debit)as debit,ledgers.account_id as id  from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='12' 
and date<='$date'  group by id
 having debit>0");
    $bliabbb=mysql_query("select sum(credit)-sum(debit)as debit,ledgers.account_id as id  from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='12'
and date<='$date'  group by id
 having debit<0");
 
    $capital=mysql_query("select sum(credit)-sum(debit)as debit,ledgers.account_id as id  from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='5'
and date<='$date'  group by id");

?>
     <table class="blue" border="1" style="background-color:#ffffff"; rules="NONE"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial";>
 <tr> <td>
  <strong><img border="0" src="logo.jpg" width="930" height="121"></td></tr></table>       
                
               <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">    
                
                <tr><td style="font-size: 20px" ><center>PACEMART JUICES & CANDIES</td></tr>
                 <tr><td style="font-size: 20px" ><center>P.O BOX 71305-00622,NAIROBI TEL: 0723 224 270</center></td></tr>
  <div align="center"><h4 style="font-family:Bell Gothic,Verdana,Arial";>Trial Balance As Of Date  <?echo $date;?> </h2></div>

<table class="blue" border="1" style="background-color:#ffffff" rules="NONE"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
 <tr><td><b>ACCOUNT</b></td> <td><b>DEBIT</b></td><td><b>CREDIT</b></td></tr>
 <?
  echo '<tr><td colspan="2"><left><b><u>OWNERS EQUITY</td></tr>';
 while ($row=mysql_fetch_array($equity)){
 if($row['debit']!=0.00){
 echo '<tr><td>'.Legers($row['id']).'</td><td>'.(number_format($row['debit'])).'</td><td></td></tr>';}
 $tequity+=$row['debit'];

 }
  while ($row=mysql_fetch_array($equityy)){
 if($row['debit']!=0.00){
 echo '<tr><td>'.Legers($row['id']).'</td><td></td><td>'.(number_format($row['debit']*-1)).'</td></tr>';}
 $btequity+=$row['debit']*-1;

 }
 echo '<tr><td colspan="2"><left><b><u>CURRENT ASSETS</td></tr>';
 while ($row=mysql_fetch_array($assets)){
 if($row['debit']!=0.00){
 echo '<tr><td>'.Legers($row['id']).'</td><td>'.(number_format($row['debit'])).'</td><td></td></tr>';}
 $tassets+=$row['debit'];

 }
  while ($row=mysql_fetch_array($bassets)){
 if($row['debit']!=0.00){
 echo '<tr><td>'.Legers($row['id']).'</td><td></td><td>'.(number_format($row['debit']*-1)).'</td></tr>';}
 $btassets+=$row['debit'];

 }
 while ($row=mysql_fetch_array($asssets)){if($row['debit']!=0.00){
 echo '<tr><td>'.Legers($row['id']).'</td><td>'.(number_format($row['debit'])).'</td><td></td></tr>';}
 $ttassets+=$row['debit'];

 }
  while ($row=mysql_fetch_array($basssets)){if($row['debit']!=0.00){
 echo '<tr><td>'.Legers($row['id']).'</td><td></td><td>'.(number_format($row['debit']*-1)).'</td></tr>';}
 $bttassets+=$row['debit'];

 }
  echo '<tr><td colspan="2"><left><b><u>FIXED ASSETS</td></tr>';
 while ($row=mysql_fetch_array($fixed)){if($row['debit']!=0.00){
 echo '<tr><td>'.Legers($row['id']).'</td><td>'.(number_format($row['debit'])).'</td><td></td></tr>';}
 $tfixed+=$row['debit'];

 }
  echo '<tr><td colspan="2"><left><b><u>EXPENSES</td></tr>';
  while ($row=mysql_fetch_array($expenses)){if($row['debit']!=0.00){
 echo '<tr><td>'.Legers($row['id']).'</td><td>'.(number_format($row['debit'])).'</td><td></td></tr>';}
 $texpenses+=$row['debit'];

 }
   while ($row=mysql_fetch_array($expensespo)){if($row['debit']!=0.00){
 echo '<tr><td>'.Legers($row['id']).'</td><td></td><td>'.(number_format($row['debit'])).'</td><td></td></tr>';}
 $texpenseso+=$row['debit'];

 }
  
  while ($row=mysql_fetch_array($cost)){if($row['debit']!=0.00){
 echo '<tr><td>'.Legers($row['id']).'</td><td>'.(number_format($row['debit'])).'</td><td></td></tr>';}
 $tcost+=$row['debit'];

 }
  echo '<tr><td colspan="2"><left><b><u>INCOME</td></tr>';
 while ($row=mysql_fetch_array($income)){if($row['debit']!=0.00){
 echo '<tr><td>'.Legers($row['id']).'</td><td></td><td>'.(number_format($row['debit'])).'</td></tr>';}
 $tincome+=$row['debit'];

 }
  echo '<tr><td colspan="2"><left><b><u>LIABILITY</td></tr>';
 while ($row=mysql_fetch_array($liab)){if($row['debit']!=0.00){
 echo '<tr><td>'.Legers($row['id']).'</td><td></td><td>'.(number_format($row['debit'])).'</td></tr>';}
 $tliab+=$row['debit'];

 }
  while ($row=mysql_fetch_array($bliab)){if($row['debit']!=0.00){
 echo '<tr><td>'.Legers($row['id']).'</td><td>'.(number_format($row['debit']*-1)).'</td><td></td></tr>';}
 $btliab+=$row['debit'];

 }
  while ($row=mysql_fetch_array($liabb)){if($row['debit']!=0.00){
 echo '<tr><td>'.Legers($row['id']).'</td><td></td><td>'.(number_format($row['debit'])).'</td></tr>';}
 $tliabb+=$row['debit'];

 }
  while ($row=mysql_fetch_array($bliabb)){if($row['debit']!=0.00){
 echo '<tr><td>'.Legers($row['id']).'</td><td>'.(number_format($row['debit']*-1)).'</td><td></td></tr>';}
 $btliabb+=$row['debit'];

 }
  while ($row=mysql_fetch_array($liabbb)){if($row['debit']!=0.00){
 echo '<tr><td>'.Legers($row['id']).'</td><td></td><td>'.(number_format($row['debit'])).'</td></tr>';}
 $tliabbb+=$row['debit'];

 }
 
   while ($row=mysql_fetch_array($bliabbb)){if($row['debit']!=0.00){
 echo '<tr><td>'.Legers($row['id']).'</td><td>'.(number_format($row['debit']*-1)).'</td><td></td></tr>';}
 $btliabbb+=$row['debit'];

 }
  echo '<tr><td colspan="2"><left><b><u>CAPITAL</td></tr>';
 while ($row=mysql_fetch_array($capital)){if($row['debit']!=0.00){
 echo '<tr><td>'.Legers($row['id']).'</td><td></td><td>'.(number_format($row['debit'])).'</td></tr>';}
 $tcapital+=$row['debit'];

 }
 $btliabbb=$btliabbb*-1;
 $btliabb=$btliabb*-1;
 $btliab=$btliab*-1;
  $totaldebit=$texpenses+ $tfixed+$tcost+ $ttassets+ $tassets+$dep+$btliabbb+$btliabb+$btliab+$tequity;
  $bttassets=$bttassets*-1;
  $btassets=$btassets*-1;
  $totalcredit=$tcapital+$tliab+$tincome+$tliabb+$tliabbb+$bttassets+$btassets+$btequity+$texpenseso;
  echo '<tr><td><b><center><u>TOTAL</td><td><b><u><center>'.number_format($totaldebit).'</td><td><b><u><center>'.number_format($totalcredit).'</td></tr></table>';
}
function Viewfinancial(){
$r=mysql_query("select * from financial_year order by id
");
  echo '
     
<table border="1" width="500" cellspacing="0" class="tables"> 
                                                        <thead>
                                                            <tr>
															<th><left>Close Year</th> 
															<th><left>Re-Open Year</th> 
															<th><left>Start Date</th> 
															<th><left>End Date</th> 
                                                              <th><left>Status</th> 
															
                                                                    
                                                            </tr>

                                                        </thead>';

														while($row=mysql_fetch_array($r)){

    echo'<tr><td><a rel="facebox" href=close.php?id=' . $row["id"] .'>Close Year</a></td>
	<td><a rel="facebox" href=open.php?id=' . $row["id"] .'>Re-Open Year</a></td>
	<td>' . (($row['start'])) . '</td>
		<td>' . (($row['end'])) . '</td>
	<td>' . (($row['status'])) . '</td>
	</tr>';
}
							echo "</table>";
}
function ViewUserActivities($date1,$date2){
$r=mysql_query("select * from user_trail
inner join users on users.user_id=user_trail.user
where user_trail.date between '$date1' and '$date2'
order by date,time
");
  echo '<div align="center">ALL USERS AUDIT TRAIL </div>
     
<table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
                                                            <tr>
															<th><left>Date</th> 
															<th><left>Time</th> 
															<th><left>Activity</th> 
															<th><left>User</th> 
                                                          
															
                                                                    
                                                            </tr>

                                                        </thead>';

														while($row=mysql_fetch_array($r)){

    echo'<tr>
	
	<td>' . (($row['date'])) . '</td>
		<td>' . (($row['time'])) . '</td>
	<td>' . (($row['action'])) . '</td>
	<td>' . (($row['user_name'])) . '</td>
	</tr>';
}
							echo "</table>";
}
function ViewAssets(){
$r=mysql_query("select *,debit-(datediff(NOW(),date)/365)*(dep/100*debit) as current from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='6'");

?>
<table class="blue" border="1" style="background-color:#ffffff"; rules="NONE"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial";>
 <tr> <td>
  <strong><img border="0" src="logo.JPG" width="930" height="121"></td></tr></table>
  <div align="center"><h2 style="font-family:Bell Gothic,Verdana,Arial";>Fixed Assets</h2></div>

<table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
 <tr> <td><b>Name</b></td><td><b>Sub Name</b></td><td><b>Purchase Date:</b></td><td><b>Purchase Price:</b></td><td><b>Depreciation Rate:</b></td><td><b>Current Value:</b></td></tr>
 <?while ($row=mysql_fetch_array($r)){
 echo '<tr><td>'.Legers($row['account_id']).'</td><td>'.SubName($row['sub']).'</td><td>'.$row['date'].'</td><td>'.number_format($row['debit']).'</td><td>'.$row['dep'].'</td><td>'.number_format($row['current']).'</td></tr>';
 
 }?> 
 

 </table><br>
 <?}
 function TodaySales(){
 $r=mysql_query("SELECT *,qty as  q,total_p as 
 total FROM sales WHERE DAY( date ) = DAY(CURRENT_DATE )
AND MONTH(date)=MONTH(NOW())
AND YEAR(date)=YEAR(NOW())
and status='ACTIVE' group by sale_id order by number desc");
 ?><table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>DATE</b></td><td><b>TYPE</b> <td><b>RECEIPT</b></td><td><b>PRODUCT</b></td><td><b>QTY</b></td><td><b>PRICE</td><td><b>TOTAL</td></tr><?
 while($row=mysql_fetch_array($r)){
 echo '<tr><td>'.$row['date'].'</td><td>'.$row['type'].'</td><td>'.$row['number'].'</td><td>'.$row['p_name'].'</td><td>'.$row['q'].'</td><td>'.number_format($row['price']).'</td>
 <td>'.number_format($row['total']).'</td>
 </tr>';
 $total+=$row['total'];
 
 }
 echo '<tr><td colspan="6"><center>TOTAL</td><td>'.number_format($total).'</td></tr>';
 
  echo '</table>';
 
 }
 function YesterdaySales(){
 $r=mysql_query("SELECT *,sum(qty)as q,round(sum(total_p))as
 total FROM sales WHERE DAY( date ) = DAY(CURRENT_DATE-1 )
AND MONTH(date)=MONTH(NOW())
AND YEAR(date)=YEAR(NOW())
and status='ACTIVE' group by sale_id order by number desc");
?>
 <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>DATE</b></td><td><b>TYPE</b></td> <td><b>RECEIPT</b></td><td><b>PRODUCT</b></td><td><b>QTY</b></td><td><b>PRICE</td><td><b>TOTAL</td></tr><?
 while($row=mysql_fetch_array($r)){
 echo '<tr><td>'.$row['date'].'</td><td>'.$row['type'].'</td><td>'.$row['number'].'</td><td>'.$row['p_name'].'</td><td>'.$row['q'].'</td><td>'.number_format($row['price']).'</td>
 <td>'.number_format($row['total']).'</td></tr>';
 $total+=$row['total'];
 
 }
 echo '<tr><td colspan="6"><center>TOTAL</td><td>'.number_format($total).'</td></tr>';
  echo '</table>';
 
 }
 function SalesDates($date1,$date2){
 $r=mysql_query("SELECT *,sum(qty)as q,(sum(total_p))as
 total FROM sales where date between '$date1' and '$date2'
and status='ACTIVE' group by sale_id order by number desc");
 ?>
 <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>DATE</b></td> <td><b>RECEIPT</b></td><td><b>PRODUCT</b></td><td><b>QTY</b></td><td><b>PRICE</td><td><b>TOTAL</td></tr><?
 while($row=mysql_fetch_array($r)){
 echo '<tr><td>'.$row['date'].'</td><td>'.$row['number'].'</td><td>'.$row['p_name'].'</td><td>'.$row['q'].'</td><td>'.number_format($row['price']).'</td>
 <td>'.number_format($row['total']).'</td></tr>';
 $total+=$row['total'];
 
 }
 echo '<tr><td colspan="5"><center>TOTAL</td><td>'.number_format($total).'</td></tr>';
  echo '</table>';
 }
  function ProductProperties(){
 $r=mysql_query("SELECT * from products order by p_name");
 ?><div align="center"><h3>Product Properties</h3></div>
 <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>PRODUCT NAME</b></td> <td><b>CATEGORY</b></td><td><b>QTY LEFT</b></td><td><b>BUYING </b></td><td><b>SELLING </b></td><td><b>MARGIN</b></td><td><b>MINIMUM </td></tr><?
 $t=0;
 while($row=mysql_fetch_array($r)){
 $t++;
 if($t==42){
 echo '<tr><td><b>PRODUCT NAME</b></td> <td><b>CATEGORY</b></td><td><b>QTY LEFT</b></td><td><b>BUYING </b></td><td><b>SELLING </b></td><td><b>MARGIN</b></td><td><b>MINIMUM </td></tr>';
 $t=0;
 }
 echo '<tr><td>'.$row['p_name'].'</td><td>'.$row['category'].'</td><td>'.$row['left_p'].'</td><td>'.$row['buying'].'</td><td>'.number_format($row['price']).'</td><td>'.number_format(($row['price'])-($row['buying'])).'</td><td>'.number_format($row['minimum']).'</td>
</tr>';
 $total+=$row['total'];
 
 }

  echo '</table>';
 }
 function ProductPropertiess(){
 $r=mysql_query("SELECT * from products where price<>0 order by p_name");
 ?><div align="center"><h3>Product Properties</h3></div>
 <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>PRODUCT NAME</b></td> <td><b>SELLING </b></td></tr><?
 $t=0;
 while($row=mysql_fetch_array($r)){
 $t++;
 if($t==42){
 echo '<tr><td><b>PRODUCT NAME</b></td><td><b>SELLING </b></td></tr>';
 $t=0;
 }
 echo '<tr><td>'.$row['p_name'].'</td><td>'.number_format($row['price']).'</td>
</tr>';
 
 
 }

  echo '</table>';
 }
 function PurchasesReports($date1,$date2){
 $r=mysql_query("SELECT *,sum(total_p)as d FROM stocking where 
 p_date BETWEEN '$date1' AND '$date2'
 group by t_code order by supplier

");
 }
 function BestMargins($date1,$date2){
 $r=mysql_query("SELECT p_name, avg(price)as selling,avg(p_price)as buying,avg(price)-avg(p_price)as margin,
 ((avg(price)-avg(p_price))/avg(p_price))*100 as perc
 from sales where date between '$date1' and '$date2'
 and p_price>0
 
 group by p_name order by perc desc");
 ?><div align="center">PRODUCTS MARGIN REPORT FOR DATE BETWEEN <?echo $date1;?> AND <?echo $date2;?></div>
  <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>PRODUCT</b></td> <td><b>AVG BUYING</b></td><td><b>AVG SELLING</b></td><td><b>MARGIN</b></td><td><b>PERCENTAGE</b></td></tr><?
 while($row=mysql_fetch_array($r)){
 echo '<tr><td>'.$row['p_name'].'</td><td>'.number_format($row['buying']).'</td><td>'.number_format($row['selling']).'</td>
 <td>'.number_format($row['margin']).'</td>
  <td>'.number_format($row['perc'],2).'</td></tr>';
 $buying+=$row['buying'];
  $selling+=$row['selling'];
   $margin+=$row['margin'];
 }
  echo '<tr><td ><center>TOTAL</td><td>'.number_format($buying).'</td>
  <td>'.number_format($selling).'</td><td>'.number_format($marging).'</td></tr>';
   echo '</table>';
 
 }
 function Popular($date1,$date2){
 $r=mysql_query("SELECT p_name,sum(qty)as q,sum(total_p)as p,p_code FROM sales
WHERE date between '$date1' and '$date2'
GROUP BY p_code ORDER BY q DESC LIMIT 20");
?><div align="center">POPULAR PRODUCTS</div>
  <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>PRODUCT</b></td> <td><b>QTY SOLD</b></td><td><b>TOTAL VALUE</b></td></tr><?
 while($row=mysql_fetch_array($r)){
 echo '<tr><td>'.$row['p_name'].'</td><td>'.number_format($row['q']).'</td><td>'.number_format($row['p']).'</td>
</tr>';

 }
  echo '</table>';
 }
 function DeadStock($date1,$date2){
 $r=mysql_query("SELECT * ,buying*left_p as q From products WHERE code NOT IN(
select p_code as code FROM sales WHERE date between '$date1' and '$date2') and left_p>0");
 ?>
  <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>PRODUCT</b></td> <td><b>QTY SOLD</b></td><td><b>TOTAL VALUE</b></td></tr><?
 while($row=mysql_fetch_array($r)){
 echo '<tr><td>'.$row['p_name'].'</td><td>'.number_format($row['qty']).'</td><td>'.number_format($row['p']).'</td>
</tr>';
 }
  echo '</table>';
 }
 function ViewUsers(){

$rO=mysql_query("select *,user_name as user,department.name as department from users
inner join department on department.id=users.department
");
?>
<table class="blue" border="1" style="background-color:#ffffff"; rules="NONE"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">

 <tr><td><b>
Full Names</td><td>
Department</td></tr>
<?
while ($row=mysql_fetch_array($rO)){
 echo '<tr>
 <td>'.($row['user']).'</td><td>'.($row['department']).'</td>

</tr>';
 }
 echo '</table>';
}
 function BestCat($date1,$date2,$id){
$r=mysql_query("SELECT sales.p_name as p_name, avg(sales.price)as selling,avg(p_price)as buying,avg(sales.price)-avg(p_price)as margin

 from sales 
 inner join products on products.p_name=sales.p_name
 where date between '$date1' and '$date2'
 and p_price>0
 and category='$id'
 
 group by p_name order by margin desc");
 ?><div align="center"><?echo $id;?> CATEGORY REPORT BASED ON MARGINS
  <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>PRODUCT</b></td> <td><b>AVG BUYING</b></td><td><b>AVG SELLING</b></td><td><b>AVG MARGIN</b></td></tr><?
 while($row=mysql_fetch_array($r)){
 echo '<tr><td>'.$row['p_name'].'</td><td>'.number_format($row['buying']).'</td><td>'.number_format($row['selling']).'</td>
 <td>'.number_format($row['margin']).'</td>
</tr>';
 }
 echo '</table>';
 }
 function BestCatP($date1,$date2,$id){
$r=mysql_query("SELECT sales.p_name as p_name,sum(qty) as qty, avg(sales.price)as selling,avg(p_price)as buying,avg(sales.price)-avg(p_price)as margin

 from sales 
 inner join products on products.p_name=sales.p_name
 where date between '$date1' and '$date2'
 and p_price>0
 and category='$id'
 
 group by p_name order by qty desc");
 ?><div align="center"><?echo $id;?> CATEGORY REPORT BASED ON QTY SOLD
  <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>PRODUCT</b></td> <td><b>AVG BUYING</b></td><td><b>AVG SELLING</b></td><td><b>AVG MARGIN</b></td><td><b>QTY SOLD</b></td></tr><?
 while($row=mysql_fetch_array($r)){
 echo '<tr><td>'.$row['p_name'].'</td><td>'.number_format($row['buying']).'</td><td>'.number_format($row['selling']).'</td>
 <td>'.number_format($row['margin']).'</td ><td>'.number_format($row['qty']).'</td>
</tr>';
 }
 echo '</table>';
 }
  function LeastPopular($date1,$date2){
$r=mysql_query("SELECT p_name,sum(qty)as q,sum(total_p)as p,p_code FROM sales
WHERE date between '$date1' and '$date2'
GROUP BY p_code ORDER BY q ASC LIMIT 20");
 ?><div align="center">LEAST POPULAR PRODUCTS</div>
  <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>PRODUCT</b></td> <td><b>QTY SOLD</b></td><td><b>TOTAL VALUE</b></td></tr><?
 while($row=mysql_fetch_array($r)){
 echo '<tr><td>'.$row['p_name'].'</td><td>'.number_format($row['q']).'</td><td>'.number_format($row['p']).'</td>
</tr>';
 }
 echo '</table>';
 }
 function StockQty(){
 require_once('print.php');
 $r=mysql_query("SELECT  * FROM products
ORDER BY left_p ASC ");
 ?>
 <a href="javascript:void(processPrint());"><input type="image" value=<img src="print.png"/></a>
<div id="printMe"><div align="center">STOCK REPORT BY QTY</div>
  <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>PRODUCT</b></td> <td><b>QTY LEFT</b></td></tr><?
 while($row=mysql_fetch_array($r)){
 echo '<tr><td>'.$row['p_name'].'</td><td>'.number_format($row['left_p']).'</td>
</tr>';
 }
 echo '</table></div>';
 }
 function StockByValuation(){
  require_once('print.php');
 
 $r=mysql_query("SELECT  *,buying*left_p as value FROM products
where left_p>0
ORDER BY left_p ASC ");
 ?> <a href="javascript:void(processPrint());"><input type="image" value=<img src="print.png"/></a>
<div id="printMe"><div align="center">STOCK REPORT BY VALUATION</div>
  <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>PRODUCT</b></td> <td><b>QTY LEFT</b></td><td><b>QTY VALUE</b></td></tr><?
 while($row=mysql_fetch_array($r)){
 echo '<tr><td>'.$row['p_name'].'</td><td>'.number_format($row['left_p']).'</td><td>'.number_format($row['value']).'</td>
</tr>';
$value+=$row['value'];
 }
  echo '<tr><td colspan="2"><center>TOTAL</td><td>'.number_format($value).'</td></tr></table></div>';
 }
 function Rejects($date1,$date2){
 $r=mysql_query("SELECT * FROM return_in where 
 date BETWEEN '$date1' AND '$date2'
 group by id desc

");
?>
<table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>DATE</b></td><td><b>PRODUCT</b></td> <td><b>QTY</b></td><td><b>AMOUNT</b></td><td><b>RECEIPT</b></td><td><b>CREDIT NOTE</b></td></tr><?
 while($row=mysql_fetch_array($r)){
 echo '<tr><td>'.$row['date'].'</td><td>'.$row['p_name'].'</td><td>'.number_format($row['qty']).'</td><td>'.number_format($row['total_p']).'</td>
 <td>'.$row['receipt'].'</td><td>'.$row['credit'].'</td>
</tr>';
$value+=$row['value'];
 }
  //echo '<tr><td colspan="2"><center>TOTAL</td><td>'.number_format($value).'</td></tr>';

 echo '</table>';
}
function Audit($id){
$r=mysql_query("select * from audit where product='$id' group by audit_id order by date ");?>
<div align="center">PRODUCT AUDIT REPORTS</div>
<table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>DATE</b></td><td><b>CLOSING STOCK</b></td> <td><b>QTY</b></td><td><b>VALUE</b></td><td><b>REASON</b></td><td><b>Invoice/Receipt</b></td></tr><?
while($row = mysql_fetch_array($r))
{
  echo '<tr>';
    echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center">'.$row['date'].'</div></td>';
	 echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center">'.$row['stock'].'</div></td>';
    echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center">'.$row['qty'].'</div></td>';
	  echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center">'.$row['value'].'</div></td>';
	  	  echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center">'.$row['reason'].'</div></td>';
		  	  echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center">'.$row['number'].'</div></td>';

	  echo '</tr>';
 }
}
function ViewSuppliers(){
$r=mysql_query("select * from accounts
inner join  group_accounts on group_accounts.account_id=accounts.id
where group_id='2'");
  echo '
     
<table border="1" width="500" cellspacing="0" class="tables"> 
                                                        <thead>
                                                            <tr>
															<th><left>Edit Account</th> 
															<th><left>Account Name</th> 
                                                              <th><left>Phone</th> 
																<th><left>Address</th> 
                                                                    
                                                            </tr>

                                                        </thead>';

														while($row=mysql_fetch_array($r)){

    echo'<tr><td><a href=edit.php?id=' . $row["id"] .'>Edit Account</a></td><td>' . (($row['name'])) . '</td>
	<td>' . (($row['phone'])) . '</td>
	<td>' . (($row['address'])) . '</td></tr>';
}
							echo "</table>";
}
function PendingInvoices($id){
$r=mysql_query("select *,sum(credit)-sum(debit)as balance,sum(debit) as d,sum(credit) as c from ledgers
 where account_id='$id' group by invoice having balance >0 ");
  echo '
     
<table border="1" width="500" cellspacing="0" class="tables"> 
                                                        <thead>
                                                            <tr>
															<th><left>Invoice No</th> 
															<th><left>Maturity Date</th> 
															<th><left>Invoice Amount</th> 
                                                              <th><left>Paid Amount</th> 
																<th><left>Balance</th> 
                                                                    
                                                            </tr>

                                                        </thead>';

														while($row=mysql_fetch_array($r)){

    echo'<tr><td>' . (($row['invoice'])) . '</td>
	<td>' . (($row['mat_date'])) . '</td>
	<td>' . (number_format($row['c'])) . '</td>
	<td>' . (number_format($row['d'])) . '</td>
	
	<td>' . (number_format($row['balance'])) . '</td></tr>';
	$debit+=$row['d'];
	$credit+=$row['c'];
	$balance=$credit-$debit;
}
	  echo'<tr><td colspan="2"><b>TOTAL</td>
	<td><b>' . number_format($credit). '</td>
	<td><b>' . (number_format($debit)) . '</td>
	
	<td><b>' . (number_format($balance)) . '</td></tr>';						echo "</table>";
}

function Ageing($id){
$r=mysql_query("select *,sum(credit)-sum(debit) as balance,sum(credit)as c,sum(debit)as paid,DATEDIFF(NOW(),mat_date)as due from ledgers where account_id='$id'
and mat_date<date(NOW())
group by invoice having balance>0");
  echo '
     
<table border="1" width="500" cellspacing="0" class="tables"> 
                                                        <thead>
                                                            <tr><th><left>Invoice No</th> 
                                                              <th><left>Maturity Date</th> 
															  <th><left>Days Overdue</th> 
															  <th><left>Invoice Amount</th> 
															   <th><left>Paid Amount</th> 
																  <th><left>Invoice Balance</th> 
                                                                    
                                                            </tr>

                                                        </thead>';

														while($row=mysql_fetch_array($r)){

    echo'<tr><td>' . (($row['invoice'])) . '</td><td>' . (($row['mat_date'])) . '</td><td>' . (($row['due'])) . '</td><td>' . (number_format($row['c'])) . '</td>
	<td>' . (number_format($row['paid'])) . '</td>
	<td>' . (number_format($row['balance'])) . '</td></tr>';
}
							echo "</table>";
}
function AllInvoices($id){
$r=mysql_query("select *,sum(credit)as c from ledgers
where account_id='$id' and credit>0 group by invoice order by date");
  echo '
     
<table border="1" width="500" cellspacing="0" class="tables"> 
                                                        <thead>
                                                            <tr>
																			<th><left>Invoice Date</th> 
															<th><left>Invoice No</th> 
															<th><left>Invoice Amount</th> 
                                                           
                                                                    
                                                            </tr>

                                                        </thead>';

														while($row=mysql_fetch_array($r)){

    echo'<tr>
	<td>' . (($row['date'])) . '</td>
	<td>' . (($row['invoice'])) . '</td>
	<td>' . (number_format($row['c'])) . '</td>

	
	</tr>';
	
}
							echo "</table>";
}
function PriceChanges($date1,$date2){

}
function ReorderLevels(){
}
function CreditNotesReports($date1,$date2){
$r=mysql_query("SELECT * from return_in where date between '$date1' and '$date2'");
 ?><div align="center"><h3>CREDIT NOTES  ISSUED BETWEEN <?echo $date1;?> To <?echo $date2;?></div>
  <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>CREDIT NOTE</b></td><td><b>PRODUCT</b></td> <td><b>QTY </b></td><td><b>PRICE</b></td></tr><?
 while($row=mysql_fetch_array($r)){
 echo '<tr><td>'.$row['credit'].'</td><td>'.$row['product'].'</td><td>'.number_format($row['qty']).'</td><td>'.number_format($row['total_p']).'</td>
</tr>';
 }
 echo '</table>';
 }
 function DebitNotesReports($date1,$date2){
$r=mysql_query("SELECT * from return_out
inner join products on products.product_id=return_out.product_id

 where date between '$date1' and '$date2'");
 ?><div align="center"><h3>DEBIT NOTES  ISSUED BETWEEN <?echo $date1;?> To <?echo $date2;?></div>
  <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>DEBIT NOTE</b></td><td><b>PRODUCT</b></td> <td><b>QTY </b></td><td><b>PRICE</b></td></tr><?
 while($row=mysql_fetch_array($r)){
 echo '<tr><td>'.$row['credit'].'</td><td>'.$row['p_name'].'</td><td>'.number_format($row['qty']).'</td><td>'.number_format($row['total_p']).'</td>
</tr>';
 }
 echo '</table>';
 }
  function Changed($date1,$date2){
$r=mysql_query("SELECT * from changed 
inner join products on products.product_id=changed.product_id
where date between '$date1' and '$date2'
and changed.price=products.price");
 ?><div align="center"><b>Products Whose Buying Prices Have Changed Between <?echo $date1;?> And <?echo $date2;?></b></div>
  <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>Edit Selling </b></td><td><b>Product Name</b></td><td><b>Previous Buying</b></td> <td><b>Current Buying </b></td><td><b>Current Selling</b></td><td><b>Current Minimum</b></td></tr><?
 while($row=mysql_fetch_array($r)){
 echo '<tr>
 <td><a rel="facebox" href=edit_product.php?id=' . $row["product_id"] .'>Edit
	  </td>
 
 <td>'.$row['p_name'].'</td><td>'.$row['previous'].'</td><td>'.number_format($row['current']).'</td><td>'.number_format($row['price']).'</td>
 <td>'.number_format($row['minimum']).'</td>
</tr>';
 }
 echo '</table>';
 }
 function Changedd($date1,$date2){
$r=mysql_query("SELECT * from changed 
inner join products on products.product_id=changed.product_id
where date between '$date1' and '$date2'
order by supplier
");
 ?><div align="center"><b>Products Whose Buying Prices Have Changed Between <?echo $date1;?> And <?echo $date2;?></b></div>
  <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>Date</b></td><td><b>Product Name</b></td><td><b>Previous Buying</b></td> <td><b>Current Buying </b></td><td><b>Variance </b></td><td><b>Invoice</b></td><td><b>Supplier</b></td></tr><?
 while($row=mysql_fetch_array($r)){
 echo '<tr>

  <td>'.$row['date'].'</td>
 <td>'.$row['p_name'].'</td><td>'.$row['previous'].'</td> <td>'.number_format($row['current']).'</td> <td>'.number_format($row['current']-$row['previous']).'</td><td>'.($row['invoice']).'</td>
 
 <td>'.Supplier($row['supplier']).'</td>
</tr>';
 }
 echo '</table>';
 }
  function ReorderLevel(){
$r=mysql_query("SELECT * from products where left_p<=reorder
");
 ?><div align="center"><b>These Products Have Reached Their Re-Ordr Level Limits</b></div>
  <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>Product</b></td><td><b>Re-Order Limit</b></td><td><b>Current Stock</b></td>
 </tr><?
 while($row=mysql_fetch_array($r)){
 echo '<tr>

  <td>'.$row['p_name'].'</td>
 <td>'.$row['reorder'].'</td><td>'.$row['left_p'].'</td> 

</tr>';
 }
 echo '</table>';
 }
   function ReorderLevell(){
$r=mysql_query("SELECT *,(left_p-reorder)as r from products 
having r=10
");
 ?><div align="center"><b>These Products Have Ten Products To Re-Order Level Limits</b></div>
  <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>Product</b></td><td><b>Re-Order Limit</b></td><td><b>Current Stock</b></td>
 </tr><?
 while($row=mysql_fetch_array($r)){
 echo '<tr>

  <td>'.$row['p_name'].'</td>
 <td>'.$row['reorder'].'</td><td>'.$row['left_p'].'</td> 

</tr>';
 }
 echo '</table>';
 }
 function NotMax($date1,$date2){
$r=mysql_query("SELECT * from sales where date between '$date1' and '$date2'
and price<current
");
 ?><div align="center"><b>Products Sold Below Recommended Prices Between <?echo $date1;?> And <?echo $date2;?></b></div>
  <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>Product</b></td><td><b>Qty Sold</b></td><td><b>Selling Price</b></td><td><b>Recommended Price</b></td><td><b>Discount Total</b></td>
 </tr><?
 while($row=mysql_fetch_array($r)){
 echo '<tr>

  <td>'.$row['p_name'].'</td>
 <td>'.$row['qty'].'</td><td>'.number_format($row['price']).'</td> <td>'.number_format($row['current']).'</td>
 <td>'.number_format(($row['current']-$row['price'])*$row['qty']).'</td>  

</tr>';
$totald+=(($row['current']-$row['price'])*$row['qty']);
 }
 echo '<tr>

  <td colspan="4"><center><b>TOTAL DISCOUNT</td>
 <td><b>'.number_format($totald).'</td>
 </table>';
 }
  function Physical($date1,$date2,$session){
  if($date1!=''&&$date2!=''){
$r=mysql_query("SELECT *,stock_balances.system-manual as diff,stock_balances.system as system from stock_balances 
inner join products on products.product_id=stock_balances.product_id
where date between '$date1' and '$date2'
group by id
 order by diff
");
}

  if($session!=''){
$r=mysql_query("SELECT *,stock_balances.system-manual as diff,stock_balances.system as system from stock_balances 
inner join products on products.product_id=stock_balances.product_id  where session='$session'
group by id
 order by diff

");
}
 ?><div align="center"><b>Products Physical & System Stock Analysis</b></div>
  <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>Product</b></td><td><b>System Qty </b></td><td><b>Manual Qty</b></td><td><b>Variation</b></td>
 </tr><?
 while($row=mysql_fetch_array($r)){
 echo '<tr>

  <td>'.$row['p_name'].'</td>
 <td>'.number_format($row['system']).'</td><td>'.number_format($row['manual']).'</td> <td>'.number_format($row['diff']).'</td>
 

</tr>';
$totald+=($row['diff']);
$manual+=($row['manual']);
$system+=($row['system']);
 }
 echo '<tr>

  <td colspan="0"><center><b>TOTAL VARIATIONS</td>
   <td><b>'.number_format($system).'</td>
    <td><b>'.number_format($manual).'</td>
 <td><b>'.number_format($totald).'</td>
 </table>';
 
 }
 
 
 function PhysicalD($date1,$date2){
  if($date1!=''&&$date2!=''){
$r=mysql_query("SELECT *,sum(stock_balances.system)-sum(manual) as diff,sum(stock_balances.system) as system,sum(manual)as manual from stock_balances 
inner join products on products.product_id=stock_balances.product_id
where date between '$date1' and '$date2'
group by products.product_id
 order by diff
 limit 0,20
");
}

;

 ?><div align="center"><b>Top Twenty Products With Most Stock Discrepancies</b></div>
  <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>Product</b></td><td><b>System Qty </b></td><td><b>Manual Qty</b></td><td><b>Variation</b></td>
 </tr><?
 while($row=mysql_fetch_array($r)){
 echo '<tr>

  <td>'.$row['p_name'].'</td>
 <td>'.number_format($row['system']).'</td><td>'.number_format($row['manual']).'</td> <td>'.number_format($row['diff']).'</td>
 

</tr>';
$totald+=($row['diff']);
$manual+=($row['manual']);
$system+=($row['system']);
 }
 echo '<tr>

  <td colspan="0"><center><b>TOTAL VARIATIONS</td>
   <td><b>'.number_format($system).'</td>
    <td><b>'.number_format($manual).'</td>
 <td><b>'.number_format($totald).'</td>
 </table>';
 
 }
   function SaleInvoice($date1,$date2){
  if($date1!=''&&$date2!=''){
$r=mysql_query("SELECT * from sales
inner join ledgers on ledgers.session=sales.session
 where sales.date between '$date1' and '$date2'

 and type='INVOICE'
 and account_id<>'6'
group by sale_id order by number
");
}

;

 ?><div align="center"><b>Detailed  Product  Credit Sales Between <?echo $date1;?> And <?echo $date2?></b></div>
  <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>Product</b></td><td><b>Qty </b></td><td><b>Price</b></td><td><b>Total</b></td><td><b>Delivery No</b></td><td><b>Time</b></td><td><b>User</b></td><td><b>Customer</b></td>
 </tr><?
 while($row=mysql_fetch_array($r)){
 echo '<tr>

  <td>'.$row['p_name'].'</td>
 <td>'.($row['qty']).'</td><td>'.number_format($row['price']).'</td><td>'.number_format($row['total_p']).'</td> <td>'.($row['number']).'</td>
  <td>'.($row['time']).'</td>
   <td>'.($row['user']).'</td>
   <td>'.Mode($row['account_id']).'</td>
 

</tr>';
$totald+=($row['total_p']);
$totalq+=($row['qty']);

 }
 echo '<tr>

  <td colspan="0"><center><b>TOTAL </td>
   <td><b>'.number_format($totalq).'</td>
    <td><b></td>
 <td><b>'.number_format($totald).'</td>
 </table>';
 
 }
  function SalesD($date1,$date2){
  if($date1!=''&&$date2!=''){
$r=mysql_query("SELECT * from sales where date between '$date1' and '$date2'
 and type='RECEIPT'
group by sale_id order by number
");
}

;

 ?><div align="center"><b>Detailed Product Sales Between <?echo $date1;?> And <?echo $date2?></b></div>
  <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>Product</b></td><td><b>Qty </b></td><td><b>Price</b></td><td><b>Total</b></td><td><b>Receipt</b></td><td><b>Time</b></td><td><b>User</b></td>
 </tr><?
 while($row=mysql_fetch_array($r)){
 echo '<tr>

  <td>'.$row['p_name'].'</td>
 <td>'.($row['qty']).'</td><td>'.number_format($row['price']).'</td><td>'.number_format($row['total_p']).'</td> <td>'.($row['number']).'</td>
  <td>'.($row['time']).'</td>
   <td>'.($row['user']).'</td>
 

</tr>';
$totald+=($row['total_p']);
$totalq+=($row['qty']);

 }
 echo '<tr>

  <td colspan="0"><center><b>TOTAL </td>
   <td><b>'.number_format($totalq).'</td>
    <td><b></td>
 <td><b>'.number_format($totald).'</td>
 </table>';
 
 }
 function cumulative($date1,$date2){
  if($date1!=''&&$date2!=''){
$r=mysql_query("SELECT * ,sum(qty)as qty,sum(total_p)as total from sales where 
date between '$date1' and '$date2'

group by p_name order by qty desc
");
}

;

 ?><div align="center"><b>Detailed Product Sales Between <?echo $date1;?> And <?echo $date2?></b></div>
  <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="900" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>Product</b></td><td><b>Qty </b></td><td><b>Total</b></td>
 </tr><?
 while($row=mysql_fetch_array($r)){
 echo '<tr>

  <td>'.$row['p_name'].'</td>
 <td>'.($row['qty']).'</td><td>'.number_format($row['total']).'</td>

</tr>';
$totald+=($row['total']);
$totalq+=($row['qty']);

 }
$G=mysql_query("SELECT sum( qty ) AS qty, sum( total_p ) AS total
FROM sales
WHERE date
BETWEEN '$date1'
AND '$date2'");
$rew=mysql_fetch_array($G);
 echo '<tr>

  <td colspan="0"><center><b>TOTAL </td>
   <td><b>'.number_format($totalq).'</td>
    
 <td><b>'.number_format($totald).'</td>
 </table>';
 
 }
 function MoreB(){
 
$r=mysql_query("SELECT p_name,session, number,qty,type,price,p_price,date, (
qty * price
) - ( p_price * qty ) AS mar
FROM sales
HAVING mar <0
ORDER BY `sales`.`date` DESC
");


;

 ?><div align="center"><b>Sold Products With Huge Buying Prices Than Selling Prices</b></div>
  <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="900" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>Date</b></td><td><b>Product</b></td><td><b>Buying </b></td><td><b>Selling</b></td><td><b>Qty </b></td><td><b>Receipt</b></td><td><b>Type</b></td><td><b>Customer</b></td>
 </tr><?
 while($row=mysql_fetch_array($r)){
 echo '<tr>
  <td>'.$row['date'].'</td>
  <td>'.$row['p_name'].'</td>

  <td>'.number_format($row['p_price']).'</td>
   <td>'.number_format($row['price']).'</td>
    <td>'.($row['qty']).'</td><td>'.number_format($row['number']).'</td>
   <td>'.$row['type'].'</td>
    <td>'.GetCustomer($row['session']).'</td>

</tr>';


 }

 echo '
 </table>';
 
 }
 function SalesR($date1,$date2){
  if($date1!=''&&$date2!=''){
$r=mysql_query("SELECT number,sum(qty)as qty,sum(total_p)as total_p,time,user,type from sales where date between '$date1' and '$date2'

group by number,type order by number
");
}

;

 ?><div align="center"><b>Detailed Product Sales Between <?echo $date1;?> And <?echo $date2?></b></div>
  <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
<tr><td><b>Type</b></td><td><b>Receipt/ Invoice</b></td><td><b>Total Qty </b></td><td><b>Amount</b></td><td><b>Time</b></td><td><b>User</b></td>
 </tr><?
 while($row=mysql_fetch_array($r)){
 echo '<tr>
<td>'.$row['type'].'</td>
  <td>'.$row['number'].'</td>
<td>'.number_format($row['qty']).'</td><td>'.number_format($row['total_p']).'</td> 
  <td>'.($row['time']).'</td>
   <td>'.($row['user']).'</td>
 

</tr>';
$totald+=($row['total_p']);
$totalq+=($row['qty']);

 }
 echo '<tr>

  <td colspan="2"><center><b>TOTAL </td>
   <td><b>'.number_format($totalq).'</td>
 
 <td><b>'.number_format($totald).'</td>
 </table>';
 
 }
 function supplierAllInvoices(){
 $r=mysql_query("select * from accounts
 inner join group_accounts on group_accounts.account_id=accounts.id
 where group_id='2'")
 
 
 
 ?>
 
 

<body>
		<link rel="stylesheet" href="auto.css" />
	<div id="tablewrapper">
		<div id="tableheader">
        	<div class="search">
                <select id="columns" onchange="sorter.search('query')"></select>
                <input type="text" id="query" onkeyup="sorter.search('query')" />
            </div>
            <span class="details">
				<div>Records <span id="startrecord"></span>-<span id="endrecord"></span> of <span id="totalrecords"></span></div>
        		<div><a href="javascript:sorter.reset()">reset</a></div>
        	</span>
        </div><div align="center"><h2>Supplier Invoices</div>
		  <form method="post" action="generate_sheet.php">
        <table cellpadding="0" cellspacing="0" border="0" id="table" class="tinytable">
            <thead>
               <tr>
                    
          
			  <th><h3>Get Invoices</th>
			  <th><h3>Supplier</th>
			  	
			 
                   
                
                </tr>
            </thead>
            <tbody><?
 while($row=mysql_fetch_array($r)){
 echo '<tr>';
  echo '<td style="border-color:#000000; border-style:solid; border-width:1px;">
  <div align="left"><a  href="supplier.
php?id=' . $row['account_id'] . '">VIEW INVOICES</a></div></td>';

    echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.$row['name'].'</div></td>';

   

	
	  echo '</tr>';
 }?>
  </tbody>
   </table>
        <div id="tablefooter">
          <div id="tablenav">
            	<div>
                    <img src="images/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
                    <img src="images/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
                    <img src="images/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
                    <img src="images/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
                </div>
                <div>
                	<select id="pagedropdown"></select>
				</div>
                <div>
                	<a href="javascript:sorter.showall()">view all</a>
                </div>
            </div>
			<div id="tablelocation">
            	<div>
                    <select onchange="sorter.size(this.value)">
                    <option value="50" selected="selected">50</option>
					<option value="5" >5</option>
                        <option value="10" >10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
						<option value="100">500</option>
						<option value="100">1000</option>
                    </select>
                    <span>Entries Per Page</span>
                </div>
                <div class="page">Page <span id="currentpage"></span> of <span id="totalpages"></span></div>
            </div>
        </div>
    </div>


	<script type="text/javascript" src="script.js"></script>
	<script type="text/javascript">
	var sorter = new TINY.table.sorter('sorter','table',{
		headclass:'head',
		ascclass:'asc',
		descclass:'desc',
		evenclass:'evenrow',
		oddclass:'oddrow',
		evenselclass:'evenselected',
		oddselclass:'oddselected',
		paginate:true,
		size:100,
		colddid:'columns',
		currentid:'currentpage',
		totalid:'totalpages',
		startingrecid:'startrecord',
		endingrecid:'endrecord',
		totalrecid:'totalrecords',
		hoverid:'selectedrow',
		pageddid:'pagedropdown',
		navid:'tablenav',
		sortcolumn:1,
		sortdir:1,
		sum:[8],
		avg:[6,7,8,9],
		columns:[{index:7, format:'%', decimals:1},{index:8, format:'$', decimals:0}],
		init:true
	})
  </script>
</body>
 
 <?

 
 
 
 
 }
 function DebtorAllInvoices(){
 $r=mysql_query("select * from accounts
 inner join group_accounts on group_accounts.account_id=accounts.id
 where group_id='4'")
 
 
 
 ?>
 
 

<body>
		<link rel="stylesheet" href="auto.css" />
	<div id="tablewrapper">
		<div id="tableheader">
        	<div class="search">
                <select id="columns" onchange="sorter.search('query')"></select>
                <input type="text" id="query" onkeyup="sorter.search('query')" />
            </div>
            <span class="details">
				<div>Records <span id="startrecord"></span>-<span id="endrecord"></span> of <span id="totalrecords"></span></div>
        		<div><a href="javascript:sorter.reset()">reset</a></div>
        	</span>
        </div><div align="center"><h2>Debtor Invoices</div>
		  <form method="post" action="generate_sheet.php">
        <table cellpadding="0" cellspacing="0" border="0" id="table" class="tinytable">
            <thead>
               <tr>
                    
          
			  <th><h3>Get Invoices</th>
			  <th><h3>Customer</th>
			  	
			 
                   
                
                </tr>
            </thead>
            <tbody><?
 while($row=mysql_fetch_array($r)){
 echo '<tr>';
  echo '<td style="border-color:#000000; border-style:solid; border-width:1px;">
  <div align="left"><a  href="debtor.
php?id=' . $row['account_id'] . '">VIEW INVOICES</a></div></td>';

    echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.$row['name'].'</div></td>';

   

	
	  echo '</tr>';
 }?>
  </tbody>
   </table>
        <div id="tablefooter">
          <div id="tablenav">
            	<div>
                    <img src="images/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
                    <img src="images/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
                    <img src="images/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
                    <img src="images/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
                </div>
                <div>
                	<select id="pagedropdown"></select>
				</div>
                <div>
                	<a href="javascript:sorter.showall()">view all</a>
                </div>
            </div>
			<div id="tablelocation">
            	<div>
                    <select onchange="sorter.size(this.value)">
                    <option value="50" selected="selected">50</option>
					<option value="5" >5</option>
                        <option value="10" >10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
						<option value="100">500</option>
						<option value="100">1000</option>
                    </select>
                    <span>Entries Per Page</span>
                </div>
                <div class="page">Page <span id="currentpage"></span> of <span id="totalpages"></span></div>
            </div>
        </div>
    </div>


	<script type="text/javascript" src="script.js"></script>
	<script type="text/javascript">
	var sorter = new TINY.table.sorter('sorter','table',{
		headclass:'head',
		ascclass:'asc',
		descclass:'desc',
		evenclass:'evenrow',
		oddclass:'oddrow',
		evenselclass:'evenselected',
		oddselclass:'oddselected',
		paginate:true,
		size:100,
		colddid:'columns',
		currentid:'currentpage',
		totalid:'totalpages',
		startingrecid:'startrecord',
		endingrecid:'endrecord',
		totalrecid:'totalrecords',
		hoverid:'selectedrow',
		pageddid:'pagedropdown',
		navid:'tablenav',
		sortcolumn:1,
		sortdir:1,
		sum:[8],
		avg:[6,7,8,9],
		columns:[{index:7, format:'%', decimals:1},{index:8, format:'$', decimals:0}],
		init:true
	})
  </script>
</body>
 
 <?
 }
  function supplierAllInvoicesI($id){
 $r=mysql_query("select *, SUM(credit)AS creditt from ledgers

 where account_id='$id'
 
 GROUP BY INVOICE
 having creditt>0
")
 
 
 
 ?>
 
 

<body>
		<link rel="stylesheet" href="auto.css" />
	<div id="tablewrapper">
		<div id="tableheader">
        	<div class="search">
                <select id="columns" onchange="sorter.search('query')"></select>
                <input type="text" id="query" onkeyup="sorter.search('query')" />
            </div>
            <span class="details">
				<div>Records <span id="startrecord"></span>-<span id="endrecord"></span> of <span id="totalrecords"></span></div>
        		<div><a href="javascript:sorter.reset()">reset</a></div>
        	</span>
        </div><div align="center"><h2>Supplier Invoices Issued By <?echo Mode($id);?></div>
		  <form method="post" action="generate_sheet.php">
        <table cellpadding="0" cellspacing="0" border="0" id="table" class="tinytable">
            <thead>
               <tr>
                    
          
			  <th><h3>Get Details</th>
			   <th><h3>Invoice Date</th>
			  	
			  <th><h3>Invoice No</th>
			   <th><h3>Invoice Amount</th>
			  	
			  	
			 
                   
                
                </tr>
            </thead>
            <tbody><?
 while($row=mysql_fetch_array($r)){
 echo '<tr>';
  echo '<td style="border-color:#000000; border-style:solid; border-width:1px;">
  <div align="left"><a  rel="facebox" href="preview.
php?id=' . $row['account_id'] . ' & idd=' . $row['invoice'] . '">VIEW DETAILS</a></div></td>';

    echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.$row['date'].'</div></td>';
 echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.$row['invoice'].'</div></td>';
  echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.number_format($row['creditt']).'</div></td>';
   

	
	  echo '</tr>';
 }?>
  </tbody>
   </table>
        <div id="tablefooter">
          <div id="tablenav">
            	<div>
                    <img src="images/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
                    <img src="images/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
                    <img src="images/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
                    <img src="images/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
                </div>
                <div>
                	<select id="pagedropdown"></select>
				</div>
                <div>
                	<a href="javascript:sorter.showall()">view all</a>
                </div>
            </div>
			<div id="tablelocation">
            	<div>
                    <select onchange="sorter.size(this.value)">
                    <option value="50" selected="selected">50</option>
					<option value="5" >5</option>
                        <option value="10" >10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
						<option value="100">500</option>
						<option value="100">1000</option>
                    </select>
                    <span>Entries Per Page</span>
                </div>
                <div class="page">Page <span id="currentpage"></span> of <span id="totalpages"></span></div>
            </div>
        </div>
    </div>


	<script type="text/javascript" src="script.js"></script>
	<script type="text/javascript">
	var sorter = new TINY.table.sorter('sorter','table',{
		headclass:'head',
		ascclass:'asc',
		descclass:'desc',
		evenclass:'evenrow',
		oddclass:'oddrow',
		evenselclass:'evenselected',
		oddselclass:'oddselected',
		paginate:true,
		size:100,
		colddid:'columns',
		currentid:'currentpage',
		totalid:'totalpages',
		startingrecid:'startrecord',
		endingrecid:'endrecord',
		totalrecid:'totalrecords',
		hoverid:'selectedrow',
		pageddid:'pagedropdown',
		navid:'tablenav',
		sortcolumn:1,
		sortdir:1,
		sum:[8],
		avg:[6,7,8,9],
		columns:[{index:7, format:'%', decimals:1},{index:8, format:'$', decimals:0}],
		init:true
	})
  </script>
</body>
 
 <?

 
 
 
 
 }
 function DebtorAllInvoicesI($id){
 $r=mysql_query("select *, SUM(debit)AS creditt from ledgers

 where account_id='$id'
 
 GROUP BY INVOICE
 having creditt>0
")
 
 
 
 ?>
 
 

<body>
		<link rel="stylesheet" href="auto.css" />
	<div id="tablewrapper">
		<div id="tableheader">
        	<div class="search">
                <select id="columns" onchange="sorter.search('query')"></select>
                <input type="text" id="query" onkeyup="sorter.search('query')" />
            </div>
            <span class="details">
				<div>Records <span id="startrecord"></span>-<span id="endrecord"></span> of <span id="totalrecords"></span></div>
        		<div><a href="javascript:sorter.reset()">reset</a></div>
        	</span>
        </div><div align="center"><h2>Debtor Invoices Issued To <?echo Mode($id);?></div>
		  <form method="post" action="generate_sheet.php">
        <table cellpadding="0" cellspacing="0" border="0" id="table" class="tinytable">
            <thead>
               <tr>
                    
          
			  <th><h3>Get Details</th>
			   <th><h3>Invoice Date</th>
			  	
			  <th><h3>Invoice No</th>
			   <th><h3>Invoice Amount</th>
			  	
			  	
			 
                   
                
                </tr>
            </thead>
            <tbody><?
 while($row=mysql_fetch_array($r)){
 echo '<tr>';
  echo '<td style="border-color:#000000; border-style:solid; border-width:1px;">
  <div align="left"><a  rel="facebox" href="preview_c.
php?id=' . $row['account_id'] . ' & idd=' . $row['invoice'] . '">VIEW DETAILS</a></div></td>';

    echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.$row['date'].'</div></td>';
 echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.$row['invoice'].'</div></td>';
  echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.number_format($row['creditt']).'</div></td>';
   

	
	  echo '</tr>';
 }?>
  </tbody>
   </table>
        <div id="tablefooter">
          <div id="tablenav">
            	<div>
                    <img src="images/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
                    <img src="images/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
                    <img src="images/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
                    <img src="images/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
                </div>
                <div>
                	<select id="pagedropdown"></select>
				</div>
                <div>
                	<a href="javascript:sorter.showall()">view all</a>
                </div>
            </div>
			<div id="tablelocation">
            	<div>
                    <select onchange="sorter.size(this.value)">
                    <option value="50" selected="selected">50</option>
					<option value="5" >5</option>
                        <option value="10" >10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
						<option value="100">500</option>
						<option value="100">1000</option>
                    </select>
                    <span>Entries Per Page</span>
                </div>
                <div class="page">Page <span id="currentpage"></span> of <span id="totalpages"></span></div>
            </div>
        </div>
    </div>


	<script type="text/javascript" src="script.js"></script>
	<script type="text/javascript">
	var sorter = new TINY.table.sorter('sorter','table',{
		headclass:'head',
		ascclass:'asc',
		descclass:'desc',
		evenclass:'evenrow',
		oddclass:'oddrow',
		evenselclass:'evenselected',
		oddselclass:'oddselected',
		paginate:true,
		size:100,
		colddid:'columns',
		currentid:'currentpage',
		totalid:'totalpages',
		startingrecid:'startrecord',
		endingrecid:'endrecord',
		totalrecid:'totalrecords',
		hoverid:'selectedrow',
		pageddid:'pagedropdown',
		navid:'tablenav',
		sortcolumn:1,
		sortdir:1,
		sum:[8],
		avg:[6,7,8,9],
		columns:[{index:7, format:'%', decimals:1},{index:8, format:'$', decimals:0}],
		init:true
	})
  </script>
</body>
 
 <?

 
 
 
 
 

 
 
 
 
 }
 function CancelTransactions($date,$amount){
$r=mysql_query("select * from ledgers
inner join accounts on accounts.id=ledgers.account_id where date='$date' and debit='$amount' group by ledgers.id order by name");
?><div align="center" style="font-family:Bell Gothic,Verdana,Arial"><h3><u>Delete Or Amend Transactions</div><table class="blue" border="1" style="background-color:#ffffff"; rules="NONE"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="1" style="font-family:Bell Gothic,Verdana,Arial";>
  <tr><td><b>Delete Transactions</b></td><td><b>Amend Transactions</b></td><td><b>DATE</b></td><td><b>ACCOUNT DEBITED</b></td> <td><b>ACCOUNT CREDITED</b></td><td><b>DESCRIPTION</b></td><td><b>AMOUNT</b></td></tr>
 <?
while ($row=mysql_fetch_array($r)){
 echo '<tr>
 <td >
  <div align="left"><a  rel="facebox" href="delete_t.
php?id=' . $row['session'] . '&date='.$row['date'].'&amount='.$row['debit'].'">Delete Transactions </a></div></td><td >
  <div align="left"><a  rel="facebox" href="amend_t.
php?idd=' . $row['session'] . '&date='.$row['date'].'&amount='.$row['debit'].'"> Amend Transactions </a></div></td><td>'.($row['date']).'</td>
<td>'.($row['name']).'</td><td>'.Legers($row['froms']).'</td><td>'.(($row['description'])).'</td><td>'.(number_format($row['debit'])).'</td></tr>';
 

 }
 echo '</table>';

}
 function AllUsers(){
 $r=mysql_query("select *,department.name as d from users
 inner join department on department.id=users.department
 group by user_id
")
 
 
 
 ?>
 
 

<body>
		<link rel="stylesheet" href="tables.css" />
	<div id="tablewrapper">
		<div id="tableheader">
        	<div class="search">
                <select id="columns" onchange="sorter.search('query')"></select>
                <input type="text" id="query" onkeyup="sorter.search('query')" />
            </div>
            <span class="details">
				<div>Records <span id="startrecord"></span>-<span id="endrecord"></span> of <span id="totalrecords"></span></div>
        		<div><a href="javascript:sorter.reset()">reset</a></div>
        	</span>
        </div><div align="center"><h2>User Accounts Administration</h2></div>
		  <form method="post" action="generate_sheet.php">
        <table cellpadding="0" cellspacing="0" border="0" id="table" class="tinytable">
            <thead>
               <tr>
                    
          
			  <th><h3>De-Activate Account</th>
			   <th><h3>Activate Account</th>
			  	 
			  <th><h3>Delete Account</th>
			    <th><h3>  Activities</th>
			  <th><h3>Creation Date</th>
			  <th><h3>User</th>
			   <th><h3>Full Names</th>
			  	   <th><h3>Phone</th>
				     <th><h3>Department</th>
					   <th><h3>Status</th>
			  	
			 
                   
                
                </tr>
            </thead>
            <tbody><?
 while($row=mysql_fetch_array($r)){
 echo '<tr>';
  echo '<td style="border-color:#000000; border-style:solid; border-width:1px;">
  <div align="left"><a  rel="facebox" href="disable.
php?id=' . $row['user_id'] . '">De-Activate Account</a></div></td>';
 echo '<td style="border-color:#000000; border-style:solid; border-width:1px;">
  <div align="left"><a  rel="facebox" href="enable.
php?id=' . $row['user_id'] . ' ">Activate Account</a></div></td>';
 echo '<td style="border-color:#000000; border-style:solid; border-width:1px;">
  <div align="left"><a  rel="facebox" href="delete_a.
php?id=' . $row['user_id'] . ' ">Delete Account</a></div></td>';
 echo '<td style="border-color:#000000; border-style:solid; border-width:1px;">
  <div align="left"><a  href="user_activity.
php?id=' . $row['user_id'] . '&n='.$row['user_name'].'">View</a></div></td>';
  echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.$row['date_created'].'</div></td>';
   echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.$row['user_name'].'</div></td>';
 echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.$row['name'].'</div></td>';
  
	 echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.$row['phone'].'</div></td>';

 echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.$row['d'].'</div></td>';
    echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.$row['status'].'</div></td>';

	
	  echo '</tr>';
 }?>
  </tbody>
   </table>
        <div id="tablefooter">
          <div id="tablenav">
            	<div>
                    <img src="images/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
                    <img src="images/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
                    <img src="images/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
                    <img src="images/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
                </div>
                <div>
                	<select id="pagedropdown"></select>
				</div>
                <div>
                	<a href="javascript:sorter.showall()">view all</a>
                </div>
            </div>
			<div id="tablelocation">
            	<div>
                    <select onchange="sorter.size(this.value)">
                    <option value="50" selected="selected">50</option>
					<option value="5" >5</option>
                        <option value="10" >10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
						<option value="100">500</option>
						<option value="100">1000</option>
                    </select>
                    <span>Entries Per Page</span>
                </div>
                <div class="page">Page <span id="currentpage"></span> of <span id="totalpages"></span></div>
            </div>
        </div>
    </div>


	<script type="text/javascript" src="script.js"></script>
	<script type="text/javascript">
	var sorter = new TINY.table.sorter('sorter','table',{
		headclass:'head',
		ascclass:'asc',
		descclass:'desc',
		evenclass:'evenrow',
		oddclass:'oddrow',
		evenselclass:'evenselected',
		oddselclass:'oddselected',
		paginate:true,
		size:100,
		colddid:'columns',
		currentid:'currentpage',
		totalid:'totalpages',
		startingrecid:'startrecord',
		endingrecid:'endrecord',
		totalrecid:'totalrecords',
		hoverid:'selectedrow',
		pageddid:'pagedropdown',
		navid:'tablenav',
		sortcolumn:1,
		sortdir:1,
		sum:[8],
		avg:[6,7,8,9],
		columns:[{index:7, format:'%', decimals:1},{index:8, format:'$', decimals:0}],
		init:true
	})
  </script>
</body>
 
 <?

 
 
 
 
 }
  function AllNhif(){
 $r=mysql_query("SELECT *
FROM nhif
")
 
 
 
 ?>
 
 

<body>
		<link rel="stylesheet" href="tables.css" />
	<div id="tablewrapper">
		<div id="tableheader">
        	<div class="search">
                <select id="columns" onchange="sorter.search('query')"></select>
                <input type="text" id="query" onkeyup="sorter.search('query')" />
            </div>
            <span class="details">
				<div>Records <span id="startrecord"></span>-<span id="endrecord"></span> of <span id="totalrecords"></span></div>
        		<div><a href="javascript:sorter.reset()">reset</a></div>
        	</span>
        </div><div align="center"><h2>Nhif Administration</h2></div>
		  <form method="post" action="generate_sheet.php">
        <table cellpadding="0" cellspacing="0" border="0" id="table" class="tinytable">
            <thead>
               <tr>
                    
          
		
			  	 
			  <th><h3>Edit</th>
			    <th><h3>Minimum Bracket</th>
			  <th><h3>Maximum Bracket</th>
			  <th><h3>Rate</th>
			  
			  	
			 
                   
                
                </tr>
            </thead>
            <tbody><?
 while($row=mysql_fetch_array($r)){
 echo '<tr>';
 

 echo '<td style="border-color:#000000; border-style:solid; border-width:1px;">
  <div align="left"><a  href="edit_nhif.
php?id=' . $row['rate_id'] . '">Edit Bracket</a></div></td>';
  echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.number_format($row['mini']).'</div></td>';
   echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.number_format($row['maxi']).'</div></td>';
 echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.$row['rate'].'</div></td>';
  
	;

	
	  echo '</tr>';
 }?>
  </tbody>
   </table>
        <div id="tablefooter">
          <div id="tablenav">
            	<div>
                    <img src="images/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
                    <img src="images/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
                    <img src="images/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
                    <img src="images/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
                </div>
                <div>
                	<select id="pagedropdown"></select>
				</div>
                <div>
                	<a href="javascript:sorter.showall()">view all</a>
                </div>
            </div>
			<div id="tablelocation">
            	<div>
                    <select onchange="sorter.size(this.value)">
                    <option value="50" selected="selected">50</option>
					<option value="5" >5</option>
                        <option value="10" >10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
						<option value="100">500</option>
						<option value="100">1000</option>
                    </select>
                    <span>Entries Per Page</span>
                </div>
                <div class="page">Page <span id="currentpage"></span> of <span id="totalpages"></span></div>
            </div>
        </div>
    </div>


	<script type="text/javascript" src="script.js"></script>
	<script type="text/javascript">
	var sorter = new TINY.table.sorter('sorter','table',{
		headclass:'head',
		ascclass:'asc',
		descclass:'desc',
		evenclass:'evenrow',
		oddclass:'oddrow',
		evenselclass:'evenselected',
		oddselclass:'oddselected',
		paginate:true,
		size:100,
		colddid:'columns',
		currentid:'currentpage',
		totalid:'totalpages',
		startingrecid:'startrecord',
		endingrecid:'endrecord',
		totalrecid:'totalrecords',
		hoverid:'selectedrow',
		pageddid:'pagedropdown',
		navid:'tablenav',
		sortcolumn:1,
		sortdir:1,
		sum:[8],
		avg:[6,7,8,9],
		columns:[{index:7, format:'%', decimals:1},{index:8, format:'$', decimals:0}],
		init:true
	})
  </script>
</body>
 
 <?

 
 
 
 
 }
 function AllPaye(){
 $r=mysql_query("SELECT *
FROM `tax`
")
 
 
 
 ?>
 
 

<body>
		<link rel="stylesheet" href="tables.css" />
	<div id="tablewrapper">
		<div id="tableheader">
        	<div class="search">
                <select id="columns" onchange="sorter.search('query')"></select>
                <input type="text" id="query" onkeyup="sorter.search('query')" />
            </div>
            <span class="details">
				<div>Records <span id="startrecord"></span>-<span id="endrecord"></span> of <span id="totalrecords"></span></div>
        		<div><a href="javascript:sorter.reset()">reset</a></div>
        	</span>
        </div><div align="center"><h2>Paye Administration</h2></div>
		  <form method="post" action="generate_sheet.php">
        <table cellpadding="0" cellspacing="0" border="0" id="table" class="tinytable">
            <thead>
               <tr>
                    
          
		
			  	 
			  <th><h3>Edit</th>
			    <th><h3>Minimum Bracket</th>
			  <th><h3>Maximum Bracket</th>
			  <th><h3>Rate</th>
			  
			  	
			 
                   
                
                </tr>
            </thead>
            <tbody><?
 while($row=mysql_fetch_array($r)){
 echo '<tr>';
 

 echo '<td style="border-color:#000000; border-style:solid; border-width:1px;">
  <div align="left"><a  href="edit_paye.
php?id=' . $row['tax_id'] . '">Edit Bracket</a></div></td>';
  echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.number_format($row['mini']).'</div></td>';
   echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.number_format($row['maxi']).'</div></td>';
 echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.$row['rate'].'</div></td>';
  
	;

	
	  echo '</tr>';
 }?>
  </tbody>
   </table>
        <div id="tablefooter">
          <div id="tablenav">
            	<div>
                    <img src="images/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
                    <img src="images/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
                    <img src="images/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
                    <img src="images/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
                </div>
                <div>
                	<select id="pagedropdown"></select>
				</div>
                <div>
                	<a href="javascript:sorter.showall()">view all</a>
                </div>
            </div>
			<div id="tablelocation">
            	<div>
                    <select onchange="sorter.size(this.value)">
                    <option value="50" selected="selected">50</option>
					<option value="5" >5</option>
                        <option value="10" >10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
						<option value="100">500</option>
						<option value="100">1000</option>
                    </select>
                    <span>Entries Per Page</span>
                </div>
                <div class="page">Page <span id="currentpage"></span> of <span id="totalpages"></span></div>
            </div>
        </div>
    </div>


	<script type="text/javascript" src="script.js"></script>
	<script type="text/javascript">
	var sorter = new TINY.table.sorter('sorter','table',{
		headclass:'head',
		ascclass:'asc',
		descclass:'desc',
		evenclass:'evenrow',
		oddclass:'oddrow',
		evenselclass:'evenselected',
		oddselclass:'oddselected',
		paginate:true,
		size:100,
		colddid:'columns',
		currentid:'currentpage',
		totalid:'totalpages',
		startingrecid:'startrecord',
		endingrecid:'endrecord',
		totalrecid:'totalrecords',
		hoverid:'selectedrow',
		pageddid:'pagedropdown',
		navid:'tablenav',
		sortcolumn:1,
		sortdir:1,
		sum:[8],
		avg:[6,7,8,9],
		columns:[{index:7, format:'%', decimals:1},{index:8, format:'$', decimals:0}],
		init:true
	})
  </script>
</body>
 
 <?

 
 
 
 
 }
 function UserA($id,$name){
 $r=mysql_query("select * from user_trail where user='$id'
")
 
 
 
 ?>
 
 

<body>
		<link rel="stylesheet" href="tables.css" />
	<div id="tablewrapper">
		<div id="tableheader">
        	<div class="search">
                <select id="columns" onchange="sorter.search('query')"></select>
                <input type="text" id="query" onkeyup="sorter.search('query')" />
            </div>
            <span class="details">
				<div>Records <span id="startrecord"></span>-<span id="endrecord"></span> of <span id="totalrecords"></span></div>
        		<div><a href="javascript:sorter.reset()">reset</a></div>
        	</span>
        </div><a href="javascript:void(processPrint());"><input type="image" value=<img src="print.png"/></a>
<div id="printMe"><div align="center"><h2>User Account Activity For <?echo $name;?></h2></div>
		  <form method="post" action="generate_sheet.php">
        <table cellpadding="0" cellspacing="0" border="0" id="table" class="tinytable">
            <thead>
               <tr>
                    
          
			  <th><h3>Date</th>
			   <th><h3>Time</th>
			  	 
			  <th><h3>Account Activity</th>
			    
			  	
			 
                   
                
                </tr>
            </thead>
            <tbody><?
 while($row=mysql_fetch_array($r)){
 echo '<tr>';

  echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.$row['date'].'</div></td>';
   echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.$row['time'].'</div></td>';
 echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.$row['action'].'</div></td>';
  


	
	  echo '</tr></div>';
 }?>
  </tbody>
   </table>
        <div id="tablefooter">
          <div id="tablenav">
            	<div>
                    <img src="images/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
                    <img src="images/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
                    <img src="images/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
                    <img src="images/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
                </div>
                <div>
                	<select id="pagedropdown"></select>
				</div>
                <div>
                	<a href="javascript:sorter.showall()">view all</a>
                </div>
            </div>
			<div id="tablelocation">
            	<div>
                    <select onchange="sorter.size(this.value)">
                    <option value="50" selected="selected">50</option>
					<option value="5" >5</option>
                        <option value="10" >10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
						<option value="100">500</option>
						<option value="100">1000</option>
                    </select>
                    <span>Entries Per Page</span>
                </div>
                <div class="page">Page <span id="currentpage"></span> of <span id="totalpages"></span></div>
            </div>
        </div>
    </div>


	<script type="text/javascript" src="script.js"></script>
	<script type="text/javascript">
	var sorter = new TINY.table.sorter('sorter','table',{
		headclass:'head',
		ascclass:'asc',
		descclass:'desc',
		evenclass:'evenrow',
		oddclass:'oddrow',
		evenselclass:'evenselected',
		oddselclass:'oddselected',
		paginate:true,
		size:100,
		colddid:'columns',
		currentid:'currentpage',
		totalid:'totalpages',
		startingrecid:'startrecord',
		endingrecid:'endrecord',
		totalrecid:'totalrecords',
		hoverid:'selectedrow',
		pageddid:'pagedropdown',
		navid:'tablenav',
		sortcolumn:1,
		sortdir:1,
		sum:[8],
		avg:[6,7,8,9],
		columns:[{index:7, format:'%', decimals:1},{index:8, format:'$', decimals:0}],
		init:true
	})
  </script>
</body>
 
 <?

 
 
 
 
 }
 function movement($date1,$date2,$data){
 ?>
 <div align="center"><b> Products Movement Analysis For Dates Between <?echo $date1;?> And <?echo $date2?></b></div>
  <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
       <tr>
                    
          
			  <th><h3>Product</th>
			  <th><h3>Barcode</th>
			  	<th><h3>System Code</th> 
				  	 
              <th><h3>Current Stock</th>
			   
              <th><h3>Qty Bought</th>
			 <th><h3>Qty Sold</th>
                   
                
                </tr>
 
 <?
 $N = count($data);

  if($date1!=''&&$date2!=''){
for($i=0; $i < $N; $i++){

$Sql=mysql_query("select sum(qty)as s  from sales where p_name='$data[$i]' and date between '$date1' and '$date2'");

$row=mysql_fetch_array($Sql);
 $sold=$row['s'];
$sql=mysql_query("select sum(qty)as s  from stocking where p_name='$data[$i]' and p_date between '$date1' and '$date2'");

$row=mysql_fetch_array($sql);
$bot=$row['s'];
$sql=mysql_query("select * from products where p_name='$data[$i]'");

$row=mysql_fetch_array($sql);

echo '<tr><td>'.$row['p_name'].'</td><td>'.$row['code'].'</td><td>'.$row['system'].'</td><td>'.$row['left_p'].'</td><td>
'.number_format($bot).'</td><td>'.number_format($sold).'</td></tr>';

}
}
}

function GraphSales(){
$mask="graphs/*.png";
array_map("unlink",glob($mask));
$plot = new PHPlot();
$r=mysql_query("select sum(IF(month(date)=1,ABS(total_p),0)) as jan,
sum(IF(month(date)=2,ABS(total_p),0)) as feb,
sum(IF(month(date)=3,ABS(total_p),0)) as mar,
sum(IF(month(date)=4,ABS(total_p),0)) as apr,
sum(IF(month(date)=5,ABS(total_p),0)) as may,
sum(IF(month(date)=6,ABS(total_p),0)) as jun,
sum(IF(month(date)=7,ABS(total_p),0)) as jul,
sum(IF(month(date)=8,ABS(total_p),0)) as aug,
sum(IF(month(date)=9,ABS(total_p),0)) as sep,
sum(IF(month(date)=10,ABS(total_P),0)) as oct,
sum(IF(month(date)=11,ABS(total_p),0)) as nov,
sum(IF(month(date)=12,ABS(total_p),0)) as deci
from sales where year(date)=year(NOW())

");
$row=mysql_fetch_array($r);
$data = array(array('JAN',$row['jan']), array('FEB',$row['feb']),array('MAR',$row['mar']),array('APR',$row['apr']),array('MAY',$row['may']),
array('JUN',$row['jun']),array('JUL',$row['jul']),
array('AUG',$row['aug']),array('SEP',$row['sep']),array('OCT',$row['oct']),
array('NOV',$row['nov']),array('DEC',$row['deci']));
$plot=new PHPlot(900,400);
$plot->SetImageBorderType('plain');
$plot->SetPlotType('bars');
$plot->SetTitle('SALES GRAPH');
$plot->SetDataType('text-data');
$plot->SetDataValues($data);
$plot->SetYTitle('TOTAL SALES IN KSHS');

$plot->SetFont('y_label','5','72');
$plot->SetFont('x_label','5','72');
$plot->SetFont('y_title','5','72');
$plot->SetFont('x_title','5','72');
//$plot->SetPlotAreaWorld(null, 0, null, 100000);

$plot->SetIsInline(True);
$plot->SetOutputFile("graphs/sales.png");
$plot->DrawGraph();





}

function InvoiceGeneration($no){
$r=mysql_query("select * from sales where type='INVOICE' and number='$no'");
$l=mysql_query("select * from ledgers
inner join accounts on accounts.id=ledgers.account_id where invoice='$no' and debit>0 and description='SALES VIA INVOICE'");
$row=mysql_fetch_array($l);

?>



				
         <table class="blue" border="0" style="background-color:#ffffff"; rules="NONE"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial";>
 <tr> <td>
  <strong><img border="0" src="logo.jpg" width="930" height="121"></td></tr></table> 
               <table class="blue" border="0" style="background-color:#ffffff"
        frame="BOX" width="980" align="center" 
 cellpadding="5" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">    
                
               
                 <tr><td style="font-size: 20px" ><center>P.O BOX 71305-00622,NAIROBI TEL: 0723 224 270</center></td></tr></table>
  
  <div align="center"><h4 style="font-family:Bell Gothic,Verdana,Arial";><u>INVOICE NO <?echo $no;?></u></h4></div>

<table class="blue" border="0" style="background-color:#ffffff"
       rules="NONE" frame="BOX" width="980" align="center" 
 cellpadding="12" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
 <tr><td style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px">Client Name <b><?echo $row['name'];?></td><td style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px"></td></tr> 
  <tr><td style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px">Delivery Date <b><?echo $row['date'];?></td><td style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px"></td></tr>
 <tr><td style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px"> Payment Date <b><?echo $row['mat_date'];?></td><td style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px"></td></tr>
 </table>
 <table class="blue" border="3" style="background-color:#ffffff"
       rules="NONE" frame="BOX" width="980" align="center" 
 cellpadding="12" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial"><th style="font-size: 18px"><u><left>INVOICE DETAILS</th>
 
 <tr><td style="font-size: 18px"><u>Product Name</td><td style="font-size: 18px"><u>Qty</td> <td style="font-size: 18px"><u>Price</td><td style="font-size: 18px"><u>Sub Total</td></tr> 
  <?while($row=mysql_fetch_array($r)){
   echo '<tr><td style="font-size: 16px">'.$row['p_name'].'</td><td style="font-size: 16px">'.($row['qty']).'</td>
 <td style="font-size: 16px">'.($row['price']).'</td><td style="font-size: 16px"><b>'.number_format($row['total_p'],2).'</td></tr>';
 $total+=$row['total_p'];
 $qty+=$row['qty'];
  
  } echo '<tr><td cospan="3" style="font-size: 18px"><center><b>TOTAL (Vat Inclusive)</td><td style="font-size: 18px"><b><u>'.number_format($total,2).' </td></tr>';?>
 </table>
 <table class="blue" border="0" style="background-color:#ffffff"
       rules="NONE" frame="BOX" width="980" align="center" 
 cellpadding="20" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">
 <tr><td style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px">Stamp</td></tr>
  <tr><td></td><td style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px"><div align="right">Accountant's Signature.................................................</td></tr>
</table>
 <div align="center" style="font-family:Bell Gothic ,Verdana;">ACCOUNT IS DUE ON DEMAND</i></div><br>
   <div align="center" style="font-family:Bell Gothic ,Verdana;"><i>"Finish your house in style"</i></div>
   
   <?}

 
 