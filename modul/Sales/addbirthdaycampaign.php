<!DOCTYPE html>
<?php
require('../config/wiwe360-config.php');
$name = $_POST['name'];
$desc = $_POST['description'];
$link = $_POST['link'];

if ($name != ''){
	
# BACA DATA DALAM FORM, masukkan datake variabel
$mySql = "INSERT INTO `birthdayCampaign` (`Name`, `Description`,`Link`)
				VALUES ('$name','$desc','$link')";

$myQry=mysql_query($mySql, $Link) or die ("Gagal query".mysql_error());
if($myQry){
	echo "<meta http-equiv='refresh' content='0; url=?page=SalesMarketingCampaign'>";
}
exit;
}
?>
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
	<!-- Tracker Bar Progess -->
	<link rel="stylesheet" href="../css/progresstraccerstyle.css">


	<style>
	 .push-to-bottom {
        position: absolute;
        bottom: 30px;
        width: 100%;
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
            		<i class="pe-7s-like"></i>
            	<span>Birthday Campaign</span>
          		</h1>
         		 <ul class="main-header__breadcrumb">
            <li><a href="?page=SalesMarketingCampaign" >Marketing Campaign</a></li>
          </ul>
        </div>

        <div class ="main-header__date">
                <button onclick="window.location='?page=SalesMarketingCampaign';">Discard</button>

               <input hidden>
          </div>

	</header>

<article class="widget widget__form">
		<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
              <div class="widget__content">
              <input type="text" class="stacked-input" id="input-1" name ="name" placeholder="Name" >
                 <input type="text" class="stacked-input" id="input-1" name ="description" placeholder="Description">
                    <input type="text" class="stacked-input" id="input-1" name ="link" placeholder="Attach your link to your content here ">

                <button type="submit">Save</button>
							</form>
  </div>
  </article>


  <script type="text/javascript" src="../js/main.js"></script> <!-- Loading -->

  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>



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
