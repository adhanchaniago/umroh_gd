<!DOCTYPE html>

<?php
require('../config/wiwe360-config.php'); //Load DB(mysql) config parameter
?>

<?php 
$txtNama = $_POST['nama'];
$txtDeskrip = $_POST['description'];
$txtLink =$_POST['link'];

$mysql = "INSERT INTO push_notification (title,description,link) Values ('$txtNama','$txtDeskrip','$txtLink')";
$myquery = mysql_query($mysql,$Link) or die ("Failed".mysql_error());
if($myquery){
  
echo "<meta http-equiv='refresh' content='0; url=?page=SalesSendingNotification'>";
}
exit;
?>  

<?php
if(isset($_SESSION["role"])) {
  exit;
}
else {
  echo "<meta http-equiv='refresh' content='0; url=../modul/logout.php'>";
}
?>

<?php
if(isset($_SESSION["role"])) {
  exit;
}
else {
  echo "<meta http-equiv='refresh' content='0; url=../modul/logout.php'>";
}
?>

