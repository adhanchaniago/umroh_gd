  <?php
@require('../config/wiwe360-config.php'); //Load DB(mysql) config parameter
session_start();
$Hotel = $_SESSION['Hotel'];

$queryScoreAgoda = "SELECT * FROM KPIScore WHERE Hotel like '$Hotel%' and OTA = 'Agoda'";
$resultScoreAgoda = mysql_query($queryScoreAgoda,$Link) or die (mysql_error($Link));
$rowScoreAgoda = mysql_fetch_assoc($resultScoreAgoda);
$marginScoreAgoda = $rowScoreAgoda['Score'] / 10 * 100;

$queryScoreBooking= "SELECT * FROM KPIScore WHERE Hotel like '$Hotel%' and OTA = 'Booking'";
$resultScoreBooking = mysql_query($queryScoreBooking,$Link) or die (mysql_error($Link));
$rowScoreBooking = mysql_fetch_assoc($resultScoreBooking);
$marginScoreBooking = $rowScoreBooking['Score'] / 10 * 100;

$queryScoreTrip= "SELECT * FROM KPIScore WHERE Hotel like '$Hotel%' and OTA = 'TripAdvisor'";
$resultScoreTrip = mysql_query($queryScoreTrip,$Link) or die (mysql_error($Link));
$rowScoreTrip = mysql_fetch_assoc($resultScoreTrip);
$marginScoreTrip = $rowScoreTrip['Score'] / 5 * 100 ;

$queryCloudTag = "SELECT text, size * 10 as size FROM KPICloudTag WHERE HotelName = '$Hotel' and Period ='30 Days'";
$resultQueryCloudTag = mysql_query($queryCloudTag,$Link) or die (mysql_error($Link));
$rowCloudTag = array();
while ($r = mysql_fetch_assoc($resultQueryCloudTag))
{
    $rowCloudTag[] = $r;
}

$queryCloudTag2 = "SELECT text, size * 10 as size FROM KPICloudTag WHERE HotelName = '$Hotel' and Period ='Current Year'";
$resultQueryCloudTag2 = mysql_query($queryCloudTag2,$Link) or die (mysql_error($Link));
$rowCloudTag2 = array();
while ($r = mysql_fetch_assoc($resultQueryCloudTag2))
{
    $rowCloudTag2[] = $r;
}

$queryCloudTag3 = "SELECT text, size * 10 as size FROM KPICloudTag WHERE HotelName = '$Hotel' and Period ='Last Year'";
$resultQueryCloudTag3 = mysql_query($queryCloudTag3,$Link) or die (mysql_error($Link));
$rowCloudTag3 = array();
while ($r = mysql_fetch_assoc($resultQueryCloudTag3))
{
    $rowCloudTag3[] = $r;
}

$queryCategoryBar = "SELECT Category, Positive, Neutral, Negative FROM KPICategory WHERE HotelName = '$Hotel' and Period = '30 Days' ";
$resultCategoryBar = mysql_query ($queryCategoryBar,$Link) or die (mysql_error($Link));
$rowCategoryBar = array();
while ($r = mysql_fetch_assoc($resultCategoryBar))
{
    $rowCategoryBar[] = $r;
}

$queryCategoryBarCurrentYear = "SELECT Category, Positive, Neutral, Negative FROM KPICategory WHERE HotelName = '$Hotel' and Period ='Current Year'";
$resultCategoryBarCurrentYear = mysql_query ($queryCategoryBarCurrentYear,$Link) or die (mysql_error($Link));
$rowCategoryBarCurrentYear = array();
while($r = mysql_fetch_assoc($resultCategoryBarCurrentYear))
{
    $rowCategoryBarCurrentYear[] = $r;
}

$queryCategoryBarLastYear = "SELECT Category, Positive, Neutral, Negative FROM KPICategory WHERE HotelName = '$Hotel' and Period ='Past Year'";
$resultCategoryBarLastYear = mysql_query ($queryCategoryBarLastYear,$Link) or die (mysql_error($Link));
$rowCategoryBarLastYear = array();
while($r = mysql_fetch_assoc($resultCategoryBarLastYear))
{
    $rowCategoryBarLastYear[]=$r;
}

$queryRevCountry = "SELECT `Country`, sum(`Total`) as 'Total' FROM `KPIRevCountry` where `Period` = '30 Days' and `Hotel` = '$Hotel' group by `Country` order by case when (`Country` = 'Others') then 100 else `rank` end ASC";
$resultRevCountry = mysql_query ($queryRevCountry,$Link) or die (mysql_error($Link));
$rowRevCountry = array();
while ($r = mysql_fetch_assoc($resultRevCountry))
{
    $rowRevCountry[] = $r;
}

$queryRevCountryCurrentYear = "SELECT `Country`, sum(`Total`) as `Total` FROM KPIRevCountry WHERE Period ='Current Year' and Hotel ='$Hotel' group by `Country`order by case when (`Country` = 'Others') then 100 else `rank` end ASC";
$resultRevCountryCurrentYear = mysql_query($queryRevCountryCurrentYear,$Link) or die (mysql_error($Link));
$rowRevCountryCurrentYear = array();
while ($r = mysql_fetch_assoc($resultRevCountryCurrentYear))
{
    $rowRevCountryCurrentYear[] = $r;
}

$queryRevCountryLastYear = "SELECT `Country`, sum(`Total`) as `Total` FROM KPIRevCountry WHERE Period ='Last Year' and Hotel ='$Hotel' group by `Country`order by case when (`Country` = 'Others') then 100 else `rank` end ASC";
$resultRevCountryLastYear = mysql_query($queryRevCountryLastYear,$Link) or die (mysql_error($Link));
$rowRevCountryLastYear = array();
while ($r = mysql_fetch_assoc($resultRevCountryLastYear))
{
    $rowRevCountryLastYear[] = $r;
}

$queryTotalReviewer = "SELECT `Series` , `TripAdvisor`, `Agoda`, `Booking` FROM KPIReviewer WHERE HotelName = '$Hotel' and Period = '30 Days' order by Date asc";
$resultTotalReviewer = mysql_query($queryTotalReviewer, $Link) or die (mysql_error($Link));
$rowTotalReviewer = array();
while ($r = mysql_fetch_assoc($resultTotalReviewer))
{
    $rowTotalReviewer[] = $r;
}

$queryTotalReviewerCurrentYear = "SELECT `Series` ,`TripAdvisor`,`Agoda`,`Booking` FROM `KPIReviewer` where `HotelName` = '$Hotel' and `Period` = 'Current Year' order by cast(mid(`Series`,4,2) as UNSIGNED) ASC";
$resultTotalReviewerCurrentYear = mysql_query($queryTotalReviewerCurrentYear,$Link) or die (mysql_error($Link));
$rowTotalReviewerCurrentYear = array();
while ($r = mysql_fetch_assoc($resultTotalReviewerCurrentYear))
{
    $rowTotalReviewerCurrentYear[] = $r;
}

