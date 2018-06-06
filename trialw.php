<?require_once('functions.php');



//Now that we've created such a nice heading for our html table, lets create a heading for our csv table
$csv_hdr=" PACEMART JUICES & CANDIES \n";
$csv_hdr=" Trial Balance As At $date \n";
    $csv_hdr .= "Account, Debit, Credit \n";

//Quickly create a variable for our output that'll go into the CSV file (we'll make it blank to start).
    $csv_output="";
	
// Ok, we're done with the table heading, lets connect to the database
    $database="test";
    mysql_connect("localhost","root","");
    mysql_select_db("gikomba");
    mysql_set_charset('utf8');
    mysql_query('SET NAMES UTF-8');

// Lets say we wanted a table with all orders, their products and totals...a summary report of sorts
$assets=mysql_query("select sum(debit)-sum(credit)as debit,ledgers.account_id as id from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='4' 
and date<='$date'
 group by id
 
 having debit>0
");

// If our query has some assetss, lets store them in array of rows.
   
    
        //While our rows array has stuff in it...meaning it has column data, lets print it to each of the cells in our table
        while ($row = mysql_fetch_assoc($assets)) {
//here we are displaying the contents of the field or column in our rows array for a particular row.
            //while we're at it we might as well store the data in comma separated values (csv) format in the csv_output variable for later use.
            $csv_output .= Legers($row['id']). ", ";
           
            $csv_output .= ($row['debit']) . ", ";
         
         $csv_output .= "\n";  
           

        } 
		$assets=mysql_query("select sum(debit)-sum(credit)as debit,ledgers.account_id as id from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='4'
and date<='$date' group by id
 having debit<0
");

// If our query has some assetss, lets store them in array of rows.
   
    
        //While our rows array has stuff in it...meaning it has column data, lets print it to each of the cells in our table
        while ($row = mysql_fetch_assoc($assets)) {
//here we are displaying the contents of the field or column in our rows array for a particular row.
            //while we're at it we might as well store the data in comma separated values (csv) format in the csv_output variable for later use.
            $csv_output .= Legers($row['id']). ", ";
            $csv_output .=  ", ";
            $csv_output .= ($row['debit']*-1) . ", ";
         
         $csv_output .= "\n";  
           

        }
		$assets=mysql_query("select sum(debit)-sum(credit)as debit,ledgers.account_id as id from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='10'   group by id
 having debit>0
");

// If our query has some assetss, lets store them in array of rows.
   
    
        //While our rows array has stuff in it...meaning it has column data, lets print it to each of the cells in our table
        while ($row = mysql_fetch_assoc($assets)) {
//here we are displaying the contents of the field or column in our rows array for a particular row.
            //while we're at it we might as well store the data in comma separated values (csv) format in the csv_output variable for later use.
            $csv_output .= Legers($row['id']). ", ";
           
            $csv_output .= ($row['debit']) . ", ";
         
         $csv_output .= "\n";  
           

        } 
		$assets=mysql_query("select sum(debit)-sum(credit)as debit,ledgers.account_id as id from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='10' 
and date<='$date' group by id
 having debit<0
");

// If our query has some assetss, lets store them in array of rows.
   
    
        //While our rows array has stuff in it...meaning it has column data, lets print it to each of the cells in our table
        while ($row = mysql_fetch_assoc($assets)) {
//here we are displaying the contents of the field or column in our rows array for a particular row.
            //while we're at it we might as well store the data in comma separated values (csv) format in the csv_output variable for later use.
            $csv_output .= Legers($row['id']). ", ";
            $csv_output .=  ", ";
            $csv_output .= ($row['debit']*-1) . ", ";
         
         $csv_output .= "\n";  
           

        }
		$assets=mysql_query("select sum(debit)-sum(credit)as debit,ledgers.account_id as id from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='1'
and date<='$date' group by id
 having debit>0
");

// If our query has some assetss, lets store them in array of rows.
   
    
        //While our rows array has stuff in it...meaning it has column data, lets print it to each of the cells in our table
        while ($row = mysql_fetch_assoc($assets)) {
//here we are displaying the contents of the field or column in our rows array for a particular row.
            //while we're at it we might as well store the data in comma separated values (csv) format in the csv_output variable for later use.
            $csv_output .= Legers($row['id']). ", ";
           
            $csv_output .= ($row['debit']) . ", ";
         
         $csv_output .="\n";  
           

        }
			$assets=mysql_query("select sum(debit)-sum(credit)as debit,ledgers.account_id as id from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='7'
and date<='$date' group by id
 having debit>0
");

// If our query has some assetss, lets store them in array of rows.
   
    
        //While our rows array has stuff in it...meaning it has column data, lets print it to each of the cells in our table
        while ($row = mysql_fetch_assoc($assets)) {
//here we are displaying the contents of the field or column in our rows array for a particular row.
            //while we're at it we might as well store the data in comma separated values (csv) format in the csv_output variable for later use.
            $csv_output .= Legers($row['id']). ", ";
           
            $csv_output .= ($row['debit']) . ", ";
         
         $csv_output .="\n";  
           

        }
			
		$assets=mysql_query("select *,SUM(debit)-(datediff('$date',ledgers.date)/365)*(dep/100*SUM(debit)) as debit,accounts.id as id from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
inner join accounts on accounts.id=ledgers.account_id
where group_id='6'
and date<='$date'
GROUP BY ledgers.account_id
");

// If our query has some assetss, lets store them in array of rows.
   
    
        //While our rows array has stuff in it...meaning it has column data, lets print it to each of the cells in our table
        while ($row = mysql_fetch_assoc($assets)) {
//here we are displaying the contents of the field or column in our rows array for a particular row.
            //while we're at it we might as well store the data in comma separated values (csv) format in the csv_output variable for later use.
            $csv_output .= Legers($row['id']). ", ";
           
            $csv_output .= ($row['debit']) . ", ";
         
         $csv_output .= "\n";  
           

        }		
		$assets=mysql_query("select *,SUM(debit)-(datediff('$date',ledgers.date)/365)*(dep/100*SUM(debit)) as debit,accounts.id as id from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
inner join accounts on accounts.id=ledgers.account_id
where group_id='6'
and date<='$date'
GROUP BY ledgers.account_id
");

// If our query has some assetss, lets store them in array of rows.
   
    
        //While our rows array has stuff in it...meaning it has column data, lets print it to each of the cells in our table
        while ($row = mysql_fetch_assoc($assets)) {
//here we are displaying the contents of the field or column in our rows array for a particular row.
            //while we're at it we might as well store the data in comma separated values (csv) format in the csv_output variable for later use.
           
           $dep+=$row['debit'];

        }
		$name='DEPRECIATION';
		  $csv_output .= $name. ", ";
           
            $csv_output .= $dep . ", ";
         
         $csv_output .= "\n"; 
		 
	
			
	
						$assets=mysql_query("select sum(credit)-sum(debit)as debit,ledgers.account_id as tid from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='3'   group by tid
 and date<='$date'
 having debit>0
");

// If our query has some assetss, lets store them in array of rows.
   
    
        //While our rows array has stuff in it...meaning it has column data, lets print it to each of the cells in our table
        while ($row = mysql_fetch_assoc($assets)) {
//here we are displaying the contents of the field or column in our rows array for a particular row.
            //while we're at it we might as well store the data in comma separated values (csv) format in the csv_output variable for later use.
            $csv_output .= Legers($row['tid']). ", ";
            $csv_output .=  ", ";
            $csv_output .= ($row['debit']) . ", ";
         
         $csv_output .= "\n";  
           

        }
		
		$assets=mysql_query("select sum(credit)-sum(debit)as debit,ledgers.account_id as id from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='2'
and date<='$date' group by id
 having debit>0
");

// If our query has some assetss, lets store them in array of rows.
   
    
        //While our rows array has stuff in it...meaning it has column data, lets print it to each of the cells in our table
        while ($row = mysql_fetch_assoc($assets)) {
//here we are displaying the contents of the field or column in our rows array for a particular row.
            //while we're at it we might as well store the data in comma separated values (csv) format in the csv_output variable for later use.
            $csv_output .= Legers($row['id']). ", ";
            $csv_output .=  ", ";
            $csv_output .= ($row['debit']) . ", ";
         
         $csv_output .= "\n";  
           

        } 
		$assets=mysql_query("select sum(credit)-sum(debit)as debit,ledgers.account_id as id from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='2'
and date<='$date' group by id
 having debit<0
");

// If our query has some assetss, lets store them in array of rows.
   
    
        //While our rows array has stuff in it...meaning it has column data, lets print it to each of the cells in our table
        while ($row = mysql_fetch_assoc($assets)) {
//here we are displaying the contents of the field or column in our rows array for a particular row.
            //while we're at it we might as well store the data in comma separated values (csv) format in the csv_output variable for later use.
            $csv_output .= Legers($row['id']). ", ";
			 $csv_output .= ($row['debit']*-1) . ", ";
            $csv_output .=  ", ";
           
         
         $csv_output .= "\n";  
           

        }
			$assets=mysql_query("select sum(credit)-sum(debit)as debit,ledgers.account_id as id from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='11' 
and date<='$date' group by id
 having debit>0
");

// If our query has some assetss, lets store them in array of rows.
   
    
        //While our rows array has stuff in it...meaning it has column data, lets print it to each of the cells in our table
        while ($row = mysql_fetch_assoc($assets)) {
//here we are displaying the contents of the field or column in our rows array for a particular row.
            //while we're at it we might as well store the data in comma separated values (csv) format in the csv_output variable for later use.
            $csv_output .= Legers($row['id']). ", ";
           
            $csv_output .= ($row['debit']) . ", ";
         
         $csv_output .= "\n";  
           

        } 
		$assets=mysql_query("select sum(credit)-sum(debit)as debit,ledgers.account_id as id from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='11'
and date<='$date' group by id
 having debit<0
");

// If our query has some assetss, lets store them in array of rows.
   
    
        //While our rows array has stuff in it...meaning it has column data, lets print it to each of the cells in our table
        while ($row = mysql_fetch_assoc($assets)) {
//here we are displaying the contents of the field or column in our rows array for a particular row.
            //while we're at it we might as well store the data in comma separated values (csv) format in the csv_output variable for later use.
            $csv_output .= Legers($row['id']). ", ";
            $csv_output .=  ", ";
            $csv_output .= ($row['debit']) . ", ";
         
         $csv_output .= "\n";  
           

        }	$assets=mysql_query("select sum(credit)-sum(debit)as debit,ledgers.account_id as id from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='12'
and date<='$date' group by id
 having debit>0
");

// If our query has some assetss, lets store them in array of rows.
   
    
        //While our rows array has stuff in it...meaning it has column data, lets print it to each of the cells in our table
        while ($row = mysql_fetch_assoc($assets)) {
//here we are displaying the contents of the field or column in our rows array for a particular row.
            //while we're at it we might as well store the data in comma separated values (csv) format in the csv_output variable for later use.
            $csv_output .= Legers($row['id']). ", ";
           
            $csv_output .= ($row['debit']) . ", ";
         
         $csv_output .= "\n";  
           

        } 
		$assets=mysql_query("select sum(credit)-sum(debit)as debit,ledgers.account_id as id from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='12' 
and date<='$date' group by id
 having debit<0
");

// If our query has some assetss, lets store them in array of rows.
   
    
        //While our rows array has stuff in it...meaning it has column data, lets print it to each of the cells in our table
        while ($row = mysql_fetch_assoc($assets)) {
//here we are displaying the contents of the field or column in our rows array for a particular row.
            //while we're at it we might as well store the data in comma separated values (csv) format in the csv_output variable for later use.
            $csv_output .= Legers($row['id']). ", ";
            $csv_output .=  ", ";
            $csv_output .= ($row['debit']) . ", ";
         
         $csv_output .= "\n";  
           

        }
		
				$assets=mysql_query("select sum(credit)-sum(debit)as debit,ledgers.account_id as id  from ledgers
inner join group_accounts on group_accounts.account_id=ledgers.account_id
 where group_id='5'
and date<='$date' group by id
");

// If our query has some assetss, lets store them in array of rows.
   
    
        //While our rows array has stuff in it...meaning it has column data, lets print it to each of the cells in our table
        while ($row = mysql_fetch_assoc($assets)) {
//here we are displaying the contents of the field or column in our rows array for a particular row.
            //while we're at it we might as well store the data in comma separated values (csv) format in the csv_output variable for later use.
          $csv_output .= Legers($row['id']). ", ";
            $csv_output .=  ", ";
            $csv_output .= ($row['debit']) . ", ";
         
         $csv_output .= "\n";      
           

        }
		
		//closing while loop
     //closing if stmnt
	unset($_SESSION['date1']);
unset($_SESSION['date2']);
unset($_SESSION['id']);
?>

