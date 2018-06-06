<?php
//include('functions.php');
$con=mysqli_connect('localhost','root','','gikomba')
  or die("error connecting");
if((isset($_GET['id']))&&(is_numeric($_GET['id']))){
	$id=$_GET['id'];
	}elseif((isset($_POST['id']))&&(is_numeric($_POST['id']))){
		$id=$_POST['id'];
	}else{
		echo'<p>Page Accessed In error</p>';
		exit();
	}
	$d=mysqli_query($con,("select p_name from sales where sale_id='$id' limit 1"));
	   $row=mysqli_fetch_array($d);
	     $na=$row['p_name'];
	if(isset($_POST['submitted'])){
		$qua=mysqli_real_escape_string($con,trim($_POST['quan']));
		$price=mysqli_real_escape_string($con,trim($_POST['pric']));
		$tot=$qua*$price;
		$x=mysqli_query($con,("update sales set price='$price', qty='$qua',total_p='$tot' where sale_id='$id' limit 1"));
		$r=mysqli_query($con,("update products set left_p='$qua' where p_name='$na' limit 1"));
		if($x&&$r){
			ob_end_clean();
			header("location: sales.php");
		}else{
			echo'<p>Please Try again</p>';
		}
	}
$r=mysqli_query($con,("SELECT *,qty as  q,total_p as 
 total FROM sales WHERE DAY( date ) = DAY(CURRENT_DATE )
AND MONTH(date)=MONTH(NOW())
AND YEAR(date)=YEAR(NOW())
and status='ACTIVE' and sale_id='$id' group by sale_id order by number desc"));
$row=mysqli_fetch_array($r);
$qt=$row['qty'];
$pri=$row['price'];
echo'<form action="ed_sales.php" method="post">
<fieldest><legend>Edit Sales</legend>
<label>Quantity</label>';
echo'<input type="text" name="quan" value="'.$qt.'" required="required"/>
<label>Price</label>
<input type="text" name="pric" value="'.$pri.'" required="required"/>';
echo'<input type="hidden" name="id" value="'.$id.'">';
echo'<input type="submit" name="submit" value="Record">
<input type="hidden" name="submitted" value="True">';
echo'</fieldset></form>';
mysqli_close($con);