function testJSON(text){
    if (typeof text!=="string"){
        return false;
    }
    try{
        var json = JSON.parse(text);
        return (typeof json === 'object');
    }
    catch (error){
        return false;
    }
}
$(document).on('change', '#question_4_0_', function(e){
	var selected_value = $(this).find(':selected').data('point');
	//no json needed now
	/*
	if(testJSON(selected_value)) {
		var selected_value_json = JSON.parse(selected_value);
		if(selected_value_json.Fasting == 'fasting') {
			$("#question_6_0_").prop("disbled", true);
			$("#question_5_0_").prop("disbled", false);
			$("#question_6_0_").parent().parent().parent().parent().hide();
			$("#question_5_0_").parent().parent().parent().parent().show();
		} else {
			$("#question_5_0_").prop("disabled", true);
			$("#question_6_0_").prop("disabled", false);
			$("#question_5_0_").parent().parent().parent().parent().hide();
			$("#question_6_0_").parent().parent().parent().parent().show();
		}
	}*/
		if(selected_value == 'fasting') {
			$("#question_6_0_").parent().parent().parent().parent().hide();
			$("#question_5_0_").parent().parent().parent().parent().show();
		} else {
			$("#question_5_0_").parent().parent().parent().parent().hide();
			$("#question_6_0_").parent().parent().parent().parent().show();
		}

});

$(document).on('change', 'select', function(e) {
	if($(this).find(':selected').data('normal_value')) {
		var value = $(this).find(':selected').data('point');
		var normal_value = $(this).find(':selected').data('normal_value');
		if( value == normal_value ) {
			$("#warning_info_"+$(this).attr('id')).attr('class', 'text-success');
			$("#warning_info_"+$(this).attr('id')).text("Normal");
		} else {
			$("#warning_info_"+$(this).attr('id')).attr('class', 'text-danger');
			$("#warning_info_"+$(this).attr('id')).text("Abormal");
		}
	}
});
$(document).ready(function(){
	$("#question_6_0_").parent().parent().parent().parent().hide();
	$("#question_5_0_").parent().parent().parent().parent().hide();
	$("#question_6_0_").val(0);
	$("#question_5_0_").val(0);

	//range input default value and info message set
	/*
	$('form input[type="range"]').each(
	    function(index){  
	        var input = $(this);
	        var normal_min = input.data('normal_min');
	        var normal_max = input.data('normal_max');
	        $("#value_"+input.attr('id')).text(input.val());
	        if(normal_min == 0) {
	        	$("#normal_value_"+input.attr('id')).text('(Normal value below '+normal_max+')');
	        } else if(normal_max == 0) {
	        	$("#normal_value_"+input.attr('id')).text('(Normal value above '+normal_min+')');
	        } else {
	        	$("#normal_value_"+input.attr('id')).text('(Normal value between '+normal_min+'/'+normal_max+')');
	        }
	    }
	);*/
});

$(document).on('focusout', '#general_health_question input[type="text"]', function(e){
	console.log($(this));
	var height = $('#question_1_0_').val();
	var weight = $('#question_2_0_').val();
	if(weight.length>0 && height.length>0) {
		var weight_float = Number.parseFloat(weight);
		var height_float = Number.parseFloat(height);
		if(!Number.isNaN(weight_float) && !Number.isNaN(height_float)) {
			$('#warning_info_question_3_0_').text('');
			var BMI = (weight_float/(height_float*height_float)).toFixed(1);
			$('#question_3_0_').val(BMI + ' kg/m2');
			if(BMI<18.5) {
				$('#warning_info_question_3_0_').attr('class', 'text-danger');
				$('#warning_info_question_3_0_').text('You are Underweight');
			} else if(BMI>=18.5 && BMI<=24.9) {
				$('#warning_info_question_3_0_').attr('class', 'text-success');
				$('#warning_info_question_3_0_').text('You are of Normal BMI');
			} else if(BMI>=25 && BMI<=29.9) {
				$('#warning_info_question_3_0_').attr('class', 'text-danger');
				$('#warning_info_question_3_0_').text('You are Overweight');
			} else if(BMI>=30 && BMI<=34.9) {
				$('#warning_info_question_3_0_').attr('class', 'text-danger');
				$('#warning_info_question_3_0_').text('You are in the Obesity Class I ');
			} else if(BMI>=35 && BMI<=39.9) {
				$('#warning_info_question_3_0_').attr('class', 'text-danger');
				$('#warning_info_question_3_0_').text('You are in the Obesity Class II ');
			}
		} else {
			$('#question_3_0_').val('');
			$('#warning_info_question_3_0_').attr('class', 'text-danger');
			$('#warning_info_question_3_0_').text('*Height And Weight Should be Number');
		}
	}
});

