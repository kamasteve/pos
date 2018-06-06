<?
require_once('functions.php');
require_once('print.php');
$date1=$_POST['date1'];
$date2=$_POST['date2'];
$type='SALES';

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
                <?php headermenu($_SESSION['department'],'SALES'); ?> 
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
                            url:"stockist.php",
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
	$user=$_SESSION['user'];
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

	if(isset($_SESSION["stockist"])) //if we have the session
		{
			$found = false; //set found item to false
			
			foreach ($_SESSION["stockist"] as $cart_itm) //loop through session array
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
				$_SESSION["stockist"] = array_merge($product, $new_product);
				
			}else{
			
			
			
			
			
			
				//found user item in array list, and increased the quantity
				$_SESSION["stockist"] = $product;
			}
			
		}else{
			//create a new session var if does not exist
			 $_SESSION["stockist"] = $new_product;
		}
		//header("location: stockist.php");
		}
	?><script type="text/javascript">
window.location.reload();
</script type="text/javascript">

	
	<?
	
}

if(isset($_POST['sbb'])){

$res ="SELECT code as number FROM socode";
		$sq=mysqli_query($dbc,$res);
		$rew=mysqli_fetch_array($sq);
		$number=$rew['number']+1;
		$_SESSION['SESSION']=session_id();
		
		$user=$_SESSION['user'];
		$i ="update socode set code='$number'";
		$sqi=mysqli_query($dbc,$i);
			
foreach ($_SESSION["stockist"] as $cart_itm)
    {
	 $price= $cart_itm["price"];
	 $qty=$cart_itm["qty"];
	  $gtotal+=($qty*$price);
	}
	


		$ip=get_client_ip() ;
		$tiller=teller($ip);
		$receipt=$_SESSION['RECEIPT'];
		$total=$_POST['gTotal'];
		
		$type=$_POST['ttype'];
		 $ptype=$_POST['ptype'];
		
$ip=get_client_ip() ;
		$tiller=teller($ip);
		 $mpesav=$_POST['amountt'];
		 $ccode=$_POST['codee'];
		
		$D="SELECT * FROM sales where number='$receipt' and type='RECEIPT'";
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
		if($mpesav==$gtotal||$mpesav>$gtotal){
	foreach ($_SESSION["stockist"] as $cart_itm)
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
		if($tax>0){
$totalv=0.16*($qty*$price)/1.16;
}
	$ttv+=$totalv;
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



		$tiller=teller($ip);
		$current=maximum($id);
	$t="INSERT INTO sales (p_name, qty, total_p,number, date, time,price, p_code, p_price,vat,user,session,system,current)
VALUES ('$name', '$qty', ('$TOTAL'), '$receipt', NOW(), NOW(), '$price', '$code','$buying',round('$totalv'),'$user','$x','$system','$current')";
$st=mysqli_query($dbc,$t);
$d="UPDATE products SET sold =sold + '$qty', left_p =left_p - '$qty'
WHERE product_id = '$id'";
$t=mysqli_query($dbc,$d);
$ti="select * from products where product_id='$id'";
$tt=mysqli_query($dbc,$ti);
$tu=mysqli_fetch_array($tt);
$stock=$tu['left_p'];
$f="insert into audit(product,date,value,reason,qty,number,user,stock,session)values
('$id',NOW(),'Product Sales','$tiller','$qty','$receipt','$user','$stock','$session')";
$ff=mysqli_query($dbc,$f);
	}
	$sl=GetSALES();
$ch=$ptype;
	$cc=GetCostG();
$sss=GetStock();
$desc="Sales Transaction Code $ccode";
	SalesRecOthers($totall,$receipt,$sl,$ch,$session,$desc);
	BuysRec($buyy,$receipt,$sss,$cc,$session);
	TaxRecord(GetVat(), GetKra(),date("Y/m/d"),$ttv,$receipt,$session);
	
		$t="insert into x_report(date,till,user,amount,time,type,receipt,session,number)
		values(NOW(),'$tiller','$user','$totall',NOW(),'$type','$receipt','$x','$ccode')";
		$sql=mysqli_query($dbc,$t);
		
	
	$url="mpesa.php?c=$ccode&r=$receipt&m=$mpesav&ft=$type";
	ob_end_clean();
header("Location: $url");
}
}

