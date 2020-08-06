<?php
session_start();
$FirstName = $_SESSION['FirstName'];
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<header class="top-bar">
		<ul class="profile">
			<li>
				<div class="main-logo"><img src="../img/logo.gif"; height="45px"; style="padding-top:3px ;padding-left:10px";></div>
			</li>
			<li class="mobile-nav">
				<a href="#" onclick="return false;" class="btn-circle btn-sm">
					<i class="pe-7f-menu"></i>
				</a>
			</li>
		</ul>
		<!-- /top-bar Brand and Logoff -->
		<div class="main-brand">
			<div class="main-brand__container">
				<a style = "margin-top:15px;" href="#" class="btn-circle btn-sm"><i class=" pe-7f-bell"></i><span class="badge badge--red">2</span></a>	&nbsp;
				<a style = "margin-top:15px;" href="#" class="btn-circle btn-sm"><i class=" pe-7f-chat"></i><span class="badge badge--blue">8</span></a>	&nbsp;
				<a style = "margin-top:15px;" href="#" class="btn-circle btn-sm"><i class=" pe-7f-config"></i></a>	&nbsp;
				<a style = "margin-top:15px;" href="?page=Logout" class="btn-circle btn-sm"><i class=" pe-7f-power"></i></a>
			</div>
		</div>
	</header> <!-- /top-bar -->


	<!-- Side Bar -->
	<div class="wrapper">
		<aside class="sidebar">
			<div class="user-info">
				<figure class="rounded-image profile__img">
					<img class="media-object" src="../img/user1.jpg" alt="user">
				</figure>
			<h3 class="user-info__name" style="font-size:20px">Hi <?php if ($_SESSION['FirstName'] == 'Sales') {echo 'George';}
			else echo $_SESSION['FirstName'];?></h3>
				<h3 class="user-info__role"> </h3>
				<ul class="user-info__numbers">

				</ul>
			</div> <!-- /user-info -->

			<ul class="main-nav">
			<li class="main-nav--active">
					<a class="main-nav__link" href='?page=Sales'>
						<span class="main-nav__icon"><i class="pe-7s-signal"></i></span>
						AP Monitor
					</a>
				</li>
			<!-- Wi-Fi Monitor -->
			<li>
				<a class="main-nav__link" href='?page=SalesUsrMonitor'>
					<span class="main-nav__icon"><i class="pe-7s-user"></i></span>
					User Monitor
				</a>
			</li>

				<!-- Hotel Reputation -->
				<li class="main-nav--collapsible">
					<a class="main-nav__link" href="#" onclick="return false;">
						<span class="main-nav__icon"><i class="pe-7f-medal"></i></span>
						Hotel Reputation<span class="badge badge--line badge--blue">2</span>
					</a>
					<ul class="main-nav__submenu">
						<li><a href='?page=SalesCustFolio&uid=1'<span>Customer Folio</span></a></li>
						<li><a href='?page=SalesCompRev'><span>Competition Review</span></a></li>
					</ul>
				</li>
				</li>
				<!-- Website Performance -->
				<li>
					<a class="main-nav__link" href='?page=SalesWebPerform'>
						<span class="main-nav__icon"><i class="pe-7s-global"></i></span>
						Website Performance
					</a>
				</li>
				<li>
					<a class="main-nav__link" href="?page=SalesPrice">
						<span class="main-nav__icon"><i class="pe-7s-cash"></i></span>
						Price Analysis
					</a>
				</li>
				<li>
					<a class="main-nav__link" href="?page=SalesChannel">
						<span class="main-nav__icon"><i class="pe-7s-graph2"></i></span>
						Channel Analysis
					</a>
				</li>
				<li class="main-nav__link">
					<a class="main-nav__icon" href='?page=salespoi'>
						<span class="main-nav__icon"><i class="pe-7s-look"></i></span>
						Point of Interest
					</a>
				</li>
				<li class="main-nav__link">
					<a class="main-nav__icon" href='?page=SalesMarketingCampaign'>
						<span class="main-nav__icon"><i class="pe-7s-gift"></i></span>
						Marketing Campaign
					</a>
				</li>


<!--
				<li>
					<a class="main-nav__link" href="#">
						<span class="main-nav__icon"><i class="pe-7f-cart"></i></span>
						E-Commerce
					</a>
				</li>
				<li>
					<a class="main-nav__link" href="#">
						<span class="main-nav__icon"><i class="pe-7s-door-lock"></i></span>
						Captive Portal
					</a>
				</li> -->
			</ul> <!-- /main-nav -->
		</aside> <!-- /sidebar -->

</body>
</html>
