<!DOCTYPE html>
<?php
@require('../config/wiwe360-config.php'); //Load DB(mysql) config parameter
session_start();
$Hotel = $_SESSION['Hotel'];
$Period = $_POST['Period'];
if ($Period == '') $Period = 'Last hour';

$querysth =" select 'Global' as Location, '' as Parent, '' as ClientNumber, '' as Color
union all
select distinct concat(Parent, ' (', sum(`ClientNumber`) , ')') as Location, 'Global' as Parent, sum(`ClientNumber`) as ClientNumber , sum(`ClientNumber`) as Color  from  kpitreemap WHERE HotelName ='$Hotel' and Period = '$Period' and `ClientNumber` is not NULL
group by Parent
Union All
Select distinct A.Location, B.Parent, A.ClientNumber, A.Color FROM
(SELECT concat(Location, ' (', `ClientNumber`, ')') as Location,   Parent,`ClientNumber`, `ClientNumber` as Color FROM kpitreemap WHERE HotelName ='$Hotel' and Location not in ( select distinct Parent from  kpitreemap WHERE HotelName ='$Hotel' and Period = '$Period' and Parent is not NULL)) A
Left Join
(select distinct Parent as 'Join', concat(Parent, ' (', sum(`ClientNumber`) , ')') as Parent from  kpitreemap WHERE HotelName ='$Hotel'and Period = '$Period' and Parent is not NULL group by Parent) B
on A.Parent = B.Join
";
$sth = mysql_query($querysth,$Link) or die (mysql_error($Link));

$rows = array();
//flag is not needed
$flag = true;
$table = array();
$table['cols'] = array(

    // Labels for your chart, these represent the column titles
    // Note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage and string will be used for column title
    array('label' => 'Location', 'type' => 'string'),
    array('label' => 'Parent', 'type' => 'string'),
    array('label' => 'ClientNumber', 'type' => 'number'),
    array('label' => 'Color', 'type' => 'number')

);

while($r = mysql_fetch_assoc($sth)) {
    $temp = array();
    // the following line will be used to slice the Pie chart
    $temp[] = array('v' => (string) $r['Location']);

    // Values of each slice
    $temp[] = array('v' => (string) $r['Parent']);
    $temp[] = array('v' => (int) $r['ClientNumber']);
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
    google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

    var data = new  google.visualization.DataTable(<?=$jsonTable?>);

    tree = new google.visualization.TreeMap(document.getElementById('chart_div'));

        var options = {
        minColor: '#fff',
        midColor: '#53D769',
        maxColor: '#2ED62E',
        showScale: true,
        generateTooltip: showStaticTooltip
        };

           tree.draw(data, options);

          function showStaticTooltip(row, size, value) {
            return '<div style="background:#fd9; padding:10px; border-style:solid">' +
           '</div>';
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
       	<form action ="" method ="POST">
        <div class ="main-header__date">
           <select class ="form-control" style="height:50px; width :400px" name ="Period" onchange ="kumpul()">
               <option><?php if ($Period == 'Last Hour') echo 'Now Displayed : Last Hour';
                             if ($Period == 'Last 12 Hours') echo 'Now Displayed : Last 12 Hours';
                             if ($Period == 'Last 24 Hours') echo 'Now Displayed : Last 24 Hours';
                             ?></option>
               <option selected> Last Hour</option>
               <option>Last 12 Hours</option>
               <option>Last 24 Hours</option>
           </select>
           <input type ="submit" value ="submit" id = "submit" hidden>
        </div>
        </form>
        <script>
            function kumpul(){
                document.getElementById('submit').click();
            }
        </script>

			</header>

<br>
<div class ="row">
     <div class ="col-md-12">
      <div id="chart_div" style="height : 520px; width: 100%;"></div>
    </div>
    </div>

<br>
<div class ="col-md-12">
<div id="viewerDiv" style="width:100%; height:726px; border:none; padding:0;">&nbsp;</div>
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
