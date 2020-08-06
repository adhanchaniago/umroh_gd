<!DOCTYPE html>


<?php
session_start();
// if($_SESSION['FirstName'] == '180') {header('Location: ?page=180');} ;
include_once "../library/inc.library.php";
include_once "../library/inc.pilihan.php";
include_once "../library/inc.tanggal.php";

require('../config/travel-config.php'); //Load DB(mysql) config parameter

$Travel= $_SESSION['Travel'];




# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 100;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT DISTINCT track_jamaah.*,
 paket_umroh.nama_paket,paket_umroh.desc_umroh,paket_umroh.depart_umroh,paket_umroh.harga_umroh,paket_umroh.harga_perlengkapan,
 paket_umroh.currency,
 jamaah_daftar.first_name, jamaah_daftar.last_name, jamaah_daftar.surname, jamaah_daftar.travel
 FROM track_jamaah
 LEFT JOIN paket_umroh on track_jamaah.kd_umroh=paket_umroh.kd_umroh
 LEFT JOIN jamaah_daftar on track_jamaah.nomor_id=jamaah_daftar.nomor_id

  ORDER BY nomor_id ASC LIMIT $hal, $row";
$pageQry = mysql_query($pageSql, $Link) or die ("error paging: ".mysql_error());
$jml   = mysql_num_rows($pageQry);
$max   = ceil($jml/$row);

// Jika tombol Cari diklik
if(isset($_POST['btnCari'])){
	if($_POST) {
		// Cari berdasarkan Nomor RM dan Nama Pasien yang mirip
		$txtKataKunci	= $_POST['txtKataKunci'];
		$mySql = "SELECT track_jamaah.*,
     paket_umroh.nama_paket,paket_umroh.desc_umroh,paket_umroh.depart_umroh,paket_umroh.harga_umroh,paket_umroh.harga_perlengkapan,
     paket_umroh.currency,
     jamaah_daftar.first_name, jamaah_daftar.last_name, jamaah_daftar.surname, jamaah_daftar.travel
    FROM track_jamaah
    LEFT JOIN paket_umroh on track_jamaah.kd_umroh=paket_umroh.kd_umroh
    LEFT JOIN jamaah_daftar on track_jamaah.nomor_id=jamaah_daftar.nomor_id
     WHERE track_jamaah.depart='$txtKataKunci'
				  ORDER BY nomor_id ASC LIMIT $hal, $row";
	}
}
else {
	$mySql = "SELECT track_jamaah.*,
   paket_umroh.nama_paket,paket_umroh.desc_umroh,paket_umroh.depart_umroh,paket_umroh.harga_umroh,paket_umroh.harga_perlengkapan,
   paket_umroh.currency,
   jamaah_daftar.first_name, jamaah_daftar.last_name, jamaah_daftar.surname, jamaah_daftar.travel
   FROM track_jamaah
   LEFT JOIN paket_umroh on track_jamaah.kd_umroh=paket_umroh.kd_umroh
   LEFT JOIN jamaah_daftar on track_jamaah.nomor_id=jamaah_daftar.nomor_id

  ORDER BY nomor_id  ASC LIMIT $hal, $row";
}


// Membaca variabel form
$dataKataKunci  = isset($_POST['txtKataKunci']) ? $_POST['txtKataKunci'] : '';





?>
<html>
<head>
 <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="utf-8">
    <title>Umroh - Management</title>
   <link rel="icon" sizes="192x192" href="../img/Icon.png"/>
    <!-- Glazzed & Bootstrap -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/main.min.css">
    <!-- Pixeden Icon Fonts -->
    <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
    <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-stroke.css">
    <link rel="stylesheet" type="text/css" href="../plugins/tigra_calendar/tcal.css"/>


      <script src="../js/highcharts/highcharts.js"></script>
      <script src="https://code.highcharts.com/modules/heatmap.js"></script>
      <script src="https://code.highcharts.com/modules/exporting.js"></script>

      <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>




<style type="text/css">



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


table{
  width: 100%
}


th, td {

		height: 20px;
		padding: 10px;

    border-collapse: collapse;
	border-radius: 0px;
}
tr:nth-child(even) {
    background-color:rgba(0,0,0,.3);
}

th, td {
	  border-bottom: 1px solid black;
}

