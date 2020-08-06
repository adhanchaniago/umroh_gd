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



  if (trim($_POST['FirstName'])=="") {
    $pesanError[] = "Data <b>Nama</b> tidak boleh kosong !";
  }

  if (trim($_POST['Paket_Program'])=="KOSONG") {
    $pesanError[] = "Data <b>Paket Program</b> belum dipilih !";
  }


  # Baca Variabel Form

   $Title    = $_POST['Title'];
  $FirstName   = $_POST['FirstName'];
  $LastName    = $_POST['LastName'];
  $SurName   = $_POST['SurName'];
  $Email = $_POST['Email'];
  $Contact = $_POST['Contact'];


   $Kode_Paket = $_POST['kode_paket'];
  $Paket_Program = $_POST['Paket_Program'];
  $Depart = $_POST['Depart'];
  $Arrival = $_POST['Arrival'];
  $NomorUmroh= isset($_GET['NomorUmroh']) ?  $_GET['NomorUmroh'] : '';






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
    $mySql  = "INSERT INTO `waiting` (date_input, title,  first_name,
                                      last_name, surname, telepon, email, kd_umroh, packages_program,
                                      depart, arrival)
                              VALUES (NOW(), '$Title', '$FirstName',
                              '$LastName', '$SurName', '$Contact', '$Email', '$Kode_Paket', '$Paket_Program',
                              '$Depart', '$Arrival')";

    $myQry  = mysql_query($mySql, $Link) or die ("Gagal query".mysql_error());


    if($myQry){
      echo "<meta http-equiv='refresh' content='0; url=?page=90'>";
    }
    exit;
  }
} // Penutup Tombol Simpan

// Membaca Nomor Umroh
$NomorUmroh= isset($_GET['NomorUmroh']) ?  $_GET['NomorUmroh'] : '';
$mySql  = "SELECT kd_umroh, nama_paket, depart_umroh, hari_umroh FROM paket_umroh WHERE kd_umroh='$NomorUmroh'";
$myQry  = mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);
$dataUmroh  = $myData['nama_paket'];
$dataKeberangkatan = $myData['depart_umroh'];
$dataKodePaket= $myData['kd_umroh'];

//arrival
    $tgl = $myData['depart_umroh'];
    $hari = $myData['hari_umroh'];
    $min = 1;
    $lw = ($hari-$min);
    $pt = explode('-', $tgl);
    $t = $pt[2];
    $b = $pt[1];
    $th = $pt[0];
    $a = GregorianToJD($b, $t, $th);
    $b = JDToGregorian($a+$lw);
    $newtgl = $b;



$dataArrival = date('d F Y', strtotime($newtgl ));

# Kode Umroh
if($NomorUmroh=="") {
  $NomorUmroh= isset($_POST['txtNomorUmroh']) ? $_POST['txtNomorUmroh'] : '';
}

# VARIABEL DATA UNTUK DIBACA FORM

$dataTitle = isset($_POST['Title']) ? $_POST['Title'] : '';
$dataFirstName = isset($_POST['FirstName']) ? $_POST['FirstName'] : '';
$dataLastName = isset($_POST['LastName']) ? $_POST['LastName'] : '';
$dataSurname  = isset($_POST['SurName']) ? $_POST['SurName'] : '';
$dataGender= isset($_POST['Gender']) ? $_POST['Gender'] : '';

$dataStatus= isset($_POST['Status']) ? $_POST['Status'] : '';
$dataEmail = isset($_POST['Email']) ? $_POST['Email'] : '';
$dataContact= isset($_POST['Contact']) ? $_POST['Contact'] : '';
$dataAddress= isset($_POST['Address']) ? $_POST['Address'] : '';
$dataCity  = isset($_POST['City']) ? $_POST['City'] : '';
$dataFamilyName  = isset($_POST['FamilyName']) ? $_POST['FamilyName'] : '';
$dataFamilyContact  = isset($_POST['FamilyContact']) ? $_POST['FamilyContact'] : '';
$dataKamar  = isset($_POST['Room']) ? $_POST['Room'] : '';
$dataRoomNumber  = isset($_POST['Room_number']) ? $_POST['Room_number'] : '';
$dataPassport = isset($_POST['Passport']) ? $_POST['Passport'] : '';
$dataPoi  = isset($_POST['txtPoi']) ? $_POST['txtPoi'] : '';
$dataDoi  = isset($_POST['txtDoi']) ? $_POST['txtDoi'] : '';
$dataExpired  = isset($_POST['txtExpired']) ? $_POST['txtExpired'] : '';

$dataMahrom= isset($_POST['Mahrom']) ? $_POST['Mahrom'] : '';
$dataMahromStatus= isset($_POST['Mahrom_Status']) ? $_POST['Mahrom_Status'] : '';


// Tempat, Tgl Lahir
$dataTempatLahir= isset($_POST['place_of_birth']) ? $_POST['place_of_birth'] : '';
$dataThn    = isset($_POST['cmbThnLahir']) ? $_POST['cmbThnLahir'] : date('Y');
$dataBln    = isset($_POST['cmbBlnLahir']) ? $_POST['cmbBlnLahir'] : date('m');
$dataTgl    = isset($_POST['cmbTglLahir']) ? $_POST['cmbTglLahir'] : date('d');
$dataTglLahir   = $dataThn."-".$dataBln."-".$dataTgl;

?>




<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="utf-8">
    <title>Umroh - Customer Relation</title>
   <link rel="icon" sizes="192x192" href="../img/Icon.png"/>
    <!-- Glazzed & Bootstrap -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/main.min.css">
    <!-- Pixeden Icon Fonts -->
    <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
    <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-stroke.css">
    <link rel="stylesheet" type="text/css" href="../plugins/tigra_calendar/tcal.css"/>




