<!DOCTYPE html>
<?php

require('../config/wiwe360-config.php'); //Load DB(mysql) config parameter
session_start();
$Hotel = $_SESSION['Hotel'];

$queryTrafficVolume = "SELECT date_format(TIMESTAMP, '%h:%i %p') as TIMESTAMP, Sent, Receive FROM KPITrafficVolume WHERE HotelName = '$Hotel' and Period = 'Last Hour' order by TIMESTAMP ASC";
$resultTrafficVolume = mysql_query($queryTrafficVolume,$Link) or die ($Link);
$rowTrafficVolume = array();
while ($r = mysql_fetch_assoc($resultTrafficVolume))
{
    $rowTrafficVolume[] = $r;
}

$queryTrafficVolumeLast12Hours = "SELECT date_format(TIMESTAMP, '%h %p') as TIME, sum(Sent) as Sent, sum(Receive) as Receive FROM KPITrafficVolume WHERE HotelName = 'GIS' and Period = 'Last 12 Hours' group by date_format(TIMESTAMP, '%h %p') order by TIMESTAMP ASC";
$resultTrafficVolumeLast12Hours = mysql_query($queryTrafficVolumeLast12Hours,$Link) or die ($Link);
$rowTrafficVolumeLast12Hours = array();
while ($r = mysql_fetch_assoc($resultTrafficVolumeLast12Hours))
{
    $rowTrafficVolumeLast12Hours[] = $r;
}


$queryTrafficVolumeLast24Hours = "SELECT date_format(TIMESTAMP, '%h %p') as TIME, sum(Sent) as Sent, sum(Receive) as Receive FROM KPITrafficVolume WHERE HotelName = 'GIS' and Period = 'Last 24 Hours' group by date_format(TIMESTAMP, '%h %p') order by TIMESTAMP ASC";
$resultTrafficVolumeLast24Hours = mysql_query($queryTrafficVolumeLast24Hours,$Link) or die ($Link);
$rowTrafficVolumeLast24Hours = array();
while ($r = mysql_fetch_assoc($resultTrafficVolumeLast24Hours))
{
    $rowTrafficVolumeLast24Hours[] = $r;
}

$queryConnectedDevices = "SELECT date_format(TIMESTAMP, '%h:%i %p') as TIMESTAMP, ClientNumber as Area, ClientNumber FROM KPIClientNumber WHERE HotelName = '$Hotel' and Period = 'Last Hour' order by TIMESTAMP ASC";
$resultConnectedDevices = mysql_query($queryConnectedDevices,$Link) or die ($Link);
$rowConnectedDevices = array();
while ($r = mysql_fetch_assoc($resultConnectedDevices))
{
    $rowConnectedDevices[] = $r;
}

$queryConnectedDevicesLast12Hours = "SELECT date_format(TIMESTAMP, '%h %p') as TIME, avg(ClientNumber) as Area, avg(ClientNumber) as ClientNumber FROM KPIClientNumber WHERE HotelName = 'GIS' and Period = 'Last 12 Hours' group by date_format(TIMESTAMP, '%h %p') order by TIMESTAMP ASC";
$resultConnectedDevicesLast12Hours = mysql_query($queryConnectedDevicesLast12Hours,$Link) or die ($Link);
$rowConnectedDevicesLast12Hours = array();
while ($r = mysql_fetch_assoc($resultConnectedDevicesLast12Hours))
{
    $rowConnectedDevicesLast12Hours[] = $r;
}

$queryConnectedDevicesLast24Hours = "SELECT date_format(TIMESTAMP, '%h %p') as TIME, avg(ClientNumber) as Area, avg(ClientNumber) as ClientNumber FROM KPIClientNumber WHERE HotelName = 'GIS' and Period = 'Last 24 Hours' group by date_format(TIMESTAMP, '%h %p') order by TIMESTAMP ASC";
$resultConnectedDevicesLast24Hours = mysql_query($queryConnectedDevicesLast24Hours,$Link) or die ($Link);
$rowConnectedDevicesLast24Hours = array();
while ($r = mysql_fetch_assoc($resultConnectedDevicesLast24Hours))
{
    $rowConnectedDevicesLast24Hours[] = $r;
}

$query = "SELECT * FROM KPIInternetUptime WHERE HotelName = '$Hotel' and Period ='Last Hour'";
$result = mysql_query($query,$Link) or die(mysql_error($Link));
        $row = mysql_fetch_assoc($result);

$queryResponseTime = "SELECT * FROM KPIResponseTime WHERE HotelName = '$Hotel' and Period ='Last Hour'";
$resultResponseTime = mysql_query($queryResponseTime,$Link) or die(mysql_error($Link));
        $rowResponseTime = mysql_fetch_assoc($resultResponseTime);

