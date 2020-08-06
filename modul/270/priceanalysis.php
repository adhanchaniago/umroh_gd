<!DOCTYPE html>
<?php

require('../config/wiwe360-config.php'); //Load DB(mysql) config parameter
session_start();
$Hotel = $_SESSION['Hotel'];
$row = 9; 
$hal = isset ($_GET['hal']) ? $_GET['hal'] : 0; 
$nomor = 1;

function fontColor ($number){
    if ($number > 0) return '#00cc33';
    if ($number < 0 ) return '#ff6961';
    if ($number == 0) return '#f5f1de';
    
}

#Masukkan list Hotel yang ingin menjadi Perbandingan
$ListHotelComo = "( 'Alila Ubud',
                'Ashoka Tree Resort at Tanggayuda',
                'Ayung Resort',
                'Chapung Se Bali Villas Resort',
                'Como Uma Ubud',
                'Jungle Retreat Ubud',
                'Komaneka at Tanggayuda Ubud',
                'Mandapa A Ritz Carlton Reserve',
                'Payogan Villa Resort Spa',
                'Puri Wulandari A Boutique Resort Spa',
                'Royal Pita Maha Hotel')";



$queryPriceHeader = "SELECT * FROM KPIPriceHeader";
$resultPriceHeader = mysql_query($queryPriceHeader,$Link) or die (mysql_error($Link));
	$rowPriceHeader = mysql_fetch_assoc($resultPriceHeader);

$queryPriceHeaderDay = "SELECT DATE_FORMAT(`Today`,'%a') as Today, DATE_FORMAT(`D1`,'%a') as D1, DATE_FORMAT(`D2`,'%a') as D2, DATE_FORMAT(`D3`,'%a') as D3,DATE_FORMAT(`D4`,'%a') as D4,DATE_FORMAT(`D5`,'%a') as D5,DATE_FORMAT(`D6`,'%a') as D6,DATE_FORMAT(`D7`,'%a') as D7 FROM `KPIPriceHeader`";
$resultPriceHeaderDay = mysql_query($queryPriceHeaderDay,$Link) or die (mysql_error($Link));
	$rowPriceHeaderDay = mysql_fetch_assoc($resultPriceHeaderDay);

$queryPriceHotelHeader = "SELECT 'Virtual Hotel' as Name,Format (`Price`,0) as Price, Format (`PriceH1`,0) as PriceH1, Format (`PriceH2`,0) as PriceH2, 
Format (`PriceH2`,0) as PriceH2, Format(`PriceH3`,0) as PriceH3, Format (`PriceH4`,0) as PriceH4, Format(`PriceH5`,0) as PriceH5, 
Format(`PriceH6`,0) as PriceH6, Format(`PriceH7`,0) as PriceH7, TRUNCATE(Dif / Price * 100,1) as Dif, 
TRUNCATE(Dif1 / PriceH1 * 100,1) as Dif1,TRUNCATE(Dif2 / PriceH2 * 100,1) as Dif2,TRUNCATE(Dif3 / PriceH3 * 100,1) as Dif3,TRUNCATE(Dif4 / PriceH4 * 100,1) as Dif4,
TRUNCATE(Dif5 / PriceH5 * 100,1) as Dif5,TRUNCATE(Dif6 / PriceH6 * 100,1) as Dif6,TRUNCATE(Dif7 / PriceH7 * 100,1) as Dif7  
FROM KPIPrice WHERE HotelName like '%Como Sham%'";
$resultPriceHotelHeader = mysql_query($queryPriceHotelHeader,$Link) or die (mysql_error($Link));
$rowPriceHotelHeader = mysql_fetch_assoc($resultPriceHotelHeader);

