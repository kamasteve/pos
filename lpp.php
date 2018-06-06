<?php ini_set('display_errors', 0);

	//require_once('session.php');
		require_once('mysql.php');
		//require_once('date.js');
			//require_once('menu.php');
			$user=$_SESSION['user_name'];
	$level=$_SESSION['admin_level'];
	ini_set('display_errors', 0);


?>

<? require_once('functions.php');?>
<link rel="stylesheet" href="menu.css" media="screen">
     <link rel="stylesheet" href="style.responsive.css" media="all">
 <script src="jquery.js"></script>
        <script src="script.js"></script>
        <script src="script.responsive.js"></script>
 <nav class="art-nav clearfix">
             <?php headermenu($_SESSION['department'],'BACK OFFICE'); ?> 
            </nav>
<!DOCTYPE html>
<html dir="ltr" lang="en-US"><head><!-- Created by Artisteer v4.0.0.58475 -->
        <meta charset="utf-8">
        <title>Create Lpo</title>
        <!--<meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">-->
        <meta name="HandheldFriendly" content="True"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
        <meta name="HandheldFriendly" content="true" />
        <meta name="MobileOptimized" content="true" />

        <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
      
        <!--[if lte IE 7]><link rel="stylesheet" href="style.ie7.css" media="screen" /><![endif]-->
        <link rel="stylesheet" href="style.responsive.css" media="all">


        <script src="jquery.js"></script>
        <script src="script.js"></script>
    
        <meta name="description" content="NEURO DATA">
        <meta name="keywords" content="EZ-SACCO">
<link rel="stylesheet" type="text/css" href="tcal.css" />
<link rel="stylesheet" type="text/css" href="datepicker.css" />
<script type="text/javascript" src="tcal.js"></script> 
<title></title>
<script language="JavaScript" type="text/javascript" src="datepicker.js"></script>
<script language="JavaScript" type="text/javascript" src="suppliers.js"></script>
<script language="JavaScript" type="text/javascript" src="stockin.js"></script>
<style type="text/css">
    .fieldset-auto-width {
         display: inline-block;
    }
</style>
<style type="text/css">
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
</style>

<script type="text/javascript">
    function ShowTime()
    {
      var time=new Date()
      var h=time.getHours()
      var m=time.getMinutes()
      var s=time.getSeconds()
      // add a zero in front of numbers<10
      m=checkTime(m)
      s=checkTime(s)
      document.getElementById('txt').value=h+" : "+m+" : "+s
      t=setTimeout('ShowTime()',1000)

    }
    function checkTime(i)
    {
      if (i<10)
      {
        i="0" + i
      }
      return i
    }
    </script>
	
<script language="javascript" type="text/javascript">

function multiply(){

a=Number(document.abc.QTY.value);

b=Number(document.abc.PPRICE.value);
h=Number(document.abc.DISC.value);
g=Number(document.abc.TAX.value);
f=Number(document.abc.TOTAL.value);
q=Number(document.abc.DISCOUNT.value);

c=a*b;
e=c*h/100;
d=g/100*(a*b);
n=a*b;
z=a*b-q;
k=z*g/100;
p=a*b*h/100;
m=n-p;
l=n-k;

document.abc.TOTAL.value=l;
document.abc.VAT.value=k;
document.abc.DISCOUNT.value=p;
document.abc.TOTALL.value=m;
}
function tax(){

a=Number(document.abc.TAX.value);

b=Number(document.abc.TOTAL.value);


c=a/100*b;

h=b+c;

document.abc.VAT.value=c;
document.abc.TOTALL.value=h;
}
function total(){



b=Number(document.abc.PPRICE.value);

c=Number(document.abc.QTY.value);


e=b*c;

document.abc.TOTALL.value=e.toFixed(2);


}

function minus(){

a=Number(document.sumary.totala.value);

b=Number(document.sumary.aba.value);


c=a*b;
d=a+c;
f=d;

document.sumary.less.value=c.toFixed(2);
document.sumary.vatableless.value=f.toFixed(2);
document.sumary.totalamountdue.value=d.toFixed(2);
}


</script>


</script>


<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "This field accepts numbers only."
        return false
    }
    status = ""
    return true
}
</SCRIPT>
 <link rel="stylesheet" href="s.css" media="screen">
 <div id="art-main">
          
           



<link rel="stylesheet" href="css.css" type="text/css" media="screen" />
<link href="h.css" rel="StyleSheet" type="text/css">
<style type="text/css">
<!--
.style1 {font-size: 36px}
-->
  </style>
</head>

<body onLoad="ShowTime()">

<?php

function formatMoney($number, $fractional=false) {
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
}	


