<?php
	$namafolder="../upload/itenenary/paket/";
require('../../config/travel-config.php'); //Load DB(mysql) config parameter


$Packages_Name= $_POST['Packages_Name'];
$Day_Umroh= $_POST['Day_Umroh'];
$Departure= $_POST['Departure'];
$Hotel_Mecca = $_POST['Hotel_Mecca'];
$Hotel_Madinah = $_POST['Hotel_Madinah'];
$Plane= $_POST['Plane'];
$Price_Umroh = $_POST['Price_Umroh'];
$Price_Double = $_POST['Price_Double'];
$Price_Triple = $_POST['Price_Triple'];
$Price_Equipment = $_POST['Price_Equipment'];
$Quota = $_POST['Quota'];
$Currency = $_POST['Currency'];
$desc_umroh = $_POST['desc_umroh'];

// untuk upload dokumen
$foto_doc		= $_FILE['nama_file']['type'];
$acak1			= rand (000,555);
$tanggal		= date('Y-m-d');



if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/x-png" || $jenis_gambar==".pdf");

	$doc_itenenary = $namafolder . $tanggal. $acak1 . basename($_FILES['nama_file']['name']);

   move_uploaded_file($_FILES['nama_file']['tmp_name'], $doc_itenenary);

// if (move_uploaded_file($_FILES['nama_file']['tmp_name'], $doc_itenenary)
// 	and move_uploaded_file($_FILES['nama_file_akta']['tmp_name'], $gambar_akta));

		// $mySql	= "INSERT INTO upload( nama_file, tanggal_file )
    //
		// 		    VALUES('$doc_itenenary', '$tanggal')";

// $mySql    = "INSERT INTO paket_umroh (nama_paket, desc_umroh, hari_umroh, depart_umroh, hotel_umroh_mekkah,
//           hotel_umroh_madinah, pesawat_umroh,currency, harga_umroh, harga_triple,  harga_double, harga_perlengkapan, kuota, itinenary)
//
//         VALUES ('$Packages_Name','$desc_umroh', '$Day_Umroh', '$Departure',  '$Hotel_Mecca',
//       '$Hotel_Madinah', '$Plane', '$Currency' , '$Price_Umroh', '$Price_Triple',  '$Price_Double', '$Price_Equipment', '$Quota', '$doc_itenenary')";

$mySql	= "UPDATE paket_umroh SET nama_paket = '$Packages_Name',
        desc_umroh = '$desc_umroh',
        hari_umroh = '$Day_Umroh',
        depart_umroh = '$Departure',
        hotel_umroh_mekkah = '$Hotel_Mecca',
        hotel_umroh_madinah = '$Hotel_Madinah',
        pesawat_umroh = '$Plane',
        currency = '$Currency',
        harga_umroh = '$Price_Umroh',
        harga_triple = '$Price_Triple',
        harga_double = '$Price_Double',
        harga_perlengkapan = '$Price_Equipment',
        kuota = '$Quota',
        itinenary = '$doc_itenenary'


        WHERE kd_umroh ='".$_POST['txtKode']."'";

		$myQry	= mysql_query($mySql, $Link) or die ("Gagal query".mysql_error());
		if($myQry)


 {
	 echo "<script>alert('data berhasil disimpan');</script>";
	 	echo "<meta http-equiv='refresh' content='0;  URL=../main.php?page=Packages'>";
} else {
	echo "<script>alert('Gagal menyimpan laporan !!!');</script>";
		echo "<meta http-equiv='refresh' content='0; URL=?../main.php?page=Packages'>";
}



# MENGAMBIL DATA YANG DIEDIT, SESUAI KODE YANG DIDAPAT DARI URL
$Kode	= isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['txtKode'];
$mySql	= "SELECT * FROM paket_umroh WHERE kd_umroh='$Kode'";
$myQry	= mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);


	# MASUKKAN DATA DARI FORM KE VARIABEL TEMPORARY (SEMENTARA)
	$dataKode	= $myData['kd_umroh'];
	$dataPackages_Name	= isset($_POST['Packages_Name']) ? $_POST['Packages_Name'] : $myData['nama_paket'];
	$dataDay_Umroh= isset($_POST['Day_Umroh']) ? $_POST['Day_Umroh'] : $myData['hari_umroh'];
	$dataDeparture = isset($_POST['Departure']) ? $_POST['Departure'] : $myData['depart_umroh'];
	$dataHotel_Mecca= isset($_POST['Hotel_Mecca']) ? $_POST['Hotel_Mecca'] : $myData['hotel_umroh_mekkah'];
	$dataHotel_Madinah	= isset($_POST['Hotel_Madinah']) ? $_POST['Hotel_Madinah'] : $myData['hotel_umroh_madinah'];
	$dataPlane	= isset($_POST['Plane']) ? $_POST['Plane'] : $myData['pesawat_umroh'];
	$dataPrice_Umroh	= isset($_POST['Price_Umroh']) ? $_POST['Price_Umroh'] : $myData['harga_umroh'];
  $dataPrice_Triple	= isset($_POST['Price_Triple']) ? $_POST['Price_Triple'] : $myData['harga_triple'];
  $dataPrice_Double	= isset($_POST['Price_Double']) ? $_POST['Price_Double'] : $myData['harga_double'];
  $dataPrice_Equipment	= isset($_POST['Price_Equipment']) ? $_POST['Price_Equipment'] : $myData['harga_perlengkapan'];
  $dataCurrency = isset($_POST['Currency']) ? $_POST['Currency'] : $myData['currency'];
  $dataQuota	= isset($_POST['Quota']) ? $_POST['Quota'] : $myData['kuota'];
  $datadesc_umroh= isset($_POST['desc_umroh']) ? $_POST['desc_umroh'] : $myData['desc_umroh'];
	  $dataeditor1= isset($_POST['editor1']) ? $_POST['editor1'] : $myData['keterangan'];
 $dataDoc_Itinenary	= isset($_POST['itinenary']) ? $_POST['itinenary'] : $myData['itinenary'];


?>