$queryPriceHotel = "SELECT HotelName as Name,Format (`Price`,0) as Price, Format (`PriceH1`,0) as PriceH1, Format (`PriceH2`,0) as PriceH2, 
Format(`PriceH3`,0) as PriceH3, Format (`PriceH4`,0) as PriceH4, Format(`PriceH5`,0) as PriceH5, 
Format(`PriceH6`,0) as PriceH6, Format(`PriceH7`,0) as PriceH7, TRUNCATE(Dif / Price * 100,1) as Dif, 
TRUNCATE(Dif1 / PriceH1 * 100,1) as Dif1,TRUNCATE(Dif2 / PriceH2 * 100,1) as Dif2,TRUNCATE(Dif3 / PriceH3 * 100,1) as Dif3,TRUNCATE(Dif4 / PriceH4 * 100,1) as Dif4,
TRUNCATE(Dif5 / PriceH5 * 100,1) as Dif5,TRUNCATE(Dif6 / PriceH6 * 100,1) as Dif6,TRUNCATE(Dif7 / PriceH7 * 100,1) as Dif7  
FROM KPIPrice WHERE HotelName in $ListHotelComo order by HotelName  ASC";
$resultPriceHotel = mysql_query($queryPriceHotel,$Link) or die (mysql_error($Link));
$total   = mysql_num_rows($resultPriceHotel) + 1;
$max   = ceil($total/$row);
  
    ?>
<html>
<head>
	<title>WiWE 180 - Return</title>
  	  <link rel="stylesheet" type="text/css" href="../css/bootstrap-slider.css">
      <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/main.min.css">
  <!-- Pixeden Icon Fonts -->
  <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
  <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-stroke.css">
  <script src="../js/d3.min.js"></script>
  <script src="../js/d3.layout.cloud.js"></script>
