<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../conf.php';
include_once '../froms.php';
include_once '../function.php';
$q = $_GET["q"];
nsearch($q);
function nsearch($m) {
$r=mysql_query("select * from member_with where member='$m'");
		$rew=mysql_fetch_array($r);
    
    if (mysql_num_rows($r) == 1) {
	 $chqry = mysql_query('select * from newmember where membernumber="' . base64_encode($m) . '"') or die(mysql_error());
        $row = mysql_fetch_array($chqry);
		
       echo '<input type="text" name="mname" readonly value="'.  base64_decode($row['firstname']).' '.base64_decode($row['middlename']).' '.base64_decode($row['lastname']).'" readonly required placeholder="Enter Member Name" title="Enter Member Name"/>';
$date1=$rew['date'];
$date2=$rew['expected'];
$now=date("Y/m/d");$three=0;
		echo '<label>Deposits</label>
                        <input type="text" name="shares"  value=" '.number_format (balanceshares(($m),
								'member shares')).'" placeholder="Enter Member no." title="Enter Member no." readonly "/>';
						echo '<label>Process Date</label>
                        <input type="text" name="processd"  value=" '.(($rew['date'])).'"  readonly "/>';
						echo '<label>Maturity Date</label>
                        <input type="text" name="maturity"  value=" '.(($rew['expected'])).'" readonly "/>';
							echo '<label>Date Now</label>
                        <input type="text" name="date"  value=" '.($now).'" readonly "/>';
				
								if(strtotime($now)<strtotime($date2)){

$three=3/100*balanceshares(($m),'member shares');
	echo '<label>Comment </label>
                        <input type="text" name="three"  value="EXPECTED MATURITY DATE NOT DUE"  readonly "/>';
	echo '<label>3% Fine </label>
                        <input type="text" name="three"  value=" '.number_format($three).'"  readonly "/>';
}
								echo '<label>Other Fines</label>
                        <input type="text" name="fine"  value=" '.number_format(fine(base64_decode($row['membernumber']))).'"  readonly "/>';
						echo '<label>Balance</label>
                        <input type="text" name="balance" value=" '.number_format((balanceshares(($m),
								'member shares'))-(fine(base64_decode($row['membernumber']))+$three)).'" readonly "/>
								<input type="hidden" name="balancee" value=" '.((balanceshares(($m),
								'member shares'))-(fine(base64_decode($row['membernumber']))+$three)).'" readonly "/>';
    } else {
        echo '<input type="text" name="mname" readonly value="Member Not Found In Withdrawal List" readonly required placeholder="Enter Member Name" title="Enter Member Name"/>';
    }
}

?>
