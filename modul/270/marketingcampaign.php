<?php
session_start();
if($_SESSION['FirstName'] == 'Sales') {header('Location: ?page=SalesPrice');} ;

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
            		<i class="pe-7s-box1"></i>
            	<span>Marketing Campaign</span>
          		</h1>
         		 <br><br>
             </div>

			</header>
            <br><br><br><br><br><br><br>
            <div class ="row">
                <div class ="col-md-3">

                <a href="?page=TargetGroup" target="_self"><img src="../img/pointofInterestps.png" alt="user" width="180" class="img-responsive center-block"></a>	<br>
                    <center><font size ="5">Direct Broadcast </font><br><br>
                </div>
                
                <div class ="col-md-3">
                <a href="?page=PointOfInterest" target="_self"><img src="../img/OneShootCampaignps.png" alt="user" width="180" class="img-responsive center-block"></a> <br>	
                 <center><font size ="5">Point of Interest  </font><br><br>
                </div>				
				
                
                <div class ="col-md-3">
                     <a href="?page=LOS" target="_self"><img src="../img/TimeSpanCampaignps.png" alt="user" width="180" class="img-responsive center-block"></a><br>		<center><font size="5">Length of Stay </font><br><br>
				 
                </div>
                
                <div class ="col-md-3">
                     <a href="?page=AddBirthdayCampaign" target="_self"><img src="../img/BirthdayCampaignps.png" alt="user" width="200" class="img-responsive center-block" ></a><br>							
				    <center><font size ="5"> Birthday </font><br><br>			  		
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