</head>
<body>
    <style>
    table, th, td {
       border: 1px solid black;
        height :52px;
        padding-top: 8px;
        padding-left: 20px;
        padding-right: 10px;
        }
    
    </style>

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
            		<i class="pe-7s-diamond"></i>
            	<span>Price Analysis</span>
          		</h1>
         		 
       		 	</div>
			</header>
                

                <article class="widget">
                
				
                <div class="widget__content">
								
								<table>
							  	<thead>
							  		<tr>
							  		<th bgcolor ="#2f4f4f"><strong style="font-weight :bold;"> No. </strong> </th>
							  			<th style="width:20%" bgcolor ="#2f4f4f"><strong style="font-weight: bold;" > <font>Hotel Name</font></strong></th>
							  			<th style="width: 10%" bgcolor ="#2f4f4f"><strong style="font-weight: bold;"> <font color="Orange">
							  			<center>
                                           <strong style="font-weight: bold;" > <?php echo $rowPriceHeaderDay['Today'] ?></center>
							  			 <?php echo $rowPriceHeader['Today']; ?></font></strong><br>
							  			
							  			</th>
							  			
							  			
							  			<th style="width: 10% " bgcolor ="#2f4f4f"><strong style="font-weight: bold;">
                                            <center> <strong style="font-weight: bold;" ><?php echo $rowPriceHeaderDay['D1'] ?></strong>
							  			 </center>
							  			 <?php echo $rowPriceHeader['D1']; ?></font></strong> 
							  			</th>
							  			
							  			<th style="width: 10%" bgcolor ="#2f4f4f"><strong style="font-weight: bold;"> 
							  			<center>
							  			<?php echo $rowPriceHeaderDay['D2'] ?></center>
							  			 <?php echo $rowPriceHeader['D2']; ?> </strong>
							  			</th>
							  			
							  			<th style="width: 10%" bgcolor ="#2f4f4f"><strong style="font-weight: bold;">
							  			<center> 
							  			    <?php echo $rowPriceHeaderDay['D3'] ?></center>
                                            <?php echo $rowPriceHeader['D3']; ?></strong>
							  			</th>
							  			
							  			<th style="width: 10%" bgcolor ="#2f4f4f"><strong style="font-weight: bold;"> 
							  			<center>
							  			<?php echo $rowPriceHeaderDay['D4'] ?></center>
							  			<?php echo $rowPriceHeader['D4']; ?></strong> 
							  			</th>
							  			
							  			<th style="width: 10%" bgcolor ="#2f4f4f" onclick=""> <strong style="font-weight: bold;">
							  			<center>
							  			<?php echo $rowPriceHeaderDay['D5'] ?></center>
							  			<?php echo $rowPriceHeader['D5']; ?></strong> 
							  			 </th>
							  			 
										<th style="width: 10%" bgcolor ="#2f4f4f"><strong style="font-weight: bold;">
										<center>
										<?php echo $rowPriceHeaderDay['D6'] ?></center>
										 <?php echo $rowPriceHeader['D6']; ?></strong> <br>
										 </th>
										 
										<th style="width: 10%" bgcolor ="#2f4f4f"><strong style="font-weight: bold;">
                                        <center>
                                        <?php echo $rowPriceHeaderDay['D7'] ?></center>
                                        <?php echo $rowPriceHeader['D7']; ?></strong> <br>
										 </tr>
								 	</thead>
								 	
							  	<tbody>
							  	 <tr class="spacer"></tr>
							  	<tr>
                                   <td  ><strong style="font-weight: bold;" >
                                       <?php echo '1' ?></strong>
                                   </td>
							  		<td><strong style="font-weight: bold;" >
							  		<?php
							  			 echo  $rowPriceHotelHeader['Name'];
                                        ?></strong>
							  		</td>
							  		<td style="50px" align="right" bgcolor ="<?php echo fontColor($rowPriceHotelHeader['Dif']) ?>">
                                        <font color = black size="3px"><strong style="font-weight: bold;" ><?php echo $rowPriceHotelHeader['Price'] ?></strong></font><br>
                                        <font size="2" color ="black" ><strong style="font-weight: bold;" ><?php echo $rowPriceHotelHeader['Dif'] ?> %</strong></font>
							  		</td>
							  		<td align="right" bgcolor ="<?php echo fontColor($rowPriceHotelHeader['Dif1']) ?>">
                                        <font color = black size="3px"><strong style="font-weight: bold;" ><?php echo $rowPriceHotelHeader['PriceH1'] ?></strong></font><br>
                                        <font size="2" color= "black"><strong style="font-weight: bold;" ><?php echo $rowPriceHotelHeader['Dif1']?> %</strong></font>
							  		</td>
							  		<td align="right" bgcolor ="<?php echo fontColor($rowPriceHotelHeader['Dif2']) ?>">
                                        <font color =black size="3px"><strong style="font-weight: bold;" ><?php echo $rowPriceHotelHeader['PriceH2'] ?></strong></font><br>
                                        <font size="2" color= "black"><strong style="font-weight: bold;" ><?php echo $rowPriceHotelHeader['Dif2']?> %</strong></font>
							  		</td>

							  		<td align="right" bgcolor ="<?php echo fontColor($rowPriceHotelHeader['Dif3']) ?>">
                                        <font color =black size="3px"><strong style="font-weight: bold;" ><?php echo $rowPriceHotelHeader['PriceH3'] ?></strong></font><br>
                                        <font size="2" color= "black"><strong style="font-weight: bold;" ><?php echo $rowPriceHotelHeader['Dif3']?> %</strong></font>
							  		</td>
							  		<td align="right" bgcolor ="<?php echo fontColor($rowPriceHotelHeader['Dif4']) ?>">
                                        <font color =black size="3px"><strong style="font-weight: bold;" ><?php echo $rowPriceHotelHeader['PriceH4'] ?></strong></font><br>
                                        <font size="2" color= "black"><strong style="font-weight: bold;" ><?php echo $rowPriceHotelHeader['Dif4']?> %</strong></font>
							  		</td>
							  		
							  		<td align="right" bgcolor ="<?php echo fontColor($rowPriceHotelHeader['Dif5']) ?>">
                                        <font color =black size="3px"><strong style="font-weight: bold;" ><?php echo $rowPriceHotelHeader['PriceH5'] ?></strong></font><br>
                                        <font size="2" color="black"><strong style="font-weight: bold;" ><?php echo $rowPriceHotelHeader['Dif5']?> %</strong></font>
							  		</td>
							  		<td align="right" bgcolor ="<?php echo fontColor($rowPriceHotelHeader['Dif6']) ?>">
                                        <font color =black size="3px"><strong style="font-weight: bold;" ><?php echo $rowPriceHotelHeader['PriceH6'] ?></strong></font><br>
                                        <font size="2"color ="black" ><strong style="font-weight: bold;" ><?php echo $rowPriceHotelHeader['Dif6']?> %</strong></font>
							  		</td>
							  		<td align="right" bgcolor ="<?php echo fontColor($rowPriceHotelHeader['Dif7']) ?>">
                                        <font color =black size="3px"><strong style="font-weight: bold;" ><?php echo $rowPriceHotelHeader['PriceH7'] ?></strong></font><br>
                                        <font size="2" color="black"><strong style="font-weight: bold;" ><?php echo $rowPriceHotelHeader['Dif7']?> %</strong></font>
							  		</td>
							         <td style="display:none;">
							         </td>
							  	</tr>
							  	<?php
                                $mySql = "SELECT HotelName as Name,Format (`Price`,0) as Price, Format (`PriceH1`,0) as PriceH1, Format (`PriceH2`,0) as PriceH2, Format(`PriceH3`,0) as PriceH3, Format (`PriceH4`,0) as PriceH4, Format(`PriceH5`,0) as PriceH5, 
                                Format(`PriceH6`,0) as PriceH6, Format(`PriceH7`,0) as PriceH7, TRUNCATE(Dif / Price * 100,1) as Dif, 
                                TRUNCATE(Dif1 / PriceH1 * 100,1) as Dif1,TRUNCATE(Dif2 / PriceH2 * 100,1) as Dif2,TRUNCATE(Dif3 / PriceH3 * 100,1) as Dif3,TRUNCATE(Dif4 / PriceH4 * 100,1) as Dif4,
                                TRUNCATE(Dif5 / PriceH5 * 100,1) as Dif5,TRUNCATE(Dif6 / PriceH6 * 100,1) as Dif6,TRUNCATE(Dif7 / PriceH7 * 100,1) as Dif7  
                                FROM KPIPrice WHERE HotelName in $ListHotelComo order by HotelName  ASC limit $hal,$row";
                                $myQry = mysql_query($mySql, $Link) or die (mysql_error());
                                
                                while ($data = mysql_fetch_assoc($myQry)) {
                                $nomor ++;
                                ?>
                                <tr class="spacer"></tr>
        
                                   <tr>
                                   <td><strong style="font-weight: bold;" >
                                       <?php echo $nomor ?></strong>
                                   </td>
							  		<td><strong style="font-weight: bold;" >
							  		<?php
							  			 echo $data['Name'];
                                        ?></strong>
							  		</td>
							  		<td style="50px" align="right" bgcolor ="<?php echo fontColor($data['Dif']) ?>">
							  			<font color = black size="3px"><strong style="font-weight : bold"><?php echo $data['Price'] ?></strong></font><br>
							  			<font size="2" color ="black"><?php echo $data['Dif'] ?> %</font>
							  		</td>
							  		<td align="right" bgcolor ="<?php echo fontColor($data['Dif1']) ?>">
                                        <font color = black size="3px"> <strong style="font-weight : bold"> <?php echo $data['PriceH1'] ?></strong></font><br>
							  			<font size="2" color ="black"><?php echo $data['Dif1']?> %</font>
							  		</td>
							  		<td align="right" bgcolor ="<?php echo fontColor($data['Dif2']) ?>">
                                        <font color =black size="3px"> <strong style="font-weight : bold"> <?php echo $data['PriceH2'] ?></strong></font><br>
							  			<font size="2" color ="black"><?php echo $data['Dif2']?> %</font>
							  		</td>

							  		<td align="right" bgcolor ="<?php echo fontColor($data['Dif3']) ?>">
                                        <font color =black size="3px"> <strong style="font-weight : bold"> <?php echo $data['PriceH3'] ?></strong></font><br>
							  			<font size="2" color ="black"><?php echo $data['Dif3']?> %</font>
							  		</td>
							  		<td align="right" bgcolor ="<?php echo fontColor($data['Dif4']) ?>">
                                        <font color =black size="3px"> <strong style="font-weight : bold"> <?php echo $data['PriceH4'] ?></strong></font><br>
							  			<font size="2" color ="black"><?php echo $data['Dif4']?> %</font>
							  		</td>
							  		
							  		<td align="right" bgcolor ="<?php echo fontColor($data['Dif5']) ?>">
                                        <font color =black size="3px"> <strong style="font-weight : bold"> <?php echo $data['PriceH5'] ?></strong></font><br>
							  			<font size="2" color ="black"><?php echo $data['Dif5']?> %</font>
							  		</td>
							  		<td align="right" bgcolor ="<?php echo fontColor($data['Dif6']) ?>">
                                        <font color =black size="3px"> <strong style="font-weight : bold"> <?php echo $data['PriceH6'] ?></strong></font><br>
							  			<font size="2" color ="black"><?php echo $data['Dif6']?> %</font>
							  		</td>
							  		<td align="right" bgcolor ="<?php echo fontColor($data['Dif7']) ?>">
                                        <font color =black size="3px"> <strong style="font-weight : bold"> <?php echo $data['PriceH7'] ?></strong></font><br>
							  			<font size="2" color ="black"><?php echo $data['Dif7']?> %</font>
							  		</td>
							         <td style="display:none;">
							         </td>
							  	</tr>
                                   <?php } ?>
							  	</tbody>
								</table>
								* All Listed Price are in Indonesia Rupiah Currency (IDR)<br>
															 <ul class="pagination pull-left no-margin">
