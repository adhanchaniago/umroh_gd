<?php
session_start();
$FirstName = $_SESSION['FirstName'];
$role = $_SESSION['role'];
?>



<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin</title>
    <link rel="icon" sizes="192x192" href="/img/Icon.png"/> 

	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/main.min.css">
	
	<!-- Pixeden Icon Fonts -->
	<link rel="stylesheet" type="text/css" href="/css/pe-icon-7-filled.css">
	<link rel="stylesheet" type="text/css" href="/css/pe-icon-7-stroke.css">
</head>
<body>
	<div id="loading">
		<div class="loader loader-light loader-large"></div>
	</div>
	<header class="top-bar">
		
		<ul class="profile"> 
			<li>
				<div class="main-logo"><img src="/img/logo.png" height="50px"></div>
			</li>
			<li class="mobile-nav">
				<a href="#" onclick="return false;" class="btn-circle btn-sm">
					<i class="pe-7f-menu"></i>
				</a>
			</li>
		</ul>

		
		
	<div class="main-brand">
			<div class="main-brand__container">
				<a style = "margin-top:15px;" href="#" class="btn-circle btn-sm"><i class=" pe-7f-bell"></i><span class="badge badge--red">2</span></a>	&nbsp;
				<a style = "margin-top:15px;" href="#" class="btn-circle btn-sm"><i class=" pe-7f-chat"></i><span class="badge badge--blue">8</span></a>	&nbsp;
				<a style = "margin-top:15px;" href="#" class="btn-circle btn-sm"><i class=" pe-7f-config"></i></a>	&nbsp;
				<a style = "margin-top:15px;" href="/modul/logout.php" class="btn-circle btn-sm"><i class=" pe-7f-power"></i></a>
			</div>
		</div>
		
	</header> <!-- /top-bar -->


	<div class="wrapper">

		<aside class="sidebar">
			
			<div class="user-info">
					<figure class="rounded-image profile__img">
						<img class="media-object" src="/img/profile.jpg" alt="user">
					</figure>
					<h2 class="user-info__name">Hi <?php echo $_SESSION['FirstName'];?></h2>
					<h3 class="user-info__role">Your Module is <?php echo $_SESSION['role'];?></h3>
					<ul class="user-info__numbers">
						
					</ul>
				</div> <!-- /user-info -->

				<ul class="main-nav">
					<li class="main-nav--active">
						<a class="main-nav__link" href="admin.html">
							<span class="main-nav__icon"><i class="pe-7f-home"></i></span>
							Licence Manager
						</a>
					</li>
					<li>
						<a class="main-nav__link" href="/modul/admin/userManagement.php">
							<span class="main-nav__icon"><i class="pe-7f-edit"></i></span>
							User Management
						</a>
					</li>

					<li>
						<a class="main-nav__link" href='logout.php'>
							<span class="main-nav__icon"><i class="pe-7f-power"></i></span>
							Logout
						</a>
					</li>
					
				</ul> <!-- /main-nav -->
			
		</aside> <!-- /sidebar -->
		
		<section class="content">
			<header class="main-header">
				<div class="main-header__nav">
					<h1 class="main-header__title">
						<i class="pe-7f-home"></i>
						<span>Dashboard</span>
					</h1>
					<ul class="main-header__breadcrumb">
						<li><a href="#" onclick="return false;">Home</a></li>
						<li><a href="#" onclick="return false;">Dashboard</a></li>
						<li class="active"><a href="#" onclick="return false;">Lincence Manager</a></li>
					</ul>
				</div>
				
				
			</header> <!-- /main-header -->

			<div>
					<div class="main-stats__stat col-md-3 col-sm-3">
						<h3 class="main-stats__title">Licence</h3>
						<li>
						<p class="main-stats__resume">Status : Active</p>
						</li>
						<li>
						<p class="main-stats__resume">Module : WiWE 360</p>
						</li>
						
						<li>
						<p class="main-stats__resume">Expired : Dec 1, 2016 (Remaining 30 Day)</p>
						</li>
						<li>
						<p class="main-stats__resume">HotelID : GMU1116</p>
						</li>
					</div> <!-- /col -->
				  
				
<div class="row">

					<div class="col-md-4">
						<article class="widget widget__form">
							<header class="widget__header">
								<div class="widget__title">
									<i class="pe-7s-menu"></i><h3>Licence</h3>
								</div>
								<div class="widget__config">
									<a href="#"><i class="pe-7f-refresh"></i></a>
									<a href="#"><i class="pe-7s-close"></i></a>
								</div>
							</header>

							<div class="widget__content">
								<input type="text" placeholder="Licence">
								<button onclick="return false;">Apply</button>
						</div>
					</div>
			



			<footer class="footer-brand">
				<img src="img/logo_trim.png">
				<p>© 2014 Glazzed. All rights reserved</p>
			</footer>


		</section> <!-- /content -->

	</div>
	<script type="text/javascript" src="/js/main.js"></script>

</body>

</html>