$queryConnectedDevice = "SELECT avg(ClientNumber) as CN FROM KPIClientNumber where HotelName = '$Hotel' and Period ='Last Hour'";
$resultConnectedDevice = mysql_query($queryConnectedDevice,$Link) or die(mysql_error($Link));
        $rowConnectedDevice = mysql_fetch_assoc($resultConnectedDevice);

$query12H = "SELECT * FROM KPIInternetUptime WHERE HotelName = '$Hotel' and Period ='Last 12 Hours'";
$result12H = mysql_query($query12H,$Link) or die(mysql_error($Link));
        $row12H = mysql_fetch_assoc($result12H);

$queryResponseTime12H = "SELECT * FROM KPIResponseTime WHERE HotelName = '$Hotel' and Period ='Last 12 Hours'";
$resultResponseTime12H = mysql_query($queryResponseTime12H,$Link) or die(mysql_error($Link));
        $rowResponseTime12H = mysql_fetch_assoc($resultResponseTime12H);

$queryConnectedDevice12H = "SELECT avg(ClientNumber) as CN FROM KPIClientNumber where HotelName = '$Hotel' and Period ='Last 12 Hours'";
$resultConnectedDevice12H = mysql_query($queryConnectedDevice12H,$Link) or die(mysql_error($Link));
        $rowConnectedDevice12H = mysql_fetch_assoc($resultConnectedDevice12H);


$query24H = "SELECT * FROM KPIInternetUptime WHERE HotelName = '$Hotel' and Period ='Last 24 Hours'";
$result24H = mysql_query($query24H,$Link) or die(mysql_error($Link));
        $row24H = mysql_fetch_assoc($result24H);

$queryResponseTime24H = "SELECT * FROM KPIResponseTime WHERE HotelName = '$Hotel' and Period ='Last 24 Hours'";
$resultResponseTime24H = mysql_query($queryResponseTime24H,$Link) or die(mysql_error($Link));
        $rowResponseTime24H = mysql_fetch_assoc($resultResponseTime24H);

$queryConnectedDevice24H = "SELECT avg(ClientNumber) as CN FROM KPIClientNumber where HotelName = '$Hotel' and Period ='Last 24 Hours'";
$resultConnectedDevice24H = mysql_query($queryConnectedDevice24H,$Link) or die(mysql_error($Link));
        $rowConnectedDevice24H = mysql_fetch_assoc($resultConnectedDevice24H);

$queryDisconnectAP = "SELECT COALESCE(TotalDisconnectedAP)as TotalDisconnectedAP,TotalAP FROM APStatus WHERE HotelName = '$Hotel'";
$resultDisconnectAP = mysql_query($queryDisconnectAP,$Link) or die(mysql_error($Link));
            $rowDisconnectAP = mysql_fetch_assoc($resultDisconnectAP);
            $TotalDisconnectAP = $rowDisconnectAP['TotalDisconnectedAP'];
            $TotalAP = $rowDisconnectAP['TotalAP'];

?>
<html>
<head>
	<title>WiWE 90 - Listener</title>
  	<link rel="icon" sizes="192x192" href="../img/Icon.png"/>
  	<!-- Glazzed & Bootstrap --> 	
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/main.min.css">
	<!-- Pixeden Icon Fonts -->
	<link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
	<link rel="stylesheet" type="text/css" href="../css/pe-icon-7-stroke.css">


<style>
        .progressbar {background: rgba(184, 184, 184, 0.59); background: -webkit-linear-gradient(top, rgba(56, 56, 56, 0.34) 0%, rgba(184, 184, 184, 0.59) 100%); background: linear-gradient(to bottom, rgba(56, 56, 56, 0.34) 0%, rgba(184, 184, 184, 0.59) 100%); border: 1px solid rgba(56, 56, 56, 0.1); border-radius: 0px; height: 3px;width : 75%;}
        .progress-bar-custom {background: rgba(17, 255, 0, 1); background: -webkit-linear-gradient(top, rgba(67, 153, 25, 0.66) 0%, rgba(17, 255, 0, 1) 100%); background: linear-gradient(to bottom, rgba(67, 153, 25, 0.66) 0%, rgba(17, 255, 0, 1) 100%);}

        .newProgress-bar-custom {background: rgba(255, 255, 255, 0.6); background: -webkit-linear-gradient(top, rgba(90, 112, 100, 0.66) 0%, rgba(17, 100, 0, 1) 100%); background: linear-gradient(to bottom, rgba(255, 0, 0, 0.66) 0%, rgba(255, 0, 0, 1) 100%);}
    </style>


</head>
<body>

<style> 

/*.classWithPad { margin:10px; padding:10px; }*/
    
#balabala {
  width: 100%;
  height: 250px;
  margin-left: auto;
  margin-right: auto;
  margin-top: 15px;
}

#connectedDevices2 {
  width: 100%;
  height: 250px;
  margin-left: auto;
  margin-right: auto;
  margin-top: 15px;
}
    
