<?php
include "/config/wiwe360-config.php";
function saveimage1($photourl, $name_pic)
	{
		$Link=@mysql_connect(DBHOST,DBUSER,DBPASS);
		mysql_select_db(DBNAME,$Link);
		$result=mysql_query("select name_pic from user where UserID =4 ",$Link);
		if (mysql_num_rows($result) > 0) {
		    $update=mysql_query("UPDATE user SET PhotoURL='$photourl', name_pic='$name_pic' WHERE UserID=4 ",$Link);
		    }
		else {
		   	echo "insert";
		   	$insert=mysql_query("insert into user (PhotoURL, name_pic) values ('$photourl', '$name_pic' )",$Link);
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
	
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/main.min.css">
	
	<!-- Pixeden Icon Fonts -->
	<link rel="stylesheet" type="text/css" href="/css/pe-icon-7-filled.css">
	<link rel="stylesheet" type="text/css" href="/css/pe-icon-7-stroke.css">
</head>
<body>
	

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
			








			<div class="user-info">
					<figure class="rounded-image profile__img">
						<img class="media-object" src="img/profile.jpg" alt="user">
					</figure>
					<h2 class="user-info__name">Hendrik Gunawan</h2>
					<h3 class="user-info__role">Admin Manager</h3>
					<ul class="user-info__numbers">
						<li>
							<i class="pe-7f-user"></i>
							<p>26k+</p>
							<p>+14</p>
						</li>
						<li>
							<i class="pe-7f-paper-plane"></i>
							<p>1095+</p>
							<p>+56</p>
						</li>
						<li>
							<i class="pe-7g-watch"></i>
							<p>428</p>
							<p>+38</p>
						</li>
					</ul>
				</div> <!-- /user-info -->

				<ul class="main-nav">
					<li>
						<a class="main-nav__link" href="admin.html">
							<span class="main-nav__icon"><i class="pe-7f-home"></i></span>
							Licence Manager
						</a>
					</li>
					<li>
						<a class="main-nav__link" href="ui.html">
							<span class="main-nav__icon"><i class="pe-7f-edit"></i></span>
							UI Elements
						</a>
					</li>
					
				</ul> <!-- /main-nav -->
			
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


				<div class="row">
					
					<div class="col-md-12">
						<article class="widget">
							<header class="widget__header">
								<div class="widget__title">
									<i class="pe-7s-menu"></i>   <button data-animation="animated fadeInLeft" onclick="document.getElementById('id01').style.display='block'"  class="btn blue fixed">Add</button>
								</div>
								<div class="widget__config">
									<a href="#"><i class="pe-7f-refresh"></i></a>
									<a href="#"><i class="pe-7s-close"></i></a>
								</div>
							</header>
							
							<div class="widget__content table-responsive">
								
								<table class="table table-striped media-table">
							  	<thead>
							  		<tr>
							  			<th width="10">No</th>
							  			<th width="280">Email</th>
							  			<th width="140">Full Name</th>
							  			<th width="10">Role</th>
							  			<th width="10">Last Login</th>
							  			<th>Del</th>
							  		</tr>
							  	</thead>
							  	<tbody>


<?php
  $mySql  = "SELECT * FROM user left join role on user.RoleID=role.RoleID ORDER BY UserID ASC";
  $myQry  = mysql_query($mySql, $Link)  or die ("Query  salah : ".mysql_error());
  $nomor  = 0; 
  while ($myData = mysql_fetch_array($myQry)) {
    $nomor++;
    $Kode = $myData['UserID'];
  ?>
							  	
							  		<tr class="spacer"></tr>
							  		<tr>
							  		<td>
										<?php echo $nomor; ?>
							  		</td>
							  		<td>
							  			<?php echo $myData['Email']; ?>
							  		</td>
							  		<td>
							  			<?php echo $myData['Salutation']; ?>
							  			<?php echo $myData['FirstName']; ?> 
							  			<?php echo $myData['LastName']; ?>
							  		</td>
							  		<td>
							  			<?php echo $myData['Role']; ?>
							  		</td>
							  		<td>
							  				
							  		</td>
							  		<td>
							  				
							  		</td>
							  		</tr>

					 <?php } ?>
                      
                      </tbody>

                    </table>
                     </td>
  </tr>
  <tr class="selKecil">
    <td><b>Jumlah Data :</b> <?php echo $jml; ?> </td>
    <td align="right"><b>Halaman ke :</b> 
  <?php
  for ($h = 1; $h <= $max; $h++) {
    $list[$h] = $row * $h - $row;
    echo " <a href='?page=Petugas-Data&hal=$list[$h]'>$h</a> ";
  }
  ?>
  </td>
  </tr>
</table>
                  </div><!-- /.span -->
                </div><!-- /.row -->


			<footer class="footer-brand">
				<img src="img/logo_trim.png">
				<p>© 2016 WiWE. All rights reserved</p>
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




	<div id="id01" class="modal">
  
  <form class="modal-content animate" action="action_page.php">
    <div class="">

					<div class="col-md-12">
						<article class="widget widget__form">
							<header class="widget__header">
								<div class="widget__title">
									<i class="pe-7s-menu"></i><h3>Full form</h3>
								</div>
								<div class="widget__config">
									<a href="#"><i class="pe-7f-refresh"></i></a>
									<a href="#"><i class="pe-7s-close"></i></a>
								</div>
							</header>

							<div class="widget__content">
								<input type="text" placeholder="Full name">
								<input type="text" placeholder="Promotion code">
								<input type="text" placeholder="Email">
								<button onclick="return false;">Apply</button>
						</div>
					</div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
</body>

<!-- Mirrored from themes-pixeden.com/demos/glazzed/tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 02 Dec 2016 03:25:13 GMT -->
</html>