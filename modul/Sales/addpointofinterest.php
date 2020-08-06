<?php
require('../config/wiwe360-config.php');


# Tombol Simpan diklik
if(isset($_POST['btnSimpan'])){
  # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
  $pesanError = array();
  if (trim($_POST['Category'])=="") {
    $pesanError[] = "Data <b>Title</b> tidak boleh kosong !";    
  }

  # BACA DATA DALAM FORM, masukkan datake variabel
  $cityId=$_POST['city'];
  $stateId=$_POST['state'];
  $Category= $_POST['Category'];
  $Keyword = $_POST['Keyword'];
  $Title = $_POST['Title'];
  $Description = $_POST['Description'];
  $URL = $_POST['URL'];


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
    // Jika tidak menemukan error, simpan data ke database
    $mySql    = "INSERT INTO `poi` (`Keyword`, `title`, 
                     `Description`, `url`, `Category`, `sub-Category`, `Sub-Sub-Category`)
            VALUES ('$Keyword', 
                '$Title', 
                '$Description', 
                '$URL', 
                '$Category',
                '$stateId',
                '$cityId')";

    $myQry=mysql_query($mySql, $Link) or die ("Gagal query".mysql_error());
    if($myQry){
      echo "<meta http-equiv='refresh' content='0; url=?page=SalesPointOfInterest'>";
    }
    exit;
  } 
} // Penutup Tombol Simpan

# VARIABEL DATA UNTUK DIBACA FORM
// Supaya saat ada pesan error, data di dalam form tidak hilang. Jadi, tinggal meneruskan/memperbaiki yg salah

$dataCategory   = isset($_POST['Category']) ? $_POST['Category'] : '';
$dataSubCategory = isset($_POST['SubCategory']) ? $_POST['SubCategory'] : '';
$dataSubSubCategory = isset($_POST['SubSubCategory']) ? $_POST['SubSubCategory'] : '';
$dataKeyword  = isset($_POST['Keyword']) ? $_POST['Keyword'] : '';
$dataTitle    = isset($_POST['Title']) ? $_POST['Title'] : '';
$dataDescription    = isset($_POST['Description']) ? $_POST['Description'] : '';
$dataURL    = isset($_POST['URL']) ? $_POST['URL'] : '';
$dataCityId    = isset($_POST['city']) ? $_POST['city'] : '';
$dataCountry    = isset($_POST['country']) ? $_POST['country'] : '';
$dataStateId    = isset($_POST['state']) ? $_POST['state'] : '';
?>



<!DOCTYPE html>
<html>
<head>
  <title>WiWE 270- Generate</title>
    <link rel="icon" sizes="192x192" href="../img/Icon.png"/>
    <!-- Glazzed & Bootstrap -->  
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

  <link rel="stylesheet" type="text/css" href="../css/main.min.css">
  <!-- Pixeden Icon Fonts -->
  <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
  <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-stroke.css">

  <!-- Include Bootstrap Datepicker -->
  <link rel="stylesheet" type="text/css" href="../css/bootstrap-datetimepicker.css">

 

<style>
   .push-to-bottom {
        position: absolute;
        bottom: 30px;
        width: 100%;
      }
      </style>

</head>
<body>
  
  <!-- Calling Top Bar & Side Bar --> 
  <?php include "menu.php"; ?>

  <!-- Content --> 

<section class = "content">
 <div class="main-header__nav">
              <h1 class="main-header__title">
                <i class="pe-7s-map-marker"></i>
              <span>PoI Campaign</span>
              </h1>
             <ul class="main-header__breadcrumb">
             <li><a href ="?page=SalesMarketingCampaign" >Marketing Campaign</a></li>
            	   <a href ="?page=SalesPointOfInterest" >Point of Interest</a>
           	</ul>
        </div>
        <br>
        <br>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" class="form-horizontal" role="form">

