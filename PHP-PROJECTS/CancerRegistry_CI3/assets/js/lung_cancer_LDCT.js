$(document).ready(function() {
	$(".question_section_parent.question_row_id_6").hide();
	$(document).on("change", "input[type='radio']", function(e) {
		if($(this).data('have_point')) {
			if($(this).data('point') == 'none') {
				$(".question_section_parent.question_row_id_6").hide();
			} else {
				$(".question_section_parent.question_row_id_6").show();
			}
		}
	});
});