#connectedDevices3 {
  width: 100%;
  height: 250px;
  margin-left: auto;
  margin-right: auto;
  margin-top: 15px;
}
    

.amcharts-graph-g1 .amcharts-graph-fill {
  filter: url(#blur);
}

.amcharts-graph-g2 .amcharts-graph-fill {
  filter: url(#blur);
}

.amcharts-cursor-fill {
  filter: url(#shadow);
}
    
#trafficVolume {
    width: 100%;
    height: 262px;
    }

#trafficVolume2 {
    width: 100%;
    height: 262px;
    }

#trafficVolume3 {
    width: 100%;
    height: 262px;
    }  
       
</style>
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
                     <i class="pe-7s-network"></i>
                    <span>Access Point Monitor</span>
                  </h1>
                        
                    </div>
                    
                     <div class="main-header__date">
                    <input type="radio" id="radio_date_1" name="tab-radio" value="LastHours" checked><!--
                    --><label class="fixed-width" for="radio_date_1">Last Hours</label><!--
                    --><input type="radio" id="radio_date_2" name="tab-radio" value="12Hours"><!--
                    --><label class="fixed-width" for="radio_date_2"> 12 Hours</label><!--
                    --><input type="radio" id="radio_date_3" name="tab-radio" value="24Hours"><!--
                    --><label class="fixed-width" for="radio_date_3"> 24 Hours</label>
                    
                </div>

                </header>
                
                <div data-tab-radio="tab-radio" class="tab-radio-content row" id="LastHours">
                <div class="row">
                        <div class="col-md-3" >
                            <article class="widget" style="background-image: url('/img/APM11.png');background-repeat: no-repeat;background-position:right bottom ;">
                               <div class="widget__content widget__grid filled pad20" style="height: 105px">
                            <font size ="4">STATUS</font><br><br>
                            <font size ="6"><strong style="font-weight: bold;"> &nbsp <?php echo 'ONLINE '?> </strong></font><br>
                            <div class="progressbar" >
                            <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="60" style="width: 100%; padding-left: 0; padding-right: 0; padding-top: 5;">
                            </div>
                            </div>
                            <br>
                            </div>
                            </article>
                        </div>
                        
                        
                        <div class="col-md-3" >
                            <article class="widget"  style="background-image: url('/img/APM12.png');background-repeat: no-repeat;background-position:right bottom ;">
                               <div class="widget__content widget__grid filled pad20" style="height: 105px">
                            <font size ="4">INTERNET UPTIME</font><br><br>
                            <font size ="6"><strong style="font-weight: bold;"> &nbsp <?php echo round($row['ServiceLevel'],1)?>%</strong></font><br>
                            <div class="progressbar" >
                            <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width: 100%; padding-left: 0; padding-right: 0; padding-top: 5;">
                            </div>
                            </div>
                            <br>
                            </div>
                            </article>
                        </div>
                            
                        <div class="col-md-3" >
                            <article class="widget"  style="background-image: url('/img/APM13.png');background-repeat: no-repeat;background-position:right bottom ;">
                               <div class="widget__content widget__grid filled pad20" style="height: 105px">
                            <font size ="4">RESPONSE TIME</font><br><br>
                            <font size ="6"><strong style="font-weight: bold;"> &nbsp <?php echo $rowResponseTime['ResponseTime']?>ms </strong></font><br>
                            <div class="progressbar" >
                            <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width: 100%; padding-left: 0; padding-right: 0; padding-top: 5;">
                            </div>
                            </div>
                            <br>
                            </div>
                            </article>
                        </div>   
                                
                        <div class="col-md-3" >
                            <article class="widget"  style="background-image: url('/img/APM14.png');background-repeat: no-repeat;background-position:right bottom ;">
                               <div class="widget__content widget__grid filled pad20" style="height: 105px">
                            <font size ="4">CONNECTED DEVICE</font><br><br>
                            <font size ="6"><strong style="font-weight: bold;"> &nbsp <?php echo round($rowConnectedDevice['CN'],0); ?></strong></font><br>
                            <div class="progressbar" >
                            <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width: 100%; padding-left: 0; padding-right: 0; padding-top: 5;">
                            </div>
                            </div>
                            <br>
                            </div>
                            </article>
                        </div> 
                 </div>
                 
                 <div class="row">
				    <div class="col-md-6">

				<article class="widget">
							<header class="widget__header">
								<div class="widget__title">
									<i class=""></i><h3>Traffic Volume (MB)</h3>
								</div>
								<div class="widget__config">
									<a href="#"><i class=""></i></a>
									<a href="#"><i class="pe-7s-graph3"></i></a>
								</div>
							</header>

							<div class="widget__content filled pad20">
								
								<div class="row">
									<div class="col-md-12 text-center btn__showcase2">
										<div id="trafficVolume"></div>
									</div>
								</div>
							</div>
						</article><!-- /widget -->
				
				</div>
            
				<div class="col-md-6">
						<article class="widget">
							<header class="widget__header">
								<div class="widget__title">
									<i class=""></i><h3>Connected Devices</h3>
								</div>
								<div class="widget__config">
									<a href="#"><i class=""></i></a>
									<a href="#"><i class="pe-7s-graph3"></i></a>
								</div>
							</header>

							<div class="widget__content filled pad20">
								
								<div class="row">
									<div class="col-md-12 text-center btn__showcase2">
										<div id="balabala"></div>
									</div>

								</div>

							</div>
						</article><!-- /widget -->
					</div>
				</div>
        </div>
