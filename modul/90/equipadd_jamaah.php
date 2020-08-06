<!DOCTYPE html>

<?php
session_start();
if($_SESSION['FirstName'] == '90') {header('Location: ?page=90');} ;
include_once "../library/inc.library.php";
include_once "../library/inc.pilihan.php";
include_once "../library/inc.tanggal.php";

require('../config/travel-config.php'); //Load DB(mysql) config parameter

$Travel= $_SESSION['Travel'];



# Tombol Simpan diklik
if(isset($_POST['btnSimpan'])){
  # Validasi form, jika kosong sampaikan pesan error
  $pesanError = array();



  if (trim($_POST['QTY'])=="") {
    $pesanError[] = "Data <b>Nama</b> tidak boleh kosong !";
  }




  # Baca Variabel Form


  $Id_Equipment   = $_POST['Id_Equipment'];
  $NomorID    = $_GET['NomorJamaah'];
  $QTY   = $_POST['QTY'];


  $NomorJamaah= isset($_GET['NomorJamaah']) ?  $_GET['NomorJamaah'] : '';

   $dataJumlah = isset($_POST['jumlahpaket']) ? $_POST['jumlahpaket'] : '';
   $dataQTY  = isset($_POST['QTY']) ? $_POST['QTY'] : '';




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
    $mySql  = "INSERT INTO `equipment_jamaah` (nomor_id, id_equipment,  qty_item,
                                      input_item_date)
                              VALUES ('$NomorID', '$Id_Equipment',
                              '$QTY', NOW())";

    $myQry  = mysql_query($mySql, $Link) or die ("Gagal query".mysql_error());


    // Skrip Update stok
      $stokSql = "UPDATE equipment SET `stock`= stock - $dataJumlah
                                  WHERE id_equipment='$Id_Equipment'";
      mysql_query($stokSql, $Link) or die ("Gagal Query Edit Stok".mysql_error());


    if($myQry){
      echo "<meta http-equiv='refresh' content='0; url=?page=Invoice-CR'>";
    }
    exit;
  }
} // Penutup Tombol Simpan

// Membaca Nomor Umroh
$NomorJamaah= isset($_GET['NomorJamaah']) ?  $_GET['NomorJamaah'] : '';
$mySql  = "SELECT first_name, last_name, surname, gender FROM jamaah_daftar WHERE nomor_id='$NomorJamaah'";
$myQry  = mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);
$dataFirstName  = $myData['first_name'];
$datalastName  = $myData['last_name'];
$dataSurName  = $myData['surname'];
$dataGender  = $myData['gender'];


# Kode Umroh
if($NomorJamaah=="") {
  $NomorJamaah= isset($_POST['NomorJamaah']) ? $_POST['NomorJamaah'] : '';
}

# VARIABEL DATA UNTUK DIBACA FORM


$dataFirstName = isset($_POST['FirstName']) ? $_POST['FirstName'] : '';
$dataLastName = isset($_POST['LastName']) ? $_POST['LastName'] : '';
$dataSurname  = isset($_POST['SurName']) ? $_POST['SurName'] : '';

$dataQTY  = isset($_POST['QTY']) ? $_POST['QTY'] : '1';
$dataNomorID  = isset($_POST['NomorID']) ? $_POST['NomorID'] : $_GET['NomorJamaah'];
$dataId_Equipment  = isset($_POST['Id_Equipment']) ? $_POST['Id_Equipment'] : '';




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
    background-color: rgba(18, 35, 158, 0.65);
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
              <span>Equipment Add Proses</span>
              </h1>
             <ul class="main-header__breadcrumb">
              <li><a href ="#" onclick="window.location='#';">Home</a></li>
                 <a href ="?page=90" onclick="window.location='?page=90';">Equipment</a>
              </li>
               </ul>
           </div>


      </header>

<div class = "row">
          <div class="col-md-12">
            <article class="widget">
              <header class="widget__header">
                <div class="widget__title">
                  <i class="pe-7s-menu"></i><h3 >Equipment for ( <?php echo $myData['first_name']; ?> <?php echo $myData['last_name']; ?>  <?php echo $myData['surname']; ?> ( <?php echo $myData['gender']; ?>) )</h3>
                </div>
                <div class="widget__config">
                  <a href="#"><i class=""></i></a>
                  <a href="#"><i class=""></i></a>
                </div>
              </header>

              <div class="widget__content ">
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" class="form-horizontal" role="form">
                <table class="table table-striped media-table widget__form ">
                  <thead>
                    <tr>
                      <th style="width:1px">No </th>
                      <th>Equipment</th>
                      <th>QTY</th>
                        <th>Nomor ID</th>
                          <th></th>

                    </tr>
                  </thead>

                  <tbody>


              <tr class="spacer"></tr>
              <tr>
              <td>
              <font><p> <?php echo $nomor; ?></p></font>      </td>

               <td>
                <p> <select name="Id_Equipment" bgcolor="blue" class="btn blue ">
                   <option value="">--Select Equipment--</option>
                  <?php
$bacaSql = "SELECT DISTINCT * FROM equipment ";
$bacaQry = mysql_query($bacaSql, $Link) or die ("Gagal Query".mysql_error());
while ($bacaData = mysql_fetch_array($bacaQry)) {
if ($bacaData['id_equipment'] == $dataId_Equipment) {
$cek = " selected";
} else { $cek=""; }

echo "<option value='$bacaData[id_equipment]' $cek> Stock[ $bacaData[stock] ]  $bacaData[equipment_name]  </option>";
}
?>
                   </select> </p>
               </td>

               <td>
            <input name="QTY" type="number" name="ID" class="stacked-input" value="<?php echo $dataQTY; ?>"  id="input-1" placeholder="QTY *" required>
              </td>
                <input name="jumlahpaket" type="hidden" value="1" />
               <td>
          <input name="NomorID" type="text" name="ID" class="stacked-input" value="<?php echo $dataNomorID; ?>"  id="input-1" placeholder="Number ID*" required readonly="readonly">
              </td>
              <td>
           </td>

              </tr>


                  </tbody>

                  <tbody>


              <tr class="spacer"></tr>
              <tr>
              <td>
              <font><p></p></font>      </td>

               <td>
                <p> </p>
               </td>
                <td>
                <p align="right"></p>
               </td>
               <td>
               <p  align="right"></p>
              </td>
              <td>
              <p  align="right"></p>
             </td>


              </tr>


                  </tbody>
                </table>


                  <button  type="submit" name="btnSimpan" value=" Submit " class="btn btn-info" style="width:100% ; height:50px ;background-color: yellow;"  type="button">Save</button>
</form>






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
