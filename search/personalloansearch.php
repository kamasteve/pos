<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', '1');
include_once '../conf.php';
include_once '../froms.php';
include_once '../function.php';
//include_once '../classes.php';
$q = $_GET["q"];
loanrepaymentreport("user", $q);

function loanrepaymentreport($user, $q) {
    $mqry = mysql_query('select * from newmember where membernumber like "%' . base64_encode($q) . '%"') or die(mysql_error());
    if (mysql_num_rows($mqry) >= 1) {
        $mqry = mysql_query('select * from newmember where membernumber like "%' . base64_encode($q) . '%"') or die(mysql_error());
        $mrslt = mysql_fetch_array($mqry);
        echo '        <form method="get" action="">

        <table class="tables">
        <tr><th>Member Number</th><th>Member Name</th><th>Phone</th></tr>
        <tr><td>' . base64_decode($mrslt['membernumber']) . '</td>
            <td>' . base64_decode($mrslt['firstname']) . ' ' . base64_decode($mrslt['middlename']) . ' ' . base64_decode($mrslt['lastname']) . '</td>
            <td>' . base64_decode($mrslt['mobileno']) . '</td></tr>
   
</table>
<table class="tables">
<tr><th>Loan Id</th><th>Loan Amount</th><th>Status</th><th>View</th><th>Stop</th><th>Activate</th><th>Adjust</th><th>Cancel</th></tr>';
$qry=  mysql_query('select * from initial_l where memberno="'.  ($q).'"') or die(mysql_error());
$_SESSION['lrmno']=  base64_encode($q);
while ($row = mysql_fetch_array($qry)) {
    echo '<tr><td>'.  LoanName($row['transid']).'</td><td>'. number_format(($row['initial']),2).'</td>
	<td>'.  ($row['status']).'</td><td><div class="mybutton">
   <button name="view" value="' . $row['transid'] . '">View Loan</button></div></td><td><div class="mybutton">
   <button name="stop" value="' . $row['transid'] . '">Stop Loan</button></div></td><td><div class="mybutton">  <button name="activate" value="' . $row['transid'] . '">Re-Activate Loan</button></div></td>	<td><div class="mybutton"><a href="defualter-ind.php?id=' . ($row['transid']) . '">Adjust</a></div></td>
   	<td><div class="mybutton"><a href="delete_loan.php?id=' . ($row['transid']) . '">Cancel Loan</a></div></td></tr>';
}
echo '</table>
</form>';

guranteed($_SESSION['users'], $q);

    } else {
        echo '<span class="red">Sorry member number did not match..proceed and complete member number</span>';
        include_once '../loading.html';
    }
}

?>
