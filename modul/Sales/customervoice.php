<!DOCTYPE html>
<html>
<head>
	<title>WiWE 90 - Listener</title>
  	<link rel="icon" sizes="192x192" href="../img/Icon.png"/>
  	<!-- Glazzed & Bootstrap --> 	
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
	<!-- Calling Top Bar & Side Bar --> 
	<?php include "menu.php"; ?>

	<!-- Content --> 
	
<section class="content">
			


			<header class="main-header">
				<div class="main-header__nav">
					<h1 class="main-header__title">
						<i class="pe-7s-graph1"></i>
						<span>Statistics</span>
					</h1>
					<ul class="main-header__breadcrumb">
						<li><a href="#" onclick="return false;">Home</a></li>
						<li class="active"><a href="#" onclick="return false;">Statistics</a></li>
					</ul>
				</div>
				
			</header> <!-- /main-header -->

			<div class="row">
					<div class="main-stats__stat col-md-3 col-sm-3">
						<h3 class="main-stats__title">Resume<br> of the day.</h3>
						<p class="main-stats__resume">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
						
					</div> <!-- /col -->
				  
				  <div class="main-stats__stat col-md-3 col-sm-3 col-xs-4">
						<div class="stat-circle">
							<h3>2.287</h3>
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 92 92">
								<circle style="opacity:0.16;fill:none;stroke:#000000;stroke-width:2;stroke-miterlimit:10;" cx="46" cy="46" r="45"/>
								<path style="fill:none;stroke:#FFFFFF;stroke-width:2;stroke-miterlimit:10;" d="M84.839,68.718C88.749,62.049,91,54.289,91,46C91,21.147,70.853,1,46,1"/>
							</svg>
						</div> <!-- /stat-circle -->
						<h4 class="main-stats__subtitle">Total<br>Reviewer<br>
							<span class="main-stats__resume"> 2.287 </span>
						</h4>
					</div> <!-- /col -->

					<div class="main-stats__stat col-md-3 col-sm-3 col-xs-4">
						<div class="stat-circle">
							<h3>88%</h3>
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 92 92">
							<circle style="opacity:0.16;fill:none;stroke:#000000;stroke-width:2;stroke-miterlimit:10;" cx="46" cy="46" r="45"/>
							<path style="fill:none;stroke:#FFFFFF;stroke-width:2;stroke-miterlimit:10;" d="M6.185,66.968C13.725,81.256,28.721,91,46,91c24.853,0,45-20.147,45-45C91,21.147,70.853,1,46,1"/>
							</svg>
						</div> <!-- /stat-circle -->
						<h4 class="main-stats__subtitle">Social<br> Positive<br>
							<span class="main-stats__resume"> 88%</span>
						</h4>

					</div> <!-- /col -->

					<div class="main-stats__stat col-md-3 col-sm-3 col-xs-4">
						<div class="stat-circle">
							<h3>18%</h3>
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 92 92">
								<circle style="opacity:0.16;fill:none;stroke:#000000;stroke-width:2;stroke-miterlimit:10;" cx="46" cy="46" r="45"/>
								<path style="fill:none;stroke:#FFFFFF;stroke-width:2;stroke-miterlimit:10;" d="M91,46C91,21.147,70.853,1,46,1"/>
							</svg>
						</div> <!-- /stat-circle -->
						<h4 class="main-stats__subtitle">Food<br> Negative<br>
							<span class="main-stats__resume"> 18%</span>
						</h4>
					</div> <!-- /col -->

				</div> <!-- row -->
			<div class="row">

				<div class="col-md-4">
						<article class="widget">
								<header class="widget__header one-btn">
								<div class="widget__title">
									<i class="pe-7f-plane pe-rotate-90"></i><h3>OTA</h3>
								</div>
								<div class="widget__config">
									<a href="#"><i class="pe-7f-refresh"></i></a>
								</div>
							</header>

							<div class="widget__content filled pad20">
								
								<div class="row">
									<div class="col-md-12 text-center btn__showcase2">
										
										<table class="table table-hover media-table">
									  	<thead>
									  		<tr>
									  			<th>Online Travel Agent</th>
									  			<th>Score</th>
									  		</tr>
									  	</thead>
									  	<tbody>

									  		

									  		<tr>
									  			<td class="text-left">
									  				<figure class="pull-left post__img">
														<img width="200px" height="70px" class="media-object" src="../img/trip.png" alt="user">
													</figure>
									  			</td>
									  			<td>
									  				4.5
									  			</td>
									  		</tr>

									  		

									  		<tr>
									  			<td class="text-left">
									  				<figure class="pull-left post__img">
														<img width="180px" height="50px" class="media-object" src="../img/booking.png" alt="user">
													</figure>
									  			</td>
									  			<td>
									  				8.5
									  			</td>
									  		</tr>

									  		
									  		<tr>
									  			<td class="text-left">
									  				<figure class="pull-left post__img">
														<img width="180px" height="70px" class="media-object" src="../img/agoda.png" alt="user">
													</figure>
									  			</td>
									  			<td>
														8.4
									  			</td>
									  		</tr>

									  	

									  	</tbody>
										</table>
										



									</div>

								</div>

							</div>
						</article><!-- /widget -->
					</div>

				
					
				<div class="col-md-3">
						<article class="widget">
							<header class="widget__header one-btn">
								<div class="widget__title">
									<i class="pe-7f-menu pe-rotate-90"></i><h3>3 Columns</h3>
								</div>
								<div class="widget__config">
									<a href="#"><i class="pe-7f-refresh"></i></a>
								</div>
							</header>
							
							<div class="widget__content widget__grid filled pad20">
								<br><p>Nice Place</p></br>
								<br><p>Spacius Room</p></br>
								<br><p>Great Service</p></br>
								<br><p>Kind Of Food</p></br>
								<br><p>Very Nice Place</p></br>
								<br><p>Good Hotel</p></br>

							</div> <!-- /widget__content -->

						</article><!-- /widget -->
					</div>



					<div class="col-md-5">
						<article class="widget">
							<header class="widget__header">
								<div class="widget__title">
									<i class="pe-7s-graph"></i><h3>Country</h3>
								</div>
								<div class="widget__config">
									<a href="#"><i class="pe-7f-refresh"></i></a>
									<a href="#"><i class="pe-7s-close"></i></a>
								</div>
							</header>
							
							<div class="widget__content filled widget-ui">
								
								<div class="row">
									<div class="col-md-12 text-center">
										<div id="chartdiv3" style="width: 100%; height: 362px;"></div>
									</div>
								</div>
								
								
							</div> <!-- /widget__content -->

						</article><!-- /widget -->
					</div>

					

				</div> <!-- /row -->




				




				


				

				<div class="row">
					

					<div class="col-md-6">
						<article class="widget">
							<header class="widget__header">
								<div class="widget__title">
									<i class="pe-7f-graph3"></i><h3>Bar Chart</h3>
								</div>
								<div class="widget__config">
									<a href="#"><i class="pe-7f-refresh"></i></a>
									<a href="#"><i class="pe-7s-close"></i></a>
								</div>
							</header>

							<div class="widget__content filled pad20">
								
								<div class="row">
									<div class="col-md-12 text-center btn__showcase2">
										<div id="chartdiv2" style="width: 100%; height: 362px;"></div>
									</div>

								</div>

							</div>
						</article><!-- /widget -->
					</div>


					<div class="col-md-6">
						<article class="widget">
							<header class="widget__header">
								<div class="widget__title">
									<i class="pe-7f-graph3"></i><h3>Total Riviewer</h3>
								</div>
								<div class="widget__config">
									<a href="#"><i class="pe-7f-refresh"></i></a>
									<a href="#"><i class="pe-7s-close"></i></a>
								</div>
							</header>

							<div class="widget__content filled pad20">
								
								<div class="row">
									<div class="col-md-12 text-center btn__showcase2">
										<div id="chartdiv" style="width: 100%; height: 362px;"></div>
									</div>

								</div>

							</div>
						</article><!-- /widget -->
					</div>


				

				</div> <!-- /row -->	


			<footer class="footer-brand">
					<?php include "footer.php"; ?>
			</footer>

		</section> <!-- /content -->

	<script type="text/javascript" src="../js/main.js"></script> <!-- Loading -->
	<script type="text/javascript" src="../js/amcharts/amcharts.js"></script>
	<script type="text/javascript" src="../js/amcharts/serial.js"></script>
	<script type="text/javascript" src="../js/amcharts/pie.js"></script>
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

