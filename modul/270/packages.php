<!DOCTYPE html>

<?php
session_start();
if($_SESSION['FirstName'] == '270') {header('Location: ?page=270');} ;
include_once "../library/inc.library.php";
include_once "../library/inc.pilihan.php";
include_once "../library/inc.tanggal.php";

require('../config/travel-config.php'); //Load DB(mysql) config parameter

$Travel= $_SESSION['Travel'];


# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 10;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM paket_umroh";
$pageQry = mysql_query($pageSql, $Link) or die ("error paging: ".mysql_error());
$jml   = mysql_num_rows($pageQry);
$max   = ceil($jml/$row);
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
              <span>packages Management</span>
              </h1>
             <ul class="main-header__breadcrumb">
              <li><a href ="#" onclick="window.location='#';">Home</a></li>
                 <a href ="?page=270" onclick="window.location='?page=270';">Management</a>
              </li>
               </ul>
           </div>

              <div class="main-header__pojok">
          <button onclick="window.location='?page=Packages_Add';">Add New</button>
             </div>
      </header>

<div class = "row">
          <div class="col-md-12">
            <article class="widget">
              <header class="widget__header">
                <div class="widget__title">
                  <i class="pe-7s-menu"></i><h3>Packages</h3>
                </div>
                <div class="widget__config">
                  <a href="#"><i class=""></i></a>
                  <a href="#"><i class=""></i></a>
                </div>
              </header>

              <div class="widget__content ">

                <table class="table table-striped media-table" style="width: 100%" >
                  <thead>
                    <tr>
                      <th style="width:1px">No </th>
                      <th width="">Packages</th>
                      <th width="">Price </th>
                      <th >Depart</th>
                      <th >Plane</th>
                      <th width="70px">Hotel Mecca</th>
                      <th width="70px">Hotel Madinah</th>
                      <th width="10px">Quota</th>
                      <th width="10px">Register</th>
                        <th width="30px">Itinenary</th>
                      <th>Tool</th>

                    </tr>
                  </thead>


                  <tbody>

  <?php
  $mySql  = "SELECT * FROM paket_umroh ORDER BY `kd_umroh` ASC LIMIT $hal, $row";
  $myQry  = mysql_query($mySql, $Link)  or die ("Query  salah : ".mysql_error());
  $nomor  = 0;
  while ($myData = mysql_fetch_array($myQry)) {
    $nomor++;
    $Kode = $myData['kd_umroh'];
  ?>
              <tr class="spacer"></tr>
              <tr>
              <td>
              <font><p> <?php echo $nomor; ?></p></font>
                </td>

               <td>
                <p> <?php echo $myData['nama_paket']; ?></p>
                 <p> <?php echo $myData['desc_umroh']; ?></p>
               </td>
                <td>
              <p>  Quad <?php echo $myData['currency']; ?> <?php  echo format_angka($myData['harga_umroh']); ?></p><hr>
                  <p>  Triple <?php echo $myData['currency']; ?> <?php  echo format_angka($myData['harga_triple']); ?></p><hr>
                  <p>Double <?php echo $myData['currency']; ?> <?php  echo format_angka($myData['harga_double']); ?></p>
               </td>
                      <td>
                      <font><p><?php echo IndonesiaTgl($myData['depart_umroh']); ?></p></font>
                      </td>
                       <td>
                      <font><p><?php echo $myData['pesawat_umroh']; ?></p></font>
                      </td>
                      <td>
                      <font><p><?php echo $myData['hotel_umroh_mekkah']; ?></p></font>
                      </td>
                      <td>
                      <font><p><?php echo $myData['hotel_umroh_madinah']; ?></p></font>
                      </td>
                     <td>
                      <font><p><?php echo $myData['kuota']; ?></p></font>
                      </td>
                    <td>
                      <font><p><?php echo $myData['daftar']; ?></p></font>
                      </td>
                      <td>
                        <font><a href='modul/<?php echo $myData['itinenary']; ?>' target='_blank' class='btn green btn-sm' title="itinenary"><i class=" pe-7s-plane"></i></a></p></font>
                        </td>


                      <td>
                        <a href="?page=Packages_Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data"  onclick="return confirm('ARE YOU SURE TO DELETE THIS DATA ... ?')"  class='btn green btn-sm' title='Delete'><i class="pe-7s-close"></i></a>
                        <a href="?page=Packages_Edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data"  onclick="return confirm('ARE YOU SURE TO EDIT THIS DATA ... ?')"  class='btn green btn-sm' title='Edit'><i class="pe-7s-tools"></i></a>
 <a onclick="window.location.href='?page=Detail-Umroh&NomorUmroh=<?php echo $myData['kd_umroh']; ?>'"  target="_blank" alt="Detail umroh" id=""  class='btn green btn-sm' title="Detail"> <i class=" pe-7s-look"></i></a>&nbsp;</center>
                      </td>
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
      <a href='?page=Packages&hal=$prev'>
      <i class='pe-7s-prev'></i>
      </a>";
      ?>
      </li>
    <li class="" >
      <?php
      for ($h = 1; $h <= $max; $h++) {
        $list[$h] = $row * $h - $row;
        echo " <a href='?page=Packages&hal=$list[$h]'>$h</a> ";
      }
      ?>
    </li>
    <li class="next">
        <?php
    echo "
      <a href='?page=Packages&hal=$next'>
      <i class='pe-7s-next'></i>
      </a>";
      ?>
    </li>
      </ul>




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
</html>

<?php
if(isset($_SESSION["role"])) {
  exit;
}
else {
  echo "<meta http-equiv='refresh' content='0; url=../modul/logout.php'>";
}
?>
