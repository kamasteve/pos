   <link rel="stylesheet" href="menu.css" media="screen">
     <link rel="stylesheet" href="style.responsive.css" media="all">
 <script src="jquery.js"></script>
        <script src="script.js"></script>
        <script src="script.responsive.js"></script>	 
               <body>
        <div id="art-main">
            <header class="art-header clearfix">
           
			 <nav class="art-nav clearfix">
<ul class="art-hmenu">
                    <li>
                        <a href="index.php" class="active"><img src="images/home_w.png" class="icons"/>Home</a>
                    </li>
							
                   
					 <li>
                        <a href="#">Master Files</a>
						<ul class="active">
								<li>
                                <a href="products_view.php">Add Products</a>
                            </li>
									<li>
                                <a href="categories.php">Add Categories</a>
                            </li>
							<li>
                                <a href="add_loan.php">Stock Adjustements</a>
                            </li>
									
					<li>
                                <a href="add_loan.php">Change Password</a>
                            </li>

							
				
					</ul></li>
					
                    <li>
                        <a href="#">Transactions</a>
						<ul class="active">
									
					<li>
                                <a href="stockk.php">Add Stock</a>
                            </li>
 <li>
                                <a href="with.php">Create Credit NOte</a>
                            </li>
							 <li>
                                <a href="withdrawalpayment.php">Create Debit Note</a>
                            </li>
							 <li>
                                <a href="pick.php">Create Z Report</a>
                            </li>
							 <li>
                                <a href="cash.php">Cash Pick</a>
                            </li>
							
							<li>
                                <a href="withdrawalpayment.php">Create Lpo</a>
                            </li>
				
						
						
							
								
							
							
							
							
							
								 
							
							
								 
							</ul></li> 
							 <li>
                        <a href="#">Reports</a>
						<ul class="active">
									
					<li>
                                <a href="sales.php">Sales</a>
                            </li>
 <li>
                                <a href="with.php">Purchases</a>
                            </li>
							 <li>
                                <a href="get_credit.php">Credit Notes</a>
                            </li>
							 <li>
                                <a href="get_debit.php">Debit Notes</a>
                            </li>
						
								 <li>
                                <a href="stock.php">Stock By Qty</a>
                            </li>
					 <li>
                                <a href="stock.php">Stock By Value</a>
                            </li> <li>
                                <a href="withdrawalpayment.php">Product Audit Trail</a>
                            </li>
							
						
						
							
								
							
							
							
							
							
								 
							
							
								 
							</ul></li>
							 <li>
                        <a href="#">Graphs Analysis</a>
							 <ul class="active">
							  <li>
                                <a href="get_margins.php">Product Margins</a>
                            </li>
								  <li>
                                <a href="add_sub.php">Category Analysis</a>
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
                        <a href="income.php">System Recommedations</a>
							 <ul class="active">
							  <li>
                                <a href="get_margins.php">Product Margins</a>
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
                        <a href="income.php">Analysis</a>
							 <ul class="active">
							  <li>
                                <a href="get_margins.php">Product Margins</a>
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
                </ul>
				  </nav><br>
				  				  
<script type ="text/javascript" language ="javascript">
            function Print(elementId)
            {
                var printContent = document.getElementById(elementId);
                var windowUrl = 'about:blank';
                var uniqueName = new Date();
                var windowName = 'Print' + uniqueName.getTime();
                var printWindow = window.open(windowUrl, windowName, 'left=0,top=0,width=0,height=0');
                printWindow.document.write(printContent.innerHTML);
                printWindow.document.close();
                printWindow.focus();
                printWindow.print();
                printWindow.close();
            }
        </script>