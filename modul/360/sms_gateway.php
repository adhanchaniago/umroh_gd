<!DOCTYPE html>

<?php
session_start();
if($_SESSION['FirstName'] == '360') {header('Location: ?page=360');} ;
include_once "../library/inc.library.php";
include_once "../library/inc.pilihan.php";
include_once "../library/inc.tanggal.php";

require('../config/travel-config.php'); //Load DB(mysql) config parameter

$Travel= $_SESSION['Travel'];




?>
<html>
<head>
	<title>Umroh - Website</title>
  	<link rel="icon" sizes="192x192" href="../img/Icon.png"/>
  	<!-- Glazzed & Bootstrap -->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/main.min.css">
	<!-- Pixeden Icon Fonts -->
	<link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
	<link rel="stylesheet" type="text/css" href="../css/pe-icon-7-stroke.css">
  <script src="../js/highcharts/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/heatmap.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>

  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>




</head>
<body>
	<div id="loading">
		<div class="loader loader-light loader-large"></div>
	</div>
	<!-- Calling Top Bar & Side Bar -->
	<?php include "menu.php"; ?>

	<!-- Content -->

	<style>


 </style>

<section class="content">

<header class="main-header">
                    <div class="main-header__nav">
                        <h1 class="main-header__title">
                     <i class="pe-7s-graph1"></i>
                    <span>SMS Performance</span>
                        </h1>
                    </div>
                </header>

                <div class ="row">
                <div class="col-md-12">
                            <article class="widget"><header class="widget__header">

                                </header>
                                <div class="widget__content widget__grid filled pad20" style="height:450px">
                                 <div id ="sms"></div>
                                </div>
                            </article>
                    </div>



                </div>
                <div class ="row">
                    <div class="col-md-6">
                            <article class="widget">
                               <header class="widget__header">
                                <div class="widget__title">
                                    <i class=""></i><H3>Deposit </H3>
                                </div>
                                <div class="widget__config">
                                    <a href="#"><i class=""></i></a>
                                    <a href="#"><i class=""></i></a>
                                </div>
                                </header>
                                <div class="widget__content widget__grid filled pad20"style="height:200px">

                                <br>
                                <div class ="col-xs-9">
                                <font Size = "3"> Previous balance </font><br><br>
                                 <font Size = "3"> Deposit balance </font><br><br>
                                 <font Size = "3"> Balance now /The remaining balance</font><br><br>
                                </div>

                                <div class ="col-xs-3"><center>
                                    <font Size = "3"><strong style="font-weight:bold"> 120 </strong></font><br><br>
                                    <font Size = "3"><strong style="font-weight:bold"> 500 </strong></font><br><br>
                                    <font Size = "3"><strong style="font-weight:bold"> 620 </strong> </font><br><br>
                                 </center>
                                </div>

                                </div>
                            </article>
                    </div>

                    <div class="col-md-6">
                            <article class="widget">
                               <header class="widget__header">
                                <div class="widget__title">
                                    <i class=""></i><h3>Sender ID</h3>
                                   </div>
                                <div class="widget__config">
                                    <a href="#"><i class=""></i></a>
                                    <a href="#"><i class=""></i></a>
                                </div>
                                </header>
                                <div class="widget__content widget__grid filled pad20"style="height:200px">

                                <br>
                                <div class ="col-xs-9">
                                <font Size = "3"> Arbatour </font><br><br>
                                </div>

                                <div class ="col-xs-3"><center>
                                    <font Size = "3"><strong style="font-weight:bold"> 1 </strong></font><br><br>
                                 </center>
                                </div>

                                </div>
                            </article>
                    </div>

                </div>




			<footer class="footer-brand">
					<?php include "footer.php"; ?>
			</footer>
		</section> <!-- /content -->

    <script type="text/javascript" src="../js/main.js"></script> <!-- Loading -->
    <script type="text/javascript" src="../js/amcharts/ammap.js"></script>

    <script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/dark.js"></script>
    <script src="https://www.amcharts.com/lib/3/pie.js"></script>

    <script type="text/javascript" src="../js/canvasjs/canvasjs.min.js"></script>
<script type="text/javascript" src="../js/sms/sms.js"></script>


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
