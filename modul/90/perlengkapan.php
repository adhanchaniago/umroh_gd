<!DOCTYPE html>

<?php
session_start();
if($_SESSION['FirstName'] == '90') {header('Location: ?page=90');} ;
include_once "../library/inc.library.php";
include_once "../library/inc.pilihan.php";
include_once "../library/inc.tanggal.php";

require('../config/travel-config.php'); //Load DB(mysql) config parameter

$Travel= $_SESSION['Travel'];

if($_GET) {
	// Baca variabel URL
	$NomorJamaah= isset($_GET['NomorJamaah']) ?  $_GET['NomorJamaah'] : '';
  $mySql	= "SELECT DISTINCT trax_perlengkapan.*,paket_umroh.nama_paket,paket_umroh.depart_umroh,paket_umroh.harga_umroh,
  paket_umroh.currency,paket_umroh.harga_double,paket_umroh.harga_triple,paket_umroh.harga_perlengkapan,
  jamaah.first_name, jamaah.room, jamaah.petugas, jamaah.travel, jamaah.arrival, jamaah.birthdate, jamaah.gender,
   jamaah.phone, jamaah.alamat, jamaah.status_jamaah, jamaah.last_name, jamaah.surname
  FROM trax_perlengkapan
  	LEFT JOIN paket_umroh on trax_perlengkapan.kd_umroh=paket_umroh.kd_umroh
  		LEFT JOIN jamaah on trax_perlengkapan.nomor_id=jamaah.nomor_id

  WHERE trax_perlengkapan.nomor_id='$NomorJamaah'";
  $myQry	= mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
  $myData = mysql_fetch_array($myQry);
	$Kode = $myData['nomor_id'];



		$totalBayarUmroh = $totalBayarUmroh + $hasilharga;
		$totalBayarPerlengkapan = $totalBayarPerlengkapan + $myData['harga_perlengkapan'];

?>
<html>
<head>
    <title>Umroh Management</title>
    <link rel="icon" sizes="192x192" href="../img/Icon.png"/>
    <!-- Glazzed & Bootstrap -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/main.min.css">
    <!-- Pixeden Icon Fonts -->
    <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
    <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-stroke.css">

<style>
     .push-to-bottom {
        position: absolute;
        bottom: 30px;
        width: 100%;
      }

      </style>

</head>
<body>


    <div id="loading">
        <div class="loader loader-light loader-large"></div>
    </div>
    <!-- Calling Top Bar & Side Bar -->
    <?php include "menu.php"; ?>

    <!-- Content -->

<section class="content">
      <header class = "main-header">
        <div class="main-header__nav">
              <h1 class="main-header__title">
                <i class="pe-7s-graph1"></i>
              <span>Equipment Management</span>
              </h1>
             <ul class="main-header__breadcrumb">
              <li><a href ="#" onclick="window.location='#';">Home</a></li>
                 <a href ="?page=90" onclick="window.location='?page=90';">Equipment</a>
              </li>
               </ul>
           </div>

           <div class="main-header__pojok">
         <button onclick="window.location='?page=Equipment-Add90&NomorJamaah=<?php echo $myData['nomor_id']; ?>';">Process</button>
          </div>
      </header>

<div class = "row">
          <div class="col-md-12">
            <article class="widget">
              <header class="widget__header">
                <div class="widget__title">
                  <i class="pe-7s-menu"></i><h3 >History Payment ( <?php echo $myData['nomor_id']; ?> / <?php echo $myData['first_name']; ?> <?php echo $myData['last_name']; ?> <?php echo $myData['surname']; ?> )</h3>
                </div>
                <div class="widget__config">
                  <a href="#"><i class=""></i></a>
                  <a href="#"><i class=""></i></a>
                </div>
              </header>

              <div class="widget__content ">

                <table class="table table-striped media-table">
                  <thead>
                    <tr>
                      <th style="width:1px">No </th>
                      <th>No.Trax</th>
                      <th>Date Payment</th>
                      <th>nominal (IDR)</th>
                        <th>Method</th>

                    </tr>
                  </thead>
                  <?php
                  // Query SQL ada di bagian atas, kolom tombol Cari (btnCari)
                  $myQry = mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
                  $nomor = 0;
                  $grandTotal = 0;
                  while ($myData = mysql_fetch_array($myQry)) {
                  	$nomor++;
                  	$Kode = $myData['nomor_id'];

                  ?>

                  <tbody>


              <tr class="spacer"></tr>
              <tr>
              <td>
              <font><p> <?php echo $nomor; ?></p></font>      </td>

               <td>
                <p> <?php echo $myData['trax_perlengkapan_id']; ?> </p>
               </td>
                <td>
                <p><?php echo $myData['input_traxp']; ?> </p>
               </td>
               <td>
               <p align="right"><?php echo $myData['payment_perlengkapan']; ?></p>
              </td>
               <td>
               <p><?php echo $myData['metode_pay_perlengkapan']; ?></p>
              </td>

              </tr>


                  </tbody>
<?php } ?>
                  <tbody>


              <tr class="spacer"></tr>
              <tr>
              <td>
              <font><p></p></font>      </td>

               <td>
                <p> </p>
               </td>
                <td>
                <p align="right">Total Payment</p>
               </td>
               <td>
               <p  align="right"><?php echo $totalBayarPerlengkapan; ?></p>
              </td>
               <td>
               <p></p>
              </td>

              </tr>


                  </tbody>
                </table>

<hr>
<br>

<?php
if($_GET) {
	// Baca variabel URL
	$NomorJamaah= isset($_GET['NomorJamaah']) ?  $_GET['NomorJamaah'] : '';
  $mySql	= "SELECT DISTINCT equipment_jamaah.*,
  jamaah.first_name, jamaah.room, jamaah.petugas, jamaah.travel, jamaah.arrival, jamaah.birthdate, jamaah.gender,
   jamaah.phone, jamaah.alamat, jamaah.status_jamaah, jamaah.last_name, jamaah.surname,
	 equipment.equipment_name
  FROM equipment_jamaah
  		LEFT JOIN jamaah on equipment_jamaah.nomor_id=jamaah.nomor_id
LEFT JOIN equipment on equipment_jamaah.id_equipment=equipment.id_equipment

  WHERE equipment_jamaah.nomor_id='$NomorJamaah'";
  $myQry	= mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
  $myData = mysql_fetch_array($myQry);
	$Kode = $myData['nomor_id'];

 ?>


                <table class="table table-striped media-table">
                  <thead>
                    <tr>
                      <th style="width:1px">No </th>
                      <th>Equipment</th>
                      <th>Qty</th>
                      <th>Status</th>
                        <th></th>

                    </tr>
                  </thead>

									<?php
									// Query SQL ada di bagian atas, kolom tombol Cari (btnCari)
									$myQry = mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
									$nomor = 0;
									$grandTotal = 0;
									while ($myData = mysql_fetch_array($myQry)) {
										$nomor++;
										$Kode = $myData['nomor_id'];

									?>
                  <tbody>


              <tr class="spacer"></tr>
              <tr>
              <td>
              <font><p> <?php echo $nomor; ?></p></font>      </td>

               <td>
                <p> <?php echo $myData['equipment_name']; ?></p>
               </td>
                <td>
                <p><?php echo $myData['qty_item']; ?></p>
               </td>
               <td>
               <p><?php echo "diserahkan"; ?></p>
              </td>
               <td>
               <p></p>
              </td>

              </tr>

                  </tbody>
									<?php } ?>

                </table>


<?php } ?>





              </div> <!-- /widget__content -->

            </article><!-- /widget -->
          </div>

        </div>

      <footer class="footer-brand">
          <?php include "footer.php"; ?>
      </footer>
    </section> <!-- /content -->

    <script type="text/javascript" src="../js/main.js"></script> <!-- Loading -->

</body>
<?php } ?>
</html>

<?php
if(isset($_SESSION["role"])) {
  exit;
}
else {
  echo "<meta http-equiv='refresh' content='0; url=../modul/logout.php'>";
}
?>
