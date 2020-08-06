<!DOCTYPE html>


<?php
session_start();
if($_SESSION['FirstName'] == '') {header('Location: ?page=Channel_Payment');} ;
include_once "../library/inc.library.php";
include_once "../library/inc.pilihan.php";
include_once "../library/inc.tanggal.php";

require('../config/travel-config.php'); //Load DB(mysql) config parameter

$Travel= $_SESSION['Travel'];


# Tombol Simpan diklik
if(isset($_POST['btnSimpan'])){
  # Validasi form, jika kosong sampaikan pesan error
  $pesanError = array();



  if (trim($_POST['Payment_USD'])=="") {
    $pesanError[] = "Data <b>Nama</b> tidak boleh kosong !";
  }




  # Baca Variabel Form


  $Payment_IDR    = $_POST['Payment_IDR'];
  $Payment_USD   = $_POST['Payment_USD'];
  $metode_status =  $_POST['metode_status'];
  $metode_pay_IDR =  $_POST['metode_pay_IDR'];
  $metode_pay_USD =  $_POST['metode_pay_USD'];
    $Kd_Umroh =  $_POST['Kd_Umroh'];

  $NomorID= isset($_GET['NomorID']) ?  $_GET['NomorID'] : '';


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
  	// simpan  ke transaksi umroh USD
    // Jika tidak menemukan error, simpan data ke database
    $umroh =$myData['kd_umroh'];
    $staff =$_SESSION['FirstName'];
    $trxu_kode = buatKode("trax_umroh", "trxu-");
    $mySql  = "INSERT INTO `trax_umroh` (trax_umroh_id, input_traxu, nomor_id,  payment, kd_umroh,
                                      metode_pay, staff)
                              VALUES ('$trxu_kode', NOW(), '$NomorID', '$Payment_USD', '$Kd_Umroh',
                              '$metode_pay_USD', '$staff')";

    $myQry  = mysql_query($mySql, $Link) or die ("Gagal query".mysql_error());

    // Skrip Update stok
      $stokSql = "UPDATE track_jamaah SET   status_pay = '$metode_status'
                                  WHERE nomor_id='$NomorID'";
      mysql_query($stokSql, $Link) or die ("Gagal Query Edit Stok".mysql_error());



    // data ke transaksi perlengkapan IDR
     $trxp_kode = buatKode("trax_perlengkapan", "trxp-");
    $Sql  = "INSERT INTO `trax_perlengkapan` (trax_perlengkapan_id, input_traxp, nomor_id,  payment_perlengkapan, metode_pay_perlengkapan, staff)
                              VALUES ('$trxp_kode', NOW(), '$NomorID', '$Payment_IDR',
                              '$metode_pay_IDR', '$staff')";

    $myQry  = mysql_query($Sql, $Link) or die ("Gagal query".mysql_error());

if($myQry){
      echo "<meta http-equiv='refresh' content='0; url=?page=Invoice_Berkah'>";
    }
    exit;
  }
} // Penutup Tombol Simpan


// Membaca Nomor Umroh
$NomorID= isset($_GET['NomorID']) ?  $_GET['NomorID'] : '';
$mySql  = "SELECT track_jamaah.*, paket_umroh.nama_paket,paket_umroh.depart_umroh,paket_umroh.harga_umroh,paket_umroh.harga_perlengkapan, paket_umroh.currency,
                    trax_umroh.payment, paket_umroh.harga_triple, paket_umroh.harga_double
 FROM track_jamaah
 LEFT JOIN paket_umroh on track_jamaah.kd_umroh=paket_umroh.kd_umroh
  LEFT JOIN trax_umroh on track_jamaah.nomor_id=trax_umroh.nomor_id
 WHERE track_jamaah.nomor_id='$NomorID'";
