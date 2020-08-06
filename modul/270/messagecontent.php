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

<?php 
	$set1 = '';$set2 ='';$set3='';$set4='';$set5='';$set6='';$set7='';$set8="";
	if (isset($_POST['OldWomen'])){

		$set1 = 'oldWomen';
	};

	if (isset($_POST['OldMen'])){

		$set2 = "OldMen";
	};

	if (isset($_POST['Boys'])){

		$set3 = "Boys";
	};

	if (isset($_POST['Girls'])){

		$set4 ="Girls";
	};

	if (isset($_POST['YoungMen'])){

		$set5="YoungMen";
	};

	if (isset($_POST['YoungWomen'])){

		$set6 = "YoungWomen";
	};

	if (isset($_POST['TeenageBoys'])){

		$set7 ="TeenageBoys";
	};

	if (isset($_POST['TeenageGirls'])){

		$set8 ="TeenageGirls";
	};
?>

	<!-- Content --> 
	
<section class="content">
			<header class = "main-header">
 				<div class="main-header__nav">
          		<h1 class="main-header__title">
            		<i class="pe-7s-note"></i>
            	<span>Message Content</span>
          		</h1>
         		
        </div>
        
               <div class="main-header__date">
               
				
					<button onclick="window.location='?page=270';">Discard</button>
					<button onclick="window.location='?page=TargetGroup';">Back</button>
                    <input hidden > 
                </div>
	</header>



 <div class = "row">
 <div class ="col-md-3">
 </div>
<div class = "col-md-3">
	
		<br>
		<img src="../img/mail.png" alt="user" width="235" class="img-responsive center-block"><br>
		<center><span> Mail </span></center> <br> <br>
		<center><button class="btn blue fixed" onclick="window.location='?page=EmailContent';">Create</button> </center> 
	
	</div>

	<div class = "col-md-3">
	
		<br>
		<img src="../img/Target.png" alt="user" width="230" class="img-responsive center-block"><br>
		<center><span> Push Nottification </span></center> <br> <br>
		<center><button class="btn blue fixed" onclick="window.location='?page=PushMessageContent';">Create</button> </center> 
		
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

