<?php
include_once './classes.php';
$newuser = new User();
$users = new Users();
$permission = "income";
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US"><head><!-- Created by Artisteer v4.0.0.58475 -->
        <meta charset="utf-8">
        <title>Employee Registration</title>
        <!--<meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">-->
        <meta name="HandheldFriendly" content="True"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
        <meta name="HandheldFriendly" content="true" />
        <meta name="MobileOptimized" content="true" />

        <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <link rel="stylesheet" href="style.css" media="screen">
        <!--[if lte IE 7]><link rel="stylesheet" href="style.ie7.css" media="screen" /><![endif]-->
        <link rel="stylesheet" href="style.responsive.css" media="all">


        <script src="jquery.js"></script>
        <script src="script.js"></script>
        <script src="script.responsive.js"></script>
        <meta name="description" content="NEURO DATA">
        <meta name="keywords" content="EZ-SACCO">

    </script>
            <script type="text/javascript">
            function showUser(str)
            {

                if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                }
                else
                {// code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "./search/kinsearch.php?q=" + str, true);
                xmlhttp.send();
            }
            var counter = 1;
            function addInput(divName) {
                var newdiv = document.createElement('div');
                newdiv.innerHTML = "<?php
$qry = mysql_query("select * from accounts where actype='" . base64_encode('Capital') . "' or  actype='" . base64_encode('Loan Repayment') . "' and status='" . base64_encode('Active') . "'") or die(mysql_error());
echo "<div class='two'><label>Account Name</label><select name='tname[]' required title='Payment type'><option></option>";
while ($row = mysql_fetch_array($qry)) {
    echo "<option>" . base64_decode($row["acname"]) . "</option>";
}echo "</select></div>";
?><div class='two'><label>Payment Type</label><select name='ptype[]' required title='Payment type'><option></option><option>Select</option><option>Cash</option><option>Mobile Money</option><option>Cheque</option></div><div class='two'><label>Payment Type</label><select name='ptype' required title='Payment type'><option></option><option>Select</option><option>Cash</option><option>Mobile Money</option><option>Bank Deposit</option><option>Cheque</option></select></div><div class='two'><label>Amount</label><input type='number' name='amount[]' required placeholder='Enter Amount' title='Enter Amount' pattern='[0-9]{1,}'/>";
                document.getElementById(divName).appendChild(newdiv);
                counter++;

            }
        </script>
    <!-- SimpleTabs -->
    <script type="text/javascript" src="js/simpletabs_1.3.js"></script>
    <style type="text/css" media="screen">
        @import "css/simpletabs.css";
    </style>
