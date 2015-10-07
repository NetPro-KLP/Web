$(document).ready(function(){
	var temp = $("ul#side-menu > li a");
	for(var i=0;i<temp.length;i++){
		var temp2 = $(temp[i]).attr("href");
		if(temp2 == window.location.pathname ){
			$("ul#side-menu > li a[href='" + temp2 + "']").parent("li").addClass("active");
			$("ul#side-menu > li a[href='" + temp2 + "']").parent("li").parent("ul").removeClass("collapse");
			$("ul#side-menu > li a[href='" + temp2 + "']").parent("li").parent("ul").addClass("collapse in");
			$("ul#side-menu > li a[href='" + temp2 + "']").parent("li").parent("ul").parent("li").addClass("active");
			break;
		}
	}
});