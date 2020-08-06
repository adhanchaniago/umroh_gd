<!DOCTYPE html>

<?php
session_start();
if($_SESSION['FirstName'] == '270') {header('Location: ?page=270');} ;
include_once "../library/inc.library.php";
include_once "../library/inc.pilihan.php";
include_once "../library/inc.tanggal.php";


require('../config/travel-config.php'); //Load DB(mysql) config parameter

# Tombol Simpan diklik
if(isset($_POST['btnSimpan'])){
  # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
  $pesanError = array();
  if (trim($_POST['Username'])=="") {
    $pesanError[] = "Data <b>Email Username</b> tidak boleh kosong !";
  }

  # BACA DATA DALAM FORM, masukkan datake variabel
  $Travelname= $_POST['Travelname'];
  $Username= $_POST['Username'];
  $Password= $_POST['Password'];
  $txtPassLama= $_POST['txtPassLama'];
  $RoleID= $_POST['RoleID'];
  $Status= $_POST['Status'];
  $Salutation= $_POST['Salutation'];
  $FirstName= $_POST['FirstName'];
  $LastName= $_POST['LastName'];
  $Phone= $_POST['Phone'];
  $Gender= $_POST['Gender'];
  $Dummy= $_POST['Dummy'];
  $ExpirationDate= $_POST['ExpirationDate'];

  # Validasi Nama tindakan, jika sudah ada akan ditolak
  $cekSql="SELECT * FROM user WHERE email='$Username' AND NOT(email='".$_POST['txtLama']."')";
  $cekQry=mysql_query($cekSql, $Link) or die ("Eror Query".mysql_error());
  if(mysql_num_rows($cekQry)>=1){
    $pesanError[] = "Maaf, Username <b> $Username </b> sudah ada, ganti dengan yang lain";
  }

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


		# Cek Password baru
		if (trim($Password)=="") {
			$sqlPasword = ", password='$txtPassLama'";
		}
		else {
			$sqlPasword = ",  password ='".md5($Password)."'";
		}

    # SIMPAN DATA KE DATABASE.
    // Jika tidak menemukan error, simpan data ke database
    $mySql    = "UPDATE user SET Travelname='$Travelname',
                              Email='$Username',
                              $sqlPasword,
                              RoleID='$RoleID',
                              Status='$Status',
                              Salutation='$Salutation',
                              FirstName='$FirstName',
                              LastName='$LastName',
                              Phone='$Phone',
                              Gender='$Gender',
                              Dummy='$Dummy',
                              CreatedDate= NOW(),
                              ExpirationDate='$ExpirationDate'
                              WHERE userID='".$_GET['Kode']."'";


    $myQry=mysql_query($mySql, $Link) or die ("Gagal query".mysql_error());
    if($myQry){
      echo "<meta http-equiv='refresh' content='0; url=?page=User'>";
    }
    exit;
  }
} // Penutup Tombol Simpan


# MEMBACA DATA UNTUK DIEDIT
$Kode  = isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['Kode'];
$mySql   = "SELECT * FROM user WHERE userID='$Kode'";
$myQry   = mysql_query($mySql, $Link)  or die ("Query ambil data salah : ".mysql_error());
$myData  = mysql_fetch_array($myQry);
// Supaya saat ada pesan error, data di dalam form tidak hilang. Jadi, tinggal meneruskan/memperbaiki yg salah

# VARIABEL DATA UNTUK DIBACA FORM
// Supaya saat ada pesan error, data di dalam form tidak hilang. Jadi, tinggal meneruskan/memperbaiki yg salah
$dataTravelname   = isset($_POST['Travelname']) ? $_POST['Travelname'] :  $myData['TravelName'];
$dataUsername = isset($_POST['Username']) ? $_POST['Username'] :  $myData['Email'];
$dataPassword = isset($_POST['Password']) ? $_POST['Password'] :  $myData['Password'];
$dataRoleID = isset($_POST['RoleID']) ? $_POST['RoleID'] :  $myData['RoleID'];
$dataStatus  = isset($_POST['Status']) ? $_POST['Status'] :  $myData['Status'];
$dataSalution    = isset($_POST['Salutation']) ? $_POST['Salutation'] :  $myData['Salutation'];
$dataFirstName    = isset($_POST['FirstName']) ? $_POST['FirstName'] :  $myData['FirstName'];
$dataLastName    = isset($_POST['LastName']) ? $_POST['LastName'] :  $myData['LastName'];
$dataBirthDate    = isset($_POST['BirthDate']) ? $_POST['BirthDate'] :  $myData['BirthDate'];
$dataPhone    = isset($_POST['Phone']) ? $_POST['Phone'] :  $myData['Phone'];
$dataGender    = isset($_POST['Gender']) ? $_POST['Gender'] :  $myData['Gender'];
$dataDummy    = isset($_POST['Dummy']) ? $_POST['Dummy'] :  $myData['Dummy'];
$dataExpirationDate    = isset($_POST['ExpirationDate']) ? $_POST['ExpirationDate'] :  $myData['ExpirationDate'];
?>


