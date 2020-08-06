<!DOCTYPE html>
<html>

<head>
    <title>WiWE 90 - Listener</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-slider.css">
    <link rel="icon" sizes="192x192" href="../img/Icon.png" />
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
        
        #chartdiv100 {
            width: 100%;
            height: 200px;
            font-size: 11px;
        }
    </style>

    <style>
        .liquidFillGaugeText {
            font-family: Helvetica;
            font-weight: bold;
        }
        
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
            <span>Customer Folio</span>
          </h1>
                    <ul class="main-header__breadcrumb">
                        <li><a href="#" onclick="return false;">Home</a></li>
                        <li class="active"><a href="#" onclick="return false;">Hotel Reputation</a></li>
                        <li class="active"><a href="#" onclick="return false;">Customer Folio</a></li>
                    </ul>
                </div>

                <div class="main-header__date">
                    <input type="radio" id="radio_date_1" name="tab-radio" value="Today" checked>
                    <!--
                    -->
                    <label class="fixed-width" for="radio_date_1"><font size ="3">30 Days </font></label>
                    <!--
                    -->
                    <input type="radio" id="radio_date_2" name="tab-radio" value="7Days">
                    <!--
                    -->
                    <label class="fixed-width" for="radio_date_2"><font size ="3">Current Year</font></label>
                    <!--
                    -->
                    <input type="radio" id="radio_date_3" name="tab-radio" value="30Days">
                    <!--
                    -->
                    <label class="fixed-width" for="radio_date_3"><font size ="3">Last Year</font></label>

                </div>

                <br>
                <br>
                <div class="row">
                    <div Class="col-md-9 col-md-offset-9">
                        <input id="slider" type="text" data-provide="slider" data-slider-ticks="[1, 2, 3, 4, 5]" data-slider-ticks-labels='["2 Km", "5 Km", "10 Km", "Jakarta", "Indonesia"]' data-slider-min="1" data-slider-max="5" data-slider-step="1" data-slider-value="1" data-slider-tooltip="hide" />
                    </div>
                </div>


            </header>
            <!-- /main-header -->

            <div class="row">
                <div class="col-md-3">
                    <article class="widget">
                        <div class="widget__content widget__grid filled pad20" style="height: 150px">
                            <font size="4">Rangking</font>
                            <br>
                            <br>
                            <font size="6"><strong style="font-weight: bold;"> #2</strong></font>
                            <br>
                            <br>

                            <div class="progressbar">
                                <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width: 100%; padding-left: 0; padding-right: 0; padding-top: 5;">
                                </div>
                            </div>
                            <br>
                            <font size="3"><strong style="font-weight: bold;"> 100</strong> &nbsp Total Hotels</font>
                        </div>
                    </article>
                </div>

                <div class="col-md-3">
                    <article class="widget" style="background :'../img/booking.png'">
                        <div class="widget__content widget__grid filled pad20" style="height: 150px; background:'../img/booking.png'">
                            <font size="4">Trip Advisor</font>
                            <br>
                            <br>
                            <font size="6"><strong style="font-weight: bold;">4,5</strong></font>
                            <br>
                            <br>
                            <div class="progressbar">
                                <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 100%; padding-left: 0; padding-right: 0; padding-top: 5;">
                                </div>
                            </div>
                            <br>
                            <font size="3"><strong style="font-weight: bold;"> 100</strong> &nbsp Total Reviews </font>
                    </article>
                    </div>

                    <div class="col-md-3">
                        <article class="widget">
                            <div class="widget__content widget__grid filled pad20" style="height: 150px">
                                <img src ="../img/booking.png" width="150px">
                                <br>
                                <br>
                                <font size="6"><strong style="font-weight: bold;"> &nbsp 8 </strong></font>
                                <br>
                                <br>

                                <div class="progressbar">
                                    <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 45%; padding-left: 0; padding-right: 0; padding-top: 5;">
                                    </div>
                                </div>
                                <br>
                                <font size="3"><strong style="font-weight: bold;"> 120 </strong> Total Reviews </font>
                        </article>
                        </div>

                        <div class="col-md-3">
                            <article class="widget">
                                <div class="widget__content widget__grid filled pad20" style="height: 150px">
                                    <img src ="../img/agoda.png" width="50px">
                                    <br>
                                    <br>
                                    <font size="6"><strong style="font-weight: bold;"> &nbsp 9 </strong></font>
                                    <br>
                                    <br>

                                    <div class="progressbar">
                                        <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 57%; padding-left: 0; padding-right: 0; padding-top: 5;">
                                        </div>
                                    </div>
                                    <br>
                                    <font size="3"> <strong style="font-weight: bold;"> 200 </strong> Total Reviewers </font>
                            </article>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <article class="widget">
                                    <div class="widget__content widget__grid filled pad20">
                                        
                                        <div id="chartdiv100"></div>

                                    </div>
                                    <!-- /widget__content -->
                                </article>
                                <!-- /widget -->
                            </div>
                            <div class="col-md-6">
                                <article class="widget">
                                    <div class="widget__content widget__grid filled pad20">
                                        <div id="cloud"></div>
                                    </div>
                                    <!-- /widget__content -->
                                </article>
                                <!-- /widget -->
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-5">
                                <article class="widget">
                                    <header class="widget__header">
                                        <div class="widget__title">
                                            <i class="pe-7s-graph"></i>
                                            <h3>Pie Chart</h3>
                                        </div>
                                        <div class="widget__config">
                                            <a href="#"><i class="pe-7f-refresh"></i></a>
                                            <a href="#"><i class="pe-7s-close"></i></a>
                                        </div>
                                    </header>

                                    <div class="widget__content filled widget-ui">

                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <div id="chartdiv3" style="width: 100%; height: 362px;"></div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /widget__content -->

                                </article>
                                <!-- /widget -->
                            </div>

                            <div class="col-md-7">
                                <article class="widget">
                                    <header class="widget__header">
                                        <div class="widget__title">
                                            <i class="pe-7f-graph3"></i>
                                            <h3>Statistics</h3>
                                        </div>
                                        <div class="widget__config">
                                            <a href="#"><i class="pe-7f-refresh"></i></a>
                                            <a href="#"><i class="pe-7s-close"></i></a>
                                        </div>
                                    </header>

                                    <div class="widget__content filled">
                                        <p class="graph-number"><span>6,184</span> Visits</p>
                                        <div id="chartdiv" style="width: 100%; height: 362px;"></div>

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
        <!--<script type="text/javascript" src="../js/amcharts/xy.js"></script> -->
        <script type="text/javascript" src="../js/amcharts/radar.js"></script>
        <script type="text/javascript" src="../js/bootstrap-slider.js"></script>
        <script type="text/javascript" src="../js/canvasjs/canvasjs.min.js"></script>
        <script type="text/javascript" src="../js/chartz.js"></script>

        <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
        <script src="https://www.amcharts.com/lib/3/serial.js"></script>
        <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
        <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
        <script src="https://www.amcharts.com/lib/3/themes/none.js"></script>
        <script>
            var chart = AmCharts.makeChart("chartdiv100", {
                "type": "serial",
                "theme": "light",
                "legend": {
                    "horizontalGap": 10,
                    "maxColumns": 1,
                    "position": "right",
                    "useGraphSettings": true,
                    "markerSize": 10,
                },
                "dataProvider": [{
                    "year": 2003,
                    "europe": 2.5,
                    "namerica": 2.5,
                    "asia": 2.1,
                    "lamerica": 0.3,
                    "meast": 0.2,
                    "africa": 0.1
    }, {
                    "year": 2004,
                    "europe": 2.6,
                    "namerica": 2.7,
                    "asia": 2.2,
                    "lamerica": 0.3,
                    "meast": 0.3,
                    "africa": 0.1
    }, {
                    "year": 2005,
                    "europe": 2.8,
                    "namerica": 2.9,
                    "asia": 2.4,
                    "lamerica": 0.3,
                    "meast": 0.3,
                    "africa": 0.1
    }],
                "valueAxes": [{
                    "stackType": "100%",
                    "axisAlpha": 0.5,
                    "gridAlpha": 0
    }],
                "graphs": [{
                    "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                    "fillAlphas": 0.8,
                    "labelText": "[[value]]",
                    "lineAlpha": 0.3,
                    "title": "Europe",
                    "type": "column",
                    "color": "#000000",
                    "valueField": "europe"
    }, {
                    "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                    "fillAlphas": 0.8,
                    "labelText": "[[value]]",
                    "lineAlpha": 0.3,
                    "title": "North America",
                    "type": "column",
                    "color": "#000000",
                    "valueField": "namerica"
    }, {
                    "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                    "fillAlphas": 0.8,
                    "labelText": "[[value]]",
                    "lineAlpha": 0.3,
                    "title": "Asia-Pacific",
                    "type": "column",
                    "color": "#000000",
                    "valueField": "asia"
    }, {
                    "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                    "fillAlphas": 0.8,
                    "labelText": "[[value]]",
                    "lineAlpha": 0.3,
                    "title": "Latin America",
                    "type": "column",
                    "color": "#000000",
                    "valueField": "lamerica"
    }, {
                    "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                    "fillAlphas": 0.8,
                    "labelText": "[[value]]",
                    "lineAlpha": 0.3,
                    "title": "Middle-East",
                    "type": "column",
                    "color": "#000000",
                    "valueField": "meast"
    }, {
                    "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                    "fillAlphas": 0.8,
                    "labelText": "[[value]]",
                    "lineAlpha": 0.3,
                    "title": "Africa",
                    "type": "column",
                    "color": "#000000",
                    "valueField": "africa"
    }],
                "rotate": true,
                "categoryField": "year",
                "categoryAxis": {
                    "gridPosition": "start",
                    "axisAlpha": 0,
                    "gridAlpha": 0,
                    "position": "left"
                },
                "export": {
                    "enabled": true
                }
            });
        </script>

