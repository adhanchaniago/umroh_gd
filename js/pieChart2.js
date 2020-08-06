AmCharts.makeChart("chartdiv5", {
    "type": "pie",
    "theme": "none",
       "legend" : 
    {
        "markerType" : "square",
        "position" : "right",
        "markerSize" : 20,

    },
    "colors": ['#F35857'/*red*/,'#FFD769'/*Yellow*/,'#FF9C4B'/*Orange*/,'#989CFF'/*Purple*/],
    "dataProvider": [{
        "title": 'Room Login',
        "value": chart2.getAttribute('Room-Login')
    }, {
         "title": 'Form Registration',
        "value": chart2.getAttribute('Form-Registration')
    }, {
        "title": 'Social Media Login',
        "value": chart2.getAttribute('Social-Media-Login')
    }],
    "titleField": "title",
    "valueField": "value",
    "labelRadius": 2,
    "color": "rgba(255,255,255,0)",
    "radius": "40%",
    "innerRadius": "60%",
    "labelText": "[[title]]"
});