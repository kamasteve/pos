<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */




function headermenu($dep,$type) {
if (!isset($_SESSION['user']
 )) {
$url = 'login.php';
ob_end_clean();
header("Location: $url");
exit();
}

if(($dep==2||$dep==4)&&$type=='SALES'){

echo '<ul class="art-hmenu">
 <li>
                      <a href="indexxx.php" ><img src="images/home_w.png" class="icons"/>Home</a>
                    </li>
<li>
                        <a href="tables.php" class="active">CASHIER '.$_SESSION['user'].'  TILL &nbsp;&nbsp;&nbsp;'. teller(get_client_ip()).' </a>
                    </li>
					

                   		<li>
                        <a href="" >Cash Sales</a>
						 <ul class="active">
						   <li>
                        <a href="tables.php" >Retail Sales</a>
						<a href="tables1.php" >Wholesale Sales</a>
						<a href="product_catalogue.php" >Product Catalogue</a>
                    </li>
                           
							
                        </ul>
                    </li>
					<li>
                        <a href="dail_exp.php" >Petty Cash</a>
                    </li>
					<li>
                        <a href="creditorss.php" > CRedit Sales</a>
                    </li>
					<li>
                        <a href="deposits.php" >Customer Deposits</a>
						 <ul class="active">
						   <li>
                        <a href="deposits.php" >Create Deposit</a>
                    </li>
                            <li>
                        <a href="get_deposit.php" >Sell With Deposit</a>
                    </li>
					 <li>
                        <a href="tables.php" >Reverse Deposit</a>
                    </li>
							
                        </ul>
                    </li>
						 <li>
                        <a href=""  >TRANSACTIONS Admin</a>
							<ul class="active"> 
							         <li>
                        <a href="hold.php" >Hold Transactions</a>
                    </li>
					 <li>
                        <a href="unhold.php" >Un-Hold Transactions</a>
                    </li>
							  </ul>
                    </li>
					
				
				
					 
                  
                    <li>
                        <a href="login.php" class="active"><img src="images/logout.png" class="icons"/>Log Out</a>
                    </li>
                </ul>';
}

if(($dep==4)&&$type=='ADMIN'){

echo '<ul class="art-hmenu">
 <li>
                        <a href="admin.php" class="active"><img src="images/home_w.png" class="icons"/>Home</a>
                    </li>

<li>
                        <a href="#" class="active">ADMIN &nbsp;&nbsp;&nbsp;'.$_SESSION['user'].'   </a>
                    </li>
					

                    <li>
                        <a href="user_accounts.php" >CREATE USER ACCOUNTS</a>
                    </li>
					 <li>
                        <a href="administer_users.php" >ADMINISTER USER ACCOUNTS</a>
							<ul class="active">
									
					<li>
                                <a href="get_user.php">All User Trail</a>
                            </li></ul>
                    </li>
					<li>
                        <a href="financial_year.php" >FINANCIAL YEAR ADMIN</a>
                    </li>
					 <li>
                        <a href="change_pass.php"  >CHANGE PASSWORD</a>
							  <ul class="active">
                         
							
                        </ul>
                    </li>
					 
                  
                    <li>
                        <a href="logout.php" class="active"><img src="images/logout.png" class="icons"/>Log Out</a>
                    </li>
                </ul>';
}
if(($dep==3||$dep==4)&&$type=='BACK OFFICE'){
    echo '<ul class="art-hmenu">
                    <li>
                        <a href="indexx.php" class="active"><img src="images/home_w.png" class="icons"/>Home</a>
                    </li>
							
                   
					 <li>
                        <a href="#">Master Files</a>
						<ul class="active">
								<li>
                                <a href="add_new_stock.php">Add Products</a>
                            </li>
							<li>
                                <a href="products_view.php">Edit Products</a>
                            </li>
									<li>
                                <a href="categories.php">Add Categories</a>
                            </li>
							<li>
                                <a href="stock_adjustments.php">Stock Physical Vs Manual Variations Recording</a>
                            </li>
									<li>
                                <a href="damaged.php">Damaged Products</a>
                            </li>	
				
							
				
					</ul></li>
					
                    <li>
                        <a href="#">Transactions</a>
						<ul class="active">
									
					<li>
                                <a href="stockk.php">Add Stock</a>
                            </li>

							
				<li>
                                <a href="supp.php">Supplier Expenses</a>
                            </li>
						<li>
                                <a href="suppliers.php">Add Suppliers</a>
                            </li>						
								
						
							
								
							
							
							
							
							
								 
							
							
								 
							</ul></li> 
							 <li>
                        <a href="#">Reports</a>
						<ul class="active">
									
					<li>
                                <a href="sales.php">Sales</a>
                            </li>
							 <li>
                                <a href="properties.php">Stock Properties</a>
                            </li>
							<li>
                                <a href="propertiess.php">Stock With Less Properties</a>
                            </li>


							 <li>
                                <a href="supplier_invoices.php">Supplier Invoices</a>
                            </li>
							
							
							 <li>
                                <a href="get_stock.php">Manual vs System Stock Discrepancies</a>
                            </li>
						
								 <li>
                                <a href="stock.php">Stock By Qty</a>
                            </li>
					 <li>
                                <a href="stock.php">Stock By Value</a>
                            </li> <li>
                                <a href="audit.php">Product Audit Trail</a>
                            </li>
							
							
							
							
							<li>
                                <a href="reorder.php">Goods With Re-Order Levels Limits</a>
                            </li>
							<li>
                                <a href="reorderr.php">Goods With Approaching  Re-Order Levels Limits</a>
                            </li>
							
						
							
								
							
							
							
							
							
								 
							
							
								 
							</ul></li>
										 <li>
                        <a href="#">Detailed Reports</a>
							 <ul class="active">
							  <li>
                                <a href="get_sales.php">Product Cash Sales</a>
                            </li>
							<li>
                                <a href="expense_view.php">Daily Expense Report</a>
                            </li>
							 <li>
                                <a href="get_invoices.php">Product Invoice Sales</a>
                            </li>
								<li>
                                <a href="get_salesr.php">Sales bASED ON RECEIPTS</a>
                            </li>
							 </li>
								<li>
                                <a href="expense_view.php">DAILY EXPENSE REPORT</a>
                            </li>
							<li>
                                <a href="cumulative.php">Cumulative Sales</a>
                            </li>
							<li>
                                <a href="buying.php">Sales With Big Buying Prices Than Selling Prices</a>
                            </li>
								 
								 
						
							
							 
							
							
							
							
							
                        </ul>
                    </li>
							 <li>
                        <a href="#">Graphs </a>
							 <ul class="active">
							  <li>
                                <a href="sales_graph.php">Sales Graph</a>
                            </li>
								  <li>
                                <a href="category_graph.php">category Graph</a>
                            </li>
							 <li>
                                <a href="products_graph.php">Products Graph</a>
                            </li>
						
							
							
							
							
							
                        </ul>
                    </li>
				
					 <li>
                        <a href="#"> Recommedations</a>
							 <ul class="active">
							  <li>
                                <a href="get_margins.php">Product Margins</a>
                            </li>
							<li>
                                <a href="get_margins.php">Product Stock Discrepancies</a>
                            </li>
							 <li>
                                <a href="get_min.php">Products With Selling Price=Buying Prices</a>
                            </li>
							
								 <li>
                                <a href="get_min.php">Products Sold @ Minimum Prices Over Dates</a>
                            </li>
							
								  <li>
                                <a href="get_changed.php">Products With Changed Buying Prices</a>
                            </li>
							  <li>
                                <a href="get_changedd.php">Supplier Price Changes Over Dates</a>
                            </li>
							
							 <li>
                                <a href="get_popular.php">Popular Products</a>
                            </li>
							 <li>
                                <a href="catt.php">Popular Products By Category</a>
                            </li>
							 <li>
                                <a href="get_least.php">Least Popular Products</a>
                            </li>
							 <li>
                                <a href="get_dead.php">Dead Stock</a>
                            </li>
							
							
							
							
							
                        </ul>
                    </li>
					     
                    <li>
                        <a href="#">Analysis</a>
							 <ul class="active">
							  <li>
                                <a href="get_margins.php">Product Margins</a>
                            </li>
							 <li>
                                <a href="movement_analysis.php">Product Movement Analysis</a>
                            </li>
								<li>
                                <a href="get_stockd.php"> Stock Discrepancies Analysis</a>
                            </li>
								  <li>
                                <a href="cat.php">Category Analysis</a>
                            </li>
							 <li>
                                <a href="get_popular.php">Popular Products</a>
                            </li>
							 <li>
                                <a href="get_least.php">Least Popular Products</a>
                            </li>
							 <li>
                                <a href="get_dead.php">Dead Stock</a>
                            </li>
						
							
							
							
							
							
                        </ul>
                    </li>
                
                

					
					
			
                    <li>
                        <a href="logout.php"><img src="images/logout.png" class="icons"/>Log Out</a>
                    </li>
                </ul> ';
}
if(($dep==1||$dep==4)&&$type=='ACCOUNTS'){
    echo '<ul class="art-hmenu">
                    <li>
                        <a href="index.php" class="active"><img src="images/home_w.png" class="icons"/>Home</a>
                    </li>
							
                    <li>
                        <a href="" >Transactions</a>
						 <ul class="active">
						  <li>
                                <a href="doulble_entry.php">double entry</a>
                            </li>
								 <li>
                                <a href="double.php">Multiple double entry</a>
                            </li>
							 <li>
                                <a href="funds_transfer.php">Funds Transfer</a>
                            </li>
							 <li>
                                <a href="cancel_t.php">Cancel Transactions</a>
                            </li>
								 <li>
                                <a href="reverse_r.php">Reverse Receipt Transactions</a>
                            </li>
							 <li>
                                <a href="reverse_l.php">Reverse Credit Sales Transactions</a>
                            </li>
							</ul>
                    </li>
				
					
                   
			
					     
                    <li>
                        <a href="income.php">Finance</a>
							 <ul class="active">
							  <li>
                                <a href="add_accounts.php">Add ledger Accounts</a>
                            </li>
								  <li>
                                <a href="add_sub.php">Add ledger Sub Accounts</a>
                            </li>
							
						
							 <li>
                                <a href="income.php">Record Income</a>
                            </li>
							 <li>
                                <a href="invoice_p.php">Produce Invoice</a>
                            </li>
							 <li>
                                <a href="record_exp.php">Record Expenses</a>
                            </li>
							
							 <li>
                                <a href="debt.php">Debt Swaps</a>
                            </li>
							  <li>
                                <a href="assets.php">Add Assets</a>
                            </li> 
							 <li>
                                <a href="budget.php">Create Budget</a>
                            </li>
							 <li>
                                <a href="banks.php">Banking & Reconciliation</a>
                            </li>
							
							
                        </ul>
                    </li>
					<li>
                                <a href="#">Customer Accounts</a> <ul class="active">
										<li>
                                <a href="customers.php">Add Customers</a>
                            </li>						
								
								<li>
                                <a href="customer_record.php">Record Customer INvoices</a>
                            </li>
							  <li>
                                <a href="debtor_payment.php">Record Customer Payments</a>
                            </li>
							
							
							 <li>
                                <a href="get_customer.php">Customer Statements</a>
                            </li>
							
							<li>
                                <a href="debtor_invoices.php">View Customer Invoices</a>
                            </li>
							
							<li>
                                <a href="#">View Ageing Invoices</a>
                            </li>
							</ul>
                            </li>
						<li>
                                <a href="#">Suppliers Accounts</a> <ul class="active">
										<li>
                                <a href="suppliers.php">Add Suppliers</a>
                            </li>						
								
								<li>
                                <a href="record_bill.php">Record Supplier INvoices</a>
                            </li>
							  <li>
                                <a href="payments.php">Record Supplier Payments</a>
                            </li>
							
							
							 <li>
                                <a href="get_supplier.php">Supplier Statements</a>
                            </li>
							
							<li>
                                <a href="supplier_invoices.php">View Supplier Invoices</a>
                            </li>
							
							<li>
                                <a href="supplier_invoices.php">View Ageing Invoices</a>
                            </li>
							</ul>
                            </li>
                 <li>
                        <a href="#">FINANCE REPORTS</a>
						 <ul class="active">
                           
							
						
							<li>
                                <a href="get_ledger.php">View Ledger</a>
                            </li>
							<li>
                                <a href="get_ledgers.php">View Summarised Ledger</a>
                            </li>
							  <li>
                                <a href="get_general.php">View General Ledger</a>
                            </li>
							<li>
                                <a href="get_profit.php">View Profit</a>
                            </li>
							<li>
                                <a href="get_balance.php">View Balance Sheet</a>
                            </li>
							<li>
                                <a href="get_trial.php">View Trial Balance</a>
                            </li>
							  <li>
                                <a href="get_recon.php">View Bank & Reconciliation</a>
                            </li>
							 
							
							
							
							
							  
                        </ul>
						
                    </li>
                

					<li>
                        <a href="http://<img src="images/employee.png" class="icons"/>Payroll</a>
									 <ul class="active">
								
                            <li>
                                <a href="employees.php">ADD EMPLOYEE</a>
                            </li>
							 <li>
                                <a href="payroll_votes.php">Add Payroll Votes</a>
                            </li>
							 <li>
                                <a href="admin_payroll.php">ADMINISTER PAYROLL</a>
                            </li>
								     <li>
                                <a href="create_payroll.php">CREATE PAYROLL</a>
                            </li>
							 <li>
                                <a href="print_payslip.php">PRINT PAYSLIP</a>
                            </li>
							 <li>
                                <a href="view_payroll.php">View Payroll</a>
                            </li>
							<li>
                                <a href="administer_paye.php">Administer Paye Brackets</a>
                            </li>
							<li>
                                <a href="administer_nhif.php">Administer Nhif Brackets</a>
                            </li>
							 <li>
                                <a href="multiple_payroll.php">ONE CHEQUE MUTIPLE PAYROLL</a>
                            </li>
							
							
                        </ul>
                    </li>
					
			
                    <li>
                        <a href="logout.php"><img src="images/logout.png" class="icons"/>Log Out</a>
                    </li>
                </ul> ';
}
}