</body>

<script type="text/javascript">
    // First define your cloud data, using `text` and `size` properties:

    var skillsToDraw = [
        {
            text: 'javascript',
            size: 40
        },
        {
            text: 'D3.js',
            size: 15
        },
        {
            text: 'coffeescript',
            size: 25
        },
        {
            text: 'shaving sheep',
            size: 25
        },
        {
            text: 'AngularJS',
            size: 30
        },
        {
            text: 'Ruby',
            size: 30
        },
        {
            text: 'ECMAScript',
            size: 15
        },
        {
            text: 'Actionscript',
            size: 10
        },
        {
            text: 'Linux',
            size: 20
        },
        {
            text: 'C++',
            size: 20
        },
        {
            text: 'C#',
            size: 25
        },
        {
            text: 'JAVA',
            size: 38
        },
  // just copy data and reduce size, else the cloud is a little boring
        {
            text: 'javascript',
            size: 40
        },
        {
            text: 'D3.js',
            size: 15
        },
        {
            text: 'coffeescript',
            size: 25
        },
        {
            text: 'shaving sheep',
            size: 25
        },
        {
            text: 'AngularJS',
            size: 30
        },
        {
            text: 'Ruby',
            size: 30
        },
        {
            text: 'ECMAScript',
            size: 15
        },
        {
            text: 'Actionscript',
            size: 10
        },
        {
            text: 'Linux',
            size: 20
        },
        {
            text: 'C++',
            size: 20
        },
        {
            text: 'C#',
            size: 25
        },
        {
            text: 'JAVA',
            size: 38
        },
        {
            text: 'javascript',
            size: 40
        },
        {
            text: 'D3.js',
            size: 15
        },
        {
            text: 'coffeescript',
            size: 25
        },
        {
            text: 'shaving sheep',
            size: 25
        },
        {
            text: 'AngularJS',
            size: 30
        },
        {
            text: 'Ruby',
            size: 30
        },
        {
            text: 'ECMAScript',
            size: 15
        },
        {
            text: 'Actionscript',
            size: 10
        },
        {
            text: 'Linux',
            size: 20
        },
        {
            text: 'C++',
            size: 20
        },
        {
            text: 'C#',
            size: 25
        },
        {
            text: 'JAVA',
            size: 38
        }
];

    // Next you need to use the layout script to calculate the placement, rotation and size of each word:

    var width = 500;
    var height = 300;
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
        d3.select("#cloud").append("svg")
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

</html>

<?php
if(isset($_SESSION["role"])) {
  exit;
}
else {
  echo "<meta http-equiv='refresh' content='0; url=../modul/logout.php'>";
}
?>