<?php
include_once "../library/inc.seslogin.php";

# HAPUS DAFTAR tindakan DI TMP
if(isset($_GET['Aksi'])){
	if(trim($_GET['Aksi'])=="Hapus"){
		# Hapus Tmp jika datanya sudah dipindah
		$id			= $_GET['id'];
		$userLogin	= $_SESSION['SES_LOGIN'];
		
		$mySql = "DELETE FROM tmp_rawat WHERE id='$id' AND kd_petugas='$userLogin'";
		mysql_query($mySql, $koneksidb) or die ("Gagal kosongkan tmp".mysql_error());
	}
	if(trim($_GET['Aksi'])=="Sucsses"){
		echo "<b>DATA BERHASIL DISIMPAN</b> <br><br>";
	}
}
// =========================================================================

# TOMBOL TAMBAH DIKLIK
if(isset($_POST['btnTambah'])){
	$pesanError = array();
	if (trim($_POST['cmbType'])=="KOSONG") {
		$pesanError[] = "Data <b>Nama Type</b> belum dipilih, harus Anda pilih dari combo !";		
	}
	if (trim($_POST['cmbTindakan'])=="KOSONG") {
		$pesanError[] = "Data <b>Nama Tindakan</b> belum dipilih, harus Anda pilih dari combo !";		
	}
	if (trim($_POST['txtHarga'])=="" or ! is_numeric(trim($_POST['txtHarga']))) {
		$pesanError[] = "Data <b>Harga Tindakan (Rp) belum diisi</b>, silahkan <b>isi dengan angka</b> !";		
	}

	# BACA VARIABEL DARI FORM INPUT tindakan
	$txtNomorRM	= $_POST['txtNomorRM'];
	
	$cmbType	= $_POST['cmbType'];
	$cmbTindakan= $_POST['cmbTindakan'];
	
	$txtHarga	= $_POST['txtHarga'];
	$txtHarga	= str_replace("'","&acute;",$txtHarga);
	$txtHarga	= str_replace(".","",$txtHarga);

	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
		echo "<img src='../images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div> <br>"; 
	}


		# SIMPAN DATA KE DATABASE (tmp_rawat)
		# Jika jumlah error pesanError tidak ada, skrip di bawah dijalankan
		$tmpSql 	= "INSERT INTO tmp_rawat (kd_tindakan, harga, kd_type,  kd_petugas) 
					   VALUES ('$cmbTindakan', '$txtHarga', '$cmbType', '".$_SESSION['SES_LOGIN']."')";
		mysql_query($tmpSql, $koneksidb) or die ("Gagal Query tmp : ".mysql_error());				

	}


# ========================================================================================================
# JIKA TOMBOL SIMPAN TRANSAKSI DIKLIK
if(isset($_POST['btnSimpan'])){
	$pesanError = array();
	if (trim($_POST['txtNomorRM'])=="") {
		$pesanError[] = "Data <b>Nomor Rekam Medik (RM)</b> belum diisi, silahkan klik <b>daftar pasien</b> !";		
	}
	if (trim($_POST['txtTanggal'])=="") {
		$pesanError[] = "Data <b>Tanggal Rawat</b> belum diisi, silahkan pilih pada kalender !";		
	}
	if (trim($_POST['txtUangBayar'])==""  or ! is_numeric(trim($_POST['txtUangBayar']))) {
		$pesanError[] = "Data <b> Uang Bayar (USD)</b> belum diisi, silahkan isi dengan uang (USD) !";		
	}

	# Validasi jika belum ada satupun data item yang dimasukkan
	$tmpSql ="SELECT COUNT(*) As qty FROM tmp_rawat WHERE kd_petugas='".$_SESSION['SES_LOGIN']."'";
	$tmpQry = mysql_query($tmpSql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
	$tmpData = mysql_fetch_array($tmpQry);
	if ($tmpData['qty'] < 1) {
		$pesanError[] = "<b>DAFTAR TINDAKAN MASIH KOSONG</b>, Daftar item tindakan belum ada yang dimasukan, <b>minimal 1 data</b>.";
	}

	# Baca variabel
	$txtTanggal 	= $_POST['txtTanggal'];
	$txtNomorRM		= $_POST['txtNomorRM'];
	$txtDiagnosa	= $_POST['txtDiagnosa'];
	$txtUangBayar	= $_POST['txtUangBayar'];
	$kurs	= $_POST['kurs'];
			
			
	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
		echo "<img src='../images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div> <br>"; 
	}
	else {
		# SIMPAN KE DATABASE
		# Jika jumlah error pesanError tidak ada, maka proses Penyimpanan akan dikalkukan
		
		// Membuat kode Transaksi baru
		$nomorRawat = buatKode("rawat", "D$");
		
		$tanggal	= InggrisTgl($_POST['txtTanggal']);
		$userLogin	= $_SESSION['SES_LOGIN'];
		
		// Skrip menyimpan data ke tabel transaksi utama
		$mySql	= "INSERT INTO rawat SET 
						no_rawat='$nomorRawat', 
						tgl_rawat='$tanggal', 
						nomor_ip='$txtNomorRM', 
						hasil_diagnosa='$txtDiagnosa', 
						kurs='$kurs',
						uang_bayar='$txtUangBayar', 
						kd_petugas='$userLogin'";
		mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());

		# Ambil semua data tindakan/tindakan yang dipilih, berdasarkan user yg login
		$tmpSql ="SELECT * FROM tmp_rawat WHERE kd_petugas='$userLogin'";
		$tmpQry = mysql_query($tmpSql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
		while ($tmpData = mysql_fetch_array($tmpQry)) {
			// Membaca data dari tabel TMP
			$kodeTindakan	= $tmpData['kd_tindakan'];
			$hargaTindakan	= $tmpData['harga'];
			$kodeType		= $tmpData['kd_type'];
			
			// Masukkan semua tindakan dari TMP ke tabel rawat detail
			$itemSql = "INSERT INTO rawat_paket SET
							 tgl_tindakan='$tanggal', 
							 no_rawat='$nomorRawat', 
							 kd_tindakan='$kodeTindakan', 
							 harga='$hargaTindakan', 
							 kd_type='$kodeType'";
			mysql_query($itemSql, $koneksidb) or die ("Gagal Query ".mysql_error());
		}
			
		# Kosongkan Tmp jika datanya sudah dipindah
		$hapusSql = "DELETE FROM tmp_rawat WHERE kd_petugas='$userLogin'";
		mysql_query($hapusSql, $koneksidb) or die ("Gagal kosongkan tmp".mysql_error());
		
		// Jalankan skrip Nota
		echo "<script>";
		echo "window.open('rawat_nota.php?nomorRawat=$nomorRawat', width=330,height=330,left=100, top=25)";
		echo "</script>";
		
		// Refresh form
		echo "<meta http-equiv='refresh' content='0; url=index.php'>";

	}	
}

