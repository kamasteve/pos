<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../conf.php';

//include_once '../functions.php';
$q = $_GET["q"];
ini_set('display_errors', '0');

 namesearch($q);
function namesearch($m) {
     $c = mysql_query("select * from accounts where id='$m' 
	 ") or die(mysql_error());
	 $row=mysql_fetch_array($c);
  $name=$row['name'];
    if ($name=='MPESA') {
  
			echo' <div class="art-content-layout-row"><form method="POST" action="tables.php" autocomplete="off">
                                                                            <label> Code</label>
                                                                            <input  name="codee" autofocus value="" placeholder="Enter Mpesa Code."
																			title="Enter Asset name." required  />';	
	echo'
                                                                            <label> Amount</label>
                                                                            <input  name="amountt" autofocus value="" placeholder="Enter Mpesa Amount."
																			title="Enter Asset name." required  />
																			<input type="hidden" name="ptype" autofocus value="'.$m.'" />
																			<input type="hidden" name="ttype" autofocus value="MPESA" />';																			
   echo '   <button name="add">Add  Transaction</button>
                                                                            <button name="sbb">Complete Sale</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                             ';
    }
	    if (($name)!='MPESA'&& $name!='CASH') {
  
			echo' <form method="POST" action="tables.php" autocomplete="off">
                                                                            <label>Amount</label>
                                                                            <input  name="amountt" autofocus value="" placeholder="Enter Amount."
																			title="Enter Amount." required  />';	
	echo'
                                                                            <label>Transaction Code</label>
                                                                            <input  name="codee" autofocus value="" placeholder="Enter transaction."
																			title="Enter Asset name." required  />
																			<input type="hidden" name="ptype" autofocus value="'.$m.'" />
																			<input type="hidden" name="ttype" autofocus value="BANK" />';																			
                             echo '   <button name="add">Add  Transaction</button>
                                                                            <button name="sbb">Complete Sale</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                             ';
    }
	  if ($name=='CASH') {
  
			echo'
                                                             <form method="POST" action="tables.php" autocomplete="off"><tr>
                                                                       <label>Amount</label>
                                                                           <input    name="amountt" autofocus value="" placeholder="Enter Amount."
																			title="Enter Amount." required  />';	
	echo'
                                                                        
																			<input type="hidden" name="ptype" autofocus value="'.$m.'" />
																			<input type="hidden" name="ttype" autofocus value="CASH" />';																			
                             echo ' <button name="add">Add  Transaction</button>
                                                                            <button name="sbb">Complete Sale</button> 
                                                                        </form></div>
                                                                 
                                                                   
                                                             ';
    }
}

?>
