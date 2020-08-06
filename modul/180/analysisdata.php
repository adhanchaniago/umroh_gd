<!DOCTYPE html>

<?php
error_reporting(0);
ini_set('display_errors',0);
session_start();
if($_SESSION['FirstName'] == '180') {header('Location: ?page=Analysisdata');} ;
include_once "../library/inc.library.php";
include_once "../library/inc.pilihan.php";
include_once "../library/inc.tanggal.php";

require('../config/travel-config.php'); //Load DB(mysql) config parameter

$Travel= $_SESSION['Travel'];

//$paket = "SELECT * FROM `paket_umroh` WHERE nama_paket like 'Berkah' or nama_paket like 'Incentive' or nama_paket like 'Rahmah'
//";
$sql = "SELECT count(first_name) AS jumlah_berkah, track_jamaah.packages_program
 from jamaah_daftar
 LEFT JOIN track_jamaah on jamaah_daftar.nomor_id=track_jamaah.nomor_id
 WHERE packages_program='Berkah'" ;
$query = mysql_query($sql, $Link);
$result = mysql_fetch_array($query);

$row = mysql_fetch_assoc($result);

$berkah = $result['jumlah_berkah'] ;


$sql = "SELECT count(first_name) AS jumlah_rahmah, track_jamaah.packages_program
 from jamaah_daftar
 LEFT JOIN track_jamaah on jamaah_daftar.nomor_id=track_jamaah.nomor_id
 WHERE packages_program='Rahmah'" ;
$query = mysql_query($sql, $Link);
$result = mysql_fetch_array($query);

$row = mysql_fetch_assoc($result);

$rahmah = $result['jumlah_rahmah'] ;


$sql = "SELECT count(first_name) AS jumlah_incentive, track_jamaah.packages_program
 from jamaah_daftar
 LEFT JOIN track_jamaah on jamaah_daftar.nomor_id=track_jamaah.nomor_id
 WHERE packages_program='Incentive'" ;
$query = mysql_query($sql, $Link);
$result = mysql_fetch_array($query);

$row = mysql_fetch_assoc($result);

$incentive = $result['jumlah_incentive'] ;

$tgl=date('d-m-Y');



// echo " Jamaah Total = {$result['jumlah']}";

?>