// Membaca Nomor RM data Pasien
$NomorRM= isset($_GET['NomorRM']) ?  $_GET['NomorRM'] : '';
$mySql	= "SELECT nomor_ip, nm_pelanggan FROM pelanggan WHERE nomor_ip='$NomorRM'";
$myQry	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);
$dataPelanggan	= $myData['nm_pelanggan'];

# Kode pasien
if($NomorRM=="") {
	$NomorRM= isset($_POST['txtNomorRM']) ? $_POST['txtNomorRM'] : '';
}

# MEMBACA DATA DARI FORM UTAMA TRANSAKSI, Nilai datanya dimasukkan kembali ke Form utama DATA TRANSAKSI
$noTransaksi 	= buatKode("rawat", "D$");
$dataTanggal 	= isset($_POST['txtTanggal']) ? $_POST['txtTanggal'] : date('d-m-Y');
$dataDiagnosa	= isset($_POST['txtDiagnosa']) ? $_POST['txtDiagnosa'] : '';
$dataUangBayar	= isset($_POST['txtUangBayar']) ? $_POST['txtUangBayar'] : '';
$dataType		= isset($_POST['cmbType']) ? $_POST['cmbType'] : '';
$dataTindakan	= isset($_POST['cmbTindakan']) ? $_POST['cmbTindakan'] : '';
$datakurs	= isset($_POST['kurs']) ? $_POST['kurs'] : '';
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table width="800" cellspacing="1"  class="table-list">
    <tr>
      <td colspan="3"><h1>DOLLAR TRANSACTION </h1></td>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC"><strong>TRANSCTION DATA </strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="26%"><strong>No. Transaction </strong></td>
      <td width="1%"><strong>:</strong></td>
      <td width="73%"><input name="txtNomor" value="<?php echo $noTransaksi; ?>" size="23" maxlength="20" readonly="readonly" /></td>
    </tr>
    <tr>
      <td><strong>Date </strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtTanggal" type="text" class="tcal" value="<?php echo $dataTanggal; ?>" size="23" /></td>
    </tr>
    <tr>
      <td><strong>Costumer ID </strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtNomorRM" value="<?php echo $NomorRM; ?>" size="23" maxlength="20" required/>
        * Choose Form <a href="?page=Pencarian-Pelanggan" target="_self">The List Of Customer </a>, And Then Click The Menu <strong>List</strong> </td>
    </tr>
    <tr>
      <td><strong>Customer's Name</strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtPelanggan" value="<?php echo $dataPelanggan; ?>" size="80" maxlength="100" readonly="readonly" required/></td>
    </tr>
    <tr>
      <td><strong>Note</strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtDiagnosa" value="<?php echo $dataDiagnosa; ?>" size="80" maxlength="100" /></td>
    </tr>

     <tr>
      <td><strong>Kurs Dollar = Rp</strong></td>
      <td><strong>:</strong></td>
       <td><input name="kurs" value="<?php echo $datakurs; ?>" size="23" maxlength="23" required/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>

    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC"><strong>TRANSACTION </strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Payment Info </strong></td>
      <td><strong>:</strong></td>
      <td><select name="cmbType">
          <option value="KOSONG">....</option>
          <?php
	  $bacaSql = "SELECT * FROM type ORDER BY kd_type";
	  $bacaQry = mysql_query($bacaSql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($bacaData = mysql_fetch_array($bacaQry)) {
		if ($bacaData['kd_type'] == $dataType) {
			$cek = " selected";
		} else { $cek=""; }
		
		echo "<option value='$bacaData[kd_type]' $cek>[ $bacaData[kd_type] ]  $bacaData[nm_type]</option>";
	  }
	  ?>
        </select> </td>
    </tr>
    <tr>
      <td><strong>Umroh Package</strong></td>
      <td><strong>:</strong></td>
      <td><select name="cmbTindakan">
        <option value="KOSONG">....</option>
        <?php
	  $bacaSql = "SELECT * FROM tindakan ORDER BY kd_tindakan";
	  $bacaQry = mysql_query($bacaSql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($bacaData = mysql_fetch_array($bacaQry)) {
		if ($bacaData['kd_tindakan'] == $dataTindakan) {
			$cek = " selected";
		} else { $cek=""; }
		
		$harga = format_angka($bacaData['harga']);
		echo "<option value='$bacaData[kd_tindakan]' $cek>[ $bacaData[kd_tindakan] ]  $bacaData[nm_tindakan] </option>";
	  }
	  ?>
      </select> </td>
    </tr>
    <tr>
      <td><strong>Price ($) </strong></td>
      <td><strong>:</strong></td>
      <td><b>
        <input name="txtHarga" size="18" maxlength="12"/>
        <input name="btnTambah" type="submit" style="cursor:pointer;" value=" ADD " />
      </b></td>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC"><strong>Payment/ DP ($.) </strong></td>
      <td><strong>:</strong></td>
      <td bgcolor="#CCCCCC"><input name="txtUangBayar" value="<?php echo $dataUangBayar; ?>" size="23" maxlength="23" required/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="btnSimpan" type="submit" style="cursor:pointer;" value=" SAVE " /></td>
    </tr>
  </table>
  <br>
  <table class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
    <tr>
      <th colspan="6"><strong>Transaction List </strong></th>
    </tr>
    <tr>
      <td width="27" bgcolor="#CCCCCC"><strong>No</strong></td>
      <td width="58" bgcolor="#CCCCCC"><strong>Code </strong></td>
      <td width="365" bgcolor="#CCCCCC"><strong>Package Name </strong></td>
      <td width="190" bgcolor="#CCCCCC"><strong>Type Of Transaction</strong></td>
      <td width="90" align="right" bgcolor="#CCCCCC"><strong>Price ($) </strong></td>
      <td width="39">&nbsp;</td>
    </tr>
    <?php
	// Query SQL menampilkan data Tindakan dalam TMP_RAWAT
	$tmpSql ="SELECT tmp_rawat.*, tindakan.nm_tindakan, type.nm_type FROM tmp_rawat
			  LEFT JOIN tindakan ON tmp_rawat.kd_tindakan=tindakan.kd_tindakan 
			  LEFT JOIN type ON tmp_rawat.kd_type=type.kd_type
			  WHERE tmp_rawat.kd_petugas='".$_SESSION['SES_LOGIN']."' ORDER BY id";
	$tmpQry = mysql_query($tmpSql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
	$nomor=0;  $totalHarga = 0; 
	while($tmpData = mysql_fetch_array($tmpQry)) {
		$nomor++;
		$totalHarga	= $totalHarga +  $tmpData['harga'];
	?>
	  <tr>
		<td><?php echo $nomor; ?></td>
		<td><?php echo $tmpData['kd_tindakan']; ?></td>
		<td><?php echo $tmpData['nm_tindakan']; ?></td>
		<td><?php echo $tmpData['nm_type']; ?></td>
		<td align="right"><?php echo format_angka($tmpData['harga']); ?></td>
		<td><a href="?Aksi=Hapus&id=<?php echo $tmpData['id']; ?>" target="_self">Delete</a></td>
	  </tr>
    <?php } ?>
    <tr>
      <td colspan="4" align="right"><b> GRAND TOTAL  : </b></td>
      <td align="right" bgcolor="#CCCCCC"><strong>$. <?php echo format_angka($totalHarga); ?></strong></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>