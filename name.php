<?
session_start();
require_once('mysql.php');
//include('functions.php');
$_SESSION['new']='';

	 if(isset($_GET["td"])){
	 $id=$_GET['td'];
	 if($id&&1){
$s="select * from products where product_id='$id'";
$sql=mysqli_query($dbc,$s);
$row=mysqli_fetch_array($sql);
$product_code=$row['code'];
$product_id=$row['product_id'];
$qty=$row['left_p'];
$nm=$row['p_name'];
if($qty>0){
	$new_product = array(array('name'=>$row['p_name'],
	'system'=>$row['system'], 'code'=>$row['code'], 'qty'=>'1', 'price'=>$row['price'],
	'product_id'=>$row['product_id'],'vat'=>$row['vat'],'selling'=>$row['buying']));
$_SESSION['new']=$row['p_name'];
	if(isset($_SESSION["products"])) //if we have the session
		{
			$found = false; //set found item to false
			
			foreach ($_SESSION["products"] as $cart_itm) //loop through session array
			{
				if($cart_itm["product_id"] == $product_id){ //the item exist in array
$cart=$cart_itm["qty"]+1;
					$product[] = array('name'=>$cart_itm["name"],'system'=>$cart_itm["system"], 
					'code'=>$cart_itm["code"], 
					'qty'=>$cart, 'price'=>$cart_itm["price"],'product_id'=>$cart_itm['product_id'],'vat'=>$cart_itm['vat'],
					'selling'=>$cart_itm['selling']);
					$found = true;
				}else{
				
					//item doesn't exist in the list, just retrive old info and prepare array for session var
					$product[] = array('name'=>$cart_itm["name"],
					'system'=>$cart_itm["system"], 'code'=>$cart_itm["code"],
					'qty'=>$cart_itm["qty"], 'price'=>$cart_itm["price"],
					'product_id'=>$cart_itm['product_id'],'vat'=>$cart_itm['vat'],'selling'=>$cart_itm['selling']);
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
		}else{
					$_SESSION['msg']='product Cannot Be Sold if Qty Less Than 1';
		}
		}
		header("location: tables.php");
	 }