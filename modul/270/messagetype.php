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
	<!-- Tracker Bar Progess --> 
	<link rel="stylesheet" href="../css/styleTracker.css">
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

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
            	<span>Message Type</span>
          		</h1>
         		 <ul class="main-header__breadcrumb">
            <li><a href="#" onclick="return false;"></a>Marketing Campaign</li>
          </ul>
        </div>
	</header>



 <div class="row">
					<div class="col-md-12">
						<article class="widget">			
							<div class="widget__content table-responsive">
								<table class="table table-striped media-table">	
							  	<tbody>
							  		<tr class="spacer"></tr>
							  		<tr>
							  			<td width="30">
							  			<center>
							  				<div class="checkbox">
							  				<br>
 											<label>
    										<input data-toggle="toggle" type="checkbox">
  											</label>
											</div>
											</center>
							  			</td>
							  			<td width="500">
							  			<div class = "col-xs-3">
							  			<img src="../img/Mail.png" alt="user" width="100" class="img-responsive center-block">
							  			</div>
							  			<div class ="col-xs-9">
							  			Email Nottification <br>
							  			<font size =10 color ="orange"> 20 </font>
							  			</div>
							  			</td>
							  			<td>
							  				<div class="slider range-min sl2 orange active">
												<span class="num-min">Ora</span>
												<span class="num-max">10k</span>
											</div>
							  			</td>
							  			<td>
							  				<article class="widget widget__form">							
												<div class="widget__content">
												<button onclick="window.location='?page=EmailContent';">Edit</button>
												</div>
												</article>
							  			</td>
							  		</tr>

							  		
							  	</tbody>
								</table>
									
							</div> <!-- /widget__content -->

						</article><!-- /widget -->
					</div>


				</div> <!-- /row -->

				<div class="row">
					<div class="col-md-12">
						<article class="widget">			
							<div class="widget__content table-responsive">
								<table class="table table-striped media-table">	
							  	<tbody>
							  		<tr class="spacer"></tr>
							  		<tr>
							  			<td width="30">
							  			<center>
							  				<div class="checkbox">
							  				<br>
 											<label>
    										<input data-toggle="toggle" type="checkbox">
  											</label>
											</div>
											</center>
							  			</td>
							  			<td width="500">
							  				<div class ="col-xs-3">
							  				<img src="../img/Target.png" alt="user" width="100" class="img-responsive center-block">
							  				</div>

							  				<div class ="col-xs-9">
							  			Push Message Nottification <br>
							  			<font size =10 color ="orange"> 25 </font>
							  			</td>
							  			<td>
							  				<div class="slider range-min sl2 orange active">
												<span class="num-min">Ora</span>
												<span class="num-max">10k</span>
											</div>
							  			</td>
							  			<td>
							  				<article class="widget widget__form">							
												<div class="widget__content">
												<button onclick="window.location='?page=PushMessageContent';">Edit</button>
												</div>
												</article>
							  			</td>
							  		</tr>

							  		
							  	</tbody>
								</table>
									
							</div> <!-- /widget__content -->

						</article><!-- /widget -->
					</div>


				</div> <!-- /row -->


					<div class = "row push-to-bottom">
					<hr class ="divider">
					<div class="col-md-2">
						<article class="widget widget__form">							
							<div class="widget__content">
								<button onclick="window.location='?page=DeliverySchedule';">Discard</button>
							</div>
					</div>

					<div class="col-md-2">
						<article class="widget widget__form">							
							<div class="widget__content">
								<button onclick="window.location='?page=OneShot';">Back</button>
							</div>
					</div>

					<div class="col-md-2">
						<article class="widget widget__form">							
							<div class="widget__content">
								<button onclick="window.location='?page=Complete';">Next</button>
							</div>
							</article>
					</div>
					</div>
			

			<footer class="footer-brand">
					<?php include "footer.php"; ?>
			</footer>
		</section> <!-- /content -->

	<script type="text/javascript" src="../js/main.js"></script> <!-- Loading -->

	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

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

