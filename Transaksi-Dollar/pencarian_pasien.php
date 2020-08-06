<?php
include_once "../library/inc.seslogin.php";

// Membaca variabel form
$KeyWord	= isset($_GET['KeyWord']) ? $_GET['KeyWord'] : '';
$dataCari	= isset($_POST['txtCari']) ? $_POST['txtCari'] : $KeyWord;

// Jika tombol Cari diklik
if(isset($_POST['btnCari'])){
	if($_POST) {
		$filterSql = "WHERE nomor_ip LIKE '%$dataCari%'";
	}
}
else {
	if($KeyWord){
		$filterSql = "WHERE nm_pelanggan LIKE '%$dataCari%'";
	}
	else {
		$filterSql = "";
	}
} 

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM pelanggan $filterSql";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<h2>Cari Pelanggan </h2>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <strong>Cari Nama Pelanggan :</strong>
  <input name="txtCari" type="text" value="<?php echo $dataCari; ?>" size="40" maxlength="100" />
  <input name="btnCari" type="submit" value="Cari" />
</form>
<table  class="table-list" width="700" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <th width="20" bgcolor="#CCCCCC">No</th>
    <th width="80" bgcolor="#CCCCCC"><strong>Nomor IP </strong></th>
    <th width="160" bgcolor="#CCCCCC"><strong>Nama Pelanggan </strong></th>
    <th width="60" bgcolor="#CCCCCC"><strong>Kelamin</strong></th>
    <th width="77" bgcolor="#CCCCCC"><strong>no.telp </strong></th>
    <th width="213" bgcolor="#CCCCCC"><strong>Alamat</strong></th>
    <td width="40" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
  </tr>
<?php
$mySql = "SELECT * FROM pelanggan $filterSql ORDER BY nomor_ip ASC LIMIT $hal, $row";
$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
$nomor = 0; 
while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $myData['nomor_ip']; ?></td>
    <td><?php echo $myData['nm_pelanggan']; ?> <?php echo $myData['nm_tengah']; ?> <?php echo $myData['nm_akhir']; ?> </td>
    <td><?php echo $myData['jns_kelamin']; ?></td>
    <td><?php echo $myData['no_telepon']; ?></td>
    <td><?php echo $myData['alamat']; ?></td>
    <td><a href="?page=Transaksi-Baru&NomorRM=<?php echo $myData['nomor_ip']; ?>" target="_self" alt="Rawat">Daftar</a></td>
  </tr>
<?php } ?>  
  <tr>
    <td colspan="3"><strong>Jumlah Data :</strong> </td>
    <td colspan="4" align="right"><strong>Halaman ke : </strong>
	<?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Pencarian-Pelanggan&hal=$list[$h]&KeyWord=$dataCari'>$h</a> ";
	}
	?></td>
  </tr>
</table>
