$(document).ready(function() {
	const points = [];
	const yes_no = [];
	$('[id*="question"]').on("change", function() {
		if($(this).data('have_point')) {
			if($.isNumeric($(this).data('point'))) {
				points[$(this).attr('name')] = $(this).data('point');
				console.log(points);
			} else {
				yes_no[$(this).attr('name')] = $(this).data('point');
			}
		}

		if(Object.keys(points).length >= 7) {
			if($(this).data('group')) {
				calc(points, $(this).data('group'));
			}
			calc(points, 'default');
		}

		if(Object.keys(yes_no).length >= 5 ) {
			if($(this).data('group')) {
				find_yes_no(yes_no, $(this).data('group'));
			}
			find_yes_no(yes_no, 'default');
		}
	});
});

function calc(points, group) {
	var total_point = 0;
	var message;
	Object.keys(points).forEach( function(key) {
		total_point = total_point + Number(points[key]);
	});

	if(total_point > 0 && total_point <= 7) {
		message = 'You have mild symptoms.';
	} else if(total_point > 7 && total_point <= 19) {
		message = 'You have moderate symptoms. Please consult a doctor for further diagnostic tests.';
	} else if(total_point > 19 && total_point <= 35) {
		message = 'You have severe symptoms. Please consult a doctor urgently for further diagnostic tests.';
	} else {}

	$('.result_message.group_'+group).html(message);
}

function find_yes_no(yes_no, group) {
	var value = false;
	var message;
	Object.keys(yes_no).forEach( function(key) {
		if(yes_no[key] == 'yes') {
			value = true;
		}
	});

	if(value) {
		message = 'The symptom(s) that you are experiencing can be caused by a variety of reasons, which are not serious most of the time. We recommend that you discuss these symptoms with your healthcare provider. They will be able to fully assess your condition and carry out any relevant tests to determine the cause for your symptoms.';
	} else {
		message = '';
	}

	$('.result_message.group_'+group).html(message);
}