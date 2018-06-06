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
    if (mysql_num_rows($c)> 0) {
  
										echo '
													 											 <label>Sub Ledger</label>
                                                                     <select name="sub"  title="Client type">
                                                       
                                                            <option></option>
                                                    ';
													
    while ($row = mysql_fetch_array($c)) {
       $id=$row['id'];
	$name=$row['name'];
        echo "<option value=$id>$name</option>";
    }
    echo '</select>';

    }
}

?>
