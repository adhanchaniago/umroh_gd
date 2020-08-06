<?php
session_start();
// if($_SESSION['FirstName'] == '270') {header('Location: ?page=270');} ;
include_once "../library/inc.library.php";
include_once "../library/inc.pilihan.php";
include_once "../library/inc.tanggal.php";

	$namafolder="../upload/dokumen/paket_berkah/";
require('../../config/travel-config.php'); //Load DB(mysql) config parameter


$Id_Customer= $_POST['Id_Customer'];
$Name_Customer= $_POST['Name_Customer'];
$PAS= $_POST['PAS'];
$KK= $_POST['KK'];
$NIK= $_POST['NIK'];
$FU= $_POST['FU'];
$AKT= $_POST['AKT'];
$KUN= $_POST['KUN'];
$KTP= $_POST['KTP'];
$BKH= $_POST['BKH'];
$FH= $_POST['FH'];
$petugas= $_SESSION['FirstName'];
$tanggal		= date('Y-m-d');

// untuk upload dokumen
$foto_pas		= $_FILE['nama_file_pas']['type'];
$foto_kk		= $_FILE['nama_file_kk']['type'];
$foto_nik		= $_FILE['nama_file_nik']['type'];
$foto_fu		= $_FILE['nama_file_fu']['type'];
$foto_akt		= $_FILE['nama_file_akt']['type'];
$foto_kun		= $_FILE['nama_file_kun']['type'];
$foto_ktp		= $_FILE['nama_file_ktp']['type'];
$foto_bkh		= $_FILE['nama_file_bkh']['type'];

// $foto_doc		= $_FILE['nama_file']['type'];
$acak1			= rand (1,999);
$acak2			= rand (2,888);
$acak3			= rand (3,777);
$acak4			= rand (4,666);
$acak5			= rand (5,555);
$acak6			= rand (6,444);
$acak7			= rand (7,333);
$acak8			= rand (8,222);



if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/x-png" || $jenis_gambar==".pdf" || $jenis_gambar==".png");

	// $doc_itenenary = $namafolder . $tanggal. $acak1 . basename($_FILES['nama_file']['name']);
  $gambar_pas = $namafolder . $tanggal. $acak1 . basename($_FILES['nama_file_pas']['name']);
  $gambar_kk = $namafolder . $tanggal. $acak2 . basename($_FILES['nama_file_kk']['name']);
  $gambar_nik = $namafolder . $tanggal. $acak3 . basename($_FILES['nama_file_nik']['name']);
  $gambar_fu = $namafolder . $tanggal. $acak4 . basename($_FILES['nama_file_fu']['name']);
  $gambar_akt = $namafolder . $tanggal. $acak5 . basename($_FILES['nama_file_akt']['name']);
  $gambar_kun = $namafolder . $tanggal. $acak6 . basename($_FILES['nama_file_kun']['name']);
  $gambar_ktp = $namafolder . $tanggal. $acak7 . basename($_FILES['nama_file_ktp']['name']);
  $gambar_bkh = $namafolder . $tanggal. $acak8 . basename($_FILES['nama_file_bkh']['name']);




   move_uploaded_file($_FILES['nama_file_pas']['tmp_name'], $gambar_pas);
    move_uploaded_file($_FILES['nama_file_kk']['tmp_name'], $gambar_kk);
  move_uploaded_file($_FILES['nama_file_nik']['tmp_name'], $gambar_nik);
    move_uploaded_file($_FILES['nama_file_fu']['tmp_name'], $gambar_fu);
    move_uploaded_file($_FILES['nama_file_akt']['tmp_name'], $gambar_akt);
   move_uploaded_file($_FILES['nama_file_kun']['tmp_name'], $gambar_kun);
  move_uploaded_file($_FILES['nama_file_ktp']['tmp_name'], $gambar_ktp);
  move_uploaded_file($_FILES['nama_file_bkh']['tmp_name'], $gambar_bkh);

// if (move_uploaded_file($_FILES['nama_file']['tmp_name'], $doc_itenenary)
// 	and move_uploaded_file($_FILES['nama_file_akta']['tmp_name'], $gambar_akta));

		// $mySql	= "INSERT INTO upload( nama_file, tanggal_file )
    //
		// 		    VALUES('$doc_itenenary', '$tanggal')";

$mySql    = "INSERT INTO dokumen_super (nomor_id, name_customer, pas_image, pas_status, kk_image, kk_status, nik_image, nik_status,
                 akt_image, akt_status,kun_image, kun_status, ktp_image,  ktp_status, bkh_image, bkh_status, fu_image, fu_status, petugas, date_input)
        VALUES ('$Id_Customer','$Name_Customer', '$gambar_pas', '$PAS',  '$gambar_kk', '$KK', '$gambar_nik', '$NIK',
            '$gambar_akt', '$AKT', '$gambar_kun' , '$KUN', '$gambar_ktp',  '$KTP', '$gambar_bkh', '$BKH', '$gambar_fu', '$FU', '$petugas', '$tanggal')";
		$myQry	= mysql_query($mySql, $Link) or die ("Gagal query".mysql_error());
		if($myQry)


 {
	 echo "<script>alert('data berhasil disimpan');</script>";
	 	echo "<meta http-equiv='refresh' content='0;  URL=../main.php?page=Document'>";
} else {
	echo "<script>alert('Gagal menyimpan laporan !!!');</script>";
		echo "<meta http-equiv='refresh' content='0; URL=?../main.php?page=Document'>";
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
