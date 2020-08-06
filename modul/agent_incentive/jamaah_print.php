<?php
require('../../config/travel-config.php');
include_once "../../library/inc.library.php";

if($_GET) {
	// Baca variabel URL
	$NomorJamaah= isset($_GET['NomorJamaah']) ?  $_GET['NomorJamaah'] : '';

	// Perintah membaca data Pasien
	$mySql	= "SELECT * FROM jamaah
	WHERE nomor_id='$NomorJamaah'";
	$myQry	= mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
	$myData = mysql_fetch_array($myQry);
}
else {
	echo "Nomor ID Jamaah Tidak Terbaca";
	exit;
}
?>
<html>
<head>
<b>
   <button onclick="myFunction()">Print</button>
      </b>
<title>:: Data Of CLIENT | Travel Arba Tour</title>
<script>
function myFunction() {
    window.print();
}
</script>

<link href="../../styles/styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<body>
<style type="text/css">
	table, th, td {
 border: 1px solid black    ;
  padding-top: 12px;
  padding-left: 10px;
  padding-right: 10px;
  padding-bottom: 10px;
  border-radius: 5px;
    font-family: 'Raleway', sans-serif;
  }

.table-number {

  font-family: 'Roboto', sans-serif;
}
</style>
<div id="p1">
<table width="100%">
<tr>
<td>
<img src='../../img/arba.png' height='80' border='0' title='' />
</td>
<td>
<h2 align="center"> DATA OF CLIENT  </h2>
</td>
<td>
<h4 align="center"> ARBA TOUR TRAVEL  </h4>
</td>
</tr>
</table>

<table width="100%" cellpadding="4" cellspacing="2" class="">
	 <tr>
      <td bgcolor="#CCCCCC"><strong>JAMAAH</strong> </td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td> 																										<td bgcolor="#CCCCCC"><strong>PASSPORT</strong> </td> <td>&nbsp;</td> <td>&nbsp;</td>
    </tr>
	<tr>
	  <td width="15%"><strong>Nomor IP </strong></td>
	  <td width="1%"><strong>:</strong></td>
	  <td width="30%"><?php echo $myData['nomor_id']; ?></td>
	  <td width="15%"><b>Passport Number</b></td> <td width="1%"><strong>:</strong></td>  <td width="40%"><?php echo $myData['no_pass']; ?></td>
	</tr>
	<tr>
      <td><strong>Costumer Name </strong></td>
	  <td><strong>:</strong></td>
	  <td><?php echo $myData['first_name']; ?> <?php echo $myData['last_name']; ?> <?php echo $myData['surname']; ?> </td>       <td><b>Passport Place Of Issue</b></td> <td width="1%"><strong>:</strong></td>
	  <td><?php echo $myData['poi']; ?></td>
    </tr>
	<tr>
      <td><b>Room</b></td>
	  <td><b>:</b></td>
	  <td><?php echo $myData['room']; ?></td>
	  <td><b>Passport Date Of Issue</b></td> <td><strong>:</strong></td>
	  <td><?php echo $myData['doi']; ?></td>
    </tr>
	<tr>
      <td><b>Gender </b></td>
	  <td><b>:</b></td>
	  <td><?php echo $myData['gender']; ?></td>
	  <td><b>Passport Exipred Of Issue</b></td> <td><strong>:</strong></td>
	  <td><?php echo $myData['expired']; ?></td>																 </tr>
	<tr>
	  <td bgcolor="#CCCCCC">&nbsp;</td>
	  <td bgcolor="#CCCCCC">&nbsp;</td> <td bgcolor="#CCCCCC">&nbsp;</td>
	  <td bgcolor="#CCCCCC">&nbsp;</td> <td bgcolor="#CCCCCC">&nbsp;</td>
	  <td bgcolor="#CCCCCC">&nbsp;</td>
    </tr>

    <tr>
	  <td bgcolor="#CCCCCC"><strong> RELATION</strong> </td>
	  <td>&nbsp;</td> <td>&nbsp;</td>
	  <td bgcolor="#CCCCCC"><strong>PACKAGES DATA</strong> </td>  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
	<tr>
      <td><strong>Place, Date of birth </strong></td>
	  <td><strong>:</strong></td>
	  <td><?php echo $myData['place_of_birth'];  ?>,
	  	  <?php echo IndonesiaTgl($myData['birthdate']); ?></td>
	  	   <td><strong>Depart </strong></td> <td><strong>:</strong></td>
	   <td><?php echo $myData['depart']; ?></td>
    </tr>
	<tr>
      <td><strong>Address </strong></td>
	  <td><strong>:</strong></td>
	  <td><?php echo $myData['alamat']; ?></td>
	 <td><strong>Arrival </strong></td> <td><strong>:</strong></td>
	   <td><?php echo $myData['arrival']; ?></td>
	</tr>
	<tr>
      <td><strong>Phone </strong></td>
	  <td><strong>:</strong></td>
	  <td><?php echo $myData['phone']; ?></td>
	   <td><strong>Packages </strong></td> <td><strong>:</strong></td>
	   <td><?php echo $myData['packages_program']; ?></td>
    </tr>

    <tr>
      <td><b>Email</b></td>
	  <td><b>:</b></td>
	  <td><?php echo $myData['email']; ?></td>
	  <td bgcolor="#CCCCCC"><strong>DATA MAHROM</strong> </td>
	  <td>&nbsp;</td> <td>&nbsp;</td>
    </tr>
	<tr>
      <td><b>Marriage Status </b></td>
	  <td><b>:</b></td>
	  <td><?php echo $myData['status_jamaah']; ?></td>
		 <td>mahrom Name</td> <td>:</td>
	   <td><?php echo $myData['mahrom']; ?></td>
    </tr>
	<tr>
         <td><strong>Family Name </strong></td> <td><strong>:</strong></td>
	  <td><?php echo $myData['family_name']; ?></td>
	  	   <td>Mahrom Status </td> <td>:</td>
	   <td><?php echo $myData['mahrom_status']; ?></td>
    </tr>
   <tr>
      <td><strong>Family Contact </strong></td> <td><strong>:</strong></td>
	  <td><?php echo $myData['family_contact']; ?></td>
		<td bgcolor="#CCCCCC"><strong> Agent</strong> </td> <td>:</td>
	   <td><?php echo $myData['travel']; ?> (<?php echo $myData['petugas']; ?>)</td>
    </tr>




</table>
</div>
</form>
