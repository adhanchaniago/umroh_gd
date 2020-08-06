<!DOCTYPE html>

<?php
session_start();
// if($_SESSION['FirstName'] == '90') {header('Location: ?page=90');} ;
include_once "../library/inc.library.php";
include_once "../library/inc.pilihan.php";
include_once "../library/inc.tanggal.php";

require('../config/travel-config.php'); //Load DB(mysql) config parameter

$Travel= $_SESSION['Travel'];




?>

<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta charset="utf-8">
    <title>Umroh - Incentive</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="icon" sizes="192x192" href="../img/Icon.png"/>
    <!-- Glazzed & Bootstrap -->
    <link rel="stylesheet" type="text/css" href="../css/main.min.css">
    <!-- Pixeden Icon Fonts -->
    <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
    <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-stroke.css">



</head>
<body>
<style type="text/css">
    table, th, td {
 border: 1px solid black    ;
  padding-top: 12px;
  padding-left: 10px;
  padding-right: 10px;
  padding-bottom: 10px;
  border-radius: 5px;
    font-family: 'Raleway', sans-serif;
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
$pageSql = "SELECT jamaah_daftar.*, dokumen_super.pas_status, track_jamaah.packages_program, track_jamaah.kd_umroh, track_jamaah.depart
 FROM jamaah_daftar
  LEFT JOIN dokumen_super on jamaah_daftar.nomor_id=dokumen_super.id_dokumen
  LEFT JOIN track_jamaah on jamaah_daftar.nomor_id=track_jamaah.nomor_id
 WHERE packages_program='Incentive' ";
$pageQry = mysql_query($pageSql, $Link) or die ("error paging: ".mysql_error());
$jml   = mysql_num_rows($pageQry);
$max   = ceil($jml/$row);

// Jika tombol Cari diklik
if(isset($_POST['btnCari'])){
  if($_POST) {
    // Cari berdasarkan Nomor RM dan Nama Pasien yang mirip
    $txtKataKunci = $_POST['txtKataKunci'];
    $mySql = "SELECT jamaah_daftar.*, dokumen_super.pas_status, track_jamaah.packages_program, track_jamaah.kd_umroh, track_jamaah.depart
     FROM jamaah_daftar
     LEFT JOIN dokumen_super on jamaah_daftar.nomor_id=dokumen_super.id_dokumen
     LEFT JOIN track_jamaah on jamaah_daftar.nomor_id=track_jamaah.nomor_id
     WHERE  depart LIKE '%$txtKataKunci%' and packages_program='Incentive'
          ORDER BY nomor_id ASC LIMIT $hal, $row";
  }
}
else {
  $mySql = "SELECT jamaah_daftar.*, dokumen_super.pas_status, track_jamaah.packages_program, track_jamaah.kd_umroh, track_jamaah.depart
   FROM jamaah_daftar
   LEFT JOIN dokumen_super on jamaah_daftar.nomor_id=dokumen_super.id_dokumen
   LEFT JOIN track_jamaah on jamaah_daftar.nomor_id=track_jamaah.nomor_id
  WHERE packages_program='Incentive' ORDER BY nomor_id ASC LIMIT $hal, $row";
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
            <header class="main-header">
                <div class="main-header__nav">
                    <h1 class="main-header__title">
                        <i class="pe-7s-cloud-upload"></i>
                        <span>View Document </span>
                    </h1>
                    <ul class="main-header__breadcrumb">
                        <li><a href="?page=90" onclick="return false;"></a></li>

                    </ul>
                </div>


    <div class="row">

                    <div class="col-md-12">
                        <article class="widget">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1"  class="form-horizontal" role="form">

  <select name="txtKataKunci" bgcolor="blue" class="btn blue ">
                                <option value="ok">--Select The Departure Date--</option>
                               <?php
                               $bacaSql = "SELECT DISTINCT depart, packages_program FROM track_jamaah WHERE packages_program='Incentive'";
                               $bacaQry = mysql_query($bacaSql, $Link) or die ("Gagal Query".mysql_error());
                               while ($bacaData = mysql_fetch_array($bacaQry)) {
                               if ($bacaData['id_track'] == $dataKataKunci) {
                                 $cek = " selected";
                               } else { $cek=""; }

    echo "<option value='$bacaData[depart]' $cek>[ $bacaData[depart] ]   $bacaData[packages_program]  </option>";
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


    <div class="row">

    <div class="col-md-12">
    <article class="widget">

        <table width="100%" height="100%" >
        <thead id="grad1">
        <tr>
            <th style="text-align: center">No</th>
            <th style="width:5%text-align: center">Register ID</th>
            <th style="width:15% ; text-align: center">Name</th>
            <th style="text-align: center">Gender</th>
            <th style="text-align: center">Program</th>
            <th style="width:10% ; text-align: center">Depart</th>
            <th style="text-align: center">FOR</th>
            <th style="text-align: center">PAS</th>
            <th style="text-align: center">KK</th>
            <th style="text-align: center">NIK</th>
            <th style="text-align: center">FU</th>
            <th style="text-align: center">AKT</th>
            <th style="text-align: center">KUN</th>
            <th style="text-align: center">KTP</th>
            <th style="text-align: center">BKH</th>
            <th style="text-align: center">FH</th>
            <th colspan="2" style="text-align: center">Tool</th>
            </tr>
      </thead>
<?php
  // Query SQL ada di bagian atas, kolom tombol Cari (btnCari)
  $myQry = mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
  $nomor = 0;
  while ($myData = mysql_fetch_array($myQry)) {
    $nomor++;
    $Kode = $myData['nomor_id'];

    $pas_status = $myData['pas_status'];

    if ($pas_status=="Not mandatory") {
      $view="<span class='btn inverse green'>1 </span>";
  }
  if($pas_status=="Not yet submitted"){
  $view="<span class='btn inverse green'>2 </span>";

}
if($pas_status=="Documents submitted to representatives"){
$view="<span class='btn inverse green'>3 </span>";

}

if($pas_status=="Documents submitted to operational center"){
$view="<span class='btn inverse green'>5 </span>";

}






  ?>

        <tbody id="grad2">
        <tr>
        <td style="text-align: center"><?php echo $nomor; ?></td>
        <td style="text-align: center"><?php echo $myData['nomor_id']; ?></td>
        <td style="text-align: center"><?php echo $myData['first_name']; ?> <?php echo $myData['last_name']; ?> <?php echo $myData['surname']; ?></td>
        <td style="text-align: center"><?php echo $myData['gender']; ?></td>
        <td style="text-align: center"><?php echo $myData['packages_program']; ?></td>
        <td style="text-align: center"><?php echo IndonesiaTgl($myData['depart']); ?></td>
        <td style="text-align: center"><?php echo $view; ?></td>
         <td style="text-align: center"><?php echo $myData['pas_status']; ?></td>
          <td style="text-align: center"></td>
           <td style="text-align: center"></td>
           <td style="text-align: center"></td>
          <td style="text-align: center"></td>
           <td style="text-align: center"></td>
            <td style="text-align: center"></td>
          <td style="text-align: center"></td>
           <td style="text-align: center"></td>
        <td style="text-align: center"><center><a href="?page=Add_Document&NomorID=<?php echo $myData['nomor_id']; ?>" target="_self" alt="Edit Data" id=""  class='btn green btn-sm' title = "Input"><i class=" pe-7s-upload"></i></a>&nbsp;
        <td style="text-align: center"><center><a href="?page=Document_Personal_Berkah&NomorID=<?php echo $myData['nomor_id']; ?>" target="_self" alt="Edit Data" id=""  class='btn green btn-sm' title = "Detail"><i class=" pe-7s-user"></i></a>&nbsp;
      </center>
    </font> </td>
         </tr>
        <?php } ?>
         </tbody>
         </table>

<br>
<table style="width: 100%">
    <thead>

        <th>Legend</th>
        <th>Document Status</th>
        </tr>
         <tr>
        <th>FOR = Formulir Pendaftaran</th>
        <th><i class="btn-circle btn-sm inverse blue">1</i> = Not mandatory</th>
        </tr>
        <tr>
        <th>PAS = Passpor Asli</th>
        <th><i class="btn-circle btn-sm inverse red">2</i> = Not yet submitted</th>
        </tr>
        <tr>
        <th>KK = Kartu Keluarga</th>
        <th><i class="btn-circle btn-sm inverse yellow">3</i> = Documents submitted to representatives</th>
        </tr>
         <tr>
        <th>NIK = Buku Nikah</th>
        <th><i class="btn-circle btn-sm inverse green">4</i> = Documents submitted to the marketing department</th>
        </tr>
         <tr>
        <th>FU = Pas Photo Warna 4 x 6 =5 lembar </th>
        <th><i class="btn-circle btn-sm inverse violet">5</i> = Documents submitted to operational center</th>
        </tr>
         <tr>
        <th>AKT = Akte Kelahiran/ Izasah </th>
        <th><i class="btn-circle btn-sm inverse orange">6</i> = Documents submitted back to marketing department</th>
        </tr>
         <tr>
        <th>KUN = Kartu Kuning  </th>
        <th><i class="btn-circle btn-sm inverse ">7</i> = Documents are handed back to the representative center</th>
        </tr>
          <tr>
        <th>KTP = kartu Tanda Penduduk  </th>
        <th><i class="btn-circle btn-sm inverse ">8</i> = Documents are handed back to the representative center</th>
        </tr>

      <tr>
        <th>BKH = Bukti Kesehatan Haji  </th>
        <th></th>
        </tr>
        <tr>
        <th>FH = Pas Photo Warna 4 x 6 = 10 Lembar dan 3 x 4 = 40 Lembar  </th>
        <th></th>
        </tr>
    </thead>
</table>

                        </article><!-- /widget -->
                    </div>

                </div> <!-- /row -->


             </header> <!-- /main-header -->
            <footer class="footer-brand">
                    <?php include "footer.php"; ?>
            </footer>

        </section> <!-- /content -->

    <script src="http://d3js.org/d3.v3.min.js" language="JavaScript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/main.js"></script> <!-- Loading -->


</body>
</html>


<?php
if(isset($_SESSION["role"])) {
  exit;
}
else {
  echo "<meta http-equiv='refresh' content='0; url=../modul/logout.php'>";
}
?>