<html>
<head>
	<title>Umroh - Analysisdata</title>
  	<link rel="icon" sizes="192x192" href="../img/Icon.png"/>
  	<!-- Glazzed & Bootstrap -->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/main.min.css">
	<!-- Pixeden Icon Fonts -->
	<link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
	<link rel="stylesheet" type="text/css" href="../css/pe-icon-7-stroke.css">

  <script src="../js/highcharts/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/heatmap.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>

  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>






	<style>



	#grad1 {

	background: -webkit-linear-gradient(left,#6438ab , #3c167a); /* For Safari 5.1 to 6.0 */
	background: -o-linear-gradient(right,  #6438ab , #3c167a); /* For Opera 11.1 to 12.0 */
	background: -moz-linear-gradient(right, #6438ab , #3c167a); /* For Firefox 3.6 to 15 */
	background: linear-gradient(to right,  #6438ab , #3c167a); /* Standard syntax (must be last) */
	}

	#grad2 {

									background: -webkit-linear-gradient(left, #aa3c78 , #781049); /* For Safari 5.1 to 6.0 */
									background: -o-linear-gradient(right, #aa3c78 , #781049); /* For Opera 11.1 to 12.0 */
									background: -moz-linear-gradient(right, #aa3c78 , #781049); /* For Firefox 3.6 to 15 */
									background: linear-gradient(to right, #aa3c78 , #781049); /* Standard syntax (must be last) */

	}

	#grad3 {

									background: -webkit-linear-gradient(left, #52c055 , #3e8640); /* For Safari 5.1 to 6.0 */
									background: -o-linear-gradient(right,#52c055 , #3e8640); /* For Opera 11.1 to 12.0 */
									background: -moz-linear-gradient(right, #52c055 , #3e8640); /* For Firefox 3.6 to 15 */
									background: linear-gradient(to right, #52c055 , #3e8640); /* Standard syntax (must be last) */

	}

	#grad4 {

					background: -webkit-linear-gradient(left, #d5743b , #813d14); /* For Safari 5.1 to 6.0 */
					background: -o-linear-gradient(right,#d5743b , #813d14); /* For Opera 11.1 to 12.0 */
					background: -moz-linear-gradient(right, #d5743b , #813d14); /* For Firefox 3.6 to 15 */
					background: linear-gradient(to right, #d5743b , #813d14); /* Standard syntax (must be last) */

	}

			.progressbar {background: rgba(184, 184, 184, 0.59); background: -webkit-linear-gradient(top, rgba(56, 56, 56, 0.34) 0%, rgba(184, 184, 184, 0.59) 100%); background: linear-gradient(to bottom, rgba(56, 56, 56, 0.34) 0%, rgba(184, 184, 184, 0.59) 100%); border: 1px solid rgba(56, 56, 56, 0.1); border-radius: 0px; height: 3px;}
			.progress-bar-custom {background: rgba(17, 255, 0, 1); background: -webkit-linear-gradient(top, rgba(67, 153, 25, 0.66) 0%, rgba(17, 255, 0, 1) 100%); background: linear-gradient(to bottom, rgba(67, 153, 25, 0.66) 0%, rgba(17, 255, 0, 1) 100%);}

			.newProgress-bar-custom {background: rgba(255, 255, 255, 0.6); background: -webkit-linear-gradient(top, rgba(90, 112, 100, 0.66) 0%, rgba(17, 100, 0, 1) 100%); background: linear-gradient(to bottom, rgba(255, 0, 0, 0.66) 0%, rgba(255, 0, 0, 1) 100%);}
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

<header class="main-header">
                    <div class="main-header__nav">
                        <h1 class="main-header__title">
                     <i class="pe-7s-graph1"></i>
                    <span>Analysis Data</span>
                        </h1>
                    </div>
                </header>


                <div class ="row">
                <div class="col-md-6">
                            <article class="widget"><header class="widget__header">

                                </header>
                                <div style="border: 1px solid #1e2333;  padding-bottom: 5px; padding-top: 5px;" class="widget__content widget__grid filled pad20" id="grad1">
                                                <p>
                                    <div id="chartdiv" style=" vertical-align: middle; display: inline-block; width:calc(100% - 0px); height: 300px;">

                                        </div>
                                        <div ></div>
                                        </p>
                                        </div> <!-- /widget__content -->

                            </article>
                    </div>

                    <div class="col-md-6">
                                <article class="widget"><header class="widget__header">

                                    </header>
                                    <div style="border: 1px solid #1e2333;  padding-bottom: 5px; padding-top: 5px;" class="widget__content widget__grid filled pad20" id="grad2">

                                                    <p>
                                            <div id="barchat" style=" vertical-align: middle; display: inline-block; width:calc(100% - 0px); height: 300px;">

                                            </div>
                                            <div ></div>
                                            </p>
                                            </div> <!-- /widget__content -->

                                </article>
                        </div>
                  </div>



								<div class ="row">
								<div class="col-md-4">
														<article class="widget"><header class="widget__header">

																</header>
																<div style="border: 1px solid #1e2333;  padding-bottom: 5px; padding-top: 15px;" class="widget__content widget__grid filled pad20" id="grad2">
																								<p style="font-weight: bold">Packages Berkah Registration</p>
																								<p>
																				<div id="" style=" vertical-align: middle; display: inline-block; width:calc(80% - 0px); height: 30px;">
																					<?php

																					echo " Jamaah Total = {$berkah}"; ?>
																				</div>
																				<div style=" vertical-align: middle; display: inline-block; width:calc(75% - 0px);"></div>
																				</p>
																				</div> <!-- /widget__content -->


																		 <!-- putih -->
																<div style="background-color: #fff; border: 1px solid #1e2333; float: left; width:calc(50% + 0px); padding : 3px ; padding-right:10px; padding-left:10px ; padding-top:10px " class=" widget widget__content widget__grid filled pad20 ">
																			 <p style="color:#6438ab; font-size:14px; overflow:hidden">Male</p>
																			 <p style="color:#6438ab; font-size:35px; font-weight:bold; text-align: right; line-height: 10px">
																				 <?php
																				 $sql = "SELECT count(gender) AS male, track_jamaah.packages_program
                                         from jamaah_daftar
                                         LEFT JOIN track_jamaah on jamaah_daftar.nomor_id=track_jamaah.nomor_id
                                         WHERE packages_program='Berkah' and gender='MALE'" ;
																				 $query = mysql_query($sql, $Link);
																				 $result = mysql_fetch_array($query);
																				 echo "{$result['male']}"; ?>
																			 </p>
																			 <p style="color:#6438ab; text-align: right;">jamaah</p>
																</div> <!-- /end putih -->
																	 <!-- putih -->
																<div style=" background-color: #fff; border: 1px solid #1e2333; float: right; width:calc(50% + 0px); padding: 3px ; padding-right:10px; padding-left:10px ; padding-top:10px" class=" widget widget__content widget__grid filled pad20 ">
																		<p style="color:#6438ab; font-size:14px; overflow:hidden">Female</p>
																		<p style="color:#6438ab; font-size:35px; font-weight:bold; text-align: right; line-height: 10px ">
																			<?php
																			$sql = "SELECT count(gender) AS female, track_jamaah.packages_program
                                      from jamaah_daftar
                                      LEFT JOIN track_jamaah on jamaah_daftar.nomor_id=track_jamaah.nomor_id
                                       WHERE packages_program='Berkah' and gender='FEMALE'" ;
																			$query = mysql_query($sql, $Link);
																			$result = mysql_fetch_array($query);
																			echo "{$result['female']}"; ?>
																		</p>
																		<p style="color:#6438ab; text-align: right;">jamaah</p>
																</div> <!-- /end putih -->
														</article>
										</div>

										<div class="col-md-4">
																<article class="widget"><header class="widget__header">

																		</header>
																		<div style="border: 1px solid #1e2333;  padding-bottom: 5px; padding-top: 15px;" class="widget__content widget__grid filled pad20" id="grad3">
																										<p style="font-weight: bold">Packages Rahmah Registration</p>
																										<p>
																						<div id="" style=" vertical-align: middle; display: inline-block; width:calc(80% - 0px); height: 30px;">
																							<?php

																							echo "Jamaah Total = {$rahmah}"; ?>
																						</div>
																						<div style=" vertical-align: middle; display: inline-block; width:calc(75% - 0px);"></div>
																						</p>
																						</div> <!-- /widget__content -->


																				 <!-- putih -->
																		<div style="background-color: #fff; border: 1px solid #1e2333; float: left; width:calc(50% + 0px); padding : 3px ; padding-right:10px; padding-left:10px ; padding-top:10px " class=" widget widget__content widget__grid filled pad20 ">
																					 <p style="color:#6438ab; font-size:14px; overflow:hidden">Male</p>
																					 <p style="color:#6438ab; font-size:35px; font-weight:bold; text-align: right; line-height: 10px">
																						 <?php
																						 $sql = "SELECT count(gender) AS male, track_jamaah.packages_program
                                             from jamaah_daftar
                                             LEFT JOIN track_jamaah on jamaah_daftar.nomor_id=track_jamaah.nomor_id
                                              WHERE packages_program='Rahmah' and gender='MALE'" ;
																						 $query = mysql_query($sql, $Link);
																						 $result = mysql_fetch_array($query);
																						 echo "{$result['male']}"; ?>
																					 </p>
																					 <p style="color:#6438ab; text-align: right;">jamaah</p>
																		</div> <!-- /end putih -->
																			 <!-- putih -->
																		<div style=" background-color: #fff; border: 1px solid #1e2333; float: right; width:calc(50% + 0px); padding: 3px ; padding-right:10px; padding-left:10px ; padding-top:10px" class=" widget widget__content widget__grid filled pad20 ">
																				<p style="color:#6438ab; font-size:14px; overflow:hidden">Female</p>
																				<p style="color:#6438ab; font-size:35px; font-weight:bold; text-align: right; line-height: 10px ">
																					<?php
																					$sql = "SELECT count(gender) AS female, track_jamaah.packages_program
                                          from jamaah_daftar
                                          LEFT JOIN track_jamaah on jamaah_daftar.nomor_id=track_jamaah.nomor_id
                                           WHERE packages_program='Rahmah' and gender='FEMALE'" ;
																					$query = mysql_query($sql, $Link);
																					$result = mysql_fetch_array($query);
																					echo "{$result['female']}"; ?>
																				</p>
																				<p style="color:#6438ab; text-align: right;">jamaah</p>
																		</div> <!-- /end putih -->
																</article>
												</div>

										<div class="col-md-4">
																<article class="widget"><header class="widget__header">

																		</header>
																		<div style="border: 1px solid #1e2333;  padding-bottom: 5px; padding-top: 15px;" class="widget__content widget__grid filled pad20" id="grad1">
																										<p style="font-weight: bold">Packages Incentive Registration</p>
																										<p>
																						<div id="" style=" vertical-align: middle; display: inline-block; width:calc(80% - 0px); height: 30px;">
																							<?php


																							echo " Jamaah Total = {$incentive}"; ?>
																						</div>
																						<div style=" vertical-align: middle; display: inline-block; width:calc(75% - 0px);"></div>
																						</p>
																						</div> <!-- /widget__content -->


																				 <!-- putih -->
																		<div style="background-color: #fff; border: 1px solid #1e2333; float: left; width:calc(50% + 0px); padding : 3px ; padding-right:10px; padding-left:10px ; padding-top:10px " class=" widget widget__content widget__grid filled pad20 ">
																					 <p style="color:#6438ab; font-size:14px; overflow:hidden">Male</p>
																					 <p style="color:#6438ab; font-size:35px; font-weight:bold; text-align: right; line-height: 10px">
																						 <?php
																						 $sql = "SELECT count(gender) AS male, track_jamaah.packages_program
                                             from jamaah_daftar
                                             LEFT JOIN track_jamaah on jamaah_daftar.nomor_id=track_jamaah.nomor_id
                                              WHERE packages_program='Incentive' and gender='MALE'" ;
																						 $query = mysql_query($sql, $Link);
																						 $result = mysql_fetch_array($query);
																						 echo "{$result['male']}"; ?>
																					 </p>
																					 <p style="color:#6438ab; text-align: right;">jamaah</p>
																		</div> <!-- /end putih -->
																			 <!-- putih -->
																		<div style=" background-color: #fff; border: 1px solid #1e2333; float: right; width:calc(50% + 0px); padding: 3px ; padding-right:10px; padding-left:10px ; padding-top:10px" class=" widget widget__content widget__grid filled pad20 ">
																				<p style="color:#6438ab; font-size:14px; overflow:hidden">Female</p>
																				<p style="color:#6438ab; font-size:35px; font-weight:bold; text-align: right; line-height: 10px ">
																					<?php
																					$sql = "SELECT count(gender) AS female, track_jamaah.packages_program
                                           from jamaah_daftar
                                           LEFT JOIN track_jamaah on jamaah_daftar.nomor_id=track_jamaah.nomor_id
                                           WHERE packages_program='Incentive' and gender='FEMALE'" ;
																					$query = mysql_query($sql, $Link);
																					$result = mysql_fetch_array($query);
																					echo "{$result['female']}"; ?>
																				</p>
																				<p style="color:#6438ab; text-align: right;">jamaah</p>
																		</div> <!-- /end putih -->
																</article>
												</div>

								</div>


                <div class ="row">
                <div class="col-md-4">
                            <article class="widget"><header class="widget__header">

                                </header>
																<div style="border: 1px solid #1e2333;  padding-bottom: 5px; padding-top: 15px;" class="widget__content widget__grid filled pad20" id="grad2">
							                                  <p style="font-weight: bold">Packages Berkah Waiting</p>
							                                  <p>
							                          <div id="" style=" vertical-align: middle; display: inline-block; width:calc(80% - 0px); height: 30px;">
																					<?php
																					$sql = "SELECT count(first_name) AS jumlah
                                          from Jamaah WHERE packages_program='Berkah'" ;
																					$query = mysql_query($sql, $Link);
																					$result = mysql_fetch_array($query);

																					echo " Waiting Total {$result['jumlah']}"; ?>
																				</div>
							                          <div style=" vertical-align: middle; display: inline-block; width:calc(75% - 0px);"></div>
							                          </p>
							                          </div> <!-- /widget__content -->

                            </article>
                    </div>

										<div class="col-md-4">
																<article class="widget"><header class="widget__header">

																		</header>
																		<div style="border: 1px solid #1e2333;  padding-bottom: 5px; padding-top: 15px;" class="widget__content widget__grid filled pad20" id="grad3">
																										<p style="font-weight: bold">Packages Rahmah Waiting</p>
																										<p>
																						<div id="line1" style=" vertical-align: middle; display: inline-block; width:calc(80% - 0px); height: 30px;">
																							<?php
																							$sql = "SELECT count(first_name) AS jumlah from Jamaah WHERE packages_program='Rahmah'" ;
																							$query = mysql_query($sql, $Link);
																							$result = mysql_fetch_array($query);

																							echo "Waiting Total {$result['jumlah']}"; ?>
																						</div>
																						<div style=" vertical-align: middle; display: inline-block; width:calc(75% - 0px);"></div>
																						</p>
																						</div> <!-- /widget__content -->


																</article>
												</div>


                        										<div class="col-md-4">
                        																<article class="widget"><header class="widget__header">

                        																		</header>
                        																		<div style="border: 1px solid #1e2333;  padding-bottom: 5px; padding-top: 15px;" class="widget__content widget__grid filled pad20" id="grad1">
                        																										<p style="font-weight: bold">Packages Incentive Waiting</p>
                        																										<p>
                        																						<div id="line1" style=" vertical-align: middle; display: inline-block; width:calc(80% - 0px); height: 30px;">
                        																							<?php
                        																							$sql = "SELECT count(first_name) AS jumlah from Jamaah WHERE packages_program='Incentive'" ;
                        																							$query = mysql_query($sql, $Link);
                        																							$result = mysql_fetch_array($query);

                        																							echo "Waiting Total {$result['jumlah']}"; ?>
                        																						</div>
                        																						<div style=" vertical-align: middle; display: inline-block; width:calc(75% - 0px);"></div>
                        																						</p>
                        																						</div> <!-- /widget__content -->


                        																</article>
                        												</div>
                        <footer class="footer-brand">
                  					<?php include "footer.php"; ?>
                  			</footer>
                  		</section> <!-- /content -->

                      <script type="text/javascript" src="../js/main.js"></script> <!-- Loading -->



          <!-- <script src="https://www.amcharts.com/lib/3/amcharts.js"></script> -->
          <!-- <script src="../js/amcharts/amcharts2.js"></script>
        <script src="https://www.amcharts.com/lib/3/pie.js"></script>
        <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
        <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
        <script src="https://www.amcharts.com/lib/3/themes/light.js"></script> -->

                <script>

                /**
 * (c) 2010-2017 Torstein Honsi
 *
 * License: www.highcharts.com/license
 *
 * Dark theme for Highcharts JS
 * @author Torstein Honsi
 */

'use strict';
/* global document */
// Load the fonts
//import Highcharts from '../parts/Globals.js';
Highcharts.createElement('link', {
   href: 'https://fonts.googleapis.com/css?family=Unica+One',
   rel: 'stylesheet',
   type: 'text/css'
}, null, document.getElementsByTagName('head')[0]);

Highcharts.theme = {
   colors: ['#2b908f', '#90ee7e', '#f45b5b', '#7798BF', '#aaeeee', '#ff0066', '#eeaaee',
      '#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],
   chart: {
      backgroundColor: {
         linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
         stops: [
            [0, 'rgba(0, 0, 0, 0);'],
            [1, 'rgba(0, 0, 0, 0);']
         ]
      },
      style: {
         fontFamily: '\'Unica One\', sans-serif'
      },
      plotBorderColor: '#606063'
   },
   title: {
      style: {
         color: '#E0E0E3',
         textTransform: 'uppercase',
         fontSize: '20px'
      }
   },
   subtitle: {
      style: {
         color: '#E0E0E3',
         textTransform: 'uppercase'
      }
   },
   xAxis: {
      gridLineColor: '#707073',
      labels: {
         style: {
            color: '#E0E0E3'
         }
      },
      lineColor: '#707073',
      minorGridLineColor: '#505053',
      tickColor: '#707073',
      title: {
         style: {
            color: '#A0A0A3'

         }
      }
   },
   yAxis: {
      gridLineColor: '#707073',
      labels: {
         style: {
            color: '#E0E0E3'
         }
      },
      lineColor: '#707073',
      minorGridLineColor: '#505053',
      tickColor: '#707073',
      tickWidth: 1,
      title: {
         style: {
            color: '#A0A0A3'
         }
      }
   },
   tooltip: {
      backgroundColor: 'rgba(0, 0, 0, 0.85)',
      style: {
         color: '#F0F0F0'
      }
   },
   plotOptions: {
      series: {
         dataLabels: {
            color: '#B0B0B3'
         },
         marker: {
            lineColor: '#333'
         }
      },
      boxplot: {
         fillColor: '#505053'
      },
      candlestick: {
         lineColor: 'white'
      },
      errorbar: {
         color: 'white'
      }
   },
   legend: {
      itemStyle: {
         color: '#E0E0E3'
      },
      itemHoverStyle: {
         color: '#FFF'
      },
      itemHiddenStyle: {
         color: '#606063'
      }
   },
   credits: {
      style: {
         color: '#666'
      }
   },
   labels: {
      style: {
         color: '#707073'
      }
   },

   drilldown: {
      activeAxisLabelStyle: {
         color: '#F0F0F3'
      },
      activeDataLabelStyle: {
         color: '#F0F0F3'
      }
   },

   navigation: {
      buttonOptions: {
         symbolStroke: '#DDDDDD',
         theme: {
            fill: '#505053'
         }
      }
   },

   // scroll charts
   rangeSelector: {
      buttonTheme: {
         fill: '#505053',
         stroke: '#000000',
         style: {
            color: '#CCC'
         },
         states: {
            hover: {
               fill: '#707073',
               stroke: '#000000',
               style: {
                  color: 'white'
               }
            },
            select: {
               fill: '#000003',
               stroke: '#000000',
               style: {
                  color: 'white'
               }
            }
         }
      },
      inputBoxBorderColor: '#505053',
      inputStyle: {
         backgroundColor: '#333',
         color: 'silver'
      },
      labelStyle: {
         color: 'silver'
      }
   },

   navigator: {
      handles: {
         backgroundColor: '#666',
         borderColor: '#AAA'
      },
      outlineColor: '#CCC',
      maskFill: 'rgba(255,255,255,0.1)',
      series: {
         color: '#7798BF',
         lineColor: '#A6C7ED'
      },
      xAxis: {
         gridLineColor: '#505053'
      }
   },

   scrollbar: {
      barBackgroundColor: '#808083',
      barBorderColor: '#808083',
      buttonArrowColor: '#CCC',
      buttonBackgroundColor: '#606063',
      buttonBorderColor: '#606063',
      rifleColor: '#FFF',
      trackBackgroundColor: '#404043',
      trackBorderColor: '#404043'
   },

   // special colors for some of the
   legendBackgroundColor: 'rgba(0, 0, 0, 0.5)',
   background2: '#505053',
   dataLabelsColor: '#B0B0B3',
   textColor: '#C0C0C0',
   contrastTextColor: '#F0F0F3',
   maskColor: 'rgba(255,255,255,0.3)'
};

// Apply the theme
Highcharts.setOptions(Highcharts.theme);


                $(document).ready(function () {

                    // Build the chart
                    Highcharts.chart('chartdiv', {
                        chart: {

                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Total All Packages to date, <?php echo $tgl?>'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: false
                                },
                                showInLegend: true
                            }
                        },
                        series: [{
                            name: 'Total',
                            colorByPoint: true,
                             innerSize: '50%',
                            data: [{
                                name: 'Berkah',
                                y: <?php echo $berkah;?>
                            }, {
                                name: 'Rahmah',
                                y: <?php echo $rahmah;?>,
                                sliced: true,
                                selected: true
                            }, {
                                name: 'Incentive',
                                y: <?php echo $incentive;?>

                            }]
                        }]
                    });
                });


        // barchart
        Highcharts.chart('barchat', {
    chart: {
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 10,
            beta: 25,
            depth: 70
        }
    },
    title: {
        text: 'Packages per Month'
    },
    subtitle: {
        text: 'Notice the difference between a 0 value and a null point'
    },
    plotOptions: {
        column: {
            depth: 25
        }
    },
    xAxis: {
        categories: Highcharts.getOptions().lang.shortMonths
    },
    yAxis: {
        title: {
            text: null
        }
    },
    series: [{
        name: 'Berkah',
        data: [null, null, null, null, null, 0, 0, 2, 0, 0]
    },
    {
        name: 'Rahmah',
        data: [null, null, null, null, null, 0, 0, 0, 0, 0]
    },
     {
        name: 'Incentive',
        data: [null, null, null, null, null, 0, 0, 2, 0, 0]
    }]
});




                </script>


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
