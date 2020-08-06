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
  if (trim($_POST['Room'])=="") {
    $pesanError[] = "Data <b>Room </b> Empty !";
  }


  # Baca Variabel Form

  $Room = $_POST['Room'];
  $Nomor_Room = $_POST['Nomor_Room'];


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

    $mySql  = "UPDATE jamaah SET   room = '$Room', nomor_room = '$Nomor_Room'
          WHERE nomor_id ='".$_POST['txtKode']."'";
    $myQry  = mysql_query($mySql, $Link) or die ("Gagal query".mysql_error());
    if($myQry){
      echo "<meta http-equiv='refresh' content='0; url=?page=DataRoomlistIncentive'>";
    }
    exit;
  }
} // Penutup Tombol Simpan

# MENGAMBIL DATA YANG DIEDIT, SESUAI KODE YANG DIDAPAT DARI URL
$Kode = isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['txtKode'];
$mySql  = "SELECT * FROM jamaah WHERE nomor_id='$Kode'";
$myQry  = mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);

# MASUKKAN DATA DARI FORM KE VARIABEL TEMPORARY (SEMENTARA)
$dataKode = $myData['nomor_id'];
$dataNomorRoom  = isset($_POST['Nomor_Room']) ? $_POST['Nomor_Room'] : $myData['nomor_room'];
$dataRoom  = isset($_POST['Room']) ? $_POST['Room'] : $myData['room'];




?>

<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta charset="utf-8">
    <title>Umroh - Incentive</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="icon" sizes="192x192" href="../img/Icon.png"/>
    <!-- Glazzed & Bootstrap -->
    <link rel="stylesheet" type="text/css" href="../css/main.min.css">
    <!-- Pixeden Icon Fonts -->
    <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
    <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-stroke.css">




</head>
<body>
<style type="text/css">

        .widget__form input[type=number] {
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
                        <span>Data Roomlist Incentive  </span>
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
                <input  name="txtKode" type="text" value="<?php echo $dataKode; ?>" id="form-field-1" placeholder="" class="col-xs-10 col-sm-5" readonly="readonly"/>



      <select name="Room" class="chosen-select form-control" id="form-field-select-3" data-placeholder="Choose a State...">
        <option value="<?php echo "$dataRoom"; ?>">--</option>
        <?php
            $pilihan  = array("Quad", "Triple", "Double");
               foreach ($pilihan as $nilai) {
                 if ($dataRoom ==$nilai) {
                     $cek=" selected";
                 } else { $cek = ""; }
                 echo "<option value='$nilai' $cek>$nilai</option>";
               }
               ?>
             </select>

 <input name="Nomor_Room" type="number" value="<?php echo "$dataNomorRoom"; ?>" id="form-field-1" placeholder="" class="col-xs-10 col-sm-5" />




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
if(isset($_SESSION["Travel"])) {
  exit;
}
else {
  echo "<meta http-equiv='refresh' content='0; url=../modul/logout.php'>";
}
?>
