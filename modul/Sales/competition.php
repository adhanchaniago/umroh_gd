<!DOCTYPE html>
<?php
require('../config/wiwe360-config.php'); //Load DB(mysql) config parameter
session_start();
$Hotel = $_SESSION['Hotel'];
$HotelName = str_replace('_',' ',$_POST['Hotel']);
$Period = $_POST['period'];
$country=$_POST['country'];


$queryCompetitionbyCategory ="SELECT Category, sum(case when (`HotelName` = '$Hotel')  then `Positive`*-1 else 0 end) as 'YourHotel', sum(case when (`HotelName` = '$HotelName')  then `Positive` else 0 end) as 'YourCompetitor'  FROM `KPICategory` where `HotelName` in ('$Hotel', '$HotelName') and `Period` = '$Period' group by Category";
$resultCompetitionbyCategory = mysql_query($queryCompetitionbyCategory,$Link) or die ($Link);
$rowCompetitionbyCategory = array();
while ($r = mysql_fetch_assoc($resultCompetitionbyCategory))
                {
                    $rowCompetitionbyCategory[] = $r;
                }

$queryScoreCompetitor ="SELECT `OTA`, sum(case when(`Hotel` = '$Hotel') then `Score` else 0 end) as 'YourHotel', sum(case when(`Hotel` = '$HotelName') then `Score` else 0 end) as 'YourCompetitor' FROM `KPIScore` where `Hotel` in ('$Hotel' , '$HotelName') group by `OTA`";
$resultScoreCompetitor = mysql_query($queryScoreCompetitor,$Link) or die ($Link);
$rowScoreCompetitor = array();
while ($r = mysql_fetch_assoc($resultScoreCompetitor))
                {
                    $rowScoreCompetitor[] = $r;
                }

$queryPolarChartPositive = "SELECT `Category`, sum(case when(HotelName = '$Hotel') then Positive else 0 end) as 'YourHotelP', sum(case when(HotelName = '$HotelName') then Positive else 0 end) as 'YourCompetitorP'  FROM `KPICompetitionRadar` where  Period = '$Period' and `HotelName` in ('$Hotel' , '$HotelName') group by `Category`";
$resultPolarChartPositive = mysql_query($queryPolarChartPositive,$Link) or die ($Link);
$rowPolarChartPositive = array();
while ($r = mysql_fetch_assoc($resultPolarChartPositive))
{
    $rowPolarChartPositive[] = $r;
}

$queryPolarChartNegative = "SELECT `Category`, sum(case when(HotelName = '$Hotel') then Negative else 0 end) as 'YourHotelN', sum(case when(HotelName = '$HotelName') then Negative else 0 end) as 'YourCompetitorN'  FROM `KPICompetitionRadar` where  Period = '$Period' and `HotelName` in ('$Hotel' , '$HotelName') group by `Category`";
$resultPolarChartNegative = mysql_query($queryPolarChartNegative,$Link) or die ($Link);
$rowPolarChartNegative = array();
while ($r = mysql_fetch_assoc($resultPolarChartNegative))
{
    $rowPolarChartNegative[] = $r;
}

$queryTotalHotel = "SELECT  count(*) as Total from (
							Select distinct HotelOrigin, HotelDestination
                            FROM DIMHotelRadius
							Where HotelOrigin = '$Hotel' and Radius <= '$country' and StarRating = (select distinct StarRating from DIMHotelRadius where HotelDestination = '$Hotel')
							group by HotelOrigin, HotelDestination) A";
$resultTotalHotel = mysql_query($queryTotalHotel,$Link) or die (mysql_error($Link));
$rowTotalHotel = mysql_fetch_assoc($resultTotalHotel);

