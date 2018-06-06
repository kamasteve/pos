<?require_once('functions.php');
$type='SALES';

Permission($_SESSION['department'],$type);
$_SESSION['HOLD']=session_id();
$user=$_SESSION['user_name'];
require_once('mysql.php');

if(isset($_SESSION["products"])){
$ip=get_client_ip() ;
$tiller=teller($ip);
$session=$_SESSION['HOLD'];
	foreach ($_SESSION["products"] as $cart_itm)
    {
	 $price= $cart_itm["price"];
	$name=$cart_itm["name"];
	$code=$cart_itm["code"];
	$system=$cart_itm["system"];
	$qty=$cart_itm["qty"];
	$vat=$cart_itm["vat"];
	$product_id=$cart_itm["product_id"];
	$r="insert into hold(product_id,product,price,qty,vat,session,time,date,till,user,code,system)
	values('$product_id','$name','$price','$qty','$vat','$session',NOW(),NOW(),'$tiller','$user','$code','$system')";
	$Sql=mysqli_query($dbc,$r);
	
	
	}
		unset($_SESSION['products']);

  unset($_SESSION['HOLD']);
    session_regenerate_id();

}


header("location: tables.php");