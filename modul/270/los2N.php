<?php
require('../config/wiwe360-config.php');

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 10;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM los2n";
$pageQry = mysql_query($pageSql, $Link) or die ("error paging: ".mysql_error());
$jml   = mysql_num_rows($pageQry);
$max   = ceil($jml/$row);
?>

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

<style>
	 .push-to-bottom {
        position: absolute;
        bottom: 30px;
        width: 100%;
      }

      </style>

</head>
<body>
		

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
            	<span>Length of Stay Campaign 2 Night</span>
          		</h1>
         		 <ul class="main-header__breadcrumb">
            	<li><a href ="?page=MarketingCampaign" onclick="window.location='?page=MarketingCampaign';">Marketing Campaign</a></li>
            	   <a href ="?page=LOS" onclick="window.location='?page=LOS';">Length Of Stay Campaign</a>
            	</li>
           		 </ul>
       		 </div>

        			<div class="main-header__pojok">    
					<button onclick="window.location='?page=AddLOS2';">Add New</button>				            
         		 </div>
			</header>

<div class = "row">
					<div class="col-md-12">
						<article class="widget">
							<header class="widget__header">
								<div class="widget__title">
									<i class="pe-7s-menu"></i><h3>Length of Stay (2 Night)</h3>
								</div>
								<div class="widget__config">
									<a href="#"><i class=""></i></a>
									<a href="#"><i class=""></i></a>
								</div>
							</header>
							
							<div class="widget__content ">
								
								<table class="table table-striped media-table">
							  	<thead>
							  		<tr>
							  			<th style="width:1px">No </th>
							  			<th>Event</th>
							  			<th>Message Title</th>
							  			<th width="10px" >Day</th>
							  			<th width="10px" >Time</th>
							  			<th width="10px">Edit</th>
							  			<th>Del</th>
							  		</tr>
							  	</thead>


							  	<tbody>

	<?php
  $mySql  = "SELECT * FROM los2n ORDER BY `id_los2n` ASC LIMIT $hal, $row";
  $myQry  = mysql_query($mySql, $Link)  or die ("Query  salah : ".mysql_error());
  $nomor  = 0; 
  while ($myData = mysql_fetch_array($myQry)) {
    $nomor++;
    $Kode = $myData['id_los2n'];
  ?>	
							<tr class="spacer"></tr>
							<tr>
							<td>
							<font><p> <?php echo $nomor; ?></p></font>			</td>
							  			
							 <td>
							  <p> <?php echo $myData['event']; ?></p>
							 </td>
							  <td>
							  <p> <?php echo $myData['title']; ?></p>
							 </td>
							 <td>
							<font><p><?php echo $myData['day']; ?></p></font>								
							  </td>
							  			
							  			<td>
											<font><p><?php echo $myData['time']; ?></p></font>								
							  			</td>
							  			
                                        <td>
                                        <a href="?page=Edit-LOS2N&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data" title='Edit Data' ><i class="pe-7s-note"></i></a>

							  			</td>
							  			
							  			<td>
							  				<a href="?page=Delete-LOS2N&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data"  onclick="return confirm('ARE YOU SURE TO DELETE THIS DATA ... ?')" title='Delete'><i class="pe-7s-close"></i></a>

							  			  
							  			</td>
							  		</tr>

							  	
			<?php } ?>
							  	</tbody>
								</table>
		   <ul class="pagination pull-left no-margin">
<li class="" >
<strong style="font-weight: bold;">Total Records :</strong>
                                <?php echo $jml; ?>
</ul>
		
<?php 
		
		$prev = $hal - $row;
		if ($prev <= -$row) { $prev = 0;}
		$next = $hal + $row;
		$Selisih = $jml - $row;
		if ($Selisih <= 0) {$Selisih = 0;}
		
		if ($next >= $jml) { $next =  $Selisih;}
?>

		<ul class="pagination pull-right no-margin">
			<li class="prev">
		<?php
		echo "
			<a href='?page=LOS2N&hal=$prev'>
			<i class='pe-7s-prev'></i>
			</a>";
			?>
			</li>
		<li class="" >
			<?php
			for ($h = 1; $h <= $max; $h++) {
				$list[$h] = $row * $h - $row;
				echo " <a href='?page=LOS2N&hal=$list[$h]'>$h</a> ";
			}
			?>
		</li>
		<li class="next">
				<?php
		echo "
			<a href='?page=LOS2N&hal=$next'>
			<i class='pe-7s-next'></i>
			</a>";
			?>
		</li>
			</ul>
  

								
							</div> <!-- /widget__content -->

						</article><!-- /widget -->
					</div>

				</div>

			<footer class="footer-brand">
					<?php include "footer.php"; ?>
			</footer>
		</section> <!-- /content -->

	<script type="text/javascript" src="../js/main.js"></script> <!-- Loading -->
	
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