</head>
<body>
    <div id="art-main">
        <header class="art-header clearfix">

            <?php headerinfo(); ?>

        </header>
 <nav class="art-nav clearfix">
                <?php headermenu($_SESSION['department']); ?>  
            </nav>
        <div class="art-sheet clearfix">
            <div class="art-layout-wrapper clearfix">
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <div class="art-layout-cell art-sidebar1 clearfix"><div class="art-vmenublock clearfix">
                                <?php
                                username();
                                sidemenu();
                                ?>
                            </div></div>
                        <div class="art-layout-cell art-content clearfix"><article class="art-post art-article">
                                <h2 class="art-postheader"><span class="art-postheadericon">Employee Registration</span></h2>
                                <!------form start----->

                                <?php
                                if ($users->permissions($_SESSION['users'], $permission)) {
                                    ?>
                                    <div class="simpleTabs">
                                        <ul class="simpleTabsNavigation">
                                            <li><a href="#">Employee Registration</a></li>
                                            <li><a href="#">Employee Payroll Adminstration</a></li>
                                            
                                        </ul>
                                        <div class="simpleTabsContent">
                                            <?php
                                            if (isset($_REQUEST['submit'])) {
                                                // get the original filename

                                                $image = gmdate("hisG") . $_FILES['image']['name'];
                                                // image storing folder, make sure you indicate the right path
                                                $folder = "employee/";

                                                // image checking if exist or the input field is not empty
                                                if ($image) {
                                                    // creating a filename
                                                    $filename = $folder . $image;

                                                    // uploading image file to specified folder
                                                    $copied = copy($_FILES['image']['tmp_name'], $filename);

                                                    // checking if upload succesfull
                                                    if (!$copied) {

                                                        // creating variable for the purpose of checking: 
                                                        // 0-unsuccessfull, 1-successfull
                                                        //$ok = 0;
                                                       $newuser-> addEmployee($user, $_REQUEST['fname'], $_REQUEST['mname'],$_REQUEST['lname'], $_REQUEST['idno'],$_REQUEST['eno'],
 $_REQUEST['position'],$_REQUEST['department'], $_REQUEST['mobile'], $_REQUEST['pin'], $_REQUEST['nhif'],$_REQUEST['nssf'],$_REQUEST['residence'], $_REQUEST['bank'],
 $_REQUEST['account'], $_REQUEST['email'],$_REQUEST['gender'],  $image);
                                                    } else {
                                                            $newuser-> addEmployee($user, $_REQUEST['fname'], $_REQUEST['mname'],$_REQUEST['lname'], $_REQUEST['idno'],$_REQUEST['eno'],
 $_REQUEST['position'],$_REQUEST['department'], $_REQUEST['mobile'], $_REQUEST['pin'], $_REQUEST['nhif'],$_REQUEST['nssf'],$_REQUEST['residence'], $_REQUEST['bank'],
 $_REQUEST['account'], $_REQUEST['email'],$_REQUEST['gender'],  $image);
                                                    }
                                                }
                                            }
                                            employeeregistration() ;
                                            ?>   
                                        </div>
                                        <div class="simpleTabsContent">
                                            <?php
                                            if (isset($_REQUEST['nsubmit'])) {
                                                // get the original filename
                                                $image = gmdate("hisG") . $_FILES['image']['name'];
                                                // image storing folder, make sure you indicate the right path
                                                $folder = "photos/";

                                                // image checking if exist or the input field is not empty
                                                if ($image) {
                                                    // creating a filename
                                                    $filename = $folder . $image;

                                                    // uploading image file to specified folder
                                                    $copied = copy($_FILES['image']['tmp_name'], $filename);

                                                    // checking if upload succesfull
                                                    if (!$copied) {

                                                        // creating variable for the purpose of checking: 
                                                        // 0-unsuccessfull, 1-successfull
                                                        //$ok = 0;
                                                        $newuser->addkin($_REQUEST['mno'], $_REQUEST['fname'], $_REQUEST['mmname'], $_REQUEST['lname'], $_REQUEST['relationship'], $_REQUEST['idno'], $_REQUEST['mobile'], $image, $_REQUEST['comments']);
                                                    } else {
                                                        $newuser->addkin($_REQUEST['mno'], $_REQUEST['fname'], $_REQUEST['mmname'], $_REQUEST['lname'], $_REQUEST['relationship'], $_REQUEST['idno'], $_REQUEST['mobile'], $image, $_REQUEST['comments']);
                                                    }
                                                }
                                            }
											     if (isset($_REQUEST['process'])) {
	PayrollUpdate($user,$_REQUEST['e_id'],$_REQUEST['basic'],$_REQUEST['house'],$_REQUEST['medical'],$_REQUEST['due'],$_REQUEST['nhif'],$_REQUEST['advance'],$_REQUEST['bonus'],$_REQUEST['loan']);
												 
												 }
                                        payrollInfo($_REQUEST['eno']);
                                            ?>
                                        </div>
                                      
                                    </div>
                                    <?php
                                } else {
                                    echo '<span class="red">Sorry you do not have permission to view this page</span></br>';
                                }
                                ?>
                                <!---from end--->
                            </article></div>
                    </div>
                </div>
            </div><?php footer(); ?>

        </div>
    </div>


</body></html>