<li class="" >
<strong style="font-weight: bold;">Total Records :</strong>
                                <?php echo  $total;  ?>
</ul>
		
<?php 
		
		$prev = $hal - $row;
		if ($prev <= -$row) { $prev = 0;}
		$next = $hal + $row;
		$Selisih = $total - $row;
		if ($Selisih <= 0) {$Selisih = 0;}
		
		if ($next >= $total) { $next =  $Selisih;}
?>

		<ul class="pagination pull-right no-margin">
			<li class="prev">
		<?php
		echo "
			<a href='?page=PriceAnalysis&hal=$prev'>
			<i class='pe-7s-prev'></i>
			</a>";
			?>
			</li>
		<li class="" >
			<?php
			for ($h = 1; $h <= $max; $h++) {
				$list[$h] = $row * $h - $row;
				echo " <a href='?page=PriceAnalysis&hal=$list[$h]'>$h</a> ";
			}
			?>
		</li>
		<li class="next">
				<?php
		echo "
			<a href='?page=PriceAnalysis&hal=$next'>
			<i class='pe-7s-next'></i>
			</a>";
			?>
		</li>
			</ul>
						
								

								
							</div> <!-- /widget__content -->

			<footer class="footer-brand">
					<?php include "footer.php"; ?>
			</footer>
		</section> <!-- /content -->

	<script type="text/javascript" src="../js/main.js"></script> <!-- Loading -->
	<script type="text/javascript" src="../js/amcharts/amcharts.js"></script>
	<script type="text/javascript" src="../js/amcharts/serial.js"></script>
	<script type="text/javascript" src="../js/amcharts/pie.js"></script>
	<script type="text/javascript" src="../js/chartz.js"></script>
	  <script type="text/javascript" src="../js/bootstrap-slider.js"></script>

 	

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

