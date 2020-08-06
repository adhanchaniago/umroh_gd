<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>WiWE 180 - Return</title>
	<link rel="icon" sizes="192x192" href="../img/Icon.png"/> 
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/main.min.css">
	
	<!-- Pixeden Icon Fonts -->
	<link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
	<link rel="stylesheet" type="text/css" href="../css/pe-icon-7-stroke.css">
</head>
<body>
	<div id="loading">
		<div class="loader loader-light loader-large"></div>
	</div>
	<header class="top-bar">
		
	<ul class="profile"> 
			<li>
				<div class="main-logo"><img src="../img/logo.png" height="50px"></div>
			</li>
			<li class="mobile-nav">
				<a href="#" onclick="return false;" class="btn-circle btn-sm">
					<i class="pe-7f-menu"></i>
				</a>
			</li>
		</ul>
		<!-- /top-bar Brand and Logoff -->
		<div class="main-brand">
			<div class="main-brand__container">
				<a style = "margin-top:15px;" href="#" class="btn-circle btn-sm"><i class=" pe-7f-bell"></i><span class="badge badge--red">2</span></a>	&nbsp;
				<a style = "margin-top:15px;" href="#" class="btn-circle btn-sm"><i class=" pe-7f-chat"></i><span class="badge badge--blue">8</span></a>	&nbsp;
				<a style = "margin-top:15px;" href="?page=180" class="btn-circle btn-sm"><i class=" pe-7f-config"></i></a>	&nbsp;
				<a style = "margin-top:15px;" href="?page=Logout" class="btn-circle btn-sm"><i class=" pe-7f-power"></i></a>
			</div>
		</div>
	</header> <!-- /top-bar -->
	<div class="wrapper">
		<aside class="sidebar">
			<?php include "menu.php"; ?>
		</aside> <!-- /sidebar -->
		<section class="content">
		<!--	include "../modul/90/90dashboard.php"; ?> -->
		<?php include "config180.php"; ?>
			<footer class="footer-brand">
					<?php include "footer.php"; ?>
			</footer>
		</section> <!-- /content -->
	</div>
	<script type="text/javascript" src="../js/main.js"></script>
	<script type="text/javascript" src="../js/amcharts/amcharts.js"></script>
	<script type="text/javascript" src="../js/amcharts/serial.js"></script>
	<script type="text/javascript" src="../js/amcharts/pie.js"></script>
	<script type="text/javascript" src="../js/chart.js"></script>
	<script type="text/javascript" src="../js/chartz.js"></script>
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