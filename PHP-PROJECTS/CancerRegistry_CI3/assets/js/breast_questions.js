$(document).ready(function(){

var active_id = $(".progress_bar").find("li.active").attr('id');
if(active_id == "group_1"){
	$("#current_page").val("group_1");

} else if(active_id == "group_2"){
	$("#current_page").val("group_2");

} else if (active_id == "group_3") {

	$("#current_page").val("group_3");

} else if (active_id == "group_4") {

	$("#current_page").val("group_4");

} else if (active_id == "group_5"){

	$("#current_page").val("group_5");

} else if (active_id == "group_6"){

	$("#current_page").val("group_6");

}

$(".headnode #next, .footernode #next").on('click', function(){

	$current_page = $("#current_page").val();
	console.log($current_page);
	if ($current_page == "group_1") {

		$("#previous_page").val("group_1");
		$current_page = $("#current_page").val("group_2");
		$(".headnode #group_2").addClass('active');
		$(".footernode #group_2").addClass('active');
		$(".group_1").hide();
		$(".group_2").show();

	} else if ($current_page == "group_2") {

		$("#previous_page").val("group_2");
		$current_page = $("#current_page").val("group_3");
		$(".headnode #group_3").addClass('active');
		$(".footernode #group_3").addClass('active');		
		$(".group_2").hide();
		$(".group_3").show();

	} else if ($current_page == "group_2") {

		$("#previous_page").val("group_2");
		$current_page = $("#current_page").val("group_3");
		$(".headnode #group_3").addClass('active');
		$(".footernode #group_3").addClass('active');
		$(".group_2").hide();
		$(".group_3").show();
	} else if($current_page == "group_3"){

		$("#previous_page").val("group_3");
		$current_page = $("#current_page").val("group_4");
		$(".headnode #group_4").addClass('active');
		$(".footernode #group_4").addClass('active');
		$(".group_3").hide();
		$(".group_4").show();

	} else if($current_page == "group_4"){

		$("#previous_page").val("group_4");
		$current_page = $("#current_page").val("group_5");
		$(".headnode #group_5").addClass('active');
		$(".footernode #group_5").addClass('active');
		$(".group_4").hide();
		$(".group_5").show();

	} else if($current_page == "group_5"){

		$("#previous_page").val("group_5");
		// $current_page = $("#current_page").val("group_6");
		// $("#group_6").addClass('active');
		// $(".group_5").hide();
		// $(".group_6").show();
		$current_page = $("#current_page").val("completed");
		$(".headnode #completed").addClass('active');
		$(".footernode #completed").addClass('active');
		$(".group_5").hide();
		$(".select-msg").hide();
		$(".completed").show();
	} else if($current_page == "group_6"){

		$("#previous_page").val("group_6");
	}

	var question5_value = $('.question5:checked').val();
	var question11_value = $('.question11:checked').val();

	if (question5_value == 'no') {
    	$(".question6").hide();
	}
	if (question11_value == 'no') {
    	$(".question12").hide();
	}

});

$(".headnode #previous,.footernode #previous").on('click', function(){

	$current_page = $("#previous_page").val();
console.log($current_page);
	if($current_page == "group_1") {
		$previous_page = $("#previous_page").val("group_1");
		$("#current_page").val("group_1");
		$(".headnode #group_2").removeClass('active');
		$(".footernode #group_2").removeClass('active');
		$(".group_1").show();
		$(".group_2").hide();
	} else if ($current_page == "group_2") {
		$previous_page = $("#previous_page").val("group_1");
		$("#current_page").val("group_2");
		$(".headnode #group_3").removeClass('active');
		$(".footernode #group_3").removeClass('active');
		$(".group_2").show();
		$(".group_3").hide();
	} else if($current_page == "group_3"){

		$previous_page = $("#previous_page").val("group_2");
		$("#current_page").val("group_3"); 
		$(".headnode #group_4").removeClass('active');
		$(".footernode #group_4").removeClass('active');
		$(".group_3").show();
		$(".group_4").hide();

	} else if($current_page == "group_4"){

		$previous_page = $("#previous_page").val("group_3");
		$("#current_page").val("group_4"); 
		$(".headnode #group_5").removeClass('active');
		$(".footernode #group_5").removeClass('active');
		$(".group_4").show();
		$(".group_5").hide();

	} else if($current_page == "group_5"){


		$previous_page = $("#previous_page").val("group_5");
		$("#current_page").val("group_6"); 
		$(".headnode #completed").removeClass('active');
		$(".footernode #completed").removeClass('active');
		$(".group_5").show();
		$(".completed").hide();
		$previous_page = $("#previous_page").val("group_4");
		// $("#current_page").val("group_5");
		// $("#group_6").removeClass('active');
		// $(".group_5").show();
		// $(".group_6").hide();
	} else if($current_page == "group_6"){

		$previous_page = $("#previous_page").val("group_5");
		$("#current_page").val("group_6"); 
		$(".headnode #completed").removeClass('active');
		$(".footernode #completed").removeClass('active');
		$(".group_6").show();
		$(".completed").hide();
	} else if($current_page == "completed"){

		$previous_page = $("#previous_page").val("group_6");
		$("#current_page").val("completed"); 
		$(".headnode #completed").addClass('active');
		$(".footernode #completed").addClass('active');
		$(".group_6").hide();
		$(".select-msg").hide();
		$(".completed").show();
	}

	var question5_value = $('.question5:checked').val();
	var question11_value = $('.question11:checked').val();

	if (question5_value == 'no') {
    	$(".question6").hide();
	}
	if (question11_value == 'no') {
    	$(".question12").hide();
	}

});


$(".question5").on("click", function () {
    var val = $(this).val();
    if (val == 'yes') {
    	$(".question6").show();
    } else {
    	$(".question6").hide();

    }
});

$(".question11").on("click", function () {
    var val = $(this).val();
    if (val == 'yes') {
    	$(".question12").show();
    } else {
    	$(".question12").hide();

    }
});


});
