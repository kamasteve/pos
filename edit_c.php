<?php
require_once('functions.php');
require_once('conf.php');



							if (isset($_GET['id']))
							{
					
						
						$id = $_GET['id'];
						$result = mysql_query("SELECT * FROM accounts WHERE id = '$id'");
						
						$row = mysql_fetch_array($result);
						$id=$row["id"];
						$name=$row["name"];
						$phone=$row["phone"];
						$rate=$row["descc"];
					
						mysql_close($con);
						}
						
						?>




<form action="edit_cc.php" method="post">
<input name="id" type="hidden" value="<?php echo $id; ?>"/>

<b>Customer Name:<br />
<input name="name" type="text" value="<?php echo $name; ?>" size="50" required="required"/><br />


Customer Phone:<br />
<input name="phone" type="text" value="<?php echo $phone; ?>" size="50" required="required" />
<br />
Credit Limit:<br />
<input name="limit" type="text" value="<?php echo $rate; ?>"size="40"  required="required"/><br />
<br />



<input name="submit" type="submit" value="save">
</form>
