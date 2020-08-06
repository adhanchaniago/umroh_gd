<!DOCTYPE html>
<?php
@require('../config/wiwe360-config.php'); //Load DB(mysql) config parameter
session_start();
$Hotel = $_SESSION['Hotel'];
 $Period = $_POST['Period'];


$querysth="SELECT '' as Hotel, '' as Parent, 'Global' as Category, '' as Jumlah,'' as Color
       union all
	   SELECT '' as Hotel, 'Global' as Parent, 'Arts' as Category, '' as Jumlah, '' as Color
	   union all
	   SELECT '' as Hotel, 'Global' as Parent, 'Other' as Category, '' as Jumlah, '' as Color
	   union all
	   SELECT '' as Hotel, 'Global' as Parent, 'Business' as Category, '' as Jumlah, '' as Color
	   union all
	   SELECT '' as Hotel, 'Global' as Parent, 'Culinary' as Category, '' as Jumlah, '' as Color
	   union all
	   SELECT '' as Hotel, 'Global' as Parent, 'Health' as Category, '' as Jumlah, '' as Color
	   union all
	   SELECT '' as Hotel, 'Global' as Parent, 'Indonesia' as Category, '' as Jumlah, '' as Color
	   union all
	   SELECT '' as Hotel, 'Global' as Parent, 'Kids and Teen' as Category, '' as Jumlah, '' as Color
	   union all
	   SELECT '' as Hotel, 'Global' as Parent, 'Malaysia' as Category, '' as Jumlah, '' as Color
	   union all
	   SELECT '' as Hotel, 'Global' as Parent, 'News' as Category, '' as Jumlah, '' as Color
	   union all
	   SELECT '' as Hotel, 'Global' as Parent, 'Recreation' as Category, '' as Jumlah, '' as Color
	   union all
	   SELECT '' as Hotel, 'Global' as Parent, 'Reference ' as Category, '' as Jumlah, '' as Color
	   union all
	   SELECT '' as Hotel, 'Global' as Parent, 'Shopping' as Category, '' as Jumlah, '' as Color
	   union all
	   SELECT '' as Hotel, 'Global' as Parent, 'Society' as Category, '' as Jumlah, '' as Color
	   union all
	   SELECT '' as Hotel, 'Global' as Parent, 'Sports' as Category, '' as Jumlah, '' as Color
       union all
	   SELECT DISTINCT Hotel, Category as Parent, CategorySubSub as Category, sum(Jumlah) as Jumlah,  sum(Jumlah) as Color FROM poisource WHERE Hotel ='$Hotel' and Category <> 'Other'  group by Hotel, Category, CategorySubSub ";

$sth = mysql_query($querysth,$Link) or die (mysql_error($Link));

$rows = array();
//flag is not needed
$flag = true;
$table = array();
$table['cols'] = array(

    // Labels for your chart, these represent the column titles
    // Note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage and string will be used for column title
    array('label' => 'Category', 'type' => 'string'),
    array('label' => 'Parent', 'type' => 'string'),
    array('label' => 'Jumlah', 'type' => 'number'),
    array('label' => 'Color', 'type' => 'number')

);

while($r = mysql_fetch_assoc($sth)) {
    $temp = array();
    // the following line will be used to slice the Pie chart
    $temp[] = array('v' => (string) $r['Category']);

    // Values of each slice
    $temp[] = array('v' => (string) $r['Parent']);
    $temp[] = array('v' => (int) $r['Jumlah']);
    $temp[] = array('v' => (int) $r['Color']);
    $rows[] = array('c' => $temp);
}

$table['rows'] = $rows;
$jsonTable = json_encode($table);
?>