$queryPositiveRank = "Select X.HotelDestination, X.rank, X.Positive
							From (
							SELECT s.*, @curRank := @curRank + 1 AS rank
							from (
							Select distinct A.HotelOrigin, A.HotelDestination, coalesce(B.Positive,0) as Positive
                            from
                            (SELECT HotelOrigin, HotelDestination, `Hotel-Destination`, StarRating, Province, Area,Distance, Radius
                            FROM DIMHotelRadius) A
                            left Join
                            (SELECT Period, HotelName, Positive, TotalSentiment
                            FROM KPIHotelPositive) B
                            on A.`Hotel-Destination` = B.HotelName
                            Where A.HotelOrigin = '$Hotel' AND (B.Period = '$Period' or B.Period is null) AND (A.Radius <= '$country') and StarRating = (select distinct StarRating from DIMHotelRadius where HotelDestination = '$Hotel')
							group by A.HotelOrigin, A.HotelDestination
							order by Positive DESC, TotalSentiment DESC
							) s,(SELECT @curRank := 0) r ) X
							Where X.HotelDestination = '$Hotel'
";
$resultPositiveRank = mysql_query($queryPositiveRank,$Link) or die (mysql_error($Link));
$rowPositiveRank = mysql_fetch_assoc($resultPositiveRank);

$queryPositiveRank2 = "Select X.HotelDestination, X.rank, X.Positive
							From (
							SELECT s.*, @curRank := @curRank + 1 AS rank
							from (
							Select distinct A.HotelOrigin, A.HotelDestination, coalesce(B.Positive,0) as Positive
                            from
                            (SELECT HotelOrigin, HotelDestination, `Hotel-Destination`, StarRating, Province, Area,Distance, Radius
                            FROM DIMHotelRadius) A
                            left Join
                            (SELECT Period, HotelName, Positive, TotalSentiment
                            FROM KPIHotelPositive) B
                            on A.`Hotel-Destination` = B.HotelName
                            Where A.HotelOrigin = '$Hotel' AND (B.Period = '$Period' or B.Period is null) AND (A.Radius <= '$country') and StarRating = (select distinct StarRating from DIMHotelRadius where HotelDestination = '$Hotel')
							group by A.HotelOrigin, A.HotelDestination
							order by Positive DESC, TotalSentiment DESC
							) s,(SELECT @curRank := 0) r ) X
							Where X.HotelDestination = '$HotelName'";

$resultPositiveRank2 = mysql_query($queryPositiveRank2,$Link) or die (mysql_error($Link));
$rowPositiveRank2 = mysql_fetch_assoc($resultPositiveRank2);

$Rank1 = ($rowTotalHotel['Total'] - $rowPositiveRank['rank']) / ($rowTotalHotel['Total'] - 1) * 100;
$Rank2 = ($rowTotalHotel['Total'] - $rowPositiveRank2['rank']) / ($rowTotalHotel['Total'] - 1) * 100;

$queryReview = "SELECT `Period`, `HotelName`, sum(`Positive`) + sum(`Neutral`) + sum(`Negative`) as Total FROM `KPICategory` WHERE `HotelName` = '$Hotel' and  `Period` = '$Period' group by `Period`, `HotelName`";
$resultReview = mysql_query ($queryReview,$Link) or die (mysql_error($Link));
$rowReview = mysql_fetch_assoc ($resultReview);


$queryReview2 = "SELECT `Period`, `HotelName`, sum(`Positive`) + sum(`Neutral`) + sum(`Negative`) as Total FROM `KPICategory` WHERE `HotelName` = '$HotelName' and  `Period` = '$Period' group by `Period`, `HotelName`";
$resultReview2 = mysql_query ($queryReview2,$Link) or die (mysql_error($Link));
$rowReview2 = mysql_fetch_assoc ($resultReview2);

$queryNegativeSentiment = "SELECT `Period`, `HotelName`, `Category`, sum(`Negative`) / ((`Positive`) + sum(`Neutral`) + sum(`Negative`))*100 as Percent FROM `KPICategory` WHERE `HotelName` = '$Hotel' and  `Period` = '$Period' group by `Period`, `HotelName`, `Category` order by Percent DESC limit 1";
$resultNegativeSentiment = mysql_query ($queryNegativeSentiment,$Link) or die (mysql_error($Link));
$rowNegativeSentiment = mysql_fetch_assoc($resultNegativeSentiment);

