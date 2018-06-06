<?
//require_once('menu.php');
require_once('functions.php');
require_once('print.php');
$type='BACK OFFICE';

Permission($_SESSION['department'],$type);
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US"><head><!-- Created by Artisteer v4.0.0.58475 -->
        <meta charset="utf-8">
        <title>Physical Count </title>
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
<?
if(isset($_POST['submitted'])){

$session=session_id();
$user=$_SESSION['user_name'];;
$size = count($_POST['id']);

$i = 0;
while ($i < $size)
	{ 	$stock = $_POST['stock'][$i];
	$manual= $_POST['stock'][$i];
	$actual= $_POST['actual'][$i];
	$code= $_POST['id'][$i];
	$name= mysqli_real_escape_string($dbc,$_POST['name'][$i]);
	$diff=$actual-$manual;


$r="insert into stock_balances(product_id,session,system,manual,date,user)
values('$code','$session','$actual','$manual',NOW(),'$user')";

	$sql=mysqli_query($dbc,$r);
	++$i;
	 session_regenerate_id();
	ob_end_clean();
		 header("Location:physical.php?session=$session");		
	}

}

if(isset($_POST['submit'])){
$edittable=$_POST['selector'];
$N = count($edittable);

?>


<a href="javascript:void(processPrint());"><input type="image" value=<img src="print.png"/></a>
<div id="printMe">
 <table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="680" align="center" 
 cellpadding="2" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">   
<tr><th>Product</td><th>Physical Count</td></tr>
<?

for($i=0; $i < $N; $i++){
$r="select * from products where product_id='$edittable[$i]'";
$sql=mysqli_query($dbc,$r);
$row=mysqli_fetch_array($sql);
$name=$row['description'];
$price=$row['price'];
$point_of_sale=$row['system'];
echo ' 
<tr><td style="font-size: 14px">'.strtoupper($name).'</td><td style="font-size: 14px">&nbsp;</td></tr>
';
	}
	echo '</table>';
	}else{
	$edittable=$_POST['selector'];
$N = count($edittable);
	?>
	<form  action="generate_sheet.php" method="post"><br><br><div align="center"><h3>RECORD PHYSICAL COUNT</h3></div>
	<table class="blue" border="1" style="background-color:#ffffff"
        frame="BOX" width="680" align="center" 
 cellpadding="0" cellspacing="0" style="font-family:Bell Gothic,Verdana,Arial">   
<tr><td style="font-size: 18px">Product</td><td style="font-size: 18px">Physical Count</td></tr>
<?
for($i=0; $i < $N; $i++){
$r="select * from products where product_id='$edittable[$i]'";
$sql=mysqli_query($dbc,$r);
$row=mysqli_fetch_array($sql);
$name=$row['description'];
$price=$row['price'];
$point_of_sale=$row['system'];
echo ' 
<tr><td style="font-size: 14px">'.strtoupper($name).'</td>
';
	echo "<td><input type='number'     name='stock[$i]'  autocomplete='off' required='required'  value='' required='required' />
<input type='hidden' name='id[$i]' value='{$row['product_id']}' /></td>
<input type='hidden' name='actual[$i]' value='{$row['left_p']}' /></tr>";
	}
	?>
	<tr><td></td><td><input  type="submit" value="Submit" name="submitted" style="height: 34px; width: 100px;" name="submitted" id="submit" class="submit" />
					 <input type="hidden" name="submitted"
value="TRUE" />
		</tr></table>
		  </form>
	
	<?
	}