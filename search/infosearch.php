<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../conf.php';
include_once '../froms.php';
$q = $_GET["q"];
persornalinformationsearch($q);

function persornalinformationsearch($m) {
    $chqry = mysql_query('select * from newmember where membernumber like "%' . base64_encode($m) . '%"') or die(mysql_error());
    if (mysql_num_rows($chqry) == 1) {
        $row = mysql_fetch_array($chqry);
        membersearchresults("user", $row['photo'], $row['primarykey'], $row['firstname'], $row['middlename'], $row['lastname'], $row['idnumber'], $row['membernumber']
                , $row['town'], $row['county'], $row['mobileno'], $row['pinnumber'], $row['residence'], $row['career'], $row['email'], $row['comments']);
    } else {
        echo '<span class="red">Sorry member number did not match..proceed and complete member number</span>';
        include_once '../loading.html';
    }
}

?>
