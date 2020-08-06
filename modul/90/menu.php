<?php
$FirstName = $_SESSION['FirstName'];
$Travel = $_SESSION['Travel'];
$role = $_SESSION['role'];
include '../library/tracking.php';
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
				<div class="main-logo"><img src="../img/rebuild.png"; height="45px"; style="padding-top:3px ;padding-left:10px";></div>
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
			<!--	<a style = "margin-top:15px;" href="#" class="btn-circle btn-sm"><i class=" pe-7f-bell"></i><span class="badge badge--red">2</span></a>	&nbsp;
				<a style = "margin-top:15px;" href="#" class="btn-circle btn-sm"><i class=" pe-7f-chat"></i><span class="badge badge--blue">8</span></a>	&nbsp; -->
<a style = "margin-top:15px;" href="?page=News_All" class="btn-circle btn-sm"><i class="pe-7s-volume"></i></a>	&nbsp;
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
					<img class="media-object" src="../img/user4.png" alt="user">
				</figure>
			<h2 class="user-info__name">Hi <?php if ($_SESSION['FirstName'] == 'Sales') {echo 'IT Operation';}
			else echo $_SESSION['FirstName'];?></h2>
				<h3 class="user-info__role">Division - Customer Relation</h3>
				<ul class="user-info__numbers">

				</ul>
			</div> <!-- /user-info -->

			<ul class="main-nav">
				<li class="main-nav--active">
					<a class="main-nav__link" href='?page=90'>
						<span class="main-nav__icon"><i class="pe-7f-plane"></i></span>
						Booking Umroh
					</a>
				</li>
					<li class="main-nav--">
					<a class="main-nav__link" href='?page=Waiting_Choice'>
						<span class="main-nav__icon"><i class="pe-7f-pin"></i></span>
						Unpaid
					</a>
				</li>
				<li class="main-nav--">
				<a class="main-nav__link" href='?page=DataJamaahCancel'>
					<span class="main-nav__icon"><i class="pe-7f-attention"></i></span>
					Cancel List
				</a>
			</li>
				<!-- Data Jamaah-->
				<li class="main-nav--collapsible">
					<a class="main-nav__link" href="#" onclick="return false;">
						<span class="main-nav__icon"><i class="pe-7s-network"></i></span>
						Registered<span class="badge badge--line badge--blue">3</span>
					</a>
					<ul class="main-nav__submenu">
						<li><a href='?page=DataJamaahSafwa'><span>Safwa</span></a></li>
						<li><a href='?page=DataJamaahRahmah'><span>Marwa</span></a></li>
						<li><a href='?page=DataJamaahIncentive'><span>Incentive</span></a></li>
					</ul>
				</li>

				<!-- mahrom -->
				<li class="main-nav--collapsible">
					<a class="main-nav__link" href="#" onclick="return false;">
						<span class="main-nav__icon"><i class="pe-7f-users"></i></span>
						Mahrom<span class="badge badge--line badge--blue">3</span>
					</a>
					<ul class="main-nav__submenu">
						<li><a href='?page=DataMahromBerkah'><span>Mahrom Berkah</span></a></li>
						<li><a href='?page=DataMahromRahmah'><span>Mahrom Rahmah</span></a></li>
						<li><a href='?page=DataMahromIncentive'><span>Mahrom Incentive</span></a></li>
					</ul>
				</li>
				<!-- Roomlist -->
				<li class="main-nav--collapsible">
					<a class="main-nav__link" href="#" onclick="return false;">
						<span class="main-nav__icon"><i class="pe-7f-medal"></i></span>
						Roomlist<span class="badge badge--line badge--blue">3</span>
					</a>
					<ul class="main-nav__submenu">
						<li><a href='?page=DataRoomlistBerkah'><span>Roomlist Berkah</span></a></li>
						<li><a href='?page=DataRoomlistRahmah'><span>Roomlist Rahmah</span></a></li>
						<li><a href='?page=DataRoomlistIncentive'><span>Roomlist Incentive</span></a></li>
					</ul>
				</li>

					<li class="main-nav--">
					<a class="main-nav__link" href='?page=Document'>
						<span class="main-nav__icon"><i class="pe-7s-cloud-upload"></i></span>
						Document
					</a>
				</li>

				<li class="main-nav--">
				<a class="main-nav__link" href='?page=Invoice-All'>
					<span class="main-nav__icon"><i class="pe-7s-wallet"></i></span>
					Invoice Payment
				</a>
			</li>


				</li>
				<!-- Website Performance -->
				<li>
					<a class="main-nav__link" href='?page=DataReport'>
						<span class="main-nav__icon"><i class="pe-7f-graph1"></i></span>
						Data Report
					</a>
				</li>
			</ul> <!-- /main-nav -->
		</aside> <!-- /sidebar -->

</body>
</html>