$queryNegativeSentiment2= "SELECT `Period`, `HotelName`, `Category`, sum(`Negative`) / ((`Positive`) + sum(`Neutral`) + sum(`Negative`))*100 as Percent  FROM `KPICategory` WHERE `HotelName` = '$HotelName' and  `Period` = '$Period' group by `Period`, `HotelName`, `Category` order by Percent DESC limit 1";
$resultNegativeSentiment2 = mysql_query ($queryNegativeSentiment2,$Link) or die (mysql_error($Link));
$rowNegativeSentiment2 = mysql_fetch_assoc($resultNegativeSentiment2);

$queryPriceLowest ="SELECT Price as Price FROM KPIPrice WHERE HotelName ='$Hotel'";
$resultPriceLowest = mysql_query($queryPriceLowest,$Link) or die (mysql_error($Link));
$rowPriceLowest = mysql_fetch_assoc($resultPriceLowest);

$queryPriceLowest2 ="SELECT Price as Price FROM KPIPrice WHERE HotelName ='$HotelName'";
$resultPriceLowest2 = mysql_query($queryPriceLowest2,$Link) or die (mysql_error($Link));
$rowPriceLowest2 = mysql_fetch_assoc($resultPriceLowest2);

#Baca parameter terakhir pada dropdown list
$dataCountry = isset($_POST['country']) ? $_POST['country'] : 'Select Radius';
setlocale(LC_MONETARY, 'id_ID');
?>
    <html>

    <head>
        <title>WiWE 90 - Listener</title>
        <link rel="icon" sizes="192x192" href="../img/Icon.png" />
        <!-- Glazzed & Bootstrap -->
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/main.min.css">
        <!-- Pixeden Icon Fonts -->
        <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
        <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-stroke.css"> </head>

    <body>
        <style>
            #chartCompetitionReview2 {
                width: 100%;
                height: 500px;
                font-size: 11px;
            }

            #polarChart1 {
                width: 100%;
                height: 500px;
            }

            #kanan{
              padding-left: 15px;
              margin-left: 15px;
            }
        </style>

        <style>
        .progressbar {margin-top: 7px;background: rgba(107, 104, 104, 0.49); border: 1px solid rgba(245, 245, 245, 0); border-radius: 25px; height: 4px;}
        .progress-bar-custom {background: rgba(15, 217, 9, 1);}
            .newProgress-bar-custom {background: rgba(28, 125, 250,1); background: -webkit-linear-gradient(top, rgba(28, 125, 250, 1) 0%, rgba(28, 125, 250, 1) 100%); background: linear-gradient(to bottom, rgba(28, 125, 250, 1) 0%, rgba(28, 125, 250, 1) 0%);}
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
						<i class="pe-7s-paper-plane"></i>
						<span>Competition Review</span><br>
						<font size ="4">&nbsp &nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp<?php if ($Hotel == 'GIS'){echo 'Virtual Hotel';} ?> Vs <?php echo $HotelName ?> in <?php echo $Period ?> at <?php if ($country == 2) echo '0-2 KM';
                                                                       if ($country == 5) echo '0-5 KM';
                                                                       if ($country == 10) echo '0-10 KM';
                                                                       if ($country == 100) echo 'Province';
                                                                       if ($country == 1000) echo 'Indonesia'; ?></font>
					</h1> </div>
                    <!-- Dropdown Filter Start -->
                    <div class="main-header__date">
                        <form method="post" action="" name="form1">
                            <table>
                                <tr>
                                    <td>
                                        <select name="country" class="form-control" onChange="getState(this.value)">
                                            <option value="<?php echo $dataCountry; ?>">
                                                <?php  if ($country == '') echo 'Select Radius';
                                                                       if ($country == 2) echo 'Select Radius';
                                                                       if ($country == 5) echo 'Select Radius';
                                                                       if ($country == 10) echo 'Select Radius';
                                                                       if ($country == 100) echo 'Select Radius';
                                                                       if ($country == 1000) echo 'Select Radius';?>
                                            </option>
                                            <?php $db = new mysqli('localhost','u4784502','3edcVFR$','u4784502_wiwe360');
                    $config = $db->query("SELECT DISTINCT  `Radius` as id ,
                                        case when (`Radius` >10) then `Province` when (`Radius` =2) then '0-2 KM' when (`Radius` =5) then '0-5 KM' when (`Radius` =10) then '0-10 KM' else `Radius` end as  country
                                        FROM `DIMHotelRadius`
                                        WHERE HotelOrigin ='$Hotel'and StarRating = (select distinct StarRating from `DIMHotelRadius` where `HotelDestination` ='$Hotel')  order by Radius ASC");
                    while ($view = $config->fetch_array()) {
                    ?>
                                                <option value="<?php echo $view['id'] ?>">
                                                    <?php echo $view['country']; ?>
                                                </option>
                                                <?php } ?>
                                        </select>
                                    </td>
                                    <td>
                                        <div id="statediv">
                                            <select name="state" class="form-control">
                                                <option>Select Your Competitor</option>
                                            </select>
                                        </div>
                                        <div id="citydiv">
                                            <td>
                                                <select name="period" class="form-control" onChange="submitAction()">
                                                    <option>Select Period</option>
                                                    <option>30 Days</option>
                                                    <option>Current Year</option>
                                                    <option>Past Year</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="submit" id="compare" hidden> </td>
                                </tr>
                            </table>
                        </form>
                        <script>
                            function submitAction() {
                                document.getElementById("compare").click();
                            }
                        </script>
                        </div>
                        <!-- Filter Dropdown End -->
                </header>
                <!-- /main-header -->
                <div class="row">
                    <div class="col-md-3">
                        <article class="widget">
                            <div class="widget__content widget__grid filled pad20" style="height: 120px">
                                <center><font size="4"> RANKING</font></center>
                                <br>
                                <br>
                                <div class = "row">
                                <div  class ="col-xs-2"> You </div>
                                <div class ="col-xs-8">
                                <div class="progressbar">
                                <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $Rank1?>%; padding-left: 0; padding-right: 0; padding-top: 5;">
                                </div>
                                </div>
                              </div>
                              <div class ="col-xs-2"> <font size="3"><strong style="font-weight: bold;"> #<?php echo $rowPositiveRank['rank']; ?> </strong> </font></div>
                              </div>

                              <div class = "row">
                              <div  class ="col-xs-2"> Comp. </div>
                              <div class ="col-xs-8">
                              <div class="progressbar">
                              <div class="progress-bar newProgress-bar-custom" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $Rank2?>%; padding-left: 0; padding-right: 0; padding-top: 5;">
                              </div>
                              </div>
                            </div>
                            <div class ="col-xs-2"> <font size="3"><strong style="font-weight: bold;"> #<?php echo $rowPositiveRank2['rank'] ?> </strong> </font></div>
                            </div>

                                <!-- <div class="col-xs-6"> <font size="2"><strong style="font-weight: bold;"> <?php echo $rowTotalHotel['Total'] ?></strong> Total Hotels </font> </div>
                                <div class="col-xs-6"> <font size="3"><strong style="font-weight: bold;">&nbsp &nbsp #<?php echo $rowPositiveRank['rank']; ?> </strong> &nbsp   VS &nbsp  <strong style ="font-weight:bold;"> #<?php echo $rowPositiveRank2['rank'] ?></strong> </font> </div> -->
                            </div>
                        </article>
                    </div>
                    <div class="col-md-3">
                        <article class="widget">
                            <div class="widget__content widget__grid filled pad20" style="height: 120px">
                                <center><font size="3"> POSITIVE SENTIMENT </font></center>
                                <br>
                                <br>
                                <div class = "row">
                                <div  class ="col-xs-2"> You </div>
                                <div class ="col-xs-8">
                                <div class="progressbar">
                                <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width:  <?php echo round($rowPositiveRank  ['Positive'],1) ?>%; padding-left: 0; padding-right: 0; padding-top: 5;">
                                </div>
                                </div>
                              </div>
                              <div class ="col-xs-2" style="padding-left:0px"> <font size="3"><strong style="font-weight: bold;">  <?php echo round($rowPositiveRank['Positive'],1) ?>% </strong> </font></div>
                              </div>
                                <!-- <div class="row">
                                    <div class="col-xs-4"> <font size="3"><strong style="font-weight: bold;"> <?php echo round($rowPositiveRank['Positive'],1); ?>% </strong></font> </div>
                                    <div class="col-xs-4"> <font size="2"><center>Percentage </center></font> </div>
                                    <div class="col-xs-4"> <font size="3"><strong style="font-weight: bold;">&nbsp &nbsp <?php echo round($rowPositiveRank2['Positive'],1) ?>% </strong></font> </div>
                                </div> -->

                                <div class = "row">
                                <div  class ="col-xs-2"> Comp. </div>
                                <div class ="col-xs-8">
                                <div class="progressbar">
                                <div class="progress-bar newProgress-bar-custom " role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width:  <?php echo round($rowPositiveRank2['Positive'],1) ?>%; padding-left: 0; padding-right: 0; padding-top: 5;">
                                </div>
                                </div>
                              </div>
                              <div class ="col-xs-2" style="padding-left:0px"> <font size="3"><strong style="font-weight: bold;">  <?php echo round($rowPositiveRank2['Positive'],1) ?>% </strong> </font></div>
                              </div>
                                <!-- <div class="row">
                                    <div class="col-xs-3"> <font size="3"><strong style="font-weight: bold;"> <?php echo $rowReview['Total']; ?> </strong></font> </div>
                                    <div class="col-xs-6"> <font size="2"><center>Total Reviewer</center></font> </div>
                                    <div class="col-xs-3"> <font size="3"><strong style="font-weight: bold;">  <?php echo $rowReview2['Total'] ?> </strong></font> </div>
                                </div> -->
                                <br>
                                <br> </article>
                        </div>
                        <div class="col-md-3">
                            <article class="widget">
                                <div class="widget__content widget__grid filled pad20" style="height: 120px">
                                    <center><font size="3"> MOST NEGATIVE SENTIMENT </font></center>
                                    <br>
                                    <br>

                                    <div class = "row">
                                    <div  class ="col-xs-3"> <?php echo $rowNegativeSentiment['Category']; ?> </div>
                                    <div class ="col-xs-7">
                                    <div class="progressbar">
                                    <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width:  <?php echo round($rowNegativeSentiment['Percent'],1); ?>%; padding-left: 0; padding-right: 0; padding-top: 5;">
                                    </div>
                                    </div>
                                  </div>
                                  <div class ="col-xs-2" style="padding-left:0px"> <font size="3"><strong style="font-weight: bold;">  <?php echo round($rowNegativeSentiment['Percent'],1); ?>% </strong> </font></div>
                                  </div>

                                    <!-- <div class="row">
                                        <div class="col-xs-4"> <font size="3"><strong style="font-weight: bold;"> <?php echo round($rowNegativeSentiment['Percent'],1); ?>% </strong></font> </div>
                                        <div class="col-xs-4"> <font size="2"><center> Percentage </center></font> </div>
                                        <div class="col-xs-4"> <font size="4"><strong style="font-weight: bold;"> &nbsp   <?php echo round($rowNegativeSentiment2['Percent'],1); ?>% </strong></font> </div>
                                    </div> -->

                                    <div class = "row">
                                    <div  class ="col-xs-3"> <?php echo $rowNegativeSentiment2['Category']; ?> </div>
                                    <div class ="col-xs-7">
                                    <div class="progressbar">
                                    <div class="progress-bar newProgress-bar-custom " role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round($rowNegativeSentiment2['Percent'],1); ?>%; padding-left: 0; padding-right: 0; padding-top: 5;">
                                    </div>
                                    </div>
                                  </div>
                                  <div class ="col-xs-2" style="padding-left:0px"> <font size="3"><strong style="font-weight: bold;">  <?php echo round($rowNegativeSentiment2['Percent'],1); ?>% </strong> </font></div>
                                  </div>

                                    <!-- <div class="row">
                                        <div class="col-xs-4"> <font size="3"><strong style="font-weight: bold;"> <?php echo $rowNegativeSentiment['Category']; ?> </strong></font> </div>
                                        <div class="col-xs-4"> <font size="2"><center> Category </center></font> </div>
                                        <div class="col-xs-4"> <font size="3"><strong style="font-weight: bold;"> &nbsp  <?php echo $rowNegativeSentiment2['Category']; ?>  </strong></font> </div>
                                    </div> -->
                                    <br>
                                    <br> </article>
                            </div>
                            <div class="col-md-3">
                                <article class="widget">
                                    <div class="widget__content widget__grid filled pad20" style="height: 120px">
                                        <center><font size="3"> ROOM RATE (IDR) </font></center>
                                        <br>
                                        <br>
                                        <div class="row">
                                            <div class="col-xs-4"> <font size="2"><strong style="font-weight: bold;"> <?php echo  money_format('%.0n',$rowPriceLowest['Price']); ?></strong></font> </div>
                                            <div class="col-xs-4"> <font size="2"><center> Lowest </center></font> </div>
                                            <div class="col-xs-4"> <font size="2"><strong style="font-weight: bold;"> <?php echo  money_format('%.0n',$rowPriceLowest2['Price']); ?> </strong></font> </div>
                                        </div>
                                        <br>
                                        <br> </article>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <article class="widget">
                                        <div class="widget__content filled pad20">
                                            <div class="row">
                                                <div class="col-md-12 text-center btn__showcase2">
                                                    <div id="chartCompetitionReview" style="width: 100%; height: 300px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <!-- /widget -->
                                </div>
                                <div class="col-md-6">
                                    <article class="widget">
                                        <div class="widget__content filled pad20">
                                            <div class="row">
                                                <div class="col-md-12 text-center btn__showcase2">
                                                    <div id="chartCompetitionReview2" style="width: 100%; height: 300px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <!-- /widget -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <article class="widget">
                                        <header class="widget__header">
                                            <div class="widget__title"> <i class=""></i>
                                                <h3>Positive Sentiment</h3> </div>
                                            <div class="widget__config"> <a href="#"><i class=""></i></a> <a href="#"><i class="pe-7s-graph"></i></a> </div>
                                        </header>
                                        <div class="widget__content filled pad20">
                                            <div class="row">
                                                <div class="col-md-12 text-center btn__showcase2">
                                                    <div id="polarChartPositive" style="width: 100%; height: 300px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <!-- /widget -->
                                </div>
                                <div class="col-md-6">
                                    <article class="widget">
                                        <header class="widget__header">
                                            <div class="widget__title"> <i class=""></i>
                                                <h3>Negative Sentiment</h3> </div>
                                            <div class="widget__config"> <a href="#"><i class=""></i></a> <a href="#"><i class="pe-7s-graph"></i></a> </div>
                                        </header>
                                        <div class="widget__content filled pad20">
                                            <div class="row">
                                                <div class="col-md-12 text-center btn__showcase2">
                                                    <div id="polarChartNegative" style="width: 100%; height: 300px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <!-- /widget -->
                                </div>
                            </div>
                            <footer class="footer-brand">
                                <?php include "footer.php"; ?>
                            </footer>
            </section>
            <!-- /content -->
            <script type="text/javascript" src="../js/main.js"></script>
            <!-- Loading -->
            <script type="text/javascript" src="../js/amcharts/amcharts.js"></script>
            <script type="text/javascript" src="../js/amcharts/serial.js"></script>
            <script type="text/javascript" src="../js/amcharts/pie.js"></script>
            <script type="text/javascript" src="../js/chartz.js"></script>
            <script type="text/javascript" src="../js/amcharts/newAmcharts.js"></script>
            <script src="https://www.amcharts.com/lib/3/radar.js"></script>
            <script src="https://www.amcharts.com/lib/3/serial.js"></script>
            <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
            <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
            <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
            <script>
                var chart = AmCharts.makeChart("chartCompetitionReview", {
                    "type": "serial"
                    , "theme": "dark"
                    , "rotate": true
                    , "marginBottom": 35
                    , "dataProvider": <?php print json_encode($rowCompetitionbyCategory) ?>
                    , "startDuration": 1
                    , "graphs": [{
                        "fillAlphas": 0.8
                        , "lineAlpha": 0.2
                        , "type": "column"
                        , "valueField": "YourHotel"
                        , "title": "Your Hotel"
                        , "labelText": "Your Hotel"
                        , "clustered": false
                        , "labelFunction": function (item) {
                            return Math.abs(item.values.value);
                        }
                        , "balloonFunction": function (item) {
                            return item.category + ": " + Math.abs(item.values.value) + "%";
                        }
  }, {
                        "fillAlphas": 0.8
                        , "lineAlpha": 0.2
                        , "type": "column"
                        , "valueField": "YourCompetitor"
                        , "title": "Your Competitor"
                        , "labelText": "Your Competitor"
                        , "clustered": false
                        , "labelFunction": function (item) {
                            return Math.abs(item.values.value);
                        }
                        , "balloonFunction": function (item) {
                            return item.category + ": " + Math.abs(item.values.value) + "%";
                        }
  }]
                    , "categoryField": "Category"
                    , "categoryAxis": {
                        "gridPosition": "start"
                        , "gridAlpha": 0.2
                        , "axisAlpha": 0
                    }
                    , "valueAxes": [{
                        "gridAlpha": 0
                        , "stackType": "100%"
                        , "ignoreAxisWidth": true
                        , "labelFunction": function (value) {
                            return Math.abs(value) + '%';
                        }
                        , "guides": [{
                            "value": 0
                            , "lineAlpha": 0.2
    }]
  }]
                    , "balloon": {
                        "fixedPosition": true
                    }
                    , "chartCursor": {
                        "valueBalloonsEnabled": false
                        , "cursorAlpha": 0.05
                        , "fullWidth": true
                    }
                    , "allLabels": [{
                        "text": "Your Hotel"
                        , "x": "28%"
                        , "y": "0%"
                        , "bold": true
                        , "align": "middle"
  }, {
                        "text": "Your Competitor"
                        , "x": "75%"
                        , "y": "0%"
                        , "bold": true
                        , "align": "middle"
  }]
                    , "export": {
                        "enabled": false
                    }
                });
            </script>
            <script>
                var chart = AmCharts.makeChart("chartCompetitionReview2", {
                    "type": "serial"
                    , "theme": "dark"
                    , "categoryField": "OTA"
                    , "rotate": true
                    , "marginBottom": 50
                    , "startDuration": 1
                    , "categoryAxis": {
                        "gridPosition": "start"
                        , "position": "left"
                    }
                    , "trendLines": []
                    , "graphs": [
                        {
                            "balloonText": "Your Hotel:[[value]]"
                            , "fillAlphas": 0.8
                            , "id": "AmGraph-1"
                            , "lineAlpha": 0.2
                            , "title": "YourHotel"
                            , "labelText": "[[value]]"
                            , "type": "column"
                            , "valueField": "YourHotel"
		}
                        , {
                            "balloonText": "Your Competitor:[[value]]"
                            , "fillAlphas": 0.8
                            , "id": "AmGraph-2"
                            , "lineAlpha": 0.2
                            , "title": "YourCompetitor"
                            , "labelText": "[[value]]"
                            , "type": "column"
                            , "valueField": "YourCompetitor"
		}
	]
                    , "guides": []
                    , "valueAxes": [
                        {
                            "id": "ValueAxis-1"
                            , "position": "bottom"
                            , "axisAlpha": 0
                            , "minimum": 0
		}
	]
                    , "allLabels": [{
                        "text": "Score"
                        , "x": "50%"
                        , "y": "0%"
                        , "bold": true
                        , "align": "middle"
  }]
                    , "balloon": {}
                    , "titles": []
                    , "dataProvider": <?php print json_encode( $rowScoreCompetitor); ?>
                    , "export": {
                        "enabled": true
                    }
                });
            </script>
            <!-- ################################################ POLAR CHART CONFIGURATION #########################################################-->
            <script>
                var chart = AmCharts.makeChart("polarChartPositive", {
                    "type": "radar"
                    , "theme": "dark"
                    , "legend": {
                        "horizontalGap": 0
                        , "maxColumns": 1
                        , "position": "right"
                        , "useGraphSettings": true
                        , "markerSize": 10
                    }
                    , "dataProvider": <?php print json_encode($rowPolarChartPositive); ?>
                    , "startDuration": 2
                    , "graphs": [{
                            "balloonText": "[[value]]%"
                            , "bullet": "round"
                            , "title": "Your Hotel"
                            , "lineThickness": 2
                            , "valueField": "YourHotelP"
  }, {
                            "balloonText": "[[value]]%"
                            , "bullet": "round"
                            , "title": "Your Competitor"
                            , "lineThickness": 2
                            , "valueField": "YourCompetitorP"
  }
  ]
                    , "categoryField": "Category"
                    , "export": {
                        "enabled": true
                    }
                });
            </script>
            <script>
                var chart = AmCharts.makeChart("polarChartNegative", {
                    "type": "radar"
                    , "theme": "dark"
                    , "legend": {
                        "horizontalGap": 0
                        , "maxColumns": 1
                        , "position": "right"
                        , "useGraphSettings": true
                        , "markerSize": 10
                    }
                    , "dataProvider": <?php print json_encode($rowPolarChartNegative); ?>
                    , "startDuration": 2
                    , "graphs": [{
                            "balloonText": "[[value]]%"
                            , "bullet": "round"
                            , "title": "Your Hotel"
                            , "lineThickness": 2
                            , "lineColor": "#FFD769"
                            , "valueField": "YourHotelN"
  }, {
                            "balloonText": "[[value]]%"
                            , "bullet": "round"
                            , "title": "Your Competitor"
                            , "lineThickness": 2
                            , "lineColor": "#f35857"
                            , "valueField": "YourCompetitorN"
  }
  ]
                    , "categoryField": "Category"
                    , "export": {
                        "enabled": true
                    }
                });
            </script>
            <!-- Script Dropdown Filter -->
            <script>
                // Roshan's Ajax dropdown code with php
                // This notice must stay intact for legal use
                // Copyright reserved to Roshan Bhattarai - nepaliboy007@yahoo.com
                // If you have any problem contact me at http://roshanbh.com.np
                function getXMLHTTP() { //fuction to return the xml http object
                    var xmlhttp = false;
                    try {
                        xmlhttp = new XMLHttpRequest();
                    }
                    catch (e) {
                        try {
                            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                        catch (e) {
                            try {
                                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                            }
                            catch (e1) {
                                xmlhttp = false;
                            }
                        }
                    }
                    return xmlhttp;
                }

                function getState(countryId) {
                    var strURL = "../modul/90/findState.php?country=" + countryId;
                    var req = getXMLHTTP();
                    if (req) {
                        req.onreadystatechange = function () {
                            if (req.readyState == 4) {
                                // only if "OK"
                                if (req.status == 200) {
                                    document.getElementById('statediv').innerHTML = req.responseText;
                                }
                                else {
                                    alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                                }
                            }
                        }
                        req.open("GET", strURL, true);
                        req.send(null);
                    }
                }

                function getCity(countryId, stateId) {
                    var strURL = "../modul/90/findCity.php?country=" + countryId + "&state=" + stateId;
                    var req = getXMLHTTP();
                    if (req) {
                        req.onreadystatechange = function () {
                            if (req.readyState == 4) {
                                // only if "OK"
                                if (req.status == 200) {
                                    document.getElementById('citydiv').innerHTML = req.responseText;
                                }
                                else {
                                    alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                                }
                            }
                        }
                        req.open("GET", strURL, true);
                        req.send(null);
                    }
                }
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
