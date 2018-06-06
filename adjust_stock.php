<?ob_start();
require_once('mysql.php');
session_start();
 //session_regenerate_id();
$session=session_id();
$user=$_SESSION['user_name'];;
$size = count($_POST['id']);
$cat=mysqli_real_escape_string($dbc,$_POST['cat']);
$i = 0;
while ($i < $size)
	{ 	$stock = $_POST['stock'][$i];
	$manual= $_POST['stock'][$i];
	$actual= $_POST['actual'][$i];
	$code= $_POST['code'][$i];
	$name= mysqli_real_escape_string($dbc,$_POST['name'][$i]);
	$diff=$actual-$manual;
$r="insert into stock_balances(name,code,session,system,manual,diff,date,time,user,category)
values('$name','$code','$session','$actual','$manual','$diff',NOW(),NOW(),'$user','$cat')";



	$sql=mysqli_query($dbc,$r);
	++$i;
	 session_regenerate_id();
	ob_end_clean();
		 header("Location:physical.php?id=$session&c=$cat");		
	}
	

	
	?>