$queryTotalReviewerLastYear = "SELECT `Series` ,`TripAdvisor`,`Agoda`,`Booking` FROM `KPIReviewer` where `HotelName` = '$Hotel' and `Period` = 'Last Year' order by cast(mid(`Series`,4,2) as UNSIGNED) ASC";
$resultTotalReviewerLastYear = mysql_query($queryTotalReviewerLastYear,$Link) or die (mysql_error($Link));
$rowTotalReviewerLastYear = array();
while ($r = mysql_fetch_assoc($resultTotalReviewerLastYear))
{
    $rowTotalReviewerLastYear[] = $r;
}

        $rangeValue = $_GET["uid"];

        if ($rangeValue == 1){
            $rangeId = '2';
        }

        else if ($rangeValue == 2)
        {
            $rangeId = '5';
        }
        else if ($rangeValue == 3){
            $rangeId = '10';
        }

        else if ($rangeValue == 4){
            $rangeId = '100';
        }

        else if ($rangeValue == 5){
            $rangeId = "1000";
        }


$queryProvince ="select distinct Province as Province from DIMHotelRadius where HotelDestination = '$Hotel'" ;
$resultProvince = mysql_query($queryProvince,$Link) or die (mysql_error($Link));
$Province = mysql_fetch_assoc($resultProvince);

$queryRankingHotel30Days = "Select X.HotelDestination, X.rank, X.Positive
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
                            Where A.HotelOrigin = '$Hotel' AND (B.Period = '30 Days' or B.Period is null) AND (A.Radius <= '$rangeId') and StarRating = (select distinct StarRating from DIMHotelRadius where HotelDestination = '$Hotel')
							group by A.HotelOrigin, A.HotelDestination
							order by Positive DESC, TotalSentiment DESC
							) s,(SELECT @curRank := 0) r ) X
							Where X.HotelDestination = '$Hotel'";
$resultRankingHotel30Days = mysql_query($queryRankingHotel30Days,$Link) or die (mysql_error($Link));
$rowRankingHotel30Days = mysql_fetch_assoc($resultRankingHotel30Days);

$queryRankingHotelCurrentYear = "Select X.HotelDestination, X.rank, X.Positive
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
                            Where A.HotelOrigin = '$Hotel' AND (B.Period = 'Current Year' or B.Period is null) AND (A.Radius <= '$rangeId') and StarRating = (select distinct StarRating from DIMHotelRadius where HotelDestination = '$Hotel')
							group by A.HotelOrigin, A.HotelDestination
							order by Positive DESC, TotalSentiment DESC
							) s,(SELECT @curRank := 0) r ) X
							Where X.HotelDestination = '$Hotel'";
$resultRankingHotelCurrentYear = mysql_query($queryRankingHotelCurrentYear,$Link) or die (mysql_error($Link));
$rowRankingHotelCurrentYear = mysql_fetch_assoc($resultRankingHotelCurrentYear);


$queryRankingHotelLastYear = "Select X.HotelDestination, X.rank, X.Positive
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
                            Where A.HotelOrigin = '$Hotel' AND (B.Period = 'Past Year' or B.Period is null) AND (A.Radius <= '$rangeId') and StarRating = (select distinct StarRating from DIMHotelRadius where HotelDestination = '$Hotel')
							group by A.HotelOrigin, A.HotelDestination
							order by Positive DESC, TotalSentiment DESC
							) s,(SELECT @curRank := 0) r ) X
							Where X.HotelDestination = '$Hotel'";
$resultRankingHotelLastYear = mysql_query($queryRankingHotelLastYear,$Link) or die (mysql_error($Link));
$rowRankingHotelLastYear = mysql_fetch_assoc($resultRankingHotelLastYear);

$queryTotalHotel30Days = "SELECT  count(*) as Total from (
							Select distinct HotelOrigin, HotelDestination
                            FROM DIMHotelRadius
							Where HotelOrigin = '$Hotel' and Radius <= '$rangeId' and StarRating = (select distinct StarRating from DIMHotelRadius where HotelDestination = '$Hotel')
							group by HotelOrigin, HotelDestination) A";
$resultTotalHotel30Days = mysql_query($queryTotalHotel30Days,$Link) or die (mysql_error($Link));
$rowTotalHotel30Days = mysql_fetch_assoc($resultTotalHotel30Days);

$queryTotalHotelCurrentYear = "SELECT  count(*) as Total from (
							Select distinct HotelOrigin, HotelDestination
                            FROM DIMHotelRadius
							Where HotelOrigin = '$Hotel' and Radius <= '$rangeId' and StarRating = (select distinct StarRating from DIMHotelRadius where HotelDestination = '$Hotel')
							group by HotelOrigin, HotelDestination) A";

$resultTotalHotelCurrentYear = mysql_query($queryTotalHotelCurrentYear, $Link) or die (mysql_error($Link));
$rowTotalHotelCurrentYear = mysql_fetch_assoc($resultTotalHotelCurrentYear);

$queryTotalHotelLastYear = "SELECT  count(*) as Total from (
							Select distinct HotelOrigin, HotelDestination
                            FROM DIMHotelRadius
							Where HotelOrigin = '$Hotel' and Radius <= '$rangeId' and StarRating = (select distinct StarRating from DIMHotelRadius where HotelDestination = '$Hotel')
							group by HotelOrigin, HotelDestination) A";
$resultTotalHotelLastYear = mysql_query($queryTotalHotelLastYear,$Link) or die (mysql_error($Link));
$rowTotalHotelLastYear = mysql_fetch_assoc($resultTotalHotelLastYear);

?>

<!DOCTYPE html>
<html>
<head>
  <title>WiWE 90 - Listeners</title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap-slider.css">
    <link rel="icon" sizes="192x192" href="../img/Icon.png"/>
    <!-- Glazzed & Bootstrap -->
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/main.min.css">
  <!-- Pixeden Icon Fonts -->
  <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-filled.css">
  <link rel="stylesheet" type="text/css" href="../css/pe-icon-7-stroke.css">
  <script src="../js/d3.min.js"></script>
  <script src="../js/d3.layout.cloud.js"></script>