<!-- ###################################### Last Hour Section End Here ########################################################## -->                 
              
              <div data-tab-radio="tab-radio" class="tab-radio-content row" id="12Hours">
               <div class="row">
                       <div class="col-md-3" >
                            <article class="widget" style="background-image: url('/img/APM11.png');background-repeat: no-repeat;background-position:right bottom ;">
                               <div class="widget__content widget__grid filled pad20" style="height: 105px">
                            <font size ="4">STATUS</font><br><br>
                            <font size ="6"><strong style="font-weight: bold;"> &nbsp <?php echo 'ONLINE '?> </strong></font><br>
                            <div class="progressbar" >
                            <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="60" style="width: 100%; padding-left: 0; padding-right: 0; padding-top: 5;">
                            </div>
                            </div>
                            <br>
                            </div>
                            </article>
                        </div>
                        <div class="col-md-3" >
                            <article class="widget"  style="background-image: url('/img/APM12.png');background-repeat: no-repeat;background-position:right bottom ;">
                               <div class="widget__content widget__grid filled pad20" style="height: 105px">
                            <font size ="4">INTERNET UPTIME</font><br><br>
                            <font size ="6"><strong style="font-weight: bold;"> &nbsp <?php echo round($row12H['ServiceLevel'],1)?>% </strong></font><br>
                            <div class="progressbar" >
                            <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width: 100%; padding-left: 0; padding-right: 0; padding-top: 5;">
                            </div>
                            </div>
                            <br>
                            </div>
                            </article>
                        </div>
                            
                            
                        <div class="col-md-3" >
                            <article class="widget"  style="background-image: url('/img/APM13.png');background-repeat: no-repeat;background-position:right bottom ;">
                               <div class="widget__content widget__grid filled pad20" style="height: 105px">
                            <font size ="4">RESPONSE TIME</font><br><br>
                            <font size ="6"><strong style="font-weight: bold;"> &nbsp <?php echo $rowResponseTime12H['ResponseTime']?>ms </strong></font><br>
                            <div class="progressbar" >
                            <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width: 100%; padding-left: 0; padding-right: 0; padding-top: 5;">
                            </div>
                            </div>
                            <br>
                            </div>
                            </article>
                        </div>  

                        <div class="col-md-3" >
                            <article class="widget"  style="background-image: url('/img/APM14.png');background-repeat: no-repeat;background-position:right bottom ;">
                               <div class="widget__content widget__grid filled pad20" style="height: 105px">
                            <font size ="4">CONNECTED DEVICE</font><br><br>
                            <font size ="6"><strong style="font-weight: bold;"> &nbsp <?php echo round($rowConnectedDevice12H['CN'],0); ?></strong></font><br>
                            <div class="progressbar" >
                            <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width: 100%; padding-left: 0; padding-right: 0; padding-top: 5;">
                            </div>
                            </div>
                            <br>
                            </div>
                            </article>
                        </div> 
                         </div>
                         
                         <div class="row">
				    <div class="col-md-6">

				<article class="widget">
							<header class="widget__header">
								<div class="widget__title">
									<i class=""></i><h3>Traffic Volume (MB)</h3>
								</div>
								<div class="widget__config">
									<a href="#"><i class=""></i></a>
									<a href="#"><i class="pe-7s-graph3"></i></a>
								</div>
							</header>

							<div class="widget__content filled pad20">
								
								<div class="row">
									<div class="col-md-12 text-center btn__showcase2">
										<div id="trafficVolume2"></div>
									</div>

								</div>

							</div>
						</article><!-- /widget -->
				
				</div>
            
				<div class="col-md-6">
						<article class="widget">
							<header class="widget__header">
								<div class="widget__title">
									<i class=""></i><h3>Connected Devices</h3>
								</div>
								<div class="widget__config">
									<a href="#"><i class=""></i></a>
									<a href="#"><i class="pe-7s-graph3"></i></a>
								</div>
							</header>

							<div class="widget__content filled pad20">
								
								<div class="row">
									<div class="col-md-12 text-center btn__showcase2">
										<div id="connectedDevices2"></div>
									</div>

								</div>

							</div>
						</article><!-- /widget -->
					</div>
				</div>
            </div>
