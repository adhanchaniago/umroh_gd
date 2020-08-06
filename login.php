<?php
session_start();
include_once "library/inc.connection.php";
include_once "library/inc.library.php";
include_once "library/inc.pilihan.php";
include_once "library/inc.tanggal.php";

// Baca Jam pada Komputer
date_default_timezone_set("Asia/Jakarta");
?>

<!DOCTYPE html>
<html lang="en">

<!-- build by garidev  -->
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Arbasys :: Sign in</title>
	
	<link rel="icon" sizes="192x192" href="img/touch-icon.png" /> 
	<link rel="apple-touch-icon" href="img/touch-icon-iphone.png" /> 
	<link rel="apple-touch-icon" sizes="76x76" href="img/touch-icon-ipad.png" /> 
	<link rel="apple-touch-icon" sizes="120x120" href="img/touch-icon-iphone-retina.png" />
	<link rel="apple-touch-icon" sizes="152x152" href="img/touch-icon-ipad-retina.png" />
	
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.min.css">
	
	<!-- Pixeden Icon Fonts -->
	<link rel="stylesheet" type="text/css" href="css/pe-icon-7-filled.css">
	<link rel="stylesheet" type="text/css" href="css/pe-icon-7-stroke.css">
</head>
<body>
	<div id="loading">
		<div class="loader loader-light loader-large"></div>
	</div>

	
				
				
					<div>
					
					<div class="col-md-4  col-md-offset-4">
						<article class="widget widget__login">
							<header class="widget__header one-btn">
								<div class="widget__title">
									<div class="main-logo"><img src="img/logo.png"></div> Sign in Arbasys 1.0
								</div>
								<div class="widget__config">
									<a href="#" ></a>
								</div>
							</header>


							<form class="widget__content"" action="login_validasi.php" method="post" name="form1" target="_self"/>

								<input type="text"  name="txtUser" placeholder="Username" required>
								<input type="password" name="txtPassword" placeholder="Password" required>
								 <select name="cmbLevel" required class="form-control" >
              <option value="KOSONG">level</option>
              <?php
    $pilihan = array("BOD", "Manager", "CRO", "Finance", "SE", "Admin"	);
    foreach ($pilihan as $nilai) {
      if ($_POST['cmbLevel']==$nilai) { 
        $cek="selected";
      } else { $cek = ""; }
      echo "<option value='$nilai' $cek>$nilai</option>";
    }
    ?>
        </select>

     

								<button type="submit" name="btnLogin">Sign in</button>
							</div>
							</form>
						</article><!-- /widget -->
					</div>
				</div>



	 
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/amcharts/amcharts.js"></script>
	<script type="text/javascript" src="js/amcharts/serial.js"></script>
	<script type="text/javascript" src="js/amcharts/pie.js"></script>
	<script type="text/javascript" src="js/chart.js"></script>
</body>

<!-- Mirrored from themes-pixeden.com/demos/glazzed/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 29 Dec 2016 16:07:24 GMT -->
</html>