<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once './classes.php';
session_destroy();
header('location:login.php');
?>
