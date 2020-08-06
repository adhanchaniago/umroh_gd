<!DOCTYPE html>
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
	

</head>
<body>
	<div id="loading">
		<div class="loader loader-light loader-large"></div>
	</div>
	<!-- Calling Top Bar & Side Bar --> 
	<?php include "menu.php"; ?>

	<!-- Content --> 
	
	<style>
    
    #mapChart {
  width: 100%;
  height: 420px;
}

.map-marker !important; {
    /* adjusting for the marker dimensions
    so that it is centered on coordinates */
    margin-left: -8px; !important;
    margin-top: -8px; !important;
}
.map-marker.map-clickable {
    cursor: pointer;!important;
}
.pulse {
    width: 10px;!important;
    height: 10px;!important;
    border: 5px solid #f7f14c;!important;
    -webkit-border-radius: 30px;!important;
    -moz-border-radius: 30px;!important;
    border-radius: 30px;!important;
    background-color: #716f42;!important;
    z-index: 10;!important;
    position: absolute;!important;
  }
.map-marker .dot {
    border: 10px solid #fff601; !important;
    background: transparent; !important;
    -webkit-border-radius: 60px; !important;
    -moz-border-radius: 60px; !important;
    border-radius: 60px; !important;
    height: 50px; !important;
    width: 50px; !important;
    -webkit-animation: pulse 3s ease-out; !important;
    -moz-animation: pulse 3s ease-out;!important;
    animation: pulse 3s ease-out;!important;
    -webkit-animation-iteration-count: infinite;!important;
    -moz-animation-iteration-count: infinite;!important;
    animation-iteration-count: infinite;!important;
    position: absolute;!important;
    top: -20px;!important;
    left: -20px;!important;
    z-index: 1;!important;
    opacity: 0;!important;
  }
  @-moz-keyframes pulse {
   0% {
      -moz-transform: scale(0);!important;
      opacity: 0.0;!important;
   }
   25% {
      -moz-transform: scale(0);!important;
      opacity: 0.1;!important;
   }
   50% {
      -moz-transform: scale(0.1);!important;
      opacity: 0.3;!important;
   }
   75% {
      -moz-transform: scale(0.5);!important;
      opacity: 0.5;!important;
   }
   100% {
      -moz-transform: scale(1);!important;
      opacity: 0.0;!important;
   }
  }
        @-webkit-keyframes "pulse" {
   0% {
      -webkit-transform: scale(0);
      opacity: 0.0;
   }
   25% {
      -webkit-transform: scale(0);
      opacity: 0.1;
   }
   50% {
      -webkit-transform: scale(0.1);
      opacity: 0.3;
   }
   75% {
      -webkit-transform: scale(0.5);
      opacity: 0.5;
   }
   100% {
      -webkit-transform: scale(1);
      opacity: 0.0;
   }
  }
        
#visitorBrowser {
	width		: 100%;
	height		: 380px;
	font-size	: 11px;
}
        
#ExitPagesChart{
	width		: 100%;
	height		: 200px;
	font-size	: 11px;
}
        
#AttractivePage {
	width		: 100%;
	height		: 200px;
	font-size	: 11px;
}				
 </style>
	
<section class="content">
			
