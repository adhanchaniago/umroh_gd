<?php
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";

# Baca noNota dari URL
if(isset($_GET['nomorTransaksi'])){
	$nomorTransaksi = $_GET['nomorTransaksi'];
	
	// Perintah untuk mendapatkan data dari tabel rawat
	$mySql = "SELECT rawat.*, petugas.nm_petugas,pelanggan.nm_pelanggan,pelanggan.depart,pelanggan.nm_tengah,pelanggan.nm_akhir  FROM rawat
				LEFT JOIN petugas ON rawat.kd_petugas=petugas.kd_petugas 
        LEFT JOIN pelanggan ON rawat.nomor_ip=pelanggan.nomor_ip
				WHERE no_rawat='$nomorTransaksi'";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$kolomData = mysql_fetch_array($myQry);
}
else {
	echo "ID Pelanggan (nomor IP) tidak ditemukan";
	exit;
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cetak Nota Kwintansi Pembayaran - PT.ARBA TOUR</title>
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
	window.print();
	window.onfocus=function(){ window.close();}
</script>
</head>
<body onLoad="window.print()">
<table class="table-list" width="600" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td height="87" colspan="4" align="center">
		<strong>ARBA TOUR </strong><br />
        <strong> Jl.Buah Batu No.201E, Turangga Lengkong , Bandung </strong><br />
        <strong>Telp. (022)- 7332220 - 7302199 </strong><br />
        BANDUNG 40264, JAWA BARAT </td>
  </tr>
  <tr>
    <td colspan="2"><strong>No. Nota :</strong> <?php echo $kolomData['no_rawat']; ?></td>
    <td colspan="2" align="right"> <?php echo IndonesiaTgl($kolomData['tgl_rawat']); ?></td>
  </tr>
  <tr>
    <td width="23" ><strong>&nbsp;</strong></td>
    <td width="307" ><strong>Keterangan : </strong></td>
    <td width="174" ><strong>&nbsp;</strong></td>
    <td width="80" align="right"><strong><?php echo $kolomData['hasil_diagnosa']; ?></strong></td>
  </tr>
  <tr>
    <td width="23" ><strong>&nbsp;</strong></td>
    <td width="307" ><strong>Jatuh Tempo Pembayaran : </strong></td>
    <td width="174" ><strong>&nbsp;</strong></td>
    <td width="80" align="right"><strong>&nbsp;</strong></td>
  </tr>
  <tr>
    <td width="23" ><strong>&nbsp;</strong></td>
    <td width="307" ><strong>Keberangkatan : </strong></td>
    <td width="174" ><strong>&nbsp;</strong></td>
    <td colspan="2" align="right"><strong><?php echo IndonesiaTgl($kolomData['depart']); ?></strong></td>
  </tr>
  <tr>
    <td width="23" bgcolor="#F5F5F5"><strong>No</strong></td>
    <td width="307" bgcolor="#F5F5F5"><strong>Rincian </strong></td>
    <td width="174" bgcolor="#F5F5F5"><strong>keterangan Pembayaran </strong></td>
    <td width="80" align="right" bgcolor="#F5F5F5"><strong>harga</strong></td>
  </tr>
<?php
# Baca variabel
$totalBayar = 0; 
$uangKembali=0;

# Menampilkan List Item tindakan yang dibeli untuk Nomor Transaksi Terpilih
$notaSql = "SELECT rawat_paket.*, tindakan.nm_tindakan, type.nm_type 
			FROM rawat_paket
			LEFT JOIN tindakan ON rawat_paket.kd_tindakan=tindakan.kd_tindakan 
			LEFT JOIN type ON rawat_paket.kd_type=type.kd_type
			WHERE rawat_paket.no_rawat='$nomorTransaksi'
			ORDER BY tindakan.kd_tindakan ASC";
$notaQry = mysql_query($notaSql, $koneksidb)  or die ("Query list salah : ".mysql_error());
$nomor  = 0;  
while ($notaData = mysql_fetch_array($notaQry)) {
$nomor++;
	$totalBayar	= $totalBayar + $notaData['harga'];
	$uangKembali= $kolomData['uang_bayar'] - $totalBayar;
?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $notaData['kd_tindakan']; ?>/ <?php echo $notaData['nm_tindakan']; ?></td>
    <td><?php echo $notaData['nm_type']; ?></td>
    <td align="right"</td>
  </tr>
<?php } ?>
  <tr>
    <td colspan="3" align="right"><strong>Total Harga ($) : </strong></td>
    <td align="right" bgcolor="#F5F5F5"><?php echo format_angka($totalBayar); ?></td>
  </tr>
  <tr>
    <td colspan="3" align="right"><strong> Pembayaran ($) : </strong></td>
    <td align="right"><?php echo format_angka($kolomData['uang_bayar']); ?></td>
  </tr>
  <tr>
    <td colspan="3" align="right">
	<strong>
	<?php 
	// membuat keterangan status Uang Kembali / Uang Hutang
	if($kolomData['uang_bayar'] < $totalBayar) {
		echo "Kurang Pembayaran ($) : ";
	}
	else {
		echo "Kembali ($) : ";
	}; ?></strong></td>
    <td align="right"><?php echo format_angka($uangKembali); ?></td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>

  <tr>
    <td colspan="3"> &nbsp;PT.ARBA TOUR :</td>  <td colspan="1" align="left"> CUSTOMER </td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><?php echo $kolomData['nm_petugas']; ?></td> <td colspan="2" align="right"><?php echo $kolomData['nm_pelanggan']; ?> <?php echo $kolomData['nm_tengah']; ?> <?php echo $kolomData['nm_akhir']; ?></td>
  </tr>
  
</table>
</body>
</html>

