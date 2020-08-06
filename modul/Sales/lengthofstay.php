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
            		<i class="pe-7s-cloud"></i>
            	<span>Length of Stay Campaign</span>
          		</h1>
         		 <ul class="main-header__breadcrumb">
            	<li><a href ="?page=SalesMarketingCampaign" ">Marketing Campaign</a></li>
           		 </ul>
       		 </div>
			</header>
<br><br><br>
<div class = "row">
                <div class ="col-md-2"></div>
					<div class="col-md-10">
						<article class="widget">
							<div class ="row">
                    <div class ="col-md-3">
                    <a href="?page=SalesLOS1N" target="_self"><img src="../img/1night.png" alt="user" width="180" class="img-responsive center-block"></a>	<br>
                    <center><font size ="5">One Night Stay </font><br><br>		
                   </center>
                </div>
                
                <div class ="col-md-3">
                     <a href="?page=SalesLOS2N" target="_self"><img src="../img/2night.png" alt="user" width="180" class="img-responsive center-block"></a><br>					
				    <center><font size ="5">Two Night Stay </font><br><br></center>
                </div>
                
                <div class ="col-md-3">
                    <a href="?page=SalesLOS3N" target="_self"><img src="../img/3night.png" alt="user" width="180" class="img-responsive center-block"></a><br>					
				    <center><font size="5">More Than Three Night </font><br><br>
				 </center>
                </div>
                
                       
            </div>
						</article><!-- /widget -->
					</div>

				</div>

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

