$(document).ready(function() {
	$(document).on("keyup", "#question_5_0_", function() {
		var input_value = $(this).val();
		var range = '';
		var content = '';
		var adult_or_adolescent = $('#adult_or_adolescent').val();
		const non_smoker_range = [];
		const light_smoker_range = [];
		const regular_smoker_range = [];
		if(adult_or_adolescent == '1') {
			non_smoker_range['min'] = 0;
			non_smoker_range['max'] = 6;
			light_smoker_range['min'] = 7;
			light_smoker_range['max'] = 10;
			regular_smoker_range['min'] = 11;
			regular_smoker_range['max'] = 30;
		} else {
			non_smoker_range['min'] = 0;
			non_smoker_range['max'] = 3;
			light_smoker_range['min'] = 4;
			light_smoker_range['max'] = 6;
			regular_smoker_range['min'] = 7;
			regular_smoker_range['max'] = 30;
		}
		if(input_value.length>0) {
			if( input_value >= non_smoker_range['min'] && input_value <= non_smoker_range['max'] ) {
				range = 'Non-smoker range';
				content = 'This is the range for non-smokers and those who’ve recently stopped smoking. The reading will fluctuate within this range from day to day and hour to hour.';
			} else if( input_value >= light_smoker_range['min'] && input_value <= light_smoker_range['max'] ) {
				range = 'Light smoker range';
				content = 'This is the range for light smoker, passive smoker or non-smoker with poor breathing air quality. Patients in this range will be advised to <span class="text-danger">stop smoking</span>. Consuming a fewer number of cigarettes per day should not be viewed as less damaging or safer – the dangerous effects of cigarettes remain the same.';
			} else {
				range = 'Regular smoker range';
				content = 'This is the range for regular smokers which smoke heavily with higher levels of CO in their blood. Patients are advised to <span class="text-danger">stop smoking</span> or receive quit smoking services for free at a government clinic.';
			}
		}
		$(".result_message").html('<strong>'+range+'</strong><p>'+content+'</p>');
	});


$("#lungs_cancer_question").submit(function(e){
        e.preventDefault();
        if($("#question_5_0_").val().length > 0){
            $(this).unbind(e).submit();;
        } else {
        	$("#question_5_0_").css({'border': 'red solid 1px'});
            return false;
        }
        
  });
});