<?php
	$namafolder="../upload/news/";
require('../../config/travel-config.php'); //Load DB(mysql) config parameter


$Title= $_POST['Title'];
$Content= $_POST['Content'];
$Created = $_POST['Created'];

// untuk upload dokumen
$file_news		= $_FILE['nama_file']['type'];
$acak1			= rand (000,555);
$tanggal		= date('Y-m-d');



if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/x-png" || $jenis_gambar==".pdf");

	$doc_news = $namafolder . $tanggal. $acak1 . basename($_FILES['nama_file']['name']);

   move_uploaded_file($_FILES['nama_file']['tmp_name'], $doc_news);

// if (move_uploaded_file($_FILES['nama_file']['tmp_name'], $doc_itenenary)
// 	and move_uploaded_file($_FILES['nama_file_akta']['tmp_name'], $gambar_akta));

		// $mySql	= "INSERT INTO upload( nama_file, tanggal_file )
    //
		// 		    VALUES('$doc_itenenary', '$tanggal')";

$mySql    =  "INSERT INTO push_news (title, content, image, created, date_created)
        VALUES ('$Title','$Content', '$doc_news', '$Created',  NOW())";

		$myQry	= mysql_query($mySql, $Link) or die ("Gagal query".mysql_error());
		if($myQry)


 {
	 echo "<script>alert('data berhasil disimpan');</script>";
	 	echo "<meta http-equiv='refresh' content='0;  URL=../main.php?page=News'>";
} else {
	echo "<script>alert('Gagal menyimpan laporan !!!');</script>";
		echo "<meta http-equiv='refresh' content='0; URL=?../main.php?page=News'>";
}

?>
