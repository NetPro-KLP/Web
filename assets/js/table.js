function getData(page){
    $.ajax({
        type: 'POST',
        url: "./ajax.php",
        data: "oper=table" + "&code=" + page,
        success: function(res){
            var spl = res.split("&");
            var temp = spl[0];
            temp = JSON.parse(temp);
            Pagination(temp.total,page+1,10);
            $("tbody").html(spl[1]);
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