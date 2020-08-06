<?php
include "wiwe360CaptivePortalConfig.php";

ini_set('mysql.connect_timeout',300);
ini_set('default_socket_timeout',300);


//Function to display image preview from Frame 1 AND 1st Banner
function displayimageC()
	{
		$Link=@mysql_connect(DBHOST,DBUSER,DBPASS);
		mysql_select_db(DBNAME,$Link);
		$result=mysql_query("select * from CPLayout where FrameID=1 AND BannerID =1",$Link);
		while ($row =mysql_fetch_array($result)) {
			echo '<img height="300" width="520" src="data:image;base64,'.$row[7].' ">';
		}
		mysql_close($Link);
	}

//Function to display image preview from Frame 1 AND 1st Banner
function displayimage1()
	{
		$Link=@mysql_connect(DBHOST,DBUSER,DBPASS);
		mysql_select_db(DBNAME,$Link);
		$result=mysql_query("select * from CPLayout where FrameID=1 AND BannerID =1",$Link);
		while ($row =mysql_fetch_array($result)) {
			echo '<img height="100" width="100" src="data:image;base64,'.$row[7].' ">';
		}
		mysql_close($Link);
	}
//Function to display image preview from Frame 1 AND 2nd Banner
function displayimage2()
	{
		$Link=@mysql_connect(DBHOST,DBUSER,DBPASS);
		mysql_select_db(DBNAME,$Link);
		$result=mysql_query("select * from CPLayout where FrameID=1 AND BannerID =2",$Link);
		while (@$row =mysql_fetch_array($result)) {
			echo '<img height="100" width="100" src="data:image;base64,'.$row[7].' ">';
		}
		mysql_close($Link);
	}
//Function to display image preview from Frame 1 AND 3rd Banner
function displayimage3()
	{
		$Link=@mysql_connect(DBHOST,DBUSER,DBPASS);
		mysql_select_db(DBNAME,$Link);
		$result=mysql_query("select * from CPLayout where FrameID=1 AND BannerID =3",$Link);
		while (@$row =mysql_fetch_array($result)) {
			echo '<img height="100" width="100" src="data:image;base64,'.$row[7].' ">';
		}
		mysql_close($Link);
	}


//Function to insert or update image of Frame 1 AND 1st Banner
function saveimage1($name1,$image1)
	{
		$Link=@mysql_connect(DBHOST,DBUSER,DBPASS);
		mysql_select_db(DBNAME,$Link);
		$result=mysql_query("select name from CPLayout where FrameID=1 AND BannerID =1",$Link);
		if (mysql_num_rows($result) > 0) {
		    $update=mysql_query("UPDATE CPLayout SET NAME='$name1',Image='$image1' WHERE FrameID=1 AND BannerID =1",$Link);
		    }
		else {
		   	echo "insert";
		   	$insert=mysql_query("insert into CPLayout (FrameID, FrameName, BannerID, name, image) values (1,'Frame 1',1,'$name1','$image1')",$Link);
			}
		mysql_close($Link);
	}

//Function to insert or update image of Frame 1 AND 2nd Banner
function saveimage2($name2,$image2)
	{
		$Link=@mysql_connect(DBHOST,DBUSER,DBPASS);
		mysql_select_db(DBNAME,$Link);
		$result=mysql_query("select name from CPLayout where FrameID=1 AND BannerID =2",$Link);
		if (mysql_num_rows($result) > 0) {
		    $update=mysql_query("UPDATE CPLayout SET NAME='$name2',Image='$image2' WHERE FrameID=1 AND BannerID =2",$Link);
		    }
		else {
		   	echo "insert";
		   	$insert=mysql_query("insert into CPLayout (FrameID, FrameName, BannerID, name, image) values (1,'Frame 1',2,'$name2','$image2')",$Link);
			}
		mysql_close($Link);
	}

