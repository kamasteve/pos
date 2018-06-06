<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../conf.php';
include_once '../froms.php';
include_once '../function.php';
$q = $_GET["q"];
$h=$q;
namesearch($q);
function namesearch($m) {
     $chqry = mysql_query('select * from newmember where membernumber="' . base64_encode($m) . '"') or die(mysql_error());
    if (mysql_num_rows($chqry) == 1) {
        $row = mysql_fetch_array($chqry);
       echo '<div class="two">
        <label>Member Name</label>
        <input type="text" name="mname" value="'.  base64_decode($row['firstname']).' '.base64_decode($row['middlename']).' '.base64_decode($row['lastname']).'" readonly required placeholder="Enter Member Name" title="Enter Member Name"/>
        </div>
		 <div class="two">
                                                            <label>Free Shares M</label>
                                                          <input type="text"  value="' . balanceshares(($m) ,'member shares') . '" readonly/>
                                                        </div>
														 <div class="two">
                                                            <label>Free Shares P</label>
                                                              <input type="text"  value="' . balanceshares(($m) ,'petrol shares') . '" readonly/>
                                                        </div>';
	
	?>
	<?
	$p=base64_encode('pending');
	$m=base64_encode($m);
	$result=@mysql_query("select * from loanapplication where membernumber='$m' and status='$p'");

	 
	 echo '<div class="two">';
echo"<label>Loan Type:</label>";
echo"<select name='transid'>";
while ($row=mysql_fetch_assoc($result)){
$name=base64_decode($row['loantype']);
$id=$row['transactionid'];
echo"<option value=$id>$name";
}
echo"</select>\n";
echo '</div>';


 
       
    }
}

?>