<header class="main-header">
                    <div class="main-header__nav">
                        <h1 class="main-header__title">
                     <i class="pe-7s-graph1"></i>
                    <span>Website Performance</span>
                        </h1>    
                    </div>
                </header>
                
                <div class ="row">
                <div class="col-md-6">
                            <article class="widget"><header class="widget__header">
                                <div class="widget__title">
                                    <i class=""></i><H3>Map</H3>
                                </div>
                                <div class="widget__config">
                                    <a href="#"><i class=""></i></a>
                                    <a href="#"><i class=""></i></a>
                                </div>
                                </header>
                                <div class="widget__content widget__grid filled pad20" style="height:450px">
                                 <div id ="mapChart"></div>   
                                </div>
                            </article>
                    </div>
                    
                    <div class="col-md-6">
                            <article class="widget">
                               <header class="widget__header">
                                <div class="widget__title">
                                    <i class=""></i><H3>Visitor Browser</H3>
                                </div>
                                <div class="widget__config">
                                    <a href="#"><i class=""></i></a>
                                    <a href="#"><i class=""></i></a>
                                </div>
                                </header>
                                <div class="widget__content widget__grid filled pad20"style="height:450px">
                              
                                    <div id="visitorBrowser"></div>
                                </div>
                            </article>
                    </div>
                    
                </div>
                <div class ="row">
                    <div class="col-md-6"> 
                            <article class="widget">
                               <header class="widget__header">
                                <div class="widget__title">
                                    <i class=""></i><H3>Visit Overview</H3>
                                </div>
                                <div class="widget__config">
                                    <a href="#"><i class=""></i></a>
                                    <a href="#"><i class=""></i></a>
                                </div>
                                </header>
                                <div class="widget__content widget__grid filled pad20"style="height:200px">
                                
                                <br>
                                <div class ="col-xs-9">
                                <font Size = "3"> Pages Per Visits </font><br><br>
                                 <font Size = "3"> Minutes Per Visits </font><br><br>
                                 <font Size = "3">  New Visitors</font><br><br>
                                 <font Size = "3"> Returning Visitors </font><br>
                                </div>
                                
                                <div class ="col-xs-3"><center>
                                    <font Size = "3"><strong style="font-weight:bold"> 3 </strong></font><br><br>
                                    <font Size = "3"><strong style="font-weight:bold"> 1 </strong></font><br><br>
                                    <font Size = "3"><strong style="font-weight:bold"> 2 </strong> </font><br><br>
                                    <font Size = "3"><strong style="font-weight:bold"> 3 </strong> </font><br>
                                 </center>   
                                </div>
                                 
                                </div>
                            </article>
                    </div>
                    
                    <div class="col-md-6"> 
                            <article class="widget">
                               <header class="widget__header">
                                <div class="widget__title">
                                    <i class=""></i><h3>Referer Website</h3>
                                   </div>
                                <div class="widget__config">
                                    <a href="#"><i class=""></i></a>
                                    <a href="#"><i class=""></i></a>
                                </div>
                                </header>
                                <div class="widget__content widget__grid filled pad20"style="height:200px">
                                
                                <br>
                                <div class ="col-xs-9">
                                <font Size = "3"> Traveloka.com </font><br><br>
                                 <font Size = "3"> Google.com </font><br><br>
                                 <font Size = "3">  Kayak.com</font><br><br>
                                 <font Size = "3"> Twitter.com </font> <br>  
                                </div>
                                
                                <div class ="col-xs-3"><center>
                                    <font Size = "3"><strong style="font-weight:bold">15 </strong></font><br><br>
                                    <font Size = "3"><strong style="font-weight:bold"> 8 </strong></font><br><br>
                                    <font Size = "3"><strong style="font-weight:bold"> 7 </strong> </font><br><br>
                                    <font Size = "3"><strong style="font-weight:bold"> 4 </strong> </font><br>
                                 </center>   
                                </div>
                                 
                                </div>
                            </article>
                    </div>
                    
                </div>
                
            <div class ="row">
                    <div class="col-md-6">
                            <article class="widget">
                               <header class="widget__header">
                                <div class="widget__title">
                                    <i class=""></i><H3>Exit Pages</H3>
                                </div>
                                <div class="widget__config">
                                    <a href="#"><i class=""></i></a>
                                    <a href="#"><i class=""></i></a>
                                </div>
                                </header>
                                <div class="widget__content widget__grid filled pad20"style="height:350px">
                                    <br>
                                    <div id="ExitPagesChart" style="height: 300px; width: 100%;">
                                </div>
                                </div>
                            </article>
                    </div>
                    
                    <div class="col-md-6">
                            <article class="widget">
                               <header class="widget__header">
                                <div class="widget__title">
                                    <i class=""></i><H3>Attractive Pages</H3>
                                </div>
                                <div class="widget__config">
                                    <a href="#"><i class=""></i></a>
                                    <a href="#"><i class=""></i></a>
                                </div>
                                </header>
                                <div class="widget__content widget__grid filled pad20"style="height:350px">
                                   <br>
                                    <div id="AttractivePage" style="height: 300px; width: 100%;">
                                    </div>
                                <div class ="col-xs-6">
                                </div>
                                </div>
                            </article>
                    </div>
                    
                </div>
            

			<footer class="footer-brand">
					<?php include "footer.php"; ?>
			</footer>
		</section> <!-- /content -->

    <script type="text/javascript" src="../js/main.js"></script> <!-- Loading -->
    <script type="text/javascript" src="../js/amcharts/ammap.js"></script>
   
    <script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/dark.js"></script>
    <script src="https://www.amcharts.com/lib/3/pie.js"></script>
   
    <script type="text/javascript" src="../js/canvasjs/canvasjs.min.js"></script>
	
	<script>
    
    var map = AmCharts.makeChart( "mapChart", {
  "type": "map",
  "theme": "dark",
  "projection": "miller",

  "imagesSettings": {
    "rollOverColor": "#089282",
    "rollOverScale": 3,
    "selectedScale": 3,
    "selectedColor": "#089282",
    "color": "#13564e"
  },

  "areasSettings": {
    "unlistedAreasColor": "#15A892"
  },

  "dataProvider": {
    "map": "worldLow",
    "images": [ {
      "zoomLevel": 5,
      "scale": 0.5,
      "title": "Brussels",
      "latitude": 50.8371,
      "longitude": 4.3676
    }, {
      "zoomLevel": 5,
      "scale": 0.5,
      "title": "Copenhagen",
      "latitude": 55.6763,
      "longitude": 12.5681
    }, {
      "zoomLevel": 5,
      "scale": 0.5,
      "title": "Paris",
      "latitude": 48.8567,
      "longitude": 2.3510
    }, {
      "zoomLevel": 5,
      "scale": 0.5,
      "title": "Reykjavik",
      "latitude": 64.1353,
      "longitude": -21.8952
    }, {
      "zoomLevel": 5,
      "scale": 0.5,
      "title": "Moscow",
      "latitude": 55.7558,
      "longitude": 37.6176
    }, {
      "zoomLevel": 5,
      "scale": 0.5,
      "title": "Madrid",
      "latitude": 40.4167,
      "longitude": -3.7033
    }, {
      "zoomLevel": 5,
      "scale": 0.5,
      "title": "London",
      "latitude": 51.5002,
      "longitude": -0.1262,
      "url": "http://www.google.co.uk"
    }, {
      "zoomLevel": 5,
      "scale": 0.5,
      "title": "Peking",
      "latitude": 39.9056,
      "longitude": 116.3958
    }, {
      "zoomLevel": 5,
      "scale": 0.5,
      "title": "New Delhi",
      "latitude": 28.6353,
      "longitude": 77.2250
    }, {
      "zoomLevel": 5,
      "scale": 0.5,
      "title": "Tokyo",
      "latitude": 35.6785,
      "longitude": 139.6823,
      "url": "http://www.google.co.jp"
    }, {
      "zoomLevel": 5,
      "scale": 0.5,
      "title": "Ankara",
      "latitude": 39.9439,
      "longitude": 32.8560
    }, {
      "zoomLevel": 5,
      "scale": 0.5,
      "title": "Buenos Aires",
      "latitude": -34.6118,
      "longitude": -58.4173
    }, {
      "zoomLevel": 5,
      "scale": 0.5,
      "title": "Brasilia",
      "latitude": -15.7801,
      "longitude": -47.9292
    }, {
      "zoomLevel": 5,
      "scale": 0.5,
      "title": "Ottawa",
      "latitude": 45.4235,
      "longitude": -75.6979
    }, {
      "zoomLevel": 5,
      "scale": 0.5,
      "title": "Washington",
      "latitude": 38.8921,
      "longitude": -77.0241
    }, {
      "zoomLevel": 5,
      "scale": 0.5,
      "title": "Kinshasa",
      "latitude": -4.3369,
      "longitude": 15.3271
    }, {
      "zoomLevel": 5,
      "scale": 0.5,
      "title": "Jakarta",
      "latitude": -6.174668,
      "longitude": 106.827126
    },{
      "zoomLevel": 5,
      "scale": 0.5,
      "title": "Cairo",
      "latitude": 30.0571,
      "longitude": 31.2272
    }, {
      "zoomLevel": 5,
      "scale": 0.5,
      "title": "Pretoria",
      "latitude": -25.7463,
      "longitude": 28.1876
    } ]
  }
} );

