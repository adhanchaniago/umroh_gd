<!DOCTYPE html>

<?php
session_start();
if($_SESSION['FirstName'] == 'Add_Document') {header('Location: ?page=Add_Document');} ;
include_once "../library/inc.library.php";
include_once "../library/inc.pilihan.php";
include_once "../library/inc.tanggal.php";

require('../config/travel-config.php'); //Load DB(mysql) config parameter



// require('../config/travel-config.php'); //Load DB(mysql) config parameter

// # Tombol Simpan diklik
// if(isset($_POST['btnSimpan'])){
//   # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
//   $pesanError = array();
//   if (trim($_POST['Packages_Name'])=="") {
//     $pesanError[] = "Data <b>Packages</b> tidak boleh kosong !";
//   }
//
//   # BACA DATA DALAM FORM, masukkan datake variabel
//   $Packages_Name= $_POST['Packages_Name'];
//   $Day_Umroh= $_POST['Day_Umroh'];
//   $Departure= $_POST['Departure'];
//   $Hotel_Mecca = $_POST['Hotel_Mecca'];
//   $Hotel_Madinah = $_POST['Hotel_Madinah'];
//   $Plane= $_POST['Plane'];
//   $Price_Umroh = $_POST['Price_Umroh'];
//   $Price_Double = $_POST['Price_Double'];
//   $Price_Triple = $_POST['Price_Triple'];
//   $Price_Equipment = $_POST['Price_Equipment'];
//   $Quota = $_POST['Quota'];
//   $Currency = $_POST['Currency'];
//   $desc_umroh = $_POST['desc_umroh'];
//
//
//   # JIKA ADA PESAN ERROR DARI VALIDASI
//   if (count($pesanError)>=1 ){
//     echo "<div class='mssgBox'>";
//     echo "<img src='images/attention.png'> <br><hr>";
//       $noPesan=0;
//       foreach ($pesanError as $indeks=>$pesan_tampil) {
//       $noPesan++;
//         echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
//       }
//     echo "</div> <br>";
//   }
//   else {
//     # SIMPAN DATA KE DATABASE.
//     // Jika tidak menemukan error, simpan data ke database
//     $mySql    = "INSERT INTO paket_umroh (nama_paket, desc_umroh, hari_umroh, depart_umroh, hotel_umroh_mekkah,
//                      hotel_umroh_madinah, pesawat_umroh,currency, harga_umroh, harga_triple,  harga_double, harga_perlengkapan, kuota)
//             VALUES ('$Packages_Name','$desc_umroh', '$Day_Umroh', '$Departure',  '$Hotel_Mecca',
//                 '$Hotel_Madinah', '$Plane', '$Currency' , '$Price_Umroh', '$Price_Triple',  '$Price_Double', '$Price_Equipment', '$Quota')";
//     $myQry=mysql_query($mySql, $Link) or die ("Gagal query".mysql_error());
//     if($myQry){
//       echo "<meta http-equiv='refresh' content='0; url=?page=Packages'>";
//     }
//     exit;
//   }
// } // Penutup Tombol Simpan
//
//
// # VARIABEL DATA UNTUK DIBACA FORM
// // Supaya saat ada pesan error, data di dalam form tidak hilang. Jadi, tinggal meneruskan/memperbaiki yg salah
// $dataPackages_Name   = isset($_POST['Packages_Name']) ? $_POST['Packages_Name'] : '';
// $datadesc_umroh   = isset($_POST['desc_umroh']) ? $_POST['desc_umroh'] : '';
// $dataDay_Umroh = isset($_POST['Day_Umroh']) ? $_POST['Day_Umroh'] : '';
// $dataDeparture = isset($_POST['Departure']) ? $_POST['Departure'] : '';
// $dataHotel_Mecca = isset($_POST['Hotel_Mecca']) ? $_POST['Hotel_Mecca'] : '';
// $dataHotel_Madinah  = isset($_POST['Hotel_Madinah']) ? $_POST['Hotel_Madinah'] : '';
// $dataPlane    = isset($_POST['Plane']) ? $_POST['Plane'] : '';
// $dataPrice_Umroh    = isset($_POST['Price_Umroh']) ? $_POST['Price_Umroh'] : '';
// $dataPrice_Double    = isset($_POST['Price_Double']) ? $_POST['Price_Double'] : '';
// $dataPrice_Triple    = isset($_POST['Price_Triple']) ? $_POST['Price_Triple'] : '';
// $dataPrice_Equipment    = isset($_POST['Price_Equipment']) ? $_POST['Price_Equipment'] : '';
// $dataQuota    = isset($_POST['Quota']) ? $_POST['Quota'] : '';
// $dataCurrency    = isset($_POST['Currency']) ? $_POST['Currency'] : '';

// Membaca Nomor Umroh
$NomorID= isset($_GET['NomorID']) ?  $_GET['NomorID'] : '';
$mySql  = "SELECT nomor_id, first_name, last_name, surname FROM jamaah_daftar WHERE nomor_id='$NomorID'";
$myQry  = mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);
$dataNomorID  = $myData['nomor_id'];
$dataFirstName  = $myData['first_name'];
$dataLastName  = $myData['last_name'];
$dataSurName  = $myData['surname'];


