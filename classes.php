<?php
ini_set('display_errors', '0');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
ob_start();
session_start();
error_reporting(E_ALL ^ E_NOTICE);
set_time_limit(0);

include_once './conf.php';

include_once './mysql.php';
include_once './forms.php';

include_once './functions.php';
include_once './reports.php';

include_once './navigation/navigations.php';

 
                       




?>
