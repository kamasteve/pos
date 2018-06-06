<!DOCTYPE html>
<html dir="ltr" lang="en-US"><head><!-- Created by Artisteer v4.0.0.58475 -->
        <meta charset="utf-8">
        <title>Re-Order Limits</title>
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
 <nav class="art-nav clearfix">
             <?php
			 require_once('functions.php');
			 $type='BACK OFFICE';

Permission($_SESSION['department'],$type);
			  headermenu($_SESSION['department'],'BACK OFFICE'); ?> 
            </nav>
 


<style>
input[type='text'] { font-size:18px; }
</style>
<style type="text/css">
    .fieldset-auto-width {
         display: inline-block;
    }

	
	}
</style>


<script language="JavaScript" type="text/javascript" src="audit.js"></script>

					<legend>Product Details</legend>

  
  <fieldset style="border-color:#000000; border-width:5px; background-color:#e8e8e8;" class="fieldset-auto-width"><form id='inputform'>
        <div id="container">
           
 			 <input type="text" data-index="1" autofocus="autofocus" id="amots" placeholder=" Put Product Name Here..... "
			  size="30" onKeyUp="bleble();" autocomplete="off"/>
          
            <div id="layer2" ></div>
        </div></form>
		</fieldset>

	
	
	</div>