function headerinfo() {
    $Rows = mysql_query('SELECT * FROM saccodetails');

    $Row = mysql_fetch_array($Rows);
    $lqry = mysql_query('select * from saccodetails') or die(mysql_error());
    $rslt = mysql_fetch_array($lqry);
    $logo = 'photos/' . base64_decode($rslt['logo']);

    echo '<div class="art-shapes">
                    <h1 class="art-headline" data-left="48.85%">
                        <a href="#">' . base64_decode($Row['compname']) . '</a>
                    </h1>
                    <h2 class="art-slogan" data-left="47.26%">' . base64_decode($Row['slogan']) . '</h2>

                    <div class="art-object2132829940" data-left="2.74%">
<img src="' . $logo . '" style="width: 100%; max-width: 150px; min-width: 100px; max-height: 47px;" />
</div>

                </div>';
}

function footer() {

    echo '<footer class="art-footer clearfix">
                   <p>Copyright © ' . date("Y") . ' , All Rights Reserved.<br>
                                        <span id="art-footnote-links"><a href="" target="_blank">NeuroData Systems</a> Product</span>

                        <br></p>
                </footer>';
}

function adminmenu() {

    echo '
     
<div class="art-vmenublockcontent">
    <ul class="art-vmenu">
        <li>
                                                <a href="">Settings</a>
                                                <ul class="active">
                                                    <li>
                                                        <a href="saccodetails.php"><img src="images/settings.png" class="icons"/>Sacco Details</a>
                                                    </li>
                                                    <li>
                                                        <a href="backup.php"><img src="images/blue_external_drive_backup.png" class="icons"/>Backups</a>
                                                    </li>
                                                    <li>
                                                        <a href="audit.php"><img src="images/log_pencil.png" class="icons"/>User Activities</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            </ul>
                                            </div>';
}

function admintop() {
    echo '<ul class="art-hmenu">
                    <li>
                        <a href="admingroups.php"><img src="images/usergroups.png" class="icons"/>User Groups</a>
                    </li>
                    <li>
                        <a href="adminpermissions.php"><img src="images/userpermissions.png" class="icons"/>Permissions</a>
                    </li>
                    <li>
                        <a href="adminusers.php"><img src="images/users.png" class="icons"/>Users</a>
                    </li>
                    <li>
                        <a href="adminprofile.php"><img src="images/profile.png" class="icons"/>Profile</a>
                    </li>
                    <li>
                        <a href="logout.php"><img src="images/logout.png" class="icons"/>Log Out</a>
                    </li>
                </ul>';
}
?>
 
