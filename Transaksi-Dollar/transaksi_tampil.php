<?php
include_once "../library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM rawat";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?><table width="800" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td width="5" align="right">&nbsp;</td>
    <td colspan="2" align="right"><h1><b>COSTUMER TRANSACTION DATA </b></h1></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">
	<table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <th width="29" align="center"><strong>No</strong></th>
        <th width="102"><strong>No Transaction</strong></th>
        <th width="103"><strong>Date </strong></th>
        <th width="133"><strong>ID  </strong></th>
        <th width="291"><strong>Name </strong></th>
        <th width="291"><strong>Notice </strong></th>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
      </tr>
      <?php
	$mySql = "SELECT rawat.*, pelanggan.nm_pelanggan
				FROM rawat 
				LEFT JOIN pelanggan ON rawat.nomor_ip = pelanggan.nomor_ip
				ORDER BY no_rawat DESC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['no_rawat'];
	?>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $myData['no_rawat']; ?></td>
        <td><?php echo IndonesiaTgl($myData['tgl_rawat']); ?></td>
        <td><?php echo $myData['nomor_ip']; ?></td>
        <td><?php echo $myData['nm_pelanggan']; ?></td>
        <td><?php echo $myData['hasil_diagnosa']; ?></td>
        <td width="45" align="center"><a href="dollar_nota.php?nomorTransaksi=<?php echo $Kode; ?>" target="_blank">Nota</a></td>
        <td width="45" align="center"><a href="?page=Rawat-Hapus&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ARE YOU SURE TO DELETE IT ... ?')">Delete</a></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
  <tr class="selKecil">
    <td>&nbsp;</td>
     <td><b>Amount Of Data :</b> <?php echo $jml; ?> </td>
    <td width="480" align="right"><b>Page:</b>
      <?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Transaksi-Tampil&hal=$list[$h]'>$h</a> ";
	}
	?></td>
  </tr>
</table>
