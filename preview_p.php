<?
require_once('mysql.php');


 if ( (isset($_GET['id'])) &&
 (($_GET['id'])) ) {
$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) &&
 (($_POST['id'])) ) {
$id = $_POST['id'];
}
$s="select * from hold where session='$id'
GROUP BY id";
$sql=mysqli_query($dbc,$s);



?>



<table width="700" align="center" cellpadding="0" cellspacing="0" style="font-size:14px; border-color:#000000; background-color:#ffffff; border-style:solid; border-width:1px;">
  <tr>
   
    <td width="200" style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center"><strong>Product</strong></div></td>
    <td width="44" style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center"><strong>Qty</strong></div></td>
        <td width="94" style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center"><strong>Price </strong></div></td>

   
  </tr>
  <?
  require_once('mysql.php');


while($row = mysqli_fetch_array($sql))
{
  echo '<tr>';

  
    echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.$row['product'].'</div></td>';
  echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.$row['qty'].'</div></td>';
    echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.number_format($row['price'],2).'</div></td>';

$total+=$row['price']*$row['qty'];
	
	  echo '</tr>';
 }
   echo '<tr>';

  
    echo '<td colspan="2" style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left"><b>TOTAL</div></td>
	<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left"><b>'.number_format($total).'</div></td>';
 echo '</table>';
 
 ?>


<div align="center"><i>PACEMART JUICES & CANDIES<br
/></div></div></div></div></div>