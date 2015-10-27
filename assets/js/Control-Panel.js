$(document).ready(function(){
   $(".warn-sign").css("left",15+($(".error-sign").text().length*6));
});
$.getScript("/assets/lib/js/socket.io.js", function(){
    var socket = io.connect('http://61.43.139.16:8888');
    socket.emit('realtimeOn', {});
    socket.on("realtimeOn res", function(data) {
        if(data.code == 200)
        {
            console.log(data);
            for(var i in data)
            {
                var value = [];
                for(var j in data[i])
                    value.push(data[i][j].trafficPercentage);
                $(".updating-chart[data-chart='" + i + "']").peity("line", { fill: '#0e9aef',stroke:'#1c84c6', width: 128 }).text(value.join(",")).change();
                value = $(".updating-chart[data-chart='" + i + "']").text().split(",");
                //$(".updating-chart[data-chart='1']").parent().find("small").text(data[i][data[i].length-1].traffic);
                //$(".updating-chart[data-chart='1']").parent().parent().find("h7").text(data[i][data[i].length-1].endtime);
            }
        }
        else
            alert("커넥션이 종료 되었습니다. 페이지를 새로고침을 해주시기 바랍니다.");
    });
    socket.on("realtimeClose res", function(data) {
    	console.log(JSON.stringify(data));
    });
});