# Kode Umroh
if($NomorID=="") {
  $NomorID= isset($_POST['nomor_id']) ? $_POST['nomor_id'] : '';
}

# VARIABEL DATA UNTUK DIBACA FORM
// Supaya saat ada pesan error, data di dalam form tidak hilang. Jadi, tinggal meneruskan/memperbaiki yg salah
$dataPackages_Name   = isset($_POST['Packages_Name']) ? $_POST['Packages_Name'] : '';
$datadesc_umroh   = isset($_POST['desc_umroh']) ? $_POST['desc_umroh'] : '';

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

        .widget__form input[type=number] {
    display: inline-block;
    width: 100%;
    border: none;
    height: 35px;
    vertical-align: top;
    background-color: rgba(0,0,0,.25);
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
    background-color: rgba(0,0,0,.25);
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
    background-color: rgba(0,0,0,.25);
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
              <span>Document Data </span>
              </h1>
             <ul class="main-header__breadcrumb">
              <li><a href ="#" onclick="window.location='#';">Home</a></li>
                 <a href ="?page=90" onclick="window.location='?page=90';">Management</a>
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
                  <i class="pe-7s-menu"></i><h3>Add Document</h3>
                </div>
                <div class="widget__config">
                  <a href="#"><i class="pe-7f-refresh"></i></a>
                  <a href="#"><i class="pe-7s-close"></i></a>
                </div>
              </header>
              <form action="../modul/proses/proses_dokumen_1.php"  method="post" target="_self" enctype ="multipart/form-data">
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
                            <h3>Nomor ID</h3>
                          </div>
                        </div>
                      </td>
                      <td >

 <input name="Id_Customer" type="text"  class="stacked-input" value="<?php echo $dataNomorID; ?>" id="input-1" placeholder="Desc Umroh" required style="width:100%">
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
                            <h3>Name Customer</h3>
                          </div>
                        </div>
                      </td>
                      <td>
                       <input name="Name_Customer" type="text"  class="stacked-input" value="<?php echo $dataFirstName; ?> <?php echo $dataLastName; ?> <?php echo $dataSurName; ?>"  id="input-1" placeholder="Name " required>
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
                              <h3>Passport (PAS)</h3>
                            </div>
                          </div>
                        </td>
                        <td>
                        <input name="nama_file_pas" type="file"  class="stacked-input full-label" value=""  id="input-1" placeholder="Departure" required> <br>
                        <select name="PAS" required class="form-control col-xs-10 col-sm-5" style=" height: 35px; width: 100%" >
                <option value=""> </option>
                 <option value="Not Mandatory">Not Mandatory</option>
                 <option value="Not Yet Submitted">Not Yet Submitted</option>
                 <option value="Documents submitted to representatives">Documents submitted to representatives</option>
                <option value="Documents submitted to the marketing department">Documents submitted to the marketing department</option>
                <option value="Documents submitted to operational center">Documents submitted to operational center</option>
                <option value="Documents submitted back to marketing department">Documents submitted back to marketing department</option>
                <option value="Documents are handed back to the representative center">Documents are handed back to the representative center</option>
                            </select>
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
                              <h3>Family Card (KK)</h3>
                            </div>
                          </div>
                        </td>
                        <td>
                        <input name="nama_file_kk" type="file"  class="stacked-input full-label" value=""  id="input-1" placeholder="Departure" required> <br>
                        <select name="KK" required class="form-control col-xs-10 col-sm-5" style=" height: 35px; width: 100%" >
                <option value=""> </option>
                 <option value="Not Mandatory">Not Mandatory</option>
                 <option value="Not Yet Submitted">Not Yet Submitted</option>
                 <option value="Documents submitted to representatives">Documents submitted to representatives</option>
                <option value="Documents submitted to the marketing department">Documents submitted to the marketing department</option>
                <option value="Documents submitted to operational center">Documents submitted to operational center</option>
                <option value="Documents submitted back to marketing department">Documents submitted back to marketing department</option>
                <option value="Documents are handed back to the representative center">Documents are handed back to the representative center</option>
                            </select>
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
                              <h3>marriage Book (NIK)</h3>
                            </div>
                          </div>
                        </td>
                        <td>
                        <input name="nama_file_nik" type="file"  class="stacked-input full-label" value=""  id="input-1" placeholder="Departure" required> <br>
                        <select name="NIK" required class="form-control col-xs-10 col-sm-5" style=" height: 35px; width: 100%" >
                <option value=""> </option>
                 <option value="Not Mandatory">Not Mandatory</option>
                 <option value="Not Yet Submitted">Not Yet Submitted</option>
                 <option value="Documents submitted to representatives">Documents submitted to representatives</option>
                <option value="Documents submitted to the marketing department">Documents submitted to the marketing department</option>
                <option value="Documents submitted to operational center">Documents submitted to operational center</option>
                <option value="Documents submitted back to marketing department">Documents submitted back to marketing department</option>
                <option value="Documents are handed back to the representative center">Documents are handed back to the representative center</option>
                            </select>
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
                              <h3>Color Photographs 4x6 = 5 Sheet / Color Photographs 4x6 = 10 Sheet and 3X4 = 40 Sheet (FU)</h3>
                            </div>
                          </div>
                        </td>
                        <td>
                        <input name="nama_file_fu" type="file"  class="stacked-input full-label" value=""  id="input-1" placeholder="Departure" required> <br>
                        <select name="FU" required class="form-control col-xs-10 col-sm-5" style=" height: 35px; width: 100%" >
                <option value=""> </option>
                 <option value="Not Mandatory">Not Mandatory</option>
                 <option value="Not Yet Submitted">Not Yet Submitted</option>
                 <option value="Documents submitted to representatives">Documents submitted to representatives</option>
                <option value="Documents submitted to the marketing department">Documents submitted to the marketing department</option>
                <option value="Documents submitted to operational center">Documents submitted to operational center</option>
                <option value="Documents submitted back to marketing department">Documents submitted back to marketing department</option>
                <option value="Documents are handed back to the representative center">Documents are handed back to the representative center</option>
                            </select>
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
                              <h3>Birth Certificate / Certificate (AKT)</h3>
                            </div>
                          </div>
                        </td>
                        <td>
                        <input name="nama_file_akt" type="file"  class="stacked-input full-label" value=""  id="input-1" placeholder="Departure" required> <br>
                        <select name="AKT" required class="form-control col-xs-10 col-sm-5" style=" height: 35px; width: 100%" >
                <option value=""> </option>
                 <option value="Not Mandatory">Not Mandatory</option>
                 <option value="Not Yet Submitted">Not Yet Submitted</option>
                 <option value="Documents submitted to representatives">Documents submitted to representatives</option>
                <option value="Documents submitted to the marketing department">Documents submitted to the marketing department</option>
                <option value="Documents submitted to operational center">Documents submitted to operational center</option>
                <option value="Documents submitted back to marketing department">Documents submitted back to marketing department</option>
                <option value="Documents are handed back to the representative center">Documents are handed back to the representative center</option>
                            </select>
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
                              <h3>Yellow Card (KUN)</h3>
                            </div>
                          </div>
                        </td>
                        <td>
                        <input name="nama_file_kun" type="file"  class="stacked-input full-label" value=""  id="input-1" placeholder="Departure" required> <br>
                        <select name="KUN" required class="form-control col-xs-10 col-sm-5" style=" height: 35px; width: 100%" >
                <option value=""></option>
                 <option value="Not Mandatory">Not Mandatory</option>
                 <option value="Not Yet Submitted">Not Yet Submitted</option>
                 <option value="Documents submitted to representatives">Documents submitted to representatives</option>
                <option value="Documents submitted to the marketing department">Documents submitted to the marketing department</option>
                <option value="Documents submitted to operational center">Documents submitted to operational center</option>
                <option value="Documents submitted back to marketing department">Documents submitted back to marketing department</option>
                <option value="Documents are handed back to the representative center">Documents are handed back to the representative center</option>
                            </select>
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
                              <h3>Identity Card (KTP)</h3>
                            </div>
                          </div>
                        </td>
                        <td>
                        <input name="nama_file_ktp" type="file"  class="stacked-input full-label" value=""  id="input-1" placeholder="Departure" required> <br>
                        <select name="KTP" required class="form-control col-xs-10 col-sm-5" style=" height: 35px; width: 100%" >
                <option value=""> </option>
                 <option value="Not Mandatory">Not Mandatory</option>
                 <option value="Not Yet Submitted">Not Yet Submitted</option>
                 <option value="Documents submitted to representatives">Documents submitted to representatives</option>
                <option value="Documents submitted to the marketing department">Documents submitted to the marketing department</option>
                <option value="Documents submitted to operational center">Documents submitted to operational center</option>
                <option value="Documents submitted back to marketing department">Documents submitted back to marketing department</option>
                <option value="Documents are handed back to the representative center">Documents are handed back to the representative center</option>
                            </select>
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
                              <h3>Evidence of Hajj Health (BKH)</h3>
                            </div>
                          </div>
                        </td>
                        <td>
                        <input name="nama_file_bkh" type="file"  class="stacked-input full-label" value=""  id="input-1" placeholder="Departure" required> <br>
                        <select name="BKH" required class="form-control col-xs-10 col-sm-5" style=" height: 35px; width: 100%" >
                <option value=""> </option>
                 <option value="Not Mandatory">Not Mandatory</option>
                 <option value="Not Yet Submitted">Not Yet Submitted</option>
                 <option value="Documents submitted to representatives">Documents submitted to representatives</option>
                <option value="Documents submitted to the marketing department">Documents submitted to the marketing department</option>
                <option value="Documents submitted to operational center">Documents submitted to operational center</option>
                <option value="Documents submitted back to marketing department">Documents submitted back to marketing department</option>
                <option value="Documents are handed back to the representative center">Documents are handed back to the representative center</option>
                            </select>
                        </td>
                        <td>
                          <a href="#" onclick="return false;" class="post__del"><i class="pe-7f-check"></i></a>
                        </td>
                      </tr>




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
