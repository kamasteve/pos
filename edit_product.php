<?php
require_once('functions.php');
$user=$_SESSION['user'];
	$level=$_SESSION['admin_level'];



							if (isset($_GET['id']))
							{
						$con = mysql_connect('localhost','root',"");
						if (!$con)
						  {
						  die('Could not connect: ' . mysql_error());
						  }
						
						mysql_select_db("point_of_sale", $con);
						
						$id = $_GET['id'];
						$result = mysql_query("SELECT * FROM products WHERE product_id = $id");
						
						$row = mysql_fetch_array($result);
						$id=$row["product_id"];
						$pcode=$row["code"];
						$pname=$row["p_name"];
						$pdesc=$row["description"];
						$pleft=$row["left_p"];
						$vat=$row["vat"];
							$cat=$row["category"];
								$minimum=$row["minimum"];
						$pprice=$row["price"];
							$buying=$row["buying"];
							$comp=$row["company"];
						$re=$row["reorder"];
						mysql_close($con);
						}
						
						?>




<form action="edit.php" method="post">
<input name="m" type="hidden" value="<?php echo $id; ?>"/>
<input name="gg" type="hidden" value="<?php echo $pleft; ?>"/><br />
<b>Product name:<br />
<input name="p" type="text" value="<?php echo $pname; ?>" size="50"/><br />
<b>Barcode:<br />
<input name="bar" type="text" value="<?php echo $pcode; ?>" size="50"/><br />

category:<br />
<input name="cat" type="text" value="<?php echo $cat; ?>" size="50" />
<br />
Buying price:<br />
<input name="buying" type="text" value="<?php echo $buying; ?>"size="40" /><br />
<br />

Retail selling price:<br />
<input name="ee" type="text" value="<?php echo $pprice; ?>"size="40" /><br />


Wholesale selling price:<br />
<input name="minimum" type="text" value="<?php echo $minimum; ?>"size="40" /><br />

vat:<br />
<input name="vat" type="text" value="<?php echo $vat; ?>"size="40" /><br />
Re-Order Level:<br />
<input name="f" type="text" value="<?php echo $re; ?>" size="40"/><br />
Reason:<br />
<input name="x" type="text" value="" size="50"/><br />
<input name="submit" type="submit" value="save">
</form>
