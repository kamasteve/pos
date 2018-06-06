<?php
include_once './classes.php';
$newuser = new User();
$users = new Users();
$permission = "viewpersonalinfo";
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US"><head><!-- Created by Artisteer v4.0.0.58475 -->
        <meta charset="utf-8">
        <title>Employee Information</title>
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
        <script type="text/javascript">
            function showUser(str)
            {
                if (str == "")
                {
                    document.getElementById("txtHint").innerHTML = "";
                    return;
                }
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
                xmlhttp.open("GET", "./search/employee.php?q=" + str, true);
                xmlhttp.send();
            }
        </script>

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
                                    ?>
                                    <div class="art-vmenublockcontent">
                                        <ul class="art-vmenu">
                                            <li>
                                                <a href="" class="active">View</a>
                                                <ul class="active">
                                                    <li>
                                                        <a href="personalinformation.php" class="active"><img src="images/user.png" class="icons"/>Personal Information</a>
                                                    </li>
                                                   
                                                    <li>
                                                        <a href="personalcontributiions.php"><img src="images/dollars.png" class="icons"/>Contributions</a>
                                                    </li>
                                                    <li>
                                                        <a href="personalloan.php"><img src="images/personal_loan.png" class="icons"/>Loans</a>
                                                    </li>
                                                                                                      <li>
                                                        <a href="communication.php"><img src="images/chat.png" class="icons"/>Responses</a>
                                                    </li>
                                                    <li>
                                                        <a href="withdrawal.php"><img src="images/bankwithdrawal.png" class="icons"/>Withdrawal</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="">Finance</a>
                                                <ul>
                                                    <li>
                                                        <a href="accountsettings.php"><img src="images/emblem_money.png" class="icons"/>Account Settings</a>
                                                    </li>
													 <li>
                                                        <a href="balancebf.php"><img src="images/bal.png" class="icons"/>Balance b/f</a>
                                                    </li>
                                                      <li>
                                                        <a href="banking.php"><img src="images/personal_loan.png" class="icons"/>Banking</a>
                                                    </li>
                                                    <li>
                                                        <a href="journals.php"><img src="images/news.png" class="icons"/>Journals</a>
                                                    </li>
                                                    <li>
                                                        <a href="profitandloss.php"><img src="images/cash_register.png" class="icons"/>Profit and loss</a>
                                                    </li>
                                                    <li>
                                                        <a href="ledger.php"><img src="images/folder_home2.png" class="icons"/>General Ledgers</a>
                                                    </li>
                                                    <li>
                                                        <a href="trialbalance.php"><img src="images/balance.png" class="icons"/>Trial Balance</a>
                                                    </li>
                                                    <li>
                                                        <a href="balancesheet.php"><img src="images/pic_balance.png" class="icons"/>Balance Sheet</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="">Reports</a>
                                                <ul>
                                                     <li>
                                                        <a href="viewgroups.php"><img src="images/Groups-Meeting-Light-icon.png" class="icons"/>Contribution Groups</a>
                                                    </li>
                                                    <li>
                                                        <a href="viewmembers.php"><img src="images/people.png" class="icons"/>Members</a>
                                                    </li>
                                                    
                                                    <li>
                                                        <a href="viewcontributions.php"><img src="images/money_no_shadow.png" class="icons"/>Contributions</a>
                                                    </li>
                                                    <li>
                                                        <a href="viewloans.php"><img src="images/personal_loan.png" class="icons"/>Loans</a>
                                                    </li>
                                                    <li>
                                                        <a href="viewincome.php"><img src="images/cash_register.png" class="icons"/>Income</a>
                                                    </li>
                                                    <li>
                                                        <a href="viewexpenses.php"><img src="images/dollars.png" class="icons"/>Expenses</a>
                                                    </li>
                                                    <li>
                                                        <a href="viewfeedback.php"><img src="images/chat.png" class="icons"/>Feedback</a>
                                                    </li>
                                                     <li>
                                                        <a href="viewbanking.php"><img src="images/cash_register.png" class="icons"/>Banking</a>
                                                    </li> 
                                                    <li>
                                                        <a href="withdrawalsview.php"><img src="images/bankwithdrawal.png" class="icons"/>Withdrawals</a>
                                                    </li>
													 <li>
                                                        <a href="viewbalancebf.php"><img src="images/bal.png" class="icons"/>Balance b/f</a>
                                                    </li>
                                                </ul>
                                            </li>
                                              <li>
                                                <a href="">Shares Management</a>
                                                <ul>
                                                <li>
                                                        <a href="sharesmanagement.php"><img src="images/Groups-Meeting-Light-icon.png" class="icons"/>Shares Management</a>
                                                    </li>
                                                     </ul>
                                            </li>
                                                                                  </ul>
                                    </div>
                                </div></div>
                            <div class="art-layout-cell art-content clearfix">
                                <article class="art-post art-article">
                                    <h2 class="art-postheader"><span class="art-postheadericon">Employee Information</span></h2>

                                    <!------form start----->
                                    
                                     <?php
                                    if ($users->permissions($_SESSION['users'], $permission)) {
                                        ?>
                                    <form action="" method="post">
                                        <div class="searcher">
                                            <input type="text" name="mysearch" autofocus required="required" title="Enter Member Number to search" placeholder="Enter Member Number to search" onkeyup="showUser(this.value)"/>
                                        </div>

                                    </form>
                                    <?php
                                       if (isset($_REQUEST['process'])) {
	PayrollUpdate($user,$_REQUEST['e_id'],$_REQUEST['basic'],$_REQUEST['house'],$_REQUEST['medical'],$_REQUEST['due'],$_REQUEST['nhif'],$_REQUEST['advance'],$_REQUEST['bonus'],$_REQUEST['loan']);
												 
												 }
                                    ?>

                                    <div id="txtHint"></div>
                                    
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