<?
require_once('functions.php');
require_once('print.php');
$date1=$_POST['date1'];
$date2=$_POST['date2'];
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US"><head><!-- Created by Artisteer v4.0.0.58475 -->
        <meta charset="utf-8">
        <title>POINT OF</title>
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
                <?php headermenu($_SESSION['department']); ?> 
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
                            url:"tables.php",
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
	$user=$_SESSION['user_name'];
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

	$new_product = array(array('name'=>$row['description'],
	'system'=>$row['system'], 'code'=>$row['code'], 'qty'=>'1',
	'price'=>$row['price'],'product_id'=>$row['product_id'],'vat'=>$row['vat'],'selling'=>$row['buying']));

	if(isset($_SESSION["products"])) //if we have the session
		{
			$found = false; //set found item to false
			
			foreach ($_SESSION["products"] as $cart_itm) //loop through session array
			{
				if($cart_itm["code"] == $product_code){ //the item exist in array
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
		//header("location: tables.php");
		}
	?><script type="text/javascript">
window.location.reload();
</script type="text/javascript">

	
	<?
	
}

	


if(isset($_POST['sub'])){
$res ="SELECT code as number FROM socode";
		$sq=mysqli_query($dbc,$res);
		$rew=mysqli_fetch_array($sq);
		$number=$rew['number']+1;
		$_SESSION['SESSION']=session_id();
		$_SESSION['RECEIPT']=$number;
		$user=$_SESSION['user_name'];
		$i ="update socode set code='$number'";
		$sqi=mysqli_query($dbc,$i);
			

	


		$ip=get_client_ip() ;
		$tiller=teller($ip);
		$rec=$_SESSION['RECEIPT'];
$total=0;
foreach ($_SESSION["products"] as $cart_itm)
    {
	 $price= $cart_itm["price"];
	 $qty=$cart_itm["qty"];
	 $gtotal+=($qty*$price);
	}
	
if($_POST['credit1']!=''){
 $credit=$_POST['credit1'];
$r="select * from return_in where credit='$credit' and status='ACTIVE'";
$sql=mysqli_query($dbc,$r);
$row=mysqli_fetch_array($sql);
 $credit1=$row['total_p'];
$total=$credit1+$total;
$ra="UPDATE return_in set status='NOT ACTIVE' where credit='$number'";
			$ri=mysqli_query($dbc,$ra);

}
if($_POST['cashm']!=''){
if($_POST['cashm']>0){
 $cash=$_POST['cashm'];}


 $total=$total+$cash;

}
if($_POST['bank']!=''){
if($_POST['bank']>0){
$cheque=$_POST['bank'];}


$total=$total+$cheque;

}
if($total>$gtotal||$total==$gtotal){
	$D="SELECT * FROM sales where number='$receipt'";
		$dd=mysqli_query($dbc,$D);
		if(mysqli_num_rows($dd)==0){
		$_SESSION['RECEIPT']=$number;}
		if(mysqli_num_rows($dd)>0){
		$res ="SELECT code as number FROM socode";
		$sq=mysqli_query($dbc,$res);
		$rew=mysqli_fetch_array($sq);
			$number=$rew['number']+1;
		$_SESSION['RECEIPT']=$number;
		}
	foreach ($_SESSION["products"] as $cart_itm)
    {
	$rec=$_SESSION['RECEIPT'];
	 $price= $cart_itm["price"];
	 $qty=$cart_itm["qty"];
$name=mysqli_real_escape_string($dbc,$cart_itm["name"]);
	$code=$cart_itm["code"];
	
	$system=$cart_itm["system"];
	$id=$cart_itm["product_id"];
	$tax=$cart_itm["vat"];
	$TOTAL=($qty*$price);
	$hh+=$TOTAL;
	$totalv=$tax/100*($qty*$price);
	$x=$_SESSION['SESSION'];
$y="select * from products where code='$code'";
	$yy=mysqli_query($dbc,$y);
	$yyy=mysqli_fetch_array($yy);
	$buying=$yyy["buying"];
$session=$x;
	$t="insert into ledgers(credit,receipt,account_id,froms,session,date,description)values('$TOTAL','$rec','4','2','$session',NOW(),'SALES')";
$tt=mysqli_query($dbc,$t);
//$account=GetId($id);
$t="insert into ledgers(debit,account_id,froms,receipt,session,date,description)values('$TOTAL','2','4','$rec','$session',NOW(),'SALES')";
$tt=mysqli_query($dbc,$t);

$buy=$buying*$qty;

$t="insert into ledgers(credit,receipt,account_id,froms,session,date,description)values('$buy','$rec','3','5','$session',NOW(),'SALES')";
$tt=mysqli_query($dbc,$t);
//$account=GetId($id);
$t="insert into ledgers(debit,account_id,froms,receipt,session,date,description)values('$buy','5','3','$receipt','$session',NOW(),'SALES')";
$tt=mysqli_query($dbc,$t);
	$t="INSERT INTO sales (p_name, qty, total_p,number, date, time,price, p_code, p_price,vat,user,session,system)
VALUES ('$name', '$qty', ('$TOTAL'), '$rec', NOW(), NOW(), '$price', '$code','$buying',round('$totalv'),'$user','$x','$system')";
$st=mysqli_query($dbc,$t);
$d="UPDATE products SET sold =sold + '$qty', left_p =left_p - '$qty'
WHERE product_id = '$id'";
$t=mysqli_query($dbc,$d);

$ti="select * from products where product_id='$id'";
$tt=mysqli_query($dbc,$ti);
$tu=mysqli_fetch_array($tt);
$stock=$tu['left_p'];
$f="insert into audit(product,date,value,reason,qty,number,user,stock)values
('$code',NOW(),'Product Sales','$tiller','$qty','$rec','$user','$stock')";
$ff=mysqli_query($dbc,$f);
	}
	$receipt=$_SESSION['RECEIPT'];
		$to=$gtotal-$credit1;
			$t="insert into x_report(date,till,user,amount,time,type,receipt,session,bank,number)
		values(NOW(),'$tiller','$user','$to',NOW(),'CASH','$rec','$x','','')";
		$sql=mysqli_query($dbc,$t);
		$t="insert into x_report(date,till,user,amount,time,type,receipt,session,bank,number)
		values(NOW(),'$tiller','$user','$credit1',NOW(),'CREDIT NOTES','$rec','$x','','$credit')";
		$sql=mysqli_query($dbc,$t);
			
multiple($credit1,$cheque,$to,$rec,$gtotal);
	unset($_SESSION['products']);
	unset($_SESSION['RECEIPT']);
  unset($_SESSION['SESSION']);
    session_regenerate_id();
}
}

	if(isset($_POST["submit"])&&isset($_SESSION["products"])){


$res ="SELECT code as number FROM socode";
		$sq=mysqli_query($dbc,$res);
		$rew=mysqli_fetch_array($sq);
		$number=$rew['number']+1;
		$_SESSION['SESSION']=session_id();
		
		$user=$_SESSION['user_name'];
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
		$D="SELECT * FROM sales where number='$receipt'";
		$dd=mysqli_query($dbc,$D);
		if(mysqli_num_rows($dd)==0){
		$_SESSION['RECEIPT']=$number;}
		if(mysqli_num_rows($dd)>0){
		$res ="SELECT code as number FROM socode";
		$sq=mysqli_query($dbc,$res);
		$rew=mysqli_fetch_array($sq);
			$number=$rew['number']+1;
		$_SESSION['RECEIPT']=$number;
		}
		if($change==0||$change>0){
	foreach ($_SESSION["products"] as $cart_itm)
    {
	$receipt=$_SESSION['RECEIPT'];
	 $price= $cart_itm["price"];
	$name=mysqli_real_escape_string($dbc,$cart_itm["name"]);
	$code=$cart_itm["code"];
	$qty=$cart_itm["qty"];
	$id=$cart_itm["product_id"];
	$system=$cart_itm["system"];
	$tax=$cart_itm["vat"];
	$TOTAL=($qty*$price);
	$totalv=$tax/100*($qty*$price);
	$x=$_SESSION['SESSION'];
	$ip=get_client_ip() ;
$y="select * from products where code='$code'";
	$yy=mysqli_query($dbc,$y);
	$yyy=mysqli_fetch_array($yy);
	$buying=$yyy["buying"];
	$totall+=$TOTAL;
	$session=$x;
	$buy=$buying*$qty;
	$t="insert into ledgers(credit,receipt,account_id,froms,session,date,description)values('$TOTAL','$receipt','4','2','$session',NOW(),'SALES')";
$tt=mysqli_query($dbc,$t);
//$account=GetId($id);
$t="insert into ledgers(debit,account_id,froms,receipt,session,date,description)values('$TOTAL','2','4','$receipt','$session',NOW(),'SALES')";
$tt=mysqli_query($dbc,$t);


$t="insert into ledgers(credit,receipt,account_id,froms,session,date,description)values('$buy','$receipt','3','5','$session',NOW(),'SALES')";
$tt=mysqli_query($dbc,$t);
//$account=GetId($id);
$t="insert into ledgers(debit,account_id,froms,receipt,session,date,description)values('$buy','5','3','$receipt','$session',NOW(),'SALES')";
$tt=mysqli_query($dbc,$t);
		$tiller=teller($ip);
	$t="INSERT INTO sales (p_name, qty, total_p,number, date, time,price, p_code, p_price,vat,user,session,system)
VALUES ('$name', '$qty', ('$TOTAL'), '$receipt', NOW(), NOW(), '$price', '$code','$buying',round('$totalv'),'$user','$x','$system')";
$st=mysqli_query($dbc,$t);
$d="UPDATE products SET sold =sold + '$qty', left_p =left_p - '$qty'
WHERE product_id = '$id'";
$t=mysqli_query($dbc,$d);
$ti="select * from products where product_id='$id'";
$tt=mysqli_query($dbc,$ti);
$tu=mysqli_fetch_array($tt);
$stock=$tu['left_p'];
$f="insert into audit(product,date,value,reason,qty,number,user,stock)values
('$code',NOW(),'Product Sales','$tiller','$qty','$receipt','$user','$stock')";
$ff=mysqli_query($dbc,$f);
	}
		$t="insert into x_report(date,till,user,amount,time,type,receipt,session)
		values(NOW(),'$tiller','$user','$totall',NOW(),'$type','$receipt','$x')";
		$sql=mysqli_query($dbc,$t);
		
	 Receipt($receipt,$cash,$change,$x);
	unset($_SESSION['products']);
	unset($_SESSION['RECEIPT']);	
	session_regenerate_id();
	}session_regenerate_id();
		unset($_SESSION['products']);
	unset($_SESSION['RECEIPT']);
}

			if(isset($_GET["removep"]) && isset($_SESSION["products"]))
{
	$product_id	= $_GET["removep"]; //get the product code to remove
	//$return_url 	= base64_decode($_GET["return_url"]); //get return url

	
	foreach ($_SESSION["products"] as $cart_itm) //loop through session array var
	{	if($cart_itm["product_id"]==$product_id){
	$qty=$cart_itm["qty"];
	$price=$cart_itm["price"];
	$session=session_id();
	$teller=teller($ip);
	$code=$cart_itm["code"];
	$name=mysqli_real_escape_string($dbc,$cart_itm["name"]);
		$user=$_SESSION['user_name'];
	$h="insert into exemptions(qty,price,user,session,code,time,date,teller,product_id,name)
	values('$qty','$price','$user','$session','$code',NOW(),NOW(),'$teller','$product_id','$name')";
	$hh=mysqli_query($dbc,$h);
	}
		if($cart_itm["product_id"]!=$product_id){ //item does,t exist in the list
			$product[] = array('name'=>$cart_itm["name"], 'system'=>$cart_itm["system"],'code'=>$cart_itm["code"], 'qty'=>$cart_itm["qty"],
			'price'=>$cart_itm["price"],'product_id'=>$cart_itm['product_id'],'vat'=>$cart_itm['vat'],'selling'=>$cart_itm['selling']);
		}
		
		//create a new product list for cart
		$_SESSION["products"] = $product;
	}
	//header("location: tables.php");
	//redirect back to original page
		header("location:tables.php");
}
?><head><title>SALES</title><style>
input[type='text'] { font-size:18px; }
</style>
<style type="text/css">
    .fieldset-auto-width {
         display: inline-block;
    }

	
	}
