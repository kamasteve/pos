<? require_once('menu.php');

require_once('header.php');
require_once('print.php');
?>
<?
require_once('mysql.php');
$date1=$_POST['date1'];
$date2=$_POST['date2'];
$r="SELECT * from return_in where date between '$date1' and '$date2'";
$sql=mysqli_query($dbc,$r);

?>
<a href="javascript:void(processPrint());"><input type="image" value=<img src="print.png"/></a>
<div id="printMe">
<div align="center"><b>Issued Credit Notes For Period :</b><strong> <?php echo $_POST['date1']; ?></strong>&nbsp;&nbsp;To:<strong> <?php echo $_POST['date2']; ?>
<br />
    </strong></div>
<table width="700" align="center" cellpadding="0" cellspacing="0" style="font-size:16px; border-color:#000000;background-color:#ffffff; border-style:solid; border-width:1px;">
  <tr>
     <td width="97" style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center"><strong>Credit Note</strong></div></td>
    <td width="100" style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center"><strong>Product Code</strong></div></td>
    <td width="274" style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center"><strong>Product </strong></div></td>
   <td width="127" style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center"><strong>Qty</strong></div></td>
    <td width="77" style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center"><strong>Price</strong></div></td>
	
 

	
	<td width="127" style="border-color:#000000; border-style:solid; border-width:1px;"><div align="center"><strong>Status</strong></div></td>
  </tr>
  <?
  
  while($row = mysqli_fetch_array($sql))
{
  echo '<tr>'; echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.$row['credit'].'</div></td>';
    echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.$row['code'].'</div></td>';
  
	    echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.$row['product'].'</div></td>';	
    echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.$row['qty'].'</div></td>';	
    


   echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.number_format($row['total_p']).'</div></td>';	
	
	echo '</div></td>';
	   echo '<td style="border-color:#000000; border-style:solid; border-width:1px;"><div align="left">'.($row['status']).'</div></td>';	
	
	echo '</div></td>';

 $to+=$row['total_p'];   
  echo '</tr>';
 }

?>   <tr>
    <td colspan="5" style="border-color:#000000; border-style:solid; border-width:1px;"><div align="right"><strong> Total Value For Credit Notes</strong></div></td>
    <td width="127" style="border-color:#000000; border-style:solid; border-width:1px;">
	
	  <div align="center">
	  <?
	  
{

    
	echo number_format($to, true);
 }

	  ?>
	  </tr>
 </div>
	<table width="100%" height="120%" cellspacing="0" border="0">
<TR height="100"><TD><?php require_once("footer.php"); ?></TD></TR>