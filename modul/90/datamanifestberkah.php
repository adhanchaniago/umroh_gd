<!DOCTYPE html>

<?php
session_start();
if($_SESSION['FirstName'] == '90') {header('Location: ?page=90');} ;
include_once "../library/inc.library.php";
include_once "../library/inc.pilihan.php";
include_once "../library/inc.tanggal.php";

require('../config/travel-config.php'); //Load DB(mysql) config parameter

$Travel= $_SESSION['Travel'];




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

<script>
function printContent(el){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}
</script>

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
background: -webkit-linear-gradient(left, #1ac5fb , #1d72f1); /* For Safari 5.1 to 6.0 */
background: -o-linear-gradient(right, #1ac5fb, #1d72f1); /* For Opera 11.1 to 12.0 */
background: -moz-linear-gradient(right, #1ac5fb, #1d72f1); /* For Firefox 3.6 to 15 */
background: linear-gradient(to right, #1ac5fb , #1d72f1); /* Standard syntax (must be last) */
}

#grad2 {
                height: 50px;
                background: #fff; /* For Safari 5.1 to 6.0 */

}

th {
    background-color: #1ac5fb;
    color: white;
}

</style>


<?php
# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 99;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT track_jamaah.*, jamaah_daftar.first_name, jamaah_daftar.last_name, jamaah_daftar.surname,
jamaah_daftar.title,jamaah_daftar.birthdate,jamaah_daftar.no_pass,jamaah_daftar.poi, jamaah_daftar.doi,jamaah_daftar.expired,
jamaah_daftar.petugas, jamaah_daftar.travel
FROM track_jamaah
LEFT JOIN jamaah_daftar on track_jamaah.nomor_id=jamaah_daftar.nomor_id
WHERE packages_program='Berkah' ORDER BY mahrom; ";
$pageQry = mysql_query($pageSql, $Link) or die ("error paging: ".mysql_error());
$jml   = mysql_num_rows($pageQry);
$max   = ceil($jml/$row);

// Jika tombol Cari diklik
if(isset($_POST['btnCari'])){
  if($_POST) {
    // Cari berdasarkan Nomor RM dan Nama Pasien yang mirip
    $txtKataKunci = $_POST['txtKataKunci'];
    $mySql = "SELECT track_jamaah.*, jamaah_daftar.first_name, jamaah_daftar.last_name, jamaah_daftar.surname,
    jamaah_daftar.title,jamaah_daftar.birthdate,jamaah_daftar.no_pass,jamaah_daftar.poi, jamaah_daftar.doi,jamaah_daftar.expired,
    jamaah_daftar.petugas, jamaah_daftar.travel
    FROM track_jamaah
    LEFT JOIN jamaah_daftar on track_jamaah.nomor_id=jamaah_daftar.nomor_id
    WHERE depart LIKE '%$txtKataKunci%' and packages_program='Berkah'
          ORDER BY room ASC LIMIT $hal, $row";
  }
}
else {
  $mySql = "SELECT track_jamaah.*, jamaah_daftar.first_name, jamaah_daftar.last_name, jamaah_daftar.surname,
  jamaah_daftar.title,jamaah_daftar.birthdate,jamaah_daftar.no_pass,jamaah_daftar.poi, jamaah_daftar.doi,jamaah_daftar.expired,
  jamaah_daftar.petugas, jamaah_daftar.travel
  FROM track_jamaah
  LEFT JOIN jamaah_daftar on track_jamaah.nomor_id=jamaah_daftar.nomor_id
  WHERE packages_program='Berkah' ORDER BY mahrom ASC LIMIT $hal, $row";
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
                        <span>Data manifest Berkah  </span>
                    </h1>
                    <ul class="main-header__breadcrumb">
                        <li><a href="#" onclick="return false;"></a></li>

                    </ul>
                </div>
                <br>
  <a type="button" 	class="btn btn-default no-print" onclick="printContent('div1')" style="background: transparent;">Print </a>

                <div id="div1">


    <div class="row">

                    <div class="col-md-12">
                        <article class="widget">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1"  class="form-horizontal" role="form">
                            <select name="txtKataKunci" bgcolor="blue" class="btn blue ">
                                <option value="ok">--Select The Departure Date--</option>
                               <?php
    $bacaSql = "SELECT DISTINCT packages_program, depart FROM track_jamaah WHERE packages_program='Berkah'";
    $bacaQry = mysql_query($bacaSql, $Link) or die ("Gagal Query".mysql_error());
    while ($bacaData = mysql_fetch_array($bacaQry)) {
    if ($bacaData['depart'] == $dataKataKunci) {
      $cek = " selected";
    } else { $cek=""; }

    echo "<option value='$bacaData[depart]' $cek> [ $bacaData[depart] ]   $bacaData[packages_program]  </option>";
    }
    ?>
                                </select>

         <button  type="submit" name="btnCari" value="search"  class="btn blue no-print" type="submit">
                        Submit
                      </button>
            </form>

                        </article><!-- /widget -->
                    </div>

                </div> <!-- /row -->

    <div class="row" >

    <div class="col-md-12">
    <article class="widget">
<?php
  // Query SQL ada di bagian atas, kolom tombol Cari (btnCari)
  $myQry = mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
  $nomor = 0;
  while ($myData = mysql_fetch_array($myQry)) {
    $nomor++;
    $Kode = $myData['nomor_id'];




  ?>



   <?php } ?>

  <table width="100%" >
   <th style="text-align: left; width: 40%">
    <img src="../img/arba.png"; height="75px"; style="padding-top:3px ;padding-left:10px";>
    </th>
    <th style="text-align: left; width: 60%">
        <h3>Manifest</h3>
    </th>
</table>
<hr>
        <table width="100%" height="100%" border="1px" >

        <tr>
            <th style="text-align: center;">No</th>
            <th style="text-align: center;">Name</th>
            <th style="text-align: center;">Title</th>
            <th style="text-align: center;">DOB</th>
            <th style="text-align: center;">No Passport</th>
            <th style="text-align: center;">Issued Passport</th>
            <th style="text-align: center;">Exp Passport</th>
            <th style="text-align: center;">Issue Office</th>
            <th style="text-align: center;">Relation Status</th>

            </tr>

<?php
  // Query SQL ada di bagian atas, kolom tombol Cari (btnCari)
  $myQry = mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
  $nomor = 0;
  while ($myData = mysql_fetch_array($myQry)) {
    $nomor++;
    $Kode = $myData['nomor_id'];




  ?>


        <tr>
        <td><?php echo $nomor; ?></td>
         <td><?php echo $myData['first_name']; ?>&nbsp;<?php echo $myData['last_name']; ?>&nbsp;<?php echo $myData['surname']; ?></td>
        <td><?php echo $myData['title']; ?></td>
        <td><?php echo $myData['place_of_birth']; ?>&nbsp;<?php echo IndonesiaTgl($myData['birthdate']); ?></td>
        <td><?php echo $myData['no_pass']; ?></td>
        <td><?php echo IndonesiaTgl($myData['doi']); ?></td>
        <td><?php echo $myData['expired']; ?></td>
           <td><?php echo $myData['poi']; ?></td>
        <td><?php echo $myData['mahrom_status']; ?></td>

         </tr>
        <?php } ?>

         </table>



                        </article><!-- /widget -->
                    </div>

                </div> <!-- /row -->
</div>

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
