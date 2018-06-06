<?require_once('functions.php');


$name=Acc($id);
//Now that we've created such a nice heading for our html table, lets create a heading for our csv table
$csv_hdr="$name Ledger Report   For Dates Between $date1 And $date2 \n";
    $csv_hdr .= "Date, Sub Account, Account, No, Description, Debit, Credit, Opening";
//Quickly create a variable for our output that'll go into the CSV file (we'll make it blank to start).
    $csv_output="";
	
// Ok, we're done with the table heading, lets connect to the database
    $database="test";
    mysql_connect("localhost","root","");
    mysql_select_db("gikomba");
    mysql_set_charset('utf8');
    mysql_query('SET NAMES UTF-8');

// Lets say we wanted a table with all orders, their products and totals...a summary report of sorts
    $result=mysql_query("select *,sum(credit)as 
credit,sum(debit) as debit,concat(receipt,' ',invoice) as receip from ledgers where account_id='$id' 
and date between '$date1' and '$date2' group by id order by date");
 $group=GetGroup($id);
  $opening=LedgerBalance($id,$date1);
   $csv_output .= $row[''] . ", ";
           
            $csv_output .= ($row['']) . ", ";
         
            $csv_output .= ($row['']) . ", ";
          //repeat for all remaining fields or columns we have headings for...
            $csv_output .= $row[''] . ", ";
         
            $csv_output .= $row[''] . ", ";
            $csv_output .= $row[''] . ", ";

           $csv_output .= $row[''] . ", ";
            $csv_output .= $opening . "\n"; 
// If our query has some results, lets store them in array of rows.
    if (mysql_num_rows($result) > 0) {
    
        //While our rows array has stuff in it...meaning it has column data, lets print it to each of the cells in our table
        while ($row = mysql_fetch_assoc($result)) {
		  if($group==4||$group==1||$group==7||$group==6||$group==9||$group==10){
 $opening=$opening+$row['debit']-$row['credit'];
 $closing=$opening;
 }
  if($group==3||$group==2||$group==5){
 $opening=$opening+$row['credit']-$row['debit'];
  $closing=$opening;
 }
//here we are displaying the contents of the field or column in our rows array for a particular row.
            //while we're at it we might as well store the data in comma separated values (csv) format in the csv_output variable for later use.
            $csv_output .= $row['date'] . ", ";
           
            $csv_output .= SubName($row['sub']) . ", ";
         
            $csv_output .= Acc($row['account_id']) . ", ";
          //repeat for all remaining fields or columns we have headings for...
            $csv_output .= $row['receipt'] . ", ";
         
            $csv_output .= $row['description'] . ", ";
            $csv_output .= $row['debit'] . ", ";

           $csv_output .= $row['credit'] . ", ";
            $csv_output .= $opening . "\n";  
           

        } //closing while loop
    } //closing if stmnt
	unset($_SESSION['date1']);
unset($_SESSION['date2']);
unset($_SESSION['id']);
?>

