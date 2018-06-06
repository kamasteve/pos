<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
ob_start();
session_start();
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', '0');
include_once '../conf.PHP';
include_once '../froms.PHP';
$q = $_GET["q"];
withdrawalsearch($q);
function withdrawalsearch($j) {
    $sql = mysql_query('select * from newmember where membernumber like "%' . base64_encode($j) . '%"') or die(mysql_error());
    if (mysql_num_rows($sql) == 1) {
        $row = mysql_fetch_array($sql);
        withdrawsearchresults($_SESSION['users'], $row['membernumber'], $row['firstname'], $row['middlename'], $row['lastname'], $row['idnumber'], $row['town'], $row['county'], $row['mobileno'], $row['comments']);
    } else {
        echo '<span class="red">Sorry member number did not match..proceed and complete member number</span>';
        include_once '../loading.html';
    }
}

?>