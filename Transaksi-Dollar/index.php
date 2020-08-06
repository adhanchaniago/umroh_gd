<?php
session_start();
if($_SESSION['FirstName'] == '90') {header('Location: ?page=90');} ;
include_once "../library/inc.library.php";
include_once "../library/inc.pilihan.php";
include_once "../library/inc.tanggal.php";

require('../config/travel-config.php'); //Load DB(mysql) config parameter

$Travel= $_SESSION['Travel'];


date_default_timezone_set("Asia/Jakarta");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: TRANSAKSI PAKET UMROH - TRAVEL ARBA TOUR</title>
<link href="../styles/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../plugins/tigra_calendar/tcal.css" />
<script type="text/javascript" src="../plugins/tigra_calendar/tcal.js"></script> 
</head>
<body>
<table width="400" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="../images/logo.png" width="499" height="80"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><a href="?page=Transaksi-Baru" target="_self">Transaksi baru</a> | <a href="?page=Transaksi-Tampil" target="_self">Tampilkan Transaksi </a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>

 <?php 
# KONTROL MENU PROGRAM
if(isset($_GET['page'])) {
	// Jika mendapatkan variabel URL ?page
	switch($_GET['page']){				
		case 'Transaksi-Baru' :
			if(!file_exists ("transaksi_baru.php")) die ("Empty Main Page!"); 
			include "transaksi_baru.php";	break;
		case 'Transaksi-Tampil' :
			if(!file_exists ("transaksi_tampil.php")) die ("Empty Main Page!"); 
			include "transaksi_tampil.php";	break;
		case 'Rawat-Hapus' :
			if(!file_exists ("rawat_hapus.php")) die ("Empty Main Page!"); 
			include "rawat_hapus.php";	break;
		case 'Pencarian-Pelanggan' : 
			if(!file_exists ("pencarian_pasien.php")) die ("Empty Main Page!"); 
			include "pencarian_pasien.php";	break;
	}
}
else {
	include "transaksi_baru.php";
}
?>
</body>
</html>
