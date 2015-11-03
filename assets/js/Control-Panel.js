function ajaxcall(action,idx){
    $.ajax({
        type: 'POST',
        url: "./ajax.php",
        data: "oper=" + action + "&code=" + idx,
        success: function(res){
            if(action == "show")
            {
                $(".row").html(res);
                $('.footable').footable();
                $("#Packet-Modal").modal();
            }
            else
                location.reload();
        },
        error:function(err){
            alert("데이터를 가져오는데 실패하였습니다.");
        }
    });
}
$(document).on("click",".show-packet",function(){
    ajaxcall("show",$(this).parent().parent().parent().find("h5").text());
});
$(document).on("click",".block",function(){
    ajaxcall("block",$(this).parent().parent().parent().parent().parent().attr("id"));
});
$(document).on("click",".unblock",function(){
    ajaxcall("unblock",$(this).parent().parent().parent().parent().parent().attr("id"));
});
$(document).on("click",".remove",function(){
    ajaxcall("remove",$(this).parent().parent().parent().parent().parent().attr("id"));
});
$(document).ready(function(){
    if($(".warn-sign").length == 1)
        $(".warn-sign").css("left",15);
    else if($(".warn-sign").length == 2)
        $(".warn-sign").css("left",20);
    else if($(".warn-sign").length == 3)
        $(".warn-sign").css("left",25);
    else if($(".warn-sign").length == 4)
        $(".warn-sign").css("left",30);
});
$.getScript("/assets/lib/js/socket.io.js", function(){
    var socket = io.connect('http://172.16.100.61:8888');
    socket.emit('realtimeOn', {});
    socket.on("realtimeOn res", function(data) {
        if(data.code == 200)
        {
            for(var i in data)
            {
                var value = [];
                for(var j in data[i])
                    value.push(data[i][j].trafficPercentage);
                $(".updating-chart[data-chart='" + i + "']").peity("line", { fill: '#0e9aef',stroke:'#1c84c6', width: 128 }).text(value.join(",")).change();
                value = $(".updating-chart[data-chart='" + i + "']").text().split(",");
                totaltraffic = totaltraffic(data[i][data[i].length-1].totaltraffic/1024);
                $(".updating-chart[data-chart='" + i + "']").parent().find("small").text(totaltraffic.toLocaleString() + "/MB");
                $(".updating-chart[data-chart='" + i + "']").parent().parent().find("h7").text(data[i][data[i].length-1].endtime);
            }
        }
        else
            alert("커넥션이 종료 되었습니다. 페이지를 새로고침을 해주시기 바랍니다.");
    });
    socket.on("realtimeClose res", function(data) {
    	console.log(JSON.stringify(data));
    });
});
function getData(page){
    $.ajax({
        type: 'POST',
        url: "./ajax.php",
        data: "oper=Usertable" + "&code=" + page,
        success: function(res){
            var spl = res.split("&");
            var temp = spl[0];
            temp = JSON.parse(temp);
            Pagination(temp.total,page+1,24);
            $(".User-Panel").html(spl[1]);
        },
        error:function(err){
            alert("데이터를 가져오는데 실패하였습니다.");
        }
    });
}
function Pagination(totalPages, nowPage, limit)
{
	$('.pagination2').empty();
	$('.pagination2').html('<button type="button" class="btn btn-white PREV"><i class="fa fa-chevron-left"></i></button>');
	var currentPage = lowerLimit = upperLimit = Math.min(nowPage, totalPages);

	for (var b = 1; b < limit && b < totalPages;) {
	    if (lowerLimit > 1 ) { lowerLimit--; b++; }
	    if (b < limit && upperLimit < totalPages) { upperLimit++; b++; }
	}

	for (var i = lowerLimit; i <= upperLimit; i++) {
	    if (i == currentPage) $('.pagination2').append('<button class="btn btn-white active">' + i + '</button>');
	    else $('.pagination2').append('<button class="btn btn-white">' + i + '</button>');
	}
	$('.pagination2').append('<button type="button" class="btn btn-white NEXT"><i class="fa fa-chevron-right"></i> </button>');
	$(".pagination2 > button").click(function(){
		var page = $(this).text();

		if($(this).hasClass("PREV"))
		{
			if(lowerLimit-1 < 1)
				page = 1;
			getData(lowerLimit-1);

		}
		else if($(this).hasClass("NEXT"))
		{

    		if(lowerLimit+1 > upperLimit)
				page = 1;
			getData(upperLimit-1);
        }
        else
			getData(page-1);
	});
}
$(document).ready(function(){
    getData(0);
});
