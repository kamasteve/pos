<?
require_once('functions.php');
require_once('print.php');
$date1=$_POST['date1'];
$date2=$_POST['date2'];
$type='BACK OFFICE';

Permission($_SESSION['department'],$type);
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US"><head><!-- Created by Artisteer v4.0.0.58475 -->
        <meta charset="utf-8">
        <title>Muuzaji</title>
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
                <?php headermenu($_SESSION['department'],'BACK OFFICE'); ?> 
            </nav>
<script src="js/jquery.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                 
                 function search(){

                      var title=$("#search").val();

                      if(title!=""){
                        $("#result").html("<img src='ajax-loader.gif'/>");
                         $.ajax({
                            type:"post",
                            url:"damaged.php",
                            data:"title="+title,
                            success:function(data){
                                $("#result").html(data);
                                $("#search").val("");
                             }

                          });
                      }
					    

                     
                 }

                 

                  $('#search').keyup(function(e) {
                     if(e.keyCode == 13) {
                        search();
                      }
                  });
            });
        </script>
<?

	ini_set('display_errors', 0);
	$user=$_SESSION['user_id'];
	$level=$_SESSION['admin_level'];


	
	require_once('mysql.php');
	if (isset($_POST['title']) && $_POST['title'] != '') {
	//Add slashes to any quotes to avoid SQL problems.
	$search = $_POST['title'];

	$r=("SELECT * FROM products WHERE code ='$search'");
	$sql=mysqli_query($dbc,$r);
$row=mysqli_fetch_array($sql);
	$id=$row['product_id'];
	
	
if($id&&1){
$s="select * from products where product_id='$id'";
$sql=mysqli_query($dbc,$s);
$row=mysqli_fetch_array($sql);
$product_code=$row['code'];
$product_id=$row['product_id'];
	$new_product = array(array('name'=>$row['description'],
	'system'=>$row['system'], 'code'=>$row['code'], 'qty'=>'1',
	'price'=>$row['price'],'product_id'=>$row['product_id'],'vat'=>$row['vat'],'selling'=>$row['buying']));

	if(isset($_SESSION["products"])) //if we have the session
		{
			$found = false; //set found item to false
			
			foreach ($_SESSION["products"] as $cart_itm) //loop through session array
			{
				if($cart_itm["product_id"] == $product_code){ //the item exist in array
$cart=$cart_itm["qty"]+1;
					$product[] = array('name'=>$cart_itm["name"], 'system'=>$cart_itm["system"],
					'code'=>$cart_itm["code"], 'qty'=>$cart,
					'price'=>$cart_itm["price"],'product_id'=>$cart_itm['product_id'],'vat'=>$cart_itm['vat'],'selling'=>$cart_itm['selling']);
					$found = true;
				}else{
				
					//item doesn't exist in the list, just retrive old info and prepare array for session var
					$product[] = array('name'=>$cart_itm["name"],
					'system'=>$cart_itm["system"], 'code'=>$cart_itm["code"], 'qty'=>$cart_itm["qty"],
					'price'=>$cart_itm["price"],'product_id'=>$cart_itm['product_id'],'vat'=>$cart_itm['vat'],'selling'=>$cart_itm['selling']);
				}
			}
			
			if($found == false) //we didn't find item in array
			{
				//add new user item in array
				$_SESSION["products"] = array_merge($product, $new_product);
				
			}else{
			
			
			
			
			
			
				//found user item in array list, and increased the quantity
				$_SESSION["products"] = $product;
			}
			
		}else{
			//create a new session var if does not exist
			 $_SESSION["products"] = $new_product;
		}
		//header("location: damaged.php");
		}
	?><script type="text/javascript">
window.location.reload();
</script type="text/javascript">

	
	<?
	
}
if(isset($_POST["submit"])&&isset($_SESSION["products"])){


$res ="SELECT code as number FROM socode";
		$sq=mysqli_query($dbc,$res);
		$rew=mysqli_fetch_array($sq);
		$number=$rew['number']+1;
		$_SESSION['SESSION']=session_id();
		
		$user=$_SESSION['user'];
		$i ="update socode set code='$number'";
		$sqi=mysqli_query($dbc,$i);
			

	


		$ip=get_client_ip() ;
		$tiller=teller($ip);
		$receipt=$_SESSION['RECEIPT'];
		$total=$_POST['gTotal'];
		
		$type='CASH';
		
$ip=get_client_ip() ;
		$tiller=teller($ip);
		$cash=$_POST['cash'];
		$change=$_POST['change'];
		$D="SELECT * FROM damages where number='$receipt'";
		$dd=mysqli_query($dbc,$D);
		if(mysqli_num_rows($dd)==0){
		$_SESSION['DAMAGES']=$number;}
		if(mysqli_num_rows($dd)>0){
		$res ="SELECT code as number FROM dode";
		$sq=mysqli_query($dbc,$res);
		$rew=mysqli_fetch_array($sq);
			$number=$rew['number']+1;
		$_SESSION['DAMAGES']=$number;
		}

	foreach ($_SESSION["products"] as $cart_itm)
    {
	$receipt=$_SESSION['DAMAGES'];
	 $price= $cart_itm["price"];
	$name=mysqli_real_escape_string($dbc,$cart_itm["name"]);
	$code=$cart_itm["code"];
	$qty=$cart_itm["qty"];
	$id=$cart_itm["product_id"];
	$system=$cart_itm["system"];
	$tax=$cart_itm["vat"];
	
	$TOTAL=($qty*$price);

	$x=$_SESSION['SESSION'];
	$ip=get_client_ip() ;
$y="select * from products where product_id='$id'";
	$yy=mysqli_query($dbc,$y);
	$yyy=mysqli_fetch_array($yy);
	$buying=$yyy["buying"];
	$totall+=$TOTAL;
	$session=$x;
	$buy=$buying*$qty;



$buyy+=$buying*$qty;
$f="insert into damages(product_id,date,qty,price,total,number,session)values
('$id',NOW(),'$qty','$buying','$buy','$receipt','$session')";
$ff=mysqli_query($dbc,$f);


		$tiller=teller($ip);
		$current=maximum($id);
		$user=$_SESSION['user'];

$st=mysqli_query($dbc,$t);
$d="UPDATE products SET  left_p =left_p - '$qty'
WHERE product_id = '$id'";
$t=mysqli_query($dbc,$d);
$ti="select * from products where product_id='$id'";
$tt=mysqli_query($dbc,$ti);
$tu=mysqli_fetch_array($tt);
$stock=$tu['left_p'];
$name=$tu['p_name'];
$f="insert into audit(product,date,value,reason,qty,number,user,stock,session)values
('$id',NOW(),'Product Damaged','$tiller','$qty','$receipt','$user','$stock','$session')";
$ff=mysqli_query($dbc,$f);
UserAudit($user,"Added $qty Damaged Product $name",date("Y/m/d"),$ip);
	}
	
	$cc=GetDamages();
$sss=GetStock();
	
	Damaged($buyy,$receipt,$sss,$cc,$session);
	//TaxRecord(GetVat(), GetKra(),date("Y/m/d"),$ttv,$receipt,$session);
	
	
	$url="damages.php?c=$cash&r=$receipt&ch=$change&x=$x";
	ob_end_clean();
header("Location: $url");
	
	session_regenerate_id();
		unset($_SESSION['products']);
	unset($_SESSION['DAMAGES']);
}


	



			if(isset($_GET["removep"]) && isset($_SESSION["products"]))
{
	$product_id	= $_GET["removep"]; //get the product code to remove
	//$return_url 	= base64_decode($_GET["return_url"]); //get return url

	
	foreach ($_SESSION["products"] as $cart_itm) //loop through session array var
	{	
		if($cart_itm["product_id"]!=$product_id){ //item does,t exist in the list
			$product[] = array('name'=>$cart_itm["name"], 'system'=>$cart_itm["system"],'code'=>$cart_itm["code"], 'qty'=>$cart_itm["qty"],
			'price'=>$cart_itm["price"],'product_id'=>$cart_itm['product_id'],'vat'=>$cart_itm['vat'],'selling'=>$cart_itm['selling']);
		}
		
		//create a new product list for cart
		$_SESSION["products"] = $product;
	}
	//header("location: damaged.php");
	//redirect back to original page
		header("location:damaged.php");
}
?><head><title>Damages</title><style>
input[type='text'] { font-size:18px;font-color:red; }
</style>
<style type="text/css">
    .fieldset-auto-width {
         display: inline-block;
    }

	
	}
