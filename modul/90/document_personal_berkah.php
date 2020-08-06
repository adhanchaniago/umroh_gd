<!DOCTYPE html>

<?php
session_start();
// if($_SESSION['FirstName'] == '90') {header('Location: ?page=90');} ;
include_once "../library/inc.library.php";
include_once "../library/inc.pilihan.php";
include_once "../library/inc.tanggal.php";

require('../config/travel-config.php'); //Load DB(mysql) config parameter

$Travel= $_SESSION['Travel'];

if($_GET) {

	// Perintah membaca data Pasien
  $NomorID= isset($_GET['NomorID']) ?  $_GET['NomorID'] : '';
  $mySql  = "SELECT * FROM dokumen_super WHERE nomor_id='$NomorID'";
  $myQry  = mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
  $myData = mysql_fetch_array($myQry);


}else {
	echo "Nomor ID Jamaah Tidak Terbaca";
	exit;
}

$Kode = $myData['nomor_id'];
$dataNomorID  = $myData['nomor_id'];

# Kode Umroh
if($NomorID=="") {
  $NomorID= isset($_POST['nomor_id']) ? $_POST['nomor_id'] : '';
}





?>

<html>
<head>
	<title>Umroh - Document</title>
  	<link rel="icon" sizes="192x192" href="../img/Icon.png"/>
  	<!-- Glazzed & Bootstrap -->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/main.min.css">
	<!-- Pixeden Icon Fonts -->
	<link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
	<link rel="stylesheet" type="text/css" href="../css/pe-icon-7-stroke.css">


</head>
<body>
	<div id="loading">
		<div class="loader loader-light loader-large"></div>
	</div>
	<!-- Calling Top Bar & Side Bar -->
	<?php include "menu.php"; ?>

	<!-- Content -->

	<style>



  table{
    width: 100%
  }


  th, td {

  		height: 20px;
  		padding: 10px;

      border-collapse: collapse;
  	border-radius: 0px;
  }
  tr:nth-child(even) {
      background-color:rgba(0,0,0,.3);
  }

  th, td {
  	  border-bottom: 1px solid black;
  }

 </style>

<section class="content">

