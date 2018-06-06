<?
function OtherPayments(){
$yy=mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='10'

");
  echo '<table align="center" frame="BOX"  style="border-color:#000000;font-size:16px ;background-color:#e8e8e8;" frame="BOX" border="0"  width="980px" 
 cellpadding="0"  >
                                                                       
																		              <tr><td style="font-family:Bell Gothic ,Verdana,Arial;">Other Payment Types</td><th>
                                                                     <select name="main" required title="Client type" onChange="showUser(this.value)">
                                                       
                                                            <option></option>
                                                    ';
													
    while ($row = mysql_fetch_array($yy)) {
       $id=$row['account_id'];
	$name=$row['name'];
        echo "<option value=$id>$name</option>";
    }
    echo '</select>';
	echo '<div id="txtHint"></div>';
	
                                           echo'</table>';
}
function MultiPayments(){
$yy=mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='10'
and name<>'Cash'
");
  echo '<table align="center" frame="BOX"  style="border-color:#000000;font-size:16px ;background-color:#e8e8e8;" frame="BOX" border="1"  width="950px" 
 cellpadding="1"  >
                                                                       
																		              <tr><td style="font-family:Bell Gothic ,Verdana,Arial;"><b>Multi Payments Types</td><th>
                                                                     <select name="main" required title="Client type" onChange="showUsers(this.value)">
                                                       
                                                            <option></option>
                                                    ';
													
    while ($row = mysql_fetch_array($yy)) {
       $id=$row['account_id'];
	$name=$row['name'];
        echo "<option value=$id>$name</option>";
    }
    echo '</select>';
	echo '<div id="txtHints"></div>';
	
                                           echo'</table>';
}
function FixedAssets() {
$yy=mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='6'
");
$y=mysql_query("select * from accounts

");
    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
																		              <label>Main Account</label>
                                                                     <select name="main" required title="Client type">
                                                       
                                                            <option></option>
                                                    ';
													
    while ($row = mysql_fetch_array($yy)) {
       $id=$row['account_id'];
	$name=$row['name'];
        echo "<option value=$id>$name</option>";
    }
    echo '</select>';echo'
                                                                            <label>Asset Name</label>
                                                                            <input type="text" name="name" autofocus value="" placeholder="Enter Asset name."
																			title="Enter Asset name." required  />
																			 <label>Purchase Price</label>
                                                                            <input type="text" name="price" autofocus value="" placeholder="Enter Purchase Price."
																			title="Enter Purchase Price." required  />
                                                                            <label>Depriciation Rate</label>
                                                                            <input type="text" name="rate" autofocus value="" placeholder="Enter Depriciation Rate."
																			title="Enter Purchase Price." required  /> 
																			<label>Description</label>
                                                                            <input type="text" name="desc" autofocus value="" placeholder="Enter Description."
																			title="Enter Purchase Price." required  /> 
																			<label>Purchase Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date" id="sd" value=""  readonly />
																		
                                                                   

                    <label>Payment Type</label>
                                                                     <select name="payment" required title="Client type">
                                                       
                                                            <option></option>
                                                    ';
													
    while ($row = mysql_fetch_array($y)) {
       $id=$row['id'];
	$name=$row['name'];
        echo "<option value=$id>$name</option>";
    }
    echo '</select>';												 

                                                         
                                                                         echo '   
                                                                            <button name="ledger">Add Asset</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
}
function Employee() {
$y=mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='10'");
    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
                                                                            <label>Employee Name</label>
                                                                            <input type="text" name="name" 
																			autofocus value="" placeholder="Enter Employee name."
																			title="Enter Asset name." required  />
                                                                                 <label>Employee No</label>
                                                                            <input type="text" name="eno" 
																			autofocus value="" placeholder="Enter Employee No."
																			title="Enter Asset No." required  />
																			  <label>Id No</label>
                                                                            <input type="text" name="id" 
																			autofocus value="" placeholder="Enter Employee Id No."
																			title="Enter Asset No." required  />
																			<label> Phone</label>
                                                                            <input type="text" name="phone" 
																			autofocus value="" placeholder="Enter Employee Phone No."
																			title="Enter Asset No." required  />
																			<label> Pin No</label>
                                                                            <input type="text" name="pin" 
																			autofocus value="" placeholder="Enter Employee Pin No."
																			title="Enter Asset No</." required  />
																			<label> N.H.I.F No</label>
                                                                            <input type="text" name="nhif" 
																			autofocus value="" placeholder="Enter Employee NHIF No."
																			title="Enter Asset No</." required  />
																			<label> N.S.S.F No</label>
                                                                            <input type="text" name="nssf" 
																			autofocus value="" placeholder="Enter Employee Pin No."
																			title="Enter Asset No." required  />
																			
<label> Department</label>
                                                                            <input type="text" name="dep" 
																			autofocus value="" placeholder="Enter Employee Department."
																			title="Enter Asset No." required  />
		<label>Position</label>
                                                                            <input type="text" name="pos" 
																			autofocus value="" placeholder="Enter Employee Position."
																			title="Enter Asset No." required  />	
																		        <label>Bank Type</label>
                                                                     <select name="bank" required title="Vote type">
                                                       
                                                            <option></option>
                                                    ';
													
    while ($row = mysql_fetch_array($y)) {
       $id=$row['account_id'];
	$name=$row['name'];
        echo "<option value=$id>$name</option>";
    }
    echo '</select>
<label> Account No</label>
                                                                            <input type="text" name="account" 
																			autofocus value="" placeholder="Enter Employee Account No."
																			title="Enter Asset No." required  />																			

                                                         
                                                                            
                                                                            <button name="ledger">Add Employee</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
}
function CreatePayroll($id){

$r=mysql_query("select * from pgroups where group_id='1' and status='fixed'");
$b=mysql_query("select * from pgroups where group_id='2' AND NAME<>'NHIF' and status='fixed'");

$i = 0;


 echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">';
while($row=mysql_fetch_array($r)){
$name=ucfirst(strtolower($row['name']));
 echo "<label>{$name}</label>
                                                                            <input type='text' name='allowance[$i]' placeholder='{$row['name']}' 
																			 value='' 
																			 required  />
																			  <input type='hidden' name='group[$i]'
																			 value='{$row['id']}'  
																			 required  />";
																			++$i;

}
$l= 0;	
while($row=mysql_fetch_array($b)){
$name=ucfirst(strtolower($row['name']));
 echo "<label>{$name}</label>
                                                                            <input type='text' name='deductions[$l]'
																			 value=''  placeholder='{$row['name']}' 
																			 required  />
																			   <input type='hidden' name='groupp[$l]'
																			 value='{$row['id']}'  
																			 required  />";
																			++$l;

}
  echo '<input type="hidden" name="employee" 
																			autofocus value="'.$id.'" placeholder="Enter Employee Account No."
																			title="Enter Asset No." required  />';
                echo '  <button name="payroll">Create Payroll</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';																																			
}
function SubAccountP() {

$d=mysql_query("select * from accounts where name='SALARIES & WAGES'");
if(mysql_num_rows($d)==0){
$f=mysql_query("insert into accounts(name)values('SALARIES & WAGES')");
$id=mysql_insert_id();
$c=mysql_query("insert into group_accounts(account_id,group_id)values('$id','1')");


}
$y=mysql_query("select * from accounts where name='SALARIES & WAGES'");
$r=mysql_query("select * from sayroll");
    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
																		        <label>Main Account</label>
                                                                     <select name="id"  title="Client type">
                                                       
                                                            <option></option>
                                                    ';
													
    while ($row = mysql_fetch_array($y)) {
       $id=$row['id'];
	$name=$row['name'];
        echo "<option value=$id>$name</option>";
    }
    echo '</select>
	 																	        <label>Vote Type</label>
                                                                     <select name="idd"  title="Vote type">
                                                       
                                                            <option></option>
                                                    ';
													
    while ($row = mysql_fetch_array($r)) {
       $id=$row['id'];
	$name=$row['name'];
        echo "<option value=$id>$name</option>";
    }
    echo '</select>
										        <label>Type</label>
                                                                     <select name="type" required title="Client type">
                                                       
                                                            <option></option>
                                                    ';
													
    
        echo "<option value=fixed>Fixed</option>";
     echo "<option value=vary>Not Fixed</option>";
    echo '</select>';

    echo '
                                                                            <label>Vote Name</label>
                                                                            <input type="text" name="name" autofocus value="" placeholder="Enter vote name."
																			title="Enter Sub name." required  />
                                                                                       
                                                                   

																	

                                                         
                                                                            
                                                                            <button name="ledgers">Add Vote Name</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
}
function PAForm() {
$y=mysql_query("select * from sayroll");
$yy=mysql_query("select * from group_heads
 where id='12'");

    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
																		
																        <label>Group Head</label>
                                                                     <select name="idd" required title="Group type">
                                                       
                                                            <option></option>
                                                    ';
													
    while ($row = mysql_fetch_array($yy)) {
       $id=$row['id'];
	$name=$row['name'];
        echo "<option value=$id>$name</option>";
    }
    echo '</select>
																		        <label>Vote Type</label>
                                                                     <select name="id" required title="Vote type">
                                                       
                                                            <option></option>
                                                    ';
													
    while ($row = mysql_fetch_array($y)) {
       $id=$row['id'];
	$name=$row['name'];
        echo "<option value=$id>$name</option>";
    }
    echo '</select>
															        <label>Type</label>
                                                                     <select name="type" required title="Client type">
                                                       
                                                            <option></option>
                                                    ';
													
    
        echo "<option value=fixed>Fixed</option>";
     echo "<option value=vary>Not Fixed</option>";
    echo '</select>
	                                                <label>Vote Name</label>
                                                                            <input type="text" name="name" autofocus value="" placeholder="Enter Vote name."
																			title="Enter Expense name." required  />
                                                                            
                                                                   

																	

                                                         
                                                                            
                                                                            <button name="ledger">Add Payroll Vote</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
}
function EditFixed($id){

$r=mysql_query("select *,sum(debit)+sum(credit)as sum from fixed where employee_id='$id' group by group_id");
//$b=mysql_query("select * from pgroups where group_id='2' and status='fixed'");
$employee=Employees($id);
$i = 0;


 echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">';
																		 echo "<label><b>Employee</b></label>
                                                                            <input type='text' name='name' placeholder='' 
																			 value='{$employee}' 
																			 required readonly/>";
																			 
while($row=mysql_fetch_array($r)){
$name=ucfirst(strtolower(Vname($row['group_id'])));
 echo "<label>{$name}</label>
                                                                            <input type='text' name='allowance[$i]' 
																			 value='{$row['sum']}' 
																			 required  />
																			  <input type='hidden' name='group[$i]'
																			 value='{$row['id']}'  
																			 required  />";
																			++$i;

}

  echo '<input type="hidden" name="employee" 
																			autofocus value="'.$id.'" placeholder="Enter Employee Account No."
																			title="Enter Asset No." required  />';
                echo '  <button name="fixedp">Edit Payroll For '.$employee.'</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';																																			
}
function Additions($id) {
$y=mysql_query("select * from pgroups where status='vary' and group_id='1'");

    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
																		        <label>Vote Type</label>
                                                                     <select name="id" required title="Client type">
                                                       
                                                            <option></option>
                                                    ';
													
    while ($row = mysql_fetch_array($y)) {
       $id=$row['id'];
	$name=$row['name'];
        echo "<option value=$id>$name</option>";
    }
    echo '</select>
														
	                                                <label>Amount</label>
                                                                            <input type="text" name="amount" autofocus value="" placeholder="Enter Vote Amount."
																			title="Enter Expense name." required  />
																			 <input type="hidden" name="employee" autofocus value="'.$id.'" placeholder="Enter Vote Amount."
																			title="Enter Expense name." required  />
                                                                            
                                                                   
                                                   <label> Date </label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date" id="sd" value=""
																		   readonly />                
																	

                                                         
                                                                            
                                                                            <button name="bon">Adjust Bonuses</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
}
function InvoiceForm() {


    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="invoice_gen.php" autocomplete="off">
						
														
	                                                <label>Delivery Note No</label>
                                                                            <input type="text" name="number" autofocus value="" placeholder="Enter Delivery Note No."
																			title="Enter Delivery Note No" required  />
                                                                            
                                                
                                                         
                                                                            
                                                                            <button name="ded">Produce Invoice</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
}
function Reversal() {


    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="GET" action="" autocomplete="off">
						
														
	                                                <label>Receipt No</label>
                                                                            <input type="text" name="id" autofocus value="" placeholder="Enter Delivery Receipt NO."
																			title="Enter Receipt NO" required  />
                                                                            
                                                
                                                         
                                                                            
                                                                            <button name="ded">Reverse Transaction</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
}
function Deductions($id) {
$y=mysql_query("select * from pgroups where status='vary' and group_id='2'");

    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
																		        <label>Vote Type</label>
                                                                     <select name="id" required title="Client type">
                                                       
                                                            <option></option>
                                                    ';
													
    while ($row = mysql_fetch_array($y)) {
       $id=$row['id'];
	$name=$row['name'];
        echo "<option value=$id>$name</option>";
    }
    echo '</select>
														
	                                                <label>Amount</label>
                                                                            <input type="text" name="amount" autofocus value="" placeholder="Enter Vote Amount."
																			title="Enter Expense name." required  />
                                                                            
                                                   <label> Date </label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date" id="ed" value=""
																		   readonly />                

																		 <input type="hidden" name="employee" autofocus value="'.$id.'" placeholder="Enter Vote Amount."
																			title="Enter Expense name." required  />

                                                         
                                                                            
                                                                            <button name="ded">Adjust Deductions</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
}
function CommitPayroll() {

    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
                                                                           
																		<label> Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date" id="sd" value=""  readonly />
																			


                                                         
                                                                          
                                                                            <button name="add">Create Months Payroll</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
}
function ViewPayroll() {

    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="payroll_report.php" autocomplete="off">
                                                                           
																		<label> Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date" id="sd" value=""  readonly />
																			


                                                         
                                                                          
                                                                            <button name="add">View Months Payroll</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
														}
														function PrintPayslip() {

    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="payslip.php" autocomplete="off">
                                                                           
																		<label> Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date" id="sd" value=""  readonly />
																			


                                                         
                                                                          
                                                                            <button name="add">Print Payslip</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
}
function ComputeNet($date){

$r=mysql_query("select sum(debit)-sum(credit)as net,bank from employee_table
inner join employee on employee.employee_id=employee_table.employee_id

where month(employee_table.date)=month('$date')
and status='NOT PAID'
and year(employee_table.date)=year('$date')

group by bank");

 
    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">';
                                                                           
  	echo '	 <label>Bank</label>
                                                                     <select name="bank" required title="Client type">
                                                       
                                                            <option></option>
                                                                                                                         <form method="POST" action="" autocomplete="off">';
while($row=mysql_fetch_array($r)){
$name='';

   $id=$row['bank'];
	$name.=Mode($row['bank']);
	$name.=' (';
	$name.=number_format($row['net']);
	$name.=')';
        echo "<option value=$id>$name</option>";
}
   echo '</select>';

echo '<label>Cheque No</label>
                                                                            <input type="text" name="cheque" 
																			autofocus value="" placeholder="Enter Cheque No."
																			title="Enter Asset No." required  />
    <label> Date </label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date" id="sd" value=""
																		   readonly /> 	';		


	echo'
                                                                            <button name="add">POST CHEQUE</button>
                                                                        </form>
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>';
																		   

}
function Customers() {

    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="get" action="" autocomplete="off">
                                                                            <label>Customer Name</label>
                                                                            <input type="text" name="name" autofocus value="" placeholder="Enter customer name."
																			title="Enter Customer name." required  />
                                                                              <label>Contacts</label>
                                                                            <input type="text" name="contacts" autofocus value="" placeholder="Enter Customer contacts."
																			title="Enter Customer contacts" required  />

  <label>Address</label>
                                                                            <input type="text" name="address" autofocus value="" placeholder="Enter Address."
																			title="Enter Address." required  />
																			
																	

                                                         
                                                                            
                                                                            <button name="ledger">Add Customer Account</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
}
function DebtorS() {
$ty=mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='2'");


    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
                                                                           
                                                                            
                                                                            
                                                                           
															
																			 <label>Supplier </label>
                                                                     <select name="supplier" required title="Client type">
                                                       
                                                            <option></option>
                                                    ';
													
    while ($row = mysql_fetch_array($ty)) {
       $id=$row['account_id'];
	$name=$row['name'];
        echo "<option value=$id>$name</option>";
    }
    echo '</select>';

        	

	echo  '<label>Amount</label>
                                                                            <input type="text" name="amount" 
																			autofocus value="" placeholder="Enter Amount."
																			title="Enter Amount." required  />';                                                      
	
	 echo '<label> Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date" id="sd" value=""  readonly />
																			';
	echo'
                                                                            <button name="add">Create Debt Swap</button>
                                                                        </form>
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>';
}
function DebtorForm() {
$ty=mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='4'
and status='ACTIVE'
order by name");
$ye=mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='10' or group_id='4'
and status='ACTIVE'
order by name");

    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
                                                                           
                                                                            
                                                                            
                                                                           
															
																			 <label>Client </label>
                                                                     <select name="client" required title="Client type">
                                                       
                                                            <option></option>
                                                    ';
													
    while ($row = mysql_fetch_array($ty)) {
       $id=$row['account_id'];
	$name=$row['name'];
        echo "<option value=$id>$name</option>";
    }
    echo '</select>';

        		echo '	 <label>Payment Type</label>
                                                                     <select name="payment" required title="Client type">
                                                       
                                                            <option></option>
                                                    ';
													
    while ($row = mysql_fetch_array($ye)) {
       $id=$row['account_id'];
	$name=$row['name'];
        echo "<option value=$id>$name</option>";
    }
    echo '</select>';

	echo  '<label>Amount</label>
                                                                            <input type="text" name="amount" 
																			autofocus value="" placeholder="Enter Amount."
																			title="Enter Amount." required  />';                                                      
	
	 echo '<label> Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date" id="sd" value=""  readonly />
																			';
	echo'
                                                                            <button name="add">Make Payment</button>
                                                                        </form>
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>';
}
function CustomerRecord(){

$ty=mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='3'
");
$y=mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='4'
");


    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">';
                                                                           
                                                                            
                                                                            
                   	                                                  
															
																			echo ' <label>Income</label>
                                                                     <select name="income" required title="Client type">
                                                       
                                                            <option></option>
                                                    ';
													
    while ($row = mysql_fetch_array($ty)) {
       $id=$row['id'];
	$name=$row['name'];
        echo "<option value=$id>$name</option>";
    }
    echo '</select>';
	
													echo '	 <label>Customer</label>
                                                                     <select name="customer" required title="Client type">
                                                       
                                                            <option></option>
                                                    ';
													
    while ($row = mysql_fetch_array($y)) {
       $id=$row['account_id'];
	$name=$row['name'];
        echo "<option value=$id>$name</option>";
    }
    echo '</select>';

	echo  '<label>Amount</label>
                                                                            <input type="text" name="amount" 
																			autofocus value="" placeholder="Enter Amount."
																			title="Enter Amount." required  />';
																			
		 echo '<label> Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date" id="sd" value=""  readonly />
																			';
																				echo  '<label>InvoiceNo</label>
                                                                            <input type="text" name="invoice" 
																			autofocus value="" placeholder="Enter Invoice no."
																			  />';
																			  
	

	echo'
                                                                            <button name="add">Record Income</button>
                                                                        </form>
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>';


}
function ChangePass() {

    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
                                                                            <label>User Name</label>
                                                                            <input type="text" name="user" 
																			autofocus value="" placeholder="Enter User name."
																			title="Enter Asset name." required  />
																			     <label>Old Password</label>
                                                                            <input type="password" name="old" 
																			autofocus value="" placeholder="Enter Old Password."
																			title="Enter Asset name." required  />
                                                                                 <label>New Password</label>
                                                                            <input type="password" name="new" 
																			autofocus value="" placeholder="Enter New Password."
																			title="Enter Asset No</." required  />
                                                                   
     <label>Confirm Password</label>
                                                                            <input type="password" name="new2" 
																			autofocus value="" placeholder="Confirm  New Password."
																			title="Enter price." required  />
																			
                                                       

                                                         
                                                                            
                                                                            <button name="ledger">Change Password</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
}
function VoucherForm($transid){
if($transid!=''){
 $amount=GetLoan(base64_encode($transid));}

$r=mysql_query("select * from  accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='10'");
echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
																		        <label>Payment Type</label>
                                                                     <select name="id" required title="Client type">
                                                       
                                                            <option></option>
                                                    ';

				while ($row = mysql_fetch_array($r))
				{
								$id = $row['account_id'];
								$name = $row['name'];
								echo "<option value=$id>$name</option>";
				}
				echo '</select>';
				echo '
                                                                            <label>Amount Payable</label>
                                                                            <input type="text" name="amount" value="'.$amount.'"
																			 readonly/>';

				echo '
                                                                            <label>Cheque No</label>
                                                                            <input type="text" name="cheque" autofocus value="" placeholder="Enter Cheque No."
																			title="Enter cheque No." required  />
																			<label> Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date" id="ed" value=""  readonly />
                                                                                       
                                                                   

																	

                                                         
                                                                            
                                                                            <button name="voucher">Process Voucher</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';


}
function OVoucherForm($session){

$s=mysql_query("select * from payments where session='$session'");
$roww=mysql_fetch_array($s);
$r=mysql_query("select * from  accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='10'");
echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
																		        <label>Payment Type</label>
                                                                     <select name="id" required title="Client type">
                                                       
                                                            <option></option>
                                                    ';

				while ($row = mysql_fetch_array($r))
				{
								$id = $row['account_id'];
								$name = $row['name'];
								echo "<option value=$id>$name</option>";
				}
				echo '</select>';
					echo '
                                                                            <label>Paid To</label>
                                                                            <input type="text" name="name" value="'.guarantorname(base64_encode($roww['member'])).'"
																			 readonly/>';
																			 	echo '
                                                                            <label>Voucher No</label>
                                                                            <input type="text" name="number" value="'.$roww['number'].'"
																			 readonly/>';
				echo '
                                                                            <label>Amount Payable</label>
                                                                            <input type="text" name="amount" value="'.$roww['amount'].'"
																			 readonly/>';

				echo '
                                                                            <label>Cheque No</label>
                                                                            <input type="text" name="cheque" autofocus value="" placeholder="Enter Cheque No."
																			title="Enter cheque No." required  />
																			<label> Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date" id="ed" value=""  readonly />
                                                                                       
                                                                   

																	

                                                         
                                                                            
                                                                            <button name="voucher">Process Voucher</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';


}
	function CancelForm()
{

				echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
                                                                            
																			<label>Amount</label>
                                                                            <input type="text" name="amount" autofocus value="" 
																			placeholder="Enter Amount."
																			title="Enter Amount." required  /> 
																		<label> Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date" id="ed" value=""  readonly />
                                                                                       
                                                                   	


                                                         
                                                                          
                                                                            <button name="get">Get Transactions</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
}
function SubAccount()
{
				$y = mysql_query("select * from accounts order by name");
				$yy = mysql_query("select * from group_heads");
				echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
																		        <label>Main Account</label>
                                                                     <select name="id" required title="Client type">
                                                       
                                                            <option></option>
                                                    ';

				while ($row = mysql_fetch_array($y))
				{
								$id = $row['id'];
								$name = $row['name'];
								echo "<option value=$id>$name</option>";
				}
				echo '</select>';

				echo '
                                                                            <label>Sub Ledger</label>
                                                                            <input type="text" name="name" autofocus value="" placeholder="Enter Sub name."
																			title="Enter Sub name." required  />
                                                                                       
                                                                   

																	

                                                         
                                                                            
                                                                            <button name="ledger">Add Sub Account</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
}
function CreateBudget()
{
				$r = mysql_query("select * from accounts 
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='1' 
order by group_id");
				echo '
     <form method="POST" action="budget.php" autocomplete="off"> 
<table class="blue" border="1" style="background-color:#ffffff"; rules="NONE"
        frame="BOX" width="980" align="center" 
 cellpadding="0" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial";>
                                                       
                                                            <tr><td>Account Name</td> 
															
																<td>Budgeted Amount</td>  
                                                              
																
                                                                    
                                                            </tr>

                                                        ';
				$i = 0;
				while ($row = mysql_fetch_array($r))
				{

								echo '<tr><td>' . (($row['name'])) . '</td>';

								echo "<td ><input size='4' type='text' required='required' name='amount[$i]' value='' /></td>";
								echo "<td><input type='hidden' name='account_id[$i]' value='{$row['id']}' /></td></tr>";
								++$i;
				}
				echo "<tr><td><b>Budget Year</td><td><input  type='number' size='4' name='year' value='' required/></td></tr></table>   <div class='two'>
                                                    
                                                        <button name='submit'>SUBMIT</button>
                                                    </div></form>";
}

function FormBank()
{
				$y = mysql_query("select * ,accounts.id as id from accounts 
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='10'");

				echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
																		        <label>Bank Account</label>
                                                                     <select name="bank" required title="Client type">
                                                       
                                                            <option></option>
                                                    ';

				while ($row = mysql_fetch_array($y))
				{
								$id = $row['id'];
								$name = $row['name'];
								echo "<option value=$id>$name</option>";
				}
				echo '</select>


                                                                                       
                                                                   

																	

                                                         
                                                                            
                                                                            <button name="add">Reconcile Bank</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
}
function YearFMM()
{

				echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="view_budget.php" autocomplete="off">
                                                                            
																			<label>Year</label>
                                                                            <input type="text" name="year" autofocus value="" 
																			placeholder="Enter Year."
																			title="Enter Amount." required  /> 
																			


                                                         
                                                                          
                                                                            <button name="ledgerr">Get Report</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
}
function FormBankR()
{
				$y = mysql_query("select * ,accounts.id as id from accounts 
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='10'");

				echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="view_recon.php" autocomplete="off">
																		        <label>Bank Account</label>
                                                                     <select name="bank" required title="Client type">
                                                       
                                                            <option></option>
                                                    ';

				while ($row = mysql_fetch_array($y))
				{
								$id = $row['id'];
								$name = $row['name'];
								echo "<option value=$id>$name</option>";
				}
				echo '</select>

                                                      
<label> Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date" id="sd" value=""  readonly />
																		
   																		
                                                                                       
                                                                   

																	

                                                         
                                                                            
                                                                            <button name="add">View Reconciliation</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
}
function ChequePayments()
{
				$y = mysql_query("select * ,accounts.id as id from accounts 
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='10'");

				echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
																		        <label>Bank Account</label>
                                                                     <select name="bank" required title="Client type">
                                                       
                                                            <option></option>
                                                    ';

				while ($row = mysql_fetch_array($y))
				{
								$id = $row['id'];
								$name = $row['name'];
								echo "<option value=$id>$name</option>";
				}
				echo '</select>';

				echo '</select>
                                                                            <label>Cheque No</label>
                                                                            <input type="text" name="cheque" autofocus value="" placeholder="Enter Cheque No."
																			title="Enter Sub name." required  />
																			            <label> Date </label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date" id="ed" value=""
																		   readonly />  
                                                                                       
                                                                   

																	

                                                         
                                                                            
                                                                            <button name="add">Record Payments</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
}
function CreateBudgett()
{
				$r = mysql_query("select * from accounts 
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='3' 
order by group_id");
				echo '
     <form method="POST" action="budget.php" autocomplete="off"> 
<table border="1" width="700" cellspacing="0" class="tables"> 
                                                        <thead>
                                                            <tr><th>Account Name</th> 
															
																<th>Budgeted Amount</th>  
                                                              
																
                                                                    
                                                            </tr>

                                                        </thead>';
				$i = 0;
				while ($row = mysql_fetch_array($r))
				{

								echo '<tr><td>' . (($row['name'])) . '</td>';

								echo "<td><input type='text' required='required' name='amount[$i]' value='' /></td>";
								echo "<td><input type='hidden' name='account_id[$i]' value='{$row['id']}' /></td></tr>";
								++$i;
				}
				echo "<tr><td><b>Budget Year</td><td><input  type='number' size='4' name='year' value='' required/></td></tr></table>   <div class='two'>
                                                    
                                                        <button name='submitt'>SUBMIT</button>
                                                    </div></form>";
}

function AddAccount()
{
				$y = mysql_query("select * from group_heads");

				echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
																		        <label>Group Head</label>
                                                                     <select name="id" required title="Client type">
                                                       
                                                            <option></option>
                                                    ';

				while ($row = mysql_fetch_array($y))
				{
								$id = $row['id'];
								$name = $row['name'];
								echo "<option value=$id>$name</option>";
				}
				echo '</select>';

				echo '</select>
                                                                            <label>Account Name</label>
                                                                            <input type="text" name="name" autofocus value="" placeholder="Enter Account name."
																			title="Enter Account name." required  />
                                                                                    
                                                                   

																	

                                                         
                                                                            
                                                                            <button name="ledger">Add Account</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
}
function suppliers()
{

				echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="get" action="" autocomplete="off">
                                                                            <label>Supplier Name</label>
                                                                            <input type="text" name="name" autofocus value="" placeholder="Enter Supplier name."
																			title="Enter Supplier name." required  />
                                                                              <label>Contacts</label>
                                                                            <input type="text" name="contacts" autofocus value="" placeholder="Enter Suplier contacts."
																			title="Enter Suplier contacts" required  />
                                                                   
  <label>Address</label>
                                                                            <input type="text" name="address" autofocus value="" placeholder="Enter Address."
																			title="Enter Address." required  />
																	

                                                         
                                                                            
                                                                            <button name="ledger">Add Supplier Account</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
}
function RecordBill()
{

				$ty = mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='1'
order by name

");
				$y = mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='2'
order by name
");

				echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
                                                                           
                                                                            
                                                                            
                                                                           
															
																			 <label>Bill </label>
                                                                     <select name="bill"  title="Client type">
                                                       
                                                            <option></option>
                                                    ';

				while ($row = mysql_fetch_array($ty))
				{
								$id = $row['account_id'];
								$name = $row['name'];
								echo "<option value=$id>$name</option>";
				}
				echo '</select>';

				echo '	 <label>Supplier</label>
                                                                     <select name="supplier"  title="Client type">
                                                       
                                                            <option></option>
                                                    ';

				while ($row = mysql_fetch_array($y))
				{
								$id = $row['account_id'];
								$name = $row['name'];
								echo "<option value=$id>$name</option>";
				}
				echo '</select>';

				
																			
				echo '<label> VAT</label>
                                                                            <input type="text" name="vat" 
																			autofocus value="" placeholder="Enter Vat Amount."
																			title="Enter Amount." required  />';
																																		
				echo '<label>Amount + VAT</label>
                                                                            <input type="text" name="amount" 
																			autofocus value="" placeholder="Enter  Amount Inclusive Vat."
																			title="Enter Amount." required  />';
				echo '<label>Invoice</label>
                                                                            <input type="text" name="invoice" 
																			autofocus value="" placeholder="Enter Invoice No."
																			title="Enter Invoice No." required  />';

				echo '<label>Bill Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date" id="sd" value=""  readonly />
																			';

				echo '<label>Maturity Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date2" id="ed" value=""  readonly />
																			';

				echo '
                                                                            <button name="add">Record Bill</button>
                                                                        </form>
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>';

}
function FundsTransfer()
{

				$ty = mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='10'
and status='ACTIVE'
order by name
");
				$y = mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='10'
and status='ACTIVE'
order by name
");

				echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
                                                                           
                                                                            
                                                                            
                                                                           
															
																			 <label>Transfer From </label>
                                                                     <select name="from" required title="Client type">
                                                       
                                                            <option></option>
                                                    ';

				while ($row = mysql_fetch_array($ty))
				{
								$id = $row['account_id'];
								$name = $row['name'];
								echo "<option value=$id>$name</option>";
				}
				echo '</select>';

				echo '	 <label>Transfer To</label>
                                                                     <select name="to" required title="Client type">
                                                       
                                                            <option></option>
                                                    ';

				while ($row = mysql_fetch_array($y))
				{
								$id = $row['account_id'];
								$name = $row['name'];
								echo "<option value=$id>$name</option>";
				}
				echo '</select>';

				echo '<label>Amount</label>
                                                                            <input type="text" name="amount" 
																			autofocus value="" placeholder="Enter Amount."
																			title="Enter Amount." required  />';

				echo '<label> Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date" id="sd" value=""  readonly />
																			';
				echo '<label>Cheque No</label>
                                                                            <input type="text" name="cheque" 
																			autofocus value="" placeholder="Enter Cheque no."
																			  />';
				echo '<label>Description</label>
                                                                            <input type="text" name="desc" 
																			autofocus value="" placeholder="Enter Description."
																			  />';

				echo '
                                                                            <button name="add">Transfer Funds</button>
                                                                        </form>
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>';

}

function Module()
{


				echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
                                                                           
                                                                            
                                                                            
                                                                           
															
																			 <label>Module</label>
                                                                     <select name="module" required title="Client type">
                                                       
                                                            <option></option>
															<option value="sales">SALES</option>
																<option value="office">BACK OFFICE</option>
																	<option value="accounts">ACCOUNTS</option>
                                                    ';

				echo '</select>';

		

			

				echo '
                                                                            <button name="add">Choose Module</button>
                                                                        </form>
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>';

}
function Moduleform() {

    echo '
<div class="art-postcontent art-postcontent-0 clearfix"><div class="loginform">
    <div class="art-content-layout">
        <div class="art-content-layout-row">
            <div class="art-layout-cell" style="width: 100%" > 
            ';
 
    echo '
                <form action="" method="post" autocomplete="off">
                    <div class="two">
                       		 <label><b>Module</b></label>
                                                                     <select name="module" required title="Client type">
                                                       
                                                            <option></option>
															<option value="sales">SALES</option>
																<option value="office">BACK OFFICE</option>
																
																	<option value="admin">ADMIN</option>
                                                    

				</select>


                    </div>
                   
            </div>
        </div>
    </div>
    <div class="art-content-layout">
        <div class="art-content-layout-row">
            <div class="art-layout-cell" style="width: 100%" >
                <div class="two">
                    <button name="login">Load Module</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</div> 
';
}
function viewDate() {
$ty=mysql_query("select * from accounts order by name
");

    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="withd.php" autocomplete="off">
                                                                           
                                                                            
                                                                            
                                                                           
															
					';

 

	                                                      
	
	 echo '<label>Processing Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date" id="sd" value=""  readonly />
																			';
																				

	echo'
                                                                            <button name="add">Process Withdrawal</button>
                                                                        </form>
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>';
}

function viewLedgers() {
$ty=mysql_query("select * from accounts where status='ACTIVE' order by name
");

    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="view_ledger.php" autocomplete="off">
                                                                           
                                                                            
                                                                            
                                                                           
															
																			 <label>Account </label>
                                                                     <select name="account" required title="Client type" onChange="showUser(this.value)">
                                                       
                                                            <option></option>
                                                    ';
													
    while ($row = mysql_fetch_array($ty)) {
       $id=$row['id'];
	$name=$row['name'];
        echo "<option value=$id>$name</option>";
    }
    echo '</select>';

      echo '<div id="txtHint"></div>';

	                                                      
	
	 echo '<label>Start Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date1" id="sd" value=""  readonly />
																			';
																				
	 echo '<label>End Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date2" id="ed" value=""  readonly />
																			';
	echo'
                                                                            <button name="add">View Ledger</button>
                                                                        </form>
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>';
}

function viewCLedgers() {
$ty=mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='4' and status='ACTIVE' order by name
");

    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="view_ledger.php" autocomplete="off">
                                                                           
                                                                            
                                                                            
                                                                           
															
																			 <label>Account </label>
                                                                     <select name="account" required title="Client type" onChange="showUser(this.value)">
                                                       
                                                            <option></option>
                                                    ';
													
    while ($row = mysql_fetch_array($ty)) {
       $id=$row['account_id'];
	$name=$row['name'];
        echo "<option value=$id>$name</option>";
    }
    echo '</select>';

      echo '<div id="txtHint"></div>';

	                                                      
	
	 echo '<label>Start Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date1" id="sd" value=""  readonly />
																			';
																				
	 echo '<label>End Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date2" id="ed" value=""  readonly />
																			';
	echo'
                                                                            <button name="add">View Ledger</button>
                                                                        </form>
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>';
}
function viewSLedgers() {
$ty=mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='2' and status='ACTIVE' order by name
");

    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="view_ledger.php" autocomplete="off">
                                                                           
                                                                            
                                                                            
                                                                           
															
																			 <label>Account </label>
                                                                     <select name="account" required title="Client type" onChange="showUser(this.value)">
                                                       
                                                            <option></option>
                                                    ';
													
    while ($row = mysql_fetch_array($ty)) {
       $id=$row['account_id'];
	$name=$row['name'];
        echo "<option value=$id>$name</option>";
    }
    echo '</select>';

      echo '<div id="txtHint"></div>';

	                                                      
	
	 echo '<label>Start Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date1" id="sd" value=""  readonly />
																			';
																				
	 echo '<label>End Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date2" id="ed" value=""  readonly />
																			';
	echo'
                                                                            <button name="add">View Ledger</button>
                                                                        </form>
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>';
}
function financial() {
$ty=mysql_query("select * from accounts order by name
");

    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
                                                                           
                                                                            
                                                                            
                                                                           
															
					';

      

	                                                      
	
	 echo '<label>Start Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date1" id="sd" value=""  readonly />
																			';
																				
	 echo '<label>End Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date2" id="ed" value=""  readonly />
																			';
	echo'
                                                                            <button name="add">Create Financial Year</button>
                                                                        </form>
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>';
}
function viewLedgersC() {
$ty=mysql_query("select * from accounts where status='ACTIVE' order by name
");

    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
                                                                           
                                                                            
                                                                            
                                                                           
															
																			 <label>Account </label>
                                                                     <select name="account" required title="Client type" onChange="showUser(this.value)">
                                                       
                                                            <option></option>
                                                    ';
													
    while ($row = mysql_fetch_array($ty)) {
       $id=$row['id'];
	$name=$row['name'];
        echo "<option value=$id>$name</option>";
    }
    echo '</select>';

      echo '<div id="txtHint"></div>';

	                                                      
	
	 echo '<label>Start Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date1" id="sd" value=""  readonly />
																			';
																				
	 echo '<label>End Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date2" id="ed" value=""  readonly />
																			';
	echo'
                                                                            <button name="view">View Ledger</button>
                                                                        </form>
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>';
}
function ProfitForm()
{

				echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="view_profit.php" autocomplete="off">
                                                                           
                                                                            
                                                                            
 

      

	                                                      
	
	<label>Start Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date1" id="sd" value=""  readonly />
																			';

				echo '<label>End Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date2" id="ed" value=""  readonly />
																			';
				echo '
                                                                            <button name="add">View Profit</button>
                                                                        </form>
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>';
}
function ViewGeneral()
{

				echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="view_general.php" autocomplete="off">
                                                                           
                                                                            
                                                                            
 

      

	                                                      
	
	<label>Start Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date1" id="sd" value=""  readonly />
																			';

				echo '<label>End Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date2" id="ed" value=""  readonly />
																			';
				echo '
                                                                            <button name="add">View General Ledger</button>
                                                                        </form>
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>';
}
function BForm()
{

				echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="balance_sheet.php" autocomplete="off">
                                                                           
                                                                            
                                                                            
 

      

	                                                      
	
	<label> Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date1" id="sd" value=""  readonly />
																			';

			
				echo '
                                                                            <button name="add">View Balance Sheet</button>
                                                                        </form>
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>';
}
function TForm()
{

				echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="trial.php" autocomplete="off">
                                                                           
                                                                            
                                                                            
 

      

	                                                      
	
	<label>Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date1" id="sd" value=""  readonly />
																			';

				echo '
                                                                            <button name="add">View Trial Balance</button>
                                                                        </form>
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>';
}
function IncomeRecord()
{

				$ty = mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='3'
and status='ACTIVE'
");
				$y = mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='10'
and status='ACTIVE'
");
		

				echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
                                                                           
                                                                            
                                                                            
                                                                           
															
																			 <label>Income</label>
                                                                     <select name="income" required title="Client type" onChange="showUser(this.value)">
                                                       
                                                            <option></option>
                                                    ';

				while ($row = mysql_fetch_array($ty))
				{
								$id = $row['account_id'];
								$name = $row['name'];
								echo "<option value=$id>$name</option>";
				}
				echo '</select>';
				echo '<div id="txtHint"></div>';

				echo '	 <label>Payment Type</label>
                                                                     <select name="customer" required title="Client type">
                                                       
                                                            <option></option>
                                                    ';

				while ($row = mysql_fetch_array($y))
				{
								$id = $row['account_id'];
								$name = $row['name'];
								echo "<option value=$id>$name</option>";
				}
				echo '</select>';
			
echo '<label>From</label>
                                                                            <input type="text" name="from" 
																			autofocus value="" placeholder="Enter From."
																			title="Enter Amount." required  />';
				echo '<label>Amount</label>
                                                                            <input type="text" name="amount" 
																			autofocus value="" placeholder="Enter Amount."
																			title="Enter Amount." required  />';

				echo '<label> Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date" id="sd" value=""  readonly />
																			';

				echo '<label>Transaction No</label>
                                                                            <input type="text" name="transaction" 
																			autofocus value="" placeholder="Enter Transaction."
																			 required  />';
				echo '<label>Description</label>
                                                                            <input type="text" name="desc" 
																			autofocus value="" placeholder="Enter Description."
																			 required  />';

				echo '
                                                                            <button name="add">Record Income</button>
                                                                        </form>
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>';

}
function RecordExpe()
{

				$ty = mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='1'
and status='ACTIVE'
order by name
");
				$y = mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='10'
and status='ACTIVE'
order by name
");
				$r = mysql_query("select * from departments

");

				echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
                                                                           
                                                                            
                                                                            
                                                                           
															
																			 <label>Expense </label>
                                                                     <select name="credit" required title="Client type" onChange="showUser(this.value)">
                                                       
                                                            <option></option>
                                                    ';

				while ($row = mysql_fetch_array($ty))
				{
								$id = $row['account_id'];
								$name = $row['name'];
								echo "<option value=$id>$name</option>";
				}
				echo '</select>';

				echo '<div id="txtHint"></div>';
				echo '	 <label>Payment Type</label>
                                                                     <select name="payment" required title="Client type">
                                                       
                                                            <option></option>
                                                    ';

				while ($row = mysql_fetch_array($y))
				{
								$id = $row['account_id'];
								$name = $row['name'];
								echo "<option value=$id>$name</option>";
				}
				echo '</select>';

				echo '<label>Amount</label>
                                                                            <input type="text" name="amount" 
																			autofocus value="" placeholder="Enter Amount."
																			title="Enter Amount." required  />';

				echo '<label> Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date" id="sd" value=""  readonly />
																			';
																							echo '<label>Receipt No</label>
                                                                            <input type="text" name="receipt" 
																			autofocus value="" placeholder="Enter Receipt no."
																			  />';
																			  				echo '<label>Vat</label>
                                                                            <input type="text" name="vat" 
																			autofocus value="" placeholder="Enter vat."
																			  required/>';
				echo '<label>Cheque No</label>
                                                                            <input type="text" name="cheque" 
																			autofocus value="" placeholder="Enter Cheque no."
																			  />';
				echo '<label>Description</label>
                                                                            <input type="text" name="desc" 
																			autofocus value="" placeholder="Enter Description."
																			  />';

				echo '
                                                                            <button name="add">Record Expenses</button>
                                                                        </form>
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>';

}
function DoubleE()
{

				$ty = mysql_query("select * from accounts  where status='ACTIVE' order by name

");
				$y = mysql_query("select * from accounts where  status='ACTIVE' order by name

");
	

				echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
                                                                           
                                                                            
                                                                            
                                                                           
															
																			 <label>Debit </label>
                                                                     <select name="debit" required title="Client type" onChange="showUser(this.value)">
                                                       
                                                            <option></option>
                                                    ';

				while ($row = mysql_fetch_array($ty))
				{
								$id = $row['id'];
								$name = $row['name'];
								echo "<option value=$id>$name</option>";
				}
				echo '</select>';

				echo '<div id="txtHint"></div>';
				echo '	 <label>Credit</label>
                                                                     <select name="credit" required title="Client type" onChange="showUsel(this.value)">
                                                       
                                                            <option></option>
                                                    ';

				while ($row = mysql_fetch_array($y))
				{
								$id = $row['id'];
								$name = $row['name'];
								echo "<option value=$id>$name</option>";
				}
				echo '</select>';
echo '<div id="txtHintt"></div>';
				echo '<label>Amount</label>
                                                                            <input type="text" name="amount" 
																			autofocus value="" placeholder="Enter Amount."
																			title="Enter Amount." required  />';

				echo '<label> Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date" id="sd" value=""  readonly />
																			';
				echo '<label>Cheque No</label>
                                                                            <input type="text" name="cheque" 
																			autofocus value="" placeholder="Enter Cheque no."
																			  />';
				echo '<label>Description</label>
                                                                            <input type="text" name="desc" 
																			autofocus value="" placeholder="Enter Description."
																			  required/>';

				echo '
                                                                            <button name="add">Record Transaction</button>
                                                                        </form>
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>';

}
function DoubleEE( $debit,$credit,$date,$cheque,$amount)
{
if($debit==''){
				$ty = mysql_query("select * from accounts where a status='ACTIVE' order by name

");
}
if($debit!=''){
				$ty = mysql_query("select * from accounts where id='$debit' 

");
}
if($credit==''){
				$y = mysql_query("select * from accounts where  status='ACTIVE' order by name 

");}
if($credit!=''){
				$y = mysql_query("select * from accounts  where id='$credit' 

");}
		
				echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
                                                                           
                                                                            
                                                                            
                                                                           
															
																			 <label>Debit </label>
                                                                     <select name="debit" required title="Client type" onChange="showUser(this.value)">
                                                       
                                                            <option></option>
                                                    ';

				while ($row = mysql_fetch_array($ty))
				{
								$id = $row['id'];
								$name = $row['name'];
								echo "<option value=$id>$name</option>";
				}
				echo '</select>';

				echo '<div id="txtHint"></div>';
				echo '	 <label>Credit</label>
                                                                     <select name="credit" required title="Client type" onChange="showUsel(this.value)">
                                                       
                                                            <option></option>
                                                    ';

				while ($row = mysql_fetch_array($y))
				{
								$id = $row['id'];
								$name = $row['name'];
								echo "<option value=$id>$name</option>";
				}
				echo '</select>';
echo '<div id="txtHintt"></div>';
	echo '<label>Balance</label>
                                                                            <input type="text" name="balance" 
																			autofocus value="'.$amount.'" placeholder="Enter Cheque no."
																			  readonly/>';
				echo '<label>Amount</label>
                                                                            <input type="text" name="amount" 
																			autofocus value="" placeholder="Enter Amount."
																			title="Enter Amount." required  />';

				echo '<label> Date</label>
                                                                           <input type="text"  name="date"  value="'.$date.'"  readonly />
																			';
				echo '<label>Cheque No</label>
                                                                            <input type="text" name="cheque" 
																			autofocus value="'.$cheque.'" placeholder="Enter Cheque no."
																			  readonly/>';
				

				echo '
                                                                            <button name="add">Add Transaction</button></form><form>
																			<button name="finish">Finish Transaction</button>
																			   
                                                                        </form>
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>';

}
function AccountDC(){
				$ty = mysql_query("select * from accounts  order by name

");
				$y = mysql_query("select * from accounts  order by name

");
	
echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="gg.php" autocomplete="off">
                                                                           
                                                                            
                                                                            
                                                                           
															
																			 <label>Debit </label>
                                                                     <select name="debit" >
                                                       
                                                            <option></option>
                                                    ';

				while ($row = mysql_fetch_array($ty))
				{
								$id = $row['id'];
								$name = $row['name'];
								echo "<option value=$id>$name</option>";
				}
				echo '</select>';
	echo '	 <label>Credit</label>
                                                                     <select name="credit" >
                                                       
                                                            <option></option>
                                                    ';

				while ($row = mysql_fetch_array($y))
				{
								$id = $row['id'];
								$name = $row['name'];
								echo "<option value=$id>$name</option>";
				}
				echo '</select>';
					echo '<label> Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date" id="sd" value="'.$date.'"  readonly />
																			';
																				echo '<label>Amount</label>
                                                                           <input type="text"  name="amount" id="sd" value=""   required/>
																			';
																				echo '<label>Cheque</label>
                                                                           <input type="text"  name="cheque" id="sd" value=""   />
																			';
																		
				echo '<button name="finish">Start Transaction</button>
                                                                          
																			   
                                                                        </form>
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>';

}
function Reconciliation()
{

				echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
                                                                            <label>Receipt </label>
                                                                            <input type="text" name="debit" 
																			autofocus value="0.00" placeholder="Enter Receipts Amount."
																			title="Enter Account name."  required/>
                                                                                 <label>Payment</label>
                                                                            <input type="text" name="credit" 
																			autofocus value="0.00" placeholder="Enter Payment Amount."
																			title="Enter Account No</." required  />
                                                                   
     <label>Transaction No</label>
                                                                            <input type="text" name="no" 
																			autofocus value="" placeholder="Enter Transaction No."
																			title="Enter price." required  />
                                                       
<label> Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date" id="sd" value=""  readonly />
																		
                                                         
                                                                            
                                                       

                                                        <button name="ledger" >Post</button>
                                                          </form><form>
                                                        <button name="reconcile" >Reconcile Bank</button></form>

                                                         
                                                                          
                                                                  
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
}


function adminloginform() {

    echo '
<div class="art-postcontent art-postcontent-0 clearfix"><div class="loginform">
    <div class="art-content-layout">
        <div class="art-content-layout-row">
            <div class="art-layout-cell" style="width: 100%" > 
            ';
 
    echo '
                <form action="login.php" method="post" autocomplete="off">
                    <div class="five">
                        <label>User Name<img src="images/App-login-manager-icon.png" class="icons"/></label>
                        <input type="text" name="user" placeholder="Enter your username" title="Enter your username,it should be atleast 6 characters" required/>

                    </div>
                    <div class="five">
                        <label>Password<img src="images/passwordico.png" class="icons"/></label>
                        <input type="password" name="password" placeholder="Enter your password" title="Enter your password,it should be atleast 6 characters" required/>
                    </div>
            </div>
        </div>
    </div>
    <div class="art-content-layout">
        <div class="art-content-layout-row">
            <div class="art-layout-cell" style="width: 100%" >
                <div class="two">
                    <button name="login">Log in</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</div> 
';
}


function ClientForm() {
$ty=mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='2'");

    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
                                                                           
                                                                            
                                                                            
                                                                           
															
																			 <label>Supplier </label>
                                                                     <select name="client" required title="Client type">
                                                       
                                                            <option></option>
                                                    ';
													
    while ($row = mysql_fetch_array($ty)) {
       $id=$row['account_id'];
	$name=$row['name'];
        echo "<option value=$id>$name</option>";
    }
    echo '</select>';

                                                              
	

	echo'
                                                                            <button name="add">Make Payment</button>
                                                                        </form>
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>';
}
function SupplierPayments($idd){


$y=mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='10' or group_id='4'
");

    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
                                                                           
                                                                            
                                                                            
                                                                           
			
		 <label>Payment Type</label>
                                                                     <select name="payment" required title="Client type">
                                                       
                                                            <option></option>
                                                    ';
													
    while ($row = mysql_fetch_array($y)) {
       $id=$row['account_id'];
	$name=$row['name'];
        echo "<option value=$id>$name</option>";
    }
    echo '</select>';

	echo  '<label>Amount</label>
                                                                            <input type="text" name="amount" 
																			autofocus value="" placeholder="Enter Amount."
																			title="Enter Amount." required  />';
																			
		 echo '<label> Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date" id="sd" value=""  readonly />
																			';
																				echo  '<label>Cheque No</label>
                                                                            <input type="text" name="che" required 
																			 value="" placeholder="Enter Cheque no / Petty Cash No."
																			  />';
																			
																			  	echo  '<label>Description</label>
                                                                            <input type="text" name="desc" 
																			autofocus value="" placeholder="Enter Description."
																			  /><input type="hidden" name="id" 
value="'.$idd.'" />';

	echo'
                                                                            <button name="addd">Record Payments</button>
                                                                        </form>
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>';


}
function DDForm() {

    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
                                                                           
																		 
																			<label>Start Date </label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date1" id="sd" value=""
																		   readonly />
																			<label>End Date </label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date2" id="ed" value=""
																		   readonly />


                                                         
                                                                          
                                                                            <button name="ledger">Get Report</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
}
function UserForm() {
$ty=mysql_query("select * from department
");
$t=mysql_query("select * from user_level
");

    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
                                                                           
                                                                            
                                                                            
                                                                           
															
																			 <label>Department </label>
                                                                     <select name="dep" required title="Loan type">
                                                       
                                                            <option></option>
                                                    ';
													
    while ($row = mysql_fetch_array($ty)) {
       $id=$row['id'];
	$name=$row['name'];
        echo "<option value=$id>$name</option>";
    }
    echo '</select>';
															
			
    
	
																				echo '<label>Full Name</label>
                                                                            <input type="text" name="name" autofocus value="" placeholder="Enter Full name."
																			title="Enter Full name." required  />';
																			echo '<label>Phone</label>
                                                                            <input type="text" name="phone" autofocus value="" placeholder="Enter Phone Number."
																			title="Enter FPhone Number." required  />';
	 echo '<label>User Name</label>
                                                                            <input type="text" name="user" autofocus value="" placeholder="Enter User name."
																			title="Enter User  name." required  />';
																			echo '<label>Password</label>
                                                                            <input type="password" name="pass1" autofocus value="" placeholder="Enter Password."
																			title="Enter Password." required  />';
																			echo '<label>Confirm Password</label>
                                                                            <input type="password" name="pass2" autofocus value="" placeholder="Confirm Password."
																			title="Confirm Password." required  />';
                                                                              	
	
 
	echo'
                                                                            <button name="add">Create User</button>
                                                                        </form>
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>';
}
function DSForm($name) {

    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="" autocomplete="off">
                                                                           <label>Category Name </label>
                                                                           <input type="text"  name="id"  value="'.$name.'"
																		   readonly />
																		 
																			<label>Start Date </label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date1" id="sd" value=""
																		   readonly />
																			<label>End Date </label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date2" id="ed" value=""
																		   readonly />


                                                         
                                                                          
                                                                            <button name="ledger">Get Report</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
}
function DFF() {

$r=mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='4'
order by name

");

    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="dd.php" autocomplete="off">
                                                                           
                                                                            
                                                                            
 
				
			
								 <label>Customer </label>
                                                                     <select name="supplier" required title="Loan type">
                                                       
                                                            <option></option>
                                                    ';
													
    while ($row = mysql_fetch_array($r)) {
       $id=$row['account_id'];
	$name=$row['name'];
        echo "<option value=$id>$name</option>";
      }

	        echo '</select>    
			
			
								 <label>Sale Type</label>
                                                                     <select name="sale" required title="Type">
                                                       
                                                            <option></option>
															  <option value="1">RETAIL</option>
															  <option value="2">WHOLESALE</option>
															   </select>    
<label>Delivery Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date" id="sd" value=""  readonly />
																					

<label>Expected Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="expected" id="ed" value=""  readonly />
																					
	
	
		
	
	

                                                                            <button name="add">Create Sale</button>
                                                                        </form>
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>';
}

function CFF() {

$r=mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='2'
order by name

");

    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="ss.php" autocomplete="off">
                                                                           
                                                                            
                                                                            
 
				
			
								 <label>Supplier </label>
                                                                     <select name="supplier" required title="Loan type">
                                                       
                                                            <option></option>
                                                    ';
													
    while ($row = mysql_fetch_array($r)) {
       $id=$row['account_id'];
	$name=$row['name'];
        echo "<option value=$id>$name</option>";
      }

	        echo '</select>    
			  <label>Invoice No</label>
                                                                            <input type="text" name="invoice" 
																			autofocus value="" placeholder="Enter Invoice No."
																			title="Enter price." required  />
<label>Receive Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date" id="sd" value=""  readonly />
																					

<label>Invoice Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="expected" id="ed" value=""  readonly />
																					
	
	
		
	
	

                                                                            <button name="add"> Stock</button>
                                                                        </form>
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>';
}
function LPO() {

$r=mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='2'
order by name
");

    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="ll.php" autocomplete="off">
                                                                           
                                                                            
                                                                            
 
				
			
								 <label>Supplier </label>
                                                                     <select name="supplier" required title="Loan type">
                                                       
                                                            <option></option>
                                                    ';
													
    while ($row = mysql_fetch_array($r)) {
       $id=$row['account_id'];
	$name=$row['name'];
        echo "<option value=$id>$name</option>";
      }

	        echo '</select>    
			 
<label>Lpo Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="date" id="sd" value=""  readonly />
																					

<label>Supply Date</label>
                                                                           <input type="text" class="w8em format-y-m-d" name="expected" id="ed" value=""  readonly />
																					
	
	
		
	
	

                                                                            <button name="add">Create Lpo</button>
                                                                        </form>
                                                                    </div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>';
}

function Category() {

    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="get" action="" autocomplete="off">
                                                                            <label>Category Name</label>
                                                                            <input type="text" name="name" autofocus value="" placeholder="Enter Category name."
																			title="Enter Category name." required  />
																		

                                                                           																

                                                         
                                                                            
                                                                            <button name="ledger">Add Category</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
} 
function Deposits() {
$r=mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='10'
order by name
");

    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="get" action="" autocomplete="off">
																						 <label>Deposit Type </label>
                                                                     <select name="to" required title="Loan type">
                                                       
                                                            <option></option>
                                                    ';
													
    while ($row = mysql_fetch_array($r)) {
       $id=$row['account_id'];
	$name=$row['name'];
        echo "<option value=$id>$name</option>";
      }

	        echo '</select>  
                                                                            <label>Customer Name</label>
                                                                            <input type="text" name="name" autofocus value="" placeholder="Enter Customer name."
																			title="Enter Customer name." required  />
																		
  <label>Customer Id No</label>
                                                                            <input type="text" name="id" autofocus value="" placeholder="Enter Customer Id No."
																			title="Enter Customer Id No." required  />
																			  <label>Customer Phone</label>
                                                                            <input type="text" name="phone" autofocus value="" placeholder="Enter Customer Phone."
																			title="Enter Customer Phone." required  />
																			  <label>Deposit Amount</label>
                                                                            <input type="text" name="amount" autofocus value="" placeholder="Enter Deposit Amount."
																			title="Enter Deposit Amount." required  />
<label> Date</label>
                                                                           <input type="text" placeholder="Click Icon To Select Date." class="w8em format-y-m-d" name="date" id="ed" value=""  readonly />
																					
	
	
		
                                                                           																

                                                         
                                                                            
                                                                            <button name="ledger">Add Customer Deposit</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
}
 function Deep() {


    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                      
						

	                                                <label>Deposit No</label>
                                                                            <input type="text" name="id" autofocus value="" placeholder="Enter Depost Slip  NO."
																			title="Enter Receipt NO" required  onkeyup="showUser(this.value)"/>
                                                                           
                                                
                                                         <div id="txtHint"></div> 
                                                                            
                                                                      
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
}
