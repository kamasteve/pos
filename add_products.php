<?php
require_once('functions.php');?>

<!--===========================================================================================================================-->
<script language="javascript" type="text/javascript">

function multiply(){

a=Number(document.abc.BUYING.value);

b=Number(document.abc.MARGIN.value);
i=Number(document.abc.QTY.value);
f=Number(document.abc.TOTAL.value);



h=f/i;
e=h/100*b;
c=e+h;

document.abc.SELLING.value=c.toFixed(0);

document.abc.BUYING.value=h.toFixed(2);




	


}
</script>
<fieldset><legend><b>Add New Product</b></legend>
<form action="save_product.php" method="post" name="abc">

name:<br />
<input name="b" required="required" type="text" SIZE="40" /><br />




<?

$result=@mysql_query("SELECT *
FROM categories");
print"<b>Category:</br>";

print"<select name=\"category\" required='required'>";
print "<option></option>";
while ($row=mysql_fetch_assoc($result)){
$id=$row['id'];
$name=$row['name'];
print"<option value=$id>$name\n";
}
print"</select>\n";
print"</p>\n";
?>
</td></tr>


buying price:<br />
<input name="e" required="required" id="BUYING" onkeyup="multiply()"  type="text" /><br />

selling price:<br />
<input name="SELLING" required="required" id="SELLING"   type="text" /><br />
Re-order level:<br />
<input name="reorder" required="required"    type="text" /><br />
vat:<br />
<input required="required" name="v" type="text" /><br />
<input name="submit" type="submit" value="save">
</form></fieldset>