//Function to insert or update image of Frame 1 AND 3rd Banner
function saveimage3($name3,$image3)
	{
		$Link=@mysql_connect(DBHOST,DBUSER,DBPASS);
		mysql_select_db(DBNAME,$Link);
		$result=mysql_query("select name from CPLayout where FrameID=1 AND BannerID =3",$Link);
		if (mysql_num_rows($result) > 0) {
		    $update=mysql_query("UPDATE CPLayout SET NAME='$name3',Image='$image3' WHERE FrameID=1 AND BannerID =3",$Link);
		    }
		else {
		   	echo "insert";
		   	$insert=mysql_query("insert into CPLayout (FrameID, FrameName, BannerID, name, image) values (1,'Frame 1',3,'$name3','$image3')",$Link);
			}
		mysql_close($Link);
	}

	//Save button to update WelcomeText, PortalText & PopUpHeader
	if(@$_POST['submit']=="Save") {
		$WelcomeText = $_POST["WelcomeText"];
		$PortalText = $_POST["PortalText"];
		$PopUpHeader = $_POST["PopUpHeader"];
		
		$Link=@mysql_connect(DBHOST,DBUSER,DBPASS);
		mysql_select_db(DBNAME,$Link);
		
		$update=mysql_query("UPDATE CPLayout SET WelcomeText='$WelcomeText',PortalText='$PortalText',PopUpHeader='$PortalText' WHERE FrameID=1",$Link);
		if($update)
				{
					echo "Record saved";
				}
				else 
				{
					echo "Could not save";
				}
		mysql_close($Link);
	}
?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themes-pixeden.com/demos/glazzed/tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 02 Dec 2016 03:25:11 GMT -->
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Glazzed Admin Theme :: Statistics</title>
	
	<link rel="icon" sizes="192x192" href="img/touch-icon.png" /> 
	<link rel="apple-touch-icon" href="img/touch-icon-iphone.png" /> 
	<link rel="apple-touch-icon" sizes="76x76" href="img/touch-icon-ipad.png" /> 
	<link rel="apple-touch-icon" sizes="120x120" href="img/touch-icon-iphone-retina.png" />
	<link rel="apple-touch-icon" sizes="152x152" href="img/touch-icon-ipad-retina.png" />
	
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.min.css">

	<style>
.topleft {
    position: absolute;
    top: 40px;
    left: 80px;
    font-size: 18px;
	}

</style>


	
	<!-- Pixeden Icon Fonts -->
	<link rel="stylesheet" type="text/css" href="css/pe-icon-7-filled.css">
	<link rel="stylesheet" type="text/css" href="css/pe-icon-7-stroke.css">