</style>


<html>
<script language="JavaScript" type="text/javascript" src="damages.js"></script>

<script language="JavaScript" type="text/javascript" src="shortcuts.js"></script>
  <script>
shortcut.add("Ctrl",function() {
window.location.href = window.location.href;
});;

shortcut.add("Ctrl",function() {
window.location.href = window.location.href;
});;</script>
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
	  
	  a=Number(document.abc.QTY.value);

if (a!=0) // some logic to determine if it is ok to go
    {document.getElementById("xx").disabled = false;}
  else // in case it was enabled and the user changed their mind
    {document.getElementById("xx").disabled = true;}
	
	
i=Number(document.mn.cash.value);
p=Number(document.mn.amount.value);
l=Number(document.ble.gtotal.value);
k=Number(document.mn.payable.value);

if (l<=i) // some logic to determine if it is ok to go
    {document.getElementById("ble").disabled = false;}
	else if (l<=p) // some logic to determine if it is ok to go
    {document.getElementById("ble").disabled = false;}
	
	else if (k>0) // some logic to determine if it is ok to go
    {document.getElementById("ble").disabled = false;}
  else // in case it was enabled and the user changed their mind
    {document.getElementById("ble").disabled = true;}	
	
	
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
				  
<script type ="text/javascript" language ="javascript">
            function Print(elementId)
            {
                var printContent = document.getElementById(elementId);
                var windowUrl = 'about:blank';
                var uniqueName = new Date();
                var windowName = 'Print' + uniqueName.getTime();
                var printWindow = window.open(windowUrl, windowName, 'left=0,top=0,width=0,height=0');
                printWindow.document.write(printContent.innerHTML);
                printWindow.document.close();
                printWindow.focus();
                printWindow.print();
                printWindow.close();
            }
        </script>