</style>
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
            	<span>Payment Status</span>
          		</h1>
       		 	</div>

            <div class="row">

                         <div class="col-md-12">
                         <article class="widget widget__form ">
                 <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1"  class="form-horizontal" role="form">
                   <select name="txtKataKunci" bgcolor="blue" class="btn blue ">
                                                 <option value="ok">--Select The Departure Date--</option>
                                                <?php
                     $bacaSql = "SELECT DISTINCT track_jamaah.*,
                      paket_umroh.nama_paket,paket_umroh.desc_umroh,paket_umroh.depart_umroh,paket_umroh.harga_umroh,paket_umroh.harga_perlengkapan,
                      paket_umroh.currency,
                      jamaah_daftar.first_name, jamaah_daftar.last_name, jamaah_daftar.surname, jamaah_daftar.travel
                     FROM track_jamaah
                     LEFT JOIN paket_umroh on track_jamaah.kd_umroh=paket_umroh.kd_umroh
                     LEFT JOIN jamaah_daftar on track_jamaah.nomor_id=jamaah_daftar.nomor_id
                     ";
                     $bacaQry = mysql_query($bacaSql, $Link) or die ("Gagal Query".mysql_error());
                     while ($bacaData = mysql_fetch_array($bacaQry)) {
                     if ($bacaData['kd_umroh'] == $dataType) {
                       $cek = " selected";
                     } else { $cek=""; }

                     echo "<option value='$bacaData[depart]' $cek>[ $bacaData[depart] ]   $bacaData[packages_program]  </option>";
                     }
                     ?>
                                                 </select>
              <button  type="submit" name="btnCari" value="search"  class="btn blue" type="submit" style="width:10%; height:15%">
                             Submit
                           </button>
                 </form>

                             </article><!-- /widget -->
                         </div>

                     </div> <!-- /row -->


                     <div class ="row">
                     <div class="col-md-6">
                                 <article class="widget"><header class="widget__header">

                                     </header>
                                     <div style="border: 1px solid #1e2333;  padding-bottom: 5px; padding-top: 5px;" class="widget__content widget__grid filled pad20" id="grad1">
                                                     <p>
                                         <div id="12" style=" vertical-align: middle; display: inline-block; width:calc(100% - 0px); height: 300px;">

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
                                                 <div id="stock" style=" vertical-align: middle; display: inline-block; width:calc(100% - 0px); height: 300px;">

                                                 </div>
                                                 <div ></div>
                                                 </p>
                                                 </div> <!-- /widget__content -->

                                     </article>
                             </div>
                       </div>


            <div class ="row">
              <div class="col-md-12 ">
                      <article class="widget">
            <div class="" style="background-color:rgba(0,0,0,.2);">
              <table class=" ">

                <thead style="font-weight:bold">
                  <tr>
                    <th colspan="4" style="background-color:rgba(0,0,0,.4);"> <p class="">All Packages</p> </th>
                  </tr>
                    </thead>
<tr class="spacer" ></tr>
                      <tbody >
                  <thead style="font-weight:bold">
                  <tr style="background-color:rgba(0,0,0,.3);">
                      <td width=""><p font-weight="bold" class="lucida">Travel</p></td>
                    <td width=""><p font-weight="bold" class="lucida">Name</p></td>
                    <td width=""  align="center"><p font-weight="bold" class="lucida">Depart</p></td>
                    <td width=""  align="center"><p font-weight="bold" class="lucida">Status</p></td>
                  </tr>
                </thead>

                <?php
// Query SQL ada di bagian atas, kolom tombol Cari (btnCari)
$myQry = mysql_query($mySql, $Link)  or die ("Query salah : ".mysql_error());
$nomor = 0;

$totalBayarUmroh = 0;
$totalBayarPerlengkapan = 0;
while ($myData = mysql_fetch_array($myQry)) {
  $nomor++;
  $Kode = $myData['nomor_id'];




?>
                  <tr>
          <td align="center"><p class="content1"><?php echo $myData['travel']; ?> </p></td>
          <td><p class="content1"><?php echo $myData['first_name']; ?>&nbsp;<?php echo $myData['last_name']; ?>&nbsp;<?php echo $myData['surname']; ?></p></td>
          <td  align="center"><p class="content1"><?php echo IndonesiaTgl($myData['depart_umroh']); ?></p></td>
            <td  align="center"><p class="content1"><?php echo $myData['status_pay']; ?></p></td>

                  </tr>
    <?php } ?>
</tbody>
              </table>
            </div>
          </article>
            </div>
              </div>

			</header>



			<footer class="footer-brand">
					<?php include "footer.php"; ?>
			</footer>
		</section> <!-- /content -->

	<script type="text/javascript" src="../js/main.js"></script> <!-- Loading -->
	<script type="text/javascript" src="../js/amcharts/amcharts.js"></script>
	<script type="text/javascript" src="../js/amcharts/serial.js"></script>
	<script type="text/javascript" src="../js/amcharts/pie.js"></script>
	<script type="text/javascript" src="../js/chartz.js"></script>


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
            [0, 'rgba(0, 0, 0, 0.0)'],
            [1, 'rgba(0, 0, 0, 0.0)']
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

Highcharts.chart('12', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Status Payment'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: 'Total',
        colorByPoint: true,
        data: [{
            name: 'Payment',
            y: 2
        },
        {
            name: 'No Payment',
            y: 1
        }, {
            name: 'DP',
            y: 3,
            sliced: true,
            selected: true

        }]
    }]
});


//data untuk stock
Highcharts.chart('stock', {
    chart: {
        type: 'areaspline'
    },
    title: {
        text: 'Stock'
    },
    legend: {
        layout: 'vertical',
        align: 'left',
        verticalAlign: 'top',
        x: 150,
        y: 100,
        floating: true,
        borderWidth: 1,
        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
    },
    xAxis: {
        categories: [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday'
        ],
        plotBands: [{ // visualize the weekend
            from: 4.5,
            to: 6.5,
            color: 'rgba(68, 170, 213, .2)'
        }]
    },
    yAxis: {
        title: {
            text: 'units'
        }
    },
    tooltip: {
        shared: true,
        valueSuffix: ' units'
    },
    credits: {
        enabled: false
    },
    plotOptions: {
        areaspline: {
            fillOpacity: 0.5
        }
    },
    series: [{
        name: 'TAS KOPER',
        data: [3, 4, 3, 3, 0, 2, 1]
    },
    {
        name: 'BUKU DOA',
        data: [4, 6, 6, 1, 2, 1, 4]
    }, {
        name: 'SERAGAM BATIK',
        data: [1, 3, 4, 3, 3, 5, 4]

  }, {
      name: 'KAIN IHRAM',
      data: [1, 3, 2, 2, 1, 1, 1]
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