</head>
<body>
<style type="text/css">
    table, th, td {
 border: 1px solid black    ;
  padding-top: 12px;
  padding-left: 10px;
  padding-right: 10px;
  padding-bottom: 10px;
  border-radius: 5px;
    font-family: 'Raleway', sans-serif;
  }

.table-number {

  font-family: 'Roboto', sans-serif;
}

#grad1 {
height: 50px;
background: -webkit-linear-gradient(left, #0bd745 , #1cd88b); /* For Safari 5.1 to 6.0 */
background: -o-linear-gradient(right, #0bd745, #1cd88b); /* For Opera 11.1 to 12.0 */
background: -moz-linear-gradient(right, #0bd745, #1cd88b); /* For Firefox 3.6 to 15 */
background: linear-gradient(to right, #0bd745 , #1cd88b); /* Standard syntax (must be last) */
}

#grad2 {
                height: 100px;
                background: -webkit-linear-gradient(left, #1ac5fb , #1d72f1); /* For Safari 5.1 to 6.0 */
                background: -o-linear-gradient(right, #1ac5fb, #1d72f1); /* For Opera 11.1 to 12.0 */
                background: -moz-linear-gradient(right, #1ac5fb, #1d72f1); /* For Firefox 3.6 to 15 */
                background: linear-gradient(to right, #1ac5fb , #1d72f1); /* Standard syntax (must be last) */

}


textarea {
    display: inline-block;
    width: 100%;
    border: none;
    height: 120px;
    vertical-align: top;
    background-color: rgba(0,0,0,.25);
    margin: 1px 0 0;
    padding-left: 24px;
    font-weight: 100;
    color: #fff;
    padding-top: 15px;
}


.widget__form input[type=date] {
    display: inline-block;
    width: 60%;
    border: none;
    height: 64px;
    vertical-align: top;
    background-color: rgba(0,0,0,.25);
    margin: 1px 0 0;
    padding-left: 24px;
    font-weight: 100;
    color: #fff;
}

</style>


    <div id="loading">
        <div class="loader loader-light loader-large"></div>
    </div>
    <!-- Calling Top Bar & Side Bar -->
    <?php include "menu.php"; ?>


    <!-- Content -->

<section class="content">
            <header class="main-header">
                <div class="main-header__nav">
                    <h1 class="main-header__title">
                        <i class="pe-7f-users"></i>
                        <span>Add Waiting</span>
                    </h1>
                    <ul class="main-header__breadcrumb">
                        <li><a href="?page=90" onclick="return false;"></a></li>

                    </ul>
                </div>


    <div class="row">

                    <div class="col-md-12">
                        <article class="widget widget__form">
           <div class="widget__content">
  <div class="main-container ace-save-state" id="main-container">
      <script type="text/javascript">
        try{ace.settings.loadState('main-container')}catch(e){}
      </script>
  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" class="form-horizontal" role="form">

<div class="col-md-12">

  <div class = "row">
  <div class = "col-md-4">


  <div>
  <select name="Title" required class="form-control" style=" height: 64px;" >
              <option value="<?php echo "$dataTitle";?>"> Select Title*</option>
               <option value="Mr">Mr</option>
               <option value="Mrs">Mrs</option>
               <option value="Miss">Miss</option>
        </select></div>
<div>
 <input name="FirstName" type="text" name="ID" class="stacked-input" value="<?php echo $dataFirstName; ?>"  id="input-1" placeholder="First Name *" required>
  </div>

  <div>
 <input name="LastName" type="text" name="ID" class="stacked-input" value="<?php echo $dataLastName; ?>"  id="input-1" placeholder="Middle Name" >
  </div>

   <div>
 <input name="SurName" type="text" name="ID" class="stacked-input" value="<?php echo $dataSurname; ?>"  id="input-1" placeholder="SurName" >
  </div>


        </div><!--end row -->


  <div class = "row">
  <div class = "col-md-4">


  <div>
 <input name="Email" type="text" name="ID" class="stacked-input" value="<?php echo "$dataEmail";?>"  id="input-1" placeholder="Email" >
  </div>

<div>
 <input  name="Contact" type="text" name="ID" class="stacked-input" value="<?php echo "$dataContact";?>"  id="input-1" placeholder="Contact Number*" required>
  </div>



   <div class="btn-vars__showcase">
  </div>

        </div><!--end row -->

<div class = "row">
  <div class = "col-md-4">


 <div>
 <input type="text" name="kode_paket" class="stacked-input" value="<?php echo $dataKodePaket; ?>"  id="input-1" placeholder="Kode" required hidden>

 <input type="text" name="Paket_Program" class="stacked-input" value="<?php echo $dataUmroh; ?>"  id="input-1" placeholder="Umroh Packages" required>
  </div>
<input name="jumlahpaket" type="hidden" value="1" />
  <div>
 <input type="text" name="Depart" class="stacked-input" value="<?php echo $dataKeberangkatan; ?>"  id="input-1" placeholder="depart" required>
  </div>

  <div>
 <input type="text" name="Arrival" class="stacked-input" value="<?php echo $dataArrival; ?>"  id="input-1" placeholder="Arrival" required>
  </div>
  <br>








        </div><!--end row -->
        </div>


  </div>
  <br>




  <button  type="submit" name="btnSimpan" value=" Submit " class="btn btn-info" type="button">Save</button>
  </div>
  </form>

                        </article><!-- /widget -->
                    </div>

                </div> <!-- /row -->


             </header> <!-- /main-header -->
            <footer class="footer-brand">
                    <?php include "footer.php"; ?>
            </footer>

        </section> <!-- /content -->

    <script src="http://d3js.org/d3.v3.min.js" language="JavaScript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
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
