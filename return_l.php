
<?
require_once('functions.php');


if(isset($_POST['submit'])){
$s="select * from ccode";
$sql=mysqli_query($dbc,$s);
$row=mysqli_fetch_array($sql);
$code=$row['code'];
$_SESSION['OUT']=$code;
$_SESSION['SESS']=$_POST['receipt'];
$_SESSION['supplier']=$_POST['id'];
ob_end_clean();

header("location: return_out.php");


}
$type='BACK OFFICE';

Permission($_SESSION['department'],$type);
	
	 ?>
	 
	 <!DOCTYPE html>
<html dir="ltr" lang="en-US"><head><!-- Created by Artisteer v4.0.0.58475 -->
        <meta charset="utf-8">
        <title>Debit Note</title>
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
                <?php headermenu($_SESSION['department'],'BACK OFFICE');

$r=mysql_query("select * from accounts
inner join group_accounts on group_accounts.account_id=accounts.id
where group_id='2'");				?> 
            </nav>
	 
	 <style>
input[type='text'] { font-size: 20px; }
</style>
	 <style type="text/css">
    .fieldset-auto-width {
         display: inline-block;
    }
</style><div align="center"><fieldset class="fieldset-auto-width">
<form action="return_l.php" method="post">
<H3>INVOICE NO:</H3><br />
<input name="receipt"  REQUIRED="REQUIRED" value="" size="50"/>

<br />
<?
echo '<label>Supplier</label>
                                                                     <select name="id" required title="Client type">
                                                       
                                                            <option></option>
                                                    ';

				while ($row = mysql_fetch_array($r))
				{
								$id = $row['account_id'];
								$name = $row['name'];
								echo "<option value=$id>$name</option>";
				}
				echo '</select><br>';


?>



<input name="submit" type="submit" value="GET">
</form>
<div\>