<!--############################################# 12 HOURS SENCTION ENDS HERE ####################################################### -->
        
            
            <div data-tab-radio="tab-radio" class="tab-radio-content row" id="24Hours">
            <div class="row">
                        <div class="col-md-3" >
                            <article class="widget" style="background-image: url('/img/APM11.png');background-repeat: no-repeat;background-position:right bottom ;">
                               <div class="widget__content widget__grid filled pad20" style="height: 105px">
                            <font size ="4">STATUS</font><br><br>
                            <font size ="6"><strong style="font-weight: bold;"> &nbsp <?php echo 'ONLINE '?> </strong></font><br>
                            <div class="progressbar" >
                            <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="60" style="width: 100%; padding-left: 0; padding-right: 0; padding-top: 5;">
                            </div>
                            </div>
                            <br>
                            </div>
                            </article>
                        </div>
                        
                        <div class="col-md-3" >
                            <article class="widget"  style="background-image: url('/img/APM12.png');background-repeat: no-repeat;background-position:right bottom ;">
                               <div class="widget__content widget__grid filled pad20" style="height: 105px">
                            <font size ="4">INTERNET UPTIME</font><br><br>
                            <font size ="6"><strong style="font-weight: bold;"> &nbsp <?php echo round($row24H['ServiceLevel'],1)?>% </strong></font><br>
                            <div class="progressbar" >
                            <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width: 100%; padding-left: 0; padding-right: 0; padding-top: 5;">
                            </div>
                            </div>
                            <br>
                            </div>
                            </article>
                        </div>
                            
                        <div class="col-md-3" >
                            <article class="widget"  style="background-image: url('/img/APM13.png');background-repeat: no-repeat;background-position:right bottom ;">
                               <div class="widget__content widget__grid filled pad20" style="height: 105px">
                            <font size ="4">RESPONSE TIME</font><br><br>
                            <font size ="6"><strong style="font-weight: bold;"> &nbsp <?php echo $rowResponseTime24H['ResponseTime']?>ms </strong></font><br>
                            <div class="progressbar" >
                            <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width: 100%; padding-left: 0; padding-right: 0; padding-top: 5;">
                            </div>
                            </div>
                            <br>
                            </div>
                            </article>
                        </div>  

                        <div class="col-md-3" >
                            <article class="widget"  style="background-image: url('/img/APM14.png');background-repeat: no-repeat;background-position:right bottom ;">
                               <div class="widget__content widget__grid filled pad20" style="height: 105px">
                            <font size ="4">CONNECTED DEVICE</font><br><br>
                            <font size ="6"><strong style="font-weight: bold;"> &nbsp <?php echo round($rowConnectedDevice24H['CN'],0); ?></strong></font><br>
                            <div class="progressbar" >
                            <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width: 100%; padding-left: 0; padding-right: 0; padding-top: 5;">
                            </div>
                            </div>
                            <br>
                            </div>
                            </article>
                        </div> 
                         </div>
                         
                         <div class="row">
				    <div class="col-md-6">

				<article class="widget">
							<header class="widget__header">
								<div class="widget__title">
									<i class=""></i><h3>Traffic Volume (MB)</h3>
								</div>
								<div class="widget__config">
									<a href="#"><i class=""></i></a>
									<a href="#"><i class="pe-7s-graph3"></i></a>
								</div>
							</header>

							<div class="widget__content filled pad20">
								
								<div class="row">
									<div class="col-md-12 text-center btn__showcase2">
										<div id="trafficVolume3"></div>
									</div>

								</div>

							</div>
						</article><!-- /widget -->
				
				</div>
            
				<div class="col-md-6">
						<article class="widget">
							<header class="widget__header">
								<div class="widget__title">
									<i class=""></i><h3>Connected Devices</h3>
								</div>
								<div class="widget__config">
									<a href="#"><i class=""></i></a>
									<a href="#"><i class="pe-7s-graph3"></i></a>
								</div>
							</header>

							<div class="widget__content filled pad20">
								
								<div class="row">
									<div class="col-md-12 text-center btn__showcase2">
										<div id="connectedDevices3"></div>
									</div>

								</div>

							</div>
						</article><!-- /widget -->
					</div>
				</div>
            </div>
     
            <div class ="row">
                        <div class="col-md-12">
						<article class="widget">
							<header class="widget__header">
								<div class="widget__title">
									<i class=""></i><h3>Continuosly Disconnected AP</h3>
								</div>
								<div class="widget__config">
									<a href="#"><i class=""></i></a>
									<a href="#"><i class="pe-7s-menu"></i></a>
								</div>
							</header>
							
							<div class="widget__content table-responsive">
								
								<table class="table table-striped media-table">
							  	<thead>
							  		<tr>
							  			<th>Hotel Name</th>
							  			<th>AP Name</th>
							  			<th>AP Mac</th>
							  			<th>Last Seen</th>
							  			<th>Downtime (Hour)</th>
							  			<th>IP Address</th>
							  		</tr>
							  	</thead>
							  	<tbody>