if(isset($_POST['sub'])){
$res ="SELECT code as number FROM socode";
		$sq=mysqli_query($dbc,$res);
		$rew=mysqli_fetch_array($sq);
		$number=$rew['number']+1;
		$_SESSION['SESSION']=session_id();
		$_SESSION['RECEIPT']=$number;
		$user=$_SESSION['user'];
		$i ="update socode set code='$number'";
		$sqi=mysqli_query($dbc,$i);
			

	


		$ip=get_client_ip() ;
		$tiller=teller($ip);
		$rec=$_SESSION['RECEIPT'];
$total=0;
foreach ($_SESSION["stockist"] as $cart_itm)
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
	$D="SELECT * FROM sales where number='$receipt' and type='RECEIPT'";
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
	foreach ($_SESSION["stockist"] as $cart_itm)
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
	if($tax>0){
$totalv=0.16*($qty*$price)/1.16;
}
	$x=$_SESSION['SESSION'];
$y="select * from products where product_id='$id'";
	$yy=mysqli_query($dbc,$y);
	$yyy=mysqli_fetch_array($yy);
	$buying=$yyy["buying"];
$session=$x;
	$sl=GetSALES();
$ch=GetCash();
	$t="insert into ledgers(credit,receipt,account_id,froms,session,date,description)values('$TOTAL','$rec','$sl','$ch','$session',NOW(),'SALES')";
$tt=mysqli_query($dbc,$t);
//$account=GetId($id);
$t="insert into ledgers(debit,account_id,froms,receipt,session,date,description)values('$TOTAL','$ch','$sl','$rec','$session',NOW(),'SALES')";
$tt=mysqli_query($dbc,$t);

$buy=$buying*$qty;
$cc=GetCostG();
$sss=GetStock();

$t="insert into ledgers(credit,receipt,account_id,froms,session,date,description)values('$buy','$rec','$sss','$cc','$session',NOW(),'SALES')";
$tt=mysqli_query($dbc,$t);
//$account=GetId($id);
$t="insert into ledgers(debit,account_id,froms,receipt,session,date,description)values('$buy','$cc','$sss','$receipt','$session',NOW(),'SALES')";
$tt=mysqli_query($dbc,$t);
$current=maximum($id);
	$t="INSERT INTO sales (p_name, qty, total_p,number, date, time,price, p_code, p_price,vat,user,session,system,current)
VALUES ('$name', '$qty', ('$TOTAL'), '$rec', NOW(), NOW(), '$price', '$code','$buying',round('$totalv'),'$user','$x','$system','$current')";
$st=mysqli_query($dbc,$t);
$d="UPDATE products SET sold =sold + '$qty', left_p =left_p - '$qty'
WHERE product_id = '$id'";
$t=mysqli_query($dbc,$d);

$ti="select * from products where product_id='$id'";
$tt=mysqli_query($dbc,$ti);
$tu=mysqli_fetch_array($tt);
$stock=$tu['left_p'];

$f="insert into audit(product,date,value,reason,qty,number,user,stock,session)values
('$id',NOW(),'Product Sales','$tiller','$qty','$rec','$user','$stock','$session')";
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
	unset($_SESSION['stockist']);
	unset($_SESSION['RECEIPT']);
  unset($_SESSION['SESSION']);
    session_regenerate_id();
}
}

	if(isset($_POST["submit"])&&isset($_SESSION["stockist"])){


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
		$discount=$_POST['discount'];
		$D="SELECT * FROM sales where number='$receipt' and type='RECEIPT'";
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
	foreach ($_SESSION["stockist"] as $cart_itm)
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
	if($tax>0){
$totalv=0.16*($qty*$price)/1.16;
}
	$ttv+=$totalv;
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



		$tiller=teller($ip);
		$current=maximum($id);
		$user=$_SESSION['user'];
	$t="INSERT INTO sales (p_name, qty, total_p,number, date, time,price, p_code, p_price,vat,user,session,system,current)
VALUES ('$name', '$qty', ('$TOTAL'), '$receipt', NOW(), NOW(), '$price', '$code','$buying',round('$totalv'),'$user','$x','$system','$current')";
$st=mysqli_query($dbc,$t);
$d="UPDATE products SET sold =sold + '$qty', left_p =left_p - '$qty'
WHERE product_id = '$id'";
$t=mysqli_query($dbc,$d);
$ti="select * from products where product_id='$id'";
$tt=mysqli_query($dbc,$ti);
$tu=mysqli_fetch_array($tt);
$stock=$tu['left_p'];
$f="insert into audit(product,date,value,reason,qty,number,user,stock,session)values
('$id',NOW(),'Product Sales','$tiller','$qty','$receipt','$user','$stock','$session')";
$ff=mysqli_query($dbc,$f);
	}
	$sl=GetSALES();
$ch=GetCash();
	$cc=GetCostG();
$sss=GetStock();
$disc=GetDiscount();
	SalesRec($totall,$receipt,$sl,$ch,$session);
	BuysRec($buyy,$receipt,$sss,$cc,$session);
DiscRec($discount,$receipt,$ch,$disc,$session);
	TaxRecord(GetVat(), GetKra(),date("Y/m/d"),$ttv,$receipt,$session);
	
		$t="insert into x_report(date,till,user,amount,time,type,receipt,session)
		values(NOW(),'$tiller','$user','$totall',NOW(),'$type','$receipt','$x')";
		$sql=mysqli_query($dbc,$t);
		UserAudit($_SESSION['user_id'],"Sold receipt $receipt",date("Y/m/d"),$ip);
	$url="receipt.php?c=$cash&r=$receipt&ch=$change&x=$x&d=$discount";
	ob_end_clean();
