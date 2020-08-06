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

<style>
	 .push-to-bottom {
        position: absolute;
        bottom: 30px;
        width: 100%;
      }

      </style>

</head>
<body>
 <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
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
		            <span>New Campaign</span>
		          </h1>
		          <ul class="main-header__breadcrumb">
		            <li><a href="#" onclick="return false;">Marketing Campaign</a></li>
		            <li class="active"><a href="#" onclick="return false;">New Campaign</a></li>
		          </ul>
		        </div>

	</header>


  <!-- Content --> 
  
<section class="content">

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