<!--
							  		<tr class="spacer"></tr>
							  		<tr>
							  		    <td>
							  		        Virtual Hotel 
							  		    </td>
							  		    <td>
							  		        RuckusR310Gym
							  		    </td>
							  		    <td>
							  		        F8:E7:1E:0E:95:60
							  		    </td>
							  		    <td>
							  		        02/07/2018
							  		    </td>
							  		    <td>
							  		        314
							  		    </td>
							  		    <td>
							  		        10.10.26.30
							  		    </td>
							  		</tr>
							  		
-->

							  	</tbody>
								</table>
								

								
							</div> <!-- /widget__content -->

						</article><!-- /widget -->
					</div>
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
	<script type="text/javascript" src="../js/amcharts/newAmcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <script src="https://www.amcharts.com/lib/3/themes/black.js"></script>
    <script type="text/javascript" src="../js/amcharts/newSerial.js"></script>
	
	<!--########################################## CONNECTED DEVICES CHART CONFIGURATION ############################################## -->
	
	<script>
                    
    var chartData = <?php print json_encode($rowConnectedDevices);  ?>;
 
    var chart =  AmCharts.makeChart("balabala", {
    "type": "serial",
        "theme": "light",
 
    "fontFamily": "",
    "autoMargins": true,
    "addClassNames": true,
    "zoomOutText": "",
    "defs": {
        "filter": [
            {
              
                "id": "blur",
                "feGaussianBlur": {
                    "in": "SourceGraphic",
                    "stdDeviation": "50"
                }
            },
            {
                "id": "shadow",
               
                "feOffset": {
                    "result": "offOut",
                    "in": "SourceAlpha",
                    "dx": "2",
                    "dy": "2"
                },
                "feGaussianBlur": {
                    "result": "blurOut",
                    "in": "offOut",
                    "stdDeviation": "10"
                },
                "feColorMatrix": {
                    "result": "blurOut",
                    "type": "matrix",
                    "values": "0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 .2 0"
                },
                "feBlend": {
                    "in": "SourceGraphic",
                    "in2": "blurOut",
                    "mode": "normal"
                }
            }
        ]
    },
    "fontSize": 15,
    "pathToImages": "../amcharts/images/",
    "dataProvider": chartData,
    "marginTop": 0,
    "marginRight": 1,
    "marginLeft": 0,
    "autoMarginOffset": 5,
    "categoryField": "TIMESTAMP",
    "categoryAxis": {
        "gridAlpha": 0.01,
        "axisColor": "#DADADA",
  
        "tickLength": 0
 
  
    },
    "valueAxes": [
        {
           
            "stackType": "regular",
            "gridAlpha": 0.01,
            "axisAlpha": 0
        }
    ],
    "graphs": [
        {
            "id": "g1",
            "type": "line",
            "title": "Area",
            "valueField": "Area",
            "fillColors": [
                "#0066e3",
                "#802ea9"
            ],
            "lineAlpha": 0,
            "fillAlphas": 0.8,
            "showBalloon": false
        },
        {
            "id": "g2",
            "type": "line",
            "title": "Motorcycles",
            "valueField": "motorcycles",
            "lineAlpha": 0,
            "fillAlphas": 0.8,
            "lineColor": "#5bb5ea",
            "showBalloon": false
        },
        {
            "id": "g3",
            "title": "ClientNumber",
            "valueField": "ClientNumber",
            "lineAlpha": 0.5,
            "lineColor": "#FFFFFF",
            "bullet": "round",
            "dashLength": 2,
            "bulletBorderAlpha": 1,
            "bulletAlpha": 1,
            "bulletSize": 15,
            "stackable": false,
            "bulletColor": "#5d7ad9",
            "bulletBorderColor": "#FFFFFF",
            "bulletBorderThickness": 3,
            "balloonText": "<div style='margin-bottom:30px;text-shadow: 2px 2px rgba(0, 0, 0, 0.1); font-weight:200;font-size:30px; color:#ffffff'>[[value]]</div>"
        }
    ],
    "chartCursor": {
        "cursorAlpha": 1,
        "zoomable": false,
        "cursorColor": "#FFFFFF",
        "categoryBalloonColor": "#8d83c8",
        "fullWidth": true,
        "balloonPointerOrientation": "vertical"
    },
    "balloon": {
        "borderAlpha": 0,
        "fillAlpha": 0,
        "shadowAlpha": 0,
    }
}); 
        

