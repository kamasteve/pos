<?require_once('functions.php');


$date=date("Y/m/d");
//Now that we've created such a nice heading for our html table, lets create a heading for our csv table
$csv_hdr=" PACEMART JUICES & CANDIES \n";
$csv_hdr=" Balance Sheet As At $date \n";
 

//Quickly create a variable for our output that'll go into the CSV file (we'll make it blank to start).
    $csv_output="";
	
// Ok, we're done with the table heading, lets connect to the database
    $database="test";
    mysql_connect("localhost","root","");
    mysql_select_db("gikomba");
    mysql_set_charset('utf8');
    mysql_query('SET NAMES UTF-8');
 $he=mysql_query("select  sum(credit)as credit,ledgers.account_id as account_id  from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='3'


group by ledgers.account_id
");

while($row=mysql_fetch_array($he)){

$incom+=$row['credit'];
 }
   $ce=mysql_query("select  sum(debit)-sum(credit)as credit,ledgers.account_id as account_id   from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='7'


group by ledgers.account_id

");
while($row=mysql_fetch_array($ce)){

$cost+=$row['credit'];
 }
   $c=mysql_query("select  sum(debit)-sum(credit)as credit,ledgers.account_id as account_id   from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id ='1'


group by ledgers.account_id
having credit>0
");
while($row=mysql_fetch_array($c)){

$expenses+=$row['credit'];
 }
    $ce=mysql_query("select  sum(debit)-sum(credit)as credit,ledgers.account_id as account_id   from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id ='14'


group by ledgers.account_id
having credit>0
");
while($row=mysql_fetch_array($c)){

$equity+=$row['credit'];
 }
   $over=mysql_query("select  sum(debit)-sum(credit)as credit,ledgers.account_id as account_id   from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='2'


group by ledgers.account_id
having credit>0

");
while($row=mysql_fetch_array($over)){

$pexpenses+=$row['credit'];
 }
 $retained=$equity+(($incom-$cost)-$expenses);
 
 $csv_output .= "CAPITAL EMPLOYED";
   $csv_output .= "\n";
 $h=mysql_query("select  sum(credit)-sum(debit) as credit,ledgers.account_id as account_id  from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='5'


group by ledgers.account_id
");

while($row=mysql_fetch_array($h)){
$income+=$row['credit'];

 $csv_output .= Legers($row['account_id']). ", ";
           
            $csv_output .= ($row['credit']) . ", ";
         
         $csv_output .= "\n"; 
 }
 $fixed=mysql_query("select (datediff(NOW(),ledgers.date)/365)*(dep/100*SUM(debit)) as current from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
inner join accounts on accounts.id=ledgers.account_id
where group_id='6'

group by ledgers.account_id");
while($row=mysql_fetch_array($fixed)){

$dep+=$row['current'];
 }
 $name='RETAINED EARNINGS';
  $csv_output .= $name .", ";
   
           
            $csv_output .= ($retained-$dep) . ", ";
         
         $csv_output .= "\n";
		$name='TOTAL SHAREHOLDERS FUND';
  $csv_output .= $name .", ";
		  
           
            $csv_output .= ($income+$retained-$dep) . ", ";
         
         $csv_output .= "\n";
 $csv_output .="LONG TERM LIABLITIES" ;
   $csv_output .= "\n";
 $c=mysql_query("select  sum(credit)-sum(debit)as credit,ledgers.account_id as account_id   from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='8'

group by ledgers.account_id
");
while($row=mysql_fetch_array($c)){
 $csv_output .= Legers($row['accouunt_id']). ", ";
           
            $csv_output .= ($row['credit']) . ", ";
         
         $csv_output .= "\n"; 
$coste+=$row['credit'];
 }
  $name=" ";
  $csv_output .= $name .", ";
           
            $csv_output .= ($coste) . ", ";
         
         $csv_output .= "\n"; 
$name=" ";
  $csv_output .= $name .", ";
           
            $csv_output .= ($income+$coste+$retained-$dep) . ", ";
         
         $csv_output .= "\n"; 

 $csv_output .= "REPRESENTED BY";
   $csv_output .= "\n";
 $csv_output .= "NON CURRENT ASSETS";
   $csv_output .= "\n";
  $c=mysql_query("select *,SUM(debit)-(datediff(NOW(),ledgers.date)/365)*(dep/100*SUM(debit)) as credit from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
inner join accounts on accounts.id=ledgers.account_id


where group_id='6'
group by ledgers.account_id
");
while($row=mysql_fetch_array($c)){
 $csv_output .= Legers($row['account_id']). ", ";
           
            $csv_output .= ($row['credit']) . ", ";
         
         $csv_output .= "\n"; 
$fixedd+=$row['credit'];
 }
  $name=" ";
  $csv_output .= $name .", ";$csv_output .= ($fixedd) . ", ";
         
       
         
         $csv_output .= "\n";
 $csv_output .= "CURRENT ASSETS";
   $csv_output .= "\n";

  $c=mysql_query("select  sum(debit)-sum(credit)as credit,ledgers.account_id as account_id   from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='4' 


group by ledgers.account_id

");
while($row=mysql_fetch_array($c)){if($row['credit']!=0.00){
 $csv_output .= Legers($row['account_id']). ", ";
           
            $csv_output .= ($row['credit']) . ", ";
         
         $csv_output .= "\n"; }
$current+=$row['credit'];
 }
   $c=mysql_query("select  sum(debit)-sum(credit)as credit,ledgers.account_id as account_id   from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='10' 


group by ledgers.account_id

");
while($row=mysql_fetch_array($c)){
 $csv_output .= Legers($row['account_id']). ", ";
           
            $csv_output .= ($row['credit']) . ", ";
         
         $csv_output .= "\n"; 
$currentt+=$row['credit'];
 }
 $current=$current+$currentt;//$pexpenses;
 $csv_output .= "PRE-PAID EXPENSES";
   $csv_output .= "\n";

 $c=mysql_query("select  sum(credit)-sum(debit)as credit,ledgers.account_id as account_id   from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='1' 


group by ledgers.account_id
having credit>0

");
while($row=mysql_fetch_array($c)){
if($row['credit']!=0.00){
 $csv_output .= Legers($row['account_id']). ", ";
           
            $csv_output .= ($row['credit']) . ", ";
         
         $csv_output .= "\n"; }
$currenttp+=$row['credit'];
 }
 $csv_output .= "TRADE DEBTORS";
   $csv_output .= "\n";

 $c=mysql_query("select  sum(debit)-sum(credit)as credit,ledgers.account_id as account_id   from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='2' 
and ledgers.account_id<>'11'


group by ledgers.account_id
having credit>0

");
while($row=mysql_fetch_array($c)){
if($row['credit']!=0.00){
 $csv_output .= Legers($row['account_id']). ", ";
           
            $csv_output .= ($row['credit']) . ", ";
         
         $csv_output .= "\n"; }
$currenttpp+=$row['credit'];
 }

 $current=$current+$currenttp+$currenttpp;
$name=" ";
  $csv_output .= $name .", ";$csv_output .= ($current) . ", ";
         
         $csv_output .= "\n";
 $csv_output .= "CURRENT LIABILITIES";
   $csv_output .= "\n";
  $c=mysql_query("select  sum(credit)-sum(debit)as credit,ledgers.account_id as account_id   from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='2'
group by ledgers.account_id


");
while($row=mysql_fetch_array($c)){
if($row['credit']<0){
$cu=$row['credit']*-1;
}
else{
$cu=$row['credit'];
}if($cu!=0.00){
 $csv_output .= Legers($row['account_id']). ", ";
           
            $csv_output .= ($row['credit']) . ", ";
         
         $csv_output .= "\n"; }
if($row['credit']<0){
$ty=$row['credit']*-1;
$currentl+=$ty;
}else{
$currentl+=$row['credit'];
}
 }
  $csv_output .= "STATUTORY DEDUCTIONS";
    $csv_output .= "\n";

  $c=mysql_query("select  sum(credit)-sum(debit)as credit,ledgers.account_id as account_id   from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='12'

group by ledgers.account_id


");
while($row=mysql_fetch_array($c)){
 $csv_output .= Legers($row['account_id']). ", ";
           
            $csv_output .= ($row['credit']) . ", ";
         
         $csv_output .= "\n"; 
$currentll1+=$row['credit'];
 }
  $csv_output .= "UNPAID SALARIES";
    $csv_output .= "\n";

  $c=mysql_query("select  sum(credit)-sum(debit)as credit,ledgers.account_id as account_id   from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='11'

group by ledgers.account_id


");
while($row=mysql_fetch_array($c)){
 $csv_output .= Legers($row['account_id']). ", ";
           
            $csv_output .= ($row['credit']) . ", ";
         
         $csv_output .= "\n"; 
$currentll+=$row['credit'];
 }
$currentl0=$currentl+$currentll+$currentll1;
$name=" ";
  $csv_output .= $name .", ";$csv_output .= ($current1) . ", ";
         
         $csv_output .= "\n";
$name='NET CURRENT ASSETS';
  $csv_output .= $name .", ";$csv_output .= ($current-$currentl0) . ", ";
         
         $csv_output .= "\n";
		 $name=" ";
  $csv_output .= $name .", ";$csv_output .= ($fixedd+($current-$currentl0)+$currenttpp) . ", ";
         
         $csv_output .= "\n";


 
		
		//closing while loop
     //closing if stmnt

?>

