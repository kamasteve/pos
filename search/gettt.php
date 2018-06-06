<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../conf.php';

//include_once '../functions.php';
$q = $_GET["q"];


 namesearch($q);
function namesearch($m) {
     $c = mysql_query("select * from sub_accounts where account='$m' order by name
	 ") or die(mysql_error());
    if (($m)==26) {
  
			echo'<form method="POST" action="tables.php" autocomplete="off">
                                                                            <label>Mpesa Code</label>
                                                                            <input  name="codee" autofocus value="" placeholder="Enter Mpesa Code."
																			title="Enter Asset name." required  />';	
	echo'
                                                                            <label>Mpesa Amount</label>
                                                                            <input  name="amountt" autofocus value="" placeholder="Enter Mpesa Amount."
																			title="Enter Asset name." required  />
																			<input type="hidden" name="ptype" autofocus value="26" />
																			<input type="hidden" name="ttype" autofocus value="MPESA" />';																			
   echo '   
                                                                            <button name="sbb">Complete Sale</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                             ';
    }
	    if (($m)==38) {
  
			echo'<form method="POST" action="tables.php" autocomplete="off">
                                                                            <label>Amount</label>
                                                                            <input  name="amountt" autofocus value="" placeholder="Enter Amount."
																			title="Enter Amount." required  />';	
	echo'
                                                                            <label>Transaction Code</label>
                                                                            <input  name="codee" autofocus value="" placeholder="Enter transaction."
																			title="Enter Asset name." required  />
																			<input type="hidden" name="ptype" autofocus value="38" />
																			<input type="hidden" name="ttype" autofocus value="KCB BANK" />';																			
                             echo '   
                                                                            <button name="sbb">Complete Sale</button>
                                                                        </form>
                                                                    </div>
                                                                   
                                                             ';
    }
}

?>
