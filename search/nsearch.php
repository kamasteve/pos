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
     $chqry = mysql_query('select * from newmember where membernumber="' . base64_encode($m) . '"') or die(mysql_error());
    if (mysql_num_rows($chqry) == 1) {
        $row = mysql_fetch_array($chqry);
       echo '<input type="text" name="mname" readonly value="'.  base64_decode($row['firstname']).' '.base64_decode($row['middlename']).' '.base64_decode($row['lastname']).'" readonly required placeholder="Enter Member Name" title="Enter Member Name"/>';
    } else {
        echo '<input type="text" name="mname" readonly value="Name Not Found" readonly required placeholder="Enter Member Name" title="Enter Member Name"/>';
    }
}

?>
