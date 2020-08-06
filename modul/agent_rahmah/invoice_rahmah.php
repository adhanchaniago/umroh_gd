<!DOCTYPE html>

<?php
session_start();
// if($_SESSION['FirstName'] == '90') {header('Location: ?page=Invoice_Rahmah');} ;
include_once "../library/inc.library.php";
include_once "../library/inc.pilihan.php";
include_once "../library/inc.tanggal.php";

require('../config/travel-config.php'); //Load DB(mysql) config parameter

$Travel= $_SESSION['Travel'];




?>
<html>
<head>

  <title>Umroh Management - CRO</title>
    <link rel="icon" sizes="192x192" href="../img/Icon.png"/>
    <!-- Glazzed & Bootstrap -->
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/main.min.css">
  <!-- Pixeden Icon Fonts -->
  <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
  <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-stroke.css">

</head>

<textarea id="printing-css" style="display:none;">.no-print{display:none}</textarea>
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
<script type="text/javascript">
//<![CDATA[
function printDiv(elementId) {
    var a = document.getElementById('printing-css').value;
    var b = document.getElementById(elementId).innerHTML;
    window.frames["print_frame"].document.title = document.title;
    window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
}
//]]>

</script>

<body>


<?php
# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 100;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT DISTINCT track_jamaah.*,
 paket_umroh.nama_paket,paket_umroh.desc_umroh,paket_umroh.depart_umroh,paket_umroh.harga_umroh,paket_umroh.harga_perlengkapan,
 paket_umroh.currency,
 jamaah_daftar.first_name, jamaah_daftar.last_name, jamaah_daftar.surname
 FROM track_jamaah
 LEFT JOIN paket_umroh on track_jamaah.kd_umroh=paket_umroh.kd_umroh
 LEFT JOIN jamaah_daftar on track_jamaah.nomor_id=jamaah_daftar.nomor_id
 WHERE packages_program='Rahmah'
  ORDER BY nomor_id ASC LIMIT $hal, $row";
$pageQry = mysql_query($pageSql, $Link) or die ("error paging: ".mysql_error());
$jml   = mysql_num_rows($pageQry);
$max   = ceil($jml/$row);

// Jika tombol Cari diklik
if(isset($_POST['btnCari'])){
	if($_POST) {
		// Cari berdasarkan Nomor RM dan Nama Pasien yang mirip
		$txtKataKunci	= $_POST['txtKataKunci'];
		$mySql = "SELECT track_jamaah.*,
     paket_umroh.nama_paket,paket_umroh.desc_umroh,paket_umroh.depart_umroh,paket_umroh.harga_umroh,paket_umroh.harga_perlengkapan,
     paket_umroh.currency,
     jamaah_daftar.first_name, jamaah_daftar.last_name, jamaah_daftar.surname
    FROM track_jamaah
    LEFT JOIN paket_umroh on track_jamaah.kd_umroh=paket_umroh.kd_umroh
    LEFT JOIN jamaah_daftar on track_jamaah.nomor_id=jamaah_daftar.nomor_id
     WHERE track_jamaah.depart='$txtKataKunci' and packages_program='Rahmah'
				  ORDER BY nomor_id ASC LIMIT $hal, $row";
	}
}
else {
	$mySql = "SELECT track_jamaah.*,
   paket_umroh.nama_paket,paket_umroh.desc_umroh,paket_umroh.depart_umroh,paket_umroh.harga_umroh,paket_umroh.harga_perlengkapan,
   paket_umroh.currency,
   jamaah_daftar.first_name, jamaah_daftar.last_name, jamaah_daftar.surname
   FROM track_jamaah
   LEFT JOIN paket_umroh on track_jamaah.kd_umroh=paket_umroh.kd_umroh
   LEFT JOIN jamaah_daftar on track_jamaah.nomor_id=jamaah_daftar.nomor_id
   WHERE packages_program='Rahmah'
  ORDER BY nomor_id  ASC LIMIT $hal, $row";
}


// Membaca variabel form
$dataKataKunci  = isset($_POST['txtKataKunci']) ? $_POST['txtKataKunci'] : '';




