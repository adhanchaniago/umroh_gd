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
  $Gender = $_POST['Gender'];
  $Status = $_POST['Status'];
  $Email = $_POST['Email'];
  $Contact = $_POST['Contact'];
  $Address = $_POST['Address'];
  $City = $_POST['City'];
  $FamilyName = $_POST['FamilyName'];
  $FamilyContact = $_POST['FamilyContact'];
  $place_of_birth = $_POST['place_of_birth'];

  $Paket_Program = $_POST['Paket_Program'];
  $Depart = $_POST['Depart'];
  $Arrival = $_POST['Arrival'];
  $Kd_Umroh = $_POST['Kd_Umroh'];
  $Room = $_POST['Room'];
  $Passport = $_POST['Passport'];
 $txtPoi = $_POST['txtPoi'];
  $txtDoi = $_POST['txtDoi'];
  $txtExpired = $_POST['txtExpired'];
  $Mahrom = $_POST['Mahrom'];
  $Mahrom_Status = $_POST['Mahrom_Status'];

   $dataJumlah = isset($_POST['jumlahpaket']) ? $_POST['jumlahpaket'] : '';
  $NomorUmroh= isset($_GET['NomorUmroh']) ?  $_GET['NomorUmroh'] : '';


  
  
  // Membaca form tanggal lahir (comboBox : tanggal, bulan dan tahun lahir)
  $cmbTglLahir  = $_POST['cmbTglLahir'];
  $cmbBlnLahir  = $_POST['cmbBlnLahir'];
  $cmbThnLahir  = $_POST['cmbThnLahir'];
  $tanggalLahir = "$cmbThnLahir-$cmbBlnLahir-$cmbTglLahir";




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
    $kodeBaru = buatKode("jamaah_silver", "IS");
    $mySql  = "INSERT INTO `jamaah_silver` (nomor_id_silver, date_input, title,  first_name, 
                                      last_name, surname, gender, place_of_birth, birthdate, status_jamaah, 
                                      phone, alamat, email, kota, family_name, family_contact, packages_program,
                                      depart, arrival, room, no_pass, poi, doi, expired, 
                                      Mahrom, mahrom_status, kd_umroh) 
                              VALUES ('$kodeBaru', NOW(), '$Title', '$FirstName', 
                              '$LastName', '$SurName', '$Gender', '$place_of_birth', '$tanggalLahir', '$Status', 
                              '$Contact', '$Address', '$Email', '$City', '$FamilyName', '$FamilyContact', '$Paket_Program', 
                              '$Depart', '$Arrival', '$Room',  '$Passport', '$txtPoi', '$txtDoi', '$txtExpired'
                              , '$Mahrom' , '$Mahrom_Status', '$Kd_Umroh')"; 

    $myQry  = mysql_query($mySql, $Link) or die ("Gagal query".mysql_error());

      // Skrip Update stok
      $stokSql = "UPDATE paket_umroh SET `kuota`= kuota - $dataJumlah, 
                                          `daftar` = daftar + $dataJumlah 
                                  WHERE kd_umroh='$NomorUmroh'";
      mysql_query($stokSql, $Link) or die ("Gagal Query Edit Stok".mysql_error());

    

   
    
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
$dataKodeUmroh  = $myData['kd_umroh'];
$dataUmroh  = $myData['nama_paket'];
$dataKeberangkatan = $myData['depart_umroh'];

//arrival
    $tgl = $myData['depart_umroh'];
    $lw = $myData['hari_umroh'];
    $pt = explode('-', $tgl);
    $t = $pt[2];
    $b = $pt[1];
    $th = $pt[0];
    $a = GregorianToJD($b, $t, $th);
    $b = JDToGregorian($a+$lw);
    $newtgl = $b;

   

$dataArrival = date('d F Y', strtotime($newtgl ));