</style>


<html>
<script language="JavaScript" type="text/javascript" src="productsearch.js"></script>

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

<table align="center" frame="BOX"  style="border-color:#000000;font-size:20px ;background-color:#e8e8e8;" frame="BOX" border="1"  width="800px"  cellpadding="1"  >
 <tr><th style="border-color:#000000;background-color:#0a6184;">Product</th><th style="border-color:#000000;background-color:#0a6184;">Price</th><th
 style="border-color:#000000;background-color:#0a6184;">Quantity</th><th style="border-color:#000000;background-color:#0a6184;">Total</th><th
 style="border-color:#000000;background-color:#0a6184;">Remove</th>
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
	echo '<form method="post" action="add_p.php">';
	?>
 
  <tr><td  style="border-color:#000000;background-color:#e8e8e8;"><input type="text"  name="product[]" size="55" value="<?echo UCWORDS($cart_itm["name"]);?>"  readonly/>
      <td  style="border-color:#000000;background-color:#e8e8e8;">
	<?echo
	  "<input type='text' onkeypress='return checkIt(event)'  name='price[$i]' value=' {$cart_itm['price']}' />";?>
      </td><td  align="left" style="border-color:#000000;background-color:#e8e8e8;"><?echo
	  "<input type='text' onkeypress='return checkIt(event)'  name='quantity[$i]' value=' {$cart_itm['qty']}' />";?>
	 
      </td><td  style="border-color:#000000;background-color:#e8e8e8;">
	  <input type="text" value="<?echo $cart_itm["price"]*$cart_itm["qty"];?>"  name="total[]"  readonly/></td>
	  <td style="border-color:#000000;background-color:#e8e8e8;"><?echo '<a href=tables.php?removep=' . $cart_itm["product_id"] .'>';?>
	<img src="media/Delete.png"/></a></td>
	<td><input type="submit"
