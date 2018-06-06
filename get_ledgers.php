<? require_once('functions.php');
$type='ACCOUNTS';

Permission($_SESSION['department'],$type);?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US"><head><!-- Created by Artisteer v4.0.0.58475 -->
        <meta charset="utf-8">
        <title>View Ledger</title>
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
		
<script type="text/javascript" src="datepicker.js"></script>
      
        <link href="datepicker.css" rel="stylesheet" type="text/css" />
		
<script type="text/javascript">
//<![CDATA[

/*
        A "Reservation Date" example using two datePickers
        --------------------------------------------------

        * Functionality

        1. When the page loads:
                - We clear the value of the two inputs (to clear any values cached by the browser)
                - We set an "onchange" event handler on the startDate input to call the setReservationDates function
        2. When a start date is selected
                - We set the low range of the endDate datePicker to be the start date the user has just selected
                - If the endDate input already has a date stipulated and the date falls before the new start date then we clear the input's value

        * Caveats (aren't there always)

        - This demo has been written for dates that have NOT been split across three inputs

*/

function makeTwoChars(inp) {
        return String(inp).length < 2 ? "0" + inp : inp;
}

function initialiseInputs() {
        // Clear any old values from the inputs (that might be cached by the browser after a page reload)
        document.getElementById("sd").value = "";
        document.getElementById("ed").value = "";

        // Add the onchange event handler to the start date input
        datePickerController.addEvent(document.getElementById("sd"), "change", setReservationDates);
}

var initAttempts = 0;

function setReservationDates(e) {
        // Internet Explorer will not have created the datePickers yet so we poll the datePickerController Object using a setTimeout
        // until they become available (a maximum of ten times in case something has gone horribly wrong)

        try {
                var sd = datePickerController.getDatePicker("sd");
                var ed = datePickerController.getDatePicker("ed");
        } catch (err) {
                if(initAttempts++ < 10) setTimeout("setReservationDates()", 50);
                return;
        }

        // Check the value of the input is a date of the correct format
        var dt = datePickerController.dateFormat(this.value, sd.format.charAt(0) == "m");

        // If the input's value cannot be parsed as a valid date then return
        if(dt == 0) return;

        // At this stage we have a valid YYYYMMDD date

        // Grab the value set within the endDate input and parse it using the dateFormat method
        // N.B: The second parameter to the dateFormat function, if TRUE, tells the function to favour the m-d-y date format
        var edv = datePickerController.dateFormat(document.getElementById("ed").value, ed.format.charAt(0) == "m");

        // Set the low range of the second datePicker to be the date parsed from the first
        ed.setRangeLow( dt );
        
        // If theres a value already present within the end date input and it's smaller than the start date
        // then clear the end date value
        if(edv < dt) {
                document.getElementById("ed").value = "";
        }
}

function removeInputEvents() {
        // Remove the onchange event handler set within the function initialiseInputs
        datePickerController.removeEvent(document.getElementById("sd"), "change", setReservationDates);
}

datePickerController.addEvent(window, 'load', initialiseInputs);
datePickerController.addEvent(window, 'unload', removeInputEvents);

//]]>
</script>

<!--sa error trapping-->
<script type="text/javascript">
function validateForm()
{
var x=document.forms["amort"]["date"].value;
if (x==null || x=="")
  {
  alert("you must enter the Commencement Date(click the calendar icon)");
  return false;
  }

}
</script>
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
                xmlhttp.open("GET", "./search/get.php?q=" + str, true);
                xmlhttp.send();
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
    
            <nav class="art-nav clearfix">
             <?php headermenu($_SESSION['department'],'ACCOUNTS'); ?>
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
                                                <a href="" class="active">Accounting</a>
                                                <ul class="active">
                                                    <li>
                                                        <a href="add_accounts.php">Create Ledgers</a>
                                                    </li>
                                                   
                                                    <li>
                                                        <a href="get_ledger.php">View ledger</a>
                                                    </li>
													
                                                <li>
                                                        <a href="doulble_entry.php">Double Entry</a>
                                                    </li>
													 <li>
                                                        <a href="income.php">Record Income</a>
                                                    </li>
													 <li>
                                                        <a href="record_exp.php">Record Expenses</a>
                                                    </li>
													 <li>
                                                        <a href="payments.php">Supplier Payments</a>
                                                    </li>
													 <li>
                                                        <a href="debtor_payment.php">Customer Payments</a>
                                                    </li>
                                                       
                                                    
                                                </ul>
                                            </li>
                                
                              
                                         
                                                   </ul>
                                         
                                                   </ul>
                                    </div>
                                </div></div>
                            <div class="art-layout-cell art-content clearfix">
                                <article class="art-post art-article">
                                    <h2 class="art-postheader"><span class="art-postheadericon">View Ledger</span></h2>

                                    <!------form start----->
                                 
                                    <div class="art-content-layout">
                                        <div class="art-content-layout-row">
                                            <div class="art-layout-cell" style="width: 100%" >
                                                <div class="simpleTabs">
                                                    <ul class="simpleTabsNavigation">
                                                    
														<li><a href="#">View Ledger Summarised By Sub Ledgers</a></li>
														
                                                       
                                                    </ul>
                                                  
													  
                                              <div class="simpleTabsContent">
                                                        <?php
                                                 if (isset($_REQUEST['view'])) {
													   $date1=$_REQUEST['date1'];
													    $date2=$_REQUEST['date2'];
														 $id=$_REQUEST['account'];
														 $sub=$_REQUEST['sub'];
														$url="view_ledgerc.php?d1=$date1&d2=$date2&a=$id&s=$sub";
                                                       ob_end_clean();
header("Location: $url");
                                                        }
                                                       viewLedgersC();
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
                </div><?php footer(); ?>

            </div>
        </div>


    </body></html>