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
	<link rel="stylesheet" href="../css/progresstraccerstyle.css">

	<link rel="stylesheet" href="https://unpkg.com/flatpickr/dist/flatpickr.min.css">
	<script src="https://unpkg.com/flatpickr"></script>

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
<input class="flatpickr" type="text" placeholder="Select Date..">
			<header class = "main-header">
 				<div class="main-header__nav">
          		<h1 class="main-header__title">
            		<i class="pe-7s-graph1"></i>
            	<span>Complete</span>
          		</h1>
         		 <ul class="main-header__breadcrumb">
            <li><a href="#" onclick="return false;"></a>Time Based Campaign</li>
          </ul>
        </div>
	</header>

	<div class="checkout-wrap">
  <ul class="checkout-bar">

    <li class="visited first">
      <a href="#">New Campaign</a>
    </li>
    
    <li class="visited">Target Group</li>
    
    <li class="visited">Message Type</li>
    
    <li class="visited">Message Content</li>
    
    <li class="active">Complete</li>
       
  </ul>

</div>
<br><br><br><br><br>

	<div class = "row">
	<div class = "col-xs-6">
			<article class = "widget">
				<div class="widget__content widget__grid filled pad20" style="height: 120px">
				<div class = "col-xs-3">
				<img src="../img/Mail.png" alt="user" width="80" >
				</div>
				<div class = "col-xs-5">
				<br>
				<font size ="15" color = "orange"> 25 </font> out of  100 * Email Nottification
				</div>
				</div>
				</article>
 	</div>
 	</div>


	<div class = "row">
	<div class = "col-xs-6">
			<article class = "widget">
				<div class="widget__content widget__grid filled pad20" style="height: 120px">
				<div class = "col-xs-3">
				<img src="../img/Target.png" alt="user" width="80" >
				</div>
				<div class = "col-xs-5">
				<br>
				<font size ="35" color ="orange"> 25 </font> out of  100 * Push Nottification
				</div>
				</div>
				</article>
 	</div>
 	</div>
 	<article class="widget widget__form">             
              <div class="widget__content">
              <input class="flatpickr" type="text" placeholder="Select Date..">
              </div>
              </article>

 	<div class = "row push-to-bottom">
					<hr class ="divider">

					<div class="col-md-2">
						<article class="widget widget__form">							
							<div class="widget__content">
								<button onclick="window.location='?page=MessageType';">Back</button>
							</div>
					</div>

					<div class="col-md-2">
						<article class="widget widget__form">							
							<div class="widget__content">
								<button onclick="window.location='?page=MarketingCampaign';">Save</button>
							</div>
					</div>
					</div>

			

			<footer class="footer-brand">
					<?php include "footer.php"; ?>
			</footer>
		</section> <!-- /content -->

	<script type="text/javascript" src="../js/main.js"></script> <!-- Loading -->

	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
	<script type="text/javascript">
		
		flatpickr(".flatpickr", {
			enableTime: true
			});
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

>