?>


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
              <span>Payment Packages Rahmah</span>
              </h1>

            </div>
      </header>

       <div class="row">

                    <div class="col-md-12">
                    <article class="widget widget__form ">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1"  class="form-horizontal" role="form">
              <select name="txtKataKunci" bgcolor="blue" class="btn blue ">
                                            <option value="ok">--Select The Departure Date--</option>
                                           <?php
                $bacaSql = "SELECT  track_jamaah.*,
                 paket_umroh.nama_paket,paket_umroh.desc_umroh,paket_umroh.depart_umroh,paket_umroh.harga_umroh,paket_umroh.harga_perlengkapan,
                 paket_umroh.currency,
                 jamaah_daftar.first_name, jamaah_daftar.last_name, jamaah_daftar.surname
                FROM track_jamaah
                LEFT JOIN paket_umroh on track_jamaah.kd_umroh=paket_umroh.kd_umroh
                LEFT JOIN jamaah_daftar on track_jamaah.nomor_id=jamaah_daftar.nomor_id
                WHERE packages_program='Rahmah'";
                $bacaQry = mysql_query($bacaSql, $Link) or die ("Gagal Query".mysql_error());
                while ($bacaData = mysql_fetch_array($bacaQry)) {
                if ($bacaData['kd_umroh'] == $dataType) {
                  $cek = " selected";
                } else { $cek=""; }

                echo "<option value='$bacaData[depart]' $cek>[ $bacaData[depart] ]   $bacaData[packages_program]  </option>";
                }
                ?>
                                            </select>
         <button  type="submit" name="btnCari" value="search"  class="btn blue" type="submit" style="width:10%; height:15%">
                        Submit
                      </button>
            </form>

                        </article><!-- /widget -->
                    </div>

                </div> <!-- /row -->

            <table class="table table-striped media-table" style="width: 100%">
                  <thead>
                    <tr>
                     <th><strong style="font-weight: bold;"><center>No.</center></strong></th>
                     <th><strong style="font-weight: bold;"><center>Travel/Agent</center></strong></th>
                      <th><strong style="font-weight: bold;"><center>ID</center></strong></th>
                      <th><strong style="font-weight: bold;"><center>Name</center></strong></th>
                      <th><strong style="font-weight: bold;"><center>Departure</center></strong></th>
                      <th width="20%"><strong style="font-weight: bold;"><center>Package</strong></th>
                        <th><strong style="font-weight: bold;"><center>Status</center></strong></th>
                      <th ><strong style="font-weight: bold;"><center>Detail</center></strong></th>
                      <th ><strong style="font-weight: bold;"><center>Action</center></strong></th>
                      <th style="display : none"></th>
                    </tr>
                  </thead>

                  <?php
  // Query SQL ada di bagian atas, kolom tombol Cari (btnCari)
  $myQry = mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
  $nomor = 0;

  $totalBayarUmroh = 0;
$totalBayarPerlengkapan = 0;
  while ($myData = mysql_fetch_array($myQry)) {
    $nomor++;
    $Kode = $myData['nomor_id'];




  ?>

                  <tbody>
                  <tr class="spacer"></tr>
                  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $myData['travel']; ?> <br><hr>
        <?php echo $myData['petugas']; ?></td>
    <td><?php echo $myData['nomor_id']; ?></td>
    <td><?php echo $myData['first_name']; ?>&nbsp;<?php echo $myData['last_name']; ?>&nbsp;<?php echo $myData['surname']; ?></td>
    <td><?php echo IndonesiaTgl($myData['depart_umroh']); ?></td>

    <td><?php echo $myData['nama_paket']; ?><br>
        <?php echo $myData['desc_umroh']; ?></td>
<td><?php echo $myData['status_pay']; ?></td>



      <td align ="right">
      <a href="cetak/invoice_print.php?NomorJamaah=<?php echo $myData['nomor_id']; ?>" target="_blank" alt="Detail Data" class='btn blue ' title="Detail"> <i class="pe-7s-search" ></i></a>&nbsp;
      </td>

                   <td align ="right">



                        <a class="btn green btn-sm" type="submit" name="button90" id="submit90"  onclick="window.location.href = '?page=Channel_Payment&NomorID=<?php echo $myData['nomor_id']; ?>'" title="Payment"><i class=" pe-7s-cash"></i></a>
                        <button class="btn green btn-sm" type="submit" name="button90" id="submit90"  onclick="window.location.href = '?page=Equipment-Data90&NomorID=<?php echo $myData['nomor_id']; ?>'" title="Equipment"><i class=" pe-7s-portfolio"></i></button>
                   </td>

                    <td style="display :none">

                   </td>
                  </tr>




                                </tbody>
                                  <?php } ?>
            </table>



      <footer class="footer-brand">
          <?php include "footer.php"; ?>
      </footer>
    </section> <!-- /content -->

  <script type="text/javascript" src="../js/main.js"></script> <!-- Loading -->
  <script type="text/javascript" src="../js/amcharts/amcharts.js"></script>
  <script type="text/javascript" src="../js/amcharts/serial.js"></script>
  <script type="text/javascript" src="../js/amcharts/pie.js"></script>
  <script type="text/javascript" src="../js/chartz.js"></script>




      </div>
    </div>
  </div>
</body>
</html>

<?php
if(isset($_SESSION["Travel"])) {
  exit;
}
else {
  echo "<meta http-equiv='refresh' content='0; url=../modul/logout.php'>";
}
?>