</head>
<body>
	<div id="loading">
		<div class="loader loader-light loader-large"></div>
	</div>
	<header class="top-bar">
		
		<ul class="profile"> 
			<li>
				<a href="#" class="btn-circle no-circle">
					<i class="pe-7f-back"></i>
				</a>
			</li>
			<li>
				<a href="#" onclick="return false;" class="btn-circle btn-sm">
					<i class="pe-7f-mail"></i>
					<span class="badge badge--blue">8</span>
				</a>
			</li>
			<li>
				<a href="#" onclick="return false;" class="btn-circle btn-sm">
					<i class="pe-7g-sets"></i>
				</a>
			</li>
			<li>
				<a href="#" onclick="return false;" class="btn-circle btn-sm active">
					<i class="pe-7g-user"></i>
				</a>
			</li>
			<li class="mobile-nav">
				<a href="#" onclick="return false;" class="btn-circle btn-sm">
					<i class="pe-7f-menu"></i>
				</a>
			</li>
		</ul>

		<div class="main-search">
			<input type="text" placeholder="Search ..." id="msearch">
			<label for="msearch">
				<i class="pe-7s-search"></i>
			</label>
			<button>
				<i class="pe-7g-arrow-circled pe-rotate-90"></i>
			</button>
		</div>
		
		<div class="main-brand">
			<div class="main-brand__container">
				<div class="main-logo"><img src="img/logo.png"></div>
				<input type="checkbox" id="s-logo" class="sw" />
				<label class="swtc swtc--dark swtc--header" for="s-logo"></label> 
			</div>
		</div>
		
	</header> <!-- /top-bar -->


	<div class="wrapper">

		<aside class="sidebar">
			
			<?php include "menu.php"; ?>
			
		</aside> <!-- /sidebar -->
		
		<section class="content">
			<header class="main-header">
				<div class="main-header__nav">
					<h1 class="main-header__title">
						<i class="pe-7f-note2"></i>
						<span>Tables &amp; forms</span>
					</h1>
					<ul class="main-header__breadcrumb">
						<li><a href="#" onclick="return false;">Home</a></li>
						<li class="active"><a href="#" onclick="return false;">Tables &amp; forms</a></li>
					</ul>
				</div>
				
			</header> <!-- /main-header -->


				
			
 <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Preview</button>
				<div class="row">

					<div class="col-md-4">
						<article class="widget widget__form">
							<header class="widget__header">
								<div class="widget__title">
									<i class="pe-7s-menu"></i><h3>Full form</h3>
								</div>
								<div class="widget__config">
									<a href="#"></a>
									<a href="#"><i class="pe-7s-close"></i></a>
								</div>
							</header>

							<form class="widget__content" method="post">
								<input type="text" name="WelcomeText" placeholder="Enter Welcome Text">
								<input type="text" name="PortalText" placeholder="Enter Portal Text">
								<input type="text" name="PopUpHeader" placeholder="Enter Pop Up Header">
								<button class="btn btn-info"  type="submit" name="submit" type="button" value="Save"> Save</button>
						

									
						</form>
					</div>
					
					<div class="col-md-8">
						<article class="widget widget__form">
							<header class="widget__header">
								<div class="widget__title">
									<i class="pe-7s-menu"></i><h3>Labeled full form</h3>
								</div>
								<div class="widget__config">
									<a href="#"><i class="pe-7f-refresh"></i></a>
									<a href="#"><i class="pe-7s-close"></i></a>
								</div>
							</header>

				<form method="post" enctype="multipart/form-data" class="widget__content">
								
				<label class="full-label">
				<input type="file" name="image1" id="file-att">
				<i class="pe-7f-paperclip"></i><span class="label"> image 1  <?php
				if(isset($_POST['submit1'])) {
				if(@getimagesize($_FILES['image1']['tmp_name'])== FALSE) {
				echo "Please select an image.";
				}
				else {
				$image1= addslashes($_FILES['image1']['tmp_name']);
				$name1= addslashes($_FILES['image1']['name']);
				$image1= file_get_contents($image1);
				$image1= base64_encode($image1);
				saveimage1($name1,$image1);
				}
				}
				echo "<br>";
				?></span>
				</label>
				<?php			
				displayimage1();
				?>
				<button class="btn blue fixed"  type="submit" name="submit1" value="Upload Banner 1">Save</button>
						
						</form>
				
			<form method="post" enctype="multipart/form-data" class="widget__content">
								
				<label class="full-label">
				<input type="file" name="image2" id="file-att2">
				<i class="pe-7f-paperclip"></i><span class="label"> image 2  <?php
			if(isset($_POST['submit2'])) {
				if(@getimagesize($_FILES['image2']['tmp_name'])== FALSE) {
					echo "Please select an image.";
				}
				else {
					$image2= addslashes($_FILES['image2']['tmp_name']);
					$name2= addslashes($_FILES['image2']['name']);
					$image2= file_get_contents($image2);
					$image2= base64_encode($image2);
					saveimage2($name2,$image2);
				}
			}
			echo "<br>";
		?></span>
				</label>
				<?php			
				displayimage2();
				?>
				<button class="btn blue fixed"  type="submit" name="submit2" value="Upload Banner 2">Save</button>
						
						</form>

			<form method="post" enctype="multipart/form-data" class="widget__content">
								
				<label class="full-label">
				<input type="file" name="image3" id="file-att3">
				<i class="pe-7f-paperclip"></i><span class="label"> image 3  <?php
			if(isset($_POST['submit3'])) {
				if(@getimagesize($_FILES['image3']['tmp_name'])== FALSE) {
					echo "Please select an image.";
				}
				else {
					$image3= addslashes($_FILES['image3']['tmp_name']);
					$name3= addslashes($_FILES['image3']['name']);
					$image3= file_get_contents($image3);
					$image3= base64_encode($image3);
					saveimage3($name3,$image3);
				}
			}
			echo "<br>";
		?></span>
				</label>
				<?php			
				displayimage3();
				?>
				<button class="btn blue fixed"  type="submit" name="submit3" value="Upload Banner 3">Save</button>
						
						</form>

				</div> <!-- /row -->

				


				  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Preview Captive Portal</h4>
        </div>
        <div class="modal-body">

        <div class="container">
 			 <?php			
				displayimageC();
				?>
  <div class="topleft">Welcome to Hotel WiWE</div>
</div>
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>


			<footer class="footer-brand">
				<img src="img/logo_trim.png">
				<p>© 2014 Glazzed. All rights reserved</p>
			</footer>


		</section> <!-- /content -->

	</div>


	
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/amcharts/amcharts.js"></script>
	<script type="text/javascript" src="js/amcharts/serial.js"></script>
	<script type="text/javascript" src="js/amcharts/pie.js"></script>
	<script type="text/javascript" src="js/amcharts/xy.js"></script>
	<script type="text/javascript" src="js/amcharts/radar.js"></script>
	<script type="text/javascript" src="js/charts.js"></script>
</body>

<!-- Mirrored from themes-pixeden.com/demos/glazzed/tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 02 Dec 2016 03:25:13 GMT -->
</html>