$(document).on('keyup', '#general_health_question input[type="number"]', function(e) {
	var input_val = $(this).val();
	var normal_min = $(this).data('normal_min');
	var normal_max = $(this).data('normal_max');
	var co_depend_input = $(this).data('co_depend');
	//this co_depend used to check Bp
	if(co_depend_input) {
		$("#warning_info_"+co_depend_input).hide();
		var co_depend_element = $("#"+co_depend_input);
		var co_depend_input_val = co_depend_element.val();
		var co_depend_normal_min = co_depend_element.data('normal_min');
		var co_depend_normal_max = co_depend_element.data('normal_max');
		//set to hidden input values
		var main_input = $(this).data('main_input');
		$('#'+main_input).val(($('#'+main_input+'1').val())+'/'+($('#'+main_input+'2').val()));
		//if both value in boundary
		if((normal_max>=input_val && normal_min<=input_val) && (co_depend_normal_max>=co_depend_input_val && co_depend_normal_min<=co_depend_input_val)) {
			$("#warning_info_"+$("#"+main_input).attr('id')).attr('class', 'text-success');
			$("#warning_info_"+$("#"+main_input).attr('id')).text("Normal");
		}
		else {
			$("#warning_info_"+$("#"+main_input).attr('id')).attr('class', 'text-danger');
			$("#warning_info_"+$("#"+main_input).attr('id')).text("Abnormal");
		}
	} else {
		if(normal_max == undefined) {
			if(normal_min<=input_val) {
				$("#warning_info_"+$(this).attr('id')).attr('class', 'text-success');
				$("#warning_info_"+$(this).attr('id')).text("Normal");
			} else {
				$("#warning_info_"+$(this).attr('id')).attr('class', 'text-danger');
				$("#warning_info_"+$(this).attr('id')).text("Below Normal");
			}
		} else if(normal_min == undefined) {
			if(normal_max>=input_val) {
				$("#warning_info_"+$(this).attr('id')).attr('class', 'text-success');
				$("#warning_info_"+$(this).attr('id')).text("Normal");
			} else {
				$("#warning_info_"+$(this).attr('id')).attr('class', 'text-danger');
				$("#warning_info_"+$(this).attr('id')).text("Above Normal");
			} 
		} else {
			if(normal_max>=input_val && normal_min<=input_val) {
				$("#warning_info_"+$(this).attr('id')).attr('class', 'text-success');
				$("#warning_info_"+$(this).attr('id')).text("Normal");
			} else if(normal_max<=input_val) {
				$("#warning_info_"+$(this).attr('id')).attr('class', 'text-danger');
				$("#warning_info_"+$(this).attr('id')).text("Above Normal");
			} else if(normal_min>=input_val) {
				$("#warning_info_"+$(this).attr('id')).attr('class', 'text-danger');
				$("#warning_info_"+$(this).attr('id')).text("Below Normal");
			}
		}
	}
});

//ajax to submit
/*
$(document).on('click', '.proceed-btn-general_health_question', function(e) {
	e.preventDefault();
	const data =new Array();
	$('form[name="general_health_question"] input, form[name="general_health_question"] select').each(function(index) {
		var input = $(this);
		data[input.attr('name')] = input.val();
	});

	const jsonString = JSON.stringify(Object.assign({}, data));
	console.log(jsonString);
	 $.ajax({
        type : "POST",
        url : site_url+"general_health/ajax_save_general_health_questions",
        data : JSON.parse(jsonString),
        beforeSend: function() {
			$(this).attr('disabled',true);
        },
        success: function(response) {
        	const responseJson = JSON.parse(response);
        	if(responseJson.result == 'success') {
        		window.location()
        	} else {
        		alert("not saved");
        	}
        	$(this).attr('disabled',true);
        }
    });  
});*/
$(document).ready(function() {
    var total_page = $('#total_page').val();
    for(var i=2; i<=total_page; i++) {
        $(".group_"+i).hide();
    }
    $(".group_1").show();
});