<script type="text/javascript">

function isNum(value)
{
    return 123;
}

function calcTotals()
{
    var grandTotal = 0;
    var row = 0;

    while (document.forms['cart'].elements['price[]'][row])
    {
        priceObj = document.forms['cart'].elements['price[]'][row];
        qtyObj   = document.forms['cart'].elements['quantity[]'][row];
        totalObj = document.forms['cart'].elements['total[]'][row];

        if (isNaN(priceObj.value))
        {
            priceObj = '';
        }
        if (isNaN(qtyObj.value))
        {
            qtyObj = '';
        }

        if (priceObj.value && qtyObj.value)
        {
            totalObj.value = (parseFloat(priceObj.value) * parseFloat(qtyObj.value));
            grandTotal = grandTotal + parseFloat(totalObj.value);
        }
        else
        {
            totalObj.value = '';
        }
        row++;
    }
    document.getElementById('grand_total').value = grandTotal;
    return;
}

</script>
<script language="javascript" type="text/javascript">

function minus(){

a=Number(document.cart.cash.value);

b=Number(document.cart.grand_total.value);

c=a-b;

document.cart.change.value=c.toFixed(2);

}


</script>
<script type="text/javascript">
function showDiv(prefix,chooser) 
{
        for(var i=0;i<chooser.options.length;i++) 
		{
        	var div = document.getElementById(prefix+chooser.options[i].value);
            div.style.display = 'none';
        }
 
		var selectedOption = (chooser.options[chooser.selectedIndex].value);
		
 
		if(selectedOption == "1")
		{
			displayDiv(prefix,"1");
		}
		else if(selectedOption == "2")
		{
			displayDiv(prefix,"2");
		}
		else if(selectedOption == "3")
		{
			displayDiv(prefix,"3");
		}
		else if(selectedOption == "4")
		{
			displayDiv(prefix,"4");
		}
		
 
}
 
function displayDiv(prefix,suffix) 
{
        var div = document.getElementById(prefix+suffix);
        div.style.display = 'block';
}

</script>









<script type="text/javascript">
function showDiv2(prefix,chooser) 
{
        for(var i=0;i<chooser.options.length;i++) 
		{
        	var div = document.getElementById(prefix+chooser.options[i].value);
            div.style.display = 'none';
        }
 
		var selectedOption = (chooser.options[chooser.selectedIndex].value);
		
 
		if(selectedOption == "5")
		{
			displayDiv(prefix,"5");
		}
		else if(selectedOption == "4")
		{
			displayDiv(prefix,"4");
		}
		
 
}
 