name="type" value="Update" style="height: 1px;background-color#4AC948;  width: 1px;
	cursor:pointer;" />
 
  
  <?
   echo '<input type="hidden" name="code" value="'.$cart_itm["code"].'" />
   <input type="hidden" name="number" value="'.$i.'" />';
           ?></td></tr></form><?
  	++$i;
  }}?>
  
  <form name="cart" id='inputform'  method="POST" action="tables.php" style="border-color:#000000; border-width:2; font-size:17px;">
  <tr>
      <th style="background-color:#e8e8e8;" colspan="3" style="text-align:right;">
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Grand Total</th>
      <th style="background-color:#e8e8e8;"><input type="text"  name="gTotal" value="<?echo $totalp;?>" id="grand_total" readonly/></th>
  </th></tr><tr>
    <th style="background-color:#e8e8e8;" colspan="3" style="text-align:right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cash Amount</td>
      <td style="border-color:#000000;background-color:#e8e8e8;"><input data-index="2" autocomplete="off" type="text" onkeypress="return checkIt(event)"  name="cash"  required="required" onkeyup="minus()" id="cash" /></td>
  </th></tr><tr>
    <th style="border-color:#000000;background-color:#e8e8e8;font-weight: bold;;" colspan="3" style="text-align:right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Change</th>
      <td style="border-color:#000000;background-color:#e8e8e8;"><input  type="text" style="background-color:red;font-size:19px"  name="change" id="change" readonly/></td>
  </th></tr><tr>
     <th style="text-align:right;" colspan="4"><input class="active" name="submit" type="submit" value="COMPLETE SALE"
	 style="height: 85px;background-color#4AC948;  width: 150px;
	cursor:pointer;"  /></td>