// data tahun expired passport
//$txtDoi = $_POST['txtDoi'];
$tgl1 =  $_POST['txtDoi'];// pendefinisian tanggal awal
$tgl2 = date('d-m-Y', strtotime('+5 year', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari


# Kode Umroh
if($NomorUmroh=="") {
  $NomorUmroh= isset($_POST['txtNomorUmroh']) ? $_POST['txtNomorUmroh'] : '';
}

# VARIABEL DATA UNTUK DIBACA FORM

$dataKode = buatKode("jamaah_silver", "IS");
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


<?php
# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 10;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM paket_umroh ";
$pageQry = mysql_query($pageSql, $Link) or die ("error paging: ".mysql_error());
$jml   = mysql_num_rows($pageQry);
$max   = ceil($jml/$row);

// Jika tombol Cari diklik
if(isset($_POST['btnCari'])){
  if($_POST) {
    // Cari berdasarkan Nomor RM dan Nama Pasien yang mirip
    $txtKataKunci = $_POST['txtKataKunci'];
    $mySql = "SELECT * FROM paket_umroh WHERE  depart_umroh LIKE '%$txtKataKunci%' 
          ORDER BY kd_umroh ASC LIMIT $hal, $row";
  }
}
else {
  $mySql = "SELECT * FROM paket_umroh  ORDER BY kd_umroh ASC LIMIT $hal, $row";
} 

// Membaca variabel form
$dataKataKunci  = isset($_POST['txtKataKunci']) ? $_POST['txtKataKunci'] : '';
?>



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
                        <span>Add Data</span>
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
 <input name="textfield" type="text" name="ID" class="stacked-input" value="<?php echo $dataKode; ?>"  id="input-1" placeholder="ID Jamaah" required readonly="readonly">
  </div>

  <div> 
   <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Select Title *  </label> 
  <select name="Title" required class="form-control col-xs-10 col-sm-5" style=" height: 64px; width: 75%" >
              <option value="<?php echo "$dataTitle";?>"> <?php echo "$dataTitle";?></option>
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

 <div> 
  <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Select Gender *  </label><select name="Gender" required class="form-control col-xs-10 col-sm-5" style=" height: 64px; width: 75%"  >
              <option value="<?php echo "$dataGender";?>" title="tes"> <?php echo "$dataGender";?></option>
               <option value="Male">Male</option>
               <option value="Female">Female</option>
        </select></div>



  <div>
<input name="place_of_birth" type="text"  value="<?php echo $dataTempatLahir; ?>" size="12" maxlength="100" placeholder="Place of birth*
" required />, <?php echo listTanggal("Lahir",$dataTglLahir); ?> 
  </div>
  <BR>

  <div> 
  <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Select Status *  </label><select name="Status" required class="form-control col-xs-10 col-sm-5" style=" height: 64px; width: 75%"  >
              <option value="<?php echo "$dataStatus";?>" title="tes"> <?php echo "$dataStatus";?></option>
               <option value="Marriage">Marriage</option>
               <option value="Single">Single</option>
        </select></div>
  <div class="btn-vars__showcase">
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

  <div>
 <textarea type="text" name="Address" class="stacked-input" value="<?php echo "$dataAddress";?>"  id="input-1" placeholder="Address*" required><?php echo "$dataAddress";?></textarea>
  </div>

  <div>
 <input type="text" name="City" class="stacked-input" value="<?php echo "$dataCity";?>"  id="input-1" placeholder="City*" required>
  </div>

   <div>
 <input type="text" name="FamilyName" class="stacked-input" value="<?php echo "$dataFamilyName";?>"  id="input-1" placeholder="Family Name" >
  </div>

  <div>
 <input type="text" name="FamilyContact" class="stacked-input" value="<?php echo "$dataFamilyContact";?>"  id="input-1" placeholder="Family Contact" >
  </div>

  <div> 
  <label class="col-sm-12 control-label no-padding-right" for="form-field-1"> Select Room Type (Select One) *  </label>
  </div>
  <br>
  <hr>

 
  <div class = "row"> 

   <div>
  <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Select Room *  </label><select name="Room"  class="form-control col-xs-10 col-sm-5" style=" height: 64px; width: 70%"  >
        <option value="<?php echo "$dataKamar";?>"><?php echo "$dataKamar";?></option>
        <option value="Double1">Double1</option>
        <option value="Double2">Double2</option>
        <option value="Double3">Double3</option>
         <option value="Double4">Double4</option>
          <option value="Double5">Double5</option>
           <option value="Double6">Double6</option>
            <option value="Double7">Double7</option>
             <option value="Double8">Double8</option>
              <option value="Double9">Double9</option>
               <option value="Double10">Double10</option>
       <option value="Triple1">Triple1</option>
       <option value="Triple2">Triple2</option>
       <option value="Triple3">Triple3</option>
       <option value="Triple4">Triple4</option>
       <option value="Triple5">Triple5</option>
       <option value="Triple6">Triple6</option>
       <option value="Triple7">Triple7</option>
       <option value="Triple8">Triple8</option>
       <option value="Triple9">Triple9</option>
       <option value="Triple10">Triple10</option>
       <option value="Triple11">Triple11</option>
       <option value="Quad1">Quad1</option>
       <option value="Quad2">Quad2</option>
       <option value="Quad3">Quad3</option>
       <option value="Quad4">Quad4</option>
       <option value="Quad5">Quad5</option>
       <option value="Quad6">Quad6</option>
       <option value="Quad7">Quad7</option>
       <option value="Quad8">Quad8</option>
       <option value="Quad9">Quad9</option>
       <option value="Quad10">Quad10</option>
       <option value="Quad11">Quad11</option>
       <option value="Quad12">Quad12</option>
       <option value="Quad13">Quad13</option>
        </select></div>

  </div>

   <div class="btn-vars__showcase">
  </div>

        </div><!--end row -->

<div class = "row">
  <div class = "col-md-4">

<div>
 <input type="text" name="Kd_Umroh" class="stacked-input" value="<?php echo $dataKodeUmroh ; ?>"  id="input-1" placeholder="Kode" required readonly="readonly">
  </div>

 <div>
 <input type="text" name="Paket_Program" class="stacked-input" value="<?php echo $dataUmroh; ?>"  id="input-1" placeholder="Umroh Packages" required readonly="readonly">
  </div>
<input name="jumlahpaket" type="hidden" value="1" />
  <div>
 <input type="text" name="Depart" class="stacked-input" value="<?php echo $dataKeberangkatan; ?>"  id="input-1" placeholder="depart" required readonly="readonly">
  </div>

  <div>
 <input type="text" name="Arrival" class="stacked-input" value="<?php echo $dataArrival; ?>"  id="input-1" placeholder="Arrival" required readonly="readonly">
  </div>
  <br>

  

  <div>
 <input type="text" name="Passport" class="stacked-input" value="<?php echo "$dataPassport";?>"  id="input-1" placeholder="No Passport" >
  </div>

<div>
 <input type="text" name="txtPoi" class="stacked-input" value="<?php echo "$dataPoi";?>"  id="input-1" placeholder="Place Of Issue" >
  </div>

  <div>
  <input name="txtDoi" type="date" onchange=this.form.submit()  id="myDate"  value="<?php echo "$dataDoi";?>" placeholder="Date" class="col-xs-10 col-sm-5" /> <i style='font-size:60px;' class="pe-7f-date"></i> <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Date Of Issue Passport  </label>
  </div>
 
   <div>
  <input style="width: 60%"  name="txtExpired" type="text" id="myDate"  value=" <?php echo $tgl2; //print tanggal ?>" class="col-xs-10 col-sm-5" /> <i style='font-size:60px;' class="pe-7f-date"></i> <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Expired Of Issue Passport  </label>
  </div>

  <div>
<input type="text" name="Mahrom" class="stacked-input" value="<?php echo "$dataMahrom";?>"  id="input-1" placeholder="Name of Mahrom" >

  </div>

   <div> 
  <select name="Mahrom_Status"  class="form-control" style=" height: 64px;" >
              <option value="<?php echo "$dataMahromStatus";?>"> -Select Status Relation for Mahrom-</option>
               <option value="Husband">Husband</option>
               <option value="Wife">Wife</option>
               <option value="Single">Single</option>
               <option value="Mohther">Mother</option>
               <option value="Single">Father</option>
               <option value="Single">Single</option>
               <option value="Rifqoh/WG"> Rifqoh/WG</option>
               <option value="Child"> Child</option>
               <option value="Ikhwan"> Ikhwan</option>

        </select></div>





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