<div class="widget__content">
          <div class = "row">
      <div class = "col-md-4 dropdown">
         <select name="Category" onChange="getState(this.value)" class="form-control" required>
            <option value="">Category</option>
            <?php $db = new mysqli('localhost','u4784502_wiwe360','infotech','u4784502_wiwe360');
             $config = $db->query("SELECT DISTINCT `Category` as id, `Category` as country FROM `poisource` where `Category` not in ('N/A', 'Adult')");
              while ($view = $config->fetch_array()) {
             ?>
            <option value="<?php echo $view['id'] ?>"><?php echo $view['country']; ?></option>
            <?php } ?>
            </select>
      </div>

<!--
        <div>Country</div>
        <div>
        <select name="country" onChange="getState(this.value)">
      <option value="">Select Country</option>
      <option value="1">USA</option>
      <option value="2">Canada</option>
        </select>
        </div>
-->


          <div class = "col-md-4 dropdown"><div id="statediv"><select name="state"  class="form-control">
      <option value="<?php echo "$stateId";?>">Sub Categoty</option>
          </select></div></div>

          <div class = "col-md-4 dropdown"><div id="citydiv"><select name="city"  class="form-control">
      <option  value="<?php echo "$cityId";?>">Sub Sub Category</option>
          </select></div></div>


  </div>

 <br>
<div align="center"><font color="white"></font></div>
              
          
<br>

              <div class = "row">
                <div class ="col-xs-12 widget__form">
                  <input name="Keyword" type="text" class="stacked-input" id="input-1" placeholder="Keyword" required>
                </div>
        </div>
              <br><br>

  <font size ="5"> Message : </font>
<br><br>
  <article class = "widget__form">
  <input  name="Title" type="text" class="stacked-input" id = "inputTitle" placeholder="Title" required><br>
  <input name="Description" type="text" class="stacked-input" id = "inputDescription" placeholder="Description" required><br>
  <input name="URL" type="text" class="stacked-input" id = "inputURL" placeholder="URL to your E-Commerce" required><br>
  </article>
  <br>
<div class ="col-md-6 widget__form">
          <button  type="reset">Reset</button>
          </div>
<div class ="col-md-6 widget__form">
            <button  type="submit" name="btnSimpan" value=" Submit " class="btn btn-info" type="button">Save</button>
            <input hidden>

        </div>
</form>
</section>


  <script type="text/javascript" src="../js/jquery.min.js"></script>
  <script type="text/javascript" src="../js/bootstrap-datetimepicker.js"></script>
  <script type="text/javascript">
   flatpickr(".flatpickr", {
  enableTime: true
  });
  </script>
  <script language="javascript" type="text/javascript">

function getXMLHTTP() { 
    var xmlhttp=false;  
    try{
      xmlhttp=new XMLHttpRequest();
    }
    catch(e)  {   
      try{      
        xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e){
        try{
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch(e1){
          xmlhttp=false;
        }
      }
    }
      
    return xmlhttp;
    }
  
  function getState(countryId) {    
    var strURL="../modul/Sales/findState.php?country="+countryId;
    var req = getXMLHTTP();
    
    if (req) {
      
      req.onreadystatechange = function() {
        if (req.readyState == 4) {
          // only if "OK"
          if (req.status == 200) {            
            document.getElementById('statediv').innerHTML=req.responseText;           
          } else {
            alert("There was a problem while using XMLHTTP:\n" + req.statusText);
          }
        }       
      }     
      req.open("GET", strURL, true);
      req.send(null);
    }   
  }   
  function getCity(countryId,stateId) { 
    var strURL="../modul/Sales/findCity.php?country="+countryId+"&state="+stateId;
    var req = getXMLHTTP();
    
    if (req) {
      
      req.onreadystatechange = function() {
        if (req.readyState == 4) {
          // only if "OK"
          if (req.status == 200) {            
            document.getElementById('citydiv').innerHTML=req.responseText;            
          } else {
            alert("There was a problem while using XMLHTTP:\n" + req.statusText);
          }
        }       
      }     
      req.open("GET", strURL, true);
      req.send(null);
    }
        
  }
</script>


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

