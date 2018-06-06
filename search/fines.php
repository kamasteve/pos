<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../conf.php';
include_once '../froms.php';
include_once '../function.php';
$q = $_GET["q"];
namesearch($q);
function namesearch($m) {
     $chqry = mysql_query('select * from newmember where membernumber="' . base64_encode($m) . '"') or die(mysql_error());
    if (mysql_num_rows($chqry) == 1) {
        $row = mysql_fetch_array($chqry);
       echo '<div class="two">
        <label>Member Name</label>
        <input type="text" name="mname" value="'.  base64_decode($row['firstname']).' '.base64_decode($row['middlename']).' '.base64_decode($row['lastname']).'" readonly required placeholder="Enter Member Name" title="Enter Member Name"/>
        </div>';
	
   echo '<div class="two">
        <label>Fines Due</label>
         <input type="text" name="fines" autofocus value=" '.number_format(fine(base64_decode($row['membernumber']))).'" placeholder="Enter Member no." title="Enter Member no." "/>
        </div>';
	

	 

 
       
    }
}

?>