<html>
<head>
    <title>Umroh Management</title>
    <link rel="icon" sizes="192x192" href="../img/Icon.png"/>
    <!-- Glazzed & Bootstrap -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/main.min.css">
    <!-- Pixeden Icon Fonts -->
    <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
    <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-stroke.css">

<style>
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
   select {
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
.widget__form input[type=text] {
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

.widget__form input[type=password] {
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
.widget__form input[type=date] {
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

      </style>

</head>


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
              <span>User Management</span>
              </h1>
             <ul class="main-header__breadcrumb">
              <li><a href ="#" onclick="window.location='#';">Home</a></li>
                 <a href ="?page=270" onclick="window.location='?page=270';">Management</a>
              </li>
               </ul>
           </div>


      </header>

<div class = "row">


             <div class="row">

          <div class="col-md-12">
            <article class="widget">
              <header class="widget__header">
                <div class="widget__title">
                  <i class="pe-7s-menu"></i><h3>Add New User</h3>
                </div>
                <div class="widget__config">
                  <a href="#"><i class="pe-7f-refresh"></i></a>
                  <a href="#"><i class="pe-7s-close"></i></a>
                </div>
              </header>
              <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" class="form-horizontal" role="form">
              <div class="widget__content table-responsive">

                <table class="table table-striped media-table">
                  <thead>
                    <tr>
                      <th width="270">Description</th>
                      <th>Post Info</th>
                      <th>Required</th>
                    </tr>
                  </thead>
                  <tbody class="widget widget__form">


                    <tr class="spacer"></tr>
                    <tr>
                      <td>
                        <div class="media">
                          <div class="media-body post_desc">
                            <h3>Travel Name</h3>
                          </div>
                        </div>
                      </td>
                      <td >
        <select name="Travelname" required class="form" >
        <option value="<?php echo $dataTravelname; ?>"><?php echo $dataTravelname; ?></option>
        <?php
    $pilihan = array("Garisdev", "ArbaTour", "Agent"  );
    foreach ($pilihan as $nilai) {
      if ($_POST['cmbLevel']==$nilai) {
        $cek="selected";
      } else { $cek = ""; }
      echo "<option value='$nilai' $cek>$nilai</option>";
    }
    ?>
        </select>
        </td>
        <td>
      <a href="#" onclick="return false;" class="post__del"><i class="pe-7f-check"></i></a>
        </td>
      </tr>

                    <tr class="spacer"></tr>
                    <tr>
                      <td>
                        <div class="media">
                          <div class="media-body post_desc">
                            <h3>Email</h3>
                          </div>
                        </div>
                      </td>
                      <td>
                       <input name="Username" type="text"  class="stacked-input" value="<?php echo $dataUsername; ?>"  id="input-1" placeholder="Email" required>
                        <input name="txtLama" type="hidden" value="<?php echo $myData['Email']; ?>" required/>
                      </td>
                      <td>
                       <a href="#" onclick="return false;" class="post__del"><i class="pe-7f-check"></i></a>
                      </td>
                    </tr>

                    <tr class="spacer"></tr>
                    <tr>
                      <td>
                        <div class="media">
                          <div class="media-body post_desc">
                            <h3>password</h3>
                          </div>
                        </div>
                      </td>
                      <td>
                      <input name="Password" type="password"  class="stacked-input" value="<?php echo $dataPassword ?>"  id="input-1" placeholder="Password" required>
 <input name="txtPassLama" type="hidden" value="<?php echo $myData['password']; ?>" />
                      </td>
                      <td>
                        <a href="#" onclick="return false;" class="post__del"><i class="pe-7f-check"></i></a>
                      </td>
                    </tr>

                      <tr class="spacer"></tr>
                    <tr>
                      <td>
                        <div class="media">
                          <div class="media-body post_desc">
                            <h3>Status</h3>
                          </div>
                        </div>
                      </td>
                      <td>
                      <input name="Status" type="checkbox" id="s2-2" class="sw" checked value="Active" />
                      <label class="switch2 blue" for="s2-2"></label>( I= Active ,0= Deactive )

                </td>
                      <td>
                        <a href="#" onclick="return false;" class="post__del"><i class="pe-7f-check"></i></a>
                      </td>
                    </tr>

                      <tr class="spacer"></tr>
                    <tr>
                      <td>
                        <div class="media">
                          <div class="media-body post_desc">
                            <h3>Name</h3>
                          </div>
                        </div>
                      </td>
                      <td>
            <select name="Salutation" required class="form" >
        <option value="<?php echo $dataSalution; ?>"><?php echo $dataSalution; ?></option>
        <?php
    $pilihan = array("MR.", "MRS.", "MISS." );
    foreach ($pilihan as $nilai) {
      if ($_POST['Salutation']==$nilai) {
        $cek="selected";
      } else { $cek = ""; }
      echo "<option value='$nilai' $cek>$nilai</option>";
    }
    ?>
    </select>
    <input name="FirstName" type="text"  class="stacked-input" value="<?php echo $dataFirstName; ?>"  id="input-1" placeholder="First Name " required>
     <input name="LastName" type="text"  class="stacked-input" value="<?php echo $dataLastName; ?>"  id="input-1" placeholder="Last Name " required>
                      </td>
                      <td>
                       <a href="#" onclick="return false;" class="post__del"><i class="pe-7f-check"></i></a>
                      </td>
                    </tr>

                      <tr class="spacer"></tr>
                    <tr>
                      <td>
                        <div class="media">
                          <div class="media-body post_desc">
                            <h3>Phone</h3>
                          </div>
                        </div>
                      </td>
                      <td>
                       <input name="Phone" type="text"  class="stacked-input" value="<?php echo $dataPhone; ?>"  id="input-1" placeholder="Phone" required>
                      </td>
                      <td>
                        <a href="#" onclick="return false;" class="post__del"><i class="pe-7f-check"></i></a>
                      </td>
                    </tr>

                      <tr class="spacer"></tr>
                    <tr>
                      <td>
                        <div class="media">
                          <div class="media-body post_desc">
                            <h3>Gender</h3>
                          </div>
                        </div>
                      </td>
                      <td>
                       <select name="Gender" required class="form" >
        <option value="<?php echo $dataGender; ?>"><?php echo $dataGender; ?></option>
        <?php
    $pilihan = array("Male", "Female" );
    foreach ($pilihan as $nilai) {
      if ($_POST['Gender']==$nilai) {
        $cek="selected";
      } else { $cek = ""; }
      echo "<option value='$nilai' $cek>$nilai</option>";
    }
    ?>
    </select>
                      </td>
                      <td>
                         <a href="#" onclick="return false;" class="post__del"><i class="pe-7f-check"></i></a>
                      </td>
                    </tr>

             <tr class="spacer"></tr>
                    <tr>
                      <td>
                        <div class="media">
                          <div class="media-body post_desc">
                            <h3>Role</h3>
                          </div>
                        </div>
                      </td>
                      <td>
                       <select name="RoleID" required class="form" >
        <option value="<?php echo $dataRoleID; ?>"><?php echo $dataRoleID; ?></option>
        <option value="2">CRO</option>
        <option value="3">CRO and Finance</option>
        <option value="6">Management</option>

    </select>
                      </td>
                      <td>
                         <a href="#" onclick="return false;" class="post__del"><i class="pe-7f-check"></i></a>
                      </td>
                    </tr>

                      <tr class="spacer"></tr>
                    <tr>
                      <td>
                        <div class="media">
                          <div class="media-body post_desc">
                            <h3>Dummy</h3>
                          </div>
                        </div>
                      </td>
                      <td>
                        <input name="Dummy" type="number"  class="stacked-input" value="<?php echo $dataDummy; ?>"  id="input-1" placeholder="Dummy" required readonly="readonly">
                      </td>
                      <td>
                        <a href="#" onclick="return false;" class="post__del"><i class="pe-7f-check"></i></a>
                      </td>
                    </tr>
                      <tr class="spacer"></tr>
                    <tr>
                      <td>
                        <div class="media">
                          <div class="media-body post_desc">
                            <h3>Expired User</h3>
                          </div>
                        </div>
                      </td>
                      <td>
                       <input name="ExpirationDate" type="date"  class="stacked-input" value="<?php echo $dataExpirationDate; ?>"  id="input-1" placeholder="Expiration Date" required>
                      </td>
                      <td>
                        <a href="#" onclick="return false;" class="post__del"><i class="pe-7f-check"></i></a>
                      </td>
                    </tr>

                  </tbody>
                </table>
<br>
<hr>
                <center><button  type="submit" name="btnSimpan" value=" Submit " class="btn btn-info" type="button" style="width: 50% ;border:solid blue">Save</button></center>
                <hr>



              </div> <!-- /widget__content -->
              </form>
            </article><!-- /widget -->
          </div>


        </div> <!-- /row -->


      <footer class="footer-brand">
          <?php include "footer.php"; ?>
      </footer>
    </section> <!-- /content -->

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