<header class="main-header">
                    <div class="main-header__nav">
                        <h1 class="main-header__title">
                     <i class="pe-7s-graph1"></i>
                    <span>Document : <?php echo $myData['name_customer']; ?></span>
                        </h1>
                    </div>
                </header>

                <div class ="row">
                <div class="col-md-3">
                            <article class="widget"><header class="widget__header">
                                <div class="widget__title">
                                    <i class=""></i><H3>Pas Foto</H3>
                                </div>
                                <div class="widget__config">
                                    <a href="#"><i class="">status</i></a>
                                    <a href="#"><i class=""></i></a>
                                </div>
                                </header>
                                <div class="widget__content widget__grid filled pad20" style="height:200px">
                                 <div id ="">  <a href='modul/<?php echo $myData['fu_image']; ?>' target='_blank'  title="Pas Foto">
                                 <img src="modul/<?php echo $myData['fu_image']; ?> "  height="160px"; style="padding-top:3px ;padding-left:10px";/></a>&nbsp;</div>
                                </div>
                            </article>
                    </div>

                    <div class="col-md-3">
                            <article class="widget">
                               <header class="widget__header">
                                <div class="widget__title">
                                    <i class=""></i><H3>Passpor</H3>
                                </div>
                                <div class="widget__config">
                                    <a href="#"><i class=""></i></a>
                                    <a href="#"><i class=""></i></a>
                                </div>
                                </header>
                                <div class="widget__content widget__grid filled pad20"style="height:200px">
                                  <div id ="">  <a href='modul/<?php echo $myData['pas_image']; ?>' target='_blank'  title="Pas Foto">
                                  <img src="modul/<?php echo $myData['pas_image']; ?> "  height="160px"; style="padding-top:3px ;padding-left:10px";/></a>&nbsp;</div>
                                </div>
                            </article>
                    </div>

                    <div class="col-md-6">
                            <article class="widget">
                               <header class="widget__header">
                                <div class="widget__title">
                                    <i class=""></i><H3>Detail Jamaah</H3>
                                </div>
                                <div class="widget__config">
                                    <a href="#"><i class=""></i></a>
                                    <a href="#"><i class=""></i></a>
                                </div>
                                </header>
                                <div class="widget__content widget__grid filled pad20"style="height:200px">

                                    <div id=""><?php echo $myData['name_customer']; ?></div> <br>
                                      <div id=""><?php echo $myData['nomor_id']; ?></div>
                                </div>
                            </article>
                    </div>



                </div>
                <div class ="row">
    							<div class="col-md-4 ">
    								      <article class="widget">
    						<div class="" style="background-color:rgba(0,0,0,.4);">
    							<table class=" ">
    								<thead style="">
    									<tr>
    										<th colspan="3" style="background-color:rgba(0,0,0,.7);"> <p class="lucida">Document </p> </th>
    									</tr>
    										</thead>
    <tr class="spacer" ></tr>
    											<tbody >
    									<tr>
    										<td width=""><p font-weight="bold" class="lucida">Document Name</p></td>
    										<td width=""  align="center" colspan="2"><p font-weight="bold" class="lucida">Link</p></td>
    									</tr>

    									<tr>
    										<td><p class="content1">Passpor</p></td>
    										<td  align="center" colspan="2"><p class="content1"><a href='modul/<?php echo $myData['pas_image']; ?>' target='_blank'  title="Pas Foto" >
                        Data</a></p></td>


    									</tr>

                      <tr>
    										<td><p class="content1">KK</p></td>
    										<td  align="center" colspan="2"><p class="content1"><a href='modul/<?php echo $myData['kk_image']; ?>' target='_blank'  title="Pas Foto">
                        Data</a></p></td>


    									</tr>

                      <tr>
    										<td><p class="content1">Buku Nikah</p></td>
    										<td  align="center" colspan="2"><p class="content1"><a href='modul/<?php echo $myData['nik_image']; ?>' target='_blank'  title="Pas Foto">
                        Data</a></p></td>


    									</tr>

                      <tr>
                        <td><p class="content1">Akte</p></td>
                        <td  align="center" colspan="2"><p class="content1"><a href='modul/<?php echo $myData['akt_image']; ?>' target='_blank'  title="Pas Foto">
                        Data</a></p></td>


                      </tr>

                      <tr>
                        <td><p class="content1">Kartu Kuning</p></td>
                        <td  align="center" colspan="2"><p class="content1"><a href='modul/<?php echo $myData['kun_image']; ?>' target='_blank'  title="Pas Foto">
                        Data</a></p></td>


                      </tr>

                      <tr>
                        <td><p class="content1">Bukti Kesehatan Haji</p></td>
                        <td  align="center" colspan="2"><p class="content1"><a href='modul/<?php echo $myData['bkh_image']; ?>' target='_blank'  title="Pas Foto">
                        Data</a></p></td>


                      </tr>
    </tbody>
    							</table>
    						</div>
    					</article>
    						</div>


    							<div class="col-md-8">
    								      <article class="widget">
    						<div class="" style="background-color:rgba(0,0,0,.4);">
    							<table class=" ">
    								<thead style="">
    									<tr>
    										<th colspan="3" style="background-color:rgba(0,0,0,.7);"> <p class="lucida">Status Document</p> </th>
    									</tr>
    										</thead>
    <tr class="spacer" ></tr>
    											<tbody >
    									<tr>
    										<td width=""><p font-weight="bold" class="lucida">Document Name</p></td>
    										<td width=""  align="center" colspan="2"><p font-weight="bold" class="lucida">Status</p></td>
    									</tr>



    									<tr>

    										<td><p class="content1">Passpor</p></td>
    										<td  align="center" colspan="2"><p class="content1"><?php echo $myData['pas_status']; ?></p></td>

    									</tr>

                      <tr>

    										<td><p class="content1">KK</p></td>
    										<td  align="center" colspan="2"><p class="content1"><?php echo $myData['kk_status']; ?></p></td>

    									</tr>

                      <tr>

    										<td><p class="content1">Buku Nikah</p></td>
    										<td  align="center" colspan="2"><p class="content1"><?php echo $myData['nik_status']; ?></p></td>

    									</tr>

                      <tr>

                        <td><p class="content1">Akte</p></td>
                        <td  align="center" colspan="2"><p class="content1"><?php echo $myData['akt_status']; ?></p></td>

                      </tr>

                      <tr>

                        <td><p class="content1">kartu Kuning</p></td>
                        <td  align="center" colspan="2"><p class="content1"><?php echo $myData['kun_status']; ?></p></td>

                      </tr>

                      <tr>

                        <td><p class="content1">Bukti Kesehatan Haji</p></td>
                        <td  align="center" colspan="2"><p class="content1"><?php echo $myData['bkh_status']; ?></p></td>

                      </tr>

                      <tr>

                        <td><p class="content1">KTP</p></td>
                        <td  align="center" colspan="2"><p class="content1"><?php echo $myData['ktp_status']; ?></p></td>

                      </tr>

                      <tr>

                        <td><p class="content1">Pas Foto</p></td>
                        <td  align="center" colspan="2"><p class="content1"><?php echo $myData['fu_status']; ?></p></td>

                      </tr>


    </tbody>
    							</table>
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