?>
<form action="add_lpo.php" method="post" name="abc"><div class="wraper">
<fieldset class="fieldset-auto-width" style="border-color:#000000; border-width:4px; background-color:#e8e8e8;">

					<legend>Stock Details</legend>

  <div class="top">
    <div class="topleft">
     
      <input type="text" id="amot" name="amot" size="30" placeholder="Type Expense Name Hint Here..... " onKeyUp="bleble();" autocomplete="off"/>
<div id="layer2" style="margin-right:-30px;"></div>

 
	
	
	</div>
    <div class="topright">
						<?php
						/*$q=20;
						$s=86400;
						$r=$q*$s;*/
						$timestamp=time(); //current timestamp
						/*$tm=$timestamp+$r; // Will add 2 days to the $timestamp*/
						$da=date("m/d/Y", $timestamp);
						/*
						echo "Current time string: $da <br>";
						$da1=date("F j, Y", $tm);
						echo "Modified time: $da1 <br>";*/
						?>
						




						<?php
							if (isset($_GET['id']))
							{
						$con = mysql_connect('localhost','mulken',"muwake");
						if (!$con)
						  {
						  die('Could not connect: ' . mysql_error());
						  }
						
						mysql_select_db("point_of_sale", $con);
						
						$p_id = $_GET['id'];
						$result = mysql_query("SELECT * FROM products WHERE product_id = $p_id");
						
						$row = mysql_fetch_array($result);
						$name=$row["p_name"];
						
						mysql_close($con);
						}
						
						?>
						
						
						
						
						
						
						
						
						
						<table id="header" width="871" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="347"><div align="right"><b>Stock : </div></td>
    <td colspan="3"><input name="PNAME" type="text" value="<?php echo $name ?>" size="70"  readonly/>
	<input name="id" type="hidden" value="<?php echo $p_id ?>"  /></td>
 
	
	 <td><div align="right"> </div></td>
    <td width="184"><input name="DISC" id="DISC" type="text" value="" onkeyup="total()"  size="20"
	style="border:0px;" />
	     
	</td>
    <td width="124" rowspan="3"><input name="submit" type="submit" 
	value="ADD TO CART" style="height: 84px; width: 110px; cursor:pointer;" id="xx" /><input name="product_id" type="hidden" value="<?php echo $id ?>" readonly/><input name="PCODES" type="hidden" value="<?php echo $CODE ?>" readonly/></td>
  </tr>
    <tr>
    <td><div align="right"><b>QTY : </div></td>
    <td><input name="QTYY" type="text" value="" /></td>
    
  
	
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="right"><b>Lpo Number : </div></td>
    <td><input name="CODE" type="text" id="CODE" value="<?php echo $_SESSION['SEMBER']; ?>" /></td>
    
  
	
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
      
    

       
  </tr>
  <tr>
     
      

    
  </tr>

</table>
	
	
	
	
	
  
  </fieldset>

  
  
  
  
  
  
  
  
  <fieldset style="border-width: 3px;">

					<legend>Lpo List</legend>
  <div class="center">
    <table width="100%" border="1" cellspacing="0" cellpadding="0" style="border-color:#000000;background-color:#cc8022;border-width:thin;">
      <tr>
       
        <td width="35%"><div align="center"><strong>DESCRIPTION</strong></div></td>
		<td width="10%"><div align="center"><strong>QUANTITY </strong></div></td>
	

		<td width="5%">CANCEL</td>

      </tr>
	  <?php
$con = mysql_connect("localhost","mulken","muwake");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("point_of_sale", $con);
$f=$_SESSION['SEMBER'];
$result = mysql_query("SELECT * FROM lpo where invoice= '$f'");

while($row = mysql_fetch_array($result))
  {
      echo '<tr>';
       
		echo '<td><div align="left">&nbsp;&nbsp;'.$row['name'].'</div></td>';

	
	$tax+=$row['vat'];
	$total+=$row['amount'];
        echo '<td><div align="right">';
		$we=$row['qty'];
		echo formatMoney($we, true);
		echo '&nbsp;&nbsp;</div></td>';
		

   
	
	
		
			
        echo '<td>';
		echo '<a href=delete_lpo.php?id=' . $row["id"] .'>Remove</a>';
		echo '</td>';
      echo '</tr>';
	  
	  }
	

mysql_close($con);
?>
    </table>
	</form><br><br>
	<fieldset class="fieldset-auto-width" style="border-color:#000000; border-width:4px; background-color:#e8e8e8;">
	   <form action="print_lpo.php" method="post">
	   	<table id="header" width="550" border="0" cellpadding="0" cellspacing="0">


  <tr>
  	   <td colspan="3"><input name="submit" type="submit" value="PRINT LPO">
	</table></fieldset>
    <br />
	
	<div align="right">
	
	
	


	


	

</body>
</html>
<table width="100%" height="-5%" cellspacing="0" border="0">
<TR height="100"><TD><?php require_once("footer.php"); ?></TD></TR>
