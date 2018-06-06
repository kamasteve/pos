<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', '0');
include_once '../conf.php';
include_once '../froms.php';
include_once '../function.php';
//include_once '../classes.php';
$q = $_GET["q"];
loanrepaymentreport("user",$q);
function loanrepaymentreport($user, $q) {    
    $mqry = mysql_query('select * from newmember where membernumber like "%' . base64_encode($q) . '%"') or die(mysql_error());
    if (mysql_num_rows($mqry) >= 1) {
    $mqry = mysql_query('select * from newmember where membernumber like "%' . base64_encode($q) . '%"') or die(mysql_error());
    $mrslt = mysql_fetch_array($mqry);
    $_SESSION['gmno']=$mrslt['membernumber'];
    echo '
        <table class="tables">        
        <tr><th>Member Number</th><th>Member Name</th><th>Phone</th></tr>
        <tr><td>' . base64_decode($mrslt['membernumber']) . '</td>
            <td>' . base64_decode($mrslt['firstname']) . ' ' . base64_decode($mrslt['middlename']) . ' ' . base64_decode($mrslt['lastname']) . '</td>
            <td>' . base64_decode($mrslt['mobileno']) . '</td></tr>
        </table>';
    $loanqry=  mysql_query('select * from loans where membernumber like "%'.base64_encode($q).'%" and status="'.base64_encode("active").'"') or die(mysql_error());
    $loanrslt=  mysql_fetch_array($loanqry);
    echo '<table class="tables">
        <tr><th>Loan Amount</th><th>Monthly Pay</th><th>Amount Paid</th><th>Amount Remaining</th><th>Status</th></tr>
        <tr><td>Ksh.'.  number_format(base64_decode($loanrslt['amount'])+  totalloanint($mrslt['membernumber']),2).'</td>
            <td>Ksh.'.  number_format(base64_decode($loanrslt['monthlypayment']),2).'</td>
                <td>Ksh.'. number_format(addloanamoutpaid($mrslt['membernumber']),2).'</td>
                <td>Ksh.'.  number_format(remailingloan($mrslt['membernumber']),2).'</td>
                <td>'.  base64_decode($loanrslt['status']).'</td>
                </tr>
        <tr></tr>
        </table>
        <table class="tables">
        <tr><th colspan="4">Payments Details</th></tr>
        <tr><th>Payee</th><th>Payee Id</th><th>Amount</th><th>Date</th></tr>';
    loanrepaymentdetails($mrslt['membernumber']);
        echo '</table>';
    } else {
        unset($_SESSION['gmno']);
        echo '<span class="red">Sorry member number did not match..proceed and complete member number</span>';
        include_once '../loading.html';
    }
}
?>