header("Location: $url");
	
	}session_regenerate_id();
		unset($_SESSION['stockist']);
	unset($_SESSION['RECEIPT']);
}

			if(isset($_GET["removep"]) && isset($_SESSION["stockist"]))
{
	$product_id	= $_GET["removep"]; //get the product code to remove
	//$return_url 	= base64_decode($_GET["return_url"]); //get return url

	
	foreach ($_SESSION["stockist"] as $cart_itm) //loop through session array var
	{	if($cart_itm["product_id"]==$product_id){
	$qty=$cart_itm["qty"];
	$price=$cart_itm["price"];
	$session=session_id();
	$teller=teller($ip);
	$code=$cart_itm["code"];
	$name=mysqli_real_escape_string($dbc,$cart_itm["name"]);
		$user=$_SESSION['user'];
	$h="insert into exemptions(qty,price,user,session,code,time,date,teller,product_id,name)
	values('$qty','$price','$user','$session','$code',NOW(),NOW(),'$teller','$product_id','$name')";
	$hh=mysqli_query($dbc,$h);
	}
		if($cart_itm["product_id"]!=$product_id){ //item does,t exist in the list
			$product[] = array('name'=>$cart_itm["name"], 'system'=>$cart_itm["system"],'code'=>$cart_itm["code"], 'qty'=>$cart_itm["qty"],
			'price'=>$cart_itm["price"],'product_id'=>$cart_itm['product_id'],'vat'=>$cart_itm['vat'],'selling'=>$cart_itm['selling']);
		}
		
		//create a new product list for cart
		$_SESSION["stockist"] = $product;
	}
	//header("location: stockist.php");
	//redirect back to original page
		header("location:stockist.php");
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
<script language="JavaScript" type="text/javascript" src="stockist.js"></script>

<script language="JavaScript" type="text/javascript" src="shortcuts.js"></script>
  <script>
shortcut.add("Ctrl",function() {
window.location.href = window.location.href;
});;
 
shortcut.add("Alt",function setFocusToBox(){
document.getElementById("disc").focus();
});
shortcut.add("End",function setFocusToBox(){
document.getElementById("cash").focus();
});
shortcut.add("Tab",function setFocusToBox(){
document.getElementById("amots").focus();
});
shortcut.add("Shift",function setFocusToBox(){
document.getElementById("1").focus();
});

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
	n=Number(document.cart.disc.value);

g=Number(document.cart.grand_total.value);

c=g-n;

a=Number(document.cart.cash.value);

b=Number(document.cart.result.value);

h=a-c;

document.cart.change.value=h.toFixed(2);
document.cart.result.value=c.toFixed(2);
}


