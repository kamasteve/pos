<?php
require_once('functions.php');
$user=$_SESSION['user'];
	$level=$_SESSION['admin_level'];



							if (isset($_GET['id']))
							{
					
						
						$id = $_GET['id'];
						$result = mysql_query("SELECT * FROM tax WHERE tax_id = $id");
						
						$row = mysql_fetch_array($result);
						$id=$row["id"];
						$maximum=$row["maxi"];
						$minimum=$row["mini"];
						$rate=$row["rate"];
					
						mysql_close($con);
						}
						
						?>




<form action="edit_p.php" method="post">
<input name="m" type="hidden" value="<?php echo $id; ?>"/>
<input name="gg" type="hidden" value="<?php echo $pleft; ?>"/><br />
<b>minimum bracket:<br />
<input name="minimum" type="text" value="<?php echo $minimum; ?>" size="50"/><br />


maximum bracket:<br />
<input name="maximum" type="text" value="<?php echo $maximum; ?>" size="50" />
<br />
rate:<br />
<input name="rate" type="text" value="<?php echo $rate; ?>"size="40" /><br />
<br />



<input name="submit" type="submit" value="save">
</form>
