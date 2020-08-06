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
  if (trim($_POST['mahrom_status'])=="") {
    $pesanError[] = "Data <b>status </b> tidak boleh kosong !";
  }


  # Baca Variabel Form

  $mahrom = $_POST['mahrom'];
$mahrom_status = $_POST['mahrom_status'];


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
    # SIMPAN PERUBAHAN DATA, Jika jumlah error pesanError tidak ada, simpan datanya

    $mySql  = "UPDATE track_jamaah SET    mahrom = '$mahrom',
                                  mahrom_status = '$mahrom_status'
          WHERE nomor_id ='".$_POST['txtKode']."'";
    $myQry  = mysql_query($mySql, $Link) or die ("Gagal query".mysql_error());
    if($myQry){
      echo "<meta http-equiv='refresh' content='0; url=?page=DataMahromBerkah'>";
    }
    exit;
  }
} // Penutup Tombol Simpan

# MENGAMBIL DATA YANG DIEDIT, SESUAI KODE YANG DIDAPAT DARI URL
$Kode = isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['txtKode'];
$mySql  = "SELECT *
FROM track_jamaah
WHERE nomor_id='$Kode'";
$myQry  = mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);

# MASUKKAN DATA DARI FORM KE VARIABEL TEMPORARY (SEMENTARA)
$dataKode = $myData['nomor_id'];
$dataMahrom  = isset($_POST['mahrom']) ? $_POST['mahrom'] : $myData['mahrom'];
$dataMahrom_status  = isset($_POST['mahrom_status']) ? $_POST['mahrom_status'] : $myData['mahrom_status'];




?>

<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta charset="utf-8">
    <title>Umroh - Berkah</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="icon" sizes="192x192" href="../img/Icon.png"/>
    <!-- Glazzed & Bootstrap -->
    <link rel="stylesheet" type="text/css" href="../css/main.min.css">
    <!-- Pixeden Icon Fonts -->
    <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
    <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all">




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

background: -webkit-linear-gradient(left, #0bd745 , #1cd88b); /* For Safari 5.1 to 6.0 */
background: -o-linear-gradient(right, #0bd745, #1cd88b); /* For Opera 11.1 to 12.0 */
background: -moz-linear-gradient(right, #0bd745, #1cd88b); /* For Firefox 3.6 to 15 */
background: linear-gradient(to right, #0bd745 , #1cd88b); /* Standard syntax (must be last) */
}

#grad2 {

                background: -webkit-linear-gradient(left, #1ac5fb , #1d72f1); /* For Safari 5.1 to 6.0 */
                background: -o-linear-gradient(right, #1ac5fb, #1d72f1); /* For Opera 11.1 to 12.0 */
                background: -moz-linear-gradient(right, #1ac5fb, #1d72f1); /* For Firefox 3.6 to 15 */
                background: linear-gradient(to right, #1ac5fb , #1d72f1); /* Standard syntax (must be last) */

}

</style>


<style type="text/css">
  p {
    color: red;
    font-size: 18px;  }
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
                        <span>Add/Edit Mahrom Berkah  </span>
                    </h1>
                    <ul class="main-header__breadcrumb">
                        <li><a href="?page=90" onclick="return false;"></a></li>

                    </ul>
                </div>




    <div class="row">

                    <div class="col-md-12">
                        <article class="widget">
  <div class="row">

          <div class="col-md-4">
            <article class="widget widget__form">

  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" class="form-horizontal" role="form">
              <div class="widget__content">
                <input type="text" disabled="disabled" id="grad2">
                <input  name="txtKode" type="text" value="<?php echo $dataKode; ?>" id="form-field-1" placeholder="" class="col-xs-10 col-sm-5" readonly="readonly"/>
                <input  name="mahrom" type="text" value="" id="" placeholder="Add Name" class="col-xs-10 col-sm-5" />

              <div>
  <select name="mahrom_status"  class="form-control" style=" height: 64px;" >
              <option value="<?php echo "$dataMahrom_status";?>"> -<?php echo "$dataMahrom_status";?>-</option>
               <option value="Husband">Husband</option>
               <option value="Wife">Wife</option>
               <option value="Single">Single</option>
               <option value="Mohther">Mother</option>
               <option value="Single">Father</option>
               <option value="Single">Single</option>
               <option value="Rifqoh/WG"> Rifqoh/WG</option>
               <option value="Child"> Child</option>
               <option value="Ikhwan"> Ikhwan</option>
               <option value="Single"> Single</option>
               <option value="">--</option>

        </select></div>
                                <button id="grad2" type="submit" name="btnSimpan" value=" Submit " class="btn btn-info" type="button">

                        Submit
                      </button>

            </div>
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
