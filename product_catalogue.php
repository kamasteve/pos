<? require_once('classes.php');
require_once('face.php');
require_once('config.php');
ini_set('display_errors', '0');
$type='SALES';

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
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<link href='catalogue.css' rel='stylesheet'>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
		
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
        <!-- SimpleTabs -->
        <script type="text/javascript" src="js/simpletabs_1.3.js"></script>
		
        <style type="text/css" media="screen">
            @import "css/simpletabs.css";
        </style>
    </head>
    <body>
        <div id="art-main">
          
            <nav class="art-nav clearfix">
                <?php headermenu($_SESSION['department'],'SALES'); ?> 
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

<script type="text/javascript" language="javascript" class="init">
$(document).ready(function() {
    $('#example').DataTable( {
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 9 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 9, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                '$'+pageTotal +' ( $'+ total +' total)'
            );
        }
    } );
} );
</script>

<?php
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$result = mysqli_query($mysqli,"SELECT * from products ;");
while($row = mysqli_fetch_array($result)) {
	$wishID = $row["image_name"];
				$filename = $row["image_ext"];
				$file_combi= $wishID .'' . $filename  ;
?>
  <div class="col-sm-4">
            <article class="col-item">
            	<div class="photo">
        			<div class="options-cart-round">
        				<button class="btn btn-default" title="Add to cart">
        					<span class="fa fa-shopping-cart"></span>
        				</button>
        			</div>
					<?php
echo "<img src='ajax/uploads/".$file_combi."'  class='img-responsive' alt='Product Image'/>";
?>
        		</div>
        		<div class="info">
        			<div class="row">
        				<div class="price-details ">
        					<p class="details">Name :<?php echo $row["p_name"]; ?> </p>
<p class="details"> Description: <?php echo $row['description']; ?> </p>
<p class="details"> Retail Price: <?php echo $row["price"]; ?> </p>
<p class="details">Wholesale  Price: <?php echo $row["minimum"]; ?> </p>
        				</div>
        			</div>
        		</div>
        	</article>
            <p class="text-center">Hover over image</p>
        </div>


	
 


<?php }
mysqli_close($mysqli);
	?>
	</tbody>
	</table>


</div>
</div>
</div>

</div>
</div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">Exit</button>
</div>

<div class="modal-body">
<div class="form-group row">
  <label for="external-id" class="col-xs-4 col-form-label">Invoice Number</label>
  <div class="col-xs-8">
     <input class="form-control" type="text" value="" id="id_" disabled>
  </div>
</div>
<div class="form-group row">
  <label for="external-id" class="col-xs-4 col-form-label">Customer</label>
  <div class="col-xs-8">
     <input class="form-control" type="text" value="" id="fname" disabled>
  </div>
</div>
<div class="form-group row">
  <label for="external-id" class="col-xs-4 col-form-label">Tenant ID</label>
  <div class="col-xs-8">
     <input class="form-control" type="text" value="" id="tenant_id" disabled>
  </div>
</div>
<div class="form-group row">
  <label for="external-id" class="col-xs-4 col-form-label">Invoiced Ammount</label>
  <div class="col-xs-8">
    <input class="form-control" type="text" value="" id="total" disabled>
  </div>
</div>
<div class="form-group row">
  <label for="external-id" class="col-xs-4 col-form-label">Rental Period</label>
  <div class="col-xs-8">
    <input class="form-control" type="text" value="" id="period" disabled>
  </div>
</div> 
<div class="form-group row">
  <label for="external-id" class="col-xs-4 col-form-label">Unit ID</label>
  <div class="col-xs-8">
    <input class="form-control" type="text" value="" id="id_unit" disabled>
  </div>
</div>
<div class="form-group row">
  <label for="external-id" class="col-xs-4 col-form-label">Paid Ammount</label>
  <div class="col-xs-8">
    <input class="form-control" type="text" value="" id="amount">
  </div>
</div>
<div class="form-group row">
<label class="control-label col-xs-4" for="fname">Payment Mode:</label>
  <div class="col-xs-8">
  
 <select class="form-control " name="mode" id="mode">
        <option value="Cash">Cash</option>
        <option value="Bank Deposit">Bank Deposit</option>
		
		<option value="Mpesa">Mpesa</option>
        <option value="Cheque">Cheque</option>
      </select>
	</div>	
	</div>
	<div class="form-group row">

		
		<label class="control-label col-xs-4" for="fname">Select Property:</label>
		<div class=" col-xs-8">
	<?php
    //Include database configuration file
    
    
    //Get all country data
    $query = $con->query("SELECT * FROM bank_accounts  ORDER BY id ASC");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    ?>
    <select class='form-control ' name="property" id="property">
        <option value="">Select Property</option>
        <?php
        if($rowCount > 0){
            while($row = $query->fetch_assoc()){ 
                echo '<option value="'.$row['bank_name'].'">'.$row['bank_name'].'</option>';
            }
        }else{
            echo '<option value="">Property not available</option>';
        }
        ?>
    </select>
	</div>
</div>
	<input type="hidden" id="responsible" value="<?php echo  $_id; ?> "/>
		<div class="form-group row">
  <label for="external-id" class="col-xs-4 col-form-label"> Payment Ref </label>
  <div class="col-xs-8">
    <input class="form-control" type="text" value="" id="payment_ref" >
  </div>
</div>



<button type="button" class="  btn-warning" data-dismiss="modal">Cancel</button>
<button type="submit" class=" btn-success " data-dismiss="modal" id="update_record">PAY</button>


</div>
</div>
</div>
</div>
        
</div>
</div>




<?php include ('includes/footer.php');  ?>