<style>
            div.relativedropdown {
                position: relative;
                left: 500px;
            }

            #chartdiv30Days {
                width: 100%;
                height: 200px;
                font-size: 11px;
            }

            #chartdivCurrentYear {
                width: 100%;
                height: 200px;
                font-size: 11px;
            }

            #chartdivLastYear {
                width: 100%;
                height: 200px;
                font-size: 11px;
            }

             body {color: #fff; }
             #verticalBarChart30Days {
             width: 100%;
             height: 250px;
             }

            body {color: #fff; }
            #verticalBarChartCurrentYear {
            width: 100%;
            height: 250px;
            }

            body {color: #fff; }
            #verticalBarChartLastYear {
            width: 100%;
            height: 250px;
            }

            #pieChartCurrentYear {
            width       : 100%;
            height      : 500px;
            font-size   : 11px;
            }
        </style>
<style>
        .progressbar {
                background: rgba(184, 184, 184, 0.59);
                background: -webkit-linear-gradient(top, rgba(56, 56, 56, 0.34) 0%, rgba(184, 184, 184, 0.59) 100%);
                background: linear-gradient(to bottom, rgba(56, 56, 56, 0.34) 0%, rgba(184, 184, 184, 0.59) 100%);
                border: 1px solid rgba(56, 56, 56, 0.1);
                border-radius: 0px;
                height: 3px;
            }

            .progress-bar-custom {
                background: rgba(17, 255, 0, 1);
                background: -webkit-linear-gradient(top, rgba(67, 153, 25, 0.66) 0%, rgba(17, 255, 0, 1) 100%);
                background: linear-gradient(to bottom, rgba(67, 153, 25, 0.66) 0%, rgba(17, 255, 0, 1) 100%);
            }

            .newProgress-bar-custom {
                background: rgba(255, 255, 255, 0.6);
                background: -webkit-linear-gradient(top, rgba(90, 112, 100, 0.66) 0%, rgba(17, 100, 0, 1) 100%);
                background: linear-gradient(to bottom, rgba(255, 0, 0, 0.66) 0%, rgba(255, 0, 0, 1) 100%);
            }
    </style>


</head>
<body>
<div id="cloud" style="display: none"></div>

<script type="text/javascript">
    // First define your cloud data, using `text` and `size` properties:

var skillsToDraw = [
    { text: 'javascript', size: 40 }

];

// Next you need to use the layout script to calculate the placement, rotation and size of each word:

    var width = 600;
    var height = 500;
    var fill = d3.scale.category20();

    d3.layout.cloud()
        .size([width, height])
        .words(skillsToDraw)
        .rotate(function() {
            return ~~(Math.random() * 2) * 90;
        })
        .font("Helvetica")
        .fontSize(function(d) {
            return d.size;
        })
        .on("end", drawSkillCloud)
        .start();

// Finally implement `drawSkillCloud`, which performs the D3 drawing:

    // apply D3.js drawing API
    function drawSkillCloud(words) {
        d3.select("#cloud").append("svg")
            .attr("width", width)
            .attr("height", height)
            .append("g")
            .attr("transform", "translate(" + ~~(width / 2) + "," + ~~(height / 2) + ")")
            .selectAll("text")
            .data(words)
            .enter().append("text")
            .style("font-size", function(d) {
                return d.size + "px";
            })
            .style("-webkit-touch-callout", "none")
            .style("-webkit-user-select", "none")
            .style("-khtml-user-select", "none")
            .style("-moz-user-select", "none")
            .style("-ms-user-select", "none")
            .style("user-select", "none")
            .style("cursor", "default")
            .style("font-family", "Impact")
            .style("fill", function(d, i) {
                return fill(i);
            })
            .attr("text-anchor", "middle")
            .attr("transform", function(d) {
                return "translate(" + [d.x, d.y] + ")rotate(" + d.rotate + ")";
            })
            .text(function(d) {
                return d.text;
            });
    }

// optional: set the viewbox to content bounding box (zooming in on the content, effectively trimming whitespace)

    var svg = document.getElementsByTagName("svg")[0];
    var bbox = svg.getBBox();
    var viewBox = [bbox.x, bbox.y, bbox.width, bbox.height].join(" ");
    svg.setAttribute("viewBox", viewBox);


</script>


  <div id="loading">
    <div class="loader loader-light loader-large"></div>
  </div>
  <!-- Calling Top Bar & Side Bar -->
  <?php include "menu.php"; ?>

  <!-- Content -->

