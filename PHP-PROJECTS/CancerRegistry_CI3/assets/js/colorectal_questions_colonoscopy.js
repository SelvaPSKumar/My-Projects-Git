$(document).ready(function() {
	$(".question_row_id_6").hide();
});
$(document).on('change', 'select', function(e) {
	if($(this).find(':selected').data('have_point')) {
		var q_index=$(this).attr("name");
	    var q_value=$(this).find(':selected').data('point');
	    if(q_value == 'normal') {
	    	$(".question_row_id_6").hide();
	    	$("#question_6_0_ option").prop("selected", false);
	    	$(".result_message").hide();
	    } else if (q_value == 'abnormal'){
	    	$(".question_row_id_6").show();
	    	$(".result_message").show();
	    }

	    var result_display = '';
	    console.log(q_value);
	    switch(q_value) {
	    	case 'haemorrhoids':
	    		result_display = '<div class="text-secondary">Consult a GP or surgeon for further management.</div>';
	    	break;

		    case 'diverticular disease':
		    case 'benign colonic polyps':
		    case 'neoplastic colonic polyps':
		    case 'inflammation/ulceration':
		    case 'bleeding':
		    	result_display = '<div class="text-secondary">Consult a gastroenterologist, or colorectal surgeon or general surgeon for further management.</div>';
		    break;

			default:
		    break;
	    }
	    $('.result_message').html(result_display);

	}
});