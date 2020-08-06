

<?php
require('../../config/travel-config.php');
include_once "../../library/inc.library.php";
include_once "../../library/inc.tanggal.php";
include_once "../../library/inc.pilihan.php";

if($_GET) {
	// Baca variabel URL
	$NomorJamaah= isset($_GET['NomorJamaah']) ?  $_GET['NomorJamaah'] : '';

	// Perintah membaca data Pasien
	$mySql	= "SELECT DISTINCT trax_umroh.*,paket_umroh.nama_paket,paket_umroh.depart_umroh,paket_umroh.harga_umroh,
  paket_umroh.currency,paket_umroh.harga_double,paket_umroh.harga_triple,paket_umroh.harga_perlengkapan,
	jamaah_daftar.first_name, jamaah_daftar.petugas, jamaah_daftar.travel, jamaah_daftar.birthdate, jamaah_daftar.gender,
	 jamaah_daftar.phone, jamaah_daftar.alamat, jamaah_daftar.status_jamaah, jamaah_daftar.last_name, jamaah_daftar.surname,
	 track_jamaah.packages_program, track_jamaah.kd_umroh, track_jamaah.depart,  track_jamaah.arrival, track_jamaah.room
  FROM trax_umroh
    LEFT JOIN paket_umroh on trax_umroh.kd_umroh=paket_umroh.kd_umroh
		  LEFT JOIN jamaah_daftar on trax_umroh.nomor_id=jamaah_daftar.nomor_id
			LEFT JOIN track_jamaah on trax_umroh.nomor_id=track_jamaah.nomor_id

  WHERE trax_umroh.nomor_id='$NomorJamaah'";
	$myQry	= mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
	$myData = mysql_fetch_array($myQry);



}else {
	echo "Nomor ID Jamaah Tidak Terbaca";
	exit;
}

$Kode = $myData['nomor_id'];




// Tanggal Lahir
  $birthday =  $myData['birthdate'];

  // Convert Ke Date Time
  $biday = new DateTime($birthday);
  $today = new DateTime();

  $diff = $today->diff($biday);


// data untuk menentukan harga paket dari kamar
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
	$totalBayarPerlengkapan = $totalBayarPerlengkapan + $myData['harga_perlengkapan'];
	$pembayaranUmrohSebelumnya = $myData['payment'];
	//$sisaTagihanUmroh = $totalBayarUmroh - $pembayaranUmrohSebelumnya;


	$pembayaranPerlengkapanSebelumnya = $myData['payment_perlengkapan'];
	$sisaTagihanPerlengkapan = $totalBayarPerlengkapan - $pembayaranPerlengkapanSebelumnya;



?>


<html>
<head>
	<style>
	body {padding:30px}
.print-area {border:1px solid red;padding:1em;margin:0 0 1em}

.button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
	</style>

      <br><hr>
<title>:: Data Of CLIENT | Travel Arba Tour</title>
<script>
function printContent(el){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}
</script>

<link href="../../styles/styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<body>
<style type="text/css">
	table, th, td {
 border: 1px solid black    ;
  padding-top: 5px;
  padding-left: 5px;
  padding-right: 5px;
  padding-bottom: 5px;
  border-radius: 5px;
    font-family: 'Raleway', sans-serif;
    font-size: 11px;
  }

.table-number {

  font-family: 'Roboto', sans-serif;
}
</style>
<a type="button" 	class="button no-print" onclick="printContent('div1')">Print </a>
<a type="button" 	class="button no-print"  href="#">Email</a>
<div id="div1">
<table width="100%" border="1px">
<tr>
<td>
<img src='../../img/arba.png' height='80' border='0' title='' />
</td>
<td>
<font align="left"> Detail Invoice : <font color="red"> <b><?php echo $myData['nomor_id']; ?></b> </font> </font><br>
<font align="left">Program : <?php echo $myData['nama_paket']; ?> <?php echo $myData['desc_umroh']; ?></font><br>
<font align="left">Group : <?php echo $myData['travel']; ?> - <?php echo $myData['petugas']; ?></font><br>
<font align="left">Schedule : <?php echo IndonesiaTgl($myData['depart_umroh']); ?> - <?php echo $myData['arrival']; ?></font><br>
<font align="left">Name : <?php echo $myData['first_name']; ?>  <?php echo $myData['last_name']; ?>  <?php echo $myData['surname']; ?></font><br>
<span><?php echo  $diff->y ." Age"; ?> (<?php echo $myData['gender']; ?> - <?php echo $myData['status_jamaah']; ?>)</span>
</td>
<td>
<font align="left"> address : </font><br>
<font align="left"><?php echo $myData['alamat']; ?></font><br>
<font align="left">Hp:<?php echo $myData['phone']; ?></font>
</td>
</tr>
</table>