<!-- Content -->

            <section class="content">

                <header class="main-header">
                    <div class="main-header__nav">
                        <h1 class="main-header__title">
                     <i class="pe-7s-notebook"></i>
                    <span>Customer Folio</span>
                  </h1>
                     <ul class="main-header__breadcrumb">
                        </ul>
                    </div>

                    <div class="main-header__date">

                      <div class ="row">

                      <div class = "col-md-offset-4">
                            <input id="Slider" name ="Slider" onchange="myFunction()" type="text"  data-provide="slider"  data-slider-ticks="[1, 2, 3, 4, 5]" data-slider-ticks-labels='["2 Km", "5 Km", "10 Km", "<?php echo $Province['Province']; ?>", "Indonesia"]' data-slider-min="1" data-slider-max="5" data-slider-step="1" data-slider-value="<?php echo $rangeValue ?>" data-slider-tooltip="hide" />

                            <script>
                                function myFunction() {
                                var x = document.getElementById("Slider").value;
                                window.location.href="main.php?page=SalesCustFolio&uid=" + x ;
                                }
                            </script>
                        </div>
                        </div><br><br>
                        <div class ="row">
                        <input type="radio" id="radio_date_1" name="tab-radio" value="30Days" >
                    <label class="fixed-width" for="radio_date_1"><font size="3">30 Days</font></label>
                    <input type="radio" id="radio_date_2" name="tab-radio" value="CurrentYear" checked>
                    <label class="fixed-width" for="radio_date_2"><font size="3">Current Year</font></label>
                    <input type="radio" id="radio_date_3" name="tab-radio" value="PastYear">
                    <label class="fixed-width" for="radio_date_3"><font size="3">Past Year</font></label>
                    </div>
                  </div>
                    <br>
                    <br>
                    <br>
                    <br>

                </header>
                <!-- /main-header -->

                   <div data-tab-radio="tab-radio" class="tab-radio-content" id="30Days">
                     <h2 text-align :"left" size :"50px"> Rangking # </h2>
                    <div class="row">
                        <div class="col-md-3">
                            <article class="widget">
                                <div class="widget__content widget__grid filled pad20" style="height: 150px">
                                    <font size="4">Ranking</font>
                                    <br>
                                    <br>
                                    <font size="6"><strong style="font-weight: bold;"> #<?php echo $rowRankingHotel30Days['rank'] ?></strong></font>
                                    <br>
                                    <br>

                                    <div class="progressbar">
                                        <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width: 100%; padding-left: 0; padding-right: 0; padding-top: 5;">
                                        </div>
                                    </div>
                                    <br>
                                    <font size="3"><strong style="font-weight: bold;"> <?php echo $rowTotalHotel30Days['Total'] ?></strong> &nbsp Total Hotels</font>
                                </div>
                            </article>
                        </div>

                        <div class="col-md-3">
                            <article class="widget" style="background :'../img/booking.png'">
                                <div class="widget__content widget__grid filled pad20" style="height: 150px; background:'../img/booking.png'">
                                    <img src="../img/trip.png" width="200px">
                                    <br>
                                    <font size="6"><strong style="font-weight: bold;"> <?php echo $rowScoreTrip['Score'] ?></strong></font>
                                    <br>
                                    <br>
                                    <div class="progressbar">
                                        <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="<?php $marginScoreTrip ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $marginScoreTrip   ?>%; padding-left: 0; padding-right: 0; padding-top: 5;">
                                        </div>
                                    </div>
                                    <br>
                                    <font size="3"><strong style="font-weight: bold;"> <?php echo $rowScoreTrip['TotalReviewer'] ?></strong> Total Reviewers</font>
                            </article>
                            </div>

                            <div class="col-md-3">
                                <article class="widget">
                                    <div class="widget__content widget__grid filled pad20" style="height: 150px">
                                        <img src="../img/booking.png" width="190px">

                                        <br>
                                        <font size="6"><strong style="font-weight: bold;"> &nbsp <?php echo $rowScoreBooking['Score'] ?> </strong></font>
                                        <br>
                                        <br>

                                        <div class="progressbar">
                                            <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="<?php echo $marginScoreBooking ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $marginScoreBooking ?>%; padding-left: 0; padding-right: 0; padding-top: 5;">
                                            </div>
                                        </div>
                                        <br>
                                        <font size="3"> <strong style="font-weight: bold;"> <?php echo $rowScoreBooking['TotalReviewer'] ?> </strong> Total Reviewers </font>
                                </article>
                                </div>

                                <div class="col-md-3">
                                    <article class="widget">
                                        <div class="widget__content widget__grid filled pad20" style="height: 150px">
                                            <img src="../img/agoda.png" width="180px" style="margin-top:0">

                                            <br>
                                            <font size="6"><strong style="font-weight: bold;"> &nbsp <?php echo $rowScoreAgoda['Score'] ?> </strong></font>
                                            <br>
                                            <br>

                                            <div class="progressbar">
                                                <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="<?php echo $marginScoreAgoda ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $marginScoreAgoda ?>%; padding-left: 0; padding-right: 0; padding-top: 5;">
                                                </div>
                                            </div>
                                            <br>
                                            <font size="3"> <strong style="font-weight: bold;">  <?php echo $rowScoreAgoda['TotalReviewer'] ?></strong> Total Reviewer </font>
                                    </article>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <article class="widget">
                                            <div class="widget__content widget__grid filled pad20">
                                                <div id="chartdiv30Days"></div>
                                            </div>
                                            <!-- /widget__content -->
                                        </article>
                                        <!-- /widget -->
                                    </div>
                                    <div class="col-md-6">
                                        <article class="widget">
                                            <div class="widget__content widget__grid filled pad20">
                                                <div id="CloudTag">

                                                     <script>
                                                    var skillsToDraw =<?php print json_encode($rowCloudTag); ?>;
                                                    // Next you need to use the layout script to calculate the placement, rotation and size of each word:
                                                    var width = 500;
                                                    var height = 200;
                                                    var fill = d3.scale.category20();

                                                    d3.layout.cloud()
                                                        .size([width, height])
                                                        .words(skillsToDraw)
                                                        .rotate(function () {
                                                            return ~~(Math.random() * 2) * 90;
                                                        })
                                                        .font("Helvetica")
                                                        .fontSize(function (d) {
                                                            return d.size;
                                                        })
                                                        .on("end", drawSkillCloud)
                                                        .start();

                                                    // Finally implement `drawSkillCloud`, which performs the D3 drawing:
                                                    // apply D3.js drawing API
                                                    function drawSkillCloud(words) {
                                                        d3.select("#CloudTag").append("svg")
                                                            .attr("width", width)
                                                            .attr("height", height)
                                                            .append("g")
                                                            .attr("transform", "translate(" + ~~(width / 2) + "," + ~~(height / 2) + ")")
                                                            .selectAll("text")
                                                            .data(words)
                                                            .enter().append("text")
                                                            .style("font-size", function (d) {
                                                                return d.size + "px";
                                                            })
                                                            .style("-webkit-touch-callout", "none")
                                                            .style("-webkit-user-select", "none")
                                                            .style("-khtml-user-select", "none")
                                                            .style("-moz-user-select", "none")
                                                            .style("-ms-user-select", "none")
                                                            .style("user-select", "none")
                                                            .style("cursor", "default")
                                                            .style("font-family", "Impact")
                                                            .style("fill", function (d, i) {
                                                                return fill(i);
                                                            })
                                                            .attr("text-anchor", "middle")
                                                            .attr("transform", function (d) {
                                                                return "translate(" + [d.x, d.y] + ")rotate(" + d.rotate + ")";
                                                            })
                                                            .text(function (d) {
                                                                return d.text;
                                                            });
                                                    }

                                                    // optional: set the viewbox to content bounding box (zooming in on the content, effectively trimming whitespace)

                                                    var svg = document.getElementsByTagName("svg")[0];
                                                    var bbox = svg.getBBox();
                                                    var viewBox = [bbox.x, bbox.y, bbox.width, bbox.height].join(" ");
                                                    svg.setAttribute("viewBox", viewBox);
                                                    </script>
                                                </div>
                                            </div>
                                            <!-- /widget__content -->
                                        </article>
                                        <!-- /widget -->
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <article class="widget">
                                            <header class="widget__header">
                                                <div class="widget__title">
                                                    <i class=""></i>
                                                    <h3>Country Reviewer</h3>
                                                </div>
                                                <div class="widget__config">
                                                    <a href="#"><i class=""></i></a>
                                                    <a href="#"><i class="pe-7s-graph"></i></a>
                                                </div>
                                            </header>

                                            <div class="widget__content filled widget-ui">
                                                <div id="pieChart30Days" style="width: 100%; height: 362px;"></div>
                                            </div>
                                            <!-- /widget__content -->
                                        </article>
                                        <!-- /widget -->
                                    </div>

                                    <div class="col-md-6">
                                        <article class="widget">
                                            <header class="widget__header">
                                                <div class="widget__title">
                                                    <i class=""></i>
                                                    <h3>Number of Reviewer</h3>
                                                </div>
                                                <div class="widget__config">
                                                   <a href="#"><i class=""></i></a>
                                                    <a href="#"><i class="pe-7f-graph3"></i></a>
                                                </div>
                                            </header>

                                            <div class="widget__content filled">
                                                <div id="verticalBarChart30Days" style="width: 100%; height: 362px;"></div>

                                            </div>
                                        </article>
                                        <!-- /widget -->
                                    </div>

                                </div>

                            </div>
                <!-- CURRENT YEAR CONTENT -->

                    <div data-tab-radio="tab-radio" class="tab-radio-content row" id="CurrentYear">

                        <div class="row">
                            <div class="col-md-3">
                            <article class="widget">
                                <div class="widget__content widget__grid filled pad20" style="height: 150px">
                                    <font size="4">Ranking</font>
                                    <br>
                                    <br>
                                    <font size="6"><strong style="font-weight: bold;"> #<?php echo $rowRankingHotelCurrentYear['rank'] ?></strong></font>
                                    <br>
                                    <br>

                                    <div class="progressbar">
                                        <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width: 100%; padding-left: 0; padding-right: 0; padding-top: 5;">
                                        </div>
                                    </div>
                                    <br>
                                    <font size="3"><strong style="font-weight: bold;"> <?php echo $rowTotalHotelCurrentYear['Total'] ?> </strong> &nbsp Total Hotels</font>
                                </div>
                            </article>
                        </div>

                        <div class="col-md-3">
                            <article class="widget" style="background :'../img/booking.png'">
                                <div class="widget__content widget__grid filled pad20" style="height: 150px; background:'../img/booking.png'">
                                    <img src="../img/trip.png" width="200px">
                                    <br>
                                    <font size="6"><strong style="font-weight: bold;"> <?php echo $rowScoreTrip['Score'] ?></strong></font>
                                    <br>
                                    <br>
                                    <div class="progressbar">
                                        <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $marginScoreTrip ?>%; padding-left: 0; padding-right: 0; padding-top: 5;">
                                        </div>
                                    </div>
                                    <br>
                                    <font size="3"><strong style="font-weight: bold;"> <?php echo $rowScoreTrip['TotalReviewer'] ?></strong> Total Reviewers</font>
                            </article>
                            </div>

                            <div class="col-md-3">
                                <article class="widget">
                                    <div class="widget__content widget__grid filled pad20" style="height: 150px">
                                        <img src="../img/booking.png" width="190px">

                                        <br>
                                        <font size="6"><strong style="font-weight: bold;"> &nbsp <?php echo $rowScoreBooking['Score'] ?> </strong></font>
                                        <br>
                                        <br>

                                        <div class="progressbar">
                                            <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $marginScoreBooking ?>%; padding-left: 0; padding-right: 0; padding-top: 5;">
                                            </div>
                                        </div>
                                        <br>
                                        <font size="3"> <strong style="font-weight: bold;"> <?php echo $rowScoreBooking['TotalReviewer'] ?> </strong> Total Reviewers </font>
                                </article>
                                </div>

                                <div class="col-md-3">
                                    <article class="widget">
                                        <div class="widget__content widget__grid filled pad20" style="height: 150px">
                                            <img src="../img/agoda.png" width="180px" style="margin-top:0">

                                            <br>
                                            <font size="6"><strong style="font-weight: bold;"> &nbsp <?php echo $rowScoreAgoda['Score'] ?> </strong></font>
                                            <br>
                                            <br>

                                            <div class="progressbar">
                                                <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $marginScoreAgoda ?>%; padding-left: 0; padding-right: 0; padding-top: 5;">
                                                </div>
                                            </div>
                                            <br>
                                            <font size="3"> <strong style="font-weight: bold;">  <?php echo $rowScoreAgoda['TotalReviewer'] ?></strong> Total Reviewer </font>
                                    </article>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <article class="widget">
                                            <div class="widget__content widget__grid filled pad20">
                                                <div id="chartdivCurrentYear"></div>
                                            </div>
                                            <!-- /widget__content -->
                                        </article>
                                        <!-- /widget -->
                                    </div>
                                    <div class="col-md-6">
                                        <article class="widget">
                                            <div class="widget__content widget__grid filled pad20">
                                                <div id="cloudCurrentYear">

                                                    <script>
                                                    var skillsToDraw =<?php print json_encode($rowCloudTag2); ?>;
                                                    // Next you need to use the layout script to calculate the placement, rotation and size of each word:
                                                    var width = 500;
                                                    var height = 200;
                                                    var fill = d3.scale.category20();

                                                    d3.layout.cloud()
                                                        .size([width, height])
                                                        .words(skillsToDraw)
                                                        .rotate(function () {
                                                            return ~~(Math.random() * 2) * 90;
                                                        })
                                                        .font("Helvetica")
                                                        .fontSize(function (d) {
                                                            return d.size;
                                                        })
                                                        .on("end", drawSkillCloud)
                                                        .start();

                                                    // Finally implement `drawSkillCloud`, which performs the D3 drawing:
                                                    // apply D3.js drawing API
                                                    function drawSkillCloud(words) {
                                                        d3.select("#cloudCurrentYear").append("svg")
                                                            .attr("width", width)
                                                            .attr("height", height)
                                                            .append("g")
                                                            .attr("transform", "translate(" + ~~(width / 2) + "," + ~~(height / 2) + ")")
                                                            .selectAll("text")
                                                            .data(words)
                                                            .enter().append("text")
                                                            .style("font-size", function (d) {
                                                                return d.size + "px";
                                                            })
                                                            .style("-webkit-touch-callout", "none")
                                                            .style("-webkit-user-select", "none")
                                                            .style("-khtml-user-select", "none")
                                                            .style("-moz-user-select", "none")
                                                            .style("-ms-user-select", "none")
                                                            .style("user-select", "none")
                                                            .style("cursor", "default")
                                                            .style("font-family", "Impact")
                                                            .style("fill", function (d, i) {
                                                                return fill(i);
                                                            })
                                                            .attr("text-anchor", "middle")
                                                            .attr("transform", function (d) {
                                                                return "translate(" + [d.x, d.y] + ")rotate(" + d.rotate + ")";
                                                            })
                                                            .text(function (d) {
                                                                return d.text;
                                                            });
                                                    }

                                                    // optional: set the viewbox to content bounding box (zooming in on the content, effectively trimming whitespace)

                                                    var svg = document.getElementsByTagName("svg")[0];
                                                    var bbox = svg.getBBox();
                                                    var viewBox = [bbox.x, bbox.y, bbox.width, bbox.height].join(" ");
                                                    svg.setAttribute("viewBox", viewBox);
                                                    </script>
                                                </div>
                                            </div>
                                            <!-- /widget__content -->
                                        </article>
                                        <!-- /widget -->
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <article class="widget">
                                            <header class="widget__header">
                                                <div class="widget__title">
                                                    <i class=""></i>
                                                    <h3>Country Reviewer</h3>
                                                </div>
                                                <div class="widget__config">
                                                    <a href="#"><i class=""></i></a>
                                                    <a href="#"><i class="pe-7s-graph"></i></a>
                                                </div>
                                            </header>

                                                <div class="widget__content filled widget-ui">
                                                    <div id="pieChartCurrentYear" style="width: 100%; height: 362px;"></div>
                                                </div>
                                            </article>
                                            <!-- /widget -->
                                    </div>
                                     <!-- /widget__content -->

                                    <div class="col-md-6">
                                        <article class="widget">
                                            <header class="widget__header">
                                                <div class="widget__title">
                                                    <i class=""></i>
                                                    <h3>Number of Reviewer by Week</h3>
                                                </div>
                                                <div class="widget__config">
                                                   <a href="#"><i class=""></i></a>
                                                    <a href="#"><i class="pe-7f-graph3"></i></a>
                                                </div>
                                            </header>

                                            <div class="widget__content filled">
                                                <div id="verticalBarChartCurrentYear" style="width: 100%; height: 362px;"></div>
                                            </div>
                                        </article>
                                        <!-- /widget -->
                                    </div>
                                    </div>

                                </div>

                <!-- lAST YEAR TAB CONTENT -->
                        <div data-tab-radio="tab-radio" class="tab-radio-content row" id="PastYear">
                            <div class="row">
                                <div class="col-md-3">
                            <article class="widget">
                                <div class="widget__content widget__grid filled pad20" style="height: 150px">
                                    <font size="4">Ranking</font>
                                    <br>
                                    <br>
                                    <font size="6"><strong style="font-weight: bold;"> #<?php echo $rowRankingHotelLastYear['rank'] ?></strong></font>
                                    <br>
                                    <br>

                                    <div class="progressbar">
                                        <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width: 100%; padding-left: 0; padding-right: 0; padding-top: 5;">
                                        </div>
                                    </div>
                                    <br>
                                    <font size="3"><strong style="font-weight: bold;"> <?php echo $rowTotalHotelLastYear['Total'] ?></strong> &nbsp Total Hotels</font>
                                </div>
                            </article>
                        </div>

                        <div class="col-md-3">
                            <article class="widget" style="background :'../img/booking.png'">
                                <div class="widget__content widget__grid filled pad20" style="height: 150px; background:'../img/booking.png'">
                                    <img src="../img/trip.png" width="200px">
                                    <br>
                                    <font size="6"><strong style="font-weight: bold;"> <?php echo $rowScoreTrip['Score'] ?></strong></font>
                                    <br>
                                    <br>
                                    <div class="progressbar">
                                        <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $marginScoreTrip ?>%; padding-left: 0; padding-right: 0; padding-top: 5;">
                                        </div>
                                    </div>
                                    <br>
                                    <font size="3"><strong style="font-weight: bold;"> <?php echo $rowScoreTrip['TotalReviewer'] ?></strong> Total Reviewers</font>
                            </article>
                            </div>

                            <div class="col-md-3">
                                <article class="widget">
                                    <div class="widget__content widget__grid filled pad20" style="height: 150px">
                                        <img src="../img/booking.png" width="190px">

                                        <br>
                                        <font size="6"><strong style="font-weight: bold;"> &nbsp <?php echo $rowScoreBooking['Score'] ?> </strong></font>
                                        <br>
                                        <br>

                                        <div class="progressbar">
                                            <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $marginScoreBooking ?>%; padding-left: 0; padding-right: 0; padding-top: 5;">
                                            </div>
                                        </div>
                                        <br>
                                        <font size="3"> <strong style="font-weight: bold;"> <?php echo $rowScoreBooking['TotalReviewer'] ?> </strong> Total Reviewers </font>
                                </article>
                                </div>

                                <div class="col-md-3">
                                    <article class="widget">
                                        <div class="widget__content widget__grid filled pad20" style="height: 150px">
                                            <img src="../img/agoda.png" width="180px" style="margin-top:0">

                                            <br>
                                            <font size="6"><strong style="font-weight: bold;"> &nbsp <?php echo $rowScoreAgoda['Score'] ?> </strong></font>
                                            <br>
                                            <br>

                                            <div class="progressbar">
                                                <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $marginScoreAgoda ?>%; padding-left: 0; padding-right: 0; padding-top: 5;">
                                                </div>
                                            </div>
                                            <br>
                                            <font size="3"> <strong style="font-weight: bold;">  <?php echo $rowScoreAgoda['TotalReviewer'] ?></strong> Total Reviewer </font>
                                    </article>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <article class="widget">
                                            <div class="widget__content widget__grid filled pad20">

                                                <div id="chartdivLastYear"></div>

                                            </div>
                                            <!-- /widget__content -->
                                        </article>
                                        <!-- /widget -->
                                    </div>
                                    <div class="col-md-6">
                                        <article class="widget">
                                            <div class="widget__content widget__grid filled pad20">

                                                <!-- INI MULAI TAG CLOUD -->
                                                 <div id='wordcloud'>
                                                    <script>
                                                    var skillsToDraw =<?php print json_encode($rowCloudTag3); ?>;
                                                    // Next you need to use the layout script to calculate the placement, rotation and size of each word:
                                                    var width = 500;
                                                    var height = 200;
                                                    var fill = d3.scale.category20();

                                                    d3.layout.cloud()
                                                        .size([width, height])
                                                        .words(skillsToDraw)
                                                        .rotate(function () {
                                                            return ~~(Math.random() * 2) * 90;
                                                        })
                                                        .font("Helvetica")
                                                        .fontSize(function (d) {
                                                            return d.size;
                                                        })
                                                        .on("end", drawSkillCloud)
                                                        .start();

                                                    // Finally implement `drawSkillCloud`, which performs the D3 drawing:
                                                    // apply D3.js drawing API
                                                    function drawSkillCloud(words) {
                                                        d3.select("#wordcloud").append("svg")
                                                            .attr("width", width)
                                                            .attr("height", height)
                                                            .append("g")
                                                            .attr("transform", "translate(" + ~~(width / 2) + "," + ~~(height / 2) + ")")
                                                            .selectAll("text")
                                                            .data(words)
                                                            .enter().append("text")
                                                            .style("font-size", function (d) {
                                                                return d.size + "px";
                                                            })
                                                            .style("-webkit-touch-callout", "none")
                                                            .style("-webkit-user-select", "none")
                                                            .style("-khtml-user-select", "none")
                                                            .style("-moz-user-select", "none")
                                                            .style("-ms-user-select", "none")
                                                            .style("user-select", "none")
                                                            .style("cursor", "default")
                                                            .style("font-family", "Impact")
                                                            .style("fill", function (d, i) {
                                                                return fill(i);
                                                            })
                                                            .attr("text-anchor", "middle")
                                                            .attr("transform", function (d) {
                                                                return "translate(" + [d.x, d.y] + ")rotate(" + d.rotate + ")";
                                                            })
                                                            .text(function (d) {
                                                                return d.text;
                                                            });
                                                    }

                                                    // optional: set the viewbox to content bounding box (zooming in on the content, effectively trimming whitespace)

                                                    var svg = document.getElementsByTagName("svg")[0];
                                                    var bbox = svg.getBBox();
                                                    var viewBox = [bbox.x, bbox.y, bbox.width, bbox.height].join(" ");
                                                    svg.setAttribute("viewBox", viewBox);

                                                    </script>


                                                 </div>
                                                <!-- AKHIR DARI TAG CLOUD -->

                                            </div>
                                            <!-- /widget__content -->
                                        </article>
                                        <!-- /widget -->
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <article class="widget">
                                            <header class="widget__header">
                                                <div class="widget__title">
                                                    <i class=""></i>
                                                    <h3>Country Reviewer</h3>
                                                </div>
                                                <div class="widget__config">
                                                   <a href="#"><i class=""></i></a>
                                                    <a href="#"><i class="pe-7s-graph"></i></a>
                                                </div>
                                            </header>

                                            <div class="widget__content filled widget-ui">

                                                <div class="row">
                                                    <div class="col-md-12 text-center">
                                                        <div id="pieChartLastYear" style="width: 100%; height: 362px;"></div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- /widget__content -->

                                        </article>
                                        <!-- /widget -->
                                    </div>
                                    <div class="col-md-6">
                                        <article class="widget">
                                           <header class="widget__header">
                                                <div class="widget__title">
                                                    <i class=""></i>
                                                    <h3>Number of Reviewer by Week</h3>
                                                </div>
                                                <div class="widget__config">
                                                   <a href="#"><i class=""></i></a>
                                                    <a href="#"><i class="pe-7f-graph3"></i></a>
                                                </div>
                                            </header>

                                            <div class="widget__content filled">
                                                <div id="verticalBarChartLastYear" style="width: 100%; height: 362px;"></div>
                                            </div>
                                        </article>
                                        <!-- /widget -->
                                    </div>

                                </div>
                            </div>



        <footer class="footer-brand">
            <?php include "footer.php"; ?>
        </footer>

          </section><!-- /content -->

            <script type="text/javascript" src="../js/main.js"></script>
            <!-- Loading -->
            <script type="text/javascript" src="../js/amcharts/amcharts.js"></script>
            <script type="text/javascript" src="../js/amcharts/serial.js"></script>
            <script type="text/javascript" src="../js/amcharts/pie.js"></script>
            <!--<script type="text/javascript" src="../js/amcharts/xy.js"></script> -->
            <script type="text/javascript" src="../js/amcharts/radar.js"></script>
            <script type="text/javascript" src="../js/bootstrap-slider.js"></script>
            <script type="text/javascript" src="../js/canvasjs/canvasjs.min.js"></script>
            <script type="text/javascript" src="../js/amcharts/newAmcharts.js"></script>
            <script src="https://www.amcharts.com/lib/3/serial.js"></script>
            <script src="https://www.amcharts.com/lib/3/pie.js"></script>
            <script src="http://d3js.org/d3.v3.min.js"></script>

            <script>
            var slider = new Slider("#ex6");
            slider.on("slide", function(sliderValue) {
            document.getElementById("ex6SliderVal").textContent = sliderValue;
            console.log(sliderValue);
            });
            </script>

