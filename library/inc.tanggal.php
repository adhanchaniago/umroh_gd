<style type="text/css"> 
	.selectbulan {
    display: inline-block;
    width: 40%;
    border: none;
    height: 64px;
    vertical-align: top;
    background-color: rgba(0,0,0,.50);
    margin: 1px 0 0;
    padding-left: 24px;
    font-weight: 100;
    color: #fff;
}

.selecttanggal {
    display: inline-block;
    width: 20%;
    border: none;
    height: 64px;
    vertical-align: top;
    background-color: rgba(0,0,0,.50);
    margin: 1px 0 0;
    padding-left: 24px;
    font-weight: 100;
    color: #fff;
}

.selecttahun {
    display: inline-block;
    width: 29%;
    border: none;
    height: 64px;
    vertical-align: top;
    background-color: rgba(0,0,0,.50);
    margin: 1px 0 0;
    padding-left: 24px;
    font-weight: 100;
    color: #fff;
}
</style>

<?php
function listTanggal($nama, $tanggal) {
	date_default_timezone_set("Asia/Jakarta");

	# Pecah Bagian Tanggal
	$tglTerpilih=substr($tanggal,8,2);
	$blnTerpilih=substr($tanggal,5,2);
	$thnTerpilih=substr($tanggal,0,4);

	# Combo/ ListBox untuk Tanggal
	echo "<select class='selecttanggal' name='cmbTgl$nama' id='$nama'>";
	  for ($tgl =1; $tgl <= 31; $tgl++) {
	  	// Dua digit
		if (strlen($tgl)==1) {
			$tgl = "0".$tgl;
		}
		else { $tgl = $tgl; }

		// Terpilih
		if ($tgl==$tglTerpilih) {
			$cek="selected";
		} else { $cek = ""; }

		echo "<option value='$tgl' $cek>$tgl</option>";
	  }
	echo "</select>";
	echo " <b>/</b> ";
	
	# Combo/ListBox untuk Bulan
	echo "<select class='selectbulan' name='cmbBln$nama' id='$nama'>";
		$bulanArray = array("01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April",
							"05" => "Mei", "06" => "Juni", "07" => "Juli", "08" => "Agustus",
							"09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember");
		foreach ($bulanArray as $angka => $bulan) {
			// Terpilih
			if ($angka==$blnTerpilih) {
				$cek="selected";
			} else { $cek = ""; }

			echo "<option value='$angka' $cek> $bulan</option>";
		}
	echo "</select>";
	echo " <b>/</b> ";
	
	# Combo/ ListBox untuk Tahun
	echo "<select class='selecttahun' name='cmbThn$nama' id='$nama'>";
	  $tahun = date('Y')-100;
	  for ($tahun; $tahun < date('Y') +100; $tahun++) {
		// Terpilih
		if ($tahun==$thnTerpilih) {
			$cek="selected";
		} else { $cek = ""; }
		
		echo "<option value='$tahun' $cek> $tahun</option>";
	  }
	echo "</select>";
}

# ============================================
function listTanggal2($nama, $tanggal) {
	date_default_timezone_set("Asia/Jakarta");

	# Pecah Bagian Tanggal
	$tglTerpilih=substr($tanggal,8,2);
	$blnTerpilih=substr($tanggal,5,2);
	$thnTerpilih=substr($tanggal,0,4);

	# Combo/ ListBox untuk Tanggal
	echo "<select name='cmbTgl$nama' id='$nama'>";
	  for ($tgl =1; $tgl <= 31; $tgl++) {
	  	// Dua digit
		if (strlen($tgl)==1) {
			$tgl = "0".$tgl;
		}
		else { $tgl = $tgl; }

		// Terpilih
		if ($tgl==$tglTerpilih) {
			$cek="selected";
		} else { $cek = ""; }

		echo "<option value='$tgl' $cek>$tgl</option>";
	  }
	echo "</select>";
	echo " <b>/</b> ";
	
	# Combo/ListBox untuk Bulan
	echo "<select name='cmbBln$nama' id='$nama'>";
		$bulanArray = array("01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April",
							"05" => "Mei", "06" => "Juni", "07" => "Juli", "08" => "Agustus",
							"09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember");
		foreach ($bulanArray as $angka => $bulan) {
			// Terpilih
			if ($angka==$blnTerpilih) {
				$cek="selected";
			} else { $cek = ""; }

			echo "<option value='$angka' $cek> $bulan</option>";
		}
	echo "</select>";
	echo " <b>/</b> ";
	
	# Combo/ ListBox untuk Tahun
	echo "<select name='cmbThn$nama' id='$nama'>";
	  $tahun = date('Y');
	  for ($tahun; $tahun <= date('Y')+1; $tahun++) {
		// Terpilih
		if ($tahun==$thnTerpilih) {
			$cek="selected";
		} else { $cek = ""; }
		
		echo "<option value='$tahun' $cek> $tahun</option>";
	  }
	echo "</select>";
}
?>

