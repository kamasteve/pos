<?php ini_set('display_errors', 1);
	
		require_once('functions.php');
		
			$type='BACK OFFICE';

if (!isset($_SESSION['user']
 )) {
$url = 'login.php';
ob_end_clean();
header("Location: $url");
exit();
}
			$user=$_SESSION['user_name'];
	



?>
   <link rel="stylesheet" href="menu.css" media="screen">
     <link rel="stylesheet" href="style.responsive.css" media="all">
 <script src="jquery.js"></script>
        <script src="script.js"></script>
        <script src="script.responsive.js"></script>
 <nav class="art-nav clearfix">
             <?php headermenu($_SESSION['department'],'BACK OFFICE'); ?> 
            </nav>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script> 
<title>Add Stock</title>
<script language="JavaScript" type="text/javascript" src="supplier.js"></script>
<script language="JavaScript" type="text/javascript" src="stockincodesearch.js"></script>

<style type="text/css">
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
</style>
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
    function ShowTime()
    {
      var time=new Date()
      var h=time.getHours()
      var m=time.getMinutes()
      var s=time.getSeconds()
      // add a zero in front of numbers<10
      m=checkTime(m)
      s=checkTime(s)
      document.getElementById('txt').value=h+" : "+m+" : "+s
      t=setTimeout('ShowTime()',1000)

    }
    function checkTime(i)
    {
      if (i<10)
      {
        i="0" + i
      }
      return i
    }
    </script>
	
<script language="javascript" type="text/javascript">

function multiply(){

a=Number(document.abc.QTY.value);

b=Number(document.abc.PPRICE.value);
h=Number(document.abc.DISC.value);
g=Number(document.abc.TAX.value);
f=Number(document.abc.TOTAL.value);
q=Number(document.abc.DISCOUNT.value);

c=a*b;
e=c*h/100;
d=g/100*(a*b);
n=a*b;
z=a*b-q;
k=z*g/100;
p=a*b*h/100;
m=n-p;
l=n-k;

document.abc.TOTAL.value=l;
document.abc.VAT.value=k;
document.abc.DISCOUNT.value=p;
document.abc.TOTALL.value=m;
}
function tax(){

a=Number(document.abc.TAX.value);

b=Number(document.abc.TOTAL.value);


c=a/100*b;

h=b+c;

document.abc.VAT.value=c;
document.abc.TOTALL.value=h;
}
function total(){

a=Number(document.abc.TAX.value);

b=Number(document.abc.TOTALL.value);
c=Number(document.abc.QTY.value);
h=Number(document.abc.DISC.value);
z=a+100;
g=h/100*b;
e=b/c;
t=100/z*e;
v=a/z*b;
document.abc.PPRICE.value=e.toFixed(2);
document.abc.VAT.value=v.toFixed(2);
document.abc.PRICE.value=t.toFixed(2);
document.abc.DISCOUNT.value=g.toFixed(2);

}
function qty(){

a=Number(document.abc.TAX.value);

b=Number(document.abc.PPRICE.value);
c=Number(document.abc.QTY.value);
h=Number(document.abc.DISC.value);
t=b*c;
z=a+100;
g=h/100*b;
e=b/c;
tr=100/z*t/c;
v=a/z*t;
document.abc.TOTALL.value=t.toFixed(2);
document.abc.VAT.value=v.toFixed(2);
document.abc.PRICE.value=tr.toFixed(2);
document.abc.DISCOUNT.value=g.toFixed(2);

}
function minus(){

a=Number(document.sumary.totala.value);

b=Number(document.sumary.aba.value);


c=a*b;
d=a+c;
f=d;

document.sumary.less.value=c.toFixed(2);
document.sumary.vatableless.value=f.toFixed(2);
document.sumary.totalamountdue.value=d.toFixed(2);
}


</script>


</script>


<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "This field accepts numbers only."
        return false
    }
    status = ""
    return true
}
</SCRIPT>





<link rel="stylesheet" href="css.css" type="text/css" media="screen" />
<link href="h.css" rel="StyleSheet" type="text/css">
<style type="text/css">
<!--
.style1 {font-size: 36px}
-->
  </style>
</head>

			<style>
input[type='text'] { font-size:15px; }
</style>
<style type="text/css">
    .fieldset-auto-width {
         display: inline-block;
    }

	
	}
</style>

<?php

function formatMoney($number, $fractional=false) {
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
}	


