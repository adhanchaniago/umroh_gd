

<?php 
session_start();
$Hotel = $_SESSION['Hotel'];
$country=$_GET['country'];

		
$link = mysql_connect('localhost','u4784502','3edcVFR$'); //changet the configuration in required
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db('u4784502_wiwe360');
$query="SELECT DISTINCT replace(HotelDestination, ' ','_') as id, HotelDestination as statename FROM DIMHotelRadius WHERE (Radius <= '$country')and HotelOrigin ='$Hotel' and Distance != 0  and StarRating = (select distinct StarRating from `DIMHotelRadius` where `HotelDestination` ='$Hotel') order by HotelDestination ASC";
$result=mysql_query($query);

?>
<html>
    <!-- Glazzed & Bootstrap --> 	
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/main.min.css">
	<!-- Pixeden Icon Fonts -->
	<link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
	<link rel="stylesheet" type="text/css" href="../css/pe-icon-7-stroke.css">

<select class ="form-control"  name="state" onChange="getCity('<?php echo $country ?>',this.value)" >
<option>Select Your Competitor</option>
<?php while($row=mysql_fetch_array($result)) { ?>
<option value=<?php echo $row['id']?>><?php echo $row['statename'];?></option>
<?php } ?>
</select>
</html>