$myQry  = mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);
$dataKodeID  = $myData['nomor_id'];
$dataFirstName  = $myData['first_name'] ;
$dataLastName  = $myData['last_name'] ;
$dataSurName  = $myData['surname'] ;
// data paket
$dataPaket  = $myData['nama_paket'] ;
$dataHargaUmroh  = $myData['harga_umroh'] ;
$dataHargaPerlengkapan  = $myData['harga_perlengkapan'] ;


// data untuk menentukan harga paket dari kamar
$totalBayarUmroh = 0;
  $Kamar = $myData['room'];
  $DD = $myData['harga_double'];
  $TT = $myData['harga_triple'];
  $QQ = $myData['harga_umroh'];

  if ($Kamar == Triple) {
    $hasilharga="$TT";
  }
  if ($Kamar == Quad) {
    $hasilharga="$QQ";
  }
  if ($Kamar == Double) {
    $hasilharga="$DD";
  }

  $totalBayarUmroh = $totalBayarUmroh + $hasilharga;


# Nomor Id
if($NomorID=="") {
  $NomorID= isset($_POST['NomorID']) ? $_POST['NomorID'] : '';
}

# VARIABEL DATA UNTUK DIBACA FORM
$dataKodetrxu = buatKode("trax_umroh", "trxu-");
$dataKodetrxp = buatKode("trax_perlengkapan", "trxp-");
$dataKd_Umroh = isset($_POST['Kd_Umroh']) ? $_POST['Kd_Umroh'] : $myData['kd_umroh'];
$dataPaymentUSD = isset($_POST['Payment_USD']) ? $_POST['Payment_USD'] : '';
$dataPaymentIDR = isset($_POST['Payment_IDR']) ? $_POST['Payment_IDR'] : '';
$dataMetodeStatus  = isset($_POST['metode_status']) ? $_POST['metode_status'] : $myData['metode_status'];
$dataMetodeUSD  = isset($_POST['metode_pay_USD']) ? $_POST['metode_pay_USD'] : '';
$dataMetodeIDR  = isset($_POST['metode_pay_IDR']) ? $_POST['metode_pay_IDR'] : '';


?>
<html>
<head>
 <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="utf-8">
    <title>Umroh - Management</title>
   <link rel="icon" sizes="192x192" href="../img/Icon.png"/>
    <!-- Glazzed & Bootstrap -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/main.min.css">
    <!-- Pixeden Icon Fonts -->
    <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
    <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-stroke.css">
    <link rel="stylesheet" type="text/css" href="../plugins/tigra_calendar/tcal.css"/>

