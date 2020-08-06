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

</style>

<?php
# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 10;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT DISTINCT jamaah.*,
 paket_umroh.nama_paket,paket_umroh.depart_umroh,paket_umroh.harga_umroh,paket_umroh.harga_perlengkapan, trax_umroh.trax_umroh_id, trax_umroh.payment, trax_umroh.input_traxu, trax_umroh.metode_pay,
  trax_umroh.staff,  trax_perlengkapan.trax_perlengkapan_id, trax_perlengkapan.input_traxp, trax_perlengkapan.payment_perlengkapan, trax_perlengkapan.metode_pay_perlengkapan
 FROM jamaah
  LEFT JOIN paket_umroh on jamaah.kd_umroh=paket_umroh.kd_umroh
      LEFT JOIN trax_umroh on jamaah.nomor_id=trax_umroh.nomor_id
      LEFT JOIN trax_perlengkapan on jamaah.nomor_id=trax_perlengkapan.nomor_id

 WHERE packages_program='Super Saver'
  ORDER BY nomor_id ASC LIMIT $hal, $row";
$pageQry = mysql_query($pageSql, $Link) or die ("error paging: ".mysql_error());
$jml   = mysql_num_rows($pageQry);
$max   = ceil($jml/$row);

// Jika tombol Cari diklik
if(isset($_POST['btnCari'])){
  if($_POST) {
    // Cari berdasarkan Nomor RM dan Nama Pasien yang mirip
    $txtKataKunci = $_POST['txtKataKunci'];
    $mySql = "SELECT DISTINCT jamaah.*,paket_umroh.nama_paket,paket_umroh.depart_umroh,paket_umroh.harga_umroh,paket_umroh.harga_perlengkapan, trax_umroh.trax_umroh_id, trax_umroh.payment, trax_umroh.input_traxu, trax_umroh.metode_pay,
  trax_umroh.staff,  trax_perlengkapan.trax_perlengkapan_id, trax_perlengkapan.input_traxp, trax_perlengkapan.payment_perlengkapan, trax_perlengkapan.metode_pay_perlengkapan
      FROM jamaah
      LEFT JOIN paket_umroh on jamaah.kd_umroh=paket_umroh.kd_umroh
     LEFT JOIN trax_umroh on jamaah.nomor_id=trax_umroh.nomor_id
     LEFT JOIN trax_perlengkapan on jamaah.nomor_id=trax_perlengkapan.nomor_id
      WHERE  first_name LIKE '%$txtKataKunci%'
          ORDER BY nomor_id ASC LIMIT $hal, $row";
  }
}
else {
  $mySql = "SELECT DISTINCT jamaah.*, paket_umroh.nama_paket,paket_umroh.depart_umroh,paket_umroh.harga_umroh,paket_umroh.harga_perlengkapan, trax_umroh.trax_umroh_id, trax_umroh.payment, trax_umroh.input_traxu, trax_umroh.metode_pay,
  trax_umroh.staff,  trax_perlengkapan.trax_perlengkapan_id, trax_perlengkapan.input_traxp, trax_perlengkapan.payment_perlengkapan, trax_perlengkapan.metode_pay_perlengkapan
 FROM jamaah
LEFT JOIN paket_umroh on jamaah.kd_umroh=paket_umroh.kd_umroh
    LEFT JOIN trax_umroh on jamaah.nomor_id=trax_umroh.nomor_id
    LEFT JOIN trax_perlengkapan on jamaah.nomor_id=trax_perlengkapan.nomor_id
  WHERE packages_program='Super Saver' ORDER BY nomor_id ASC LIMIT $hal, $row";
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
              <span>Payment</span>
              </h1>

            </div>
      </header>

       <div class="row">

                    <div class="col-md-12">
                    <article class="widget">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1"  class="form-horizontal" role="form">
                             <select name="txtKataKunci"  bgcolor="blue" class="btn blue ">
                            <option value="maaf belum bisa">Select</option>
    <?php
    $bacaSql = "SELECT * FROM jamaah WHERE packages_program='Super Saver'";
    $bacaQry = mysql_query($bacaSql, $Link) or die ("Gagal Query".mysql_error());
    while ($bacaData = mysql_fetch_array($bacaQry)) {
    if ($bacaData['nomor_id'] == $bacaData) {
      $cek = " selected";
    } else { $cek=""; }

    echo "<option value='$bacaData[first_name]' $cek>[ $bacaData[nomor_id] ]  $bacaData[first_name]  $bacaData[last_name]  $bacaData[surname]</option>";
    }
    ?>
        </select>
         <button  type="submit" name="btnCari" value="search"  class="btn blue" type="submit">
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
                      <th><strong style="font-weight: bold;"><center>ID</center></strong></th>
                      <th><strong style="font-weight: bold;"><center>Name</center></strong></th>
                      <th><strong style="font-weight: bold;"><center>Departure</center></strong></th>
                      <th><strong style="font-weight: bold;"><center>Package</strong></th>
                      <th><strong style="font-weight: bold;"><center>USD</center></th>
                      <th ><strong style="font-weight: bold;"><center>IDR</center></strong></th>
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

 $totalBayarUmroh = $totalBayarUmroh + $myData['harga_umroh'];
    $totalBayarPerlengkapan = $totalBayarPerlengkapan + $myData['harga_perlengkapan'];


    $pembayaranUmrohSebelumnya = $myData['payment'];
    $pembayaranPerlengkapanSebelumnya = $myData['payment_perlengkapan'];
    $sisaTagihanUmroh = $totalBayarUmroh - $pembayaranUmrohSebelumnya;
    $sisaTagihanPerlengkapan = $totalBayarPerlengkapan - $pembayaranPerlengkapanSebelumnya;


  ?>

                  <tbody>
                  <tr class="spacer"></tr>
                  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $myData['nomor_id']; ?></td>
    <td><?php echo $myData['first_name']; ?>&nbsp;<?php echo $myData['last_name']; ?>&nbsp;<?php echo $myData['surname']; ?></td>

    <td><?php echo IndonesiaTgl($myData['depart_umroh']); ?></td>

    <td><?php echo $myData['nama_paket']; ?></td>
    <td>
    <font color="red"><?php echo format_angka($myData['harga_umroh']); ?></font><br>
    <font color="green"><?php echo format_angka($myData['payment']); ?></font><br>
    <font color="Yellow"><?php echo format_angka($sisaTagihanUmroh); ?></font>
    </td>

    <td>
    <font color="red"><?php echo format_angka($myData['harga_perlengkapan']);?></font><br>
    <font color="green"><?php echo format_angka($myData['payment_perlengkapan']); ?></font><br>
     <font color="Yellow"><?php echo format_angka($sisaTagihanPerlengkapan); ?></font>
    </td>

                   <td align ="right">
                       <button class="btn blue" data-toggle="modal" data-target="#myModal"><i class=" pe-7s-search"></i></button>
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


   <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content" >
      <div id="area-1" >
        <div class="modal-header">


          <h4 class="modal-title">Detail Invoice</h4>
        </div>
        <div class="modal-body">
                    <?php
  // Query SQL ada di bagian atas, kolom tombol Cari (btnCari)
  $myQry = mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
  $nomor = 0;
  # Baca variabel
$totalBayarUmroh = 0;
$totalBayarPerlengkapan = 0;
  while ($myData = mysql_fetch_array($myQry)) {
    $nomor++;
    $Kode = $myData['nomor_id'];
    $totalBayarUmroh = $totalBayarUmroh + $myData['harga_umroh'];
    $totalBayarPerlengkapan = $totalBayarPerlengkapan + $myData['harga_perlengkapan'];


    $pembayaranUmrohSebelumnya = $myData['payment'];
    $pembayaranPerlengkapanSebelumnya = $myData['payment_perlengkapan'];
    $sisaTagihanUmroh = $totalBayarUmroh - $pembayaranUmrohSebelumnya;
    $sisaTagihanPerlengkapan = $totalBayarPerlengkapan - $pembayaranPerlengkapanSebelumnya;

// Tanggal Lahir
  $birthday =  $myData['birthdate'];

  // Convert Ke Date Time
  $biday = new DateTime($birthday);
  $today = new DateTime();

  $diff = $today->diff($biday);



  ?>

  <header class="main-header">
  <table width="100%" >
  <tr>
  <thead>
  <th style="text-align: left;"><span>Program</span></th>
  <th style="text-align: left;"><span>:</span></th>
  <th style="text-align: left;"><span><?php echo $myData['nama_paket']; ?></span></th>
  <th colspan="2" style="text-align: right;" ><strong >Address :</strong></th>
  <th style="text-align: left;"> <?php echo $myData['alamat']; ?></th>
  </tr>
  <tr>
  <th style="text-align: left;"><span>Depart</span></th>
  <th style="text-align: left;"><span>:</span></th>
  <th style="text-align: left;"><span><?php echo IndonesiaTgl($myData['depart_umroh']); ?></span></th>
   <th colspan="2" style="text-align: right;" ><strong >Contact :</strong></th>
  <th style="text-align: left;"> <?php echo $myData['phone']; ?></th>
  </tr>
  <tr>
  <th style="text-align: left;"><span>Name</span></th>
  <th style="text-align: left;"><span>:</span></th>
  <th style="text-align: left;"><span><?php echo $myData['first_name']; ?>&nbsp;<?php echo $myData['last_name']; ?>&nbsp;<?php echo $myData['surname']; ?></span></th>
    <th colspan="2"  style="text-align: right;"><strong>Email :</strong></th>
     <th style="text-align: left;"><?php echo $myData['email']; ?></th>
  </tr>
  <tr>
  <th style="text-align: left;"><span>Age</span></th>
  <th style="text-align: left;"><span>:</span></th>
  <th style="text-align: left;"><span><?php echo  $diff->y ." Age"; ?> (<?php echo $myData['gender']; ?> - <?php echo $myData['status_jamaah']; ?>)</span></th>




 </thead>
 </tr>
  </table>
      </header> <!-- /main-header -->
              <hr>

          <table width="100%"  border="1">
            <tr>
            <thead bgcolor="#1c7dfa">
              <tr>
              <th rowspan="2" style="text-align: center; color: black;">No.</th>
              <th rowspan="2" style="text-align: center; color: black;">No.Trancation</th>
              <th rowspan="2" style="text-align: center; color: black;">Desc</th>
              <th colspan="2" style="text-align: center; color: black;">Total</th>
               </tr>
                <tr>
              <th style="text-align: center; color: black;">USD</th>
              <th style="text-align: center; color: black;">IDR</th>
               </tr>
            </thead>
            </tr>
            <tr>


            <tbody style="background-color: #fff">
            <tr>
              <td style="text-align: center;color: black;"> 1 </td>
              <td style="text-align: center;color: black;"> <?php echo $myData['nomor_id']; ?></td>
              <td style="text-align: center; color: black;"> Equiment </td>
              <td style="text-align: right; color: black;"> 0 </td>
              <td style="text-align: right; color: black;"> <?php echo format_angka($myData['harga_perlengkapan']);?></td>
            </tr>
            <tr>
              <td style="text-align: center; color: black;"> 2 </td>
              <td style="text-align: center; color: black;"> <?php echo $myData['nomor_id']; ?> </td>
              <td style="text-align: center; color: black;"> <?php echo $myData['nama_paket']; ?></td>
              <td style="text-align: right; color: black;"><?php echo format_angka($myData['harga_umroh']); ?> </td>
              <td style="text-align: right; color: black;"> 0</td>

            </tr>
             <tr>
              <td style="text-align: right; color: black;" colspan="3"> Total</td>
              <td style="text-align: right; color: red;"><?php echo format_angka($totalBayarUmroh); ?></td>
              <td style="text-align: right; color: red;"><?php echo format_angka($totalBayarPerlengkapan); ?></td>

            </tr>
            <tr>
              <td style="text-align: right; color: black;" colspan="3"> Previous payment</td>
              <td style="text-align: right; color: green;"><?php echo format_angka($pembayaranUmrohSebelumnya); ?></td>
              <td style="text-align: right; color: green ;"><?php echo format_angka($pembayaranPerlengkapanSebelumnya); ?></td>

            </tr>

             <tr>
              <td style="text-align: right; color: black;" colspan="3"> Rest of the bill</td>
              <td style="text-align: right; color: black;"><?php echo format_angka($sisaTagihanUmroh); ?></td>
              <td style="text-align: right; color: black;"><?php echo format_angka($sisaTagihanPerlengkapan); ?></td>
            </tbody>

            </tr>
          </table>


        </div>
         <?php } ?>
        <div class="modal-footer">
           <a type="button"  class="btn btn-default no-print"  href="javascript:printDiv('area-1');">Print</a>
          <button type="button" class="btn btn-default no-print" data-dismiss="modal">Close</button>
        </div>
        </div><!-- print -- >

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