<!-- ##################################################### SCRIPT FOR STACKED CATEGORY BAR ###################################################-->
            <script type="text/javascript">
                var chart = AmCharts.makeChart("chartdiv30Days", {
                    "type": "serial",
                      "marginBottom": 50,
                    "legend": {
                        "horizontalGap": 10,
                        "maxColumns": 1,
                        "position": "right",
                        "useGraphSettings": true,
                        "markerSize": 10,
                    },
                    "dataProvider": <?php print json_encode($rowCategoryBar); ?>
                    ,
                    "valueAxes": [{
                        "stackType": "100%",
                        "axisAlpha": 0.5,
                         "labelFunction" : function(value){
                        return Math.abs(value) + '%';
                        },
                        "gridAlpha": 0
    }],
                    "graphs": [{
                        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                        "fillAlphas": 0.8,
                        "labelText": "[[value]]",
                        "lineAlpha": 0.3,
                        "title": "Positive",
                        "type": "column",
                        "color": "#000000",
                        "valueField": "Positive"
    },{
                        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                        "fillAlphas": 0.8,
                        "labelText": "[[value]]",
                        "lineAlpha": 0.3,
                        "title": "Neutral",
                        "type": "column",
                        "color": "#000000",
                        "fillColors" :"#FFD769",
                        "valueField": "Neutral"
    },{
                        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                        "fillAlphas": 0.8,
                        "labelText": "[[value]]",
                        "lineAlpha": 0.3,
                        "title": "Negative",
                        "type": "column",
                        "color": "#000000",
                        "fillColors" : "#F35857",
                        "valueField": "Negative"
    }],
                    "rotate": true,
                    "categoryField": "Category",
                    "categoryAxis": {
                        "gridPosition": "start",
                        "axisAlpha": 0,
                        "gridAlpha": 0,
                        "position": "left"
                    },
                    "export": {
                        "enabled": false
                    }
                });


                var chart = AmCharts.makeChart("chartdivCurrentYear", {
                    "type": "serial",
                    "theme": "light",
                      "marginBottom": 50,
                    "legend": {
                        "horizontalGap": 10,
                        "maxColumns": 1,
                        "position": "right",
                        "useGraphSettings": true,
                        "markerSize": 10,
                    },
                    "dataProvider": <?php print json_encode($rowCategoryBarCurrentYear); ?>
                    ,
                    "valueAxes": [{
                        "stackType": "100%",
                        "axisAlpha": 0.5,
                         "labelFunction" : function(value){
                        return Math.abs(value) + '%';
                        },
                        "gridAlpha": 0
    }],
                    "graphs": [{
                        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                        "fillAlphas": 0.8,
                        "labelText": "[[value]]",
                        "lineAlpha": 0.3,
                        "title": "Positive",
                        "type": "column",
                        "color": "#000000",
                        "valueField": "Positive"
    },{
                        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                        "fillAlphas": 0.8,
                        "labelText": "[[value]]",
                        "lineAlpha": 0.3,
                        "title": "Neutral",
                        "type": "column",
                        "color": "#000000",
                        "fillColors" :"#FFD769",
                        "valueField": "Neutral"
    },{
                        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                        "fillAlphas": 0.8,
                        "labelText": "[[value]]",
                        "lineAlpha": 0.3,
                        "title": "Negative",
                        "type": "column",
                        "color": "#000000",
                        "fillColors" : "#F35857",
                        "valueField": "Negative"
    }],
                    "rotate": true,
                    "categoryField": "Category",
                    "categoryAxis": {
                        "gridPosition": "start",
                        "axisAlpha": 0,
                        "gridAlpha": 0,
                        "position": "left"
                    },
                    "export": {
                        "enabled": false
                    }
                });

                var chart = AmCharts.makeChart("chartdivLastYear", {
                    "type": "serial",
                    "theme": "light",
                      "marginBottom": 50,
                    "legend": {
                        "horizontalGap": 10,
                        "maxColumns": 1,
                        "position": "right",
                        "useGraphSettings": true,
                        "markerSize": 10,
                    },
                    "dataProvider": <?php print json_encode($rowCategoryBarLastYear); ?>
                    ,
                    "valueAxes": [{
                        "stackType": "100%",
                        "axisAlpha": 0.5,
                        "ignoreAxisWidth" : true,
                        "labelFunction" : function(value){
                        return Math.abs(value) + '%';
                        },
                        "gridAlpha": 0
    }],
                    "graphs": [{
                        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                        "fillAlphas": 0.8,
                        "labelText": "[[value]]",
                        "lineAlpha": 0.3,
                        "title": "Positive",
                        "type": "column",
                        "color": "#000000",
                        "valueField": "Positive"
    },{
                        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                        "fillAlphas": 0.8,
                        "labelText": "[[value]]",
                        "lineAlpha": 0.3,
                        "title": "Neutral",
                        "type": "column",
                        "color": "#000000",
                        "fillColors" :"#FFD769",
                        "valueField": "Neutral"
    },{
                        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                        "fillAlphas": 0.8,
                        "labelText": "[[value]]",
                        "lineAlpha": 0.3,
                        "title": "Negative",
                        "type": "column",
                        "color": "#000000",
                        "fillColors" : "#F35857",
                        "valueField": "Negative"
    }],
                    "rotate": true,
                    "categoryField": "Category",
                    "categoryAxis": {
                        "gridPosition": "start",
                        "axisAlpha": 0,
                        "gridAlpha": 0,
                        "position": "left"
                    },
                    "export": {
                        "enabled": false
                    }
                });
            </script>

