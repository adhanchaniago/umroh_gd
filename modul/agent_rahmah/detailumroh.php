<?php

session_start();
if($_SESSION['FirstName'] == '90') {header('Location: ?page=90');} ;
include_once "../library/inc.library.php";
include_once "../library/inc.pilihan.php";
include_once "../library/inc.tanggal.php";

require('../config/travel-config.php'); //Load DB(mysql) config parameter

$Travel= $_SESSION['Travel'];

// Membaca Nomor Umroh
$NomorUmroh= isset($_GET['NomorUmroh']) ?  $_GET['NomorUmroh'] : '';
$mySql  = "SELECT * FROM paket_umroh WHERE kd_umroh='$NomorUmroh'";
$myQry  = mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);
$dataUmroh  = $myData['nama_paket'];
$dataKeberangkatan = $myData['depart_umroh'];
$dataKodePaket= $myData['kd_umroh'];
$dataDescPaket= $myData['desc_umroh'];
$dataHotelMekkah= $myData['hotel_umroh_mekkah'];
$dataHotelMadinah= $myData['hotel_umroh_madinah'];
$dataPlane= $myData['pesawat_umroh'];
$dataCurrency= $myData['currency'];
$dataHargaUmroh= $myData['harga_umroh'];
$dataHargaDouble= $myData['harga_double'];
$dataHargaTriple= $myData['harga_triple'];
$dataHargaPerlengkapan= $myData['harga_perlengkapan'];
$dataKuota= $myData['kuota'];
$dataDaftar= $myData['daftar'];
$dataDayUmroh= $myData['hari_umroh'];

//arrival
    $tgl = $myData['depart_umroh'];
    $hari = $myData['hari_umroh'];
    $min = 1;
    $lw = ($hari-$min);
    $pt = explode('-', $tgl);
    $t = $pt[2];
    $b = $pt[1];
    $th = $pt[0];
    $a = GregorianToJD($b, $t, $th);
    $b = JDToGregorian($a+$lw);
    $newtgl = $b;


    $dataArrival = date('d F Y', strtotime($newtgl ));

# Kode Umroh
if($NomorUmroh=="") {
  $NomorUmroh= isset($_POST['txtNomorUmroh']) ? $_POST['txtNomorUmroh'] : '';
}

//$txtDoi = $_POST['txtDoi'];
$tgl1 =  $myData['depart_umroh'];// pendefinisian tanggal awal
$tgl2 = date('d-m-Y', strtotime('+9 day', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari


?>

<html>
<head>
	<style>
	body {padding:30px}
.print-area {border:1px solid red;padding:1em;margin:0 0 1em}

.button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
	</style>

      <br><hr>
<title>:: Data Of Package | Travel Arba Tour</title>
<script>
function printContent(el){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}
</script>

<link href="../../styles/styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<body>
<style type="text/css">
	table, th, td {
 border: 1px solid black    ;
  padding-top: 5px;
  padding-left: 5px;
  padding-right: 5px;
  padding-bottom: 5px;
  border-radius: 5px;
    font-family: 'Raleway', sans-serif;
    font-size: 11px;
  }

.table-number {

  font-family: 'Roboto', sans-serif;
}
</style>
<a type="button" 	class="button no-print" onclick="printContent('div1')">Print </a>
<div id="div1">
<table width="100%" border="1px">
<tr>
<td><strong><?php echo $dataDescPaket; ?></strong></td>
<td><strong>Quota = <?php echo $dataKuota; ?></strong></td>
<td><strong>Registered = <?php echo $dataDaftar; ?></strong></td>
</tr>
</table>

<table width="100%" cellpadding="4" cellspacing="2" class="" border="1px" >
	 <tr>
	 <td  rowspan="2" witdh="5%" bgcolor="#CCCCCC"  align="center"><strong>Packages </strong> </td>
	 <td rowspan="2" witdh="" bgcolor="#CCCCCC"  align="center"><strong>Planes Packages</strong> </td>
    <td rowspan="2" witdh="" bgcolor="#CCCCCC"  align="center"><strong>Day Umroh</strong> </td>
		<td rowspan="2" witdh="" bgcolor="#CCCCCC"  align="center"><strong>Depart</strong> </td>
		<td rowspan="2" witdh="" bgcolor="#CCCCCC"  align="center"><strong>Arrival</strong> </td>
	  <td colspan="2"  bgcolor="#CCCCCC"  align="center"><strong>Hotel</strong></td>
		<td colspan="3"  bgcolor="#CCCCCC"  align="center"><strong>Price <?php echo $dataCurrency; ?> </strong></td>
    </tr>
	<tr>
	  <td witdh="5%"  bgcolor="#CCCCCC"  align="center"><strong>Mekkah</strong></td>
	  <td witdh="5%"  bgcolor="#CCCCCC"  align="center"><strong>Madinah</strong></td>
		<td witdh="5%"  bgcolor="#CCCCCC"  align="center"><strong>Double</strong></td>
	  <td witdh="5%"  bgcolor="#CCCCCC"  align="center"><strong>Triple</strong></td>
		<td witdh="5%"  bgcolor="#CCCCCC"  align="center"><strong>Quad</strong></td>
	<tr>
	  <td><center><strong><?php echo $dataUmroh; ?></strong></center></td>
		<td><center><strong><?php echo $dataPlane; ?></strong></center></td>
		<td><center><strong><?php echo $dataDayUmroh; ?></strong></center></td>
		<td><center><strong><?php echo IndonesiaTgl($myData['depart_umroh']); ?></strong></center></td>
		<td><center><strong><?php echo $dataArrival; ?></strong></center></td>
		<td><center><strong><?php echo $dataHotelMekkah; ?></strong></center></td>
		<td><center><strong><?php echo $dataHotelMadinah; ?></strong></center></td>
     <td><center><strong><?php echo $dataHargaDouble; ?></strong></center></td>
	  <td><center><strong><?php echo $dataHargaTriple; ?></strong></center></td>
  <td><center><strong><?php echo $dataHargaUmroh; ?></strong></center></td>
    </tr>





		</table>
		<hr>

</div>
</form>
