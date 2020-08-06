<!DOCTYPE html>
<html>
<head>
	<title>WiWE 270- Generate</title>
  	<link rel="icon" sizes="192x192" href="../img/Icon.png"/>
  	<!-- Glazzed & Bootstrap --> 	
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">

	<link rel="stylesheet" type="text/css" href="../css/main.min.css">
	<!-- Pixeden Icon Fonts -->
	<link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
	<link rel="stylesheet" type="text/css" href="../css/pe-icon-7-stroke.css">

	<!-- Include Bootstrap Datepicker -->
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />

	<link rel="stylesheet" type="text/css" href="../plugins/tigra_calendar/tcal.css"/>
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
            	<span>One Shot</span>
          		</h1>
         		 <ul class="main-header__breadcrumb">
            <li><a href="#" onclick="return false;"></a>Marketing Campaign</li>
          </ul>
        </div>
	</header>

	<img src="../img/uptime.png" alt="user" width="300" class="img-responsive center-block">
 	<div class = "row">
 	<div class = "col-md-2">
 	</div>
	<div class="col-md-8">
						<article class="widget widget__form">							
							<div class="widget__content">
							<input type="text" class="stacked-input" id="input-1" placeholder="Name">
							<input type="text" class="stacked-input" id="input-2" placeholder="Description">
							<input type="text" class="tcal" id = "inputStartDate" placeholder="Start Date">
							<input type="text" class="tcal" id = "inputEndDate" placeholder="End Date">
							<div class = "row">
							<div class = "col-md-4">
							<input type="checkbox" id="s-1" class="sw">
							<label class="switch" for="s-1"></label> Repeat Every 
							</div>
							<div class = "col-md-3">
							<select name="cmbLevel" required class="form-control" >
             				 <option value="KOSONG">Number </option>
             				 <?php
   			 					$pilihan = array("1", "2", "3", "4", "5", "6","7","8","9","10","11","12","13","14","15");
    							foreach ($pilihan as $nilai) {
      						if ($_POST['cmbLevel']==$nilai) { 
       					 	$cek="selected";
      						} else { $cek = ""; }
     	 echo "<option value='$nilai' $cek>$nilai</option>";
    }
    ?>
        </select>
        </div>

        <div class = "col-md-3">
							<select name="cmbLevel" required class="form-control" >
              <option value="KOSONG"> Day </option>
              <?php
   			 $pilihan = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday","Sunday");
    		foreach ($pilihan as $nilai) {
      		if ($_POST['cmbLevel']==$nilai) { 
       	 $cek="selected";
      	} else { $cek = ""; }
      echo "<option value='$nilai' $cek>$nilai</option>";
    }
    ?>
        </select>
        </div>

        </div>
					</div>
			</div>

			<div class = "row push-to-bottom">
					<hr class ="divider">
					<div class = "col-md-3">
					</div>
					<div class =" col-md-1">
					</div>
					<div class="col-md-3">
						<article class="widget widget__form">							
							<div class="widget__content">
								<button onclick="window.location='?page=DeliverySchedule';">Discard</button>
							</div>
					</div>

					<div class="col-md-3">
						<article class="widget widget__form">							
							<div class="widget__content">
								<button onclick="window.location='?page=TargetGroup';">Next</button>
							</div>
					</div>
					</div>


			<footer class="footer-brand">
					<?php include "footer.php"; ?>
			</footer>
		</section> <!-- /content -->

	<script type="text/javascript" src="../js/main.js"></script> <!-- Loading -->
	<script type="text/javascript" src="../js/datetimepicker/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/datetimepicker/bootstrap-datetimepicker.fr.js"></script>
	<script type="text/javascript" src="../js/datetimepicker/bootstrap-datetimepicker.js"></script>
	<script type="text/javascript" src="../js/datetimepicker/jquery-1.8.3.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
	<script type="text/javascript" src="../plugins/tigra_calendar/tcal.js"></script> 

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

