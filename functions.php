<?php
ini_set('display_errors', '0');
ini_set('log_errors', 1);
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
ob_start();
session_start();
error_reporting(E_ALL ^ E_NOTICE);
set_time_limit(0);
require 'phplot.php';

include_once './conf.php';

include_once './mysql.php';
include_once './forms.php';

include_once './functions.php';
include_once './reports.php';

include_once './navigation/navigations.php';
function SDate($no){
$s=mysql_query("select * from lpo where invoice='$no'");
$row=mysql_fetch_array($s);
$date=$row['mat_date'];
return $date;


}
function SendSMS($host, $port, $username, $password, $phoneNoRecip, $msgText) {
    /* Parameters:
      $host ? IP address or host name of the NowSMS server
      $port ? "Port number for the web interface" of the NowSMS Server
      $username ? <span class="notranslate">"SMS Users"</span> account on the NowSMS server
      $password ? Password defined for the <span class="notranslate">"SMS Users"</span> account on the NowSMS Server
      $phoneNoRecip ? One or more phone numbers (comma delimited) to receive the text message
      $msgText ? Text of the message
     */
    $fp = fsockopen($host, $port, $errno, $errstr);
    if (!$fp) {
        echo "errno: $errno \n";
        echo "errstr: $errstr\n";
        return $result;
    }

    fwrite($fp, "GET /?Phone=" . rawurlencode($phoneNoRecip) . "&Text=" . rawurlencode($msgText) . " HTTP/1.0\n");
    if ($username != "") {
        $auth = $username . ":" . $password;
        $auth = base64_encode($auth);
        fwrite($fp, "Authorization: Basic " . $auth . "\n");
    }
    fwrite($fp, "\n");

    $res = "";

    while (!feof($fp)) {
        $res .= fread($fp, 1);
    }
    fclose($fp);


    return $res;
}
 function LedgerBalance($id,$date){
 $group=GetGroup($id);
  if($group==4||$group==1||$group==7||$group==6||$group==9||$group==10){
$r=mysql_query("select sum(debit)-sum(credit)as balance from ledgers where account_id='$id' and date<'$date'");
}
if($group==3||$group==2||$group==5||$group==14){
$r=mysql_query("select sum(credit)-sum(debit)as balance from ledgers where account_id='$id' and date<'$date'");
}
$row=mysql_fetch_array($r);
$balance=$row['balance'];
return $balance;
}
function UserAudit($user,$activity,$date,$ip){
$r=mysql_query("insert into user_trail(user,action,time,date,ip)
values('$user','$activity',NOW(),NOW(),'$ip')");
}

function ledgerbalance1($id,$date1,$date2){
	$group=GetGroup($id);
if($group==3||$group==2||$group==5||$group==14){
$r=mysql_query("select sum(credit)-sum(debit)as balance from ledgers where account_id='$id' and date between '$date1' and '$date2'");
$row=mysql_fetch_array($r);
$balance=$row['balance'];
return $balance;
}	
}
function ReverseReceipts($no){


$ro=mysql_query("select * from sales where number='$no' and type='INVOICE' group by sale_id");
if(mysql_num_rows($ro)>0){
$t=mysql_query("select * from sales where number='$no' and type='INVOICE' group by sale_id");
while($tyy=mysql_fetch_array($t)){
 $name= mysql_real_escape_string($tyy['p_name']);
$qty=$tyy['qty'];
$session=$tyy['session'];
$g=mysql_query("update products set left_p=left_p+'$qty' where p_name='$name'");}

$der=mysql_query("delete from sales where number='$no' and type='INVOICE'");


$b=mysql_query("delete from ledgers where session='$session'");

echo '<span class="green">Receipt Transactions Succesfully Reversed</span></br>';
}else{
echo '<span class="red">Reversal Not Possible Receipt Does Not Exist</span></br>';
}
session_regenerate_id();
}
function ReverseReceipt($no){
$session=session_id();

$ro=mysql_query("select * from sales where number='$no' and type='RECEIPT'  group by sale_id");
if(mysql_num_rows($ro)>0){
$t=mysql_query("select * from sales where number='$no' and type='RECEIPT'  group by sale_id");
while($tyy=mysql_fetch_array($t)){
$name=mysql_real_escape_string($tyy['p_name']);
 $qty=$tyy['qty'];
 $session=$tyy['session'];
$g=mysql_query("update products set left_p=left_p+'$qty' where p_name='$name'");}

$d=mysql_query("delete from sales where number='$no' and type='RECEIPT'");


$b=mysql_query("delete from ledgers where session='$session'");
echo '<span class="green">Receipt Transactions Succesfully Reversed</span></br>';
}else{
echo '<span class="red">Reversal Not Possible Receipt Does Not Exist</span></br>';
}
session_regenerate_id();
}
function AddSubP($name,$id,$status,$type){
$name=mysql_real_escape_string($name);

$r=mysql_query("select * from sub_accounts where name='$name' ");

if(mysql_num_rows($r)==0){

$t=mysql_query("insert into sub_accounts(name,account)values('$name','$id')");
$idd=mysql_insert_id();
$y=mysql_query("insert into pgroups(id,name,group_id,status)
values('$idd','$name','$status','$type')");




 echo '<span class="green">Vote Succesfully Added</span></br>';}else{
 echo '<span class="red">Vote Already Exists</span></br>';}
}
function PayrollVote($name,$id,$status,$idd){
$name=mysql_real_escape_string($name);
$t=mysql_query("select * from pgroups where name='$name'");
if(mysql_num_rows($t)==0){
$yI=mysql_query("insert into accounts(name)values('$name')");
$ide=mysql_insert_id();
$D=mysql_query("insert into pgroups(id,name,group_id,status)
values('$ide','$name','$id','$status')");
$c=mysql_query("insert into group_accounts(account_id,group_id)values('$ide','$idd')");

 echo '<span class="green">Payroll Vote Succesfully Added</span></br>';
}
else{
 echo '<span class="red">Sorry Payroll Vote Already Exists</span></br>';}


}
function Vname($id){
$r=mysql_query("select * from pgroups where id='$id'");
$row=mysql_fetch_array($r);
$name=$row['name'];
return $name;
}

function AdjustDeductions($id,$eid,$amount,$date){
$r=mysql_query("insert into varance(group_id,employee_id,date,credit)values('$id','$eid','$date','$amount')");
 echo '<span class="green">Deduction Succesfully Adjusted</span></br>';
}
function Employees($id){
$r=mysql_query("select * from employee where employee_id='$id'");
$row=mysql_fetch_array($r);
$name=$row['names'];
return $name;
}
function GetBasic(){
$r=mysql_query("select * from pgroups where name='BASIC SALARY' ");

$f=mysql_fetch_array($r);
$g=$f['id'];

return $g;

}
 function GetPayeP($id,$date){
$r=mysql_query("select sum(debit)-200 as gross from fixed where employee_id='$id'");
$row=mysql_fetch_array($r);
$fixed=$row['gross'];
$bas=GetBasic();
$r=mysql_query("select sum(debit) as gross from fixed where employee_id='$id' and group_id='$bas'");
$row=mysql_fetch_array($r);
$basic=$row['gross'];

$r=mysql_query("select sum(debit) as gross from varance where employee_id='$id' and MONTH(date)=MONTH('$date')");
$row=mysql_fetch_array($r);
$var=$row['gross'];
$gross=$fixed+$var;



//$gross=62000;
$dd=mysql_query("SELECT * FROM tax WHERE '$gross' BETWEEN mini and maxi");
$rew=mysql_fetch_array($dd);
$mini = $rew['mini'];
$rate = $rew['rate'];
$tax_id=$rew['tax_id'];
$taxable=$gross-$mini;
  $firstpaye =$taxable*$rate/100;
$id2=$tax_id-1;
$y=mysql_query("SELECT tax FROM tax WHERE tax_id='$id2'");

$row = mysql_fetch_array($y);
$tax = $row['tax'];
$paye=$tax+$firstpaye-(1162-$insurance);
if($paye<=0){
$paye=0.0;
}
return $paye;

}
function GetDeductions($id,$date){
$r=mysql_query("select sum(credit) as gross from fixed where employee_id='$id'");
$row=mysql_fetch_array($r);
$fixed=$row['gross'];
$r=mysql_query("select sum(credit) as gross from varance where employee_id='$id' and MONTH(date)=MONTH('$date')");
$row=mysql_fetch_array($r);
$var=$row['gross'];
$gross=$fixed+$var;
//$gross=62000;

return $gross;


}
function EmployeeNo($id){
$r=mysql_query("select * from employee where employee_id='$id'");
$row=mysql_fetch_array($r);
$name=$row['eno'];
return $name;
}
function IdNo($id){
$r=mysql_query("select * from employee where employee_id='$id'");
$row=mysql_fetch_array($r);
$name=$row['id_no'];
return $name;
}
function AdjustBonuses($id,$eid,$amount,$date){
$r=mysql_query("insert into varance(group_id,employee_id,date,debit)values('$id','$eid','$date','$amount')");
 echo '<span class="green">Bonus Succesfully Adjusted</span></br>';
}
function CommitedPayroll($date){
$session=session_id();
$staff=GetStaff();
$r=mysql_query("insert into ledgers(date,credit,account_id,froms,sub,session)(select '$date'as date,debit,'$staff' as account_id,group_id as froms,group_id,'$session' as session from fixed where debit>0 group by id)");
$r=mysql_query("insert into ledgers(date,debit,account_id,froms,sub,session)(select '$date'as date,debit,group_id as account_id,employee_id ,group_id,'$session' as session from fixed where debit>0 group by id)");
$r=mysql_query("insert into ledgers(date,credit,froms,account_id,sub,session)(select '$date'as date,credit,'$staff' as account_id,group_id as froms,group_id,'$session' as session from fixed where credit>0 group by id)");
$r=mysql_query("insert into ledgers(date,debit,froms,account_id,sub,session)(select '$date'as date,credit,group_id as account_id,employee_id ,group_id,'$session' as session from fixed where credit>0 group by id)");
$r=mysql_query("insert into ledgers(date,credit,account_id,froms,sub,session)(select '$date'as date,debit,'$staff' as account_id,group_id as froms,group_id,'$session' as session from varance where debit>0 group by id)");
$r=mysql_query("insert into ledgers(date,debit,account_id,froms,sub,session)(select '$date'as date,debit,group_id as account_id,employee_id ,group_id,'$session' as session from varance where debit>0 group by id)");
$r=mysql_query("insert into ledgers(date,credit,froms,account_id,sub,session)(select '$date'as date,credit,'$staff' as account_id,group_id as froms,group_id,'$session' as session from varance where credit>0 group by id)");
$r=mysql_query("insert into ledgers(date,debit,froms,account_id,sub,session)(select '$date'as date,credit,group_id as account_id,employee_id ,group_id,'$session' as session from varance where credit>0 group by id)");
$r=mysql_query("insert into employee_table(employee_id,date,debit,group_id)(select employee_id,'$date' as date,debit,group_id from fixed where debit>0 group by id)");
$r=mysql_query("insert into employee_table(employee_id,date,credit,group_id)(select employee_id,'$date' as date,credit,group_id from fixed where credit>0 group by id)");
$r=mysql_query("insert into employee_table(employee_id,date,debit,group_id)(select employee_id,'$date' as date,debit,group_id from varance where debit>0 and month(date)=month('$date') group by id)");
$r=mysql_query("insert into employee_table(employee_id,date,credit,group_id)(select employee_id,'$date' as date,credit,group_id from varance where credit>0 and month(date)=month('$date') group by id)");
$d=mysql_query("select * from ledgers where session='$session'");
while($row=mysql_fetch_array($d)){
$idd=GetPV($row['account_id']);
$from=GetPV($row['froms']);
$id=$row['id'];
$h=mysql_query("update ledgers set account_id='$idd',froms='$from' where id='$id'");

}
$t=mysql_query("update ledgers set description='STAFf SALARIES' where session='$session'");
echo '<span class="green">Payroll Succesfully Added</span></br>';
}
function GetPV($id){
$r=mysql_query("select * from sub_accounts where id='$id'");
if(mysql_num_rows($r)>0){
$f=mysql_fetch_array($r);
$g=$f['account'];
}else{
$g=$id;
}
return $g;

}
function GetPId(){
$r=mysql_query("select * from pgroups where name='PAYE' ");

$f=mysql_fetch_array($r);
$g=$f['id'];

return $g;

}
function GetCustomer($session){
$r=mysql_query("select * from ledgers where session='$session' and debit>0");
$row=mysql_fetch_array($r);
$name=Acc($row['account_id']);
return $name;
}
function InsertPaye($date,$p){
$r=mysql_query("select * from employee");
while($row=mysql_fetch_array($r)){
$session=session_id();
$id=GetStaff();
$paye=GetPayeP($id,$date);
$t=mysql_query("insert into ledgers(debit,account_id,froms,date,session)
values('$paye','$id','$p','$date','$session')");
$t=mysql_query("insert into ledgers(credit,account_id,froms,date,session)
values('$paye','$p','$id','$date','$session')");
$t=mysql_query("insert into employee_table(credit,employee_id,group_id,date)
values('$paye','$id','$p','$date')");

}
}
function GetTaxableP($id,$date){
$r=mysql_query("select sum(debit)-200 as gross from fixed where employee_id='$id'");
$row=mysql_fetch_array($r);
$fixed=$row['gross'];
$bas=GetBasic();
$r=mysql_query("select sum(debit) as gross from fixed where employee_id='$id' and group_id='$bas'");
$row=mysql_fetch_array($r);
$basic=$row['gross'];
$basic=15/100*$basic;


$r=mysql_query("select sum(debit) as gross from varance where employee_id='$id' and MONTH(date)=MONTH('$date')");
$row=mysql_fetch_array($r);
$var=$row['gross'];
$gross=$fixed+$var;
//$gross=62000;

return $gross;

}
function PostCheque($date,$bank,$cheque){

$rp=mysql_query("select sum(debit)-sum(credit)as net,bank,employee.employee_id AS employee_id from employee_table
inner join employee on employee.employee_id=employee_table.employee_id

where month(employee_table.date)=month('$date')
and status='NOT PAID'
and year(employee_table.date)=year('$date')
and bank='$bank'

group by employee_table.employee_id");
$session=session_id();
while($row=mysql_fetch_array($rp)){
$staff=GetStaff();
$employee=$row['employee_id'];
$net=$row['net'];
$nn+=$net;
$g=mysql_query("update employee_table set status='PAID' where employee_id='$employee' and month(date)=month('$date')
and year(date)=year('$date')");
$ur=mysql_query("insert into ledgers(credit,account_id,sub,date,receipt,froms,session,invoice)values('$net','$bank','$staff','$date','$rec','$employee','$session','$cheque')");
//$r=mysql_query("insert into supplier_ledgers(credit,supplier_id,date,code,session)values('$amount','$payment','$date','$invoice','$session')");

$i=mysql_query("insert into ledgers(debit,account_id,sub,date,receipt,froms,session,invoice)values('$net','$staff','$employee','$date','$rec','$bank','$session','$cheque')");
$name=SubName($employee);


$ne=number_format($net);
 echo "<span class='green'>$name salary of $ne succesfully debited their account</span></br>";
 session_regenerate_id();
}
BankCredit($bank,$nn,$date,$cheque,$session);

}
function GetGross($id,$date){
$r=mysql_query("select sum(debit)-200 as gross from fixed where employee_id='$id'");
$row=mysql_fetch_array($r);
$fixed=$row['gross'];



$r=mysql_query("select sum(debit) as gross from varance where employee_id='$id' and MONTH(date)=MONTH('$date')");
$row=mysql_fetch_array($r);
$var=$row['gross'];
$gross=$fixed+$var;
//$gross=62000;

return $gross;

}
function GetNet($id,$date){
$paye=GetPayeP($id,$date);
$gross=GetGross($id,$date);
$deductions=GetDeductions($id,$date);
$net=$gross+200-($paye+$deductions);
return $net;

}


function DeletePayrollVote($id){
if($id!=1){
$t=mysql_query("select * from pgroups where id='$id'");
if(mysql_num_rows($t)>0){
$y=mysql_query("delete from pgroups where id='$id'");
 echo '<span class="green">Payroll Vote Succesfully Deleted</span></br>';
}
else{
 echo '<span class="red">Sorry Payroll Vote Does Not Exists</span></br>';}


}else{
 echo '<span class="red">Sorry Paye Vote cannot be deleted!-(It\'s A system Constant)</span></br>';

}
}
function AddEmployee($name,$no,$id,$phone,$pin,$nssf,$nhif,$dep,$pos,$bank,$account){
$name=mysql_real_escape_string($name);
$bank=mysql_real_escape_string($bank);
$pos=mysql_real_escape_string($pos);
$dep=mysql_real_escape_string($dep);
$staff=GetStaff();
$t=mysql_query("select * from employee where id_no='$id'");
if(mysql_num_rows($t)==0){
$e=mysql_query("insert into sub_accounts(name,account)values('$name','$staff')");
 echo '<span class="green">Employee Succesfully Added</span></br>';
 $if=mysql_insert_id();

 //$k=mysql_query("insert into group_accounts(account_id,group_id)values('$if','11')");
 $y=mysql_query("insert into employee(employee_id,names,id_no,pin,nssf_no,nhif_no,position,dep,phone,bank,account,eno)
values('$if','$name','$id','$pin','$nssf','$nhif','$pos','$dep','$phone','$bank','$account','$no')");
 
 
 $_SESSION['employee']=$if;
}
else{
 echo '<span class="red">Sorry Employee Already Exists</span></br>';}


}
function AddAsset($name,$dep,$price,$date,$desc,$payment,$main){
$name=mysql_real_escape_string($name);
$desc=mysql_real_escape_string($desc);
$t=mysql_query("select * from sub_accounts where name='$name'");
if(mysql_num_rows($t)==0){
$y=mysql_query("insert into sub_accounts(name,account)
values('$name','$main')");
 echo '<span class="green">Asset Succesfully Added</span></br>';
 $id=mysql_insert_id();
 $session=session_id();

  $q=mysql_query("INSERT into ledgers(date,credit,description,sub,froms,session,account_id,dep)VALUES('$date','$price','$desc','$id','$main','$session','$payment','$dep')");

  $r=mysql_query("INSERT into ledgers(date,debit,
  description,sub,froms,session,account_id,dep)VALUES('$date','$price','$desc','$id','$payment','$session','$main','$dep')");
}
else{
 echo '<span class="red">Sorry Asset Already Exists</span></br>';}
 session_regenerate_id();


}
function LpS($no){
$s=mysql_query("select * from lpo where invoice='$no'");
$row=mysql_fetch_array($s);
$date=Mode($row['supplier']);
return $date;


}
function LDate($no){
$s=mysql_query("select * from lpo where invoice='$no'");
$row=mysql_fetch_array($s);
$date=$row['date'];
return $date;


}
function ChangePassT($user,$old,$new,$new2){

$user=mysql_real_escape_string($user);
$old=mysql_real_escape_string($old);
$new=mysql_real_escape_string($new);
$new2=mysql_real_escape_string($new2);
$q =mysql_query( "SELECT *,user_id, user_name
 FROM users WHERE
 user_name='$user' AND password=SHA1('$old')
");
if(mysql_num_rows($q)==1){
if($new==$new2){
$r=mysql_query("update users set password=SHA1('$new') where user_name='$user' and password=SHA1('$old') limit 1");
 echo '<span class="green">User Password Succesfully Updated</span></br>';
}else{
 echo '<span class="red">Your Passwordd dont match</span></br>';
}

}else{

 echo '<span class="red">Your Cant Change Another Username Password</span></br>';
}



}
function minimum($id){
$r=mysql_query("select * from products where product_id='$id'");
$row=mysql_fetch_array($r);
$minimum=$row['minimum'];
return $minimum;

}
function stcokist($id){
$r=mysql_query("select * from products where product_id='$id'");
$row=mysql_fetch_array($r);
$minimum=$row['stockist'];
return $minimum;

}
function maximum($id){
$r=mysql_query("select * from products where product_id='$id'");
$row=mysql_fetch_array($r);
$minimum=$row['price'];
return $minimum;

}
function AddCategory($name){
$name=mysql_real_escape_string($name);

$t=mysql_query("select * from categories where name='$name'");
if(mysql_num_rows($t)==0){
$y=mysql_query("insert into categories(name)
values('$name')");
 echo '<span class="green">Category Succesfully Added</span></br>';

}
else{
 echo '<span class="red">Sorry Category Already Exists</span></br>';}


}
function AddDeposit($name,$amount,$date,$id,$phone,$froms){
$e=mysql_query("select * from depo");
$ee=mysql_fetch_array($e);
$number=$ee['number'];
$t=mysql_query("update depo set number=number+1");
$dep=GetDeposit();
$session=session_id();
$r=mysql_query("insert into deposits(name,date,amount,id_no,phone,number)values('$name','$date','$amount','$id','$phone','$number')");
$l=mysql_query("insert into ledgers(account_id,froms,date,description,credit,session,receipt)value('$dep','$froms','$date','CUSTOMER DEPOSITS','$amount','$session','$number')");
$l=mysql_query("insert into ledgers(account_id,froms,date,description,debit,session,receipt)value('$froms','$dep','$date','CUSTOMER DEPOSITS','$amount','$session','$number')");
session_regenerate_id();


ob_end_clean();
header("location:deposit_slips.php?n=$number&s=$froms");
}
function GetDeposit(){
$r=mysql_query("select * from accounts where name='CUSTOMER DEPOSITS'");
if(mysql_num_rows($r)==0){
$f=mysql_query("insert into accounts(name)values('CUSTOMER DEPOSITS')");
$id=mysql_insert_id();
$h=mysql_query("insert into group_accounts(account_id,group_id)values('$id','2')");

}else{
$row=mysql_fetch_array($r);
$id=$row['id'];


}
return $id;

}
function GetDebt(){
$r=mysql_query("select * from accounts where name='DEBT SWAP'");
if(mysql_num_rows($r)==0){
$f=mysql_query("insert into accounts(name)values('DEBT SWAP')");
$id=mysql_insert_id();
$h=mysql_query("insert into group_accounts(account_id,group_id)values('$id','2')");

}else{
$row=mysql_fetch_array($r);
$id=$row['id'];


}
return $id;

}
function GetStaff(){
$r=mysql_query("select * from accounts where name='STAFF SALARIES'");
if(mysql_num_rows($r)==0){
$f=mysql_query("insert into accounts(name)values('STAFF SALARIES')");
$id=mysql_insert_id();
$h=mysql_query("insert into group_accounts(account_id,group_id)values('$id','11')");

}else{
$row=mysql_fetch_array($r);
$id=$row['id'];


}
return $id;

}
function GetEquity(){
$r=mysql_query("select * from accounts where name='RETAINED EARNINGS'");
if(mysql_num_rows($r)==0){
$f=mysql_query("insert into accounts(name)values('RETAINED EARNINGS')");
$id=mysql_insert_id();
$h=mysql_query("insert into group_accounts(account_id,group_id)values('$id','14')");

}else{
$row=mysql_fetch_array($r);
$id=$row['id'];


}
return $id;

}
function GetDep(){
$r=mysql_query("select * from accounts where name='ASSETS DEPRECIATION'");
if(mysql_num_rows($r)==0){
$f=mysql_query("insert into accounts(name)values('ASSETS DEPRECIATION')");
$id=mysql_insert_id();
$h=mysql_query("insert into group_accounts(account_id,group_id)values('$id','1')");

}else{
$row=mysql_fetch_array($r);
$id=$row['id'];


}
return $id;

}

function DebtSwap($date,$amount,$supplier){
$id= GetDebt();
$r=mysql_query("select * from dswap");
$row=mysql_fetch_array($r);
$number=$row['code'];
$_SESSION['SWAP']=$number;
$l=mysql_query("insert into debtswap(number,date,amount,supplier)values('$number',
'$date','$amount','$supplier')");
$session=session_id();
$f=mysql_query("insert into ledgers(account_id,froms,debit,date,session,amount)values('$supplier','$id','$date','$session','$amount')");
$f=mysql_query("insert into ledgers(account_id,froms,credit,date,session,amount)values('$id','$supplier','$date','$session','$amount')");
$r=mysql_query("update dswap set code=code+1");
$url='swapnotes.php';
session_regenerate_id();
ob_end_clean();
header("Location: $url");
}
function GetStock(){
$r=mysql_query("select * from accounts where name='STOCK'");
if(mysql_num_rows($r)==0){
$f=mysql_query("insert into accounts(name)values('STOCK')");
$id=mysql_insert_id();
$h=mysql_query("insert into group_accounts(account_id,group_id)values('$id','4')");

}else{
$row=mysql_fetch_array($r);
$id=$row['id'];


}
return $id;

}
function AddUser($name,$user,$pass1,$pass2,$dep,$level,$phone){
$name=mysql_real_escape_string($name);
$user=mysql_real_escape_string($user);
if($pass1==$pass2){
$okay=1;
}else{
$okay=0;
}
	UserAudit($_SESSION['user_id'],"Added User $name",date("Y/m/d"),$ip);
$r=mysql_query("select * from users where user_name='$user'");
if(mysql_num_rows($r)==0&&$okay==1){
$t=mysql_query("insert into users(name,user_name,password,level_id,department,phone)
values('$name','$user',SHA1('$pass1'),'$level','$dep','$phone')");
 echo '<span class="green">User Account Succesfully Created</span></br>';
}
if(mysql_num_rows($r)>0){
echo '<span class="red">That Username Is Already Registered</span></br>';
}
if($okay==0){
echo '<span class="red">Your Password Did Not Match</span></br>';}
}
function Supplier($id){
$t=mysql_query("select * from accounts where id='$id'");
$row=mysql_fetch_array($t);
$name=$row['name'];
return $name;

}

function AddYear($start,$end){
$name=mysql_real_escape_string($name);
$t=mysql_query("select * from financial_year where start between='$start' and '$end'");
if(mysql_num_rows($t)==0){
$y=mysql_query("insert into financial_year(start,end)
values('$start','$end')");


 echo '<span class="green">Financial Year Succesfully Added</span></br>';
}else{
 echo '<span class="red">Sorry Financial Year Cannot Be Created</span></br>';}

}

function AddSuppliers($name,$phone,$add){
$name=mysql_real_escape_string($name);
$t=mysql_query("select * from accounts where name='$name'");
if(mysql_num_rows($t)==0){
$y=mysql_query("insert into accounts(name,phone,address)
values('$name','$phone','$add')");
$id=mysql_insert_id();
$d=mysql_query("insert into group_accounts(account_id,group_id)values
('$id','2')");
 echo '<span class="green">Supplier Succesfully Added</span></br>';
}else{
 echo '<span class="red">Sorry supplier Already Exists</span></br>';}

}
function GetSALES(){
$r=mysql_query("select * from accounts where name='SALES'");
if(mysql_num_rows($r)==0){
$f=mysql_query("insert into accounts(name)values('SALES')");
$id=mysql_insert_id();
$h=mysql_query("insert into group_accounts(account_id,group_id)values('$id','3')");

}else{
$row=mysql_fetch_array($r);
$id=$row['id'];


}
return $id;

}
function GetDiscount(){
$r=mysql_query("select * from accounts where name='SALES DISCOUNT'");
if(mysql_num_rows($r)==0){
$f=mysql_query("insert into accounts(name)values('SALES DISCOUNT')");
$id=mysql_insert_id();
$h=mysql_query("insert into group_accounts(account_id,group_id)values('$id','1')");

}else{
$row=mysql_fetch_array($r);
$id=$row['id'];


}
return $id;

}
function GetCash(){
$r=mysql_query("select * from accounts where name='CASH'");
if(mysql_num_rows($r)==0){
$f=mysql_query("insert into accounts(name)values('CASH')");
$id=mysql_insert_id();
$h=mysql_query("insert into group_accounts(account_id,group_id)values('$id','4')");

}else{
$row=mysql_fetch_array($r);
$id=$row['id'];


}
return $id;

}
function GetTaxGoods(){
$r=mysql_query("select * from accounts where name='TAX ON GOODS'");
if(mysql_num_rows($r)==0){
$f=mysql_query("insert into accounts(name)values('TAX ON GOODS')");
$id=mysql_insert_id();
$h=mysql_query("insert into group_accounts(account_id,group_id)values('$id','1')");

}else{
$row=mysql_fetch_array($r);
$id=$row['id'];


}
return $id;

}
function GetCostG(){
$r=mysql_query("select * from accounts where name='COST OF GOODS SOLD'");
if(mysql_num_rows($r)==0){
$f=mysql_query("insert into accounts(name)values('COST OF GOODS SOLD')");
$id=mysql_insert_id();
$h=mysql_query("insert into group_accounts(account_id,group_id)values('$id','1')");

}else{
$row=mysql_fetch_array($r);
$id=$row['id'];


}
return $id;

}
function GetDamages(){
$r=mysql_query("select * from accounts where name='DAMAGES'");
if(mysql_num_rows($r)==0){
$f=mysql_query("insert into accounts(name)values('DAMAGES')");
$id=mysql_insert_id();
$h=mysql_query("insert into group_accounts(account_id,group_id)values('$id','1')");

}else{
$row=mysql_fetch_array($r);
$id=$row['id'];


}
return $id;

}
function BuysRec($buy,$rec,$sss,$cc,$session){

$t=mysql_query("insert into ledgers(credit,receipt,account_id,froms,session,date,description)values('$buy','$rec','$sss','$cc','$session',NOW(),'COST OF GOODS SOLD')");

$t=mysql_query("insert into ledgers(debit,account_id,froms,receipt,session,date,description)values('$buy','$cc','$sss','$rec','$session',NOW(),'COST OF GOODS SOLD')");


}
function DiscRec($buy,$rec,$sss,$cc,$session){

$t=mysql_query("insert into ledgers(credit,receipt,account_id,froms,session,date,description)values('$buy','$rec','$sss','$cc','$session',NOW(),'SALES DISCOUNT')");

$t=mysql_query("insert into ledgers(debit,account_id,froms,receipt,session,date,description)values('$buy','$cc','$sss','$rec','$session',NOW(),'SALES DISCOUNT')");


}
function Damaged($buy,$rec,$sss,$cc,$session){

$t=mysql_query("insert into ledgers(credit,receipt,account_id,froms,session,date,description)values('$buy','$rec','$sss','$cc','$session',NOW(),'COST OF GOODS DAMAGED')");

$t=mysql_query("insert into ledgers(debit,account_id,froms,receipt,session,date,description)values('$buy','$cc','$sss','$rec','$session',NOW(),'COST OF GOODS DAMAGED')");


}
function BuysRecC($buy,$rec,$sss,$cc,$session,$date){

$t=mysql_query("insert into ledgers(credit,receipt,account_id,froms,session,date,description)values('$buy','$rec','$sss','$cc','$session','$date','COST OF GOODS SOLD')");

$t=mysql_query("insert into ledgers(debit,account_id,froms,receipt,session,date,description)values('$buy','$cc','$sss','$rec','$session','$date','COST OF GOODS SOLD')");


}
function SalesRec($tor,$rec,$sl,$ch,$session){
	$t=mysql_query("insert into ledgers(credit,receipt,account_id,froms,session,date,description)values('$tor','$rec','$sl','$ch','$session',NOW(),'SALES')");

$t=mysql_query("insert into ledgers(debit,account_id,froms,receipt,session,date,description)values('$tor','$ch','$sl','$rec','$session',NOW(),'SALES')");


}
function SalesRecOthers($tor,$rec,$sl,$ch,$session,$desc){
	$t=mysql_query("insert into ledgers(credit,receipt,account_id,froms,session,date,description)values('$tor','$rec','$sl','$ch','$session',NOW(),'$desc')");

$t=mysql_query("insert into ledgers(debit,account_id,froms,receipt,session,date,description)values('$tor','$ch','$sl','$rec','$session',NOW(),'$desc')");


}
function SalesRecIN($tor,$rec,$sl,$ch,$session,$expected){
	$t=mysql_query("insert into ledgers(credit,invoice,account_id,froms,session,date,description,mat_date)values
	('$tor','$rec','$sl','$ch','$session',NOW(),'SALES VIA INVOICE','$expected')");

$t=mysql_query("insert into ledgers(debit,account_id,froms,invoice,session,date,description,mat_date)
values('$tor','$ch','$sl','$rec','$session',NOW(),'SALES VIA INVOICE','$expected')");


}
function SalesRecINC($tor,$rec,$sl,$ch,$session,$expected,$delivery){
	$t=mysql_query("insert into ledgers(credit,invoice,account_id,froms,session,date,description,mat_date)values
	('$tor','$rec','$sl','$ch','$session','$delivery','SALES VIA INVOICE','$expected')");

$t=mysql_query("insert into ledgers(debit,account_id,froms,invoice,session,date,description,mat_date)
values('$tor','$ch','$sl','$rec','$session','$delivery','SALES VIA INVOICE','$expected')");


}
function SalesRecINCD($tor,$rec,$sl,$ch,$session,$expected,$delivery,$number){
	$t=mysql_query("insert into ledgers(credit,receipt,account_id,froms,session,date,description,mat_date)values
	('$tor','$rec','$sl','$ch','$session','$delivery','SALES USING DEPOSIT SLIP $number','$expected')");

$t=mysql_query("insert into ledgers(debit,account_id,froms,receipt,session,date,description,mat_date)
values('$tor','$ch','$sl','$rec','$session','$delivery','SALES USING DEPOSIT SLIP $number','$expected')");


}
function PurchasesRecord($date,$CODE,$TOTALL,$session,$expected,$froms,$supplier){
$t=mysql_query("insert into ledgers(credit,invoice,froms,session,account_id,mat_date,description,date)values
('$TOTALL','$CODE','$froms','$session','$supplier','$expected','PURCHASES','$date')");

$t=mysql_query("insert into ledgers(debit,account_id,invoice,session,froms,mat_date,description,date)values('$TOTALL',
'$froms','$CODE','$session','$supplier','$expected','PURCHASES','$date')");


}
function PurchasesVat($date,$v,$vat,$kra,$CODE,$session){
$t=mysql_query("insert into ledgers(credit,invoice,froms,session,account_id,description,date)values('$vat','$CODE','$kra','$session','$v',
'PURCHASES VAT','$date')");

$t=mysql_query("insert into ledgers(debit,account_id,invoice,session,froms,description,date)values('$vat','$kra','$CODE','$session',
'$v','PURCHASES VAT','$date')");


}
function GetKra(){
$r=mysql_query("select * from accounts where name='K.R.A'");
if(mysql_num_rows($r)==0){
$f=mysql_query("insert into accounts(name)values('K.R.A')");
$id=mysql_insert_id();
$h=mysql_query("insert into group_accounts(account_id,group_id)values('$id','2')");

}else{
$row=mysql_fetch_array($r);
$id=$row['id'];


}
return $id;

}
function GetVat(){
$r=mysql_query("select * from accounts where name='VAT'");
if(mysql_num_rows($r)==0){
$f=mysql_query("insert into accounts(name)values('VAT')");
$id=mysql_insert_id();
$h=mysql_query("insert into group_accounts(account_id,group_id)values('$id','1')");

}else{
$row=mysql_fetch_array($r);
$id=$row['id'];


}
return $id;

}
function login($user,$pass){
$q =mysql_query( "SELECT *,user_id, user_name
 FROM users WHERE
 user_name='$user' AND password=SHA1('$pass')
");
if (mysql_num_rows($q) == 1) {
$row=mysql_fetch_array($q);
$_SESSION['user_id'] = $row['user_id'];
$_SESSION['user'] = $row['user_name'];
$_SESSION['name']=$row['name'];
$_SESSION['level']=$row['level_id'];
$_SESSION['department']=$row['department'];
if($_SESSION['department']==1){
$url='index.php';}
if($_SESSION['department']==2){
$url='indexxx.php';}
if($_SESSION['department']==3){
$url='indexx.php';

}
if($_SESSION['department']==4){
$url='module.php';

}
}else{
$_SESSION['login']='USERNAME & PASSWORD COMBINATIONS NOT VALID';
$url='login.php';
}

ob_end_clean();
header("Location: $url");
}
function  IncomePayments($customer,$payment,$date,$amount){
$session=session_id();
$r=mysql_query("insert into ledgers(credit,account_id,date,receipt,froms,session)values('$amount','$customer','$date','$invoice','$payment','$session')");

$r=mysql_query("insert into ledgers(debit,account_id,date,receipt,froms,session)values('$amount','$payment','$date','$invoice','$customer','$session')");
echo "<span class='green'>Debtor Payment Succesfull </span></br>";
session_regenerate_id();
}
function  IncomeRecorddC($income,$customer,$date,$amount,$invoice){
$session=session_id();
$r=mysql_query("insert into ledgers(credit,account_id,date,receipt,froms,session)values('$amount','$income','$date','$invoice','$customer','$session')");
//$f=mysql_query("insert into customer_ledgers(customer_id,date,credit,receipt,session)values('$income','$date','$amount','$invoice','$session')");
$r=mysql_query("insert into ledgers(debit,account_id,date,receipt,froms,session)values('$amount','$customer','$date','$invoice','$income','$session')");
echo "<span class='green'>Income Recording Succesfull </span></br>";
session_regenerate_id();
}
function  BasicSupplier($supplier,$ptype,$date,$amount,$tcode,$desc){
$desc=mysql_real_escape_string($desc);
$session=session_id();
$r=mysql_query("insert into ledgers(credit,account_id,date,receipt,froms,session,description)values('$amount','$ptype','$date','$tcode','$supplier','$session','$desc')");
//$f=mysql_query("insert into customer_ledgers(customer_id,date,credit,receipt,session)values('$income','$date','$amount','$invoice','$session')");
$r=mysql_query("insert into ledgers(debit,account_id,date,receipt,froms,session,description)values('$amount','$supplier','$date','$tcode','$ptype','$session','$desc')");
echo "<span class='green'>Supplier Payment Recording Succesfull </span></br>";
session_regenerate_id();
}
function AddCustomer($name,$phone,$add,$credit){
$name=mysql_real_escape_string($name);
$t=mysql_query("select * from accounts where name='$name'");
if(mysql_num_rows($t)==0){
$y=mysql_query("insert into accounts(name,phone,address)
values('$name','$phone','$add')");
$id=mysql_insert_id();
$d=mysql_query("insert into group_accounts(account_id,group_id)values
('$id','4')");
 echo '<span class="green">Customer Succesfully Added</span></br>';
}else{
 echo '<span class="red">Sorry Customer Already Exists</span></br>';}

}
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}


function teller($ip){

if($ip=='127.0.0.1'){
$teller='1';


}
if($ip=='192.168.0.101'){
$teller='2';


}
if($ip=='192.168.0.102'){
$teller='3';


}
if($ip=='192.168.0.103'){
$teller='4';


}
if($ip=='192.168.0.105'){
$teller='5';


}
if($ip=='192.168.0.104'){
$teller='6';


}
return $teller;}
function ReceiptOthers($receipt,$type,$bank,$number,$given){
	ini_set('display_errors', 0);
	$user=$_SESSION['user_name'];
ini_set('display_errors', 0);
include('mysql.php');
$te=type($type);
$r="select *,time(NOW()) as t from sales where number='$receipt'";
$sql=mysqli_query($dbc,$r);
$id = "javascript:Print('stylized')";
    echo '<body onload="' . $id . '"><div id="stylized">
             <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 25px">
               
                   <tr><td><center><img src="logo.jpg" width="550" height="100"/></center></td></tr>   
                   
                
                <tr><td ><h3><b><center>ABC SHOP</b></h3></td></tr>
				   <tr><td ><h3><b><center>PACEMART JUICES & CANDIES</b></h3></td></tr>
                 <tr><td colspan="2"><center>P.O BOX 7109-00300,NAIROBI TEL:0723 224 270</center></td></tr>
				 <tr><td colspan="2"><center>PIN: PO51449945S</center></td></tr>
									 <tr><td colspan="2"><center>RECEIPT :' . $receipt  . '</center></td></tr>			 		
				 <tr><td colspan="2"><center>Till: ' . $tiller . '</center></td></tr> 		
				 <tr><td colspan="2"><center>Date:' . (date("Y/m/d")) . '</center></td></tr>
				 <tr><th>
				<hr size="10" noshade>  </th>
				</tr></table>
				            <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;">
							 
                <tr><th width="420" style="font-size: 22px">ITEM</th><th width="20" style="font-size: 22px">QTY
				</th><th align="right" width="200" style="font-size: 22px">AMOUNT</th></tr>
				';
    $total = 0;
	$vat=0;
    while ($row = mysqli_fetch_array($sql)) {
        echo '<tr><td style="font-size: 22px">
		' . ($row['system']) . '</td><td></td><td style="font-size: 22px" align="right">' . ($row['qty']) . ' X ' . number_format($row['price'],2) . '</td><tr></tr>
		<tr><td style="font-size: 22px">' . (strtoupper($row['p_name'])) . '</td>
		<td style="font-size: 22px">
		</td><td align="right" style="font-size: 22px">' . number_format($row['total_p'],2) . '</td></tr></tr>';
        $total+=($row['total_p']);
		$vat+=$row['vat'];
		$qty+=$row['qty'];
		$time=$row['t'];
    }
	echo '<table width="550" style="font-family:Bell Gothic,Verdana,Arial;">
 
 
	
	 <tr><th style="font-size: 20px"><u>TOTAL QTY</th><th width="300" style="font-size: 20px">&nbsp;&nbsp;&nbsp;&nbsp;<u>VATABLE AMT </th><th style="font-size: 20px"><u>
VAT </th></tr>
 	 <tr><td style="font-size: 22px">&nbsp;&nbsp;'.$qty.'</td><td style="font-size: 22px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.number_format(($total*84/100)) .'</td><td style="font-size: 22px">&nbsp;&nbsp;&nbsp;'.number_format($vat) .'</th></tr>
   <tr><td></td><th style="font-size: 22px">TOTAL </th><td style="font-size: 22px"> ' . number_format($total, 2) . '</td></tr>';
   if($te=='CHEQUE'){
   echo'
   <tr><td></td><th style="font-size: 22px">PAYMENT TYPE</th><td style="font-size: 22px"> ' . $te . '</td></tr>
      <tr><td></td><th style="font-size: 22px">BANK </th><td style="font-size: 22px"> ' . $bank. '</td></tr>
   <tr><td></td><th style="font-size: 22px">CHEQUE NO </th><td style="font-size: 22px"> ' . $number. '</td></tr>
   <tr><td></td><th style="font-size: 22px">AMOUNT</th><td style="font-size: 22px"> ' .number_format($given). '</td></tr>';}
   if($te=='CREDIT NOTES'){
   echo'
   <tr><td></td><th style="font-size: 22px">PAYMENT TYPE</th><td style="font-size: 22px"> ' . $te . '</td></tr>

   <tr><td></td><th style="font-size: 22px">AMOUNT</th><td style="font-size: 22px"> ' .number_format($given). '</td></tr>';}
    if($te=='MPESA'){
   echo'
   <tr><td></td><th style="font-size: 22px">PAYMENT TYPE</th><td style="font-size: 22px"> ' . $te . '</td></tr>
      <tr><td></td><th style="font-size: 22px">CODE</th><td style="font-size: 22px"> ' . $number. '</td></tr>
   <tr><td></td><th style="font-size: 22px">AMOUNT </th><td style="font-size: 22px"> ' . number_format($given). '</td></tr>';}?><? echo '
    <tr><th><hr style="border-top: dotted 3px;" /></th>
				 <th><hr style="border-top: dotted 3px;" /></th><th>
				 <hr style="border-top: dotted 3px;" /></th><th><hr style="border-top: dotted 3px;" /></th></tr>
				 <tr><th>
				<hr size="10"  noshade>  </th><th>
				<hr size="10"  noshade>  </th><th>
				<hr size="10"  noshade> </th><th>
				</tr></table>
				 <table width="550" style="font-family:Bell Gothic,Verdana,Arial;">
                <tr><td  style="font-size: 22px"><center>You were served by:' . ($user) . ' at '.$time.'</center></td></tr>
				<tr><th  style="font-size: 22px"><center>Thank for shopping with us</center></th></tr>
			
				 <tr><th><hr style="border-top: dotted 3px;" /></th>
				 <th><hr style="border-top: dotted 3px;" /></th><th>
				 <hr style="border-top: dotted 3px;" /></th><th><hr style="border-top: dotted 3px;" /></th></tr>
				 <tr><td><h4></h4></td></tr>
				<tr><td style="font-size: 17px"> <div align="center"><b>GOODS ONCE SOLD CANNOT BE RE-ACCEPTED<td></div></tr>
        </div></table>            
</div><input type="submit" name="btnPrint" value="print" asp:Button ID="btnPrint" runat="server" onclick="' . $id . '"/></body>';
 session_regenerate_id();

}
function DepositSlip($type,$number){
	ini_set('display_errors', 0);
	$user=$_SESSION['user'];


$te=type($type);
$r=mysql_query("select *,time(NOW()) as t from deposits where number='$number'");
$row=mysql_fetch_array($r);
$id = "javascript:Print('stylized')";
    echo '<body onload="' . $id . '"><div id="stylized">
            <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 25px">
                   
                
                   
                
              
				   <tr><td ><h3><b><center>PACEMART JUICES & CANDIES</b></h3></td></tr>
                 <tr><td colspan="2"><center>P.O BOX 7109-00300,NAIROBI TEL:0723 224 270</center></td></tr>
				 <tr><td colspan="2" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px"><center>SLIP NO '.$number.'</center></td></tr>
				 <tr><td colspan="2" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px"><center>DEPOSIT SLIP GENERATED BY '.$user.'  </center></td></tr>
				  <tr><td colspan="2" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 20px"><center>GENERATION  TIME '.$row['t'].'</center></td></tr>
				 <tr><td colspan="2" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 18px"><left>CLIENT NAME <u>'.$row['name'].'</center></td></tr>
				  <tr><td colspan="2" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 18px"><left>CLIENT PHONE <u>'.$row['phone'].' </center></td></tr>
				   <tr><td colspan="2" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 18px"><left>CLIENT  ID NO <u>'.$row['id_no'].' </center></td></tr>
				 <tr><td colspan="2" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 18px"><left>Date:' . (date("Y/m/d")) . '</center></td></tr>
				 	 <tr><td colspan="2" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 15px"><center><u>*OFFICIAL ID IS NEEDED DURING REDEEMING OF THIS SLIP*</center></td></tr>
					 <tr><td colspan="2" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 15px"><center><b>*THIS IS NOT A RECEIPT*</b></center></td></tr>
<tr><th>
				<hr size="10" noshade> </hr> </th>
			
			
				</tr></table>
				            <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;">
							
				   </table>
<table width="550" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 25px">
<tr><td><b>NARRATION</td><td><b></th><td><b>AMOUNT</td></tr>';

echo '<tr>
<td style="font-size: 22px">CUSTOMER DEPOSITS</td><td style="font-size: 22px"></td>
<td style="font-size: 22px">' . number_format(($row['amount'])) . '</td>
</tr>';


echo '<tr>
<td style="font-size: 22px"><b>TOTAL</td><td style="font-size: 22px"></td>
<td style="font-size: 22px"><b>' . number_format(($row['amount'])) . '</td>
</tr>';
echo'<tr><th>
				<hr size="10" noshade>  </hr></th><th>
				<hr size="10" noshade> </hr> </th>
				<th>
				<hr size="10" noshade>  </hr></th>
				<th>
				<hr size="10" noshade>  </hr></th>
				</tr>';
              echo'

<tr><th> 
				<hr size="10" noshade>  </hr></th><th>
				<hr size="10" noshade> </hr> </th>
				<th>
				<hr size="10" noshade>  </hr></th>
				<th>
				<hr size="10" noshade>  </hr></th>
				</tr>	  </table>
				
				
				<br><br>
			   </div><input type="submit" name="btnPrint" value="print" asp:Button ID="btnPrint" runat="server" onclick="' . $id . '"/></body>';
 session_regenerate_id();

}
function type($id){
if($id==1){
$type='MPESA';}
if($id==2){
$type='CREDIT NOTES';}

if($id==3){
$type='CHEQUE';}
return $type;


}
function CXreport($user,$till,$cash,$credit,$mpesa,$cheque,$session,$float,$picked,$petty){
include('conf.php');

$r=mysql_query("select * ,time(NOW())as f from user_audit where date=date(NOW())
 and user='$user'
 and till='$till'
 and status='ACTIVE' order by id desc limit 1");

 $row=mysql_fetch_array($r);
 $time=$row['f'];
$gh=$time;
 $t=mysql_query("insert into cash_pick(user,time,date,till,amountt,actual,type,session)
 values('$user',NOW(),NOW(),'$till','$float','3000','FLOAT','$session')");
  $l=mysql_query("select sum(cash)as a from cpick where till='$till' and date=date(NOW())");

 $lol=mysql_fetch_array($l);
 $actual=$lol['a'];
 $t=mysql_query("insert into cash_pick(user,time,date,till,amountt,actual,type,session)
 values('$user',NOW(),NOW(),'$till','$picked','$actual','CASH PICKED','$session')");
   $l=mysql_query("select sum(amount)as a from petty where till='$till' and date=date(NOW())");

 $lol=mysql_fetch_array($l);
 $actual=$lol['a'];
 $t=mysql_query("insert into cash_pick(user,time,date,till,amountt,actual,type,session)
 values('$user',NOW(),NOW(),'$till','$petty','$actual','PETTY CASH','$session')");
 $l=mysql_query("select sum(amount)as a from x_report where till='$till' 
 and date=date(NOW()) and type='CASH' and status='ACTIVE'");

 $lol=mysql_fetch_array($l);
 $actual=$lol['a'];
  $l=mysql_query("select sum(amount)as a from x_report where till='$till' and date=date(NOW()) 
  and type='CREDIT NOTES' and status='ACTIVE'");

 $lol=mysql_fetch_array($l);
 $actua=$lol['a'];
 $actuall=$actual+$actua;
 $t=mysql_query("insert into cash_pick(user,time,date,till,amountt,actual,type,session)
 values('$user',NOW(),NOW(),'$till','$cash','$actuall','CASH','$session')");
  $l=mysql_query("select sum(amount)as a from x_report where till='$till' and date=date(NOW()) 
  and type='CREDIT NOTES' and status='ACTIVE'");

 $lol=mysql_fetch_array($l);
 $actual=$lol['a'];
 $t=mysql_query("insert into cash_pick(user,time,date,till,amountt,actual,type,session)
 values('$user',NOW(),NOW(),'$till','$credit','$actual','CREDIT NOTES','$session')");
  $l=mysql_query("select sum(amount)as a from x_report where till='$till' and date=date(NOW()) and type='MPESA' and status='ACTIVE'");

 $lol=mysql_fetch_array($l);
 $actual=$lol['a'];
 $t=mysql_query("insert into cash_pick(user,time,date,till,amountt,actual,type,session)
 values('$user',NOW(),NOW(),'$till','$mpesa','$actual','MPESA','$session')");
  $l=mysql_query("select sum(amount)as a from x_report where till='$till' and date=date(NOW()) and type='CHEQUES' and status='ACTIVE'");

 $lol=mysql_fetch_array($l);
 $actual=$lol['a'];
 $t=mysql_query("insert into cash_pick(user,time,date,till,amountt,actual,type,session)
 values('$user',NOW(),NOW(),'$till','$cheque','$actual','CHEQUES','$session')");


 $y=mysql_query("select * from cash_pick where  till='$till' and session='$session' and
 date=date(NOW())");

 
 
 $f=mysql_query("update x_report set status='NOT ACTIVE' where  date=date(NOW()) and status='ACTIVE' and till='$till'");
 $id = "javascript:Print('stylized')";
    echo '<body onload="' . $id . '"><div id="stylized">
            <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 25px">
                   
                
                   
                
                <tr><td ><h3><b><center>ABC SHOP</b></h3></td></tr>
				   <tr><td ><h3><b><center>PACEMART JUICES & CANDIES</b></h3></td></tr>
                 <tr><td colspan="2"><center>P.O BOX 7109-00300,NAIROBI TEL:0723 224 270</center></td></tr>
				 <tr><td colspan="2"><center>Z-REPORT GENERATED BY '.$user.' FOR Till '.$till.' AT '.$time.'</center></td></tr>
				 <tr><td colspan="2"><center>Date:' . (date("Y/m/d")) . '</center></td></tr>
<tr><th>
				<hr size="10" noshade> </hr> </th>
			
			
				</tr></table>
				            <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;">
							
				   <tr><td></td><th style="font-size: 22px">Generation Time </th><td style="font-size: 22px"> ' .$time . '</td>
				   </tr></table>
<table width="550" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 25px">
<tr><td><b>TYPE</td><td><b>SYSTEM</th><td><b>ACTUAL</td><td><b>VARIATION</td></tr>';
while($row=mysql_fetch_array($y)){
echo '<tr>
<td style="font-size: 22px">' . (($row['TYPE'])) . '</td>
<td style="font-size: 22px">' . number_format(($row['actual'])) . '</td>
<td style="font-size: 22px">' . number_format(($row['amountt'])) . '</td>
<td style="font-size: 22px">' . number_format(($row['amountt']-$row['actual'])) . '</td></tr>';
$totali+=($row['amountt']-$row['actual']);
$actuali+=$row['amountt'];
$systemi+=$row['actual'];

}echo '<tr>
<td style="font-size: 22px"><b>TOTAL</td>
<td style="font-size: 22px"><b>' . number_format(($systemi)) . '</td>
<td style="font-size: 22px"><b>' . number_format(($actuali)) . '</td>
<td style="font-size: 22px"><b>' . number_format(($totali)) . '</td></tr>';
echo'<tr><th>
				<hr size="10" noshade>  </hr></th><th>
				<hr size="10" noshade> </hr> </th><th>
				<hr size="10" noshade>  </hr></th>
				<th>
				<hr size="10" noshade>  </hr></th>
				</tr>';
              echo'<tr><td> TOTAL VAT</td><td style="font-size: 22px"><b>:' . number_format(vatZ($till)). '</td></tr>
<tr><td>TOTAL CUSTOMERS</td><td style="font-size: 22px"><b>:' . number_format(CustomersTill($till)) . '</td></tr> 
<tr><th>
				<hr size="10" noshade>  </hr></th><th>
				<hr size="10" noshade> </hr> </th><th>
				<hr size="10" noshade>  </hr></th>
				<th>
				<hr size="10" noshade>  </hr></th>
				</tr>	  </table><br><br>
			   </div><input type="submit" name="btnPrint" value="print" asp:Button ID="btnPrint" runat="server" onclick="' . $id . '"/></body>';
 
 
}
function CXreportU($user,$till,$cash,$credit,$mpesa,$cheque,$session,$float,$picked,$petty,$u){
include('conf.php');

$r=mysql_query("select * ,time(NOW())as f from user_audit where date=date(NOW())
 and user='$user'
 and till='$till'
 and status='ACTIVE' order by id desc limit 1");

 $row=mysql_fetch_array($r);
 $time=$row['f'];
$gh=$time;
 $t=mysql_query("insert into cash_pick(user,time,date,till,amountt,actual,type,session,userr)
 values('$user',NOW(),NOW(),'$till','$float','3000','FLOAT','$session','$u')");
  $l=mysql_query("select sum(cash)as a from cpick where userr='$u' and date=date(NOW())");

 $lol=mysql_fetch_array($l);
 $actual=$lol['a'];
 $t=mysql_query("insert into cash_pick(user,time,date,till,amountt,actual,type,session,userr)
 values('$user',NOW(),NOW(),'$till','$picked','$actual','CASH PICKED','$session','$u')");
   $l=mysql_query("select sum(amount)as a from petty where userr='$u' and date=date(NOW())");

 $lol=mysql_fetch_array($l);
 $actual=$lol['a'];
 $t=mysql_query("insert into cash_pick(user,time,date,till,amountt,actual,type,session,userr)
 values('$user',NOW(),NOW(),'$till','$petty','$actual','PETTY CASH','$session','$u')");
 $l=mysql_query("select sum(amount)as a from x_report where user='$u' and till='$till'  
 and date=date(NOW()) and type='CASH' and status='ACTIVE'");

 $lol=mysql_fetch_array($l);
 $actual=$lol['a'];
  $l=mysql_query("select sum(amount)as a from x_report where user='$u' and till='$till' and date=date(NOW()) 
  and type='CREDIT NOTES' and status='ACTIVE'");

 $lol=mysql_fetch_array($l);
 $actua=$lol['a'];
 $actuall=$actual+$actua;
 $t=mysql_query("insert into cash_pick(user,time,date,till,amountt,actual,type,session,userr)
 values('$user',NOW(),NOW(),'$till','$cash','$actuall','CASH','$session','$u')");
  $l=mysql_query("select sum(amount)as a from x_report where user='$u' and till='$till'  and date=date(NOW()) 
  and type='CREDIT NOTES' and status='ACTIVE'");

 $lol=mysql_fetch_array($l);
 $actual=$lol['a'];
 $t=mysql_query("insert into cash_pick(user,time,date,till,amountt,actual,type,session,userr)
 values('$user',NOW(),NOW(),'$till','$credit','$actual','CREDIT NOTES','$session','$u')");
  $l=mysql_query("select sum(amount)as a from x_report where user='$u' and till='$till' and date=date(NOW()) and type='MPESA' and status='ACTIVE'");

 $lol=mysql_fetch_array($l);
 $actual=$lol['a'];
 $t=mysql_query("insert into cash_pick(user,time,date,till,amountt,actual,type,session,userr)
 values('$user',NOW(),NOW(),'$till','$mpesa','$actual','MPESA','$session','$u')");
  $l=mysql_query("select sum(amount)as a from x_report where user='$u' and till='$till'  and date=date(NOW()) and type='CHEQUES' and status='ACTIVE'");

 $lol=mysql_fetch_array($l);
 $actual=$lol['a'];
 $t=mysql_query("insert into cash_pick(user,time,date,till,amountt,actual,type,session,userr)
 values('$user',NOW(),NOW(),'$till','$cheque','$actual','CHEQUES','$session','$u')");


 $y=mysql_query("select * from cash_pick where  userr='$u' and till='$till'  and session='$session' and
 date=date(NOW())");

 
 
 $f=mysql_query("update x_report set status='NOT ACTIVE' where  date=date(NOW()) and status='ACTIVE' and user='$u'");
 $id = "javascript:Print('stylized')";
    echo '<body onload="' . $id . '"><div id="stylized">
            <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 25px">
                   
                
                   
                
                <tr><td ><h3><b><center>ABC SHOP</b></h3></td></tr>
				   <tr><td ><h3><b><center>PACEMART JUICES & CANDIES</b></h3></td></tr>
                 <tr><td colspan="2"><center>P.O BOX 7109-00300,NAIROBI TEL:0723 224 270</center></td></tr>
				 <tr><td colspan="2"><center>Z-REPORT GENERATED BY '.$user.' FOR CASHIER '.$u.' @ Till '.$till.' AT '.$time.'</center></td></tr>
				 <tr><td colspan="2"><center>Date:' . (date("Y/m/d")) . '</center></td></tr>
<tr><th>
				<hr size="10" noshade> </hr> </th>
			
			
				</tr></table>
				            <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;">
							
				   <tr><td></td><th style="font-size: 22px">Generation Time </th><td style="font-size: 22px"> ' .$time . '</td>
				   </tr></table>
<table width="550" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 25px">
<tr><td><b>TYPE</td><td><b>SYSTEM</th><td><b>ACTUAL</td><td><b>VARIATION</td></tr>';
while($row=mysql_fetch_array($y)){
echo '<tr>
<td style="font-size: 22px">' . (($row['TYPE'])) . '</td>
<td style="font-size: 22px">' . number_format(($row['actual'])) . '</td>
<td style="font-size: 22px">' . number_format(($row['amountt'])) . '</td>
<td style="font-size: 22px">' . number_format(($row['amountt']-$row['actual'])) . '</td></tr>';
$totali+=($row['amountt']-$row['actual']);
$actuali+=$row['amountt'];
$systemi+=$row['actual'];

}echo '<tr>
<td style="font-size: 22px"><b>TOTAL</td>
<td style="font-size: 22px"><b>' . number_format(($systemi)) . '</td>
<td style="font-size: 22px"><b>' . number_format(($actuali)) . '</td>
<td style="font-size: 22px"><b>' . number_format(($totali)) . '</td></tr>';
echo'<tr><th>
				<hr size="10" noshade>  </hr></th><th>
				<hr size="10" noshade> </hr> </th><th>
				<hr size="10" noshade>  </hr></th>
				<th>
				<hr size="10" noshade>  </hr></th>
				</tr>';
              echo'<tr><td> TOTAL VAT</td><td style="font-size: 22px"><b>:' . number_format(vatZ($till)). '</td></tr>
<tr><td>TOTAL CUSTOMERS</td><td style="font-size: 22px"><b>:' . number_format(CustomersTill($till)) . '</td></tr> 
<tr><th>
				<hr size="10" noshade>  </hr></th><th>
				<hr size="10" noshade> </hr> </th><th>
				<hr size="10" noshade>  </hr></th>
				<th>
				<hr size="10" noshade>  </hr></th>
				</tr>	  </table><br><br>
			   </div><input type="submit" name="btnPrint" value="print" asp:Button ID="btnPrint" runat="server" onclick="' . $id . '"/></body>';
 
 
}
function receiptCount(){
include('conf.php');
$r=mysql_query("select distinct(number) from sales where month(date)=month(NOW())");

$number=mysql_num_rows($r);
return $number;

}
function buyingP($code){
require_once('conf.php');
$r=mysql_query("select * from products where code='$code'");

$row=mysql_fetch_array($r);
$buying=$row['buying'];
return $buying;

}
function Vat($code){
require_once('conf.php');
$r=mysql_query("select * from products where code='$code'");

$row=mysql_fetch_array($r);
$buying=$row['vat'];
return $buying;

}
function CreditNote($credit,$receipt){
include('mysql.php');
$s="select * from return_in where receipt='$receipt' and credit='$credit'";
$sql=mysqli_query($dbc,$s);
$id = "javascript:Print('stylized')";
    echo '<body onload="' . $id . '"><div id="stylized">
             <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 25px">
               
                   <tr><td><center><img src="logo.jpg" width="550" height="100"/></center></td></tr>   
                   
                
                
				   <tr><td ><h3><b><center>PACEMART JUICES & CANDIES</b></h3></td></tr>
                 <tr><td colspan="2"><center>P.O BOX 7109-00300,NAIROBI TEL:0723 224 270</center></td></tr>
				 <tr><td colspan="2"><center>PIN: PO51449945S</center></td></tr>
			
									 <tr><td colspan="2"><center>CREDIT NOTE #:: '.$credit.'</center></td></tr>			 		
						
				 <tr><td colspan="2"><center>Date:' . (date("Y/m/d")) . '</center></td></tr>
				 <tr><th>
				<hr size="10" noshade>  </th>
				</tr></table>
				            <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;">
							 
                <tr><th width="420" style="font-size: 22px">ITEM</th><th width="30" style="font-size: 22px">QTY
				</th><th width="30" style="font-size: 22px">PRICE
				</th><th align="right" width="200" style="font-size: 22px">AMOUNT</th></tr>';
   while ($row = mysqli_fetch_array($sql)) {
        echo '<tr>
		<td style="font-size: 22px">' . (strtoupper($row['product'])) . '</td>
		<td style="font-size: 22px">' . (($row['qty'])) . '</td>
				<td style="font-size: 22px">' . (number_format($row['price'])) . '</td>
		<td align="right" style="font-size: 22px">' . number_format($row['total_p'],2) . '</td></tr>';
        $total+=($row['total_p']);
		$qty=+$row['qty'];
		
    } echo'		<tr><th>
				<hr size="10" noshade>  </th><th>
				<hr size="10" noshade>  </th><th>
				<hr size="10" noshade>  </th>
				</tr>';
	 echo '<tr>
		<td style="font-size: 22px"><b>TOTAL</td>
		<td style="font-size: 22px"><b>' . (($qty)) . '</td>
		<td align="right" style="font-size: 22px"><b>' . number_format($total,2) . '</td></tr>';
		echo'<tr><th>
				<hr size="10" noshade>  </th><th>
				<hr size="10" noshade>  </th><th>
				<hr size="10" noshade>  </th>
				</tr>';
		echo '</table>  
 <div align="left"><b>CREDIT NOTE IS VALID FOR 90 DAYS ONLY FROM ' . (date("Y/m/d")) . '</h4></center></div>	
</div><input type="submit" name="btnPrint" value="print" asp:Button ID="btnPrint" runat="server" onclick="' . $id . '"/></body>';
}
function DebitNote($credit,$receipt,$supplier){
include('mysql.php');
$s="select * from return_out
inner join products on products.product_id=return_out.product_id where receipt='$receipt' and credit='$credit'";
$sql=mysqli_query($dbc,$s);
$id = "javascript:Print('stylized')";
    echo '<body onload="' . $id . '"><div id="stylized">
             <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 25px">
               
                   <tr><td><center><img src="logo.jpg" width="550" height="100"/></center></td></tr>   
                   
                
              
				   <tr><td ><h3><b><center>PACEMART JUICES & CANDIES</b></h3></td></tr>
                 <tr><td colspan="2"><center>P.O BOX 7109-00300,NAIROBI TEL:0723 224 270</center></td></tr>
				 <tr><td colspan="2"><center>PIN: PO51449945S</center></td></tr>
									 <tr><td colspan="2"><center>DEBIT NOTE #:: '.$credit.'</center></td></tr>			 		
									 <tr><td colspan="2"><center>SUPPLIER #:: '.$supplier.'</center></td></tr>	
				 <tr><td colspan="2"><center>Date:' . (date("Y/m/d")) . '</center></td></tr>
				 <tr><th>
				<hr size="10" noshade>  </th>
				</tr></table>
				            <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;">
							 
                <tr><th width="420" style="font-size: 22px">ITEM</th><th width="30" style="font-size: 22px">QTY
				</th><th align="right" width="200" style="font-size: 22px">AMOUNT</th></tr>';
   while ($row = mysqli_fetch_array($sql)) {
        echo '<tr>
		<td style="font-size: 22px">' . (strtoupper($row['p_name'])) . '</td>
		<td style="font-size: 22px">' . (($row['qty'])) . '</td>
		<td align="right" style="font-size: 22px">' . number_format($row['total_p'],2) . '</td></tr>';
        $total+=($row['total_p']);
		$qty=+$row['qty'];
		
    } echo'<tr><th>
				<hr size="10" noshade>  </th><th>
				<hr size="10" noshade>  </th><th>
				<hr size="10" noshade>  </th>
				</tr>';
	 echo '<tr>
		<td style="font-size: 22px"><b>TOTAL</td>
		<td style="font-size: 22px"><b>' . (($qty)) . '</td>
		<td align="right" style="font-size: 22px"><b>' . number_format($total,2) . '</td></tr>';
		echo'<tr><th>
				<hr size="10" noshade>  </th><th>
				<hr size="10" noshade>  </th><th>
				<hr size="10" noshade>  </th>
				</tr>';
		echo '</table>            
</div><input type="submit" name="btnPrint" value="print" asp:Button ID="btnPrint" runat="server" onclick="' . $id . '"/></body>';
}
function SwaNote($credit){
include('mysql.php');
$s="select * from debtswap where number='$credit'";
$sql=mysqli_query($dbc,$s);
$row=mysqli_fetch_array($sql);
$amount=$row['amount'];
$supplier=$row['supplier'];
$id = "javascript:Print('stylized')";
    echo '<body onload="' . $id . '"><div id="stylized">
             <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 25px">
               
                   <tr><td><center><img src="logo.jpg" width="550" height="100"/></center></td></tr>   
                   
                
              
				   <tr><td ><h3><b><center>PACEMART JUICES & CANDIES</b></h3></td></tr>
                 <tr><td colspan="2"><center>P.O BOX 7109-00300,NAIROBI TEL:0723 224 270</center></td></tr>
				 <tr><td colspan="2"><center>PIN: PO51449945S</center></td></tr>
									 <tr><td colspan="2"><center>CREDIT NOTE #:: '.$credit.'</center></td></tr>			 		
									 <tr><td colspan="2"><center>SUPPLIER #:: '.Mode($supplier).'</center></td></tr>	
				 <tr><td colspan="2"><center>Date:' . (date("Y/m/d")) . '</center></td></tr>
				 <tr><th>
				<hr size="10" noshade>  </th>
				</tr></table>
				            <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;">';
							 
 echo'<tr><th>
				<hr size="10" noshade>  </th><th>
				<hr size="10" noshade>  </th><th>
				<hr size="10" noshade>  </th>
				</tr>';
	 echo '<tr>
		<td style="font-size: 22px"><b>TOTAL VALUE</td>
		<td style="font-size: 22px"><b></td>
		<td align="right" style="font-size: 22px"><b>' . number_format($amount,2) . '</td></tr>';
		echo'<tr><th>
				<hr size="10" noshade>  </th><th>
				<hr size="10" noshade>  </th><th>
				<hr size="10" noshade>  </th>
				</tr>';
		echo '</table>            
</div><input type="submit" name="btnPrint" value="print" asp:Button ID="btnPrint" runat="server" onclick="' . $id . '"/></body>';
}
function mpesaR($code,$amount,$receipt,$type){
	$user=$_SESSION['user'];
ini_set('display_errors', 0);
include('mysql.php');
$ip=get_client_ip() ;
		$tiller=teller($ip);
$r="select *,time(NOW()) as t from sales where number='$receipt'";
$sql=mysqli_query($dbc,$r);

$id = "javascript:Print('stylized')";
    echo '<body onload="' . $id . '"><div id="stylized">
	
            <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 25px">
               
                   <tr><td><center><img src="logo.jpg" width="550" height="100"/></center></td></tr>   
                   
                
				   <tr><td ><h3><b><center>PACEMART JUICES & CANDIES</b></h3></td></tr>
                 <tr><td colspan="2"><center>P.O BOX 7109-00300,NAIROBI TEL:0723 224 270</center></td></tr>
				 <tr><td colspan="2"><center>PIN: PO51449945S</center></td></tr>
							
	<tr><td colspan="2"><center>RECEIPT NO:# '.$receipt.'</tD></tr>									 
				 <tr><td colspan="2"><center>Till: ' . $tiller . '</center></td></tr> 		
				 <tr><td colspan="2"><center>Date:' . (date("Y/m/d")) . '</center></td></tr>
				 <tr><th>
				<hr size="10" noshade>  </th>
				</tr></table>
				            <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;">
							 
                <tr><th width="420" style="font-size: 22px">ITEM</th><th width="30" style="font-size: 22px">QTY
				</th><th align="right" width="200" style="font-size: 22px">AMOUNT</th></tr>
				';
    $total = 0;
	$vat=0;
      while ($row = mysqli_fetch_array($sql)) {
        echo '<tr><td style="font-size: 22px">' . (strtoupper($row['p_name'])) . '
		</td><td></td><td style="font-size: 22px" align="right">' . ($row['qty']) . ' X ' . number_format($row['price'],2) . '</td><tr></tr>
		<tr><td style="font-size: 22px"></td>
		<td style="font-size: 22px">
		</td><td align="right" style="font-size: 22px">' . number_format($row['total_p'],2) . '</td></tr></tr>';
        $total+=($row['total_p']);
		$vat+=$row['vat'];
		$qty+=$row['qty'];
		$time=$row['t'];

}
echo '</table><br><br>';
	echo '<table style="font-family:Bell Gothic,Verdana,Arial;">
   <tr><th>
				<hr size="10"  noshade>  </th><th>
				<hr size="10"  noshade>  </th><th>
				<hr size="10"  noshade> </th><th>
				</tr>

	
	 <tr><th style="font-size: 20px"><u>QTY</th><th width="300" 
	 style="font-size: 20px">&nbsp;&nbsp;&nbsp;&nbsp;<u>VATABLE AMT </th><th style="font-size: 20px"><u>
VAT </th></tr>
 	 <tr><td style="font-size: 22px">&nbsp;&nbsp;'.$qty.'</td>
	 <td style="font-size: 22px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 '.number_format(($total-$vat)) .'</td><td style="font-size: 22px">&nbsp;&nbsp;&nbsp;'.number_format($vat) .'</th></tr>
   <tr><td></td><th style="font-size: 22px">TOTAL </th><td style="font-size: 22px"> ' . number_format($total, 2) . '</td></tr>
   <tr><td></td><th style="font-size: 22px">'.$type.' AMOUNT</th><td style="font-size: 22px"> ' . number_format($amount, 2) . '</td></tr>
   <tr><td></td><th style="font-size: 22px">TRANSACTION CODE</th><td style="font-size: 22px"> ' .($code) . '</td></tr>

	 	 <tr><td></td><th style="font-size: 22px">CHANGE</th><td style="font-size: 22px"> ' . number_format($amount-$total, 2) . '</td></tr>
	<tr><th>
				<hr size="10"  noshade>  </th><th>
				<hr size="10"  noshade>  </th><th>
				<hr size="10"  noshade> </th><th>
				</tr>
    </table>
				 <table width="550" style="font-family:Bell Gothic,Verdana,Arial;">
                <tr><td  style="font-size: 22px"><center>You were served by:' . ($user) . ' at '.$time.'</center></td></tr>
				<tr><th  style="font-size: 22px"><center>Thankyou for shopping with us</center></th></tr>
			
				 <tr><th>
				<hr size="10"  noshade>  </th><th>
				
				</tr>
				 <tr><td><h4></h4></td></tr>
				<tr><td style="font-size: 17px"> <div align="center"><b>GOODS ONCE SOLD CANNOT BE RE-ACCEPTED<td></div></tr>
				
				
        </div></table>            
</div><input type="submit" name="btnPrint" value="print" asp:Button ID="btnPrint" runat="server" onclick="' . $id . '"/></body>';
 session_regenerate_id();
 }
 function swap($code,$amount,$receipt){
	$user=$_SESSION['user'];
ini_set('display_errors', 0);
include('mysql.php');
$ip=get_client_ip() ;
		$tiller=teller($ip);
$r="select *,time(NOW()) as t from sales where number='$receipt'";
$sql=mysqli_query($dbc,$r);

$id = "javascript:Print('stylized')";
    echo '<body onload="' . $id . '"><div id="stylized">
	
            <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 25px">
               
                   <tr><td><center><img src="logo.jpg" width="550" height="100"/></center></td></tr>   
                   
                
				   <tr><td ><h3><b><center>PACEMART JUICES & CANDIES</b></h3></td></tr>
                 <tr><td colspan="2"><center>P.O BOX 7109-00300,NAIROBI TEL:0723 224 270</center></td></tr>
				 <tr><td colspan="2"><center>PIN: PO51449945S</center></td></tr>
									 <tr><td colspan="2"><center>#:' . receiptCount()  . '</center></td></tr>			 		
				 <tr><td colspan="2"><center>Till: ' . $tiller . '</center></td></tr> 		
				 <tr><td colspan="2"><center>Date:' . (date("Y/m/d")) . '</center></td></tr>
				 <tr><th>
				<hr size="10" noshade>  </th>
				</tr></table>
				            <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;">
							 
                <tr><th width="420" style="font-size: 22px">ITEM</th><th width="30" style="font-size: 22px">QTY
				</th><th align="right" width="200" style="font-size: 22px">AMOUNT</th></tr>
				';
    $total = 0;
	$vat=0;
      while ($row = mysqli_fetch_array($sql)) {
        echo '<tr><td style="font-size: 22px">
		' . ($row['system']) . '</td><td></td><td style="font-size: 22px" align="right">' . ($row['qty']) . ' X ' . number_format($row['price'],2) . '</td><tr></tr>
		<tr><td style="font-size: 22px">' . (strtoupper($row['p_name'])) . '</td>
		<td style="font-size: 22px">
		</td><td align="right" style="font-size: 22px">' . number_format($row['total_p'],2) . '</td></tr></tr>';
        $total+=($row['total_p']);
		$vat+=$row['vat'];
		$qty+=$row['qty'];
		$time=$row['t'];

}
echo '</table><br><br>';
	echo '<table style="font-family:Bell Gothic,Verdana,Arial;">
   <tr><th>
				<hr size="10"  noshade>  </th><th>
				<hr size="10"  noshade>  </th><th>
				<hr size="10"  noshade> </th><th>
				</tr>

	
	 <tr><th style="font-size: 20px"><u>TOTAL QTY</th><th width="300" 
	 style="font-size: 20px">&nbsp;&nbsp;&nbsp;&nbsp;<u>VATABLE AMT </th><th style="font-size: 20px"><u>
VAT </th></tr>
 	 <tr><td style="font-size: 22px">&nbsp;&nbsp;'.$qty.'</td>
	 <td style="font-size: 22px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 '.number_format(($total*84/100)) .'</td><td style="font-size: 22px">&nbsp;&nbsp;&nbsp;'.number_format($vat) .'</th></tr>
   <tr><td></td><th style="font-size: 22px">TOTAL </th><td style="font-size: 22px"> ' . number_format($total, 2) . '</td></tr>
   <tr><td></td><th style="font-size: 22px">SWAP AMOUNT</th><td style="font-size: 22px"> ' . number_format($amount, 2) . '</td></tr>
   <tr><td></td><th style="font-size: 22px">SWAP NUMBER</th><td style="font-size: 22px"> ' .($code) . '</td></tr>

	 	 <tr><td></td><th style="font-size: 22px">CHANGE</th><td style="font-size: 22px"> ' . number_format($amount-$total, 2) . '</td></tr>
	<tr><th>
				<hr size="10"  noshade>  </th><th>
				<hr size="10"  noshade>  </th><th>
				<hr size="10"  noshade> </th><th>
				</tr>
    </table>
				 <table width="550" style="font-family:Bell Gothic,Verdana,Arial;">
                <tr><td  style="font-size: 22px"><center>You were served by:' . ($user) . ' at '.$time.'</center></td></tr>
				<tr><th  style="font-size: 22px"><center>Thankyou for shopping with us</center></th></tr>
				<tr><th>RECEIPT NO:# '.$receipt.'</th></tr>
				 <tr><th>
				<hr size="10"  noshade>  </th><th>
				
				</tr>
				 <tr><td><h4></h4></td></tr>
				<tr><td style="font-size: 17px"> <div align="center"><b>GOODS ONCE SOLD CANNOT BE RE-ACCEPTED<td></div></tr>
				
				
        </div></table>            
</div><input type="submit" name="btnPrint" value="print" asp:Button ID="btnPrint" runat="server" onclick="' . $id . '"/></body>';
 session_regenerate_id();
 }
 function multiple($credit,$cheque,$cash,$receipt,$tt){
	$user=$_SESSION['user_name'];
ini_set('display_errors', 0);
include('mysql.php');
$ip=get_client_ip() ;
		$tiller=teller($ip);
$r="select *,time(NOW()) as t from sales where number='$receipt'";
$sql=mysqli_query($dbc,$r);

$id = "javascript:Print('stylized')";
    echo '<body onload="' . $id . '"><div id="stylized">
	
            <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 25px">
               
                   <tr><td><center><img src="logo.jpg" width="550" height="100"/></center></td></tr>   
                   
                
				   <tr><td ><h3><b><center>PACEMART JUICES & CANDIES</b></h3></td></tr>
                 <tr><td colspan="2"><center>P.O BOX 7109-00300,NAIROBI TEL:0723 224 270</center></td></tr>
				 <tr><td colspan="2"><center>PIN: PO51449945S</center></td></tr>
									 <tr><td colspan="2"><center>RECEIPT #:' . $receipt  . '</center></td></tr>			 		
				 <tr><td colspan="2"><center>Till: ' . $tiller . '</center></td></tr> 		
				 <tr><td colspan="2"><center>Date:' . (date("Y/m/d")) . '</center></td></tr>
				 <tr><th>
				<hr size="10" noshade>  </th>
				</tr></table>
				            <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;">
							 
                <tr><th width="420" style="font-size: 22px">ITEM</th><th width="20" style="font-size: 22px">QTY
				</th><th align="right" width="200" style="font-size: 22px">AMOUNT</th></tr>
				';
    $total = 0;
	$vat=0;
      while ($row = mysqli_fetch_array($sql)) {
        echo '<tr><td style="font-size: 22px">
		' . ($row['system']) . '</td><td></td><td style="font-size: 22px" align="right">' . ($row['qty']) . ' X ' . number_format($row['price'],2) . '</td><tr></tr>
		<tr><td style="font-size: 22px">' . (strtoupper($row['p_name'])) . '</td>
		<td style="font-size: 22px">
		</td><td align="right" style="font-size: 22px">' . number_format($row['total_p'],2) . '</td></tr></tr>';
        $total+=($row['total_p']);
		$vat+=$row['vat'];
		$qty+=$row['qty'];
		$time=$row['t'];

}
echo '</table><br><br>';
	echo '<table style="font-family:Bell Gothic,Verdana,Arial;">
   <tr><th>
				<hr size="10"  noshade>  </th><th>
				<hr size="10"  noshade>  </th><th>
				<hr size="10"  noshade> </th><th>
				</tr>

	
	 <tr><th style="font-size: 20px"><u>TOTAL QTY</th><th width="300" 
	 style="font-size: 20px">&nbsp;&nbsp;&nbsp;&nbsp;<u>VATABLE AMT </th><th style="font-size: 20px"><u>
VAT </th></tr>
 	 <tr><td style="font-size: 22px">&nbsp;&nbsp;'.$qty.'</td>
	 <td style="font-size: 22px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 '.number_format(($total*84/100)) .'</td><td style="font-size: 22px">&nbsp;&nbsp;&nbsp;'.number_format($vat) .'</th></tr>
   <tr><td></td><th style="font-size: 22px">TOTAL </th><td style="font-size: 22px"> ' . number_format($total, 2) . '</td></tr>
   <tr><td></td><th style="font-size: 22px">CASH </th><td style="font-size: 22px"> ' . number_format($cash, 2) . '</td></tr>
   <tr><td></td><th style="font-size: 22px">CREDIT NOTE</th><td style="font-size: 22px"> ' . number_format($credit, 2) . '</td></tr>
    <tr><td></td><th style="font-size: 22px">CHEQUE</th><td style="font-size: 22px"> ' . number_format($cheque, 2) . '</td></tr>
	 <tr><td></td><th style="font-size: 22px">TOTAL TENDERED</th><td style="font-size: 22px"> ' . number_format($tt, 2) . '</td></tr>
	 	 <tr><td></td><th style="font-size: 22px">CHANGE</th><td style="font-size: 22px"> ' . number_format($tt-$total, 2) . '</td></tr>
	<tr><th>
				<hr size="10"  noshade>  </th><th>
				<hr size="10"  noshade>  </th><th>
				<hr size="10"  noshade> </th><th>
				</tr>
    </table>
				 <table width="550" style="font-family:Bell Gothic,Verdana,Arial;">
                <tr><td  style="font-size: 22px"><center>You were served by:' . ($user) . ' at '.$time.'</center></td></tr>
				<tr><th  style="font-size: 22px"><center>Thankyou for shopping with us</center></th></tr>
				
				 <tr><th>
				<hr size="10"  noshade>  </th><th>
				
				</tr>
				 <tr><td><h4></h4></td></tr>
				<tr><td style="font-size: 17px"> <div align="center"><b>GOODS ONCE SOLD CANNOT BE RE-ACCEPTED<td></div></tr>
				
				
        </div></table>            
</div><input type="submit" name="btnPrint" value="print" asp:Button ID="btnPrint" runat="server" onclick="' . $id . '"/></body>';
 session_regenerate_id();
 }
 function Invoice($receipt,$cash,$change,$session,$user,$customer){
	ini_set('display_errors', 0);

ini_set('display_errors', 0);
include('mysql.php');
$ip=get_client_ip() ;
		$tiller=teller($ip);
$r="select *,time(NOW()) as t from sales where number='$receipt' and type='INVOICE' and session='$session'";
$sql=mysqli_query($dbc,$r);

$id = "javascript:Print('stylized')";
    echo '<body onload="' . $id . '"><div id="stylized">
	
            <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 25px">
               
                   <tr><td><center><img src="logo.jpg" width="550" height="100"/></center></td></tr>   
                   
                
            
				   <tr><td ><h3><b><center>PACEMART JUICES & CANDIES</b></h3></td></tr>
                 <tr><td colspan="2"><center>P.O BOX 7109-00300,NAIROBI TEL:0723 224 270</center></td></tr>
				 <tr><td colspan="2"><center>PIN: PO51449945S</center></td></tr>
				  <tr><td colspan="2"><center>CUSTOMER: '.Mode($customer).'</center></td></tr>	
									
									
<tr><td colspan="2"><center>DELIVERY NO:# '.$receipt.'</center></td></tr>									 
				 <tr><td colspan="2"><center>Till: ' . $tiller . '</center></td></tr> 		
				<tr><td  colspan="2"><center>' . gmdate("d-m-y h:i:s G") .
								'</center></td></tr>
				 <tr><th>
				<hr size="10" noshade>  </th>
				</tr></table>
				            <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;">
							 
                <tr><th width="420" style="font-size: 22px">ITEM</th><th width="20" style="font-size: 22px">QTY
				</th><th align="right" width="200" style="font-size: 22px">AMOUNT</th></tr>
				';
    $total = 0;
	$vat=0;
      while ($row = mysqli_fetch_array($sql)) {
        echo '<tr><td style="font-size: 22px">
		' . (strtoupper($row['p_name'])) . '</td><td></td><td style="font-size: 22px" align="right">' . ($row['qty']) . ' X ' . number_format($row['price'],2) . '</td><tr></tr>
		<tr><td style="font-size: 22px"></td>
		<td style="font-size: 22px">
		</td><td align="right" style="font-size: 22px">' . number_format($row['total_p'],2) . '</td></tr></tr>';
        $total+=($row['total_p']);
		$vat+=$row['vat'];
		$qty+=$row['qty'];
		$time=$row['t'];
    }echo '</table><br><br>';
	echo '<table style="font-family:Bell Gothic,Verdana,Arial;">
   <tr><th>
				<hr size="10"  noshade>  </th><th>
				<hr size="10"  noshade>  </th><th>
				<hr size="10"  noshade> </th><th>
				</tr>

	
	 <tr><th style="font-size: 20px"><u> QTY</th><th width="300" 
	 style="font-size: 20px">&nbsp;&nbsp;&nbsp;&nbsp;<u>VATABLE AMT </th><th style="font-size: 20px"><u>
VAT </th></tr>
 	 <tr><td style="font-size: 22px">&nbsp;&nbsp;'.$qty.'</td>
	 <td style="font-size: 22px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 '.number_format(($total*84/100)) .'</td><td style="font-size: 22px">&nbsp;&nbsp;&nbsp;'.number_format($vat) .'</th></tr>
   <tr><td></td><th style="font-size: 22px">TOTAL </th><td style="font-size: 22px"> ' . number_format($total, 2) . '</td></tr>
   

   <tr><th>
				<hr size="10"  noshade>  </th><th>
				<hr size="10"  noshade>  </th><th>
				<hr size="10"  noshade> </th><th>
				</tr>
    </table>
				 <table width="550" style="font-family:Bell Gothic,Verdana,Arial;">
                <tr><td  style="font-size: 22px"><center>You were served by:' . ($user) . ' at '.$time.'</center></td></tr>
				<tr><th  style="font-size: 22px"><center>Thank you for shopping with us</center></th></tr>
				
				 <tr><th>
				<hr size="10"  noshade>  </th><th>
				
				</tr>
				 <tr><td><h4></h4></td></tr>
				<tr><td style="font-size: 17px"> <div align="center"><b>GOODS ONCE SOLD CANNOT BE RE-ACCEPTED<td></div></tr>
				
				
        </div></table>            
</div><input type="submit" name="btnPrint" value="print" asp:Button ID="btnPrint" runat="server" onclick="' . $id . '"/>';

 session_regenerate_id();

}
function DepositReceipt($receipt,$cash,$change,$session,$user,$discount,$deposit){
	ini_set('display_errors', 0);

ini_set('display_errors', 0);
include('mysql.php');
$ip=get_client_ip() ;
		$tiller=teller($ip);
$r="select *,time(NOW()) as t from sales where number='$receipt' and session='$session'";
$sql=mysqli_query($dbc,$r);

$id = "javascript:Print('stylized')";
    echo '<body onload="' . $id . '"><div id="stylized">
	
            <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 25px">
               
                   <tr><td><center><img src="logo.jpg" width="550" height="100"/></center></td></tr>   
                   
                
            
				   <tr><td ><h3><b><center>PACEMART JUICES & CANDIES</b></h3></td></tr>
                 <tr><td colspan="2"><center>P.O BOX 7109-00300,NAIROBI TEL:0723 224 270</center></td></tr>
				 <tr><td colspan="2"><center>PIN: PO51449945S</center></td></tr>
								
<tr><td colspan="2"><center>RECEIPT NO:# '.$receipt.'</center></td></tr>									 
				 <tr><td colspan="2"><center>Till: ' . $tiller . '</center></td></tr> 		
				<tr><td  colspan="2"><center>' . gmdate("d-m-y h:i:s G") .
								'</center></td></tr>
				 <tr><th>
				<hr size="10" noshade>  </th>
				</tr></table>
				            <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;">
							 
                <tr><th width="420" style="font-size: 22px">ITEM</th><th width="20" style="font-size: 22px">QTY
				</th><th align="right" width="200" style="font-size: 22px">AMOUNT</th></tr>
				';
    $total = 0;
	$vat=0;
      while ($row = mysqli_fetch_array($sql)) {
        echo '<tr><td style="font-size: 22px">
		' . (strtoupper($row['p_name'])) . '</td><td></td><td style="font-size: 22px" align="right">' . ($row['qty']) . ' X ' . number_format($row['price'],2) . '</td><tr></tr>
		<tr><td style="font-size: 22px"></td>
		<td style="font-size: 22px">
		</td><td align="right" style="font-size: 22px">' . number_format($row['total_p'],2) . '</td></tr></tr>';
        $total+=($row['total_p']);
		$vat+=$row['vat'];
		$qty+=$row['qty'];
		$time=$row['t'];
    }echo '</table><br><br>';
	echo ' <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 25px">
   <tr><td>
				<hr size="10"  noshade>  </td>
				</tr></table>';
				echo '<table  width="550" style="font-family:Bell Gothic,Verdana,Arial;">
 

	
	 <tr><th style="font-size: 20px"><u> QTY</th><th width="300" 
	 style="font-size: 20px">&nbsp;&nbsp;&nbsp;&nbsp;<u>VATABLE AMT </th><th style="font-size: 20px"><u>
VAT </th></tr>
 	 <tr><td style="font-size: 22px">&nbsp;&nbsp;'.$qty.'</td>
	 <td style="font-size: 22px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 '.number_format(($total-$vat)) .'</td><td style="font-size: 22px">&nbsp;&nbsp;&nbsp;'.number_format($vat) .'</th></tr>
   <tr><td></td><th style="font-size: 22px">TOTAL </th><td style="font-size: 22px"> ' . number_format($total, 2) . '</td></tr>
   <tr><td></td><th style="font-size: 22px">DISCOUNT </th><td style="font-size: 22px"> ' . number_format($discount, 2) . '</td></tr>
   <tr><td></td><th style="font-size: 22px">LESS DISCOUNT</th><td style="font-size: 22px"> ' . number_format($total-$discount, 2) . '</td></tr>
   <tr><td></td><th style="font-size: 22px">CASH DEPOSIT</th><td style="font-size: 22px"> ' . number_format($deposit, 2) . '</td></tr>
   <tr><td></td><th style="font-size: 22px">CASH TOP UP</th><td style="font-size: 22px"> ' . number_format($cash, 2) . '</td></tr>
   <tr><td></td><th style="font-size: 22px">TOTAL TENDERED</th><td style="font-size: 22px"> ' . number_format($cash+$deposit, 2) . '</td></tr>
   <tr><td></td><th style="font-size: 22px">CHANGE </th><td style="font-size: 22px"> ' . number_format($change, 2) . '</td></tr>
   <tr><th>
				<hr size="10"  noshade>  </th><th>
				<hr size="10"  noshade>  </th><th>
				<hr size="10"  noshade> </th><th>
				</tr>
    </table>
				 <table width="550" style="font-family:Bell Gothic,Verdana,Arial;">
                <tr><td  style="font-size: 22px"><center>You were served by:' . ($user) . ' at '.$time.'</center></td></tr>
				<tr><th  style="font-size: 22px"><center>Thank you for shopping with us</center></th></tr>
				
				 <tr><th>
				<hr size="10"  noshade>  </th><th>
				
				</tr>
				 <tr><td><h4></h4></td></tr>
				<tr><td style="font-size: 17px"> <div align="center"><b>GOODS ONCE SOLD CANNOT BE RE-ACCEPTED<td></div></tr>
				
				
        </div></table>            
</div><input type="submit" name="btnPrint" value="print" asp:Button ID="btnPrint" runat="server" onclick="' . $id . '"/>';

 session_regenerate_id();

}
	function Receipt($receipt,$cash,$change,$session,$user,$discount){
	ini_set('display_errors', 0);

ini_set('display_errors', 0);
include('mysql.php');
$ip=get_client_ip() ;
		$tiller=teller($ip);
$r="select *,time(NOW()) as t from sales where number='$receipt' and session='$session'";
$sql=mysqli_query($dbc,$r);

$id = "javascript:Print('stylized')";
    echo '<body onload="' . $id . '"><div id="stylized">
	
            <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 25px">
               
                 
                   
                
            
				   <tr><td  style="font-size: 20px"><h3><b><center>R M HOLDINGS LTD</b></h3></td></tr>
                 <tr><td  style="font-size: 20px"colspan="2"><center>P.O BOX 19093-00500,NAIROBI TEL:0202000210, 0710928789</center></td></tr>
				 <tr><td  style="font-size: 20px"colspan="2"><center>PIN: P051402067X</center></td></tr>
					 <tr><td  style="font-size: 20px"colspan="2"><center>VAT NO:0461472Q</center></td></tr>			
<tr><td  style="font-size: 20px" colspan="2"><center>RECEIPT NO:# '.$receipt.'</center></td></tr>									 
				 <tr><td  style="font-size: 20px" colspan="2"><center>Till: ' . $tiller . '</center></td></tr> 		
				<tr><td  style="font-size: 20px" colspan="2"><center>' . gmdate("d-m-y h:i:s G") .
								'</center></td></tr>
				 <tr><th>
				<hr size="10" noshade>  </th>
				</tr></table>
				            <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;">
							 
                <tr><th width="420" style="font-size: 20px">ITEM</th><th width="30" style="font-size: 20px">QTY
				</th><th align="right" width="200" style="font-size: 20px">AMOUNT</th></tr>
				';
    $total = 0;
	$vat=0;
      while ($row = mysqli_fetch_array($sql)) {
        echo '<tr><td style="font-size: 20px">
		' . (strtoupper($row['p_name'])) . '</td><td></td><td style="font-size: 20px" align="right">' . ($row['qty']) . ' X ' . number_format($row['price'],2) . '</td><tr></tr>
		<tr><td style="font-size: 20px"></td>
		<td style="font-size: 20px">
		</td><td align="right" style="font-size: 20px">' . number_format($row['total_p'],2) . '</td></tr></tr>';
        $total+=($row['total_p']);
		$vat+=$row['vat'];
		$qty+=$row['qty'];
		$time=$row['t'];
    }echo '</table><br><br>';
	echo ' <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 18px">
   <tr><td>
				<hr size="10"  noshade>  </td>
				</tr></table>';
				echo '<table  width="550" style="font-family:Bell Gothic,Verdana,Arial;">
 

	
	 <tr><th style="font-size: 20px"><u> QTY</th><th width="300" 
	 style="font-size: 20px">&nbsp;&nbsp;&nbsp;&nbsp;<u>VATABLE AMT </th><th style="font-size: 20px"><u>
VAT </th></tr>
 	 <tr><td style="font-size: 20px">&nbsp;&nbsp;'.$qty.'</td>
	 <td style="font-size: 20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 '.number_format(($total-$vat)) .'</td><td style="font-size: 20px">&nbsp;&nbsp;&nbsp;'.number_format($vat) .'</th></tr>
   <tr><td></td><th style="font-size: 20px">TOTAL </th><td style="font-size: 20px"> ' . number_format($total, 2) . '</td></tr>
   <tr><td></td><th style="font-size: 20px">DISCOUNT </th><td style="font-size: 20px"> ' . number_format($discount, 2) . '</td></tr>
   <tr><td></td><th style="font-size: 20px">LESS DISCOUNT</th><td style="font-size: 20px"> ' . number_format($total-$discount, 2) . '</td></tr>
   <tr><td></td><th style="font-size: 20px">CASH </th><td style="font-size: 20px"> ' . number_format($cash, 2) . '</td></tr>
   <tr><td></td><th style="font-size: 20px">CHANGE </th><td style="font-size: 20px"> ' . number_format($change, 2) . '</td></tr>
   <tr><th>
				<hr size="10"  noshade>  </th><th>
				<hr size="10"  noshade>  </th><th>
				<hr size="10"  noshade> </th><th>
				</tr>
    </table>
				 <table width="550" style="font-family:Bell Gothic,Verdana,Arial;">
                <tr><td  style="font-size: 20px"><center>You were served by:' . ($user) . ' at '.$time.'</center></td></tr>
				
				 <tr><th>
				<hr size="10"  noshade>  </th><th>
				
				</tr>
				 <tr><td><h4></h4></td></tr>
				<tr><td style="font-size: 20px"> <div align="center"><b>GOODS ONCE SOLD CANNOT BE RE-ACCEPTED<td></div></tr>
				
				
        </div></table>            
</div><input type="submit" name="btnPrint" value="print" asp:Button ID="btnPrint" runat="server" onclick="' . $id . '"/>';

 session_regenerate_id();

}function DamageP($receipt,$session,$user){
	ini_set('display_errors', 0);

ini_set('display_errors', 0);
include('mysql.php');
$ip=get_client_ip() ;
		$tiller=teller($ip);
$r="select *,time(NOW()) as t from damages
inner join products on products.product_id=damages.product_id where number='$receipt' and session='$session'";
$sql=mysqli_query($dbc,$r);

$id = "javascript:Print('stylized')";
    echo '<body onload="' . $id . '"><div id="stylized">
	
            <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 25px">
               
                   <tr><td><center><img src="logo.jpg" width="550" height="100"/></center></td></tr>   
                   
                
            
				   <tr><td ><h3><b><center>PACEMART JUICES & CANDIES</b></h3></td></tr>
                 <tr><td colspan="2"><center>P.O BOX 7109-00300,NAIROBI TEL:0723 224 270</center></td></tr>
				 <tr><td colspan="2"><center>PIN: PO51449945S</center></td></tr>
								
<tr><td colspan="2"><center> NO:# '.$receipt.'</center></td></tr>									 
				 <tr><td colspan="2"><center>Till: ' . $tiller . '</center></td></tr> 		
				<tr><td  colspan="2"><center>' . gmdate("d-m-y h:i:s G") .
								'</center></td></tr>
				 <tr><th>
				<hr size="10" noshade>  </th>
				</tr></table>
				            <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;">
							 
                <tr><th width="420" style="font-size: 22px">ITEM</th><th width="30" style="font-size: 22px">QTY
				</th></tr>
				';
    $total = 0;
	$vat=0;
      while ($row = mysqli_fetch_array($sql)) {
        echo '<tr><td style="font-size: 22px">
		' . (strtoupper($row['p_name'])) . '</td><td></td><td style="font-size: 22px" align="right">' . ($row['qty']) . '</td><tr></tr>
		<tr><td style="font-size: 22px"></td>
		<td style="font-size: 22px">
		</td></tr></tr>';
     
	
		$qty+=$row['qty'];
		$time=$row['t'];
    }echo '</table><br><br>';
	echo '<table style="font-family:Bell Gothic,Verdana,Arial;">
   <tr><th>
				<hr size="10"  noshade>  </th><th>
				<hr size="10"  noshade>  </th><th>
				<hr size="10"  noshade> </th><th>
				</tr>

	
	
   <tr><th>
				<hr size="10"  noshade>  </th><th>
				<hr size="10"  noshade>  </th><th>
				<hr size="10"  noshade> </th><th>
				</tr>
    </table>
				 <table width="550" style="font-family:Bell Gothic,Verdana,Arial;">
                <tr><td  style="font-size: 22px"><center>Generated by:' . ($user) . ' at '.$time.'</center></td></tr>
				
				
				 <tr><th>
				<hr size="10"  noshade>  </th><th>
				
				</tr>
				 <tr><td><h4></h4></td></tr>
				
				
				
        </div></table>            
</div><input type="submit" name="btnPrint" value="print" asp:Button ID="btnPrint" runat="server" onclick="' . $id . '"/>';

 session_regenerate_id();

}

function CashPick($session,$credit,$till,$user,$no){
include('mysql.php');

$id = "javascript:Print('stylized')";
    echo '<body onload="' . $id . '"><div id="stylized">
             <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 25px">
               
                   <tr><td><center><img src="logo.jpg" width="550" height="100"/></center></td></tr>   
                   
                
                <tr><td ><h3><b><center>ABC SHOP</b></h3></td></tr>
                 <tr><td colspan="2"><center>P.O BOX 7109-00300,NAIROBI TEL:0723 224 270</center></td></tr>
				 <tr><td colspan="2"><center>PIN: PO51449945S</center></td></tr>
				  <tr><td colspan="2"><center><b><u>CASH PICK REPORT<b></u></center></td></tr>
									 <tr><td colspan="2"><center>NUMBER #:: '.$no.'</center></td></tr>			 		
						<tr><td colspan="2"><center>TILL #:: '.$till.'</center></td></tr>
						<tr><td colspan="2"><center>USER #:: '.$user.'</center></td></tr>
				 <tr><td colspan="2"><center>Date:' . (date("Y/m/d")) . '</center></td></tr>
				 <tr><th>
				<hr size="10" noshade>  </th>
				</tr></table>
				            <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;">';
							 
                
 echo'<tr><th>
				<hr size="10" noshade>  </th><th>
				<hr size="10" noshade>  </th>
				</tr>';
	 echo '<tr>
		<td style="font-size: 22px"><b>TOTAL</td>
		<td style="font-size: 22px"><b>' . (number_format($credit)) . '</td>
		</tr>';
		echo '<tr>
		<td style="font-size: 22px"><b>Cashier Sign</td>
		<td style="font-size: 22px"><b>.........................................</td>
		</tr>';
		echo '<tr>
		<td style="font-size: 22px"><b>Supervisor Sign</td>
		<td style="font-size: 22px"><b>.........................................</td>
		</tr>';
		echo'<tr><th>
				<hr size="10" noshade>  </th><th>
				<hr size="10" noshade>  </th><th>
				<hr size="10" noshade>  </th>
				</tr>';
		echo '</table>            
</div><input type="submit" name="btnPrint" value="print" asp:Button ID="btnPrint" runat="server" onclick="' . $id . '"/></body>';
 session_regenerate_id();
 }
 	function petty($session,$cash,$invoice,$supplier,$till,$user,$no){
include('mysql.php');

$id = "javascript:Print('stylized')";
    echo '<body onload="' . $id . '"><div id="stylized">
             <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;font-size: 25px">
               
                   <tr><td><center><img src="logo.jpg" width="550" height="100"/></center></td></tr>   
                   
                
                <tr><td ><h3><b><center>ABC SHOP</b></h3></td></tr>
                 <tr><td colspan="2"><center>P.O BOX 7109-00300,NAIROBI TEL:0723 224 270</center></td></tr>
				 <tr><td colspan="2"><center>PIN: PO51449945S</center></td></tr>
				  <tr><td colspan="2"><center><b><u>PETTY CASH REPORT<b></u></center></td></tr>
									 <tr><td colspan="2"><center>NUMBER #:: '.$no.'</center></td></tr>			 		
						<tr><td colspan="2"><center>TILL #:: '.$till.'</center></td></tr>
						<tr><td colspan="2"><center>USER #:: '.$user.'</center></td></tr>
				 <tr><td colspan="2"><center>Date:' . (date("Y/m/d")) . '</center></td></tr>
				 <tr><th>
				<hr size="10" noshade>  </th>
				</tr></table>
				            <table width="550" style="font-family:Bell Gothic ,Verdana,Arial;">';
							 
                
 echo'<tr><th>
				<hr size="10" noshade>  </th><th>
				<hr size="10" noshade>  </th>
				</tr>';
				 echo '<tr>
		<td style="font-size: 22px"><b>SUPPLIER</td>
		<td style="font-size: 22px"><b>' . ($supplier) . '</td>
		</tr>';
		 echo '<tr>
		<td style="font-size: 22px"><b>INVOICE NO</td>
		<td style="font-size: 22px"><b>' . (($invoice)) . '</td>
		</tr>';
	 echo '<tr>
		<td style="font-size: 22px"><b>TOTAL</td>
		<td style="font-size: 22px"><b>' . (number_format($cash)) . '</td>
		</tr>';
		echo '<tr>
		<td style="font-size: 22px"><b>Cashier Sign</td>
		<td style="font-size: 22px"><b>.........................................</td>
		</tr>';
		echo '<tr>
		<td style="font-size: 22px"><b>Supervisor Sign</td>
		<td style="font-size: 22px"><b>.........................................</td>
		</tr>';
		echo'<tr><th>
				<hr size="10" noshade>  </th><th>
				<hr size="10" noshade>  </th><th>
				<hr size="10" noshade>  </th>
				</tr>';
		echo '</table>            
</div><input type="submit" name="btnPrint" value="print" asp:Button ID="btnPrint" runat="server" onclick="' . $id . '"/></body>';
 session_regenerate_id();
 }
function addpermission($user, $ugroup, $status, $permission) {
        $adperm = mysql_query('insert into groupperm values("","' . 
		usergroupid($ugroup) . '","' . $permission. '","' . ($status) . '")') or die(mysql_error());
		}
		
		function AccountAdd($name, $code, $id)
{
				$name = mysql_real_escape_string($name);
				$t = mysql_query("select * from accounts where name='$name'");
				if (mysql_num_rows($t) == 0)
				{
								$y = mysql_query("insert into accounts(name)
values('$name')");
								$idd = mysql_insert_id();
								$d = mysql_query("insert into group_accounts(group_id,account_id)values
('$id','$idd')");
UserAudit($_SESSION['user_id'],"Added Ledger $name",date("Y/m/d"),$ip);
								echo '<span class="green">Account Succesfully Added</span></br>';
				} else
				{
								echo '<span class="red">Sorry Account Already Exists</span></br>';
				}

}
function IncomeRecordd($income, $customer, $date, $amount, $invoice, $desc, $department,
				$sub,$from)
{
				$session = session_id();
				$desc = mysql_real_escape_string($desc);
				$r = mysql_query("insert into ledgers(credit,account_id,date,receipt,froms,session,description,sub)values('$amount','$income','$date','$invoice',
'$customer','$session','$desc','$sub')");
				//$f=mysql_query("insert into customer_ledgers(customer_id,date,credit,receipt,session)values('$income','$date','$amount','$invoice','$session')");
				$r = mysql_query("insert into ledgers(debit,account_id,date,receipt,froms,session,description,sub)values
('$amount','$customer','$date','$invoice','$income','$session','$desc','$sub')");
				$group = GetGroup($customer);
				if ($group == 10)
				{
								BankDebit($customer, $amount, $date, $invoice, $session);
				}
				echo "<span class='green'>Income Recording Succesfull </span></br>";
//$user = new Users();
				incomereceipt($user,$customer,$amount,$income,$from,$date,$session);

}
function billRecord($bill, $supplier, $date, $amount, $invoice, $maturity,$vat)
{
				$session = session_id();
				$account = $bill;
					TaxRecord(GetKra(),GetVat(),date("Y/m/d"),$vat,$invoice,$session);
				$r = mysql_query("insert into ledgers(credit,account_id,date,receipt,froms,session,mat_date,invoice)values('$amount','$supplier','$date','$invoice','$account','$session','$maturity','$invoice')");

				$r = mysql_query("insert into ledgers(debit,account_id,date,receipt,froms,session,mat_date,invoice)values('$amount','$account','$date','$invoice','$supplier','$session','$maturity','$invoice')");
				echo "<span class='green'>Bill Recording Succesfull </span></br>";
				//$f=mysql_query("insert into supplier_ledgers(debit,supplier_id,date,code)values('$amount','$supplier','$date','$invoice')");
				session_regenerate_id();
}
function TaxRecord($account, $supplier, $date, $amount,$invoice,$session)
{
			
				$r = mysql_query("insert into ledgers(credit,account_id,date,froms,session,mat_date,receipt,description)
				values('$amount','$supplier','$date','$account','$session','$maturity','$invoice','TAX ON GOODS')");

				$r = mysql_query("insert into ledgers(debit,account_id,date,froms,session,mat_date,receipt,description)values('$amount','$account','$date','$supplier','$session','$maturity','$invoice','TAX ON GOODS')");
				
				//$f=mysql_query("insert into supplier_ledgers(debit,supplier_id,date,code)values('$amount','$supplier','$date','$invoice')");
				
}

function TransferFunds($form, $to, $date, $cheque, $amount, $desc)
{
				$session = session_id();
				$desc ='FUNDS TRANSFER';
				$q = mysql_query("INSERT into ledgers(date,credit,description,account_id,froms,session)VALUES('$date','$amount','$desc','$form','$to','$session')");

				$r = mysql_query("INSERT into ledgers(date,debit,
  description,account_id,froms,session)VALUES('$date','$amount','$desc','$to','$form','$session')");

				echo "<span class='green'>Funds Transfer Succesfull </span></br>";
				session_regenerate_id();
}
function DoubleEntry($credit, $debit, $amount, $date, $desc,$sub)
{
				$session = session_id();
				$desc = mysql_real_escape_string($desc);
				$q = mysql_query("INSERT into ledgers(date,credit,description,account_id,froms,session,sub)
				VALUES('$date','$amount','$desc','$credit','$debit','$session','$sub')");

				$r = mysql_query("INSERT into ledgers(date,debit,
  description,account_id,froms,session,sub)VALUES('$date','$amount','$desc','$debit','$credit','$session','$sub')");
				echo "<span class='green'>Double Entry Succesfull </span></br>";
				session_regenerate_id();
}
function DoubleEntryM($credit, $debit, $amount, $date, $desc,$sub,$session,$cheque)
{
				
				$desc = mysql_real_escape_string($desc);
				$q = mysql_query("INSERT into ledgers(date,credit,description,account_id,froms,session,sub,receipt)
				VALUES('$date','$amount','$desc','$credit','$debit','$session','$sub','$cheque')");

				$r = mysql_query("INSERT into ledgers(date,debit,
  description,account_id,froms,session,sub,receipt)VALUES('$date','$amount','$desc','$debit','$credit','$session','$sub','$cheque')");
				echo "<span class='green'>Double Entry Transaction Succesfull </span></br>";
				//session_regenerate_id();
}
function RecordLedgerExp($credit, $payment, $date, $cheque, $amount, $desc, $department,
				$sub,$receipt,$vat)
{
				$session = session_id();
				UserAudit($_SESSION['user_id'],"Recorded expenses via session $session",date("Y/m/d"),$ip);
				$q = mysql_query("INSERT into ledgers(date,debit,description,account_id,froms,session,receipt,sub)VALUES
 ('$date','$amount','$desc','$credit','$payment','$session','$cheque','$sub')");

				$r = mysql_query("INSERT into ledgers(date,credit,
  description,account_id,froms,session,receipt,sub)VALUES('$date','$amount','$desc','$payment','$credit','$session','$cheque','$sub')");
  	if($vat==16){$totalv=0.16*($amount)/1.16;
	TaxRecord(GetKra(),GetVat(),date("Y/m/d"),$totalv,$receipt,$session);
	}
				$group = GetGroup($payment);
				if ($group == 10)
				{
								BankCredit($payment, $amount, $date, $cheque, $session);
				}
				echo "<span class='green'>Expenses Have Been Recorded  Succesfully </span></br>";
				session_regenerate_id();
}
function BankCredit($bank, $amount, $date, $cheque, $session)
{
				$r = mysql_query("insert into cash_book(date,credit,account_id,receipt,session)
values('$date','$amount','$bank','$cheque','$session')
");

}
function BankDebit($bank, $amount, $date, $cheque, $session)
{
				$r = mysql_query("insert into cash_book(date,debit,account_id,receipt,session)
values('$date','$amount','$bank','$cheque','$session')
");

}
function CreateReconciliation($bank)
{

				$v = mysql_query("update bank_statement set status='NOT ACTIVE' where account_id='$bank'");

				$r = mysql_query("insert into bank_statement(debit,credit,receipt,date,account_id,t_date,type)( SELECT debit, credit,receipt,date,account_id,t_date,type
FROM (
SELECT  credit, debit,receipt,date,account_id,date(NOW()) as t_date,type
FROM bank_account
where account_id='$bank'
UNION ALL
SELECT credit, debit,receipt,date,account_id,date(NOW()) as t_date,type
FROM cash_book
where account_id='$bank'
)data
GROUP BY debit, credit,receipt
HAVING count( * ) !=2)");

				$f = mysql_query("insert into cash_book(date,type,debit,receipt,account_id,t_date)(SELECT bank_account.date,bank_account.type,
 bank_account.debit, bank_account.receipt,bank_account.account_id,date(NOW())
FROM bank_statement, bank_account
WHERE bank_account.debit = bank_statement.debit
AND bank_statement.debit >0
AND bank_statement.account_id ='$bank'
AND bank_account.receipt=bank_statement.receipt)");

				$f = mysql_query("insert into cash_book(date,type,credit,receipt,account_id,t_date)(SELECT bank_account.date,bank_account.type
 bank_account.credit, bank_account.receipt,bank_account.account_id,date(NOW())
FROM bank_statement, bank_account
WHERE bank_account.credit = bank_statement.credit
AND bank_statement.credit >0
AND bank_statement.account_id ='$bank'
AND bank_account.receipt=bank_statement.receipt)");

				echo '<span class="green">Banking And Reconciliation Succesfully Done</span></br>';

}
function InputBank($date, $credit, $debit, $no, $session, $bank)
{
				$h = mysql_query("select * from bank_account where number='$no' and date='$date' and credit='$credit' and debit='$debit'");
				if (mysql_num_rows($h) == 0)
				{
								$t = mysql_query("insert into bank_account(credit,debit,date,account_id,session,receipt)
values('$credit','$debit','$date','$bank','$session','$no')");
								$id = mysql_insert_id();
								if ($id)
								{
												echo '<span class="green">Data Entry Succesful</span></br>';
								} else
								{

												echo '<span class="red">Data Entry Not Succesful</span></br>';
								}

				} else
				{
								echo '<span class="red">Entry Already Exists !</span></br>';

				}
}
function IncomePayment($customer, $payment, $date, $amount)
{
				$session = session_id();
				$r = mysql_query("insert into ledgers(credit,account_id,date,receipt,froms,session)values('$amount','$customer','$date','$invoice','$payment','$session')");

				$r = mysql_query("insert into ledgers(debit,account_id,date,receipt,froms,session)values('$amount','$payment','$date','$invoice','$customer','$session')");
				echo "<span class='green'>Income Payment Succesfull </span></br>";
				$group = GetGroup($customer);
				if ($group == 10)
				{
								BankDebit($income, $amount, $date, $cheque, $session,$desc);
				}
				session_regenerate_id();
}
function SPayment($id, $payment, $date, $amount, $session, $rec,$desc)
{
				$ro = mysql_query("select id,sum(debit)as debit,sum(credit)as credit,sum(credit)-sum(debit)as balance,invoice from ledgers 
where account_id='$id'
group by invoice
having balance>0 order by invoice");
				$customer = $id;
				$session = session_id();
				echo "<span class='green'>Supplier Payment Succesfull </span></br>";
				while ($row = mysql_fetch_array($ro))
				{

								$credit = $row['credit'];

								$debit = $row['debit'];
								$balance = $row['balance'];
								$invoice = $row['invoice'];
								if ($amount > 0)
								{
												if ($balance > $amount)
												{
																$r = mysql_query("insert into
																ledgers(credit,account_id,date,receipt,froms,session,invoice,description)values
('$amount','$payment','$date','$rec','$customer','$session','$invoice','$desc')");
																//$r=mysql_query("insert into supplier_ledgers(credit,supplier_id,date,code,session)values('$amount','$payment','$date','$invoice','$session')");

																$r = mysql_query("insert into ledgers(debit,account_id,date,receipt,froms,session,invoice,description)values
																('$amount','$customer','$date','$rec','$payment','$session','$invoice','$desc')");
																$amount = 0;
												}else
												if ($amount > $balance)
												{
																$r = mysql_query("insert into ledgers(credit,account_id,date,receipt,froms,session,
																invoice,description)
																values('$balance','$payment','$date','$rec','$customer','$session','$invoice','$desc')");
																//$r=mysql_query("insert into supplier_ledgers(credit,supplier_id,date,code,session)values('$amount','$payment','$date','$invoice','$session')");

																$r = mysql_query("insert into ledgers(debit,account_id,date,receipt,froms,session,invoice,
																description)
																values('$balance','$customer','$date','$rec','$payment','$session','$invoice','$desc')");
																$amount = $amount - $balance;
												}else
												if ($amount == $balance)
												{
																$r = mysql_query("insert into ledgers(credit,account_id,date,receipt,froms,session,invoice,
																description)values
																('$amount','$payment','$date','$rec','$customer','$session','$invoice','$desc')");
																//$r=mysql_query("insert into supplier_ledgers(credit,supplier_id,date,code,session)values('$amount','$payment','$date','$invoice','$session')");

																$r = mysql_query("insert into ledgers(debit,account_id,date,receipt,froms,session,invoice
																,description)values
																('$amount','$customer','$date','$rec','$payment','$session','$invoice','$desc')");

																$amount = 0;
												}

								}

				}
				$group = GetGroup($payment);
				if ($group == 10)
				{
								BankCredit($payment, $amount, $date, $cheque, $session);
				}
}
function Mode($id){
$r=mysql_query("select * from accounts where id='$id'");
$row=mysql_fetch_array($r);
$name=$row['name'];
return $name;
}
function LoanDisbursement($account,$froms,$sub,$date,$amount,$session,$cheque){
$transaction=$_SESSION['vid'];
$l=mysql_query("select * from voucher");
	$row=mysql_fetch_array($l);
	$number=$row['number'];
	$tu=mysql_query("update voucher set number=number+1");
$k=mysql_query("insert into ledgers(account_id,froms,sub,date,debit,session,description,receipt,transaction)values
('$account','$froms','$sub','$date','$amount','$session','LOANS DISBURSEMENT','$cheque','$transaction')");
$r=mysql_query("insert into ledgers(account_id,froms,sub,date,credit,session,description,receipt,transaction)values
('$froms','$account','$sub','$date','$amount','$session','LOANS DISBURSEMENT','$cheque','$transaction')");
$f=mysql_query("insert into payments(date,member,amount,number,session)values('$date','$sub','$amount','$number','$session')");
BankCredit($froms, $amount, $date, $cheque, $session);
		echo "<span class='green'>Loan Disbursement Succesfull </span></br>";
		unset($_SESSION['t']);
		unset($_SESSION['vid']);
		session_regenerate_id();
		
		$url="payment.php?s=$session&d=$froms&t=LOAN DISBURSEMENT&c=$cheque&tr=$transaction";
		
ob_end_clean();
header("Location: $url");
}
function WithDisbursement($account,$froms,$sub,$date,$amount,$session,$cheque){
$transaction=gmdate("dmyhisG");


$r=mysql_query("insert into ledgers(account_id,froms,sub,date,debit,session,description,receipt,transaction)values
('$account','$froms','$sub','$date','$amount','$session','MEMBER WITHDRAWAL','$cheque','$transaction')");
$r=mysql_query("insert into ledgers(account_id,froms,sub,date,credit,session,description,receipt,transaction)values
('$froms','$account','$sub','$date','$amount','$session','MEMBER WITHDRAWAL','$cheque','$transaction')");

BankCredit($froms, $amount, $date, $cheque, $session);
		echo "<span class='green'>Payment Voucher  Succesfully Created </span></br>";
		unset($_SESSION['PROCESS']);
		
		session_regenerate_id();
		$url="payment.php?s=$session&d=$froms&t=MEMBER DEPOSITS REFUNDS&c=$cheque&tr=$transaction";
		
ob_end_clean();
header("Location: $url");
}
function GetLoan($id){
$r=mysql_query("select * from initial_l where transid='$id'");
$row=mysql_fetch_array($r);
$amount=$row['initial'];
return $amount;

}
function PrincipalPayment($account, $froms, $sub, $amount, $date, $session)
{
$date=date("Y/m/d");
				$r = mysql_query("insert into ledgers(account_id,froms,sub,date,debit,session,description)values
('$account','$froms','$sub','$date','$amount','$session','PRINCIPAL PAYMENT')");
				$r = mysql_query("insert into ledgers(account_id,froms,sub,date,credit,session,description)values
('$froms','$account','$sub','$date','$amount','$session','PRINCIPAL  PAYMENT')");

}
function shutdown(){
$output=SHELL_EXEC('shutdown /s /t 00');
echo $output;
}
function RecoveryPayment($account, $froms, $sub, $amount, $date, $session)
{
$date=date("Y/m/d");
				$r = mysql_query("insert into ledgers(account_id,froms,sub,date,debit,session,description)values
('$account','$froms','$sub','$date','$amount','$session','LOANS RECOVERY')");
				$r = mysql_query("insert into ledgers(account_id,froms,sub,date,credit,session,description)values
('$froms','$account','$sub','$date','$amount','$session','LOANS RECOVERY')");

}
function InvestmentPayment($account, $froms, $sub, $amount, $date, $session)
{
$date=date("Y/m/d");
				$r = mysql_query("insert into ledgers(account_id,froms,sub,date,debit,session,description)values
('$account','$froms','$sub','$date','$amount','$session','INVESTMENT PAYMENT')");
				$r = mysql_query("insert into ledgers(account_id,froms,sub,date,credit,session,description)values
('$froms','$account','$sub','$date','$amount','$session','INVESTMENT  PAYMENT')");

}
//Credit Income Account ($froms)
//Debit Current Asset Account ($account)
function InterestPayment($account, $froms, $sub, $amount, $date, $session)
{
$date=date("Y/m/d");
				$r = mysql_query("insert into ledgers(account_id,froms,sub,date,debit,session,description)values
('$account','$froms','$sub','$date','$amount','$session','INTEREST PAYMENT')");
				$r = mysql_query("insert into ledgers(account_id,froms,sub,date,credit,session,description)values
('$froms','$account','$sub','$date','$amount','$session','INTEREST PAYMENT')");

}
//Credit Income Account ($froms)
//Debit Current Asset Account ($account)
function InsurancePayment($account, $froms, $sub, $amount, $date, $session)
{
$date=date("Y/m/d");
				$r = mysql_query("insert into ledgers(account_id,froms,sub,date,debit,session,description)values
('$account','$froms','$sub','$date','$amount','$session','INSURANCE PAYMENT')");
				$r = mysql_query("insert into ledgers(account_id,froms,sub,date,credit,session,description)values
('$froms','$account','$sub','$date','$amount','$session','INSURANCE PAYMENT')");

}
function GetSharesType($name){
$n=strtoupper($name);
$r=mysql_query("select * from accounts where name='$n'");
if(mysql_num_rows($r)==0){
$t=mysql_query("insert into accounts(name,descc)values('$n','1')");
$id=mysql_insert_id();
$f=mysql_query("insert into group_accounts(account_id,group_id)values('$id','2')");

}else{
$row=mysql_fetch_array($r);
$id=$row['id'];


}
return $id;



}
function InvestmentType($name){
$n=strtoupper($name);
$r=mysql_query("select * from accounts where name='$n'");
if(mysql_num_rows($r)==0){
$t=mysql_query("insert into accounts(name,descc)values('$n','1')");
$id=mysql_insert_id();
$f=mysql_query("insert into group_accounts(account_id,group_id)values('$id','13')");

}else{
$row=mysql_fetch_array($r);
$id=$row['id'];


}
return $id;



}
//Credit Liability Account ($froms)
//Debit Current Asset Account ($account)
function SharesPayment($account, $froms, $sub, $amount, $date, $session,$name)
{
				$r = mysql_query("insert into ledgers(account_id,froms,sub,date,debit,session,description)values
('$account','$froms','$sub','$date','$amount','$session','$name')");
				$r = mysql_query("insert into ledgers(account_id,froms,sub,date,credit,session,description)values
('$froms','$account','$sub','$date','$amount','$session','$name')");

}
function Acc($id)
{
				$r = mysql_query("select * from accounts where id='$id'");
				$row = mysql_fetch_array($r);
				$cost = $row['name'];
				return $cost;

}
function Nosee($no)
{
				if ($no == 0)
				{
								$no = '-';
				}
				if ($no != 0)
				{
								$no = $no;
				}
				return $no;
}
function SubName($id){
$r=mysql_query("select * from sub_accounts where id='$id'");
$row=mysql_fetch_array($r);
$name=$row['name'];
if($name==''){$name='-';}
return $name;
}
function GetPrincipal(){
$r=mysql_query("select * from accounts where name='PRINCIPAL'");
if(mysql_num_rows($r)==0){
$f=mysql_query("insert into accounts(name,descc)values('PRINCIPAL','1')");
$id=mysql_insert_id();
$e=mysql_query("insert into group_accounts(account_id,group_id)values('$id','5')");
$interest=$id;
}else{
$row=mysql_fetch_array($r);
$interest=$row['id'];

}
return $interest;}
function GetInterest(){
$r=mysql_query("select * from accounts where name='INTEREST'");
if(mysql_num_rows($r)==0){
$f=mysql_query("insert into accounts(name,descc)values('INTEREST','1')");
$id=mysql_insert_id();
$e=mysql_query("insert into group_accounts(account_id,group_id)values('$id','3')");
$interest=$id;
}else{
$row=mysql_fetch_array($r);
$interest=$row['id'];

}
return $interest;}
function GetOutstanding(){
$r=mysql_query("select * from accounts where name='OUTSTANDING LOANS'");
if(mysql_num_rows($r)==0){
$f=mysql_query("insert into accounts(name,descc)values('OUTSTANDING LOANS','1')");
$id=mysql_insert_id();
$e=mysql_query("insert into group_accounts(account_id,group_id)values('$id','4')");
$interest=$id;
}else{
$row=mysql_fetch_array($r);
$interest=$row['id'];

}
return $interest;}
function GetInsurance(){
$r=mysql_query("select * from accounts where name='RISK MANAGEMENT LOAN'");
if(mysql_num_rows($r)==0){
$f=mysql_query("insert into accounts(name,descc)values('RISK MANAGEMENT LOAN','1')");
$id=mysql_insert_id();
$e=mysql_query("insert into group_accounts(account_id,group_id)values('$id','3')");
$interest=$id;
}else{
$row=mysql_fetch_array($r);
$interest=$row['id'];

}
return $interest;}
function RiskPayment($account,$froms,$sub,$amount,$date,$session){
$r=mysql_query("insert into ledgers(account_id,froms,sub,date,debit,session,description)values
('$account','$froms','$sub','$date','$amount','$session','INSURANCE PAYMENT')");
$r=mysql_query("insert into ledgers(account_id,froms,sub,date,credit,session,description)values
('$froms','$account','$sub','$date','$amount','$session','INSURANCE PAYMENT')");

}
function GetInsurancee(){
$r=mysql_query("select * from accounts where name='RISK MANAGEMENT  SHARES & BBF'");
if(mysql_num_rows($r)==0){
$f=mysql_query("insert into accounts(name,descc)values('RISK MANAGEMENT  SHARES & BBF','1')");
$id=mysql_insert_id();
$e=mysql_query("insert into group_accounts(account_id,group_id)values('$id','3')");
$interest=$id;
}else{
$row=mysql_fetch_array($r);
$interest=$row['id'];

}
return $interest;}

function GetGroup($id)
{
				$r = mysql_query("select * from group_accounts where account_id='$id'");
				$row = mysql_fetch_array($r);
				$id = $row['group_id'];
				return $id;
}
function Legers($id)
{
				$r = mysql_query("select * from accounts where id='$id'");
				$row = mysql_fetch_array($r);
				$idd=$row['name'];
				return $idd;
}
function InsertWith($mno,$date,$amount,$no){
$id = base64_encode($mno);
	$r=mysql_query("update newmember set status='Tk9UIEFDVElWRQ==' where primarykey='$id'");
	$r=mysql_query("update monthly_con set status='Tk9UIEFDVElWRQ==' where membernumber='$id'");
	
	$session=session_id();
	$_SESSION['PROCESS']=$session;
	$l=mysql_query("select * from voucher");
	$row=mysql_fetch_array($l);
	$number=$row['number'];
		$tu=mysql_query("update voucher set number=number+1");
	$f=mysql_query("insert into payments(date,member,amount,number,session)values('$date','$mno','$amount','$number','$session')");
	
	echo "<span class='green'>Withdrawal Succefully Done Please Proceed And Print Payment Voucher To Complete Transaction</span></br>";
}
function AddSub($name,$id,$idd){
$name=mysql_real_escape_string($name);

$r=mysql_query("select * from sub_accounts where name='$name' ");

if(mysql_num_rows($r)==0){

$t=mysql_query("insert into sub_accounts(name,account)values('$name','$id')");






 echo '<span class="green">Sub Account Succesfully Added</span></br>';}else{
 echo '<span class="red">Sub Account Exists</span></br>';}
}
function Permission($department,$type){
if(($type=='SALES')&&($department=='3'||$department=='1')){
$url='login.php';
                                        ob_end_clean();
										$_SESSION['msgg']='You Do Not Have Enough Priviliges To Access Those Resources';
header("Location: $url");
}
if($type=='BACK OFFICE'&&($department=='1'||$department=='2')){
$url='login.php';
                                        ob_end_clean();
										$_SESSION['msgg']='You Do Not Have Enough Priviliges To Access Those Resources';
header("Location: $url");
}
if($type=='ACCOUNTS'&&($department=='3'||$department=='2')){
$url='login.php';
                                        ob_end_clean();
										$_SESSION['msgg']='You Do Not Have Enough Priviliges To Access Those Resources';
header("Location: $url");
}
if($type=='ADMIN'&&($department=='3'||$department=='2'||$department=='1')){
$url='login.php';
$_SESSION['msgg']='You Do Not Have Enough Priviliges To Access Those Resources';
                                        ob_end_clean();
header("Location: $url");
}

}


function CloseYear($id){
$r=mysql_query("select * from financial_year where id='$id' and status='ACTIVE'");
$row=mysql_fetch_array($r);
$account=GetEquity();
$dep_a=GetDep();
$date1=$row['start'];
$date2=$row['end'];
if($date1&&$date2){

 $de=mysql_query("select ledgers.account_id as account_id,sub,(datediff('$date2',ledgers.date)/365)*(dep/100*(sum(debit)-sum(credit))) as current from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
inner join accounts on accounts.id=ledgers.account_id
where group_id='6'

group by ledgers.sub");
while($row=mysql_fetch_array($de)){

$dep=$row['current'];
$depid=$row['account_id'];
$sub=$row['sub'];
$namee=SubName($sub);
$l=mysql_query("insert into ledgers(account_id,froms,debit,description,date,session,sub)
values('$dep_a','$depid','$dep','ASSETS DEPRECIATION OF $namee',
'$date2',concat('$date1','$date2'),'$sub')");
$n=mysql_query("insert into ledgers(account_id,froms,credit,description,date,session,sub)values
('$depid','$dep_a','$dep','ASSETS DEPRECIATION OF $namee','$date2',concat('$date1','$date2'),'$sub')");
 }

$expenses=mysql_query("select  sum(debit)-sum(credit)as credit,ledgers.account_id as account_id from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='1'

and ledgers.date between '$date1' and '$date2'
group by ledgers.account_id
having credit>0
");
while($rew=mysql_fetch_array($expenses)){
$amount=$rew['credit'];
$account_id=$rew['account_id'];
$l=mysql_query("insert into ledgers(account_id,froms,debit,description,date,session)values('$account','$account_id','$amount','P & L',
'$date2',concat('$date1','$date2'))");
$n=mysql_query("insert into ledgers(account_id,froms,credit,description,date,session)values('$account_id','$account','$amount','P & L','$date2',concat('$date1','$date2'))");
}
$cost=mysql_query("select  sum(debit)-sum(credit)as credit,ledgers.account_id as account_id from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='7'

and ledgers.date between '$date1' and '$date2'
group by ledgers.account_id
having credit>0");
while($rew=mysql_fetch_array($cost)){
$amount=$rew['credit'];
$account_id=$rew['account_id'];
$l=mysql_query("insert into ledgers(account_id,froms,debit,description,date,session)values('$account','$account_id','$amount','P & L','$date2',concat('$date1','$date2'))");
$n=mysql_query("insert into ledgers(account_id,froms,credit,description,date,session)values('$account_id','$account','$amount','P & L','$date2',concat('$date1','$date2'))");
}
$income=mysql_query("select  sum(credit)-sum(debit)as credit,ledgers.account_id as account_id from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='3'

and ledgers.date between '$date1' and '$date2'
group by ledgers.account_id
having credit>0");
while($raw=mysql_fetch_array($income)){
$amount=$raw['credit'];
$account_id=$raw['account_id'];
$li=mysql_query("insert into ledgers(account_id,froms,debit,description,date,session)values('$account_id','$account','$amount','P & L','$date2',concat('$date1','$date2'))");
$ni=mysql_query("insert into ledgers(account_id,froms,credit,description,date,session)values('$account','$account_id','$amount','P & L','$date2',concat('$date1','$date2'))");
}
$_SESSION['msg']='FINANCIAL YEAR CLOSURE SUCCESFUL';
$f=mysql_query("update financial_year set status='CLOSED' where id='$id'");

}else{
$_SESSION['msg']='FINANCIAL YEAR CLOSURE NOT POSSIBLE';

}

}
function DateStatus($date){
$r=mysql_query("select * from financial_year where '$date' between start and end");
$row=mysql_fetch_array($r);
$status=$row['status'];
return $status;}
function DebitP($id,$date){
$r=mysql_query("select sum(debit)-sum(credit)as debit from ledgers where date<='$date'
and account_id='$id'");
$row=mysql_fetch_array($r);
$credit=$row['debit'];
return $credit;

}
function CreditP($id,$date){
$r=mysql_query("select sum(credit)-sum(debit)as debit from ledgers where date<='$date'
and account_id='$id'");
$row=mysql_fetch_array($r);
$credit=$row['debit'];
return $credit;

}
function FixedAssetsP($id,$date){
  $c=mysql_query("select SUM(debit)-(datediff(NOW(),ledgers.date)/365)*(dep/100*SUM(debit)) as credit from ledgers
where account_id='$id'
and date<='$date'
group by ledgers.account_id
");
$row=mysql_fetch_array($c);
$credit=$row['credit'];
return $credit;

}
?>