<!DOCTYPE html>

<?php
session_start();
if($_SESSION['FirstName'] == '270') {header('Location: ?page=270');} ;
include_once "../library/inc.library.php";
include_once "../library/inc.pilihan.php";
include_once "../library/inc.tanggal.php";

require('../config/travel-config.php'); //Load DB(mysql) config parameter




# MENGAMBIL DATA YANG DIEDIT, SESUAI KODE YANG DIDAPAT DARI URL
$Kode	= isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['txtKode'];
$mySql	= "SELECT * FROM paket_umroh WHERE kd_umroh='$Kode'";
$myQry	= mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);


	# MASUKKAN DATA DARI FORM KE VARIABEL TEMPORARY (SEMENTARA)
	$dataKode	= $myData['kd_umroh'];
	$dataPackages_Name	= isset($_POST['Packages_Name']) ? $_POST['Packages_Name'] : $myData['nama_paket'];
	$dataDay_Umroh= isset($_POST['Day_Umroh']) ? $_POST['Day_Umroh'] : $myData['hari_umroh'];
	$dataDeparture = isset($_POST['Departure']) ? $_POST['Departure'] : $myData['depart_umroh'];
	$dataHotel_Mecca= isset($_POST['Hotel_Mecca']) ? $_POST['Hotel_Mecca'] : $myData['hotel_umroh_mekkah'];
	$dataHotel_Madinah	= isset($_POST['Hotel_Madinah']) ? $_POST['Hotel_Madinah'] : $myData['hotel_umroh_madinah'];
	$dataPlane	= isset($_POST['Plane']) ? $_POST['Plane'] : $myData['pesawat_umroh'];
	$dataPrice_Umroh	= isset($_POST['Price_Umroh']) ? $_POST['Price_Umroh'] : $myData['harga_umroh'];
  $dataPrice_Triple	= isset($_POST['Price_Triple']) ? $_POST['Price_Triple'] : $myData['harga_triple'];
  $dataPrice_Double	= isset($_POST['Price_Double']) ? $_POST['Price_Double'] : $myData['harga_double'];
  $dataPrice_Equipment	= isset($_POST['Price_Equipment']) ? $_POST['Price_Equipment'] : $myData['harga_perlengkapan'];
  $dataCurrency = isset($_POST['Currency']) ? $_POST['Currency'] : $myData['currency'];
  $dataQuota	= isset($_POST['Quota']) ? $_POST['Quota'] : $myData['kuota'];
  $datadesc_umroh= isset($_POST['desc_umroh']) ? $_POST['desc_umroh'] : $myData['desc_umroh'];
	  $dataeditor1= isset($_POST['editor1']) ? $_POST['editor1'] : $myData['keterangan'];
 $dataDoc_Itinenary	= isset($_POST['itinenary']) ? $_POST['itinenary'] : $myData['itinenary'];

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

		<script src="//cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>