<table width="100%" cellpadding="4" cellspacing="2" class="" border="1px" >
	 <tr>
    <td rowspan="2" witdh="" bgcolor="#CCCCCC" align="center"><strong>No.</strong> </td>
	 <td  rowspan="2" witdh="" bgcolor="#CCCCCC"  align="center"><strong>No Trancation</strong> </td>
    <td rowspan="2" witdh="5%" bgcolor="#CCCCCC"  align="center"><strong>Desc</strong> </td>
	  <td colspan="2"  bgcolor="#CCCCCC"  align="center"><strong>Total</strong></td>
    </tr>
	<tr>
	  <td witdh="5%"  bgcolor="#CCCCCC"  align="center"><strong><?php echo $myData['currency']; ?></strong></td>
	  <td witdh="5%"  bgcolor="#CCCCCC"  align="center"><strong>IDR</strong></td>
	<tr>
      <td align="center"><strong>1 </strong></td>
	  <td><strong><?php echo $myData['nomor_id'];  ?></strong></td>
    <td><strong>Equipment + Handling</strong></td>
	  <td align="right"></td>
      <td  align="right"> <?php echo format_angka($myData['harga_perlengkapan']); ?></td>
    </tr>
	<tr>
      <td align="center"> <b>2</b></td>
      <td><b><?php echo $myData['nomor_id'];  ?></b></td>
	  <td><b>Paket Dasar (<?php echo $myData['room']; ?>)</b></td>
	  <td align="right"><?php echo format_angka($hasilharga); ?> </td>
	  <td align="right"></td>
    </tr>

	<tr>
	  <td bgcolor="#CCCCCC">&nbsp;</td>
	  <td bgcolor="#CCCCCC">&nbsp;</td> <td align="right" bgcolor="#CCCCCC"><b>Total Bill</b> </td>
	  <td  align="right" bgcolor="#CCCCCC"><?php echo format_angka($totalBayarUmroh); ?> </td> <td align="right" bgcolor="#CCCCCC"><?php echo format_angka($totalBayarPerlengkapan); ?></td>

    </tr>

    <tr>
	  <td><strong></strong> </td>
	  <td>&nbsp;</td> <td align="right" bgcolor="#CCCCCC"><font color="red"><b>Total previous payment</b></font></td>

	  <td  align="right" bgcolor="#CCCCCC"><font color="red"><?php

		$myQry = mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
		$grandTotal = 0;
		while ($myData = mysql_fetch_array($myQry)) {
			$Kode = $myData['nomor_id'];

			 $grandTotal = $grandTotal + $myData['payment'];
		 }

 echo format_angka($grandTotal);?> </font> </td>

		 <td  align="right" bgcolor="#CCCCCC">
			 <font color="red"><?php

			 $myQry = mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
			 $grandTotal1 = 0;
			 while ($myData = mysql_fetch_array($myQry)) {
			 	$Kode = $myData['nomor_id'];

			 	 $grandTotal1 = $grandTotal1 + $myData['payment_perlengkapan'];
			  }

			 echo format_angka($grandTotal1);?> </font>

		 </td>

    </tr>
	<tr>
      <td><strong>&nbsp; </strong></td>
	  <td>&nbsp;</td> <td align="right" bgcolor="#CCCCCC"><b>Rest of the bill</b></td>
	  <td  align="right" bgcolor="#CCCCCC"><font color="">
			<?php
			$sisaTagihanUmroh = $totalBayarUmroh - $grandTotal;

		echo format_angka( $sisaTagihanUmroh); ?> </font> </td>
		<td align="right"><strong>
					<?php

