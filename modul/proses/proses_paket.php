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
$editor1 = $_POST['editor1'];


$Pinjam = date("d-m-Y");
$haridariumroh = mktime(0,0,0,date("n"),date("j")+3,date("Y"));
$arrivalumroh = date("d-m-Y",$haridariumroh);


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

$mySql    = "INSERT INTO paket_umroh (nama_paket, desc_umroh, hari_umroh, depart_umroh, arrival_umroh, hotel_umroh_mekkah,
          hotel_umroh_madinah, pesawat_umroh,currency, harga_umroh, harga_triple,  harga_double, harga_perlengkapan, kuota, itinenary, keterangan)

        VALUES ('$Packages_Name','$desc_umroh', '$Day_Umroh', '$Departure', '$arrivalumroh',  '$Hotel_Mecca',
      '$Hotel_Madinah', '$Plane', '$Currency' , '$Price_Umroh', '$Price_Triple',  '$Price_Double', '$Price_Equipment', '$Quota', '$doc_itenenary', '$editor1')";

		$myQry	= mysql_query($mySql, $Link) or die ("Gagal query".mysql_error());
		if($myQry)


 {
	 echo "<script>alert('data berhasil disimpan');</script>";
	 	echo "<meta http-equiv='refresh' content='0;  URL=../main.php?page=Packages'>";
} else {
	echo "<script>alert('Gagal menyimpan laporan !!!');</script>";
		echo "<meta http-equiv='refresh' content='0; URL=?../main.php?page=Packages'>";
}

?>