<!-- ########################################### VERTICAL BAR CHART CONFIGURATION ############################################################### -->
        <script type="text/javascript">
        var chart = AmCharts.makeChart("verticalBarChart30Days", {
        "type": "serial",
        "theme": "light",
        "legend": {
            "horizontalGap": 0,
            "maxColumns": 4,
            "position": "bottom",
            "useGraphSettings": true,
            "markerSize": 10
        },
        "dataProvider":<?php print json_encode($rowTotalReviewer);?>
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
        "title": "TripAdvisor",
        "type": "column",
                "color": "transparent",
        "valueField": "TripAdvisor"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Agoda",
        "type": "column",
                "color": "transparent",
        "valueField": "Agoda"
    },{
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Booking",
        "type": "column",
                "color": "transparent",
        "valueField": "Booking"
    }],
        "categoryField": "Series",
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

var chart = AmCharts.makeChart("verticalBarChartCurrentYear", {
        "type": "serial",
        "theme": "light",
        "legend": {
            "horizontalGap": 0,
            "maxColumns": 4,
            "position": "bottom",
            "useGraphSettings": true,
            "markerSize": 10
        },
        "dataProvider":<?php print json_encode($rowTotalReviewerCurrentYear);?>
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
        "title": "TripAdvisor",
        "type": "column",
                "color": "transparent",
        "valueField": "TripAdvisor"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Agoda",
        "type": "column",
                "color": "transparent",
        "valueField": "Agoda"
    },{
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Booking",
        "type": "column",
                "color": "transparent",
        "valueField": "Booking"
    }],
        "categoryField": "Series",
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

