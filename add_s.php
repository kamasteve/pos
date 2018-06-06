<?
session_start();
require_once('mysql.php');
require_once('functions.php');
		if(isset($_POST['type'])){
		$_SESSION['msg']=' ';
$id=$_POST['code'];
$i=$_POST['number'];
 $address= $_POST['quantity'][$i];
  $price= $_POST['price'][$i];
 
 
	if(isset($_SESSION["stockist"])) //if we have the session
		{
		
			foreach ($_SESSION["stockist"] as $cart_itm) //loop through session array
			{
				if($cart_itm["product_id"] ==$id){ //the item exist in array
$cart=$address;
 $minimum=stcokist($cart_itm['product_id']);
 $maximum=maximum($cart_itm['product_id']);
if($price<$minimum){
 $naa=$cart_itm["name"];
$price=$cart_itm["price"];
$_SESSION['msg']="Sorry applicable stockist price for $naa  is $minimum";

}
if($price>$minimum && $price<=$maximum){
 $price=$price;
 $cart_itm["price"];

}
if($price>$cart_itm["price"])

{
 $naa=$cart_itm["name"];


$_SESSION['msg']="Sorry applicable maximum price for $naa  is $maximum";
$price=$maximum;
}

			
					
					$product[] = array('name'=>$cart_itm["name"],'system'=>$cart_itm["system"], 
					'code'=>$cart_itm["code"], 
					'qty'=>trim($cart), 'price'=>trim($price),'product_id'=>$cart_itm['product_id'],'vat'=>$cart_itm['vat'],
					'selling'=>$cart_itm['selling']);
		}
		else{
				
					//item doesn't exist in the list, just retrive old info and prepare array for session var
					$product[] = array('name'=>$cart_itm["name"],'system'=>$cart_itm["system"], 
					'code'=>$cart_itm["code"], 
					'qty'=>trim($cart_itm["qty"]), 'price'=>$cart_itm["price"],'product_id'=>$cart_itm['product_id'],'vat'=>$cart_itm['vat'],
					'selling'=>$cart_itm['selling']);
				}
		}
		$_SESSION["stockist"] = $product;
		}
	header("location: stockist.php");
		}