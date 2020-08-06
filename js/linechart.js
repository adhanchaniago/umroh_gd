var lineChartData = [{
        "date" : '2016-12-09',
        "members": dateLast30Day.getAttribute('returning1'),
        "orders" : dateLast30Day.getAttribute('new1')
    }, {
        "date" : dateLast30Day.getAttribute('date2'),
        "members": dateLast30Day.getAttribute('returning2'),
        "orders" : dateLast30Day.getAttribute('new2')
    }, {
        "date" : dateLast30Day.getAttribute('date3'),
        "members": dateLast30Day.getAttribute('returning3'),
        "orders" : dateLast30Day.getAttribute('new3')
    }, {
        "date" : dateLast30Day.getAttribute('date4'),
        "members": dateLast30Day.getAttribute('returning4'),
        "orders" : dateLast30Day.getAttribute('new4')
    }, {
        "date": dateLast30Day.getAttribute('date5'),
        "members": dateLast30Day.getAttribute('returning5'),
        "orders" : dateLast30Day.getAttribute('new5')
    }, {
        "date": dateLast30Day.getAttribute('date6'),
        "members": dateLast30Day.getAttribute('returning6'),
        "orders" : dateLast30Day.getAttribute('new6')
    }, {
        "date": dateLast30Day.getAttribute('date7'),
        "members": dateLast30Day.getAttribute('returning7'),
        "orders" : dateLast30Day.getAttribute('new7')
    }, {
        "date": dateLast30Day.getAttribute('date8'),
        "members": dateLast30Day.getAttribute('returning8'),
        "orders" : dateLast30Day.getAttribute('new8')
    }, {
        "date": dateLast30Day.getAttribute('date9'),
        "members": dateLast30Day.getAttribute('returning9'),
        "orders" : dateLast30Day.getAttribute('new9')
    }, {
        "date": dateLast30Day.getAttribute('date10'),
        "members": dateLast30Day.getAttribute('returning10'),
        "orders" : dateLast30Day.getAttribute('new10')
    }, {
        "date": dateLast30Day.getAttribute('date11'),
        "members": dateLast30Day.getAttribute('returning11'),
        "orders" : dateLast30Day.getAttribute('new11')
    }, {
        "date": dateLast30Day.getAttribute('date12'),
        "members": dateLast30Day.getAttribute('returning12'),
        "orders" : dateLast30Day.getAttribute('new12')
    }, {
        "date": dateLast30Day.getAttribute('date13'),
        "members": dateLast30Day.getAttribute('returning13'),
        "orders" : dateLast30Day.getAttribute('new13')
    }, {
        "date": dateLast30Day.getAttribute('date14'),
        "members": dateLast30Day.getAttribute('returning14'),
        "orders" : dateLast30Day.getAttribute('new14')
    }, {
        "date": dateLast30Day.getAttribute('date15'),
        "members": dateLast30Day.getAttribute('returning15'),
        "orders" : dateLast30Day.getAttribute('new15')
    }, {
        "date": dateLast30Day.getAttribute('date16'),
        "members": dateLast30Day.getAttribute('returning16'),
        "orders" : dateLast30Day.getAttribute('new16')
    }, {
        "date": dateLast30Day.getAttribute('date17'),
        "members": dateLast30Day.getAttribute('returning17'),
        "orders" : dateLast30Day.getAttribute('new17')
    }, {
        "date": dateLast30Day.getAttribute('date18'),
        "members": dateLast30Day.getAttribute('returning18'),
        "orders" : dateLast30Day.getAttribute('new18')
    }, {
        "date": dateLast30Day.getAttribute('date19'),
        "members": dateLast30Day.getAttribute('returning19'),
        "orders" : dateLast30Day.getAttribute('new19')
    }, {
        "date": dateLast30Day.getAttribute('date20'),
        "members": dateLast30Day.getAttribute('returning20'),
        "orders" : dateLast30Day.getAttribute('new20')
    }, {
        "date": dateLast30Day.getAttribute('date21'),
        "members": dateLast30Day.getAttribute('returning21'),
        "orders" : dateLast30Day.getAttribute('new21')
    }, {
        "date": dateLast30Day.getAttribute('date22'),
        "members": dateLast30Day.getAttribute('returning22'),
        "orders" : dateLast30Day.getAttribute('new22')
    }, {
        "date": dateLast30Day.getAttribute('date23'),
        "members": dateLast30Day.getAttribute('returning23'),
        "orders" : dateLast30Day.getAttribute('new23')
    }, {
        "date": dateLast30Day.getAttribute('date24'),
        "members": dateLast30Day.getAttribute('returning24'),
        "orders" : dateLast30Day.getAttribute('new24')
    }, {
        "date": dateLast30Day.getAttribute('date25'),
        "members": dateLast30Day.getAttribute('returning25'),
        "orders" : dateLast30Day.getAttribute('new25')
    }, {
        "date": dateLast30Day.getAttribute('date26'),
        "members": dateLast30Day.getAttribute('returning26'),
        "orders" : dateLast30Day.getAttribute('new26')
    }, {
        "date": dateLast30Day.getAttribute('date27'),
        "members": dateLast30Day.getAttribute('returning27'),
        "orders" : dateLast30Day.getAttribute('new27')
    },  {
        "date": dateLast30Day.getAttribute('date28'),
        "members": dateLast30Day.getAttribute('returning28'),
        "orders" : dateLast30Day.getAttribute('new28')
    }, {
        "date": dateLast30Day.getAttribute('date29'),
        "members": dateLast30Day.getAttribute('returning29'),
        "orders" : dateLast30Day.getAttribute('new29')
    }, {
        "date": dateLast30Day.getAttribute('date30'),
        "members": dateLast30Day.getAttribute('returning30'),
        "orders" : dateLast30Day.getAttribute('new30')
    }, {
        "date": dateLast30Day.getAttribute('date31'),
        "members": dateLast30Day.getAttribute('returning31'),
        "orders" : dateLast30Day.getAttribute('new31')
    }];


AmCharts.ready(function () {
    var chart = new AmCharts.AmSerialChart();
    chart.dataProvider = lineChartData;
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
    chart.write("chartdiv");

});