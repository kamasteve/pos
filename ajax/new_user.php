<?php
include_once('../config.php');
    $NAME = $_REQUEST['E_NAME'];
	$DESCRIPTION = $_REQUEST['E_NAME'];
	$CATEGORY = $_REQUEST['CATEGORY'];
	$B_PRICE = $_REQUEST['b_price'];
	$R_PRICE = $_REQUEST['r_price'];
	$W_PRICE = $_REQUEST['w_price'];
	$R_LEVEL = $_REQUEST['r_level'];
	$B_CODE = $_REQUEST['b_code'];
	$VAT = $_REQUEST['vat'];
	//$USERNAME = $_REQUEST['USER_NAME'];
	//$ADDEB_BY = $_REQUEST['ADDEB_BY'];
	//$OTP= '1234';
	$image = $_FILES['image']['name'];
	$file_basename = substr($image, 0, strripos($image, '.')); // get file extention
$file_ext = substr($image, strripos($image, '.'));
	//$ADDEB_BY = $_REQUEST['ADDEB_BY'];
	//$OTP= '1234';
	
	if ($_FILES["image"]["error"] > 0)
  {
  echo "Error: " . $_FILES["image"]["error"] . "<br>";
  }
else
  {
  move_uploaded_file($_FILES["image"]["tmp_name"],
      "uploads/" . $_FILES["image"]["name"]);
  }

	
$add_unit ="INSERT into products(p_name,description,code,category,price,reorder,buying,vat,minimum,image_name,image_ext,sold,left_p,system,company,factor) VALUES('$NAME','$DESCRIPTION','$B_CODE','$CATEGORY','$R_PRICE','$R_LEVEL','$B_PRICE','$VAT','$W_PRICE','$file_basename','$file_ext','0','0','0','0','0')";
 $result_addunits = mysqli_query($mysqli, $add_unit);

            if (!$result_addunits) {
             print "Error: " . $add_unit . "<br>" . mysqli_error($mysqli);
			}
			else{
			echo "Product Added Successfully";

}
?>