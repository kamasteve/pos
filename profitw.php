<?require_once('functions.php');


$date1=$_POST['date1'];
$date2=$_POST['date2'];
//Now that we've created such a nice heading for our html table, lets create a heading for our csv table
$csv_hdr=" PACEMART JUICES & CANDIES \n";
$csv_hdr=" Profit & Loss Statement For Dates Between $date1 To $date2 \n";


//Quickly create a variable for our output that'll go into the CSV file (we'll make it blank to start).
    $csv_output="";
	
// Ok, we're done with the table heading, lets connect to the database
    $database="test";
    mysql_connect("localhost","root","");
    mysql_select_db("gikomba");
    mysql_set_charset('utf8');
    mysql_query('SET NAMES UTF-8');

// Lets say we wanted a table with all orders, their products and totals...a summary report of sorts
 $h=mysql_query("select  sum(credit)as credit,ledgers.account_id as account_id from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='3'

and ledgers.date between '$date1' and '$date2'
group by ledgers.account_id
having credit>0
");
 $csv_output .= "INCOME";
   $csv_output .= "\n";
// If our query has some assetss, lets store them in array of rows.
   
    
        //While our rows array has stuff in it...meaning it has column data, lets print it to each of the cells in our table
        while ($row = mysql_fetch_assoc($h)) {
//here we are displaying the contents of the field or column in our rows array for a particular row.
            //while we're at it we might as well store the data in comma separated values (csv) format in the csv_output variable for later use.
            $csv_output .= Legers($row['account_id']). ", ";
           
            $csv_output .= ($row['credit']) . ", ";
         
         $csv_output .= "\n";  
         $income+=$row['credit'];  

        }
 $name='TOTAL INCOME';
  $csv_output .= $name .", ";
   
           
            $csv_output .= ($income) . ", ";
         
         $csv_output .= "\n";		
		 $de=mysql_query("select (datediff(NOW(),ledgers.date)/365)*(dep/100*sum(debit)) as current from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
inner join accounts on accounts.id=ledgers.account_id
where group_id='6'

group by ledgers.account_id");
while($row=mysql_fetch_array($de)){

$dep+=$row['current'];
 }
		 $csv_output .= "DIRECT COSTS";
   $csv_output .= "\n";
		$h=mysql_query("select  sum(debit)as credit,ledgers.account_id as account_id   from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='7'

and ledgers.date between '$date1' and '$date2'
group by ledgers.account_id
having credit>0
");

// If our query has some assetss, lets store them in array of rows.
   
    
        //While our rows array has stuff in it...meaning it has column data, lets print it to each of the cells in our table
        while ($row = mysql_fetch_assoc($h)) {
//here we are displaying the contents of the field or column in our rows array for a particular row.
            //while we're at it we might as well store the data in comma separated values (csv) format in the csv_output variable for later use.
            $csv_output .= Legers($row['account_id']). ", ";
           
            $csv_output .= ($row['credit']) . ", ";
         
         $csv_output .= "\n";  
          $cost+=$row['credit']; 

        } 
		 $name='TOTAL COSTS';
  $csv_output .= $name .", ";
   
           
            $csv_output .= ($cost) . ", ";
         
         $csv_output .= "\n"; $name='GROSS PROFIT';
  $csv_output .= $name .", ";
   
           
            $csv_output .= ($income-$cost) . ", ";
         
         $csv_output .= "\n";
		 
		 $csv_output .= "EXPENSES";
   $csv_output .= "\n";
		$h=mysql_query("select  sum(debit)-sum(credit)as credit,ledgers.account_id as account_id   from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
where group_id='1' 

and ledgers.date between '$date1' and '$date2'

group by ledgers.account_id
having credit>0
");

// If our query has some assetss, lets store them in array of rows.
   
    
        //While our rows array has stuff in it...meaning it has column data, lets print it to each of the cells in our table
        while ($row = mysql_fetch_assoc($h)) {
//here we are displaying the contents of the field or column in our rows array for a particular row.
            //while we're at it we might as well store the data in comma separated values (csv) format in the csv_output variable for later use.
            $csv_output .= Legers($row['account_id']). ", ";
           
            $csv_output .= ($row['credit']) . ", ";
         
         $csv_output .= "\n";  
           $expenses+=$row['credit'];

        }
		      $name='DEPRECIATION';
  $csv_output .= $name .", ";
   
           
            $csv_output .= ($dep) . ", ";
         
         $csv_output .= "\n"; 
		
         $name='TOTAL EXPENSES';
  $csv_output .= $name .", ";
   
           
            $csv_output .= ($expenses+$dep) . ", ";
         
         $csv_output .= "\n";  

        $name='PROFIT FOR PERIOD';
  $csv_output .= $name .", ";
   
           
            $csv_output .= (($income-$cost)-($expenses+$dep)) . ", ";
         
         $csv_output .= "\n";
		
		//closing while loop
     //closing if stmnt
	unset($_SESSION['date1']);
unset($_SESSION['date2']);
unset($_SESSION['id']);
?>

