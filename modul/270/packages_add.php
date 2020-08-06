<!DOCTYPE html>

<?php
session_start();
// if($_SESSION['FirstName'] == '270') {header('Location: ?page=270');} ;
include_once "../library/inc.library.php";
include_once "../library/inc.pilihan.php";
include_once "../library/inc.tanggal.php";


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



// $Pinjam = "2017-8-29";
// $haridariumroh = mktime(0,0,0,date("n"),date("j")+3,date("Y"));
// $arrivalumroh = date("d-m-Y",$haridariumroh);

// $date = "2017-8-29";
// $tgl = strtotime ( '+3 day' , strtotime ( $date ) ) ; //mengurangi 3 hari hasilnya 2012-02-13
//   $arrivalumroh = date($tgl,$date);


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
              <span>packages Management <?php echo "$arrivalumroh"; ?> </span>
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
            <form action="../modul/proses/proses_paket.php"  method="post" target="_self" enctype ="multipart/form-data">
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
                            <h3>Departure Group</h3>
                          </div>
                        </div>
                      </td>
                      <td >
                        <select name="Packages_Name" required class="form-control col-xs-10 col-sm-5" style=" height: 35px; width: 20%" >
                                  <option value="<?php echo $dataPackages_Name; ?>"> <?php echo $dataPackages_Name; ?></option>
                                   <option value="Safwa">Safwa</option>
                                   <option value="Marwa">Marwa</option>
                                   <option value="Incentive">Incentive</option>
                            </select>
 <input name="desc_umroh" type="text"  class="stacked-input" value="<?php echo $dataDay_Umroh; ?>"  id="input-1" placeholder="Group Code"  style="width:80%" >
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
                       <input name="Quota" type="number"  class="stacked-input" value="<?php echo $dataQuota; ?>"  id="input-1" placeholder="Quota" required>
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

<input name="nama_file" type="file" id="nama_file" size="30"  />
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
