var lineChartData2 = [
    {
        "date": Last7day.getAttribute("date1"),
        "members": Last7day.getAttribute("returning1"),
        "orders": Last7day.getAttribute("new1")
    },
    {
        "date": Last7day.getAttribute("date2"),
        "members": Last7day.getAttribute("returning2"),
        "orders": Last7day.getAttribute("new2")
    },
    {
       "date": Last7day.getAttribute("date3"),
        "members": Last7day.getAttribute("returning3"),
        "orders": Last7day.getAttribute("new3")
    },
    {
       "date": Last7day.getAttribute("date4"),
        "members": Last7day.getAttribute("returning4"),
        "orders": Last7day.getAttribute("new4")
    },
    {
       "date": Last7day.getAttribute("date5"),
        "members": Last7day.getAttribute("returning5"),
        "orders": Last7day.getAttribute("new5")
    },
    {
        "date": Last7day.getAttribute("date6"),
        "members": Last7day.getAttribute("returning6"),
        "orders": Last7day.getAttribute("new6")
    },
    {
        "date": Last7day.getAttribute("date7"),
        "members": Last7day.getAttribute("returning7"),
        "orders" : Last7day.getAttribute("new7")
    }
];


AmCharts.ready(function () {
    var chart = new AmCharts.AmSerialChart();
    chart.dataProvider = lineChartData2;
    chart.pathToImages = "http://www.amcharts.com/lib/3/images/";
    chart.categoryField = "date";
    chart.dataDateFormat = "YYYY-MM-DD";

  

    // sometimes we need to set margins manually
    // autoMargins should be set to false in order chart to use custom margin values
    chart.autoMargins = false;
    chart.marginRight = 0;
    chart.marginLeft = 30;
    chart.marginBottom = 30;
    chart.marginTop = 40;
    
    // AXES
    // category                
    var categoryAxis = chart.categoryAxis;
    categoryAxis.parseDates = true; // as our data is date-based, we set parseDates to true
    categoryAxis.minPeriod = "DD"; // our data is daily, so we set minPeriod to DD
    categoryAxis.inside = false;
    categoryAxis.gridAlpha = 0;
    categoryAxis.tickLength = 0;
    categoryAxis.axisAlpha = 0.5;
    categoryAxis.fontSize = 9;
    categoryAxis.axisColor = "rgba(255,255,255,0.8)";
    categoryAxis.color = "rgba(255,255,255,0.8)";

    
    // value
    var valueAxis = new AmCharts.ValueAxis();
    valueAxis.dashLength = 2;
    valueAxis.gridColor = "rgba(255,255,255,0.8)";
    valueAxis.gridAlpha = 0.2;
    valueAxis.axisColor = "rgba(255,255,255,0.8)";
    valueAxis.color = "rgba(255,255,255,0.8)";
    valueAxis.axisAlpha = 0.5;
    valueAxis.fontSize = 9;
    chart.addValueAxis(valueAxis);
    
    // members
    var graph = new AmCharts.AmGraph();
    graph.type = "smoothedLine";
    graph.valueField = "members";
    graph.lineColor = "#53d769";
    graph.lineThickness = 3;
    graph.bullet = "round";
    //graph.bulletColor = "rgba(0,0,0,0.3)";
    graph.bulletBorderColor = "#53d769";
    graph.bulletBorderAlpha = 1;
    graph.bulletBorderThickness = 3;
    graph.bulletSize = 6;
    chart.addGraph(graph);

    // orders
    var graph1 = new AmCharts.AmGraph();
    graph1.type = "smoothedLine";
    graph1.valueField = "orders";
    graph1.lineColor = "#1c7dfa";
    graph1.lineThickness = 3;
    graph1.bullet = "round";
    //graph1.bulletColor = "rgba(0,0,0,0.3)";
    graph1.bulletBorderColor = "#1c7dfa";
    graph1.bulletBorderAlpha = 1;
    graph1.bulletBorderThickness = 3;
    graph1.bulletSize = 6;
    chart.addGraph(graph1);
    
    // CURSOR
    var chartCursor = new AmCharts.ChartCursor();
    chart.addChartCursor(chartCursor);
    chartCursor.categoryBalloonAlpha = 0.2;
    chartCursor.cursorAlpha = 0.2;
    chartCursor.cursorColor = 'rgba(255,255,255,.8)';
    chartCursor.categoryBalloonEnabled = false;
    
    // WRITE
    chart.write("chartdiv8");

});