</script>

  <script type="text/javascript">
	function calculate() {
		n=Number(document.cart.disc.value);

g=Number(document.cart.grand_total.value);

h=g-n;
a=Number(document.cart.cash.value);

b=Number(document.cart.grand_total.value);

c=b-n;
v=a-c;
document.cart.result.value=c.toFixed(2);
  document.cart.change.value=v.toFixed(2);    
		
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
		 <script type="text/javascript">
            function showUsers(str)
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
                        document.getElementById("txtHints").innerHTML = xmlhttp.responseText;
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
   <fieldset style="border-color:#000000; border-width:1px; background-color:#bbbbbb;" class="fieldset-auto-width"><form id='inputform'>
        <div id="container">
           
 			 <input type="text" data-index="1" autofocus="autofocus" id="amots" placeholder=" Put Product Name Here..... "
			  size="30" onKeyUp="bleble();" autocomplete="off"/>
          
             <ul id="result"></ul>
        </div></form>
		</fieldset>
  

	
	
	</div><br>
<div align="center" style="font-family:Bell Gothic ,Verdana,Arial;"><h3><?echo $_SESSION['msg'];?></h3></div>
<table align="center" frame="BOX"  style="border-color:#000000;font-size:18px ;background-color:;" frame="BOX" border="0.2"  width="980px" 
 cellpadding="0"  >
 <tr><th style="border-color:#000000;background-color:#bbbbbb;">Product</th><th style="border-color:#000000;background-color:#bbbbbb;">Price</th><th
 style="border-color:#000000;background-color:#bbbbbb;" width="50">Quantity</th><th style="border-color:#000000;background-color:#bbbbbb;">Total</th><th
 style="border-color:#000000;background-color:#bbbbbb;">Empty</th>
 <th
 style="border-color:#000000;background-color:#bbbbbb;"></th></tr>
 <tr>
      <td><input type="hidden" name="price[]" onkeyup="calcTotals()" readonly/>
      </td><td><input type="hidden" required="required" name="quantity[]" onkeyup="calcTotals()" />
      </td><td><input type="hidden"  name="total[]" readonly/></td>
  </tr>
<?if(isset($_SESSION["stockist"]))
{
//krsort($_SESSION["stockist"]);
    $total = 0;
  $i = 0;
    foreach ($_SESSION["stockist"] as $cart_itm)
    {
	$totalp+=$cart_itm["price"]*$cart_itm["qty"];
	echo '<form method="post" action="add_s.php">';
	if($_SESSION['new']==($cart_itm["name"])){
	$t=1;
	
	}
	?>
 
  <tr><td  style="border-color:#000000;background-color:#e8e8e8;" width="500"><?echo UCWORDS($cart_itm["name"]);?></td>
      <td  style="border-color:#000000;background-color:#e8e8e8;">
	<?echo
	  "<input type='text' autocomplete='off' onkeypress='return checkIt(event)' size='2'  name='price[$i]' value=' {$cart_itm['price']}' />";?>
      </td><td   style="border-color:#000000;background-color:#e8e8e8;" ><?echo
	  "<input type='text' id='$t'  autocomplete='off' name='quantity[$i]' value=' {$cart_itm['qty']}' onfocus='javascript:this.value=\"\"' />";?>
	 
      </td><td style="border-color:#000000;background-color:#bbbbbb;">
	  <?echo number_format($cart_itm["price"]*$cart_itm["qty"]);?></td>
	  <td style="border-color:#000000;background-color:#e8e8e8;" width="5"><?echo '<a href=stockist.php?removep=' . $cart_itm["product_id"] .'>';?>
	<img src="x.png"/></a></td>
	<td width="1" style="border-color:#000000;background-color:#e8e8e8;"><input type="submit"
name="type" value="Update" style="height: 0px;background-color#4AC948;  width: 0px;
	cursor:pointer;" />
 
  
  <?
   echo '<input type="hidden" name="code" value="'.$cart_itm["product_id"].'" />
   <input type="hidden" name="number" value="'.$i.'" />';
           ?></td></tr></form><?
  	++$i;
  }}?>

  <form name="cart" id='inputform'  method="POST" action="stockist.php" style="border-color:#000000; border-width:2; font-size:17px;">
  <tr>
      <td colspan="3" align="right" style="border-color:#000000;background-color:#e8e8e8;">Grand Total</td>
      <td style="background-color:#e8e8e8;" width="130"><input type="text"  name="gTotal" value="<?echo $totalp;?>" style="border-color:#000000;background-color:#bbbbbb"; id="grand_total" readonly/></td>
  </th></tr>
    <tr>
    <td colspan="3" align="right" style="border-color:#000000;background-color:#e8e8e8;">Discount Amount</td>
      <td style="border-color:#000000;background-color:#e8e8e8;" width="130"><input  autocomplete="off" type="text" style="border-color:#000000;background-color:#e8e8e8"; value="" onkeypress="return checkIt(event)"  name="discount"   onkeyup="calculate()" id="disc" onfocus='javascript:this.value=""' /></td>
  </th></tr>
    <tr>
    <td colspan="3" align="right" style="border-color:#000000;background-color:#e8e8e8;">Less Discount</td>
      <td style="border-color:#000000;background-color:#e8e8e8;" width="130"><input  autocomplete="off" type="text"  style="border-color:#000000;background-color:#bbbbbb";  name="result"    id="result" readonly/></td>
  </th></tr>
  <tr>
    <td colspan="3" align="right" style="border-color:#000000;background-color:#e8e8e8;">Cash Amount</td>
      <td style="border-color:#000000;background-color:#e8e8e8;" width="130"><input data-index="2" autocomplete="off" type="text" style="border-color:#000000;background-color:#e8e8e8"; onkeypress="return checkIt(event)"  name="cash"  required="required" onkeyup="minus()" id="cash" onfocus='javascript:this.value=""' /></td>
  </th></tr>
  <tr>
    <td colspan="3" align="right" style="border-color:#000000;background-color:#e8e8e8;"><b>Change</th>
      <td style="border-color:#000000;background-color:#e8e8e8;" width="130"><input  type="text" size="2" style="border-color:#000000;background-color:#bbbbbb";  name="change" id="change" readonly/></td>
  </th> <th style="text-align:right;" style="border-color:#000000;background-color:#e8e8e8;" colspan="4"><input class="active" name="submit" type="submit" value="COMPLETE SALE"
	 style="height: 45px;background-color#4AC948;  width: 120px;
	cursor:pointer;"  /></th></tr>
<tr>
    </tr>
</table></form>


<?
ini_set('display_errors', '0');
OtherPayments();?>
<?//MultiPayments();?>
	

	