?>
 <div align="center"><h4><? $no=$_SESSION['MEMBER'];
						$name=Acc($_SESSION['supplier']);echo "Invoice No $no By $name ";?></h2></div>
   <div class="topleft">
	
     
<div id="layer2" style="margin-right:-30px;"></div>

	
	
	</div>
     <body>    
   <fieldset style="border-color:#000000; border-width:1px; background-color:#e8e8e8;" >
   <form  id="CODE" method="post" action="codes.php">
       <table align="left"  style="border-color:#000000;font-size:15px ;background-color:;" frame="BOX" border="0.1"  width="980px" 
 cellpadding="0"><tr><td>
	  <input type="text" name="title" id="2" autofocus="autofocus" autocomplete="off"  placeholder=" Put Barcode Here....."/>
	  <input type="submit"  style="height:0px;width:0px;border:none;padding:0px;" hidefocus="true"/></form></td><td>
           
 			 <input type="text"   id="amot" placeholder=" Put Product Name Here..... "
			  size="30" onKeyUp="bleble();" autocomplete="off"/>
          
            </td></tr></table>
   
		</fieldset>
<form action="add_stock.php" method="post" name="abc"><div class="wraper">
<fieldset style="border-width: 5px;">

					<legend style="font-family:Bell Gothic,Verdana,Arial"><b>Product Details</legend>



 
	
	
    
						<?php
						/*$q=20;
						$s=86400;
						$r=$q*$s;*/
						$timestamp=time(); //current timestamp
						/*$tm=$timestamp+$r; // Will add 2 days to the $timestamp*/
						$da=date("m/d/Y", $timestamp);
						/*
						echo "Current time string: $da <br>";
						$da1=date("F j, Y", $tm);
						echo "Modified time: $da1 <br>";*/
						?>
						




						<?php
							if (isset($_GET['id']))
							{
						$con = mysql_connect('localhost','root',"");
						if (!$con)
						  {
						  die('Could not connect: ' . mysql_error());
						  }
						
						mysql_select_db("gikomba", $con);
						
						$p_id = $_GET['id'];
						$result = mysql_query("SELECT * FROM products WHERE product_id = $p_id");
						
						$row = mysql_fetch_array($result);
						$name=$row["p_name"];
						$CODE=$row["code"];
						$desc=$row["p_name"];
						$qty_left=$row["left_P"];
						$price=$row["price"];
						$buying=$row["buying"];
						$id=$row["product_id"];
						$pleft=$row["left_p"];
						mysql_close($con);
						}
						
						?>
				
			
						
						
						
						
						
						
						
						<table cellpadding="4" cellspacing="0" border="1"
						style="font-family:Bell Gothic,Verdana,Arial" width="1200" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="347"><div align="left">Product Name </div></td>
    <td colspan="3"><?echo $desc;?><input  style="background-color:#e8e8e8;" name="PNAME" type="hidden" value="<?php echo $desc ?>" size="50" style="border:0px;" readonly/></td>
 
	
	 <td><div align="left"><b>Discount </div></td>
    <td width="284"><input style="background-color:#e8e8e8;font-size:16px" name="DISC" id="DISC" type="text" value="0.00" onkeyup="total()"  size="20"
	 />
	     
	</td>
    <td width="124" rowspan="3"><input name="submit" type="submit" 
	value="ADD TO CART" style="height: 84px; width: 110px; cursor:point_of_saler;" id="xx" /><input name="product_id" type="hidden" value="<?php echo $id ?>" readonly/><input name="PCODES" type="hidden" value="<?php echo $CODE ?>" readonly/></td>
  </tr>
  <tr>
      <td width="104"><div align="left"><b>Quantity : </div></td>
    <td width="184">
      <input name="QTY" style="background-color:#e8e8e8;font-size:16px" id="QTY"  autocomplete="off" type="text" onkeyup="total()"required="required"  />
   </td>
    <td width="300"><div align="left">Sub Total : </div></td>
    <td width="104"><span style="margin-left: 0px;">
  <input style="background-color:#e8e8e8;"  name="PRICE" id="PRICE" required="required"  type="text"  style="border:0px;" readonly="readonly"/>
    </span></td>

    <td width="300"><div align="left">Discount Amount: </div></td>
    <td><span style="margin-left: 0px;">
      <input style="background-color:#e8e8e8;" name="DISCOUNT" id="DISCOUNT" type="text"  style="border:0px;"/>
    </span></td>
  </tr>
  <tr>
    
    <input name="CODE" type="hidden" id="CODE" value="" style="border:0px;"/>
    <td><div align="left">Cost Price : </div></td>
    <td><input  style="background-color:#e8e8e8;" name="PPRICE" id="PPRICE" type="text" onfocus='javascript:this.value=""' onkeyup="qty()"  autocomplete="off" style="border:0px;" /></td>
    <td><div align="left">Previous Price: </div></td>