var chartData = <?php print json_encode($rowConnectedDevicesLast12Hours);  ?>;
 
    var chart =  AmCharts.makeChart("connectedDevices2", {
    "type": "serial",
        "theme": "light",
 
    "fontFamily": "",
    "autoMargins": true,
    "addClassNames": true,
    "zoomOutText": "",
    "defs": {
        "filter": [
            {
              
                "id": "blur",
                "feGaussianBlur": {
                    "in": "SourceGraphic",
                    "stdDeviation": "50"
                }
            },
            {
                "id": "shadow",
               
                "feOffset": {
                    "result": "offOut",
                    "in": "SourceAlpha",
                    "dx": "2",
                    "dy": "2"
                },
                "feGaussianBlur": {
                    "result": "blurOut",
                    "in": "offOut",
                    "stdDeviation": "10"
                },
                "feColorMatrix": {
                    "result": "blurOut",
                    "type": "matrix",
                    "values": "0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 .2 0"
                },
                "feBlend": {
                    "in": "SourceGraphic",
                    "in2": "blurOut",
                    "mode": "normal"
                }
            }
        ]
    },
    "fontSize": 15,
    "pathToImages": "../amcharts/images/",
    "dataProvider": chartData,
    "marginTop": 0,
    "marginRight": 1,
    "marginLeft": 0,
    "autoMarginOffset": 5,
    "categoryField": "TIME",
    "categoryAxis": {
        "gridAlpha": 0.01,
        "axisColor": "#DADADA",
        "labelRotation" :90,
        "tickLength": 0
 
  
    },
    "valueAxes": [
        {
           
            "stackType": "regular",
            "gridAlpha": 0.01,
            "axisAlpha": 0
        }
    ],
    "graphs": [
        {
            "id": "g1",
            "type": "line",
            "title": "Area",
            "valueField": "Area",
            "fillColors": [
                "#0066e3",
                "#802ea9"
            ],
            "lineAlpha": 0,
            "fillAlphas": 0.8,
            "showBalloon": false
        },
        {
            "id": "g2",
            "type": "line",
            "title": "Motorcycles",
            "valueField": "motorcycles",
            "lineAlpha": 0,
            "fillAlphas": 0.8,
            "lineColor": "#5bb5ea",
            "showBalloon": false
        },
        {
            "id": "g3",
            "title": "ClientNumber",
            "valueField": "ClientNumber",
            "lineAlpha": 0.5,
            "lineColor": "#FFFFFF",
            "bullet": "round",
            "dashLength": 2,
            "bulletBorderAlpha": 1,
            "bulletAlpha": 1,
            "bulletSize": 15,
            "stackable": false,
            "bulletColor": "#5d7ad9",
            "bulletBorderColor": "#FFFFFF",
            "bulletBorderThickness": 3,
            "balloonText": "<div style='margin-bottom:30px;text-shadow: 2px 2px rgba(0, 0, 0, 0.1); font-weight:200;font-size:30px; color:#ffffff'>[[value]]</div>"
        }
    ],
    "chartCursor": {
        "cursorAlpha": 1,
        "zoomable": false,
        "cursorColor": "#FFFFFF",
        "categoryBalloonColor": "#8d83c8",
        "fullWidth": true,
        "balloonPointerOrientation": "vertical"
    },
    "balloon": {
        "borderAlpha": 0,
        "fillAlpha": 0,
        "shadowAlpha": 0,
    }
});
        
        

var chartData = <?php print json_encode($rowConnectedDevicesLast24Hours);  ?>;
 
    var chart =  AmCharts.makeChart("connectedDevices3", {
    "type": "serial",
        "theme": "light",
 
    "fontFamily": "",
    "autoMargins": true,
    "addClassNames": true,
    "zoomOutText": "",
    "defs": {
        "filter": [
            {
              
                "id": "blur",
                "feGaussianBlur": {
                    "in": "SourceGraphic",
                    "stdDeviation": "50"
                }
            },
            {
                "id": "shadow",
               
                "feOffset": {
                    "result": "offOut",
                    "in": "SourceAlpha",
                    "dx": "2",
                    "dy": "2"
                },
                "feGaussianBlur": {
                    "result": "blurOut",
                    "in": "offOut",
                    "stdDeviation": "10"
                },
                "feColorMatrix": {
                    "result": "blurOut",
                    "type": "matrix",
                    "values": "0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 .2 0"
                },
                "feBlend": {
                    "in": "SourceGraphic",
                    "in2": "blurOut",
                    "mode": "normal"
                }
            }
        ]
    },
    "fontSize": 15,
    "pathToImages": "../amcharts/images/",
    "dataProvider": chartData,
    "marginTop": 0,
    "marginRight": 1,
    "marginLeft": 0,
    "autoMarginOffset": 5,
    "categoryField": "TIME",
    "categoryAxis": {
        "gridAlpha": 0.01,
        "axisColor": "#DADADA",
        "labelRotation" :90,
        "tickLength": 0
 
  
    },
    "valueAxes": [
        {
           
            "stackType": "regular",
            "gridAlpha": 0.01,
            "axisAlpha": 0
        }
    ],
    "graphs": [
        {
            "id": "g1",
            "type": "line",
            "title": "Area",
            "valueField": "Area",
            "fillColors": [
                "#0066e3",
                "#802ea9"
            ],
            "lineAlpha": 0,
            "fillAlphas": 0.8,
            "showBalloon": false
        },
        {
            "id": "g2",
            "type": "line",
            "title": "Motorcycles",
            "valueField": "motorcycles",
            "lineAlpha": 0,
            "fillAlphas": 0.8,
            "lineColor": "#5bb5ea",
            "showBalloon": false
        },
        {
            "id": "g3",
            "title": "ClientNumber",
            "valueField": "ClientNumber",
            "lineAlpha": 0.5,
            "lineColor": "#FFFFFF",
            "bullet": "round",
            "dashLength": 2,
            "bulletBorderAlpha": 1,
            "bulletAlpha": 1,
            "bulletSize": 15,
            "stackable": false,
            "bulletColor": "#5d7ad9",
            "bulletBorderColor": "#FFFFFF",
            "bulletBorderThickness": 3,
            "balloonText": "<div style='margin-bottom:30px;text-shadow: 2px 2px rgba(0, 0, 0, 0.1); font-weight:200;font-size:30px; color:#ffffff'>[[value]]</div>"
        }
    ],
    "chartCursor": {
        "cursorAlpha": 1,
        "zoomable": false,
        "cursorColor": "#FFFFFF",
        "categoryBalloonColor": "#8d83c8",
        "fullWidth": true,
        "balloonPointerOrientation": "vertical"
    },
    "balloon": {
        "borderAlpha": 0,
        "fillAlpha": 0,
        "shadowAlpha": 0,
    }
});      
        
    </script>
    
