const selected_answers=new Array();
var total = 0;
$(document).ready(function() {
	var patient_gender = $("#patient_gender").val();
	if(patient_gender == 1) {
		$("#question_2_1_").trigger("click");
	} else {
		$("#question_2_0_").trigger("click");
	}
});
$(document).on('change', 'select', function(e) {
	//for assessment tool id 21
	if($(this).find(':selected').data('have_point')) {
		var q_index=$(this).attr("name");
	    var q_value=$(this).find(':selected').data('point');
	    selected_answers[q_index]=q_value;
	    calc();
	    console.log(selected_answers);
	}
});
$(document).on('change', 'input[type="radio"]', function(e) {
	if($(this).data('have_point')) {
		var q_index=$(this).attr("name");
	    var q_value=$(this).data('point');
	    selected_answers[q_index]=q_value;
	    calc();
	    console.log(selected_answers);
	}
});
function calc() {
	if( Object.keys(selected_answers).length == 4 ) {
		var total=0;
		Object.keys(selected_answers).forEach(function(key) {
            //console.log(key, radio_questions[key]);
            total=total+Number(selected_answers[key]);
        });
        var text_val = "";
        if( total == 0 || total == 1 ) {
        	text_val = "<div class='text-success'>You are of low risk and should continue preventative practices. It is ideal to do a baseline Faecal Occult Blood Test (FOBT) at any Klinik Kesihatan. Otherwise, contact National Cancer Society Malaysia (NCSM) at 03-26987351 for further details on FOBT.</div>";
        } else if( total == 2 || total == 3 ) {
        	text_val = "<div class='text-warning'>You are of moderate risk. It is recommended for you to do the FOBT at any Klinik Kesihatan. Otherwise, contact National Cancer Society Malaysia (NCSM) at 03-26987351 for further details on FOBT.</div>";
        } else if( total >= 4 && 7 >= total ) {
        	text_val ="<div class='text-danger'>You are high risk: Please consult a gastroenterologist, colorectal surgeon or general surgeon. You may do this in any private hospital or the respective units of gastroenterology in a government hospital. An urgent colonoscopy will be scheduled for you.</div>";
        } else {}

        $("#question_5_0_").val(total);
	    $('.result_message').html(text_val);
	}
}
