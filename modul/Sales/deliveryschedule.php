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
	<link href="../css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

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
            	<span>Delivery Schedule</span>
          		</h1>
         		 <ul class="main-header__breadcrumb">
            <li><a href="#" onclick="return false;"></a>Marketing Campaign</li>
          </ul>
        </div>
	</header>
	
            <div class="form-group">
                <label for="dtp_input1" class="col-md-2 control-label">DateTime Picking</label>
                <div class="input-group date form_datetime col-md-5" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                    <input class="form-control" size="16" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>
				<input type="hidden" id="dtp_input1" value="" /><br/>
            </div>

 	<div class = "row">
 	<div class = "col-md-2">
 	</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<hr class ="divider">
					<div class = row>
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
								<button onclick="window.location='?page=DeliverySchedule';">Next</button>
							</div>
					</div>
			</div>
			</div>

			<footer class="footer-brand">
					<?php include "footer.php"; ?>
			</footer>
		</section> <!-- /content -->

	<script type="text/javascript" src="../js/main.js"></script> <!-- Loading -->

	<script type="text/javascript" src="/js/datetimepicker/jquery-1.8.3.min.js" charset="UTF-8"></script>
	<script type="text/javascript" src="/js/datetimepicker/bootstrap.min.js"></script>
	<script type="text/javascript" src="/js/datetimepicker/bootstrap-datetimepicker.js" charset="UTF-8"></script>
	<script type="text/javascript" src="/js/datetimepicker/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
	
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

