<!DOCTYPE html>

<?php
session_start();
if($_SESSION['FirstName'] == '180') {header('Location: ?page=180');} ;
include_once "../library/inc.library.php";
include_once "../library/inc.pilihan.php";
include_once "../library/inc.tanggal.php";

require('../config/travel-config.php'); //Load DB(mysql) config parameter

$Travel= $_SESSION['Travel'];




?>
<html>
<head>

  <title>Umroh Management - Finance</title>
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

<style type="text/css">
    table, th, td {
 border: 1px solid black    ;
  padding-top: 5px;
  padding-left: 5px;
  padding-right: 5px;
  padding-bottom: 5px;
  border-radius: 5px;
    font-family: 'Raleway', sans-serif;
    height: 12px;
  }

.table-number {

  font-family: 'Roboto', sans-serif;
}

#grad1 {
height: 50px;
background: -webkit-linear-gradient(left, #0bd745 , #1cd88b); /* For Safari 5.1 to 6.0 */
background: -o-linear-gradient(right, #0bd745, #1cd88b); /* For Opera 11.1 to 12.0 */
background: -moz-linear-gradient(right, #0bd745, #1cd88b); /* For Firefox 3.6 to 15 */
background: linear-gradient(to right, #0bd745 , #1cd88b); /* Standard syntax (must be last) */
}

#grad2 {
                height: 50px;
                background: -webkit-linear-gradient(left, #1ac5fb , #1d72f1); /* For Safari 5.1 to 6.0 */
                background: -o-linear-gradient(right, #1ac5fb, #1d72f1); /* For Opera 11.1 to 12.0 */
                background: -moz-linear-gradient(right, #1ac5fb, #1d72f1); /* For Firefox 3.6 to 15 */
                background: linear-gradient(to right, #1ac5fb , #1d72f1); /* Standard syntax (must be last) */

}
.widget__form input[type=text] {
    display: inline-block;
    width: 30%;
    border: none;
    height: 35px;
    vertical-align: top;
    background-color: rgba(0, 0, 0, 0.5);
    margin: 1px 0 0;
    padding-left: 24px;
    font-weight: 100;
    color: #fff;
}

</style>

<?php
# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 100;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT DISTINCT jamaah.*,
 paket_umroh.nama_paket,paket_umroh.desc_umroh,paket_umroh.depart_umroh,paket_umroh.harga_umroh,paket_umroh.harga_perlengkapan
 FROM jamaah
  LEFT JOIN paket_umroh on jamaah.kd_umroh=paket_umroh.kd_umroh

 WHERE packages_program='Super Saver'
  ORDER BY nomor_id ASC LIMIT $hal, $row";
$pageQry = mysql_query($pageSql, $Link) or die ("error paging: ".mysql_error());
$jml   = mysql_num_rows($pageQry);
$max   = ceil($jml/$row);

// Jika tombol Cari diklik
if(isset($_POST['btnCari'])){
	if($_POST) {
		// Cari berdasarkan Nomor RM dan Nama Pasien yang mirip
		$txtKataKunci	= $_POST['txtKataKunci'];
		$mySql = "SELECT jamaah.*,
     paket_umroh.nama_paket,paket_umroh.desc_umroh,paket_umroh.depart_umroh,paket_umroh.harga_umroh,paket_umroh.harga_perlengkapan,
     paket_umroh.currency
     FROM jamaah
     LEFT JOIN paket_umroh on jamaah.kd_umroh=paket_umroh.kd_umroh
     WHERE jamaah.depart='$txtKataKunci'
				  ORDER BY nomor_id ASC LIMIT $hal, $row";
	}
}
else {
	$mySql = "SELECT jamaah.*,
   paket_umroh.nama_paket,paket_umroh.desc_umroh,paket_umroh.depart_umroh,paket_umroh.harga_umroh,paket_umroh.harga_perlengkapan
  FROM jamaah
   LEFT JOIN paket_umroh on jamaah.kd_umroh=paket_umroh.kd_umroh
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
              <span>Payment Packages Super Saver</span>
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
                $bacaSql = "SELECT distinct * FROM paket_umroh WHERE nama_paket='Super Saver'";
                $bacaQry = mysql_query($bacaSql, $Link) or die ("Gagal Query".mysql_error());
                while ($bacaData = mysql_fetch_array($bacaQry)) {
                if ($bacaData['kd_umroh'] == $dataType) {
                  $cek = " selected";
                } else { $cek=""; }

                echo "<option value='$bacaData[depart_umroh]' $cek>[ $bacaData[depart_umroh] ]   $bacaData[nama_paket]  </option>";
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
<td><?php echo $myData['metode_status']; ?></td>



      <td align ="right">
      <a href="180/invoice_print.php?NomorJamaah=<?php echo $myData['nomor_id']; ?>" target="_blank" alt="Detail Data" class='btn blue ' title="Detail"> <i class="pe-7s-search" ></i></a>&nbsp;
      </td>

                   <td align ="right">



                        <a class="btn green btn-sm" type="submit" name="button90" id="submit90"  onclick="window.location.href = '?page=Channel180&NomorID=<?php echo $myData['nomor_id']; ?>'" title="Payment"><i class=" pe-7s-cash"></i></a>
                        <button class="btn green btn-sm" type="submit" name="button90" id="submit90"  onclick="window.location.href = '#'" title="Equipment"><i class=" pe-7s-portfolio"></i></button>
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
