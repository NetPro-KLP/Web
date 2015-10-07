$(document).ready(function(){
	var temp = $("ul#side-menu > li a");
	for(var i=0;i<temp.length;i++){
		var temp2 = $(temp[i]).attr("href");
		if(temp2 == window.location.pathname ){
			var temp3 = $("ul#side-menu > li a[href='" + temp2 + "']");
			$(".top-panel h2#main-title").text(temp3.text());
			temp3.parent("li").addClass("active");
			if(temp2 != "/")
				$(".breadcrumb").append("<li><a href='/'>대쉬보드</a></li>");
			if(temp3.children(".nav-label").length == 0)
			{
				temp3.parent("li").parent("ul").removeClass("collapse");
				temp3.parent("li").parent("ul").addClass("collapse in");
				temp3.parent("li").parent("ul").parent("li").addClass("active");
				$(".breadcrumb").append("<li><a>" + temp3.parent("li").parent("ul").parent().find(".nav-label").text() + "</a>");
			}
			$(".breadcrumb").append("<li class='active'><strong>" + temp3.text() + "</strong></li");
			break;
		}
	}
	
});