<!-- ############################################################# TRAFFIC VOLUME CONFIGURATION ######################################################## -->
        <script>
                    
var chart = AmCharts.makeChart("trafficVolume", {
    "type": "serial",
    "theme": "light",
    "legend": {
        "horizontalGap": 0,
        "maxColumns": 1,
        "position": "right",
        "useGraphSettings": true,
        "markerSize": 10
    },
    "dataProvider": <?php print json_encode($rowTrafficVolume);?>
    ,
    "valueAxes": [{
        "stackType": "regular",
        "axisAlpha": 0.3,
        "gridAlpha": 0
    }],
    "graphs": [{
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Sent",
        "type": "column",
                "color": "transparent",
        "valueField": "Sent"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Receive",
        "type": "column",
                "color": "transparent",
        "valueField": "Receive"
    }],
    "categoryField": "TIMESTAMP",
    "categoryAxis": {
        "gridPosition": "start",
        "labelRotation" :90,
        "minHorizontalGap":10,
        "axisAlpha": 0.3,
        "gridAlpha": 0,
        "position": "left"
    },
    "export": {
        "enabled": false
     }

    });  
            

var chart = AmCharts.makeChart("trafficVolume2", {
    "type": "serial",
    "theme": "light",
    "legend": {
        "horizontalGap": 0,
        "maxColumns": 1,
        "position": "bottom",
        "maxColumns":2,
        "useGraphSettings": true,
        "markerSize": 10
    },
    "dataProvider": <?php print json_encode($rowTrafficVolumeLast12Hours);?>
    ,
    "valueAxes": [{
        "stackType": "regular",
        "axisAlpha": 0.3,
        "gridAlpha": 0
    }],
    "graphs": [{
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Sent",
        "type": "column",
                "color": "transparent",
        "valueField": "Sent"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Receive",
        "type": "column",
                "color": "transparent",
        "valueField": "Receive"
    }],
    "categoryField": "TIME",
    "categoryAxis": {
        "gridPosition": "start",
        "labelRotation" :90,
        "minHorizontalGap":10,
        "axisAlpha": 0.3,
        "gridAlpha": 0,
        "position": "left"
    },
    "export": {
        "enabled": false
     }

    });
            
var chart = AmCharts.makeChart("trafficVolume3", {
    "type": "serial",
    "theme": "light",
    "legend": {
        "horizontalGap": 0,
        "maxColumns": 1,
        "position": "bottom",
        "maxColumns":2,
        "useGraphSettings": true,
        "markerSize": 10
    },
    "dataProvider": <?php print json_encode($rowTrafficVolumeLast24Hours);?>
    ,
    "valueAxes": [{
        "stackType": "regular",
        "axisAlpha": 0.3,
        "gridAlpha": 0
    }],
    "graphs": [{
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Sent",
        "type": "column",
                "color": "transparent",
        "valueField": "Sent"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Receive",
        "type": "column",
                "color": "transparent",
        "valueField": "Receive"
    }],
    "categoryField": "TIME",
    "categoryAxis": {
        "gridPosition": "start",
        "labelRotation" :90,
        "minHorizontalGap":10,
        "axisAlpha": 0.3,
        "gridAlpha": 0,
        "position": "left"
    },
    "export": {
        "enabled": false
     }

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

