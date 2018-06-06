<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../conf.php';

$q = $_GET["q"];

   function Deposits($name,$phone,$id,$deposit,$date,$number) {


    echo '<div class="art-content-layout">
                                                            <div class="art-content-layout-row">
                                                                <div class="art-layout-cell" style="width: 60%" >
                                                                    <div class="two">
                                                                        <form method="POST" action="deposit.php" autocomplete="off">
					       
                                                                            <input type="hidden" name="number" autofocus value="'.$number.'" placeholder="Enter Customer name."
																			title="Enter Customer name." required  readonly/>
                                                                            <label>Customer Name</label>
                                                                            <input type="text" name="name" autofocus value="'.$name.'" placeholder="Enter Customer name."
																			title="Enter Customer name." required  readonly/>
																		
  <label>Customer Id No</label>
                                                                            <input type="text" name="id" autofocus value="'.$id.'" placeholder="Enter Customer Id No."
																			title="Enter Customer Id No." required  readonly/>
																			  <label>Customer Phone</label>
                                                                            <input type="text" name="phone" autofocus 
																			value="'.$phone.'" placeholder="Enter Customer Phone."
																			title="Enter Customer Phone." required readonly />
																			  <label>Deposit Amount</label>
                                                                            <input type="text" name="amount" autofocus value="'.number_format($deposit).'" placeholder="Enter Deposit Amount."
																			title="Enter Deposit Amount." required  readonly/>
																			 <input type="hidden" name="deposit" autofocus value="'.$deposit.'" placeholder="Enter Deposit Amount."
																			title="Enter Deposit Amount." required  />
<label> Date</label>
                                                                           <input type="text"
																		   placeholder="Click Icon To Select Date."  name="date" id="ed" value="'.$date.'"  readonly />
																					
	
	
		
                                                                           																

                                                         
                                                                            
                                                                            <button name="ledger">Make Sale</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
}

    $vqry=  mysql_query('select * from deposits where number= "'.  ($q).'" and status="ACTIVE"') or die(mysql_error());
    if(mysql_num_rows($vqry)>=1){
	$row=mysql_fetch_array($vqry);
    Deposits($row['name'],$row['phone'],$row['id_no'],$row['amount'],$row['date'],$row['number']);
    }  else {
        echo '<span class="red">Sorry Deposit No is not active</span>';        
        include_once '../loading.html';

    }

?>
