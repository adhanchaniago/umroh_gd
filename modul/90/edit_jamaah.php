<style type="text/css">
  p {
    color: red;
    font-size: 18px;  }
</style>

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
	if (trim($_POST['FirstName'])=="") {
		$pesanError[] = "Data <b>Nama Depan</b> tidak boleh kosong !";
	}


  # Baca Variabel Form

     $Title    = $_POST['Title'];
    $FirstName   = $_POST['FirstName'];
    $LastName    = $_POST['LastName'];
    $SurName   = $_POST['SurName'];
    $Gender = $_POST['Gender'];
    $Status = $_POST['Status'];
    $Email = $_POST['Email'];
    $Contact = $_POST['Contact'];
    $Address = $_POST['Address'];
    $City = $_POST['City'];
    $FamilyName = $_POST['FamilyName'];
    $FamilyContact = $_POST['FamilyContact'];
    $FamilyRelationship = $_POST['FamilyRelationship'];
    $place_of_birth = $_POST['place_of_birth'];
    $tanggalLahir = $_POST['tgllahir'];

    // $Paket_Program = $_POST['Paket_Program'];
    $Depart = $_POST['Depart'];
    $Arrival = $_POST['Arrival'];
    // $Kd_Umroh = $_POST['Kd_Umroh'];
    // $Room = $_POST['Room'];
    $Passport = $_POST['Passport'];
   $txtPoi = $_POST['txtPoi'];
    $txtDoi = $_POST['txtDoi'];
    $txtExpired = $_POST['txtExpired'];
    // $Mahrom = $_POST['Mahrom'];
    // $Mahrom_Status = $_POST['Mahrom_Status'];
      $officer = $_POST['officer'];
        $travel = $_POST['travel'];

    //  $dataJumlah = isset($_POST['jumlahpaket']) ? $_POST['jumlahpaket'] : '';
    $NomorUmroh= isset($_GET['NomorUmroh']) ?  $_GET['NomorUmroh'] : '';




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
		$petugas= $_SESSION['SES_LOGIN'];
    $mysql = "UPDATE jamaah_daftar SET
                               date_input = NOW(),
                               title = '$Title',
                               first_name = '$FirstName',
                               last_name = '$LastName',
                               surname= '$SurName',
                               gender = '$Gender',
                               place_of_birth = '$place_of_birth',
                               birthdate = '$tanggalLahir',
                               status_jamaah = '$Status',
                               phone = '$Contact',
                               alamat = '$Address',
                               email = '$Email',
                               kota = '$City',
                               family_name = '$FamilyName',
                               family_contact = '$FamilyContact',
                               family_relationship = '$FamilyRelationship',
                              --  packages_program = '$Paket_Program',
                              --  depart = '$Depart',
                              --  arrival = '$Arrival',
                              --  room ='$Room',
                               no_pass = '$Passport',
                               poi = '$txtPoi',
                               doi = '$txtDoi',
                               expired = '$txtExpired',
                              --  mahrom = '$Mahrom',
                              --  mahrom_status  = '$Mahrom_Status',
                              --  kd_umroh = 'Kd_Umroh'
                               WHERE nomor_id = '".$_POST['txtKode']."' ";
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?page=Pelanggan-Data'>";
		}
		exit;
	}
} // Penutup Tombol Simpan


