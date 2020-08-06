<!DOCTYPE html>

<?php
session_start();
if($_SESSION['FirstName'] == '90') {header('Location: ?page=90');} ;
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
  background:  #335dfa; /* For Safari 5.1 to 6.0 */
}

#grad2 {
                height: 50px;
                background:  #fff; /* For Safari 5.1 to 6.0 */


}

</style>


<?php
# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 10;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM paket_umroh WHERE nama_paket='Incentive' ";
$pageQry = mysql_query($pageSql, $Link) or die ("error paging: ".mysql_error());
$jml   = mysql_num_rows($pageQry);
$max   = ceil($jml/$row);

// Jika tombol Cari diklik
if(isset($_POST['btnCari'])){
  if($_POST) {
    // Cari berdasarkan Nomor RM dan Nama Pasien yang mirip
    $txtKataKunci = $_POST['txtKataKunci'];
    $mySql = "SELECT * FROM paket_umroh WHERE  depart_umroh LIKE '%$txtKataKunci%'
          ORDER BY kd_umroh ASC LIMIT $hal, $row";
  }
}
else {
  $mySql = "SELECT * FROM paket_umroh WHERE nama_paket='Incentive' ORDER BY kd_umroh ASC LIMIT $hal, $row";
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
                        <i class="pe-7f-plane"></i>
                        <span>Booking Online </span>
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
    $bacaSql = "SELECT distinct * FROM paket_umroh WHERE nama_paket='Incentive'";
    $bacaQry = mysql_query($bacaSql, $Link) or die ("Gagal Query".mysql_error());
    while ($bacaData = mysql_fetch_array($bacaQry)) {
    if ($bacaData['kd_umroh'] == $dataType) {
      $cek = " selected";
    } else { $cek=""; }

    echo "<option value='$bacaData[depart_umroh]' $cek>[ $bacaData[depart_umroh] ]   $bacaData[nama_paket] $bacaData[desc_umroh]  </option>";
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
            <th style="text-align: center">Packages</th>
            <th style="text-align: center">Departure</th>
            <th style="text-align: center">Arrival</th>
            <th style="text-align: center">Day</th>
            <th style="text-align: center">Quota</th>
            <th style="text-align: center">Register</th>
            <th style="text-align: center">Status</th>
            <th style="text-align: center">Tool</th>
            </tr>
      </thead>
<?php
  // Query SQL ada di bagian atas, kolom tombol Cari (btnCari)
  $myQry = mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
  $nomor = 0;
  while ($myData = mysql_fetch_array($myQry)) {
    $nomor++;
    $Kode = $myData['kd_umroh'];
    $Paket = $myData['kuota'];


    //arrival
        $tgl = $myData['depart_umroh'];
        $hari = $myData['hari_umroh'];
        $min = 1;
        $lw = ($hari-$min);
        $pt = explode('-', $tgl);
        $t = $pt[2];
        $b = $pt[1];
        $th = $pt[0];
        $a = GregorianToJD($b, $t, $th);
        $b = JDToGregorian($a+$lw);
        $newtgl = $b;


        $dataArrival = date('d F Y', strtotime($newtgl ));


      if ($Paket >=16) {
        $view="<span class='btn inverse green'>Open </span>";
    }
        $Kuota1=15;
        $Kuota2=8;
    if ($Paket <=$Kuota1 and $Kuota2) {
        $view="<span class='btn inverse yellow'>Open</span>";
    }
      if ($Paket <=8) {
        $view="<span class='btn inverse red'>Limited quota</span>";
    }


    if ($Paket =0) {
      $view="<span class='btn inverse red'>Close</span>";
  }

  // data untuk selisih tanggal
      $date1 = $myData['depart_umroh'];
         $date2 = date('d-m-Y');
         $selisih = ((strtotime ($date1) - strtotime ($date2))/(60*60*24));




  ?>

        <tbody id="grad2">
        <tr>
        <td style="text-align: center"><?php echo $nomor; ?></td>
        <td style="text-align: center"><?php echo $myData['nama_paket']; ?> <?php echo $myData['desc_umroh']; ?></td>
        <td style="text-align: center"><?php echo IndonesiaTgl($myData['depart_umroh']); ?></td>
        <td style="text-align: center"><?php echo $dataArrival; ?></td>
        <td style="text-align: center"><?php echo $myData['hari_umroh']; ?></td>
        <td style="text-align: center"><?php echo $myData['kuota']; ?></td>
        <td style="text-align: center"><?php echo $myData['daftar']; ?></td>
        <td style="text-align: center; width: 20%"><?php echo $view; ?> <?php echo $selisih; ?> Day</td>
        <td style="text-align: center"><center><font><a href="?page=input_jamaah&NomorUmroh=<?php echo $myData['kd_umroh']; ?>" target="_self" alt="Edit Data" id="kuota"  class='btn green btn-sm' title = "Booking"><i class=" pe-7s-upload"></i></a>&nbsp;
      <a href='modul/<?php echo $myData['itinenary']; ?>' target='_blank' class='btn green btn-sm' title="Itinenary"> <i class=" pe-7s-plane"></i></a>&nbsp;
        <a onclick="window.location.href='?page=Waiting&NomorUmroh=<?php echo $myData['kd_umroh']; ?>'"   target="_self" alt="Edit Data" id="kuota"  class='btn green btn-sm' title="Waiting List"> <i class=" pe-7s-note2"></i></a>&nbsp;
 <a onclick="window.location.href='?page=Detail-Umroh&NomorUmroh=<?php echo $myData['kd_umroh']; ?>'"  target="_self" alt="Detail umroh" id=""  class='btn green btn-sm' title="Detail"> <i class=" pe-7s-look"></i></a>&nbsp;</center>
 </center>
    </font> </td>
         </tr>
        <?php } ?>
         </tbody>
         </table>

            <ul class="pagination pull-left no-margin">
<li class="" >
<strong style="font-weight: bold;">Total Records :</strong>
                                <?php echo $jml; ?>
</ul>

<?php

        $prev = $hal - $row;
        if ($prev <= -$row) { $prev = 0;}
        $next = $hal + $row;
        $Selisih = $jml - $row;
        if ($Selisih <= 0) {$Selisih = 0;}

        if ($next >= $jml) { $next =  $Selisih;}
?>

        <ul class="pagination pull-right no-margin">
            <li class="prev">
        <?php
        echo "
            <a href='?page=Super_Saver&hal=$prev'>
            <i style='font-size:15px;' class='pe-7s-prev'></i>
            </a>";
            ?>
            </li>
        <li class="">
            <?php
            for ($h = 1; $h <= $max; $h++) {
                $list[$h] = $row * $h - $row;
                echo " <a href='?page=Super_Saver&hal=$list[$h]'>$h</a> ";
            }
            ?>
        </li>
        <li class="next">
                <?php
        echo "
            <a href='?page=Super_Saver&hal=$next'>
            <i style='font-size:15px;' class='pe-7s-next'></i>
            </a>";
            ?>
        </li>
            </ul>

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
