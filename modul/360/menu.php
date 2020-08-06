<!--<?php
//session_start();
//$FirstName = $_SESSION['FirstName'];
//$role = $_SESSION['role'];
?>-->

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<header class="top-bar">
		<ul class="profile">
				<li>
				<div class="main-logo"><img src="../img/garisdevumroh.png"; height="45px"; style="padding-top:3px ;padding-left:10px";></div>
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
				<!--<a style = "margin-top:15px;" href="#" class="btn-circle btn-sm"><i class=" pe-7f-bell"></i><span class="badge badge--red">2</span></a>	&nbsp;
				<a style = "margin-top:15px;" href="#" class="btn-circle btn-sm"><i class=" pe-7f-chat"></i><span class="badge badge--blue">8</span></a>	&nbsp;-->
				<a style = "margin-top:15px;" href="?page=Halaman-Utama" class="btn-circle btn-sm"><i class=" pe-7f-back"></i></a>	&nbsp;
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
			<h2 class="user-info__name">Hi <?php if ($_SESSION['FirstName'] == 'Sales') {echo 'Business Owner';}
			else echo $_SESSION['FirstName'];?></h2>
				<h3 class="user-info__role">Monitoring - Umroh</h3>
				<ul class="user-info__numbers">

				</ul>
			</div> <!-- /user-info -->

			<ul class="main-nav">
				<li class="main-nav--active">
					<a class="main-nav__link" href='?page=360' type="submit" name="btnCari" value="search" >
						<span class="main-nav__icon"><i class="pe-7s-global"></i></span>
						Website Performance
					</a>
				</li>

				<li class="main-nav--active">
					<a class="main-nav__link" href='?page=sms'>
						<span class="main-nav__icon"><i class="pe-7s-users"></i></span>
						SMS Gateway
					</a>
				</li>

				<li class="main-nav--active">
					<a class="main-nav__link" href='#'>
						<span class="main-nav__icon"><i class="pe-7s-signal"></i></span>
						Monitoring Agent
					</a>
				</li>

				<li class="main-nav--active">
					<a class="main-nav__link" href='#'>
						<span class="main-nav__icon"><i class="pe-7s-graph1"></i></span>
						Travel Reputation
					</a>
				</li>

			</ul> <!-- /main-nav -->
		</aside> <!-- /sidebar -->

</body>
</html>