echo format_angka( $sisaTagihanPerlengkapan);
			?> </strong></td>
    </tr>
	<tr>

    <tr>
        <td><strong>&nbsp; </strong></td>
  	  <td><strong>&nbsp;</strong></td>
  	  <td>&nbsp;</td>
  	  	   <td><strong> </strong></td> <td><strong>&nbsp;</strong></td>
      </tr>
		</table>
		<hr>
		<table width="100%" border="1px">
			<thead>
  	<tr>
      <th colspan="5" bgcolor="#CCCCCC"><strong>Details Payment Packages</strong></th>

	</tr>
	<tr>
      <th rowspan="2" align="center"><strong>No. </strong></th>
	  <th rowspan="2" align="center"><strong>No.Trx</strong></td>
	  <th rowspan="2" align="center"><strong>Date / Methode</strong></td>
	   <th colspan="" align="center"><strong>Amount</strong></th>
    </tr>

    <tr>

  	   <th align="center"><strong>Nominal </strong></td>

			</tr>
		</thead>
		<?php
	  // Query SQL ada di bagian atas, kolom tombol Cari (btnCari)
	  $myQry = mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
	  $nomor = 0;
		$grandTotal = 0;
	  while ($myData = mysql_fetch_array($myQry)) {
	    $nomor++;
	    $Kode = $myData['nomor_id'];

			 $grandTotal = $grandTotal + $myData['payment'];
	  ?>

<tbody >
		  <tr>
          <td align="center"><strong><?php echo $nomor; ?></strong></td>
    	  <td><strong><?php echo $myData['trax_umroh_id']; ?> </strong></td>
    	  <td><strong><?php echo IndonesiaTgl($myData['input_traxu']); ?>/ <?php echo $myData['metode_pay'];  ?></strong></td>
    	 <td align="right"><strong><?php echo $myData['payment'];  ?> </strong></td>
</tbody>
  <?php } ?>
<tfoot>
	<tr>
		<td align="center" colspan="3"><strong>Total Payment</strong></td>
	 <td align="right"><strong>

		  <?php echo $grandTotal;  ?></strong></td>
		</tr>
</tfoot>
</table>

<?php
$mySql	= "SELECT DISTINCT trax_perlengkapan.*,paket_umroh.nama_paket,paket_umroh.depart_umroh,paket_umroh.harga_umroh,
paket_umroh.currency,paket_umroh.harga_double,paket_umroh.harga_triple,paket_umroh.harga_perlengkapan,
jamaah.first_name, jamaah.room, jamaah.petugas, jamaah.travel, jamaah.arrival, jamaah.birthdate, jamaah.gender,
 jamaah.phone, jamaah.alamat, jamaah.status_jamaah, jamaah.last_name, jamaah.surname
FROM trax_perlengkapan
	LEFT JOIN paket_umroh on trax_perlengkapan.kd_umroh=paket_umroh.kd_umroh
		LEFT JOIN jamaah on trax_perlengkapan.nomor_id=jamaah.nomor_id

WHERE trax_perlengkapan.nomor_id='$NomorJamaah'";
$myQry	= mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);

 ?>

<table width="100%" border="1px">
	<thead>
<tr>
	<th colspan="5" bgcolor="#CCCCCC"><strong>Details Payment Equipment</strong></th>

</tr>
<tr>
	<th rowspan="2" align="center"><strong>No. </strong></th>
<th rowspan="2" align="center"><strong>No.Trx</strong></td>
<th rowspan="2" align="center"><strong>Date / Methode</strong></td>
 <th colspan="" align="center"><strong>Amount</strong></th>
</tr>

<tr>
	<td align="center"><strong>Nominal</strong></th>
	</tr>
</thead>
<?php
// Query SQL ada di bagian atas, kolom tombol Cari (btnCari)
$myQry = mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
$nomor = 0;
$grandTotal = 0;
while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
	$Kode = $myData['nomor_id'];

?>

<tbody >
	<tr>
			<td align="center"><strong><?php echo $nomor; ?></strong></td>
		<td><strong><?php echo $myData['trax_perlengkapan_id']; ?></strong></td>
		<td><strong><?php echo $myData['input_traxp'];  ?>/<?php echo $myData['metode_pay_perlengkapan'];  ?></strong></td>
	<td align="right"><strong><?php echo $myData['payment_perlengkapan'];  ?> </strong></td>
		</tr>
</tbody>
<?php } ?>
<tfoot>
<tr>
<td align="center" colspan="3"><strong>Total Payment</strong></td>
<td align="right"><strong><?php
$myQry = mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
$grandTotal1 = 0;
while ($myData = mysql_fetch_array($myQry)) {
 $Kode = $myData['nomor_id'];

	$grandTotal1 = $grandTotal1 + $myData['payment_perlengkapan'];
 }

 echo $grandTotal1;  ?></strong></td>
</tr>
</tfoot>
</table>
</div>
</form>