<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta charset="utf-8">
	<title>WiWE 90 - Listener</title>
  	<link rel="icon" sizes="192x192" href="../img/Icon.png"/>
  	<!-- Glazzed & Bootstrap -->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/main.min.css">
	<!-- Pixeden Icon Fonts -->
	<link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
	<link rel="stylesheet" type="text/css" href="../css/pe-icon-7-stroke.css">
	<script type="text/javascript" src="../js/viewer.js"></script>

	<!--Load the Ajax API-->
    	<script type="text/javascript" src="../js/googlechart/underscore-min.js"></script>
    	<script type="text/javascript" src="../js/googlechart/jsapi.js"></script>
    	<script type="text/javascript" src="../js/googlechart/loader.js"></script>
    	<script type="text/javascript">

    	// Load the Visualization API and the piechart package.
    	google.charts.load('current', {'packages':['treemap']});

    	// Set a callback to run when the Google Visualization API is loaded.
    	google.charts.setOnLoadCallback(drawChart1Hour);
      	function drawChart1Hour() {

    	var data1Hour = new  google.visualization.DataTable(<?=$jsonTable?>);

   	 tree = new google.visualization.TreeMap(document.getElementById('chart_div'));

        var options1Hour = {
        minColor: '#fff',
        midColor: '#53D769',
        maxColor: '#2ED62E',
        showScale: true,
        generateTooltip: showStaticTooltip
        };

           tree.draw(data1Hour, options1Hour);

          function showStaticTooltip(row, size, value) {
            return '<div style="background:#fd9; padding:10px; border-style:solid">' +
           'Read more about the <a href="http://en.wikipedia.org/wiki/Kingdom_(biology)">kingdoms of life</a>.</div>';
  		}

      }

      // Set a callback to run when the Google Visualization API is loaded.
    	google.charts.setOnLoadCallback(drawChart1Day);
      	function drawChart1Day() {

    	var data1Day = new  google.visualization.DataTable(<?=$jsonTable?>);

   	 tree = new google.visualization.TreeMap(document.getElementById('chart_div_1Day'));

        var options1Day = {
        minColor: '#fff',
        midColor: '#53D769',
        maxColor: '#2ED62E',
        showScale: true,
        generateTooltip: showStaticTooltip
        };

           tree.draw(data1Day, options1Day);

          function showStaticTooltip(row, size, value) {
            return '<div style="background:#fd9; padding:10px; border-style:solid">' +
           'Read more about the <a href="http://en.wikipedia.org/wiki/Kingdom_(biology)">kingdoms of life</a>.</div>';
  		}

      }

       // Set a callback to run when the Google Visualization API is loaded.
    	google.charts.setOnLoadCallback(drawChart1Week);
      	function drawChart1Week() {

    	var data1Week = new  google.visualization.DataTable(<?=$jsonTable?>);

   	 tree = new google.visualization.TreeMap(document.getElementById('chart_div_1Week'));

        var options1Week = {
        minColor: '#fff',
        midColor: '#53D769',
        maxColor: '#2ED62E',
        showScale: true,
        generateTooltip: showStaticTooltip
        };

           tree.draw(data1Week, options1Week);

          function showStaticTooltip(row, size, value) {
            return '<div style="background:#fd9; padding:10px; border-style:solid">' +
           '.</div>';
  		}

      }
    </script>
</head>

<body onload="viewer.load('viewerDiv', 'xuntitled.xml', '../js/untitled.offline.xml.js', '', {x:0, y:0, zoom:100, controls:'none'})">

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
            		<i class="pe-7s-graph3"></i>
            		<span>User Monitoring</span>
          		</h1>

       		 	</div>

       		 	<div class="main-header__date">
                  <form method ="POST" action="">
                   <select class = "form-control" style="height : 50px; width : 400px" onchange ="lookup()" name ="Period">
                       <option>Select Period</option>
                       <option>1 Hour</option>
                       <option>1 Day</option>
                       <option>1 Week</option>
                   </select>
                   <input type ="submit" name ="submit" id = "submit" hidden>
                   </form>
                   <script>
                    function lookup(){
                        document.getElementById('submit').click();
                    }
                    </script>

	                   </div>

    </header>
	<div class ="row">
     	<div class ="col-md-12">
      	<div id="chart_div" style="height : 580px; width: 100%;"></div>
    	</div>
	</div>
<br>
<div class ="col-md-6">
<div id="viewerDiv" style="width:580px; height:726px; border:none; padding:0;">&nbsp;</div>
</div>

