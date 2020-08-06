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
				<div class="main-logo"><img src="../img/logoarba.png"; height="45px"; style="padding-top:3px ;padding-left:10px";></div>
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
			<h2 class="user-info__name">Hi <?php if ($_SESSION['FirstName'] == 'Sales') {echo 'Marketing Team';}
			else echo $_SESSION['FirstName'];?></h2>
				<h3 class="user-info__role">Manager - Management</h3>
				<ul class="user-info__numbers">

				</ul>
			</div> <!-- /user-info -->

			<ul class="main-nav">
				<li class="main-nav--active">
					<a class="main-nav__link" href='?page=270'>
						<span class="main-nav__icon"><i class="pe-7s-box1"></i></span>
						Management
					</a>
				</li>

				<li class="">
					<a class="main-nav__link" href='?page=Travel'>
						<span class="main-nav__icon"><i class="pe-7s-plane"></i></span>
						Travel/ Agent
					</a>
				</li>

				<!-- <li class="">
					<a class="main-nav__link" href='?page=itenenary-Add'>
						<span class="main-nav__icon"><i class="pe-7s-photo"></i></span>
						Itenenary
					</a>
				</li> -->

				<!-- Perlengkapan -->
				<li>
					<a class="main-nav__link" href="?page=Equipment">
						<span class="main-nav__icon"><i class="pe-7s-portfolio"></i></span>
						Equipment
					</a>
				</li>
		        <!-- User Monitor -->
				<li>
					<a class="main-nav__link" href="?page=User">
						<span class="main-nav__icon"><i class="pe-7s-graph3"></i></span>
						User Monitor
					</a>
				</li>

			</ul> <!-- /main-nav -->
		</aside> <!-- /sidebar -->

</body>
</html>
