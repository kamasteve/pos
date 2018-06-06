<?php
include_once 'functions.php';
$type='ADMIN';

Permission($_SESSION['department'],$type);

?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US"><head><!-- Created by Artisteer v4.0.0.58475 -->
        <meta charset="utf-8">
        <title>Home</title>
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


    </head>
    <body>
        <div id="art-main">
      
    
<?php //headerinfo(); ?>

         
            <nav class="art-nav clearfix">
                 <?php headermenu($_SESSION['department'],'ADMIN'); ?>  
            </nav>
            <div class="art-sheet clearfix">
                <div class="art-layout-wrapper clearfix">
                    <div class="art-content-layout">
                        <div class="art-content-layout-row">
                            <div class="art-layout-cell art-sidebar1 clearfix"><div class="art-vmenublock clearfix">
                                   <ul class="art-vmenu">
                                           
										
											  <li>
                                                <a href="" class="active">Quick Links</a>
                                                <ul class="active">
                                                    <li>
                                                        <a href="user_accounts.php">Create user accounts</a>
                                                    </li>
                                                   
                                                    <li>
                                                        <a href="administer_users.php">Administer Accounts</a>
                                                    </li>
													
                                                <li>
                                                        <a href="administer_users.php">View User Accounts</a>
                                                    </li>
													 <li>
                                                        <a href="module.php">Load Module</a>
                                                    </li>
													 
                                                       
                                                    
                                                </ul>
                                            </li>
                                
                              
                                         
                                                   </ul>
                                </div></div>
                            <div class="art-layout-cell art-content clearfix"><article class="art-post art-article">
                                    <h2 class="art-postheader"><span class="art-postheadericon">Home</span></h2>
 <!------form start----->
                                    <img src="logo.jpg" height="300px;" width="90%" class="icons"/>
                                    <!---from end--->
                                </article></div>
                        </div>
                    </div>
                </div><?php //footer(); ?>

            </div>
                  </div>


    </body></html>