// add events to recalculate map position when the map is moved or zoomed
map.addListener( "positionChanged", updateCustomMarkers );

// this function will take current images on the map and create HTML elements for them
function updateCustomMarkers( event ) {
  // get map object
  var map = event.chart;

  // go through all of the images
  for ( var x in map.dataProvider.images ) {
    // get MapImage object
    var image = map.dataProvider.images[ x ];

    // check if it has corresponding HTML element
    if ( 'undefined' == typeof image.externalElement )
      image.externalElement = createCustomMarker( image );

    // reposition the element accoridng to coordinates
    var xy = map.coordinatesToStageXY( image.longitude, image.latitude );
    image.externalElement.style.top = xy.y + 'px';
    image.externalElement.style.left = xy.x + 'px';
  }
}

// this function creates and returns a new marker element
function createCustomMarker( image ) {
  // create holder
  var holder = document.createElement( 'div' );
  holder.className = 'map-marker';
  holder.title = image.title;
  holder.style.position = 'absolute';

  // maybe add a link to it?
  if ( undefined != image.url ) {
    holder.onclick = function() {
      window.location.href = image.url;
    };
    holder.className += ' map-clickable';
  }

  // create dot
  var dot = document.createElement( 'div' );
  dot.className = 'dot';
  holder.appendChild( dot );

  // create pulse
  var pulse = document.createElement( 'div' );
  pulse.className = 'pulse';
  holder.appendChild( pulse );

  // append the marker to the map container
  image.chart.chartDiv.appendChild( holder );

  return holder;
}
</script>

