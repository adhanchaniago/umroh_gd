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
    <title>Roomlist Management</title>
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
                    <i class="pe-7s-cloud"></i>
                <span>Select The Packages for Mahrom </span>
                </h1>

             </div>
            </header>
<br><br><br>
<div class = "row">
                <div class ="col-md-2"></div>
                    <div class="col-md-10">
                        <article class="widget">
                            <div class ="row">
                    <div class ="col-md-3">
                    <a href="?page=ReportMahrom_Berkah" target="_self"><img src="../img/1night.png" alt="user" width="180" class="img-responsive center-block"></a>  <br>
                    <center><font size ="5">Berkah </font><br><br>
                   </center>
                </div>

                <div class ="col-md-3">
                     <a href="?page=ReportMahrom_Rahmah" target="_self"><img src="../img/2night.png" alt="user" width="180" class="img-responsive center-block"></a><br>
                    <center><font size ="5">Rahmah </font><br><br></center>
                </div>

                <div class ="col-md-3">
                    <a href="?page=ReportMahrom_Incentive" target="_self"><img src="../img/3night.png" alt="user" width="180" class="img-responsive center-block"></a><br>
                    <center><font size="5">Incentive </font><br><br>
                 </center>
                </div>


            </div>
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
