$(document).ready(statistics);

function statistics(){
$('#newsAndRecurrents').hide();
$('#unique').hide();
    $.get("/prueba/final/estadisticas/main")
    .done(processMain);
    
}

function processMain(response){
 
    var data= response;
    var category=[];
    var news=[];
    var recurrents=[];
    var newsData={};
    var uniques=[];
    var uniqueData={};
    for(var p in data[0].data.values){
        category.push({
        "label":dateFormat(p)
        });
        news.push({
            "value": data[0].data.values[p][0]
        });
        recurrents.push({
            "value": data[0].data.values[p][1]
        });
    }
    for(var pr in data[1].data.values){
        uniques.push({
            "label":dateFormat(pr),
            "value": data[1].data.values[pr][0]
        });
    }
    $("#loadingNews").hide();
    $("#loadingUnique").hide();  
    newsData.categories=category;
    newsData.news=news;
    newsData.recurrents=recurrents;
    uniqueData.data=uniques;
  
    $('#newsAndRecurrents').show();
    $('#unique').show();
   newsChart(newsData);
   unique(uniqueData);
}
function newsChart(data){


     $('#newsAndRecurrents').insertFusionCharts({
         type: "msline",
        width: "100%",
        height: "300",
        dataFormat: "json",
        dataSource: {
           "chart": {
        "caption": "Visitantes Nuevos VS Recurrentes",
        "subCaption": "Ultimos 30 Dias",
        "captionFontSize": "14",
        "subcaptionFontSize": "14",
        "subcaptionFontBold": "0",
        "paletteColors": "#0075c2,#1aaf5d",
        "bgcolor": "#ffffff",
        "showBorder": "0",
        "showShadow": "0",
        "showCanvasBorder": "0",
        "usePlotGradientColor": "0",
        "legendBorderAlpha": "0",
        "legendShadow": "0",
        "showAxisLines": "0",
        "showAlternateHGridColor": "0",
        "divlineThickness": "1",
        "divLineIsDashed": "1",
        "divLineDashLen": "1",
        "divLineGapLen": "1",
        "xAxisName": "Dias",
        "yAxisName": "Visitantes",
        "showValues": "0"
    },

         "categories": [
        {
            "category": data.categories
        }
    ],
    "dataset": [
        {
            "seriesname": "Nuevos",
            "data": data.news
        },
        {
            "seriesname": "Recurrentes",
            "data": data.recurrents
        }
    ]   
        }
    
    });
}
function unique(data){
    $('#unique').insertFusionCharts({
        type: "column2d",
        width: "100%",
        height: "300",
        dataFormat: "json",
        dataSource:{
    "chart": {
        "caption": "Visitantes Unicos",
        "subCaption": "Ultimos 30 Dias",
        "xAxisName": "Dias",
        "paletteColors": "#0075c2",
         "captionFontSize": "14",
        "subcaptionFontSize": "14",
        "subcaptionFontBold": "0",
        "yAxisName": "Visitantes",
        "theme": "carbon"
    },
    "data": data.data
}
    }

        );
}

function dateFormat(val){
    var date=String(val).slice(5,10);
    var split= date.split('-');
    var format= split[1]+'-'+split[0];
    return format;
}