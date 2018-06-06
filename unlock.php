<?
REQUIRE_ONCE('functions.php');
$user=$_SESSION['user_name'];
REQUIRE_ONCE('mysql.php');

$ip=get_client_ip();
$tiller=teller($ip);

		
 if ( (isset($_GET['id'])) &&
 (($_GET['id'])) ) {
$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) &&
 (($_POST['id'])) ) {
$id = $_POST['id'];
}
if($id){
$r="select * from hold where till='$tiller'and user='$user' and session='$id' and status='ACTIVE'";
$sql=mysqli_query($dbc,$r);
$n=mysqli_num_rows($sql);
if($n>0){
$t="select * from hold where session='$id'";
$tt=mysqli_query($dbc,$t);
while($row=mysqli_fetch_array($tt)){
$product[] = array('name'=>$row["product"], 'system'=>$row["system"],
					'code'=>$row["code"], 'qty'=>$row['qty'], 'price'=>$row["price"],'product_id'=>$row['product_id'],'vat'=>$row['vat']);

}
$y="delete from hold where session='$id'";
$yy=mysqli_query($dbc,$y);
$_SESSION["products"] = $product;
}

}

header("location: tables.php");
?>