<td> <input  style="background-color:#e8e8e8;" name='buying' value="<?php echo $buying; ?>" type="text" style="border:0px;" readonly="readonly"/>
<input name='selling' value="<?php echo $price; ?>" type="hidden" />
	


  </tr>
   <tr>
    <td><div align="left"><b>Tax Rate : </div></td>
    <td><input name="TAX" style="background-color:#e8e8e8;font-size:16px" type="text" id="TAX" onkeyup="total()"  value="16.00" /></td>
    <td><div align="left"> V.A.T: </div></td>
    <td><input name="VAT" style="background-color:#e8e8e8;"  id="VAT" type="text" style="border:0px;" readonly="readonly"/></td>
    <td><div align="left"><b>TOTAL </div></td>
<td> <input style="background-color:#e8e8e8;font-size:16px" name="TOTALL" id="TOTALL" autocomplete="off" onkeyup="total()"   type="text"  />
	
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
 
</table>
	
	
	
	
	
  
  </fieldset>

  
  
  
  
  
  
  
  
  <fieldset style="border-width: 3px;">

					<legend style="font-family:Bell Gothic,Verdana,Arial"><b>Invoice List</legend>
  <div class="center">
    <table cellpadding="4" cellspacing="0" 
						style="font-family:Bell Gothic,Verdana,Arial" border="1" cellspacing="0" cellpadding="0" style="border-color:#000000;background-color:#cc8022;border-width:thin;">
      <tr>
        
        <td width="35%"><div align="center"><strong>DESCRIPTION</strong></div></td>
		<td width="10%"><div align="center"><strong>QUANTITY </strong></div></td>
	
        
        <td width="10%"><div align="center"><strong>UNIT PRICE</strong></div></td>
		<td width="10%"><div align="center"><strong>DISCOUNT</strong></div></td>
			<td width="10%"><div align="center"><strong>V.A.T</strong></div></td>
		<td width="10%"><div align="center"><strong>TOTAL</strong></div></td>
		<td width="5%">CANCEL</td>

      </tr>
	  <?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("gikomba", $con);
 $f=$_SESSION['MEMBER'];
$result = mysql_query("SELECT *,stocking.price as d FROM stocking 
inner join products on products.product_id=stocking.product_id
where t_code= '$f'
group by stocking.product_id ORDER BY id desc");

while($row = mysql_fetch_array($result))
  {
      echo '<tr>';
 
		echo '<td><div align="left">&nbsp;&nbsp;'.$row['p_name'].'</div></td>';
        echo '<td><div align="center">'.$row['qty'].'</div></td>';
	$discount+=$row['discount'];
	$tax+=$row['tax'];
	$total+=$row['total_p'];
        echo '<td><div align="center">'.number_format($row['d']).'</div></td>';
		 echo '<td><div align="center">'.$row['discount'].'</div></td>';
		    echo '<td><div align="center">'.$row['tax'].'</div></td>';
        echo '<td><div align="right">';
		$fg=$row['total_p'];
		echo formatMoney($fg, true);
		echo '&nbsp;&nbsp;</div></td>';
	
		echo '&nbsp;&nbsp;</div></td>';
		
        echo '<td>';
		echo '<a href=delete_stock.php?id=' . $row["id"] .'>Remove</a>';
		echo '</td>';
      echo '</tr>';
	  
	  }
	    echo '<tr>';
        echo '<td colspan="3"><b><center>TOTAL</td>';
	
  

		 echo '<td><div align="center"><b>'.number_format($discount,2).'</div></td>';
		    echo '<td><div align="center"><b>'.number_format($tax,2).'</div></td>';
    echo '<td><div align="center"><b>'.number_format($total).'</div></td>';
	
		echo '&nbsp;&nbsp;</div></td>';
		
      
      echo '</tr>';

mysql_close($con);
?>
    </table>
	</form>
 
  
    <br />
	
	<div align="right">
	
	
	


	


	

</body>


</html>
<table width="100%" height="-5%" cellspacing="0" border="0">
<TR height="100"><TD><?php require_once("footer.php"); ?></TD></TR>