<div class ="col-md-6">
           <table class="table table-striped media-table">
							  	<thead>
							  		<tr>
							  			<th><strong style="font-weight: bold;"> User</strong></th>
							  			<th><strong style="font-weight: bold;">
                                            Timestamp</strong>
							  			</th>
							  			<th><strong style="font-weight: bold;">
                                            Category</strong>
							  			</th>

							  			<th><strong style="font-weight: bold;">
							  			    Sub-Category</strong>
                                            </th>

							  			<th><strong style="font-weight: bold;">
							  			PoI
							  			</th>
                                        <th style="display : none"></th>
								</tr>
								 	</thead>
							  	<tbody>
							  	<tr class="spacer"></tr>
                                  <tr>
                                      <td>
                                          Room 201
                                      </td>
                                      <td>
                                          11:45
                                      </td>
                                      <td>
                                          Culinary
                                      </td>
                                      <td>
                                          Lunch
                                      </td>
                                      <td>
                                         Ayam Betutu
                                      </td>
                                  </tr>

							  	<tr class="spacer"></tr>
                                  <tr>
                                      <td>
                                          Room 203
                                      </td>
                                      <td>
                                          12:05
                                      </td>
                                      <td>
                                          Shopping
                                      </td>
                                      <td>
                                          Gifts
                                      </td>
                                      <td>
                                         Krisna
                                      </td>
                                  </tr>


							  	<tr class="spacer"></tr>
                                  <tr>
                                      <td>
                                          Room 203
                                      </td>
                                      <td>
                                          11.47
                                      </td>
                                      <td>
                                          Travel
                                        </td>
                                      <td>
                                         Public Transportaion
                                      </td>
                                      <td>
                                         Go-Jek
                                      </td>
                                  </tr>

							  	<tr class="spacer"></tr>
                                  <tr>
                                      <td>
                                          Room 205
                                      </td>
                                      <td>
                                          11:45
                                      </td>
                                      <td>
                                          Culinary
                                      </td>
                                      <td>
                                          Lunch
                                      </td>
                                      <td>
                                         Ayam Betutu
                                      </td>
                                  </tr>

                                  <tr class="spacer"></tr>
                                  <tr>
                                      <td>
                                          Room 207
                                      </td>
                                      <td>
                                          10:25
                                      </td>
                                      <td>
                                          Culinary
                                      </td>
                                      <td>
                                          Lunch
                                      </td>
                                      <td>
                                         Nuris
                                      </td>
                                  </tr>

                                  <tr class="spacer"></tr>
                                  <tr>
                                      <td>
                                          Room 211
                                      </td>
                                      <td>
                                          10:48
                                      </td>
                                      <td>
                                          Travel
                                      </td>
                                      <td>
                                          Cultural
                                      </td>
                                      <td>
                                         Tanah Lot
                                      </td>
                                  </tr>

                                  <tr class="spacer"></tr>
                                  <tr>
                                      <td>
                                          Room 213
                                      </td>
                                      <td>
                                          09:15
                                      </td>
                                      <td>
                                          Sport
                                      </td>
                                      <td>
                                          Water Sport
                                      </td>
                                      <td>
                                         Snorkling - Nusa Dua
                                      </td>
                                  </tr>

                                  <tr class="spacer"></tr>
                                  <tr>
                                      <td>
                                          Room 217
                                      </td>
                                      <td>
                                          08:12
                                      </td>
                                      <td>
                                          Travel
                                      </td>
                                      <td>
                                          Package Tour
                                      </td>
                                      <td>
                                        Musuem Puri Lukisan
                                      </td>
                                  </tr>

                                  <tr class="spacer"></tr>
                                  <tr>
                                      <td>
                                          Room 215
                                      </td>
                                      <td>
                                          07:15
                                      </td>
                                      <td>
                                          Culinary
                                      </td>
                                      <td>
                                          Coffee
                                      </td>
                                      <td>
                                         Starbucks
                                      </td>
                                  </tr>

                                  <tr class="spacer"></tr>
                                  <tr>
                                      <td>
                                          Room 211
                                      </td>
                                      <td>
                                          07:10
                                      </td>
                                      <td>
                                          Travel
                                      </td>
                                      <td>
                                          Cultural
                                      </td>
                                      <td>
                                         Uluwatu
                                      </td>
                                  </tr>
               </tbody>
    </table>

</div>

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
