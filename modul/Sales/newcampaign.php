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

	<!-- Include Bootstrap Datepicker -->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-datetimepicker.css">


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
            <li><a href="#" onclick="return false;"></a>Marketing Campaign</li>
          </ul>
        </div>
	</header>

<div class="checkout-wrap">
  <ul class="checkout-bar">

    <li class="active">
      <a href="#">New Campaign</a>
    </li>
    
    <li class="next">Target Group</li>
    
    <li class="next">Message Type</li>
    
    <li class="next">Message Content</li>`
    
    <li class="next">Complete</li>
       
  </ul>

</div>

<br><br><br>
<br>
	
 	<div class = "row">
 	<div class = "col-md-2">
 	</div>
	<div class="col-md-8">
						<article class="widget widget__form">							
							<div class="widget__content">
							<input class="flatpickr" type="text" placeholder="Select Date..">
							<input type="text" class="stacked-input" id="input-1" placeholder="Name">
							<input type="text" class="stacked-input" id="input-2" placeholder="Description">

							<div class = "row">
							
							<div class = "col-xs-6">
							<input type="text" class="tcal" id = "inputStartDate" placeholder="Start Date">
							</div>
							<div class ="col-xs-5"> 
							
							</div>

							<div class = "row">
							<div class = "col-xs-6">
							<input type="text" class="tcal" id = "inputEndDate" placeholder="End Date">
							</div>
							</div>
							<br>
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
								<button onclick="window.location='?page=MarketingCampaign';">Discard</button>
							</div>
					</div>

					<div class="col-md-3">
						<article class="widget widget__form">							
							<div class="widget__content">
								<button onclick="window.location='?page=TargetGroup';">Next</button>
							</div>
					</div>
					</div>

<div class="input-append date form_datetime" data-date="2012-12-21T15:25:00Z">
								    <input size="16" type="text" value="" readonly>
								    <span class="add-on"><i class="icon-remove"></i></span>
								    <span class="add-on"><i class="icon-th"></i></span>
								</div>
								 

								
							</div>
			
		</section> <!-- /content -->


 	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap-datetimepicker.js"></script>
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

