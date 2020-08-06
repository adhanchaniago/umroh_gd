<!DOCTYPE html>

<?php
session_start();
if($_SESSION['FirstName'] == '270') {header('Location: ?page=270');} ;
include_once "../library/inc.library.php";
include_once "../library/inc.pilihan.php";
include_once "../library/inc.tanggal.php";

$namafolder="../modul/content_news/";


require('../config/travel-config.php'); //Load DB(mysql) config parameter

# Tombol Simpan diklik
if(isset($_POST['btnSimpan'])){
  # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
  $pesanError = array();
  if (trim($_POST['Travel_Name'])=="") {
    $pesanError[] = "Data <b>Travel</b> tidak boleh kosong !";
  }

  # BACA DATA DALAM FORM, masukkan datake variabel
  $Travel_Name= $_POST['Travel_Name'];
  $Alamat= $_POST['Alamat'];
  $Travel_Phone = $_POST['Travel_Phone'];





  # JIKA ADA PESAN ERROR DARI VALIDASI
  if (count($pesanError)>=1 ){
    echo "<div class='mssgBox'>";
    echo "<img src='images/attention.png'> <br><hr>";
      $noPesan=0;
      foreach ($pesanError as $indeks=>$pesan_tampil) {
      $noPesan++;
        echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
      }
    echo "</div> <br>";
  }
  else {
    # SIMPAN DATA KE DATABASE.
    // Jika tidak menemukan error, simpan data ke database
    $mySql    = "INSERT INTO travel (travel_name, alamat, phone_travel)
            VALUES ('$Travel_Name','$Alamat', '$Travel_Phone')";
    $myQry=mysql_query($mySql, $Link) or die ("Gagal query".mysql_error());
    if($myQry){
      echo "<meta http-equiv='refresh' content='0; url=?page=Travel'>";
    }
    exit;
  }
} // Penutup Tombol Simpan


# VARIABEL DATA UNTUK DIBACA FORM
// Supaya saat ada pesan error, data di dalam form tidak hilang. Jadi, tinggal meneruskan/memperbaiki yg salah
$dataTravel_Name   = isset($_POST['Travel_Name']) ? $_POST['Travel_Name'] : '';
$dataAlamat   = isset($_POST['Alamat']) ? $_POST['Alamat'] : '';
$dataTravel_Phone  = isset($_POST['Travel_Phone']) ? $_POST['Travel_Phone'] : '';
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

textarea {
    display: inline-block;
    width: 100%;
    border: none;
    height: 65px;
    vertical-align: top;
    background-color: rgba(0, 0, 0, 0.5);
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
              <span>Travel Management</span>
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
                  <i class="pe-7s-menu"></i><h3>Add Travel</h3>
                </div>
                <div class="widget__config">
                  <a href="#"><i class="pe-7f-refresh"></i></a>
                  <a href="#"><i class="pe-7s-close"></i></a>
                </div>
              </header>
              <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" class="form-horizontal" role="form">
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
                            <h3>Travel</h3>
                          </div>
                        </div>
                      </td>
                      <td >
<input name="Travel_Name" type="text"  class="stacked-input" value="<?php echo $dataTravel_Name; ?>"  id="input-1" placeholder="Travel Name" required style="width:100%">
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
                            <h3>Address</h3>
                          </div>
                        </div>
                      </td>
                      <td>
  <textarea type="text" name="Alamat" class="stacked-input" value="<?php echo "$dataAlamat";?>"  id="input-1" placeholder="Address" required><?php echo "$dataContent";?></textarea>
                               </td>

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
                            <h3>Contact</h3>
                          </div>
                        </div>
                      </td>
                      <td>
  <textarea type="text" name="Travel_Phone" class="stacked-input" value="<?php echo "$dataTravel_Phone";?>"  id="input-1" placeholder="Contact" required><?php echo "$dataContent";?></textarea>
                               </td>

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
