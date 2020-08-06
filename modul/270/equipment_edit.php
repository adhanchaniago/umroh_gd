<!DOCTYPE html>

<?php
session_start();
if($_SESSION['FirstName'] == '270') {header('Location: ?page=270');} ;
include_once "../library/inc.library.php";
include_once "../library/inc.pilihan.php";
include_once "../library/inc.tanggal.php";


require('../config/travel-config.php'); //Load DB(mysql) config parameter

# Tombol Simpan diklik
if(isset($_POST['btnSimpan'])){
  # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
  $pesanError = array();
  if (trim($_POST['EquipmentName'])=="") {
    $pesanError[] = "Data <b>Equipment Name</b> tidak boleh kosong !";    
  }

  # BACA DATA DALAM FORM, masukkan datake variabel
  $EquipmentName= $_POST['EquipmentName'];
  $Stock= $_POST['Stock'];



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
    $mySql    = "UPDATE equipment SET equipment_name='$EquipmentName', 
                stock='$Stock' WHERE id_equipment='".$_GET['Kode']."'";
    $myQry=mysql_query($mySql, $Link) or die ("Gagal query".mysql_error());
    if($myQry){
      echo "<meta http-equiv='refresh' content='0; url=?page=Equipment'>";
    }
    exit;
  } 
} // Penutup Tombol Simpan


# VARIABEL DATA UNTUK DIBACA FORM

# MEMBACA DATA UNTUK DIEDIT
$Kode  = isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['Kode']; 
$mySql   = "SELECT * FROM equipment WHERE id_equipment='$Kode'";
$myQry   = mysql_query($mySql, $Link)  or die ("Query ambil data salah : ".mysql_error());
$myData  = mysql_fetch_array($myQry);
// Supaya saat ada pesan error, data di dalam form tidak hilang. Jadi, tinggal meneruskan/memperbaiki yg salah

$dataEquipmentName   = isset($_POST['EquipmentName']) ? $_POST['EquipmentName'] : $myData['equipment_name'];
$dataStock = isset($_POST['Stock']) ? $_POST['Stock'] : $myData['stock'];

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
   select {
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


.widget__form input[type=password] {
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
.widget__form input[type=date] {
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
              <span>Equipment Data</span>
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
          
          <div class="col-md-6">
            <article class="widget widget__form" >
              <header class="widget__header">
                <div class="widget__title">
                  <i class="pe-7s-menu"></i><h3>Add form</h3>
                </div>
                <div class="widget__config">
                  <a href="#"><i class="pe-7f-refresh"></i></a>
                  <a href="#"><i class="pe-7s-close"></i></a>
                </div>
              </header>
 <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" class="form-horizontal" role="form">
              <div class="widget__content">
                <input name="EquipmentName" value="<?php echo $dataEquipmentName ?>" type="text" placeholder="Equipment Name" required>
                <input name="Stock" value="<?php echo $dataStock ?>" type="number" placeholder="Stock" required>
                <button type="submit" name="btnSimpan" value=" Submit " >Apply</button>
            </div>
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

