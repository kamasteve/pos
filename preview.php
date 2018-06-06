<?
require_once('functions.php');
require_once('print.php');

 $id=$_GET['id'];
 $idd=$_GET['idd'];
$s="select * ,stocking.price as p from stocking
inner join  products on products.product_id=stocking.product_id
 where t_code='$idd'
 and supplier='$id'
GROUP BY id";
$sql=mysqli_query($dbc,$s);



?>
<a href="javascript:void(processPrint());"><input type="image" value=<img src="print.png"/></a>
<div id="printMe">
<div align="center"><h3>INVOICE NO <?echo $idd;?> DETAILS</div>


<table width="700" align="center" cellpadding="0" cellspacing="0" style="font-size:14px; border-color:#000000; background-color:#ffffff; border-style:solid; border-width:1px;">
  <tr>
   
    <td width="200" style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center"><strong>Product</strong></div></td>
    <td width="44" style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center"><strong>Qty</strong></div></td>
        <td width="94" style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center"><strong>Price </strong></div></td>
  <td width="94" style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center"><strong>Total</strong></div></td>
   
  </tr>
  <?
  require_once('mysql.php');


while($row = mysqli_fetch_array($sql))
{
  echo '<tr>';

  
    echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.$row['p_name'].'</div></td>';
  echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.$row['qty'].'</div></td>';
    echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.number_format($row['p'],2).'</div></td>';
	 echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.number_format($row['total_p'],2).'</div></td>';

$total+=$row['total_p'];
	
	  echo '</tr>';
 }
   echo '<tr>';

  
    echo '<td colspan="3" style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left"><b>TOTAL</div></td>
	<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left"><b>'.number_format($total).'</div></td>';
 echo '</table>';
 
 ?>


<div align="center"><i>PACEMART JUICES & CANDIES<br
/></div></div></div></div></div>