function displayDiv(prefix,suffix) 
{
        var div = document.getElementById(prefix+suffix);
        div.style.display = 'block';
}

</script>




</head>
      

<script>
function startTime() {
    var today=new Date();
    var h=today.getHours();
    var m=today.getMinutes();
    var s=today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML = h+":"+m+":"+s;
    var t = setTimeout(function(){startTime()},500);
}

function checkTime(i) {
    if (i<10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
</script>
<script language="JavaScript" type="text/javascript" src="new.js"></script>
<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
$('#inputform').on('keydown', 'input', function (event) {
    if (event.which == 35) {
        event.preventDefault();
        var $this = $(event.target);
        var index = parseFloat($this.attr('data-index'));
        $('[data-index="' + (index + 1).toString() + '"]').focus();
    }
});
});//]]>  

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
                xmlhttp.open("GET", "./search/gett.php?q=" + str, true);
                xmlhttp.send();
            }
           
        </script>


<body onLoad="calcTotals(),startTime()"></body>

   <div class="topleft">
	
     
<div id="layer2" style="margin-right:-30px;"></div>

	
	
	</div>
     <body>    
   <fieldset style="border-color:#000000; border-width:5px; background-color:#e8e8e8;" class="fieldset-auto-width"><form id='inputform'>
        <div id="container">
           
 			 <input type="text" data-index="1" autofocus="autofocus" id="amots" placeholder=" Put Product Name Here..... "
			  size="30" onKeyUp="bleble();" autocomplete="off"/>
          
             <ul id="result"></ul>
        </div></form>
		</fieldset>
  

	
	
	</div><br>

<table align="center" frame="BOX"  style="border-color:#000000;font-size:20px ;background-color:#e8e8e8;" frame="BOX" border="0.2"  width="950px" 
 cellpadding="0.5"  >
 <tr><th style="border-color:#000000;background-color:#0a6184;">Product</th><th
 style="border-color:#000000;background-color:#0a6184;">Quantity</th><th
 style="border-color:#000000;background-color:#0a6184;">Empty</th>
 <th
 style="border-color:#000000;background-color:#0a6184;"></th></tr>
 <tr>
      <td><input type="hidden" name="price[]" onkeyup="calcTotals()" readonly/>
      </td><td><input type="hidden" required="required" name="quantity[]" onkeyup="calcTotals()" />
      </td><td><input type="hidden"  name="total[]" readonly/></td>
  </tr>
<?if(isset($_SESSION["products"]))
{
//krsort($_SESSION["products"]);
    $total = 0;
  $i = 0;
    foreach ($_SESSION["products"] as $cart_itm)
    {
	$totalp+=$cart_itm["price"]*$cart_itm["qty"];
	echo '<form method="post" action="add_d.php">';
	?>
 
  <tr><td  style="border-color:#000000;background-color:white;"><?echo UCWORDS($cart_itm["name"]);?></td>
     <td   style="border-color:#000000;background-color:#e8e8e8;"><?echo
	  "<input type='text' size='7' name='quantity[$i]' value=' {$cart_itm['qty']}' />";?>
	 
      </td>
	  <td style="border-color:#000000;background-color:#e8e8e8;"><?echo '<a href=damaged.php?removep=' . $cart_itm["product_id"] .'>';?>
	<img src="x.png"/></a></td>
	<td><input type="submit"
name="type" value="Update" style="height: 0px;background-color#4AC948;  width: 0px;
	cursor:pointer;" />
 
  
  <?
   echo '<input type="hidden" name="code" value="'.$cart_itm["product_id"].'" />
   <input type="hidden" name="number" value="'.$i.'" />';
           ?></td></tr></form><?
  	++$i;
  }}?>
  
  <form name="cart" id='inputform'  method="POST" action="damaged.php" style="border-color:#000000; border-width:2; font-size:17px;">
 
 
<tr>
     <th style="text-align:right;" colspan="4"><input class="active" name="submit" type="submit" value="COMPLETE TRANSACTION"
	 style="height: 85px;background-color#4AC948;  width: 180px;
	cursor:pointer;"  /></td></tr>
</table></form>


	
