<?	ini_set('display_errors', 1);
session_start();
require_once('functions.php');
  $d=$_SESSION['admin_level'];
if($d==1){
require_once('adminn.php');}
if($d==2){
require_once('accounts.php');}
if($d==3){
require_once('backoffice.php');}?>