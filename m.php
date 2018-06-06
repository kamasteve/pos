<?php
require_once('functions.php');
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US"><head><!-- Created by Artisteer v4.0.0.58475 -->
        <meta charset="utf-8">
        <title> System</title>
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
            <header class="art-header clearfix">
<h2><div align="center">Muuzaji Bora POS System V.1.0</div></h2>

            </header>
            <div class="art-sheet clearfix">
                <div class="art-layout-wrapper clearfix">
                    <div class="art-content-layout">
                        <div class="art-content-layout-row">
                            <!--<div class="art-layout-cell art-sidebar1 clearfix">
                                <div class="art-vmenublock clearfix">
                                    <div class="art-vmenublockcontent">
                                        <ul class="art-vmenu">
                                            <li>
                                                <a href="" class="active">User Logged in as</a>
                                                <ul class="active">
                                                    <li>
                                                        <a href=""><img src="images/user.png" class="icons"/><?php echo 'Hello Admin'; ?></a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>-->
                            <div class="art-layout-cell art-content clearfix"><article class="art-post art-article">
                                    <!------form start----->
                                    <div id="backgroundimg">
                                        <?php
                                           if (isset($_REQUEST['login'])) {
										$user=$_REQUEST['user'];
										$pass=$_REQUEST['password'];
							login($user,$pass);
                                        }

                                       Moduleform();
                                        ?>
                                   </div>
                                    <!---from end--->
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="art-footer clearfix">
                    <p>Copyright © <?php echo date("Y"); ?> , All Rights Reserved.<br>
                        <span id="art-footnote-links"><a href="" target="_blank"></a> Product</span>
                        <br></p>
                </footer>

            </div>
        </div>


    </body></html>