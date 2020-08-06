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
$pageSql = "SELECT * FROM user";
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
              <span>User Management</span>
              </h1>
             <ul class="main-header__breadcrumb">
              <li><a href ="#" onclick="window.location='#';">Home</a></li>
                 <a href ="?page=270" onclick="window.location='?page=270';">Management</a>
              </li>
               </ul>
           </div>

              <div class="main-header__pojok">
          <button onclick="window.location='?page=User_Add';">Add New</button>
             </div>
      </header>

<div class = "row">
          <div class="col-md-12">
            <article class="widget">
              <header class="widget__header">
                <div class="widget__title">
                  <i class="pe-7s-menu"></i><h3>User Data</h3>
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
                      <th>Travel Name</th>
                      <th>Name Employee</th>
                      <th width="10px" >Email</th>
                      <th width="10px" >Departement</th>
                      <th width="10px">Status</th>
                       <th >Expired Login</th>
                        <th>Edit</th>
                      <th>Del</th>
                    </tr>
                  </thead>


                  <tbody>

  <?php
  $mySql  = "SELECT * FROM user ORDER BY `UserID` ASC LIMIT $hal, $row";
  $myQry  = mysql_query($mySql, $Link)  or die ("Query  salah : ".mysql_error());
  $nomor  = 0;
  while ($myData = mysql_fetch_array($myQry)) {
    $nomor++;
    $Kode = $myData['UserID'];
  ?>
              <tr class="spacer"></tr>
              <tr>
              <td>
              <font><p> <?php echo $nomor; ?></p></font>      </td>

               <td>
                <p> <?php echo $myData['TravelName']; ?></p>
               </td>
                <td>
                <p><?php echo $myData['Salutation']; ?> <?php echo $myData['FirstName']; ?></p>
               </td>
                      <td>
                      <font><p><?php echo $myData['Email']; ?></p></font>
                      </td>
                       <td>
                      <font><p><?php echo $myData['RoleID']; ?></p></font>
                      </td>
                     <td>
                      <font><p><?php echo $myData['Status']; ?></p></font>
                      </td>
                      <td>
                      <font><p><?php echo $myData['ExpirationDate']; ?></p></font>
                      </td>
                       <td>
                     <a href="?page=User-Edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data"  title='Edit'><i class="pe-7s-note"></i></a>
                      </td>

                      <td>
                        <a href="?page=User_Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data"  onclick="return confirm('ARE YOU SURE TO DELETE THIS DATA ... ?')" title='Delete'><i class="pe-7s-close"></i></a>


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
      <a href='?page=User&hal=$prev'>
      <i class='pe-7s-prev'></i>
      </a>";
      ?>
      </li>
    <li class="" >
      <?php
      for ($h = 1; $h <= $max; $h++) {
        $list[$h] = $row * $h - $row;
        echo " <a href='?page=User&hal=$list[$h]'>$h</a> ";
      }
      ?>
    </li>
    <li class="next">
        <?php
    echo "
      <a href='?page=User&hal=$next'>
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