<!-- ################################################# PIE CHART VISITOR BROWSER ##################################################################### -->
<script>

var chart = AmCharts.makeChart( "visitorBrowser", {
  "type": "pie",
  "theme": "dark",
   "legend" : 
    {
        "markerType" : "square",
        "position" : "right",
        "markerSize" : 20,
    },
  "dataProvider": [ {
    "title": "Firefox",
    "fillColors": "#53D769",
    "value": 15
  }, {
    "title": "Chrome",
    "value": 20
  },
  {
       "title": "Safari",
    "value": 5               
  }],
  "titleField": "title",
  "valueField": "value",
  "labelRadius": 5,

  "radius": "32%",
  "innerRadius": "60%",
  "labelText": "[[title]]",
  "export": {
    "enabled": false
  }
} );

</script>

<!-- ################################################# Exit Pages Configuration ##################################################################### -->

<!-- #################################################### Exit Pages @#################################################################################### -->
<script>

var chart = new CanvasJS.Chart("ExitPagesChart", {
backgroundColor:"transparent",

        animationEnabled: true,
            axisX:{
            interval: 1,
            gridThickness:0,
            labelFontSize: 14,
            labelFontColor : "#FFFFFF"
            },
            axisY:{
            gridThickness: 1,
            gridColor: "#5B5B5B",
                labelFontSize: 14,
            labelFontColor : "#FFFFFF"
            },
            data: [
            {    
                type: "bar",
                name: "companies",
                axisYType: "primary",
                color: "#53D769",                                                         
                dataPoints: [
                {y: 7, label: "Booking.php"  },
                {y: 8, label: "Contact.php"  },
                {y: 12, label: "Meeting&Events.php"  },
                {y: 15, label: "Special-Offer.php"  },
                {y: 17, label: "Wedding.php"  },
                {y: 18, label: "Restauran&Bar.php"  },
                {y: 20, label: "room-suites.php"  }                                          
                            ]
                        }
                    ]
            });
chart.render();

</script> 
<!-- ############################################## ATTRACTIVE PAGES CONFIGURATION CHART ############################################################ -->
<script>
    var chart1 = new CanvasJS.Chart("AttractivePage",
    {
       backgroundColor:"transparent",
      animationEnabled: true,
      legend: {
        fontColor : "white",
        cursor:"pointer",
        itemclick : function(e) {
          if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
              e.dataSeries.visible = false;
          }
          else {
              e.dataSeries.visible = true;
          }
          chart1.render();
        }
      },
        axisY:{
            gridThickness: 1,
            gridColor: "#5B5B5B",
            labelFontSize: 14,
            labelFontColor : "#FFFFFF"
            },
        
        axisX:{
            labelFontSize : 14, labelFontColor : "#FFFFFF"            
            },
      toolTip: {
        shared: true, 
        content: function(e){
          var str = '';
          var total = 0 ;
          var str3;
          var str2 ;
          for (var i = 0; i < e.entries.length; i++){
            var  str1 = "<span style= 'color:"+e.entries[i].dataSeries.color + "'> " + e.entries[i].dataSeries.name + "</span>: <strong>"+  e.entries[i].dataPoint.y + "</strong> <br/>" ;
            total = e.entries[i].dataPoint.y + total;
            str = str.concat(str1);
          }
          str2 = "<span style = 'color:DodgerBlue; '><strong>"+e.entries[0].dataPoint.label + "</strong></span><br/>";
          str3 = "<span style = 'color:Tomato '>Total: </span><strong>" + total + "</strong><br/>";
          
          return (str2.concat(str)).concat(str3);
        }
 
      },
      data: [
      {       
        type: "bar",
        showInLegend: true,
        name: "Visit",
        color: "#53D769",
        dataPoints: [
        {y: 7, label: "Booking.php"  },
                {y: 8, label: "Contact.php"  },
                {y: 12, label: "Meeting&Events.php"  },
                {y: 15, label: "Special-Offer.php"  },
                {y: 17, label: "Wedding.php"  },
                {y: 18, label: "Restauran&Bar.php"  },
                {y: 20, label: "room-suites.php"  }       
 
 
        ]
      },
      {       
        type: "bar",
        showInLegend: true,
        name: "Bounce",
        color: "#1C7DFA",         
        dataPoints: [
       {y: 7, label: "Booking.php"  },
        {y: 3, label: "Contact.php"  },
        {y: 5, label: "Meeting&Events.php"  },
        {y: 4, label: "Special-Offer.php"  },
        {y: 9, label: "Wedding.php"  },
        {y: 2, label: "Restauran&Bar.php"  },
        {y: 6, label: "room-suites.php"  }         
 
 
        ]
      }
      ]
    });
 
chart1.render(); 
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

