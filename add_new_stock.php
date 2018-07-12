<? require_once('classes.php');
require_once('face.php');
require_once('config.php');
ini_set('display_errors', '0');
$type='BACK OFFICE';

Permission($_SESSION['department'],$type);?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US"><head><!-- Created by Artisteer v4.0.0.58475 -->
        <meta charset="utf-8">
        <title>Add Accounts</title>
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
		   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
		


	  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
   <script type="text/javascript">
  $(document).ready(function(e){
    $("#fupForm").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'ajax/new_user.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#fupForm').css("opacity",".5");
            },
            success: function(msg){
                $('.statusMsg').html('');
                if(msg == 'ok'){
                    $('#fupForm')[0].reset();
                    $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Form data submitted successfully.</span>');
                }else{
                    $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">Some problem occurred, please try again.</span>');
                }
                $('#fupForm').css("opacity","");
                $(".submitBtn").removeAttr("disabled");
            }
        });
    });
    
    //file type validation
    $("#file").change(function() {
        var file = this.files[0];
        var imagefile = file.type;
        var match= ["image/jpeg","image/png","image/jpg"];
        if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
            alert('Please select a valid image file (JPEG/JPG/PNG).');
            $("#file").val('');
            return false;
        }
    });
});
    </script>	
	<script type="text/javascript" src="js/datepicker.js"></script>
      
        <link href="css/datepicker.css" rel="stylesheet" type="text/css" />

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
var x=document.forms["com"]["date"].value;
if (x==null || x=="")
  {
  alert("you must enter your start  Date(click the calendar icon)");
  return false;
  }

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
                <?php headermenu($_SESSION['department'],'BACK OFFICE'); ?> 
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
                                                        <a href="products_view.php">Add Products</a>
                                                    </li>
                                                    <li>
                                                        <a href="stock.php">Add Stock</a>
                                                    </li>
                                                    <li>
                                                        <a href="categories.php">Add Categories</a>
                                                    </li>
													
                                                <li>
                                                        <a href="return_r.php">Create Credit Note</a>
                                                    </li>
													 <li>
                                                        <a href="return_l.php">Create Debit Note</a>
                                                    </li>
													
                                                       
                                                    
                                                </ul>
                                            </li>
                                
                              
                                         
                                                   </ul>             
                                    </div>
                                </div></div>
                            <div class="art-layout-cell art-content clearfix">
                                <article class="art-post art-article">
                                    <h2 class="art-postheader"><span class="art-postheadericon">Add Stock</span></h2>


                                    <!------form start----->
                              <form enctype="multipart/form-data" id="fupForm" >
<div class='messages alert '> </div>
	<div class="form-group">
<label class="control-label col-xs-3" for="text">STOCK NAMES:</label>
 <div class="input-group  col-xs-5" id="invoice_due_text">
 <input class="form-control" name ="E_NAME" value="" id="name">
</div>
 <span class="help-block" id="error"></span>   
</div>   
<div class="form-group ">
<label class="control-label col-xs-3" for="text">CATEGORY:</label>
<div class=" input-group  col-xs-5">
	<?php
    //Include database configuration file
    
 $mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

    //Get all country data
    $query = $mysqli->query("SELECT * FROM `categories` ORDER BY id ASC");
    
    //Count total number of rows
	if (!$query) {
    trigger_error('Invalid query: ' . $mysqli->error);
}
    $rowCount = $query->num_rows;
	//mysqli_num_rows($query);
	
	
    ?>
    <select class='form-control' name="CATEGORY" id="role">
        <option value="">Select CATEGORY</option>
        <?php
        if($rowCount > 0){
            while($row = $query->fetch_assoc()){ 
                echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
            }
        }else{
            echo '<option value="">NO CATEGORY CREATED</option>';
        }
        ?>
    </select>
	
</div>

</div> 
 <div class="form-group ">
<label class="control-label col-xs-3" for="text">BUYING PRICE:</label>
 <div class="input-group  col-xs-5" id="invoice_due_text">
 <input class="form-control" name="b_price" id="b_price"> 
 <span class="help-block" id="error"></span> 
</div> 
</div>      
<div class="form-group ">
<label class="control-label col-xs-3" for="text">RETAIL PRICE:</label>
 <div class="input-group  col-xs-5" id="invoice_due_text">
 <input class="form-control" name="r_price" id="r_price" value="" placeholder="RETAIL PRICE:" >
  <span class="help-block" id="error"></span>   
</div>
</div> 
<div class="form-group ">
<label class="control-label col-xs-3" for="text">WHOLESALE PRICE:</label>
 <div class="input-group  col-xs-5" id="invoice_due_text">
 <input type="text" class="form-control" name="w_price" id="w_price" >
 <span class="help-block" id="error"></span> 
</div>
</div>

<div class="form-group ">
<label class="control-label col-xs-3" for="text">RE-ORDER-LEVEL:</label>
 <div class="input-group  col-xs-5" id="invoice_due_text">
 <input type="text" class="form-control" id="r_level" name="r_level" >
 <span class="help-block" id="error"></span> 
</div>
</div> 
<div class="form-group ">
<label class="control-label col-xs-4" for="text">PHOTO:</label>
 <div class="input-group  col-xs-8" id="invoice_due_text">
       <input id="image" name="image" type="file" class="file" multiple 
        data-show-upload="false" data-show-caption="true" data-msg-placeholder="Select {files} for upload..." required>
  <span class="help-block" id="error"></span> 
</div>
</div>
<div class="form-group ">
<label class="control-label col-xs-3" for="text">VAT:</label>
 <div class="input-group  col-xs-5" id="invoice_due_text">
 <input type="text" class="form-control" id="vat" name="vat">
 <span class="help-block" id="error"></span> 
</div>
</div> 

 	 
 <div class="form-group ">
<label class="control-label col-xs-3" for="text">BAR CODE:</label>
 <div class="input-group  col-xs-5" id="invoice_due_text">
 <input type="tel" class="form-control" name="b_code" placeholder="BAR CODE">
</div>
</div> 
<input type="hidden" name="ADDEB_BY" value="<?php echo $_SESSION['USERNAME']; ?> "/>

<div class="form-group ">
<label class="control-label col-xs-3" for="text"></label>
 <div class="input-group  col-xs-5" id="invoice_due_text">
<input type="submit" name="submit" class="btn btn-danger submitBtn" value="SAVE"/>		
</div>
</div>  
          
    </form>
                                 
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