<style type="text/css">

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
</style>
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
            	<span>Channel Bill</span>
          		</h1>
       		 	</div>

			</header>
			 <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" class="form-horizontal widget widget__form" role="form">
			 <div class="main-header__nav">

    <p>Bill To : <?php echo $dataFirstName; ?> <?php echo $dataLastName; ?> <?php echo $dataSurName; ?></p>
    <br>

    <p>Number ID : <input name="textfield" type="text" name="ID" class="stacked-input" value="<?php echo $NomorID; ?>"  id="input-1" placeholder="ID Jamaah" required readonly="readonly"></p>
    <p>Status <select name="metode_status"  class="form-control" style=" height: 35px;" required >
            <option value="<?php echo "$dataMetodeStatus";?>"> <?php echo "$dataMetodeStatus";?></option>
             <option value="DP">DP</option>
             <option value="PAID">PAID</option>
      </select></p>
       		 	</div>
       		 	<hr>
            <table class="table table-striped media-table">
							  	<thead>
							  		<tr>
							  			<th><strong style="font-weight: bold;"><center>No Trx</center></strong></th>
							  			<th><strong style="font-weight: bold;"><center>Desc</center></strong></th>
							  			<th><strong style="font-weight: bold;"><center>Basic Price </center></strong></th>
							  			<th><strong style="font-weight: bold;"><center>Payment (Fill in only numbers)</center></strong></th>
							  			<th><strong style="font-weight: bold;"><center>Method</strong></th>
							  			<th><strong style="font-weight: bold;"><center> &nbsp;</center></strong></th>

							  			<th style="display : none"></th>
							  		</tr>
								 	</thead>

							  	<tbody>
							  	<tr class="spacer"></tr>
							  	<tr>
							  	<td><input name="textfield" type="text" class="stacked-input" value="<?php echo $dataKodetrxu; ?>"  id="input-1" placeholder="No transcation" required readonly="readonly">
                  </td>
							  	<td>
							  	    Packages Umroh <?php echo $myData['kd_umroh']; ?> <hr>
                      <input name="Kd_Umroh"  type="hidden" name="ID" class="stacked-input" value="<?php echo $myData['kd_umroh']; ?>"  id="input-1" placeholder="" required>
                      room <?php echo $myData['room']; ?>

							  	</td>

							     <td >
							      <font color ="red"><?php echo $myData['currency']; ?>. <?php echo format_angka("$totalBayarUmroh");?></font> <hr>
                    Payment = <?php
                		$myQry = mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
                		$grandTotal = 0;
                		while ($myData = mysql_fetch_array($myQry)) {
                			$Kode = $myData['nomor_id'];

                			 $grandTotal = $grandTotal + $myData['payment'];
                		 }
               echo format_angka($grandTotal);?> <hr>


              <font color="yellow"> Rest of Bill = <?php
               $sisaTagihanUmroh = $totalBayarUmroh - $grandTotal;

             echo format_angka( $sisaTagihanUmroh); ?> </font>
							     </td>

							     <td align ="right" class="widget widget__form" >
							      <input name="Payment_USD" type="number" name="ID" class="stacked-input" value=""  id="input-1" placeholder="Payment Packages" required>
							     </td>

							     <td align ="right">
			<select name="metode_pay_USD"  class="form-control" style=" height: 35px;" required >
              <option value="<?php echo "$dataMetodeUSD";?>"> Select Status*</option>
               <option value="Transfer">Transfer</option>
               <option value="Cash">Cash</option>
               <option value="No Payment">No Payment</option>
        </select>
							     </td>

							     <td align ="right">
							         &nbsp;
							     </td>


							  	</tr>
							  	<tr class="spacer"></tr>
                                  <tr>
       <td><input name="textfield" type="text"  class="stacked-input" value="<?php echo $dataKodetrxp; ?>"  id="input-1" placeholder="No transcation" required readonly="readonly"></td>
							  	<td >
							  	    Equipment
							  	</td>

							     <td >
							       <font color ="red"> (IDR) <?php echo format_angka("$dataHargaPerlengkapan");?> </font>
							     </td>

							     <td align ="right" class="widget widget__form" >
							      <input name="Payment_IDR" type="number" name="ID" class="stacked-input" value=""  id="input-1" placeholder="Payment IDR" >
							     </td>

							     <td align ="right">
			<select name="metode_pay_IDR" required class="form-control" style=" height: 35px;" >
              <option value="<?php echo "$dataMetodeIDR";?>"> Select Status*</option>
               <option value="Transfer">Transfer</option>
               <option value="Cash">Cash</option>
                <option value="No Payment">No Payment</option>
        </select>
							     </td>

							     <td align ="right">
							           &nbsp;
							     </td>


							  	</tr>






                                </tbody>
            </table>
            <br>
            <hr>
           <button class="form-control"  type="submit" name="btnSimpan" value=" Submit " class="btn btn-info" type="button" onclick="return confirm('IS IT ALREADY CORRECT ... ?')">Save</button>
            </form>


			<footer class="footer-brand">
					<?php include "footer.php"; ?>
			</footer>
		</section> <!-- /content -->

	<script type="text/javascript" src="../js/main.js"></script> <!-- Loading -->
	<script type="text/javascript" src="../js/amcharts/amcharts.js"></script>
	<script type="text/javascript" src="../js/amcharts/serial.js"></script>
	<script type="text/javascript" src="../js/amcharts/pie.js"></script>
	<script type="text/javascript" src="../js/chartz.js"></script>

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
