var mapData;
var mapColor = {};
var levelcolor = ['#ed5565','#f8ac59','#1c84c6'];

function block(func,code)
{
    $.ajax({
        type: 'POST',
        url: "./ajax.php",
        data: "oper=" + func + "&code=" + code,
        success: function(res){
            if(func == "block")
                mapColor[code] = "#d1dade";
            else
            {
                if(!mapData[code])
                    mapColor[code] = "#1ab394";
                else
                {
                    var mbValue = mapData[code]/1024;
                    if(mbValue >= 30000)
                        mapColor[code] = levelcolor[0];
                    else if(mbValue >= 10000)
                        mapColor[code] = levelcolor[1];
                    else if(mbValue >= 100)
                        mapColor[code] = levelcolor[2];
                }
            }
            var map = $('#world-map').vectorMap('get', 'mapObject');
            map.series.regions[0].setValues(mapColor);
        },
        error:function(err){
            alert("데이터를 가져오는데 실패하였습니다.");
        }
    });
}
$(document).ready(function(){
   $.ajax({
        type: 'POST',
        url: "./ajax.php",
        data: "oper=trafficall",
        success: function(res){
            mapData = JSON.parse(res);
            for(var Code in mapData){
                var mbValue = mapData[Code]/1024;
                if(mbValue >= 30000)
                    mapColor[Code] = levelcolor[0];
                else if(mbValue >= 10000)
                    mapColor[Code] = levelcolor[1];
                else if(mbValue >= 100)
                    mapColor[Code] = levelcolor[2];
            }
        },
        async: false,
        error:function(err){
            alert("데이터를 가져오는데 실패하였습니다.");
        }
    });
    $.ajax({
        type: 'POST',
        url: "./ajax.php",
        data: "oper=blacklist",
        success: function(res){
            var temp = res.split(",");
            for(var i=0;i<temp.length;i++)
                mapColor[temp[i]] = '#d1dade';
        },
        async: false,
        error:function(err){
            alert("데이터를 가져오는데 실패하였습니다.");
        }
    });
    var map = $('#world-map').vectorMap('get', 'mapObject');
    map.series.regions[0].setValues(mapColor);
});
$('#world-map').vectorMap({
       map: 'world_mill_en',
       backgroundColor: "transparent",
       regionStyle: {
           initial: {
               fill: '#1ab394',
               "fill-opacity": 0.9,
               stroke: 'none',
               "stroke-width": 0,
               "stroke-opacity": 0
           }
       },
    onRegionClick: function(event, code) {
        if(mapColor[code] == "#d1dade")
            block("unblock",code);
        else
            block("block",code);
    },
    series: {
    regions: [{
           values: mapData,
           attribute: 'fill'
       }]
    },
    onRegionTipShow: function(e, el, code){
        if(mapData[code])
            el.html(el.html() + "<br>Traffic - " + mapData[code] + "KB");
    }
});