// data tahun expired passport
//$txtDoi = $_POST['txtDoi'];
$tgl1 =  $_POST['txtDoi'];// pendefinisian tanggal awal
$tgl2 = date('d-m-Y', strtotime('+5 year', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari

// Tanggal Lahir
  $tgllahir =  $_POST['tgllahir'];

  // Convert Ke Date Time
  $biday = new DateTime($tgllahir);
  $today = new DateTime();

  $diff = $today->diff($biday);



# MENGAMBIL DATA YANG DIEDIT, SESUAI KODE YANG DIDAPAT DARI URL
$Kode	= isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['txtKode'];
$mySql	= "SELECT * FROM jamaah_daftar WHERE nomor_id='$Kode'";
$myQry	= mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);

# MASUKKAN DATA DARI FORM KE VARIABEL TEMPORARY (SEMENTARA)
$dataKode	= $myData['nomor_id'];
$dataTitle = isset($_POST['Title']) ? $_POST['Title'] : $myData['title'];
$dataFirstName = isset($_POST['FirstName']) ? $_POST['FirstName'] : $myData['first_name'];
$dataLastName = isset($_POST['LastName']) ? $_POST['LastName'] :  $myData['last_name'];
$dataSurname  = isset($_POST['SurName']) ? $_POST['SurName'] : $myData['surname'];
$dataGender= isset($_POST['Gender']) ? $_POST['Gender'] :  $myData['gender'];

$dataStatus= isset($_POST['Status']) ? $_POST['Status'] :  $myData['status_jamaah'];
$dataEmail = isset($_POST['Email']) ? $_POST['Email'] :  $myData['email'];
$dataContact= isset($_POST['Contact']) ? $_POST['Contact'] :  $myData['phone'];
$dataAddress= isset($_POST['Address']) ? $_POST['Address'] :  $myData['alamat'];
$dataCity  = isset($_POST['City']) ? $_POST['City'] :  $myData['kota'];
$dataFamilyName  = isset($_POST['FamilyName']) ? $_POST['FamilyName'] :  $myData['family_name'];
$dataFamilyContact  = isset($_POST['FamilyContact']) ? $_POST['FamilyContact'] :  $myData['family_contact'];
$dataFamilyRelationship  = isset($_POST['FamilyRelationship']) ? $_POST['FamilyRelationship'] :  $myData['family_relationship'];
$dataKamar  = isset($_POST['Room']) ? $_POST['Room'] :  $myData['room'];
$dataPassport = isset($_POST['Passport']) ? $_POST['Passport'] :  $myData['no_pass'];
$dataPoi  = isset($_POST['txtPoi']) ? $_POST['txtPoi'] :  $myData['poi'];
$dataDoi  = isset($_POST['txtDoi']) ? $_POST['txtDoi'] :  $myData['doi'];
$dataExpired  = isset($_POST['txtExpired']) ? $_POST['txtExpired'] :  $myData['expired'];

$dataMahrom= isset($_POST['Mahrom']) ? $_POST['Mahrom'] :  $myData['mahrom'];

$dataMahromStatus= isset($_POST['Mahrom_Status']) ? $_POST['Mahrom_Status'] : $myData['mahrom_status'];



// Tempat, Tgl Lahir
$dataTempatLahir= isset($_POST['place_of_birth']) ? $_POST['place_of_birth'] : $myData['place_of_birth'];
//$dataThn		= isset($_POST['cmbThnLahir']) ? $_POST['cmbThnLahir'] : substr($myData['tanggal_lahir'], 0,4);
//$dataBln		= isset($_POST['cmbBlnLahir']) ? $_POST['cmbBlnLahir'] : substr($myData['tanggal_lahir'], 5,2);
//$dataTgl		= isset($_POST['cmbTglLahir']) ? $_POST['cmbTglLahir'] : substr($myData['tanggal_lahir'], 8,2);
$datatgllahir   = isset($_POST['birthdate']) ? $_POST['birthdate'] : $myData['birthdate'];
?>


<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="utf-8">
    <title>Umroh - Customer Relation</title>
   <link rel="icon" sizes="192x192" href="../img/Icon.png"/>
    <!-- Glazzed & Bootstrap -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/main.min.css">
    <!-- Pixeden Icon Fonts -->
    <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
    <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-stroke.css">
    <link rel="stylesheet" type="text/css" href="../plugins/tigra_calendar/tcal.css"/>




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


     .push-to-bottom {
        position: absolute;
        bottom: 30px;
        width: 100%;
      }

        .widget__form input[type=number] {
    display: inline-block;
    width: 100%;
    border: none;
    height: 35px;
    vertical-align: top;
    background-color: rgba(18, 35, 158, 0.65);
    margin: 1px 0 0;
    padding-left: 24px;
    font-weight: 100;
    color: #fff;
}


.widget__form select[type=text] {
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

.widget__form input[type=text] {
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

textarea {
    display: inline-block;
    width: 100%;
    border: none;
    height: 65px;
    vertical-align: top;
    background-color: rgba(0, 0, 0, 0.5);
    margin: 1px 0 0;
    padding-left: 24px;
    font-weight: 100;
    color: #fff;
}

.widget__form input[type=password] {
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
.widget__form input[type=date] {
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
                        <span>Edit Data</span>
                    </h1>
                    <ul class="main-header__breadcrumb">
                        <li><a href="?page=90" onclick="return false;"></a></li>

                    </ul>
                </div>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" class="form-horizontal" role="form">
<div class="row">
                <div class="col-md-6">
                						<article class="widget">
                							<header class="widget__header">
                								<div class="widget__title">
                									<i class="pe-7s-display2"></i><h3>Biodata</h3>
                								</div>
                								<div class="widget__config">
                									<a href="#"></a>
                									<a href="#"></a>
                								</div>
                							</header>

                							<div class="widget__content filled table-responsive pad20">


                			<table class="widget__form col-md-12" width="100%" >
                			<thead>
                			<tr>
                			<th ></th>
                			<th class="text-center">Desc</th>

                		</tr>
                	</thead>
                	<tbody>



      <tr>
      <td class="text-center">
    ID
      </td>
      <td class="">
      <input type="text" name="ID" class="stacked-input" value="<?php echo $dataKode; ?>"  id="input-1" placeholder="ID Jamaah" required readonly="readonly">
      </td>

      </tr>

      <tr>
      	<td class="text-center">
      	Salutation
      	</td>

      <td>
        <select name="Title" required class="form-control col-xs-10 col-sm-5" style=" height: 35px; width: 100%" >
                  <option value="<?php echo "$dataTitle";?>"> <?php echo "$dataTitle";?></option>
                   <option value="MR.">MR.</option>
                   <option value="MRS.">MRS.</option>
                   <option value="MISS.">MISS.</option>
            </select>
      </td>

      </tr>

      <tr>
      	<td class="text-center">
      		First Name
      	</td>

      	<td>
        <input name="FirstName" type="text" name="ID" class="stacked-input" value="<?php echo $dataFirstName; ?>"  id="input-1" placeholder="First Name *" required>
        </td>

    	</tr>
      <tr>
        <td class="text-center">
          Last Name
        </td>

        <td>
      <input name="LastName" type="text" name="ID" class="stacked-input" value="<?php echo $dataLastName; ?>"  id="input-1" placeholder="Middle Name" >
        </td>

      </tr>

      <tr>
        <td class="text-center">
          SurName
        </td>

        <td>
    <input name="SurName" type="text" name="ID" class="stacked-input" value="<?php echo $dataSurname; ?>"  id="input-1" placeholder="SurName" >
        </td>

      </tr>

      <tr>
        <td class="text-center">
        Gender
        </td>

        <td>
          <select name="Gender" required class="form-control col-xs-10 col-sm-5" style=" height: 35px; width: 100%"  >
                    <option value="<?php echo "$dataGender";?>" title="tes"> <?php echo "$dataGender";?></option>
                     <option value="MALE">MALE</option>
                     <option value="FEMALE">FEMALE</option>
              </select>
        </td>

      </tr>
      <tr>
        <td class="text-center">
      BirthDay
        </td>

        <td>
  <input name="place_of_birth" type="text"  value="<?php echo $dataTempatLahir; ?>" size="12" maxlength="100" placeholder="Place of birth*" required />
  <input name="tgllahir" type="date" onchange=this.form.submit()  id="bday"  value="<?php echo $datatgllahir; ?>" placeholder="birth*" class="col-xs-10 col-sm-5"
" required />
        </td>

      </tr>

      <tr>
        <td class="text-center">
      Age
        </td>

        <td>
  <input style="width: 100%"  name="age" type="text" id="bday"  value=" <?php echo  $diff->y ." Year"; ?>" class="col-xs-10 col-sm-5" />
        </td>

      </tr>

      <tr>
        <td class="text-center">
      Status
        </td>

        <td>
  <select name="Status" required class="form-control col-xs-10 col-sm-5" style=" height: 35px; width: 100%"  >
                <option value="<?php echo "$dataStatus";?>" title="tes"> <?php echo "$dataStatus";?></option>
                 <option value="MARRIAGE">MARRIAGE</option>
                 <option value="SINGLE">SINGLE</option>
          </select>
        </td>

      </tr>
      <tr>
        <td class="text-center">
      Email
        </td>

        <td>
<input name="Email" type="text" name="ID" class="stacked-input" value="<?php echo "$dataEmail";?>"  id="input-1" placeholder="Email" >
        </td>

      </tr>
      <tr>
        <td class="text-center">
      Phone
        </td>

        <td>
 <input  name="Contact" type="text" name="ID" class="stacked-input" value="<?php echo "$dataContact";?>"  id="input-1" placeholder="Contact Number*" required>
        </td>

      </tr>

      <tr>
        <td class="text-center">
    Address
        </td>

        <td>
 <textarea type="text" name="Address" class="stacked-input" value="<?php echo "$dataAddress";?>"  id="input-1" placeholder="Address*" required><?php echo "$dataAddress";?></textarea>
        </td>

      </tr>
      <tr>
        <td class="text-center">
  City
        </td>

        <td>
<input type="text" name="City" class="stacked-input" value="<?php echo "$dataCity";?>"  id="input-1" placeholder="City*" required>
        </td>

      </tr>

      <tr>
      <td class="text-center">
      Family Name
      </td>
    <td class="">
      <input type="text" name="FamilyName" class="stacked-input" value="<?php echo "$dataFamilyName";?>"  id="input-1" placeholder="Family Name" >
      </td>
    </tr>

            <tr>
              <td class="text-center">
      Family Contact
              </td>

            <td>
      <input type="text" name="FamilyContact" class="stacked-input" value="<?php echo "$dataFamilyContact";?>"  id="input-1" placeholder="Family Contact" >
            </td>

            </tr>

            <tr>
              <td class="text-center">
        Family Relationship
              </td>

              <td>
                <select name="FamilyRelationship" class="form-control col-xs-10 col-sm-5" style=" height: 35px; width: 100%"  >
                              <option value="<?php echo "$dataFamilyRelationship";?>" title="tes"> <?php echo "$dataFamilyRelationship";?></option>
                               <option value="FATHER">FATHER</option>
                               <option value="MOTHER">MOTHER</option>
                               <option value="BROTHER">BROTHER</option>
                               <option value="SISTER">SISTER</option>
                               <option value="OTHERS">OTHERS</option>
                        </select>
              </td>

            </tr>

    </tbody>
    </table>


                							</div> <!-- /widget__content -->

                						</article><!-- /widget -->
                					</div>








              <div class="col-md-6">
              						<article class="widget">
              							<header class="widget__header">
              								<div class="widget__title">
              									<i class="pe-7s-display2"></i><h3>Passport , Officer Travel</h3>
              								</div>
              								<div class="widget__config">
              									<a href="#"><i class="pe-7f-refresh"></i></a>
              									<a href="#"><i class="pe-7s-close"></i></a>
              								</div>
              							</header>

              <div class="widget__content filled table-responsive pad20">


                  <table class="widget__form col-md-12" width="100%" >
                  <thead>
                  <tr>
                  <th ></th>
                  <th class="text-center">Desc</th>

                </tr>
              </thead>
              <tbody>



              <tr>
              <td class="text-center">
          No Passpor
              </td>
            <td class="">
      <input type="text" name="Passport" class="stacked-input" value="<?php echo "$dataPassport";?>"  id="input-1" placeholder="No Passport" >
                      </td>
                    </tr>

          <tr>
      <td class="text-center">
        Place Of Issued
      </td>

                  <td>
       <input type="text" name="txtPoi" class="stacked-input" value="<?php echo "$dataPoi";?>"  id="input-1" placeholder="Place Of Issue" >
                  </td>

    </tr>

        <tr>
          <td class="text-center">
    Date Of Issued
          </td>

          <td>
      <input name="txtDoi" type="date" onchange=this.form.submit()  id="myDate"  value="<?php echo "$dataDoi";?>" placeholder="Date" class="col-xs-10 col-sm-5" />
            </td>
          </tr>


        <tr>
          <td class="text-center">
    Expired Of Issued
          </td>

            <td>
    <input style="width: 50%"  name="txtExpired" type="text" id="myDate"  value="  <?php echo $tgl2; //print tanggal ?>" class="col-xs-10 col-sm-5" ></input>
                    </td>
                  </tr>



        <tr>
      <td class="text-center">
      Officer
      </td>

      <td>
<input type="text" name="officer" class="stacked-input" style="width: 100%" value="<?php echo $_SESSION['FirstName'];?>"  id="input-1" placeholder="Officer" readonly="readonly" />
      </td>
      </tr>

      <tr>
    <td class="text-center">
    Travel / Agent
    </td>

    <td>
<input type="text" name="travel" class="stacked-input" style="width: 100%" value="<?php echo $_SESSION['Travel'];?>"  id="input-1" placeholder="Travel" readonly="readonly"/ >
    </td>
    </tr>



    </tbody>
    </table>


            </div> <!-- /widget__content -->

          </article><!-- /widget -->
        </div>

</div><!-- end row-->

  <button  type="submit" name="btnSimpan" value=" Submit " class="btn btn-info" style="width:100% ; height:50px ;background-color: #060b17;"  type="button"><font style="color:white">Save</font></button>
</form>



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