<style>
     .push-to-bottom {
        position: absolute;
        bottom: 30px;
        width: 100%;
      }

        .widget__form input[type=number] {
    display: inline-block;
    width: 100%;
    border: none;
    height: 35px;
    vertical-align: top;
    background-color: rgb(76, 76, 76);
    margin: 1px 0 0;
    padding-left: 24px;
    font-weight: 100;
    color: #fff;
}
.widget__form input[type=text] {
    display: inline-block;
    width: 100%;
    border: none;
    height: 35px;
    vertical-align: top;
    background-color: rgb(76, 76, 76);
    margin: 1px 0 0;
    padding-left: 24px;
    font-weight: 100;
    color: #fff;
}
.widget__form input[type=date] {
    display: inline-block;
    width: 100%;
    border: none;
    height: 35px;
    vertical-align: top;
    background-color: rgb(76, 76, 76);
    margin: 1px 0 0;
    padding-left: 24px;
    font-weight: 100;
    color: #fff;
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


      </header>

<div class = "row">


             <div class="row">

          <div class="col-md-12">
            <article class="widget">
              <header class="widget__header">
                <div class="widget__title">
                  <i class="pe-7s-menu"></i><h3>Add New Packages</h3>
                </div>
                <div class="widget__config">
                  <a href="#"><i class="pe-7f-refresh"></i></a>
                  <a href="#"><i class="pe-7s-close"></i></a>
                </div>
              </header>
            <form action="../modul/proses/proses_edit_paket.php"  method="post" target="_self" enctype ="multipart/form-data">
              <div class="widget__content table-responsive">

                <table class="table table-striped media-table">
                  <thead>
                    <tr>
                      <th width="270">Description</th>
                      <th>Post Info</th>
                      <th>Required</th>
                    </tr>
                  </thead>
                  <tbody class="widget widget__form">


                    <tr class="spacer"></tr>
                    <tr>
                      <td>
                        <div class="media">
                          <div class="media-body post_desc">
                            <h3>Packages Name</h3>
                          </div>
                        </div>
                      </td>
                      <td >
                        <select name="Packages_Name" required class="form-control col-xs-10 col-sm-5" style=" height: 35px; width: 20%" >
                                  <option value="<?php echo $dataPackages_Name; ?>"> <?php echo $dataPackages_Name; ?></option>
                                   <option value="Berkah">Berkah</option>
                                   <option value="Rahmah">Rahmah</option>
                                   <option value="Incentive">Incentive</option>
                            </select>
 <input name="desc_umroh" type="text"  class="stacked-input" value="<?php echo $datadesc_umroh; ?>"  id="input-1" placeholder="Desc Umroh"  style="width:80%">
                      </td>
                      <td>
                        <a href="#" onclick="return false;" class="post__del"><i class="pe-7f-check"></i></a>
                      </td>
                    </tr>

                    <tr class="spacer"></tr>
                    <tr>
                      <td>
                        <div class="media">
                          <div class="media-body post_desc">
                            <h3>Day Umroh</h3>
                          </div>
                        </div>
                      </td>
                      <td>
                       <input name="Day_Umroh" type="number"  class="stacked-input" value="<?php echo $dataDay_Umroh; ?>"  id="input-1" placeholder="Day Umroh" required>
                      </td>
                      <td>
                       <a href="#" onclick="return false;" class="post__del"><i class="pe-7f-check"></i></a>
                      </td>
                    </tr>

                    <tr class="spacer"></tr>
                    <tr>
                      <td>
                        <div class="media">
                          <div class="media-body post_desc">
                            <h3>Departure</h3>
                          </div>
                        </div>
                      </td>
                      <td>
                      <input name="Departure" type="date"  class="stacked-input" value="<?php echo $dataDeparture ?>"  id="input-1" placeholder="Departure" required>
                      </td>
                      <td>
                        <a href="#" onclick="return false;" class="post__del"><i class="pe-7f-check"></i></a>
                      </td>
                    </tr>

                      <tr class="spacer"></tr>
                    <tr>
                      <td>
                        <div class="media">
                          <div class="media-body post_desc">
                            <h3>Hotel Mecca</h3>
                          </div>
                        </div>
                      </td>
                      <td>
                       <input name="Hotel_Mecca" type="text"  class="stacked-input" value="<?php echo $dataHotel_Mecca; ?>"  id="input-1" placeholder="Hotel Mecca" required>
                      </td>
                      <td>
                        <a href="#" onclick="return false;" class="post__del"><i class="pe-7f-check"></i></a>
                      </td>
                    </tr>

                      <tr class="spacer"></tr>
                    <tr>
                      <td>
                        <div class="media">
                          <div class="media-body post_desc">
                            <h3>Hotel madinah</h3>
                          </div>
                        </div>
                      </td>
                      <td>
                        <input name="Hotel_Madinah" type="text"  class="stacked-input" value="<?php echo $dataHotel_Madinah; ?>"  id="input-1" placeholder="Hotel Madinah" required>
                      </td>
                      <td>
                       <a href="#" onclick="return false;" class="post__del"><i class="pe-7f-check"></i></a>
                      </td>
                    </tr>

                      <tr class="spacer"></tr>
                    <tr>
                      <td>
                        <div class="media">
                          <div class="media-body post_desc">
                            <h3>Plane</h3>
                          </div>
                        </div>
                      </td>
                      <td>
                       <input name="Plane" type="text"  class="stacked-input" value="<?php echo $dataPlane; ?>"  id="input-1" placeholder="Plane" required>
                      </td>
                      <td>
                        <a href="#" onclick="return false;" class="post__del"><i class="pe-7f-check"></i></a>
                      </td>
                    </tr>



                      <tr class="spacer"></tr>
                    <tr>
                      <td>
                        <div class="media">
                          <div class="media-body post_desc">
                            <h3>Price Umroh (USD/IDR) / Example : 25000000</h3>
                          </div>
                        </div>
                      </td>
                      <td>
                        <select name="Currency" required class="form-control col-xs-10 col-sm-5" style=" height: 35px; width: 80%" >
                                  <option value="<?php echo "$dataCurrency";?>"> <?php echo "$dataCurrency";?></option>
                                   <option value="IDR">IDR</option>
                                   <option value="USD">USD</option>
                            </select>
                       <input name="Price_Umroh" type="number"  class="stacked-input" value="<?php echo $dataPrice_Umroh; ?>"  id="input-1" placeholder="Price Umroh Quad" style="width:80%" required>
                       <input name="Price_Double" type="number"  class="stacked-input" value="<?php echo $dataPrice_Double; ?>"  id="input-2" placeholder="Price Umroh Double" style="width:80%" required>
                      <input name="Price_Triple" type="number"  class="stacked-input" value="<?php echo $dataPrice_Triple; ?>"  id="input-3" placeholder="Price Umroh Triple" style="width:80%" required>
                      </td>
                      <td>
                         <a href="#" onclick="return false;" class="post__del"><i class="pe-7f-check"></i></a>
                      </td>
                    </tr>





                      <tr class="spacer"></tr>
                    <tr>
                      <td>
                        <div class="media">
                          <div class="media-body post_desc">
                            <h3>Price Equipment (IDR) / Example : 1250000</h3>
                          </div>
                        </div>
                      </td>
                      <td>
                        <input name="Price_Equipment" type="number"  class="stacked-input" value="<?php echo $dataPrice_Equipment; ?>"  id="input-1" placeholder="Price Equipment" required>
                      </td>
                      <td>
                        <a href="#" onclick="return false;" class="post__del"><i class="pe-7f-check"></i></a>
                      </td>
                    </tr>
                      <tr class="spacer"></tr>
                    <tr>
                      <td>
                        <div class="media">
                          <div class="media-body post_desc">
                            <h3>Quota</h3>
                          </div>
                        </div>
                      </td>
                      <td>
                       <input name="Quota" type="number"  class="stacked-input" value="<?php echo $dataQuota; ?>"  id="input-1" placeholder="Quota" required/>
                      </td>
                      <td>
                        <a href="#" onclick="return false;" class="post__del"><i class="pe-7f-check"></i></a>
                      </td>
                    </tr>
                    <tr class="spacer"></tr>
                    <tr>
                      <td>
                        <div class="media">
                          <div class="media-body post_desc">
                            <h3>Input File Itinenary</h3>
                          </div>
                        </div>
                      </td>
                      <td>

<input name="nama_file" type="file" id="nama_file" size="30" required />
                      <p>* <i>format doc "jpg/png/pdf" </i></td>
                    </td>
                    <td>
     <a href="#" onclick="return false;" class="post__del"><i class="pe-7f-check"></i></a>
    </td>
  </tr>

	<tr class="spacer"></tr>
<tr>
	<td>
		<div class="media">
			<div class="media-body post_desc">
				<h3>Information</h3>
			</div>
		</div>
	</td>
	<td>
		<textarea name="editor1"></textarea>
				 <script>
						 CKEDITOR.replace( 'editor1' );
				 </script>
	</td>
	<td>
		<a href="#" onclick="return false;" class="post__del"><i class="pe-7f-check"></i></a>
	</td>
</tr>
<tr class="spacer"></tr>

                  </tbody>
                </table>
<br>
<hr>
                <center><button  type="submit" name="btnSimpan" value=" Submit " class="btn btn-info" type="button" style="width: 50% ;border:solid blue">Save</button></center>
                <hr>



              </div> <!-- /widget__content -->
              </form>
            </article><!-- /widget -->
          </div>


        </div> <!-- /row -->


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
