<!DOCTYPE html>

<?php
session_start();
// if($_SESSION['FirstName'] == '90') {header('Location: ?page=90');} ;
include_once "../library/inc.library.php";
include_once "../library/inc.pilihan.php";
include_once "../library/inc.tanggal.php";

require('../config/travel-config.php'); //Load DB(mysql) config parameter

$Travel= $_SESSION['Travel'];

if($_GET) {
  // Baca variabel URL
    $NomorID= isset($_GET['NomorID']) ?  $_GET['NomorID'] : '';
  $mySql  = "SELECT DISTINCT trax_perlengkapan.*,paket_umroh.nama_paket,paket_umroh.depart_umroh,paket_umroh.harga_umroh,
  paket_umroh.currency,paket_umroh.harga_double,paket_umroh.harga_triple,paket_umroh.harga_perlengkapan,
  jamaah_daftar.nomor_id,jamaah_daftar.first_name, jamaah_daftar.petugas, jamaah_daftar.birthdate, jamaah_daftar.gender,
   jamaah_daftar.phone, jamaah_daftar.alamat, jamaah_daftar.status_jamaah, jamaah_daftar.last_name, jamaah_daftar.surname
  FROM trax_perlengkapan
    LEFT JOIN paket_umroh on trax_perlengkapan.kd_umroh=paket_umroh.kd_umroh
      LEFT JOIN jamaah_daftar on trax_perlengkapan.nomor_id=jamaah_daftar.nomor_id

  WHERE trax_perlengkapan.nomor_id='$NomorID'";
  $myQry  = mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
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


      table{
        width: 100%
      }


      th, td {

      		height: 20px;
      		padding: 10px;

          border-collapse: collapse;
      	border-radius: 0px;
      }
      tr:nth-child(even) {
          background-color:rgba(0,0,0,.3);
      }

      th, td {
      	  border-bottom: 1px solid black;
      }


      </style>

</head>
<script>
function printContent(el){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}
</script>
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
      <a type="button" 	class="btn btn-default no-print" onclick="printContent('div1')" style="background: transparent;">Print </a>

<div class = "row">
          <div class="col-md-12" id="div1">
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

                <table class="">

                    <tr>
                      <th style="width:1px">No </th>
                      <th>No.Trax</th>
                      <th>Date Payment</th>
                      <th>nominal (IDR)</th>
                        <th>Method</th>

                    </tr>

                  <?php
                  // Query SQL ada di bagian atas, kolom tombol Cari (btnCari)
                  $myQry = mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
                  $nomor = 0;
                  $grandTotal = 0;
                  while ($myData = mysql_fetch_array($myQry)) {
                    $nomor++;
                    $Kode = $myData['nomor_id'];

                  ?>



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



<?php } ?>



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



                </table>

<hr>
<br>

<?php
if($_GET) {
  // Baca variabel URL
  $NomorID= isset($_GET['NomorID']) ?  $_GET['NomorID'] : '';
  $mySql  = "SELECT DISTINCT equipment_jamaah.*,
  jamaah.first_name, jamaah.room, jamaah.petugas, jamaah.travel, jamaah.arrival, jamaah.birthdate, jamaah.gender,
   jamaah.phone, jamaah.alamat, jamaah.status_jamaah, jamaah.last_name, jamaah.surname,
   equipment.equipment_name
  FROM equipment_jamaah
      LEFT JOIN jamaah on equipment_jamaah.nomor_id=jamaah.nomor_id
LEFT JOIN equipment on equipment_jamaah.id_equipment=equipment.id_equipment

  WHERE equipment_jamaah.nomor_id='$NomorID'";
  $myQry  = mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
  $myData = mysql_fetch_array($myQry);
  $Kode = $myData['nomor_id'];

 ?>


                <table class="">

                    <tr>
                      <th style="width:1px">No </th>
                      <th>Equipment</th>
                      <th>Qty</th>
                      <th>Status</th>


                    </tr>


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
               <p><?php echo "diserahkan"; ?> pada <?php echo $myData['input_item_date']; ?></p>
              </td>


              </tr>


                  <?php } ?>

                </table>

<hr>
<?php
$sql = "SELECT DISTINCT equipment_jamaah.*,
jamaah.first_name, jamaah.room, jamaah.petugas, jamaah.travel, jamaah.arrival, jamaah.birthdate, jamaah.gender,
 jamaah.phone, jamaah.alamat, jamaah.status_jamaah, jamaah.last_name, jamaah.surname,
 equipment.equipment_name
FROM equipment_jamaah
    LEFT JOIN jamaah on equipment_jamaah.nomor_id=jamaah.nomor_id
LEFT JOIN equipment on equipment_jamaah.id_equipment=equipment.id_equipment

WHERE equipment_jamaah.nomor_id='$NomorID'";
$query = mysql_query($sql, $Link);
$result = mysql_fetch_array($query);

$row = mysql_fetch_assoc($result);


?>
      <table>
        <tr>
          <th style="width:50%"><center>Telah diterima oleh</center></th>
          <th style="width:50%"><center>Petugas</center></th>
        </tr>
        <tr>
          <td style="width:50%"><center></td>
          <td style="width:50%"><center></center></td>
        </tr>
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
