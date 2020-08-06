<!DOCTYPE html>
<html>
<head>
	<title>WiWE 270 - Generate</title>
  	<link rel="icon" sizes="192x192" href="../img/Icon.png"/>
  	<!-- Glazzed & Bootstrap -->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/main.min.css">
	<!-- Pixeden Icon Fonts -->
	<link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
	<link rel="stylesheet" type="text/css" href="../css/pe-icon-7-stroke.css">
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
            		<i class="pe-7s-graph2"></i>
            	<span>Channel Analysis</span>
          		</h1>

       		 	</div>
			</header>

            <table class="table table-striped media-table">
							  	<thead>
							  		<tr>
							  			<th><strong style="font-weight: bold;"><center>OTA</center></strong></th>
							  			<th><strong style="font-weight: bold;"><center>Spent Money</center></strong></th>
							  			<th><strong style="font-weight: bold;"><center>Generated Money</center></strong></th>
							  			<th><strong style="font-weight: bold;"><center>RoI</strong></th>
							  			<th><strong style="font-weight: bold;"><center># of Clicks</center></th>
							  			<th ><strong style="font-weight: bold;"><center>#  of Booking</center></strong></th>
							  			<th ><strong style="font-weight: bold;"><center>Conversion Rate</center></strong></th>
							  			<th style="display : none"></th>
							  		</tr>
								 	</thead>

							  	<tbody>
							  	<tr class="spacer"></tr>
							  	<tr>
							  	<td>
							  	    Trip Advisor
							  	</td>

							     <td align ="right">
							       115,800,000
							     </td>

							     <td align ="right">
							         138,029,300
							     </td>

							     <td align ="right">
							         <font color ="green"> 19.20% </font>
							     </td>

							     <td align ="right">
							         537
							     </td>

							     <td align ="right">
							         254
							     </td>

							     <td align ="right">
							         47.2%
							     </td>

							      <td style="display :none">

							     </td>
							  	</tr>
							  	<tr class="spacer"></tr>
                                  <tr>
							  	<td >
							  	    Booking.com
							  	</td>

							     <td align ="right">
							       85,600,000
							     </td>

							     <td align ="right">
							       78,302,000
							     </td>

							     <td align ="right">
							        <font color ="red"> -8.53%  </font>
							     </td>

							     <td align ="right">
							         370
							     </td>

							     <td align ="right">
							         123
							     </td>

							     <td align ="right">
							         33.2%
							     </td>

							      <td style="display :none">

							     </td>
							  	</tr>

                              <tr class="spacer"></tr>
                                  <tr>
							  	<td >
							  	    Agoda
							  	</td>

							     <td align ="right">
							       72,400,000
							     </td>

							     <td align ="right">
							         65,394,020
							     </td>

							     <td align ="right">
							         <font color ="red"> -9.68% </font>
							     </td>

							     <td align ="right">
							         425
							     </td>

							     <td align ="right">
							         109
							     </td>

							     <td align ="right">
							         25.6%
							     </td>

							      <td style="display :none">

							     </td>
							  	</tr>

                               <tr class="spacer"></tr>
                                  <tr>
							  	<td>
							  	    Traveloka
							  	</td>

							     <td align ="right">
							       52,400,000
							     </td>

							     <td align ="right">
							         71,697,000
							     </td>

							     <td align ="right">
							        <font color ="green"> 36.83% </font>
							     </td>

							     <td align ="right">
							         195
							     </td>

							     <td align ="right">
							         119
							     </td>

							     <td align ="right">
							         61.1%
							     </td>

							     <td style="display :none">

							     </td>
							  	</tr>



                                </tbody>
            </table>


			<footer class="footer-brand">
					<?php include "footer.php"; ?>
			</footer>
		</section> <!-- /content -->

	<script type="text/javascript" src="../js/main.js"></script> <!-- Loading -->
	<script type="text/javascript" src="../js/amcharts/amcharts.js"></script>
	<script type="text/javascript" src="../js/amcharts/serial.js"></script>
	<script type="text/javascript" src="../js/amcharts/pie.js"></script>
	<script type="text/javascript" src="../js/chartz.js"></script>

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
