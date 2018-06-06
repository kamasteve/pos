<? require_once('functions.php');
if($_SESSION['department']==1){
$type='ACCOUNTS';}
if($_SESSION['department']==2){
$type='SALES';}
if($_SESSION['department']==3){
$type='BACK OFFICE';}
if($_SESSION['department']==4){
$type='ADMIN';
}

?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US"><head><!-- Created by Artisteer v4.0.0.58475 -->
        <meta charset="utf-8">
        <title>Change Password</title>
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
		

               
        <!-- SimpleTabs -->
        <script type="text/javascript" src="js/simpletabs_1.3.js"></script>
        <style type="text/css" media="screen">
            @import "css/simpletabs.css";
        </style>
    </head>
    <body>
        <div id="art-main">
           
            <nav class="art-nav clearfix">
                <?php headermenu($_SESSION['department'],$type); ?>  
            </nav>
            <div class="art-sheet clearfix">
                <div class="art-layout-wrapper clearfix">
                    <div class="art-content-layout">
                        <div class="art-content-layout-row">
                            <div class="art-layout-cell art-sidebar1 clearfix"><div class="art-vmenublock clearfix">
                                       <?php
                                    //username();
                                    ?>
                                    <div class="art-vmenublockcontent">
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
                                                        <a href="module.php">Load Module</a>
                                                    </li>
													 
                                                       
                                                    
                                                </ul>
                                            </li>
                                         
                                                   </ul>
                                    </div>
                                </div></div>
                            <div class="art-layout-cell art-content clearfix">
                                <article class="art-post art-article">
                                    <h2 class="art-postheader"><span class="art-postheadericon">Change Password</span></h2>

                                    <!------form start----->
                                 
                                    <div class="art-content-layout">
                                        <div class="art-content-layout-row">
                                            <div class="art-layout-cell" style="width: 100%" >
                                                <div class="simpleTabs">
                                                    <ul class="simpleTabsNavigation">
                                                        <li><a href="#">Change Password</a></li>
														
													
                                                       
                                                    </ul>
                                                    <div class="simpleTabsContent">
                                                        <?php
										 if (isset($_REQUEST['ledger'])) { 
										 $user=$_REQUEST['user'];
										 $new=$_REQUEST['new'];
										  $new2=$_REQUEST['new2'];
										   $old=$_REQUEST['old'];
										 
                                                ChangePassT($user,$old,$new,$new2);
												UserAudit($_SESSION['user_id'],"Tried Changing User Password For $user",date("Y/m/d"),$ip);}
												 ChangePass();
                                                        ?>
														
                                                    </div>
													      
											
                                            
                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     
                                    <div class="art-content-layout">
                                        <div class="art-content-layout-row">
                                            <div class="art-layout-cell" style="width: 100%" >
                                            </div>
                                        </div>
                                    </div>

                                </article></div>
                        </div>
                    </div>
                </div>
				
				
				
				
				<? footer(); ?>

            </div>
        </div>


    </body></html>