var chart = AmCharts.makeChart("verticalBarChartLastYear", {
        "type": "serial",
        "theme": "light",
        "legend": {
            "horizontalGap": 0,
            "maxColumns": 4,
            "position": "bottom",
            "useGraphSettings": true,
            "markerSize": 10
        },
        "dataProvider":<?php print json_encode($rowTotalReviewerLastYear);?>
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
        "title": "TripAdvisor",
        "type": "column",
                "color": "transparent",
        "valueField": "TripAdvisor"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Agoda",
        "type": "column",
                "color": "transparent",
        "valueField": "Agoda"
    },{
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Booking",
        "type": "column",
                "color": "transparent",
        "valueField": "Booking"
    }],
        "categoryField": "Series",
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

<!-- ################################################## SCRIPT FOR PIE CHART CONFIGURATION ######################################################-->

        <script type="text/javascript">


        var chart = AmCharts.makeChart("pieChart30Days", {
        "type": "pie",
        "theme": "none",
        "legend" :
        {
        "markerType" : "square",
        "position" : "right",
        "markerSize" : 20,

        },
        "colors": ['#F35857'/*red*/,'#FFD769'/*Yellow*/,'#FF9C4B'/*Orange*/,'#989CFF'/*Purple*/],
        "dataProvider": <?php print json_encode($rowRevCountry); ?>,
        "titleField": "Country",
        "valueField": "Total",
        "labelRadius": 2,
        "color": "rgba(255,255,255,0)",
        "radius": "40%",
        "innerRadius": "60%",
        "labelText": "[[title]]"
        });

        var chart =  AmCharts.makeChart("pieChartLastYear", {
        "type": "pie",
        "theme": "none",
        "legend" :
        {
        "markerType" : "square",
        "position" : "right",
        "markerSize" : 20,


        },
        "colors": ['#F35857'/*red*/,'#FFD769'/*Yellow*/,'#FF9C4B'/*Orange*/,'#989CFF'/*Purple*/],
        "dataProvider": <?php print json_encode($rowRevCountryLastYear)?>,
        "titleField": "Country",
        "valueField": "Total",
        "labelRadius": 2,
        "color": "rgba(255,255,255,0)",
        "radius": "40%",
        "innerRadius": "60%",
        "labelText": "[[title]]"
        });


        var chart = AmCharts.makeChart("pieChartCurrentYear", {
        "type": "pie",
        "theme": "none",
        "legend" :
        {
        "markerType" : "square",
        "position" : "right",
        "markerSize" : 20,
        },
        "colors": ['#F35857'/*red*/,'#FFD769'/*Yellow*/,'#FF9C4B'/*Orange*/,'#989CFF'/*Purple*/],
        "dataProvider": <?php print json_encode($rowRevCountryCurrentYear); ?>,
        "titleField": "Country",
        "valueField": "Total",
        "labelRadius": 2,
        "color": "rgba(255,255,255,0)",
        "radius": "40%",
        "innerRadius": "60%",
        "labelText": "[[title]]"
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
