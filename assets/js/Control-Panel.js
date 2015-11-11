function ajaxcall(action,idx){
    $.ajax({
        type: 'POST',
        url: "./ajax.php",
        data: "oper=" + action + "&code=" + idx,
        success: function(res){
            if(action == "show")
            {
                $("#Packet-Modal").html(res);
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
$.getScript("/assets/lib/js/socket.io.js", function(){
    var socket = io.connect('http://172.16.100.61:8888');
    setInterval(function(){
        socket.emit('realtimeOn', {});
        socket.on("realtimeOn res", function(data) {
            $('.error-sign').each(function() {
                if($(this).text().length == 1)
                    $(this).css("left",20);
                else if($(this).text().length == 2)
                    $(this).css("left",25);
                else if($(this).text().length == 3)
                    $(this).css("left",35);
                else if($(this).text().length == 4)
                    $(this).css("left",40);
            });
            if(data.code == 200)
            {
                for(var i in data)
                {
                    if(data.i == "statistics")
                        continue;
                    var value = [];
                    for(var j in data[i])
                    {
                        if(data[i][j].totalbytes)
                        {
                            totalbytes = parseInt(data[i][data[i].length-1].totalbytes/1024);
                            $(".updating-chart[data-chart='" + i + "']").parent().find("small").text(totalbytes.toLocaleString() + "/MB");
                            $(".updating-chart[data-chart='" + i + "']").parent().parent().find("h7").text(data[i][data[i].length-1].endtime);
                            $(".updating-chart[data-chart='" + i + "']").parent().parent().find(".error-sign").text(data[i][data[i].length-1].totaldanger);
                            $(".updating-chart[data-chart='" + i + "']").parent().parent().find(".warn-sign").text(data[i][data[i].length-1].totalwarn);
                        }
                        else
                            value.push(data[i][j].trafficPercentage);
                    }
                    $(".updating-chart[data-chart='" + i + "']").peity("line", { fill: '#0e9aef',stroke:'#1c84c6', width: 128 }).text(value.join(",")).change();
                    value = $(".updating-chart[data-chart='" + i + "']").text().split(",");
                }
            }
            else
                alert("커넥션이 종료 되었습니다. 페이지를 새로고침을 해주시기 바랍니다.");
        });
    },500);
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
