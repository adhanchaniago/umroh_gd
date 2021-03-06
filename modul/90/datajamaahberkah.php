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
    <title>Umroh - Safwa</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="icon" sizes="192x192" href="../img/Icon.png"/>
    <!-- Glazzed & Bootstrap -->
    <link rel="stylesheet" type="text/css" href="../css/main.min.css">
    <!-- Pixeden Icon Fonts -->
    <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
    <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all">


    <!-- choosen plugin -->

             <link rel="stylesheet" href="../plugins/choosen/chosen.css"> 


</head>
<body>



<?php
# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT DISTINCT  jamaah_daftar.*,track_jamaah.kd_umroh,track_jamaah.packages_program
FROM jamaah_daftar
LEFT JOIN track_jamaah on jamaah_daftar.nomor_id=track_jamaah.nomor_id
WHERE packages_program='Safwa' ";
$pageQry = mysql_query($pageSql, $Link) or die ("error paging: ".mysql_error());
$jml   = mysql_num_rows($pageQry);
$max   = ceil($jml/$row);

// Jika tombol Cari diklik
if(isset($_POST['btnCari'])){
  if($_POST) {
    // Cari berdasarkan Nomor RM dan Nama Pasien yang mirip
    $txtKataKunci = $_POST['txtKataKunci'];
    $mySql = "SELECT DISTINCT  jamaah_daftar.*,track_jamaah.kd_umroh,track_jamaah.packages_program
    FROM jamaah_daftar
    LEFT JOIN track_jamaah on jamaah_daftar.nomor_id=track_jamaah.nomor_id
    WHERE  depart LIKE '%$txtKataKunci%' and packages_program='Safwa'
          ORDER BY nomor_id ASC LIMIT $hal, $row";
  }
}
else {
  $mySql = "SELECT DISTINCT  jamaah_daftar.*,track_jamaah.kd_umroh,track_jamaah.packages_program
  FROM jamaah_daftar
  LEFT JOIN track_jamaah on jamaah_daftar.nomor_id=track_jamaah.nomor_id
  WHERE packages_program='Safwa' ORDER BY nomor_id ASC LIMIT $hal, $row";
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
                        <i class="pe-7f-users"></i>
                        <span>Data Jamaah Safwa </span>
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
                                <option value="">--Select Depart--</option>
                               <?php
    $bacaSql = "SELECT DISTINCT depart, packages_program FROM track_jamaah WHERE packages_program='Safwa'";
    $bacaQry = mysql_query($bacaSql, $Link) or die ("Gagal Query".mysql_error());
    while ($bacaData = mysql_fetch_array($bacaQry)) {
    if ($bacaData['id_track'] == $dataKataKunci) {
      $cek = " selected";
    } else { $cek=""; }

    echo "<option value='$bacaData[depart]' $cek>[ $bacaData[depart] ]  $bacaData[packages_program]  </option>";
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

        <tr>
            <th>No</th>
            <th>Agent</th>
            <th>Nomor Id</th>
            <th>Title</th>
            <th>Jamaah Name</th>
            <th>Gender</th>
             <th>Tool</th>

            </tr>

<?php
  // Query SQL ada di bagian atas, kolom tombol Cari (btnCari)
  $myQry = mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
  $nomor = 0;
  while ($myData = mysql_fetch_array($myQry)) {
    $nomor++;
    $Kode = $myData['nomor_id'];
  ?>


        <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $myData['travel']; ?> (<?php echo $myData['petugas']; ?>)</td>
        <td><?php echo $myData['nomor_id']; ?></td>
        <td><?php echo $myData['title']; ?></td>
        <td><?php echo $myData['first_name']; ?>&nbsp;<?php echo $myData['last_name']; ?>&nbsp;<?php echo $myData['surname']; ?></td>
        <td><?php echo $myData['gender']; ?></td>
        <td style="text-align:center"> <a href="90/register_print.php?NomorJamaah=<?php echo $myData['nomor_id']; ?>" target="_self" alt="Detail Data" class='btn btn-xs btn-info ace-icon fa fa-eye ' title="Detail"> <i class="pe-7s-search" ></i></a>&nbsp;
        <a href="?page=edit_jamaah&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data"  class='btn btn-xs btn-success ace-icon fa fa-pencil bigger-120' title="Edit"><i class="pe-7s-edit" ></i></a>&nbsp;
           <a href="?page=Document_Personal_Safwa&NomorID=<?php echo $myData['nomor_id']; ?> " target="_self" alt="Detail Data" class='btn btn-xs btn-info ace-icon fa fa-eye bigger-120' title="Document"><i class="pe-7s-folder" ></i></a>&nbsp;
           <a href="?page=Equipment-Data90&NomorJamaah=<?php echo $myData['nomor_id']; ?>" target="_self" alt="Detail Data" class='btn btn-xs btn-info ace-icon fa fa-eye bigger-120' title="Equipment"><i class="pe-7s-portfolio" ></i></a>&nbsp;
           <a href="cetak/invoice_print.php?NomorJamaah=<?php echo $myData['nomor_id']; ?>" target="_self" alt="Detail Data" class='btn btn-xs btn-info ace-icon fa fa-eye bigger-120' title="Invoice"><i class="pe-7s-wallet" ></i></a>&nbsp;
           <a href="#" target="_self" alt="Cancel" class='btn btn-xs btn-info ace-icon fa fa-eye bigger-120' title="Cancel/Refund"><i class="pe-7s-refresh-2" ></i></a>&nbsp;

         </tr>


                <?php } ?>
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
            <a href='?page=DataJamaahSafwa&hal=$prev'>
            <i style='font-size:15px;' class='pe-7s-prev'></i>
            </a>";
            ?>
            </li>
        <li class="">
            <?php
            for ($h = 1; $h <= $max; $h++) {
                $list[$h] = $row * $h - $row;
                echo " <a href='?page=DataJamaahSafwa&hal=$list[$h]'>$h</a> ";
            }
            ?>
        </li>
        <li class="next">
                <?php
        echo "
            <a href='?page=DataJamaahSafwa&hal=$next'>
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
if(isset($_SESSION["Travel"])) {
  exit;
}
else {
  echo "<meta http-equiv='refresh' content='0; url=../modul/logout.php'>";
}
?>