</table></form>
<form name="car"  method="POST" action="tables.php" style="border-color:#000000; border-width:thin; font-size:13px;">
 <div align="right">
  <fieldset class="fieldset-auto-width" style="border-color:#000000; border-width:4px; background-color:#e8e8e8;">
<legend>Other Payment Details</legend>


<div style="margin-right:159px;background-color:#e8e8e8;border-width: 3px";>
 OTHER MODES OF PAYMENT:&nbsp;&nbsp;
	<select name="textfield" id="cboOptions" onChange="showDiv('div',this)">	
		<option value="2">Account</option>
		<option value="3">cheque</option>
	<option value="1">mpesa</option>

	<option value="4">multiple</option>

	</select><tr>
     <th style="text-align:right;" colspan="4"><input name="sub" type="submit" value="COMPLETE SALE" style="height: 85px; width: 150px;
	cursor:pointer;"  /></td>
  
<div id="div1" class="text" style="display:none;">
	<label style="margin-left: 130px;">Amount:<input name="totall" id="amount" type="text" /></label>
	<label style="margin-left: 63px;">Code:<input name="code" id="code" type="text" /></label>
		
	</div></div>
	
	<div id="div3" class="text" style="display:none;">
	<label style="margin-left: 100px;">Bank:<input name="bankk" id="bank" type="text"/></label>
	<label style="margin-left: 63px;">Cheque No.:<input name="codee" id="check" type="text" /></label>
	<label style="margin-left: 63px;">Amount:<input name="totalll" id="amount" type="text" onkeyup="minus1()" /></label>
	</div>
	<div id="div4" class="text" style="display:none;">
	<label style="margin-left: 100px;">Credit No:<input name="credit1" id="bank" type="text"/></label>

	<label style="margin-left: 63px;">Amount:<input name="cashm"" type="text" />
	</label>
	</div>
		<div id="div2" class="text" style="display:none;">
	<label style="margin-left: 100px;">Credit No:<input  /></label>

	</div>
	
	
	
</form></fieldset></div>

</form><form>



</body>
</html>