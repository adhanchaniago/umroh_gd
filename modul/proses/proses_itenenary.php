<?php
	$namafolder="../../upload/itenenary/";
require('../../config/travel-config.php'); //Load DB(mysql) config parameter


$foto_doc		= $_FILE['nama_file']['type'];
$acak1			= rand (000,555);
$tanggal		= date('Y-m-d');



if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/x-png" || $jenis_gambar==".pdf");

	$doc_itenenary = $namafolder . $tanggal. $acak1 . basename($_FILES['nama_file']['name']);

   move_uploaded_file($_FILES['nama_file']['tmp_name'], $doc_itenenary);

// if (move_uploaded_file($_FILES['nama_file']['tmp_name'], $doc_itenenary)
// 	and move_uploaded_file($_FILES['nama_file_akta']['tmp_name'], $gambar_akta));

		$mySql	= "INSERT INTO upload( nama_file, tanggal_file )

				    VALUES('$doc_itenenary', '$tanggal')";

		$myQry	= mysql_query($mySql, $Link) or die ("Gagal query".mysql_error());
		if($myQry)


 {
	 echo "<script>alert('data berhasil disimpan');</script>";
	 	echo "<meta http-equiv='refresh' content='0;  URL=../main.php?page=270'>";
} else {
	echo "<script>alert('Gagal menyimpan laporan !!!');</script>";
		echo "<meta http-equiv='refresh' content='0; URL=?../main.php?page=270'>";
}

?>
